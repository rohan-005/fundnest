<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Update</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #F9F9F9; padding: 40px 20px; }
        .wrapper { max-width: 600px; margin: 0 auto; }
        .header {
            background: linear-gradient(135deg, #1a1a2e, #374151);
            border-radius: 20px 20px 0 0;
            padding: 40px;
            text-align: center;
            color: white;
        }
        .header h1 { font-size: 26px; font-weight: 800; }
        .header p { margin-top: 6px; opacity: 0.7; font-size: 14px; }
        .badge {
            display: inline-block;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 100px;
            padding: 6px 18px;
            font-size: 13px;
            margin-bottom: 16px;
        }
        .body {
            background: #fff;
            padding: 40px;
            border-radius: 0 0 20px 20px;
            border: 1px solid #E5E7EB;
            border-top: none;
        }
        .notice {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 28px;
            text-align: center;
        }
        .notice h2 { color: #991B1B; font-size: 20px; margin-top: 12px; }
        .detail-card {
            background: #F9FAFB;
            border: 1px solid #E5E7EB;
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 24px;
        }
        .detail-card h3 { font-size: 12px; color: #9CA3AF; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; }
        .detail-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #F3F4F6; }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { color: #6B7280; font-size: 14px; }
        .detail-value { color: #111827; font-weight: 600; font-size: 14px; }
        .remark-box {
            background: #FFF7ED;
            border: 1px solid #FED7AA;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 24px;
        }
        .remark-box h3 { font-size: 12px; color: #92400E; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
        .remark-box p { color: #78350F; font-size: 14px; line-height: 1.6; }
        .cta { text-align: center; margin: 28px 0; }
        .cta a {
            display: inline-block;
            background: #1F7A67;
            color: white;
            padding: 14px 36px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
        }
        .footer { text-align: center; margin-top: 32px; color: #9CA3AF; font-size: 13px; line-height: 1.7; }
        .footer strong { color: #1F7A67; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="badge">FundNest Scholarship Platform</div>
            <h1>Application Status Update</h1>
            <p>An update regarding your scholarship application</p>
        </div>
        <div class="body">
            <div class="notice">
                <div style="font-size:40px;">📋</div>
                <h2>Dear {{ $application->user->name }},</h2>
                <p style="color:#6B7280; margin-top:10px; font-size:14px; line-height:1.6;">
                    After careful review, we regret to inform you that your application for the scholarship below has not been approved at this time.
                </p>
            </div>

            <div class="detail-card">
                <h3>Application Details</h3>
                <div class="detail-row">
                    <span class="detail-label">Scholarship</span>
                    <span class="detail-value">{{ $application->scholarship->title }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Amount</span>
                    <span class="detail-value">₹{{ number_format($application->scholarship->amount) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Status</span>
                    <span class="detail-value" style="color:#DC2626;">❌ Not Approved</span>
                </div>
            </div>

            @if($application->admin_remark)
            <div class="remark-box">
                <h3>Reviewer's Feedback</h3>
                <p>{{ $application->admin_remark }}</p>
            </div>
            @endif

            <p style="color:#6B7280; font-size:14px; line-height:1.8; margin-bottom:24px;">
                Don't be discouraged! There are many other scholarship opportunities available on FundNest. We encourage you to browse and apply for other scholarships that match your profile.
            </p>

            <div class="cta">
                <a href="{{ url('/scholarships') }}">Browse More Scholarships →</a>
            </div>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} <strong>FundNest</strong> · Scholarship Management Platform</p>
            <p>This is an automated email, please do not reply directly.</p>
        </div>
    </div>
</body>
</html>
