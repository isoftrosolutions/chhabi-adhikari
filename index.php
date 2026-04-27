<?php
$pageTitle = 'Home';
$pageSchema = '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "D-school | NLP Training & Coaching by Chhabi Adhikari",
  "description": "Nepal\'s Foremost NLP Authority. Transform your life and career with expert coaching."
}
</script>';
include 'includes/header.php';
$hero = getSetting('hero_title_line1'); // Just to ensure config is loaded. Actually config is loaded in header.php.
$pdo = getDB();

// Fetch Hero Slides
$stmt = $pdo->query("SELECT * FROM hero_slides WHERE is_active=1 ORDER BY sort_order ASC");
$slides = $stmt->fetchAll();

// Fetch Services
$stmt = $pdo->query("SELECT * FROM services WHERE is_active=1 ORDER BY sort_order ASC LIMIT 6");
$services = $stmt->fetchAll();

// Fetch Testimonials
$stmt = $pdo->query("SELECT * FROM testimonials WHERE is_active=1 ORDER BY sort_order ASC LIMIT 3");
$testimonials = $stmt->fetchAll();

// Fetch Videos
$stmt = $pdo->query("SELECT * FROM videos WHERE is_active=1 ORDER BY sort_order ASC LIMIT 3");
$videos = $stmt->fetchAll();

// Fetch Blog Posts
$stmt = $pdo->query("SELECT * FROM blog_posts WHERE is_published=1 ORDER BY published_at DESC LIMIT 3");
$blog_posts = $stmt->fetchAll();
?>

<style>
/* ─── Reset & Base ─────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

/* ─── Animations ───────────────────────────────────────── */
@keyframes fadeUp   { from { opacity:0; transform:translateY(40px); } to { opacity:1; transform:translateY(0); } }
@keyframes fadeIn   { from { opacity:0; } to { opacity:1; } }
@keyframes scaleIn  { from { opacity:0; transform:scale(.94); } to { opacity:1; transform:scale(1); } }
@keyframes ticker   { from { transform:translateX(0); } to { transform:translateX(-50%); } }
@keyframes float    { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-10px);} }
@keyframes shimmer  { 0%{background-position:-400px 0;} 100%{background-position:400px 0;} }
@keyframes pulse-ring { 0%{box-shadow:0 0 0 0 rgba(255,106,0,.5);} 70%{box-shadow:0 0 0 18px rgba(255,106,0,0);} 100%{box-shadow:0 0 0 0 rgba(255,106,0,0);} }

.reveal { opacity:0; transform:translateY(36px); transition:opacity .7s ease, transform .7s ease; }
.reveal.visible { opacity:1; transform:translateY(0); }
.reveal-delay-1 { transition-delay:.1s; }
.reveal-delay-2 { transition-delay:.2s; }
.reveal-delay-3 { transition-delay:.3s; }
.reveal-delay-4 { transition-delay:.4s; }

/* ─── Section Shared ───────────────────────────────────── */
.idx-section { padding: 90px 0; }
.idx-container { max-width:1200px; margin:0 auto; padding:0 24px; }

.idx-heading {
    font-family: var(--font-heading);
    font-size: clamp(1.9rem, 4vw, 2.8rem);
    font-weight: 700;
    color: var(--secondary);
    text-align: center;
    margin-bottom: 14px;
    line-height: 1.15;
    letter-spacing: -.5px;
}
.idx-heading--light { color: #fff; }
.idx-subheading {
    text-align: center;
    color: var(--text-grey);
    font-size: 1.05rem;
    margin-bottom: 55px;
    line-height: 1.6;
}
.idx-subheading--light { color: rgba(255,255,255,.75); }

.gold-bar {
    display: block;
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), var(--primary-dark));
    border-radius: 4px;
    margin: 0 auto 14px;
}

/* ─── 1. HERO ──────────────────────────────────────────── */
.idx-hero {
    position: relative;
    min-height: calc(100vh - 80px);
    display: flex;
    flex-direction: column;
    justify-content: center;
    overflow: hidden;
    background: linear-gradient(155deg, #060f22 0%, #0B1E3F 50%, #0a1830 100%);
}
.idx-hero__bg-pattern {
    position: absolute;
    inset: 0;
    background-image:
        radial-gradient(circle at 80% 20%, rgba(255,106,0,.12) 0%, transparent 50%),
        radial-gradient(circle at 10% 80%, rgba(255,106,0,.07) 0%, transparent 40%),
        repeating-linear-gradient(45deg, transparent, transparent 60px, rgba(255,255,255,.015) 60px, rgba(255,255,255,.015) 61px);
    pointer-events: none;
}
.idx-hero__inner {
    position: relative;
    z-index: 2;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    padding: 60px 24px 140px;
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
}
.idx-hero__eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(255,106,0,.15);
    border: 1px solid rgba(255,106,0,.35);
    color: var(--primary);
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 8px 18px;
    border-radius: 30px;
    margin-bottom: 28px;
    backdrop-filter: blur(6px);
    animation: fadeIn .8s ease forwards;
}
.idx-hero__eyebrow i { font-size: .9rem; }
.idx-hero__title {
    font-family: var(--font-heading);
    font-size: clamp(2.6rem, 5.5vw, 4.2rem);
    font-weight: 700;
    color: #fff;
    line-height: 1.08;
    letter-spacing: -1px;
    margin-bottom: 24px;
    animation: fadeUp .9s ease .1s both;
}
.idx-hero__title em {
    font-style: normal;
    background: linear-gradient(90deg, var(--primary), #ffd166);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.idx-hero__sub {
    font-size: 1.05rem;
    color: rgba(255,255,255,.78);
    line-height: 1.75;
    margin-bottom: 40px;
    max-width: 480px;
    animation: fadeUp .9s ease .2s both;
}
.idx-hero__actions {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
    animation: fadeUp .9s ease .3s both;
}
.btn-gold {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 15px 32px;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: #fff;
    font-weight: 700;
    font-size: .9rem;
    letter-spacing: .5px;
    text-transform: uppercase;
    border-radius: 50px;
    text-decoration: none;
    box-shadow: 0 8px 28px rgba(255,106,0,.35);
    transition: all .3s ease;
    animation: pulse-ring 2.5s infinite;
}
.btn-gold:hover { transform:translateY(-3px); box-shadow:0 14px 36px rgba(255,106,0,.5); }
.btn-ghost-white {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 30px;
    border: 2px solid rgba(255,255,255,.3);
    color: #fff;
    font-weight: 600;
    font-size: .9rem;
    text-transform: uppercase;
    border-radius: 50px;
    text-decoration: none;
    backdrop-filter: blur(8px);
    background: rgba(255,255,255,.07);
    transition: all .3s ease;
}
.btn-ghost-white:hover { border-color:rgba(255,255,255,.7); background:rgba(255,255,255,.15); transform:translateY(-2px); }
.idx-hero__authority {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,.6);
    font-size: .82rem;
    font-weight: 600;
    letter-spacing: .5px;
    margin-bottom: 32px;
    animation: fadeUp .9s ease .25s both;
}
.idx-hero__authority i { color: var(--primary); }

