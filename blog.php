<?php
$pageTitle = 'Insights & Inspiration';
$pageMeta  = 'Articles on NLP, mindset, personal growth, leadership and subconscious reprogramming by Chhabi Adhikari — Deschool System.';
$pageSchema = '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Blog",
  "name": "Deschool Insights — NLP, Mindset & Growth",
  "description": "Articles on NLP, personal growth, leadership, and subconscious reprogramming by Chhabi Adhikari."
}
</script>';
include 'includes/header.php';
$pdo = getDB();

$stmt = $pdo->query("SELECT category, COUNT(*) as count FROM blog_posts WHERE is_published = 1 GROUP BY category ORDER BY count DESC LIMIT 10");
$categories = $stmt->fetchAll();

$stmt = $pdo->query("SELECT * FROM blog_posts WHERE is_published = 1 ORDER BY published_at DESC LIMIT 5");
$recent_posts = $stmt->fetchAll();

$stmt = $pdo->query("SELECT * FROM blog_posts WHERE is_published = 1 ORDER BY published_at DESC");
$all_posts    = $stmt->fetchAll();
$featured     = !empty($all_posts) ? $all_posts[0] : null;
$posts        = array_slice($all_posts, 1);

/* category → CSS accent colour */
$catColor = function(string $cat): string {
    $map = [
        'nlp'            => '#7c3aed',
        'business'       => '#FF6A00',
        'leadership'     => '#0B1E3F',
        'money mastery'  => '#dc2626',
        'wellness'       => '#059669',
        'mindset'        => '#0891b2',
        'personal growth'=> '#d97706',
        'students'       => '#2563eb',
    ];
    return $map[strtolower($cat)] ?? '#0B1E3F';
};

/* gradient set for post images */
$gradients = [
    'linear-gradient(135deg,#0B1E3F,#1a4080)',
    'linear-gradient(135deg,#FF6A00,#CC5200)',
    'linear-gradient(135deg,#059669,#047857)',
    'linear-gradient(135deg,#7c3aed,#5b21b6)',
    'linear-gradient(135deg,#dc2626,#b91c1c)',
    'linear-gradient(135deg,#0891b2,#0e7490)',
];
?>

<style>
*, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }

@keyframes fadeUp { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }
@keyframes fadeIn { from{opacity:0} to{opacity:1} }

.b-reveal { opacity:0; transform:translateY(26px); transition:opacity .6s ease, transform .6s ease; }
.b-reveal.visible { opacity:1; transform:translateY(0); }
.b-reveal-d1{transition-delay:.08s} .b-reveal-d2{transition-delay:.16s} .b-reveal-d3{transition-delay:.24s}

.b-container { max-width:1200px; margin:0 auto; padding:0 24px; }

