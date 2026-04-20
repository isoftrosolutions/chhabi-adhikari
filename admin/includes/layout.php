<?php
function adminHeader(string $title, string $current = ''): void {
    $nav = [
        'index'        => ['icon'=>'fas fa-tachometer-alt', 'label'=>'Dashboard',    'url'=>'/admin/index.php'],
        'hero'         => ['icon'=>'fas fa-images',         'label'=>'Hero Slides',  'url'=>'/admin/hero.php'],
        'services'     => ['icon'=>'fas fa-th-large',       'label'=>'Services',     'url'=>'/admin/services.php'],
        'blog'         => ['icon'=>'fas fa-newspaper',      'label'=>'Blog Posts',   'url'=>'/admin/blog.php'],
        'videos'       => ['icon'=>'fas fa-film',           'label'=>'Videos',       'url'=>'/admin/videos.php'],
        'testimonials' => ['icon'=>'fas fa-quote-left',     'label'=>'Testimonials', 'url'=>'/admin/testimonials.php'],
        'gallery'      => ['icon'=>'fas fa-photo-video',    'label'=>'Gallery',      'url'=>'/admin/gallery.php'],
        'settings'     => ['icon'=>'fas fa-cog',            'label'=>'Settings',     'url'=>'/admin/settings.php'],
    ];
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($title) ?> — D-School Admin</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0;}
:root{
  --nav:#0f1e38;--nav-hover:#1a2f5a;--gold:#F5A623;--gold-dark:#E87722;
  --white:#fff;--bg:#f4f6fb;--card:#fff;--text:#1e293b;--muted:#64748b;
  --border:#e2e8f0;--radius:10px;--shadow:0 2px 12px rgba(0,0,0,.07);
  --sidebar-w:240px;
}
body{font-family:'Inter',system-ui,sans-serif;background:var(--bg);color:var(--text);display:flex;min-height:100vh;}

/* Sidebar */
.adm-sidebar{
  width:var(--sidebar-w);min-width:var(--sidebar-w);background:var(--nav);
  display:flex;flex-direction:column;position:fixed;top:0;left:0;height:100vh;
  z-index:100;transition:transform .3s;
}
.adm-logo{
  padding:22px 24px;border-bottom:1px solid rgba(255,255,255,.07);
  font-size:1rem;font-weight:800;letter-spacing:.5px;
  color:#fff;display:flex;align-items:center;gap:10px;
}
.adm-logo span{color:var(--gold);}
.adm-logo i{font-size:1.3rem;color:var(--gold);}
.adm-nav{padding:16px 0;flex:1;overflow-y:auto;}
.adm-nav a{
  display:flex;align-items:center;gap:13px;padding:12px 24px;
  color:rgba(255,255,255,.65);text-decoration:none;font-size:.88rem;font-weight:500;
  transition:all .2s;border-left:3px solid transparent;
}
.adm-nav a:hover{background:rgba(255,255,255,.06);color:#fff;border-left-color:rgba(245,166,35,.4);}
.adm-nav a.active{background:rgba(245,166,35,.12);color:var(--gold);border-left-color:var(--gold);}
.adm-nav a i{width:18px;text-align:center;font-size:.95rem;}
.adm-nav-label{
  font-size:.68rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;
  color:rgba(255,255,255,.25);padding:18px 24px 6px;
}
.adm-sidebar-foot{padding:16px 24px;border-top:1px solid rgba(255,255,255,.07);}
.adm-sidebar-foot a{
  display:flex;align-items:center;gap:10px;color:rgba(255,255,255,.5);
  text-decoration:none;font-size:.82rem;transition:color .2s;
}
.adm-sidebar-foot a:hover{color:var(--gold);}

/* Main area */
.adm-main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh;}
.adm-topbar{
  background:#fff;border-bottom:1px solid var(--border);padding:0 28px;
  height:60px;display:flex;align-items:center;justify-content:space-between;
  position:sticky;top:0;z-index:50;
}
.adm-topbar h1{font-size:1.05rem;font-weight:700;color:var(--text);}
.adm-topbar-right{display:flex;align-items:center;gap:12px;}
.adm-user{display:flex;align-items:center;gap:10px;font-size:.85rem;color:var(--muted);}
.adm-avatar{
  width:34px;height:34px;border-radius:50%;
  background:linear-gradient(135deg,var(--gold),var(--gold-dark));
  display:flex;align-items:center;justify-content:center;
  color:#fff;font-weight:700;font-size:.9rem;
}
.adm-content{padding:28px;flex:1;}

