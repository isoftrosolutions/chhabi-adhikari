<?php
$pageTitle = 'Video Library';
$pageMeta  = 'Watch real mind transformations. Chhabi Adhikari\'s most powerful NLP sessions, mind hacks, and before-after case studies — free to watch.';
$pageSchema = '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "VideoGallery",
  "name": "Real Transformations — Deschool Video Library",
  "description": "Watch Chhabi Adhikari\'s most impactful NLP sessions, mind hacks, and transformation case studies."
}
</script>';
include 'includes/header.php';
$pdo = getDB();
$stmt = $pdo->query("SELECT * FROM videos WHERE is_active = 1 ORDER BY sort_order ASC, created_at DESC");
$videos = $stmt->fetchAll();

$categories  = array_values(array_unique(array_column($videos, 'category')));
$featured    = $videos[0] ?? null;
$rest        = array_slice($videos, 1);
$totalVideos = count($videos);
?>

<style>
/* ─── Base ──────────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

@keyframes fadeUp  { from{opacity:0;transform:translateY(32px)} to{opacity:1;transform:translateY(0)} }
@keyframes fadeIn  { from{opacity:0} to{opacity:1} }
@keyframes float   { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
@keyframes pulseRing { 0%{box-shadow:0 0 0 0 rgba(255,106,0,.5)} 70%{box-shadow:0 0 0 18px rgba(255,106,0,0)} 100%{box-shadow:0 0 0 0 rgba(255,106,0,0)} }
@keyframes ticker  { from{transform:translateX(0)} to{transform:translateX(-50%)} }

.v-reveal { opacity:0; transform:translateY(28px); transition:opacity .65s ease, transform .65s ease; }
.v-reveal.visible { opacity:1; transform:translateY(0); }
.v-reveal-d1 { transition-delay:.1s }
.v-reveal-d2 { transition-delay:.2s }
.v-reveal-d3 { transition-delay:.3s }

.v-container { max-width:1200px; margin:0 auto; padding:0 24px; }
.v-section { padding:90px 0; }

/* ─── HERO ──────────────────────────────────────────────── */
.vh {
    background: linear-gradient(160deg, #060f22 0%, #0B1E3F 55%, #0a1830 100%);
    position: relative;
    overflow: hidden;
    padding: 100px 0 80px;
}
.vh__pattern {
    position: absolute; inset: 0;
    background:
        radial-gradient(circle at 75% 25%, rgba(255,106,0,.1) 0%, transparent 45%),
        radial-gradient(circle at 15% 75%, rgba(255,106,0,.06) 0%, transparent 35%),
        repeating-linear-gradient(45deg, transparent, transparent 60px, rgba(255,255,255,.012) 60px, rgba(255,255,255,.012) 61px);
    pointer-events: none;
}
.vh__inner {
    position: relative; z-index: 2;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}
.vh__tag {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,106,0,.15);
    border: 1px solid rgba(255,106,0,.35);
    color: var(--primary);
    font-size: .75rem; font-weight: 700; letter-spacing: 2px;
    text-transform: uppercase;
    padding: 7px 16px; border-radius: 30px;
    margin-bottom: 22px;
    animation: fadeIn .7s ease forwards;
}
.vh__title {
    font-family: var(--font-heading);
    font-size: clamp(2.2rem, 4.5vw, 3.6rem);
    color: #fff; font-weight: 700;
    line-height: 1.1; letter-spacing: -.5px;
    margin-bottom: 20px;
    animation: fadeUp .8s ease .1s both;
}
.vh__title em {
    font-style: normal;
    background: linear-gradient(90deg, var(--primary), #ffd166);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.vh__sub {
    color: rgba(255,255,255,.72);
    font-size: 1.05rem; line-height: 1.7;
    margin-bottom: 36px;
    max-width: 480px;
    animation: fadeUp .8s ease .2s both;
}
.vh__actions {
    display: flex; gap: 14px; flex-wrap: wrap;
    animation: fadeUp .8s ease .3s both;
}
.btn-orange {
    display: inline-flex; align-items: center; gap: 9px;
    padding: 14px 30px;
    background: linear-gradient(135deg, #FF6A00, #CC5200);
    color: #fff; font-weight: 700; font-size: .88rem;
    text-transform: uppercase; letter-spacing: .5px;
    border-radius: 50px; text-decoration: none;
    box-shadow: 0 8px 24px rgba(255,106,0,.35);
    transition: all .3s ease;
    animation: pulseRing 2.5s infinite;
}
.btn-orange:hover { transform:translateY(-3px); box-shadow:0 14px 32px rgba(255,106,0,.5); }
.btn-ghost-w {
    display: inline-flex; align-items: center; gap: 9px;
    padding: 13px 28px;
    border: 2px solid rgba(255,255,255,.3);
    color: #fff; font-weight: 600; font-size: .88rem;
    text-transform: uppercase; border-radius: 50px;
    text-decoration: none;
    background: rgba(255,255,255,.07);
    backdrop-filter: blur(8px);
    transition: all .3s ease;
}
.btn-ghost-w:hover { border-color:rgba(255,255,255,.7); background:rgba(255,255,255,.14); transform:translateY(-2px); }

/* Hero stats */
.vh__stats {
    display: flex; flex-direction: column; gap: 20px;
    animation: fadeUp .8s ease .4s both;
}
.vh-stat {
    display: flex; align-items: center; gap: 16px;
    background: rgba(255,255,255,.07);
    border: 1px solid rgba(255,255,255,.12);
    border-radius: 16px;
    padding: 18px 22px;
    backdrop-filter: blur(8px);
    transition: all .3s ease;
}
.vh-stat:hover { background:rgba(255,106,0,.12); border-color:rgba(255,106,0,.3); }
.vh-stat__icon {
    width: 48px; height: 48px; border-radius: 12px;
    background: rgba(255,106,0,.15);
    display: flex; align-items: center; justify-content: center;
    color: var(--primary); font-size: 1.2rem; flex-shrink: 0;
}
.vh-stat__num {
    font-family: var(--font-heading);
    font-size: 1.6rem; font-weight: 700; color: #fff; line-height: 1;
}
.vh-stat__label { font-size: .78rem; color: rgba(255,255,255,.55); margin-top: 3px; }

/* ─── FEATURED VIDEO ────────────────────────────────────── */
.vf { background: #fff; }
.vf__inner {
    display: grid; grid-template-columns: 1.1fr 1fr;
    gap: 60px; align-items: center;
}
.vf__thumb {
    position: relative; border-radius: 20px;
    overflow: hidden; cursor: pointer;
    box-shadow: 0 20px 60px rgba(11,30,63,.18);
    aspect-ratio: 16/9;
    transition: transform .35s ease;
}
.vf__thumb:hover { transform: scale(1.015); }
.vf__thumb img,
.vf__thumb .vf__thumb-gradient {
    width: 100%; height: 100%; object-fit: cover; display: block;
}
.vf__thumb-gradient {
    background: var(--grad, linear-gradient(135deg,#0B1E3F,#1a3a7a));
}
.vf__thumb-overlay {
    position: absolute; inset: 0;
    background: rgba(0,0,0,.3);
    display: flex; align-items: center; justify-content: center;
    transition: background .3s ease;
}
.vf__thumb:hover .vf__thumb-overlay { background:rgba(0,0,0,.45); }
.vf__play {
    width: 80px; height: 80px; border-radius: 50%;
    background: rgba(255,106,0,.92);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 1.8rem;
    box-shadow: 0 0 0 14px rgba(255,106,0,.2);
    transition: all .3s ease;
}
.vf__thumb:hover .vf__play { transform:scale(1.1); box-shadow:0 0 0 20px rgba(255,106,0,.2); }
.vf__badge {
    position: absolute; top: 16px; left: 16px;
    background: var(--primary);
    color: #fff; font-size: .7rem; font-weight: 700;
    letter-spacing: 1px; text-transform: uppercase;
    padding: 5px 12px; border-radius: 20px;
}
.vf__label {
    font-size: .75rem; font-weight: 700; letter-spacing: 2px;
    text-transform: uppercase; color: var(--primary);
    display: flex; align-items: center; gap: 8px;
    margin-bottom: 14px;
}
.vf__label::before { content:''; display:block; width:24px; height:2px; background:var(--primary); border-radius:2px; }
.vf__title {
    font-family: var(--font-heading);
    font-size: clamp(1.6rem, 2.8vw, 2.2rem);
    color: var(--secondary); font-weight: 700;
    line-height: 1.2; margin-bottom: 16px;
}
.vf__desc {
    color: var(--text-grey); font-size: .95rem; line-height: 1.75;
    margin-bottom: 28px;
}
.vf__meta {
    display: flex; align-items: center; gap: 16px;
    margin-bottom: 28px; flex-wrap: wrap;
}
.vf__cat {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 6px 14px;
    background: rgba(255,106,0,.1);
    border: 1.5px solid rgba(255,106,0,.25);
    color: var(--primary); font-size: .78rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: .5px;
    border-radius: 20px;
}
.vf__presenter {
    display: flex; align-items: center; gap: 8px;
    color: var(--text-grey); font-size: .82rem;
}
.vf__presenter-dot {
    width: 28px; height: 28px; border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), #CC5200);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: .7rem; font-weight: 700;
}

/* ─── FILTER + GRID ─────────────────────────────────────── */
.vg { background: var(--bg-section); }
.vg__filters {
    display: flex; gap: 10px; flex-wrap: wrap;
    justify-content: center;
    margin-bottom: 50px;
}
.vg__filter-btn {
    padding: 9px 22px;
    border-radius: 30px; border: 2px solid var(--border-color);
    background: #fff; color: var(--text-grey);
    font-size: .82rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: .5px;
    cursor: pointer; transition: all .25s ease;
}
.vg__filter-btn:hover { border-color:var(--primary); color:var(--primary); }
.vg__filter-btn.active {
    background: var(--primary); border-color:var(--primary);
    color: #fff; box-shadow: 0 6px 16px rgba(255,106,0,.3);
}
.vg__grid {
    display: grid; grid-template-columns: repeat(3,1fr);
    gap: 26px;
}
.vc {
    background: #fff; border-radius: 18px;
    overflow: hidden; box-shadow: var(--shadow-sm);
    transition: all .35s cubic-bezier(.165,.84,.44,1);
    cursor: pointer;
}
.vc:hover { transform:translateY(-8px); box-shadow:var(--shadow-lg); }
.vc.hidden { display: none; }
.vc__thumb {
    position: relative; aspect-ratio: 16/9; overflow: hidden;
}
.vc__thumb img {
    width:100%; height:100%; object-fit:cover;
    display:block; transition:transform .4s ease;
}
.vc:hover .vc__thumb img { transform:scale(1.04); }
.vc__thumb-gradient {
    width:100%; height:100%;
    transition:transform .4s ease;
}
.vc:hover .vc__thumb-gradient { transform:scale(1.04); }
.vc__overlay {
    position: absolute; inset: 0;
    background: rgba(0,0,0,.28);
    display: flex; align-items: center; justify-content: center;
    transition: background .3s ease;
}
.vc:hover .vc__overlay { background:rgba(0,0,0,.45); }
.vc__play-btn {
    width: 54px; height: 54px; border-radius: 50%;
    background: rgba(255,106,0,.88);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 1.1rem;
    box-shadow: 0 0 0 10px rgba(255,106,0,.15);
    transition: all .3s ease;
}
.vc:hover .vc__play-btn { transform:scale(1.12); box-shadow:0 0 0 16px rgba(255,106,0,.15); }
.vc__cat-badge {
    position: absolute; top: 12px; left: 12px;
    background: rgba(11,30,63,.75);
    backdrop-filter: blur(6px);
    color: #fff; font-size: .65rem; font-weight: 700;
    letter-spacing: 1px; text-transform: uppercase;
    padding: 4px 10px; border-radius: 14px;
    border: 1px solid rgba(255,255,255,.15);
}
.vc__body { padding: 22px 20px; }
.vc__title {
    font-family: var(--font-heading);
    font-size: 1rem; font-weight: 700;
    color: var(--secondary); line-height: 1.35;
    margin-bottom: 8px;
}
.vc__desc {
    font-size: .82rem; color: var(--text-grey);
    line-height: 1.6; margin-bottom: 16px;
    display: -webkit-box; -webkit-line-clamp: 2;
    -webkit-box-orient: vertical; overflow: hidden;
}
.vc__footer {
    display: flex; align-items: center; justify-content: space-between;
}
.vc__watch {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: .78rem; font-weight: 700; color: var(--primary);
    text-transform: uppercase; letter-spacing: .5px;
    transition: gap .25s ease;
}
.vc:hover .vc__watch { gap: 10px; }
.vc__watch i { font-size: .7rem; }
.vc__yt-icon { color: #ff0000; font-size: 1.2rem; }

/* ─── VIRAL SECTIONS ────────────────────────────────────── */
.vs { background: #fff; position: relative; overflow: hidden; }
.vs--dark {
    background: linear-gradient(135deg, #0B1E3F 0%, #0d2650 100%);
}
.vs__label {
    display: inline-flex; align-items: center; gap: 10px;
    font-size: .75rem; font-weight: 700; letter-spacing: 2px;
    text-transform: uppercase; color: var(--primary);
    margin-bottom: 12px;
}
.vs__label::before { content:''; display:block; width:24px; height:2px; background:var(--primary); border-radius:2px; }
.vs__title {
    font-family: var(--font-heading);
    font-size: clamp(1.7rem, 3vw, 2.4rem);
    font-weight: 700; margin-bottom: 10px; line-height: 1.2;
}
.vs__sub { color: var(--text-grey); font-size: .95rem; line-height: 1.6; margin-bottom: 44px; }
.vs--dark .vs__title { color: #fff; }
.vs--dark .vs__sub { color: rgba(255,255,255,.65); }
.vs--dark .vs__label { color: var(--primary); }

/* Horizontal scroll row */
.vs__row {
    display: grid; grid-template-columns: repeat(4,1fr); gap: 20px;
}
.vs-mini {
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 14px; overflow: hidden;
    cursor: pointer; transition: all .3s ease;
}
.vs-mini:hover { background:rgba(255,106,0,.12); border-color:rgba(255,106,0,.35); transform:translateY(-4px); }
.vs-mini--light { background: #fff; border: 1.5px solid var(--border-color); }
.vs-mini--light:hover { border-color:var(--primary); box-shadow:var(--shadow-md); transform:translateY(-4px); }
.vs-mini__thumb {
    position: relative; aspect-ratio: 16/9; overflow: hidden;
}
.vs-mini__thumb img { width:100%; height:100%; object-fit:cover; display:block; }
.vs-mini__thumb-grad { width:100%; height:100%; }
.vs-mini__overlay {
    position: absolute; inset: 0;
    background: rgba(0,0,0,.3);
    display: flex; align-items: center; justify-content: center;
}
.vs-mini__play {
    width: 38px; height: 38px; border-radius: 50%;
    background: rgba(255,106,0,.85);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: .85rem;
    transition: transform .3s ease;
}
.vs-mini:hover .vs-mini__play { transform:scale(1.15); }
.vs-mini__body { padding: 14px 14px; }
.vs-mini__title {
    font-family: var(--font-heading);
    font-size: .88rem; font-weight: 700; line-height: 1.3;
    display: -webkit-box; -webkit-line-clamp: 2;
    -webkit-box-orient: vertical; overflow: hidden;
}
.vs--dark .vs-mini__title { color: #fff; }
.vs-mini--light .vs-mini__title { color: var(--secondary); }

/* ─── EMPTY STATE ───────────────────────────────────────── */
.v-empty {
    grid-column: 1/-1; text-align:center;
    padding: 80px 20px; color: var(--text-grey);
}
.v-empty i { font-size: 3rem; opacity: .3; margin-bottom: 16px; display: block; }
.v-empty p { font-size: 1.05rem; }

/* ─── MODAL ─────────────────────────────────────────────── */
.v-modal {
    position: fixed; inset: 0; z-index: 9999;
    background: rgba(0,0,0,.88);
    display: flex; align-items: center; justify-content: center;
    padding: 20px;
    opacity: 0; visibility: hidden;
    transition: opacity .3s ease, visibility .3s ease;
    backdrop-filter: blur(4px);
}
.v-modal.open { opacity:1; visibility:visible; }
.v-modal__box {
    position: relative; width:100%; max-width:900px;
    transform: scale(.95);
    transition: transform .3s ease;
}
.v-modal.open .v-modal__box { transform:scale(1); }
.v-modal__close {
    position: absolute; top:-44px; right:0;
    width:38px; height:38px; border-radius:50%;
    background:rgba(255,255,255,.15); border:2px solid rgba(255,255,255,.3);
    color:#fff; cursor:pointer; font-size:1rem;
    display:flex; align-items:center; justify-content:center;
    transition:all .25s ease;
}
.v-modal__close:hover { background:var(--primary); border-color:var(--primary); }
.v-modal__video {
    position:relative; padding-top:56.25%;
    border-radius:16px; overflow:hidden;
    background:#000;
}
.v-modal__video iframe {
    position:absolute; inset:0;
    width:100%; height:100%;
    border:0;
}
.v-modal__info {
    margin-top:18px; text-align:center;
}
.v-modal__title {
    font-family:var(--font-heading);
    color:#fff; font-size:1.15rem; font-weight:700;
    margin-bottom:10px; line-height:1.3;
}
.v-modal__actions { display:flex; gap:12px; justify-content:center; flex-wrap:wrap; }
.v-modal__yt-btn {
    display:inline-flex; align-items:center; gap:8px;
    padding:9px 20px; background:#ff0000; color:#fff;
    font-weight:700; font-size:.82rem; border-radius:30px;
    text-decoration:none; transition:all .25s ease;
}
.v-modal__yt-btn:hover { background:#cc0000; transform:translateY(-2px); }

/* ─── CTA ────────────────────────────────────────────────── */
.v-cta {
    background: linear-gradient(120deg, #FF6A00 0%, #CC5200 50%, #a84000 100%);
    padding: 90px 0; text-align: center;
    position: relative; overflow: hidden;
}
.v-cta::before {
    content:''; position:absolute; inset:0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.06'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    pointer-events:none;
}
.v-cta__inner { position:relative; z-index:1; }
.v-cta__tag {
    display:inline-block;
    background:rgba(255,255,255,.2); border:1px solid rgba(255,255,255,.3);
    color:#fff; font-size:.73rem; font-weight:700;
    letter-spacing:2px; text-transform:uppercase;
    padding:6px 16px; border-radius:30px; margin-bottom:20px;
}
.v-cta h2 {
    font-family:var(--font-heading);
    font-size:clamp(1.8rem,4vw,3rem);
    color:#fff; font-weight:700; line-height:1.15;
    margin-bottom:14px;
}
.v-cta p {
    color:rgba(255,255,255,.85); font-size:1.05rem;
    margin-bottom:36px; max-width:520px;
    margin-left:auto; margin-right:auto; line-height:1.65;
}
.v-cta__actions { display:flex; gap:14px; justify-content:center; flex-wrap:wrap; }
.btn-white-v {
    display:inline-flex; align-items:center; gap:9px;
    padding:14px 32px; background:#fff;
    color:#CC5200; font-weight:700; font-size:.88rem;
    text-transform:uppercase; letter-spacing:.5px;
    border-radius:50px; text-decoration:none;
    box-shadow:0 8px 24px rgba(0,0,0,.15);
    transition:all .3s ease;
}
.btn-white-v:hover { transform:translateY(-3px); box-shadow:0 14px 32px rgba(0,0,0,.2); }
.btn-ghost-v {
    display:inline-flex; align-items:center; gap:9px;
    padding:13px 28px;
    border:2px solid rgba(255,255,255,.5);
    color:#fff; font-weight:700; font-size:.88rem;
    text-transform:uppercase; border-radius:50px;
    text-decoration:none; background:rgba(255,255,255,.08);
    transition:all .3s ease;
}
.btn-ghost-v:hover { border-color:#fff; background:rgba(255,255,255,.18); transform:translateY(-2px); }

/* ─── Responsive ─────────────────────────────────────────── */
@media (max-width:1024px) {
    .vh__inner { grid-template-columns:1fr; gap:40px; }
    .vh__stats { flex-direction:row; flex-wrap:wrap; }
    .vh-stat { flex:1; min-width:180px; }
    .vf__inner { grid-template-columns:1fr; gap:40px; }
    .vg__grid { grid-template-columns:repeat(2,1fr); }
    .vs__row { grid-template-columns:repeat(2,1fr); }
}
@media (max-width:768px) {
    .vg__grid { grid-template-columns:1fr; }
    .vs__row { grid-template-columns:repeat(2,1fr); }
    .vh-stat { min-width:calc(50% - 10px); }
}
@media (max-width:480px) {
    .vh__actions { flex-direction:column; }
    .vh__actions a { justify-content:center; }
    .vs__row { grid-template-columns:1fr; }
    .vh-stat { min-width:100%; }
    .v-cta__actions { flex-direction:column; align-items:center; }
}
</style>

<!-- ══════════════════════════════════════════════
     HERO
══════════════════════════════════════════════ -->
<section class="vh">
    <div class="vh__pattern"></div>
    <div class="v-container">
        <div class="vh__inner">
            <div>
                <div class="vh__tag"><i class="fas fa-play-circle"></i> Video Library</div>
                <h1 class="vh__title">Watch <em>Real<br>Transformations</em></h1>
                <p class="vh__sub">See how the Deschool System rewires minds — in days, not years. Real sessions. Real people. Real results.</p>
                <div class="vh__actions">
                    <a href="#video-grid" class="btn-orange"><i class="fas fa-play"></i> Watch Now</a>
                    <a href="contact.php" class="btn-ghost-w"><i class="fas fa-calendar-check"></i> Book Free Session</a>
                </div>
            </div>
            <div class="vh__stats">
                <div class="vh-stat">
                    <div class="vh-stat__icon"><i class="fas fa-film"></i></div>
                    <div>
                        <div class="vh-stat__num"><?= $totalVideos ?>+</div>
                        <div class="vh-stat__label">Videos Available</div>
                    </div>
                </div>
                <div class="vh-stat">
                    <div class="vh-stat__icon"><i class="fas fa-users"></i></div>
                    <div>
                        <div class="vh-stat__num"><?= h(getSetting('stat_lives','1M+')) ?></div>
                        <div class="vh-stat__label">Lives Touched</div>
                    </div>
                </div>
                <div class="vh-stat">
                    <div class="vh-stat__icon"><i class="fas fa-globe-asia"></i></div>
                    <div>
                        <div class="vh-stat__num"><?= h(getSetting('stat_cities','20+')) ?></div>
                        <div class="vh-stat__label">Cities Reached</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if ($featured): ?>
<!-- ══════════════════════════════════════════════
     FEATURED VIDEO
══════════════════════════════════════════════ -->
<section class="v-section vf">
    <div class="v-container">
        <div class="vf__inner">

            <div class="vf__thumb v-reveal"
                 data-ytid="<?= h($featured['youtube_id']) ?>"
                 data-yturl="<?= h($featured['youtube_url']) ?>"
                 data-title="<?= h($featured['title']) ?>"
                 onclick="openModal(this)">
                <span class="vf__badge"><i class="fas fa-star"></i> Featured</span>
                <?php if ($featured['youtube_id']): ?>
                    <img src="https://img.youtube.com/vi/<?= h($featured['youtube_id']) ?>/maxresdefault.jpg"
                         alt="<?= h($featured['title']) ?>" loading="lazy"
                         onerror="this.src='https://img.youtube.com/vi/<?= h($featured['youtube_id']) ?>/hqdefault.jpg'">
                <?php else: ?>
                    <div class="vf__thumb-gradient" style="background:<?= h($featured['bg_gradient']) ?>"></div>
                <?php endif; ?>
                <div class="vf__thumb-overlay">
                    <div class="vf__play"><i class="fas fa-play"></i></div>
                </div>
            </div>

            <div class="v-reveal v-reveal-d1">
                <p class="vf__label">Featured Session</p>
                <h2 class="vf__title"><?= h($featured['title']) ?></h2>
                <?php if ($featured['description']): ?>
                <p class="vf__desc"><?= h($featured['description']) ?></p>
                <?php endif; ?>
                <div class="vf__meta">
                    <span class="vf__cat"><i class="fas fa-tag"></i> <?= h($featured['category']) ?></span>
                    <div class="vf__presenter">
                        <div class="vf__presenter-dot">C</div>
                        Chhabi Adhikari
                    </div>
                </div>
                <button class="btn-orange"
                        onclick="openModal(document.querySelector('.vf__thumb'))">
                    <i class="fas fa-play"></i> Watch Now
                </button>
            </div>

        </div>
    </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════
     FILTER + GRID
══════════════════════════════════════════════ -->
<section class="v-section vg" id="video-grid">
    <div class="v-container">

        <div style="text-align:center;margin-bottom:14px" class="v-reveal">
            <div style="display:inline-block;width:50px;height:4px;background:linear-gradient(90deg,var(--primary),#CC5200);border-radius:4px;margin-bottom:14px"></div>
            <h2 style="font-family:var(--font-heading);font-size:clamp(1.8rem,3.5vw,2.5rem);color:var(--secondary);font-weight:700;margin-bottom:10px">All Videos</h2>
            <p style="color:var(--text-grey);font-size:1rem">Filter by topic and find what you need</p>
        </div>

        <?php if (count($categories) > 1): ?>
        <div class="vg__filters v-reveal">
            <button class="vg__filter-btn active" data-filter="all">All (<?= $totalVideos ?>)</button>
            <?php foreach ($categories as $cat):
                $count = count(array_filter($videos, fn($v) => $v['category'] === $cat));
            ?>
            <button class="vg__filter-btn" data-filter="<?= h($cat) ?>"><?= h($cat) ?> (<?= $count ?>)</button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="vg__grid" id="vcGrid">
            <?php if (empty($videos)): ?>
            <div class="v-empty">
                <i class="fas fa-video-slash"></i>
                <p>No videos available yet. Check back soon.</p>
            </div>
            <?php else: foreach ($videos as $k => $vid): ?>
            <div class="vc v-reveal <?= $k > 0 ? 'v-reveal-d'.min($k%3+1,3) : '' ?>"
                 data-category="<?= h($vid['category']) ?>"
                 data-ytid="<?= h($vid['youtube_id']) ?>"
                 data-yturl="<?= h($vid['youtube_url']) ?>"
                 data-title="<?= h($vid['title']) ?>"
                 onclick="openModal(this)">

                <div class="vc__thumb">
                    <span class="vc__cat-badge"><?= h($vid['category']) ?></span>
                    <?php if ($vid['youtube_id']): ?>
                    <img src="https://img.youtube.com/vi/<?= h($vid['youtube_id']) ?>/mqdefault.jpg"
                         alt="<?= h($vid['title']) ?>" loading="lazy"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                    <div class="vc__thumb-gradient" style="display:none;background:<?= h($vid['bg_gradient']) ?>"></div>
                    <?php else: ?>
                    <div class="vc__thumb-gradient" style="background:<?= h($vid['bg_gradient']) ?>"></div>
                    <?php endif; ?>
                    <div class="vc__overlay">
                        <div class="vc__play-btn"><i class="fas fa-play"></i></div>
                    </div>
                </div>

                <div class="vc__body">
                    <h3 class="vc__title"><?= h($vid['title']) ?></h3>
                    <?php if ($vid['description']): ?>
                    <p class="vc__desc"><?= h($vid['description']) ?></p>
                    <?php endif; ?>
                    <div class="vc__footer">
                        <span class="vc__watch">Watch <i class="fas fa-arrow-right"></i></span>
                        <?php if ($vid['youtube_url']): ?>
                        <i class="fab fa-youtube vc__yt-icon" title="Available on YouTube"></i>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>

    </div>
</section>

<?php
/* Viral sub-sections — show only if we have enough videos */
$mindHacks    = array_filter($videos, fn($v) => in_array($v['category'],['Mindset','Students','Personal Growth']));
$transformations = array_filter($videos, fn($v) => in_array($v['category'],['NLP','Wellness','Leadership']));
?>

<?php if (count($mindHacks) >= 2): ?>
<!-- ══════════════════════════════════════════════
     🔥 1-MINUTE MIND HACKS
══════════════════════════════════════════════ -->
<section class="v-section vs vs--dark">
    <div class="v-container">
        <p class="vs__label v-reveal"><i class="fas fa-fire"></i> Quick Wins</p>
        <h2 class="vs__title v-reveal v-reveal-d1">🔥 1-Minute Mind Hacks</h2>
        <p class="vs__sub v-reveal v-reveal-d2">Short, powerful clips you can watch right now and feel the shift immediately.</p>

        <div class="vs__row">
            <?php foreach (array_slice($mindHacks,0,4) as $k=>$vid): ?>
            <div class="vs-mini v-reveal v-reveal-d<?= min($k+1,3) ?>"
                 data-ytid="<?= h($vid['youtube_id']) ?>"
                 data-yturl="<?= h($vid['youtube_url']) ?>"
                 data-title="<?= h($vid['title']) ?>"
                 onclick="openModal(this)">
                <div class="vs-mini__thumb">
                    <?php if ($vid['youtube_id']): ?>
                    <img src="https://img.youtube.com/vi/<?= h($vid['youtube_id']) ?>/mqdefault.jpg"
                         alt="<?= h($vid['title']) ?>" loading="lazy">
                    <?php else: ?>
                    <div class="vs-mini__thumb-grad" style="background:<?= h($vid['bg_gradient']) ?>"></div>
                    <?php endif; ?>
                    <div class="vs-mini__overlay"><div class="vs-mini__play"><i class="fas fa-play"></i></div></div>
                </div>
                <div class="vs-mini__body">
                    <p class="vs-mini__title"><?= h($vid['title']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (count($transformations) >= 2): ?>
<!-- ══════════════════════════════════════════════
     📊 BEFORE & AFTER — REAL TRANSFORMATIONS
══════════════════════════════════════════════ -->
<section class="v-section vs">
    <div class="v-container">
        <p class="vs__label v-reveal"><i class="fas fa-chart-line"></i> Case Studies</p>
        <h2 class="vs__title v-reveal v-reveal-d1" style="color:var(--secondary)">📊 Before &amp; After — Real Cases</h2>
        <p class="vs__sub v-reveal v-reveal-d2">These are not motivational stories. These are documented mind transformations — in hours and days.</p>

        <div class="vs__row">
            <?php foreach (array_slice($transformations,0,4) as $k=>$vid): ?>
            <div class="vs-mini vs-mini--light v-reveal v-reveal-d<?= min($k+1,3) ?>"
                 data-ytid="<?= h($vid['youtube_id']) ?>"
                 data-yturl="<?= h($vid['youtube_url']) ?>"
                 data-title="<?= h($vid['title']) ?>"
                 onclick="openModal(this)">
                <div class="vs-mini__thumb">
                    <?php if ($vid['youtube_id']): ?>
                    <img src="https://img.youtube.com/vi/<?= h($vid['youtube_id']) ?>/mqdefault.jpg"
                         alt="<?= h($vid['title']) ?>" loading="lazy">
                    <?php else: ?>
                    <div class="vs-mini__thumb-grad" style="background:<?= h($vid['bg_gradient']) ?>"></div>
                    <?php endif; ?>
                    <div class="vs-mini__overlay"><div class="vs-mini__play"><i class="fas fa-play"></i></div></div>
                </div>
                <div class="vs-mini__body">
                    <p class="vs-mini__title"><?= h($vid['title']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════
     CTA
══════════════════════════════════════════════ -->
<section class="v-cta">
    <div class="v-container">
        <div class="v-cta__inner v-reveal">
            <span class="v-cta__tag"><i class="fas fa-fire"></i> &nbsp;Seen Enough?</span>
            <h2>Ready to Experience This<br>Yourself?</h2>
            <p>The videos show you it's possible. A free session shows you the path — specifically for your mind.</p>
            <div class="v-cta__actions">
                <a href="contact.php" class="btn-white-v">
                    <i class="fas fa-calendar-check"></i> Book Free Session
                </a>
                <a href="contact.php" class="btn-ghost-v">
                    <i class="fas fa-phone"></i> Contact Now
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════
     VIDEO MODAL
══════════════════════════════════════════════ -->
<div class="v-modal" id="vModal" onclick="closeModalOutside(event)">
    <div class="v-modal__box">
        <button class="v-modal__close" onclick="closeModal()" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
        <div class="v-modal__video" id="vModalVideo"></div>
        <div class="v-modal__info">
            <p class="v-modal__title" id="vModalTitle"></p>
            <div class="v-modal__actions" id="vModalActions"></div>
        </div>
    </div>
</div>

<script>
(function () {
    /* ── Scroll reveal ── */
    const obs = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); } });
    }, { threshold: 0.1 });
    document.querySelectorAll('.v-reveal').forEach(el => obs.observe(el));

    /* ── Category filter ── */
    document.querySelectorAll('.vg__filter-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.vg__filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const filter = this.dataset.filter;
            document.querySelectorAll('#vcGrid .vc').forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
        });
    });
})();

/* ── Modal ── */
function openModal(el) {
    const ytId  = el.dataset.ytid;
    const ytUrl = el.dataset.yturl;
    const title = el.dataset.title;
    const modal = document.getElementById('vModal');
    const videoBox = document.getElementById('vModalVideo');
    const titleEl  = document.getElementById('vModalTitle');
    const actionsEl = document.getElementById('vModalActions');

    titleEl.textContent = title || '';

    if (ytId) {
        videoBox.innerHTML = `<iframe src="https://www.youtube.com/embed/${ytId}?autoplay=1&rel=0" allow="autoplay; encrypted-media" allowfullscreen></iframe>`;
        actionsEl.innerHTML = `<a href="${ytUrl || 'https://youtube.com/watch?v='+ytId}" target="_blank" rel="noopener" class="v-modal__yt-btn"><i class="fab fa-youtube"></i> Watch on YouTube</a>`;
    } else if (ytUrl) {
        window.open(ytUrl, '_blank', 'noopener');
        return;
    } else {
        videoBox.innerHTML = `<div style="background:#111;width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#666;font-size:1rem;position:absolute;inset:0;">No video source available.</div>`;
        actionsEl.innerHTML = '';
    }

    modal.classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('vModal');
    modal.classList.remove('open');
    document.body.style.overflow = '';
    document.getElementById('vModalVideo').innerHTML = '';
}

function closeModalOutside(e) {
    if (e.target === document.getElementById('vModal')) closeModal();
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script>

<?php include 'includes/footer.php'; ?>
