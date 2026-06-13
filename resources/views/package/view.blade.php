<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Shipment #{{ $package->tracking_number }} | Cheap Express Logistics</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #0f172a;
            --navy-light: #1e293b;
            --indigo: #4f46e5;
            --indigo-light: #6366f1;
            --cyan: #0891b2;
            --emerald: #059669;
            --amber: #d97706;
            --rose: #e11d48;
            --slate-50: #f8fafc;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-400: #94a3b8;
            --slate-500: #64748b;
            --slate-700: #334155;
            --slate-900: #0f172a;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f0f4f8;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }

        /* ── NAV ─────────────────────────────────────── */
        .trk-nav {
            background: rgba(15,23,42,0.95);
            backdrop-filter: blur(12px);
            padding: 0.75rem 1.5rem;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 1000;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .trk-nav-brand {
            display: flex; align-items: center; gap: 0.6rem; text-decoration: none;
        }
        .trk-nav-brand-icon {
            width: 36px; height: 36px; border-radius: 9px;
            background: var(--indigo); display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 0.9rem;
        }
        .trk-nav-brand-name { color: #fff; font-weight: 700; font-size: 1rem; }
        .trk-nav-date { color: rgba(255,255,255,0.45); font-size: 0.78rem; }
        .trk-nav-back {
            display: inline-flex; align-items: center; gap: 6px;
            color: rgba(255,255,255,0.7); font-size: 0.82rem; font-weight: 500;
            text-decoration: none; padding: 6px 14px; border-radius: 8px;
            border: 1px solid rgba(255,255,255,0.15); transition: all 0.2s;
        }
        .trk-nav-back:hover { color: #fff; background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.25); }

        /* ── HERO ────────────────────────────────────── */
        .trk-hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #1e1b4b 100%);
            padding: 3rem 1.5rem 5.5rem;
            position: relative; overflow: hidden;
        }
        .trk-hero::before {
            content: ''; position: absolute;
            top: -100px; right: -100px; width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(79,70,229,0.25) 0%, transparent 70%);
            pointer-events: none;
        }
        .trk-hero::after {
            content: ''; position: absolute;
            bottom: -80px; left: 10%; width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(8,145,178,0.15) 0%, transparent 70%);
            pointer-events: none;
        }
        .trk-hero-inner { position: relative; z-index: 2; max-width: 1200px; margin: 0 auto; }
        .trk-hero-eyebrow {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.7); font-size: 0.72rem; font-weight: 600;
            padding: 5px 12px; border-radius: 50px; letter-spacing: 0.07em; text-transform: uppercase;
            margin-bottom: 1rem;
        }
        .trk-hero-eyebrow .live-dot {
            width: 7px; height: 7px; border-radius: 50%; background: #34d399;
            animation: livePulse 2s ease-in-out infinite;
        }
        @keyframes livePulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(52,211,153,0.6); }
            50%       { box-shadow: 0 0 0 6px rgba(52,211,153,0); }
        }
        .trk-hero-tracking { font-size: clamp(1.6rem, 4vw, 2.5rem); font-weight: 800; color: #fff; letter-spacing: 0.04em; font-family: 'Courier New', monospace; margin-bottom: 0.6rem; }
        .trk-hero-sub { color: rgba(255,255,255,0.5); font-size: 0.88rem; margin-bottom: 1.5rem; }

        /* Status badge */
        .trk-status-badge {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 8px 18px; border-radius: 50px; font-size: 0.82rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase;
        }
        .trk-status-badge .dot { width: 8px; height: 8px; border-radius: 50%; animation: livePulse 2s infinite; }
        .badge-delivered  { background: rgba(5,150,105,0.2); color: #6ee7b7; border: 1px solid rgba(5,150,105,0.35); }
        .badge-delivered .dot  { background: #34d399; }
        .badge-transit    { background: rgba(79,70,229,0.2); color: #a5b4fc; border: 1px solid rgba(79,70,229,0.35); }
        .badge-transit .dot    { background: #818cf8; }
        .badge-pending    { background: rgba(217,119,6,0.2); color: #fcd34d; border: 1px solid rgba(217,119,6,0.35); }
        .badge-pending .dot    { background: #fbbf24; }
        .badge-default    { background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.8); border: 1px solid rgba(255,255,255,0.15); }
        .badge-default .dot    { background: #94a3b8; }

        /* Route strip inside hero */
        .trk-route {
            display: flex; align-items: center; gap: 1rem;
            background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);
            border-radius: 14px; padding: 1rem 1.5rem;
            margin-top: 2rem;
        }
        .trk-route-point { flex: 1; }
        .trk-route-label { font-size: 0.68rem; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.4); font-weight: 600; margin-bottom: 3px; }
        .trk-route-city  { font-size: 1rem; font-weight: 700; color: #fff; }
        .trk-route-date  { font-size: 0.75rem; color: rgba(255,255,255,0.45); margin-top: 2px; }
        .trk-route-mid   { display: flex; flex-direction: column; align-items: center; gap: 4px; flex-shrink: 0; }
        .trk-route-mid .plane { font-size: 1.2rem; color: var(--indigo-light); transform: rotate(0deg); }
        .trk-route-mid .dashes {
            display: flex; gap: 3px;
        }
        .trk-route-mid .dashes span {
            width: 20px; height: 2px; border-radius: 1px; background: rgba(255,255,255,0.2);
            animation: dashPulse 1.8s ease-in-out infinite;
        }
        .trk-route-mid .dashes span:nth-child(2) { animation-delay: 0.3s; }
        .trk-route-mid .dashes span:nth-child(3) { animation-delay: 0.6s; }
        @keyframes dashPulse { 0%,100%{opacity:0.25} 50%{opacity:0.8} }

        /* ── STATS CARDS (overlap hero) ──────────────── */
        .trk-stats { margin-top: -3rem; padding: 0 1.5rem; position: relative; z-index: 10; max-width: 1200px; margin-left: auto; margin-right: auto; margin-top: -3rem; }
        .stat-pill {
            background: #fff; border-radius: 16px;
            padding: 1rem 1.25rem; box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border: 1px solid rgba(0,0,0,0.05);
            display: flex; align-items: center; gap: 0.9rem;
        }
        .stat-pill-icon {
            width: 46px; height: 46px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0;
        }
        .spi-indigo { background: #eef2ff; color: #4f46e5; }
        .spi-emerald{ background: #ecfdf5; color: #059669; }
        .spi-amber  { background: #fffbeb; color: #d97706; }
        .spi-cyan   { background: #ecfeff; color: #0891b2; }
        .sp-label { font-size: 0.68rem; text-transform: uppercase; letter-spacing: 0.07em; color: var(--slate-500); font-weight: 600; margin-bottom: 2px; }
        .sp-value { font-size: 1.1rem; font-weight: 800; color: var(--slate-900); line-height: 1; }

        /* ── MAIN WRAPPER ────────────────────────────── */
        .trk-main { max-width: 1200px; margin: 0 auto; padding: 1.5rem; }

        /* ── CARDS ───────────────────────────────────── */
        .trk-card {
            background: #fff; border-radius: 18px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            border: 1px solid rgba(0,0,0,0.05); overflow: hidden; margin-bottom: 1.5rem;
        }
        .trk-card-header {
            padding: 1rem 1.5rem; border-bottom: 1px solid #f1f5f9;
            display: flex; align-items: center; justify-content: space-between;
        }
        .trk-card-title {
            font-size: 0.92rem; font-weight: 700; color: #1e293b;
            display: flex; align-items: center; gap: 0.6rem;
        }
        .trk-card-title-icon {
            width: 30px; height: 30px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center; font-size: 0.82rem;
        }
        .trk-card-body { padding: 1.25rem 1.5rem; }

        /* ── PROGRESS STEPS ──────────────────────────── */
        .steps-wrap { position: relative; display: flex; justify-content: space-between; align-items: flex-start; }
        .steps-line {
            position: absolute; top: 22px; left: calc(10% + 22px); right: calc(10% + 22px);
            height: 3px; background: var(--slate-200); border-radius: 2px; z-index: 0;
        }
        .steps-progress {
            position: absolute; top: 22px; left: calc(10% + 22px);
            height: 3px; background: linear-gradient(to right, #4f46e5, #818cf8);
            border-radius: 2px; z-index: 1; transition: width 1.2s ease;
        }
        .step-item { text-align: center; position: relative; z-index: 2; flex: 1; padding: 0 0.25rem; }
        .step-circle {
            width: 44px; height: 44px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 0.6rem; font-size: 1rem;
            border: 3px solid var(--slate-200); background: #fff;
            color: var(--slate-400); transition: all 0.4s ease;
        }
        .step-item.completed .step-circle { background: #4f46e5; border-color: #4f46e5; color: #fff; }
        .step-item.active .step-circle {
            background: #fff; border-color: #4f46e5; color: #4f46e5;
            box-shadow: 0 0 0 5px rgba(79,70,229,0.15);
            animation: stepPulse 2s ease-in-out infinite;
        }
        @keyframes stepPulse {
            0%,100% { box-shadow: 0 0 0 5px rgba(79,70,229,0.15); }
            50%      { box-shadow: 0 0 0 10px rgba(79,70,229,0.06); }
        }
        .step-name { font-size: 0.72rem; font-weight: 600; color: var(--slate-500); line-height: 1.3; }
        .step-item.completed .step-name, .step-item.active .step-name { color: #4f46e5; }
        .step-date { font-size: 0.65rem; color: var(--slate-400); margin-top: 2px; }

        /* ── PROGRESS BAR ────────────────────────────── */
        .trk-pbar-wrap { margin-bottom: 1.5rem; }
        .trk-pbar-labels { display: flex; justify-content: space-between; margin-bottom: 6px; font-size: 0.75rem; color: var(--slate-500); font-weight: 500; }
        .trk-pbar-labels span:last-child { font-weight: 700; color: #4f46e5; }
        .trk-pbar-bg { height: 10px; background: var(--slate-200); border-radius: 99px; overflow: hidden; }
        .trk-pbar-fill {
            height: 100%; border-radius: 99px;
            background: linear-gradient(90deg, #4f46e5, #818cf8);
            position: relative; transition: width 1.5s ease;
        }
        .trk-pbar-fill::after {
            content: ''; position: absolute; top: 0; right: 0; bottom: 0; left: 0;
            background: linear-gradient(-45deg, rgba(255,255,255,0.2) 25%, transparent 25%, transparent 50%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0.2) 75%, transparent 75%, transparent);
            background-size: 24px 24px; animation: barStripe 1.5s linear infinite;
        }
        @keyframes barStripe { to { background-position: 24px 0; } }

        /* ── MAP ─────────────────────────────────────── */
        #map { height: 420px; width: 100%; border-radius: 12px; z-index: 1; }
        .map-wrapper { border-radius: 12px; overflow: hidden; position: relative; }
        .map-pill {
            position: absolute; z-index: 10; background: rgba(15,23,42,0.85); backdrop-filter: blur(8px);
            color: #fff; border-radius: 8px; padding: 6px 12px; font-size: 0.75rem; font-weight: 600;
            display: flex; align-items: center; gap: 5px;
        }
        .map-live { top: 12px; right: 12px; }
        .map-live .ldot { width: 7px; height: 7px; border-radius: 50%; background: #34d399; animation: livePulse 2s infinite; }
        .route-info-bar {
            margin-top: 0.75rem; background: #eff6ff; border: 1px solid #bfdbfe;
            border-radius: 10px; padding: 0.65rem 1rem;
            font-size: 0.82rem; color: #1e40af; font-weight: 500; display: none;
            align-items: center; gap: 0.5rem; flex-wrap: wrap;
        }
        /* Hide the routing machine turn-by-turn panel — we only want the line */
        .leaflet-routing-container { display: none !important; }
        /* Keep Leaflet zoom control from overlapping overlays on small screens */
        @media (max-width: 576px) {
            .leaflet-control-zoom { margin-bottom: 10px !important; margin-right: 10px !important; }
            .leaflet-control-layers { margin-top: 10px !important; margin-right: 10px !important; }
        }

        /* ── TIMELINE ────────────────────────────────── */
        .trk-timeline { position: relative; }
        .trk-tl-item { display: flex; gap: 0.875rem; padding-bottom: 1.5rem; }
        .trk-tl-item:last-child { padding-bottom: 0; }
        .trk-tl-left { display: flex; flex-direction: column; align-items: center; width: 34px; flex-shrink: 0; }
        .trk-tl-dot {
            width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.75rem; font-weight: 700; position: relative; z-index: 1;
        }
        .trk-tl-dot.tl-delivered { background: #dcfce7; color: #16a34a; border: 2px solid #16a34a; }
        .trk-tl-dot.tl-transit   { background: #e0e7ff; color: #4f46e5; border: 2px solid #4f46e5; }
        .trk-tl-dot.tl-pending   { background: #fef9c3; color: #ca8a04; border: 2px solid #ca8a04; }
        .trk-tl-dot.tl-default   { background: #f1f5f9; color: #64748b; border: 2px solid #94a3b8; }
        .trk-tl-dot.tl-current   { box-shadow: 0 0 0 5px rgba(79,70,229,0.15); }
        .trk-tl-line { flex: 1; width: 2px; background: #e2e8f0; min-height: 18px; margin: 3px 0; }
        .trk-tl-item:last-child .trk-tl-line { display: none; }
        .trk-tl-content {
            flex: 1; background: #f8fafc; border: 1px solid #e2e8f0;
            border-radius: 12px; padding: 0.875rem 1rem; transition: box-shadow 0.2s;
        }
        .trk-tl-content:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.07); }
        .trk-tl-content.current-item { background: #eff6ff; border-color: #bfdbfe; }
        .trk-tl-top { display: flex; justify-content: space-between; align-items: flex-start; gap: 0.5rem; flex-wrap: wrap; }
        .trk-tl-status { font-weight: 700; color: #1e293b; font-size: 0.88rem; }
        .trk-tl-time   { font-size: 0.72rem; color: var(--slate-500); white-space: nowrap; }
        .trk-tl-loc    { font-size: 0.8rem; color: #475569; margin-top: 3px; display: flex; align-items: center; gap: 4px; }
        .trk-current-badge {
            display: inline-flex; align-items: center; gap: 5px;
            background: #4f46e5; color: #fff; font-size: 0.68rem; font-weight: 700;
            padding: 3px 10px; border-radius: 50px; text-transform: uppercase; letter-spacing: 0.06em; margin-top: 6px;
        }
        .trk-current-badge::before { content: ''; width: 6px; height: 6px; background: #fff; border-radius: 50%; animation: livePulse2 1.5s ease-in-out infinite; }
        @keyframes livePulse2 { 0%,100%{opacity:0.4} 50%{opacity:1} }

        /* ── INFO SECTIONS ───────────────────────────── */
        .info-row {
            display: flex; padding: 0.55rem 0;
            border-bottom: 1px solid #f8fafc;
            font-size: 0.85rem; gap: 0.5rem; align-items: flex-start;
        }
        .info-row:last-child { border-bottom: none; padding-bottom: 0; }
        .info-lbl { color: #64748b; font-weight: 600; min-width: 130px; flex-shrink: 0; font-size: 0.8rem; }
        .info-val { color: #1e293b; font-weight: 500; word-break: break-word; }
        .person-avatar {
            width: 42px; height: 42px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 1rem; flex-shrink: 0; color: #fff;
        }

        /* ── MEDIA ───────────────────────────────────── */
        .media-grid { display: flex; flex-wrap: wrap; gap: 10px; }
        .media-thumb {
            width: 120px; height: 95px; border-radius: 10px; overflow: hidden;
            border: 2px solid #e2e8f0; cursor: pointer; transition: all 0.2s;
        }
        .media-thumb:hover { border-color: #4f46e5; transform: scale(1.03); }
        .media-thumb img, .media-thumb video { width: 100%; height: 100%; object-fit: cover; }

        /* ── ACTION BUTTONS ──────────────────────────── */
        .btn-trk-outline {
            display: inline-flex; align-items: center; gap: 6px;
            border: 1.5px solid #e2e8f0; background: #fff; color: #475569;
            padding: 0.55rem 1.25rem; border-radius: 10px; font-weight: 600; font-size: 0.85rem;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-trk-outline:hover { border-color: #4f46e5; color: #4f46e5; background: #eff6ff; }
        .btn-trk-primary {
            display: inline-flex; align-items: center; gap: 6px;
            background: linear-gradient(135deg, #4f46e5, #6366f1); color: #fff;
            border: none; padding: 0.55rem 1.25rem; border-radius: 10px; font-weight: 700; font-size: 0.85rem;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-trk-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(79,70,229,0.35); }

        /* ── STATUS ALERT ────────────────────────────── */
        .trk-alert {
            display: flex; align-items: flex-start; gap: 0.75rem;
            background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 12px;
            padding: 1rem 1.25rem; font-size: 0.85rem; color: #1e40af; font-weight: 500; margin-bottom: 1.5rem;
        }
        .trk-alert i { font-size: 1rem; color: #4f46e5; flex-shrink: 0; margin-top: 1px; }

        /* ── FOOTER ──────────────────────────────────── */
        .trk-footer {
            background: #0f172a; color: rgba(255,255,255,0.6);
            padding: 2.5rem 1.5rem; margin-top: 2rem;
        }
        .trk-footer-inner { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
        .trk-footer-brand { display: flex; align-items: center; gap: 0.5rem; color: #fff; font-weight: 700; font-size: 0.95rem; text-decoration: none; }
        .trk-footer-brand-icon { width: 30px; height: 30px; border-radius: 7px; background: #4f46e5; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 0.8rem; }
        .trk-footer-contact a { color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.82rem; }
        .trk-footer-contact a:hover { color: #fff; }

        /* ── RESPONSIVE ──────────────────────────────── */
        @media (max-width: 992px) {
            #map { height: 340px; }
        }
        @media (max-width: 768px) {
            .trk-hero { padding: 2rem 1rem 5rem; }
            .trk-route { flex-direction: column; gap: 0.75rem; }
            .trk-route-mid .plane { transform: rotate(90deg); }
            #map { height: 260px; border-radius: 10px; }
            .map-wrapper { border-radius: 10px; }
            .map-card-body { padding: 0.75rem !important; }
            .steps-wrap { flex-wrap: wrap; gap: 0.5rem; }
            .steps-line, .steps-progress { display: none; }
            .step-item { flex: 0 0 45%; }
            .stat-pill { padding: 0.75rem 1rem; }
            .sp-value { font-size: 1rem; }
            .trk-tl-top { flex-direction: column; }
            .trk-card-header { flex-wrap: wrap; gap: 0.5rem; }
        }
        @media (max-width: 480px) {
            #map { height: 220px; border-radius: 8px; }
            .map-wrapper { border-radius: 8px; }
            .map-pill { font-size: 0.68rem; padding: 4px 8px; }
            .map-pill .ldot { width: 6px; height: 6px; }
            .route-info-bar { font-size: 0.78rem; }
            .map-card-body { padding: 0.5rem !important; }
        }

        /* Leaflet popup */
        .leaflet-popup-content-wrapper { border-radius: 10px; box-shadow: 0 8px 30px rgba(0,0,0,0.15); }
        .custom-popup { font-family: 'Inter', sans-serif; font-size: 0.82rem; min-width: 140px; }
        .custom-popup strong { display: block; font-weight: 700; color: #1e293b; margin-bottom: 3px; }
        .custom-popup span { color: #64748b; }
    </style>
</head>
<body>

    <!-- GTranslate -->
    <div class="gtranslate_wrapper"></div>
    <script>
        window.gtranslateSettings = {"default_language":"en","detect_browser_language":true,"wrapper_selector":".gtranslate_wrapper","switcher_horizontal_position":"right","switcher_vertical_position":"middle","alt_flags":{"en":"usa","pt":"brazil","es":"colombia","fr":"quebec"}}
    </script>
    <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

    <!-- Nav -->
    <nav class="trk-nav">
        <a href="{{ route('homepage') }}" class="trk-nav-brand">
            <div class="trk-nav-brand-icon"><i class="fas fa-shipping-fast"></i></div>
            <span class="trk-nav-brand-name">Cheap Express Logistics</span>
        </a>
        <span class="trk-nav-date d-none d-md-block">{{ date('l, F j, Y') }}</span>
        <a href="{{ route('track') }}" class="trk-nav-back">
            <i class="fas fa-search" style="font-size:0.75rem;"></i> Track Another
        </a>
    </nav>

    @php
        $latestStatus = $package->trackingLocations->sortByDesc('arrival_time')->first()->status ?? ($package->status ?? 'In Transit');
        $badgeClass = 'badge-default'; $badgeIcon = 'fa-circle';
        if (str_contains($latestStatus, 'Delivered'))                                                         { $badgeClass = 'badge-delivered'; $badgeIcon = 'fa-check-circle'; }
        elseif (str_contains($latestStatus,'Shipped')||str_contains($latestStatus,'Transit')||str_contains($latestStatus,'Delivery')) { $badgeClass = 'badge-transit';   $badgeIcon = 'fa-shipping-fast'; }
        elseif (str_contains($latestStatus,'Pending')||str_contains($latestStatus,'Processing')||str_contains($latestStatus,'Created')){ $badgeClass = 'badge-pending';   $badgeIcon = 'fa-clock'; }
        $currentLocation = $package->trackingLocations->where('is_current', true)->first();
        $stepsProgress = 0;
        if ($package->current_step >= 1) $stepsProgress = 0;
        if ($package->current_step >= 2) $stepsProgress = 33;
        if ($package->current_step >= 3) $stepsProgress = 66;
        if ($package->current_step >= 4) $stepsProgress = 100;
    @endphp

    <!-- Hero -->
    <div class="trk-hero">
        <div class="trk-hero-inner">
            <div class="trk-hero-eyebrow">
                <span class="live-dot"></span> Live Tracking
            </div>
            <div class="trk-hero-tracking">{{ $package->tracking_number }}</div>
            <div class="trk-hero-sub">Shipment Tracking Details &mdash; Last updated {{ $package->updated_at->format('M d, Y · H:i') }}</div>
            <span class="trk-status-badge {{ $badgeClass }}">
                <span class="dot"></span>
                <i class="fas {{ $badgeIcon }}"></i>
                {{ $latestStatus }}
            </span>

            <!-- Route -->
            <div class="trk-route">
                <div class="trk-route-point">
                    <div class="trk-route-label"><i class="fas fa-map-marker-alt me-1"></i>Origin</div>
                    <div class="trk-route-city">{{ $package->shipping_from }}</div>
                    @if($package->shipping_date)
                    <div class="trk-route-date">{{ $package->shipping_date->format('M d, Y') }}</div>
                    @endif
                </div>
                <div class="trk-route-mid">
                    <div class="dashes"><span></span><span></span><span></span></div>
                    <i class="fas fa-plane plane"></i>
                    <div class="dashes"><span></span><span></span><span></span></div>
                </div>
                <div class="trk-route-point" style="text-align:right;">
                    <div class="trk-route-label"><i class="fas fa-flag-checkered me-1"></i>Destination</div>
                    <div class="trk-route-city">{{ $package->shipping_to }}</div>
                    @if($package->estimated_delivery_date)
                    <div class="trk-route-date">Est. {{ $package->estimated_delivery_date->format('M d, Y') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Stats pills -->
    <div class="trk-stats">
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="stat-pill">
                    <div class="stat-pill-icon spi-indigo"><i class="fas fa-weight-hanging"></i></div>
                    <div><div class="sp-label">Weight</div><div class="sp-value">{{ $package->total_weight }}<small style="font-weight:500;color:#94a3b8;font-size:0.7rem;"> kg</small></div></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-pill">
                    <div class="stat-pill-icon spi-emerald"><i class="fas fa-cubes"></i></div>
                    <div><div class="sp-label">Qty</div><div class="sp-value">{{ $package->item_quantity }}<small style="font-weight:500;color:#94a3b8;font-size:0.7rem;"> pcs</small></div></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-pill">
                    <div class="stat-pill-icon spi-amber"><i class="fas fa-dollar-sign"></i></div>
                    <div><div class="sp-label">Value</div><div class="sp-value">${{ number_format($package->declared_value, 0) }}</div></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-pill">
                    <div class="stat-pill-icon spi-cyan"><i class="fas fa-tachometer-alt"></i></div>
                    <div><div class="sp-label">Progress</div><div class="sp-value">{{ $package->progress_percentage }}<small style="font-weight:500;color:#94a3b8;font-size:0.7rem;">%</small></div></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="trk-main" style="margin-top: 1.5rem;">

        <!-- Video (shown at top if present) -->
        @if(!empty($package->video_url) && count($package->video_url) > 0)
        <div class="trk-card" style="overflow:hidden;">
            <div class="trk-card-header">
                <div class="trk-card-title">
                    <div class="trk-card-title-icon" style="background:#faf5ff;color:#7c3aed;"><i class="fas fa-video"></i></div>
                    Package Video
                </div>
                <span style="font-size:0.78rem;color:#64748b;">{{ count($package->video_url) }} video{{ count($package->video_url) != 1 ? 's' : '' }}</span>
            </div>
            <!-- Responsive 16:9 main player -->
            @php
                $primaryVideo = $package->video_url[0];
                $primaryVideoSrc = str_starts_with($primaryVideo, 'http') ? $primaryVideo : asset($primaryVideo);
            @endphp
            <div style="position:relative;width:100%;padding-top:56.25%;background:#000;">
                <video id="mainVideoPlayer" controls autoplay muted playsinline
                    style="position:absolute;top:0;left:0;width:100%;height:100%;object-fit:contain;display:block;">
                    <source src="{{ $primaryVideoSrc }}" type="video/mp4">
                </video>
            </div>
            <!-- Extra video thumbnails -->
            @if(count($package->video_url) > 1)
            <div style="padding:0.75rem 1rem;display:flex;gap:10px;flex-wrap:wrap;border-top:1px solid #f1f5f9;background:#f8fafc;">
                @foreach($package->video_url as $i => $vUrl)
                @php $vSrc = str_starts_with($vUrl, 'http') ? $vUrl : asset($vUrl); @endphp
                <div onclick="switchVideo('{{ $vSrc }}')"
                    style="width:140px;height:88px;border-radius:10px;overflow:hidden;border:2px solid {{ $i===0 ? '#7c3aed' : '#e2e8f0' }};cursor:pointer;flex-shrink:0;transition:border-color 0.2s;"
                    onmouseover="this.style.borderColor='#7c3aed'" onmouseout="this.style.borderColor='#e2e8f0'">
                    <video style="width:100%;height:100%;object-fit:cover;pointer-events:none;" muted preload="metadata">
                        <source src="{{ $vSrc }}" type="video/mp4">
                    </video>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @endif

        <!-- Status alert -->
        <div class="trk-alert">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Current Status:</strong>
                @if($currentLocation)
                    Your package is currently in <strong>{{ $currentLocation->location_name }}</strong>.
                @else
                    Your package is in transit to <strong>{{ $package->shipping_to }}</strong>.
                @endif
                Last updated: {{ $package->updated_at->format('M d, Y H:i') }}
            </div>
        </div>

        <!-- Map -->
        <div class="trk-card">
            <div class="trk-card-header">
                <div class="trk-card-title">
                    <div class="trk-card-title-icon" style="background:#eff6ff;color:#4f46e5;"><i class="fas fa-map-marked-alt"></i></div>
                    Live Map
                </div>
                <div style="display:flex;gap:8px;">
                    <button class="btn-trk-outline" id="centerMap" style="padding:0.35rem 0.9rem;font-size:0.78rem;">
                        <i class="fas fa-crosshairs"></i> Center
                    </button>
                    <button class="btn-trk-outline" id="toggleRoute" style="padding:0.35rem 0.9rem;font-size:0.78rem;">
                        <i class="fas fa-route"></i> Route
                    </button>
                </div>
            </div>
            <div class="trk-card-body map-card-body">
                <div class="map-wrapper">
                    <div id="map"></div>
                    <div class="map-pill map-live"><span class="ldot"></span> Live Tracking</div>
                </div>
                <div class="route-info-bar" id="routeInfo">
                    <i class="fas fa-route me-2"></i>
                    Distance: <strong id="routeDistance"></strong> &nbsp;·&nbsp; Est. Time: <strong id="routeTime"></strong>
                </div>
            </div>
        </div>

        <!-- Progress bar + Steps -->
        <div class="trk-card">
            <div class="trk-card-header">
                <div class="trk-card-title">
                    <div class="trk-card-title-icon" style="background:#f0fdf4;color:#059669;"><i class="fas fa-tasks"></i></div>
                    Delivery Progress
                </div>
                <span style="font-size:0.8rem;font-weight:700;color:#4f46e5;">{{ $package->progress_percentage }}% Complete</span>
            </div>
            <div class="trk-card-body">
                <!-- Progress bar -->
                <div class="trk-pbar-wrap">
                    <div class="trk-pbar-labels">
                        <span>{{ $package->shipping_from }}</span>
                        <span>{{ $package->progress_percentage }}%</span>
                        <span>{{ $package->shipping_to }}</span>
                    </div>
                    <div class="trk-pbar-bg">
                        <div class="trk-pbar-fill" style="width:{{ $package->progress_percentage }}%;"></div>
                    </div>
                </div>

                <!-- Steps -->
                <div class="steps-wrap mt-4">
                    <div class="steps-line"></div>
                    <div class="steps-progress" style="width: calc({{ $stepsProgress }}% * (100% - calc(20% + 44px)) / 100);"></div>

                    @php $steps = [
                        ['icon'=>'fa-clipboard-check','name'=>$package->step1_name ?? 'Send Out','date'=>$package->step1_date ?? null,'num'=>1],
                        ['icon'=>'fa-cog',            'name'=>$package->step2_name ?? 'Processing','date'=>$package->step2_date ?? null,'num'=>2],
                        ['icon'=>'fa-shipping-fast',  'name'=>$package->step3_name ?? 'In Transit','date'=>$package->step3_date ?? null,'num'=>3],
                        ['icon'=>'fa-check-circle',   'name'=>$package->step4_name ?? 'Arriving','date'=>$package->step4_date ?? null,'num'=>4],
                    ]; @endphp

                    @foreach($steps as $step)
                    @php
                        $stepClass = '';
                        if ($package->current_step > $step['num'])       $stepClass = 'completed';
                        elseif ($package->current_step == $step['num'])  $stepClass = 'active';
                    @endphp
                    <div class="step-item {{ $stepClass }}">
                        <div class="step-circle">
                            @if($package->current_step > $step['num'])
                                <i class="fas fa-check"></i>
                            @else
                                <i class="fas {{ $step['icon'] }}"></i>
                            @endif
                        </div>
                        <div class="step-name">{{ $step['name'] }}</div>
                        @if($step['date'])
                        <div class="step-date">{{ $step['date']->format('M d') }}</div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Tracking Timeline -->
        <div class="trk-card">
            <div class="trk-card-header">
                <div class="trk-card-title">
                    <div class="trk-card-title-icon" style="background:#eef2ff;color:#4f46e5;"><i class="fas fa-route"></i></div>
                    Tracking History
                </div>
                <span style="font-size:0.78rem;color:#64748b;">{{ $package->trackingLocations->count() }} update{{ $package->trackingLocations->count() != 1 ? 's' : '' }}</span>
            </div>
            <div class="trk-card-body">
                @if($package->trackingLocations->isEmpty())
                    <div style="text-align:center;padding:2rem;color:#9ca3af;">
                        <i class="fas fa-map-marked-alt" style="font-size:2rem;display:block;margin-bottom:0.75rem;"></i>
                        No tracking updates available yet.
                    </div>
                @else
                <div class="trk-timeline">
                    @foreach($package->trackingLocations->sortByDesc('arrival_time') as $loc)
                    @php
                        $tlDot = 'tl-default'; $tlIcon = 'fa-circle';
                        if (str_contains($loc->status,'Delivered'))                                                          { $tlDot='tl-delivered'; $tlIcon='fa-check'; }
                        elseif (str_contains($loc->status,'Shipped')||str_contains($loc->status,'Transit')||str_contains($loc->status,'Delivery')) { $tlDot='tl-transit';   $tlIcon='fa-shipping-fast'; }
                        elseif (str_contains($loc->status,'Pending')||str_contains($loc->status,'Processing')||str_contains($loc->status,'Created')){ $tlDot='tl-pending';   $tlIcon='fa-clock'; }
                    @endphp
                    <div class="trk-tl-item">
                        <div class="trk-tl-left">
                            <div class="trk-tl-dot {{ $tlDot }} {{ $loc->is_current ? 'tl-current' : '' }}">
                                <i class="fas {{ $tlIcon }}" style="font-size:0.65rem;"></i>
                            </div>
                            <div class="trk-tl-line"></div>
                        </div>
                        <div class="trk-tl-content {{ $loc->is_current ? 'current-item' : '' }}">
                            <div class="trk-tl-top">
                                <span class="trk-tl-status">{{ $loc->status }}</span>
                                <span class="trk-tl-time"><i class="far fa-clock me-1"></i>{{ $loc->arrival_time->format('M d, Y · h:i A') }}</span>
                            </div>
                            <div class="trk-tl-loc">
                                <i class="fas fa-map-pin" style="color:#94a3b8;font-size:0.7rem;"></i>
                                {{ $loc->location_name }}
                            </div>
                            @if($loc->is_current)
                                <span class="trk-current-badge">Current Location</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        <!-- Sender + Receiver -->
        <div class="row g-4 mb-4">
            <!-- Sender -->
            <div class="col-md-6">
                <div class="trk-card h-100" style="margin-bottom:0;">
                    <div class="trk-card-header">
                        <div class="trk-card-title">
                            <div class="trk-card-title-icon" style="background:#fff7ed;color:#ea580c;"><i class="fas fa-user-tie"></i></div>
                            Sender
                        </div>
                    </div>
                    <div class="trk-card-body">
                        @if($package->sender_name && $package->sender_name !== 'Not Provided')
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="person-avatar" style="background:linear-gradient(135deg,#ea580c,#f97316);">{{ strtoupper(substr($package->sender_name,0,1)) }}</div>
                            <div>
                                <div style="font-weight:700;color:#1e293b;">{{ $package->sender_name }}</div>
                                @if($package->sender_email && $package->sender_email !== 'not-provided@example.com')
                                <div style="font-size:0.78rem;color:#64748b;">{{ $package->sender_email }}</div>
                                @endif
                            </div>
                        </div>
                        @endif
                        @if($package->sender_phone && $package->sender_phone !== 'Not Provided')
                        <div class="info-row"><span class="info-lbl"><i class="fas fa-phone me-1" style="color:#ea580c;"></i>Phone</span><span class="info-val">{{ $package->sender_phone }}</span></div>
                        @endif
                        @if($package->sender_address && $package->sender_address !== 'Not Provided')
                        <div class="info-row"><span class="info-lbl"><i class="fas fa-map-marker-alt me-1" style="color:#ea580c;"></i>Address</span><span class="info-val">{{ $package->sender_address }}</span></div>
                        @endif
                        @if(($package->sender_city && $package->sender_city !== 'Not Provided') || ($package->sender_state && $package->sender_state !== 'Not Provided'))
                        <div class="info-row">
                            <span class="info-lbl"><i class="fas fa-city me-1" style="color:#ea580c;"></i>City/State</span>
                            <span class="info-val">{{ collect([$package->sender_city, $package->sender_state, $package->sender_zip])->filter(fn($v)=>$v && $v!=='Not Provided')->implode(', ') }}</span>
                        </div>
                        @endif
                        @if($package->sender_country && $package->sender_country !== 'Not Provided')
                        <div class="info-row"><span class="info-lbl"><i class="fas fa-globe me-1" style="color:#ea580c;"></i>Country</span><span class="info-val">{{ $package->sender_country }}</span></div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Receiver -->
            <div class="col-md-6">
                <div class="trk-card h-100" style="margin-bottom:0;">
                    <div class="trk-card-header">
                        <div class="trk-card-title">
                            <div class="trk-card-title-icon" style="background:#faf5ff;color:#7c3aed;"><i class="fas fa-user"></i></div>
                            Receiver
                        </div>
                    </div>
                    <div class="trk-card-body">
                        @if($package->receiver_name)
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="person-avatar" style="background:linear-gradient(135deg,#7c3aed,#a855f7);">{{ strtoupper(substr($package->receiver_name,0,1)) }}</div>
                            <div>
                                <div style="font-weight:700;color:#1e293b;">{{ $package->receiver_name }}</div>
                                @if($package->receiver_email && $package->receiver_email !== 'not-provided@example.com')
                                <div style="font-size:0.78rem;color:#64748b;">{{ $package->receiver_email }}</div>
                                @endif
                            </div>
                        </div>
                        @endif
                        @if($package->receiver_phone)
                        <div class="info-row"><span class="info-lbl"><i class="fas fa-phone me-1" style="color:#7c3aed;"></i>Phone</span><span class="info-val">{{ $package->receiver_phone }}</span></div>
                        @endif
                        @if($package->receiver_address)
                        <div class="info-row"><span class="info-lbl"><i class="fas fa-map-marker-alt me-1" style="color:#7c3aed;"></i>Address</span><span class="info-val">{{ $package->receiver_address }}</span></div>
                        @endif
                        @if(($package->receiver_city && $package->receiver_city !== 'Not Provided') || ($package->receiver_state && $package->receiver_state !== 'Not Provided'))
                        <div class="info-row">
                            <span class="info-lbl"><i class="fas fa-city me-1" style="color:#7c3aed;"></i>City/State</span>
                            <span class="info-val">{{ collect([$package->receiver_city, $package->receiver_state, $package->receiver_zip])->filter(fn($v)=>$v && $v!=='Not Provided')->implode(', ') }}</span>
                        </div>
                        @endif
                        @if($package->receiver_country)
                        <div class="info-row"><span class="info-lbl"><i class="fas fa-globe me-1" style="color:#7c3aed;"></i>Country</span><span class="info-val">{{ $package->receiver_country }}</span></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Shipping + Package details -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="trk-card h-100" style="margin-bottom:0;">
                    <div class="trk-card-header">
                        <div class="trk-card-title">
                            <div class="trk-card-title-icon" style="background:#ecfdf5;color:#059669;"><i class="fas fa-truck"></i></div>
                            Shipping Information
                        </div>
                    </div>
                    <div class="trk-card-body">
                        @if($package->shipping_from)<div class="info-row"><span class="info-lbl">From</span><span class="info-val">{{ $package->shipping_from }}</span></div>@endif
                        @if($package->shipping_to)<div class="info-row"><span class="info-lbl">To</span><span class="info-val">{{ $package->shipping_to }}</span></div>@endif
                        @if($package->shipping_date)<div class="info-row"><span class="info-lbl">Ship Date</span><span class="info-val">{{ $package->shipping_date->format('M d, Y') }}</span></div>@endif
                        @if($package->estimated_delivery_date)<div class="info-row"><span class="info-lbl">Est. Delivery</span><span class="info-val">{{ $package->estimated_delivery_date->format('M d, Y') }}</span></div>@endif
                        <div class="info-row"><span class="info-lbl">Carrier</span><span class="info-val">Cheap Express Logistics</span></div>
                        <div class="info-row"><span class="info-lbl">Service</span><span class="info-val">Priority International</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="trk-card h-100" style="margin-bottom:0;">
                    <div class="trk-card-header">
                        <div class="trk-card-title">
                            <div class="trk-card-title-icon" style="background:#eff6ff;color:#2563eb;"><i class="fas fa-box-open"></i></div>
                            Package Details
                        </div>
                    </div>
                    <div class="trk-card-body">
                        @if($package->item_description)<div class="info-row"><span class="info-lbl">Description</span><span class="info-val">{{ $package->item_description }}</span></div>@endif
                        @if($package->item_quantity)<div class="info-row"><span class="info-lbl">Quantity</span><span class="info-val">{{ $package->item_quantity }} pcs</span></div>@endif
                        @if($package->declared_value)<div class="info-row"><span class="info-lbl">Declared Value</span><span class="info-val">${{ number_format($package->declared_value, 2) }}</span></div>@endif
                        @if($package->total_weight)<div class="info-row"><span class="info-lbl">Total Weight</span><span class="info-val">{{ $package->total_weight }} kg</span></div>@endif
                        @if($package->number_of_boxes || $package->box_weight)
                        <div class="info-row"><span class="info-lbl">Boxes</span><span class="info-val">{{ $package->number_of_boxes }} box{{ $package->number_of_boxes != 1 ? 'es' : '' }}@if($package->box_weight) &nbsp;({{ $package->box_weight }} kg ea.)@endif</span></div>
                        @endif
                        @if($package->notes)<div class="info-row"><span class="info-lbl">Notes</span><span class="info-val">{{ $package->notes }}</span></div>@endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Images -->
        @if(!empty($package->image_url) && count($package->image_url) > 0)
        <div class="trk-card">
            <div class="trk-card-header">
                <div class="trk-card-title">
                    <div class="trk-card-title-icon" style="background:#fff7ed;color:#ea580c;"><i class="fas fa-camera"></i></div>
                    Package Images
                </div>
                <span style="font-size:0.78rem;color:#64748b;">{{ count($package->image_url) }} image{{ count($package->image_url) != 1 ? 's' : '' }}</span>
            </div>
            <div class="trk-card-body">
                <div class="media-grid">
                    @foreach($package->image_url as $imageUrl)
                    <div class="media-thumb" onclick="window.open('{{ $imageUrl }}','_blank')">
                        <img src="{{ $imageUrl }}" alt="Package">
                    </div>
                    @endforeach
                </div>
                <p style="font-size:0.72rem;color:#94a3b8;margin-top:8px;"><i class="fas fa-external-link-alt me-1"></i>Click any image to view full size</p>
            </div>
        </div>
        @endif


        <!-- Action buttons -->
        <div class="d-flex justify-content-end gap-2 mb-2" style="flex-wrap:wrap;">
            <button class="btn-trk-outline" id="printBtn"><i class="fas fa-print"></i> Print Details</button>
            <button class="btn-trk-primary" id="refreshBtn"><i class="fas fa-sync-alt"></i> Refresh Status</button>
        </div>

    </div><!-- /trk-main -->

    <!-- Footer -->
    <div class="trk-footer">
        <div class="trk-footer-inner">
            <a href="{{ route('homepage') }}" class="trk-footer-brand">
                <div class="trk-footer-brand-icon"><i class="fas fa-shipping-fast"></i></div>
                Cheap Express Logistics
            </a>
            <div class="trk-footer-contact">
                <a href="mailto:support@cheapexpresslogistics.org"><i class="fas fa-envelope me-1"></i> support@cheapexpresslogistics.org</a>
            </div>
            <div style="font-size:0.78rem;">© {{ date('Y') }} Cheap Express Logistics</div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const isMobile = () => window.innerWidth <= 768;
        const map = L.map('map', {
            zoomControl: false,
            preferCanvas: true,
            tap: true,
            dragging: true,
            touchZoom: true,
            scrollWheelZoom: !isMobile()
        }).setView([20, 0], 2);

        // Place zoom control bottom-right so it doesn't collide with overlays on mobile
        L.control.zoom({ position: isMobile() ? 'bottomright' : 'topleft' }).addTo(map);

        // Recalculate map size whenever the container resizes (orientation change, etc.)
        window.addEventListener('resize', () => {
            map.invalidateSize();
            map.options.scrollWheelZoom = !isMobile();
        });

        const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 19
        });
        const darkLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OpenStreetMap &copy; CARTO', maxZoom: 19
        });
        const satelliteLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 20, subdomains: ['mt0','mt1','mt2','mt3'], attribution: '&copy; Google'
        });
        osmLayer.addTo(map);
        L.control.layers({ "Street": osmLayer, "Dark": darkLayer, "Satellite": satelliteLayer }).addTo(map);

        async function geocodeLocation(name) {
            try {
                const r = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(name)}&limit=1`);
                const d = await r.json();
                if (d && d.length > 0) return { lat: parseFloat(d[0].lat), lng: parseFloat(d[0].lon), name: d[0].display_name };
            } catch(e) {}
            return null;
        }

        function makeIcon(html, size) {
            return L.divIcon({ html, className: '', iconSize: size, iconAnchor: [size[0]/2, size[1]/2] });
        }

        async function initMap() {
            const originGeo = await geocodeLocation('{{ $package->shipping_from }}');
            const destGeo   = await geocodeLocation('{{ $package->shipping_to }}');

            const originCoords = originGeo ? [originGeo.lat, originGeo.lng] : [37.7749, -122.4194];
            const destCoords   = destGeo   ? [destGeo.lat,   destGeo.lng]   : [40.7128,  -74.0060];

            const originIcon = makeIcon(`<div style="width:14px;height:14px;border-radius:50%;background:#10b981;border:3px solid #fff;box-shadow:0 0 0 3px rgba(16,185,129,0.3);"></div>`, [14,14]);
            const destIcon   = makeIcon(`<div style="width:14px;height:14px;border-radius:50%;background:#ef4444;border:3px solid #fff;box-shadow:0 0 0 3px rgba(239,68,68,0.3);"></div>`, [14,14]);
            const truckIcon  = makeIcon(`<div style="font-size:22px;filter:drop-shadow(0 2px 4px rgba(0,0,0,0.4));">✈️</div>`, [28,28]);

            L.marker(originCoords, {icon: originIcon}).addTo(map)
                .bindPopup(`<div class="custom-popup"><strong>Origin</strong><span>{{ $package->shipping_from }}</span></div>`);
            L.marker(destCoords, {icon: destIcon}).addTo(map)
                .bindPopup(`<div class="custom-popup"><strong>Destination</strong><span>{{ $package->shipping_to }}</span></div>`);

            @if($currentLocation)
                const curGeo = await geocodeLocation('{{ $currentLocation->location_name }}');
                var currentCoords = curGeo ? [curGeo.lat, curGeo.lng] : [
                    originCoords[0] + (destCoords[0]-originCoords[0]) * {{ ($package->progress_percentage ?? 50) / 100 }},
                    originCoords[1] + (destCoords[1]-originCoords[1]) * {{ ($package->progress_percentage ?? 50) / 100 }}
                ];
            @else
                var currentCoords = [
                    originCoords[0] + (destCoords[0]-originCoords[0]) * {{ ($package->progress_percentage ?? 50) / 100 }},
                    originCoords[1] + (destCoords[1]-originCoords[1]) * {{ ($package->progress_percentage ?? 50) / 100 }}
                ];
            @endif

            const vehicleMarker = L.marker(currentCoords, {icon: truckIcon}).addTo(map)
                .bindPopup(`<div class="custom-popup"><strong>Current Location</strong><span>{{ $currentLocation ? $currentLocation->location_name : $package->shipping_to }} &mdash; {{ $package->progress_percentage }}%</span></div>`)
                .openPopup();

            const routingControl = L.Routing.control({
                waypoints: [L.latLng(originCoords), L.latLng(destCoords)],
                routeWhileDragging: false, showAlternatives: false, fitSelectedRoutes: false, show: false,
                createMarker: () => null,
                lineOptions: { styles: [{ color: '#4f46e5', opacity: 0.6, weight: 5 }] }
            }).addTo(map);

            const traveledLine  = L.polyline([originCoords, currentCoords], { color: '#10b981', weight: 4, opacity: 0.8, dashArray: '8,8' }).addTo(map);
            const remainingLine = L.polyline([currentCoords, destCoords],   { color: '#94a3b8', weight: 3, opacity: 0.5, dashArray: '6,10' }).addTo(map);

            const bounds = L.latLngBounds([originCoords, destCoords, currentCoords]);
            // Let the DOM settle before fitting bounds (fixes blank map on first load)
            setTimeout(() => {
                map.invalidateSize();
                map.fitBounds(bounds.pad(isMobile() ? 0.2 : 0.15));
            }, 200);

            routingControl.on('routesfound', function(e) {
                const r = e.routes[0];
                document.getElementById('routeDistance').textContent = (r.summary.totalDistance/1000).toFixed(1) + ' km';
                document.getElementById('routeTime').textContent = Math.round(r.summary.totalTime/3600) + ' hrs';
                document.getElementById('routeInfo').style.display = 'flex';
            });

            let routeVisible = true;
            document.getElementById('toggleRoute').addEventListener('click', function() {
                routeVisible = !routeVisible;
                if (routeVisible) {
                    routingControl.addTo(map); traveledLine.addTo(map); remainingLine.addTo(map);
                    this.innerHTML = '<i class="fas fa-route"></i> Route';
                } else {
                    map.removeControl(routingControl); map.removeLayer(traveledLine); map.removeLayer(remainingLine);
                    this.innerHTML = '<i class="fas fa-eye-slash"></i> Show';
                }
            });
            document.getElementById('centerMap').addEventListener('click', () => map.fitBounds(bounds.pad(0.15)));

            return { vehicleMarker, currentCoords, destCoords };
        }

        initMap().then(({ vehicleMarker, currentCoords, destCoords }) => {
            let simActive = false, simInterval, simPos = [...currentCoords];
            const simCtrl = L.control({ position: 'bottomleft' });
            simCtrl.onAdd = function() {
                const d = L.DomUtil.create('div');
                d.innerHTML = `<button id="simBtn" style="background:#f59e0b;color:#fff;border:none;padding:6px 12px;border-radius:8px;font-size:0.75rem;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:5px;"><i class="fas fa-play"></i> Demo</button>`;
                return d;
            };
            simCtrl.addTo(map);
            document.getElementById('simBtn').addEventListener('click', function() {
                if (!simActive) {
                    simActive = true; this.innerHTML = '<i class="fas fa-stop"></i> Stop'; this.style.background = '#ef4444';
                    simInterval = setInterval(() => {
                        const step = 0.0001;
                        simPos = [simPos[0]+(destCoords[0]-simPos[0])*step, simPos[1]+(destCoords[1]-simPos[1])*step];
                        vehicleMarker.setLatLng(simPos);
                        if (Math.abs(simPos[0]-destCoords[0])<0.01 && Math.abs(simPos[1]-destCoords[1])<0.01) { simActive=false; clearInterval(simInterval); this.innerHTML='<i class="fas fa-play"></i> Demo'; this.style.background='#f59e0b'; }
                    }, 100);
                } else {
                    simActive = false; clearInterval(simInterval); this.innerHTML = '<i class="fas fa-play"></i> Demo'; this.style.background = '#f59e0b';
                }
            });
        });

        // Video thumbnail switcher
        window.switchVideo = function(src) {
            const player = document.getElementById('mainVideoPlayer');
            if (!player) return;
            player.pause();
            player.src = src;
            player.load();
            player.play().catch(() => {});
            player.scrollIntoView({ behavior: 'smooth', block: 'center' });
        };

        document.getElementById('printBtn').addEventListener('click', () => window.print());
        document.getElementById('refreshBtn').addEventListener('click', function() {
            const orig = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Refreshing...'; this.disabled = true;
            setTimeout(() => { this.innerHTML = orig; this.disabled = false; location.reload(); }, 1500);
        });
    });
    </script>

    <!-- Chaport Live Chat -->
    <script type="text/javascript">
        (function(w,d,v3){
        w.chaportConfig = { appId : '69cef60e3d9a0fc13a0c4609' };
        if(w.chaport)return;v3=w.chaport={};v3._q=[];v3._l={};v3.q=function(){v3._q.push(arguments)};v3.on=function(e,fn){if(!v3._l[e])v3._l[e]=[];v3._l[e].push(fn)};var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://app.chaport.com/javascripts/insert.js';var ss=d.getElementsByTagName('script')[0];ss.parentNode.insertBefore(s,ss)})(window, document);
    </script>
</body>
</html>
