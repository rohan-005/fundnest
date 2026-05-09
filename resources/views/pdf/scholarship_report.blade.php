<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $scholarship->title }} — Report</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10px; color: #1a1a1a; }
        .header { background: #0F3D35; color: white; padding: 24px; }
        .header h1 { font-size: 16px; font-weight: 800; }
        .header .sub { font-size: 11px; opacity: 0.7; margin-top: 4px; }
        .info-grid { display: flex; gap: 12px; padding: 16px 24px; background: #EAF7F2; border-bottom: 1px solid #D7E7E1; }
        .info-item { flex: 1; }
        .info-item .label { font-size: 8px; text-transform: uppercase; letter-spacing: 0.5px; color: #4B7A6A; margin-bottom: 3px; }
        .info-item .value { font-size: 12px; font-weight: 700; color: #0F3D35; }
        .section-title { font-size: 11px; font-weight: 700; color: #0F3D35; padding: 12px 24px 6px; border-top: 1px solid #D7E7E1; margin-top: 10px; }
        table { width: 100%; border-collapse: collapse; }
        thead th { background: #1F7A67; color: white; padding: 7px 10px; text-align: left; font-size: 9px; text-transform: uppercase; }
        tbody tr:nth-child(even) { background: #F0FBF6; }
        tbody td { padding: 7px 10px; border-bottom: 1px solid #E5E7EB; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 20px; font-size: 9px; font-weight: 700; }
        .approved { background: #DCFCE7; color: #166534; }
        .pending  { background: #FEF9C3; color: #854D0E; }
        .rejected { background: #FEE2E2; color: #991B1B; }
        .footer { margin-top: 20px; text-align: center; color: #9CA3AF; font-size: 9px; padding: 10px; }
        .desc { padding: 10px 24px; font-size: 10px; line-height: 1.6; color: #374151; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $scholarship->title }}</h1>
        <p class="sub">Scholarship Report · Generated {{ now()->format('d M Y') }}</p>
    </div>

    <div class="info-grid">
        <div class="info-item">
            <div class="label">Amount</div>
            <div class="value">₹{{ number_format($scholarship->amount) }}</div>
        </div>
        <div class="info-item">
            <div class="label">Deadline</div>
            <div class="value">{{ $scholarship->deadline?->format('d M Y') }}</div>
        </div>
        <div class="info-item">
            <div class="label">Slots</div>
            <div class="value">{{ $scholarship->available_slots }}</div>
        </div>
        <div class="info-item">
            <div class="label">Total Applications</div>
            <div class="value">{{ $scholarship->applications->count() }}</div>
        </div>
        <div class="info-item">
            <div class="label">Approved</div>
            <div class="value" style="color:#166534">{{ $scholarship->applications->where('status','approved')->count() }}</div>
        </div>
        <div class="info-item">
            <div class="label">Category</div>
            <div class="value">{{ $scholarship->category?->name ?? 'Uncategorized' }}</div>
        </div>
    </div>

    @if($scholarship->eligibility)
    <div class="desc">
        <strong>Eligibility:</strong> {{ $scholarship->eligibility }}
    </div>
    @endif

    <div class="section-title">Applications</div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Email</th>
                <th>Institution</th>
                <th>CGPA</th>
                <th>Status</th>
                <th>Applied</th>
            </tr>
        </thead>
        <tbody>
            @forelse($scholarship->applications as $i => $app)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $app->user->name }}</td>
                <td>{{ $app->user->email }}</td>
                <td>{{ $app->user->institution ?: '—' }}</td>
                <td>{{ $app->user->cgpa ? number_format($app->user->cgpa,2) : '—' }}</td>
                <td><span class="badge {{ $app->status }}">{{ ucfirst($app->status) }}</span></td>
                <td>{{ $app->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center; padding:16px; color:#9CA3AF;">No applications yet.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">FundNest Scholarship Management Platform · Confidential Report</div>
</body>
</html>
