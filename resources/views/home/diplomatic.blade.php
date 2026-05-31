@extends('layouts.home')

@section('title', 'Diplomatic Bag & Secure Logistics - Elite Exchange Delivery')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-primary-700 to-primary-900 py-24 md:py-32">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 bg-pattern opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.2\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 animate-slide-up">Diplomatic Bag & Secure Logistics</h1>
            <p class="text-xl text-primary-100 max-w-2xl mx-auto animate-slide-up" style="animation-delay: 0.1s">
                Government-grade security, protecting sensitive materials and information worldwide.
            </p>
            
            <!-- Breadcrumbs -->
            <nav class="mt-8 flex justify-center" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm text-primary-200">
                    <li>
                        <a href="{{ route('homepage') }}" class="hover:text-white transition-colors">Home</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-4 w-4 text-primary-300 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <a href="{{ route('services') }}" class="hover:text-white transition-colors">Services</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-4 w-4 text-primary-300 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-white font-medium">Diplomatic Bag</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    
    <!-- Wave Divider -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" class="text-white fill-current">
            <path d="M0,96L80,80C160,64,320,32,480,32C640,32,800,64,960,69.3C1120,75,1280,53,1360,42.7L1440,32L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
        </svg>
    </div>
</section>

<!-- Content Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Image Column -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative">
                    <div class="absolute -top-6 -left-6 w-24 h-24 bg-primary-100 rounded-full opacity-70"></div>
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-primary-50 rounded-full opacity-70"></div>
                    <img src="{{ asset('temp/custom/images/diplomatic-bag-compressor.jpg') }}" alt="Diplomatic Courier & Bag Services" class="relative z-10 rounded-2xl shadow-xl max-w-full lg:max-w-md">
                </div>
            </div>
            
            <!-- Text Column -->
            <div class="lg:col-span-7 space-y-6">
                <h2 class="text-3xl font-bold text-gray-900 mb-4 border-b-2 border-primary-500 pb-3 inline-block">Secure Government & Corporate Courier Solutions</h2>
                <p class="text-gray-700 leading-relaxed text-lg text-justify">
                    Our history incorporates more than 800 years of ensuring our client's and Government’s diplomatic mail is fully protected. This means we are experts in ensuring mail, documents, and sensitive materials are exactly where they need to be, when they need to be there, securely and without compromise.
                </p>
                <p class="text-gray-700 leading-relaxed text-lg text-justify">
                    Our service is truly global, including to hostile environments. We operate a highly secure, flexible, and cost-effective door-to-door global service by ground and air. Our diplomatic courier services, known as the <strong>Elite Exchange Delivery Messengers</strong>, make sure sensitive material is always kept safe under tight surveillance throughout its entire journey.
                </p>
                <p class="text-gray-700 leading-relaxed text-lg text-justify">
                    As well as securely delivering information and materials we also manage its disposal. Protecting information effectively includes making sure it is disposed of correctly when it is no longer needed. We destroy or dispose of all sensitive items, ranging from paper and other documents to hardware, in a secure, environmentally friendly service that has a full audit trail for complete assurance.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Features & Security Standards -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-primary-600 font-semibold tracking-wider uppercase text-sm">Security Assured</span>
            <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-4">Why Trust Elite Exchange Delivery?</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Our security protocols are built to satisfy strict diplomatic standards.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-xl shadow-md border border-gray-100">
                <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-shield-alt text-primary-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Tamper-Proof Solutions</h3>
                <p class="text-gray-600">
                    Utilizing diplomatic-grade seals and packaging, we guarantee your package remains untouched throughout transit.
                </p>
            </div>
            
            <div class="bg-white p-8 rounded-xl shadow-md border border-gray-100">
                <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-user-shield text-primary-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Vetted Handlers</h3>
                <p class="text-gray-600">
                    All Elite Exchange Delivery Messengers undergo extensive background checks and possess high security clearances.
                </p>
            </div>
            
            <div class="bg-white p-8 rounded-xl shadow-md border border-gray-100">
                <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-route text-primary-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Chain of Custody</h3>
                <p class="text-gray-600">
                    Our comprehensive audit logs and dual-custody tracking systems ensure transparency and complete accountability.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Call To Action -->
<section class="py-20 bg-gradient-to-r from-primary-600 to-primary-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Need Ultimate Security For Your Shipment?</h2>
            <p class="text-xl text-primary-100 max-w-2xl mx-auto mb-10">
                Get in touch with our diplomatic logistics advisors to structure your secure transport.
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="{{ route('contact') }}" class="bg-white text-primary-700 hover:bg-gray-100 px-8 py-4 rounded-lg font-medium transition-colors inline-flex items-center justify-center">
                    <i class="fas fa-envelope mr-2"></i>
                    Consult Our Team
                </a>
                <a href="{{ route('services') }}" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-primary-700 px-8 py-4 rounded-lg font-medium transition-colors inline-flex items-center justify-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Other Services
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
