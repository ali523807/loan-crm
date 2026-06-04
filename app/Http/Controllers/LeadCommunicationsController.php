<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadCommunicationRequest;
use App\Models\CommunicationLog;
use App\Models\CommunicationTemplate;
use App\Models\LoanApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Throwable;

class LeadCommunicationsController extends Controller
{
    public function store(StoreLeadCommunicationRequest $request, LoanApplication $loanApplication): RedirectResponse
    {
        $loanApplication->load(['customer', 'documents']);
        $template = CommunicationTemplate::query()->findOrFail($request->validated('communication_template_id'));
        $subject = $request->validated('subject') ?: $this->renderTemplate($template->subject ?? '', $loanApplication);
        $message = $request->validated('message') ?: $this->renderTemplate($template->body, $loanApplication);
        $channel = $request->validated('channel');
        $recipient = $channel === 'email'
            ? (string) $loanApplication->customer->email
            : (string) $loanApplication->customer->mobile;

        $status = $channel === 'email' ? 'sent' : 'prepared';
        $errorMessage = null;
        $sentAt = $channel === 'email' ? now() : null;

        if ($channel === 'email') {
            try {
                abort_if(blank($recipient), 422, 'Customer email is not available.');

                Mail::raw($message, function ($mail) use ($recipient, $subject): void {
                    $mail->to($recipient)->subject($subject ?: 'Loan application update');
                });
            } catch (Throwable $throwable) {
                $status = 'failed';
                $sentAt = null;
                $errorMessage = $throwable->getMessage();
            }
        }

        CommunicationLog::query()->create([
            'loan_application_id' => $loanApplication->id,
            'communication_template_id' => $template->id,
            'sent_by_id' => $request->user()->id,
            'channel' => $channel,
            'recipient' => $recipient,
            'subject' => $subject,
            'message' => $message,
            'status' => $status,
            'error_message' => $errorMessage,
            'sent_at' => $sentAt,
        ]);

        return back()->with(
            $status === 'failed' ? 'error' : 'success',
            $status === 'failed'
                ? 'Communication could not be sent, but the failed attempt was logged.'
                : ($channel === 'email' ? 'Email sent and logged successfully.' : 'WhatsApp message prepared and logged.'),
        );
    }

    private function renderTemplate(string $content, LoanApplication $loanApplication): string
    {
        $missingDocuments = $loanApplication->documents
            ->filter(fn ($document): bool => in_array($document->status, ['missing', 'rejected'], true))
            ->map(fn ($document): string => '- '.$document->type.($document->remarks ? ': '.$document->remarks : ''))
            ->values()
            ->join("\n");

        $variables = [
            '{app_name}' => config('app.name'),
            '{customer_name}' => $loanApplication->customer->full_name,
            '{application_number}' => $loanApplication->application_number,
            '{loan_type}' => $loanApplication->loan_type,
            '{status}' => $loanApplication->statusLabel(),
            '{missing_documents}' => $missingDocuments ?: '- No missing documents recorded.',
        ];

        return str_replace(array_keys($variables), array_values($variables), $content);
    }
}
