@extends('layouts.app')

@section('title', 'Elite Exchange Delivery - Global Logistics & Shipping')

@section('content')
<!-- Hero Section -->
<section class="hero-bg min-h-[70vh] md:min-h-screen flex items-center relative overflow-hidden"
    style="background-image: url('https://images.unsplash.com/photo-1578575437130-527eed3abbec?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');">
    <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 to-gray-900/70 z-1"></div>
    <div class="hero-content container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight mb-4">
                Global Logistics, <span class="text-indigo-400">Simplified.</span>
            </h1>
            <p class="text-lg md:text-xl text-text-primary mb-8">
                Navigating the complexities of global trade with speed, reliability, and unparalleled service. Your
                business, delivered.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('track') }}"
                    class="bg-indigo-600 text-white font-semibold px-8 py-4 rounded-xl hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all duration-300 shadow-lg hover:shadow-indigo-500/50 flex items-center justify-center gap-2">
                    <i data-feather="compass" class="h-5 w-5"></i>
                    <span>Track Your Shipment</span>
                </a>
                <a href="{{ route('contact') }}#quote-form"
                    class="bg-gray-700/50 backdrop-blur-sm border border-gray-600 text-white font-semibold px-8 py-4 rounded-xl hover:bg-gray-700 transition-colors duration-300 flex items-center justify-center gap-2">
                    <i data-feather="file-text" class="h-5 w-5"></i>
                    <span>Request a Quote</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Tracking Widget -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 w-full max-w-md z-10">
        <div class="card rounded-2xl p-6 shadow-2xl mx-4">
            <h3 class="text-xl font-bold text-white mb-4 text-center">Track Your Package</h3>
            <form action="{{ route('package') }}" method="POST" class="flex gap-2 tracking-form">
                @csrf
                <input type="text" name="tracking_number" placeholder="Enter tracking number"
                    class="form-input flex-grow rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-700 border-gray-600 text-white placeholder-gray-400"
                    required>
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-colors duration-300 flex items-center gap-2">
                    <i data-feather="search" class="h-5 w-5"></i>
                    <span class="hidden sm:inline">Track</span>
                </button>
            </form>
            @if(session('error'))
            <div class="mt-3 p-2 bg-red-500/20 border border-red-500 rounded-lg">
                <p class="text-red-400 text-sm flex items-center gap-1">
                    <i data-feather="alert-circle" class="h-4 w-4"></i>
                    {{ session('error') }}
                </p>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="bg-gray-800 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <h3 class="text-3xl md:text-4xl font-bold text-white">1.2M+</h3>
                <p class="text-text-secondary">Parcels Delivered</p>
            </div>
            <div>
                <h3 class="text-3xl md:text-4xl font-bold text-white">150+</h3>
                <p class="text-text-secondary">Countries Reached</p>
            </div>
            <div>
                <h3 class="text-3xl md:text-4xl font-bold text-white">99.7%</h3>
                <p class="text-text-secondary">On-Time Delivery</p>
            </div>
            <div>
                <h3 class="text-3xl md:text-4xl font-bold text-white">25k+</h3>
                <p class="text-text-secondary">Satisfied Clients</p>
            </div>
        </div>
    </div>
</section>

