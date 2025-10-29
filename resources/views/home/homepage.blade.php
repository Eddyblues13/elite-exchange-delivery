@extends('layouts.app')

@section('title', 'Elite Exchange Delivery - Global Logistics & Shipping')

@section('content')
<!-- Hero Section -->
<section class="hero-bg min-h-[70vh] md:min-h-screen flex items-center"
    style="background-image: url('https://thumbs.dreamstime.com/b/logistics-truck-plane-global-map-blue-background-international-customs-day-banner-logistics-truck-plane-global-map-358322335.jpg');">
    <div class="hero-content container mx-auto px-4 sm:px-6 lg:px-8 text-center">
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

<!-- Services Section -->
<section class="py-16 md:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Our Core Services</h2>
            <p class="mt-4 text-text-secondary">We provide a full spectrum of logistics services to ensure your supply
                chain is efficient, robust, and reliable.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="card rounded-2xl overflow-hidden group">
                <img src="https://aircargoweek.com/wp-content/uploads/2021/02/Screenshot-2021-02-23-at-09.38.10.png"
                    alt="Air Freight"
                    class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2">Air Freight</h3>
                    <p class="text-text-secondary text-sm">When time is critical, our global air freight services
                        provide the speed and reliability you need.</p>
                </div>
            </div>
            <div class="card rounded-2xl overflow-hidden group">
                <img src="https://cdn.businessday.ng/2020/07/sea-freight.jpg" alt="Ocean Freight"
                    class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2">Ocean Freight</h3>
                    <p class="text-text-secondary text-sm">Cost-effective and comprehensive ocean freight solutions for
                        large-volume shipments.</p>
                </div>
            </div>
            <div class="card rounded-2xl overflow-hidden group">
                <img src="https://www.aircargonews.net/wp-content/uploads/2021/02/road-freight.jpg" alt="Road Freight"
                    class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2">Road Freight</h3>
                    <p class="text-text-secondary text-sm">Efficient and flexible road transport solutions connecting
                        regional hubs and local destinations.</p>
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

<!-- CTA Section -->
<section class="py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-indigo-600 rounded-2xl p-10 text-center shadow-2xl shadow-indigo-500/30">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Ready to Ship with Confidence?</h2>
            <p class="text-indigo-200 max-w-2xl mx-auto mb-8">Get a free, no-obligation quote for your next shipment and
                experience the Elite Exchange Delivery difference.</p>
            <a href="{{ route('contact') }}#quote-form"
                class="bg-white text-indigo-600 font-semibold px-8 py-4 rounded-xl hover:bg-gray-200 transition-colors duration-300">
                Get a Free Quote
            </a>
        </div>
    </div>
</section>
@endsection