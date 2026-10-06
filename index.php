
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ZenithBank | Banking Management System</title>

    <link rel="stylesheet" href="css/style.css">

</head>


<body>


<!-- =========================================
     NAVIGATION
========================================= -->

<header class="public-navbar">

    <div class="public-logo">
        <span>Zenith</span>Bank
    </div>


    <nav>

        <a href="#home">Home</a>

        <a href="#about">About</a>

        <a href="#services">Services</a>

        <a href="#contact">Contact</a>

        <a href="dashboard.php" class="dashboard-btn">
            Dashboard
        </a>

    </nav>

</header>



<!-- =========================================
     HERO SECTION
========================================= -->

<section id="home" class="hero">

    <div class="hero-content">

        <div class="hero-text">

            <span class="welcome-text">
                WELCOME TO ZENITHBANK
            </span>

            <h1>
                Banking Made
                <span>Simple & Secure</span>
            </h1>

            <p>
                Your trusted banking partner providing reliable,
                secure and convenient financial services for
                individuals and businesses.
            </p>


            <div class="hero-buttons">

                <a href="#services" class="primary-btn">
                    Explore Our Services
                </a>

                <a href="#contact" class="secondary-btn">
                    Contact Us
                </a>

            </div>

        </div>


        <!-- =================================
             IMAGE SLIDER
        ================================== -->

        <div class="bank-slider">

            <div class="slide active">

                <img
                    src="https://images.pexels.com/photos/7260951/pexels-photo-7260951.jpeg"
                    alt="Modern Bank Building"
                >

            </div>


            <div class="slide">

                <img
                    src="https://images.pexels.com/photos/10958528/pexels-photo-10958528.jpeg"
                    alt="Modern Banking Building"
                >

            </div>


            <div class="slide">

                <img
                    src="https://images.pexels.com/photos/17366012/pexels-photo-17366012.jpeg"
                    alt="Bank Building"
                >

            </div>

        </div>

    </div>

</section>



<!-- =========================================
     ABOUT SECTION
========================================= -->

<section id="about" class="about-section">

    <div class="section-container">

        <div class="section-title">

            <span>ABOUT US</span>

            <h2>Banking You Can Trust</h2>

            <p>
                At ZenithBank, we are committed to providing
                dependable banking services designed around
                the needs of our customers.
            </p>

        </div>


        <div class="about-content">

            <div class="about-card">

                <h3>Our Mission</h3>

                <p>
                    To provide secure, convenient and reliable
                    banking services while building long-lasting
                    relationships with our customers.
                </p>

            </div>


            <div class="about-card">

                <h3>Our Vision</h3>

                <p>
                    To become a trusted financial institution
                    recognized for excellent customer service,
                    innovation and professionalism.
                </p>

            </div>


            <div class="about-card">

                <h3>Our Values</h3>

                <p>
                    Integrity, professionalism, customer
                    satisfaction, security and innovation
                    guide everything we do.
                </p>

            </div>

        </div>

    </div>

</section>



<!-- =========================================
     SERVICES SECTION
========================================= -->

<section id="services" class="services-section">

    <div class="section-container">

        <div class="section-title">

            <span>OUR SERVICES</span>

            <h2>What We Offer</h2>

            <p>
                Simple and reliable banking services designed
                to make managing your finances easier.
            </p>

        </div>


        <div class="services-grid">


            <div class="service-card">

                <div class="service-icon">
                    💳
                </div>

                <h3>Customer Accounts</h3>

                <p>
                    Manage your banking accounts with
                    convenient and reliable services.
                </p>

            </div>


            <div class="service-card">

                <div class="service-icon">
                    💰
                </div>

                <h3>Loans & Financing</h3>

                <p>
                    Access financial solutions designed
                    to support your personal and business needs.
                </p>

            </div>


            <div class="service-card">

                <div class="service-icon">
                    💸
                </div>

                <h3>Money Transfer</h3>

                <p>
                    Enjoy convenient and secure money
                    transfer services.
                </p>

            </div>


            <div class="service-card">

                <div class="service-icon">
                    🔐
                </div>

                <h3>Secure Banking</h3>

                <p>
                    We prioritize the security and privacy
                    of our customers' banking information.
                </p>

            </div>


        </div>

    </div>

</section>



<!-- =========================================
     CONTACT SECTION
========================================= -->

<section id="contact" class="contact-section">

    <div class="section-container">

        <div class="section-title">

            <span>CONTACT US</span>

            <h2>We Are Here To Help</h2>

            <p>
                Have a question? Our team is ready to assist you.
            </p>

        </div>


        <div class="contact-grid">


            <div class="contact-card">

                <div class="contact-icon">
                    📍
                </div>

                <h3>Our Address</h3>

                <p>
                    ZenithBank Banking Centre
                </p>

            </div>


            <div class="contact-card">

                <div class="contact-icon">
                    📞
                </div>

                <h3>Phone</h3>

                <p>
                    +234 800 000 0000
                </p>

            </div>


            <div class="contact-card">

                <div class="contact-icon">
                    ✉️
                </div>

                <h3>Email</h3>

                <p>
                    info@zenithbank.com
                </p>

            </div>


        </div>

    </div>

</section>



<!-- =========================================
     FOOTER
========================================= -->

<footer class="public-footer">

    <div class="footer-logo">

        <span>Zenith</span>Bank

    </div>


    <p>
        Banking Management System
    </p>


    <div class="footer-links">

        <a href="#home">Home</a>

        <a href="#about">About</a>

        <a href="#services">Services</a>

        <a href="#contact">Contact</a>

    </div>


    <p class="copyright">

        &copy; 2026 ZenithBank. All Rights Reserved.

    </p>

</footer>



<!-- =========================================
     IMAGE SLIDER JAVASCRIPT
========================================= -->

<script>

    let currentSlide = 0;

    const slides = document.querySelectorAll(".slide");


    function showSlide(index) {

        slides.forEach(function(slide) {

            slide.classList.remove("active");

        });


        slides[index].classList.add("active");

    }


    function nextSlide() {

        currentSlide++;

        if (currentSlide >= slides.length) {

            currentSlide = 0;

        }

        showSlide(currentSlide);

    }


    setInterval(nextSlide, 5000);

</script>


</body>

</html>

