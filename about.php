<?php
$pageTitle = 'About Us - Chhabi Adhikari & D-school System';
$pageSchema = '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "AboutPage",
  "name": "About Chhabi Adhikari & D-school System",
  "description": "Learn about Chhabi Adhikari, Nepal\'s foremost NLP authority, and the mission of D-school System to transform lives."
}
</script>';
include 'includes/header.php';
?>

<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

@keyframes fadeUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes scaleIn { from { opacity: 0; transform: scale(.94); } to { opacity: 1; transform: scale(1); } }
@keyframes float { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-10px);} }

.reveal { opacity: 0; transform: translateY(36px); transition: opacity .7s ease, transform .7s ease; }
.reveal.visible { opacity: 1; transform: translateY(0); }
.reveal-delay-1 { transition-delay: .1s; }
.reveal-delay-2 { transition-delay: .2s; }
.reveal-delay-3 { transition-delay: .3s; }
.reveal-delay-4 { transition-delay: .4s; }

.about-hero {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: linear-gradient(155deg, #0d1b35 0%, #1a2f5a 45%, #0f2040 100%);
    overflow: hidden;
}
.about-hero__bg {
    position: absolute;
    inset: 0;
    background-image:
        radial-gradient(circle at 85% 15%, rgba(245,166,35,.12) 0%, transparent 50%),
        radial-gradient(circle at 15% 85%, rgba(245,166,35,.08) 0%, transparent 40%),
        repeating-linear-gradient(45deg, transparent, transparent 60px, rgba(255,255,255,.015) 60px, rgba(255,255,255,.015) 61px);
    pointer-events: none;
}
.about-hero__inner {
    position: relative;
    z-index: 2;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
    padding: 100px 24px;
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
}
.about-hero__eyebrow {
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
    margin-bottom: 24px;
    backdrop-filter: blur(6px);
    animation: fadeIn .8s ease forwards;
}
.about-hero__title {
    font-family: var(--font-heading);
    font-size: clamp(2.4rem, 5vw, 3.8rem);
    font-weight: 700;
    color: #fff;
    line-height: 1.1;
    letter-spacing: -1px;
    margin-bottom: 24px;
    animation: fadeUp .9s ease .1s both;
}
.about-hero__title em {
    font-style: normal;
    background: linear-gradient(90deg, var(--primary), #ffd166);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.about-hero__text {
    font-size: 1.05rem;
    color: rgba(255,255,255,.78);
    line-height: 1.8;
    margin-bottom: 32px;
    max-width: 520px;
    animation: fadeUp .9s ease .2s both;
}
.about-hero__image-wrap {
    position: relative;
    animation: scaleIn 1s ease .2s both;
}
.about-hero__image-frame {
    position: relative;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 40px 100px rgba(0,0,0,.5);
}
.about-hero__image-frame img {
    width: 100%;
    height: 550px;
    object-fit: cover;
    display: block;
}
.about-hero__image-frame::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(10,20,50,.5) 0%, transparent 50%);
    z-index: 1;
    border-radius: 24px;
}
.about-hero__badge {
    position: absolute;
    bottom: 24px;
    left: 24px;
    z-index: 2;
    background: rgba(245,166,35,.95);
    border-radius: 16px;
    padding: 16px 24px;
    display: flex;
    align-items: center;
    gap: 14px;
    box-shadow: 0 10px 30px rgba(245,166,35,.5);
}
.about-hero__badge i { font-size: 1.8rem; color: #fff; }
.about-hero__badge strong { font-family: var(--font-heading); font-size: 1.4rem; color: var(--secondary); display: block; }
.about-hero__badge span { font-size: .75rem; color: var(--secondary); font-weight: 600; text-transform: uppercase; letter-spacing: .5px; }
.about-hero__deco-ring {
    position: absolute;
    top: -30px;
    right: -30px;
    width: 140px;
    height: 140px;
    border-radius: 50%;
    border: 3px dashed rgba(245,166,35,.4);
    animation: float 4s ease-in-out infinite;
    pointer-events: none;
}

.about-section { padding: 100px 0; }
.about-section--dark { background: linear-gradient(135deg, var(--secondary) 0%, #0d1b35 100%); }
.about-section--light { background: #f8f9fc; }
.about-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

.section-header { text-align: center; margin-bottom: 60px; }
.section-header__eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(245,166,35,.15);
    border: 1px solid rgba(245,166,35,.35);
    color: var(--primary);
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 8px 16px;
    border-radius: 30px;
    margin-bottom: 18px;
}
.section-header__title {
    font-family: var(--font-heading);
    font-size: clamp(1.8rem, 3.5vw, 2.6rem);
    font-weight: 700;
    color: var(--secondary);
    line-height: 1.2;
    letter-spacing: -.5px;
}
.section-header__title--light { color: #fff; }
.section-header__desc {
    font-size: 1rem;
    color: var(--text-grey);
    max-width: 600px;
    margin: 16px auto 0;
    line-height: 1.7;
}
.section-header__desc--light { color: rgba(255,255,255,.7); }

.about-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
}
.about-grid__img {
    position: relative;
}
.about-grid__frame {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-lg);
}
.about-grid__frame::before {
    content: '';
    position: absolute;
    inset: -4px;
    border-radius: 24px;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark), var(--secondary));
    z-index: -1;
}
.about-grid__frame img {
    width: 100%;
    height: 450px;
    object-fit: cover;
    border-radius: 18px;
    display: block;
}
.about-grid__content h3 {
    font-size: .8rem;
    font-weight: 700;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: var(--primary);
    margin-bottom: 12px;
}
.about-grid__content h2 {
    font-family: var(--font-heading);
    font-size: clamp(1.6rem, 3vw, 2.2rem);
    font-weight: 700;
    color: var(--secondary);
    line-height: 1.25;
    margin-bottom: 20px;
}
.about-grid__content p {
    color: var(--text-grey);
    font-size: .97rem;
    line-height: 1.8;
    margin-bottom: 16px;
}
.about-grid__content--light h2 { color: #fff; }
.about-grid__content--light p { color: rgba(255,255,255,.75); }

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    margin-top: 50px;
}
.stat-card {
    text-align: center;
    padding: 30px 20px;
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.15);
    border-radius: 20px;
    backdrop-filter: blur(10px);
    transition: all .3s ease;
}
.stat-card:hover { transform: translateY(-5px); background: rgba(255,255,255,.12); }
.stat-card__num {
    font-family: var(--font-heading);
    font-size: 2.8rem;
    font-weight: 700;
    color: var(--primary);
    line-height: 1;
    margin-bottom: 8px;
}
.stat-card__label {
    font-size: .85rem;
    font-weight: 600;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
}
.value-card {
    background: #fff;
    border-radius: 20px;
    padding: 40px 30px;
    box-shadow: var(--shadow-sm);
    text-align: center;
    transition: all .35s ease;
}
.value-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); }
.value-card__icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
    font-size: 1.8rem;
    color: #fff;
    box-shadow: 0 10px 30px rgba(245,166,35,.35);
}
.value-card__title {
    font-family: var(--font-heading);
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--secondary);
    margin-bottom: 12px;
}
.value-card__desc {
    font-size: .9rem;
    color: var(--text-grey);
    line-height: 1.7;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}
