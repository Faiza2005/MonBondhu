<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - MonBondhu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary: #4a6fa5;
            --secondary: #6b8cbc;
            --accent: #ff7e5f;
            --light: #f8f9fa;
            --dark: #2c3e50;
            --text: #333333;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            color: var(--text);
            overflow-x: hidden;
        }

        /* Header Styles */
        header {
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo h1 {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .logo-icon {
            font-size: 2rem;
            animation: pulse 2s infinite;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--light);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: var(--light);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .login-btn {
            background-color: var(--accent);
            color: white;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(255, 126, 95, 0.3);
        }

        .login-btn:hover {
            background-color: #ff6b4a;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 126, 95, 0.4);
        }

        /* Hero Section */
        .about-hero {
            padding: 5rem 2rem;
            text-align: center;
            background: linear-gradient(135deg, rgba(74, 111, 165, 0.1) 0%, rgba(107, 140, 188, 0.1) 100%);
            position: relative;
            overflow: hidden;
        }

        .about-hero::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(74, 111, 165, 0.1) 0%, rgba(107, 140, 188, 0.1) 100%);
            top: -150px;
            right: -150px;
        }

        .about-hero::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(255, 126, 95, 0.1) 0%, rgba(255, 149, 125, 0.1) 100%);
            bottom: -100px;
            left: -100px;
        }

        .about-hero h1 {
            font-size: 3.5rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .about-hero h1::after {
            content: '';
            position: absolute;
            width: 100px;
            height: 4px;
            background: var(--accent);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .about-hero p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto 2rem;
            line-height: 1.6;
            color: var(--dark);
        }

        /* Mission Section */
        .mission {
            padding: 5rem 2rem;
            background-color: white;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 3rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            width: 80px;
            height: 4px;
            background: var(--accent);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .mission-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            gap: 3rem;
        }

        .mission-text {
            flex: 1;
        }

        .mission-text h3 {
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .mission-text p {
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 1.5rem;
            color: var(--text);
        }

        .mission-image {
            flex: 1;
            position: relative;
        }

        .floating-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            position: relative;
            z-index: 1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-card:nth-child(1) {
            animation-delay: 0s;
        }

        .floating-card:nth-child(2) {
            animation-delay: 2s;
            margin-top: 2rem;
            margin-left: 2rem;
        }

        .floating-card:nth-child(3) {
            animation-delay: 4s;
            margin-top: -1rem;
            margin-left: -1rem;
        }

        .card-icon {
            font-size: 2.5rem;
            color: var(--accent);
            margin-bottom: 1rem;
        }

        /* Values Section */
        .values {
            padding: 5rem 2rem;
            background: linear-gradient(135deg, rgba(74, 111, 165, 0.05) 0%, rgba(107, 140, 188, 0.05) 100%);
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .value-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            text-align: center;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .value-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--accent);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .value-card:hover::before {
            transform: scaleX(1);
        }

        .value-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .value-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .value-card h3 {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .value-card p {
            color: var(--text);
            line-height: 1.6;
        }

        /* Team Section */
        .team {
            padding: 5rem 2rem;
            background-color: white;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .team-member {
            text-align: center;
            transition: all 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-5px);
        }

        .member-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            position: relative;
            overflow: hidden;
        }

        .member-image::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(255, 126, 95, 0.2);
            border-radius: 50%;
            transform: scale(0);
            transition: transform 0.3s ease;
        }

        .team-member:hover .member-image::after {
            transform: scale(1);
        }

        .team-member h3 {
            font-size: 1.3rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .team-member p {
            color: var(--text);
            font-style: italic;
        }

        /* Stats Section */
        .stats {
            padding: 5rem 2rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            text-align: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .stat-item h2 {
            font-size: 3rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .stat-item p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        /* CTA Section */
        .cta {
            padding: 5rem 2rem;
            text-align: center;
            background: linear-gradient(135deg, rgba(255, 126, 95, 0.1) 0%, rgba(255, 149, 125, 0.1) 100%);
        }

        .cta h2 {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .cta p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 2rem;
            line-height: 1.6;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, var(--accent) 0%, #ff9e7d 100%);
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 30px;
            font-size: 1.2rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 126, 95, 0.4);
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 126, 95, 0.6);
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 3rem 2rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-column h3 {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            color: var(--light);
            position: relative;
            display: inline-block;
        }

        .footer-column h3::after {
            content: '';
            position: absolute;
            width: 40px;
            height: 3px;
            background: var(--accent);
            bottom: -8px;
            left: 0;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }

        .social-icons {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-icons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            background: var(--accent);
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            margin-top: 3rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
        }

        /* Animations */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-15px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-links {
                gap: 1rem;
            }

            .about-hero h1 {
                font-size: 2.5rem;
            }

            .mission-content {
                flex-direction: column;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <i class="fas fa-brain logo-icon"></i>
                <h1>MonBondhu</h1>
            </div>
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="features.html">Features</a></li>
                <li><a href="about.html" class="active">About</a></li>
                <li><a href="support.html">Support</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
            <button class="login-btn">Login</button>
        </nav>
    </header>

    <!-- About Hero Section -->
    <section class="about-hero">
        <h1>About MonBondhu</h1>
        <p>We are committed to making mental healthcare accessible, affordable, and effective for everyone. Our mission is to break down barriers and create a supportive community where mental wellbeing is a priority.</p>
    </section>

    <!-- Mission Section -->
    <section class="mission">
        <h2 class="section-title">Our Mission & Vision</h2>
        <div class="mission-content">
            <div class="mission-text fade-in">
                <h3>Friend of Your Mind</h3>
                <p>MonBondhu was founded with a simple yet powerful vision: to create a world where mental health support is accessible to all, regardless of their background or financial situation.</p>
                <p>We believe that everyone deserves a friend for their mind - a reliable companion through life's challenges that provides professional support, resources, and a caring community.</p>
                <p>Our platform combines cutting-edge technology with evidence-based therapeutic approaches to deliver personalized mental healthcare that fits your lifestyle and needs.</p>
            </div>
            <div class="mission-image">
                <div class="floating-card">
                    <i class="fas fa-heart card-icon"></i>
                    <h3>Compassionate Care</h3>
                    <p>We approach mental health with empathy, understanding, and respect for every individual's journey.</p>
                </div>
                <div class="floating-card">
                    <i class="fas fa-shield-alt card-icon"></i>
                    <h3>Safe & Secure</h3>
                    <p>Your privacy and data security are our top priorities in everything we do.</p>
                </div>
                <div class="floating-card">
                    <i class="fas fa-users card-icon"></i>
                    <h3>Community Support</h3>
                    <p>Connect with others who understand your experiences in our supportive community.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values">
        <h2 class="section-title">Our Values</h2>
        <div class="values-grid">
            <div class="value-card fade-in">
                <i class="fas fa-hand-holding-heart value-icon"></i>
                <h3>Empathy First</h3>
                <p>We approach every interaction with compassion and understanding, creating a safe space for healing and growth.</p>
            </div>
            <div class="value-card fade-in">
                <i class="fas fa-lock value-icon"></i>
                <h3>Confidentiality</h3>
                <p>Your privacy is sacred. We maintain the highest standards of data protection and confidentiality.</p>
            </div>
            <div class="value-card fade-in">
                <i class="fas fa-graduation-cap value-icon"></i>
                <h3>Evidence-Based</h3>
                <p>Our methods are grounded in scientific research and delivered by qualified mental health professionals.</p>
            </div>
            <div class="value-card fade-in">
                <i class="fas fa-globe value-icon"></i>
                <h3>Accessibility</h3>
                <p>We break down barriers to make mental healthcare available to everyone, everywhere.</p>
            </div>
            <div class="value-card fade-in">
                <i class="fas fa-rocket value-icon"></i>
                <h3>Innovation</h3>
                <p>We continuously evolve our platform with the latest technology to enhance your mental health journey.</p>
            </div>
            <div class="value-card fade-in">
                <i class="fas fa-hands-helping value-icon"></i>
                <h3>Community</h3>
                <p>We believe in the power of connection and support from others who understand your experiences.</p>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team">
        <h2 class="section-title">Meet Our Team</h2>
        <div class="team-grid">
            <div class="team-member fade-in">
                <div class="member-image">
                    <i class="fas fa-user-md"></i>
                </div>
                <h3>Dr. Sarah Johnson</h3>
                <p>Chief Psychologist</p>
            </div>
            <div class="team-member fade-in">
                <div class="member-image">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <h3>Michael Chen</h3>
                <p>Technology Director</p>
            </div>
            <div class="team-member fade-in">
                <div class="member-image">
                    <i class="fas fa-hands"></i>
                </div>
                <h3>Priya Sharma</h3>
                <p>Community Manager</p>
            </div>
            <div class="team-member fade-in">
                <div class="member-image">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>David Wilson</h3>
                <p>Operations Head</p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <h2 class="section-title" style="color: white;">Our Impact</h2>
        <div class="stats-grid">
            <div class="stat-item fade-in">
                <h2>50,000+</h2>
                <p>Users Helped</p>
            </div>
            <div class="stat-item fade-in">
                <h2>200+</h2>
                <p>Qualified Professionals</p>
            </div>
            <div class="stat-item fade-in">
                <h2>95%</h2>
                <p>User Satisfaction</p>
            </div>
            <div class="stat-item fade-in">
                <h2>24/7</h2>
                <p>Support Available</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <h2>Ready to Start Your Mental Wellness Journey?</h2>
        <p>Join thousands of others who have found support, understanding, and healing with MonBondhu. Take the first step towards a healthier mind today.</p>
        <a href="#" class="cta-button">Get Started Now</a>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>MonBondhu</h3>
                <p>Your trusted companion for mental wellness. We provide accessible, affordable, and professional mental health support.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="features.html">Features</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="support.html">Support</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Services</h3>
                <ul class="footer-links">
                    <li><a href="#">Online Therapy</a></li>
                    <li><a href="#">Support Groups</a></li>
                    <li><a href="#">Self-Help Resources</a></li>
                    <li><a href="#">Crisis Support</a></li>
                    <li><a href="#">Wellness Programs</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contact Us</h3>
                <ul class="footer-links">
                    <li><i class="fas fa-envelope"></i> info@monbondhu.com</li>
                    <li><i class="fas fa-phone"></i> +1 (555) 123-4567</li>
                    <li><i class="fas fa-map-marker-alt"></i> 123 Wellness Street, Mind City</li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2023 MonBondhu. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Fade in animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in');
            
            const fadeInOnScroll = function() {
                fadeElements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const elementVisible = 150;
                    
                    if (elementTop < window.innerHeight - elementVisible) {
                        element.classList.add('visible');
                    }
                });
            };
            
            // Check on load
            fadeInOnScroll();
            
            // Check on scroll
            window.addEventListener('scroll', fadeInOnScroll);
        });
    </script>
</body>
</html>