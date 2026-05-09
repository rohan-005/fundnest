<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Approved</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #EAF7F2; padding: 40px 20px; }
        .wrapper { max-width: 600px; margin: 0 auto; }
        .header {
            background: linear-gradient(135deg, #0F3D35, #1F7A67);
            border-radius: 20px 20px 0 0;
            padding: 40px;
            text-align: center;
            color: white;
        }
        .header h1 { font-size: 28px; font-weight: 800; letter-spacing: -0.5px; }
        .header p { margin-top: 6px; opacity: 0.85; font-size: 14px; }
        .badge {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 100px;
            padding: 6px 18px;
            font-size: 13px;
            margin-bottom: 16px;
            letter-spacing: 0.5px;
        }
        .body {
            background: #fff;
            padding: 40px;
            border-radius: 0 0 20px 20px;
            border: 1px solid #D7E7E1;
            border-top: none;
        }
        .congrats {
            background: #F0FBF6;
            border: 1px solid #A7DCC8;
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 28px;
            text-align: center;
        }
        .congrats .emoji { font-size: 48px; }
        .congrats h2 { color: #0F3D35; font-size: 22px; margin-top: 12px; font-weight: 700; }
        .detail-card {
            background: #F8FFFE;
            border: 1px solid #D7E7E1;
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 24px;
        }
        .detail-card h3 { font-size: 13px; color: #A7B8B3; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; }
        .detail-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #EAF7F2; }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { color: #6B7280; font-size: 14px; }
        .detail-value { color: #0F3D35; font-weight: 600; font-size: 14px; }
        .amount { color: #1F7A67; font-size: 22px; font-weight: 800; }
        .cta {
            text-align: center;
            margin: 28px 0;
        }
        .cta a {
            display: inline-block;
            background: linear-gradient(135deg, #1F7A67, #39B68D);
            color: white;
            padding: 14px 36px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
        }
        .footer { text-align: center; margin-top: 32px; color: #A7B8B3; font-size: 13px; line-height: 1.7; }
        .footer strong { color: #1F7A67; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="badge">FundNest Scholarship Platform</div>
            <h1>🎉 Application Approved!</h1>
            <p>Great news awaits you below</p>
        </div>
        <div class="body">
            <div class="congrats">
                <div class="emoji">🏆</div>
                <h2>Congratulations, {{ $application->user->name }}!</h2>
                <p style="color:#4B7A6A; margin-top:8px; font-size:15px;">
                    Your scholarship application has been <strong>approved</strong>.
                </p>
            </div>

            <div class="detail-card">
                <h3>Scholarship Details</h3>
                <div class="detail-row">
                    <span class="detail-label">Scholarship</span>
                    <span class="detail-value">{{ $application->scholarship->title }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Award Amount</span>
                    <span class="amount">₹{{ number_format($application->scholarship->amount) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Status</span>
                    <span class="detail-value" style="color:#1DB954;">✅ Approved</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Date</span>
                    <span class="detail-value">{{ now()->format('d M Y') }}</span>
                </div>
            </div>

            @if($application->admin_remark)
            <div class="detail-card">
                <h3>Admin Remarks</h3>
                <p style="color:#374151; line-height:1.6;">{{ $application->admin_remark }}</p>
            </div>
            @endif

            <div class="cta">
                <a href="{{ url('/dashboard') }}">View Your Dashboard →</a>
            </div>

            <p style="color:#6B7280; font-size:14px; line-height:1.7; text-align:center;">
                Keep an eye on your FundNest account for further instructions regarding fund disbursement. We wish you all the best in your academic journey!
            </p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} <strong>FundNest</strong> · Scholarship Management Platform</p>
            <p>This is an automated email, please do not reply directly.</p>
        </div>
    </div>
</body>
</html>