/* Hero right — image */
.idx-hero__image-wrap {
    position: relative;
    animation: scaleIn 1s ease .2s both;
}
.idx-hero__image-frame {
    position: relative;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 30px 80px rgba(0,0,0,.4);
}
.idx-hero__image-frame::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(10,20,50,.6) 0%, transparent 55%);
    z-index: 1;
    border-radius: 24px;
}
.idx-hero__image-frame img {
    width: 100%;
    height: 500px;
    object-fit: cover;
    display: block;
}
.idx-hero__image-badge {
    position: absolute;
    bottom: 24px;
    left: 24px;
    z-index: 2;
    background: rgba(255,255,255,.1);
    backdrop-filter: blur(14px);
    border: 1px solid rgba(255,255,255,.25);
    border-radius: 16px;
    padding: 14px 20px;
    display: flex;
    align-items: center;
    gap: 14px;
    color: #fff;
}
.idx-hero__image-badge i { font-size: 1.5rem; color: var(--primary); }
.idx-hero__image-badge strong { font-size: 1.3rem; display: block; font-family: var(--font-heading); }
.idx-hero__image-badge span { font-size: .78rem; opacity: .8; }
.idx-hero__deco-ring {
    position: absolute;
    top: -20px;
    right: -20px;
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 3px dashed rgba(255,106,0,.4);
    animation: float 4s ease-in-out infinite;
    pointer-events: none;
}
.idx-hero__deco-dot {
    position: absolute;
    bottom: -15px;
    right: 40px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(255,106,0,.2);
    animation: float 5s ease-in-out infinite reverse;
    pointer-events: none;
}



/* ─── 2. MARQUEE ───────────────────────────────────────── */
.idx-marquee {
    background: var(--secondary);
    padding: 18px 0;
    overflow: hidden;
    white-space: nowrap;
}
.idx-marquee__track {
    display: inline-flex;
    animation: ticker 28s linear infinite;
}
.idx-marquee__track:hover { animation-play-state: paused; }
.idx-marquee__item {
    display: inline-flex;
    align-items: center;
    gap: 22px;
    padding: 0 30px;
    font-size: .82rem;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: var(--primary);
}
.idx-marquee__item span { color: rgba(255,255,255,.25); font-size: 1.2rem; }

/* ─── 3. ABOUT ─────────────────────────────────────────── */
.idx-about { background: var(--bg-light); }
.idx-about__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
}
.idx-about__img-wrap {
    position: relative;
}
.idx-about__img-frame {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-lg);
}
.idx-about__img-frame::before {
    content: '';
    position: absolute;
    inset: -4px;
    border-radius: 24px;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark), var(--secondary));
    z-index: -1;
}
.idx-about__img-frame img {
    width: 100%;
    height: 520px;
    object-fit: cover;
    border-radius: 18px;
    display: block;
    position: relative;
    z-index: 1;
}
.idx-about__years-badge {
    position: absolute;
    bottom: -24px;
    right: -24px;
    width: 110px;
    height: 110px;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #fff;
    box-shadow: 0 10px 30px rgba(255,106,0,.5);
    z-index: 2;
    text-align: center;
    animation: float 4s ease-in-out infinite;
}
.idx-about__years-badge strong { font-family: var(--font-heading); font-size: 1.7rem; line-height: 1; }
.idx-about__years-badge span { font-size: .65rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; opacity: .9; }
.idx-about__deco {
    position: absolute;
    top: -20px;
    left: -20px;
    width: 80px;
    height: 80px;
    border: 3px solid var(--primary);
    border-radius: 50%;
    opacity: .35;
    animation: float 5s ease-in-out infinite reverse;
}

.idx-about__eyebrow {
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: var(--primary);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.idx-about__eyebrow::before { content:''; display:block; width:28px; height:2px; background:var(--primary); border-radius:2px; }
.idx-about__title {
    font-family: var(--font-heading);
    font-size: clamp(1.8rem, 3.5vw, 2.5rem);
    color: var(--secondary);
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 20px;
    letter-spacing: -.5px;
}
.idx-about__text {
    color: var(--text-grey);
    font-size: .97rem;
    line-height: 1.8;
    margin-bottom: 16px;
}
.idx-about__credentials {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin: 28px 0 36px;
}
.cred-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: #fff;
    border: 1.5px solid var(--border-color);
    border-radius: 30px;
    font-size: .78rem;
    font-weight: 700;
    color: var(--secondary);
    box-shadow: var(--shadow-sm);
    transition: all .3s ease;
}
.cred-badge:hover { border-color: var(--primary); color: var(--primary); transform: translateY(-2px); }
.cred-badge i { color: var(--primary); }
.idx-about__actions { display: flex; gap: 14px; flex-wrap: wrap; }
.btn-navy {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    padding: 14px 30px;
    background: var(--secondary);
    color: #fff;
    font-weight: 700;
    font-size: .88rem;
    text-transform: uppercase;
    letter-spacing: .5px;
    border-radius: 50px;
    text-decoration: none;
    transition: all .3s ease;
    box-shadow: 0 6px 20px rgba(11,30,63,.25);
}
.btn-navy:hover { background: #0d1b35; transform: translateY(-2px); box-shadow: 0 10px 28px rgba(11,30,63,.35); }
.btn-outline-gold {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    padding: 13px 28px;
    border: 2px solid var(--primary);
    color: var(--primary);
    font-weight: 700;
    font-size: .88rem;
    text-transform: uppercase;
    border-radius: 50px;
    text-decoration: none;
    transition: all .3s ease;
}
.btn-outline-gold:hover { background: var(--primary); color: #fff; transform: translateY(-2px); }

/* ─── 4. SERVICES ──────────────────────────────────────── */
.idx-services { background: var(--bg-section); }
.idx-services__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
}
.svc-card {
    background: #fff;
    border-radius: 20px;
    padding: 36px 28px;
    box-shadow: var(--shadow-sm);
    transition: all .35s cubic-bezier(.165,.84,.44,1);
    position: relative;
    overflow: hidden;
    cursor: pointer;
}
.svc-card::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--primary-dark));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform .35s ease;
}
.svc-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); }
.svc-card:hover::after { transform: scaleX(1); }
.svc-card__icon {
    width: 68px;
    height: 68px;
    border-radius: 18px;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.6rem;
    color: #fff;
    margin-bottom: 22px;
    box-shadow: 0 8px 20px rgba(255,106,0,.3);
    transition: transform .3s ease;
}
.svc-card:hover .svc-card__icon { transform: scale(1.08) rotate(-4deg); }
.svc-card__title {
    font-family: var(--font-heading);
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--secondary);
    margin-bottom: 10px;
    line-height: 1.3;
}
.svc-card__desc {
    font-size: .88rem;
    color: var(--text-grey);
    line-height: 1.65;
    margin-bottom: 22px;
}
.svc-card__link {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: .82rem;
    font-weight: 700;
    color: var(--primary);
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: .5px;
    opacity: 0;
    transform: translateY(6px);
    transition: all .3s ease;
}
.svc-card:hover .svc-card__link { opacity: 1; transform: translateY(0); }
.svc-card__link:hover { gap: 11px; }