<!-- Cargo Specialization Section -->
<section class="py-16 md:py-24 bg-gray-900">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Specialized Cargo Handling</h2>
            <p class="mt-4 text-text-secondary">Advanced solutions for diverse cargo types with specialized handling
                requirements</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="card rounded-2xl overflow-hidden group">
                <div class="relative overflow-hidden h-48">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                        alt="Temperature Controlled"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute inset-0 bg-blue-600/20 group-hover:bg-transparent transition-colors duration-300">
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2">Temperature Controlled</h3>
                    <p class="text-text-secondary text-sm">Advanced refrigeration for pharmaceuticals, food, and
                        sensitive materials with real-time monitoring.</p>
                    <ul class="mt-3 text-text-secondary text-xs space-y-1">
                        <li class="flex items-center">
                            <i data-feather="check" class="h-3 w-3 mr-2 text-green-400"></i>
                            -20°C to +25°C range
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="h-3 w-3 mr-2 text-green-400"></i>
                            24/7 temperature monitoring
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="h-3 w-3 mr-2 text-green-400"></i>
                            Pharmaceutical compliance
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card rounded-2xl overflow-hidden group">
                <div class="relative overflow-hidden h-48">
                    <img src="images/road.jpg" alt="Heavy Equipment"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute inset-0 bg-orange-600/20 group-hover:bg-transparent transition-colors duration-300">
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2">Heavy Equipment</h3>
                    <p class="text-text-secondary text-sm">Specialized handling for machinery, industrial equipment, and
                        oversized cargo with custom solutions.</p>
                    <ul class="mt-3 text-text-secondary text-xs space-y-1">
                        <li class="flex items-center">
                            <i data-feather="check" class="h-3 w-3 mr-2 text-green-400"></i>
                            Up to 100-ton capacity
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="h-3 w-3 mr-2 text-green-400"></i>
                            Custom rigging solutions
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="h-3 w-3 mr-2 text-green-400"></i>
                            Project cargo specialists
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card rounded-2xl overflow-hidden group">
                <div class="relative overflow-hidden h-48">
                    <img src="images/pic-1.jpg" alt="Hazardous Materials"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute inset-0 bg-red-600/20 group-hover:bg-transparent transition-colors duration-300">
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2">Hazardous Materials</h3>
                    <p class="text-text-secondary text-sm">Certified handling of dangerous goods with full compliance to
                        international safety regulations.</p>
                    <ul class="mt-3 text-text-secondary text-xs space-y-1">
                        <li class="flex items-center">
                            <i data-feather="check" class="h-3 w-3 mr-2 text-green-400"></i>
                            ADR/IATA/IMDG certified
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="h-3 w-3 mr-2 text-green-400"></i>
                            Emergency response planning
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="h-3 w-3 mr-2 text-green-400"></i>
                            Class 1-9 compliance
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card rounded-2xl overflow-hidden group">
                <div class="relative overflow-hidden h-48">
                    <img src="images/pic-2.jpg" alt="High-Value Goods"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute inset-0 bg-purple-600/20 group-hover:bg-transparent transition-colors duration-300">
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2">High-Value Goods</h3>
                    <p class="text-text-secondary text-sm">Secure transport for luxury items, artwork, electronics, and
                        sensitive documents with enhanced security.</p>
                    <ul class="mt-3 text-text-secondary text-xs space-y-1">
                        <li class="flex items-center">
                            <i data-feather="check" class="h-3 w-3 mr-2 text-green-400"></i>
                            GPS tracking & monitoring
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="h-3 w-3 mr-2 text-green-400"></i>
                            Armed escort available
                        </li>
                        <li class="flex items-center">
                            <i data-feather="check" class="h-3 w-3 mr-2 text-green-400"></i>
                            Insurance coverage
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Global Operations Section -->
<section class="py-16 md:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Global Operations Network</h2>
                <p class="text-text-secondary mb-6">
                    With strategically located hubs across 6 continents, we provide seamless end-to-end logistics
                    solutions
                    that connect your business to global markets efficiently and reliably.
                </p>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="bg-indigo-600 rounded-full p-2 mr-4 mt-1">
                            <i data-feather="globe" class="h-5 w-5 text-white"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-white mb-1">Worldwide Coverage</h4>
                            <p class="text-text-secondary text-sm">150+ countries with local expertise and customs
                                clearance support</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-indigo-600 rounded-full p-2 mr-4 mt-1">
                            <i data-feather="clock" class="h-5 w-5 text-white"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-white mb-1">24/7 Operations</h4>
                            <p class="text-text-secondary text-sm">Round-the-clock monitoring and customer support
                                across all time zones</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-indigo-600 rounded-full p-2 mr-4 mt-1">
                            <i data-feather="shield" class="h-5 w-5 text-white"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-white mb-1">Secure Facilities</h4>
                            <p class="text-text-secondary text-sm">ISO-certified warehouses with advanced security
                                systems and climate control</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-4">
                    <div class="card rounded-2xl overflow-hidden">
                        <img src="images/image2.jpg" alt="Air Cargo Hub" class="w-full h-40 object-cover">
                    </div>
                    <div class="card rounded-2xl overflow-hidden">
                        <img src="images/image2.jpeg" alt="Port Operations" class="w-full h-40 object-cover">
                    </div>
                </div>
                <div class="space-y-4 mt-8">
                    <div class="card rounded-2xl overflow-hidden">
                        <img src="images/pic-1.jpg" alt="Warehouse Operations" class="w-full h-40 object-cover">
                    </div>
                    <div class="card rounded-2xl overflow-hidden">
                        <img src="images/pic-2.jpg" alt="Ground Distribution" class="w-full h-40 object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-16 md:py-24 bg-gray-900">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Our Core Services</h2>
            <p class="mt-4 text-text-secondary">We provide a full spectrum of logistics services to ensure your supply
                chain is efficient, robust, and reliable.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="card rounded-2xl overflow-hidden group">
                <div class="relative overflow-hidden">
                    <img src="images/air.jpg" alt="Air Freight"
                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div
                        class="absolute inset-0 bg-indigo-600/20 group-hover:bg-transparent transition-colors duration-300">
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2">Air Freight</h3>
                    <p class="text-text-secondary text-sm">When time is critical, our global air freight services
                        provide the speed and reliability you need.</p>
                    <div class="mt-4 flex justify-between text-text-secondary text-xs">
                        <span class="flex items-center">
                            <i data-feather="clock" class="h-3 w-3 mr-1"></i>
                            1-3 days
                        </span>
                        <span class="flex items-center">
                            <i data-feather="package" class="h-3 w-3 mr-1"></i>
                            Up to 100kg
                        </span>
                        <span class="flex items-center">
                            <i data-feather="map-pin" class="h-3 w-3 mr-1"></i>
                            Global
                        </span>
                    </div>
                    <a href="{{ route('services') }}"
                        class="inline-flex items-center text-indigo-400 font-semibold mt-4 hover:text-indigo-300 transition-colors duration-300">
                        <span>Learn More</span>
                        <i data-feather="arrow-right" class="h-4 w-4 ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="card rounded-2xl overflow-hidden group">
                <div class="relative overflow-hidden">
                    <img src="images/ocean.jpg" alt="Ocean Freight"
                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div
                        class="absolute inset-0 bg-indigo-600/20 group-hover:bg-transparent transition-colors duration-300">
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2">Ocean Freight</h3>
                    <p class="text-text-secondary text-sm">Cost-effective and comprehensive ocean freight solutions for
                        large-volume shipments.</p>
                    <div class="mt-4 flex justify-between text-text-secondary text-xs">
                        <span class="flex items-center">
                            <i data-feather="clock" class="h-3 w-3 mr-1"></i>
                            15-45 days
                        </span>
                        <span class="flex items-center">
                            <i data-feather="package" class="h-3 w-3 mr-1"></i>
                            Up to 20 tons
                        </span>
                        <span class="flex items-center">
                            <i data-feather="map-pin" class="h-3 w-3 mr-1"></i>
                            Major ports
                        </span>
                    </div>
                    <a href="{{ route('services') }}"
                        class="inline-flex items-center text-indigo-400 font-semibold mt-4 hover:text-indigo-300 transition-colors duration-300">
                        <span>Learn More</span>
                        <i data-feather="arrow-right" class="h-4 w-4 ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="card rounded-2xl overflow-hidden group">
                <div class="relative overflow-hidden">
                    <img src="images/road.jpg" alt="Road Freight"
                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div
                        class="absolute inset-0 bg-indigo-600/20 group-hover:bg-transparent transition-colors duration-300">
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2">Road Freight</h3>
                    <p class="text-text-secondary text-sm">Efficient and flexible road transport solutions connecting
                        regional hubs and local destinations.</p>
                    <div class="mt-4 flex justify-between text-text-secondary text-xs">
                        <span class="flex items-center">
                            <i data-feather="clock" class="h-3 w-3 mr-1"></i>
                            1-7 days
                        </span>
                        <span class="flex items-center">
                            <i data-feather="package" class="h-3 w-3 mr-1"></i>
                            Up to 25 tons
                        </span>
                        <span class="flex items-center">
                            <i data-feather="map-pin" class="h-3 w-3 mr-1"></i>
                            Regional
                        </span>
                    </div>
                    <a href="{{ route('services') }}"
                        class="inline-flex items-center text-indigo-400 font-semibold mt-4 hover:text-indigo-300 transition-colors duration-300">
                        <span>Learn More</span>
                        <i data-feather="arrow-right" class="h-4 w-4 ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('services') }}"
                class="inline-flex items-center text-indigo-400 font-semibold hover:text-indigo-300 transition-colors duration-300">
                <span>View All Services</span>
                <i data-feather="arrow-right" class="h-5 w-5 ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Cargo Equipment Section -->
