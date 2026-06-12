@extends('layouts.home')

@section('title', 'Register a Package - Elite Exchange Delivery')

@section('content')

<!-- Hero Banner -->
<section class="bg-gradient-to-r from-primary-800 to-primary-600 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-4">
            <i class="fas fa-box-open text-white text-2xl"></i>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-3">Register a Package</h1>
        <p class="text-primary-100 text-lg max-w-2xl mx-auto">
            Fill in the details below to register your shipment. A unique tracking number will be auto-generated for you.
        </p>
    </div>
</section>

<!-- Form Section -->
<section class="py-12 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Alerts --}}
        @if(session('success'))
        <div class="mb-6 p-5 bg-green-50 border border-green-300 rounded-xl flex items-start space-x-3">
            <i class="fas fa-check-circle text-green-500 text-xl mt-0.5 flex-shrink-0"></i>
            <div>
                <p class="font-semibold text-green-800">Package Registered Successfully!</p>
                <p class="text-green-700 mt-1">{{ session('success') }}</p>
                <a href="{{ route('track') }}" class="inline-block mt-3 text-sm font-medium text-green-700 underline hover:text-green-900">
                    Track your package &rarr;
                </a>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-300 rounded-xl flex items-center space-x-3">
            <i class="fas fa-exclamation-circle text-red-500 text-xl flex-shrink-0"></i>
            <p class="text-red-700">{{ session('error') }}</p>
        </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data" id="registerForm">
            @csrf

            {{-- Tracking Number --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex items-center space-x-2 mb-4">
                    <i class="fas fa-barcode text-primary-600"></i>
                    <h2 class="text-lg font-semibold text-gray-800">Tracking Number</h2>
                </div>
                <div class="flex items-center space-x-3">
                    <input type="text" name="tracking_number" id="trackingNumber"
                        value="{{ old('tracking_number', 'EED' . strtoupper(substr(md5(uniqid()), 0, 10))) }}"
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 font-mono text-lg tracking-widest focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        readonly>
                    <button type="button" onclick="regenerateTracking()"
                        class="px-4 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors font-medium flex items-center space-x-2"
                        title="Generate new tracking number">
                        <i class="fas fa-sync-alt"></i>
                        <span class="hidden sm:inline">Regenerate</span>
                    </button>
                </div>
                <p class="text-sm text-gray-500 mt-2">
                    <i class="fas fa-info-circle mr-1"></i>
                    This tracking number is auto-generated. Save it to track your shipment.
                </p>
                @error('tracking_number')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Sender & Receiver --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                {{-- Sender Info --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-user text-primary-600"></i>
                        <h2 class="text-lg font-semibold text-gray-800">Sender Information</h2>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="sender_name" value="{{ old('sender_name') }}"
                                placeholder="Enter sender's full name"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('sender_name') border-red-400 @enderror">
                            @error('sender_name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Shipping From <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="shipping_from" value="{{ old('shipping_from') }}"
                                placeholder="City, Country of origin"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('shipping_from') border-red-400 @enderror">
                            @error('shipping_from')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Receiver Info --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-user-check text-primary-600"></i>
                        <h2 class="text-lg font-semibold text-gray-800">Receiver Information</h2>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="receiver_name" value="{{ old('receiver_name') }}"
                                placeholder="Receiver's full name"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('receiver_name') border-red-400 @enderror">
                            @error('receiver_name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Phone Number <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="receiver_phone" value="{{ old('receiver_phone') }}"
                                placeholder="+1 234 567 8900"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('receiver_phone') border-red-400 @enderror">
                            @error('receiver_phone')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Country <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="receiver_country" value="{{ old('receiver_country') }}"
                                placeholder="Destination country"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('receiver_country') border-red-400 @enderror">
                            @error('receiver_country')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Delivery Address <span class="text-red-500">*</span>
                            </label>
                            <textarea name="receiver_address" rows="2"
                                placeholder="Full delivery address"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('receiver_address') border-red-400 @enderror">{{ old('receiver_address') }}</textarea>
                            @error('receiver_address')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Package Details --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex items-center space-x-2 mb-4">
                    <i class="fas fa-cube text-primary-600"></i>
                    <h2 class="text-lg font-semibold text-gray-800">Package Details</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Declared Value (USD) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 font-medium">$</span>
                            <input type="number" name="amount" value="{{ old('amount') }}"
                                placeholder="0.00" step="0.01" min="0"
                                class="w-full pl-8 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('amount') border-red-400 @enderror">
                        </div>
                        @error('amount')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Item Description</label>
                        <input type="text" name="item_description" value="{{ old('item_description') }}"
                            placeholder="e.g. Electronics, Documents, Clothing"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Additional Notes</label>
                        <textarea name="notes" rows="2"
                            placeholder="Any special handling instructions or notes..."
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Video Upload --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex items-center space-x-2 mb-2">
                    <i class="fas fa-video text-primary-600"></i>
                    <h2 class="text-lg font-semibold text-gray-800">Package Video</h2>
                    <span class="text-xs text-gray-500 font-normal">(Optional)</span>
                </div>
                <p class="text-sm text-gray-500 mb-4">Upload a video showing the package contents for verification purposes.</p>

                <div id="videoDropzone"
                    class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer hover:border-primary-400 hover:bg-primary-50 transition-colors"
                    onclick="document.getElementById('packageVideo').click()">
                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                    <p class="text-gray-600 font-medium">Click to upload a video</p>
                    <p class="text-sm text-gray-400 mt-1">MP4, MOV, AVI, WMV, WEBM &mdash; Max 50MB</p>
                </div>

                <input type="file" id="packageVideo" name="package_video"
                    accept="video/mp4,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/webm"
                    class="hidden" onchange="previewVideo(this)">

                <div id="videoPreview" class="mt-4 hidden">
                    <div class="relative rounded-xl overflow-hidden bg-black">
                        <video id="previewPlayer" controls class="w-full max-h-64 object-contain"></video>
                        <button type="button" onclick="removeVideo()"
                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600 transition-colors">
                            <i class="fas fa-times text-sm"></i>
                        </button>
                    </div>
                    <p id="videoFileName" class="text-sm text-gray-600 mt-2 truncate"></p>
                </div>

                @error('package_video')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit" id="submitBtn"
                    class="flex-1 bg-primary-600 text-white font-semibold px-8 py-4 rounded-xl hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 transition-all shadow-lg flex items-center justify-center space-x-2">
                    <i class="fas fa-paper-plane"></i>
                    <span id="submitText">Register Package</span>
                </button>
                <a href="{{ route('homepage') }}"
                    class="flex-1 bg-white border border-gray-300 text-gray-700 font-semibold px-8 py-4 rounded-xl hover:bg-gray-50 transition-colors text-center flex items-center justify-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Home</span>
                </a>
            </div>
        </form>
    </div>
</section>

{{-- Info Cards --}}
<section class="py-12 bg-white border-t border-gray-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div class="p-6">
                <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-shield-alt text-primary-600 text-xl"></i>
                </div>
                <h3 class="font-semibold text-gray-800 mb-1">Secure Registration</h3>
                <p class="text-sm text-gray-500">Your package details are securely stored and encrypted.</p>
            </div>
            <div class="p-6">
                <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-search-location text-primary-600 text-xl"></i>
                </div>
                <h3 class="font-semibold text-gray-800 mb-1">Real-Time Tracking</h3>
                <p class="text-sm text-gray-500">Use your tracking number to monitor your shipment anytime.</p>
            </div>
            <div class="p-6">
                <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-headset text-primary-600 text-xl"></i>
                </div>
                <h3 class="font-semibold text-gray-800 mb-1">24/7 Support</h3>
                <p class="text-sm text-gray-500">Our team is always available to help with your shipment.</p>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    textarea { resize: vertical; }
</style>
@endpush

@push('scripts')
<script>
    function regenerateTracking() {
        fetch('{{ route("register.generate-tracking") }}')
            .then(r => r.json())
            .then(data => {
                document.getElementById('trackingNumber').value = data.tracking_number;
            })
            .catch(() => {
                const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                let rand = '';
                for (let i = 0; i < 10; i++) rand += chars.charAt(Math.floor(Math.random() * chars.length));
                document.getElementById('trackingNumber').value = 'EED' + rand;
            });
    }

    function previewVideo(input) {
        const file = input.files[0];
        if (!file) return;

        if (file.size > 50 * 1024 * 1024) {
            alert('Video must be smaller than 50MB.');
            input.value = '';
            return;
        }

        const url = URL.createObjectURL(file);
        document.getElementById('previewPlayer').src = url;
        document.getElementById('videoFileName').textContent = file.name + ' (' + (file.size / (1024 * 1024)).toFixed(1) + ' MB)';
        document.getElementById('videoPreview').classList.remove('hidden');
        document.getElementById('videoDropzone').classList.add('hidden');
    }

    function removeVideo() {
        document.getElementById('packageVideo').value = '';
        document.getElementById('previewPlayer').src = '';
        document.getElementById('videoPreview').classList.add('hidden');
        document.getElementById('videoDropzone').classList.remove('hidden');
    }

    document.getElementById('registerForm').addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        const text = document.getElementById('submitText');
        btn.disabled = true;
        btn.classList.add('opacity-75');
        text.textContent = 'Registering...';
    });
</script>
@endpush
