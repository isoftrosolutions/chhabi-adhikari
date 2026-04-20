<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/../config.php';
requireAuth();

$db = getDB(); $action = $_GET['action'] ?? 'list'; $id = (int)($_GET['id'] ?? 0);
$msg = ''; $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title    = trim($_POST['title'] ?? '');
    $desc     = trim($_POST['description'] ?? '');
    $ytUrl    = trim($_POST['youtube_url'] ?? '');
    $ytId     = $ytUrl ? extractYouTubeId($ytUrl) : trim($_POST['youtube_id'] ?? '');
    $category = trim($_POST['category'] ?? 'NLP');
    $gradient = trim($_POST['bg_gradient'] ?? 'linear-gradient(135deg,#1a2f5a,#2d4a8a)');
    $active   = isset($_POST['is_active']) ? 1 : 0;
    $order    = (int)($_POST['sort_order'] ?? 0);
    $vid      = (int)($_POST['video_id'] ?? 0);

    if (!$title) { $error = 'Title is required.'; }
    else {
        if ($vid) {
            $db->prepare("UPDATE videos SET title=?,description=?,youtube_url=?,youtube_id=?,category=?,bg_gradient=?,is_active=?,sort_order=? WHERE id=?")
               ->execute([$title,$desc,$ytUrl,$ytId,$category,$gradient,$active,$order,$vid]);
            $msg = 'Video updated.';
        } else {
            $db->prepare("INSERT INTO videos (title,description,youtube_url,youtube_id,category,bg_gradient,is_active,sort_order) VALUES (?,?,?,?,?,?,?,?)")
               ->execute([$title,$desc,$ytUrl,$ytId,$category,$gradient,$active,$order]);
            $vid = (int)$db->lastInsertId();
            $msg = 'Video added.';
        }
        $action = 'edit'; $id = $vid;
    }
}
if ($action === 'delete' && $id) { $db->prepare("DELETE FROM videos WHERE id=?")->execute([$id]); header('Location: /admin/videos.php?msg=deleted'); exit; }
if ($action === 'toggle' && $id) { $db->prepare("UPDATE videos SET is_active = 1-is_active WHERE id=?")->execute([$id]); header('Location: /admin/videos.php'); exit; }

$video = null;
if (in_array($action,['edit','new']) && $id) { $s=$db->prepare("SELECT * FROM videos WHERE id=?"); $s->execute([$id]); $video=$s->fetch(); }

require_once __DIR__ . '/includes/layout.php';
adminHeader($action==='list'?'Videos':($action==='new'?'New Video':'Edit Video'),'videos');

if(isset($_GET['msg'])&&$_GET['msg']==='deleted'): ?><div class="alert alert-success"><i class="fas fa-check-circle"></i> Video deleted.</div><?php endif;
if($msg): ?><div class="alert alert-success"><i class="fas fa-check-circle"></i> <?=h($msg)?></div><?php endif;
if($error): ?><div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?=h($error)?></div><?php endif;

if ($action === 'list'):
    $videos = $db->query("SELECT * FROM videos ORDER BY sort_order ASC, created_at DESC")->fetchAll();
