<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotoCare - Bengkel Motor Profesional</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

    @if (session('success'))
        <div class="flash-alert" role="alert">
            <i class="fas fa-circle-check"></i>
            <span>{{ session('success') }}</span>
            <button type="button" onclick="this.parentElement.remove()" aria-label="Tutup">&times;</button>
        </div>
    @endif

    <!-- ============================================================
         NAVBAR
    ============================================================ -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="#" class="nav-logo">
                <span class="logo-moto">Moto</span><span class="logo-care">Care</span>
            </a>
            <ul class="nav-menu">
                <li><a href="#beranda" class="nav-link">Beranda</a></li>
                <li><a href="#tentang" class="nav-link">Tentang kami</a></li>
                <li><a href="#layanan" class="nav-link">Layanan</a></li>
                <li><a href="#booking" class="nav-link">Booking</a></li>
                <li><a href="#galeri" class="nav-link">Galeri</a></li>
                <li><a href="#kontak" class="nav-link">Kontak</a></li>
            </ul>
            <div class="hamburger" id="hamburger">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- ============================================================
         HERO SECTION
    ============================================================ -->
    <section class="hero" id="beranda">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <p class="hero-eyebrow">Bengkel Jaya</p>
            <h1 class="hero-title">Solusi<br>Servis Motor</h1>
            <p class="hero-desc">Melayani berbagai jenis motor dengan teknisi professional, tools cutting-berkualitas, dan harga yang transparan.</p>
            <div class="hero-buttons">
                <a href="#layanan" class="btn btn-red">Selengkapnya</a>
                <a href="#kontak" class="btn btn-outline">Kontak kami</a>
            </div>
        </div>
        <div class="hero-bg">
            <img src="{{ asset('images/hero-bg.png') }}" alt="Hero Background">
        </div>
    </section>

    <!-- ============================================================
         TENTANG KAMI
    ============================================================ -->
    <section class="tentang" id="tentang">
        <div class="tentang-container">
            <div class="tentang-image">
                <img src="{{ asset('images/tentang.png') }}" alt="Tentang MotoCare">
            </div>
            <div class="tentang-content">
                <h2 class="section-title">Tentang <span class="red">Kami</span></h2>
                <p>MotoCare adalah bengkel motor yang berkomitmen memberikan layanan servis dan perawatan kendaraan dengan kualitas terbaik. Didukung oleh mekanik berpengalaman dan peralatan modern, kami siap membantu menjaga performa motor Anda agar tetap optimal, aman, dan nyaman digunakan setiap hari.</p>
                <p>Setiap Servis, kami selalu mengutamakan kepuasan pelanggan melalui pelayanan yang cepat, transparan, dan terpercaya. Mulai dari servis berkala, ganti oli, perbaikan mesin, hingga perawatan komponen lainnya, setiap pekerjaan kami lakukan dengan standar kualitas yang tinggi.</p>
            </div>
        </div>
    </section>

    <!-- ============================================================
         LAYANAN
    ============================================================ -->
    <section class="layanan" id="layanan">
        <div class="layanan-container">
            <div class="section-header">
                <h2 class="section-title-center">Layanan</h2>
                <p class="section-sub"><span class="red">SDM yang Berkualitas</span>, Terampil dan didukung dengan Alat yg Modern</p>
            </div>
            <div class="layanan-grid">
                @forelse ($services as $service)
                    <div class="layanan-card">
                        <div class="layanan-img">
                            <img src="{{ $service->image_url }}" alt="{{ $service->name }}">
                        </div>
                        <h3>{{ strtoupper($service->name) }}</h3>
                        <p>{{ $service->description }}</p>
                        <p class="layanan-price">Estimasi: Rp {{ number_format($service->estimated_price, 0, ',', '.') }}</p>
                        <a href="#booking" class="btn btn-red layanan-btn">Booking Layanan Ini</a>
                    </div>
                @empty
                    <p class="layanan-empty">Belum ada layanan yang tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ============================================================
         GALERI
    ============================================================ -->
    <section class="galeri" id="galeri">
        <div class="galeri-container">
            <h2 class="section-title-center"><span class="red">Galeri</span> Kami</h2>
            <div class="galeri-grid">
                <div class="galeri-item galeri-tall">
                    <img src="{{ asset('images/galeri1.png') }}" alt="Galeri 1">
                </div>
                <div class="galeri-item">
                    <img src="{{ asset('images/galeri2.png') }}" alt="Galeri 2">
                </div>
                <div class="galeri-item">
                    <img src="{{ asset('images/galeri3.png') }}" alt="Galeri 3">
                </div>
                <div class="galeri-item galeri-wide">
                    <img src="{{ asset('images/galeri4.png') }}" alt="Galeri 4">
                </div>
                <div class="galeri-item">
                    <img src="{{ asset('images/galeri5.png') }}" alt="Galeri 5">
                </div>
                <div class="galeri-item galeri-wide">
                    <img src="{{ asset('images/galeri6.png') }}" alt="Galeri 6">
                </div>

            </div>
        </div>
    </section>

    <!-- ============================================================
         BRANDS
    ============================================================ -->
    <section class="brands">
        <div class="brands-container">
            <p class="brands-label">BRANDS</p>
            <div class="brands-logos">
                <div class="brand-item">
                    <img src="{{ asset('images/yamaha.png') }}" alt="Yamaha">
                    <span>YAMAHA</span>
                </div>
                <div class="brand-item">
                    <span class="brand-text">SUZUKI</span>
                </div>
                <div class="brand-item">
                    <span class="brand-text brand-honda">HONDA</span>
                </div>
                <div class="brand-item">
                    <span class="brand-text">SHELL</span>
                </div>
                <div class="brand-item">
                    <span class="brand-text">ADVANCE</span>
                </div>
            </div>
            <p class="brands-more">and many more</p>
        </div>
    </section>

    <!-- ============================================================
         KONTAK KAMI
    ============================================================ -->
    <section class="kontak" id="kontak">
        <div class="kontak-overlay"></div>
        <div class="kontak-container">
            <h2 class="section-title-center white"><span class="red">Kontak</span> Kami</h2>
            <p class="kontak-sub">Hubungi kami jika Anda membutuhkan bantuan atau ingin melakukan booking.</p>
            <div class="kontak-cards">
                <div class="kontak-card">
                    <div class="kontak-icon phone">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h3>+62 882 7672 6564</h3>
                    <p>Hubungi kami jika Anda membutuhkan bantuan</p>
                </div>
                <div class="kontak-card">
                    <div class="kontak-icon email">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3>joko@gmail.com</h3>
                    <p>Hubungi kami jika Anda membutuhkan bantuan</p>
                </div>
                <div class="kontak-card">
                    <div class="kontak-icon location">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>madiun, psht</h3>
                    <p>Hubungi kami jika Anda membutuhkan bantuan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         FORM HUBUNGI
    ============================================================ -->
    <section class="form-section">
        <div class="form-container">
            <div class="form-left">
                <p class="form-from">From</p>
                <h2 class="form-title">Hubungi Sekarang !!!</h2>
                <p class="form-desc">Kami siap membantu menyelesaikan kendala dan kebutuhan bisnis Anda. Tinggalkan pesan melalui formulir di bawah ini agar tim spesialis kami dapat segera menghubungi Anda.</p>
            </div>
            <div class="form-right">
                <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                    @csrf
                    @if ($errors->hasAny(['name', 'email', 'phone', 'message']))
                        <div class="form-errors">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-row">
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama" class="form-input" required>
                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Nomor HP" class="form-input" required>
                    </div>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-input full" required>
                    <textarea name="message" placeholder="Pesan" class="form-textarea" required>{{ old('message') }}</textarea>
                    <div class="form-submit-row">
                        <button type="submit" class="btn btn-red">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- ============================================================
         FORM BOOKING
    ============================================================ -->
    <section class="form-section booking-section" id="booking">
        <div class="form-container">
            <div class="form-left">
                <p class="form-from">Booking</p>
                <h2 class="form-title">Booking Servis Sekarang</h2>
                <p class="form-desc">Isi data kendaraan dan pilih jenis servis yang Anda butuhkan. Tim kami akan menghubungi Anda melalui WhatsApp untuk mengonfirmasi jadwal servis.</p>
            </div>
            <div class="form-right">
                <form action="{{ route('booking.store') }}" method="POST" class="contact-form">
                    @csrf
                    @if ($errors->hasAny(['customer_name', 'whatsapp_number', 'plate_number', 'service_date', 'service_id']))
                        <div class="form-errors">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-row">
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}" placeholder="Nama Pelanggan" class="form-input" required>
                        <input type="tel" name="whatsapp_number" value="{{ old('whatsapp_number') }}" placeholder="Nomor WhatsApp" class="form-input" required>
                    </div>
                    <div class="form-row">
                        <input type="text" name="plate_number" value="{{ old('plate_number') }}" placeholder="Plat Nomor (contoh: AE 1234 XY)" class="form-input" style="text-transform: uppercase;" required>
                        <input type="date" name="service_date" value="{{ old('service_date') }}" min="{{ date('Y-m-d') }}" class="form-input" required>
                    </div>
                    <select name="service_id" class="form-input" required>
                        <option value="">-- Pilih Jenis Servis --</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}" @selected(old('service_id') == $service->id)>
                                {{ $service->name }} - Rp {{ number_format($service->estimated_price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-submit-row">
                        <button type="submit" class="btn btn-red">Booking Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- ============================================================
         MAP SECTION
    ============================================================ -->
    <section class="map-section">
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.123456789!2d111.5234567!3d-7.6298765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMzcnNDcuNiJTIDExMcKwMzEnMjQuNCJF!5e0!3m2!1sid!2sid!4v1234567890"
                width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </section>

    <!-- ============================================================
         FOOTER
    ============================================================ -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-col footer-brand">
                <h3 class="footer-logo"><span class="logo-moto">Moto</span><span class="logo-care">Care</span></h3>
                <p>Lokasi dekat dari Simpang tanya sayang, merupakan bengkel yang Anda butuhkan. Kami menyediakan berbagai layanan perawatan motor dengan teknisi berpengalaman.</p>
            </div>
            <div class="footer-col">
                <h4>Contact Us</h4>
                <ul>
                    <li>WhatsApp: +62 882 7672 6132</li>
                    <li>bengkeljayu@gmail.com</li>
                    <li>Madiun, Jawa Timur</li>
                    <li>Kota & Stav: +62 852 7672 0166-001</li>
                </ul>
            </div>
            <div class="footer-col footer-social">
    <h4>Sosial Media :</h4>
    <div class="social-icons">
        <!-- Ganti dengan link halaman Facebook Anda -->
        <a href="https://facebook.com/awa.udin.984" target="_blank" class="social-icon">
            <i class="fab fa-facebook-f"></i>
        </a>
        
        <!-- Ganti dengan link profil TikTok Anda -->
        <a href="https://instagram.com/awa_ilhq/" target="_blank" class="social-icon">
            <i class="fab fa-instagram"></i>
        </a>

        <a href="https://wa.me/0882003668995/" target="_blank" class="social-icon">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
</div>
        </div>
        <div class="footer-bottom">
            <p>© Copyright 2026 Motocare |</p>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Hamburger menu
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.querySelector('.nav-menu');
        hamburger.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            hamburger.classList.toggle('active');
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                    navMenu.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>