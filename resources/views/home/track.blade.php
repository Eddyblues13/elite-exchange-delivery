@extends('layouts.app')

@section('title', 'Track Shipment - Webcrack Cargo')

@section('content')
<!-- Page Header -->
<section class="page-header-bg min-h-[40vh] flex items-end py-16"
    style="background-image: url('https://placehold.co/1920x800/111827/374151?text=Track+Shipment');">
    <div class="page-header-content container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white">Track Your Shipment</h1>
        <p class="mt-2 text-lg text-text-secondary max-w-2xl">Get real-time updates on your shipment's location and
            status.</p>
    </div>
</section>

<!-- Tracking Form Section -->
<section class="py-16 md:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <div class="card p-8 rounded-2xl">
                <h2 class="text-3xl font-bold text-white mb-6">Enter Tracking Number</h2>
                <form action="#" method="GET" class="space-y-6">
                    <div>
                        <label for="tracking-number" class="block text-sm font-medium text-text-secondary mb-2">Tracking
                            Number</label>
                        <input type="text" name="tracking-number" id="tracking-number" placeholder="e.g., WCK-123456789"
                            required class="form-input w-full rounded-md py-3 px-4 text-center text-lg tracking-widest">
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-indigo-600 text-white font-semibold px-8 py-4 rounded-xl hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all duration-300 shadow-lg hover:shadow-indigo-500/50 flex items-center justify-center gap-2">
                            <i data-feather="search" class="h-5 w-5"></i>
                            <span>Track Shipment</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Tracking Result Example (Initially Hidden) -->
<section class="py-16 bg-gray-800 hidden" id="tracking-result">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="card p-8 rounded-2xl">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Shipment #WCK-123456789</h2>
                        <p class="text-text-secondary">Estimated Delivery: <span class="text-white font-semibold">Dec
                                28, 2024</span></p>
                    </div>
                    <div class="mt-4 md:mt-0 px-4 py-2 bg-green-500/20 rounded-full">
                        <span class="text-green-400 font-semibold flex items-center gap-2"><i
                                data-feather="check-circle" class="h-4 w-4"></i> In Transit</span>
                    </div>
                </div>

                <!-- Tracking Timeline -->
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex flex-col items-center mr-4">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <div class="w-0.5 h-16 bg-green-500 mt-1"></div>
                        </div>
                        <div class="flex-1 pb-8">
                            <h4 class="font-semibold text-white">Shipment Picked Up</h4>
                            <p class="text-text-secondary text-sm">Lagos, Nigeria</p>
                            <p class="text-text-secondary text-sm">Dec 20, 2024 - 09:30 AM</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex flex-col items-center mr-4">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <div class="w-0.5 h-16 bg-green-500 mt-1"></div>
                        </div>
                        <div class="flex-1 pb-8">
                            <h4 class="font-semibold text-white">Processing at Facility</h4>
                            <p class="text-text-secondary text-sm">Ikeja Distribution Center</p>
                            <p class="text-text-secondary text-sm">Dec 20, 2024 - 02:15 PM</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex flex-col items-center mr-4">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <div class="w-0.5 h-16 bg-green-500 mt-1"></div>
                        </div>
                        <div class="flex-1 pb-8">
                            <h4 class="font-semibold text-white">Departed Facility</h4>
                            <p class="text-text-secondary text-sm">En route to Port of Lagos</p>
                            <p class="text-text-secondary text-sm">Dec 21, 2024 - 08:45 AM</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex flex-col items-center mr-4">
                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                            <div class="w-0.5 h-16 bg-gray-600 mt-1"></div>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-white">Out for Delivery</h4>
                            <p class="text-text-secondary text-sm">Estimated: Dec 28, 2024</p>
                            <p class="text-text-secondary text-sm">London, United Kingdom</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex flex-col items-center mr-4">
                            <div class="w-3 h-3 bg-gray-600 rounded-full"></div>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-400">Delivered</h4>
                            <p class="text-text-secondary text-sm">Pending</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 md:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-white text-center mb-12">Tracking FAQs</h2>
            <div class="space-y-6">
                <div class="card p-6 rounded-2xl">
                    <h3 class="text-lg font-semibold text-white mb-2">Where can I find my tracking number?</h3>
                    <p class="text-text-secondary text-sm">Your tracking number is provided in the confirmation email
                        and on the shipping receipt when you booked the shipment.</p>
                </div>
                <div class="card p-6 rounded-2xl">
                    <h3 class="text-lg font-semibold text-white mb-2">How often is tracking information updated?</h3>
                    <p class="text-text-secondary text-sm">Tracking information is updated in real-time as your shipment
                        moves through our network. Major status changes are updated immediately.</p>
                </div>
                <div class="card p-6 rounded-2xl">
                    <h3 class="text-lg font-semibold text-white mb-2">My tracking hasn't updated in a while. What should
                        I do?</h3>
                    <p class="text-text-secondary text-sm">If tracking hasn't updated for more than 48 hours, please
                        contact our customer service team for assistance.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Example tracking functionality
    document.addEventListener('DOMContentLoaded', function() {
        const trackingForm = document.querySelector('form');
        const trackingResult = document.getElementById('tracking-result');
        
        if (trackingForm) {
            trackingForm.addEventListener('submit', function(e) {
                e.preventDefault();
                trackingResult.classList.remove('hidden');
                trackingResult.scrollIntoView({ behavior: 'smooth' });
            });
        }
    });
</script>
@endpush