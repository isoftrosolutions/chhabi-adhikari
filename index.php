<?php
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
@keyframes pulse-ring { 0%{box-shadow:0 0 0 0 rgba(245,166,35,.5);} 70%{box-shadow:0 0 0 18px rgba(245,166,35,0);} 100%{box-shadow:0 0 0 0 rgba(245,166,35,0);} }

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
    background: linear-gradient(155deg, #0d1b35 0%, #1a2f5a 45%, #0f2040 100%);
}
.idx-hero__bg-pattern {
    position: absolute;
    inset: 0;
    background-image:
        radial-gradient(circle at 80% 20%, rgba(245,166,35,.12) 0%, transparent 50%),
        radial-gradient(circle at 10% 80%, rgba(245,166,35,.07) 0%, transparent 40%),
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
    background: rgba(245,166,35,.15);
    border: 1px solid rgba(245,166,35,.35);
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
    box-shadow: 0 8px 28px rgba(245,166,35,.35);
    transition: all .3s ease;
    animation: pulse-ring 2.5s infinite;
}
.btn-gold:hover { transform:translateY(-3px); box-shadow:0 14px 36px rgba(245,166,35,.5); }
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
    border: 3px dashed rgba(245,166,35,.4);
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
    background: rgba(245,166,35,.2);
    animation: float 5s ease-in-out infinite reverse;
    pointer-events: none;
}

