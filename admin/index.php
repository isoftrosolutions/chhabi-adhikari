<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/../config.php';
requireAuth();

$db = getDB();
$counts = [
    'posts'        => $db->query("SELECT COUNT(*) FROM blog_posts")->fetchColumn(),
    'videos'       => $db->query("SELECT COUNT(*) FROM videos")->fetchColumn(),
    'services'     => $db->query("SELECT COUNT(*) FROM services")->fetchColumn(),
    'testimonials' => $db->query("SELECT COUNT(*) FROM testimonials")->fetchColumn(),
    'hero'         => $db->query("SELECT COUNT(*) FROM hero_slides")->fetchColumn(),
    'gallery'      => $db->query("SELECT COUNT(*) FROM gallery")->fetchColumn(),
];
$recentPosts = $db->query("SELECT title, category, is_published, created_at FROM blog_posts ORDER BY created_at DESC LIMIT 5")->fetchAll();
$recentVideos = $db->query("SELECT title, category, is_active, created_at FROM videos ORDER BY created_at DESC LIMIT 5")->fetchAll();

require_once __DIR__ . '/includes/layout.php';
adminHeader('Dashboard', 'index');
?>

<div class="stat-grid">
  <div class="stat-card">
    <div class="stat-icon gold"><i class="fas fa-newspaper"></i></div>
    <div><div class="stat-num"><?= $counts['posts'] ?></div><div class="stat-label">Blog Posts</div></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon blue"><i class="fas fa-film"></i></div>
    <div><div class="stat-num"><?= $counts['videos'] ?></div><div class="stat-label">Videos</div></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon green"><i class="fas fa-th-large"></i></div>
    <div><div class="stat-num"><?= $counts['services'] ?></div><div class="stat-label">Services</div></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon purple"><i class="fas fa-quote-left"></i></div>
    <div><div class="stat-num"><?= $counts['testimonials'] ?></div><div class="stat-label">Testimonials</div></div>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px">

  <div class="adm-card">
    <div class="adm-card-head">
      <h2><i class="fas fa-newspaper" style="color:var(--gold)"></i> Recent Blog Posts</h2>
      <a href="<?= BASE_URL ?>/admin/blog.php?action=new" class="btn btn-gold btn-sm"><i class="fas fa-plus"></i> New Post</a>
    </div>
    <table class="adm-table">
      <thead><tr><th>Title</th><th>Category</th><th>Status</th></tr></thead>
      <tbody>
        <?php foreach ($recentPosts as $p): ?>
        <tr>
          <td><a href="<?= BASE_URL ?>/admin/blog.php?action=edit&id=<?= $p['id'] ?? '' ?>" style="color:var(--nav);font-weight:500"><?= h(mb_strimwidth($p['title'], 0, 42, '…')) ?></a></td>
          <td><span class="badge badge-blue"><?= h($p['category']) ?></span></td>
          <td><span class="badge <?= $p['is_published'] ? 'badge-green' : 'badge-red' ?>"><?= $p['is_published'] ? 'Live' : 'Draft' ?></span></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div style="margin-top:14px"><a href="<?= BASE_URL ?>/admin/blog.php" class="btn btn-outline btn-sm">View All Posts</a></div>
  </div>

  <div class="adm-card">
    <div class="adm-card-head">
      <h2><i class="fas fa-film" style="color:#3b82f6"></i> Recent Videos</h2>
      <a href="<?= BASE_URL ?>/admin/videos.php?action=new" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Video</a>
    </div>
    <table class="adm-table">
      <thead><tr><th>Title</th><th>Category</th><th>Status</th></tr></thead>
      <tbody>
        <?php foreach ($recentVideos as $v): ?>
        <tr>
          <td style="font-weight:500"><?= h(mb_strimwidth($v['title'], 0, 42, '…')) ?></td>
          <td><span class="badge badge-blue"><?= h($v['category']) ?></span></td>
          <td><span class="badge <?= $v['is_active'] ? 'badge-green' : 'badge-red' ?>"><?= $v['is_active'] ? 'Active' : 'Hidden' ?></span></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div style="margin-top:14px"><a href="<?= BASE_URL ?>/admin/videos.php" class="btn btn-outline btn-sm">View All Videos</a></div>
  </div>

</div>

<div class="adm-card" style="margin-top:0">
  <div class="adm-card-head"><h2>Quick Actions</h2></div>
  <div style="display:flex;flex-wrap:wrap;gap:12px">
    <a href="<?= BASE_URL ?>/admin/blog.php?action=new"     class="btn btn-gold"><i class="fas fa-plus"></i> New Blog Post</a>
    <a href="<?= BASE_URL ?>/admin/videos.php?action=new"   class="btn btn-primary"><i class="fas fa-film"></i> Add Video</a>
    <a href="<?= BASE_URL ?>/admin/hero.php?action=new"     class="btn btn-primary"><i class="fas fa-images"></i> Add Hero Slide</a>
    <a href="<?= BASE_URL ?>/admin/gallery.php"             class="btn btn-primary"><i class="fas fa-upload"></i> Upload Images</a>
    <a href="<?= BASE_URL ?>/admin/settings.php"            class="btn btn-outline"><i class="fas fa-cog"></i> Site Settings</a>
    <a href="<?= BASE_URL ?>/" target="_blank"             class="btn btn-outline"><i class="fas fa-eye"></i> View Website</a>
  </div>
</div>

<?php adminFooter(); ?>
