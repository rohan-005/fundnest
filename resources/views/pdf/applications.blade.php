<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FundNest — Applications Report</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10px; color: #1a1a1a; }
        .header {
            background: #0F3D35;
            color: white;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 { font-size: 18px; font-weight: 800; }
        .header p { font-size: 11px; opacity: 0.7; margin-top: 3px; }
        .meta { background: #EAF7F2; padding: 10px 24px; font-size: 10px; color: #4B7A6A; border-bottom: 1px solid #D7E7E1; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        thead th { background: #1F7A67; color: white; padding: 8px 10px; text-align: left; font-size: 9px; text-transform: uppercase; letter-spacing: 0.5px; }
        tbody tr:nth-child(even) { background: #F0FBF6; }
        tbody td { padding: 7px 10px; border-bottom: 1px solid #E5E7EB; vertical-align: top; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 20px; font-size: 9px; font-weight: 700; }
        .approved { background: #DCFCE7; color: #166534; }
        .pending  { background: #FEF9C3; color: #854D0E; }
        .rejected { background: #FEE2E2; color: #991B1B; }
        .footer { margin-top: 20px; text-align: center; color: #9CA3AF; font-size: 9px; padding: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h1>FundNest — Applications Report</h1>
            <p>Generated on {{ now()->format('d M Y, h:i A') }}</p>
        </div>
        <div style="text-align:right; font-size:11px; opacity:0.8;">
            Total: {{ $applications->count() }} applications
        </div>
    </div>

    <div class="meta">
        Exported by {{ auth()->user()->name }} ({{ auth()->user()->role }})
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Email</th>
                <th>Scholarship</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Applied On</th>
                <th>Remark</th>
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $i => $app)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $app->user->name }}</td>
                <td>{{ $app->user->email }}</td>
                <td>{{ $app->scholarship->title }}</td>
                <td>₹{{ number_format($app->scholarship->amount) }}</td>
                <td><span class="badge {{ $app->status }}">{{ ucfirst($app->status) }}</span></td>
                <td>{{ $app->created_at->format('d M Y') }}</td>
                <td>{{ $app->admin_remark ?: '—' }}</td>
            </tr>
            @empty
            <tr><td colspan="8" style="text-align:center; padding:20px; color:#9CA3AF;">No applications found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">FundNest Scholarship Management Platform · Confidential</div>
</body>
</html>
