<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonBondhu - Maternal & Child Health Tracker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', 'SolaimanLipi', 'Kalpurush', sans-serif;
        }

        :root {
            --primary: #4a6fa5;
            --secondary: #6b8cbc;
            --accent: #ff7e5f;
            --light: #f8f9fa;
            --dark: #2c3e50;
            --success: #48bb78;
            --warning: #ed8936;
            --danger: #f56565;
            --text: #333333;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            color: var(--text);
            min-height: 100vh;
            padding-bottom: 80px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styles */
        header {
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 1.5rem 2rem;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .header-content {
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

        .language-toggle {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }

        .language-toggle:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Card Styles */
        .card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--light);
        }

        .card-icon {
            font-size: 1.5rem;
            color: var(--primary);
        }

        .card-title {
            font-size: 1.3rem;
            color: var(--primary);
            font-weight: 600;
        }

        /* Input Section */
        .input-group {
            margin-bottom: 1rem;
        }

        .input-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }

        .input-field {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(74, 111, 165, 0.2);
        }

        .btn {
            background: linear-gradient(135deg, var(--accent) 0%, #ff9e7d 100%);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 10px rgba(255, 126, 95, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 126, 95, 0.4);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            box-shadow: 0 4px 10px rgba(74, 111, 165, 0.3);
        }

        .btn-primary:hover {
            box-shadow: 0 6px 15px rgba(74, 111, 165, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success) 0%, #68d391 100%);
            box-shadow: 0 4px 10px rgba(72, 187, 120, 0.3);
        }

        .btn-success:hover {
            box-shadow: 0 6px 15px rgba(72, 187, 120, 0.4);
        }

        /* Timeline Section */
        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--primary);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 2rem;
            padding: 1rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            border-left: 4px solid var(--primary);
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -26px;
            top: 20px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--primary);
            border: 3px solid white;
            box-shadow: 0 0 0 2px var(--primary);
        }

        .timeline-item.upcoming {
            border-left-color: var(--warning);
        }

        .timeline-item.upcoming::before {
            background: var(--warning);
            box-shadow: 0 0 0 2px var(--warning);
        }

        .timeline-item.completed {
            border-left-color: var(--success);
        }

        .timeline-item.completed::before {
            background: var(--success);
            box-shadow: 0 0 0 2px var(--success);
        }

        .timeline-item.missed {
            border-left-color: var(--danger);
        }

        .timeline-item.missed::before {
            background: var(--danger);
            box-shadow: 0 0 0 2px var(--danger);
        }

        .timeline-date {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .timeline-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .timeline-desc {
            color: var(--text);
            margin-bottom: 0.5rem;
            line-height: 1.5;
        }

        .timeline-status {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-upcoming {
            background: rgba(237, 137, 54, 0.1);
            color: var(--warning);
        }

        .status-completed {
            background: rgba(72, 187, 120, 0.1);
            color: var(--success);
        }

        .status-missed {
            background: rgba(245, 101, 101, 0.1);
            color: var(--danger);
        }

        /* Progress Section */
        .progress-container {
            margin-top: 1rem;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .progress-bar {
            height: 10px;
            background: #e2e8f0;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--success) 0%, #68d391 100%);
            border-radius: 5px;
            transition: width 0.5s ease;
        }

        /* Stats Section */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-top: 1rem;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.3rem;
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--text);
        }

        /* Notification Section */
        .notification-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 1rem;
            background: white;
            border-radius: 10px;
            margin-bottom: 1rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            border-left: 4px solid var(--warning);
        }

        .notification-icon {
            font-size: 1.5rem;
            color: var(--warning);
        }

        .notification-content {
            flex: 1;
        }

        .notification-title {
            font-weight: 600;
            margin-bottom: 0.3rem;
        }

        .notification-desc {
            font-size: 0.9rem;
            color: var(--text);
        }

        /* Tips Section */
        .tips-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .tip-card {
            background: white;
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            border-top: 4px solid var(--accent);
        }

        .tip-icon {
            font-size: 1.5rem;
            color: var(--accent);
            margin-bottom: 0.5rem;
        }

        .tip-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }

        .tip-desc {
            font-size: 0.9rem;
            color: var(--text);
            line-height: 1.5;
        }

        /* Footer Navigation */
        .footer-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            display: flex;
            justify-content: space-around;
            padding: 0.8rem 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 100;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--text);
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }

        .nav-item.active {
            color: var(--primary);
        }

        .nav-icon {
            font-size: 1.2rem;
            margin-bottom: 0.3rem;
        }

        /* Animations */
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

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            
            header {
                padding: 1rem;
            }
            
            .logo h1 {
                font-size: 1.5rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .tips-container {
                grid-template-columns: 1fr;
            }
        }

        /* Hidden elements */
        .hidden {
            display: none;
        }

        /* Tab Content */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Reset Button */
        .reset-btn {
            background: rgba(245, 101, 101, 0.1);
            color: var(--danger);
            border: 1px solid var(--danger);
            padding: 0.5rem 1rem;
            border-radius: 10px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .reset-btn:hover {
            background: var(--danger);
            color: white;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-content">
            <div class="logo">
                <i class="fas fa-baby-carriage logo-icon"></i>
                <h1 id="app-title">MonBondhu</h1>
            </div>
            <button class="language-toggle" id="languageToggle">
                <i class="fas fa-language"></i>
                <span id="languageText">English / বাংলা</span>
            </button>
        </div>
    </header>

    <div class="container">
        <!-- Setup Section -->
        <div id="setupSection" class="card fade-in">
            <div class="card-header">
                <i class="fas fa-calendar-plus card-icon"></i>
                <h2 class="card-title" id="setupTitle">Set Up Your Tracker</h2>
            </div>
            <div class="input-group">
                <label class="input-label" id="trackerTypeLabel">Select Tracker Type</label>
                <select class="input-field" id="trackerType">
                    <option value="pregnancy">Pregnancy (Expected Delivery Date)</option>
                    <option value="child">Child (Date of Birth)</option>
                </select>
            </div>
            <div class="input-group">
                <label class="input-label" id="dateLabel">Select Date</label>
                <input type="date" class="input-field" id="selectedDate">
            </div>
            <div class="input-group">
                <label class="input-label" id="nameLabel">Name (Optional)</label>
                <input type="text" class="input-field" id="userName" placeholder="Enter name">
            </div>
            <button class="btn" id="saveBtn">
                <i class="fas fa-save"></i>
                <span id="saveText">Save & Generate Timeline</span>
            </button>
        </div>

        <!-- Dashboard Section -->
        <div id="dashboardSection" class="hidden">
            <!-- Welcome Card -->
            <div class="card fade-in">
                <div class="card-header">
                    <i class="fas fa-baby card-icon"></i>
                    <h2 class="card-title" id="welcomeTitle">Welcome!</h2>
                </div>
                <p id="welcomeText">Your maternal and child health journey is being tracked. Here's your progress:</p>
                
                <div class="progress-container">
                    <div class="progress-header">
                        <span id="progressLabel">Progress</span>
                        <span id="progressValue">0%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" id="progressFill" style="width: 0%"></div>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-value" id="completedCount">0</div>
                        <div class="stat-label" id="completedLabel">Completed</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="upcomingCount">0</div>
                        <div class="stat-label" id="upcomingLabel">Upcoming</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="missedCount">0</div>
                        <div class="stat-label" id="missedLabel">Missed</div>
                    </div>
                </div>
                
                <button class="reset-btn" id="resetBtn">
                    <i class="fas fa-redo"></i>
                    <span id="resetText">Reset All Data</span>
                </button>
            </div>

            <!-- Timeline Section -->
            <div class="card fade-in">
                <div class="card-header">
                    <i class="fas fa-list-alt card-icon"></i>
                    <h2 class="card-title" id="timelineTitle">Health Timeline</h2>
                </div>
                <div class="timeline" id="timelineContainer">
                    <!-- Timeline items will be generated here -->
                </div>
            </div>

            <!-- Notifications Section -->
            <div class="card fade-in">
                <div class="card-header">
                    <i class="fas fa-bell card-icon"></i>
                    <h2 class="card-title" id="notificationsTitle">Notifications</h2>
                </div>
                <div id="notificationsContainer">
                    <!-- Notifications will be generated here -->
                </div>
            </div>

            <!-- Health Tips Section -->
            <div class="card fade-in">
                <div class="card-header">
                    <i class="fas fa-lightbulb card-icon"></i>
                    <h2 class="card-title" id="tipsTitle">Health Tips</h2>
                </div>
                <div class="tips-container" id="tipsContainer">
                    <!-- Tips will be generated here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Navigation -->
    <div class="footer-nav">
        <a href="#" class="nav-item active" data-tab="dashboard">
            <i class="fas fa-home nav-icon"></i>
            <span id="navDashboard">Dashboard</span>
        </a>
        <a href="#" class="nav-item" data-tab="timeline">
            <i class="fas fa-calendar-alt nav-icon"></i>
            <span id="navTimeline">Timeline</span>
        </a>
        <a href="#" class="nav-item" data-tab="resources">
            <i class="fas fa-book-medical nav-icon"></i>
            <span id="navResources">Resources</span>
        </a>
        <a href="#" class="nav-item" data-tab="settings">
            <i class="fas fa-cog nav-icon"></i>
            <span id="navSettings">Settings</span>
        </a>
    </div>

    <script>
        // Language support
        const translations = {
            en: {
                appTitle: "MonBondhu",
                languageText: "English / বাংলা",
                setupTitle: "Set Up Your Tracker",
                trackerTypeLabel: "Select Tracker Type",
                dateLabel: "Select Date",
                nameLabel: "Name (Optional)",
                saveText: "Save & Generate Timeline",
                welcomeTitle: "Welcome!",
                welcomeText: "Your maternal and child health journey is being tracked. Here's your progress:",
                progressLabel: "Progress",
                timelineTitle: "Health Timeline",
                notificationsTitle: "Notifications",
                tipsTitle: "Health Tips",
                navDashboard: "Dashboard",
                navTimeline: "Timeline",
                navResources: "Resources",
                navSettings: "Settings",
                completedLabel: "Completed",
                upcomingLabel: "Upcoming",
                missedLabel: "Missed",
                statusUpcoming: "Upcoming",
                statusCompleted: "Completed",
                statusMissed: "Missed",
                daysLeft: "days left",
                daysAgo: "days ago",
                today: "Today",
                markComplete: "Mark Complete",
                markIncomplete: "Mark Incomplete",
                nextAppointment: "Next Appointment",
                vaccination: "Vaccination",
                checkup: "Checkup",
                test: "Test",
                reminder: "Reminder",
                noNotifications: "No notifications at this time",
                notificationDesc: "Scheduled for",
                tip1Title: "Nutrition",
                tip1Desc: "Eat a balanced diet with plenty of fruits, vegetables, and protein.",
                tip2Title: "Hydration",
                tip2Desc: "Drink at least 8-10 glasses of water daily to stay hydrated.",
                tip3Title: "Rest",
                tip3Desc: "Ensure you get adequate sleep and rest during pregnancy.",
                tip4Title: "Exercise",
                tip4Desc: "Engage in light to moderate exercise as recommended by your doctor.",
                resetText: "Reset All Data",
                resetConfirm: "Are you sure you want to reset all data? This action cannot be undone.",
                dataReset: "All data has been reset successfully."
            },
            bn: {
                appTitle: "মনবন্ধু",
                languageText: "English / বাংলা",
                setupTitle: "আপনার ট্র্যাকার সেট আপ করুন",
                trackerTypeLabel: "ট্র্যাকার প্রকার নির্বাচন করুন",
                dateLabel: "তারিখ নির্বাচন করুন",
                nameLabel: "নাম (ঐচ্ছিক)",
                saveText: "সংরক্ষণ করুন ও টাইমলাইন তৈরি করুন",
                welcomeTitle: "স্বাগতম!",
                welcomeText: "আপনার মাতৃত্ব ও শিশু স্বাস্থ্য যাত্রা ট্র্যাক করা হচ্ছে। এখানে আপনার অগ্রগতি:",
                progressLabel: "অগ্রগতি",
                timelineTitle: "স্বাস্থ্য টাইমলাইন",
                notificationsTitle: "নোটিফিকেশন",
                tipsTitle: "স্বাস্থ্য টিপস",
                navDashboard: "ড্যাশবোর্ড",
                navTimeline: "টাইমলাইন",
                navResources: "রিসোর্স",
                navSettings: "সেটিংস",
                completedLabel: "সম্পন্ন",
                upcomingLabel: "আসন্ন",
                missedLabel: "মিসড",
                statusUpcoming: "আসন্ন",
                statusCompleted: "সম্পন্ন",
                statusMissed: "মিসড",
                daysLeft: "দিন বাকি",
                daysAgo: "দিন আগে",
                today: "আজ",
                markComplete: "সম্পন্ন মার্ক করুন",
                markIncomplete: "অসম্পূর্ণ মার্ক করুন",
                nextAppointment: "পরবর্তী অ্যাপয়েন্টমেন্ট",
                vaccination: "টিকা",
                checkup: "চেকআপ",
                test: "পরীক্ষা",
                reminder: "রিমাইন্ডার",
                noNotifications: "এখনই কোন নোটিফিকেশন নেই",
                notificationDesc: "এর জন্য নির্ধারিত",
                tip1Title: "পুষ্টি",
                tip1Desc: "প্রচুর ফল, শাকসবজি এবং প্রোটিন সহ একটি সুষম খাদ্য খান।",
                tip2Title: "হাইড্রেশন",
                tip2Desc: "হাইড্রেটেড থাকতে দিনে কমপক্ষে ৮-১০ গ্লাস পানি পান করুন।",
                tip3Title: "বিশ্রাম",
                tip3Desc: "গর্ভাবস্থায় পর্যাপ্ত ঘুম এবং বিশ্রাম নিশ্চিত করুন।",
                tip4Title: "ব্যায়াম",
                tip4Desc: "আপনার ডাক্তারের পরামর্শ অনুযায়ী হালকা থেকে মাঝারি ব্যায়ামে নিযুক্ত হন।",
                resetText: "সমস্ত ডেটা রিসেট করুন",
                resetConfirm: "আপনি কি নিশ্চিত যে আপনি সমস্ত ডেটা রিসেট করতে চান? এই ক্রিয়াটি পূর্বাবস্থায় ফেরানো যাবে না।",
                dataReset: "সমস্ত ডেটা সফলভাবে রিসেট করা হয়েছে।"
            }
        };

        // Current language
        let currentLang = 'en';

        // DOM Elements
        const languageToggle = document.getElementById('languageToggle');
        const languageText = document.getElementById('languageText');
        const appTitle = document.getElementById('appTitle');
        const setupSection = document.getElementById('setupSection');
        const dashboardSection = document.getElementById('dashboardSection');
        const saveBtn = document.getElementById('saveBtn');
        const trackerType = document.getElementById('trackerType');
        const selectedDate = document.getElementById('selectedDate');
        const userName = document.getElementById('userName');
        const resetBtn = document.getElementById('resetBtn');

        // Initialize the app
        document.addEventListener('DOMContentLoaded', function() {
            // Check if user data exists in localStorage
            const userData = localStorage.getItem('maternalChildHealthData');
            
            if (userData) {
                // Show dashboard if data exists
                showDashboard();
                const parsedData = JSON.parse(userData);
                generateTimeline(parsedData);
                updateProgress(parsedData);
                generateNotifications(parsedData);
                generateHealthTips();
            } else {
                // Show setup if no data exists
                showSetup();
            }

            // Set up language toggle
            languageToggle.addEventListener('click', toggleLanguage);

            // Set up save button
            saveBtn.addEventListener('click', saveUserData);

            // Set up reset button
            resetBtn.addEventListener('click', resetData);
            
            // Set up footer navigation
            setupFooterNavigation();
            
            // Set default date to today
            const today = new Date().toISOString().split('T')[0];
            selectedDate.value = today;
        });

        // Toggle language function
        function toggleLanguage() {
            currentLang = currentLang === 'en' ? 'bn' : 'en';
            updateLanguage();
            
            // Update existing data if available
            const userData = localStorage.getItem('maternalChildHealthData');
            if (userData) {
                const parsedData = JSON.parse(userData);
                generateTimeline(parsedData);
                updateProgress(parsedData);
                generateNotifications(parsedData);
                generateHealthTips();
            }
        }

        // Update all text based on current language
        function updateLanguage() {
            const t = translations[currentLang];
            
            // Update all elements with translations
            for (const [key, value] of Object.entries(t)) {
                const element = document.getElementById(key);
                if (element) {
                    element.textContent = value;
                }
            }
        }

        // Show setup section
        function showSetup() {
            setupSection.classList.remove('hidden');
            dashboardSection.classList.add('hidden');
        }

        // Show dashboard section
        function showDashboard() {
            setupSection.classList.add('hidden');
            dashboardSection.classList.remove('hidden');
        }

        // Save user data
        function saveUserData() {
            const type = trackerType.value;
            const date = selectedDate.value;
            const name = userName.value || 'User';
            
            if (!date) {
                alert(currentLang === 'en' ? 'Please select a date' : 'দয়া করে একটি তারিখ নির্বাচন করুন');
                return;
            }
            
            const userData = {
                type,
                date,
                name,
                createdAt: new Date().toISOString(),
                completedItems: []
            };
            
            localStorage.setItem('maternalChildHealthData', JSON.stringify(userData));
            
            showDashboard();
            generateTimeline(userData);
            updateProgress(userData);
            generateNotifications(userData);
            generateHealthTips();
        }

        // Reset all data
        function resetData() {
            if (confirm(translations[currentLang].resetConfirm)) {
                localStorage.removeItem('maternalChildHealthData');
                showSetup();
                alert(translations[currentLang].dataReset);
            }
        }

        // Generate timeline based on user data
        function generateTimeline(userData) {
            if (!userData) return;
            
            const timelineContainer = document.getElementById('timelineContainer');
            timelineContainer.innerHTML = '';
            
            const baseDate = new Date(userData.date);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            // Generate timeline items based on type
            let timelineItems = [];
            
            if (userData.type === 'pregnancy') {
                // Pregnancy timeline (ANC visits)
                timelineItems = [
                    { date: addDays(baseDate, -280), title: 'First ANC Visit', type: 'checkup', description: 'Initial pregnancy confirmation and baseline tests' },
                    { date: addDays(baseDate, -224), title: 'Second ANC Visit', type: 'checkup', description: 'Routine checkup and ultrasound' },
                    { date: addDays(baseDate, -168), title: 'Third ANC Visit', type: 'checkup', description: 'Blood tests and growth monitoring' },
                    { date: addDays(baseDate, -112), title: 'Fourth ANC Visit', type: 'checkup', description: 'Preparing for delivery' },
                    { date: addDays(baseDate, -84), title: 'Fifth ANC Visit', type: 'checkup', description: 'Final preparations and birth plan' },
                    { date: addDays(baseDate, -56), title: 'Sixth ANC Visit', type: 'checkup', description: 'Late pregnancy assessment' },
                    { date: addDays(baseDate, -28), title: 'Seventh ANC Visit', type: 'checkup', description: 'Pre-delivery checkup' },
                    { date: baseDate, title: 'Expected Delivery Date', type: 'reminder', description: 'Baby is due around this time' }
                ];
            } else {
                // Child timeline (Vaccinations based on Bangladesh EPI schedule)
                timelineItems = [
                    { date: addDays(baseDate, 0), title: 'BCG, OPV-0, Hep-B-Birth', type: 'vaccination', description: 'Birth doses of important vaccines' },
                    { date: addDays(baseDate, 42), title: 'OPV-1, Penta-1, PCV-1', type: 'vaccination', description: '6 weeks vaccination' },
                    { date: addDays(baseDate, 70), title: 'OPV-2, Penta-2, PCV-2', type: 'vaccination', description: '10 weeks vaccination' },
                    { date: addDays(baseDate, 98), title: 'OPV-3, Penta-3, PCV-3', type: 'vaccination', description: '14 weeks vaccination' },
                    { date: addDays(baseDate, 270), title: 'Measles-Rubella-1', type: 'vaccination', description: '9 months vaccination' },
                    { date: addDays(baseDate, 365), title: 'Measles-Rubella-2', type: 'vaccination', description: '15 months vaccination' },
                    { date: addDays(baseDate, 730), title: 'OPV Booster', type: 'vaccination', description: '2 years booster dose' }
                ];
            }
            
            // Sort timeline items by date
            timelineItems.sort((a, b) => a.date - b.date);
            
            // Create timeline elements
            timelineItems.forEach(item => {
                const itemDate = new Date(item.date);
                const daysDiff = Math.floor((itemDate - today) / (1000 * 60 * 60 * 24));
                
                let status = 'upcoming';
                let statusText = translations[currentLang].statusUpcoming;
                
                if (userData.completedItems.includes(item.title)) {
                    status = 'completed';
                    statusText = translations[currentLang].statusCompleted;
                } else if (daysDiff < 0 && !userData.completedItems.includes(item.title)) {
                    status = 'missed';
                    statusText = translations[currentLang].statusMissed;
                }
                
                const timelineItem = document.createElement('div');
                timelineItem.className = `timeline-item ${status}`;
                
                let dateText = formatDate(itemDate, currentLang);
                let relativeDate = '';
                
                if (daysDiff === 0) {
                    relativeDate = `• ${translations[currentLang].today}`;
                } else if (daysDiff > 0) {
                    relativeDate = `• ${daysDiff} ${translations[currentLang].daysLeft}`;
                } else {
                    relativeDate = `• ${Math.abs(daysDiff)} ${translations[currentLang].daysAgo}`;
                }
                
                timelineItem.innerHTML = `
                    <div class="timeline-date">
                        <i class="fas fa-calendar-day"></i>
                        ${dateText} ${relativeDate}
                    </div>
                    <div class="timeline-title">${item.title}</div>
                    <div class="timeline-desc">${item.description}</div>
                    <span class="timeline-status status-${status}">${statusText}</span>
                    ${status !== 'completed' ? 
                        `<button class="btn btn-success" onclick="markComplete('${item.title}')" style="margin-top: 10px;">
                            <i class="fas fa-check"></i>
                            ${translations[currentLang].markComplete}
                        </button>` :
                        `<button class="btn" onclick="markIncomplete('${item.title}')" style="margin-top: 10px;">
                            <i class="fas fa-undo"></i>
                            ${translations[currentLang].markIncomplete}
                        </button>`
                    }
                `;
                
                timelineContainer.appendChild(timelineItem);
            });
        }

        // Update progress
        function updateProgress(userData) {
            if (!userData) return;
            
            const baseDate = new Date(userData.date);
            const today = new Date();
            
            // Generate timeline items based on type
            let timelineItems = [];
            
            if (userData.type === 'pregnancy') {
                timelineItems = Array(8).fill(0); // 8 ANC visits
            } else {
                timelineItems = Array(7).fill(0); // 7 vaccinations
            }
            
            const totalItems = timelineItems.length;
            const completedItems = userData.completedItems.length;
            const progress = Math.round((completedItems / totalItems) * 100);
            
            // Update progress bar
            document.getElementById('progressFill').style.width = `${progress}%`;
            document.getElementById('progressValue').textContent = `${progress}%`;
            
            // Update stats
            document.getElementById('completedCount').textContent = completedItems;
            document.getElementById('upcomingCount').textContent = totalItems - completedItems;
            document.getElementById('missedCount').textContent = 0; // Simplified for this example
        }

        // Generate notifications
        function generateNotifications(userData) {
            if (!userData) return;
            
            const notificationsContainer = document.getElementById('notificationsContainer');
            notificationsContainer.innerHTML = '';
            
            const baseDate = new Date(userData.date);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            // Find next upcoming item
            let nextItem = null;
            let timelineItems = [];
            
            if (userData.type === 'pregnancy') {
                timelineItems = [
                    { date: addDays(baseDate, -280), title: 'First ANC Visit', type: 'checkup' },
                    { date: addDays(baseDate, -224), title: 'Second ANC Visit', type: 'checkup' },
                    { date: addDays(baseDate, -168), title: 'Third ANC Visit', type: 'checkup' },
                    { date: addDays(baseDate, -112), title: 'Fourth ANC Visit', type: 'checkup' },
                    { date: addDays(baseDate, -84), title: 'Fifth ANC Visit', type: 'checkup' },
                    { date: addDays(baseDate, -56), title: 'Sixth ANC Visit', type: 'checkup' },
                    { date: addDays(baseDate, -28), title: 'Seventh ANC Visit', type: 'checkup' },
                    { date: baseDate, title: 'Expected Delivery Date', type: 'reminder' }
                ];
            } else {
                timelineItems = [
                    { date: addDays(baseDate, 0), title: 'BCG, OPV-0, Hep-B-Birth', type: 'vaccination' },
                    { date: addDays(baseDate, 42), title: 'OPV-1, Penta-1, PCV-1', type: 'vaccination' },
                    { date: addDays(baseDate, 70), title: 'OPV-2, Penta-2, PCV-2', type: 'vaccination' },
                    { date: addDays(baseDate, 98), title: 'OPV-3, Penta-3, PCV-3', type: 'vaccination' },
                    { date: addDays(baseDate, 270), title: 'Measles-Rubella-1', type: 'vaccination' },
                    { date: addDays(baseDate, 365), title: 'Measles-Rubella-2', type: 'vaccination' },
                    { date: addDays(baseDate, 730), title: 'OPV Booster', type: 'vaccination' }
                ];
            }
            
            // Find the next incomplete item
            for (const item of timelineItems) {
                const itemDate = new Date(item.date);
                if (itemDate >= today && !userData.completedItems.includes(item.title)) {
                    nextItem = item;
                    break;
                }
            }
            
            if (nextItem) {
                const daysDiff = Math.floor((new Date(nextItem.date) - today) / (1000 * 60 * 60 * 24));
                let notificationText = '';
                
                if (daysDiff === 0) {
                    notificationText = currentLang === 'en' ? 'is scheduled for today' : 'আজকের জন্য নির্ধারিত';
                } else if (daysDiff === 1) {
                    notificationText = currentLang === 'en' ? 'is scheduled for tomorrow' : 'আগামীকালের জন্য নির্ধারিত';
                } else {
                    notificationText = `${translations[currentLang].notificationDesc} ${formatDate(new Date(nextItem.date), currentLang}`;
                }
                
                const notification = document.createElement('div');
                notification.className = 'notification-item';
                notification.innerHTML = `
                    <i class="fas fa-bell notification-icon"></i>
                    <div class="notification-content">
                        <div class="notification-title">${nextItem.title}</div>
                        <div class="notification-desc">${notificationText}</div>
                    </div>
                `;
                
                notificationsContainer.appendChild(notification);
            } else {
                const noNotification = document.createElement('div');
                noNotification.className = 'notification-item';
                noNotification.innerHTML = `
                    <i class="fas fa-info-circle notification-icon"></i>
                    <div class="notification-content">
                        <div class="notification-title">${translations[currentLang].noNotifications}</div>
                    </div>
                `;
                
                notificationsContainer.appendChild(noNotification);
            }
        }

        // Generate health tips
        function generateHealthTips() {
            const tipsContainer = document.getElementById('tipsContainer');
            tipsContainer.innerHTML = '';
            
            const tips = [
                { icon: 'fas fa-apple-alt', title: translations[currentLang].tip1Title, description: translations[currentLang].tip1Desc },
                { icon: 'fas fa-tint', title: translations[currentLang].tip2Title, description: translations[currentLang].tip2Desc },
                { icon: 'fas fa-bed', title: translations[currentLang].tip3Title, description: translations[currentLang].tip3Desc },
                { icon: 'fas fa-walking', title: translations[currentLang].tip4Title, description: translations[currentLang].tip4Desc }
            ];
            
            tips.forEach(tip => {
                const tipCard = document.createElement('div');
                tipCard.className = 'tip-card';
                tipCard.innerHTML = `
                    <i class="${tip.icon} tip-icon"></i>
                    <div class="tip-title">${tip.title}</div>
                    <div class="tip-desc">${tip.description}</div>
                `;
                
                tipsContainer.appendChild(tipCard);
            });
        }

        // Mark item as complete
        function markComplete(itemTitle) {
            const userData = JSON.parse(localStorage.getItem('maternalChildHealthData'));
            if (!userData.completedItems.includes(itemTitle)) {
                userData.completedItems.push(itemTitle);
                localStorage.setItem('maternalChildHealthData', JSON.stringify(userData));
                
                generateTimeline(userData);
                updateProgress(userData);
                generateNotifications(userData);
            }
        }

        // Mark item as incomplete
        function markIncomplete(itemTitle) {
            const userData = JSON.parse(localStorage.getItem('maternalChildHealthData'));
            const index = userData.completedItems.indexOf(itemTitle);
            if (index > -1) {
                userData.completedItems.splice(index, 1);
                localStorage.setItem('maternalChildHealthData', JSON.stringify(userData));
                
                generateTimeline(userData);
                updateProgress(userData);
                generateNotifications(userData);
            }
        }

        // Setup footer navigation
        function setupFooterNavigation() {
            const navItems = document.querySelectorAll('.nav-item');
            
            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all items
                    navItems.forEach(nav => nav.classList.remove('active'));
                    
                    // Add active class to clicked item
                    this.classList.add('active');
                    
                    // In a real app, you would show the corresponding tab content
                    // For this example, we'll just show an alert
                    const tab = this.getAttribute('data-tab');
                    alert(`${translations[currentLang][`nav${tab.charAt(0).toUpperCase() + tab.slice(1)}`]} ${currentLang === 'en' ? 'tab selected' : 'ট্যাব নির্বাচন করা হয়েছে'}`);
                });
            }); 
        }

        // Utility functions
        function addDays(date, days) {
            const result = new Date(date);
            result.setDate(result.getDate() + days);
            return result;
        }

        function formatDate(date, lang) {
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            return date.toLocaleDateString(lang === 'en' ? 'en-US' : 'bn-BD', options);
        }
    </script>
</body>
</html> 