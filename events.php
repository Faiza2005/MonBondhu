<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Health Events</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&family=SolaimanLipi&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            /* উন্নত বাংলা ফন্ট স্ট্যাক ব্যবহার করা হয়েছে */
            font-family: 'Hind Siliguri', 'SolaimanLipi', 'Segoe UI', sans-serif;
        }

        /* আপডেট করা ব্লুইশ-পার্পল কালার ভেরিয়েবল */
        :root {
            --primary: #5a67d8; /* Indigo Blue */
            --secondary: #805ad5; /* Amethyst Purple */
            --accent: #fc8181; /* Light Red/Coral for highlights */
            --light: #edf2f7; /* Off-White for text/cards */
            --dark: #2d3748; /* Dark Grey for deep text */
            --bg-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* Blue/Purple Gradient for body */
            
            /* অন্যান্য প্রয়োজনীয় ভেরিয়েবল (আসল ফাইল থেকে) */
            --success: #48bb78;
            --warning: #ed8936;
            --danger: #f56565;
            --text: #4a5568; /* Default text color */
        }

        body {
            /* ফিক্সড: ব্যবহারকারীর দেওয়া --bg-gradient ব্যবহার */
            background: var(--bg-gradient);
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
            /* আপডেট করা হেডার ব্যাকগ্রাউন্ড */
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 1.5rem 2rem;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            position: relative;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* লোগো স্টাইল ফিক্সড */
        .logo {
            font-family: 'Hind Siliguri', 'SolaimanLipi', sans-serif;
            font-size: 2.2rem; /* সাইজ একটু বড় করা হয়েছে */
            font-weight: 700;
            /* নতুন হেডার ব্যাকগ্রাউন্ডের সাথে মানানসই করতে light কালার ব্যবহার */
            color: var(--light); 
            text-decoration: none;
            margin-right: auto;
            /* লোগোকে ফুটিয়ে তুলতে টেক্সট শ্যাডো যোগ করা হয়েছে */
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.4); /* শ্যাডো একটু গাঢ় করা হয়েছে */
            transition: all 0.3s ease;
        }
        
        .logo:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        .logo span {
            /* অ্যাকসেন্ট কালার ব্যবহার করে লোগোর দ্বিতীয় অংশকে আলাদা করে তোলা হয়েছে */
            color: var(--accent); 
        } 

        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .language-toggle, .notification-toggle {
            background: rgba(255, 255, 255, 0.3); /* একটু বেশি স্পষ্ট ব্যাকগ্রাউন্ড */
            border: none;
            color: white;
            padding: 0.6rem 1.2rem; /* প্যাডিং একটু বাড়ানো হয়েছে */
            border-radius: 25px; /* রাউন্ডার কোণা */
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px; /* গ্যাপ বাড়ানো হয়েছে */
            transition: all 0.3s ease;
            font-size: 0.95rem; /* ফন্ট সাইজ একটু বাড়ানো হয়েছে */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .language-toggle:hover, .notification-toggle:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: translateY(-1px);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--accent);
            color: white;
            border-radius: 50%;
            width: 22px; /* সাইজ একটু বাড়ানো হয়েছে */
            height: 22px;
            font-size: 0.8rem; /* ফন্ট সাইজ একটু বাড়ানো হয়েছে */
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        /* Notification Panel */
        .notification-panel {
            position: fixed;
            top: 0;
            right: -400px;
            width: 380px;
            height: 100vh;
            background: white;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.15); /* শ্যাডো একটু গাঢ় করা হয়েছে */
            z-index: 1000;
            transition: right 0.3s ease-out; /* ট্রানজিশন স্মুথ করা হয়েছে */
            display: flex;
            flex-direction: column;
        }

        .notification-panel.active {
            right: 0;
        }

        .notification-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1); /* শ্যাডো যোগ করা হয়েছে */
        }

        .notification-title {
            font-size: 1.3rem;
            font-weight: 600;
        }

        .notification-close {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            transition: transform 0.2s ease;
        }
        .notification-close:hover {
            transform: rotate(90deg);
        }

        .notification-content {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
            background-color: var(--light); /* নোটিফিকেশন কন্টেন্টের ব্যাকগ্রাউন্ড */
        }

        .notification-tabs {
            display: flex;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 1rem;
            background-color: white;
        }

        .notification-tab {
            flex: 1;
            background: none;
            border: none;
            padding: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
            color: var(--text);
            font-weight: 500;
        }

        .notification-tab.active {
            border-bottom-color: var(--primary);
            color: var(--primary);
            font-weight: 600;
        }

        .notification-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .notification-item {
            background: white; /* নোটিফিকেশন আইটেমের ব্যাকগ্রাউন্ড সাদা */
            border-radius: 10px;
            padding: 1rem;
            border-left: 5px solid var(--primary); /* বর্ডার একটু মোটা করা হয়েছে */
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); /* হালকা শ্যাডো */
        }

        .notification-item.unread {
            background: #e6f0ff; /* আনরিড নোটিফিকেশনের জন্য হালকা নীল ব্যাকগ্রাউন্ড */
            border-left-color: var(--accent);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .notification-item.reminder {
            border-left-color: var(--warning);
        }

        .notification-header-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
        }

        .notification-title {
            font-weight: 600;
            color: var(--dark);
            font-size: 1.05rem;
        }

        .notification-time {
            font-size: 0.8rem;
            color: var(--text);
            opacity: 0.8;
        }

        .notification-message {
            font-size: 0.9rem;
            color: var(--text);
            line-height: 1.4;
            margin-bottom: 0.5rem;
        }

        .notification-actions {
            display: flex;
            gap: 0.7rem; /* গ্যাপ বাড়ানো হয়েছে */
            margin-top: 0.5rem;
        }

        .notification-action {
            background: none;
            border: none;
            color: var(--primary);
            font-size: 0.85rem; /* ফন্ট সাইজ একটু বাড়ানো হয়েছে */
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px; /* গ্যাপ বাড়ানো হয়েছে */
            transition: all 0.2s ease;
        }

        .notification-action:hover {
            color: var(--secondary);
            text-decoration: underline;
        }

        .no-notifications {
            text-align: center;
            padding: 2rem;
            color: var(--text);
            opacity: 0.7;
        }

        /* Rest of the styles remain the same as previous implementation, but color-adjusted */
        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-value {
            font-size: 2.2rem; /* সাইজ একটু বাড়ানো হয়েছে */
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1rem; /* সাইজ একটু বাড়ানো হয়েছে */
            color: var(--text);
            font-weight: 500;
        }

        .search-section {
            background: white;
            border-radius: 15px;
            padding: 1.8rem; /* প্যাডিং একটু বাড়ানো হয়েছে */
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); /* শ্যাডো একটু গাঢ় করা হয়েছে */
            border: 1px solid #e2e8f0;
        }

        .search-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.2rem;
            padding-bottom: 0.8rem;
            border-bottom: 2px solid var(--light);
        }

        .search-icon {
            font-size: 1.6rem; /* সাইজ একটু বাড়ানো হয়েছে */
            color: var(--primary);
        }

        .search-title {
            font-size: 1.4rem; /* সাইজ একটু বাড়ানো হয়েছে */
            color: var(--primary);
            font-weight: 600;
        }

        .search-container {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 1.2rem; /* গ্যাপ বাড়ানো হয়েছে */
            margin-bottom: 1.8rem;
        }

        .search-input {
            padding: 0.9rem 1.2rem; /* প্যাডিং বাড়ানো হয়েছে */
            border: 2px solid #e2e8f0;
            border-radius: 12px; /* কোণা রাউন্ডার করা হয়েছে */
            font-size: 1rem;
            transition: all 0.3s ease;
            color: var(--dark);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(90, 103, 216, 0.2); /* শ্যাডো কালার আপডেট করা হয়েছে */
        }

        .search-btn {
            background: linear-gradient(135deg, var(--accent) 0%, #ff9e7d 100%);
            color: white;
            border: none;
            padding: 0.9rem 1.8rem; /* প্যাডিং বাড়ানো হয়েছে */
            border-radius: 12px; /* কোণা রাউন্ডার করা হয়েছে */
            font-size: 1.05rem; /* ফন্ট সাইজ একটু বাড়ানো হয়েছে */
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px; /* গ্যাপ বাড়ানো হয়েছে */
            box-shadow: 0 4px 12px rgba(252, 129, 129, 0.3); /* শ্যাডো কালার আপডেট করা হয়েছে */
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(252, 129, 129, 0.4);
        }

        .filters-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.2rem; /* গ্যাপ বাড়ানো হয়েছে */
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-label {
            margin-bottom: 0.6rem; /* মার্জিন বাড়ানো হয়েছে */
            font-weight: 600;
            color: var(--dark);
            font-size: 0.95rem;
        }

        .filter-select {
            padding: 0.9rem; /* প্যাডিং বাড়ানো হয়েছে */
            border: 2px solid #e2e8f0;
            border-radius: 12px; /* কোণা রাউন্ডার করা হয়েছে */
            font-size: 1rem;
            background: white;
            transition: all 0.3s ease;
            color: var(--text);
            -webkit-appearance: none; /* remove default arrow */
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23a0aec0'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.2em;
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(90, 103, 216, 0.2);
        }

        .events-section {
            background: white;
            border-radius: 15px;
            padding: 1.8rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        .events-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.8rem;
        }

        .events-title {
            font-size: 1.4rem;
            color: var(--primary);
            font-weight: 600;
        }

        .events-count {
            color: var(--text);
            font-size: 0.95rem;
        }

        .view-toggle {
            display: flex;
            background: var(--light);
            border-radius: 12px;
            padding: 0.4rem;
        }

        .view-btn {
            background: none;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--text);
            font-size: 1.1rem;
        }

        .view-btn.active {
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            color: var(--primary);
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); /* কার্ডের সাইজ একটু কমানো হয়েছে */
            gap: 1.5rem;
        }

        .event-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            position: relative;
        }

        .event-card:hover {
            transform: translateY(-7px); /* হোভার ইফেক্ট বাড়ানো হয়েছে */
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15); /* শ্যাডো গাঢ় করা হয়েছে */
        }

        .event-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 1.5rem;
            position: relative;
        }

        .event-date {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .date-badge {
            background: rgba(255, 255, 255, 0.25); /* হালকা ব্যাকগ্রাউন্ড */
            padding: 0.6rem 1.2rem;
            border-radius: 25px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .event-title {
            font-size: 1.4rem; /* সাইজ একটু বাড়ানো হয়েছে */
            font-weight: 700;
            margin-bottom: 0.6rem;
        }

        .event-organizer {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
            opacity: 0.95;
            font-weight: 500;
        }

        .event-body {
            padding: 1.5rem;
        }

        .event-details {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 1.2rem;
            margin-bottom: 1.8rem;
        }

        .detail-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .detail-icon {
            color: var(--primary);
            margin-top: 3px;
            width: 22px;
            font-size: 1.1rem;
        }

        .detail-content {
            display: flex;
            flex-direction: column;
        }

        .detail-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.3rem;
            font-size: 0.95rem;
        }

        .detail-value {
            font-size: 0.9rem;
            color: var(--text);
            line-height: 1.3;
        }

        .event-services {
            margin-bottom: 1.8rem;
        }

        .services-title {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .services-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem; /* গ্যাপ বাড়ানো হয়েছে */
        }

        .service-tag {
            background: rgba(90, 103, 216, 0.1); /* প্রাইমারি কালারের হালকা শেড */
            color: var(--primary);
            padding: 0.4rem 0.9rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: background 0.2s ease;
        }
        .service-tag:hover {
            background: rgba(90, 103, 216, 0.2);
        }

        .event-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 1.5rem; /* প্যাডিং বাড়ানো হয়েছে */
            background: var(--light);
            border-top: 1px solid #e2e8f0;
        }

        .rsvp-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .rsvp-count {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
            color: var(--text);
            font-weight: 500;
        }

        .rsvp-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .rsvp-btn:hover {
            background: var(--secondary);
            transform: translateY(-1px);
        }

        .rsvp-btn.rsvped {
            background: var(--success);
        }

        .event-actions {
            display: flex;
            gap: 0.6rem; /* গ্যাপ বাড়ানো হয়েছে */
        }

        .action-btn {
            background: none;
            border: 1px solid #e2e8f0;
            padding: 0.6rem; /* প্যাডিং বাড়ানো হয়েছে */
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--text);
            font-size: 1.1rem;
        }

        .action-btn:hover {
            background: var(--light);
            border-color: var(--primary);
            color: var(--primary);
        }

        .set-reminder-btn {
            background: var(--warning);
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .set-reminder-btn:hover {
            background: #e07b2d;
            transform: translateY(-1px);
        }

        .set-reminder-btn.reminder-set {
            background: var(--success);
        }

        /* Create Event Button */
        .create-event-btn {
            position: fixed;
            bottom: 90px;
            right: 25px; /* অবস্থান একটু ডানে সরানো হয়েছে */
            background: linear-gradient(135deg, var(--accent) 0%, #ff9e7d 100%);
            color: white;
            border: none;
            width: 65px; /* সাইজ একটু বাড়ানো হয়েছে */
            height: 65px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem; /* ফন্ট সাইজ একটু বাড়ানো হয়েছে */
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(252, 129, 129, 0.4); /* শ্যাডো গাঢ় করা হয়েছে */
            transition: all 0.3s ease;
            z-index: 90;
        }

        .create-event-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(252, 129, 129, 0.6);
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
            padding: 1rem 0; /* প্যাডিং বাড়ানো হয়েছে */
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.1); /* শ্যাডো গাঢ় করা হয়েছে */
            z-index: 100;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--text);
            font-size: 0.85rem; /* ফন্ট সাইজ একটু বাড়ানো হয়েছে */
            transition: all 0.3s ease;
            padding: 0.5rem;
            border-radius: 8px;
        }

        .nav-item.active {
            color: var(--primary);
            background-color: var(--light); /* অ্যাক্টিভ আইটেমের হালকা ব্যাকগ্রাউন্ড */
        }

        .nav-item:hover {
            background-color: var(--light);
            color: var(--primary);
        }

        .nav-icon {
            font-size: 1.3rem; /* সাইজ একটু বাড়ানো হয়েছে */
            margin-bottom: 0.4rem;
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
            
            .logo {
                font-size: 1.8rem; /* ছোট স্ক্রিনে লোগোর সাইজ কমানো হয়েছে */
            }
            
            .header-actions {
                gap: 0.5rem;
            }
            .language-toggle, .notification-toggle {
                padding: 0.4rem 0.8rem;
                font-size: 0.85rem;
                gap: 5px;
            }

            .notification-panel {
                width: 100%;
                right: -100%;
            }
            
            .stats-section {
                grid-template-columns: repeat(2, 1fr);
            }

            .search-section, .events-section {
                padding: 1rem;
            }

            .search-container {
                grid-template-columns: 1fr;
                gap: 0.8rem;
            }
            .search-input, .search-btn {
                padding: 0.7rem 1rem;
                font-size: 0.95rem;
            }
            
            .filters-container {
                grid-template-columns: 1fr;
            }
            .filter-select {
                padding: 0.7rem;
            }

            .events-grid {
                grid-template-columns: 1fr;
            }

            .event-card {
                margin: 0 auto; /* সিঙ্গেল কলামে কার্ড মাঝখানে আনতে */
                max-width: 380px; /* সর্বোচ্চ চওড়া নির্ধারণ করা হয়েছে */
            }

            .create-event-btn {
                width: 55px;
                height: 55px;
                font-size: 1.4rem;
                bottom: 80px;
                right: 15px;
            }

            .footer-nav {
                padding: 0.6rem 0;
            }
            .nav-item {
                font-size: 0.75rem;
                padding: 0.3rem;
            }
            .nav-icon {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 480px) {
            .stats-section {
                grid-template-columns: 1fr; /* একদম ছোট স্ক্রিনে সিঙ্গেল কলাম */
            }
            .header-content {
                flex-direction: column;
                gap: 1rem;
            }
            .header-actions {
                width: 100%;
                justify-content: space-around;
            }
            .logo {
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <a href="#" class="logo">মন<span>বন্ধু</span></a>
            <div class="header-actions">
                <button class="language-toggle" id="languageToggle">
                    <i class="fas fa-language"></i>
                    <span id="languageText">English</span>
                </button>
                <button class="notification-toggle" id="notificationToggle">
                    <i class="fas fa-bell"></i>
                    <span id="notification-text">Notifications</span>
                    <div class="notification-badge" id="notificationBadge">3</div>
                </button>
            </div>
        </div>
    </header>

    <div class="notification-panel" id="notificationPanel">
        <div class="notification-header">
            <h3 class="notification-title" id="notification-panel-title">Notifications</h3>
            <button class="notification-close" id="notificationClose">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="notification-tabs">
            <button class="notification-tab active" data-tab="all" id="all">All</button>
            <button class="notification-tab" data-tab="reminders" id="reminders">Reminders</button>
            <button class="notification-tab" data-tab="updates" id="updates">Updates</button>
        </div>
        <div class="notification-content">
            <div class="notification-list" id="notificationList">
                </div>
        </div>
    </div>

    <div class="container">
        <div class="stats-section fade-in">
            <div class="stat-card">
                <div class="stat-value" id="upcoming-count">12</div>
                <div class="stat-label" id="upcoming-label">Upcoming Events</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="rsvp-count">47</div>
                <div class="stat-label" id="rsvp-label">Total RSVPs</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="locations-count">8</div>
                <div class="stat-label" id="locations-label">Locations</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="reminders-count">5</div>
                <div class="stat-label" id="reminders-label">Active Reminders</div>
            </div>
        </div>

        <div class="search-section fade-in">
            <div class="search-header">
                <i class="fas fa-search search-icon"></i>
                <h2 class="search-title" id="search-title">Find Health Events</h2>
            </div>
            
            <div class="search-container">
                <input type="text" class="search-input" id="searchInput" placeholder="Search by event name, service, or location...">
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
                    <label class="filter-label" id="service-label">Service Type</label>
                    <select class="filter-select" id="serviceFilter">
                        <option value="">All Services</option>
                        <option value="blood-pressure">Blood Pressure Check</option>
                        <option value="vaccination">Vaccination</option>
                        <option value="dental">Dental Checkup</option>
                        <option value="eye-care">Eye Care</option>
                        <option value="nutrition">Nutrition Counseling</option>
                        <option value="mental-health">Mental Health</option>
                        <option value="child-health">Child Health</option>
                        <option value="women-health">Women-s Health</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label class="filter-label" id="date-label">Date Range</label>
                    <select class="filter-select" id="dateFilter">
                        <option value="">Any Date</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                        <option value="upcoming">Upcoming</option>
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
            </div>
        </div>

        <div class="events-section fade-in">
            <div class="events-header">
                <div>
                    <h3 class="events-title" id="events-title">Community Events</h3>
                    <div class="events-count" id="eventsCount">Showing 0 events</div>
                </div>
                
                <div class="view-toggle">
                    <button class="view-btn active" data-view="grid">
                        <i class="fas fa-th"></i>
                    </button>
                    <button class="view-btn" data-view="list">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
            
            <div class="events-grid" id="gridView">
                </div>
        </div>
    </div>

    <button class="create-event-btn" id="createEventBtn">
        <i class="fas fa-plus"></i>
    </button>

    <div class="footer-nav">
        <a href="dashboard.php" class="nav-item active">
            <i class="fas fa-home nav-icon"></i>
            <span id="nav-home">Home</span>
        </a>
        <a href="events.php" class="nav-item">
            <i class="fas fa-calendar nav-icon"></i>
            <span id="nav-events">Events</span>
        </a>
        <a href="#" class="nav-item">
            <i class="fas fa-bell nav-icon"></i>
            <span id="nav-notifications">Notifications</span>
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
                appTitle: "Community Health Events",
                languageText: "English",
                searchTitle: "Find Health Events",
                searchText: "Search",
                locationLabel: "Location",
                serviceLabel: "Service Type",
                dateLabel: "Date Range",
                organizationLabel: "Organization",
                eventsTitle: "Community Events",
                navHome: "Home",
                navEvents: "Events",
                navNotifications: "Notifications", 
                navProfile: "Profile",
                upcomingLabel: "Upcoming Events",
                rsvpLabel: "Total RSVPs",
                locationsLabel: "Locations",
                remindersLabel: "Active Reminders",
                date: "Date",
                time: "Time",
                location: "Location",
                organizer: "Organizer",
                services: "Services Offered",
                rsvp: "RSVP",
                rsvped: "RSVPed",
                people: "people",
                share: "Share",
                save: "Save",
                free: "Free",
                setReminder: "Set Reminder",
                reminderSet: "Reminder Set",
                notificationText: "Notifications",
                notificationPanelTitle: "Notifications",
                reminderNotification: "Event Reminder",
                eventUpdateNotification: "Event Update",
                newEventNotification: "New Event",
                rsvpConfirmation: "RSVP Confirmation",
                viewEvent: "View Event",
                dismiss: "Dismiss",
                markRead: "Mark as Read",
                noNotifications: "No notifications",
                all: "All",
                reminders: "Reminders",
                updates: "Updates"
            },
            bn: {
                appTitle: "কমিউনিটি স্বাস্থ্য ইভেন্ট",
                languageText: "বাংলা",
                searchTitle: "স্বাস্থ্য ইভেন্ট খুঁজুন",
                searchText: "খুঁজুন",
                locationLabel: "অবস্থান",
                serviceLabel: "সেবার ধরন",
                dateLabel: "তারিখের পরিসীমা",
                organizationLabel: "সংস্থা",
                eventsTitle: "কমিউনিটি ইভেন্ট",
                navHome: "হোম",
                navEvents: "ইভেন্ট",
                navNotifications: "নোটিফিকেশন",
                navProfile: "প্রোফাইল",
                upcomingLabel: "আসন্ন ইভেন্ট",
                rsvpLabel: "মোট RSVP",
                locationsLabel: "অবস্থান",
                remindersLabel: "সক্রিয় রিমাইন্ডার",
                date: "তারিখ",
                time: "সময়",
                location: "অবস্থান",
                organizer: "আয়োজক",
                services: "সেবা প্রদান",
                rsvp: "RSVP",
                rsvped: "RSVP করা হয়েছে",
                people: "জন",
                share: "শেয়ার করুন",
                save: "সেভ করুন",
                free: "ফ্রি",
                setReminder: "রিমাইন্ডার সেট করুন",
                reminderSet: "রিমাইন্ডার সেট হয়েছে",
                notificationText: "নোটিফিকেশন",
                notificationPanelTitle: "নোটিফিকেশন",
                reminderNotification: "ইভেন্ট রিমাইন্ডার",
                eventUpdateNotification: "ইভেন্ট আপডেট",
                newEventNotification: "নতুন ইভেন্ট",
                rsvpConfirmation: "RSVP নিশ্চিতকরণ",
                viewEvent: "ইভেন্ট দেখুন",
                dismiss: "বাতিল করুন",
                markRead: "পড়া হয়েছে মার্ক করুন",
                noNotifications: "কোন নোটিফিকেশন নেই",
                all: "সব",
                reminders: "রিমাইন্ডার",
                updates: "আপডেট"
            }
        };

        // Sample event data
        const eventData = [
            {
                id: 1,
                title: "Free Health Checkup Camp",
                date: "2023-12-15",
                time: "9:00 AM - 2:00 PM",
                location: "Dhaka Division",
                address: "Community Center, Mirpur-10",
                organizer: "BRAC Health",
                services: ["Blood Pressure Check", "Blood Sugar Test", "BMI Measurement", "General Consultation"],
                rsvpCount: 23,
                maxCapacity: 50,
                isFree: true,
                contact: "+880 1234 567890",
                description: "A comprehensive health checkup camp with free services for the community."
            },
            {
                id: 2,
                title: "Vaccination Drive for Children",
                date: "2023-12-18",
                time: "10:00 AM - 4:00 PM",
                location: "Chattogram Division",
                address: "Primary School, Cox's Bazar",
                organizer: "Government Health Department",
                services: ["Child Vaccination", "Nutrition Assessment", "Growth Monitoring"],
                rsvpCount: 15,
                maxCapacity: 30,
                isFree: true,
                contact: "+880 1987 654321",
                description: "Free vaccination for children under 5 years with nutrition counseling for parents."
            },
            {
                id: 3,
                title: "Mental Health Awareness Session",
                date: "2023-12-20",
                time: "3:00 PM - 5:00 PM",
                location: "Rajshahi Division",
                address: "Town Hall, Bogra",
                organizer: "ASA Mental Health Initiative",
                services: ["Mental Health Screening", "Counseling", "Stress Management", "Group Therapy"],
                rsvpCount: 8,
                maxCapacity: 25,
                isFree: true,
                contact: "+880 1678 543210",
                description: "An interactive session on mental health awareness and coping strategies."
            }
        ];

        // Notification system
        let notifications = JSON.parse(localStorage.getItem('healthEventNotifications')) || [];
        let reminders = JSON.parse(localStorage.getItem('healthEventReminders')) || [];

        // Current language
        let currentLang = 'bn'; // Default to Bengali based on your request

        // DOM Elements
        const languageToggle = document.getElementById('languageToggle');
        const notificationToggle = document.getElementById('notificationToggle');
        const notificationPanel = document.getElementById('notificationPanel');
        const notificationClose = document.getElementById('notificationClose');
        const notificationBadge = document.getElementById('notificationBadge');
        const notificationList = document.getElementById('notificationList');
        const notificationTabs = document.querySelectorAll('.notification-tab');
        const searchInput = document.getElementById('searchInput');
        const searchBtn = document.getElementById('searchBtn');
        const locationFilter = document.getElementById('locationFilter');
        const serviceFilter = document.getElementById('serviceFilter');
        const dateFilter = document.getElementById('dateFilter');
        const organizationFilter = document.getElementById('organizationFilter');
        const gridView = document.getElementById('gridView');
        const eventsCount = document.getElementById('eventsCount');
        const createEventBtn = document.getElementById('createEventBtn');

        // Initialize the app
        document.addEventListener('DOMContentLoaded', function() {
            // Set up language toggle
            languageToggle.addEventListener('click', toggleLanguage);

            // Set up notification system
            notificationToggle.addEventListener('click', toggleNotificationPanel);
            notificationClose.addEventListener('click', closeNotificationPanel);
            
            // Set up notification tabs
            notificationTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const tabType = this.getAttribute('data-tab');
                    switchNotificationTab(tabType);
                    
                    // Update active tab
                    notificationTabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Set up search and filters
            searchBtn.addEventListener('click', filterEvents);
            searchInput.addEventListener('input', filterEvents);
            locationFilter.addEventListener('change', filterEvents);
            serviceFilter.addEventListener('change', filterEvents);
            dateFilter.addEventListener('change', filterEvents);
            organizationFilter.addEventListener('change', filterEvents);

            // Set up create event button
            createEventBtn.addEventListener('click', function() {
                alert(currentLang === 'en' 
                    ? 'Create New Event feature would open here' 
                    : 'নতুন ইভেন্ট তৈরি বৈশিষ্ট্য এখানে খুলবে');
            });

            // Initialize notifications
            initializeNotifications();
            
            // Initial render
            updateLanguage(); // Initial language update
            filterEvents();
            
            // Set up footer navigation
            setupFooterNavigation();
            
            // Simulate receiving notifications (in a real app, this would come from a server)
            simulateNotifications();
            
            // Check for offline reminders
            checkOfflineReminders();
        });

        // Toggle language function
        function toggleLanguage() {
            currentLang = currentLang === 'en' ? 'bn' : 'en';
            updateLanguage();
            filterEvents(); // Re-render with new language
            renderNotifications(); // Re-render notifications with new language
        }

        // Update all text based on current language
        function updateLanguage() {
            const t = translations[currentLang];
            
            // Update all elements with translations
            document.title = t.appTitle; // Update page title
            
            // Update text for all elements with specific IDs
            const elementsToTranslate = [
                'languageText', 'searchTitle', 'searchText', 'locationLabel', 'serviceLabel', 
                'dateLabel', 'organizationLabel', 'eventsTitle', 'navHome', 'navEvents', 
                'navNotifications', 'navProfile', 'upcomingLabel', 'rsvpLabel', 'locationsLabel', 
                'remindersLabel', 'notificationText', 'notificationPanelTitle', 'all', 'reminders', 'updates'
            ];

            elementsToTranslate.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.textContent = t[id];
                }
            });
            
            // Update placeholder for search input
            if (searchInput) {
                searchInput.placeholder = currentLang === 'en' 
                    ? 'Search by event name, service, or location...' 
                    : 'ইভেন্টের নাম, সেবা বা অবস্থান দিয়ে খুঁজুন...';
            }

            // Update select options (more complex)
            updateSelectOptions(locationFilter, {
                '': 'All Locations',
                'dhaka': 'Dhaka Division',
                'chattogram': 'Chattogram Division',
                'rajshahi': 'Rajshahi Division',
                'khulna': 'Khulna Division',
                'barishal': 'Barishal Division',
                'sylhet': 'Sylhet Division',
                'rangpur': 'Rangpur Division',
                'mymensingh': 'Mymensingh Division'
            }, currentLang);

            updateSelectOptions(serviceFilter, {
                '': 'All Services',
                'blood-pressure': 'Blood Pressure Check',
                'vaccination': 'Vaccination',
                'dental': 'Dental Checkup',
                'eye-care': 'Eye Care',
                'nutrition': 'Nutrition Counseling',
                'mental-health': 'Mental Health',
                'child-health': 'Child Health',
                'women-health': 'Women\'s Health'
            }, currentLang);

            updateSelectOptions(dateFilter, {
                '': 'Any Date',
                'today': 'Today',
                'week': 'This Week',
                'month': 'This Month',
                'upcoming': 'Upcoming'
            }, currentLang);

            updateSelectOptions(organizationFilter, {
                '': 'All Organizations',
                'brac': 'BRAC',
                'asa': 'ASA',
                'grameen': 'Grameen',
                'red-crescent': 'Bangladesh Red Crescent',
                'government': 'Government',
                'other': 'Other'
            }, currentLang);

            languageText.textContent = currentLang === 'en' ? 'English' : 'বাংলা';
        }

        function updateSelectOptions(selectElement, optionsMap, lang) {
            const currentSelectedValue = selectElement.value;
            selectElement.innerHTML = ''; // Clear existing options

            for (const value in optionsMap) {
                const option = document.createElement('option');
                option.value = value;
                // Translate the text content of the option
                option.textContent = lang === 'en' ? optionsMap[value] : translateOptionText(optionsMap[value]);
                if (value === currentSelectedValue) {
                    option.selected = true;
                }
                selectElement.appendChild(option);
            }
        }

        function translateOptionText(englishText) {
            switch (englishText) {
                case 'All Locations': return 'সকল অবস্থান';
                case 'Dhaka Division': return 'ঢাকা বিভাগ';
                case 'Chattogram Division': return 'চট্টগ্রাম বিভাগ';
                case 'Rajshahi Division': return 'রাজশাহী বিভাগ';
                case 'Khulna Division': return 'খুলনা বিভাগ';
                case 'Barishal Division': return 'বরিশাল বিভাগ';
                case 'Sylhet Division': return 'সিলেট বিভাগ';
                case 'Rangpur Division': return 'রংপুর বিভাগ';
                case 'Mymensingh Division': return 'ময়মনসিংহ বিভাগ';
                
                case 'All Services': return 'সকল সেবা';
                case 'Blood Pressure Check': return 'রক্তচাপ পরীক্ষা';
                case 'Vaccination': return 'টিকাদান';
                case 'Dental Checkup': return 'দাঁতের পরীক্ষা';
                case 'Eye Care': return 'চোখের যত্ন';
                case 'Nutrition Counseling': return 'পুষ্টি পরামর্শ';
                case 'Mental Health': return 'মানসিক স্বাস্থ্য';
                case 'Child Health': return 'শিশু স্বাস্থ্য';
                case 'Women\'s Health': return 'নারী স্বাস্থ্য';

                case 'Any Date': return 'যেকোনো তারিখ';
                case 'Today': return 'আজ';
                case 'This Week': return 'এই সপ্তাহ';
                case 'This Month': return 'এই মাস';
                case 'Upcoming': return 'আসন্ন';

                case 'All Organizations': return 'সকল সংস্থা';
                case 'BRAC': return 'ব্র্যাক';
                case 'ASA': return 'আশা';
                case 'Grameen': return 'গ্রামীণ';
                case 'Bangladesh Red Crescent': return 'বাংলাদেশ রেড ক্রিসেন্ট';
                case 'Government': return 'সরকার';
                case 'Other': return 'অন্যান্য';
                default: return englishText;
            }
        }


        // Initialize notifications
        function initializeNotifications() {
            // Load saved notifications and reminders from localStorage
            notifications = JSON.parse(localStorage.getItem('healthEventNotifications')) || [];
            reminders = JSON.parse(localStorage.getItem('healthEventReminders')) || [];
            
            // Update badge count
            updateNotificationBadge();
            
            // Render notifications
            renderNotifications();
        }

        // Toggle notification panel
        function toggleNotificationPanel() {
            notificationPanel.classList.toggle('active');
        }

        // Close notification panel
        function closeNotificationPanel() {
            notificationPanel.classList.remove('active');
        }

        // Switch notification tab
        function switchNotificationTab(tabType) {
            renderNotifications(tabType);
        }

        // Render notifications
        function renderNotifications(filter = 'all') {
            const t = translations[currentLang];
            notificationList.innerHTML = '';
            
            let filteredNotifications = [];
            
            if (filter === 'all') {
                filteredNotifications = [...notifications, ...reminders];
            } else if (filter === 'reminders') {
                filteredNotifications = reminders;
            } else if (filter === 'updates') {
                filteredNotifications = notifications.filter(n => n.type !== 'reminder');
            }
            
            // Sort by timestamp (newest first)
            filteredNotifications.sort((a, b) => new Date(b.timestamp) - new Date(a.timestamp));
            
            if (filteredNotifications.length === 0) {
                notificationList.innerHTML = `<div class="no-notifications">${t.noNotifications}</div>`;
                return;
            }
            
            filteredNotifications.forEach(notification => {
                const notificationEl = document.createElement('div');
                notificationEl.className = `notification-item ${notification.read ? '' : 'unread'} ${notification.type === 'reminder' ? 'reminder' : ''}`;
                
                const timeAgo = getTimeAgo(notification.timestamp);
                
                notificationEl.innerHTML = `
                    <div class="notification-header-row">
                        <div class="notification-title">${notification.title}</div>
                        <div class="notification-time">${timeAgo}</div>
                    </div>
                    <div class="notification-message">${notification.message}</div>
                    <div class="notification-actions">
                        <button class="notification-action" data-id="${notification.id}" data-type="${notification.type}">
                            <i class="fas fa-eye"></i>
                            <span>${t.viewEvent}</span>
                        </button>
                        ${!notification.read ? `
                            <button class="notification-action mark-read" data-id="${notification.id}" data-type="${notification.type}">
                                <i class="fas fa-check"></i>
                                <span>${t.markRead}</span>
                            </button>
                        ` : ''}
                        <button class="notification-action dismiss" data-id="${notification.id}" data-type="${notification.type}">
                            <i class="fas fa-times"></i>
                            <span>${t.dismiss}</span>
                        </button>
                    </div>
                `;
                
                notificationList.appendChild(notificationEl);
            });
            
            // Add event listeners to notification actions
            document.querySelectorAll('.notification-action').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const type = this.getAttribute('data-type');
                    const action = this.classList.contains('mark-read') ? 'mark-read' : 
                                  this.classList.contains('dismiss') ? 'dismiss' : 'view';
                    
                    handleNotificationAction(id, type, action);
                });
            });
        }

        // Handle notification actions
        function handleNotificationAction(id, type, action) {
            if (action === 'mark-read') {
                if (type === 'notification') {
                    const notification = notifications.find(n => n.id === id);
                    if (notification) {
                        notification.read = true;
                        localStorage.setItem('healthEventNotifications', JSON.stringify(notifications));
                    }
                } else if (type === 'reminder') {
                    const reminder = reminders.find(r => r.id === id);
                    if (reminder) {
                        reminder.read = true;
                        localStorage.setItem('healthEventReminders', JSON.stringify(reminders));
                    }
                }
                updateNotificationBadge();
                renderNotifications();
            } else if (action === 'dismiss') {
                if (type === 'notification') {
                    notifications = notifications.filter(n => n.id !== id);
                    localStorage.setItem('healthEventNotifications', JSON.stringify(notifications));
                } else if (type === 'reminder') {
                    reminders = reminders.filter(r => r.id !== id);
                    localStorage.setItem('healthEventReminders', JSON.stringify(reminders));
                }
                updateNotificationBadge();
                renderNotifications();
            } else if (action === 'view') {
                // In a real app, this would navigate to the event
                alert(currentLang === 'en' 
                    ? 'Viewing event details...' 
                    : 'ইভেন্টের বিস্তারিত দেখানো হচ্ছে...');
            }
        }

        // Update notification badge
        function updateNotificationBadge() {
            const unreadCount = notifications.filter(n => !n.read).length + reminders.filter(r => !r.read).length;
            notificationBadge.textContent = unreadCount;
            notificationBadge.style.display = unreadCount > 0 ? 'flex' : 'none';
        }

        // Get time ago string
        function getTimeAgo(timestamp) {
            const now = new Date();
            const time = new Date(timestamp);
            const diffMs = now - time;
            const diffMins = Math.floor(diffMs / 60000);
            const diffHours = Math.floor(diffMs / 3600000);
            const diffDays = Math.floor(diffMs / 86400000);
            
            if (diffMins < 1) return currentLang === 'en' ? 'Just now' : 'এক্ষুনি';
            if (diffMins < 60) return `${diffMins} ${currentLang === 'en' ? 'mins ago' : 'মিনিট আগে'}`;
            if (diffHours < 24) return `${diffHours} ${currentLang === 'en' ? 'hours ago' : 'ঘন্টা আগে'}`;
            return `${diffDays} ${currentLang === 'en' ? 'days ago' : 'দিন আগে'}`;
        }

        // Simulate receiving notifications (for demo purposes)
        function simulateNotifications() {
            // Only add demo notifications if none exist
            if (notifications.length === 0 && reminders.length === 0) {
                // Add some sample notifications
                addNotification({
                    id: 'notif-1',
                    type: 'update',
                    title: translations[currentLang].eventUpdateNotification,
                    message: 'Free Health Checkup Camp timing has been updated to 9:00 AM - 2:00 PM',
                    timestamp: new Date(Date.now() - 30 * 60000).toISOString(), // 30 minutes ago
                    read: false,
                    eventId: 1
                });
                
                addNotification({
                    id: 'notif-2',
                    type: 'new',
                    title: translations[currentLang].newEventNotification,
                    message: 'New event added: Dental Care Camp on December 25',
                    timestamp: new Date(Date.now() - 2 * 3600000).toISOString(), // 2 hours ago
                    read: false,
                    eventId: 5
                });
                
                addNotification({
                    id: 'notif-3',
                    type: 'rsvp',
                    title: translations[currentLang].rsvpConfirmation,
                    message: 'Your RSVP for Vaccination Drive has been confirmed',
                    timestamp: new Date(Date.now() - 24 * 3600000).toISOString(), // 1 day ago
                    read: true,
                    eventId: 2
                });
                
                // Add a sample reminder
                addReminder({
                    id: 'reminder-1',
                    type: 'reminder',
                    title: translations[currentLang].reminderNotification,
                    message: 'Free Health Checkup Camp is tomorrow at 9:00 AM',
                    timestamp: new Date(Date.now() - 6 * 3600000).toISOString(), // 6 hours ago
                    read: false,
                    eventId: 1,
                    eventDate: '2023-12-15'
                });
            }
        }

        // Add a notification
        function addNotification(notification) {
            notifications.push(notification);
            localStorage.setItem('healthEventNotifications', JSON.stringify(notifications));
            updateNotificationBadge();
            
            // If notification panel is open, refresh it
            if (notificationPanel.classList.contains('active')) {
                renderNotifications();
            }
            
            // Show browser notification if supported and permission granted
            if ('Notification' in window && Notification.permission === 'granted') {
                new Notification(notification.title, {
                    body: notification.message,
                    icon: 'https://via.placeholder.com/48/5a67d8/ffffff?text=NB' // Placeholder icon
                });
            }
        }

        // Add a reminder
        function addReminder(reminder) {
            reminders.push(reminder);
            localStorage.setItem('healthEventReminders', JSON.stringify(reminders));
            updateNotificationBadge();
            
            // If notification panel is open, refresh it
            if (notificationPanel.classList.contains('active')) {
                renderNotifications();
            }
        }

        // Check for offline reminders
        function checkOfflineReminders() {
            // In a real app, this would use the Notification API with service workers
            // For this demo, we'll simulate checking for reminders when coming online
            
            // Check if we have any reminders for today
            const today = new Date().toISOString().split('T')[0];
            const todaysReminders = reminders.filter(r => r.eventDate === today && !r.read);
            
            if (todaysReminders.length > 0) {
                // Show alert for demo purposes (in real app, this would be a system notification)
                if (confirm(currentLang === 'en' 
                    ? `You have ${todaysReminders.length} event reminder(s) for today. View notifications?` 
                    : `আপনার আজকের জন্য ${todaysReminders.length}টি ইভেন্ট রিমাইন্ডার আছে। নোটিফিকেশন দেখবেন?`)) {
                    toggleNotificationPanel();
                }
            }
        }

        // Set reminder for an event
        function setEventReminder(eventId) {
            const event = eventData.find(e => e.id === eventId);
            if (!event) return;
            
            const reminderId = `reminder-${eventId}-${Date.now()}`;
            
            addReminder({
                id: reminderId,
                type: 'reminder',
                title: translations[currentLang].reminderNotification,
                message: `${event.title} ${currentLang === 'en' ? 'is on' : 'তারিখ'} ${formatEventDate(event.date)} ${currentLang === 'en' ? 'at' : 'সময়'} ${event.time}`,
                timestamp: new Date().toISOString(),
                read: false,
                eventId: eventId,
                eventDate: event.date
            });
            
            // Show confirmation
            alert(currentLang === 'en' 
                ? `Reminder set for ${event.title}` 
                : `${event.title}-এর জন্য রিমাইন্ডার সেট করা হয়েছে`);
        }

        // Format event date for display
        function formatEventDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString(currentLang === 'en' ? 'en-US' : 'bn-BD', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }

        // The rest of the event-related functions remain the same as previous implementation
        function filterEvents() {
            const searchTerm = searchInput.value.toLowerCase();
            const location = locationFilter.value;
            const service = serviceFilter.value;
            const dateRange = dateFilter.value;
            const organization = organizationFilter.value;
            
            const filteredEvents = eventData.filter(event => {
                // Search term filter
                if (searchTerm && !(
                    event.title.toLowerCase().includes(searchTerm) ||
                    event.location.toLowerCase().includes(searchTerm) ||
                    event.address.toLowerCase().includes(searchTerm) ||
                    event.services.some(s => s.toLowerCase().includes(searchTerm))
                )) {
                    return false;
                }
                
                // Location filter
                if (location && event.location.toLowerCase().replace(' division', '') !== location.toLowerCase()) {
                    return false;
                }
                
                // Service filter
                if (service && !event.services.some(s => s.toLowerCase().includes(service.replace('-', ' ')))) {
                    return false;
                }
                
                // Organization filter
                if (organization) {
                    const orgName = event.organizer.toLowerCase();
                    if (organization === 'brac' && !orgName.includes('brac')) return false;
                    if (organization === 'asa' && !orgName.includes('asa')) return false;
                    if (organization === 'grameen' && !orgName.includes('grameen')) return false;
                    if (organization === 'red-crescent' && !orgName.includes('red crescent')) return false;
                    if (organization === 'government' && !orgName.includes('government')) return false;
                }
                
                // Date filter (simplified for demo)
                if (dateRange) {
                    const eventDate = new Date(event.date);
                    const today = new Date();
                    
                    // Normalize date to midnight for comparison
                    const normalizeDate = (d) => new Date(d.getFullYear(), d.getMonth(), d.getDate());
                    const eventDateN = normalizeDate(eventDate);
                    const todayN = normalizeDate(today);
                    
                    if (dateRange === 'today' && eventDateN.getTime() !== todayN.getTime()) {
                        return false;
                    }
                    
                    if (dateRange === 'week') {
                        const nextWeek = new Date(todayN);
                        nextWeek.setDate(todayN.getDate() + 7);
                        if (eventDateN < todayN || eventDateN > nextWeek) return false;
                    }
                    
                    if (dateRange === 'month') {
                        const nextMonth = new Date(todayN);
                        nextMonth.setMonth(todayN.getMonth() + 1);
                        if (eventDateN < todayN || eventDateN > nextMonth) return false;
                    }
                    
                    if (dateRange === 'upcoming' && eventDateN < todayN) {
                        return false;
                    }
                }
                
                return true;
            });
            
            renderEvents(filteredEvents);
        }

        function renderEvents(events) {
            const t = translations[currentLang];
            
            // Handle pluralization for events count display
            const eventWord = currentLang === 'en' 
                ? (events.length === 1 ? 'event' : 'events') 
                : 'ইভেন্ট';
            const foundWord = currentLang === 'en' ? 'পাওয়া গেছে' : 'found'; // Corrected for Bengali
            const showingText = currentLang === 'en' ? 'Showing' : 'দেখাচ্ছে';


            eventsCount.textContent = `${showingText} ${events.length} ${eventWord} ${currentLang === 'bn' ? foundWord : ''}`;
            
            // Update stats
            document.getElementById('upcoming-count').textContent = events.length;
            document.getElementById('rsvp-count').textContent = events.reduce((sum, event) => sum + event.rsvpCount, 0);
            document.getElementById('locations-count').textContent = new Set(events.map(e => e.location)).size;
            document.getElementById('reminders-count').textContent = reminders.filter(r => !r.read).length;
            
            // Clear current views
            gridView.innerHTML = '';
            
            // Render grid view
            events.forEach(event => {
                const card = createEventCard(event);
                gridView.appendChild(card);
            });
        }

        function createEventCard(event) {
            const t = translations[currentLang];
            const card = document.createElement('div');
            card.className = 'event-card';
            
            // Format date
            const eventDate = new Date(event.date);
            const formattedDate = eventDate.toLocaleDateString(currentLang === 'en' ? 'en-US' : 'bn-BD', {
                weekday: 'short',
                month: 'short',
                day: 'numeric'
            });
            
            // Check if reminder is set for this event
            const hasReminder = reminders.some(r => r.eventId === event.id);
            
            card.innerHTML = `
                <div class="event-header">
                    <div class="event-date">
                        <div class="date-badge">
                            <i class="fas fa-calendar"></i>
                            <span>${formattedDate}</span>
                        </div>
                        ${event.isFree ? `<div class="date-badge"><i class="fas fa-tag"></i> ${t.free}</div>` : ''}
                    </div>
                    <h3 class="event-title">${event.title}</h3>
                    <div class="event-organizer">
                        <i class="fas fa-user-md"></i>
                        <span>${event.organizer}</span>
                    </div>
                </div>
                <div class="event-body">
                    <div class="event-details">
                        <div class="detail-item">
                            <i class="fas fa-clock detail-icon"></i>
                            <div class="detail-content">
                                <div class="detail-label">${t.time}</div>
                                <div class="detail-value">${event.time}</div>
                            </div>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-map-marker-alt detail-icon"></i>
                            <div class="detail-content">
                                <div class="detail-label">${t.location}</div>
                                <div class="detail-value">${event.address}</div>
                            </div>
                        </div>
                    </div>
                    <div class="event-services">
                        <div class="services-title">
                            <i class="fas fa-stethoscope"></i>
                            <span>${t.services}</span>
                        </div>
                        <div class="services-list">
                            ${event.services.map(service => `<span class="service-tag">${service}</span>`).join('')}
                        </div>
                    </div>
                </div>
                <div class="event-footer">
                    <div class="rsvp-section">
                        <div class="rsvp-count">
                            <i class="fas fa-users"></i>
                            <span>${event.rsvpCount} ${t.people}</span>
                        </div>
                        <button class="rsvp-btn" data-event="${event.id}">
                            <i class="fas fa-user-plus"></i>
                            <span>${t.rsvp}</span>
                        </button>
                        <button class="set-reminder-btn ${hasReminder ? 'reminder-set' : ''}" data-event="${event.id}">
                            <i class="fas fa-bell"></i>
                            <span>${hasReminder ? t.reminderSet : t.setReminder}</span>
                        </button>
                    </div>
                    <div class="event-actions">
                        <button class="action-btn" title="${t.share}">
                            <i class="fas fa-share-alt"></i>
                        </button>
                        <button class="action-btn" title="${t.save}">
                            <i class="fas fa-bookmark"></i>
                        </button>
                    </div>
                </div>
            `;
            
            // Add RSVP functionality
            const rsvpBtn = card.querySelector('.rsvp-btn');
            rsvpBtn.addEventListener('click', function() {
                const eventId = this.getAttribute('data-event');
                rsvpToEvent(eventId, this);
            });
            
            // Add reminder functionality
            const reminderBtn = card.querySelector('.set-reminder-btn');
            reminderBtn.addEventListener('click', function() {
                const eventId = this.getAttribute('data-event');
                setEventReminder(eventId);
                
                // Update button state visually right away
                this.innerHTML = `<i class="fas fa-bell"></i><span>${t.reminderSet}</span>`;
                this.classList.add('reminder-set');
            });
            
            return card;
        }

        function rsvpToEvent(eventId, button) {
            const event = eventData.find(e => e.id == eventId);
            if (!event) return;
            
            const t = translations[currentLang];
            
            if (event.rsvpCount >= event.maxCapacity) {
                alert(currentLang === 'en' 
                    ? 'Sorry, this event is at full capacity' 
                    : 'দুঃখিত, এই ইভেন্টটি পূর্ণ ক্ষমতায় পৌঁছেছে');
                return;
            }
            
            // In a real app, this would make an API call
            event.rsvpCount++;
            
            // Update button state
            button.innerHTML = `<i class="fas fa-check"></i><span>${t.rsvped}</span>`;
            button.classList.add('rsvped');
            button.disabled = true;
            
            // Add RSVP confirmation notification
            addNotification({
                id: `rsvp-${eventId}-${Date.now()}`,
                type: 'rsvp',
                title: t.rsvpConfirmation,
                message: `Your RSVP for ${event.title} has been confirmed`,
                timestamp: new Date().toISOString(),
                read: false,
                eventId: eventId
            });
            
            // Refresh events to update counts
            filterEvents();
        }

        function setupFooterNavigation() {
            const navItems = document.querySelectorAll('.nav-item');
            
            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all items
                    navItems.forEach(nav => nav.classList.remove('active'));
                    
                    // Add active class to clicked item
                    this.classList.add('active');
                    
                    // Handle navigation logic
                    const navTextElement = this.querySelector('span');
                    if (navTextElement) {
                        const navTarget = navTextElement.textContent; // Get the translated text
                        if (navTarget === translations[currentLang].navNotifications) {
                            toggleNotificationPanel();
                        } else if (navTarget === translations[currentLang].navEvents) {
                            // Current page, so no action needed other than preventing default
                        } else {
                            // For other tabs, show an alert in this demo
                            alert(`${currentLang === 'en' ? 'Navigating to' : 'নেভিগেট করা হচ্ছে'} ${navTarget}`);
                            // In a real application, you would change window.location.href here
                            // window.location.href = this.getAttribute('href');
                        }
                    }
                });
            });
        }

        // Request notification permission on page load
        if ('Notification' in window) {
            Notification.requestPermission();
        }
    </script>
</body>
</html> 