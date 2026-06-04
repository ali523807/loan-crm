@php
    $money = fn (int|float|null $amount): string => 'Rs. '.number_format((float) ($amount ?? 0));
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $document->typeLabel() }} - {{ $application->application_number }}</title>
    <style>
        body {
            margin: 0;
            background: #eef2f7;
            color: #111827;
            font-family: Arial, sans-serif;
            line-height: 1.55;
        }

        .toolbar {
            max-width: 900px;
            margin: 24px auto 12px;
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .toolbar button {
            border: 0;
            border-radius: 8px;
            padding: 10px 16px;
            background: #111827;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }

        .letter {
            max-width: 900px;
            min-height: 1080px;
            margin: 0 auto 32px;
            padding: 54px;
            background: #fff;
            box-shadow: 0 18px 60px rgba(15, 23, 42, .12);
        }

        .letter-header {
            display: flex;
            justify-content: space-between;
            gap: 24px;
            border-bottom: 2px solid #111827;
            padding-bottom: 18px;
            margin-bottom: 32px;
        }

        .brand {
            font-size: 28px;
            font-weight: 800;
        }

        .meta {
            text-align: right;
            color: #475569;
            font-size: 14px;
        }

        h1 {
            font-size: 24px;
            margin: 0 0 22px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 18px 0 26px;
        }

        th,
        td {
            border: 1px solid #d7dee8;
            padding: 10px 12px;
            text-align: left;
        }

        th {
            background: #f8fafc;
        }

        .signature {
            margin-top: 60px;
        }

        .muted {
            color: #64748b;
        }

        @media print {
            body {
                background: #fff;
            }

            .toolbar {
                display: none;
            }

            .letter {
                box-shadow: none;
                margin: 0;
                max-width: none;
                min-height: auto;
            }
        }
    </style>
</head>
<body>
<div class="toolbar">
    <button onclick="window.print()">Print / Save PDF</button>
</div>

<main class="letter">
    <div class="letter-header">
        <div>
            <div class="brand">{{ config('app.name') }}</div>
            <div class="muted">Loan processing and customer service desk</div>
        </div>
        <div class="meta">
            <div><strong>{{ $document->typeLabel() }}</strong></div>
            <div>{{ $document->document_number }}</div>
            <div>{{ $document->generated_at->format('d M Y') }}</div>
        </div>
    </div>

    <h1>{{ $document->typeLabel() }}</h1>

    <p>To,</p>
    <p>
        <strong>{{ $customer->full_name }}</strong><br>
        {{ $customer->address ?? 'Address not available' }}<br>
        Mobile: {{ $customer->mobile }}<br>
        Email: {{ $customer->email ?? '-' }}
    </p>

    @if($document->type === 'sanction_letter')
        <p>
            We are pleased to inform you that your loan application
            <strong>{{ $application->application_number }}</strong> has been sanctioned subject to final documentation,
            agreement execution, and internal policy checks.
        </p>
    @elseif($document->type === 'disbursement_letter')
        <p>
            This letter confirms that the sanctioned loan amount for application
            <strong>{{ $application->application_number }}</strong> is ready for disbursement as per the terms below.
        </p>
    @elseif($document->type === 'welcome_letter')
        <p>
            Welcome to {{ config('app.name') }}. Your loan account has been created for application
            <strong>{{ $application->application_number }}</strong>. Please keep this letter for your records.
        </p>
    @else
        <p>
            The repayment schedule below is generated for your loan application
            <strong>{{ $application->application_number }}</strong>. The first 24 installments are shown for review.
        </p>
    @endif

    <table>
        <tbody>
        <tr>
            <th>Loan Type</th>
            <td>{{ $application->loan_type }}</td>
        </tr>
        <tr>
            <th>Loan Amount</th>
            <td>{{ $money($snapshot['principal']) }}</td>
        </tr>
        <tr>
            <th>Annual Interest Rate</th>
            <td>{{ $snapshot['annual_interest_rate'] }}%</td>
        </tr>
        <tr>
            <th>Tenure</th>
            <td>{{ $snapshot['tenure_months'] }} months</td>
        </tr>
        <tr>
            <th>Estimated EMI</th>
            <td>{{ $money($snapshot['emi']) }}</td>
        </tr>
        <tr>
            <th>Processing Fee</th>
            <td>{{ $money($snapshot['processing_fee']) }}</td>
        </tr>
        @if(in_array($document->type, ['disbursement_letter', 'welcome_letter'], true))
            <tr>
                <th>Disbursement Reference</th>
                <td>{{ $snapshot['disbursement_reference'] }}</td>
            </tr>
            <tr>
                <th>Bank Account</th>
                <td>Ending with {{ $snapshot['bank_account_last_four'] }}</td>
            </tr>
        @endif
        </tbody>
    </table>

    @if($document->type === 'repayment_schedule')
        <table>
            <thead>
            <tr>
                <th>Month</th>
                <th>EMI</th>
                <th>Principal</th>
                <th>Interest</th>
                <th>Balance</th>
            </tr>
            </thead>
            <tbody>
            @foreach($schedule as $row)
                <tr>
                    <td>{{ $row['month'] }}</td>
                    <td>{{ $money($row['emi']) }}</td>
                    <td>{{ $money($row['principal']) }}</td>
                    <td>{{ $money($row['interest']) }}</td>
                    <td>{{ $money($row['balance']) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <p class="muted">
        This is a system generated document. Final terms are subject to signed agreement,
        internal policy checks, and applicable statutory requirements.
    </p>

    <div class="signature">
        <strong>Authorized Signatory</strong><br>
        {{ config('app.name') }}
    </div>
</main>
</body>
</html>
