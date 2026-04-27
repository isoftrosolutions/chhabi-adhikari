<?php
$pageTitle = 'Programs & Services';
$pageMeta  = 'Explore all Deschool programs — NLP training, life coaching, student programs, 1-on-1 sessions and audio mind programming by Chhabi Adhikari.';
$pageSchema = '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "name": "Deschool Programs & Services",
  "description": "NLP training, life coaching, student programs, and mind reprogramming services by Chhabi Adhikari."
}
</script>';
include 'includes/header.php';

/* Fetch from DB, fall back to hardcoded */
$pdo      = getDB();
$dbSvcs   = $pdo->query("SELECT * FROM services WHERE is_active=1 ORDER BY sort_order ASC")->fetchAll();
$useDB    = !empty($dbSvcs);

/* Hardcoded programs data */
$programs = [
    [
        'badge'       => 'Most Popular',
        'badge_color' => '#FF6A00',
        'image'       => 'assets/Gemini_Generated_Image_q9bjvcq9bjvcq9bj.png',
        'category'    => 'NLP Training',
        'icon'        => 'fas fa-brain',
        'title'       => 'NLP Master Practitioner',
        'desc'        => 'Intensive 5-day workshop for comprehensive NLP training that transforms your understanding of human psychology and communication.',
        'features'    => ['Subconscious reprogramming techniques','Fear & phobia elimination','Communication mastery'],
        'duration'    => '5 Days',
        'format'      => 'In-Person',
        'cert'        => 'Certified',
        'price'       => '₹25,000',
        'cta'         => 'Enroll Now',
        'link'        => 'contact.php',
        'highlight'   => true,
        'filter'      => 'in-person',
    ],
    [
        'badge'       => 'Residential',
        'badge_color' => '#7c3aed',
        'image'       => 'assets/WhatsApp%20Image%202026-02-10%20at%202.58.03%20PM.jpeg',
        'category'    => 'Life Coaching',
        'icon'        => 'fas fa-chalkboard-teacher',
        'title'       => 'Train The Trainer — Life Coach',
        'desc'        => '14-day residential program to master life coaching techniques and learn how to professionally transform lives at scale.',
        'features'    => ['Advanced coaching frameworks','Live practice sessions','Business of coaching'],
        'duration'    => '14 Days',
        'format'      => 'Residential',
        'cert'        => 'Certified',
        'price'       => '₹45,000',
        'cta'         => 'Apply Now',
        'link'        => 'contact.php',
        'highlight'   => false,
        'filter'      => 'residential',
    ],
    [
        'badge'       => 'Online',
        'badge_color' => '#0891b2',
        'image'       => 'assets/ChatGPT%20Image%20Feb%2010,%202026,%2008_03_07%20PM.png',
        'category'    => 'Self-Paced',
        'icon'        => 'fas fa-laptop',
        'title'       => 'Online NLP Bundle',
        'desc'        => 'Complete NLP certification at your own pace with lifetime access to digital content, video sessions, and interactive modules.',
        'features'    => ['Lifetime access to content','Study from anywhere','Certificate on completion'],
        'duration'    => 'Self-Paced',
        'format'      => 'Online',
        'cert'        => 'Certified',
        'price'       => '₹15,000',
        'cta'         => 'Start Learning',
        'link'        => 'contact.php',
        'highlight'   => false,
        'filter'      => 'online',
    ],
    [
        'badge'       => 'For Students',
        'badge_color' => '#059669',
        'image'       => 'assets/WhatsApp%20Image%202026-02-10%20at%202.58.03%20PM%20(2).jpeg',
        'category'    => 'Academic Excellence',
        'icon'        => 'fas fa-graduation-cap',
        'title'       => 'Student Memory Mastery',
        'desc'        => 'Eliminate exam fear, sharpen concentration and boost memory retention. Perfect for students from grade 5 through university.',
        'features'    => ['Exam anxiety elimination','Memory & focus techniques','Confidence building'],
        'duration'    => '3 Days',
        'format'      => 'In-Person',
        'cert'        => 'Popular',
        'price'       => '₹8,000',
        'cta'         => 'Enroll Now',
        'link'        => 'contact.php',
        'highlight'   => false,
        'filter'      => 'in-person',
    ],
    [
        'badge'       => '1-on-1',
        'badge_color' => '#0B1E3F',
        'image'       => 'assets/Gemini_Generated_Image_pl1l98pl1l98pl1l.png',
        'category'    => 'Personal Coaching',
        'icon'        => 'fas fa-user-friends',
        'title'       => 'Coaching & Mentoring',
        'desc'        => 'Private one-on-one sessions with Chhabi — the fastest, most targeted path to rewiring your specific blocks and fears.',
        'features'    => ['Fully personalised sessions','Trauma & fear clearance','Goal achievement strategy'],
        'duration'    => 'Flexible',
        'format'      => '1-on-1',
        'cert'        => 'Personal',
        'price'       => '₹5,000/session',
        'cta'         => 'Book Session',
        'link'        => 'contact.php',
        'highlight'   => false,
        'filter'      => 'personal',
    ],
    [
        'badge'       => 'Audio',
        'badge_color' => '#d97706',
        'image'       => 'assets/Gemini_Generated_Image_kwsdyvkwsdyvkwsd.png',
        'category'    => 'Mind Programming',
        'icon'        => 'fas fa-headphones',
        'title'       => 'Audio Programs',
        'desc'        => 'Specially designed audio sessions to program your subconscious mind positively — while you sleep, commute, or relax.',
        'features'    => ['Downloadable, use offline','Sleep & relaxation tracks','Confidence & success audios'],
        'duration'    => 'On-Demand',
        'format'      => 'Audio',
        'cert'        => 'Downloadable',
        'price'       => '₹3,000',
        'cta'         => 'Get Access',
        'link'        => 'contact.php',
        'highlight'   => false,
        'filter'      => 'online',
    ],
];
?>

