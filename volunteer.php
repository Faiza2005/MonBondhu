<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Health Worker Directory</title>
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
            max-width: 1200px;
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

        /* Search and Filter Section */
        .search-section {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .search-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--light);
        }

        .search-icon {
            font-size: 1.5rem;
            color: var(--primary);
        }

        .search-title {
            font-size: 1.3rem;
            color: var(--primary);
            font-weight: 600;
        }

        .search-container {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .search-input {
            padding: 0.8rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(74, 111, 165, 0.2);
        }

        .search-btn {
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

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 126, 95, 0.4);
        }

        .filters-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-label {
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }

        .filter-select {
            padding: 0.8rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            background: white;
            transition: all 0.3s ease;
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(74, 111, 165, 0.2);
        }

        /* Results Section */
        .results-section {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .results-title {
            font-size: 1.3rem;
            color: var(--primary);
            font-weight: 600;
        }

        .results-count {
            color: var(--text);
            font-size: 0.9rem;
        }

        .view-toggle {
            display: flex;
            background: var(--light);
            border-radius: 10px;
            padding: 0.3rem;
        }

        .view-btn {
            background: none;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--text);
        }

        .view-btn.active {
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            color: var(--primary);
        }

        /* Worker Cards Grid */
        .workers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .worker-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .worker-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .worker-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 1.5rem;
            position: relative;
        }

        .worker-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 2rem;
            color: var(--primary);
        }

        .worker-name {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .worker-location {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .worker-body {
            padding: 1.5rem;
        }

        .worker-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .skill-tag {
            background: rgba(74, 111, 165, 0.1);
            color: var(--primary);
            padding: 0.3rem 0.7rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .worker-contact {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
            margin-bottom: 1rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
        }

        .contact-icon {
            color: var(--primary);
            width: 20px;
        }

        .worker-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            background: var(--light);
            border-top: 1px solid #e2e8f0;
        }

        .verification-badge {
            display: flex;
            align-items: center;
            gap: 5px;
            background: rgba(72, 187, 120, 0.1);
            color: var(--success);
            padding: 0.3rem 0.7rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .action-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .action-btn:hover {
            background: var(--secondary);
        }

        /* Worker List View */
        .workers-list {
            display: none;
            flex-direction: column;
            gap: 1rem;
        }

        .workers-list.active {
            display: flex;
        }

        .worker-list-item {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 1rem;
            align-items: center;
            background: white;
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .worker-list-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .list-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .list-details {
            display: flex;
            flex-direction: column;
        }

        .list-name {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.3rem;
        }

        .list-location {
            font-size: 0.9rem;
            color: var(--text);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .list-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.3rem;
        }

        .list-skill {
            background: rgba(74, 111, 165, 0.1);
            color: var(--primary);
            padding: 0.2rem 0.5rem;
            border-radius: 15px;
            font-size: 0.7rem;
        }

        .list-actions {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        /* Map View */
        .map-view {
            display: none;
            height: 400px;
            background: var(--light);
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .map-view.active {
            display: block;
        }

        .map-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: var(--text);
            text-align: center;
            padding: 2rem;
        }

        .map-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        /* Detail Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 15px;
            max-width: 600px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s ease;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 1.5rem;
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .modal-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 2.5rem;
            color: var(--primary);
        }

        .modal-name {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .modal-location {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 1rem;
            opacity: 0.9;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-section {
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.8rem;
            padding-bottom: 0.3rem;
            border-bottom: 1px solid var(--light);
        }

        .modal-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .modal-skill {
            background: rgba(74, 111, 165, 0.1);
            color: var(--primary);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .contact-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .contact-method {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 1rem;
            background: var(--light);
            border-radius: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .contact-method:hover {
            background: rgba(74, 111, 165, 0.1);
        }

        .contact-icon-lg {
            font-size: 1.5rem;
            color: var(--primary);
            width: 30px;
        }

        .contact-details {
            display: flex;
            flex-direction: column;
        }

        .contact-type {
            font-weight: 600;
            color: var(--dark);
        }

        .contact-value {
            font-size: 0.9rem;
            color: var(--text);
        }

        .availability {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.8rem 1rem;
            background: rgba(72, 187, 120, 0.1);
            border-radius: 10px;
            color: var(--success);
            font-weight: 500;
        }

        .availability.offline {
            background: rgba(245, 101, 101, 0.1);
            color: var(--danger);
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
            
            .search-container {
                grid-template-columns: 1fr;
            }
            
            .workers-grid {
                grid-template-columns: 1fr;
            }
            
            .worker-list-item {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }
            
            .list-actions {
                flex-direction: row;
                justify-content: flex-end;
            }
            
            .contact-methods {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-content">
            <div class="logo">
                <i class="fas fa-hands-helping logo-icon"></i>
                <h1 id="app-title">Volunteer Health Worker Directory</h1>
            </div>
            <button class="language-toggle" id="languageToggle">
                <i class="fas fa-language"></i>
                <span id="languageText">English</span>
            </button>
        </div>
    </header>

    <div class="container">
        <!-- Search and Filter Section -->
        <div class="search-section fade-in">
            <div class="search-header">
                <i class="fas fa-search search-icon"></i>
                <h2 class="search-title" id="search-title">Find a Health Worker</h2>
            </div>
            
            <div class="search-container">
                <input type="text" class="search-input" id="searchInput" placeholder="Search by name, skill, or location...">
                <button class="search-btn" id="searchBtn">
                    <i class="fas fa-search"></i>
                    <span id="search-text">Search</span>
                </button>
            </div>
            
            <div class="filters-container">
                <div class="filter-group">
                    <label class="filter-label" id="location-label">Location</label>
                    <select class="filter-select" id="locationFilter">
                        <option value="">All Locations</option>
                        <option value="dhaka">Dhaka Division</option>
                        <option value="chattogram">Chattogram Division</option>
                        <option value="rajshahi">Rajshahi Division</option>
                        <option value="khulna">Khulna Division</option>
                        <option value="barishal">Barishal Division</option>
                        <option value="sylhet">Sylhet Division</option>
                        <option value="rangpur">Rangpur Division</option>
                        <option value="mymensingh">Mymensingh Division</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label class="filter-label" id="skills-label">Skills</label>
                    <select class="filter-select" id="skillsFilter">
                        <option value="">All Skills</option>
                        <option value="first-aid">First Aid</option>
                        <option value="mental-health">Mental Health</option>
                        <option value="maternal-health">Maternal Health</option>
                        <option value="child-health">Child Health</option>
                        <option value="nutrition">Nutrition</option>
                        <option value="vaccination">Vaccination</option>
                        <option value="hygiene">Hygiene Education</option>
                        <option value="disease-prevention">Disease Prevention</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label class="filter-label" id="organization-label">Organization</label>
                    <select class="filter-select" id="organizationFilter">
                        <option value="">All Organizations</option>
                        <option value="brac">BRAC</option>
                        <option value="asa">ASA</option>
                        <option value="grameen">Grameen</option>
                        <option value="red-crescent">Bangladesh Red Crescent</option>
                        <option value="government">Government</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label class="filter-label" id="availability-label">Availability</label>
                    <select class="filter-select" id="availabilityFilter">
                        <option value="">Any Availability</option>
                        <option value="available">Available Now</option>
                        <option value="weekdays">Weekdays</option>
                        <option value="weekends">Weekends</option>
                        <option value="evenings">Evenings</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Results Section -->
        <div class="results-section fade-in">
            <div class="results-header">
                <div>
                    <h3 class="results-title" id="results-title">Health Workers</h3>
                    <div class="results-count" id="resultsCount">Showing 0 workers</div>
                </div>
                
                <div class="view-toggle">
                    <button class="view-btn active" data-view="grid">
                        <i class="fas fa-th"></i>
                    </button>
                    <button class="view-btn" data-view="list">
                        <i class="fas fa-list"></i>
                    </button>
                    <button class="view-btn" data-view="map">
                        <i class="fas fa-map"></i>
                    </button>
                </div>
            </div>
            
            <!-- Grid View -->
            <div class="workers-grid" id="gridView">
                <!-- Worker cards will be generated here -->
            </div>
            
            <!-- List View -->
            <div class="workers-list" id="listView">
                <!-- Worker list items will be generated here -->
            </div>
            
            <!-- Map View -->
            <div class="map-view" id="mapView">
                <div class="map-placeholder">
                    <i class="fas fa-map-marked-alt map-icon"></i>
                    <h3 id="map-title">Health Worker Map</h3>
                    <p id="map-description">Map view showing health worker locations would appear here in a full implementation.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal" id="detailModal">
        <div class="modal-content">
            <div class="modal-header">
                <button class="modal-close" id="modalClose">
                    <i class="fas fa-times"></i>
                </button>
                <div class="modal-avatar" id="modalAvatar">
                    <i class="fas fa-user-md"></i>
                </div>
                <h2 class="modal-name" id="modalName">Worker Name</h2>
                <div class="modal-location">
                    <i class="fas fa-map-marker-alt"></i>
                    <span id="modalLocation">Location</span>
                </div>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <h3 class="section-title" id="skills-title">Skills & Specializations</h3>
                    <div class="modal-skills" id="modalSkills">
                        <!-- Skills will be added here -->
                    </div>
                </div>
                
                <div class="modal-section">
                    <h3 class="section-title" id="contact-title">Contact Information</h3>
                    <div class="contact-methods" id="modalContact">
                        <!-- Contact methods will be added here -->
                    </div>
                </div>
                
                <div class="modal-section">
                    <h3 class="section-title" id="availability-title">Current Availability</h3>
                    <div class="availability" id="modalAvailability">
                        <i class="fas fa-circle"></i>
                        <span id="availability-text">Available Now</span>
                    </div>
                </div>
                
                <div class="modal-section">
                    <h3 class="section-title" id="verification-title">Verification</h3>
                    <div class="verification-badge">
                        <i class="fas fa-check-circle"></i>
                        <span id="verification-text">Verified by Organization</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Navigation -->
    <div class="footer-nav">
        <a href="#" class="nav-item active">
            <i class="fas fa-search nav-icon"></i>
            <span id="nav-search">Search</span>
        </a>
        <a href="#" class="nav-item">
            <i class="fas fa-map-marker-alt nav-icon"></i>
            <span id="nav-nearby">Nearby</span>
        </a>
        <a href="#" class="nav-item">
            <i class="fas fa-heart nav-icon"></i>
            <span id="nav-favorites">Favorites</span>
        </a>
        <a href="#" class="nav-item">
            <i class="fas fa-user nav-icon"></i>
            <span id="nav-profile">Profile</span>
        </a>
    </div>

    <script>
        // Language support
        const translations = {
            en: {
                appTitle: "Volunteer Health Worker Directory",
                languageText: "English",
                searchTitle: "Find a Health Worker",
                searchText: "Search",
                locationLabel: "Location",
                skillsLabel: "Skills",
                organizationLabel: "Organization",
                availabilityLabel: "Availability",
                resultsTitle: "Health Workers",
                mapTitle: "Health Worker Map",
                mapDescription: "Map view showing health worker locations would appear here in a full implementation.",
                navSearch: "Search",
                navNearby: "Nearby",
                navFavorites: "Favorites",
                navProfile: "Profile",
                skillsTitle: "Skills & Specializations",
                contactTitle: "Contact Information",
                availabilityTitle: "Current Availability",
                verificationTitle: "Verification",
                availabilityText: "Available Now",
                verificationText: "Verified by Organization",
                contactPhone: "Call",
                contactMessage: "Message",
                contactEmail: "Email",
                viewProfile: "View Profile",
                yearsExperience: "years experience",
                available: "Available",
                busy: "Busy",
                offline: "Offline"
            },
            bn: {
                appTitle: "স্বেচ্ছাসেবক স্বাস্থ্যকর্মী ডিরেক্টরি",
                languageText: "বাংলা",
                searchTitle: "একজন স্বাস্থ্যকর্মী খুঁজুন",
                searchText: "খুঁজুন",
                locationLabel: "অবস্থান",
                skillsLabel: "দক্ষতা",
                organizationLabel: "সংস্থা",
                availabilityLabel: "উপলব্ধতা",
                resultsTitle: "স্বাস্থ্যকর্মী",
                mapTitle: "স্বাস্থ্যকর্মী ম্যাপ",
                mapDescription: "স্বাস্থ্যকর্মীদের অবস্থান দেখানো ম্যাপ ভিউ একটি সম্পূর্ণ বাস্তবায়নে এখানে উপস্থিত হবে।",
                navSearch: "খুঁজুন",
                navNearby: "কাছাকাছি",
                navFavorites: "প্রিয়",
                navProfile: "প্রোফাইল",
                skillsTitle: "দক্ষতা ও বিশেষীকরণ",
                contactTitle: "যোগাযোগের তথ্য",
                availabilityTitle: "বর্তমান উপলব্ধতা",
                verificationTitle: "যাচাইকরণ",
                availabilityText: "এখনই উপলব্ধ",
                verificationText: "সংস্থা দ্বারা যাচাইকৃত",
                contactPhone: "কল করুন",
                contactMessage: "বার্তা",
                contactEmail: "ইমেল",
                viewProfile: "প্রোফাইল দেখুন",
                yearsExperience: "বছরের অভিজ্ঞতা",
                available: "উপলব্ধ",
                busy: "ব্যস্ত",
                offline: "অফলাইন"
            }
        };

        // Sample worker data
        const workerData = [
            {
                id: 1,
                name: "Fatema Begum",
                location: "Dhaka Division",
                village: "Savar",
                skills: ["First Aid", "Maternal Health", "Child Health"],
                organization: "brac",
                experience: 5,
                contact: {
                    phone: "+880 1234 567890",
                    message: "+880 1234 567890",
                    email: "fatema@example.com"
                },
                availability: "available",
                verified: true
            },
            {
                id: 2,
                name: "Abdul Karim",
                location: "Chattogram Division", 
                village: "Cox's Bazar",
                skills: ["Mental Health", "First Aid", "Hygiene Education"],
                organization: "red-crescent",
                experience: 3,
                contact: {
                    phone: "+880 1987 654321",
                    message: "+880 1987 654321"
                },
                availability: "weekdays",
                verified: true
            },
            {
                id: 3,
                name: "Rina Akter",
                location: "Rajshahi Division",
                village: "Bogra",
                skills: ["Nutrition", "Child Health", "Vaccination"],
                organization: "asa",
                experience: 7,
                contact: {
                    phone: "+880 1678 543210",
                    email: "rina@example.com"
                },
                availability: "weekends",
                verified: true
            },
            {
                id: 4,
                name: "Mohammad Ali",
                location: "Khulna Division",
                village: "Khulna City",
                skills: ["Disease Prevention", "First Aid", "Mental Health"],
                organization: "government",
                experience: 4,
                contact: {
                    phone: "+880 1456 789012",
                    message: "+880 1456 789012"
                },
                availability: "evenings",
                verified: true
            },
            {
                id: 5,
                name: "Sultana Jahan",
                location: "Sylhet Division",
                village: "Sylhet City",
                skills: ["Maternal Health", "Nutrition", "Hygiene Education"],
                organization: "brac",
                experience: 6,
                contact: {
                    phone: "+880 1324 567890",
                    email: "sultana@example.com"
                },
                availability: "available",
                verified: true
            },
            {
                id: 6,
                name: "Rahim Uddin",
                location: "Rangpur Division",
                village: "Rangpur City",
                skills: ["First Aid", "Vaccination", "Disease Prevention"],
                organization: "grameen",
                experience: 2,
                contact: {
                    phone: "+880 1765 432109",
                    message: "+880 1765 432109"
                },
                availability: "weekdays",
                verified: true
            }
        ];

        // Organization names
        const organizations = {
            'brac': 'BRAC',
            'asa': 'ASA',
            'grameen': 'Grameen',
            'red-crescent': 'Bangladesh Red Crescent', 
            'government': 'Government',
            'other': 'Other'
        };

        // Current language
        let currentLang = 'en';

        // DOM Elements
        const languageToggle = document.getElementById('languageToggle');
        const searchInput = document.getElementById('searchInput');
        const searchBtn = document.getElementById('searchBtn');
        const locationFilter = document.getElementById('locationFilter');
        const skillsFilter = document.getElementById('skillsFilter');
        const organizationFilter = document.getElementById('organizationFilter');
        const availabilityFilter = document.getElementById('availabilityFilter');
        const gridView = document.getElementById('gridView');
        const listView = document.getElementById('listView');
        const mapView = document.getElementById('mapView');
        const viewButtons = document.querySelectorAll('.view-btn');
        const resultsCount = document.getElementById('resultsCount');
        const detailModal = document.getElementById('detailModal');
        const modalClose = document.getElementById('modalClose');

        // Initialize the app
        document.addEventListener('DOMContentLoaded', function() {
            // Set up language toggle
            languageToggle.addEventListener('click', toggleLanguage);

            // Set up search and filters
            searchBtn.addEventListener('click', filterWorkers);
            searchInput.addEventListener('input', filterWorkers);
            locationFilter.addEventListener('change', filterWorkers);
            skillsFilter.addEventListener('change', filterWorkers);
            organizationFilter.addEventListener('change', filterWorkers);
            availabilityFilter.addEventListener('change', filterWorkers);

            // Set up view toggle
            viewButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const view = this.getAttribute('data-view');
                    switchView(view);
                    
                    // Update active button
                    viewButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Set up modal close
            modalClose.addEventListener('click', closeModal);

            // Initial render
            filterWorkers();
            
            // Set up footer navigation
            setupFooterNavigation();
        });

        // Toggle language function
        function toggleLanguage() {
            currentLang = currentLang === 'en' ? 'bn' : 'en';
            updateLanguage();
            filterWorkers(); // Re-render with new language
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
            
            languageText.textContent = currentLang === 'en' ? 'English' : 'বাংলা';
        }

        // Filter workers based on search and filters
        function filterWorkers() {
            const searchTerm = searchInput.value.toLowerCase();
            const location = locationFilter.value;
            const skill = skillsFilter.value;
            const organization = organizationFilter.value;
            const availability = availabilityFilter.value;
            
            const filteredWorkers = workerData.filter(worker => {
                // Search term filter
                if (searchTerm && !(
                    worker.name.toLowerCase().includes(searchTerm) ||
                    worker.location.toLowerCase().includes(searchTerm) ||
                    worker.village.toLowerCase().includes(searchTerm) ||
                    worker.skills.some(s => s.toLowerCase().includes(searchTerm))
                )) {
                    return false;
                }
                
                // Location filter
                if (location && worker.location.toLowerCase() !== location) {
                    return false;
                }
                
                // Skills filter
                if (skill && !worker.skills.some(s => s.toLowerCase().includes(skill))) {
                    return false;
                }
                
                // Organization filter
                if (organization && worker.organization !== organization) {
                    return false;
                }
                
                // Availability filter
                if (availability) {
                    if (availability === 'available' && worker.availability !== 'available') {
                        return false;
                    }
                    if (availability === 'weekdays' && worker.availability !== 'weekdays') {
                        return false;
                    }
                    if (availability === 'weekends' && worker.availability !== 'weekends') {
                        return false;
                    }
                    if (availability === 'evenings' && worker.availability !== 'evenings') {
                        return false;
                    }
                }
                
                return true;
            });
            
            renderWorkers(filteredWorkers);
        }

        // Render workers in current view
        function renderWorkers(workers) {
            const t = translations[currentLang];
            resultsCount.textContent = `${t.resultsTitle}: ${workers.length} ${workers.length === 1 ? 'worker' : 'workers'} found`;
            
            // Clear current views
            gridView.innerHTML = '';
            listView.innerHTML = '';
            
            // Render grid view
            workers.forEach(worker => {
                const card = createWorkerCard(worker);
                gridView.appendChild(card);
            });
            
            // Render list view
            workers.forEach(worker => {
                const listItem = createWorkerListItem(worker);
                listView.appendChild(listItem);
            });
        }

        // Create worker card for grid view
        function createWorkerCard(worker) {
            const t = translations[currentLang];
            const card = document.createElement('div');
            card.className = 'worker-card';
            card.addEventListener('click', () => openModal(worker));
            
            let availabilityClass = '';
            let availabilityText = '';
            
            if (worker.availability === 'available') {
                availabilityClass = 'availability';
                availabilityText = t.available;
            } else {
                availabilityClass = 'availability offline';
                availabilityText = t.busy;
            }
            
            card.innerHTML = `
                <div class="worker-header">
                    <div class="worker-avatar">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h3 class="worker-name">${worker.name}</h3>
                    <div class="worker-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>${worker.village}, ${worker.location}</span>
                    </div>
                </div>
                <div class="worker-body">
                    <div class="worker-skills">
                        ${worker.skills.map(skill => `<span class="skill-tag">${skill}</span>`).join('')}
                    </div>
                    <div class="worker-contact">
                        ${worker.contact.phone ? `
                            <div class="contact-item">
                                <i class="fas fa-phone contact-icon"></i>
                                <span>${worker.contact.phone}</span>
                            </div>
                        ` : ''}
                        ${worker.contact.message ? `
                            <div class="contact-item">
                                <i class="fas fa-comment contact-icon"></i>
                                <span>${worker.contact.message}</span>
                            </div>
                        ` : ''}
                        ${worker.contact.email ? `
                            <div class="contact-item">
                                <i class="fas fa-envelope contact-icon"></i>
                                <span>${worker.contact.email}</span>
                            </div>
                        ` : ''}
                    </div>
                    <div class="${availabilityClass}">
                        <i class="fas fa-circle"></i>
                        <span>${availabilityText}</span>
                    </div>
                </div>
                <div class="worker-footer">
                    <div class="verification-badge">
                        <i class="fas fa-check-circle"></i>
                        <span>Verified by ${organizations[worker.organization]}</span>
                    </div>
                    <button class="action-btn">
                        <i class="fas fa-eye"></i>
                        <span>${t.viewProfile}</span>
                    </button>
                </div>
            `;
            
            return card;
        }

        // Create worker list item for list view
        function createWorkerListItem(worker) {
            const t = translations[currentLang];
            const listItem = document.createElement('div');
            listItem.className = 'worker-list-item';
            listItem.addEventListener('click', () => openModal(worker));
            
            let availabilityClass = '';
            let availabilityText = '';
            
            if (worker.availability === 'available') {
                availabilityClass = 'availability';
                availabilityText = t.available;
            } else {
                availabilityClass = 'availability offline';
                availabilityText = t.busy;
            }
            
            listItem.innerHTML = `
                <div class="list-avatar">
                    <i class="fas fa-user-md"></i>
                </div>
                <div class="list-details">
                    <div class="list-name">${worker.name}</div>
                    <div class="list-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>${worker.village}, ${worker.location}</span>
                    </div>
                    <div class="list-skills">
                        ${worker.skills.map(skill => `<span class="list-skill">${skill}</span>`).join('')}
                    </div>
                </div>
                <div class="list-actions">
                    <div class="${availabilityClass}">
                        <i class="fas fa-circle"></i>
                        <span>${availabilityText}</span>
                    </div>
                    <button class="action-btn">
                        <i class="fas fa-eye"></i>
                        <span>${t.viewProfile}</span>
                    </button>
                </div>
            `;
            
            return listItem;
        }

        // Switch between grid, list, and map views
        function switchView(view) {
            gridView.style.display = view === 'grid' ? 'grid' : 'none';
            listView.style.display = view === 'list' ? 'flex' : 'none';
            listView.classList.toggle('active', view === 'list');
            mapView.style.display = view === 'map' ? 'block' : 'none';
            mapView.classList.toggle('active', view === 'map');
        }

        // Open worker detail modal
        function openModal(worker) {
            const t = translations[currentLang];
            
            // Set modal content
            document.getElementById('modalAvatar').innerHTML = `<i class="fas fa-user-md"></i>`;
            document.getElementById('modalName').textContent = worker.name;
            document.getElementById('modalLocation').textContent = `${worker.village}, ${worker.location}`;
            
            // Set skills
            const skillsContainer = document.getElementById('modalSkills');
            skillsContainer.innerHTML = '';
            worker.skills.forEach(skill => {
                const skillEl = document.createElement('span');
                skillEl.className = 'modal-skill';
                skillEl.textContent = skill;
                skillsContainer.appendChild(skillEl);
            });
            
            // Set contact methods
            const contactContainer = document.getElementById('modalContact');
            contactContainer.innerHTML = '';
            
            if (worker.contact.phone) {
                const contactEl = document.createElement('div');
                contactEl.className = 'contact-method';
                contactEl.innerHTML = `
                    <i class="fas fa-phone contact-icon-lg"></i>
                    <div class="contact-details">
                        <div class="contact-type">${t.contactPhone}</div>
                        <div class="contact-value">${worker.contact.phone}</div>
                    </div>
                `;
                contactContainer.appendChild(contactEl);
            }
            
            if (worker.contact.message) {
                const contactEl = document.createElement('div');
                contactEl.className = 'contact-method';
                contactEl.innerHTML = `
                    <i class="fas fa-comment contact-icon-lg"></i>
                    <div class="contact-details">
                        <div class="contact-type">${t.contactMessage}</div>
                        <div class="contact-value">${worker.contact.message}</div>
                    </div>
                `;
                contactContainer.appendChild(contactEl);
            }
            
            if (worker.contact.email) {
                const contactEl = document.createElement('div');
                contactEl.className = 'contact-method';
                contactEl.innerHTML = `
                    <i class="fas fa-envelope contact-icon-lg"></i>
                    <div class="contact-details">
                        <div class="contact-type">${t.contactEmail}</div>
                        <div class="contact-value">${worker.contact.email}</div>
                    </div>
                `;
                contactContainer.appendChild(contactEl);
            }
            
            // Set availability
            const availabilityEl = document.getElementById('modalAvailability');
            const availabilityTextEl = document.getElementById('availability-text');
            
            if (worker.availability === 'available') {
                availabilityEl.className = 'availability';
                availabilityTextEl.textContent = t.available;
            } else {
                availabilityEl.className = 'availability offline';
                availabilityTextEl.textContent = t.busy;
            }
            
            // Set verification
            document.getElementById('verification-text').textContent = `Verified by ${organizations[worker.organization]}`;
            
            // Show modal
            detailModal.classList.add('active');
        }

        // Close modal
        function closeModal() {
            detailModal.classList.remove('active');
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
                    const tabText = this.querySelector('span').textContent;
                    alert(`${currentLang === 'en' ? 'Navigating to' : 'নেভিগেট করা হচ্ছে'} ${tabText}`);
                });
            });
        }
    </script>
</body>
</html> 