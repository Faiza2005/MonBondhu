<?php
session_start();

// লগিন চেক
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection 
include "db.php";

// Check if connection is established
if (!isset($conn) || $conn->connect_error) {
    die("Database connection failed. Please check your configuration.");
}

$user_id = $_SESSION['user_id'];
$user_name = "User";
$user_phone = "No Phone";

try {
    // Check if using MySQLi or PDO
    if ($conn instanceof mysqli) {
        // MySQLi version
        $sql = "SELECT full_name, phone, email FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                if (isset($user['full_name'])) $user_name = $user['full_name'];
                if (isset($user['phone'])) $user_phone = $user['phone'];
            }
            $stmt->close();
        } else {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }
    } else {
        // PDO version
        $sql = "SELECT full_name, phone, email FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            if (isset($user['full_name'])) $user_name = $user['full_name'];
            if (isset($user['phone'])) $user_phone = $user['phone'];
        }
    }
} catch (Exception $e) {
    error_log("Database error: " . $e->getMessage());
    // Continue with default values
}

$current_date = date('F d, Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonBondhu - Health Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
            --accent: #4ECDC4;
            --light: #f8f9fa;
            --dark: #2c3e50;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; color: #333; }
        .dashboard-container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .header { background: rgba(255, 255, 255, 0.95); border-radius: 15px; padding: 20px; margin-bottom: 25px; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1); display: flex; justify-content: space-between; align-items: center; }
        .header-content h1 { color: var(--dark); font-size: 2.2em; margin-bottom: 5px; font-weight: 700; }
        .header-content p { color: #7f8c8d; font-size: 1.1em; margin: 0; }
        .logout-btn { background: #ff6b6b; color: white; border: none; padding: 10px 20px; border-radius: 10px; font-weight: 600; transition: all 0.3s ease; text-decoration: none; }
        .logout-btn:hover { background: #ee5a24; color: white; }
        .user-info { background: white; border-radius: 15px; padding: 20px; margin-bottom: 25px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; }
        .info-item { text-align: center; padding: 15px; background: var(--light); border-radius: 10px; }
        .info-item strong { display: block; color: var(--dark); margin-bottom: 5px; font-size: 0.9em; }
        .info-item span { font-size: 1.1em; font-weight: 600; color: var(--primary); }
        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 25px; }
        .feature-card { background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); cursor: pointer; transition: all 0.3s ease; border-left: 5px solid var(--accent); text-align: center; }
        .feature-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15); }
        .feature-icon { font-size: 2.5em; margin-bottom: 15px; color: var(--accent); }
        .feature-card h3 { color: var(--dark); margin-bottom: 10px; font-size: 1.3em; font-weight: 600; }
        .feature-card p { color: #7f8c8d; line-height: 1.5; margin-bottom: 15px; }
        .btn-feature { background: var(--accent); color: white; border: none; padding: 8px 20px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; width: 100%; }
        .btn-feature:hover { background: #38b2ac; transform: translateY(-2px); }
        .quick-actions { background: white; border-radius: 15px; padding: 25px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); margin-bottom: 25px; }
        .quick-actions h3 { color: var(--dark); margin-bottom: 20px; text-align: center; font-weight: 600; }
        .action-buttons { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px; }
        .action-btn { background: var(--light); border: none; padding: 15px; border-radius: 10px; color: var(--dark); font-weight: 600; transition: all 0.3s ease; text-align: center; }
        .action-btn:hover { background: var(--accent); color: white; transform: translateY(-2px); }
        .footer { text-align: center; color: white; padding: 20px; font-size: 0.9em; }
        @media (max-width: 768px) {
            .header { flex-direction: column; text-align: center; gap: 15px; }
            .header-content h1 { font-size: 1.8em; }
            .features-grid { grid-template-columns: 1fr; }
            .action-buttons { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <h1>MonBondhu Health Dashboard</h1>
                <p>Your Complete Health Journey Companion</p>
            </div>
            <a href="logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </a>
        </div>

        <!-- User Information -->
        <div class="user-info">
            <div class="info-item">
                <strong>User Name</strong>
                <span><?php echo htmlspecialchars($user_name); ?></span>
            </div>
            <div class="info-item">
                <strong>Phone Number</strong>
                <span><?php echo htmlspecialchars($user_phone); ?></span>
            </div>
            <div class="info-item">
                <strong>Today's Date</strong>
                <span><?php echo $current_date; ?></span>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="features-grid">
            <div class="feature-card" onclick="window.location.href='mental health check-in.php'">
                <div class="feature-icon"><i class="fas fa-brain"></i></div>
                <h3>Mental Health Check-In</h3>
                <p>Regular self-assessment tools to track your mental wellbeing</p>
                <button class="btn-feature">Check In Now</button>
            </div>

            <div class="feature-card" onclick="window.location.href='community-help.php'">
                <div class="feature-icon"><i class="fas fa-users"></i></div>
                <h3>Community Health Support</h3>
                <p>Connect with support groups and community resources</p>
                <button class="btn-feature">Find Support</button>
            </div>

            <div class="feature-card" onclick="window.location.href='anonymous-help.php'">
                <div class="feature-icon"><i class="fas fa-user-secret"></i></div>
                <h3>Anonymous Help Request</h3>
                <p>Seek help confidentially without sharing personal information</p> 
                <button class="btn-feature">Request Help</button>
            </div>

            <div class="feature-card" onclick="window.location.href='seasonal.php'">
                <div class="feature-icon"><i class="fas fa-cloud-sun"></i></div>
                <h3>Seasonal Health Tips</h3>
                <p>Stay healthy year-round with preventive tips tailored to each season</p>
                <button class="btn-feature">View Tips</button>
            </div>

            <div class="feature-card" onclick="window.location.href='Maternal.php'">
                <div class="feature-icon"><i class="fas fa-baby"></i></div>
                <h3>Maternal & Child Health</h3>
                <p>Track pregnancy milestones and child development</p>
                <button class="btn-feature">Start Tracking</button>
            </div>

            <div class="feature-card" onclick="window.location.href='symptoms.php'">
                <div class="feature-icon"><i class="fas fa-stethoscope"></i></div>
                <h3>Symptoms Awareness</h3>
                <p>Learn to recognize important health symptoms and when to seek help</p>
                <button class="btn-feature">Learn More</button>
            </div>

            <div class="feature-card" onclick="window.location.href='events.php'">
                <div class="feature-icon"><i class="fas fa-calendar-alt"></i></div>
                <h3>Community Health Events</h3>
                <p>Find local health events, camps and workshops</p>
                <button class="btn-feature">View Events</button>
            </div>

            <div class="feature-card" onclick="window.location.href='volunteer.php'">
                <div class="feature-icon"><i class="fas fa-hands-helping"></i></div>
                <h3>Volunteer Health Worker Directory</h3>
                <p>Find trained volunteer health workers in your area</p>
                <button class="btn-feature">Find Volunteers</button>
            </div>

            <div class="feature-card" onclick="window.location.href='voice.php'">
                <div class="feature-icon"><i class="fas fa-mic"></i></div>
                <h3>Voice-First Health Assistant</h3>
                <p>Voice-Activated Interface for Low Literacy People</p>
                <button class="btn-feature">Get Started</button>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h3>Quick Actions</h3>
            <div class="action-buttons">
                <button class="action-btn" onclick="window.location.href='profile.php'"><i class="fas fa-user me-2"></i>Profile</button>
                <button class="action-btn" onclick="window.location.href='appointments.php'"><i class="fas fa-calendar me-2"></i>Appointments</button>
                <button class="action-btn" onclick="window.location.href='reports.php'"><i class="fas fa-file-medical me-2"></i>Reports</button>
                <button class="action-btn" onclick="window.location.href='settings.php'"><i class="fas fa-cog me-2"></i>Settings</button>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2025 MonBondhu. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Card click animation
        document.querySelectorAll('.feature-card').forEach(card => {
            card.addEventListener('click', function() {
                this.style.opacity = '0.7';
                setTimeout(() => { this.style.opacity = '1'; }, 300);
            });
        });

        // Button hover animation
        document.querySelectorAll('.btn-feature, .action-btn').forEach(btn => {
            btn.addEventListener('mouseenter', () => btn.style.transform = 'translateY(-2px)');
            btn.addEventListener('mouseleave', () => btn.style.transform = 'translateY(0)');
        });

        // Notification helper
        function showNotification(message) {
            if ('Notification' in window && Notification.permission === 'granted') {
                new Notification('MonBondhu', { body: message });
            }
        }

        // Request permission for notifications
        if ('Notification' in window && Notification.permission === 'default') {
            Notification.requestPermission();
        }

        // Voice button click
        const voiceBtn = document.querySelector('.feature-card[onclick*="voice.php"] .btn-feature');
        if (voiceBtn) {
            voiceBtn.addEventListener('click', e => {
                e.stopPropagation();
                showNotification('Launching Voice-First Health Assistant...');
                setTimeout(() => {
                    window.location.href = 'voice.php';
                }, 800);
            });
        }
    </script>
</body>
</html>
