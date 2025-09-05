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
            text-transform: uppercase; 
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
        width: 100vw;
        height: auto;
        min-height: 100vh;
        margin: 0;
        padding: 20px 15px;
        box-shadow: none;
        page-break-after: auto;
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
<!-- ============= SAYFA 1: HOŞ GELDİNİZ & GENEL BAKIŞ ============= -->
<section class="page">
    <!-- Geometrik arka plan öğeleri -->
    <div class="geometric-bg hex-1"></div>
    <div class="geometric-bg hex-2"></div>
    <div class="geometric-bg hex-3"></div>

    <div class="header">
        <img class="logo" src="https://brucol.be/images/logo-brucol.png" alt="Brussels College Logosu">
        <div class="page-title">Brussels College'a Hoş Geldiniz</div>
    </div>

    <div class="page-content">
        <div class="hero-section">
            <div>
                <div class="highlight-badge"> Avrupa'da Başarıya Açılan Kapınız</div>
                <h1>Brussels College</h1>
                <p class="text-muted" style="font-size: 16px; font-style: italic; margin-bottom: 12px;">Geleceğinizi Birlikte Kuralım!</p>
                
                <p>Brussels College, İngiliz ortak kurumlarıyla işbirliği içinde yüksek öğrenim programları sunarak, Avrupa'nın kalbinde eğitim alırken prestijli bir UK diploması kazanmanızı sağlar. Tüm programlar İngilizce olarak verilmekte olup, uluslararası öğrencileri Brüksel'in canlı kültürünü ve akademik mükemmelliğini deneyimlemeye davet etmektedir.</p>
                
                <div class="callout">
                Brüksel'de Eğitim ve Yaşam, İngiltere'den Diploma Ayrıcalığı!
                </div>
            </div>
            <img class="hero-image" src="https://brucol.be/images/bc-building1.webp" alt="Brussels College Kampüsü">
        </div>

        <div class="grid-3">
            <div class="card">
                <span class="eyebrow">Konum Avantajı</span>
                <h3>Avrupa'nın Kalbi</h3>
                <p>AB'nin başkentinde, Brüksel'in en stratejik yerlerinden birinde yer alan kampüsümüz, iş ağlarına, staj olanaklarına ve kültürel deneyimlere eşsiz erişim sunar.</p>
            </div>
            <div class="card">
                <span class="eyebrow">Modern Tesisler</span>
                <h3>Öğrenme Ortamı</h3>
                <p>Yenilikçi, pratik öğrenme deneyimlerini desteklemek üzere tasarlanmış son teknoloji bilgisayar laboratuvarları, iş simülasyon odaları ve ortak çalışma alanları.</p>
            </div>
            <div class="card">
                <span class="eyebrow">UK Ortaklığı</span>
                <h3>Kalite Güvencesi</h3>
                <p>Programlar, köklü UK eğitim kurumlarıyla ortaklaşa sunularak uluslararası tanınırlığa sahip diploma, beceri ve yeterlilik kazanma imkanları sunar.</p>
            </div>
        </div>

        <div class="why-choose" style="margin: 12px 0;">
            <span class="eyebrow">Neden Brussels College</span>
            <h3 style="margin-bottom: 8px;">Başarınız Önceliğimizdir</h3>
            <div class="grid-2">
                <div>
                    <ul class="feature-list">
                        <li>Bireysel ilgi odaklı küçük sınıflar</li>
                        <li>Sektör deneyimine sahip tecrübeli öğretim üyeleri</li>
                        <li>Kapsamlı öğrenci destek hizmetleri</li>
                        <li>Kariyer rehberliği ve işe yerleştirme yardımı</li>
                    </ul>
                </div>
                <div>
                    <ul class="feature-list">
                        <li>Çok kültürlü öğrenme ortamı</li>
                        <li>Modern tesisler ve teknolojik imkanlar</li>
                        <li>Esnek eğitim seçenekleri</li>
                        <li>Avrupa genelinde güçlü mezun ağı</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="location-info">
            <h3 style="margin-bottom: 8px;">Merkezi Konumun Avantajları</h3>
            <div class="grid-2">
                <div>
                    <p><strong>AB Başkenti:</strong> Avrupa kurumlarına, çok uluslu şirketlere ve uluslararası kuruluşlara ağ kurma ve staj olanaklarına doğrudan erişim.</p>
                </div>
                <div>
                    <p><strong>Ulaşım Merkezi:</strong> Paris, Londra, Amsterdam'a yüksek hızlı trenlerle mükemmel bağlantı. Brüksel Havaalanı sadece 10 dakika uzaklıkta.</p>
                </div>
            </div>
        </div>
    </div>

</section>

