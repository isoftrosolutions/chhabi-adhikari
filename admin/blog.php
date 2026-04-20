<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/../config.php';
requireAuth();

$db     = getDB();
$action = $_GET['action'] ?? 'list';
$id     = (int)($_GET['id'] ?? 0);
$msg    = '';
$error  = '';

// Handle POST (save)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title      = trim($_POST['title'] ?? '');
    $slug       = trim($_POST['slug'] ?? '') ?: slugify($title);
    $category   = trim($_POST['category'] ?? 'General');
    $excerpt    = trim($_POST['excerpt'] ?? '');
    $content    = trim($_POST['content'] ?? '');
    $author     = trim($_POST['author'] ?? 'Dr. Chhabi Adhikari');
    $gradient   = trim($_POST['image_gradient'] ?? 'linear-gradient(135deg,#1a2f5a,#3b5998)');
    $icon       = trim($_POST['image_icon'] ?? 'fas fa-newspaper');
    $published  = isset($_POST['is_published']) ? 1 : 0;
    $postId     = (int)($_POST['post_id'] ?? 0);

    // Image upload
    $imagePath = trim($_POST['existing_image'] ?? '');
    if (!empty($_FILES['image']['name'])) {
        $up = uploadFile($_FILES['image'], 'blog');
        if ($up) $imagePath = $up;
    }

    if (!$title) { $error = 'Title is required.'; }
    else {
        // Ensure unique slug
        $check = $db->prepare("SELECT id FROM blog_posts WHERE slug = ? AND id != ?");
        $check->execute([$slug, $postId]);
        if ($check->fetch()) $slug .= '-' . time();

        if ($postId) {
            $db->prepare("UPDATE blog_posts SET title=?,slug=?,category=?,excerpt=?,content=?,image_path=?,image_gradient=?,image_icon=?,author=?,is_published=? WHERE id=?")
               ->execute([$title,$slug,$category,$excerpt,$content,$imagePath,$gradient,$icon,$author,$published,$postId]);
            $msg = 'Post updated successfully.';
        } else {
            $db->prepare("INSERT INTO blog_posts (title,slug,category,excerpt,content,image_path,image_gradient,image_icon,author,is_published) VALUES (?,?,?,?,?,?,?,?,?,?)")
               ->execute([$title,$slug,$category,$excerpt,$content,$imagePath,$gradient,$icon,$author,$published]);
            $postId = (int)$db->lastInsertId();
            $msg = 'Post created successfully.';
        }
        $action = 'edit';
        $id = $postId;
    }
}

// Delete
if ($action === 'delete' && $id) {
    $db->prepare("DELETE FROM blog_posts WHERE id=?")->execute([$id]);
    header('Location: ' . BASE_URL . '/admin/blog.php?msg=deleted'); exit;
}

// Toggle published
if ($action === 'toggle' && $id) {
    $db->prepare("UPDATE blog_posts SET is_published = 1 - is_published WHERE id=?")->execute([$id]);
    header('Location: ' . BASE_URL . '/admin/blog.php'); exit;
}

$post = null;
if (in_array($action, ['edit','new']) && $id) {
    $post = $db->prepare("SELECT * FROM blog_posts WHERE id=?");
    $post->execute([$id]); $post = $post->fetch();
}

require_once __DIR__ . '/includes/layout.php';
adminHeader($action === 'list' ? 'Blog Posts' : ($action === 'new' ? 'New Blog Post' : 'Edit Post'), 'blog');

if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
  <div class="alert alert-success"><i class="fas fa-check-circle"></i> Post deleted.</div>
<?php endif;
if ($msg): ?><div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= h($msg) ?></div><?php endif;
if ($error): ?><div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?= h($error) ?></div><?php endif;

// ── LIST VIEW ──────────────────────────────────────────────────────────────
if ($action === 'list'):
    $posts = $db->query("SELECT * FROM blog_posts ORDER BY created_at DESC")->fetchAll();
?>
<div class="adm-card">
  <div class="adm-card-head">
    <h2>All Blog Posts (<?= count($posts) ?>)</h2>
    <a href="?action=new" class="btn btn-gold"><i class="fas fa-plus"></i> New Post</a>
  </div>
  <table class="adm-table">
    <thead>
      <tr><th>Title</th><th>Category</th><th>Author</th><th>Status</th><th>Date</th><th>Actions</th></tr>
    </thead>
    <tbody>
      <?php foreach ($posts as $p): ?>
      <tr>
        <td style="font-weight:600;max-width:300px"><?= h(mb_strimwidth($p['title'],0,55,'…')) ?></td>
        <td><span class="badge badge-blue"><?= h($p['category']) ?></span></td>
        <td style="color:var(--muted);font-size:.82rem"><?= h($p['author']) ?></td>
        <td>
          <a href="?action=toggle&id=<?= $p['id'] ?>" class="badge <?= $p['is_published'] ? 'badge-green' : 'badge-red' ?>" style="text-decoration:none;cursor:pointer">
            <?= $p['is_published'] ? 'Published' : 'Draft' ?>
          </a>
        </td>
        <td style="font-size:.8rem;color:var(--muted)"><?= date('M j, Y', strtotime($p['created_at'])) ?></td>
        <td>
          <div style="display:flex;gap:6px">
            <a href="?action=edit&id=<?= $p['id'] ?>" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></a>
            <a href="?action=delete&id=<?= $p['id'] ?>" class="btn btn-danger btn-sm"
               data-confirm="Delete '<?= h(addslashes($p['title'])) ?>'?"><i class="fas fa-trash"></i></a>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php
