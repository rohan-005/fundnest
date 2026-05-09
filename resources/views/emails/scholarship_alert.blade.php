<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Scholarship Alert</title>
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
        .header h1 { font-size: 26px; font-weight: 800; }
        .badge {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            border-radius: 100px;
            padding: 6px 18px;
            font-size: 13px;
            margin-bottom: 16px;
        }
        .body { background: #fff; padding: 40px; border-radius: 0 0 20px 20px; border: 1px solid #D7E7E1; border-top: none; }
        .scholarship-card {
            background: linear-gradient(135deg, #F0FBF6, #E8F8F0);
            border: 1px solid #A7DCC8;
            border-radius: 16px;
            padding: 28px;
            margin: 24px 0;
        }
        .scholarship-card h2 { color: #0F3D35; font-size: 20px; font-weight: 700; }
        .amount { color: #1F7A67; font-size: 32px; font-weight: 800; margin: 8px 0; }
        .meta { display: flex; gap: 20px; margin-top: 16px; flex-wrap: wrap; }
        .meta-item { font-size: 13px; color: #4B7A6A; }
        .meta-item strong { display: block; color: #0F3D35; font-size: 14px; }
        .description { color: #6B7280; font-size: 14px; line-height: 1.7; margin: 16px 0; }
        .cta { text-align: center; margin: 28px 0; }
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
            <div class="badge">🎓 New Scholarship Available</div>
            <h1>Don't Miss Out!</h1>
            <p style="opacity:0.8; margin-top:8px;">A new scholarship matching your profile is now available</p>
        </div>
        <div class="body">
            <p style="color:#374151; font-size:15px; line-height:1.7;">
                A new scholarship opportunity has just opened on <strong>FundNest</strong>. Here are the details:
            </p>

            <div class="scholarship-card">
                <h2>{{ $scholarship->title }}</h2>
                <div class="amount">₹{{ number_format($scholarship->amount) }}</div>
                <div class="meta">
                    <div class="meta-item">
                        <strong>Deadline</strong>
                        {{ \Carbon\Carbon::parse($scholarship->deadline)->format('d M Y') }}
                    </div>
                    <div class="meta-item">
                        <strong>Available Slots</strong>
                        {{ $scholarship->available_slots }}
                    </div>
                    @if($scholarship->category)
                    <div class="meta-item">
                        <strong>Category</strong>
                        {{ $scholarship->category->name }}
                    </div>
                    @endif
                </div>
                @if($scholarship->eligibility)
                <p class="description"><strong>Eligibility:</strong> {{ $scholarship->eligibility }}</p>
                @endif
            </div>

            <div class="cta">
                <a href="{{ url('/scholarships/' . $scholarship->id) }}">Apply Now →</a>
            </div>

            <p style="color:#9CA3AF; font-size:12px; text-align:center;">
                You are receiving this because you are a registered student on FundNest.
            </p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} <strong>FundNest</strong> · Scholarship Management Platform</p>
        </div>
    </div>
</body>
</html>