<style>
*, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }

@keyframes fadeUp  { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }
@keyframes fadeIn  { from{opacity:0} to{opacity:1} }
@keyframes float   { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
@keyframes pulseRing { 0%{box-shadow:0 0 0 0 rgba(255,106,0,.5)} 70%{box-shadow:0 0 0 16px rgba(255,106,0,0)} 100%{box-shadow:0 0 0 0 rgba(255,106,0,0)} }

.s-reveal { opacity:0; transform:translateY(26px); transition:opacity .6s ease, transform .6s ease; }
.s-reveal.visible { opacity:1; transform:translateY(0); }
.s-reveal-d1{transition-delay:.08s} .s-reveal-d2{transition-delay:.16s} .s-reveal-d3{transition-delay:.24s}

.s-container { max-width:1200px; margin:0 auto; padding:0 24px; }
.s-section { padding:90px 0; }

/* ─── HERO ──────────────────────────────────────────────── */
.sh {
    background:linear-gradient(160deg,#060f22 0%,#0B1E3F 55%,#0a1830 100%);
    position:relative; overflow:hidden;
    padding:110px 0 90px;
}
.sh::before {
    content:''; position:absolute; inset:0;
    background:
        radial-gradient(circle at 70% 25%, rgba(255,106,0,.1) 0%, transparent 45%),
        radial-gradient(circle at 15% 75%, rgba(255,106,0,.06) 0%, transparent 35%),
        repeating-linear-gradient(45deg, transparent, transparent 60px, rgba(255,255,255,.012) 60px, rgba(255,255,255,.012) 61px);
    pointer-events:none;
}
.sh__inner { position:relative; z-index:2; }
.sh__grid { display:grid; grid-template-columns:1fr 1fr; gap:60px; align-items:center; }
.sh__tag {
    display:inline-flex; align-items:center; gap:8px;
    background:rgba(255,106,0,.15); border:1px solid rgba(255,106,0,.35);
    color:var(--primary); font-size:.75rem; font-weight:700;
    letter-spacing:2px; text-transform:uppercase;
    padding:7px 16px; border-radius:30px; margin-bottom:22px;
    animation:fadeIn .7s ease forwards;
}
.sh__title {
    font-family:var(--font-heading);
    font-size:clamp(2rem,4.5vw,3.4rem);
    color:#fff; font-weight:700; line-height:1.1;
    letter-spacing:-.5px; margin-bottom:20px;
    animation:fadeUp .8s ease .1s both;
}
.sh__title em {
    font-style:normal;
    background:linear-gradient(90deg,var(--primary),#ffd166);
    -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
}
.sh__sub {
    color:rgba(255,255,255,.72); font-size:1rem; line-height:1.75;
    max-width:480px; margin-bottom:36px;
    animation:fadeUp .8s ease .2s both;
}
.sh__actions { display:flex; gap:14px; flex-wrap:wrap; animation:fadeUp .8s ease .3s both; }
.btn-s-orange {
    display:inline-flex; align-items:center; gap:9px;
    padding:14px 30px; background:linear-gradient(135deg,#FF6A00,#CC5200);
    color:#fff; font-weight:700; font-size:.88rem;
    text-transform:uppercase; letter-spacing:.5px;
    border-radius:50px; text-decoration:none;
    box-shadow:0 8px 24px rgba(255,106,0,.35);
    transition:all .3s ease; animation:pulseRing 2.5s infinite;
}
.btn-s-orange:hover { transform:translateY(-3px); box-shadow:0 14px 32px rgba(255,106,0,.5); }
.btn-s-ghost {
    display:inline-flex; align-items:center; gap:9px;
    padding:13px 28px; border:2px solid rgba(255,255,255,.3);
    color:#fff; font-weight:600; font-size:.88rem;
    text-transform:uppercase; border-radius:50px; text-decoration:none;
    background:rgba(255,255,255,.07); backdrop-filter:blur(8px);
    transition:all .3s ease;
}
.btn-s-ghost:hover { border-color:rgba(255,255,255,.7); background:rgba(255,255,255,.14); transform:translateY(-2px); }

/* Hero right — program pills */
.sh__programs {
    display:flex; flex-direction:column; gap:14px;
    animation:fadeUp .8s ease .4s both;
}
.sh-prog {
    display:flex; align-items:center; gap:16px;
    background:rgba(255,255,255,.07);
    border:1px solid rgba(255,255,255,.12);
    border-radius:16px; padding:16px 20px;
    backdrop-filter:blur(8px); transition:all .3s ease;
}
.sh-prog:hover { background:rgba(255,106,0,.12); border-color:rgba(255,106,0,.3); transform:translateX(4px); }
.sh-prog__icon {
    width:44px; height:44px; border-radius:12px;
    background:rgba(255,106,0,.15);
    display:flex; align-items:center; justify-content:center;
    color:var(--primary); font-size:1.1rem; flex-shrink:0;
}
.sh-prog__name { font-family:var(--font-heading); color:#fff; font-size:.92rem; font-weight:700; margin-bottom:2px; }
.sh-prog__sub  { font-size:.73rem; color:rgba(255,255,255,.5); }
.sh-prog__badge {
    margin-left:auto; flex-shrink:0;
    padding:3px 10px; border-radius:20px;
    font-size:.65rem; font-weight:700; text-transform:uppercase;
    border:1px solid rgba(255,255,255,.2); color:rgba(255,255,255,.7);
}

/* ─── FILTER ─────────────────────────────────────────────── */
.sf {
    background:#fff; border-bottom:1px solid var(--border-color);
    position:sticky; top:80px; z-index:100; box-shadow:var(--shadow-sm);
}
.sf__tabs {
    display:flex; overflow-x:auto; scrollbar-width:none;
    justify-content:center; padding:0 24px;
    max-width:1200px; margin:0 auto;
}
.sf__tabs::-webkit-scrollbar { display:none; }
.sf__tab {
    padding:16px 22px; background:none; border:none;
    border-bottom:3px solid transparent;
    color:var(--text-grey); font-size:.82rem; font-weight:700;
    text-transform:uppercase; letter-spacing:.5px;
    cursor:pointer; white-space:nowrap; transition:all .25s ease;
}
.sf__tab:hover { color:var(--primary); }
.sf__tab.active { color:var(--primary); border-bottom-color:var(--primary); }

/* ─── PROGRAMS GRID ─────────────────────────────────────── */
.sg { background:var(--bg-section); }
.sg__grid {
    display:grid; grid-template-columns:repeat(3,1fr); gap:28px;
}
.sc {
    background:#fff; border-radius:22px; overflow:hidden;
    box-shadow:var(--shadow-sm);
    transition:all .35s cubic-bezier(.165,.84,.44,1);
    display:flex; flex-direction:column;
    position:relative;
}
.sc.sc--highlight {
    box-shadow:0 0 0 2.5px var(--primary), var(--shadow-md);
}
.sc.sc--highlight::before {
    content:''; position:absolute; top:0; left:0; right:0; height:3px;
    background:linear-gradient(90deg,var(--primary),#ffd166);
}
.sc:hover { transform:translateY(-8px); box-shadow:var(--shadow-lg); }
.sc.sc--highlight:hover { box-shadow:0 0 0 2.5px var(--primary), var(--shadow-lg); }
.sc.sc-hidden { display:none; }

.sc__img-wrap { position:relative; height:210px; overflow:hidden; }
.sc__img { width:100%; height:100%; object-fit:cover; transition:transform .45s ease; }
.sc:hover .sc__img { transform:scale(1.05); }
.sc__badge {
    position:absolute; top:16px; left:16px;
    padding:5px 13px; border-radius:20px;
    font-size:.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.5px;
    color:#fff;
}
.sc__popular {
    position:absolute; top:16px; right:16px;
    background:rgba(255,255,255,.95); color:var(--primary);
    font-size:.65rem; font-weight:700; text-transform:uppercase; letter-spacing:.5px;
    padding:4px 10px; border-radius:12px;
    display:flex; align-items:center; gap:4px;
}

.sc__body { padding:26px 24px; flex:1; display:flex; flex-direction:column; }
.sc__cat {
    display:inline-flex; align-items:center; gap:7px;
    font-size:.72rem; font-weight:700; text-transform:uppercase;
    letter-spacing:1px; color:var(--primary); margin-bottom:10px;
}
.sc__title {
    font-family:var(--font-heading);
    font-size:1.15rem; font-weight:700; color:var(--secondary);
    line-height:1.3; margin-bottom:12px;
}
.sc__desc {
    font-size:.86rem; color:var(--text-grey);
    line-height:1.65; margin-bottom:18px;
}
.sc__features {
    list-style:none; margin-bottom:20px; display:flex; flex-direction:column; gap:7px;
}
.sc__features li {
    display:flex; align-items:flex-start; gap:9px;
    font-size:.82rem; color:var(--text-grey); line-height:1.4;
}
.sc__features li i { color:var(--primary); font-size:.75rem; margin-top:3px; flex-shrink:0; }
.sc__meta {
    display:flex; gap:8px; flex-wrap:wrap; margin-bottom:22px;
}
.sc__meta-tag {
    display:inline-flex; align-items:center; gap:5px;
    padding:5px 12px; border-radius:20px;
    background:var(--bg-section); border:1px solid var(--border-color);
    font-size:.72rem; font-weight:600; color:var(--text-grey);
}
.sc__meta-tag i { color:var(--primary); font-size:.68rem; }

.sc__footer {
    margin-top:auto; padding:20px 24px;
    border-top:1px solid var(--border-color);
    display:flex; align-items:center; justify-content:space-between; gap:12px;
}
.sc__price {
    font-family:var(--font-heading);
    font-size:1.25rem; font-weight:700; color:var(--secondary);
}
.sc__price small { font-size:.72rem; font-weight:600; color:var(--text-grey); display:block; }
.btn-s-enroll {
    display:inline-flex; align-items:center; gap:7px;
    padding:11px 22px; border-radius:30px;
    background:linear-gradient(135deg,#FF6A00,#CC5200);
    color:#fff; font-weight:700; font-size:.8rem;
    text-transform:uppercase; letter-spacing:.5px;
    text-decoration:none; white-space:nowrap;
    transition:all .3s ease; box-shadow:0 6px 16px rgba(255,106,0,.3);
}
.btn-s-enroll:hover { transform:translateY(-2px); box-shadow:0 10px 24px rgba(255,106,0,.45); }
.btn-s-outline {
    display:inline-flex; align-items:center; gap:7px;
    padding:10px 20px; border-radius:30px;
    border:2px solid var(--primary); color:var(--primary);
    font-weight:700; font-size:.8rem;
    text-transform:uppercase; letter-spacing:.5px;
    text-decoration:none; white-space:nowrap;
    transition:all .3s ease;
}
.btn-s-outline:hover { background:var(--primary); color:#fff; transform:translateY(-2px); }

/* ─── HOW IT WORKS ──────────────────────────────────────── */
.sw {
    background:linear-gradient(135deg,#0B1E3F 0%,#0d2650 100%);
    position:relative; overflow:hidden;
}
.sw::before {
    content:''; position:absolute; inset:0;
    background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23fff' fill-opacity='.025'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
    pointer-events:none;
}
.sw__steps {
    position:relative; z-index:1;
    display:grid; grid-template-columns:repeat(4,1fr);
    gap:0;
}
.sw__step {
    text-align:center; padding:50px 28px;
    position:relative;
}
.sw__step:not(:last-child)::after {
    content:''; position:absolute;
    top:50%; right:0; transform:translateY(-50%);
    width:2px; height:60px;
    background:rgba(255,255,255,.1);
}
.sw__num {
    width:64px; height:64px; border-radius:50%;
    border:2px solid rgba(255,106,0,.4);
    background:rgba(255,106,0,.1);
    display:flex; align-items:center; justify-content:center;
    font-family:var(--font-heading); font-size:1.5rem; font-weight:700;
    color:var(--primary); margin:0 auto 20px;
    transition:all .3s ease;
}
.sw__step:hover .sw__num { background:rgba(255,106,0,.2); border-color:var(--primary); transform:scale(1.08); }
.sw__step-title { font-family:var(--font-heading); color:#fff; font-size:1rem; font-weight:700; margin-bottom:10px; }
.sw__step-desc { font-size:.84rem; color:rgba(255,255,255,.6); line-height:1.6; }

/* ─── TRUST STRIP ───────────────────────────────────────── */
.st { background:#fff; padding:50px 0; border-top:1px solid var(--border-color); border-bottom:1px solid var(--border-color); }
.st__grid { display:grid; grid-template-columns:repeat(4,1fr); gap:24px; text-align:center; }
.st__item { padding:10px; }
.st__num { font-family:var(--font-heading); font-size:2.2rem; font-weight:700; color:var(--primary); line-height:1; margin-bottom:6px; }
.st__label { font-size:.82rem; color:var(--text-grey); font-weight:600; text-transform:uppercase; letter-spacing:.5px; }

/* ─── CTA ────────────────────────────────────────────────── */
.s-cta {
    background:linear-gradient(120deg,#FF6A00 0%,#CC5200 55%,#a84000 100%);
    padding:90px 0; text-align:center;
    position:relative; overflow:hidden;
}
.s-cta::before {
    content:''; position:absolute; inset:0;
    background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23fff' fill-opacity='.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
    pointer-events:none;
}
.s-cta__inner { position:relative; z-index:1; }
.s-cta__tag { display:inline-block; background:rgba(255,255,255,.2); border:1px solid rgba(255,255,255,.3); color:#fff; font-size:.72rem; font-weight:700; letter-spacing:2px; text-transform:uppercase; padding:6px 16px; border-radius:30px; margin-bottom:20px; }
.s-cta h2 { font-family:var(--font-heading); font-size:clamp(1.8rem,3.5vw,3rem); color:#fff; font-weight:700; line-height:1.15; margin-bottom:14px; }
.s-cta p { color:rgba(255,255,255,.85); font-size:1rem; margin-bottom:36px; max-width:520px; margin-left:auto; margin-right:auto; line-height:1.65; }
.s-cta__actions { display:flex; gap:14px; justify-content:center; flex-wrap:wrap; }
.btn-sw { display:inline-flex; align-items:center; gap:9px; padding:14px 32px; background:#fff; color:#CC5200; font-weight:700; font-size:.88rem; text-transform:uppercase; letter-spacing:.5px; border-radius:50px; text-decoration:none; box-shadow:0 8px 24px rgba(0,0,0,.15); transition:all .3s ease; }
.btn-sw:hover { transform:translateY(-3px); box-shadow:0 14px 32px rgba(0,0,0,.22); }
.btn-sgw { display:inline-flex; align-items:center; gap:9px; padding:13px 28px; border:2px solid rgba(255,255,255,.5); color:#fff; font-weight:700; font-size:.88rem; text-transform:uppercase; border-radius:50px; text-decoration:none; background:rgba(255,255,255,.08); transition:all .3s ease; }
.btn-sgw:hover { border-color:#fff; background:rgba(255,255,255,.18); transform:translateY(-2px); }

/* ─── Responsive ─────────────────────────────────────────── */
@media(max-width:1024px){
    .sh__grid { grid-template-columns:1fr; gap:40px; }
    .sh__programs { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
    .sg__grid { grid-template-columns:repeat(2,1fr); }
    .sw__steps { grid-template-columns:repeat(2,1fr); }
    .sw__step:not(:last-child)::after { display:none; }
    .st__grid { grid-template-columns:repeat(2,1fr); }
}
@media(max-width:768px){
    .sh { padding:80px 0 50px; }
    .s-container { padding:0 16px; }
    .sg__grid { grid-template-columns:1fr; }
    .sf__tabs { justify-content:flex-start; padding:0 16px; }
    .sf__tab { padding:14px 14px; font-size:.76rem; }
    .s-section { padding:60px 0; }
    .sw__steps { grid-template-columns:1fr 1fr; }
}
@media(max-width:480px){
    .sh { padding:70px 0 40px; }
    .sh__programs { grid-template-columns:1fr; }
    .sw__steps { grid-template-columns:1fr; }
    .st__grid { grid-template-columns:repeat(2,1fr); }
    .sc__footer { flex-direction:column; align-items:stretch; }
    .sc__footer a { justify-content:center; text-align:center; }
    .s-cta__actions { flex-direction:column; align-items:stretch; }
    .s-cta__actions a { justify-content:center; }
}
</style>

<!-- HERO -->
<section class="sh">
    <div class="s-container">
        <div class="sh__inner">
            <div class="sh__grid">
                <div>
                    <div class="sh__tag"><i class="fas fa-layer-group"></i> Programs & Services</div>
                    <h1 class="sh__title">Find the Program<br>That <em>Rewires You</em></h1>
                    <p class="sh__sub">From intensive in-person workshops to self-paced online learning — every program is designed to create permanent change at the subconscious level.</p>
                    <div class="sh__actions">
                        <a href="#programs-grid" class="btn-s-orange"><i class="fas fa-search"></i> Explore Programs</a>
                        <a href="contact.php" class="btn-s-ghost"><i class="fas fa-calendar-check"></i> Free Consultation</a>
                    </div>
                </div>
                <div class="sh__programs">
                    <?php foreach (array_slice($programs, 0, 4) as $p): ?>
                    <div class="sh-prog">
                        <div class="sh-prog__icon"><i class="<?= h($p['icon']) ?>"></i></div>
                        <div>
                            <div class="sh-prog__name"><?= h($p['title']) ?></div>
                            <div class="sh-prog__sub"><?= h($p['duration']) ?> &nbsp;·&nbsp; <?= h($p['format']) ?></div>
                        </div>
                        <span class="sh-prog__badge"><?= h($p['badge']) ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TRUST STRIP -->
<div class="st">
    <div class="s-container">
        <div class="st__grid">
            <div class="st__item s-reveal">
                <div class="st__num"><?= h(getSetting('stat_lives','1M+')) ?></div>
                <div class="st__label">Lives Touched</div>
            </div>
            <div class="st__item s-reveal s-reveal-d1">
                <div class="st__num"><?= h(getSetting('stat_programs','50+')) ?></div>
                <div class="st__label">Programs Delivered</div>
            </div>
            <div class="st__item s-reveal s-reveal-d2">
                <div class="st__num"><?= h(getSetting('stat_cities','20+')) ?></div>
                <div class="st__label">Cities Reached</div>
            </div>
            <div class="st__item s-reveal s-reveal-d3">
                <div class="st__num"><?= h(getSetting('stat_decades','20+')) ?></div>
                <div class="st__label">Years of Expertise</div>
            </div>
        </div>
    </div>
</div>

<!-- FILTER + GRID -->
<div class="sf">
    <div class="sf__tabs">
        <button class="sf__tab active" data-filter="all">All Programs</button>
        <button class="sf__tab" data-filter="in-person">In-Person</button>
        <button class="sf__tab" data-filter="residential">Residential</button>
        <button class="sf__tab" data-filter="online">Online / Audio</button>
        <button class="sf__tab" data-filter="personal">1-on-1</button>
    </div>
</div>

<section class="s-section sg" id="programs-grid">
    <div class="s-container">
        <div class="sg__grid" id="sgGrid">
            <?php foreach ($programs as $k => $p): ?>
            <article class="sc s-reveal s-reveal-d<?= ($k%3)+1 ?> <?= $p['highlight'] ? 'sc--highlight' : '' ?>"
                     data-filter="<?= h($p['filter']) ?>">

                <div class="sc__img-wrap">
                    <img class="sc__img" src="<?= BASE_URL ?>/<?= h($p['image']) ?>"
                         alt="<?= h($p['title']) ?>" loading="lazy">
                    <span class="sc__badge" style="background:<?= $p['badge_color'] ?>"><?= h($p['badge']) ?></span>
                    <?php if ($p['highlight']): ?>
                    <span class="sc__popular"><i class="fas fa-fire"></i> Most Popular</span>
                    <?php endif; ?>
                </div>

                <div class="sc__body">
                    <span class="sc__cat"><i class="<?= h($p['icon']) ?>"></i> <?= h($p['category']) ?></span>
                    <h2 class="sc__title"><?= h($p['title']) ?></h2>
                    <p class="sc__desc"><?= h($p['desc']) ?></p>
                    <ul class="sc__features">
                        <?php foreach ($p['features'] as $f): ?>
                        <li><i class="fas fa-check-circle"></i><?= h($f) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="sc__meta">
                        <span class="sc__meta-tag"><i class="fas fa-clock"></i><?= h($p['duration']) ?></span>
                        <span class="sc__meta-tag"><i class="fas fa-map-marker-alt"></i><?= h($p['format']) ?></span>
                        <span class="sc__meta-tag"><i class="fas fa-certificate"></i><?= h($p['cert']) ?></span>
                    </div>
                </div>

                <div class="sc__footer">
                    <div class="sc__price">
                        <?= h($p['price']) ?>
                        <small>Contact for group rates</small>
                    </div>
                    <a href="<?= h($p['link']) ?>" class="<?= $p['highlight'] ? 'btn-s-enroll' : 'btn-s-outline' ?>">
                        <?= h($p['cta']) ?> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="s-section sw">
    <div class="s-container">
        <div style="text-align:center;margin-bottom:60px;position:relative;z-index:1" class="s-reveal">
            <div style="display:inline-block;width:48px;height:4px;background:linear-gradient(90deg,var(--primary),#ffd166);border-radius:4px;margin-bottom:14px"></div>
            <h2 style="font-family:var(--font-heading);font-size:clamp(1.8rem,3vw,2.5rem);color:#fff;font-weight:700;margin-bottom:10px">How It Works</h2>
            <p style="color:rgba(255,255,255,.65);font-size:1rem;max-width:480px;margin:0 auto">From first contact to lasting transformation — four simple steps.</p>
        </div>
        <div class="sw__steps">
            <div class="sw__step s-reveal">
                <div class="sw__num">1</div>
                <div class="sw__step-title">Free Consultation</div>
                <p class="sw__step-desc">Book a free 20-minute call. We understand your situation and recommend the right program.</p>
            </div>
            <div class="sw__step s-reveal s-reveal-d1">
                <div class="sw__num">2</div>
                <div class="sw__step-title">Choose Your Path</div>
                <p class="sw__step-desc">Select the program that fits your goals, timeline, and budget. All formats available.</p>
            </div>
            <div class="sw__step s-reveal s-reveal-d2">
                <div class="sw__num">3</div>
                <div class="sw__step-title">The Session</div>
                <p class="sw__step-desc">Experience the Deschool System — subconscious-level work that creates real, measurable shifts.</p>
            </div>
            <div class="sw__step s-reveal s-reveal-d3">
                <div class="sw__num">4</div>
                <div class="sw__step-title">Lasting Change</div>
                <p class="sw__step-desc">Leave different. The changes go to the root — fear gone, clarity restored, identity rebuilt.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="s-cta">
    <div class="s-container">
        <div class="s-cta__inner s-reveal">
            <span class="s-cta__tag"><i class="fas fa-fire"></i> &nbsp;Not Sure Where to Start?</span>
            <h2>Let's Find the Right<br>Program for You</h2>
            <p>Book a free 20-minute consultation. We'll listen, understand, and recommend the exact path for your situation.</p>
            <div class="s-cta__actions">
                <a href="contact.php" class="btn-sw"><i class="fas fa-calendar-check"></i> Book Free Consultation</a>
                <a href="contact.php" class="btn-sgw"><i class="fas fa-phone"></i> Call Now</a>
            </div>
        </div>
    </div>
</section>

<script>
/* Reveal */
const sobs = new IntersectionObserver(entries => {
    entries.forEach(e => { if(e.isIntersecting){ e.target.classList.add('visible'); sobs.unobserve(e.target); } });
}, { threshold:0.1 });
document.querySelectorAll('.s-reveal').forEach(el => sobs.observe(el));

/* Filter */
document.querySelectorAll('.sf__tab').forEach(btn => {
    btn.addEventListener('click', function(){
        document.querySelectorAll('.sf__tab').forEach(b=>b.classList.remove('active'));
        this.classList.add('active');
        const f = this.dataset.filter;
        document.querySelectorAll('#sgGrid .sc').forEach(card => {
            card.classList.toggle('sc-hidden', f !== 'all' && card.dataset.filter !== f);
        });
    });
});

/* Smooth scroll for hero CTA */
document.querySelector('a[href="#programs-grid"]')?.addEventListener('click', e => {
    e.preventDefault();
    document.getElementById('programs-grid').scrollIntoView({ behavior:'smooth', block:'start' });
});
</script>

<?php include 'includes/footer.php'; ?>
