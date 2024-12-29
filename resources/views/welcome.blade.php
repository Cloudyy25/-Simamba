<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Simamba</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Appland
  * Template URL: https://bootstrapmade.com/free-bootstrap-app-landing-page-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 class="sitename">SIMAMBA</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Beranda</a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li><a href="#features">Layanan</a></li>
                    <li><a href="#contact">Lokasi</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="{{ route('login') }}">Login</a>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="hero-layer">
                <img src="{{ asset('images/rectangle3.png') }}" alt="Layer Background">
            </div>
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-7 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
                        <img src="{{ asset('images/bps1.png') }}" class="img-fluid animated" alt="">
                    </div>
                    <div class="col-lg-5 d-flex flex-column justify-content-center text-center text-md-start" data-aos="fade-in">
                        <h2>SELAMAT DATANG DI SIMAMBA</h2>
                        <div class="d-flex mt-4 justify-content-center justify-content-md-start">
                            <a href="{{ route('login') }}" class="download-btn"><span>Login</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section light-background">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Tentang</h2>
                <p>SiMamBa atau Sistem Informasi Monitoring Kegiatan BPS Kabupaten Sumbawa adalah platform yang dirancang khusus untuk memudahkan Pegawai BPS Kabupaten Sumbawa dalam memantau dan mengelola aktivitas secara real-time. Pantau dan lacak aktivitas terkini, optimalkan pengambilan keputusan, serta wujudkan transparansi dalam setiap proses kerja dengan satu platform.</p>
            </div><!-- End Section Title -->
        </section><!-- /About Section -->

        <!-- Features Section -->
        <section id="features" class="features section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Layanan</h2>
                <p>Layanan Sistem Informasi Monitoring Kegiatan BPS Kabupaten Sumbawa</p>
            </div><!-- End Section Title -->
        </section>

        <!-- Feature Details Section -->
        <section id="feature-details" class="feature-details section">

            <div class="container">
                <div class="row gy-4 align-items-center features-item">
                    <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                        <img src="{{ asset('images/image-1.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-7 order-2 order-md-1" data-aos="fade-up" data-aos-delay="200">
                        <h3>Melihat Dashboard Grafik Progres Kegiatan</h3>
                        <ul>
                            <li><i class="bi bi-check"></i> <span> Melihat perkembangan progres kegiatan dari seluruh tim kerja.</span></li>
                            <li><i class="bi bi-check"></i> <span> Melihat perkembangan progres kegiatan dari masing-masing tim.</span></li>
                            <li><i class="bi bi-check"></i> <span> Rekap kegiatan yang ada pada setiap bulan</span>.</li>
                        </ul>
                    </div>
                </div><!-- Features Item -->

                <div class="row gy-4 align-items-center features-item">
                    <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out">
                        <img src="{{ asset('images/image-2.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-7" data-aos="fade-up">
                        <h3>Memantau Jadwal Kegiatan</h3>
                        <ul>
                            <li><i class="bi bi-check"></i> <span> Memantau jadwal kegiatan tim masing-masing.</span></li>
                            <li><i class="bi bi-check"></i> <span> Notifikasi email apabila mendekati batas waktu kegiatan.</span></li>
                            <li><i class="bi bi-check"></i> <span> Notifikasi email perkembangan dan penyelesaian kegiatan</span>.</li>
                        </ul>
                    </div>
                </div><!-- Features Item -->

                <div class="row gy-4 align-items-center features-item">
                    <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out">
                        <img src="{{ asset('images/image-3.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-7 order-2 order-md-1" data-aos="fade-up">
                        <h3>Search, Filter, dan Export Kegiatan</h3>
                        <ul>
                            <li><i class="bi bi-check"></i> <span> Search kegiatan berdasarkan tim maupun bulan dan tahun.</span></li>
                            <li><i class="bi bi-check"></i> <span> Filter kegiatan berdasarkan tim maupun bulan dan tahun.</span></li>
                            <li><i class="bi bi-check"></i> <span> Export kegiatan</span>.</li>
                        </ul>
                    </div>
                </div><!-- Features Item -->

            </div>

        </section><!-- /Feature Details Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Lokasi dan Kontak BPS Kabupaten Sumbawa</h2>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-6">

                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="200">
                                    <i class="bi bi-geo-alt"></i>
                                    <h3>Address</h3>
                                    <p>Jl. Durian No.70 Kel, Uma Sima, Kec. Sumbawa, Kabupaten Sumbawa, Nusa Tenggara Bar. 84313</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="500">
                                    <i class="bi bi-clock"></i>
                                    <h3>Open Hours</h3>
                                    <p>Senin - Jumat</p>
                                    <p>07:00 - 16:00</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="300">
                                    <i class="bi bi-telephone"></i>
                                    <h3>Call Us</h3>
                                    <p>0371-21047</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="400">
                                    <i class="bi bi-envelope"></i>
                                    <h3>Email Us</h3>
                                    <p>bps5204@bps.go.id</p>
                                </div>
                            </div><!-- End Info Item -->

                        </div>

                    </div>

                    <div class="col-lg-6">
                        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                            <div class="row gy-4">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3946.1120823437127!2d117.42058337503029!3d-8.488482085890139!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcbeccd28996ca3%3A0x91c31301a364a6c3!2sBPS%20Kabupaten%20Sumbawa!5e0!3m2!1sen!2sid!4v1734301930345!5m2!1sen!2sid" style="border:0; width: 100%; height:370px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer orange-background">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-4 col-sm-4 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">SIMAMBA</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <strong>https://sumbawakab.bps.go.id/</strong>
                        <p class="mt-3"><strong>Telp:</strong> <span>0371-21047</span></p>
                        <p><strong>Email:</strong> <span>bps5204@bps.go.id</span></p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-5 col-sm-4 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Beranda</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#about">Tentang</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#features">Layanan</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#contact">Lokasi</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-4">
                    <h4>Follow Us</h4>
                    <div class="social-links d-flex">
                        <a href="https://sumbawakab.bps.go.id/"><i class="bi bi-google"></i></a>
                        <a href="https://www.facebook.com/bpssumbawa1"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/bpssumbawa/"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.youtube.com/@bpskabupatensumbawa7060"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Tim 3 RPL 3SD2</span></p>
        </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>