/* ─── 5. WHY US ────────────────────────────────────────── */
.idx-why {
    background: linear-gradient(135deg, var(--secondary) 0%, #0d1b35 100%);
    position: relative;
    overflow: hidden;
}
.idx-why::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    pointer-events: none;
}
.idx-why::after {
    content: '';
    position: absolute;
    top: -80px; right: -80px;
    width: 350px; height: 350px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(255,106,0,.1) 0%, transparent 70%);
    pointer-events: none;
}
.idx-why__grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 36px;
    position: relative;
    z-index: 1;
}
.why-item { text-align: center; }
.why-item__icon-wrap {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 2px solid rgba(255,106,0,.35);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 22px;
    font-size: 1.8rem;
    color: var(--primary);
    background: rgba(255,106,0,.08);
    transition: all .3s ease;
}
.why-item:hover .why-item__icon-wrap { background: rgba(255,106,0,.18); border-color: var(--primary); transform: scale(1.08); }
.why-item__num {
    font-family: var(--font-heading);
    font-size: 2.4rem;
    font-weight: 700;
    color: var(--primary);
    line-height: 1;
    margin-bottom: 6px;
}
.why-item__title {
    font-size: 1rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 10px;
}
.why-item__desc { font-size: .85rem; color: rgba(255,255,255,.6); line-height: 1.6; }

/* ─── 6. TESTIMONIALS ──────────────────────────────────── */
.idx-testimonials { background: var(--bg-section); }
.idx-testimonials__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
    margin-bottom: 48px;
}
.testi-card {
    background: #fff;
    border-radius: 18px;
    padding: 34px 28px;
    border-left: 4px solid var(--primary);
    box-shadow: var(--shadow-sm);
    transition: all .35s ease;
    position: relative;
}
.testi-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }
.testi-card__quote-icon {
    font-size: 2.4rem;
    color: var(--primary);
    opacity: .2;
    line-height: 1;
    margin-bottom: 10px;
    display: block;
}
.testi-card__text {
    font-style: italic;
    color: var(--text-grey);
    font-size: .93rem;
    line-height: 1.75;
    margin-bottom: 24px;
}
.testi-card__stars { color: var(--primary); font-size: .85rem; margin-bottom: 16px; letter-spacing: 2px; }
.testi-card__author { display: flex; align-items: center; gap: 14px; }
.testi-card__avatar {
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--secondary), #1a3a6a);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 700;
    font-family: var(--font-heading);
    font-size: 1.1rem;
    flex-shrink: 0;
}
.testi-card__name { font-weight: 700; font-size: .92rem; color: var(--secondary); margin-bottom: 3px; }
.testi-card__role { font-size: .78rem; color: var(--text-grey); }
.idx-testimonials__cta { text-align: center; }