<section class="py-16 md:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Advanced Cargo Equipment</h2>
            <p class="mt-4 text-text-secondary">State-of-the-art equipment and technology for safe and efficient cargo
                handling</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="bg-gray-800 rounded-2xl p-8 mb-6 h-64 flex items-center justify-center">
                    <img src="images/image3.jpg" alt="Cargo Planes" class="h-40 object-cover rounded-lg">
                </div>
                <h3 class="text-xl font-bold text-white mb-4">Cargo Aircraft Fleet</h3>
                <p class="text-text-secondary">Modern freighters with capacities from 5-100 tons, including
                    temperature-controlled options</p>
            </div>
            <div class="text-center">
                <div class="bg-gray-800 rounded-2xl p-8 mb-6 h-64 flex items-center justify-center">
                    <img src="images/image4.jpg" alt="Shipping Containers" class="h-40 object-cover rounded-lg">
                </div>
                <h3 class="text-xl font-bold text-white mb-4">Container Solutions</h3>
                <p class="text-text-secondary">20ft to 45ft containers, reefers, flat racks, and open tops for diverse
                    cargo requirements</p>
            </div>
            <div class="text-center">
                <div class="bg-gray-800 rounded-2xl p-8 mb-6 h-64 flex items-center justify-center">
                    <img src="images/image6.jpg" alt="Warehouse Equipment" class="h-40 object-cover rounded-lg">
                </div>
                <h3 class="text-xl font-bold text-white mb-4">Warehouse Technology</h3>
                <p class="text-text-secondary">Automated storage systems, forklifts, and material handling equipment for
                    efficient operations</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div
            class="bg-indigo-600 rounded-2xl p-10 text-center shadow-2xl shadow-indigo-500/30 relative overflow-hidden">
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-indigo-700 rounded-full -translate-y-32 translate-x-32 opacity-20">
            </div>
            <div
                class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-700 rounded-full translate-y-32 -translate-x-32 opacity-20">
            </div>

            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Ready to Ship with Confidence?</h2>
                <p class="text-indigo-200 max-w-2xl mx-auto mb-8">Get a free, no-obligation quote for your next shipment
                    and experience the Elite Exchange Delivery difference.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('contact') }}#quote-form"
                        class="bg-white text-indigo-600 font-semibold px-8 py-4 rounded-xl hover:bg-gray-200 transition-colors duration-300">
                        Get a Free Quote
                    </a>
                    <a href="tel:+13154893120"
                        class="bg-transparent border-2 border-white text-white font-semibold px-8 py-4 rounded-xl hover:bg-white/10 transition-colors duration-300">
                        <i data-feather="phone" class="h-5 w-5 inline mr-2"></i>
                        Call Us Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Initialize feather icons
    feather.replace();
    
    // Enhanced tracking form functionality
    document.addEventListener('DOMContentLoaded', function() {
        const trackingForm = document.querySelector('.tracking-form');
        const trackingInput = trackingForm?.querySelector('input[name="tracking_number"]');
        
        if (trackingForm) {
            // Focus on tracking input when page loads
            if (trackingInput) {
                setTimeout(() => {
                    trackingInput.focus();
                }, 1000);
            }
            
            // Add input validation
            trackingForm.addEventListener('submit', function(e) {
                const trackingNumber = trackingInput.value.trim();
                
                if (!trackingNumber) {
                    e.preventDefault();
                    showTrackingError('Please enter a tracking number');
                    trackingInput.focus();
                    return;
                }
                
                // Show loading state
                const submitButton = this.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.innerHTML = `
                        <i data-feather="loader" class="h-5 w-5 animate-spin"></i>
                        <span class="hidden sm:inline">Tracking...</span>
                    `;
                    feather.replace();
                }
            });
            
            // Clear error when user starts typing
            trackingInput.addEventListener('input', function() {
                clearTrackingError();
            });
        }
        
        function showTrackingError(message) {
            clearTrackingError();
            
            const errorDiv = document.createElement('div');
            errorDiv.className = 'mt-3 p-2 bg-red-500/20 border border-red-500 rounded-lg';
            errorDiv.innerHTML = `
                <p class="text-red-400 text-sm flex items-center gap-1">
                    <i data-feather="alert-circle" class="h-4 w-4"></i>
                    ${message}
                </p>
            `;
            
            trackingForm.parentNode.insertBefore(errorDiv, trackingForm.nextSibling);
            feather.replace();
        }
        
        function clearTrackingError() {
            const existingError = trackingForm.parentNode.querySelector('.mt-3');
            if (existingError) {
                existingError.remove();
            }
        }
        
        // Add keyboard shortcut (Ctrl/Cmd + K) to focus on tracking input
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                if (trackingInput) {
                    trackingInput.focus();
                }
            }
        });
        
        // Add help text for keyboard shortcut
        if (trackingInput) {
            const helpText = document.createElement('p');
            helpText.className = 'text-text-secondary text-xs text-center mt-2 opacity-0 hover:opacity-100 transition-opacity duration-300';
            helpText.innerHTML = '💡 Press <kbd class="px-1 py-0.5 bg-gray-600 rounded text-xs">Ctrl</kbd> + <kbd class="px-1 py-0.5 bg-gray-600 rounded text-xs">K</kbd> to quickly focus';
            
            trackingForm.parentNode.appendChild(helpText);
            
            // Show help text briefly on page load
            setTimeout(() => {
                helpText.classList.add('opacity-100');
                setTimeout(() => {
                    helpText.classList.remove('opacity-100');
                }, 3000);
            }, 2000);
        }
    });
</script>
@endpush