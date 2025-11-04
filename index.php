<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonBondhu - Friend of Your Mind</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2E8B57;
            --secondary: #4ECDC4;
            --accent: #FF6B6B;
            --dark: #1A535C;
            --light: #F7FFF7;
            --bg-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        * {
            margin: 0;
            padding: 0; 
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', 'Hind Siliguri', sans-serif;
            background: var(--bg-gradient);
            color: white;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        
        .logo {
            font-family: 'Hind Siliguri', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            margin-right: auto;
        }
        
        .logo span {
            color: var(--secondary);
        }
        
        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .nav-links a {
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }
        
        .nav-links a:hover {
            color: var(--primary);
        }
        
        .nav-links a:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: var(--primary);
            transition: width 0.3s ease;
        }
        
        .nav-links a:hover:after {
            width: 100%;
        }
        
        .btn-login {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 8px 25px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(46, 139, 87, 0.3);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 139, 87, 0.4);
        }
        
        .hero-section {
            min-height: 80vh;
            display: flex;
            align-items: center;
            padding: 4rem 0;
            position: relative;
        }
        
        .tagline {
            font-family: 'Hind Siliguri', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: white;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }
        
        .tagline span {
            color: #FFD700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .subtagline {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            line-height: 1.6;
            max-width: 600px;
        }
        
        .btn-primary-custom {
            background: linear-gradient(45deg, #FF6B6B, #FF8E53);
            color: white;
            border: none;
            padding: 12px 35px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            margin-right: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.6);
        }
        
        .btn-secondary-custom {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.5);
            padding: 12px 35px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }
        
        .btn-secondary-custom:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-3px);
        }
        
        /* Human Tree House Animation */
        .tree-house-container {
            position: relative;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .tree {
            position: absolute;
            width: 200px;
            height: 350px;
            background: linear-gradient(to right, #8B4513, #A0522D);
            border-radius: 100px 100px 20px 20px;
            z-index: 1;
        }
        
        .tree-top {
            position: absolute;
            width: 300px;
            height: 200px;
            background: #2E8B57;
            border-radius: 50%;
            top: -50px;
            left: -50px;
            z-index: 2;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        .tree-house {
            position: absolute;
            width: 150px;
            height: 120px;
            background: #DEB887;
            border-radius: 15px;
            top: 80px;
            left: 25px;
            z-index: 3;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        .window {
            width: 40px;
            height: 40px;
            background: #87CEEB;
            border-radius: 50%;
            margin: 5px;
            border: 2px solid #8B4513;
        }
        
        .door {
            width: 30px;
            height: 50px;
            background: #8B4513;
            border-radius: 5px 5px 0 0;
            margin-top: 10px;
        }
        
        .person {
            position: absolute;
            width: 40px;
            height: 70px;
            background: #4ECDC4;
            border-radius: 20px 20px 0 0;
            bottom: 0;
            left: 80px;
            z-index: 4;
            animation: person-sway 4s ease-in-out infinite;
        }
        
        .person-head {
            position: absolute;
            width: 30px;
            height: 30px;
            background: #FFDAB9;
            border-radius: 50%;
            top: -15px;
            left: 5px;
        }
        
        .person-arm {
            position: absolute;
            width: 10px;
            height: 40px;
            background: #4ECDC4;
            border-radius: 5px;
            top: 15px;
        }
        
        .person-arm.left {
            left: -10px;
            transform: rotate(-30deg);
        }
        
        .person-arm.right {
            right: -10px;
            transform: rotate(30deg);
        }
        
        .branch {
            position: absolute;
            background: #8B4513;
            border-radius: 10px;
            z-index: 2;
        }
        
        .branch-1 {
            width: 120px;
            height: 15px;
            top: 120px;
            left: -100px;
            transform: rotate(-20deg);
        }
        
        .branch-2 {
            width: 100px;
            height: 15px;
            top: 180px;
            right: -80px;
            transform: rotate(20deg);
        }
        
        .leaf {
            position: absolute;
            background: #2E8B57;
            border-radius: 50%;
            z-index: 2;
        }
        
        .leaf-1 {
            width: 60px;
            height: 60px;
            top: 90px;
            left: -70px;
        }
        
        .leaf-2 {
            width: 50px;
            height: 50px;
            top: 160px;
            right: -60px;
        }
        
        @keyframes person-sway {
            0%, 100% { transform: translateX(0) rotate(0deg); }
            25% { transform: translateX(-5px) rotate(-2deg); }
            75% { transform: translateX(5px) rotate(2deg); }
        }
        
        .features-section {
            padding: 5rem 0;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .section-title {
            font-family: 'Hind Siliguri', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            color: white;
        }
        
        .section-title span {
            color: #FFD700;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1.5rem;
            border-radius: 15px;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            text-align: center;
        }
        
        .feature-card:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.5rem;
        }
        
        .feature-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.8rem;
            color: #FFD700;
        }
        
        .feature-desc {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.5;
            font-size: 0.9rem;
        }
        
        footer {
            background: rgba(0, 0, 0, 0.2);
            padding: 3rem 0;
            text-align: center;
        }
        
        .footer-logo {
            font-family: 'Hind Siliguri', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }
        
        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            margin: 0 1rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .social-icons {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        
        .social-icons a {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 0.5rem;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-icons a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }
        
        .copyright {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .tagline {
                font-size: 2.5rem;
            }
            
            .nav-links {
                margin-top: 1rem;
            }
            
            .nav-links a {
                margin-left: 1rem;
                margin-right: 1rem;
            }
            
            .tree-house-container {
                height: 300px;
                margin-top: 2rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--primary);
            font-size: 1.5rem;
        }
        
        @media (max-width: 992px) {
            .nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                padding: 1rem;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
                z-index: 1000;
            }
            
            .nav-links.show {
                display: flex;
            }
            
            .nav-links a {
                margin: 0.5rem 0;
                padding: 0.5rem 1rem;
                border-radius: 5px;
            }
            
            .nav-links a:hover {
                background: rgba(46, 139, 87, 0.1);
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .navbar .container {
                position: relative;
            }
        }
        
        /* Improved Login Modal */
        .auth-modal .modal-content {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 15px;
            border: none;
        }
        
        .auth-modal .modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .auth-modal .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 10px;
        }
        
        .auth-modal .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
            color: white;
        }
        
        .auth-modal .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        
        .auth-modal .btn-close {
            filter: invert(1);
        }
        
        .auth-modal .form-check-input {
            background-color: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .auth-modal .form-check-input:checked {
            background-color: #FF6B6B;
            border-color: #FF6B6B;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center w-100">
                <a href="#" class="logo">Mon<span>Bondhu</span></a>
                
                <button class="mobile-menu-btn d-lg-none" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="nav-links d-none d-lg-flex">
                    <a href="#home">Home</a>
                    <a href="#features">Features</a>
                    <a href="about.php">About</a>
                    <a href="#support">Support</a>
                    <a href="#contact">Contact</a>
                    <button class="btn-login" onclick="openLogin()">Login</button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div class="nav-links d-lg-none mt-3" id="mobileMenu">
                <a href="#home">Home</a>
                <a href="#features">Features</a>
                <a href="#about">About</a>
                <a href="#support">Support</a>
                <a href="#contact">Contact</a>
                <a href="login.php" class="btn-login">Login</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Side - Content -->
                <div class="col-lg-6 col-md-6">
                    <h1 class="tagline">
                        Mon<span>Bondhu</span><br>
                        <small style="font-size: 1.8rem;">Friend of Your Mind</small>
                    </h1>
                    <p class="subtagline">
                        Your path to healthy life with affordable and professional mental health service. 
                        MonBondhu provides comprehensive health support, resources, and community connections 
                        to help you maintain physical and mental wellbeing.
                    </p>
                    
                    <div class="d-flex flex-wrap">
                        <a href="signup.php" class="btn-primary-custom pulse">
    Get Started
</a>

                    </div>
                </div>
                
          
                <div class="col-lg-6 col-md-6">
                    <div class="tree-house-container">
                        <div class="tree"></div>
                        <div class="tree-top"></div>
                        <div class="tree-house">
                            <div class="window"></div>
                            <div class="door"></div>
                        </div>
                        <div class="branch branch-1"></div>
                        <div class="branch branch-2"></div>
                        <div class="leaf leaf-1"></div>
                        <div class="leaf leaf-2"></div>
                        <div class="person">
                            <div class="person-head"></div>
                            <div class="person-arm left"></div>
                            <div class="person-arm right"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="features">
        <div class="container">
            <h2 class="section-title">Our <span>Features</span></h2>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3 class="feature-title">Mental Health Check-In</h3>
                    <p class="feature-desc">
                        Regular self-assessment tools to track your mental wellbeing with personalized recommendations.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="feature-title">Community Health Support</h3>
                    <p class="feature-desc">
                        Connect with support groups and community health workers for relevant guidance.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-secret"></i>
                    </div>
                    <h3 class="feature-title">Anonymous Help Request</h3>
                    <p class="feature-desc">
                        Seek help confidentially without sharing personal details for complete privacy.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3 class="feature-title">Health Facility Map</h3>
                    <p class="feature-desc">
                        Find nearby healthcare facilities and community clinics with offline-capable mapping.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3 class="feature-title">Seasonal Health Tips</h3>
                    <p class="feature-desc">
                        Receive timely health advisories for seasonal concerns like dengue and flu.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-baby"></i>
                    </div>
                    <h3 class="feature-title">Maternal & Child Health</h3>
                    <p class="feature-desc">
                        Track antenatal care and child vaccination schedules with privacy-first reminders.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <h3 class="feature-title">Symptom Awareness</h3>
                    <p class="feature-desc">
                        Educational guides to recognize concerning symptoms and when to seek care.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="feature-title">Health Events</h3>
                    <p class="feature-desc">
                        Discover upcoming health camps, vaccination drives, and awareness sessions.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon"> 
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h3 class="feature-title">Volunteer Directory</h3>
                    <p class="feature-desc">
                        Connect with trained community health workers and trusted local volunteers.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-microphone-alt"></i>
                    </div>
                    <h3 class="feature-title">Voice Assistant</h3>
                    <p class="feature-desc">
                        Navigate health information through natural Bangla voice commands for all literacy levels.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-logo">Mon<span>Bondhu</span></div>
            
            <div class="footer-links">
                <a href="#home">Home</a>
                <a href="#features">Features</a>
                <a href="#about">About</a>
                <a href="#support">Support</a>
                <a href="#contact">Contact</a>
                <a href="#privacy">Privacy Policy</a>
                <a href="#terms">Terms of Service</a>
            </div>
            
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
            
            <div class="copyright">
                &copy; 2025 MonBondhu . All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Login/Signup Modal -->
    <div class="modal fade auth-modal" id="authModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="authModalTitle">Login to MonBondhu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="authForm">
                        <div id="loginForm">
                            <div class="mb-3">
                                <label class="form-label">Email or Phone Number</label>
                                <input type="text" class="form-control" placeholder="Enter email or phone" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="Enter password" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" style="background: #FF6B6B; border: none;">Login</button>
                            <div class="text-center mt-3">
                                <a href="#" onclick="showSignup()" style="color: #FFD700;">Don't have an account? Sign up</a>
                            </div>
                        </div>
                        
                        <div id="signupForm" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" placeholder="Enter your full name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" placeholder="Enter email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" placeholder="Enter phone number" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="Create password" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" placeholder="Confirm password" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100" style="background: #4ECDC4; border: none;">Create Account</button>
                            <div class="text-center mt-3">
                                <a href="#" onclick="showLogin()" style="color: #FFD700;">Already have an account? Login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
        </div>

    <!-- Bootstrap & Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const authModal = new bootstrap.Modal(document.getElementById('authModal'));
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        // Mobile menu toggle
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('show');
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.navbar') && mobileMenu.classList.contains('show')) {
                mobileMenu.classList.remove('show');
            }
        });
        
        function openLogin() {
            document.getElementById('authModalTitle').textContent = 'Login to MonBondhu';
            document.getElementById('loginForm').style.display = 'block';
            document.getElementById('signupForm').style.display = 'none';
            authModal.show();
        }
        
        function openSignup() {
            document.getElementById('authModalTitle').textContent = 'Join MonBondhu';
            document.getElementById('loginForm').style.display = 'none';
            document.getElementById('signupForm').style.display = 'block';
            authModal.show();
        }
        
        function showSignup() {
            document.getElementById('authModalTitle').textContent = 'Join MonBondhu';
            document.getElementById('loginForm').style.display = 'none';
            document.getElementById('signupForm').style.display = 'block';
        }
        
        function showLogin() {
            document.getElementById('authModalTitle').textContent = 'Login to MonBondhu';
            document.getElementById('loginForm').style.display = 'block';
            document.getElementById('signupForm').style.display = 'none';
        }
        
        document.getElementById('authForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Authentication functionality will be implemented!');
            authModal.hide();
        });
    </script>
</body>
</html>