/* ─── 7. VIDEOS ────────────────────────────────────────── */
.idx-videos {
    background: #0b1624;
    position: relative;
    overflow: hidden;
}
.idx-videos::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 50% 0%, rgba(255,106,0,.08) 0%, transparent 60%);
    pointer-events: none;
}
.idx-videos__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-bottom: 44px;
    position: relative;
    z-index: 1;
}
.vid-thumb {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    aspect-ratio: 16/9;
    cursor: pointer;
    transition: transform .35s ease;
}
.vid-thumb:hover { transform: translateY(-6px); }
.vid-thumb__bg {
    width: 100%; height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.vid-thumb__bg-1 { background: linear-gradient(135deg, #0B1E3F, #1a3a7a); }
.vid-thumb__bg-2 { background: linear-gradient(135deg, #7c3aed, #4f26b5); }
.vid-thumb__bg-3 { background: linear-gradient(135deg, #059669, #027a50); }
.vid-thumb__overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,.35);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;
    transition: background .3s ease;
}
.vid-thumb:hover .vid-thumb__overlay { background: rgba(0,0,0,.5); }
.vid-play {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(255,106,0,.9);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.2rem;
    box-shadow: 0 0 0 10px rgba(255,106,0,.2);
    transition: all .3s ease;
}
.vid-thumb:hover .vid-play { transform: scale(1.12); box-shadow: 0 0 0 14px rgba(255,106,0,.2); }
.vid-thumb__label {
    color: rgba(255,255,255,.9);
    font-size: .82rem;
    font-weight: 600;
    text-align: center;
    padding: 0 16px;
    text-shadow: 0 1px 4px rgba(0,0,0,.5);
}
.idx-videos__cta { text-align: center; position: relative; z-index: 1; }

/* ─── 8. BLOG PREVIEW ──────────────────────────────────── */
.idx-blog { background: var(--bg-light); }
.idx-blog__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
    margin-bottom: 48px;
}
.bp-card {
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all .35s ease;
}
.bp-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); }
.bp-card__img {
    height: 200px;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: rgba(255,255,255,.5);
}
.bp-img-1 { background: linear-gradient(135deg, #0B1E3F, #1a4080); }
.bp-img-2 { background: linear-gradient(135deg, #FF6A00, #CC5200); }
.bp-img-3 { background: linear-gradient(135deg, #059669, #047857); }
.bp-card__cat {
    position: absolute;
    top: 14px;
    left: 14px;
    background: rgba(255,255,255,.15);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,.3);
    color: #fff;
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    padding: 5px 12px;
    border-radius: 20px;
}
.bp-card__body { padding: 26px 24px; }
.bp-card__date { font-size: .76rem; color: var(--text-grey); margin-bottom: 10px; display: flex; align-items: center; gap: 6px; }
.bp-card__date i { color: var(--primary); }
.bp-card__title { font-family: var(--font-heading); font-size: 1.05rem; color: var(--secondary); font-weight: 700; line-height: 1.35; margin-bottom: 10px; }
.bp-card__excerpt { font-size: .85rem; color: var(--text-grey); line-height: 1.6; margin-bottom: 18px; }
.bp-card__link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: .82rem;
    font-weight: 700;
    color: var(--primary);
    text-decoration: none;
    transition: gap .3s ease;
}
.bp-card__link:hover { gap: 10px; color: var(--primary-dark); }
.idx-blog__cta { text-align: center; }

/* ─── 9. CTA BANNER ────────────────────────────────────── */
.idx-cta {
    background: linear-gradient(120deg, var(--primary) 0%, var(--primary-dark) 50%, #c85f00 100%);
    padding: 90px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.idx-cta::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.06'%3E%3Cpath d='M50 50c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10s-10-4.477-10-10 4.477-10 10-10zM10 10c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10S0 25.523 0 20s4.477-10 10-10z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    pointer-events: none;
}
.idx-cta__inner { position: relative; z-index: 1; }
.idx-cta__tag {
    display: inline-block;
    background: rgba(255,255,255,.2);
    color: #fff;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 7px 18px;
    border-radius: 30px;
    margin-bottom: 22px;
    border: 1px solid rgba(255,255,255,.3);
}
.idx-cta__heading {
    font-family: var(--font-heading);
    font-size: clamp(2rem, 5vw, 3.2rem);
    color: #fff;
    font-weight: 700;
    margin-bottom: 16px;
    line-height: 1.15;
}
.idx-cta__sub {
    color: rgba(255,255,255,.85);
    font-size: 1.05rem;
    margin-bottom: 40px;
    max-width: 560px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.65;
}
.idx-cta__actions { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
.btn-white {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 15px 34px;
    background: #fff;
    color: var(--primary-dark);
    font-weight: 700;
    font-size: .9rem;
    text-transform: uppercase;
    letter-spacing: .5px;
    border-radius: 50px;
    text-decoration: none;
    box-shadow: 0 8px 28px rgba(0,0,0,.15);
    transition: all .3s ease;
}
.btn-white:hover { transform: translateY(-3px); box-shadow: 0 14px 36px rgba(0,0,0,.22); }
.btn-ghost-dark {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 32px;
    border: 2px solid rgba(255,255,255,.5);
    color: #fff;
    font-weight: 700;
    font-size: .9rem;
    text-transform: uppercase;
    border-radius: 50px;
    text-decoration: none;
    transition: all .3s ease;
    background: rgba(255,255,255,.08);
}
.btn-ghost-dark:hover { border-color: #fff; background: rgba(255,255,255,.18); transform: translateY(-2px); }

/* ─── WHAT IS DESCHOOL ─────────────────────────────────── */
.idx-deschool {
    background: linear-gradient(135deg, #0B1E3F 0%, #0d2650 60%, #0B1E3F 100%);
    position: relative;
    overflow: hidden;
}
.idx-deschool::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 20% 50%, rgba(255,106,0,.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 30%, rgba(255,106,0,.06) 0%, transparent 40%);
    pointer-events: none;
}
.idx-deschool__inner {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 70px;
    align-items: center;
}
.idx-deschool__label {
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: var(--primary);
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.idx-deschool__label::before { content:''; display:block; width:28px; height:2px; background:var(--primary); border-radius:2px; }
.idx-deschool__title {
    font-family: var(--font-heading);
    font-size: clamp(1.9rem, 3.5vw, 2.8rem);
    color: #fff;
    font-weight: 700;
    line-height: 1.15;
    margin-bottom: 20px;
    letter-spacing: -.5px;
}
.idx-deschool__title em {
    font-style: normal;
    background: linear-gradient(90deg, var(--primary), #ffd166);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.idx-deschool__text {
    color: rgba(255,255,255,.75);
    font-size: 1rem;
    line-height: 1.8;
    margin-bottom: 32px;
}
.idx-deschool__pillars {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 36px;
}
.ds-pillar {
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,106,0,.2);
    border-radius: 14px;
    padding: 18px 16px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    transition: all .3s ease;
}
.ds-pillar:hover { background: rgba(255,106,0,.1); border-color: rgba(255,106,0,.4); transform: translateY(-2px); }
.ds-pillar__icon {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: rgba(255,106,0,.15);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #FF6A00;
    font-size: .95rem;
    flex-shrink: 0;
}
.ds-pillar__text { font-size: .82rem; color: rgba(255,255,255,.8); line-height: 1.5; font-weight: 600; }

.idx-deschool__visual {
    display: flex;
    align-items: center;
    justify-content: center;
}
.deschool-diagram {
    position: relative;
    width: 380px;
    height: 380px;
}
.dd-center {
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    width: 130px; height: 130px;
    border-radius: 50%;
    background: linear-gradient(135deg, #FF6A00, #E85E00);
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    text-align: center;
    color: #fff;
    font-weight: 700;
    font-size: .75rem;
    box-shadow: 0 0 40px rgba(255,106,0,.35), 0 0 80px rgba(255,106,0,.12);
    z-index: 2;
}
.dd-center strong { font-size: 1rem; display: block; margin-bottom: 2px; font-family: var(--font-heading); }
.dd-orbit {
    position: absolute;
    top: 50%; left: 50%;
    width: 320px; height: 320px;
    border-radius: 50%;
    border: 1.5px dashed rgba(255,106,0,.25);
    transform: translate(-50%, -50%);
    animation: float 8s ease-in-out infinite;
}
.dd-node {
    position: absolute;
    width: 90px; height: 90px;
    border-radius: 50%;
    background: rgba(255,255,255,.06);
    border: 1.5px solid rgba(255,255,255,.15);
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    text-align: center;
    color: #fff;
    font-size: .65rem;
    font-weight: 600;
    gap: 4px;
    backdrop-filter: blur(6px);
    transition: all .3s ease;
}
.dd-node:hover { background: rgba(255,106,0,.15); border-color: rgba(255,106,0,.5); }
.dd-node i { font-size: 1.1rem; color: var(--primary); }
.dd-node--1 { top: -10px; left: 50%; transform: translateX(-50%); }
.dd-node--2 { top: 50%; right: -10px; transform: translateY(-50%); }
.dd-node--3 { bottom: -10px; left: 50%; transform: translateX(-50%); }
.dd-node--4 { top: 50%; left: -10px; transform: translateY(-50%); }

/* ─── STRUGGLES SECTION ─────────────────────────────────── */
.idx-struggles { background: #fff; }
.idx-struggles__intro {
    text-align: center;
    max-width: 640px;
    margin: 0 auto 56px;
}
.idx-struggles__question {
    font-family: var(--font-heading);
    font-size: clamp(1.6rem, 3vw, 2.3rem);
    color: var(--secondary);
    font-weight: 700;
    margin-bottom: 16px;
    line-height: 1.2;
}
.idx-struggles__question em {
    font-style: normal;
    color: #FF6A00;
}
.struggles-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 50px;
}
.struggle-card {
    border-radius: 18px;
    padding: 30px 24px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 14px;
    border: 1.5px solid var(--border-color);
    background: #fafbfd;
    transition: all .3s ease;
    position: relative;
    overflow: hidden;
}
.struggle-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #FF6A00, #ffd166);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform .35s ease;
}
.struggle-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); border-color: transparent; }
.struggle-card:hover::before { transform: scaleX(1); }
.struggle-card__icon {
    width: 52px; height: 52px;
    border-radius: 14px;
    background: rgba(255,106,0,.1);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem;
    color: #FF6A00;
}
.struggle-card__title {
    font-family: var(--font-heading);
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--secondary);
}
.struggle-card__desc {
    font-size: .85rem;
    color: var(--text-grey);
    line-height: 1.6;
}
.struggles-bottom {
    text-align: center;
    padding: 36px;
    background: linear-gradient(135deg, #0B1E3F, #1a3060);
    border-radius: 20px;
    color: #fff;
}
.struggles-bottom h3 {
    font-family: var(--font-heading);
    font-size: clamp(1.3rem, 2.5vw, 1.8rem);
    font-weight: 700;
    margin-bottom: 12px;
    line-height: 1.3;
}
.struggles-bottom h3 em { font-style: normal; color: var(--primary); }
.struggles-bottom p { color: rgba(255,255,255,.75); font-size: .95rem; margin-bottom: 24px; }

/* ─── PROOF POINTS (About) ──────────────────────────────── */
.proof-list {
    list-style: none;
    margin: 0 0 28px;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.proof-list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 14px 18px;
    background: #fff;
    border-radius: 12px;
    border-left: 3px solid var(--primary);
    box-shadow: 0 2px 10px rgba(0,0,0,.05);
    font-size: .92rem;
    color: var(--secondary);
    font-weight: 600;
    line-height: 1.4;
    transition: all .3s ease;
}
.proof-list li:hover { transform: translateX(4px); box-shadow: 0 4px 16px rgba(255,106,0,.15); }
.proof-list li i { color: var(--primary); font-size: 1rem; flex-shrink: 0; margin-top: 2px; }

/* ─── EMOTIONAL TESTIMONIAL ─────────────────────────────── */
.idx-emo-testi {
    background: linear-gradient(135deg, #0B1E3F 0%, #1a3060 100%);
    padding: 80px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.idx-emo-testi::before {
    content: '\201C';
    position: absolute;
    top: -20px; left: 50%;
    transform: translateX(-50%);
    font-size: 20rem;
    color: rgba(255,106,0,.05);
    font-family: Georgia, serif;
    line-height: 1;
    pointer-events: none;
}
.emo-testi__quote {
    font-family: var(--font-heading);
    font-size: clamp(1.5rem, 3.5vw, 2.4rem);
    color: #fff;
    font-weight: 700;
    line-height: 1.3;
    max-width: 760px;
    margin: 0 auto 28px;
    position: relative;
    z-index: 1;
}
.emo-testi__quote em { font-style: italic; color: var(--primary); }
.emo-testi__author {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 14px;
    position: relative;
    z-index: 1;
}
.emo-testi__avatar {
    width: 52px; height: 52px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    display: flex; align-items: center; justify-content: center;
    color: #fff;
    font-weight: 700;
    font-size: 1.1rem;
    font-family: var(--font-heading);
    flex-shrink: 0;
    box-shadow: 0 4px 14px rgba(255,106,0,.4);
}
.emo-testi__info { text-align: left; }
.emo-testi__name { font-weight: 700; font-size: .95rem; color: #fff; }
.emo-testi__role { font-size: .8rem; color: rgba(255,255,255,.6); }

/* ─── Responsive ───────────────────────────────────────── */
@media (max-width: 1024px) {
    .idx-hero__inner { grid-template-columns: 1fr; gap: 40px; padding-bottom: 160px; }
    .idx-hero__image-wrap { display: none; }
    .idx-about__grid { grid-template-columns: 1fr; gap: 50px; }
    .idx-services__grid { grid-template-columns: repeat(2, 1fr); }
    .idx-why__grid { grid-template-columns: repeat(2, 1fr); gap: 40px; }
    .idx-testimonials__grid { grid-template-columns: 1fr 1fr; }
    .idx-videos__grid { grid-template-columns: 1fr 1fr; }
    .idx-blog__grid { grid-template-columns: 1fr 1fr; }
    .idx-deschool__inner { grid-template-columns: 1fr; gap: 40px; }
    .deschool-diagram { width: 300px; height: 300px; }
    .dd-orbit { width: 260px; height: 260px; }
    .struggles-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
    .idx-hero__stats-inner { flex-wrap: wrap; gap: 8px; border-radius: 20px; }
    .idx-hero__title { font-size: clamp(2rem,8vw,3rem); }
    .idx-services__grid { grid-template-columns: 1fr; }
    .idx-why__grid { grid-template-columns: 1fr 1fr; }
    .idx-testimonials__grid { grid-template-columns: 1fr; }
    .idx-videos__grid { grid-template-columns: 1fr; }
    .idx-blog__grid { grid-template-columns: 1fr; }
    .idx-about__img-frame img { height: 340px; }
    .idx-about__years-badge { width: 90px; height: 90px; bottom:-14px; right:-14px; }
    .struggles-grid { grid-template-columns: 1fr; }
    .idx-deschool__pillars { grid-template-columns: 1fr; }
}
@media (max-width: 480px) {
    .idx-hero__actions { flex-direction: column; }
    .idx-hero__actions a { width: 100%; justify-content: center; }
    .idx-why__grid { grid-template-columns: 1fr; }
    .idx-cta__actions { flex-direction: column; align-items: center; }
    .deschool-diagram { display: none; }
}
</style>

<!-- ═══════════════════════════════════════════════════════════
     1. HERO
═══════════════════════════════════════════════════════════ -->
<?php $slide = $slides[0] ?? null; ?>
<section class="idx-hero" <?php if($slide && $slide['gradient']) echo "style=\"background: {$slide['gradient']};\""; ?>>
    <div class="idx-hero__bg-pattern"></div>

    <div class="idx-hero__inner">
        <!-- Left: Copy -->
        <div class="idx-hero__copy">
            <div class="idx-hero__eyebrow">
                <i class="fas fa-brain"></i>
                The Deschool System
            </div>
            <h1 class="idx-hero__title">Rewire the Mind.<br><em>Rebuild the Life.</em></h1>
            <p class="idx-hero__sub">From fear, distraction &amp; anxiety&hellip;<br>to clarity, confidence &amp; control.</p>
            <p class="idx-hero__authority"><i class="fas fa-shield-alt"></i> The official platform of the Deschool System</p>
            <div class="idx-hero__actions">
                <a href="contact.php" class="btn-gold"><i class="fas fa-fire"></i> Start Your Transformation</a>
                <a href="<?= htmlspecialchars($slide['btn2_url'] ?? 'videos.php') ?>" class="btn-ghost-white">
                    <i class="fas fa-play-circle"></i> Watch Real Transformations
                </a>
            </div>
        </div>

        <!-- Right: Image -->
        <div class="idx-hero__image-wrap">
            <div class="idx-hero__deco-ring"></div>
            <div class="idx-hero__deco-dot"></div>
            <div class="idx-hero__image-frame">
                <img src="<?= BASE_URL ?>/<?= h($slide['image_path'] ?? getSetting('hero_image')) ?>"
                     alt="Hero Image">
                <div class="idx-hero__image-badge">
                    <i class="fas fa-award"></i>
                    <div>
                        <strong>Chhabi</strong>
                        <span>NLP Master Trainer</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>

<!-- ═══════════════════════════════════════════════════════════
     2. MARQUEE
═══════════════════════════════════════════════════════════ -->
<div class="idx-marquee" aria-hidden="true">
    <div class="idx-marquee__track">
        <?php
        $items = ['NLP Master Practitioner','Life Coach Training','Money Mastery','Wellness Practitioner','Corporate Training','Student Programs','Online Courses','Subconscious Reprogramming','Personal Transformation','NLP Practitioner'];
        $html = '';
        foreach ($items as $item) {
            $html .= "<span class='idx-marquee__item'>{$item}<span>·</span></span>";
        }
        echo str_repeat($html, 2);
        ?>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     2B. WHAT IS DESCHOOL?
═══════════════════════════════════════════════════════════ -->
<section class="idx-section idx-deschool" aria-labelledby="deschool-heading">
    <div class="idx-container">
        <div class="idx-deschool__inner">
            <div class="reveal">
                <p class="idx-deschool__label">The Deschool System</p>
                <h2 class="idx-deschool__title" id="deschool-heading">
                    What is <em>Deschool</em>?
                </h2>
                <p class="idx-deschool__text">
                    Deschool is a revolutionary system that works <strong style="color:#fff">beyond traditional education and psychology</strong> — directly with the subconscious mind to eliminate fear, distraction, trauma, and limitations at the root.
                </p>
                <div class="idx-deschool__pillars">
                    <div class="ds-pillar">
                        <div class="ds-pillar__icon"><i class="fas fa-brain"></i></div>
                        <span class="ds-pillar__text">Subconscious Reprogramming</span>
                    </div>
                    <div class="ds-pillar">
                        <div class="ds-pillar__icon"><i class="fas fa-bolt"></i></div>
                        <span class="ds-pillar__text">Root-Cause Transformation</span>
                    </div>
                    <div class="ds-pillar">
                        <div class="ds-pillar__icon"><i class="fas fa-shield-alt"></i></div>
                        <span class="ds-pillar__text">Fear &amp; Trauma Elimination</span>
                    </div>
                    <div class="ds-pillar">
                        <div class="ds-pillar__icon"><i class="fas fa-infinity"></i></div>
                        <span class="ds-pillar__text">Permanent Life Change</span>
                    </div>
                </div>
                <a href="contact.php" class="btn-gold">
                    <i class="fas fa-fire"></i> Book a Free Clarity Session
                </a>
            </div>
            <div class="idx-deschool__visual reveal reveal-delay-1">
                <div class="deschool-diagram">
                    <div class="dd-orbit"></div>
                    <div class="dd-center">
                        <i class="fas fa-brain" style="font-size:2rem;margin-bottom:6px;"></i>
                        <strong>Deschool</strong>
                        System
                    </div>
                    <div class="dd-node dd-node--1"><i class="fas fa-bolt"></i>Clarity</div>
                    <div class="dd-node dd-node--2"><i class="fas fa-fire"></i>Confidence</div>
                    <div class="dd-node dd-node--3"><i class="fas fa-lock-open"></i>Freedom</div>
                    <div class="dd-node dd-node--4"><i class="fas fa-heart"></i>Identity</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     2C. STRUGGLES (Pain Points)
═══════════════════════════════════════════════════════════ -->
<section class="idx-section idx-struggles" aria-labelledby="struggles-heading">
    <div class="idx-container">
        <div class="idx-struggles__intro reveal">
            <span class="gold-bar"></span>
            <h2 class="idx-struggles__question" id="struggles-heading">
                Do Any of These Sound Like <em>You?</em>
            </h2>
            <p style="color:var(--text-grey);font-size:1rem;line-height:1.6;">You're not lazy. You're not broken. Your mind was just never taught how to work for you.</p>
        </div>

        <div class="struggles-grid">
            <div class="struggle-card reveal">
                <div class="struggle-card__icon"><i class="fas fa-graduation-cap"></i></div>
                <div class="struggle-card__title">Exam Fear &amp; Anxiety</div>
                <p class="struggle-card__desc">Your mind goes blank under pressure. You know the answers — but fear blocks you.</p>
            </div>
            <div class="struggle-card reveal reveal-delay-1">
                <div class="struggle-card__icon"><i class="fas fa-random"></i></div>
                <div class="struggle-card__title">Distraction &amp; Lack of Focus</div>
                <p class="struggle-card__desc">You start with motivation — but can't stay focused long enough to finish what matters.</p>
            </div>
            <div class="struggle-card reveal reveal-delay-2">
                <div class="struggle-card__icon"><i class="fas fa-head-side-virus"></i></div>
                <div class="struggle-card__title">Overthinking &amp; Worry</div>
                <p class="struggle-card__desc">Your mind never stops. Constant what-ifs drain your energy before the day even begins.</p>
            </div>
            <div class="struggle-card reveal reveal-delay-1">
                <div class="struggle-card__icon"><i class="fas fa-user-slash"></i></div>
                <div class="struggle-card__title">Low Self-Image</div>
                <p class="struggle-card__desc">You compare yourself constantly. Deep down, you don't feel worthy of success or love.</p>
            </div>
            <div class="struggle-card reveal reveal-delay-2">
                <div class="struggle-card__icon"><i class="fas fa-couch"></i></div>
                <div class="struggle-card__title">Laziness &amp; Procrastination</div>
                <p class="struggle-card__desc">You know what to do — but something invisible keeps pulling you back to comfort zones.</p>
            </div>
            <div class="struggle-card reveal reveal-delay-3">
                <div class="struggle-card__icon"><i class="fas fa-heartbeat"></i></div>
                <div class="struggle-card__title">Unresolved Trauma &amp; Stress</div>
                <p class="struggle-card__desc">Old wounds still run the show — affecting your relationships, health, and decisions.</p>
            </div>
        </div>

        <div class="struggles-bottom reveal">
            <h3>This is not a <em>willpower</em> problem.<br>It's a <em>subconscious programming</em> problem.</h3>
            <p>Deschool goes where therapy and motivation can't — directly to the root.</p>
            <a href="contact.php" class="btn-gold"><i class="fas fa-fire"></i> Fix Your Mind Now</a>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     3. ABOUT CHHABI
═══════════════════════════════════════════════════════════ -->
<section class="idx-section idx-about" aria-labelledby="about-heading">
    <div class="idx-container">
        <div class="idx-about__grid">

            <!-- Image -->
            <div class="idx-about__img-wrap reveal">
                <div class="idx-about__deco"></div>
                <div class="idx-about__img-frame">
                    <img src="<?= BASE_URL ?>/<?= h(getSetting('about_image', 'assets/Gemini_Generated_Image_ejsw4zejsw4zejsw.png')) ?>"
                         alt="Chhabi Adhikari — Founder of D-School System" loading="lazy">
                </div>
                <div class="idx-about__years-badge">
                    <strong><?= h(rtrim(getSetting('stat_decades', '20+'), '+')) ?>+</strong>
                    <span>Years<br>Expert</span>
                </div>
            </div>

            <!-- Content -->
            <div class="reveal reveal-delay-1">
                <p class="idx-about__eyebrow">Meet the Founder</p>
                <h2 class="idx-about__title" id="about-heading">
                    Chhabi Adhikari &mdash;<br>The Mind Behind Deschool
                </h2>

                <ul class="proof-list">
                    <li><i class="fas fa-check-circle"></i> Helped a silent child speak confidently in 7 days</li>
                    <li><i class="fas fa-check-circle"></i> Transformed deep trauma cases in days — not years</li>
                    <li><i class="fas fa-check-circle"></i> Worked with students, teachers, professors &amp; engineers</li>
                    <li><i class="fas fa-check-circle"></i> Healed phobias, fears &amp; exam anxiety at the root</li>
                    <li><i class="fas fa-check-circle"></i> Delivered programs across <?= h(getSetting('stat_cities', '20+')) ?> cities</li>
                    <li><i class="fas fa-check-circle"></i> <?= h(getSetting('stat_lives', '1M+')) ?> lives touched through workshops &amp; coaching</li>
                </ul>

                <div class="idx-about__credentials">
                    <span class="cred-badge"><i class="fas fa-certificate"></i> Certified NLP Trainer</span>
                    <span class="cred-badge"><i class="fas fa-globe-asia"></i> Nepal's #1 NLP Institute</span>
                    <span class="cred-badge"><i class="fas fa-building"></i> Corporate &amp; Personal</span>
                </div>

                <div class="idx-about__actions">
                    <a href="contact.php" class="btn-gold">
                        <i class="fas fa-calendar-check"></i> Book a Free Clarity Session
                    </a>
                    <a href="about.php" class="btn-outline-gold">
                        <i class="fas fa-user"></i> Meet Chhabi
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     4. SERVICES
═══════════════════════════════════════════════════════════ -->
<section class="idx-section idx-services" aria-labelledby="services-heading">
    <div class="idx-container">
        <span class="gold-bar reveal"></span>
        <h2 class="idx-heading reveal reveal-delay-1" id="services-heading"><?= h(getSetting('services_title', 'Our Transformational Programs')) ?></h2>
        <p class="idx-subheading reveal reveal-delay-2"><?= h(getSetting('services_subtitle', 'Expertly designed programs to empower every area of your life')) ?></p>

        <div class="idx-services__grid">
            <?php foreach ($services as $k => $svc): ?>
            <article class="svc-card reveal <?= $k > 0 ? "reveal-delay-" . ($k % 4) : "" ?>">
                <div class="svc-card__icon"><i class="<?= h($svc['icon'] ?? 'fas fa-star') ?>"></i></div>
                <h3 class="svc-card__title"><?= h($svc['title']) ?></h3>
                <p class="svc-card__desc"><?= h($svc['description']) ?></p>
                <a href="<?= htmlspecialchars($svc['link_url'] ?? 'courses.php') ?>" class="svc-card__link">Learn More <i class="fas fa-arrow-right"></i></a>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     5. WHY CHOOSE US
═══════════════════════════════════════════════════════════ -->
<section class="idx-section idx-why" aria-labelledby="why-heading">
    <div class="idx-container">
        <span class="gold-bar reveal"></span>
        <h2 class="idx-heading idx-heading--light reveal reveal-delay-1" id="why-heading"><?= h(getSetting('why_title', 'Why D-School System?')) ?></h2>
        <p class="idx-subheading idx-subheading--light reveal reveal-delay-2"><?= h(getSetting('why_subtitle', 'The standard of excellence that sets us apart')) ?></p>

        <div class="idx-why__grid">
            <div class="why-item reveal">
                <div class="why-item__icon-wrap"><i class="fas fa-user-graduate"></i></div>
                <div class="why-item__num"><?= h(getSetting('stat_decades', '20+')) ?></div>
                <div class="why-item__title">Expert Trainer</div>
                <p class="why-item__desc">Over two decades of hands-on NLP training experience from Nepal's most certified practitioner.</p>
            </div>
            <div class="why-item reveal reveal-delay-1">
                <div class="why-item__icon-wrap"><i class="fas fa-chart-line"></i></div>
                <div class="why-item__num"><?= h(getSetting('stat_lives', '1M+')) ?></div>
                <div class="why-item__title">Lives Impacted</div>
                <p class="why-item__desc">From personal counselling to mass workshops — a proven track record of real, measurable transformation.</p>
            </div>
            <div class="why-item reveal reveal-delay-2">
                <div class="why-item__icon-wrap"><i class="fas fa-certificate"></i></div>
                <div class="why-item__num"><?= h(getSetting('stat_programs', '50+')) ?></div>
                <div class="why-item__title">Certified Programs</div>
                <p class="why-item__desc">Internationally aligned curricula, taught in a simple, practical, and deeply effective way.</p>
            </div>
            <div class="why-item reveal reveal-delay-3">
                <div class="why-item__icon-wrap"><i class="fas fa-infinity"></i></div>
                <div class="why-item__num">∞</div>
                <div class="why-item__title">Lasting Results</div>
                <p class="why-item__desc">No temporary fixes. Our subconscious reprogramming approach delivers permanent life change.</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     6. TESTIMONIALS
═══════════════════════════════════════════════════════════ -->
<section class="idx-section idx-testimonials" aria-labelledby="testi-heading">
    <div class="idx-container">
        <span class="gold-bar reveal"></span>
        <h2 class="idx-heading reveal reveal-delay-1" id="testi-heading"><?= h(getSetting('testimonials_title', 'Success Stories')) ?></h2>
        <p class="idx-subheading reveal reveal-delay-2">Real transformations from real people</p>

        <div class="idx-testimonials__grid">
            <?php foreach ($testimonials as $k => $testi): ?>
            <div class="testi-card reveal <?= $k > 0 ? "reveal-delay-" . ($k % 4) : "" ?>">
                <span class="testi-card__quote-icon"><i class="fas fa-quote-left"></i></span>
                <p class="testi-card__text">"<?= h($testi['content']) ?>"</p>
                <div class="testi-card__stars"><?= str_repeat('★', $testi['rating'] ?? 5) ?></div>
                <div class="testi-card__author">
                    <div class="testi-card__avatar"><?= h($testi['avatar_initial']) ?></div>
                    <div>
                        <div class="testi-card__name"><?= h($testi['name']) ?></div>
                        <div class="testi-card__role"><?= h($testi['role']) ?><?= $testi['location'] ? ', ' . h($testi['location']) : '' ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="idx-testimonials__cta reveal">
            <a href="success-stories.php" class="btn-navy">
                <i class="fas fa-star"></i> View All Success Stories
            </a>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     7. VIDEOS
═══════════════════════════════════════════════════════════ -->
<section class="idx-section idx-videos" aria-labelledby="videos-heading">
    <div class="idx-container">
        <span class="gold-bar reveal"></span>
        <h2 class="idx-heading idx-heading--light reveal reveal-delay-1" id="videos-heading"><?= h(getSetting('videos_title', 'Watch & Learn')) ?></h2>
        <p class="idx-subheading idx-subheading--light reveal reveal-delay-2">Free NLP insights from Chhabi — watch, learn, and transform</p>

        <div class="idx-videos__grid">
            <?php foreach ($videos as $k => $vid): ?>
            <div class="vid-thumb reveal <?= $k > 0 ? "reveal-delay-" . ($k % 4) : "" ?>" <?= $vid['youtube_url'] ? "onclick=\"window.open('{$vid['youtube_url']}', '_blank')\"" : "" ?>>
                <div class="vid-thumb__bg" style="background: <?= h($vid['bg_gradient']) ?>"></div>
                <div class="vid-thumb__overlay">
                    <div class="vid-play"><i class="fas fa-play"></i></div>
                    <span class="vid-thumb__label"><?= nl2br(h($vid['title'])) ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="idx-videos__cta reveal">
            <a href="videos.php" class="btn-gold">
                <i class="fas fa-film"></i> View All Videos
            </a>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     8. BLOG PREVIEW
═══════════════════════════════════════════════════════════ -->
<section class="idx-section idx-blog" aria-labelledby="blog-heading">
    <div class="idx-container">
        <span class="gold-bar reveal"></span>
        <h2 class="idx-heading reveal reveal-delay-1" id="blog-heading"><?= h(getSetting('blog_preview_title', 'Latest Insights')) ?></h2>
        <p class="idx-subheading reveal reveal-delay-2">Thoughts on NLP, mindset, leadership &amp; personal growth</p>

        <div class="idx-blog__grid">
            <?php foreach ($blog_posts as $k => $post): ?>
            <article class="bp-card reveal <?= $k > 0 ? "reveal-delay-" . ($k % 4) : "" ?>">
                <div class="bp-card__img" style="background: <?= h($post['image_gradient']) ?>">
                    <i class="<?= h($post['image_icon']) ?>"></i>
                    <span class="bp-card__cat"><?= h($post['category']) ?></span>
                </div>
                <div class="bp-card__body">
                    <p class="bp-card__date"><i class="fas fa-calendar"></i> <?= date('F j, Y', strtotime($post['published_at'])) ?></p>
                    <h3 class="bp-card__title"><?= h($post['title']) ?></h3>
                    <p class="bp-card__excerpt"><?= h($post['excerpt']) ?></p>
                    <a href="blog.php?slug=<?= urlencode($post['slug']) ?>" class="bp-card__link">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <div class="idx-blog__cta reveal">
            <a href="blog.php" class="btn-outline-gold">
                <i class="fas fa-newspaper"></i> Read All Articles
            </a>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     8B. EMOTIONAL TESTIMONIAL
═══════════════════════════════════════════════════════════ -->
<section class="idx-emo-testi" aria-label="Testimonial">
    <div class="idx-container">
        <p class="emo-testi__quote reveal">
            &ldquo;I tried everything&hellip; but nothing changed&mdash;<em>until this.</em>&rdquo;
        </p>
        <div class="emo-testi__author reveal reveal-delay-1">
            <div class="emo-testi__avatar">S</div>
            <div class="emo-testi__info">
                <div class="emo-testi__name">Sanjay K.</div>
                <div class="emo-testi__role">Student &mdash; Kathmandu</div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     9. CTA BANNER
═══════════════════════════════════════════════════════════ -->
<section class="idx-cta" aria-labelledby="cta-heading">
    <div class="idx-container">
        <div class="idx-cta__inner reveal">
            <span class="idx-cta__tag"><i class="fas fa-fire"></i> &nbsp;Your Transformation Starts Now</span>
            <h2 class="idx-cta__heading" id="cta-heading">You Can Continue Struggling&hellip;<br>Or Take Control of Your Mind Today.</h2>
            <p class="idx-cta__sub">Thousands have already rewired their minds with the Deschool System. The only question is: are you next?</p>
            <div class="idx-cta__actions">
                <a href="contact.php" class="btn-white">
                    <i class="fas fa-calendar-check"></i> Book Free Session
                </a>
                <a href="contact.php" class="btn-ghost-dark">
                    <i class="fas fa-phone"></i> Contact Now
                </a>
            </div>
        </div>
    </div>
</section>

<script>
(function () {
    // Intersection Observer for scroll reveals
    const els = document.querySelectorAll('.reveal');
    const obs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.12 });
    els.forEach(el => obs.observe(el));
})();
</script>

<?php include 'includes/footer.php'; ?>