<!-- ============= SAYFA 2: VİZE & ÖĞRENCİ YAŞAMI ============= -->
<section class="page">
    <div class="geometric-bg hex-1"></div>
    <div class="geometric-bg hex-2"></div>

    <div class="header">
        <img class="logo" src="https://brucol.be/images/logo-brucol.png" alt="Brussels College Logosu">
        <div class="page-title">Vize ve Öğrenci Yaşamı</div>
    </div>

    <div class="page-content">
        <h1>Brüksel'de Yaşam ve Eğitim</h1>
        
  <div class="grid-2" style="margin-bottom: 10px;">
            <div class="card">
                <span class="eyebrow">Uzun Süreli Vize</span>
                <h3>D Tipi Vize Başvurusu</h3>
                <p>Uluslararası öğrencilerin D tipi (uzun süreli) vize alması gerekmektedir. Gerekli belgeler arasında geçerli pasaport, sağlık sigortası, kayıt belgesi, akademik transkriptler ve mali yeterlilik kanıtı bulunmaktadır.</p>
            </div>
            <div class="card">
                <span class="eyebrow">Vize Yenileme</span>
                <h3>Yerel Uzatma</h3>
                <p>Öğrenciler, Brussels College'dan alacakları bir sonraki kabul mektubu ile vizelerini Belçika'da yerel olarak yenileyebilirler.</p>
                <div class="info-note">
                    <small><strong></strong> Yenileme işlemi için ülkenize geri dönmeniz gerekmez.</small>
                </div>
            </div>
        </div>

        <div class="info-note" style="margin: 10px 0; font-size: 13px; padding: 10px 16px;">
            📋 <strong>Tam Vize Desteği:</strong> Öğrenci Destek Ofisimiz, kapsamlı belge kontrol listeleri, başvuru rehberliği ve yenileme yardımı sağlar | 📞 student.desk@brucol.be
        </div>

        <div class="grid-3" style="margin-bottom: 10px;">
                        <div class="card">
                <span class="eyebrow">Maliyet Avantajı</span>
                <h3>UK'ye Göre %50'den Fazla Tasarruf</h3>
                <p>İngiltere'ye oranla yarıdan daha az maliyetle (€835/ay) Brüksel'de yaşayın. Kaliteli konaklama, renkli kültür ortamı ve canlı şehir hayatına, bir çok yere göre daha uygun fiyatlarla erişebilirsiniz.</p>
            </div>
                <div class="card">
                <span class="eyebrow">Sağlık Avantajı</span>
                <h3>Uygun Fiyatlı Sağlık Sigortası</h3>
                <p>Belçika, ayda sadece 25 € karşılığında kapsamlı teminat sunan Avrupa'nın en iyi sağlık sistemlerinden birini sunar - bu rakam, diğer birçok Avrupa ülkesinden önemli ölçüde daha azdır.</p>
              </div>
            <div class="card">
                <span class="eyebrow">Öğrenci Avantajları</span>
                <h3>İndirimler ve Hizmetler</h3>
                <p>Resmi öğrenci statüsü, Belçika genelinde indirimli toplu taşıma, kültürel etkinlikler ve çeşitli yerel hizmetlere erişim sağlar.</p>
            </div>
        </div>

        <div class="grid-2">
            <div class="card">
                <span class="eyebrow">Öğrenci Çalışma İzni</span>
                <h3>Okurken Çalışın</h3>
                <ul class="feature-list">
                    <li>Dönem içinde haftada 20 saate kadar çalışma</li>
                    <li>Öğrenci rejimi altında yılda 650 saat</li>
                    <li>Tipik ücretler: saatte 13-18 €</li>
                    <li>CV rehberliği ve iş arama desteği sağlanır</li>
                </ul>
            </div>
            <div class="card">
                <span class="eyebrow">Kariyer Hizmetleri</span>
                <h3>Profesyonel Gelişim</h3>
                <ul class="feature-list">
                    <li>Bire-bir kariyer koçluğu imkanı</li>
                    <li>Sektör ağları ve işveren bağlantıları</li>
                    <li>Staj yerleştirme yardımı</li>
                    <li>Belçika'da mezuniyet sonrası kariyer desteği</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer">
        <span>Brussels College | Öğrenci Hizmetleri ve Desteği</span>
        <a href="https://brucol.be">www.brucol.be</a>
    </div>
</section>

