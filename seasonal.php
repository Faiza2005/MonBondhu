<?php
session_start();
$site_name = "MonBondhu";
$page_title = "মৌসুমী স্বাস্থ্য টিপস";
$current_year = date("Y");

$seasonal_tips = [
    'summer' => [
        'name' => 'গ্রীষ্মকাল',
        'months' => ['মার্চ', 'এপ্রিল', 'মে', 'জুন'],
        'diseases' => [
            'হিট স্ট্রোক',
            'ডিহাইড্রেশন',
            'সানবার্ন',
            'খাদ্য বিষক্রিয়া',
            'ডেঙ্গু'
        ],
        'tips' => [
            'প্রচুর পানি পান করুন',
            'সানস্ক্রিন ব্যবহার করুন',
            'হালকা রঙের ঢিলেঢালা পোশাক পরুন',
            'দুপুরের তীব্র রোদ এড়িয়ে চলুন',
            'তাজা ও হালকা খাবার খান'
        ],
        'prevention' => [
            'বাইরে বের হলে ছাতা বা ক্যাপ ব্যবহার করুন',
            'নিয়মিত ওআরএস পান করুন',
            'বাইরের খাবার এড়িয়ে চলুন',
            'ঘন ঘন গোসল করুন'
        ]
    ],
    'monsoon' => [
        'name' => 'বর্ষাকাল',
        'months' => ['জুলাই', 'আগস্ট', 'সেপ্টেম্বর'],
        'diseases' => [
            'ডেঙ্গু',
            'ম্যালেরিয়া',
            'কলেরা',
            'টাইফয়েড',
            'চর্মরোগ'
        ],
        'tips' => [
            'মশারি ব্যবহার করুন',
            'ফুটানো বা ফিল্টার করা পানি পান করুন',
            'বৃষ্টির সময় রাস্তার খাবার এড়িয়ে চলুন',
            'আসেপাসে পরিষ্কার রাখুন',
            'মশা নিরোধক ব্যবহার করুন'
        ],
        'prevention' => [
            'বাসায় যেখানে সেখানে পানি জমতে দেবেন না',
            'জানালায় নেট লাগান',
            'বাইরে থেকে এসে হাত-পা ভালোভাবে ধুয়ে নিন',
            'ভেজা কাপড় পরবেন না'
        ]
    ],
    'winter' => [
        'name' => 'শীতকাল',
        'months' => ['অক্টোবর', 'নভেম্বর', 'ডিসেম্বর', 'জানুয়ারি', 'ফেব্রুয়ারি'],
        'diseases' => [
            'সর্দি-কাশি',
            'ফ্লু',
            'নিউমোনিয়া',
            'অ্যাজমা',
            'শুষ্ক ত্বক'
        ],
        'tips' => [
            'গরম পানি দিয়ে গোসল করুন',
            'উষ্ণ ও পুষ্টিকর খাবার খান',
            'নিয়মিত ময়েশ্চারাইজার ব্যবহার করুন',
            'ইনডোর ব্যায়াম করুন',
            'ফ্লু ভ্যাকসিন নিন'
        ],
        'prevention' => [
            'পর্যাপ্ত উষ্ণ কাপড় পরুন',
            'ভিটামিন সি সমৃদ্ধ খাবার খান',
            'ঘর গরম রাখুন',
            'পর্যাপ্ত বিশ্রাম নিন'
        ]
    ]
];

function getCurrentSeason() {
    $month = date('n'); // 1 to 12
    if ($month >= 3 && $month <= 6) return 'summer';
    if ($month >= 7 && $month <= 9) return 'monsoon';
    return 'winter';
}

$current_season = getCurrentSeason();
$current_month = date('F');
$current_month_bengali = [
    'January' => 'জানুয়ারি',
    'February' => 'ফেব্রুয়ারি',
    'March' => 'মার্চ',
    'April' => 'এপ্রিল',
    'May' => 'মে',
    'June' => 'জুন',
    'July' => 'জুলাই',
    'August' => 'আগস্ট',
    'September' => 'সেপ্টেম্বর',
    'October' => 'অক্টোবর',
    'November' => 'নভেম্বর',
    'December' => 'ডিসেম্বর' 
][$current_month];