// ── FORM VIEW ──────────────────────────────────────────────────────────────
else:
    $p = $post ?? [];
    $categories = ['NLP','Business','Self Help','Leadership','Money Mastery','Mindset','Wellness','Personal Growth','General'];
    $gradients  = [
        'linear-gradient(135deg,#1a2f5a,#3b5998)' => 'Navy Blue',
        'linear-gradient(135deg,#F5A623,#E87722)'  => 'Gold Orange',
        'linear-gradient(135deg,#059669,#047857)'  => 'Green',
        'linear-gradient(135deg,#7c3aed,#5b21b6)'  => 'Purple',
        'linear-gradient(135deg,#dc2626,#b91c1c)'  => 'Red',
        'linear-gradient(135deg,#0891b2,#0e7490)'  => 'Teal',
    ];
?>
<div class="adm-card">
  <div class="adm-card-head">
    <h2><?= $p ? 'Edit: '.h(mb_strimwidth($p['title'],0,50,'…')) : 'New Blog Post' ?></h2>
    <a href="<?= BASE_URL ?>/admin/blog.php" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> All Posts</a>
  </div>

  <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="post_id" value="<?= (int)($p['id'] ?? 0) ?>">

    <div class="form-grid">
      <div class="form-group full">
        <label>Post Title *</label>
        <input type="text" id="title" name="title" value="<?= h($p['title'] ?? '') ?>" required placeholder="Enter post title...">
      </div>

      <div class="form-group">
        <label>URL Slug</label>
        <input type="text" id="slug" name="slug" value="<?= h($p['slug'] ?? '') ?>" placeholder="auto-generated-from-title">
        <span class="form-hint">Auto-generated. Edit to customise the URL.</span>
      </div>

      <div class="form-group">
        <label>Category</label>
        <select name="category">
          <?php foreach ($categories as $cat): ?>
            <option value="<?= h($cat) ?>" <?= ($p['category'] ?? '') === $cat ? 'selected' : '' ?>><?= h($cat) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group full">
        <label>Excerpt / Short Description</label>
        <textarea name="excerpt" rows="3" placeholder="Brief description shown on cards..."><?= h($p['excerpt'] ?? '') ?></textarea>
      </div>

      <div class="form-group full">
        <label>Full Article Content</label>
        <textarea name="content" rows="14" placeholder="Full article content (HTML supported)..."><?= h($p['content'] ?? '') ?></textarea>
      </div>

      <div class="form-group">
        <label>Author</label>
        <input type="text" name="author" value="<?= h($p['author'] ?? 'Dr. Chhabi Adhikari') ?>">
      </div>

      <div class="form-group">
        <label>Cover Image (upload)</label>
        <input type="file" name="image" accept="image/*" data-preview="img-preview">
        <?php if (!empty($p['image_path'])): ?>
          <img id="img-preview" src="<?= h($p['image_path']) ?>" class="img-preview" style="display:block">
          <input type="hidden" name="existing_image" value="<?= h($p['image_path']) ?>">
        <?php else: ?>
          <img id="img-preview" src="" class="img-preview" style="display:none">
        <?php endif; ?>
        <span class="form-hint">If no image uploaded, a gradient card will be shown.</span>
      </div>

      <div class="form-group">
        <label>Card Gradient (when no image)</label>
        <select name="image_gradient" onchange="document.querySelector('.gradient-preview').style.background=this.value">
          <?php foreach ($gradients as $g => $label): ?>
            <option value="<?= h($g) ?>" <?= ($p['image_gradient'] ?? '') === $g ? 'selected' : '' ?>><?= h($label) ?></option>
          <?php endforeach; ?>
        </select>
        <div class="gradient-preview" style="background:<?= h($p['image_gradient'] ?? 'linear-gradient(135deg,#1a2f5a,#3b5998)') ?>">Preview</div>
      </div>

      <div class="form-group">
        <label>Card Icon (Font Awesome class)</label>
        <input type="text" name="image_icon" value="<?= h($p['image_icon'] ?? 'fas fa-newspaper') ?>" placeholder="fas fa-newspaper">
        <span class="form-hint">e.g. fas fa-brain, fas fa-coins, fas fa-users</span>
      </div>

      <div class="form-group">
        <label>Status</label>
        <div class="toggle-wrap">
          <label class="toggle">
            <input type="checkbox" name="is_published" value="1" <?= ($p['is_published'] ?? 1) ? 'checked' : '' ?>>
            <span class="toggle-slider"></span>
          </label>
          <span>Published (visible on website)</span>
        </div>
      </div>
    </div>

    <div class="form-actions" style="margin-top:20px">
      <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Save Post</button>
      <a href="<?= BASE_URL ?>/admin/blog.php" class="btn btn-outline">Cancel</a>
    </div>
  </form>
</div>
<?php endif; ?>
<?php adminFooter(); ?>