<!-- ============= SAYFA 3: LİSANS PROGRAMLARI ============= -->
<section class="page">
    <div class="geometric-bg hex-1"></div>
    <div class="geometric-bg hex-3"></div>

    <div class="header">
        <img class="logo" src="https://brucol.be/images/logo-brucol.png" alt="Brussels College Logosu">
        <div class="page-title">Lisans Programları</div>
    </div>

    <div class="page-content">
        <h1>Lisans Derece Programları</h1>
         <div class="programme-options">
            <span class="eyebrow">Mevcut Programlar</span>
            <div class="grid-2">
                <div class="card" style="padding: 10px;">
                    <h3 style="margin: 0 0 6px 0;">BSc (Hons) İşletme</h3>
                    <p style="font-size: 13px; margin-bottom: 8px;">Gerçek dünya iş senaryoları ve vaka çalışmaları yoluyla stratejik, operasyonel ve liderlik becerileri geliştirin.</p>
                    <ul class="feature-list" style="font-size: 11px;">
                        <li>Sektör uzmanlarıyla küçük gruplar halinde eğitim</li>
                        <li>Konuk konuşmacılar, Brüksel ve çevre şehirlerde staj imkanı</li>
                        <li>İstihdam edilebilirlik ve liderlik becerilerine odaklanma</li>
                        <li>Gerçek iş vakalarıyla uygulamalı öğrenme</li>
                    </ul>
                    <small style="font-weight: 600; color: #313e3b;">Kariyer: Yönetici, Danışman, İş Geliştirme, Operasyonlar</small>
                    <div class="cost-highlight" style="margin: 8px 0;">
                    <div class="label">Diploma: BSc (Hons) İşletme<sup>*</sup></div>
                    </div>
                </div>
                <div class="card" style="padding: 10px;">
                    <h3 style="margin: 0 0 6px 0;">BEng (Hons) Yazılım Mühendisliği</h3>
                    <p style="font-size: 13px; margin-bottom: 8px;">Güncel endüstri araçları ve çerçevelerini kullanarak uygulamalı projelerle yazılım geliştirmede ustalaşın.</p>
                    <ul class="feature-list" style="font-size: 11px;">
                        <li>Pratik problem çözme ve yenilikçilik</li>
                        <li>Güncel geliştirme araçları ve platformları</li>
                        <li>Teknik ve yönetimsel yazılım teslimatı</li>
                        <li>Endüstriyel deneyimle akademik titizlik</li>
                    </ul>
                    <small style="font-weight: 600; color: #313e3b;">Kariyer: Geliştirici, Sistem Analisti, DevOps Mühendisi, Kalite Güvence Mühendisi</small>
                    <div class="cost-highlight" style="margin: 8px 0;">
                    <div class="label">Diploma: BEng (Hons) Yazılım Mühendisliği<sup>*</sup></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="single-layout">
            <div class="programme-card">
                <h2></h2>
                
                <div class="stats-summary">
                    <div class="stats-grid">
                        <div class="stat-row">
                            <span class="stat-label">UK Diploma</span>
                            <span class="stat-value">University of Greater Manchester (UK)<sup>*</sup></span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">Süre</span>
                            <span class="stat-value">3 Yıl</span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">Mod</span>
                            <span class="stat-value">Tam Zamanlı | Entegre</span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">Yıllık Ücret</span>
                            <span class="stat-value">€11,000</span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">Başlangıç Dönemleri</span>
                            <span class="stat-value">Ocak | Eylül</span>
                        </div>
                    </div>
                </div>

                <div class="apply-info" style="text-align: center;">
                    📝 Şimdi Başvurun → <a href="https://brucol.be/apply">www.brucol.be/apply</a>
                </div>
            </div>
        </div>

        <div class="compact-entry">
            <span class="eyebrow">Giriş Koşulları</span>
            <h3>Nasıl Başvurulur</h3>
            <div class="grid-2" style="gap: 10px;">
                <div>
                    <p><strong>Akademik Nitelikler:</strong> A-Levels, Uluslararası Bakalorya, Advanced Placement veya eşdeğer nitelikler. Ek hazırlık ihtiyacı olan öğrenciler için Hazırlık Yılı mevcuttur.</p>
                </div>
                <div>
                    <p><strong>İngilizce Yeterliliği:</strong> IELTS 5.5 veya eşdeğeri. Derecelerine başlamadan önce dil desteğine ihtiyaç duyan öğrenciler için kampüste yoğun İngilizce programı mevcuttur.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <span>Brussels College | Lisans Programları</span>
        <a href="https://brucol.be">www.brucol.be</a>
    </div>
</section>

