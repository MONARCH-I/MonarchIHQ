<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 — Access Denied | MonarchI</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a0a;
            color: #f5f5f7;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .glow {
            position: fixed;
            top: -20%;
            left: 50%;
            transform: translateX(-50%);
            width: 800px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(239,68,68,0.15), transparent 70%);
            pointer-events: none;
        }
        .container {
            text-align: center;
            position: relative;
            z-index: 10;
            padding: 40px 20px;
        }
        .code {
            font-size: 120px;
            font-weight: 800;
            line-height: 1;
            background: linear-gradient(135deg, #ef4444, #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -6px;
        }
        .title {
            font-size: 28px;
            font-weight: 700;
            margin: 20px 0 12px;
            color: #f5f5f7;
        }
        .subtitle {
            font-size: 15px;
            color: rgba(245,245,247,0.55);
            max-width: 420px;
            margin: 0 auto 36px;
            line-height: 1.6;
        }
        .actions { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
        .btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 11px 24px; border-radius: 12px;
            font-size: 14px; font-weight: 600;
            text-decoration: none; transition: all 0.15s;
        }
        .btn-primary { background: #2997ff; color: #fff; }
        .btn-primary:hover { background: #1a7de3; transform: translateY(-1px); }
        .btn-secondary {
            background: rgba(255,255,255,0.05);
            color: rgba(245,245,247,0.7);
            border: 1px solid rgba(255,255,255,0.1);
        }
        .btn-secondary:hover { background: rgba(255,255,255,0.08); }
        .badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #ef4444;
            border: 1px solid rgba(239,68,68,0.3);
            padding: 4px 12px;
            border-radius: 99px;
            background: rgba(239,68,68,0.08);
            margin-bottom: 24px;
        }
    </style>
</head>
<body>
    <div class="glow"></div>
    <div class="container">
        <a href="{{ url('/') }}" style="display:inline-block;margin-bottom:20px;text-decoration:none;">
            <img src="{{ asset('images/logo-white.png') }}" alt="MonarchI Logo" style="height:44px;width:auto;object-fit:contain;margin:0 auto;display:block;" />
        </a>
        <div class="code">403</div>
        <div class="badge">Access Denied</div>
        <h1 class="title">You don't have permission here.</h1>
        <p class="subtitle">
            Your account does not have the required role to access this section.
            If you believe this is an error, contact your system administrator.
        </p>
        <div class="actions">
            <a href="javascript:history.back()" class="btn btn-secondary">← Go Back</a>
            <a href="{{ url('/dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
        </div>
    </div>
</body>
</html>