.team-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all .35s ease;
}
.team-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); }
.team-card__img {
    height: 280px;
    background: linear-gradient(135deg, var(--secondary), #1a3a6a);
    display: flex;
    align-items: center;
    justify-content: center;
}
.team-card__img i { font-size: 4rem; color: rgba(255,255,255,.2); }
.team-card__body { padding: 24px; }
.team-card__name {
    font-family: var(--font-heading);
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--secondary);
    margin-bottom: 6px;
}
.team-card__role {
    font-size: .85rem;
    color: var(--primary);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 12px;
}
.team-card__desc {
    font-size: .85rem;
    color: var(--text-grey);
    line-height: 1.6;
}

.cta-section {
    background: linear-gradient(120deg, var(--primary) 0%, var(--primary-dark) 50%, #c85f00 100%);
    padding: 100px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.cta-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.06'%3E%3Cpath d='M50 50c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10S0 25.523 0 20s4.477-10 10-10zM10 10c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10S0 25.523 0 20s4.477-10 10-10z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    pointer-events: none;
}
.cta-section__inner { position: relative; z-index: 1; }
.cta-section__title {
    font-family: var(--font-heading);
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 700;
    color: #fff;
    margin-bottom: 20px;
}
.cta-section__text {
    color: rgba(255,255,255,.9);
    font-size: 1.1rem;
    margin-bottom: 36px;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}
.cta-section__actions { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
.btn-white {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 36px;
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
.btn-outline-white {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 15px 34px;
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
.btn-outline-white:hover { border-color: #fff; background: rgba(255,255,255,.18); transform: translateY(-2px); }

@media (max-width: 1024px) {
    .about-hero__inner { grid-template-columns: 1fr; gap: 50px; padding: 120px 24px 80px; }
    .about-hero__image-wrap { display: none; }
    .about-grid { grid-template-columns: 1fr; gap: 50px; }
    .about-grid__img { order: -1; }
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .values-grid { grid-template-columns: 1fr 1fr; }
    .team-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 768px) {
    .about-hero__title { font-size: clamp(2rem, 8vw, 2.8rem); }
    .stats-grid { grid-template-columns: 1fr 1fr; gap: 16px; }
    .values-grid { grid-template-columns: 1fr; }
    .team-grid { grid-template-columns: 1fr; }
}
@media (max-width: 480px) {
    .about-hero__inner { padding: 100px 24px 60px; }
    .cta-section__actions { flex-direction: column; align-items: center; }
}
</style>

<!-- HERO -->
<section class="about-hero">
    <div class="about-hero__bg"></div>
    <div class="about-hero__inner">
        <div class="about-hero__copy">
            <div class="about-hero__eyebrow">
                <i class="fas fa-star"></i> About D School System
            </div>
            <h1 class="about-hero__title">
                Awaken Your <em>Inner Potential</em><br>
                Transform Every Area of Your <em>Life</em>
            </h1>
            <p class="about-hero__text">
                At D School System, we believe every individual has the power to transform their life. Through Neuro-Linguistic Programming, science-backed techniques, and practical strategies, we train people in Nepal and beyond to unlock their true potential.
            </p>
        </div>
        <div class="about-hero__image-wrap">
            <div class="about-hero__deco-ring"></div>
            <div class="about-hero__image-frame">
                <img src="assets/Gemini_Generated_Image_ejsw4zejsw4zejsw.png" alt="D School System">
                <div class="about-hero__badge">
                    <i class="fas fa-award"></i>
                    <div>
                        <strong>20+ Years</strong>
                        <span>Transforming Nepal</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MISSION & VISION -->
<section class="about-section about-section--light">
    <div class="about-container">
        <div class="about-grid">
            <div class="about-grid__content reveal">
                <h3>Our Purpose</h3>
                <h2>Empowering Individuals to Lead Extraordinary Lives</h2>
                <p>Founded with a singular mission: to bring world-class personal development training to Nepal. We combinescientific approaches with practical, applicable techniques that create real, lasting change in every participant.</p>
                <p>From corporate leaders to students, entrepreneurs to homemakers — D School System has helped thousands discover thepower within themselves to achieve their goals.</p>
            </div>
            <div class="about-grid__img reveal reveal-delay-1">
                <div class="about-grid__frame">
                    <video controls poster="assets/Gemini_Generated_Image_ejsw4zejsw4zejsw.png" style="width:100%; height:450px; object-fit:cover; border-radius:18px;">
                        <source src="assets/Introduction_%20Dr.%20Chhabi%20Adhikari.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STATS -->
<section class="about-section about-section--dark">
    <div class="about-container">
        <div class="section-header">
            <span class="section-header__eyebrow"><i class="fas fa-chart-line"></i> Our Impact</span>
            <h2 class="section-header__title--light">Two Decades of Transformation</h2>
            <p class="section-header__desc--light">Real numbers that speak to our commitment and results</p>
        </div>
        <div class="stats-grid">
            <div class="stat-card reveal">
                <div class="stat-card__num">2M+</div>
                <div class="stat-card__label">Lives Touched</div>
            </div>
            <div class="stat-card reveal reveal-delay-1">
                <div class="stat-card__num">50+</div>
                <div class="stat-card__label">Programs</div>
            </div>
            <div class="stat-card reveal reveal-delay-2">
                <div class="stat-card__num">20+</div>
                <div class="stat-card__label">Cities</div>
            </div>
            <div class="stat-card reveal reveal-delay-3">
                <div class="stat-card__num">100K+</div>
                <div class="stat-card__label">Video Views</div>
            </div>
        </div>
    </div>
</section>

<!-- DR. CHHABI -->
<section class="about-section about-section--light">
    <div class="about-container">
        <div class="about-grid">
            <div class="about-grid__img reveal">
                <div class="about-grid__frame">
                    <img src="assets/Gemini_Generated_Image_ejsw4zejsw4zejsw.png" alt="Chhabi Adhikari">
                </div>
            </div>
            <div class="about-grid__content reveal reveal-delay-1">
                <h3>Meet the Founder</h3>
                <h2>Chhabi Adhikari — Nepal's NLP Pioneer</h2>
                <p>Chhabi Adhikari is a pioneering figure in Neuro-Linguistic Programming and personal development in Nepal. With over two decades of experience, he has transformed countless lives through his workshops, seminars, and coaching programs.</p>
                <p>As the founder of D School System, he envisioned a world where every individual is empowered to reach their full potential. His methodologies are rooted in practical application, deep psychological insights, and the belief that lasting change comes from within.</p>
                <p>Certifications and recognition from international bodies — combined with a deep understanding of Nepali culture and values — make his approach uniquely effective for Nepal's growing community of change-makers.</p>
            </div>
        </div>
    </div>
</section>

<!-- VALUES -->
<section class="about-section about-section--light" style="background: #f0f2f7;">
    <div class="about-container">
        <div class="section-header">
            <span class="section-header__eyebrow"><i class="fas fa-heart"></i> Our Values</span>
            <h2 class="section-header__title">What Drives Us</h2>
            <p class="section-header__desc">The principles that guide every program and interaction</p>
        </div>
        <div class="values-grid">
            <div class="value-card reveal">
                <div class="value-card__icon"><i class="fas fa-brain"></i></div>
                <h3 class="value-card__title">Transformation</h3>
                <p class="value-card__desc">We believe real change comes from within. Our programs are designed to reprogram limiting beliefs and install lasting success patterns.</p>
            </div>
            <div class="value-card reveal reveal-delay-1">
                <div class="value-card__icon"><i class="fas fa-hand-holding-heart"></i></div>
                <h3 class="value-card__title">Impact</h3>
                <p class="value-card__desc">Every participant matters. We're committed to measurable, life-changing results for individuals, families, and organizations.</p>
            </div>
            <div class="value-card reveal reveal-delay-2">
                <div class="value-card__icon"><i class="fas fa-globe-asia"></i></div>
                <h3 class="value-card__title">Excellence</h3>
                <p class="value-card__desc">World-class training adapted for Nepal. We combine international methodologies with local understanding.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="cta-section__inner">
        <h2 class="cta-section__title">Ready to Transform Your Life?</h2>
        <p class="cta-section__text">Join thousands who have discovered their potential with D School System.</p>
        <div class="cta-section__actions">
            <a href="courses.php" class="btn-white">
                <i class="fas fa-graduation-cap"></i> Explore Programs
            </a>
            <a href="contact.php" class="btn-outline-white">
                <i class="fas fa-envelope"></i> Contact Us
            </a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
    reveals.forEach(el => observer.observe(el));
});
</script>

<?php include 'includes/footer.php'; ?>