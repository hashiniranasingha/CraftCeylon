@extends('layouts.app')

@section('title', 'Contact Us | CraftCeylon')

@section('content')

<style>
    .contact-page {
        background: #f8f6ef;
        color: #263c2e;
        padding-bottom: 80px;
    }

   .contact-hero {
    background:
        linear-gradient(90deg, rgba(20, 48, 34, .85), rgba(20, 48, 34, .55)),
        url('https://images.pexels.com/photos/31032898/pexels-photo-31032898.jpeg?auto=compress&cs=tinysrgb&w=1800');
    background-size: cover;
    background-position: center;
    padding: 100px 20px;
    text-align: center;
    color: white;
}

    .contact-hero h1 {
        font-family: Georgia, serif;
        font-size: clamp(38px, 5vw, 58px);
        margin-bottom: 15px;
    }

    .contact-hero p {
        max-width: 600px;
        margin: auto;
        color: #e5e8df;
        line-height: 1.8;
    }

    .contact-section {
        max-width: 1150px;
        margin: 65px auto 0;
        padding: 0 20px;
    }

    .contact-heading {
        font-family: Georgia, serif;
        font-size: 36px;
        color: #254b36;
        margin-bottom: 12px;
    }

    .contact-subtitle {
        color: #777;
        line-height: 1.8;
    }

    .contact-card {
        background: white;
        border-radius: 14px;
        padding: 35px;
        height: 100%;
        box-shadow: 0 8px 30px rgba(0,0,0,.05);
    }

    .contact-card h3 {
        font-family: Georgia, serif;
        color: #254b36;
        margin-bottom: 25px;
    }

    .contact-info-item {
        display: flex;
        gap: 16px;
        margin-bottom: 25px;
    }

    .contact-icon {
        width: 46px;
        height: 46px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #edf2e9;
        color: #315b3d;
        border-radius: 50%;
        font-size: 20px;
    }

    .contact-info-item h6 {
        font-weight: 700;
        margin-bottom: 5px;
        color: #254b36;
    }

    .contact-info-item p {
        margin: 0;
        color: #777;
        line-height: 1.7;
    }

    .contact-form .form-label {
        font-weight: 600;
        color: #354b3c;
        margin-bottom: 8px;
    }

    .contact-form .form-control {
        padding: 13px 15px;
        border: 1px solid #e3e5dc;
        border-radius: 8px;
        background: #fdfdfb;
    }

    .contact-form .form-control:focus {
        border-color: #416b4d;
        box-shadow: 0 0 0 3px rgba(65,107,77,.1);
    }

    .contact-submit {
        background: #254b36;
        color: white;
        border: none;
        padding: 14px 30px;
        border-radius: 7px;
        font-weight: 600;
        transition: .3s;
    }

    .contact-submit:hover {
        background: #b18a4a;
        color: white;
        transform: translateY(-2px);
    }

    .location-box {
        background: white;
        padding: 30px;
        border-radius: 14px;
        box-shadow: 0 8px 30px rgba(0,0,0,.05);
    }

    @media(max-width: 768px) {
        .contact-hero {
            padding: 75px 20px;
        }

        .contact-card {
            padding: 25px;
        }

        .contact-heading {
            font-size: 29px;
        }
    }
</style>

<div class="contact-page">

    <!-- Hero Section -->
    <section class="contact-hero">
        <h1>Get in Touch</h1>
        <p>
            We'd love to hear from you. Whether you have a question about our
            handmade products or need assistance, our team is here to help.
        </p>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">

        <div class="text-center mb-5">
            <h2 class="contact-heading">Let's Connect</h2>
            <p class="contact-subtitle">
                Have something in mind? Send us a message and we'll get back to you.
            </p>
        </div>

        <div class="row g-4">

            <!-- Contact Information -->
            <div class="col-lg-5">
                <div class="contact-card">

                    <h3>Contact Information</h3>

                    <div class="contact-info-item">
                        <div class="contact-icon">✉</div>
                        <div>
                            <h6>Email Us</h6>
                            <p>hashinisuwanika@gmail.com.</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-icon">☎</div>
                        <div>
                            <h6>Call Us</h6>
                            <p>0782867904.</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-icon">⌖</div>
                        <div>
                            <h6>Our Location</h6>
                          <p>Bandarawela – Haldummulla</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-icon">◷</div>
                        <div>
                            <h6>Business Hours</h6>
                            <p>Monday – Saturday<br>9:00 AM – 5:00 PM</p>
                        </div>
                    </div>

                    <hr>

                    <p class="text-muted mb-0" style="line-height:1.8;">
                        CraftCeylon celebrates Sri Lankan craftsmanship by
                        connecting customers with unique handmade creations.
                    </p>

                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="contact-card">

                    <h3>Send Us a Message</h3>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}"
                          method="POST"
                          class="contact-form">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Your Name *</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   placeholder="Enter your name"
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address *</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   placeholder="Enter your email"
                                   value="{{ old('email') }}"
                                   required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Subject *</label>
                            <input type="text"
                                   name="subject"
                                   class="form-control"
                                   placeholder="What is your message about?"
                                   value="{{ old('subject') }}"
                                   required>
                            @error('subject')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Your Message *</label>
                            <textarea name="message"
                                      class="form-control"
                                      rows="5"
                                      placeholder="Write your message here..."
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="contact-submit">
                            Send Message →
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </section>

    <!-- Location Section -->
    <section class="contact-section">

        <div class="location-box text-center">
            <h2 class="contact-heading">Our Location</h2>

            <p class="contact-subtitle mb-4">
                Proudly inspired by the rich culture and craftsmanship of Sri Lanka.
            </p>

            <div class="ratio ratio-21x9 rounded overflow-hidden">
                <iframe
                  src="https://www.google.com/maps?q=Haldummulla%2C%20Bandarawela%2C%20Sri%20Lanka&output=embed"
                    style="border:0;"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

    </section>

</div>

@endsection
