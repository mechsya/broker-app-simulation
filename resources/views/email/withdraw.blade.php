<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdrawal Notification</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #ffffff; margin: 0; padding: 0;">
    <!-- Header -->
    <div
        style="padding: 16px; display: flex; align-items: center; justify-content: center; border-bottom: 4px dashed #ff9900;">
        <img src="https://i.postimg.cc/SYs5KbF2/favicon.png" alt="Logo" style="height: 50px;" />
    </div>

    <!-- Content -->
    <div style="padding: 20px; color: #333333; line-height: 1.6;">
        <p>Dear {{ $name }},</p>

        @if ($type === 'signup')
            <p>Thanks for signing up!
                We're excited to have you with us.

                You can now start exploring all the features of {{ env('APP_NAME') }}.
                If you need any help, feel free to reach out!
            </p>
        @endif

        @if ($type === 'reject')
            <p>We regret to inform you that your recent withdrawal request has been <strong>rejected</strong> by our
                team.</p>
        @endif

        @if ($type === 'success')
            <p>We’re happy to let you know that your withdrawal request has been <strong>successfully
                    processed</strong>.</p>
        @endif

        @if ($type === 'request')
            <p>We have received your withdrawal request and it is currently <strong>being processed</strong> by our
                team.</p>
        @endif

        @if ($type === 'request' || $type === 'success')
            <p><strong>Withdrawal Details:</strong></p>
            <p>
                Amount: AED {{ number_format($withdraw, 2) }}<br />
                Fee: AED 0<br />
                Total: AED {{ number_format($withdraw, 2) }}
            </p>
        @endif

        @if ($type === 'reject')
            <p><strong>Reason for Rejection:</strong></p>
            <blockquote
                style="margin: 10px 0; padding: 10px; background-color: #f9f9f9; border-left: 4px solid #ff4d4f;">
                {{ $bodyMessage }}
            </blockquote>
        @endif

        @if ($type === 'success')
            <p><strong>Reason for Approve:</strong></p>
            <blockquote
                style="margin: 10px 0; padding: 10px; background-color: #f9f9f9; border-left: 4px solid #06923E;">
                {{ $bodyMessage }}
            </blockquote>
        @endif

        @if ($type === 'request')
            <p>Please allow up to 1–2 business days for the transaction to be reviewed and completed.
                Once your request has been approved and the funds have been transferred, you will receive another
                confirmation email.</p>
        @endif

        <p>If you have any questions, feel free to reply to this email or contact our support team.</p>

        <p style="margin-top: 30px;">
            ---<br />
            Best regards,<br />
            {{ env('APP_NAME') }} Support Team
        </p>
    </div>
</body>

</html>
