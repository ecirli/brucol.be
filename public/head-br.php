<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brussels College Brochure</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    <!-- Font awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
// ...existing code...
    <style>
        /* ---------- PRINT LAYOUT ---------- */
        @page { size: A4; margin: 0; }
        html, body { height: 100%; }
        body {
            margin: 0;
            font-family: "Inter", sans-serif;
            color: #313e3b;
            background: #f3f5f7;
        }

        /* ---------- PAGE ---------- */
        .page {
            width: 210mm;
            height: 297mm;
            margin: 0 auto 12px;
            background: #fff;
            box-sizing: border-box;
            padding: 16mm 15mm 12mm 15mm;
            display: flex;
            flex-direction: column;
            page-break-after: always;
            position: relative;
            overflow: hidden;
        }
        
        .page:last-of-type {
            page-break-after: avoid;
        }
        
        .page-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 0;
        }
        
        /* Background Geometric Shapes */
        .page::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 85% 15%, rgba(213, 213, 43, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 15% 85%, rgba(213, 213, 43, 0.06) 0%, transparent 40%),
                linear-gradient(45deg, transparent 0%, rgba(213, 213, 43, 0.03) 50%, transparent 100%);
            pointer-events: none;
            z-index: 0;
        }
        
        .page > * {
            position: relative;
            z-index: 1;
        }
        
        /* Additional geometric elements */
        .page::after {
            content: "";
            position: absolute;
            top: 20%;
            right: -8%;
            width: 180px;
            height: 180px;
            border: 2px solid rgba(213, 213, 43, 0.12);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        /* Hexagon shapes */
        .geometric-bg {
            position: absolute;
            width: 60px;
            height: 60px;
            background: rgba(213, 213, 43, 0.05);
            clip-path: polygon(30% 0%, 70% 0%, 100% 50%, 70% 100%, 30% 100%, 0% 50%);
            z-index: 0;
        }
        
        .geometric-bg.hex-1 {
            top: 15%;
            left: 5%;
            transform: rotate(15deg);
        }
        
        .geometric-bg.hex-2 {
            bottom: 25%;
            right: 8%;
            transform: rotate(-25deg);
        }
        
        .geometric-bg.hex-3 {
            top: 60%;
            left: 12%;
            width: 40px;
            height: 40px;
            transform: rotate(45deg);
        }
        
        @media print {
            body { background: #fff; padding: 0; }
            .page { margin: 0; box-shadow: none; }
        }
        
        @media screen {
            .page { box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
        }

        /* ---------- TYPOGRAPHY ---------- */
        h1 { font-size: 30px; line-height: 1.15; margin: 0 0 10px; letter-spacing: -0.5px; font-weight: 800; color: #313e3b; font-family: 'Space Grotesk', sans-serif; }
        h2 { font-size: 20px; line-height: 1.2; margin: 0 0 8px; font-weight: 700; color: #313e3b; font-family: 'Space Grotesk', sans-serif; }
        h3 { font-size: 16px; line-height: 1.3; margin: 8px 0 5px; font-weight: 600; color: #313e3b; }
        p  { font-size: 14px; line-height: 1.5; margin: 0 0 6px; color: #313e3b; }
        small { font-size: 12px; color: #828c8a; }
        .text-muted { color: #828c8a; }
        .eyebrow { 
            text-transform: none; /* Remove automatic uppercase */
            letter-spacing: 0.5px; 
            font-weight: 700; 
            color: #313e3b; 
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 4px;
            padding: 3px 8px;
            font-size: 11px; 
            margin-bottom: 6px; 
            display: inline-block;
            border-left: 6px solid #d5d52b;
            border-right: 1px solid #dee2e6;
            border-top: 1px solid #dee2e6;
            border-bottom: 1px solid #dee2e6;
        }

        /* ---------- HEADER & FOOTER ---------- */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #e4e4e4;
            padding-bottom: 10px;
            margin-bottom: 12px;
            flex-shrink: 0;
        }
        
        .logo { 
            height: 42px; 
        }
        
        .page-title { 
            font-weight: 700; 
            color: #313e3b; 
            font-size: 15px; 
            letter-spacing: 0.3px; 
        }
        
        .footer {
            border-top: 1px solid #e4e4e4;
            padding-top: 8px;
            margin-top: auto;
            font-size: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #828c8a;
            flex-shrink: 0;
        }
        
        .footer a { 
            color: #313e3b; 
            text-decoration: none; 
        }

        /* ---------- LAYOUT COMPONENTS ---------- */
        .hero-section {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 16px;
            align-items: start;
            margin-bottom: 14px;
        }
        
        .hero-image {
            width: 100%;
            height: 65mm;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        
        .callout {
            background: linear-gradient(135deg, #f0f033 40%, #e6e629 60%);
            color: #2a2a2a;
            padding: 12px 16px;
            border-radius: 12px;
            text-align: center;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.3px;
            margin: 8px 0;
            box-shadow: 0 4px 15px rgba(240, 240, 51, 0.3);
        }
        
        .highlight-badge {
            display: inline-block;
            background: linear-gradient(135deg, #f0f033 0%, #e6e629 100%);
            color: #2a2a2a;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.3px;
            margin-bottom: 10px;
        }

        /* ---------- GRID SYSTEMS ---------- */
        .grid-2 { 
            display: grid; 
            grid-template-columns: 1fr 1fr; 
            gap: 12px; 
        }
        
        .grid-3 { 
            display: grid; 
            grid-template-columns: repeat(3, 1fr); 
            gap: 12px; 
        }
        
        .split-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        /* ---------- CARDS & CONTENT BLOCKS ---------- */
        .card {
            border: 1px solid #e4e4e4;
            border-radius: 10px;
            padding: 12px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            margin-bottom: 6px;
        }
        
        .programme-card {
            border: 1px solid #e4e4e4;
            border-radius: 12px;
            padding: 18px;
            background: #fff;
            height: fit-content;
            margin: 0 auto;
            max-width: 600px;
        }
        
        .feature-list {
            margin: 5px 0;
            padding: 0;
            list-style: none;
        }
        
        .feature-list li {
            position: relative;
            padding-left: 18px;
            margin: 4px 0;
            font-size: 13px;
            line-height: 1.4;
        }
        
        .feature-list li::before {
            content: "✓";
            position: absolute;
            left: 0;
            top: 0;
            color: #313e3b;
            font-weight: 800;
            font-size: 14px;
        }

        /* ---------- STATS & INFO DISPLAY ---------- */
       .stats-summary {
    background: #f8f9fa;
    border: 1px solid #e4e4e4;
    border-radius: 6px;
    padding: 10px;
    margin: 8px 0;
}

.stats-grid {
    display: block;
    margin: 0;
}

.stat-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 3px 0;
    border-bottom: 1px solid #e9ecef;
    font-size: 11px;
}

.stat-row:last-child {
    border-bottom: none;
}

.stat-label {
    font-weight: 500;
    color: #313e3b;
    font-size: 11px;
}

.stat-label::after {
    display: none;
}

.stat-value {
    font-weight: 600;
    color: #313e3b;
    background: none;
    padding: 0;
    border: none;
    font-size: 11px;
    text-align: right;
}

        /* ---------- SPECIAL ELEMENTS ---------- */
        .info-note {
            background: rgba(213, 213, 43, 0.1);
            border-left: 4px solid #d5d52b;
            padding: 8px 10px;
            border-radius: 6px;
            margin: 6px 0;
        }
        
        .info-note small {
            color: #313e3b;
            line-height: 1.4;
        }
        
        .cost-highlight {
            background: linear-gradient(135deg, rgba(213, 213, 43, 0.1) 0%, rgba(213, 213, 43, 0.15) 100%);
            border: 1px solid rgba(213, 213, 43, 0.4);
            padding: 8px 10px;
            border-radius: 8px;
            text-align: center;
            margin: 5px 0;
        }
        
        .cost-highlight .amount {
            font-size: 15px;
            font-weight: 700;
            color: #313e3b;
        }
        
        .cost-highlight .label {
            font-size: 11px;
            color: #828c8a;
            font-weight: 500;
        }

        .apply-info {
            background: linear-gradient(135deg, rgba(213, 213, 43, 0.15) 0%, rgba(213, 213, 43, 0.2) 100%);
            border: 1px solid rgba(213, 213, 43, 0.5);
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            margin-top: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #313e3b;
        }

        /* Compact entry requirements section */
        .compact-entry {
            background: #f3f8f8;
            border: 1px solid #e4e4e4;
            border-radius: 10px;
            padding: 10px;
            margin: 8px 0 0 0;
        }
        
        .compact-entry h3 {
            margin: 0 0 6px 0;
            font-size: 15px;
        }
        
        .compact-entry p {
            font-size: 13px;
            line-height: 1.4;
            margin: 0 0 4px 0;
        }

        /* Additional content styles */
        .why-choose {
            background: #f3f8f8;
            border-radius: 12px;
            padding: 14px;
            margin: 10px 0;
        }

        .location-info {
            background: linear-gradient(135deg, rgba(213, 213, 43, 0.05) 0%, rgba(213, 213, 43, 0.1) 100%);
            border-radius: 10px;
            padding: 12px;
            margin: 8px 0;
        }

        .programme-options {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 14px;
            margin: 12px 0;
        }

        .single-layout {
            max-width: 100%;
            margin: 0;
        }
    /* ---------- MOBILE RESPONSIVE ---------- */
@media (max-width: 768px) {
    /* Page adjustments for mobile */
    .page {
        width: 100%;
        height: auto;
        min-height: auto; /* Allow content to define height */
        margin: 0 0 10px 0;
        padding: 20px 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        page-break-after: auto;
        box-sizing: border-box;
    }
    
    .page:last-of-type {
        margin-bottom: 0;
    }
    
    /* Typography scaling */
    h1 { font-size: 24px; line-height: 1.2; }
    h2 { font-size: 18px; }
    h3 { font-size: 15px; }
    p { font-size: 13px; line-height: 1.4; }
    
    /* Header adjustments */
    .header {
        flex-direction: column;
        text-align: center;
        gap: 8px;
    }
    
    .logo {
        height: 35px;
    }
    
    .page-title {
        font-size: 14px;
    }
    
    /* Hero section - stack vertically */
    .hero-section {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    
    .hero-image {
        height: 200px;
        order: -1; /* Move image to top */
    }
    
    /* Grid systems - stack on mobile */
    .grid-2, .grid-3 {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    /* Cards adjustments */
    .card {
        padding: 10px;
        margin-bottom: 10px;
    }
    
    .programme-card {
        padding: 15px;
        margin: 10px 0;
    }
    
    /* Programme options cards */
    .programme-options .card {
        padding: 12px;
    }
    
    .programme-options .grid-2 {
        gap: 15px;
    }
    
    /* Feature lists */
    .feature-list li {
        font-size: 12px;
        padding-left: 15px;
        margin: 3px 0;
    }
    
    /* Stats adjustments */
    .stats-summary {
        padding: 8px;
    }
    
    .stat-row {
        font-size: 10px;
        padding: 4px 0;
    }
    
    .stat-label, .stat-value {
        font-size: 10px;
    }
    
    /* Compact entry */
    .compact-entry {
        padding: 12px;
    }
    
    .compact-entry .grid-2 {
        gap: 8px;
    }
    
    .compact-entry p {
        font-size: 12px;
        margin-bottom: 8px;
    }
    
    /* Callout and highlights */
    .callout {
        padding: 10px 12px;
        font-size: 14px;
    }
    
    .highlight-badge {
        font-size: 12px;
        padding: 5px 10px;
    }
    
    .cost-highlight {
        padding: 6px 8px;
    }
    
    .cost-highlight .amount {
        font-size: 13px;
    }
    
    .cost-highlight .label {
        font-size: 10px;
    }
    
    /* Info notes */
    .info-note {
        padding: 6px 8px;
        font-size: 12px;
    }
    
    .apply-info {
        padding: 8px;
        font-size: 12px;
    }
    
    /* Background elements - reduce on mobile */
    .geometric-bg {
        width: 40px;
        height: 40px;
    }
    
    .geometric-bg.hex-3 {
        width: 25px;
        height: 25px;
    }
    
    .page::after {
        width: 120px;
        height: 120px;
    }
    
    /* Footer adjustments */
    .footer {
        flex-direction: column;
        text-align: center;
        gap: 5px;
        font-size: 11px;
    }
    
    /* Eyebrow adjustments */
    .eyebrow {
        font-size: 10px;
        padding: 2px 6px;
    }
    
    /* Why choose section */
    .why-choose, .location-info, .programme-options {
        padding: 12px;
        margin: 10px 0;
    }
}

/* Extra small screens */
@media (max-width: 480px) {
    .page {
        padding: 15px 10px;
    }
    
    h1 { font-size: 22px; }
    h2 { font-size: 16px; }
    h3 { font-size: 14px; }
    p { font-size: 12px; }
    
    .hero-image {
        height: 180px;
    }
    
    .callout {
        font-size: 13px;
        padding: 8px 10px;
    }
    
    .card {
        padding: 8px;
    }
    
    .feature-list li {
        font-size: 11px;
    }
}
    </style>
</head>
<body>