<?php
$pageTitle = 'Gallery';
$pageMeta  = 'Behind the scenes of the Deschool System — real workshops, real people, real transformations captured in moments.';
$pageSchema = '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ImageGallery",
  "name": "Deschool Gallery — Real Workshops & Transformations",
  "description": "Behind the scenes of the Deschool System — workshops, events, and transformation moments."
}
</script>';
include 'includes/header.php';

$galleryImages = [];
try {
    $stmt = getDB()->prepare("SELECT * FROM gallery WHERE is_active = 1 ORDER BY sort_order ASC, id DESC");
    $stmt->execute();
    $galleryImages = $stmt->fetchAll();
} catch (Exception $e) {}

$categories  = array_values(array_unique(array_filter(array_column($galleryImages, 'category'))));
$totalImages = count($galleryImages);
?>

<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

@keyframes fadeUp  { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }
@keyframes fadeIn  { from{opacity:0} to{opacity:1} }
@keyframes float   { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }

.g-reveal { opacity:0; transform:translateY(26px); transition:opacity .6s ease, transform .6s ease; }
.g-reveal.visible { opacity:1; transform:translateY(0); }
.g-reveal-d1 { transition-delay:.08s } .g-reveal-d2 { transition-delay:.15s } .g-reveal-d3 { transition-delay:.22s }

.g-container { max-width:1240px; margin:0 auto; padding:0 24px; }
.g-section { padding:90px 0; }