// Handle season selection
$selected_season = $current_season;
if (isset($_GET['season']) && array_key_exists($_GET['season'], $seasonal_tips)) {
    $selected_season = $_GET['season'];
}

// Notification data (would be sent via push notification in real app)
$daily_tip = $seasonal_tips[$selected_season]['tips'][array_rand($seasonal_tips[$selected_season]['tips'])];
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - <?php echo $site_name; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #2E8B57;
            --secondary: #4ECDC4;
            --accent: #FF6B6B;
            --summer: #FFA726;
            --monsoon: #42A5F5;
            --winter: #26C6DA;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', 'Nirmala UI', 'Kalpurush', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #333;
            min-height: 100vh;
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

        .season-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            border: none;
        }

        .current-season {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .season-icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .season-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .season-tab {
            flex: 1;
            min-width: 120px;
            text-align: center;
            padding: 15px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .season-tab.active {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .season-tab.summer {
            background: var(--summer);
            color: white;
        }

        .season-tab.monsoon {
            background: var(--monsoon);
            color: white;
        }

        .season-tab.winter {
            background: var(--winter);
            color: white;
        }

        .tip-section {
            margin-bottom: 30px;
        }

        .section-title {
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
        }

        .disease-list, .tip-list, .prevention-list {
            list-style: none;
            padding: 0;
        }

        .disease-item, .tip-item, .prevention-item {
            background: #f8f9fa;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid var(--accent);
        }

        .disease-item {
            border-left-color: #dc3545;
        }

        .tip-item {
            border-left-color: #28a745;
        }

        .prevention-item {
            border-left-color: #007bff;
        }

        .notification-box {
            background: linear-gradient(135deg, #FFD700, #FFA726);
            color: #333;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            animation: pulse 2s infinite;
        }

        .monthly-calendar {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .month-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .month-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .month-card.current {
            border: 3px solid var(--primary);
        }

        .month-name {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .month-diseases {
            font-size: 0.9rem;
            color: #666;
        }

        .emergency-contact {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
            text-align: center;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }

        @media (max-width: 768px) {
            .container-main {
                padding: 15px;
            }
            
            .season-tabs {
                flex-direction: column;
            }
            
            .monthly-calendar {
                grid-template-columns: 1fr;
            }
        }

        .season-indicator {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            color: white;
            font-size: 0.9rem;
            margin-left: 10px;
        }

        .summer-bg { background: var(--summer); }
        .monsoon-bg { background: var(--monsoon); }
        .winter-bg { background: var(--winter); }
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
        <!-- Daily Notification -->
        <div class="notification-box">
            <div class="d-flex align-items-center">
                <i class="fas fa-bell fa-2x me-3"></i>
                <div>
                    <h5 class="mb-1">আজকের স্বাস্থ্য টিপস</h5>
                    <p class="mb-0"><?php echo $daily_tip; ?></p>
                </div>
            </div>
        </div>

        <div class="season-card">
            <div class="current-season">
                <div class="season-icon">
                    <?php 
                    $season_icons = [
                        'summer' => '☀️',
                        'monsoon' => '🌧️',
                        'winter' => '❄️'
                    ];
                    echo $season_icons[$current_season];
                    ?>
                </div>
                <h2>বর্তমান মৌসুম: <?php echo $seasonal_tips[$current_season]['name']; ?></h2>
                <p class="mb-0">বর্তমান মাস: <?php echo $current_month_bengali; ?></p>
            </div>

            <!-- Season Tabs -->
            <div class="season-tabs">
                <button class="season-tab summer <?php echo $selected_season === 'summer' ? 'active' : ''; ?>" 
                        onclick="selectSeason('summer')">
                    ☀️ গ্রীষ্মকাল
                </button>
                <button class="season-tab monsoon <?php echo $selected_season === 'monsoon' ? 'active' : ''; ?>" 
                        onclick="selectSeason('monsoon')">
                    🌧️ বর্ষাকাল
                </button>
                <button class="season-tab winter <?php echo $selected_season === 'winter' ? 'active' : ''; ?>" 
                        onclick="selectSeason('winter')">
                    ❄️ শীতকাল
                </button>
            </div>

            <!-- Selected Season Content -->
            <div class="selected-season-content">
                <h3 class="section-title">
                    <?php echo $seasonal_tips[$selected_season]['name']; ?> এর স্বাস্থ্য টিপস
                    <span class="season-indicator <?php echo $selected_season; ?>-bg">
                        <?php echo implode(', ', $seasonal_tips[$selected_season]['months']); ?>
                    </span>
                </h3>

                <div class="row">
                    <div class="col-md-4">
                        <div class="tip-section">
                            <h5><i class="fas fa-exclamation-triangle me-2 text-danger"></i>সচরাচর রোগ</h5>
                            <ul class="disease-list">
                                <?php foreach ($seasonal_tips[$selected_season]['diseases'] as $disease): ?>
                                <li class="disease-item">
                                    <i class="fas fa-notes-medical me-2"></i><?php echo $disease; ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="tip-section">
                            <h5><i class="fas fa-lightbulb me-2 text-success"></i>স্বাস্থ্য টিপস</h5>
                            <ul class="tip-list">
                                <?php foreach ($seasonal_tips[$selected_season]['tips'] as $tip): ?>
                                <li class="tip-item">
                                    <i class="fas fa-check-circle me-2"></i><?php echo $tip; ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="tip-section">
                            <h5><i class="fas fa-shield-alt me-2 text-primary"></i>প্রতিরোধ ব্যবস্থা</h5>
                            <ul class="prevention-list">
                                <?php foreach ($seasonal_tips[$selected_season]['prevention'] as $prevention): ?>
                                <li class="prevention-item">
                                    <i class="fas fa-shield-virus me-2"></i><?php echo $prevention; ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Calendar -->
            <div class="monthly-calendar">
                <?php
                $all_months = [
                    'জানুয়ারি' => 'winter',
                    'ফেব্রুয়ারি' => 'winter',
                    'মার্চ' => 'summer',
                    'এপ্রিল' => 'summer',
                    'মে' => 'summer',
                    'জুন' => 'summer',
                    'জুলাই' => 'monsoon',
                    'আগস্ট' => 'monsoon',
                    'সেপ্টেম্বর' => 'monsoon',
                    'অক্টোবর' => 'winter',
                    'নভেম্বর' => 'winter',
                    'ডিসেম্বর' => 'winter'
                ];

                $month_diseases = [
                    'জানুয়ারি' => ['সর্দি-কাশি', 'ফ্লু', 'নিউমোনিয়া'],
                    'ফেব্রুয়ারি' => ['ফ্লু', 'অ্যাজমা', 'শুষ্ক ত্বক'],
                    'মার্চ' => ['হিট স্ট্রোক', 'ডিহাইড্রেশন', 'ডেঙ্গু'],
                    'এপ্রিল' => ['সানবার্ন', 'খাদ্য বিষক্রিয়া', 'ডিহাইড্রেশন'],
                    'মে' => ['হিট স্ট্রোক', 'ডেঙ্গু', 'খাদ্য বিষক্রিয়া'],
                    'জুন' => ['ডেঙ্গু', 'ডিহাইড্রেশন', 'সানবার্ন'],
                    'জুলাই' => ['ডেঙ্গু', 'ম্যালেরিয়া', 'কলেরা'],
                    'আগস্ট' => ['কলেরা', 'টাইফয়েড', 'চর্মরোগ'],
                    'সেপ্টেম্বর' => ['ম্যালেরিয়া', 'ডেঙ্গু', 'চর্মরোগ'],
                    'অক্টোবর' => ['সর্দি-কাশি', 'ফ্লু', 'অ্যাজমা'],
                    'নভেম্বর' => ['ফ্লু', 'নিউমোনিয়া', 'শুষ্ক ত্বক'],
                    'ডিসেম্বর' => ['সর্দি-কাশি', 'নিউমোনিয়া', 'অ্যাজমা']
                ];

                foreach ($all_months as $month => $season):
                    $is_current = $month === $current_month_bengali;
                ?>
                <div class="month-card <?php echo $is_current ? 'current' : ''; ?>" 
                     onclick="selectSeason('<?php echo $season; ?>')">
                    <div class="month-name">
                        <?php echo $month; ?>
                        <?php if ($is_current): ?>
                        <span class="badge bg-primary">বর্তমান</span>
                        <?php endif; ?>
                    </div>
                    <div class="season-badge <?php echo $season; ?>-bg text-white px-2 py-1 rounded mb-2" style="font-size: 0.8rem;">
                        <?php 
                        $season_names = ['summer' => 'গ্রীষ্ম', 'monsoon' => 'বর্ষা', 'winter' => 'শীত'];
                        echo $season_names[$season];
                        ?>
                    </div>
                    <div class="month-diseases">
                        <strong>সচরাচর রোগ:</strong><br>
                        <?php echo implode(', ', array_slice($month_diseases[$month], 0, 2)); ?>...
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Emergency Contact -->
            <div class="emergency-contact">
                <h5><i class="fas fa-phone-alt me-2"></i>জরুরি স্বাস্থ্য হেল্পলাইন</h5>
                <p class="mb-2">স্বাস্থ্য বাতায়ন: <strong>১৬২৬৩</strong></p>
                <p class="mb-2">জরুরি সেবা: <strong>৯৯৯</strong></p>
                <p class="mb-0">২৪ ঘন্টা সেবা উপলব্ধ</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p>&copy; <?php echo $current_year; ?> <?php echo $site_name; ?> - কমিউনিটি স্বাস্থ্য নেভিগেটর। সকল অধিকার সংরক্ষিত।</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Season selection
        function selectSeason(season) {
            window.location.href = `?season=${season}`;
        }

        // Simulate push notification (in real app, this would be a service worker)
        function showNotification() {
            if ('Notification' in window && Notification.permission === 'granted') {
                const notification = new Notification('মনবন্ধু - আজকের স্বাস্থ্য টিপস', {
                    body: '<?php echo $daily_tip; ?>',
                    icon: '/icon.png',
                    tag: 'daily-tip'
                });
                
                notification.onclick = function() {
                    window.focus();
                    this.close();
                };
            }
        }

        // Request notification permission
        function requestNotificationPermission() {
            if ('Notification' in window) {
                Notification.requestPermission().then(permission => {
                    if (permission === 'granted') {
                        console.log('Notification permission granted');
                        // Schedule daily notifications
                        setInterval(showNotification, 24 * 60 * 60 * 1000); // Every 24 hours
                    }
                });
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Request notification permission on page load
            requestNotificationPermission();
            
            // Auto-scroll to current month
            const currentMonthCard = document.querySelector('.month-card.current');
            if (currentMonthCard) {
                currentMonthCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            
            // Add click effect to month cards
            document.querySelectorAll('.month-card').forEach(card => {
                card.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });
        });

        // Simulate receiving a push notification (for demo)
        setTimeout(() => {
            if (Math.random() > 0.5) { // 50% chance to show demo notification
                const demoNotification = document.createElement('div');
                demoNotification.className = 'notification-box';
                demoNotification.style.background = 'linear-gradient(135deg, #4CAF50, #45a049)';
                demoNotification.style.color = 'white';
                demoNotification.style.position = 'fixed';
                demoNotification.style.top = '20px';
                demoNotification.style.right = '20px';
                demoNotification.style.zIndex = '1000';
                demoNotification.style.maxWidth = '300px';
                demoNotification.innerHTML = `
                    <div class="d-flex align-items-center">
                        <i class="fas fa-bell me-3"></i>
                        <div>
                            <h6 class="mb-1">নতুন স্বাস্থ্য সতর্কতা</h6>
                            <p class="mb-0">বর্তমান মৌসুমে ${getRandomDisease()} এর প্রকোপ বাড়ছে। সতর্ক থাকুন।</p>
                        </div>
                    </div>
                `;
                document.body.appendChild(demoNotification);
                
                setTimeout(() => {
                    demoNotification.remove();
                }, 5000);
            }
        }, 3000);

        function getRandomDisease() {
            const diseases = ['ডেঙ্গু', 'সর্দি-কাশি', 'খাদ্য বিষক্রিয়া', 'চর্মরোগ'];
            return diseases[Math.floor(Math.random() * diseases.length)];
        }
    </script>
</body>
</html>