/* Stats bar */
.idx-hero__stats {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 4;
    display: flex;
    justify-content: center;
    padding: 0 24px 32px;
    animation: fadeUp .9s ease .5s both;
}
.idx-hero__stats-inner {
    display: flex;
    gap: 12px;
    background: rgba(255,255,255,.1);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,.18);
    border-radius: 60px;
    padding: 14px 28px;
}
.stat-pill {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 6px 18px;
    background: rgba(255,255,255,.95);
    border-radius: 40px;
    box-shadow: 0 4px 14px rgba(0,0,0,.15);
}
.stat-pill__num {
    font-family: var(--font-heading);
    font-size: 1.35rem;
    font-weight: 700;
    color: var(--primary);
    line-height: 1;
}
.stat-pill__label {
    font-size: .72rem;
    color: var(--secondary);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .5px;
    line-height: 1.2;
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
    box-shadow: 0 10px 30px rgba(245,166,35,.5);
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
    box-shadow: 0 6px 20px rgba(26,47,90,.25);
}
.btn-navy:hover { background: #0d1b35; transform: translateY(-2px); box-shadow: 0 10px 28px rgba(26,47,90,.35); }
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
    box-shadow: 0 8px 20px rgba(245,166,35,.3);
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
    background: radial-gradient(circle, rgba(245,166,35,.1) 0%, transparent 70%);
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
    border: 2px solid rgba(245,166,35,.35);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 22px;
    font-size: 1.8rem;
    color: var(--primary);
    background: rgba(245,166,35,.08);
    transition: all .3s ease;
}
.why-item:hover .why-item__icon-wrap { background: rgba(245,166,35,.18); border-color: var(--primary); transform: scale(1.08); }
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
    background: radial-gradient(circle at 50% 0%, rgba(245,166,35,.08) 0%, transparent 60%);
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
.vid-thumb__bg-1 { background: linear-gradient(135deg, #1a2f5a, #2d4a8a); }
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
    background: rgba(245,166,35,.9);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.2rem;
    box-shadow: 0 0 0 10px rgba(245,166,35,.2);
    transition: all .3s ease;
}
.vid-thumb:hover .vid-play { transform: scale(1.12); box-shadow: 0 0 0 14px rgba(245,166,35,.2); }
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
.bp-img-1 { background: linear-gradient(135deg, #1a2f5a, #3b5998); }
.bp-img-2 { background: linear-gradient(135deg, #F5A623, #E87722); }
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
}
@media (max-width: 480px) {
    .idx-hero__actions { flex-direction: column; }
    .idx-hero__actions a { width: 100%; justify-content: center; }
    .idx-why__grid { grid-template-columns: 1fr; }
    .idx-cta__actions { flex-direction: column; align-items: center; }
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
                <?= h(getSetting('hero_eyebrow')) ?>
            </div>
            <h1 class="idx-hero__title">
                <?php if ($slide): ?>
                    <?= nl2br(h($slide['title'])) ?>
                <?php else: ?>
                    <?= h(getSetting('hero_title_line1')) ?><br>
                    <?= h(getSetting('hero_title_line2')) ?>
                <?php endif; ?>
            </h1>
            <p class="idx-hero__sub">
                <?= h($slide['subtitle'] ?? getSetting('hero_subtitle')) ?>
            </p>
            <div class="idx-hero__actions">
                <a href="<?= htmlspecialchars($slide['btn1_url'] ?? 'courses.php') ?>" class="btn-gold">
                    <i class="fas fa-graduation-cap"></i> <?= h($slide['btn1_text'] ?? 'Explore Programs') ?>
                </a>
                <a href="<?= htmlspecialchars($slide['btn2_url'] ?? 'videos.php') ?>" class="btn-ghost-white">
                    <i class="fas fa-play-circle"></i> <?= h($slide['btn2_text'] ?? 'Watch Videos') ?>
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

    <!-- Stats Bar -->
    <div class="idx-hero__stats">
        <div class="idx-hero__stats-inner">
            <div class="stat-pill">
                <span class="stat-pill__num"><?= h(getSetting('stat_decades', '2+')) ?></span>
                <span class="stat-pill__label">Decades of<br>Experience</span>
            </div>
            <div class="stat-pill">
                <span class="stat-pill__num"><?= h(getSetting('stat_lives', '1M+')) ?></span>
                <span class="stat-pill__label">Lives<br>Touched</span>
            </div>
            <div class="stat-pill">
                <span class="stat-pill__num"><?= h(getSetting('stat_cities', '20+')) ?></span>
                <span class="stat-pill__label">Cities<br>Reached</span>
            </div>
            <div class="stat-pill">
                <span class="stat-pill__num"><?= h(getSetting('stat_programs', '50+')) ?></span>
                <span class="stat-pill__label">Programs<br>Delivered</span>
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
     3. ABOUT DR. CHHABI
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
                <p class="idx-about__eyebrow"><?= h(getSetting('about_eyebrow', 'Meet the Founder')) ?></p>
                <h2 class="idx-about__title" id="about-heading">
                    <?= nl2br(h(getSetting('about_title', "Chhabi Adhikari —\nNepal's Foremost NLP Authority"))) ?>
                </h2>
                <p class="idx-about__text">
                    <?= nl2br(h(getSetting('about_text1'))) ?>
                </p>
                <p class="idx-about__text">
                    <?= nl2br(h(getSetting('about_text2'))) ?>
                </p>

                <div class="idx-about__credentials">
                    <span class="cred-badge"><i class="fas fa-certificate"></i> Certified NLP Trainer</span>
                    <span class="cred-badge"><i class="fas fa-globe-asia"></i> Nepal's #1 NLP Institute</span>
                    <span class="cred-badge"><i class="fas fa-users"></i> <?= h(getSetting('stat_lives', '1M+')) ?> Lives Reached</span>
                    <span class="cred-badge"><i class="fas fa-building"></i> Corporate & Personal</span>
                </div>

                <div class="idx-about__actions">
                    <a href="about.php" class="btn-navy">
                        <i class="fas fa-info-circle"></i> Learn More
                    </a>
                    <a href="contact.php" class="btn-outline-gold">
                        <i class="fas fa-envelope"></i> Get In Touch
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
     9. CTA BANNER
═══════════════════════════════════════════════════════════ -->
<section class="idx-cta" aria-labelledby="cta-heading">
    <div class="idx-container">
        <div class="idx-cta__inner reveal">
            <span class="idx-cta__tag"><i class="fas fa-fire"></i> &nbsp;Limited Seats Available</span>
            <h2 class="idx-cta__heading" id="cta-heading"><?= h(getSetting('cta_heading', 'Ready to Transform Your Life?')) ?></h2>
            <p class="idx-cta__sub"><?= h(getSetting('cta_subtext', 'Take the first step today. Join thousands of people who have already transformed their mindset, relationships, career, and health through D-School System.')) ?></p>
            <div class="idx-cta__actions">
                <a href="calendar.php" class="btn-white">
                    <i class="fas fa-calendar-check"></i> Join a Workshop
                </a>
                <a href="contact.php" class="btn-ghost-dark">
                    <i class="fas fa-envelope"></i> Contact Us
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
