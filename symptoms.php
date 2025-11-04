<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Symptom Awareness Guide</title>
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

        /* Disclaimer Banner */
        .disclaimer {
            background: linear-gradient(135deg, var(--warning) 0%, #f6ad55 100%);
            color: white;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 10px rgba(237, 137, 54, 0.3);
            animation: fadeIn 0.5s ease;
        }

        .disclaimer-icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
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

        /* Symptom Grid */
        .symptoms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .symptom-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem 1rem;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .symptom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .symptom-card.selected {
            border-color: var(--accent);
            background: rgba(255, 126, 95, 0.05);
        }

        .symptom-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .symptom-title {
            font-weight: 600;
            color: var(--dark);
        }

        /* Symptom Detail Section */
        .symptom-detail {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-top: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.5s ease;
            display: none;
        }

        .symptom-detail.active {
            display: block;
        }

        .detail-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--light);
        }

        .detail-icon {
            font-size: 1.8rem;
            color: var(--primary);
        }

        .detail-title {
            font-size: 1.5rem;
            color: var(--primary);
            font-weight: 600;
        }

        .info-section {
            margin-bottom: 1.5rem;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.8rem;
            padding-bottom: 0.3rem;
            border-bottom: 1px solid var(--light);
        }

        .section-icon {
            font-size: 1.2rem;
        }

        .danger .section-icon {
            color: var(--danger);
        }

        .home-care .section-icon {
            color: var(--success);
        }

        .info-list {
            padding-left: 1.5rem;
        }

        .info-list li {
            margin-bottom: 0.5rem;
            line-height: 1.5;
        }

        .warning-box {
            background: rgba(245, 101, 101, 0.1);
            border-left: 4px solid var(--danger);
            padding: 1rem;
            border-radius: 5px;
            margin-top: 1rem;
        }

        .tip-box {
            background: rgba(72, 187, 120, 0.1);
            border-left: 4px solid var(--success);
            padding: 1rem;
            border-radius: 5px;
            margin-top: 1rem;
        }

        /* Emergency Section */
        .emergency-section {
            background: linear-gradient(135deg, var(--danger) 0%, #fc8181 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 15px;
            margin-top: 1.5rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(245, 101, 101, 0.3);
            animation: pulse 2s infinite;
        }

        .emergency-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .emergency-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .emergency-text {
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .emergency-btn {
            background: white;
            color: var(--danger);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .emergency-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
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
            
            .symptoms-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-content">
            <div class="logo">
                <i class="fas fa-heartbeat logo-icon"></i>
                <h1 id="app-title">Symptom Awareness Guide</h1>
            </div>
            <button class="language-toggle" id="languageToggle">
                <i class="fas fa-language"></i>
                <span id="languageText">English</span>
            </button>
        </div>
    </header>

    <div class="container">
        <!-- Disclaimer Banner -->
        <div class="disclaimer fade-in">
            <i class="fas fa-exclamation-triangle disclaimer-icon"></i>
            <h3 id="disclaimer-title">Important Notice</h3>
            <p id="disclaimer-text">This is an educational guide, not a diagnostic tool. Please see a healthcare professional for medical advice.</p>
        </div>

        <!-- Symptoms Overview -->
        <div class="card fade-in">
            <div class="card-header">
                <i class="fas fa-stethoscope card-icon"></i>
                <h2 class="card-title" id="symptoms-title">Common Symptoms</h2>
            </div>
            <p id="symptoms-description">Select a symptom to learn more about possible causes, danger signs, and home care tips.</p>
            
            <div class="symptoms-grid">
                <div class="symptom-card" data-symptom="fever">
                    <i class="fas fa-thermometer-full symptom-icon"></i>
                    <div class="symptom-title" id="fever-title">Fever</div>
                </div>
                <div class="symptom-card" data-symptom="diarrhea">
                    <i class="fas fa-tint symptom-icon"></i>
                    <div class="symptom-title" id="diarrhea-title">Diarrhea</div>
                </div>
                <div class="symptom-card" data-symptom="chest-pain">
                    <i class="fas fa-heart symptom-icon"></i>
                    <div class="symptom-title" id="chest-pain-title">Chest Pain</div>
                </div>
                <div class="symptom-card" data-symptom="sadness">
                    <i class="fas fa-sad-tear symptom-icon"></i>
                    <div class="symptom-title" id="sadness-title">Persistent Sadness</div>
                </div>
                <div class="symptom-card" data-symptom="cough">
                    <i class="fas fa-lungs symptom-icon"></i>
                    <div class="symptom-title" id="cough-title">Persistent Cough</div>
                </div>
                <div class="symptom-card" data-symptom="headache">
                    <i class="fas fa-head-side-virus symptom-icon"></i>
                    <div class="symptom-title" id="headache-title">Severe Headache</div>
                </div>
            </div>
        </div>

        <!-- Symptom Detail Section -->
        <div id="symptomDetail" class="symptom-detail">
            <!-- Content will be dynamically generated -->
        </div>

        <!-- Emergency Section -->
        <div class="emergency-section fade-in">
            <i class="fas fa-ambulance emergency-icon"></i>
            <div class="emergency-title" id="emergency-title">Emergency Warning</div>
            <div class="emergency-text" id="emergency-text">If you or someone else is experiencing severe symptoms, don't wait. Seek immediate medical attention.</div>
            <button class="emergency-btn" id="emergency-btn">
                <i class="fas fa-phone-alt"></i>
                <span id="emergency-call">Call Emergency Services</span>
            </button>
        </div>
    </div>

    <!-- Footer Navigation -->
    <div class="footer-nav">
        <a href="#" class="nav-item active">
            <i class="fas fa-home nav-icon"></i>
            <span id="nav-home">Home</span>
        </a>
        <a href="#" class="nav-item">
            <i class="fas fa-heartbeat nav-icon"></i>
            <span id="nav-symptoms">Symptoms</span>
        </a>
        <a href="#" class="nav-item">
            <i class="fas fa-book-medical nav-icon"></i>
            <span id="nav-resources">Resources</span>
        </a>
        <a href="#" class="nav-item">
            <i class="fas fa-user-md nav-icon"></i>
            <span id="nav-find-help">Find Help</span>
        </a>
    </div>

    <script>
        // Language support
        const translations = {
            en: {
                appTitle: "Symptom Awareness Guide",
                languageText: "English",
                disclaimerTitle: "Important Notice",
                disclaimerText: "This is an educational guide, not a diagnostic tool. Please see a healthcare professional for medical advice.",
                symptomsTitle: "Common Symptoms",
                symptomsDescription: "Select a symptom to learn more about possible causes, danger signs, and home care tips.",
                feverTitle: "Fever",
                diarrheaTitle: "Diarrhea",
                chestPainTitle: "Chest Pain",
                sadnessTitle: "Persistent Sadness",
                coughTitle: "Persistent Cough",
                headacheTitle: "Severe Headache",
                emergencyTitle: "Emergency Warning",
                emergencyText: "If you or someone else is experiencing severe symptoms, don't wait. Seek immediate medical attention.",
                emergencyCall: "Call Emergency Services",
                navHome: "Home",
                navSymptoms: "Symptoms",
                navResources: "Resources",
                navFindHelp: "Find Help",
                possibleCauses: "Possible Causes",
                dangerSigns: "Danger Signs - See a Doctor NOW",
                homeCare: "What You Can Do at Home",
                notADoctor: "Remember: This is not a substitute for professional medical advice."
            },
            bn: {
                appTitle: "লক্ষণ সচেতনতা গাইড",
                languageText: "বাংলা",
                disclaimerTitle: "গুরুত্বপূর্ণ নোটিশ",
                disclaimerText: "এটি একটি শিক্ষামূলক গাইড, রোগ নির্ণয়ের সরঞ্জাম নয়। চিকিৎসা পরামর্শের জন্য একজন স্বাস্থ্যসেবা পেশাদারের সাথে পরামর্শ করুন।",
                symptomsTitle: "সাধারণ লক্ষণ",
                symptomsDescription: "সম্ভাব্য কারণ, বিপদ সংকেত এবং ঘরোয়া যত্নের টিপস সম্পর্কে আরও জানতে একটি লক্ষণ নির্বাচন করুন।",
                feverTitle: "জ্বর",
                diarrheaTitle: "ডায়রিয়া",
                chestPainTitle: "বুক ব্যাথা",
                sadnessTitle: "স্থায়ী দুঃখ",
                coughTitle: "স্থায়ী কাশি",
                headacheTitle: "তীব্র মাথাব্যথা",
                emergencyTitle: "জরুরি সতর্কতা",
                emergencyText: "আপনি বা অন্য কেউ যদি গুরুতর লক্ষণ অনুভব করেন, তাহলে অপেক্ষা করবেন না। অবিলম্বে চিকিৎসা সহায়তা নিন।",
                emergencyCall: "জরুরি সেবায় কল করুন",
                navHome: "হোম",
                navSymptoms: "লক্ষণ",
                navResources: "রিসোর্স",
                navFindHelp: "সাহায্য খুঁজুন",
                possibleCauses: "সম্ভাব্য কারণ",
                dangerSigns: "বিপদ সংকেত - এখনই ডাক্তারের কাছে যান",
                homeCare: "বাড়িতে আপনি কি করতে পারেন",
                notADoctor: "মনে রাখবেন: এটি পেশাদার চিকিৎসা পরামর্শের বিকল্প নয়।"
            }
        };

        // Symptom data
        const symptomData = {
            en: {
                fever: {
                    title: "Fever",
                    icon: "fas fa-thermometer-full",
                    causes: [
                        "Viral infections (flu, cold, COVID-19)",
                        "Bacterial infections",
                        "Inflammatory conditions",
                        "Heat exhaustion",
                        "Certain medications"
                    ],
                    dangerSigns: [
                        "Fever above 103°F (39.4°C) in adults",
                        "Fever lasting more than 3 days",
                        "Severe headache with fever",
                        "Difficulty breathing",
                        "Stiff neck or confusion",
                        "Seizures or convulsions"
                    ],
                    homeCare: [
                        "Drink plenty of fluids",
                        "Rest as much as possible",
                        "Use lukewarm sponge baths",
                        "Take acetaminophen or ibuprofen as directed",
                        "Wear lightweight clothing",
                        "Monitor temperature regularly"
                    ]
                },
                diarrhea: {
                    title: "Diarrhea",
                    icon: "fas fa-tint",
                    causes: [
                        "Viral infections (norovirus, rotavirus)",
                        "Bacterial infections (E. coli, salmonella)",
                        "Food intolerance or allergies",
                        "Medication side effects",
                        "Digestive disorders"
                    ],
                    dangerSigns: [
                        "Diarrhea lasting more than 2 days",
                        "Severe abdominal or rectal pain",
                        "Blood or pus in stool",
                        "Signs of dehydration (dry mouth, dizziness)",
                        "Fever above 102°F (38.9°C)",
                        "No urination for 8+ hours"
                    ],
                    homeCare: [
                        "Drink oral rehydration solutions",
                        "Avoid dairy, fatty foods, and caffeine",
                        "Eat bland foods (bananas, rice, toast)",
                        "Wash hands frequently",
                        "Get plenty of rest",
                        "Consider probiotics"
                    ]
                },
                "chest-pain": {
                    title: "Chest Pain",
                    icon: "fas fa-heart",
                    causes: [
                        "Heart-related issues (angina, heart attack)",
                        "Acid reflux or GERD",
                        "Muscle strain",
                        "Anxiety or panic attacks",
                        "Respiratory problems"
                    ],
                    dangerSigns: [
                        "Chest pain with pressure, squeezing, or fullness",
                        "Pain spreading to jaw, neck, or arm",
                        "Shortness of breath",
                        "Cold sweat, nausea, or dizziness",
                        "Rapid or irregular heartbeat",
                        "Chest pain following physical activity"
                    ],
                    homeCare: [
                        "Sit down and try to relax",
                        "Take prescribed medications if available",
                        "Avoid physical exertion",
                        "Practice deep breathing if anxiety-related",
                        "Avoid heavy meals",
                        "Monitor symptoms closely"
                    ]
                },
                sadness: {
                    title: "Persistent Sadness",
                    icon: "fas fa-sad-tear",
                    causes: [
                        "Depression",
                        "Grief or loss",
                        "Chronic stress",
                        "Hormonal changes",
                        "Certain medical conditions"
                    ],
                    dangerSigns: [
                        "Thoughts of self-harm or suicide",
                        "Inability to perform daily activities",
                        "Withdrawal from social interactions",
                        "Significant weight changes",
                        "Substance abuse",
                        "Extreme fatigue or lack of energy"
                    ],
                    homeCare: [
                        "Talk to someone you trust",
                        "Maintain a regular routine",
                        "Get regular physical activity",
                        "Practice relaxation techniques",
                        "Ensure adequate sleep",
                        "Limit alcohol and caffeine"
                    ]
                },
                cough: {
                    title: "Persistent Cough",
                    icon: "fas fa-lungs",
                    causes: [
                        "Respiratory infections",
                        "Allergies or asthma",
                        "Acid reflux",
                        "Smoking or exposure to irritants",
                        "Certain medications"
                    ],
                    dangerSigns: [
                        "Coughing up blood",
                        "Shortness of breath or wheezing",
                        "Fever that doesn't go away",
                        "Unexplained weight loss",
                        "Night sweats",
                        "Chest pain when coughing"
                    ],
                    homeCare: [
                        "Stay hydrated with warm liquids",
                        "Use a humidifier",
                        "Avoid irritants like smoke",
                        "Try honey or throat lozenges",
                        "Elevate your head while sleeping",
                        "Practice good hand hygiene"
                    ]
                },
                headache: {
                    title: "Severe Headache",
                    icon: "fas fa-head-side-virus",
                    causes: [
                        "Tension headaches",
                        "Migraines",
                        "Sinus pressure",
                        "Dehydration",
                        "Eye strain"
                    ],
                    dangerSigns: [
                        "Sudden, severe headache",
                        "Headache after head injury",
                        "Headache with fever and stiff neck",
                        "Confusion, slurred speech, or weakness",
                        "Seizures or vision changes",
                        "Worst headache of your life"
                    ],
                    homeCare: [
                        "Rest in a quiet, dark room",
                        "Apply cold or warm compresses",
                        "Stay hydrated",
                        "Practice relaxation techniques",
                        "Massage neck and shoulders",
                        "Consider OTC pain relievers as directed"
                    ]
                }
            },
            bn: {
                fever: {
                    title: "জ্বর",
                    icon: "fas fa-thermometer-full",
                    causes: [
                        "ভাইরাল সংক্রমণ (ফ্লু, সর্দি, COVID-19)",
                        "ব্যাকটেরিয়াজনিত সংক্রমণ",
                        "প্রদাহজনিত অবস্থা",
                        "তাপ ক্লান্তি",
                        "কিছু ওষুধ"
                    ],
                    dangerSigns: [
                        "প্রাপ্তবয়স্কদের মধ্যে ১০৩°F (৩৯.৪°C) এর উপরে জ্বর",
                        "৩ দিনের বেশি স্থায়ী জ্বর",
                        "জ্বরের সাথে তীব্র মাথাব্যথা",
                        "শ্বাস নিতে কষ্ট",
                        "গলা শক্ত বা বিভ্রান্তি",
                        "খিঁচুনি বা কনভালশন"
                    ],
                    homeCare: [
                        "প্রচুর তরল পান করুন",
                        "যতটা সম্ভব বিশ্রাম নিন",
                        "হালকা গরম স্পঞ্জ স্নান ব্যবহার করুন",
                        "নির্দেশিত হিসাবে অ্যাসিটামিনোফেন বা আইবুপ্রোফেন নিন",
                        "হালকা ওজনের পোশাক পরুন",
                        "নিয়মিত তাপমাত্রা পর্যবেক্ষণ করুন"
                    ]
                },
                diarrhea: {
                    title: "ডায়রিয়া",
                    icon: "fas fa-tint",
                    causes: [
                        "ভাইরাল সংক্রমণ (নোরোভাইরাস, রোটাভাইরাস)",
                        "ব্যাকটেরিয়াজনিত সংক্রমণ (ই. কোলাই, সালমোনেলা)",
                        "খাদ্য অসহিষ্ণুতা বা অ্যালার্জি",
                        "ওষুধের পার্শ্বপ্রতিক্রিয়া",
                        "পাচনতন্ত্রের রোগ"
                    ],
                    dangerSigns: [
                        "২ দিনের বেশি স্থায়ী ডায়রিয়া",
                        "তীব্র পেট বা মলদ্বারের ব্যথা",
                        "মলে রক্ত বা পুঁজ",
                        "ডিহাইড্রেশনের লক্ষণ (শুষ্ক মুখ, মাথা ঘোরা)",
                        "১০২°F (৩৮.৯°C) এর উপরে জ্বর",
                        "৮+ ঘন্টা প্রস্রাব না হওয়া"
                    ],
                    homeCare: [
                        "ওরাল রিহাইড্রেশন সলিউশন পান করুন",
                        "দুগ্ধ, চর্বিযুক্ত খাবার এবং ক্যাফেইন এড়িয়ে চলুন",
                        "হালকা খাবার খান (কলা, ভাত, টোস্ট)",
                        "ঘন ঘন হাত ধুয়ে নিন",
                        "প্রচুর বিশ্রাম নিন",
                        "প্রোবায়োটিক্স বিবেচনা করুন"
                    ]
                },
                "chest-pain": {
                    title: "বুক ব্যাথা",
                    icon: "fas fa-heart",
                    causes: [
                        "হৃদয় সম্পর্কিত সমস্যা (এনজাইনা, হার্ট অ্যাটাক)",
                        "অ্যাসিড রিফ্লাক্স বা GERD",
                        "পেশী টান",
                        "উদ্বেগ বা প্যানিক অ্যাটাক",
                        "শ্বাসকষ্টের সমস্যা"
                    ],
                    dangerSigns: [
                        "চাপ, চিপা বা পূর্ণতা সহ বুকের ব্যথা",
                        "চোয়াল, ঘাড় বা বাহুতে ব্যথা ছড়িয়ে পড়া",
                        "শ্বাসকষ্ট",
                        "ঠান্ডা ঘাম, বমি বমি ভাব বা মাথা ঘোরা",
                        "দ্রুত বা অনিয়মিত হৃদস্পন্দন",
                        "শারীরিক কার্যকলাপের পরে বুকের ব্যথা"
                    ],
                    homeCare: [
                        "বসুন এবং শিথিল হওয়ার চেষ্টা করুন ", 
                        "উপলব্ধ থাকলে নির্ধারিত ওষুধ নিন",
                        "শারীরিক পরিশ্রম এড়িয়ে চলুন",
                        "উদ্বেগ-সম্পর্কিত হলে গভীর শ্বাস-প্রশ্বাসের অনুশীলন করুন",
                        "ভারী খাবার এড়িয়ে চলুন",
                        "লক্ষণগুলি ঘনিষ্ঠভাবে পর্যবেক্ষণ করুন"
                    ]
                },
                sadness: {
                    title: "স্থায়ী দুঃখ",
                    icon: "fas fa-sad-tear",
                    causes: [
                        "ডিপ্রেশন",
                        "দুঃখ বা ক্ষতি",
                        "দীর্ঘস্থায়ী স্ট্রেস",
                        "হরমোনের পরিবর্তন",
                        "কিছু চিকিৎসা অবস্থা"
                    ],
                    dangerSigns: [
                        "আত্মঘাতী বা আত্মহত্যার চিন্তা",
                        "দৈনন্দিন কাজকর্ম করতে অক্ষমতা",
                        "সামাজিক মিথস্ক্রিয়া থেকে প্রত্যাহার",
                        "উল্লেখযোগ্য ওজন পরিবর্তন",
                        "মাদকাসক্তি",
                        "চরম ক্লান্তি বা শক্তির অভাব"
                    ],
                    homeCare: [
                        "আপনার বিশ্বাস করা কারো সাথে কথা বলুন",
                        "একটি নিয়মিত রুটিন বজায় রাখুন",
                        "নিয়মিত শারীরিক কার্যকলাপ পান",
                        "বিশ্রাম কৌশল অনুশীলন করুন",
                        "পর্যাপ্ত ঘুম নিশ্চিত করুন",
                        "অ্যালকোহল এবং ক্যাফিন সীমিত করুন"
                    ]
                },
                cough: {
                    title: "স্থায়ী কাশি",
                    icon: "fas fa-lungs",
                    causes: [
                        "শ্বাসযন্ত্রের সংক্রমণ",
                        "অ্যালার্জি বা হাঁপানি",
                        "অ্যাসিড রিফ্লাক্স",
                        "ধূমপান বা বিরক্তিকর এক্সপোজার",
                        "কিছু ওষুধ"
                    ],
                    dangerSigns: [
                        "রক্ত কাশি",
                        "শ্বাসকষ্ট বা হুইজিং",
                        "জ্বর যা চলে যায় না",
                        "অব্যক্ত ওজন হ্রাস",
                        "রাতের ঘাম",
                        "কাশি দিলে বুকের ব্যথা"
                    ],
                    homeCare: [
                        "গরম তরল দিয়ে হাইড্রেটেড থাকুন",
                        "একটি হিউমিডিফায়ার ব্যবহার করুন",
                        "ধোঁয়ার মতো বিরক্তিকর এড়িয়ে চলুন",
                        "মধু বা গলা লজেন্স চেষ্টা করুন",
                        "ঘুমানোর সময় আপনার মাথা উঁচু করুন",
                        "ভাল হ্যান্ড হাইজিন অনুশীলন করুন"
                    ]
                },
                headache: {
                    title: "তীব্র মাথাব্যথা",
                    icon: "fas fa-head-side-virus",
                    causes: [
                        "টেনশন হেডেক",
                        "মাইগ্রেন",
                        "সাইনাস চাপ",
                        "ডিহাইড্রেশন",
                        "চোখের চাপ"
                    ],
                    dangerSigns: [
                        "হঠাৎ, তীব্র মাথাব্যথা",
                        "মাথায় আঘাতের পরে মাথাব্যথা",
                        "জ্বর এবং গলা শক্ত সহ মাথাব্যথা",
                        "বিভ্রান্তি, অস্পষ্ট বক্তব্য, বা দুর্বলতা",
                        "খিঁচুনি বা দৃষ্টিশক্তি পরিবর্তন",
                        "আপনার জীবনের সবচেয়ে খারাপ মাথাব্যথা"
                    ],
                    homeCare: [
                        "একটি শান্ত, অন্ধকার ঘরে বিশ্রাম নিন",
                        "ঠান্ডা বা গরম কম্প্রেস প্রয়োগ করুন",
                        "হাইড্রেটেড থাকুন",
                        "বিশ্রাম কৌশল অনুশীলন করুন",
                        "ঘাড় এবং কাঁধ ম্যাসাজ করুন",
                        "নির্দেশিত হিসাবে OTC ব্যথা উপশমকারী বিবেচনা করুন"
                    ]
                }
            }
        };

        // Current language
        let currentLang = 'en';

        // DOM Elements
        const languageToggle = document.getElementById('languageToggle');
        const symptomCards = document.querySelectorAll('.symptom-card');
        const symptomDetail = document.getElementById('symptomDetail');
        const emergencyBtn = document.getElementById('emergency-btn');

        // Initialize the app
        document.addEventListener('DOMContentLoaded', function() {
            // Set up language toggle
            languageToggle.addEventListener('click', toggleLanguage);

            // Set up symptom card clicks
            symptomCards.forEach(card => {
                card.addEventListener('click', function() {
                    const symptom = this.getAttribute('data-symptom');
                    showSymptomDetail(symptom);
                    
                    // Update selected state
                    symptomCards.forEach(c => c.classList.remove('selected'));
                    this.classList.add('selected');
                });
            });

            // Set up emergency button
            emergencyBtn.addEventListener('click', function() {
                alert(currentLang === 'en' 
                    ? 'Calling emergency services...' 
                    : 'জরুরি সেবায় কল করা হচ্ছে...');
            });

            // Set up footer navigation
            setupFooterNavigation();
        });

        // Toggle language function
        function toggleLanguage() {
            currentLang = currentLang === 'en' ? 'bn' : 'en';
            updateLanguage();
            
            // Refresh symptom detail if one is showing
            const selectedCard = document.querySelector('.symptom-card.selected');
            if (selectedCard) {
                const symptom = selectedCard.getAttribute('data-symptom');
                showSymptomDetail(symptom);
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
            
            languageText.textContent = currentLang === 'en' ? 'English' : 'বাংলা';
        }

        // Show symptom detail
        function showSymptomDetail(symptom) {
            const data = symptomData[currentLang][symptom];
            const t = translations[currentLang];
            
            symptomDetail.innerHTML = `
                <div class="detail-header">
                    <i class="${data.icon} detail-icon"></i>
                    <h2 class="detail-title">${data.title}</h2>
                </div>
                
                <div class="info-section">
                    <div class="section-title">
                        <i class="fas fa-info-circle section-icon"></i>
                        <span>${t.possibleCauses}</span>
                    </div>
                    <ul class="info-list">
                        ${data.causes.map(cause => `<li>${cause}</li>`).join('')}
                    </ul>
                </div>
                
                <div class="info-section">
                    <div class="section-title danger">
                        <i class="fas fa-exclamation-triangle section-icon"></i>
                        <span>${t.dangerSigns}</span>
                    </div>
                    <ul class="info-list">
                        ${data.dangerSigns.map(sign => `<li>${sign}</li>`).join('')}
                    </ul>
                    <div class="warning-box">
                        <i class="fas fa-first-aid"></i> ${t.dangerSigns}
                    </div>
                </div>
                
                <div class="info-section">
                    <div class="section-title home-care">
                        <i class="fas fa-home section-icon"></i>
                        <span>${t.homeCare}</span>
                    </div>
                    <ul class="info-list">
                        ${data.homeCare.map(care => `<li>${care}</li>`).join('')}
                    </ul>
                    <div class="tip-box">
                        <i class="fas fa-lightbulb"></i> ${t.notADoctor}
                    </div>
                </div>
            `;
            
            symptomDetail.classList.add('active');
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