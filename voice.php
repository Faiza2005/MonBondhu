<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shastho Shohayika - Voice Health Assistant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4a6fa5;
            --secondary: #6b8cbc;
            --accent: #ff7e5f;
            --light: #f8f9fa;
            --dark: #2c3e50;
            --success: #48bb78;
            --warning: #ed8936;
            --danger: #f56565;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', 'SolaimanLipi', 'Kalpurush', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .app-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            margin-bottom: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .logo-icon {
            font-size: 3rem;
            color: var(--primary);
            animation: pulse 2s infinite;
        }

        .logo-text {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .subtitle {
            color: #666;
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        /* Assistant Animation */
        .assistant-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }

        .assistant-avatar {
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            position: relative;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .assistant-avatar::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="30" cy="40" r="8" fill="white" opacity="0.7"/><circle cx="70" cy="40" r="8" fill="white" opacity="0.7"/><path d="M30 70 Q50 85 70 70" stroke="white" stroke-width="3" fill="none" opacity="0.7"/></svg>') center no-repeat;
        }

        .assistant-avatar.listening::before {
            animation: speak 0.5s infinite alternate;
        }

        .assistant-avatar.thinking::before {
            animation: think 2s infinite;
        }

        .assistant-status {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 10px;
            text-align: center;
            min-height: 30px;
        }

        .assistant-message {
            background: var(--light);
            border-radius: 20px;
            padding: 15px 20px;
            margin-bottom: 20px;
            position: relative;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border-left: 5px solid var(--primary);
            animation: fadeIn 0.5s ease;
        }

        .assistant-message::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 20px;
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-bottom: 10px solid var(--light);
        }

        /* Voice Interface */
        .voice-interface {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .voice-btn {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), #ff9e7d);
            border: none;
            color: white;
            font-size: 1.8rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(255, 126, 95, 0.4);
            transition: all 0.3s ease;
            position: relative;
            z-index: 10;
        }

        .voice-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 30px rgba(255, 126, 95, 0.6);
        }

        .voice-btn.listening {
            background: linear-gradient(135deg, var(--success), #68d391);
            animation: pulse 1.5s infinite;
        }

        .voice-btn.thinking {
            background: linear-gradient(135deg, var(--warning), #f6ad55);
        }

        .voice-feedback {
            text-align: center;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .transcript {
            background: var(--light);
            border-radius: 15px;
            padding: 15px;
            margin-top: 10px;
            min-height: 60px;
            border: 2px dashed #e2e8f0;
            text-align: center;
            font-style: italic;
            color: #666;
        }

        /* Options List */
        .options-container {
            margin-top: 20px;
        }

        .options-title {
            text-align: center;
            margin-bottom: 15px;
            font-weight: 600;
            color: var(--dark);
        }

        .options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .option-btn {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 15px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .option-btn:hover {
            border-color: var(--primary);
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .option-icon {
            font-size: 1.5rem;
            color: var(--primary);
        }

        /* Conversation History */
        .conversation-container {
            margin-top: 30px;
            max-height: 300px;
            overflow-y: auto;
            padding: 15px;
            background: var(--light);
            border-radius: 15px;
        }

        .conversation-title {
            text-align: center;
            margin-bottom: 15px;
            font-weight: 600;
            color: var(--dark);
        }

        .message {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .message.user {
            flex-direction: row-reverse;
        }

        .message-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .message.user .message-avatar {
            background: linear-gradient(135deg, var(--accent), #ff9e7d);
            color: white;
        }

        .message.assistant .message-avatar {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .message-content {
            background: white;
            padding: 12px 15px;
            border-radius: 15px;
            max-width: 70%;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .message.user .message-content {
            background: linear-gradient(135deg, var(--accent), #ff9e7d);
            color: white;
        }

        /* Animations */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes speak {
            0% { transform: scaleY(1); }
            100% { transform: scaleY(0.8); }
        }

        @keyframes think {
            0% { opacity: 0.5; }
            50% { opacity: 1; }
            100% { opacity: 0.5; }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            .app-card {
                padding: 20px;
            }
            
            .logo-text {
                font-size: 2rem;
            }
            
            .options-grid {
                grid-template-columns: 1fr;
            }
            
            .message-content {
                max-width: 85%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="app-card">
            <!-- Header -->
            <div class="header">
                <div class="logo">
                    <i class="fas fa-robot logo-icon"></i>
                    <h1 class="logo-text">Shastho Shohayika</h1>
                </div>
                <p class="subtitle">Your Voice-First Health Assistant</p>
            </div>

            <!-- Assistant Animation -->
            <div class="assistant-container">
                <div class="assistant-avatar" id="assistantAvatar">
                    <!-- Animated face will be created with CSS -->
                </div>
                <div class="assistant-status" id="assistantStatus">
                    Ready to help you
                </div>
                <div class="assistant-message" id="assistantMessage">
                    Hello, I am your Shastho Shohayika. How can I help you today?
                </div>
            </div>

            <!-- Voice Interface -->
            <div class="voice-interface">
                <button class="voice-btn" id="voiceBtn">
                    <i class="fas fa-microphone"></i>
                </button>
                <div class="voice-feedback" id="voiceFeedback">
                    Click the microphone and speak
                </div>
                <div class="transcript" id="transcript">
                    Your speech will appear here...
                </div>
            </div>

            <!-- Options List (shown when confidence is low) -->
            <div class="options-container" id="optionsContainer" style="display: none;">
                <div class="options-title">I found a few things. Please select from the list:</div>
                <div class="options-grid" id="optionsGrid">
                    <!-- Options will be dynamically added here -->
                </div>
            </div>

            <!-- Conversation History -->
            <div class="conversation-container">
                <div class="conversation-title">Conversation History</div>
                <div id="conversationHistory">
                    <!-- Messages will be dynamically added here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // DOM Elements
        const voiceBtn = document.getElementById('voiceBtn');
        const assistantAvatar = document.getElementById('assistantAvatar');
        const assistantStatus = document.getElementById('assistantStatus');
        const assistantMessage = document.getElementById('assistantMessage');
        const voiceFeedback = document.getElementById('voiceFeedback');
        const transcript = document.getElementById('transcript');
        const optionsContainer = document.getElementById('optionsContainer');
        const optionsGrid = document.getElementById('optionsGrid');
        const conversationHistory = document.getElementById('conversationHistory');

        // Speech Recognition Setup
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        let recognition;
        
        if (SpeechRecognition) {
            recognition = new SpeechRecognition();
            recognition.continuous = false;
            recognition.interimResults = true;
            recognition.lang = 'bn-BD'; // Set to Bengali by default
            
            recognition.onstart = function() {
                updateUI('listening', 'Listening...', 'Speak now...');
            };
            
            recognition.onresult = function(event) {
                let interimTranscript = '';
                let finalTranscript = '';
                
                for (let i = event.resultIndex; i < event.results.length; i++) {
                    if (event.results[i].isFinal) {
                        finalTranscript += event.results[i][0].transcript;
                    } else {
                        interimTranscript += event.results[i][0].transcript;
                    }
                }
                
                transcript.textContent = finalTranscript || interimTranscript;
                
                if (finalTranscript) {
                    processSpeech(finalTranscript);
                }
            };
            
            recognition.onerror = function(event) {
                console.error('Speech recognition error', event.error);
                updateUI('idle', 'Error occurred', 'Sorry, there was an error. Please try again.');
                setTimeout(() => {
                    updateUI('idle', 'Ready to help you', 'Click the microphone and speak');
                }, 3000);
            };
            
            recognition.onend = function() {
                if (voiceBtn.classList.contains('listening')) {
                    updateUI('idle', 'Processing...', 'Processing your request...');
                }
            };
        } else {
            voiceFeedback.textContent = 'Speech recognition not supported in this browser';
            voiceBtn.disabled = true;
        }

        // Speech Synthesis Setup
        const synth = window.speechSynthesis;

        function speak(text, lang = 'bn-BD') {
            if (synth.speaking) {
                synth.cancel();
            }
            
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = lang;
            utterance.rate = 0.9;
            utterance.pitch = 1;
            
            utterance.onstart = function() {
                assistantAvatar.classList.add('listening');
            };
            
            utterance.onend = function() {
                assistantAvatar.classList.remove('listening');
            };
            
            synth.speak(utterance);
        }

        // Command Processing
        function processSpeech(text) {
            addMessageToHistory(text, 'user');
            updateUI('thinking', 'Thinking...', 'Processing your request...');
            
            // Normalize text for matching
            const normalizedText = text.toLowerCase().trim();
            
            // Check for commands with context awareness
            let command = matchCommand(normalizedText);
            
            if (command) {
                // If we have high confidence, execute the command
                setTimeout(() => {
                    executeCommand(command);
                }, 1500);
            } else {
                // If confidence is low, show options
                setTimeout(() => {
                    showOptions(normalizedText);
                }, 1500);
            }
        }

        // Command Matching with Context Awareness
        function matchCommand(text) {
            // Hospital related commands
            if (text.includes('হাসপাতাল') || text.includes('hospital') || 
                (text.includes('হাস') && text.includes('পাতাল'))) {
                return 'find_hospital';
            }
            
            // Mental health related commands
            if (text.includes('মন খারাপ') || text.includes('sad') || text.includes('depressed') ||
                text.includes('মানসিক') || text.includes('mental')) {
                return 'mental_health';
            }
            
            // Vaccination related commands
            if (text.includes('টিকা') || text.includes('vaccine') || text.includes('vaccination') ||
                text.includes('ইঞ্জেকশন') || text.includes('injection')) {
                return 'vaccination_schedule';
            }
            
            // Emergency commands
            if (text.includes('জরুরী') || text.includes('emergency') || text.includes('অ্যাম্বুলেন্স')) {
                return 'emergency';
            }
            
            // Doctor appointment
            if (text.includes('ডাক্তার') || text.includes('doctor') || text.includes('appointment')) {
                return 'doctor_appointment';
            }
            
            // Medicine reminder
            if (text.includes('ওষুধ') || text.includes('medicine') || text.includes('reminder')) {
                return 'medicine_reminder';
            }
            
            return null;
        }

        // Show options when confidence is low
        function showOptions(text) {
            updateUI('idle', 'Please select an option', 'I found a few things. Please select from the list:');
            
            // Clear previous options
            optionsGrid.innerHTML = '';
            
            // Generate probable options based on text
            const probableOptions = generateProbableOptions(text);
            
            // Add options to the grid
            probableOptions.forEach(option => {
                const optionBtn = document.createElement('div');
                optionBtn.className = 'option-btn';
                optionBtn.innerHTML = `
                    <div class="option-icon">${option.icon}</div>
                    <div>${option.text}</div>
                `;
                optionBtn.addEventListener('click', () => {
                    executeCommand(option.command);
                    optionsContainer.style.display = 'none';
                });
                optionsGrid.appendChild(optionBtn);
            });
            
            // Show options container
            optionsContainer.style.display = 'block';
        }

        // Generate probable options based on text
        function generateProbableOptions(text) {
            const options = [];
            
            // Hospital related
            if (text.includes('হাস') || text.includes('hospital') || text.includes('পাতাল')) {
                options.push({
                    icon: '<i class="fas fa-hospital"></i>',
                    text: 'হাসপাতাল খুঁজুন (Find Hospital)',
                    command: 'find_hospital'
                });
            }
            
            // Mental health related
            if (text.includes('মন') || text.includes('sad') || text.includes('mental')) {
                options.push({
                    icon: '<i class="fas fa-brain"></i>',
                    text: 'আমার মন খারাপ (I feel sad)',
                    command: 'mental_health'
                });
            }
            
            // Vaccination related
            if (text.includes('টিকা') || text.includes('vaccine') || text.includes('ইঞ্জেকশন')) {
                options.push({
                    icon: '<i class="fas fa-syringe"></i>',
                    text: 'টিকা এর সময়সূচী দেখান (Show vaccination schedule)',
                    command: 'vaccination_schedule'
                });
            }
            
            // Add default options if we don't have enough
            if (options.length < 2) {
                options.push({
                    icon: '<i class="fas fa-hospital"></i>',
                    text: 'হাসপাতাল খুঁজুন (Find Hospital)',
                    command: 'find_hospital'
                });
                
                options.push({
                    icon: '<i class="fas fa-brain"></i>',
                    text: 'আমার মন খারাপ (I feel sad)',
                    command: 'mental_health'
                });
                
                options.push({
                    icon: '<i class="fas fa-syringe"></i>',
                    text: 'টিকা এর সময়সূচী দেখান (Show vaccination schedule)',
                    command: 'vaccination_schedule'
                });
            }
            
            return options;
        }

        // Execute Command
        function executeCommand(command) {
            let message = '';
            let action = '';
            
            switch(command) {
                case 'find_hospital':
                    message = 'আমি আপনার কাছাকাছি হাসপাতাল খুঁজছি। আপনার বর্তমান অবস্থান শেয়ার করতে চান?';
                    action = 'Looking for nearby hospitals...';
                    break;
                    
                case 'mental_health':
                    message = 'আমি বুঝতে পারছি আপনি মানসিকভাবে কষ্টে আছেন। আমি আপনাকে একজন কাউন্সেলরের সাথে সংযোগ করতে পারি। আপনি কি চান?';
                    action = 'Connecting you with mental health resources...';
                    break;
                    
                case 'vaccination_schedule':
                    message = 'আপনার বয়স এবং অবস্থা অনুযায়ী টিকার সময়সূচী দেখাচ্ছি। শিশুদের জন্য নিয়মিত টিকা এবং করোনা টিকার তথ্য দিতে পারি।';
                    action = 'Showing vaccination schedule...';
                    break;
                    
                case 'emergency':
                    message = 'জরুরী সাহায্যের জন্য আমি অ্যাম্বুলেন্স ডাকছি। দয়া করে আপনার ঠিকানা confirm করুন।';
                    action = 'Emergency help is on the way!';
                    break;
                    
                case 'doctor_appointment':
                    message = 'আমি আপনাকে একজন ডাক্তারের সাথে অ্যাপয়েন্টমেন্ট করতে সাহায্য করতে পারি। আপনি কি ধরনের ডাক্তার প্রয়োজন?';
                    action = 'Scheduling a doctor appointment...';
                    break;
                    
                case 'medicine_reminder':
                    message = 'আমি আপনার ওষুধ খাওয়ার রিমাইন্ডার সেট করতে পারি। কোন ওষুধের জন্য রিমাইন্ডার চান?';
                    action = 'Setting up medicine reminder...';
                    break;
                    
                default:
                    message = 'দুঃখিত, আমি আপনাকে সাহায্য করতে পারিনি। দয়া করে আবার চেষ্টা করুন।';
                    action = 'Sorry, I could not help with that.';
            }
            
            // Update UI
            updateUI('idle', 'Ready to help you', message);
            addMessageToHistory(message, 'assistant');
            
            // Speak the response
            speak(message);
            
            // Perform the action (simulated)
            if (action) {
                setTimeout(() => {
                    assistantStatus.textContent = action;
                }, 2000);
            }
        }

        // Update UI State
        function updateUI(state, status, message) {
            // Update button state
            voiceBtn.className = 'voice-btn';
            if (state === 'listening') {
                voiceBtn.classList.add('listening');
                voiceBtn.innerHTML = '<i class="fas fa-stop"></i>';
            } else if (state === 'thinking') {
                voiceBtn.classList.add('thinking');
                voiceBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            } else {
                voiceBtn.innerHTML = '<i class="fas fa-microphone"></i>';
            }
            
            // Update assistant state
            assistantAvatar.className = 'assistant-avatar';
            if (state === 'listening') {
                assistantAvatar.classList.add('listening');
            } else if (state === 'thinking') {
                assistantAvatar.classList.add('thinking');
            }
            
            // Update texts
            assistantStatus.textContent = status;
            assistantMessage.textContent = message;
            voiceFeedback.textContent = message;
        }

        // Add message to conversation history
        function addMessageToHistory(text, sender) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${sender}`;
            
            const avatarDiv = document.createElement('div');
            avatarDiv.className = 'message-avatar';
            
            const contentDiv = document.createElement('div');
            contentDiv.className = 'message-content';
            contentDiv.textContent = text;
            
            if (sender === 'user') {
                avatarDiv.innerHTML = '<i class="fas fa-user"></i>';
            } else {
                avatarDiv.innerHTML = '<i class="fas fa-robot"></i>';
            } 
            
            messageDiv.appendChild(avatarDiv);
            messageDiv.appendChild(contentDiv);
            
            conversationHistory.appendChild(messageDiv);
            
            // Scroll to bottom
            conversationHistory.scrollTop = conversationHistory.scrollHeight;
        }

        // Voice Button Event Listener
        voiceBtn.addEventListener('click', function() {
            if (this.classList.contains('listening')) {
                // Stop listening
                recognition.stop();
                updateUI('idle', 'Ready to help you', 'Click the microphone and speak');
            } else {
                // Start listening
                transcript.textContent = 'Listening...';
                recognition.start();
            }
        });

        // Initial greeting
        window.addEventListener('load', function() {
            setTimeout(() => {
                speak('Hello, I am your Shastho Shohayika. How can I help you today?');
            }, 1000);
        });
    </script>
</body>
</html>