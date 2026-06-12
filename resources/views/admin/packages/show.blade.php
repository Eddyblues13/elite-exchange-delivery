@include('admin.header')

<style>
    /* ── Page base ─────────────────────────────────── */
    .pkg-page { background: #f0f2f5; min-height: 100vh; }

    /* ── Hero header ───────────────────────────────── */
    .pkg-hero {
        background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 60%, #1d4ed8 100%);
        padding: 2rem 2rem 4.5rem;
        position: relative;
        overflow: hidden;
    }
    .pkg-hero::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 300px; height: 300px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
    }
    .pkg-hero::after {
        content: '';
        position: absolute;
        bottom: -80px; left: 20%;
        width: 220px; height: 220px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }
    .pkg-hero-title { font-size: 1.1rem; color: rgba(255,255,255,0.7); font-weight: 500; margin-bottom: 0.25rem; }
    .pkg-hero-tracking {
        font-size: 1.75rem; font-weight: 800; color: #fff; letter-spacing: 0.05em;
        font-family: 'Courier New', monospace;
    }
    .pkg-hero-status { display: inline-flex; align-items: center; gap: 6px; padding: 6px 16px; border-radius: 50px; font-size: 0.8rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; }
    .status-delivered  { background: rgba(16,185,129,0.2); color: #6ee7b7; border: 1px solid rgba(16,185,129,0.4); }
    .status-transit    { background: rgba(59,130,246,0.2); color: #93c5fd; border: 1px solid rgba(59,130,246,0.4); }
    .status-pending    { background: rgba(245,158,11,0.2); color: #fcd34d; border: 1px solid rgba(245,158,11,0.4); }
    .status-default    { background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.8); border: 1px solid rgba(255,255,255,0.2); }
    .pkg-hero-actions { display: flex; gap: 0.5rem; flex-wrap: wrap; }
    .btn-hero-primary {
        background: #fff; color: #1e3a5f; font-weight: 700; font-size: 0.85rem;
        border: none; padding: 0.55rem 1.25rem; border-radius: 8px;
        display: inline-flex; align-items: center; gap: 6px;
        transition: all 0.2s; cursor: pointer;
    }
    .btn-hero-primary:hover { background: #e0e7ff; color: #1e3a5f; transform: translateY(-1px); }
    .btn-hero-ghost {
        background: rgba(255,255,255,0.12); color: #fff; font-weight: 600; font-size: 0.85rem;
        border: 1px solid rgba(255,255,255,0.25); padding: 0.55rem 1.25rem; border-radius: 8px;
        display: inline-flex; align-items: center; gap: 6px;
        transition: all 0.2s; text-decoration: none;
    }
    .btn-hero-ghost:hover { background: rgba(255,255,255,0.2); color: #fff; text-decoration: none; transform: translateY(-1px); }

    /* ── Stat cards ────────────────────────────────── */
    .stats-row { margin-top: -2.5rem; padding: 0 1.5rem; position: relative; z-index: 10; }
    .stat-card {
        background: #fff; border-radius: 16px;
        padding: 1.25rem 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        display: flex; align-items: center; gap: 1rem;
        border: 1px solid rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,0,0,0.12); }
    .stat-icon {
        width: 52px; height: 52px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem; flex-shrink: 0;
    }
    .stat-icon.blue   { background: #eff6ff; color: #2563eb; }
    .stat-icon.green  { background: #f0fdf4; color: #16a34a; }
    .stat-icon.orange { background: #fff7ed; color: #ea580c; }
    .stat-icon.purple { background: #faf5ff; color: #7c3aed; }
    .stat-label { font-size: 0.72rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.07em; font-weight: 600; margin-bottom: 2px; }
    .stat-value { font-size: 1.25rem; font-weight: 800; color: #111827; line-height: 1; }

    /* ── Section cards ─────────────────────────────── */
    .section-card {
        background: #fff; border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        border: 1px solid rgba(0,0,0,0.05);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    .section-card-header {
        padding: 1rem 1.5rem;
        display: flex; align-items: center; justify-content: space-between;
        border-bottom: 1px solid #f1f5f9;
    }
    .section-card-title {
        font-size: 0.92rem; font-weight: 700; color: #1e293b;
        display: flex; align-items: center; gap: 0.6rem;
    }
    .section-card-title .title-icon {
        width: 32px; height: 32px; border-radius: 8px;
        display: flex; align-items: center; justify-content: center; font-size: 0.9rem;
    }
    .section-card-body { padding: 1.25rem 1.5rem; }

    /* ── Info rows ─────────────────────────────────── */
    .info-row {
        display: flex; padding: 0.6rem 0;
        border-bottom: 1px solid #f8fafc;
        font-size: 0.875rem;
        align-items: flex-start;
        gap: 0.5rem;
    }
    .info-row:last-child { border-bottom: none; padding-bottom: 0; }
    .info-label { color: #64748b; font-weight: 600; min-width: 140px; flex-shrink: 0; }
    .info-value { color: #1e293b; font-weight: 500; word-break: break-word; }

    /* ── Shipping route strip ──────────────────────── */
    .route-strip {
        background: linear-gradient(135deg, #f8faff 0%, #eef2ff 100%);
        border: 1px solid #e0e7ff;
        border-radius: 14px;
        padding: 1.25rem 1.5rem;
        display: flex; align-items: center; justify-content: space-between;
        gap: 1rem; margin-bottom: 1.5rem;
    }
    .route-point { text-align: center; flex: 1; }
    .route-label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.08em; color: #6b7280; font-weight: 600; margin-bottom: 4px; }
    .route-city { font-size: 1rem; font-weight: 800; color: #1e3a5f; }
    .route-arrow {
        flex: 0 0 auto; text-align: center;
        color: #2563eb; font-size: 1.4rem; position: relative;
        display: flex; flex-direction: column; align-items: center; gap: 4px;
    }
    .route-arrow::before {
        content: ''; display: block; width: 60px; height: 2px;
        background: linear-gradient(to right, #2563eb, #7c3aed);
        border-radius: 2px;
    }
    .route-dots {
        display: flex; gap: 4px; align-items: center; justify-content: center;
    }
    .route-dots span {
        width: 6px; height: 6px; border-radius: 50%; background: #2563eb;
        animation: dotPulse 1.5s ease-in-out infinite;
    }
    .route-dots span:nth-child(2) { animation-delay: 0.3s; }
    .route-dots span:nth-child(3) { animation-delay: 0.6s; }
    @keyframes dotPulse {
        0%, 100% { opacity: 0.3; transform: scale(0.8); }
        50% { opacity: 1; transform: scale(1); }
    }

    /* ── Progress bar ──────────────────────────────── */
    .pkg-progress-wrap { margin-top: 0.4rem; }
    .pkg-progress-bar-bg {
        background: #e2e8f0; border-radius: 999px;
        height: 10px; overflow: hidden;
    }
    .pkg-progress-bar-fill {
        height: 100%; border-radius: 999px;
        background: linear-gradient(to right, #2563eb, #7c3aed);
        transition: width 1s ease;
        position: relative;
    }
    .pkg-progress-bar-fill::after {
        content: ''; position: absolute; top: 0; right: 0;
        width: 16px; height: 100%;
        background: rgba(255,255,255,0.3);
        border-radius: 0 999px 999px 0;
    }
    .pkg-progress-label { font-size: 0.75rem; color: #64748b; margin-top: 4px; display: flex; justify-content: space-between; }

    /* ── Timeline ──────────────────────────────────── */
    .pkg-timeline { position: relative; }
    .pkg-timeline-item {
        display: flex; gap: 1rem; padding-bottom: 1.75rem; position: relative;
    }
    .pkg-timeline-item:last-child { padding-bottom: 0; }
    .pkg-timeline-left {
        display: flex; flex-direction: column; align-items: center; flex-shrink: 0; width: 36px;
    }
    .pkg-timeline-dot {
        width: 36px; height: 36px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.85rem; font-weight: 700; flex-shrink: 0;
        position: relative; z-index: 1;
    }
    .pkg-timeline-dot.delivered { background: #dcfce7; color: #16a34a; border: 2.5px solid #16a34a; }
    .pkg-timeline-dot.transit   { background: #dbeafe; color: #2563eb; border: 2.5px solid #2563eb; }
    .pkg-timeline-dot.pending   { background: #fef9c3; color: #ca8a04; border: 2.5px solid #ca8a04; }
    .pkg-timeline-dot.default   { background: #f1f5f9; color: #64748b; border: 2.5px solid #94a3b8; }
    .pkg-timeline-dot.current   { box-shadow: 0 0 0 5px rgba(37,99,235,0.15); }
    .pkg-timeline-line {
        flex: 1; width: 2px; background: #e2e8f0; margin: 4px 0;
        min-height: 20px;
    }
    .pkg-timeline-item:last-child .pkg-timeline-line { display: none; }
    .pkg-timeline-content {
        flex: 1; background: #f8fafc; border: 1px solid #e2e8f0;
        border-radius: 12px; padding: 0.875rem 1rem;
        transition: box-shadow 0.2s;
    }
    .pkg-timeline-content:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
    .pkg-timeline-content.current-loc {
        background: #eff6ff; border-color: #bfdbfe;
    }
    .tl-top { display: flex; justify-content: space-between; align-items: flex-start; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 4px; }
    .tl-status { font-weight: 700; color: #1e293b; font-size: 0.9rem; }
    .tl-time { font-size: 0.75rem; color: #64748b; white-space: nowrap; }
    .tl-location { font-size: 0.82rem; color: #475569; display: flex; align-items: center; gap: 4px; }
    .tl-current-badge {
        display: inline-flex; align-items: center; gap: 4px;
        background: #2563eb; color: #fff; font-size: 0.68rem; font-weight: 700;
        padding: 2px 8px; border-radius: 50px; text-transform: uppercase; letter-spacing: 0.05em;
        margin-top: 6px;
    }
    .tl-current-badge::before {
        content: ''; width: 6px; height: 6px; background: #fff; border-radius: 50%;
        animation: currentPulse 1.5s ease-in-out infinite;
    }
    @keyframes currentPulse { 0%, 100% { opacity: 0.4; } 50% { opacity: 1; } }
    .tl-actions { display: flex; gap: 6px; margin-top: 0.6rem; flex-wrap: wrap; }
    .btn-tl-edit {
        display: inline-flex; align-items: center; gap: 4px; font-size: 0.75rem;
        padding: 4px 10px; border-radius: 6px; font-weight: 600;
        background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe;
        cursor: pointer; transition: all 0.15s;
    }
    .btn-tl-edit:hover { background: #dbeafe; }
    .btn-tl-delete {
        display: inline-flex; align-items: center; gap: 4px; font-size: 0.75rem;
        padding: 4px 10px; border-radius: 6px; font-weight: 600;
        background: #fef2f2; color: #dc2626; border: 1px solid #fecaca;
        cursor: pointer; transition: all 0.15s; border: none;
    }
    .btn-tl-delete:hover { background: #fee2e2; }

    /* ── Media gallery ─────────────────────────────── */
    .media-grid { display: flex; flex-wrap: wrap; gap: 10px; }
    .media-thumb {
        width: 110px; height: 90px; border-radius: 10px; overflow: hidden;
        border: 2px solid #e2e8f0; transition: all 0.2s; position: relative;
    }
    .media-thumb:hover { border-color: #2563eb; transform: scale(1.03); }
    .media-thumb img, .media-thumb video { width: 100%; height: 100%; object-fit: cover; }
    .media-hint { font-size: 0.72rem; color: #6b7280; margin-top: 8px; }

    /* ── Modals ─────────────────────────────────────── */
    .pkg-modal .modal-content { border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 25px 60px rgba(0,0,0,0.2); }
    .pkg-modal .modal-header { background: linear-gradient(135deg, #1e3a5f, #2563eb); color: #fff; border: none; padding: 1.25rem 1.5rem; }
    .pkg-modal .modal-title { font-weight: 700; font-size: 1rem; }
    .pkg-modal .close { color: #fff; opacity: 0.8; font-size: 1.4rem; text-shadow: none; }
    .pkg-modal .close:hover { opacity: 1; }
    .pkg-modal .modal-body { padding: 1.5rem; }
    .pkg-modal .modal-footer { border-top: 1px solid #f1f5f9; padding: 1rem 1.5rem; }
    .pkg-modal .form-label { font-weight: 600; font-size: 0.82rem; color: #374151; margin-bottom: 5px; }
    .pkg-modal .form-control {
        border: 1.5px solid #e2e8f0; border-radius: 10px;
        padding: 0.6rem 0.9rem; font-size: 0.88rem; color: #1e293b;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .pkg-modal .form-control:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.12); }
    .btn-modal-primary {
        background: linear-gradient(135deg, #2563eb, #7c3aed); color: #fff;
        border: none; padding: 0.6rem 1.5rem; border-radius: 10px;
        font-weight: 700; font-size: 0.88rem; display: inline-flex; align-items: center; gap: 6px;
        transition: all 0.2s;
    }
    .btn-modal-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(37,99,235,0.35); color: #fff; }
    .btn-modal-cancel {
        background: #f1f5f9; color: #475569; border: none;
        padding: 0.6rem 1.25rem; border-radius: 10px;
        font-weight: 600; font-size: 0.88rem;
    }
    .btn-modal-cancel:hover { background: #e2e8f0; color: #1e293b; }
</style>

<div class="main-panel pkg-page">
    <div class="content" style="padding: 0;">

        @php
            $latestStatus = $package->trackingLocations->sortByDesc('arrival_time')->first()->status ?? 'Unknown';
            $statusClass = 'status-default';
            $statusIcon  = 'fa-circle';
            if (str_contains($latestStatus, 'Delivered')) { $statusClass = 'status-delivered'; $statusIcon = 'fa-check-circle'; }
            elseif (str_contains($latestStatus, 'Shipped') || str_contains($latestStatus, 'Transit') || str_contains($latestStatus, 'Delivery')) { $statusClass = 'status-transit'; $statusIcon = 'fa-shipping-fast'; }
            elseif (str_contains($latestStatus, 'Pending') || str_contains($latestStatus, 'Processing') || str_contains($latestStatus, 'Created')) { $statusClass = 'status-pending'; $statusIcon = 'fa-clock'; }
        @endphp

        <!-- Hero -->
        <div class="pkg-hero">
            <div class="d-flex justify-content-between align-items-start flex-wrap" style="gap:1rem; position:relative; z-index:2;">
                <div>
                    <p class="pkg-hero-title"><i class="fas fa-box mr-1"></i> Package Details</p>
                    <div class="pkg-hero-tracking mb-2">{{ $package->tracking_number }}</div>
                    <span class="pkg-hero-status {{ $statusClass }}">
                        <i class="fas {{ $statusIcon }}" style="font-size:0.7rem;"></i>
                        {{ $latestStatus }}
                    </span>
                </div>
                <div class="pkg-hero-actions">
                    <button class="btn-hero-primary" id="sendEmailBtn" onclick="sendPackageEmail()">
                        <i class="fas fa-paper-plane"></i> Send Email
                    </button>
                    <a href="{{ route('admin.packages.index') }}" class="btn-hero-ghost">
                        <i class="fas fa-arrow-left"></i> All Packages
                    </a>
                </div>
            </div>
        </div>

        <!-- Stat Cards -->
        <div class="stats-row">
            <div class="row" style="margin:0 -0.5rem;">
                <div class="col-6 col-lg-3" style="padding:0 0.5rem; margin-bottom:1rem;">
                    <div class="stat-card">
                        <div class="stat-icon blue"><i class="fas fa-weight-hanging"></i></div>
                        <div>
                            <div class="stat-label">Total Weight</div>
                            <div class="stat-value">{{ $package->total_weight }}<span style="font-size:0.8rem;font-weight:500;color:#6b7280;"> kg</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3" style="padding:0 0.5rem; margin-bottom:1rem;">
                    <div class="stat-card">
                        <div class="stat-icon green"><i class="fas fa-cubes"></i></div>
                        <div>
                            <div class="stat-label">Quantity</div>
                            <div class="stat-value">{{ $package->item_quantity }}<span style="font-size:0.8rem;font-weight:500;color:#6b7280;"> pcs</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3" style="padding:0 0.5rem; margin-bottom:1rem;">
                    <div class="stat-card">
                        <div class="stat-icon orange"><i class="fas fa-dollar-sign"></i></div>
                        <div>
                            <div class="stat-label">Declared Value</div>
                            <div class="stat-value">${{ number_format($package->declared_value, 0) }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3" style="padding:0 0.5rem; margin-bottom:1rem;">
                    <div class="stat-card">
                        <div class="stat-icon purple"><i class="fas fa-boxes"></i></div>
                        <div>
                            <div class="stat-label">Boxes</div>
                            <div class="stat-value">{{ $package->number_of_boxes }}<span style="font-size:0.8rem;font-weight:500;color:#6b7280;"> box</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div style="padding: 1rem 1.5rem 2rem;">

            <!-- Shipping Route Strip -->
            <div class="route-strip">
                <div class="route-point">
                    <div class="route-label"><i class="fas fa-map-marker-alt mr-1"></i>Origin</div>
                    <div class="route-city">{{ $package->shipping_from }}</div>
                    <div style="font-size:0.75rem;color:#64748b;margin-top:2px;">{{ $package->shipping_date->format('M d, Y') }}</div>
                </div>
                <div class="route-arrow">
                    <div class="route-dots"><span></span><span></span><span></span></div>
                    <i class="fas fa-plane" style="font-size:1.3rem;color:#2563eb;transform:rotate(90deg);margin:2px 0;"></i>
                    <div class="route-dots"><span></span><span></span><span></span></div>
                </div>
                <div class="route-point">
                    <div class="route-label"><i class="fas fa-flag-checkered mr-1"></i>Destination</div>
                    <div class="route-city">{{ $package->shipping_to }}</div>
                    <div style="font-size:0.75rem;color:#64748b;margin-top:2px;">Est. {{ $package->estimated_delivery_date->format('M d, Y') }}</div>
                </div>
            </div>

            <div class="row">
                <!-- Left: Package Info + Shipping Info -->
                <div class="col-lg-6">

                    <!-- Package Info -->
                    <div class="section-card">
                        <div class="section-card-header">
                            <div class="section-card-title">
                                <div class="title-icon" style="background:#eff6ff;color:#2563eb;"><i class="fas fa-box-open"></i></div>
                                Package Information
                            </div>
                        </div>
                        <div class="section-card-body">
                            <div class="info-row">
                                <span class="info-label">Description</span>
                                <span class="info-value">{{ $package->item_description }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Box Weight</span>
                                <span class="info-value">{{ $package->box_weight }} kg</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Notes</span>
                                <span class="info-value" style="color:{{ $package->notes ? '#1e293b' : '#9ca3af' }}">{{ $package->notes ?? 'None' }}</span>
                            </div>

                            @if(!empty($package->image_url) && count($package->image_url) > 0)
                            <div class="info-row" style="flex-direction:column;align-items:flex-start;">
                                <span class="info-label" style="margin-bottom:8px;">Package Images</span>
                                <div class="media-grid">
                                    @foreach($package->image_url as $imageUrl)
                                    <a href="{{ $imageUrl }}" target="_blank" class="media-thumb">
                                        <img src="{{ $imageUrl }}" alt="Package">
                                    </a>
                                    @endforeach
                                </div>
                                <p class="media-hint"><i class="fas fa-external-link-alt mr-1"></i>Click image to view full size</p>
                            </div>
                            @endif

                            @if(!empty($package->video_url) && count($package->video_url) > 0)
                            <div class="info-row" style="flex-direction:column;align-items:flex-start;">
                                <span class="info-label" style="margin-bottom:8px;">Package Videos</span>
                                <div class="media-grid">
                                    @foreach($package->video_url as $videoUrl)
                                    <div class="media-thumb">
                                        <video controls><source src="{{ $videoUrl }}" type="video/mp4"></video>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Shipping Info -->
                    <div class="section-card">
                        <div class="section-card-header">
                            <div class="section-card-title">
                                <div class="title-icon" style="background:#ecfdf5;color:#16a34a;"><i class="fas fa-truck"></i></div>
                                Shipping Details
                            </div>
                        </div>
                        <div class="section-card-body">
                            <div class="info-row">
                                <span class="info-label">Shipped On</span>
                                <span class="info-value">{{ $package->shipping_date->format('D, M d, Y') }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Est. Delivery</span>
                                <span class="info-value">{{ $package->estimated_delivery_date->format('D, M d, Y') }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Current Status</span>
                                <span class="info-value">
                                    <span class="pkg-hero-status {{ $statusClass }}" style="font-size:0.72rem;padding:3px 10px;">
                                        {{ $latestStatus }}
                                    </span>
                                </span>
                            </div>
                            <div class="info-row" style="flex-direction:column;align-items:flex-start;">
                                <span class="info-label" style="margin-bottom:6px;">Delivery Progress</span>
                                <div class="pkg-progress-wrap" style="width:100%;">
                                    <div class="pkg-progress-bar-bg">
                                        <div class="pkg-progress-bar-fill" style="width:{{ $package->progress_percentage }}%;"></div>
                                    </div>
                                    <div class="pkg-progress-label">
                                        <span>0%</span>
                                        <span style="font-weight:700;color:#2563eb;">{{ $package->progress_percentage }}%</span>
                                        <span>100%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right: Sender + Receiver -->
                <div class="col-lg-6">

                    <!-- Sender -->
                    <div class="section-card">
                        <div class="section-card-header">
                            <div class="section-card-title">
                                <div class="title-icon" style="background:#fff7ed;color:#ea580c;"><i class="fas fa-user-tie"></i></div>
                                Sender
                            </div>
                        </div>
                        <div class="section-card-body">
                            <div class="d-flex align-items-center mb-3" style="gap:0.75rem;">
                                <div style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,#ea580c,#f97316);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:1.1rem;flex-shrink:0;">
                                    {{ strtoupper(substr($package->sender_name, 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight:700;color:#1e293b;">{{ $package->sender_name }}</div>
                                    <div style="font-size:0.8rem;color:#64748b;">{{ $package->sender_email }}</div>
                                </div>
                            </div>
                            <div class="info-row">
                                <span class="info-label"><i class="fas fa-phone mr-1" style="color:#ea580c;"></i>Phone</span>
                                <span class="info-value">{{ $package->sender_phone }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label"><i class="fas fa-map-marker-alt mr-1" style="color:#ea580c;"></i>Address</span>
                                <span class="info-value">{{ $package->sender_address }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label"><i class="fas fa-city mr-1" style="color:#ea580c;"></i>City / State</span>
                                <span class="info-value">{{ $package->sender_city }}, {{ $package->sender_state }} {{ $package->sender_zip }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label"><i class="fas fa-globe mr-1" style="color:#ea580c;"></i>Country</span>
                                <span class="info-value">{{ $package->sender_country }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Receiver -->
                    <div class="section-card">
                        <div class="section-card-header">
                            <div class="section-card-title">
                                <div class="title-icon" style="background:#faf5ff;color:#7c3aed;"><i class="fas fa-user"></i></div>
                                Receiver
                            </div>
                        </div>
                        <div class="section-card-body">
                            <div class="d-flex align-items-center mb-3" style="gap:0.75rem;">
                                <div style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,#7c3aed,#a855f7);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:1.1rem;flex-shrink:0;">
                                    {{ strtoupper(substr($package->receiver_name, 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight:700;color:#1e293b;">{{ $package->receiver_name }}</div>
                                    <div style="font-size:0.8rem;color:#64748b;">{{ $package->receiver_email }}</div>
                                </div>
                            </div>
                            <div class="info-row">
                                <span class="info-label"><i class="fas fa-phone mr-1" style="color:#7c3aed;"></i>Phone</span>
                                <span class="info-value">{{ $package->receiver_phone }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label"><i class="fas fa-map-marker-alt mr-1" style="color:#7c3aed;"></i>Address</span>
                                <span class="info-value">{{ $package->receiver_address }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label"><i class="fas fa-city mr-1" style="color:#7c3aed;"></i>City / State</span>
                                <span class="info-value">{{ $package->receiver_city }}, {{ $package->receiver_state }} {{ $package->receiver_zip }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label"><i class="fas fa-globe mr-1" style="color:#7c3aed;"></i>Country</span>
                                <span class="info-value">{{ $package->receiver_country }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Tracking History -->
            <div class="section-card">
                <div class="section-card-header">
                    <div class="section-card-title">
                        <div class="title-icon" style="background:#f0fdf4;color:#16a34a;"><i class="fas fa-route"></i></div>
                        Tracking History
                    </div>
                    <button class="btn-hero-primary" style="font-size:0.8rem;padding:0.45rem 1rem;" data-toggle="modal" data-target="#addTrackingModal">
                        <i class="fas fa-plus"></i> Add Update
                    </button>
                </div>
                <div class="section-card-body">
                    @if($trackingLocations->isEmpty())
                        <div style="text-align:center;padding:2rem;color:#9ca3af;">
                            <i class="fas fa-map-marked-alt" style="font-size:2rem;margin-bottom:0.75rem;display:block;"></i>
                            No tracking updates yet
                        </div>
                    @else
                    <div class="pkg-timeline">
                        @foreach($trackingLocations->sortByDesc('arrival_time') as $location)
                        @php
                            $tlClass = 'default';
                            $tlIcon = 'fa-circle';
                            if (str_contains($location->status, 'Delivered')) { $tlClass = 'delivered'; $tlIcon = 'fa-check'; }
                            elseif (str_contains($location->status, 'Shipped') || str_contains($location->status, 'Transit') || str_contains($location->status, 'Delivery')) { $tlClass = 'transit'; $tlIcon = 'fa-shipping-fast'; }
                            elseif (str_contains($location->status, 'Pending') || str_contains($location->status, 'Processing') || str_contains($location->status, 'Created')) { $tlClass = 'pending'; $tlIcon = 'fa-clock'; }
                        @endphp
                        <div class="pkg-timeline-item">
                            <div class="pkg-timeline-left">
                                <div class="pkg-timeline-dot {{ $tlClass }} {{ $location->is_current ? 'current' : '' }}">
                                    <i class="fas {{ $tlIcon }}" style="font-size:0.7rem;"></i>
                                </div>
                                <div class="pkg-timeline-line"></div>
                            </div>
                            <div class="pkg-timeline-content {{ $location->is_current ? 'current-loc' : '' }}">
                                <div class="tl-top">
                                    <span class="tl-status">{{ $location->status }}</span>
                                    <span class="tl-time"><i class="fas fa-clock mr-1"></i>{{ $location->arrival_time->format('M d, Y · h:i A') }}</span>
                                </div>
                                <div class="tl-location">
                                    <i class="fas fa-map-pin" style="color:#94a3b8;font-size:0.7rem;"></i>
                                    {{ $location->location_name }}
                                </div>
                                @if($location->is_current)
                                    <div class="tl-current-badge">Current Location</div>
                                @endif
                                <div class="tl-actions">
                                    <button class="btn-tl-edit edit-tracking"
                                        data-id="{{ $location->id }}"
                                        data-status="{{ $location->status }}"
                                        data-location="{{ $location->location_name }}"
                                        data-arrival="{{ $location->arrival_time->format('Y-m-d\TH:i') }}">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.tracking.destroy', $location->id) }}" method="POST" class="d-inline delete-tracking-form" style="margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-tl-delete">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

        </div><!-- /main content -->
    </div>
</div>

<!-- Add Tracking Modal -->
<div class="modal fade pkg-modal" id="addTrackingModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>Add Tracking Update</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="addTrackingForm" action="{{ route('admin.packages.tracking.store', $package->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Location Name</label>
                        <input type="text" class="form-control" name="location_name" placeholder="e.g. Miami International Airport" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="Package Created">Package Created</option>
                            <option value="Processing">Processing</option>
                            <option value="Shipped">Shipped</option>
                            <option value="In Transit">In Transit</option>
                            <option value="Out for Delivery">Out for Delivery</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Returned">Returned</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Arrival Time</label>
                        <input type="datetime-local" class="form-control" name="arrival_time" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-modal-primary"><i class="fas fa-save"></i> Save Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Tracking Modal -->
<div class="modal fade pkg-modal" id="editTrackingModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-pencil-alt mr-2"></i>Edit Tracking Update</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="editTrackingForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Location Name</label>
                        <input type="text" class="form-control" name="location_name" id="editLocationName" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="status" id="editStatus" required>
                            <option value="Package Created">Package Created</option>
                            <option value="Processing">Processing</option>
                            <option value="Shipped">Shipped</option>
                            <option value="In Transit">In Transit</option>
                            <option value="Out for Delivery">Out for Delivery</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Returned">Returned</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Arrival Time</label>
                        <input type="datetime-local" class="form-control" name="arrival_time" id="editArrivalTime" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-modal-primary"><i class="fas fa-save"></i> Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function sendPackageEmail() {
        const btn = $('#sendEmailBtn');
        const originalHtml = btn.html();
        Swal.fire({
            title: 'Send Email Notification?',
            html: 'This will send a notification to:<br><strong>{{ $package->receiver_email ?? $package->sender_email ?? "No email available" }}</strong>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-paper-plane"></i> Send',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Sending...');
                $.ajax({
                    url: '{{ route("admin.packages.send-email", $package->id) }}',
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        response.status === 'success' ? toastr.success(response.message) : toastr.error(response.message || 'Failed to send email');
                    },
                    error: function(xhr) { toastr.error(xhr.responseJSON?.message || 'Failed to send email'); },
                    complete: function() { btn.prop('disabled', false).html(originalHtml); }
                });
            }
        });
    }

    $(document).ready(function () {
        $('#addTrackingForm').on('submit', function (e) {
            e.preventDefault();
            const form = this;
            const btn = $(form).find('button[type="submit"]');
            btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm mr-1"></span> Saving...');
            $.ajax({
                url: $(form).attr('action'), type: 'POST', data: $(form).serialize(),
                success: function (r) {
                    if (r.status === 'success') { toastr.success(r.message); $('#addTrackingModal').modal('hide'); setTimeout(() => location.reload(), 1500); }
                },
                error: function (r) { toastr.error(r.responseJSON?.message || 'Failed to add update'); btn.prop('disabled', false).html('<i class="fas fa-save"></i> Save Update'); }
            });
        });

        $('.edit-tracking').on('click', function () {
            $('#editTrackingForm').attr('action', '/admin/tracking/' + $(this).data('id'));
            $('#editLocationName').val($(this).data('location'));
            $('#editStatus').val($(this).data('status'));
            $('#editArrivalTime').val($(this).data('arrival'));
            $('#editTrackingModal').modal('show');
        });

        $('#editTrackingForm').on('submit', function (e) {
            e.preventDefault();
            const form = this;
            const btn = $(form).find('button[type="submit"]');
            btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm mr-1"></span> Saving...');
            $.ajax({
                url: $(form).attr('action'), type: 'POST', data: $(form).serialize(),
                success: function (r) {
                    if (r.status === 'success') { toastr.success(r.message); $('#editTrackingModal').modal('hide'); setTimeout(() => location.reload(), 1500); }
                },
                error: function (r) { toastr.error(r.responseJSON?.message || 'Failed to update'); btn.prop('disabled', false).html('<i class="fas fa-save"></i> Save Changes'); }
            });
        });

        $('.delete-tracking-form').on('submit', function (e) {
            e.preventDefault();
            const form = this;
            Swal.fire({
                title: 'Delete this update?', text: "This action cannot be undone.", icon: 'warning',
                showCancelButton: true, confirmButtonColor: '#dc2626', cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: $(form).attr('action'), type: 'POST', data: $(form).serialize(),
                        success: function (r) {
                            if (r.status === 'success') { toastr.success(r.message); setTimeout(() => location.reload(), 1500); }
                        },
                        error: function (r) { toastr.error(r.responseJSON?.message || 'Failed to delete'); }
                    });
                }
            });
        });
    });
</script>

@include('admin.footer')
