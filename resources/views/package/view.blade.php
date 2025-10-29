<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Package Tracking | FedEx</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

    <style>
        :root {
            --primary: #2c3e50;
            --primary-light: #3d566e;
            --secondary: #3498db;
            --secondary-light: #5dade2;
            --accent: #e74c3c;
            --light: #f8f9fa;
            --lighter: #ffffff;
            --dark: #2c3e50;
            --text: #34495e;
            --text-light: #7f8c8d;
            --border: #e0e0e0;
            --success: #2ecc71;
            --warning: #f39c12;
            --error: #e74c3c;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.12);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #dfe6f0 100%);
            min-height: 100vh;
            color: var(--text);
            font-family: 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .tracking-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .tracking-card {
            border-radius: 15px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            background: white;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .tracking-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .header-gradient {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            padding: 20px 0;
        }

        .tracking-hero {
            background: url('https://images.unsplash.com/photo-1519003303723-6f91b0f2749f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80') no-repeat center center;
            background-size: cover;
            height: 200px;
            position: relative;
            border-radius: 15px 15px 0 0;
            overflow: hidden;
        }

        .tracking-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to right, rgba(44, 62, 80, 0.8), rgba(52, 152, 219, 0.8));
        }

        .hero-content {
            position: relative;
            z-index: 1;
            color: white;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-processing {
            background-color: #cce5ff;
            color: #004085;
        }

        .status-shipped {
            background-color: #d4edda;
            color: #155724;
        }

        .status-in-transit {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .status-out-for-delivery {
            background-color: #d4edda;
            color: #155724;
        }

        .status-delivered {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .live-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            background-color: var(--success);
            border-radius: 50%;
            margin-right: 5px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(46, 204, 113, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(46, 204, 113, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(46, 204, 113, 0);
            }
        }

        .tracking-progress-bar {
            height: 8px;
            border-radius: 4px;
            background-color: #e9ecef;
            overflow: hidden;
        }

        .tracking-progress-fill {
            height: 100%;
            border-radius: 4px;
            background: linear-gradient(90deg, var(--secondary-light), var(--secondary));
            transition: width 1.5s ease-in-out;
        }

        .map-container {
            height: 300px;
            border-radius: 10px;
            overflow: hidden;
            background-color: #eaeaea;
            position: relative;
        }

        #map {
            height: 100%;
            width: 100%;
            border-radius: 10px;
            z-index: 1;
        }

        .map-overlay {
            position: absolute;
            top: 10px;
            right: 10px;
            background: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
            z-index: 2;
        }

        .info-card {
            border-radius: 10px;
            border: 1px solid var(--border);
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
        }

        .info-card:hover {
            box-shadow: var(--shadow-md);
        }

        .info-card-header {
            background-color: var(--light);
            padding: 12px 15px;
            border-bottom: 1px solid var(--border);
            font-weight: 600;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-card-body {
            padding: 15px;
        }

        .detail-item {
            padding: 10px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 500;
            color: var(--primary);
            margin-bottom: 5px;
            font-size: 14px;
        }

        .animated-progress {
            position: relative;
            overflow: hidden;
        }

        .animated-progress .progress-bar {
            position: relative;
            overflow: hidden;
        }

        .animated-progress .progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background-image: linear-gradient(-45deg,
                    rgba(255, 255, 255, 0.2) 25%,
                    transparent 25%,
                    transparent 50%,
                    rgba(255, 255, 255, 0.2) 50%,
                    rgba(255, 255, 255, 0.2) 75%,
                    transparent 75%,
                    transparent);
            background-size: 50px 50px;
            animation: move 2s linear infinite;
            overflow: hidden;
        }

        @keyframes move {
            0% {
                background-position: 0 0;
            }

            100% {
                background-position: 50px 50px;
            }
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-light) 100%);
            border: none;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }

        .btn-outline {
            border: 2px solid var(--primary);
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            color: var(--primary);
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .step-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 20px;
            background-color: var(--light);
            color: var(--text-light);
            transition: all 0.3s ease;
        }

        .step-active .step-icon {
            background-color: var(--secondary);
            color: white;
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
            animation: pulse-icon 2s infinite;
        }

        .step-completed .step-icon {
            background-color: var(--success);
            color: white;
        }

        @keyframes pulse-icon {
            0% {
                box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
            }

            50% {
                box-shadow: 0 5px 20px rgba(52, 152, 219, 0.6);
            }

            100% {
                box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
            }
        }

        .notification-toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1050;
            animation: slideInRight 0.5s forwards;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        footer {
            background-color: var(--primary);
            color: white;
            padding: 30px 0;
            margin-top: 40px;
        }

        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            height: 100%;
            width: 2px;
            background-color: var(--secondary);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-marker {
            position: absolute;
            left: -30px;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: var(--secondary);
            border: 3px solid white;
            box-shadow: 0 0 0 3px var(--secondary-light);
        }

        .timeline-content {
            background: var(--light);
            padding: 15px;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
        }

        .timeline-date {
            font-size: 12px;
            color: var(--text-light);
            margin-bottom: 5px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .tracking-hero {
                height: 150px;
            }

            .map-container {
                height: 200px;
            }

            .step-icon {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
        }

        /* Leaflet map adjustments */
        .leaflet-popup-content {
            margin: 12px 15px;
        }

        .leaflet-popup-content-wrapper {
            border-radius: 8px;
        }
    </style>

    <!-- Smartsupp Live Chat script -->
    <script type="text/javascript">
        var _smartsupp = _smartsupp || {};
_smartsupp.key = '88eaf4d3011f53e9304c5ce938ed729f1cbf3519';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
    </script>
    <noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript>

</head>

<body>
    <div class="container tracking-container">
        <div class="gtranslate_wrapper"></div>
        <script>
            window.gtranslateSettings = {"default_language":"en","detect_browser_language":true,"wrapper_selector":".gtranslate_wrapper","switcher_horizontal_position":"right","switcher_vertical_position":"top","alt_flags":{"en":"usa","pt":"brazil","es":"colombia","fr":"quebec"}}
        </script>
        <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

        <!-- Header Section -->
        <header class="header-gradient rounded-top">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-shipping-fast fa-2x text-white me-2"></i>
                        <a href="{{route('homepage')}}" class="logo"> <img src="./assets/images/logo.png" width="80"
                                height="50"></a>
                    </div>
                    <div>
                        <span class="text-white-50">{{ date('l, F j, Y') }}</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <div class="tracking-hero d-flex align-items-center">
            <div class="container hero-content">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-1 animate__animated animate__fadeInLeft">Shipment Tracking Details</h2>
                        <p class="mb-0 animate__animated animate__fadeInLeft animate__delay-1s">
                            Real-time updates for your package #{{ $package->tracking_number }}
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end animate__animated animate__fadeInRight">
                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $package->status)) }}">
                            <i class="fas fa-circle-notch fa-spin" style="font-size: 10px;"></i>
                            {{ $package->status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="tracking-card">
            <div class="container py-4">
                <!-- Status Alert -->
                <div class="alert alert-primary d-flex align-items-center animate__animated animate__fadeIn"
                    role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <div>
                        <strong>Current Status:</strong>
                        @if($currentLocation = $package->trackingLocations->where('is_current', true)->first())
                        Your package is currently in {{ $currentLocation->location_name }}.
                        @else
                        Your package is in transit.
                        @endif
                        Last updated: <span id="lastUpdated">{{ $package->updated_at->format('M d, Y H:i') }}</span>
                    </div>
                </div>

                <!-- Map Visualization -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="map-container mb-3">
                            <div id="map"></div>
                            <div class="map-overlay">
                                <span class="live-indicator"></span>
                                <span class="small">Live Tracking</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tracking Progress -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between mb-2">
                            <small>{{ $package->shipping_from }}</small>
                            <small>{{ $package->shipping_to }}</small>
                        </div>
                        <div class="tracking-progress-bar">
                            <div class="tracking-progress-fill animated-progress"
                                style="width: {{ $package->progress_percentage }}%"></div>
                        </div>
                    </div>
                </div>

                <!-- Progress Steps -->
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="d-flex justify-content-between position-relative">
                            <!-- Connection line -->
                            <div class="position-absolute"
                                style="top: 25px; left: 0; right: 0; height: 3px; background-color: #e9ecef; z-index: 1;">
                            </div>

                            <!-- Step 1 -->
                            <div
                                class="text-center position-relative z-2 {{ $package->current_step >= 1 ? 'step-completed' : ($package->current_step == 1 ? 'step-active' : '') }}">
                                <div class="step-icon mx-auto">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <h6 class="mb-1">{{ $package->step1_name ?? 'Order Received' }}</h6>
                                <small class="text-muted">
                                    @if($package->step1_date)
                                    {{ $package->step1_date->format('M d, Y') }}
                                    @endif
                                </small>
                            </div>

                            <!-- Step 2 -->
                            <div
                                class="text-center position-relative z-2 {{ $package->current_step >= 2 ? 'step-completed' : ($package->current_step == 2 ? 'step-active' : '') }}">
                                <div class="step-icon mx-auto">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <h6 class="mb-1">{{ $package->step2_name ?? 'Processing' }}</h6>
                                <small class="text-muted">
                                    @if($package->step2_date)
                                    {{ $package->step2_date->format('M d, Y') }}
                                    @endif
                                </small>
                            </div>

                            <!-- Step 3 -->
                            <div
                                class="text-center position-relative z-2 {{ $package->current_step >= 3 ? 'step-completed' : ($package->current_step == 3 ? 'step-active' : '') }}">
                                <div class="step-icon mx-auto">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <h6 class="mb-1">{{ $package->step3_name ?? 'In Transit' }}</h6>
                                <small class="text-muted">
                                    @if($package->step3_date)
                                    {{ $package->step3_date->format('M d, Y') }}
                                    @endif
                                </small>
                            </div>

                            <!-- Step 4 -->
                            <div
                                class="text-center position-relative z-2 {{ $package->current_step >= 4 ? 'step-completed' : ($package->current_step == 4 ? 'step-active' : '') }}">
                                <div class="step-icon mx-auto">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h6 class="mb-1">{{ $package->step4_name ?? 'Delivered' }}</h6>
                                <small class="text-muted">
                                    @if($package->step4_date)
                                    {{ $package->step4_date->format('M d, Y') }}
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tracking Timeline -->
                <div class="row mb-5">
                    <div class="col-12">
                        <h4 class="mb-4">Tracking History</h4>
                        <div class="timeline">
                            @foreach($package->trackingLocations->sortByDesc('arrival_time') as $location)
                            <div class="timeline-item">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <div class="timeline-date">
                                        <i class="far fa-clock me-1"></i>
                                        {{ $location->arrival_time->format('M d, Y H:i') }}
                                        @if($location->is_current)
                                        <span class="badge bg-info ms-2">Current</span>
                                        @endif
                                    </div>
                                    <h6 class="mb-1">{{ $location->location_name }}</h6>
                                    <p class="mb-0 text-muted">{{ $location->status }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Package Details -->
                <div class="row">
                    <!-- Sender Information -->
                    <div class="col-md-6 mb-4">
                        <div class="info-card h-100">
                            <div class="info-card-header">
                                <i class="fas fa-user"></i> Sender Information
                            </div>
                            <div class="info-card-body">
                                <div class="detail-item">
                                    <div class="detail-label">Name</div>
                                    <div>{{ $package->sender_name }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Address</div>
                                    <div>{{ $package->sender_address }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">City/State/Zip</div>
                                    <div>{{ $package->sender_city }}, {{ $package->sender_state }} {{
                                        $package->sender_zip }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Country</div>
                                    <div>{{ $package->sender_country }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Contact</div>
                                    <div>
                                        <div>{{ $package->sender_phone }}</div>
                                        <div>{{ $package->sender_email }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Receiver Information -->
                    <div class="col-md-6 mb-4">
                        <div class="info-card h-100">
                            <div class="info-card-header">
                                <i class="fas fa-user-tag"></i> Receiver Information
                            </div>
                            <div class="info-card-body">
                                <div class="detail-item">
                                    <div class="detail-label">Name</div>
                                    <div>{{ $package->receiver_name }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Address</div>
                                    <div>{{ $package->receiver_address }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">City/State/Zip</div>
                                    <div>{{ $package->receiver_city }}, {{ $package->receiver_state }} {{
                                        $package->receiver_zip }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Country</div>
                                    <div>{{ $package->receiver_country }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Contact</div>
                                    <div>
                                        <div>{{ $package->receiver_phone }}</div>
                                        <div>{{ $package->receiver_email }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="col-md-6 mb-4">
                        <div class="info-card h-100">
                            <div class="info-card-header">
                                <i class="fas fa-truck"></i> Shipping Information
                            </div>
                            <div class="info-card-body">
                                <div class="detail-item">
                                    <div class="detail-label">From</div>
                                    <div>{{ $package->shipping_from }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">To</div>
                                    <div>{{ $package->shipping_to }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Shipped Date</div>
                                    <div>
                                        @if($package->shipping_date)
                                        {{ $package->shipping_date->format('M d, Y') }}
                                        @else
                                        Pending
                                        @endif
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Est. Delivery</div>
                                    <div>
                                        @if($package->estimated_delivery_date)
                                        {{ $package->estimated_delivery_date->format('M d, Y') }}
                                        @else
                                        To be determined
                                        @endif
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Carrier</div>
                                    <div>FedEx Express</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Service</div>
                                    <div>Priority International</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Package Details -->
                    <div class="col-md-6 mb-4">
                        <div class="info-card h-100">
                            <div class="info-card-header">
                                <i class="fas fa-box-open"></i> Package Details
                            </div>
                            <div class="info-card-body">
                                <div class="detail-item">
                                    <div class="detail-label">Description</div>
                                    <div>{{ $package->item_description }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Quantity</div>
                                    <div>{{ $package->item_quantity }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Declared Value</div>
                                    <div>${{ number_format($package->declared_value, 2) }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Total Weight</div>
                                    <div>{{ $package->total_weight }} kg</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Boxes</div>
                                    <div>{{ $package->number_of_boxes }} ({{ $package->box_weight }} kg each)</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Dimensions</div>
                                    <div>30 × 20 × 15 cm (each)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes Section -->
                @if($package->notes)
                <div class="row">
                    <div class="col-12">
                        <div class="info-card">
                            <div class="info-card-header">
                                <i class="fas fa-sticky-note"></i> Additional Notes
                            </div>
                            <div class="info-card-body">
                                <p class="mb-0">{{ $package->notes }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-end gap-2">
                        <button class="btn btn-outline" id="printBtn">
                            <i class="fas fa-print me-2"></i> Print Details
                        </button>
                        <button class="btn btn-primary" id="refreshBtn">
                            <i class="fas fa-sync-alt me-2"></i> Refresh Status
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="rounded-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>FedEx TrackPro</h5>
                        <p>Your trusted partner for fast and reliable shipping solutions worldwide.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p>Need help? Contact our support team 24/7</p>
                        <p><i class="fas fa-phone me-2"></i> +1(318) 491-5463</p>
                        <p><i class="fas fa-envelope me-2"></i> support@expressairdelivery.com</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Initialize world view
    const map = L.map('map').setView([20, 0], 2);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Origin and destination markers
    const originCoords = [37.7749, -122.4194];   // Replace with {{ $package->origin_lat }}, {{ $package->origin_lng }}
    const destCoords   = [40.7128, -74.0060];    // Replace with {{ $package->destination_lat }}, {{ $package->destination_lng }}

    const origin = L.marker(originCoords).addTo(map)
        .bindPopup('Origin: {{ $package->shipping_from }}').openPopup();

    const destination = L.marker(destCoords).addTo(map)
        .bindPopup('Destination: {{ $package->shipping_to }}');

    // Pulsing current location (if available)
    @if($currentLocation = $package->trackingLocations->where('is_current', true)->first())
        const currentCoords = [39.8283, -98.5795]; // Replace with {{ $currentLocation->lat }}, {{ $currentLocation->lng }}

        const pulsingIcon = L.divIcon({
            html: '<div class="pulse-marker"></div>',
            className: '',
            iconSize: [20, 20],
            iconAnchor: [10, 10]
        });

        L.marker(currentCoords, {icon: pulsingIcon})
            .addTo(map)
            .bindPopup('Current Location: {{ $currentLocation->location_name }}')
            .openPopup();
    @endif

    // Truck icon
    const movingIcon = L.divIcon({
        html: '<i class="fas fa-truck fa-2x" style="color: #e74c3c;"></i>',
        className: '',
        iconSize: [30, 30],
        iconAnchor: [15, 15]
    });
    let vehicleMarker = L.marker(originCoords, {icon: movingIcon}).addTo(map);

    // Animated route line
    let routeLine = L.polyline([originCoords], {color: '#3498db', weight: 5}).addTo(map);

    // Smooth animation
    let progress = 0; // 0% → 100%
    function animateTruck() {
        if (progress >= 100) return;

        progress += 0.5; // speed (increase for faster movement)
        const lat = originCoords[0] + (destCoords[0] - originCoords[0]) * (progress / 100);
        const lng = originCoords[1] + (destCoords[1] - originCoords[1]) * (progress / 100);

        vehicleMarker.setLatLng([lat, lng]);

        // Extend route line gradually
        routeLine.addLatLng([lat, lng]);

        requestAnimationFrame(animateTruck);
    }

    animateTruck(); // start animation
});
    </script>

    <style>
        /* Pulsing marker effect */
        .pulse-marker {
            width: 20px;
            height: 20px;
            background: rgba(52, 152, 219, 0.4);
            border-radius: 50%;
            position: relative;
        }

        .pulse-marker::after {
            content: '';
            width: 20px;
            height: 20px;
            position: absolute;
            border-radius: 50%;
            background: rgba(52, 152, 219, 0.7);
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(2);
                opacity: 0;
            }
        }
    </style>


</body>

</html>