/* Cards & Tables */
.adm-card{background:var(--card);border-radius:var(--radius);box-shadow:var(--shadow);padding:24px;margin-bottom:24px;}
.adm-card-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:12px;}
.adm-card-head h2{font-size:1rem;font-weight:700;color:var(--text);}
.stat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-bottom:24px;}
.stat-card{
  background:var(--card);border-radius:var(--radius);padding:22px 20px;
  box-shadow:var(--shadow);display:flex;align-items:center;gap:16px;
}
.stat-icon{
  width:50px;height:50px;border-radius:12px;display:flex;align-items:center;
  justify-content:center;font-size:1.3rem;color:#fff;flex-shrink:0;
}
.stat-icon.blue  {background:linear-gradient(135deg,#3b82f6,#2563eb);}
.stat-icon.gold  {background:linear-gradient(135deg,var(--gold),var(--gold-dark));}
.stat-icon.green {background:linear-gradient(135deg,#10b981,#059669);}
.stat-icon.purple{background:linear-gradient(135deg,#8b5cf6,#7c3aed);}
.stat-icon.navy  {background:linear-gradient(135deg,#1a2f5a,#0f1e38);}
.stat-num{font-size:1.7rem;font-weight:700;color:var(--text);line-height:1;}
.stat-label{font-size:.78rem;color:var(--muted);margin-top:3px;}

/* Table */
.adm-table{width:100%;border-collapse:collapse;font-size:.875rem;}
.adm-table th{
  background:#f8fafc;text-align:left;padding:11px 14px;
  font-size:.75rem;font-weight:700;text-transform:uppercase;
  letter-spacing:.8px;color:var(--muted);border-bottom:2px solid var(--border);
}
.adm-table td{padding:12px 14px;border-bottom:1px solid var(--border);vertical-align:middle;}
.adm-table tr:last-child td{border-bottom:none;}
.adm-table tr:hover td{background:#fafafa;}
.badge{
  display:inline-block;padding:3px 10px;border-radius:20px;
  font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;
}
.badge-green{background:#d1fae5;color:#065f46;}
.badge-red  {background:#fee2e2;color:#991b1b;}
.badge-blue {background:#dbeafe;color:#1e40af;}
.badge-gold {background:#fef3c7;color:#92400e;}

/* Buttons */
.btn{
  display:inline-flex;align-items:center;gap:7px;padding:9px 18px;
  border-radius:8px;font-size:.83rem;font-weight:600;cursor:pointer;
  text-decoration:none;border:none;transition:all .2s;white-space:nowrap;
}
.btn-primary{background:var(--nav);color:#fff;}
.btn-primary:hover{background:#1a2f5a;}
.btn-gold{background:var(--gold);color:#fff;}
.btn-gold:hover{background:var(--gold-dark);}
.btn-success{background:#10b981;color:#fff;}
.btn-success:hover{background:#059669;}
.btn-danger{background:#ef4444;color:#fff;}
.btn-danger:hover{background:#dc2626;}
.btn-sm{padding:6px 12px;font-size:.78rem;}
.btn-outline{background:transparent;border:1.5px solid var(--border);color:var(--muted);}
.btn-outline:hover{border-color:var(--nav);color:var(--nav);}

/* Forms */
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
.form-group{display:flex;flex-direction:column;gap:6px;}
.form-group.full{grid-column:1/-1;}
label{font-size:.82rem;font-weight:600;color:var(--text);}
input[type=text],input[type=url],input[type=email],input[type=password],
input[type=number],select,textarea{
  width:100%;padding:10px 13px;border:1.5px solid var(--border);
  border-radius:8px;font-size:.88rem;color:var(--text);
  background:#fff;transition:border-color .2s;
  font-family:inherit;
}
input:focus,select:focus,textarea:focus{outline:none;border-color:var(--gold);}
textarea{resize:vertical;min-height:100px;}
.form-hint{font-size:.76rem;color:var(--muted);}
.form-actions{display:flex;gap:10px;margin-top:8px;}
.img-preview{max-width:200px;border-radius:8px;margin-top:8px;display:block;}
.gradient-preview{
  height:60px;border-radius:8px;margin-top:8px;
  display:flex;align-items:center;justify-content:center;
  color:rgba(255,255,255,.7);font-size:.8rem;
}

/* Alerts */
.alert{padding:12px 18px;border-radius:8px;margin-bottom:18px;font-size:.88rem;display:flex;align-items:center;gap:10px;}
.alert-success{background:#d1fae5;color:#065f46;border:1px solid #a7f3d0;}
.alert-error  {background:#fee2e2;color:#991b1b;border:1px solid #fca5a5;}
.alert-info   {background:#dbeafe;color:#1e40af;border:1px solid #93c5fd;}

/* Toggle switch */
.toggle-wrap{display:flex;align-items:center;gap:10px;}
.toggle{position:relative;width:42px;height:24px;cursor:pointer;}
.toggle input{opacity:0;width:0;height:0;}
.toggle-slider{
  position:absolute;inset:0;background:#ddd;border-radius:24px;
  transition:.3s;cursor:pointer;
}
.toggle-slider:before{
  content:'';position:absolute;width:18px;height:18px;
  left:3px;top:3px;background:#fff;border-radius:50%;transition:.3s;
}
.toggle input:checked + .toggle-slider{background:var(--gold);}
.toggle input:checked + .toggle-slider:before{transform:translateX(18px);}

/* Tabs */
.tab-bar{display:flex;gap:0;border-bottom:2px solid var(--border);margin-bottom:24px;}
.tab-btn{
  padding:10px 20px;font-size:.85rem;font-weight:600;color:var(--muted);
  background:none;border:none;cursor:pointer;border-bottom:2px solid transparent;
  margin-bottom:-2px;transition:all .2s;
}
.tab-btn.active{color:var(--gold);border-bottom-color:var(--gold);}
.tab-content{display:none;}
.tab-content.active{display:block;}

/* Responsive */
@media(max-width:900px){
  .stat-grid{grid-template-columns:1fr 1fr;}
  .form-grid{grid-template-columns:1fr;}
}
@media(max-width:600px){
  .adm-sidebar{transform:translateX(-100%);}
  .adm-main{margin-left:0;}
  .stat-grid{grid-template-columns:1fr;}
}
</style>
</head>
<body>

<aside class="adm-sidebar">
  <div class="adm-logo">
    <i class="fas fa-brain"></i>
    D-SCHOOL<span>CMS</span>
  </div>
  <nav class="adm-nav">
    <div class="adm-nav-label">Main</div>
    <?php foreach ($nav as $key => $item): ?>
      <a href="<?= $item['url'] ?>" class="<?= $current === $key ? 'active' : '' ?>">
        <i class="<?= $item['icon'] ?>"></i> <?= $item['label'] ?>
      </a>
    <?php endforeach; ?>
    <div class="adm-nav-label">Site</div>
    <a href="/" target="_blank"><i class="fas fa-external-link-alt"></i> View Website</a>
  </nav>
  <div class="adm-sidebar-foot">
    <a href="/admin/logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
  </div>
</aside>

<div class="adm-main">
  <div class="adm-topbar">
    <h1><?= htmlspecialchars($title) ?></h1>
    <div class="adm-topbar-right">
      <div class="adm-user">
        <div class="adm-avatar">A</div>
        <span>Admin</span>
      </div>
    </div>
  </div>
  <div class="adm-content">
    <?php
}

function adminFooter(): void {
    ?>
  </div><!-- /adm-content -->
</div><!-- /adm-main -->

<script>
// Confirm before delete
document.querySelectorAll('[data-confirm]').forEach(el => {
  el.addEventListener('click', e => {
    if (!confirm(el.dataset.confirm || 'Are you sure?')) e.preventDefault();
  });
});
// Tabs
document.querySelectorAll('.tab-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const group = btn.closest('.tab-group');
    group.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    group.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById(btn.dataset.tab)?.classList.add('active');
  });
});
// Image preview
document.querySelectorAll('input[type=file]').forEach(inp => {
  inp.addEventListener('change', () => {
    const file = inp.files[0];
    if (!file) return;
    const id = inp.dataset.preview;
    const prev = id ? document.getElementById(id) : inp.nextElementSibling;
    if (prev && prev.tagName === 'IMG') {
      prev.src = URL.createObjectURL(file);
      prev.style.display = 'block';
    }
  });
});
// Gradient preview
document.querySelectorAll('input[name$="_gradient"],input[name="gradient"]').forEach(inp => {
  const updatePreview = () => {
    const prev = document.querySelector('.gradient-preview');
    if (prev) prev.style.background = inp.value;
  };
  inp.addEventListener('input', updatePreview);
  updatePreview();
});
// Slug generator
const titleInp = document.getElementById('title');
const slugInp  = document.getElementById('slug');
if (titleInp && slugInp && !slugInp.dataset.locked) {
  titleInp.addEventListener('input', () => {
    slugInp.value = titleInp.value.toLowerCase()
      .replace(/[^a-z0-9\s-]/g,'').replace(/[\s-]+/g,'-').replace(/^-|-$/g,'');
  });
  slugInp.addEventListener('input', () => { slugInp.dataset.locked = '1'; });
}
</script>
</body>
</html>
    <?php
}
