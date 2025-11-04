<?php
session_start();
$site_name = "MonBondhu";
$page_title = "স্বাস্থ্য সুবিধা মানচিত্র";
$current_year = date("Y");

// Sample health facilities data
$health_facilities = [
    [
        'id' => 1,
        'name' => 'চর কলাপাড়া কমিউনিটি ক্লিনিক',
        'type' => 'clinic',
        'upazila' => 'কলাপাড়া',
        'union' => 'চর কলাপাড়া',
        'landmark' => 'বড় বটগাছের পাশে',
        'lat' => 21.9833,
        'lng' => 90.2167,
        'transport' => '⛵ নৌকা যোগে যাওয়া যায়',
        'contact' => '01712345678',
        'hours' => 'সকাল ৯টা - বিকাল ৫টা'
    ],
    [
        'id' => 2,
        'name' => 'সদর হাসপাতাল',
        'type' => 'hospital',
        'upazila' => 'পটুয়াখালী সদর',
        'union' => 'পটুয়াখালী',
        'landmark' => 'জেলা সদর সংলগ্ন',
        'lat' => 22.3592,
        'lng' => 90.3375,
        'transport' => '🚌 প্রতি ঘন্টায় বাস available',
        'contact' => '01712345679',
        'hours' => '২৪ ঘন্টা'
    ],
    [
        'id' => 3,
        'name' => 'আমিনা ফার্মেসি',
        'type' => 'pharmacy',
        'upazila' => 'কলাপাড়া',
        'union' => 'চর কলাপাড়া',
        'landmark' => 'বাজারের ভিতরে',
        'lat' => 21.9867,
        'lng' => 90.2200,
        'transport' => '⛵ নৌকা যোগে যাওয়া যায়',
        'contact' => '01712345680',
        'hours' => 'সকাল ৮টা - রাত ১০টা'
    ],
    [
        'id' => 4,
        'name' => 'ডাঃ রহমান (সিএইচডব্লিউ)',
        'type' => 'chw',
        'upazila' => 'কলাপাড়া',
        'union' => 'চর কলাপাড়া',
        'landmark' => 'গ্রামের মসজিদ সংলগ্ন',
        'lat' => 21.9845,
        'lng' => 90.2189,
        'transport' => '🚶‍♂️ হেঁটে যাওয়া যায়',
        'contact' => '01712345681',
        'hours' => 'সকাল ১০টা - সন্ধ্যা ৬টা'
    ],
    [
        'id' => 5,
        'name' => 'মোঃ করিম (যুব নেতা)',
        'type' => 'youth_leader',
        'upazila' => 'কলাপাড়া',
        'union' => 'চর কলাপাড়া',
        'landmark' => 'যুব ক্লাবের পাশে',
        'lat' => 21.9850,
        'lng' => 90.2195,
        'transport' => '🚶‍♂️ হেঁটে যাওয়া যায়',
        'contact' => '01712345682',
        'hours' => 'সন্ধ্যা ৬টা - রাত ৯টা'
    ],
    [
        'id' => 6,
        'name' => 'বেগমা কমিউনিটি ক্লিনিক',
        'type' => 'clinic',
        'upazila' => 'বাউফল',
        'union' => 'বেগমগঞ্জ',
        'landmark' => 'প্রাথমিক বিদ্যালয় সংলগ্ন',
        'lat' => 22.4000,
        'lng' => 90.5000,
        'transport' => '🚌 প্রতি ২ ঘন্টায় বাস',
        'contact' => '01712345683',
        'hours' => 'সকাল ৯টা - বিকাল ৪টা'
    ]
];

// Function to get facilities by upazila
function getFacilitiesByUpazila($facilities, $upazila) {
    return array_filter($facilities, function($facility) use ($upazila) {
        return $facility['upazila'] === $upazila;
    });
}

