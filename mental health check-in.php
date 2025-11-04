<?php
// In future, you can connect this with database using PHP if needed.
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonBondhu - আপনার মননের সঙ্গী</title>
    <style>
        * {
            margin: 0; padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', 'Nirmala UI', 'Kalpurush', sans-serif;
        }
        :root {
            --primary: #2E8B57;
            --secondary: #4ECDC4;
            --accent: #FF6B6B;
            --light: #F7FFF7; 
            --dark: #1A535C;
        }
        body {
            background: linear-gradient(135deg, #87CEEB, #98FB98);
            color: var(--dark);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            background: rgba(255,255,255,0.95);
            padding: 30px;
            border-radius: 20px;
            max-width: 520px;
            width: 100%;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            text-align: center;
        }
        .logo h1 {
            color: var(--primary);
            font-size: 2.3rem;
        }
        .logo p { color: #333; }

        .checkin-btn {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 18px;
            border-radius: 40px;
            font-size: 1.3rem;
            font-weight: bold;
            margin: 20px 0;
            width: 100%;
            cursor: pointer;
            transition: 0.3s;
        }
        .checkin-btn:hover { transform: scale(1.05); }

        .section { display: none; margin-top: 20px; animation: fadeIn 0.5s ease; }
        .show { display: block; }
        .mood-options { display: flex; justify-content: space-around; margin: 15px 0; }
        .mood-option {
            cursor: pointer;
            text-align: center;
            padding: 10px;
            border-radius: 12px;
            transition: 0.3s;
        }
        .mood-option:hover { background: rgba(46,139,87,0.1); transform: scale(1.05); }
        .mood-option.selected { background: rgba(46,139,87,0.2); }

        select, input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 10px;
        }

        .result-box {
            background: rgba(46,139,87,0.1);
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
            text-align: left;
        }
        .footer { margin-top: 25px; font-size: 0.9rem; color: #666; }

        @keyframes fadeIn {
            from {opacity:0; transform: translateY(15px);}
            to {opacity:1; transform: translateY(0);}
        }
    </style>
</head>
<body>

<div class="container">
    <div class="logo">
        <h1>মনবন্ধু</h1>
        <p>আপনার মননের সঙ্গী</p>
    </div>

    <button class="checkin-btn" id="startBtn">আজকের অবস্থা জানাতে ক্লিক করুন</button>

    <div id="moodSection" class="section">
        <h3>আপনার আজকের মনের অবস্থা কেমন?</h3>
        <div class="mood-options">
            <div class="mood-option" data-mood="happy">😊 খুশি</div>
            <div class="mood-option" data-mood="neutral">😐 স্বাভাবিক</div>
            <div class="mood-option" data-mood="sad">😔 খারাপ</div>
        </div>
    </div>

    <div id="sleepSection" class="section">
        <h3>গতরাতে আপনার ঘুম কেমন হয়েছে?</h3>
        <select id="sleep">
            <option value="">-- নির্বাচন করুন --</option>
            <option value="good">ভালো ঘুম</option>
            <option value="average">মোটামুটি</option>
            <option value="poor">খারাপ</option>
        </select>
    </div>

    <div id="mealSection" class="section">
        <h3>আজকে আপনি কয়বেলা খাবার খেয়েছেন?</h3>
        <select id="meal">
            <option value="">-- নির্বাচন করুন --</option>
            <option value="3">৩ বেলা ঠিকভাবে খেয়েছি</option>
            <option value="2">২ বেলা খেয়েছি</option>
            <option value="1">১ বেলা খেয়েছি</option>
            <option value="0">ঠিক মতো খাইনি</option>
        </select>
    </div>

    <div id="resultSection" class="section">
        <h3>আজকের সারসংক্ষেপ 🌿</h3>
        <div class="result-box" id="resultBox"></div>
    </div>

    <div class="footer">
        <p>আপনার তথ্য সম্পূর্ণ গোপন রাখা হবে ❤️</p>
    </div> 
</div>

<script>
    const startBtn = document.getElementById('startBtn');
    const moodSection = document.getElementById('moodSection');
    const sleepSection = document.getElementById('sleepSection');
    const mealSection = document.getElementById('mealSection');
    const resultSection = document.getElementById('resultSection');
    let userData = {};

    startBtn.addEventListener('click', () => {
        startBtn.style.display = 'none';
        moodSection.classList.add('show');
    });

    document.querySelectorAll('.mood-option').forEach(option => {
        option.addEventListener('click', () => {
            document.querySelectorAll('.mood-option').forEach(o => o.classList.remove('selected'));
            option.classList.add('selected');
            userData.mood = option.dataset.mood;
            sleepSection.classList.add('show');
        });
    });

    document.getElementById('sleep').addEventListener('change', function() {
        if (this.value !== '') {
            userData.sleep = this.value;
            mealSection.classList.add('show');
        }
    });

    document.getElementById('meal').addEventListener('change', function() {
        if (this.value !== '') {
            userData.meal = this.value;
            showResult();
        }
    });

    function showResult() {
        resultSection.classList.add('show');
        const box = document.getElementById('resultBox');
        let message = '';

        // Personalized summary
        if (userData.mood === 'happy') message += '😊 আপনি আজ খুশি মনে আছেন! ';
        else if (userData.mood === 'neutral') message += '🙂 আপনার মন এখন স্বাভাবিক আছে। ';
        else message += '😔 মনে হচ্ছে আপনি আজ একটু খারাপ লাগায় আছেন। ';

        // Sleep feedback
        if (userData.sleep === 'good') message += 'গতরাতের ঘুম দারুণ হয়েছে, খুব ভালো! ';
        else if (userData.sleep === 'average') message += 'ঘুম মোটামুটি হয়েছে, একটু আগে ঘুমালে আরও ভালো লাগবে। ';
        else message += 'ঘুম ঠিক মতো হয়নি, রাতে মোবাইল কম ব্যবহার করুন ও রিল্যাক্স করুন। ';

        // Meal feedback
        if (userData.meal === '3') message += '🍽 আপনি নিয়মিত খাবার খেয়েছেন, শরীর ভালো থাকবে!';
        else if (userData.meal === '2') message += '🥗 আজকে ২ বেলা খেয়েছেন, পরেরবার পূর্ণ ৩ বেলা খাবার নিন।';
        else if (userData.meal === '1') message += '⚠️ মাত্র ১ বেলা খাবার খেয়েছেন! পুষ্টিকর খাবার খেতে ভুলবেন না।';
        else message += '🚨 আজকে কিছুই খাননি? শরীর ও মন দুটোই দুর্বল হবে! একটু কিছু খেয়ে নিন।';

        // Recommendation
        message += '<br><br><b>আজকের পরামর্শ:</b> ';
        if (userData.mood === 'sad') message += 'একটু হাঁটাহাঁটি করুন, গান শুনুন বা প্রিয় কারো সাথে কথা বলুন 💚';
        else if (userData.sleep === 'poor') message += 'আজ রাতে তাড়াতাড়ি ঘুমাতে যান ও মনকে শান্ত রাখুন 🌙';
        else message += 'মন ভালো রাখুন, নিজেকে ছোটো সুখে খুঁজে নিন 🌼';

        box.innerHTML = message;
        localStorage.setItem('monbondhuData', JSON.stringify(userData));
    }
</script>

</body>
</html>
