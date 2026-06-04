<?php

namespace Database\Seeders;

use App\Models\CommunicationTemplate;
use Illuminate\Database\Seeder;

class CommunicationTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'name' => 'Status Update',
                'type' => 'status_update',
                'channel' => 'email',
                'subject' => 'Loan application {application_number} status update',
                'body' => "Dear {customer_name},\n\nYour loan application {application_number} is currently marked as {status}.\n\nOur team will contact you if any further action is required.\n\nRegards,\n{app_name}",
            ],
            [
                'name' => 'Missing Documents',
                'type' => 'missing_documents',
                'channel' => 'email',
                'subject' => 'Documents required for application {application_number}',
                'body' => "Dear {customer_name},\n\nWe need the following document updates to continue processing your loan application {application_number}:\n\n{missing_documents}\n\nPlease share clear copies at the earliest.\n\nRegards,\n{app_name}",
            ],
            [
                'name' => 'Document Rejected',
                'type' => 'document_rejected',
                'channel' => 'email',
                'subject' => 'Document update required for {application_number}',
                'body' => "Dear {customer_name},\n\nOne or more documents for your application {application_number} could not be verified.\n\n{missing_documents}\n\nPlease resubmit the corrected documents.\n\nRegards,\n{app_name}",
            ],
            [
                'name' => 'Sanction Letter Generated',
                'type' => 'sanction_generated',
                'channel' => 'email',
                'subject' => 'Sanction letter generated for {application_number}',
                'body' => "Dear {customer_name},\n\nYour sanction letter for loan application {application_number} has been generated. Please review the terms and complete the required agreement formalities.\n\nRegards,\n{app_name}",
            ],
            [
                'name' => 'Disbursement Completed',
                'type' => 'disbursement_completed',
                'channel' => 'email',
                'subject' => 'Loan disbursement update for {application_number}',
                'body' => "Dear {customer_name},\n\nYour loan application {application_number} has been marked as {status}. The disbursement process has been completed as per the approved terms.\n\nRegards,\n{app_name}",
            ],
        ];

        foreach ($templates as $template) {
            CommunicationTemplate::query()->updateOrCreate(
                ['name' => $template['name']],
                [...$template, 'active' => true],
            );
        }
    }
}