<!-- ============= SAYFA 4: YÜKSEK LİSANS PROGRAMLARI ============= -->
<section class="page">
    <div class="geometric-bg hex-2"></div>
    <div class="geometric-bg hex-3"></div>

    <div class="header">
        <img class="logo" src="https://brucol.be/images/logo-brucol.png" alt="Brussels College Logosu">
        <div class="page-title">Yüksek Lisans Programları</div>
    </div>

    <div class="page-content">
        <h1>Yüksek Lisans Derece Programları</h1>
           <div class="programme-options">
            <span class="eyebrow">Mevcut Programlar</span>
            <div class="grid-2">
                <div class="card" style="padding: 10px;">
                    <h3 style="margin: 0 0 6px 0;">MBA - İşletme Yüksek Lisansı</h3>
                    <p style="font-size: 13px; margin-bottom: 8px;">Uygulamalı, gerçek dünya öğrenimi yoluyla stratejik, finansal ve liderlik yeteneği geliştirin.</p>
                    <ul class="feature-list" style="font-size: 11px;">
                        <li>Stratejik liderlik ve yönetim odaklı</li>
                        <li>Konuk konuşmacılar ve Brüksel merkezli projeler</li>
                        <li>Yakın destekle küçük grup eğitimi</li>
                        <li>Gelişmiş istihdam edilebilirlik ve ağ kurma</li>
                    </ul>
                    <small style="font-weight: 600; color: #313e3b;">Kariyer: Genel Müdür, Strateji Müdürü, Danışman, İş Geliştirme</small>
                    <div class="cost-highlight" style="margin: 8px 0;">
                    <div class="label">Diploma: MBA<sup>*</sup></div>
                    </div>
                </div>
                <div class="card" style="padding: 10px;">
                    <h3 style="margin: 0 0 6px 0;">MSc Bulut ve Ağ Güvenliği</h3>
                    <p style="font-size: 13px; margin-bottom: 8px;">Endüstri standardı araçlar ve özel laboratuvarlar kullanarak siber güvenlikte uygulamalı deneyimle ustalaşın.</p>
                    <ul class="feature-list" style="font-size: 11px;">
                        <li>Sektör deneyimli öğretim kadrosu</li>
                        <li>Satıcı ortaklıkları (Cisco, Red Hat erişimi)</li>
                        <li>Kurumsal donanıma sahip özel laboratuvarlar</li>
                        <li>Küçükten büyük bulut altyapısına ölçeklendirme</li>
                    </ul>
                    <small style="font-weight: 600; color: #313e3b;">Kariyer: Güvenlik Mühendisi, SOC Analisti, Ağ Mimarı, BT Güvenlik Müdürü</small>
                    <div class="cost-highlight" style="margin: 8px 0;">
                    <div class="label">Diploma: MSc Bulut ve Ağ Güvenliği<sup>*</sup></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-layout">
            <div class="programme-card">
                <h2></h2>
                
                <div class="stats-summary">
                    <div class="stats-grid">
                        <div class="stat-row">
                            <span class="stat-label">UK Diploma</span>
                            <span class="stat-value">University of Greater Manchester (UK)<sup>*</sup></span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">Süre</span>
                            <span class="stat-value">2 Yıl</span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">Mod</span>
                            <span class="stat-value">Tam Zamanlı | Entegre</span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">Yıllık Ücret</span>
                            <span class="stat-value">€12,000</span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">Başlangıç Dönemleri</span>
                            <span class="stat-value">Ocak | Eylül</span>
                        </div>
                    </div>
                </div>
       <div class="compact-entry">
            <span class="eyebrow">Giriş Koşulları</span>
            <h3>Nasıl Başvurulur</h3>
            <div class="grid-2" style="gap: 10px;">
                <div>
                   <p><strong>Akademik Nitelikler:</strong> İlgili bir disiplinden lisans derecesi (mesleki deneyim kayıt için bir avantajdır). Gerekli belgeler: diploma/transkriptler, CV, kimlik/pasaport, kısa kişisel beyan.</p>
                    <p><strong>Mülakat:</strong> Başvuru sürecinin bir parçası olarak istenebilir.</p>
                </div>
                <div>
                    <p><strong>İngilizce Yeterliliği:</strong> IELTS 6.0-6.5 veya eşdeğeri. Anadili İngilizce olanlar veya önceki eğitimini İngilizce olarak tamamlayanlar resmi onayla muaf tutulabilir.</p>
                    <p><strong>Dil Desteği:</strong> Eşiğin altındakiler için Yoğun İngilizce Modülü mevcuttur.</p>
                </div>
            </div>
        </div>
                <div class="info-note" style="text-align: center;">
                    📝 Şimdi Başvurun → <a href="https://brucol.be/apply">www.brucol.be/apply</a>
                </div>
            </div>
        </div>

        <div class="apply-info">
            <small><sup>*</sup>Programın nasıl yapılandırıldığı, sunulduğu ve verildiği hakkında ayrıntılar için Brussels College'ın web sitesine bakın.</small>
        </div>

    <div class="footer">
        <span>Brussels College | Yüksek Lisans Programları</span>
        <a href="https://brucol.be/apply">www.brucol.be/apply</a>
    </div>
</section>

</body>
</html>