/* ─── HERO ───────────────────────────────────────────── */
.gh {
    background: linear-gradient(160deg, #060f22 0%, #0B1E3F 55%, #0a1830 100%);
    position: relative; overflow: hidden;
    padding: 110px 0 90px;
}
.gh__pattern {
    position: absolute; inset: 0;
    background:
        radial-gradient(circle at 80% 20%, rgba(255,106,0,.1) 0%, transparent 45%),
        radial-gradient(circle at 15% 80%, rgba(255,106,0,.06) 0%, transparent 35%),
        repeating-linear-gradient(45deg, transparent, transparent 60px, rgba(255,255,255,.012) 60px, rgba(255,255,255,.012) 61px);
    pointer-events: none;
}
.gh__inner { position:relative; z-index:2; text-align:center; }
.gh__tag {
    display: inline-flex; align-items:center; gap:8px;
    background: rgba(255,106,0,.15); border:1px solid rgba(255,106,0,.35);
    color: var(--primary); font-size:.75rem; font-weight:700;
    letter-spacing:2px; text-transform:uppercase;
    padding:7px 16px; border-radius:30px; margin-bottom:22px;
    animation: fadeIn .7s ease forwards;
}
.gh__title {
    font-family: var(--font-heading);
    font-size: clamp(2rem, 4.5vw, 3.4rem);
    color: #fff; font-weight:700; line-height:1.12;
    letter-spacing:-.5px; margin-bottom:18px;
    animation: fadeUp .8s ease .1s both;
}
.gh__title em {
    font-style:normal;
    background: linear-gradient(90deg, var(--primary), #ffd166);
    -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
}
.gh__sub {
    color: rgba(255,255,255,.7); font-size:1rem; line-height:1.7;
    max-width:520px; margin:0 auto 50px;
    animation: fadeUp .8s ease .2s both;
}
.gh__stats {
    display: flex; justify-content:center; gap:12px;
    flex-wrap: wrap;
    animation: fadeUp .8s ease .35s both;
}
.gh-stat {
    display: flex; align-items:center; gap:12px;
    background: rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.12);
    border-radius:14px; padding:14px 22px;
    backdrop-filter:blur(8px);
    transition:all .3s ease;
}
.gh-stat:hover { background:rgba(255,106,0,.12); border-color:rgba(255,106,0,.3); }
.gh-stat__icon { color:var(--primary); font-size:1.2rem; }
.gh-stat__num { font-family:var(--font-heading); font-size:1.4rem; font-weight:700; color:#fff; line-height:1; }
.gh-stat__label { font-size:.73rem; color:rgba(255,255,255,.5); margin-top:2px; }

/* ─── FILTER ─────────────────────────────────────────── */
.gf {
    background:#fff;
    border-bottom:1px solid var(--border-color);
    position:sticky; top:80px; z-index:100;
    box-shadow:var(--shadow-sm);
}
.gf__inner {
    display:flex; gap:0; overflow-x:auto;
    scrollbar-width:none; justify-content:center;
    padding:0 24px; max-width:1240px; margin:0 auto;
}
.gf__inner::-webkit-scrollbar { display:none; }
.gf__tab {
    padding:16px 22px; background:none; border:none;
    border-bottom:3px solid transparent;
    color:var(--text-grey); font-size:.82rem; font-weight:700;
    text-transform:uppercase; letter-spacing:.5px;
    cursor:pointer; white-space:nowrap;
    transition:all .25s ease;
}
.gf__tab:hover { color:var(--primary); }
.gf__tab.active { color:var(--primary); border-bottom-color:var(--primary); }

/* ─── MASONRY GRID ───────────────────────────────────── */
.gg { background:var(--bg-section); }
.g-masonry {
    columns: 3; column-gap: 18px;
}
.g-item {
    break-inside: avoid;
    margin-bottom: 18px;
    border-radius: 14px;
    overflow: hidden;
    cursor: pointer;
    position: relative;
    box-shadow: var(--shadow-sm);
    transition: all .35s cubic-bezier(.165,.84,.44,1);
}
.g-item.g-hidden { display: none; }
.g-item:hover { transform:translateY(-5px); box-shadow:var(--shadow-lg); }
.g-item img {
    width:100%; display:block;
    transition: transform .4s ease;
}
.g-item:hover img { transform:scale(1.04); }
.g-item__overlay {
    position:absolute; inset:0;
    background:linear-gradient(to top, rgba(11,30,63,.75) 0%, rgba(11,30,63,.1) 50%, transparent 100%);
    opacity:0; transition:opacity .35s ease;
    display:flex; flex-direction:column;
    justify-content:flex-end; padding:20px;
}
.g-item:hover .g-item__overlay { opacity:1; }
.g-item__cat {
    display:inline-block; padding:4px 10px;
    background:var(--primary); color:#fff;
    font-size:.65rem; font-weight:700;
    text-transform:uppercase; letter-spacing:1px;
    border-radius:12px; margin-bottom:7px;
    align-self:flex-start;
}
.g-item__title {
    font-family:var(--font-heading);
    color:#fff; font-size:.95rem; font-weight:700;
    line-height:1.3;
}
.g-item__zoom {
    position:absolute; top:14px; right:14px;
    width:36px; height:36px; border-radius:50%;
    background:rgba(255,255,255,.2); backdrop-filter:blur(6px);
    display:flex; align-items:center; justify-content:center;
    color:#fff; font-size:.85rem;
    opacity:0; transform:scale(.8);
    transition:all .3s ease;
}
.g-item:hover .g-item__zoom { opacity:1; transform:scale(1); }

/* Empty state */
.g-empty {
    column-span:all; text-align:center;
    padding:100px 20px; color:var(--text-grey);
}
.g-empty i { font-size:3.5rem; opacity:.2; display:block; margin-bottom:16px; }
.g-empty p { font-size:1.1rem; }

/* ─── LIGHTBOX ───────────────────────────────────────── */
.glb {
    position:fixed; inset:0; z-index:9999;
    background:rgba(0,0,0,.95);
    display:flex; align-items:center; justify-content:center;
    padding:20px; opacity:0; visibility:hidden;
    transition:opacity .3s ease, visibility .3s ease;
    backdrop-filter:blur(6px);
}
.glb.open { opacity:1; visibility:visible; }
.glb__box {
    position:relative; max-width:1000px; width:100%;
    transform:scale(.95); transition:transform .3s ease;
}
.glb.open .glb__box { transform:scale(1); }
.glb__img {
    width:100%; max-height:80vh; object-fit:contain;
    border-radius:12px; display:block;
}
.glb__caption {
    text-align:center; margin-top:16px;
}
.glb__title {
    color:#fff; font-family:var(--font-heading);
    font-size:1.1rem; font-weight:700;
}
.glb__cat {
    display:inline-block; margin-top:6px;
    padding:4px 12px; border-radius:14px;
    background:rgba(255,106,0,.2); border:1px solid rgba(255,106,0,.4);
    color:var(--primary); font-size:.75rem; font-weight:700;
}
.glb__counter {
    color:rgba(255,255,255,.45); font-size:.8rem; margin-top:5px;
}
.glb__close {
    position:absolute; top:-46px; right:0;
    width:38px; height:38px; border-radius:50%;
    background:rgba(255,255,255,.12); border:1.5px solid rgba(255,255,255,.25);
    color:#fff; cursor:pointer; font-size:1rem;
    display:flex; align-items:center; justify-content:center;
    transition:all .25s ease;
}
.glb__close:hover { background:var(--primary); border-color:var(--primary); }
.glb__arrow {
    position:absolute; top:50%; transform:translateY(-50%);
    width:46px; height:46px; border-radius:50%;
    background:rgba(255,255,255,.1); border:1.5px solid rgba(255,255,255,.2);
    color:#fff; cursor:pointer; font-size:1.1rem;
    display:flex; align-items:center; justify-content:center;
    transition:all .25s ease; backdrop-filter:blur(6px);
}
.glb__arrow:hover { background:var(--primary); border-color:var(--primary); }
.glb__arrow--prev { left:-60px; }
.glb__arrow--next { right:-60px; }

/* ─── CTA ────────────────────────────────────────────── */
.g-cta {
    background:linear-gradient(120deg, #FF6A00 0%, #CC5200 55%, #a84000 100%);
    padding:90px 0; text-align:center;
    position:relative; overflow:hidden;
}
.g-cta::before {
    content:''; position:absolute; inset:0;
    background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23fff' fill-opacity='.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
    pointer-events:none;
}
.g-cta__inner { position:relative; z-index:1; }
.g-cta__tag {
    display:inline-block;
    background:rgba(255,255,255,.2); border:1px solid rgba(255,255,255,.3);
    color:#fff; font-size:.72rem; font-weight:700;
    letter-spacing:2px; text-transform:uppercase;
    padding:6px 16px; border-radius:30px; margin-bottom:20px;
}
.g-cta h2 {
    font-family:var(--font-heading);
    font-size:clamp(1.7rem,3.5vw,2.8rem);
    color:#fff; font-weight:700; line-height:1.15; margin-bottom:14px;
}
.g-cta p { color:rgba(255,255,255,.85); font-size:1rem; margin-bottom:34px; max-width:480px; margin-left:auto; margin-right:auto; line-height:1.65; }
.g-cta__actions { display:flex; gap:14px; justify-content:center; flex-wrap:wrap; }
.btn-wh { display:inline-flex; align-items:center; gap:9px; padding:13px 30px; background:#fff; color:#CC5200; font-weight:700; font-size:.88rem; text-transform:uppercase; letter-spacing:.5px; border-radius:50px; text-decoration:none; box-shadow:0 8px 24px rgba(0,0,0,.15); transition:all .3s ease; }
.btn-wh:hover { transform:translateY(-3px); box-shadow:0 14px 32px rgba(0,0,0,.2); }
.btn-gh { display:inline-flex; align-items:center; gap:9px; padding:12px 26px; border:2px solid rgba(255,255,255,.5); color:#fff; font-weight:700; font-size:.88rem; text-transform:uppercase; border-radius:50px; text-decoration:none; background:rgba(255,255,255,.08); transition:all .3s ease; }
.btn-gh:hover { border-color:#fff; background:rgba(255,255,255,.18); transform:translateY(-2px); }

/* ─── Responsive ─────────────────────────────────────── */
@media(max-width:1024px){
    .g-masonry { columns:2; }
    .glb__arrow--prev { left:-18px; } .glb__arrow--next { right:-18px; }
}
@media(max-width:640px){
    .g-masonry { columns:1; }
    .glb__arrow { display:none; }
    .gh__stats { gap:8px; }
    .gh-stat { min-width:calc(50% - 4px); justify-content:center; }
    .g-cta__actions { flex-direction:column; align-items:center; }
}
</style>

<!-- HERO -->
<section class="gh">
    <div class="gh__pattern"></div>
    <div class="g-container">
        <div class="gh__inner">
            <div class="gh__tag"><i class="fas fa-images"></i> Photo Gallery</div>
            <h1 class="gh__title">Every Session.<br><em>Every Transformation.</em> Captured.</h1>
            <p class="gh__sub">Behind the scenes of the Deschool System — real workshops, real people, real moments of change.</p>
            <div class="gh__stats">
                <div class="gh-stat">
                    <i class="fas fa-images gh-stat__icon"></i>
                    <div>
                        <div class="gh-stat__num"><?= $totalImages ?>+</div>
                        <div class="gh-stat__label">Photos</div>
                    </div>
                </div>
                <div class="gh-stat">
                    <i class="fas fa-calendar-check gh-stat__icon"></i>
                    <div>
                        <div class="gh-stat__num"><?= h(getSetting('stat_programs','50+')) ?></div>
                        <div class="gh-stat__label">Events</div>
                    </div>
                </div>
                <div class="gh-stat">
                    <i class="fas fa-globe-asia gh-stat__icon"></i>
                    <div>
                        <div class="gh-stat__num"><?= h(getSetting('stat_cities','20+')) ?></div>
                        <div class="gh-stat__label">Cities</div>
                    </div>
                </div>
                <div class="gh-stat">
                    <i class="fas fa-users gh-stat__icon"></i>
                    <div>
                        <div class="gh-stat__num"><?= h(getSetting('stat_lives','1M+')) ?></div>
                        <div class="gh-stat__label">Lives Touched</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FILTER -->
<?php if (count($categories) > 1): ?>
<div class="gf">
    <div class="gf__inner">
        <button class="gf__tab active" data-filter="all">All (<?= $totalImages ?>)</button>
        <?php foreach ($categories as $cat):
            $cnt = count(array_filter($galleryImages, fn($i) => $i['category'] === $cat));
        ?>
        <button class="gf__tab" data-filter="<?= h($cat) ?>"><?= h($cat) ?> (<?= $cnt ?>)</button>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<!-- GRID -->
<section class="g-section gg" id="gallery-grid">
    <div class="g-container">

        <?php if (empty($galleryImages)): ?>
        <div class="g-empty">
            <i class="fas fa-images"></i>
            <p>Gallery photos coming soon. Check back after the next workshop!</p>
        </div>
        <?php else: ?>

        <div class="g-masonry" id="gMasonry">
            <?php foreach ($galleryImages as $k => $img): ?>
            <div class="g-item g-reveal g-reveal-d<?= ($k%3)+1 ?>"
                 data-category="<?= h($img['category']) ?>"
                 data-index="<?= $k ?>"
                 onclick="openLightbox(<?= $k ?>)">
                <img src="<?= h($img['image_path']) ?>"
                     alt="<?= h($img['alt_text'] ?: $img['title'] ?: 'Gallery image') ?>"
                     loading="lazy">
                <div class="g-item__overlay">
                    <?php if ($img['category']): ?><span class="g-item__cat"><?= h($img['category']) ?></span><?php endif; ?>
                    <?php if ($img['title']): ?><p class="g-item__title"><?= h($img['title']) ?></p><?php endif; ?>
                </div>
                <div class="g-item__zoom"><i class="fas fa-expand-alt"></i></div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php endif; ?>
    </div>
</section>

<!-- CTA -->
<section class="g-cta">
    <div class="g-container">
        <div class="g-cta__inner g-reveal">
            <span class="g-cta__tag"><i class="fas fa-fire"></i> &nbsp;Be Part of the Story</span>
            <h2>Want to Be in the<br>Next Workshop?</h2>
            <p>Join hundreds who have walked through these doors and walked out transformed.</p>
            <div class="g-cta__actions">
                <a href="contact.php" class="btn-wh"><i class="fas fa-calendar-check"></i> Book Free Session</a>
                <a href="contact.php" class="btn-gh"><i class="fas fa-phone"></i> Contact Now</a>
            </div>
        </div>
    </div>
</section>

<!-- LIGHTBOX -->
<div class="glb" id="gLightbox">
    <div class="glb__box">
        <button class="glb__close" onclick="closeLightbox()"><i class="fas fa-times"></i></button>
        <button class="glb__arrow glb__arrow--prev" onclick="prevImage()"><i class="fas fa-chevron-left"></i></button>
        <button class="glb__arrow glb__arrow--next" onclick="nextImage()"><i class="fas fa-chevron-right"></i></button>
        <img class="glb__img" id="glbImg" src="" alt="">
        <div class="glb__caption">
            <p class="glb__title" id="glbTitle"></p>
            <span class="glb__cat" id="glbCat" style="display:none"></span>
            <p class="glb__counter" id="glbCounter"></p>
        </div>
    </div>
</div>

<script>
/* ── Reveal ── */
const gobs = new IntersectionObserver(entries => {
    entries.forEach(e => { if(e.isIntersecting){ e.target.classList.add('visible'); gobs.unobserve(e.target); } });
}, { threshold:0.1 });
document.querySelectorAll('.g-reveal').forEach(el => gobs.observe(el));

/* ── Filter ── */
document.querySelectorAll('.gf__tab').forEach(btn => {
    btn.addEventListener('click', function(){
        document.querySelectorAll('.gf__tab').forEach(b=>b.classList.remove('active'));
        this.classList.add('active');
        const f = this.dataset.filter;
        document.querySelectorAll('.g-item').forEach(item => {
            item.classList.toggle('g-hidden', f !== 'all' && item.dataset.category !== f);
        });
    });
});

/* ── Lightbox ── */
const images = <?php
    echo json_encode(array_map(fn($i) => [
        'src'      => $i['image_path'],
        'title'    => $i['title'] ?? '',
        'category' => $i['category'] ?? '',
        'alt'      => $i['alt_text'] ?: ($i['title'] ?? 'Gallery image'),
    ], $galleryImages));
?>;

let currentIdx = 0;
const visibleImages = () => {
    const items = document.querySelectorAll('.g-item:not(.g-hidden)');
    return Array.from(items).map(el => parseInt(el.dataset.index));
};

function openLightbox(idx) {
    currentIdx = idx;
    renderLightbox();
    document.getElementById('gLightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('gLightbox').classList.remove('open');
    document.body.style.overflow = '';
}
function renderLightbox() {
    const img = images[currentIdx];
    if (!img) return;
    document.getElementById('glbImg').src  = img.src;
    document.getElementById('glbImg').alt  = img.alt;
    document.getElementById('glbTitle').textContent = img.title || '';
    const catEl = document.getElementById('glbCat');
    if (img.category) { catEl.textContent = img.category; catEl.style.display = 'inline-block'; }
    else { catEl.style.display = 'none'; }
    const vis = visibleImages();
    const pos = vis.indexOf(currentIdx);
    document.getElementById('glbCounter').textContent = (pos + 1) + ' / ' + vis.length;
}
function prevImage() {
    const vis = visibleImages();
    let pos = vis.indexOf(currentIdx) - 1;
    if (pos < 0) pos = vis.length - 1;
    currentIdx = vis[pos];
    renderLightbox();
}
function nextImage() {
    const vis = visibleImages();
    let pos = vis.indexOf(currentIdx) + 1;
    if (pos >= vis.length) pos = 0;
    currentIdx = vis[pos];
    renderLightbox();
}
document.getElementById('gLightbox').addEventListener('click', e => {
    if (e.target === document.getElementById('gLightbox')) closeLightbox();
});
document.addEventListener('keydown', e => {
    if (!document.getElementById('gLightbox').classList.contains('open')) return;
    if (e.key === 'Escape')      closeLightbox();
    if (e.key === 'ArrowLeft')   prevImage();
    if (e.key === 'ArrowRight')  nextImage();
});
</script>

<?php include 'includes/footer.php'; ?>
