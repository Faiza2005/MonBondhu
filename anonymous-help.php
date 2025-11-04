<?php
session_start();

// Generate unique confirmation ID
function generateConfirmationId() {
    return 'MB-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
}

// Save help request to file (offline storage)
function saveHelpRequest($data) {
    $filename = 'help_requests/' . $data['confirmation_id'] . '.json';
    if (!is_dir('help_requests')) {
        mkdir('help_requests', 0777, true);
    }
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $confirmation_id = generateConfirmationId();
    $request_data = [
        'confirmation_id' => $confirmation_id,
        'problem_description' => $_POST['problem_description'],
        'help_type' => $_POST['help_type'],
        'contact_preference' => $_POST['contact_preference'],
        'submitted_at' => date('Y-m-d H:i:s'),
        'status' => 'pending'
    ];
    
    saveHelpRequest($request_data);
    
    // Set confirmation in session to show success message
    $_SESSION['confirmation_id'] = $confirmation_id;
    header("Location: anonymous-help.php?success=1");
    exit();
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>বেনামী সাহায্য অনুরোধ - MonBondhu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4a6fa5;
            --secondary: #6b8cbc;
            --accent: #4ECDC4;
            --trust-blue: #3498db;
            --trust-green: #27ae60;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', 'SolaimanLipi', 'Kalpurush', sans-serif;
        }
        
        .security-header {
            background: linear-gradient(135deg, var(--trust-blue), var(--primary));
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .security-icons {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        
        .consent-box {
            background: #d4edda;
            border: 2px solid var(--trust-green);
            border-radius: 15px;
            padding: 25px;
            margin: 25px 0;
            text-align: center;
        }
        
        .input-help {
            font-size: 0.85rem;
            color: #666;
            margin-top: 8px;
            font-style: italic;
        }
        
        .voice-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            margin: 15px 0;
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .voice-btn:hover {
            background: #3a5f95;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .voice-btn.listening {
            background: var(--trust-green);
            animation: pulse 1.5s infinite;
        }
        
        .process-steps {
            display: flex;
            justify-content: space-between;
            margin: 35px 0;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .step {
            text-align: center;
            flex: 1;
            min-width: 150px;
        }
        
        .step-icon {
            width: 70px;
            height: 70px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 1.8rem;
            color: var(--primary);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: 3px solid var(--trust-blue);
        }
        
        .step-text {
            font-size: 0.95rem;
            color: #2c3e50;
            font-weight: 600;
        }
        
        .volunteer-message {
            background: #E8F5E8;
            border: 3px solid var(--trust-green);
            border-radius: 15px;
            padding: 25px;
            margin: 25px 0;
            text-align: center;
            font-style: italic;
            font-size: 1.1rem;
            color: #2c3e50;
        }
        
        .confirmation-box {
            background: linear-gradient(135deg, var(--trust-green), #45a049);
            color: white;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            margin: 25px 0;
            display: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        
        .confirmation-box.show {
            display: block;
            animation: fadeIn 0.5s ease;
        }
        
        .confirmation-id {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 20px 0;
            background: rgba(255,255,255,0.2);
            padding: 15px 30px;
            border-radius: 15px;
            display: inline-block;
            letter-spacing: 2px;
        }
        
        .privacy-note {
            background: #F8F9FA;
            border-radius: 15px;
            padding: 20px;
            margin-top: 25px;
            font-size: 0.95rem;
            color: #666;
            border-left: 5px solid var(--trust-blue);
        }
        
        .form-control {
            border-radius: 10px;
            padding: 15px;
            border: 2px solid #e9ecef;
            font-size: 1rem;
        }
        
        .form-control:focus {
            border-color: var(--trust-blue);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-submit {
            background: linear-gradient(135deg, var(--trust-green), #45a049);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            margin: 20px 0;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .main-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            border: none;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="card">
            <!-- Security Header -->
            <div class="security-header">
                <div class="security-icons">
                    <i class="fas fa-shield-alt me-3"></i>
                    <i class="fas fa-lock me-3"></i>
                    <i class="fas fa-user-secret"></i>
                </div>
                <h1>বেনামী সাহায্য অনুরোধ</h1>
                <p class="mb-0">আপনার পরিচয় গোপন রাখা হবে - আমরা শুধু আপনার সমস্যাটি জানব</p>
            </div>

            <!-- Consent Box -->
            <div class="consent-box">
                <h4><i class="fas fa-check-circle me-2 text-success"></i>গোপনীয়তা নিশ্চিতকরণ</h4>
                <p class="mb-0 fs-5">
                    <strong>আমরা এটি শুধুমাত্র একজন প্রশিক্ষিত স্বেচ্ছাসেবকের সাথে শেয়ার করব। 
                    তারা কখনই জানবে না যে আপনি কে।</strong>
                </p>
            </div>

            <!-- Success Confirmation -->
            <?php if (isset($_SESSION['confirmation_id'])): ?>
            <div class="confirmation-box show">
                <i class="fas fa-check-circle fa-4x mb-3"></i>
                <h2>আপনার অনুরোধ সফলভাবে জমা হয়েছে!</h2>
                <div class="confirmation-id"><?php echo $_SESSION['confirmation_id']; ?></div>
                <p class="fs-5">আপনার কনফার্মেশন ID সংরক্ষণ করুন। একজন স্বেচ্ছাসেবক ৪৮ ঘন্টার মধ্যে যোগাযোগ করবেন।</p>
                <button class="btn btn-light mt-3" onclick="window.location.href='anonymous-help.php'">
                    <i class="fas fa-plus me-2"></i>আরেকটি অনুরোধ করুন
                </button>
            </div>
            <?php unset($_SESSION['confirmation_id']); ?>
            <?php endif; ?>

            <!-- Help Request Form -->
            <form id="helpForm" method="POST" action="" <?php if(isset($_SESSION['confirmation_id'])) echo 'style="display:none;"'; ?>>
                <!-- Problem Description -->
                <div class="mb-4">
                    <label class="form-label fs-5 fw-bold">আপনার সমস্যা বর্ণনা করুন</label>
                    <textarea 
                        class="form-control" 
                        name="problem_description" 
                        id="problemDescription"
                        rows="6" 
                        placeholder="আপনি কি ধরনের সাহায্য চান? বিস্তারিত লিখুন... যেমন: 'আমি খুব চিন্তিত থাকি', 'পরিবারে সমস্যা হচ্ছে', 'স্বাস্থ্য সংক্রান্ত সমস্যা' ইত্যাদি"
                        required></textarea>
                    <div class="input-help">বিস্তারিত লিখলে আমরা আপনাকে ভালভাবে সাহায্য করতে পারব</div>
                </div>

                <!-- Voice Input Button -->
                <button type="button" class="voice-btn" id="voiceBtn">
                    <i class="fas fa-microphone"></i> 
                    <span id="voiceText">ভয়েসে বলুন - কথা বলে সমস্যা বর্ণনা করুন</span>
                </button>

                <!-- Help Type -->
                <div class="mb-4">
                    <label class="form-label fs-5 fw-bold">সাহায্যের ধরন</label>
                    <select class="form-control" name="help_type" id="helpType">
                        <option value="mental_health">মানসিক স্বাস্থ্য সহায়তা</option>
                        <option value="physical_health">শারীরিক স্বাস্থ্য সমস্যা</option>
                        <option value="family_issue">পারিবারিক সমস্যা</option>
                        <option value="relationship">সম্পর্ক সংক্রান্ত সমস্যা</option>
                        <option value="financial">আর্থিক সমস্যা</option>
                        <option value="pregnancy_issue">গর্ভাবস্থার সমস্যা</option>
                        <option value="child_care">শিশু যত্ন সম্পর্কিত</option>
                        <option value="other">অন্যান্য সমস্যা</option>
                    </select>
                </div>

                <!-- Contact Preference -->
                <div class="mb-4">
                    <label class="form-label fs-5 fw-bold">যোগাযোগের পছন্দ (ঐচ্ছিক)</label>
                    <select class="form-control" name="contact_preference" id="contactPreference">
                        <option value="message">শুধুমাত্র মেসেজের মাধ্যমে</option>
                        <option value="call">ফোন কল</option>
                        <option value="video_call">ভিডিও কল</option>
                        <option value="in_person">ব্যক্তিগতভাবে দেখা (যদি উপযুক্ত হয়)</option>
                    </select>
                    <div class="input-help">আপনি যদি যোগাযোগের মাধ্যম উল্লেখ না করেন, আমরা শুধুমাত্র মেসেজের মাধ্যমে যোগাযোগ করব</div>
                </div>

                <!-- Process Steps -->
                <div class="process-steps">
                    <div class="step">
                        <div class="step-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div class="step-text">অনুরোধ জমা দিন</div>
                    </div>
                    <div class="step">
                        <div class="step-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="step-text">স্বেচ্ছাসেবক বরাদ্দ</div>
                    </div>
                    <div class="step">
                        <div class="step-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="step-text">যোগাযোগ করুন</div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane me-2"></i>সাহায্য অনুরোধ পাঠান
                </button>
            </form>

            <!-- Volunteer Message Example -->
            <div class="volunteer-message">
                <i class="fas fa-quote-left me-2"></i>
                <strong>"হ্যালো, আমি 'মনবন্ধু' থেকে একজন স্বেচ্ছাসেবক। আপনি সাহায্য চেয়েছেন। কথা বলতে চান?"</strong>
                <i class="fas fa-quote-right ms-2"></i>
            </div>

            <!-- Privacy Note -->
            <div class="privacy-note">
                <h5><i class="fas fa-info-circle me-2"></i>কি ঘটবে যখন আপনি জমা দেবেন:</h5>
                <ul class="mb-0">
                    <li>আপনার অনুরোধ সম্পূর্ণ গোপনে সংরক্ষণ করা হবে</li>
                    <li>একজন প্রশিক্ষিত স্বেচ্ছাসেবক ৪৮ ঘন্টার মধ্যে যোগাযোগ করার চেষ্টা করবেন</li>
                    <li>আপনি কথা বলতে বা না বলতে পারলে - কোন চাপ নেই</li>
                    <li>সমস্ত তথ্য গোপন রাখা হবে, কেউ জানবে না আপনি কে</li>
                    <li>আপনি চাইলে শুধু লিখেও যোগাযোগ করতে পারবেন</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Voice Recognition Setup
        let recognition;
        let isListening = false;

        function initVoiceRecognition() {
            if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
                recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
                recognition.lang = 'bn-BD';
                recognition.continuous = false;
                recognition.interimResults = false;

                recognition.onstart = function() {
                    isListening = true;
                    document.getElementById('voiceBtn').classList.add('listening');
                    document.getElementById('voiceText').innerHTML = 'শোনা হচ্ছে... কথা বলুন';
                };

                recognition.onresult = function(event) {
                    const transcript = event.results[0][0].transcript;
                    document.getElementById('problemDescription').value = transcript;
                    
                    // Show success feedback
                    document.getElementById('voiceText').innerHTML = '<i class="fas fa-check"></i> ভয়েস রেকর্ড করা হয়েছে!';
                    document.getElementById('voiceBtn').style.background = '#27ae60';
                    
                    setTimeout(() => {
                        resetVoiceButton();
                    }, 3000);
                };

                recognition.onerror = function(event) {
                    console.error('Speech recognition error', event.error);
                    resetVoiceButton();
                    
                    if (event.error === 'not-allowed') {
                        alert('মাইক্রোফোন এক্সেস দেওয়া হয়নি। দয়া করে ব্রাউজার সেটিংস থেকে অনুমতি দিন।');
                    } else {
                        alert('ভয়েস রিকগনিশনে সমস্যা হচ্ছে। দয়া করে টাইপ করে লিখুন।');
                    }
                };

                recognition.onend = function() {
                    resetVoiceButton();
                };

            } else {
                // Hide voice button if not supported
                document.getElementById('voiceBtn').style.display = 'none';
            }
        }

        function resetVoiceButton() {
            isListening = false;
            const voiceBtn = document.getElementById('voiceBtn');
            voiceBtn.classList.remove('listening');
            voiceBtn.style.background = '';
            document.getElementById('voiceText').innerHTML = '<i class="fas fa-microphone"></i> ভয়েসে বলুন - কথা বলে সমস্যা বর্ণনা করুন';
        }

        function startVoiceRecognition() {
            if (!isListening) {
                try {
                    recognition.start();
                } catch (e) {
                    alert('ভয়েস রিকগনিশন শুরু করতে সমস্যা হচ্ছে। দয়া করে পুনরায় চেষ্টা করুন।');
                }
            } else {
                recognition.stop();
            }
        }

        // Form validation
        document.getElementById('helpForm').addEventListener('submit', function(e) {
            const problemText = document.getElementById('problemDescription').value.trim();
            
            if (problemText.length < 10) {
                e.preventDefault();
                alert('দয়া করে আপনার সমস্যা বিস্তারিত বর্ণনা করুন (কমপক্ষে ১০ অক্ষর)।');
                document.getElementById('problemDescription').focus();
                return false;
            }
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>জমা দেওয়া হচ্ছে...';
            submitBtn.disabled = true;
        });

        // Initialize when page loads<?php
session_start();

// Generate unique confirmation ID
function generateConfirmationId() {
    return 'MB-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
}

// Save help request to file (offline storage)
function saveHelpRequest($data) {
    $filename = 'help_requests/' . $data['confirmation_id'] . '.json';
    if (!is_dir('help_requests')) {
        mkdir('help_requests', 0777, true);
    }
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['problem_description'])) {
    $confirmation_id = generateConfirmationId();
    $request_data = [
        'confirmation_id' => $confirmation_id,
        'problem_description' => $_POST['problem_description'],
        'help_type' => $_POST['help_type'],
        'contact_preference' => $_POST['contact_preference'],
        'submitted_at' => date('Y-m-d H:i:s'),
        'status' => 'pending'
    ];
    
    saveHelpRequest($request_data);
    
    // Set confirmation in session to show success message
    $_SESSION['confirmation_id'] = $confirmation_id;
    $_SESSION['help_submitted'] = true;
    header("Location: anonymous-help.php?success=1");
    exit();
}

// Check if showing success message
$show_success = isset($_SESSION['confirmation_id']);
$confirmation_id = $_SESSION['confirmation_id'] ?? '';
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>বেনামী সাহায্য অনুরোধ - MonBondhu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4a6fa5;
            --secondary: #6b8cbc;
            --accent: #4ECDC4;
            --trust-blue: #3498db;
            --trust-green: #27ae60;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', 'SolaimanLipi', 'Kalpurush', sans-serif;
            padding: 20px;
        }
        
        .security-header {
            background: linear-gradient(135deg, var(--trust-blue), var(--primary));
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .security-icons {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        
        .consent-box {
            background: #d4edda;
            border: 2px solid var(--trust-green);
            border-radius: 15px;
            padding: 25px;
            margin: 25px 0;
            text-align: center;
        }
        
        .input-help {
            font-size: 0.85rem;
            color: #666;
            margin-top: 8px;
            font-style: italic;
        }
        
        .voice-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            margin: 15px 0;
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .voice-btn:hover {
            background: #3a5f95;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .voice-btn.listening {
            background: var(--trust-green);
            animation: pulse 1.5s infinite;
        }
        
        .process-steps {
            display: flex;
            justify-content: space-between;
            margin: 35px 0;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .step {
            text-align: center;
            flex: 1;
            min-width: 150px;
        }
        
        .step-icon {
            width: 70px;
            height: 70px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 1.8rem;
            color: var(--primary);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: 3px solid var(--trust-blue);
        }
        
        .step-text {
            font-size: 0.95rem;
            color: #2c3e50;
            font-weight: 600;
        }
        
        .volunteer-message {
            background: #E8F5E8;
            border: 3px solid var(--trust-green);
            border-radius: 15px;
            padding: 25px;
            margin: 25px 0;
            text-align: center;
            font-style: italic;
            font-size: 1.1rem;
            color: #2c3e50;
        }
        
        .confirmation-box {
            background: linear-gradient(135deg, var(--trust-green), #45a049);
            color: white;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            margin: 25px 0;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        
        .confirmation-id {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 20px 0;
            background: rgba(255,255,255,0.2);
            padding: 15px 30px;
            border-radius: 15px;
            display: inline-block;
            letter-spacing: 2px;
            font-family: 'Courier New', monospace;
        }
        
        .privacy-note {
            background: #F8F9FA;
            border-radius: 15px;
            padding: 20px;
            margin-top: 25px;
            font-size: 0.95rem;
            color: #666;
            border-left: 5px solid var(--trust-blue);
        }
        
        .form-control {
            border-radius: 10px;
            padding: 15px;
            border: 2px solid #e9ecef;
            font-size: 1rem;
            font-family: 'SolaimanLipi', 'Kalpurush', sans-serif;
        }
        
        .form-control:focus {
            border-color: var(--trust-blue);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-submit {
            background: linear-gradient(135deg, var(--trust-green), #45a049);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            margin: 20px 0;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .main-container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            border: none;
            margin-bottom: 30px;
        }
        
        .back-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }
        
        .back-btn:hover {
            color: white;
            background: #3a5f95;
        }
        
        .voice-status {
            text-align: center;
            padding: 10px;
            margin: 10px 0;
            border-radius: 10px;
            display: none;
        }
        
        .voice-status.listening {
            display: block;
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Back Button -->
        <a href="dashboard.php" class="back-btn">
            <i class="fas fa-arrow-left"></i> ড্যাশবোর্ডে ফিরে যান
        </a>

        <div class="card">
            <!-- Security Header -->
            <div class="security-header">
                <div class="security-icons">
                    <i class="fas fa-shield-alt me-3"></i>
                    <i class="fas fa-lock me-3"></i>
                    <i class="fas fa-user-secret"></i>
                </div>
                <h1>বেনামী সাহায্য অনুরোধ</h1>
                <p class="mb-0">আপনার পরিচয় গোপন রাখা হবে - আমরা শুধু আপনার সমস্যাটি জানব</p>
            </div>

            <!-- Consent Box -->
            <div class="consent-box">
                <h4><i class="fas fa-check-circle me-2 text-success"></i>গোপনীয়তা নিশ্চিতকরণ</h4>
                <p class="mb-0 fs-5">
                    <strong>আমরা এটি শুধুমাত্র একজন প্রশিক্ষিত স্বেচ্ছাসেবকের সাথে শেয়ার করব। 
                    তারা কখনই জানবে না যে আপনি কে।</strong>
                </p>
            </div>

            <!-- Success Confirmation -->
            <?php if ($show_success): ?>
            <div class="confirmation-box show">
                <i class="fas fa-check-circle fa-4x mb-3"></i>
                <h2>আপনার অনুরোধ সফলভাবে জমা হয়েছে!</h2>
                <div class="confirmation-id"><?php echo $confirmation_id; ?></div>
                <p class="fs-5">আপনার কনফার্মেশন ID সংরক্ষণ করুন। একজন স্বেচ্ছাসেবক ৪৮ ঘন্টার মধ্যে যোগাযোগ করবেন।</p>
                <div class="mt-4">
                    <button class="btn btn-light me-3" onclick="window.location.href='anonymous-help.php'">
                        <i class="fas fa-plus me-2"></i>আরেকটি অনুরোধ করুন
                    </button>
                    <a href="dashboard.php" class="btn btn-outline-light">
                        <i class="fas fa-home me-2"></i>ড্যাশবোর্ডে যান
                    </a>
                </div>
            </div>
            <?php unset($_SESSION['confirmation_id']); ?>
            <?php endif; ?>

            <!-- Help Request Form -->
            <form id="helpForm" method="POST" action="" <?php if($show_success) echo 'style="display:none;"'; ?>>
                <!-- Problem Description -->
                <div class="mb-4">
                    <label class="form-label fs-5 fw-bold">আপনার সমস্যা বর্ণনা করুন *</label>
                    <textarea 
                        class="form-control" 
                        name="problem_description" 
                        id="problemDescription"
                        rows="6" 
                        placeholder="আপনি কি ধরনের সাহায্য চান? বিস্তারিত লিখুন... যেমন: 'আমি খুব চিন্তিত থাকি', 'পরিবারে সমস্যা হচ্ছে', 'স্বাস্থ্য সংক্রান্ত সমস্যা' ইত্যাদি"
                        required></textarea>
                    <div class="input-help">বিস্তারিত লিখলে আমরা আপনাকে ভালভাবে সাহায্য করতে পারব (কমপক্ষে ১০ অক্ষর প্রয়োজন)</div>
                </div>

                <!-- Voice Input Section -->
                <div class="mb-4">
                    <label class="form-label fs-5 fw-bold">অথবা ভয়েসে বলুন</label>
                    <button type="button" class="voice-btn" id="voiceBtn">
                        <i class="fas fa-microphone"></i> 
                        <span id="voiceText">ভয়েসে বলুন - কথা বলে সমস্যা বর্ণনা করুন</span>
                    </button>
                    <div id="voiceStatus" class="voice-status"></div>
                    <div class="input-help">মাইক্রোফোন বাটনে ক্লিক করুন এবং বাংলায় আপনার সমস্যা বলুন</div>
                </div>

                <!-- Help Type -->
                <div class="mb-4">
                    <label class="form-label fs-5 fw-bold">সাহায্যের ধরন *</label>
                    <select class="form-control" name="help_type" id="helpType" required>
                        <option value="">সাহায্যের ধরন নির্বাচন করুন</option>
                        <option value="mental_health">মানসিক স্বাস্থ্য সহায়তা</option>
                        <option value="physical_health">শারীরিক স্বাস্থ্য সমস্যা</option>
                        <option value="family_issue">পারিবারিক সমস্যা</option>
                        <option value="relationship">সম্পর্ক সংক্রান্ত সমস্যা</option>
                        <option value="financial">আর্থিক সমস্যা</option>
                        <option value="pregnancy_issue">গর্ভাবস্থার সমস্যা</option>
                        <option value="child_care">শিশু যত্ন সম্পর্কিত</option>
                        <option value="education">শিক্ষা সংক্রান্ত</option>
                        <option value="legal">আইনী সহায়তা</option>
                        <option value="other">অন্যান্য সমস্যা</option>
                    </select>
                </div>

                <!-- Contact Preference -->
                <div class="mb-4">
                    <label class="form-label fs-5 fw-bold">যোগাযোগের পছন্দ</label>
                    <select class="form-control" name="contact_preference" id="contactPreference">
                        <option value="message">শুধুমাত্র মেসেজের মাধ্যমে</option>
                        <option value="call">ফোন কল</option>
                        <option value="video_call">ভিডিও কল</option>
                        <option value="in_person">ব্যক্তিগতভাবে দেখা (যদি উপযুক্ত হয়)</option>
                    </select>
                    <div class="input-help">আপনি যদি যোগাযোগের মাধ্যম উল্লেখ না করেন, আমরা শুধুমাত্র মেসেজের মাধ্যমে যোগাযোগ করব</div>
                </div>

                <!-- Process Steps -->
                <div class="process-steps">
                    <div class="step">
                        <div class="step-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div class="step-text">অনুরোধ জমা দিন</div>
                    </div>
                    <div class="step">
                        <div class="step-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="step-text">স্বেচ্ছাসেবক বরাদ্দ</div>
                    </div>
                    <div class="step">
                        <div class="step-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="step-text">যোগাযোগ করুন</div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane me-2"></i>সাহায্য অনুরোধ পাঠান
                </button>
            </form>

            <!-- Volunteer Message Example -->
            <div class="volunteer-message">
                <i class="fas fa-quote-left me-2"></i>
                <strong>"হ্যালো, আমি 'মনবন্ধু' থেকে একজন স্বেচ্ছাসেবক। আপনি সাহায্য চেয়েছেন। কথা বলতে চান?"</strong>
                <i class="fas fa-quote-right ms-2"></i>
                <p class="mt-3 mb-0 text-muted">- এটি হবে স্বেচ্ছাসেবকের প্রথম বার্তা। কোন চাপ নেই, আপনি উত্তর দিতে বা না দিতে পারবেন।</p>
            </div>

            <!-- Privacy Note -->
            <div class="privacy-note">
                <h5><i class="fas fa-info-circle me-2"></i>কি ঘটবে যখন আপনি জমা দেবেন:</h5>
                <ul class="mb-0">
                    <li><strong>গোপনীয়তা:</strong> আপনার অনুরোধ সম্পূর্ণ গোপনে সংরক্ষণ করা হবে</li>
                    <li><strong>স্বেচ্ছাসেবক:</strong> একজন প্রশিক্ষিত স্বেচ্ছাসেবক ৪৮ ঘন্টার মধ্যে যোগাযোগ করার চেষ্টা করবেন</li>
                    <li><strong>নিরাপত্তা:</strong> আপনি কথা বলতে বা না বলতে পারলে - কোন চাপ নেই</li>
                    <li><strong>অজ্ঞাতকুল:</strong> সমস্ত তথ্য গোপন রাখা হবে, কেউ জানবে না আপনি কে</li>
                    <li><strong>নমনীয়তা:</strong> আপনি চাইলে শুধু লিখেও যোগাযোগ করতে পারবেন</li>
                    <li><strong>কন্ট্রোল:</strong> আপনি যেকোনো সময় কথা বলা বন্ধ করতে পারবেন</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Voice Recognition Setup
        let recognition;
        let isListening = false;
        let finalTranscript = '';

        function initVoiceRecognition() {
            if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
                recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
                recognition.lang = 'bn-BD';
                recognition.continuous = false;
                recognition.interimResults = true;
                recognition.maxAlternatives = 1;

                recognition.onstart = function() {
                    isListening = true;
                    document.getElementById('voiceBtn').classList.add('listening');
                    document.getElementById('voiceText').innerHTML = '<i class="fas fa-circle text-danger"></i> শোনা হচ্ছে... কথা বলুন এখন';
                    document.getElementById('voiceStatus').textContent = 'শোনা হচ্ছে... বাংলায় কথা বলুন';
                    document.getElementById('voiceStatus').classList.add('listening');
                };

                recognition.onresult = function(event) {
                    let interimTranscript = '';
                    
                    for (let i = event.resultIndex; i < event.results.length; ++i) {
                        if (event.results[i].isFinal) {
                            finalTranscript += event.results[i][0].transcript;
                        } else {
                            interimTranscript += event.results[i][0].transcript;
                        }
                    }
                    
                    // Update textarea with both final and interim results
                    document.getElementById('problemDescription').value = finalTranscript + interimTranscript;
                    
                    // Update status
                    document.getElementById('voiceStatus').textContent = 'শোনা হচ্ছে: ' + interimTranscript;
                };

                recognition.onerror = function(event) {
                    console.error('Speech recognition error', event.error);
                    resetVoiceButton();
                    
                    let errorMessage = 'ভয়েস রিকগনিশনে সমস্যা হচ্ছে। দয়া করে টাইপ করে লিখুন।';
                    
                    if (event.error === 'not-allowed') {
                        errorMessage = 'মাইক্রোফোন এক্সেস দেওয়া হয়নি। দয়া করে ব্রাউজার সেটিংস থেকে অনুমতি দিন।';
                    } else if (event.error === 'no-speech') {
                        errorMessage = 'কোন কথা শোনা যায়নি। দয়া করে আবার চেষ্টা করুন।';
                    } else if (event.error === 'audio-capture') {
                        errorMessage = 'মাইক্রোফোন পাওয়া যায়নি। দয়া করে মাইক্রোফোন চেক করুন।';
                    }
                    
                    document.getElementById('voiceStatus').textContent = errorMessage;
                    document.getElementById('voiceStatus').style.background = '#f8d7da';
                    document.getElementById('voiceStatus').style.color = '#721c24';
                    document.getElementById('voiceStatus').style.border = '1px solid #f5c6cb';
                };

                recognition.onend = function() {
                    resetVoiceButton();
                    if (finalTranscript.length > 0) {
                        document.getElementById('voiceStatus').textContent = 'ভয়েস রেকর্ড করা হয়েছে! আপনি এখন টাইপ করে এডিট করতে পারেন।';
                        document.getElementById('voiceStatus').style.background = '#d4edda';
                        document.getElementById('voiceStatus').style.color = '#155724';
                        document.getElementById('voiceStatus').style.border = '1px solid #c3e6cb';
                    }
                };

            } else {
                // Hide voice button if not supported
                document.getElementById('voiceBtn').style.display = 'none';
                document.getElementById('voiceStatus').textContent = 'দুঃখিত, আপনার ব্রাউজার ভয়েস রিকগনিশন সাপোর্ট করে না।';
                document.getElementById('voiceStatus').style.display = 'block';
            }
        }

        function resetVoiceButton() {
            isListening = false;
            const voiceBtn = document.getElementById('voiceBtn');
            voiceBtn.classList.remove('listening');
            voiceBtn.style.background = '';
            document.getElementById('voiceText').innerHTML = '<i class="fas fa-microphone"></i> ভয়েসে বলুন - কথা বলে সমস্যা বর্ণনা করুন';
        }

        function startVoiceRecognition() {
            if (!isListening) {
                try {
                    finalTranscript = '';
                    recognition.start();
                } catch (e) {
                    alert('ভয়েস রিকগনিশন শুরু করতে সমস্যা হচ্ছে। দয়া করে পুনরায় চেষ্টা করুন।');
                }
            } else {
                recognition.stop();
            }
        }

        // Form validation
        document.getElementById('helpForm')?.addEventListener('submit', function(e) {
            const problemText = document.getElementById('problemDescription').value.trim();
            const helpType = document.getElementById('helpType').value;
            
            if (problemText.length < 10) {
                e.preventDefault();
                alert('দয়া করে আপনার সমস্যা বিস্তারিত বর্ণনা করুন (কমপক্ষে ১০ অক্ষর)।');
                document.getElementById('problemDescription').focus();
                return false;
            }
            
            if (!helpType) {
                e.preventDefault();
                alert('দয়া করে সাহায্যের ধরন নির্বাচন করুন।');
                document.getElementById('helpType').focus();
                return false;
            }
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>জমা দেওয়া হচ্ছে...';
            submitBtn.disabled = true;
            
            // Re-enable after 3 seconds if still on page
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 3000);
        });

        // Auto-save draft to localStorage
        function autoSaveDraft() {
            const formData = {
                problem_description: document.getElementById('problemDescription').value,
                help_type: document.getElementById('helpType').value,
                contact_preference: document.getElementById('contactPreference').value
            };
            localStorage.setItem('anonymous_help_draft', JSON.stringify(formData));
        }

        // Load draft from localStorage
        function loadDraft() {
            const draft = localStorage.getItem('anonymous_help_draft');
            if (draft) {
                const formData = JSON.parse(draft);
                document.getElementById('problemDescription').value = formData.problem_description || '';
                document.getElementById('helpType').value = formData.help_type || '';
                document.getElementById('contactPreference').value = formData.contact_preference || '';
            }
        }

        // Clear draft after successful submission
        function clearDraft() {
            localStorage.removeItem('anonymous_help_draft');
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initVoiceRecognition();
            
            // Voice button click event
            document.getElementById('voiceBtn')?.addEventListener('click', startVoiceRecognition);
            
            // Auto-focus on problem description if form is visible
            if (!<?php echo $show_success ? 'true' : 'false'; ?>) {
                document.getElementById('problemDescription')?.focus();
                loadDraft();
            } else {
                clearDraft();
            }
            
            // Auto-save when user types
            document.getElementById('problemDescription')?.addEventListener('input', autoSaveDraft);
            document.getElementById('helpType')?.addEventListener('change', autoSaveDraft);
            document.getElementById('contactPreference')?.addEventListener('change', autoSaveDraft);
        });

        // Keyboard shortcut for voice (V key)
        document.addEventListener('keydown', function(e) {
            if ((e.key === 'v' || e.key === 'V') && e.altKey) {
                e.preventDefault();
                startVoiceRecognition();
            }
        });
    </script>
</body>
</html>
        document.addEventListener('DOMContentLoaded', function() {
            initVoiceRecognition();
            
            // Voice button click event
            document.getElementById('voiceBtn').addEventListener('click', startVoiceRecognition);
            
            // Auto-focus on problem description
            document.getElementById('problemDescription').focus();
        });

        // Keyboard shortcut for voice (V key)
        document.addEventListener('keydown', function(e) {
            if (e.key === 'v' && e.ctrlKey) {
                e.preventDefault();
                startVoiceRecognition();
            }
        });
    </script>
</body>
</html>