<?php
// AI Bot API Configuration
class AIHealthAssistant {
    private $api_key;
    private $api_url;
    
    public function __construct() {
        $this->api_key = "your_actual_api_key_here";
        $this->api_url = "https://api.openai.com/v1/chat/completions";
    }
    
    public function processHealthQuery($user_message, $context = []) {
        // Enhanced context-aware processing
        $enhanced_message = $this->enhanceWithContext($user_message);
        
        $response = $this->callAIAPI($enhanced_message, $context);
        
        // Add health-specific post-processing
        return $this->addHealthResources($response);
    }
    
    private function enhanceWithContext($message) {
        $message = strtolower($message);
        
        // Context correction for common mishearings
        $corrections = [
            'হাস পাতাল' => 'হাসপাতাল',
            'মন খারাপ' => 'মানসিক স্বাস্থ্য', 
            'টিকা সময়' => 'টিকা সিডিউল',
            'ডাক্তার দেখান' => 'ডাক্তার অ্যাপয়েন্টমেন্ট'
        ];
        
        foreach ($corrections as $wrong => $correct) {
            if (strpos($message, $wrong) !== false) {
                $message = str_replace($wrong, $correct, $message);
            }
        }
        
        return $message;
    }
    
    private function callAIAPI($message, $context) {
        $headers = [
            "Content-Type: application/json",
            "Authorization: Bearer " . $this->api_key
        ];
        
        $messages = [
            [
                "role" => "system",
                "content" => $this->getSystemPrompt()
            ]
        ];
        
        // Add context if available
        foreach ($context as $ctx) {
            $messages[] = $ctx;
        }
        
        $messages[] = [
            "role" => "user",
            "content" => $message
        ];
        
        $data = [
            "model" => "gpt-3.5-turbo",
            "messages" => $messages,
            "max_tokens" => 200,
            "temperature" => 0.7
        ];
        
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $this->api_url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30
        ]);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($http_code == 200) {
            $response_data = json_decode($response, true);
            return $response_data['choices'][0]['message']['content'] ?? $this->getFallbackResponse($message);
        }
        
        return $this->getFallbackResponse($message);
    }
    
    private function getSystemPrompt() {
        return "You are Shastho Shohayika, a compassionate Bengali health assistant. 
        Always respond in Bengali. Be empathetic and practical.
        
        Key capabilities:
        1. Hospital/Clinic search and directions
        2. Mental health support and resources  
        3. Vaccine schedules and information
        4. Doctor appointments
        5. Emergency health guidance
        6. Medicine information
        7. Health tips and prevention
        
        Response guidelines:
        - Keep responses under 2-3 sentences
        - Always show empathy first
        - Provide actionable advice
        - Suggest next steps
        - Use simple, clear Bengali";
    }
    
    private function addHealthResources($response) {
        // Add relevant health resources based on response content
        $resources = "";
        
        if (strpos(strtolower($response), 'হাসপাতাল') !== false) {
            $resources = "\n\n🏥 নিকটবর্তী হাসপাতাল খুঁজতে: https://maps.google.com";
        }
        elseif (strpos(strtolower($response), 'মন') !== false) {
            $resources = "\n\n🧠 মানসিক স্বাস্থ্য হেল্পলাইন: ১৬২৬৩";
        }
        elseif (strpos(strtolower($response), 'টিকা') !== false) {
            $resources = "\n\n💉 টিকা সিডিউল: স্বাস্থ্য অধিদপ্তর - ১৬২৬৩";
        }
        
        return $response . $resources;
    }
    
    private function getFallbackResponse($message) {
        $fallbacks = [
            "দুঃখিত, আমি এখন উত্তর দিতে পারছি না। দয়া করে অপেক্ষা করুন ।",
            "আমি এখন আপনার বার্তা প্রক্রিয়া করতে পারছি না। দয়া করে আবার চেষ্টা করুন।",
            "সংযোগ সমস্যা হচ্ছে। দয়া করে নিশ্চিত করুন যে আপনার ইন্টারনেট সংযোগ সক্রিয় আছে।"
        ];
        
        return $fallbacks[array_rand($fallbacks)];
    }
}

// Usage example:
// $ai_assistant = new AIHealthAssistant();
// $response = $ai_assistant->processHealthQuery("হাসপাতাল খুঁজুন");
?> 