// Function to get unique upazilas
function getUniqueUpazilas($facilities) {
    $upazilas = array_unique(array_column($facilities, 'upazila'));
    sort($upazilas);
    return $upazilas;
}

// Get type name in Bengali
function getTypeName($type) {
    $types = [
        'clinic' => 'ক্লিনিক',
        'hospital' => 'হাসপাতাল',
        'pharmacy' => 'ফার্মেসি',
        'chw' => 'কমিউনিটি স্বাস্থ্যকর্মী',
        'youth_leader' => 'যুব নেতা',
        'teacher' => 'শিক্ষক'
    ];
    return $types[$type] ?? $type;
}

// Get type icon
function getTypeIcon($type) {
    $icons = [
        'clinic' => '🏥',
        'hospital' => '🏨',
        'pharmacy' => '💊',
        'chw' => '👨‍⚕️',
        'youth_leader' => '👨‍💼',
        'teacher' => '👨‍🏫'
    ];
    return $icons[$type] ?? '📍';
}

// Check if online (simulated - in real app, you'd check navigator.onLine)
$is_online = true; // This would be determined by JavaScript in real implementation
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - <?php echo $site_name; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        :root {
            --primary: #2E8B57;
            --secondary: #4ECDC4;
            --accent: #FF6B6B;
            --light: #F7FFF7;
            --dark: #1A535C;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', 'Nirmala UI', 'Kalpurush', sans-serif;
        }

        body {
            background: #f8f9fa;
            color: #333;
        }

        .navbar {
            background: linear-gradient(120deg, var(--primary), var(--secondary));
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .logo {
            font-weight: 700;
            font-size: 1.5rem;
            color: white;
        }

        .logo span {
            color: #FFD700;
        }

        .container-main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .view-toggle {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .view-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            margin-right: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .view-btn.active {
            background: var(--primary);
            color: white;
        }

        .status-indicator {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            margin-left: 10px;
        }

        .online {
            background: #d4edda;
            color: #155724;
        }

        .offline {
            background: #f8d7da;
            color: #721c24;
        }

        /* Map Styles */
        #map-container {
            display: none;
            height: 600px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        #map {
            height: 100%;
            width: 100%;
        }

        /* List Styles */
        #list-container {
            display: none;
        }

        .search-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .upazila-section {
            background: white;
            border-radius: 10px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .upazila-header {
            background: linear-gradient(120deg, var(--primary), var(--secondary));
            color: white;
            padding: 15px 20px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .upazila-content {
            display: none;
            padding: 0;
        }

        .upazila-content.show {
            display: block;
        }

        .facility-item {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            transition: background 0.3s ease;
        }

        .facility-item:hover {
            background: #f8f9fa;
        }

        .facility-item:last-child {
            border-bottom: none;
        }

        .facility-icon {
            font-size: 1.5rem;
            margin-right: 15px;
        }

        .facility-name {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .facility-location {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .facility-transport {
            color: var(--primary);
            font-size: 0.85rem;
            margin-bottom: 5px;
        }

        .facility-contact {
            color: #666;
            font-size: 0.85rem;
        }

        .transport-bus {
            color: #28a745;
        }

        .transport-boat {
            color: #007bff;
        }

        .transport-walk {
            color: #6c757d;
        }

        /* Facility type colors */
        .clinic { border-left: 4px solid #28a745; }
        .hospital { border-left: 4px solid #dc3545; }
        .pharmacy { border-left: 4px solid #ffc107; }
        .chw { border-left: 4px solid #17a2b8; }
        .youth_leader { border-left: 4px solid #6f42c1; }
        .teacher { border-left: 4px solid #fd7e14; }

        @media (max-width: 768px) {
            .container-main {
                padding: 10px;
            }
            
            #map-container {
                height: 400px;
            }
            
            .view-btn {
                padding: 8px 15px;
                font-size: 0.9rem;
            }
        }

        .no-results {
            text-align: center;
            padding: 40px;
            color: #666;
        }

        .facility-details {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
            display: none;
        }

        .facility-details.show {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand logo" href="index.php">মন<span>বন্ধু</span></a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link text-white" href="index.php"><i class="fas fa-home me-1"></i> হোম</a>
                <a class="nav-link text-white" href="dashboard.php"><i class="fas fa-tachometer-alt me-1"></i> ড্যাশবোর্ড</a>
            </div>
        </div>
    </nav>

    <div class="container-main">
        <div class="view-toggle">
            <h4 class="mb-3">স্বাস্থ্য সুবিধা মানচিত্র</h4>
            <div class="d-flex align-items-center">
                <button id="map-btn" class="view-btn active">
                    <i class="fas fa-map-marked-alt me-2"></i>মানচিত্র
                </button>
                <button id="list-btn" class="view-btn">
                    <i class="fas fa-list me-2"></i>তালিকা
                </button>
                <div id="status-indicator" class="status-indicator online">
                    <i class="fas fa-wifi me-1"></i>অনলাইন
                </div>
            </div>
        </div>

        <!-- Map View -->
        <div id="map-container">
            <div id="map"></div>
        </div>

        <!-- List View -->
        <div id="list-container">
            <div class="search-box">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" id="search-input" class="form-control" placeholder="উপজেলা, ইউনিয়ন বা স্থানের নাম লিখুন...">
                    </div>
                    <div class="col-md-4">
                        <select id="type-filter" class="form-control">
                            <option value="">সব ধরনের সুবিধা</option>
                            <option value="clinic">ক্লিনিক</option>
                            <option value="hospital">হাসপাতাল</option>
                            <option value="pharmacy">ফার্মেসি</option>
                            <option value="chw">স্বাস্থ্যকর্মী</option>
                            <option value="youth_leader">যুব নেতা</option>
                            <option value="teacher">শিক্ষক</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button id="search-btn" class="btn btn-primary w-100">
                            <i class="fas fa-search me-1"></i>খুঁজুন
                        </button>
                    </div>
                </div>
            </div>

            <div id="facilities-list">
                <?php
                $upazilas = getUniqueUpazilas($health_facilities);
                foreach ($upazilas as $upazila):
                    $facilities = getFacilitiesByUpazila($health_facilities, $upazila);
                ?>
                <div class="upazila-section">
                    <div class="upazila-header" onclick="toggleUpazila('<?php echo $upazila; ?>')">
                        <h5 class="mb-0"><?php echo $upazila; ?> উপজেলা</h5>
                        <span>
                            <i class="fas fa-chevron-down"></i>
                            <span class="badge bg-light text-dark"><?php echo count($facilities); ?>টি সুবিধা</span>
                        </span>
                    </div>
                    <div class="upazila-content" id="upazila-<?php echo $upazila; ?>">
                        <?php foreach ($facilities as $facility): ?>
                        <div class="facility-item <?php echo $facility['type']; ?>" data-type="<?php echo $facility['type']; ?>">
                            <div class="d-flex align-items-start">
                                <div class="facility-icon">
                                    <?php echo getTypeIcon($facility['type']); ?>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="facility-name"><?php echo $facility['name']; ?></div>
                                    <div class="facility-location">
                                        <?php echo $facility['union']; ?> ইউনিয়ন, <?php echo $facility['landmark']; ?>
                                    </div>
                                    <div class="facility-transport">
                                        <?php 
                                        $transport_class = '';
                                        if (strpos($facility['transport'], '🚌') !== false) {
                                            $transport_class = 'transport-bus';
                                        } elseif (strpos($facility['transport'], '⛵') !== false) {
                                            $transport_class = 'transport-boat';
                                        } elseif (strpos($facility['transport'], '🚶') !== false) {
                                            $transport_class = 'transport-walk';
                                        }
                                        ?>
                                        <span class="<?php echo $transport_class; ?>">
                                            <i class="fas fa-info-circle me-1"></i><?php echo $facility['transport']; ?>
                                        </span>
                                    </div>
                                    <div class="facility-contact">
                                        <i class="fas fa-phone me-1"></i><?php echo $facility['contact']; ?> | 
                                        <i class="fas fa-clock me-1"></i><?php echo $facility['hours']; ?>
                                    </div>
                                    <button class="btn btn-sm btn-outline-primary mt-2" onclick="toggleDetails(<?php echo $facility['id']; ?>)">
                                        বিস্তারিত দেখুন
                                    </button>
                                    <div class="facility-details" id="details-<?php echo $facility['id']; ?>">
                                        <strong>সুবিধার ধরন:</strong> <?php echo getTypeName($facility['type']); ?><br>
                                        <strong>যোগাযোগ:</strong> <?php echo $facility['contact']; ?><br>
                                        <strong>খোলার সময়:</strong> <?php echo $facility['hours']; ?><br>
                                        <strong>পরিবহন:</strong> <?php echo $facility['transport']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
           &copy; 2025 MonBondhu . All rights reserved.
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Health facilities data from PHP
        const healthFacilities = <?php echo json_encode($health_facilities); ?>;
        
        // View toggle functionality
        const mapBtn = document.getElementById('map-btn');
        const listBtn = document.getElementById('list-btn');
        const mapContainer = document.getElementById('map-container');
        const listContainer = document.getElementById('list-container');
        const statusIndicator = document.getElementById('status-indicator');

        // Initialize with map view
        mapContainer.style.display = 'block';
        listContainer.style.display = 'none';

        // Check online status (simulated)
        function checkOnlineStatus() {
            // In real implementation, use: const isOnline = navigator.onLine;
            const isOnline = true; // Simulating online for demo
            
            if (isOnline) {
                statusIndicator.className = 'status-indicator online';
                statusIndicator.innerHTML = '<i class="fas fa-wifi me-1"></i>অনলাইন';
                initializeMap();
            } else {
                statusIndicator.className = 'status-indicator offline';
                statusIndicator.innerHTML = '<i class="fas fa-wifi-slash me-1"></i>অফলাইন';
                // Force list view when offline
                showListView();
                mapBtn.classList.remove('active');
                listBtn.classList.add('active');
            }
        }

        function showMapView() {
            mapContainer.style.display = 'block';
            listContainer.style.display = 'none';
            mapBtn.classList.add('active');
            listBtn.classList.remove('active');
            initializeMap();
        }

        function showListView() {
            mapContainer.style.display = 'none';
            listContainer.style.display = 'block';
            mapBtn.classList.remove('active');
            listBtn.classList.add('active');
        }

        mapBtn.addEventListener('click', showMapView);
        listBtn.addEventListener('click', showListView);

        // Map initialization
        let map;
        function initializeMap() {
            if (map) {
                map.remove();
            }
            
            map = L.map('map').setView([22.3569, 91.7832], 10); // Centered on Bangladesh
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Add markers for each facility
            healthFacilities.forEach(facility => {
                const icon = L.divIcon({
                    html: getTypeIcon(facility.type),
                    className: 'custom-div-icon',
                    iconSize: [30, 30]
                });

                const marker = L.marker([facility.lat, facility.lng], { icon: icon }).addTo(map);
                
                const popupContent = `
                    <div class="p-2">
                        <h6>${facility.name}</h6>
                        <p class="mb-1"><strong>ধরন:</strong> ${getTypeName(facility.type)}</p>
                        <p class="mb-1"><strong>অবস্থান:</strong> ${facility.union}, ${facility.upazila}</p>
                        <p class="mb-1"><strong>ল্যান্ডমার্ক:</strong> ${facility.landmark}</p>
                        <p class="mb-1"><strong>পরিবহন:</strong> ${facility.transport}</p>
                        <p class="mb-1"><strong>যোগাযোগ:</strong> ${facility.contact}</p>
                        <p class="mb-0"><strong>সময়:</strong> ${facility.hours}</p>
                    </div>
                `;
                
                marker.bindPopup(popupContent);
            });
        }

        // Helper function to get type name
        function getTypeName(type) {
            const types = {
                'clinic': 'ক্লিনিক',
                'hospital': 'হাসপাতাল',
                'pharmacy': 'ফার্মেসি',
                'chw': 'কমিউনিটি স্বাস্থ্যকর্মী',
                'youth_leader': 'যুব নেতা',
                'teacher': 'শিক্ষক'
            };
            return types[type] || type;
        }

        // Helper function to get type icon
        function getTypeIcon(type) {
            const icons = {
                'clinic': '🏥',
                'hospital': '🏨',
                'pharmacy': '💊',
                'chw': '👨‍⚕️',
                'youth_leader': '👨‍💼',
                'teacher': '👨‍🏫'
            };
            return icons[type] || '📍';
        }

        // List view functionality
        function toggleUpazila(upazila) {
            const content = document.getElementById(`upazila-${upazila}`);
            content.classList.toggle('show');
        }

        function toggleDetails(id) {
            const details = document.getElementById(`details-${id}`);
            details.classList.toggle('show');
        }

        // Search functionality
        document.getElementById('search-btn').addEventListener('click', performSearch);
        document.getElementById('search-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        function performSearch() {
            const searchTerm = document.getElementById('search-input').value.toLowerCase();
            const typeFilter = document.getElementById('type-filter').value;
            
            const facilities = document.querySelectorAll('.facility-item');
            let hasResults = false;
            
            facilities.forEach(facility => {
                const facilityType = facility.getAttribute('data-type');
                const facilityText = facility.textContent.toLowerCase();
                
                const matchesSearch = searchTerm === '' || facilityText.includes(searchTerm);
                const matchesType = typeFilter === '' || facilityType === typeFilter;
                
                if (matchesSearch && matchesType) {
                    facility.style.display = 'flex';
                    hasResults = true;
                    
                    // Show parent upazila
                    const upazilaContent = facility.closest('.upazila-content');
                    if (upazilaContent) {
                        upazilaContent.classList.add('show');
                        const upazilaHeader = upazilaContent.previousElementSibling;
                        if (upazilaHeader) {
                            upazilaHeader.style.display = 'flex';
                        }
                    }
                } else {
                    facility.style.display = 'none';
                }
            });
            
            // Hide empty upazilas
            document.querySelectorAll('.upazila-content').forEach(content => {
                const visibleFacilities = content.querySelectorAll('.facility-item[style=""]');
                if (visibleFacilities.length === 0) {
                    content.style.display = 'none';
                    const header = content.previousElementSibling;
                    if (header) {
                        header.style.display = 'none';
                    }
                } else {
                    content.style.display = 'block';
                    const header = content.previousElementSibling;
                    if (header) {
                        header.style.display = 'flex';
                    }
                }
            });
            
            // Show no results message if needed
            const noResults = document.getElementById('no-results');
            if (!hasResults) {
                if (!noResults) {
                    const noResultsDiv = document.createElement('div');
                    noResultsDiv.id = 'no-results';
                    noResultsDiv.className = 'no-results';
                    noResultsDiv.innerHTML = `
                        <i class="fas fa-search fa-3x mb-3 text-muted"></i>
                        <h5>কোন ফলাফল পাওয়া যায়নি</h5>
                        <p>অনুগ্রহ করে অন্য শব্দ দিয়ে আবার চেষ্টা করুন</p>
                    `;
                    document.getElementById('facilities-list').appendChild(noResultsDiv);
                }
            } else if (noResults) {
                noResults.remove();
            }
        }

        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            checkOnlineStatus();
            
            // Auto-expand first upazila
            const firstUpazila = document.querySelector('.upazila-content');
            if (firstUpazila) {
                firstUpazila.classList.add('show');
            }
        });
    </script>
</body>
</html> 