?>
<div class="adm-card">
  <div class="adm-card-head">
    <h2>All Videos (<?=count($videos)?>)</h2>
    <a href="?action=new" class="btn btn-gold"><i class="fas fa-plus"></i> Add Video</a>
  </div>
  <table class="adm-table">
    <thead><tr><th>#</th><th>Title</th><th>YouTube ID</th><th>Category</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>
      <?php foreach ($videos as $v): ?>
      <tr>
        <td style="color:var(--muted)"><?=$v['sort_order']?></td>
        <td style="font-weight:600"><?=h(mb_strimwidth($v['title'],0,50,'…'))?></td>
        <td>
          <?php if($v['youtube_id']): ?>
            <a href="https://youtube.com/watch?v=<?=h($v['youtube_id'])?>" target="_blank" style="color:red;font-size:.82rem"><i class="fab fa-youtube"></i> <?=h($v['youtube_id'])?></a>
          <?php else: ?><span style="color:var(--muted);font-size:.8rem">No YouTube link</span><?php endif; ?>
        </td>
        <td><span class="badge badge-blue"><?=h($v['category'])?></span></td>
        <td><a href="?action=toggle&id=<?=$v['id']?>" class="badge <?=$v['is_active']?'badge-green':'badge-red'?>" style="text-decoration:none;cursor:pointer"><?=$v['is_active']?'Active':'Hidden'?></a></td>
        <td>
          <div style="display:flex;gap:6px">
            <a href="?action=edit&id=<?=$v['id']?>" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></a>
            <a href="?action=delete&id=<?=$v['id']?>" class="btn btn-danger btn-sm" data-confirm="Delete this video?"><i class="fas fa-trash"></i></a>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php else:
  $v = $video ?? [];
  $cats = ['NLP','Business','Leadership','Money Mastery','Wellness','Students','Personal Growth','Mindset'];
  $grads = ['linear-gradient(135deg,#1a2f5a,#2d4a8a)'=>'Navy','linear-gradient(135deg,#7c3aed,#4f26b5)'=>'Purple','linear-gradient(135deg,#059669,#027a50)'=>'Green','linear-gradient(135deg,#dc2626,#b91c1c)'=>'Red','linear-gradient(135deg,#0891b2,#0e7490)'=>'Teal','linear-gradient(135deg,#F5A623,#c85f00)'=>'Gold'];
?>
<div class="adm-card">
  <div class="adm-card-head">
    <h2><?=$v?'Edit Video':'New Video'?></h2>
    <a href="/admin/videos.php" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> All Videos</a>
  </div>
  <form method="POST">
    <input type="hidden" name="video_id" value="<?=(int)($v['id']??0)?>">
    <div class="form-grid">
      <div class="form-group full">
        <label>Video Title *</label>
        <input type="text" name="title" value="<?=h($v['title']??'')?>" required placeholder="e.g. Introduction to NLP">
      </div>
      <div class="form-group full">
        <label>Description</label>
        <textarea name="description" rows="3" placeholder="Brief description..."><?=h($v['description']??'')?></textarea>
      </div>
      <div class="form-group">
        <label>YouTube URL</label>
        <input type="url" name="youtube_url" value="<?=h($v['youtube_url']??'')?>" placeholder="https://www.youtube.com/watch?v=...">
        <span class="form-hint">Paste the full YouTube link — ID will be extracted automatically.</span>
      </div>
      <div class="form-group">
        <label>YouTube Video ID</label>
        <input type="text" name="youtube_id" value="<?=h($v['youtube_id']??'')?>" placeholder="e.g. dQw4w9WgXcQ (auto-filled from URL)">
        <?php if($v['youtube_id']??''): ?>
          <img src="https://img.youtube.com/vi/<?=h($v['youtube_id'])?>/mqdefault.jpg" style="margin-top:8px;border-radius:8px;max-width:240px">
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label>Category</label>
        <select name="category">
          <?php foreach($cats as $c): ?><option value="<?=h($c)?>" <?=($v['category']??'')===$c?'selected':''?>><?=h($c)?></option><?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label>Thumbnail Gradient (when no YouTube ID)</label>
        <select name="bg_gradient" onchange="document.querySelector('.gradient-preview').style.background=this.value">
          <?php foreach($grads as $g=>$l): ?><option value="<?=h($g)?>" <?=($v['bg_gradient']??'')===$g?'selected':''?>><?=h($l)?></option><?php endforeach; ?>
        </select>
        <div class="gradient-preview" style="background:<?=h($v['bg_gradient']??'linear-gradient(135deg,#1a2f5a,#2d4a8a)')?>">Preview</div>
      </div>
      <div class="form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="<?=(int)($v['sort_order']??0)?>" min="0">
      </div>
      <div class="form-group">
        <label>Status</label>
        <div class="toggle-wrap">
          <label class="toggle"><input type="checkbox" name="is_active" <?=($v['is_active']??1)?'checked':''?>><span class="toggle-slider"></span></label>
          <span>Active (visible on website)</span>
        </div>
      </div>
    </div>
    <div class="form-actions" style="margin-top:20px">
      <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Save Video</button>
      <a href="/admin/videos.php" class="btn btn-outline">Cancel</a>
    </div>
  </form>
</div>
<?php endif; adminFooter(); ?>
