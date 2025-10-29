@extends('layouts.app')

@section('title', 'Contact Us - Webcrack Cargo')

@section('content')
<!-- Page Header -->
<section class="page-header-bg min-h-[40vh] flex items-end py-16"
    style="background-image: url('https://placehold.co/1920x800/111827/374151?text=Contact+Us');">
    <div class="page-header-content container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white">Get in Touch</h1>
        <p class="mt-2 text-lg text-text-secondary max-w-2xl">We're here to help. Reach out to us with any questions or
            for a personalized quote.</p>
    </div>
</section>

<!-- Contact Info and Form Section -->
<section class="py-16 md:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Left: Contact Info -->
            <div>
                <h2 class="text-3xl font-bold text-white mb-6">Contact Information</h2>
                <p class="text-text-secondary mb-8">Our team is available to assist you during business hours. Feel free
                    to visit, call, or email us.</p>

                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="p-3 bg-gray-800 rounded-lg mr-4"><i data-feather="map-pin"
                                class="h-6 w-6 text-indigo-400"></i></div>
                        <div>
                            <h4 class="font-semibold text-white">Our Office</h4>
                            <p class="text-text-secondary">123 Logic Drive, Ikeja, Lagos, Nigeria</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="p-3 bg-gray-800 rounded-lg mr-4"><i data-feather="phone"
                                class="h-6 w-6 text-indigo-400"></i></div>
                        <div>
                            <h4 class="font-semibold text-white">Phone</h4>
                            <p class="text-text-secondary">+234 800 123 4567</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="p-3 bg-gray-800 rounded-lg mr-4"><i data-feather="mail"
                                class="h-6 w-6 text-indigo-400"></i></div>
                        <div>
                            <h4 class="font-semibold text-white">Email</h4>
                            <p class="text-text-secondary">contact@webcrackcargo.com</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="p-3 bg-gray-800 rounded-lg mr-4"><i data-feather="clock"
                                class="h-6 w-6 text-indigo-400"></i></div>
                        <div>
                            <h4 class="font-semibold text-white">Business Hours</h4>
                            <p class="text-text-secondary">Monday - Friday: 9am - 6pm</p>
                            <p class="text-text-secondary">Saturday: 10am - 2pm</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right: Contact Form -->
            <div id="quote-form" class="card p-8 rounded-2xl">
                <h2 class="text-3xl font-bold text-white mb-6">Send Us a Message</h2>
                <form action="#" method="POST" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-text-secondary mb-2">Full Name</label>
                        <input type="text" name="name" id="name" required
                            class="form-input w-full rounded-md py-3 px-4">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-text-secondary mb-2">Email
                            Address</label>
                        <input type="email" name="email" id="email" required
                            class="form-input w-full rounded-md py-3 px-4">
                    </div>
                    <div>
                        <label for="subject" class="block text-sm font-medium text-text-secondary mb-2">Subject</label>
                        <input type="text" name="subject" id="subject" required
                            class="form-input w-full rounded-md py-3 px-4">
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-text-secondary mb-2">Message</label>
                        <textarea name="message" id="message" rows="4" required
                            class="form-input w-full rounded-md py-3 px-4"></textarea>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-indigo-600 text-white font-semibold px-8 py-4 rounded-xl hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all duration-300 shadow-lg hover:shadow-indigo-500/50">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="h-96 bg-gray-800">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.2952467548233!2d3.344407915359487!3d6.609598095220197!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b9228fa2a197f%3A0x8c7c9c646ab39f75!2sIkeja%2C%20Lagos!5e0!3m2!1sen!2sng!4v1677671853245!5m2!1sen!2sng"
        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade" class="filter grayscale invert brightness-75"></iframe>
</section>
@endsection