/* ─── HERO ──────────────────────────────────────────────── */
.bh {
    background: linear-gradient(160deg, #060f22 0%, #0B1E3F 55%, #0a1830 100%);
    position: relative; overflow: hidden;
    padding: 110px 0 80px;
}
.bh::before {
    content:''; position:absolute; inset:0;
    background:
        radial-gradient(circle at 75% 30%, rgba(255,106,0,.1) 0%, transparent 45%),
        radial-gradient(circle at 15% 70%, rgba(255,106,0,.06) 0%, transparent 35%),
        repeating-linear-gradient(45deg, transparent, transparent 60px, rgba(255,255,255,.012) 60px, rgba(255,255,255,.012) 61px);
    pointer-events:none;
}
.bh__inner { position:relative; z-index:2; text-align:center; }
.bh__breadcrumb {
    display:flex; justify-content:center; gap:8px;
    font-size:.8rem; color:rgba(255,255,255,.45);
    margin-bottom:22px; animation:fadeIn .7s ease forwards;
}
.bh__breadcrumb a { color:var(--primary); text-decoration:none; }
.bh__breadcrumb a:hover { text-decoration:underline; }
.bh__tag {
    display:inline-flex; align-items:center; gap:8px;
    background:rgba(255,106,0,.15); border:1px solid rgba(255,106,0,.35);
    color:var(--primary); font-size:.75rem; font-weight:700;
    letter-spacing:2px; text-transform:uppercase;
    padding:7px 16px; border-radius:30px; margin-bottom:22px;
    animation:fadeIn .8s ease .1s both;
}
.bh__title {
    font-family:var(--font-heading);
    font-size:clamp(2rem,4.5vw,3.2rem);
    color:#fff; font-weight:700; line-height:1.15;
    margin-bottom:16px;
    animation:fadeUp .8s ease .15s both;
}
.bh__title em {
    font-style:normal;
    background:linear-gradient(90deg,var(--primary),#ffd166);
    -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
}
.bh__sub {
    color:rgba(255,255,255,.68); font-size:1rem; line-height:1.7;
    max-width:520px; margin:0 auto;
    animation:fadeUp .8s ease .22s both;
}

/* ─── STICKY FILTER ─────────────────────────────────────── */
.bf {
    background:#fff;
    border-bottom:1px solid var(--border-color);
    position:sticky; top:80px; z-index:100;
    box-shadow:var(--shadow-sm);
}
.bf__tabs {
    display:flex; overflow-x:auto; scrollbar-width:none;
    justify-content:center; padding:0 24px;
    max-width:1200px; margin:0 auto;
}
.bf__tabs::-webkit-scrollbar { display:none; }
.bf__tab {
    padding:17px 22px; background:none; border:none;
    border-bottom:3px solid transparent;
    color:var(--text-grey); font-size:.82rem; font-weight:700;
    text-transform:uppercase; letter-spacing:.5px;
    cursor:pointer; white-space:nowrap;
    transition:all .25s ease;
}
.bf__tab:hover { color:var(--primary); }
.bf__tab.active { color:var(--primary); border-bottom-color:var(--primary); }

/* ─── MAIN LAYOUT ───────────────────────────────────────── */
.bm {
    padding:70px 0 100px;
    background:var(--bg-section);
}
.bm__layout {
    display:grid; grid-template-columns:1fr 310px;
    gap:46px; align-items:start;
}

/* ─── FEATURED POST ─────────────────────────────────────── */
.bf-post {
    background:#fff; border-radius:22px; overflow:hidden;
    box-shadow:var(--shadow-md);
    display:grid; grid-template-columns:1fr 1fr;
    margin-bottom:36px;
    transition:all .35s cubic-bezier(.165,.84,.44,1);
}
.bf-post:hover { transform:translateY(-5px); box-shadow:var(--shadow-lg); }
.bf-post__img {
    position:relative; overflow:hidden; min-height:300px;
}
.bf-post__bg {
    width:100%; height:100%;
    display:flex; align-items:center; justify-content:center;
    font-size:3.5rem; color:rgba(255,255,255,.45);
    transition:transform .5s ease;
}
.bf-post:hover .bf-post__bg { transform:scale(1.05); }
.bf-post__star {
    position:absolute; top:18px; left:18px;
    background:var(--primary); color:#fff;
    font-size:.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.5px;
    padding:5px 14px; border-radius:20px;
    box-shadow:0 4px 12px rgba(255,106,0,.4);
}
.bf-post__body {
    padding:38px 36px;
    display:flex; flex-direction:column; justify-content:center;
}
.bf-post__cat {
    display:inline-flex; align-items:center; gap:6px;
    font-size:.73rem; font-weight:700; text-transform:uppercase;
    letter-spacing:1px; color:var(--primary);
    margin-bottom:13px;
}
.bf-post__title {
    font-family:var(--font-heading);
    font-size:clamp(1.3rem,2.5vw,1.7rem);
    color:var(--secondary); font-weight:700;
    line-height:1.25; margin-bottom:14px;
    text-decoration:none; display:block;
    transition:color .25s ease;
}
.bf-post__title:hover { color:var(--primary); }
.bf-post__meta {
    display:flex; align-items:center; gap:18px;
    font-size:.8rem; color:var(--text-grey);
    margin-bottom:16px; flex-wrap:wrap;
}
.bf-post__meta i { color:var(--primary); margin-right:4px; }
.bf-post__excerpt {
    color:var(--text-grey); font-size:.9rem; line-height:1.72;
    margin-bottom:24px;
    display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden;
}
.bf-post__cta {
    display:inline-flex; align-items:center; gap:7px;
    color:var(--primary); font-weight:700; font-size:.88rem;
    text-decoration:none; transition:gap .25s ease;
}
.bf-post__cta:hover { gap:11px; color:var(--primary-dark); }

/* ─── POSTS GRID ────────────────────────────────────────── */
.bp-grid {
    display:grid; grid-template-columns:repeat(2,1fr);
    gap:24px;
}
.bp-card {
    background:#fff; border-radius:18px; overflow:hidden;
    box-shadow:var(--shadow-sm);
    transition:all .35s cubic-bezier(.165,.84,.44,1);
    display:flex; flex-direction:column;
}
.bp-card:hover { transform:translateY(-7px); box-shadow:var(--shadow-lg); }
.bp-card.bp-hidden { display:none; }
.bp-card__img {
    position:relative; height:190px; overflow:hidden;
}
.bp-card__bg {
    width:100%; height:100%;
    display:flex; align-items:center; justify-content:center;
    font-size:2.8rem; color:rgba(255,255,255,.45);
    transition:transform .45s ease;
}
.bp-card:hover .bp-card__bg { transform:scale(1.06); }
.bp-card__badge {
    position:absolute; top:12px; left:12px;
    padding:4px 11px; border-radius:16px;
    font-size:.65rem; font-weight:700;
    text-transform:uppercase; letter-spacing:.5px;
    color:#fff;
}
.bp-card__body {
    padding:22px 20px; flex:1;
    display:flex; flex-direction:column;
}
.bp-card__title {
    font-family:var(--font-heading);
    font-size:1.02rem; font-weight:700;
    color:var(--secondary); line-height:1.35;
    margin-bottom:9px; text-decoration:none; display:block;
    transition:color .25s ease;
}
.bp-card__title:hover { color:var(--primary); }
.bp-card__excerpt {
    font-size:.83rem; color:var(--text-grey);
    line-height:1.6; margin-bottom:16px; flex:1;
    display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden;
}
.bp-card__footer {
    display:flex; align-items:center; justify-content:space-between;
    font-size:.77rem; color:var(--text-grey);
    border-top:1px solid #f0f3f8; padding-top:14px; margin-top:auto;
}
.bp-card__footer i { color:var(--primary); margin-right:3px; }
.bp-card__footer a {
    display:inline-flex; align-items:center; gap:5px;
    color:var(--primary); font-weight:700;
    text-decoration:none; transition:gap .25s ease;
}
.bp-card__footer a:hover { gap:8px; color:var(--primary-dark); }

/* Empty */
.bp-empty {
    grid-column:1/-1; text-align:center;
    padding:80px 20px; color:var(--text-grey);
}
.bp-empty i { font-size:3rem; opacity:.2; display:block; margin-bottom:14px; }

/* ─── SIDEBAR ───────────────────────────────────────────── */
.bs { position:sticky; top:140px; }
.bs__widget {
    background:#fff; border-radius:18px;
    padding:28px; box-shadow:var(--shadow-sm);
    margin-bottom:24px;
}
.bs__widget h4 {
    font-family:var(--font-heading);
    font-size:.88rem; font-weight:700;
    color:var(--secondary); text-transform:uppercase;
    letter-spacing:1px; margin-bottom:20px;
    padding-bottom:12px;
    border-bottom:2px solid var(--primary);
}
/* Recent posts */
.bs__recent-item {
    display:flex; gap:14px;
    padding:12px 0; border-bottom:1px solid #f0f3f8;
    align-items:flex-start;
}
.bs__recent-item:last-child { border-bottom:none; padding-bottom:0; }
.bs__recent-thumb {
    width:58px; height:58px; border-radius:10px; flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
    font-size:1.2rem; color:rgba(255,255,255,.6);
}
.bs__recent-info h5 {
    font-size:.85rem; color:var(--secondary); font-weight:600;
    line-height:1.35; margin-bottom:4px;
}
.bs__recent-info h5 a { color:inherit; text-decoration:none; transition:color .25s; }
.bs__recent-info h5 a:hover { color:var(--primary); }
.bs__recent-info span { font-size:.75rem; color:var(--text-grey); }
/* Categories */
.bs__cat-list { list-style:none; }
.bs__cat-list li {
    display:flex; justify-content:space-between; align-items:center;
    padding:10px 0; border-bottom:1px solid #f0f3f8;
    font-size:.88rem;
}
.bs__cat-list li:last-child { border-bottom:none; }
.bs__cat-list a {
    color:var(--text-grey); text-decoration:none;
    cursor:pointer; transition:color .25s;
    display:flex; align-items:center; gap:7px;
}
.bs__cat-list a:hover { color:var(--primary); }
.bs__cat-list a i { color:var(--primary); font-size:.7rem; }
.bs__count {
    background:var(--bg-section); color:var(--text-grey);
    padding:2px 10px; border-radius:20px;
    font-size:.75rem; font-weight:600;
}
/* Tags */
.bs__tags { display:flex; flex-wrap:wrap; gap:8px; }
.bs__tag {
    padding:6px 14px; border-radius:20px;
    border:1.5px solid var(--border-color);
    font-size:.78rem; color:var(--text-grey);
    cursor:pointer; transition:all .25s ease;
    background:#fff;
}
.bs__tag:hover { background:var(--primary); color:#fff; border-color:var(--primary); }
/* Subscribe widget */
.bs__widget--sub {
    background:linear-gradient(135deg,#0B1E3F,#1a3060);
    color:#fff;
}
.bs__widget--sub h4 { color:#fff; border-bottom-color:var(--primary); }
.bs__widget--sub p { font-size:.88rem; opacity:.8; margin-bottom:18px; line-height:1.65; }
.bs__sub-form { display:flex; flex-direction:column; gap:10px; }
.bs__sub-form input {
    padding:11px 14px; border-radius:10px; border:1px solid rgba(255,255,255,.2);
    background:rgba(255,255,255,.1); color:#fff; font-size:.88rem; outline:none;
}
.bs__sub-form input::placeholder { color:rgba(255,255,255,.45); }
.bs__sub-form button {
    padding:11px; background:var(--primary); color:#fff;
    border:none; border-radius:10px; font-weight:700;
    cursor:pointer; font-size:.88rem; transition:all .25s ease;
    display:flex; align-items:center; justify-content:center; gap:8px;
}
.bs__sub-form button:hover { background:var(--primary-dark); transform:translateY(-1px); }
/* Promo widget */
.bs__widget--promo {
    background:linear-gradient(135deg,#FF6A00,#CC5200);
    color:#fff; text-align:center;
}
.bs__widget--promo h4 { color:#fff; border-bottom-color:rgba(255,255,255,.3); }
.bs__widget--promo p { font-size:.88rem; opacity:.9; margin-bottom:20px; line-height:1.6; }
.bs__promo-btn {
    display:inline-flex; align-items:center; gap:8px;
    padding:12px 24px; background:#fff; color:#CC5200;
    font-weight:700; font-size:.82rem; text-transform:uppercase;
    border-radius:30px; text-decoration:none;
    transition:all .25s ease;
}
.bs__promo-btn:hover { transform:translateY(-2px); box-shadow:0 8px 20px rgba(0,0,0,.2); }

/* ─── CTA BANNER ────────────────────────────────────────── */
.b-cta {
    background:linear-gradient(120deg,#0B1E3F 0%,#1a3060 50%,#0B1E3F 100%);
    padding:90px 0; text-align:center;
    position:relative; overflow:hidden;
}
.b-cta::before {
    content:''; position:absolute; inset:0;
    background:
        radial-gradient(circle at 20% 50%, rgba(255,106,0,.1) 0%, transparent 40%),
        radial-gradient(circle at 80% 30%, rgba(255,106,0,.07) 0%, transparent 35%);
    pointer-events:none;
}
.b-cta__inner { position:relative; z-index:1; }
.b-cta__tag {
    display:inline-block;
    background:rgba(255,106,0,.15); border:1px solid rgba(255,106,0,.35);
    color:var(--primary); font-size:.72rem; font-weight:700;
    letter-spacing:2px; text-transform:uppercase;
    padding:6px 16px; border-radius:30px; margin-bottom:20px;
}
.b-cta h2 {
    font-family:var(--font-heading);
    font-size:clamp(1.7rem,3.5vw,2.8rem);
    color:#fff; font-weight:700; line-height:1.15; margin-bottom:14px;
}
.b-cta p { color:rgba(255,255,255,.75); font-size:1rem; margin-bottom:34px; max-width:500px; margin-left:auto; margin-right:auto; line-height:1.65; }
.b-cta__actions { display:flex; gap:14px; justify-content:center; flex-wrap:wrap; }
.btn-orng { display:inline-flex; align-items:center; gap:9px; padding:14px 32px; background:linear-gradient(135deg,#FF6A00,#CC5200); color:#fff; font-weight:700; font-size:.88rem; text-transform:uppercase; letter-spacing:.5px; border-radius:50px; text-decoration:none; box-shadow:0 8px 24px rgba(255,106,0,.35); transition:all .3s ease; }
.btn-orng:hover { transform:translateY(-3px); box-shadow:0 14px 32px rgba(255,106,0,.5); }
.btn-lght { display:inline-flex; align-items:center; gap:9px; padding:13px 28px; border:2px solid rgba(255,255,255,.3); color:#fff; font-weight:700; font-size:.88rem; text-transform:uppercase; border-radius:50px; text-decoration:none; background:rgba(255,255,255,.07); transition:all .3s ease; }
.btn-lght:hover { border-color:rgba(255,255,255,.7); background:rgba(255,255,255,.14); transform:translateY(-2px); }

/* Mobile-only inline CTA strip (hidden on desktop) */
.bm-mobile-cta { display:none; }

/* ─── Responsive ────────────────────────────────────────── */

/* ── Tablet ≤1024px ── */
@media(max-width:1024px){
    .bm__layout { grid-template-columns:1fr; }
    .bs { position:static; display:grid; grid-template-columns:1fr 1fr; gap:20px; align-items:start; }
    .bs__widget { margin-bottom:0; }
    .bm { padding:50px 0 70px; }
}

/* ── Mobile ≤768px ── */
@media(max-width:768px){
    /* Hero */
    .bh { padding:80px 0 46px; }
    .bh__sub { font-size:.92rem; }

    /* Filter bar — left-align so tabs don't overflow */
    .bf__tabs { justify-content:flex-start; padding:0 16px; }
    .bf__tab  { padding:14px 14px; font-size:.76rem; letter-spacing:0; }

    /* Container */
    .b-container { padding:0 16px; }

    /* Main section */
    .bm { padding:34px 0 52px; }

    /* Featured post */
    .bf-post { grid-template-columns:1fr; margin-bottom:22px; border-radius:16px; }
    .bf-post__img { min-height:210px; }
    .bf-post__body { padding:22px 20px; }
    .bf-post__title { font-size:1.2rem; }
    .bf-post__excerpt { -webkit-line-clamp:2; }

    /* Cards */
    .bp-grid { grid-template-columns:1fr; gap:16px; }

    /* Sidebar — single column below posts */
    .bs { grid-template-columns:1fr; }

    /* Mobile inline CTA strip — show between featured and grid */
    .bm-mobile-cta {
        display:flex;
        align-items:center; justify-content:center; gap:10px;
        background:linear-gradient(135deg,#FF6A00,#CC5200);
        color:#fff; font-family:var(--font-heading);
        font-size:.9rem; font-weight:700;
        padding:16px 20px; border-radius:14px;
        margin-bottom:20px; text-decoration:none;
        box-shadow:0 6px 20px rgba(255,106,0,.3);
        transition:all .25s ease;
    }
    .bm-mobile-cta:hover { transform:translateY(-2px); box-shadow:0 10px 28px rgba(255,106,0,.4); }

    /* CTA banner */
    .b-cta { padding:60px 0; }
    .b-cta h2 { font-size:clamp(1.5rem,5vw,2.2rem); }
}

/* ── Small mobile ≤480px ── */
@media(max-width:480px){
    /* Hero */
    .bh { padding:68px 0 38px; }
    .bh__breadcrumb { font-size:.72rem; }
    .bh__tag { font-size:.67rem; padding:6px 12px; letter-spacing:1px; }
    .bh__title { line-height:1.18; }
    .bh__sub { font-size:.86rem; }

    /* Container */
    .b-container { padding:0 14px; }

    /* Filter tabs */
    .bf__tab { padding:13px 12px; font-size:.72rem; }

    /* Featured post */
    .bf-post__img { min-height:180px; }
    .bf-post__body { padding:18px 16px; }
    .bf-post__title { font-size:1.1rem; }
    .bf-post__meta { flex-direction:column; align-items:flex-start; gap:4px; }
    .bf-post__excerpt { display:none; }

    /* Cards */
    .bp-card__img { height:155px; }
    .bp-card__body { padding:16px 14px; }
    .bp-card__title { font-size:.95rem; }
    .bp-card__excerpt { font-size:.8rem; -webkit-line-clamp:2; }
    .bp-card__footer { font-size:.72rem; }

    /* Sidebar widgets */
    .bs__widget { padding:20px 16px; }
    .bs__promo-btn { width:100%; justify-content:center; }

    /* CTA banner */
    .b-cta { padding:50px 0; }
    .b-cta__actions { flex-direction:column; align-items:stretch; }
    .b-cta__actions a { justify-content:center; }
    .b-cta p { font-size:.92rem; }
}

/* ── Very small ≤360px ── */
@media(max-width:360px){
    .bh { padding:62px 0 34px; }
    .b-container { padding:0 12px; }
    .bf-post__body { padding:16px 14px; }
    .bf-post__title { font-size:1rem; }
    .bp-card__img { height:140px; }
    .bp-card__body { padding:14px 12px; }
    .bm-mobile-cta { font-size:.82rem; padding:14px 16px; }
}
</style>

<!-- HERO -->
<section class="bh">
    <div class="b-container">
        <div class="bh__inner">
            <div class="bh__breadcrumb">
                <a href="index.php">Home</a><span>/</span><span>Blog</span>
            </div>
            <div class="bh__tag"><i class="fas fa-pen-nib"></i> Insights &amp; Inspiration</div>
            <h1 class="bh__title">Ideas That<br><em>Rewire Minds</em></h1>
            <p class="bh__sub">Articles on NLP, mindset, subconscious reprogramming, leadership and personal growth by Chhabi Adhikari.</p>
        </div>
    </div>
</section>

<!-- STICKY FILTER -->
<div class="bf">
    <div class="bf__tabs">
        <button class="bf__tab active" data-filter="all">All Posts</button>
        <?php foreach ($categories as $c): ?>
        <button class="bf__tab" data-filter="<?= h(slugify($c['category'])) ?>"><?= h($c['category']) ?></button>
        <?php endforeach; ?>
    </div>
</div>

<!-- MAIN -->
<section class="bm">
    <div class="b-container">
        <div class="bm__layout">

            <!-- Posts column -->
            <div>

                <!-- Featured -->
                <?php if ($featured): ?>
                <article class="bf-post b-reveal">
                    <div class="bf-post__img">
                        <div class="bf-post__bg" style="background:<?= h($featured['image_gradient'] ?: $gradients[0]) ?>">
                            <i class="<?= h($featured['image_icon'] ?: 'fas fa-brain') ?>"></i>
                        </div>
                        <span class="bf-post__star"><i class="fas fa-star"></i> Featured</span>
                    </div>
                    <div class="bf-post__body">
                        <span class="bf-post__cat"><i class="fas fa-tag"></i> <?= h($featured['category']) ?></span>
                        <a href="blog-detail.php?slug=<?= urlencode($featured['slug']) ?>" class="bf-post__title"><?= h($featured['title']) ?></a>
                        <div class="bf-post__meta">
                            <span><i class="fas fa-user"></i><?= h($featured['author'] ?? 'Chhabi Adhikari') ?></span>
                            <span><i class="fas fa-calendar"></i><?= date('F j, Y', strtotime($featured['published_at'])) ?></span>
                        </div>
                        <p class="bf-post__excerpt"><?= h($featured['excerpt']) ?></p>
                        <a href="blog-detail.php?slug=<?= urlencode($featured['slug']) ?>" class="bf-post__cta">
                            Read Full Article <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </article>
                <?php endif; ?>

                <!-- Mobile-only inline CTA — appears between featured and grid on small screens -->
                <a href="contact.php" class="bm-mobile-cta">
                    <i class="fas fa-calendar-check"></i> Book a Free Clarity Session
                </a>

                <!-- Grid -->
                <div class="bp-grid" id="bpGrid">
                    <?php if (empty($posts)): ?>
                    <div class="bp-empty">
                        <i class="fas fa-newspaper"></i>
                        <p>No articles yet. Check back soon!</p>
                    </div>
                    <?php else: foreach ($posts as $k => $post):
                        $grad  = $post['image_gradient'] ?: $gradients[$k % count($gradients)];
                        $icon  = $post['image_icon'] ?: 'fas fa-brain';
                        $color = $catColor($post['category']);
                    ?>
                    <article class="bp-card b-reveal b-reveal-d<?= ($k%3)+1 ?>"
                             data-category="<?= h(slugify($post['category'])) ?>">
                        <div class="bp-card__img">
                            <div class="bp-card__bg" style="background:<?= h($grad) ?>">
                                <i class="<?= h($icon) ?>"></i>
                            </div>
                            <span class="bp-card__badge" style="background:<?= $color ?>">
                                <?= h($post['category']) ?>
                            </span>
                        </div>
                        <div class="bp-card__body">
                            <a href="blog-detail.php?slug=<?= urlencode($post['slug']) ?>" class="bp-card__title">
                                <?= h($post['title']) ?>
                            </a>
                            <p class="bp-card__excerpt"><?= h($post['excerpt']) ?></p>
                            <div class="bp-card__footer">
                                <span><i class="fas fa-calendar"></i><?= date('M j, Y', strtotime($post['published_at'])) ?></span>
                                <a href="blog-detail.php?slug=<?= urlencode($post['slug']) ?>">Read More <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; endif; ?>
                </div>

            </div>

            <!-- Sidebar -->
            <aside class="bs">

                <!-- Recent Posts -->
                <div class="bs__widget b-reveal">
                    <h4>Recent Posts</h4>
                    <?php foreach ($recent_posts as $rp): ?>
                    <div class="bs__recent-item">
                        <div class="bs__recent-thumb" style="background:<?= h($rp['image_gradient'] ?: $gradients[0]) ?>; border-radius:10px;">
                            <i class="<?= h($rp['image_icon'] ?: 'fas fa-brain') ?>"></i>
                        </div>
                        <div class="bs__recent-info">
                            <h5><a href="blog-detail.php?slug=<?= urlencode($rp['slug']) ?>"><?= h($rp['title']) ?></a></h5>
                            <span><i class="fas fa-calendar" style="color:var(--primary);margin-right:4px;font-size:.7rem"></i><?= date('F j, Y', strtotime($rp['published_at'])) ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Categories -->
                <div class="bs__widget b-reveal b-reveal-d1">
                    <h4>Categories</h4>
                    <ul class="bs__cat-list">
                        <?php foreach ($categories as $c): ?>
                        <li>
                            <a class="sidebar-cat-link" data-cat="<?= h(slugify($c['category'])) ?>">
                                <i class="fas fa-chevron-right"></i><?= h($c['category']) ?>
                            </a>
                            <span class="bs__count"><?= $c['count'] ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Tags -->
                <div class="bs__widget b-reveal b-reveal-d2">
                    <h4>Popular Tags</h4>
                    <div class="bs__tags">
                        <?php
                        $tags = ['NLP','Mindset','Success','Leadership','Wealth','Subconscious','Coaching','Nepal','Growth','Trauma','Fear','Identity','Focus','Confidence'];
                        foreach ($tags as $t): ?>
                        <span class="bs__tag"><?= h($t) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Subscribe -->
                <div class="bs__widget bs__widget--sub b-reveal b-reveal-d3">
                    <h4>Stay Updated</h4>
                    <p>Get Chhabi's latest insights on NLP and mind transformation delivered straight to your inbox.</p>
                    <form class="bs__sub-form" onsubmit="return false;">
                        <input type="email" placeholder="Your email address">
                        <button type="submit"><i class="fas fa-paper-plane"></i> Subscribe Free</button>
                    </form>
                </div>

                <!-- Promo -->
                <div class="bs__widget bs__widget--promo b-reveal">
                    <h4>Free Clarity Session</h4>
                    <p>Stop reading about transformation. Experience it — book your free session today.</p>
                    <a href="contact.php" class="bs__promo-btn">
                        <i class="fas fa-calendar-check"></i> Book Now
                    </a>
                </div>

            </aside>
        </div>
    </div>
</section>

<!-- CTA BANNER -->
<section class="b-cta">
    <div class="b-container">
        <div class="b-cta__inner b-reveal">
            <span class="b-cta__tag"><i class="fas fa-fire"></i> &nbsp;Take the Next Step</span>
            <h2>Reading Is Just the Start.<br>Transformation Happens in Action.</h2>
            <p>Every article points to one truth: the mind can change. Let Chhabi show you exactly how — in a free session.</p>
            <div class="b-cta__actions">
                <a href="contact.php" class="btn-orng"><i class="fas fa-calendar-check"></i> Book Free Session</a>
                <a href="videos.php" class="btn-lght"><i class="fas fa-play-circle"></i> Watch Real Cases</a>
            </div>
        </div>
    </div>
</section>

<script>
/* Reveal */
const bobs = new IntersectionObserver(entries => {
    entries.forEach(e => { if(e.isIntersecting){ e.target.classList.add('visible'); bobs.unobserve(e.target); } });
}, { threshold:0.1 });
document.querySelectorAll('.b-reveal').forEach(el => bobs.observe(el));

/* Category filter — top tabs */
function filterBlog(cat) {
    document.querySelectorAll('#bpGrid .bp-card').forEach(card => {
        card.classList.toggle('bp-hidden', cat !== 'all' && card.dataset.category !== cat);
    });
}
document.querySelectorAll('.bf__tab').forEach(tab => {
    tab.addEventListener('click', function(){
        document.querySelectorAll('.bf__tab').forEach(t=>t.classList.remove('active'));
        this.classList.add('active');
        filterBlog(this.dataset.filter);
    });
});

/* Sidebar category links sync with top tabs */
document.querySelectorAll('.sidebar-cat-link').forEach(link => {
    link.addEventListener('click', function(e){
        e.preventDefault();
        const cat = this.dataset.cat;
        const matchingTab = document.querySelector(`.bf__tab[data-filter="${cat}"]`);
        if (matchingTab) matchingTab.click();
        window.scrollTo({ top: document.querySelector('.bm').offsetTop - 100, behavior: 'smooth' });
    });
});

/* Tags — filter too */
document.querySelectorAll('.bs__tag').forEach(tag => {
    tag.addEventListener('click', function(){
        const term = this.textContent.trim().toLowerCase();
        document.querySelectorAll('#bpGrid .bp-card').forEach(card => {
            const title = card.querySelector('.bp-card__title')?.textContent.toLowerCase() || '';
            const cat   = card.dataset.category || '';
            card.classList.toggle('bp-hidden', !title.includes(term) && !cat.includes(term));
        });
        document.querySelectorAll('.bf__tab').forEach(t=>t.classList.remove('active'));
        document.querySelector('.bf__tab[data-filter="all"]').classList.add('active');
    });
});
</script>

<?php include 'includes/footer.php'; ?>
