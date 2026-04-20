<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/../config.php';
requireAuth();

$db = getDB();
$msg = ''; $error = '';

// Upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['images']['name'][0])) {
    $count = 0;
    $category = trim($_POST['category'] ?? 'General');
    foreach ($_FILES['images']['tmp_name'] as $k => $tmp) {
        if (!$_FILES['images']['error'][$k]) {
            $file = ['name'=>$_FILES['images']['name'][$k],'tmp_name'=>$tmp,'size'=>$_FILES['images']['size'][$k],'type'=>$_FILES['images']['type'][$k],'error'=>0];
            $path = uploadFile($file, 'gallery');
            if ($path) {
                $title = pathinfo($_FILES['images']['name'][$k], PATHINFO_FILENAME);
                $db->prepare("INSERT INTO gallery (title,image_path,alt_text,category) VALUES (?,?,?,?)")
                   ->execute([$title, $path, $title, $category]);
                $count++;
            }
        }
    }
    $msg = "$count image(s) uploaded successfully.";
}

// Update title/alt
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_id'])) {
    $db->prepare("UPDATE gallery SET title=?,alt_text=?,category=?,is_active=? WHERE id=?")
       ->execute([trim($_POST['title']??''), trim($_POST['alt_text']??''), trim($_POST['category']??'General'), isset($_POST['is_active'])?1:0, (int)$_POST['update_id']]);
    $msg = 'Image updated.';
}

// Delete
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $img = $db->prepare("SELECT image_path FROM gallery WHERE id=?");
    $img->execute([(int)$_GET['id']]); $row = $img->fetch();
    if ($row && $row['image_path']) {
        $fullPath = __DIR__ . '/../' . ltrim($row['image_path'], '/');
        if (file_exists($fullPath)) @unlink($fullPath);
    }
    $db->prepare("DELETE FROM gallery WHERE id=?")->execute([(int)$_GET['id']]);
    header('Location: ' . BASE_URL . '/admin/gallery.php?msg=deleted'); exit;
}

$images = $db->query("SELECT * FROM gallery ORDER BY created_at DESC")->fetchAll();
$cats   = ['General','Workshop','Team','Events','Office','Students'];

require_once __DIR__ . '/includes/layout.php';
adminHeader('Image Gallery','gallery');

if(isset($_GET['msg'])&&$_GET['msg']==='deleted'): ?><div class="alert alert-success"><i class="fas fa-check-circle"></i> Image deleted.</div><?php endif;
if($msg): ?><div class="alert alert-success"><i class="fas fa-check-circle"></i> <?=h($msg)?></div><?php endif;
if($error): ?><div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?=h($error)?></div><?php endif;
?>

<div class="adm-card">
  <div class="adm-card-head"><h2>Upload New Images</h2></div>
  <form method="POST" enctype="multipart/form-data">
    <div class="form-grid">
      <div class="form-group full">
        <label>Select Images (multiple allowed)</label>
        <input type="file" name="images[]" accept="image/*" multiple required>
        <span class="form-hint">JPG, PNG, GIF, WebP. Multiple files can be selected at once.</span>
      </div>
      <div class="form-group">
        <label>Category</label>
        <select name="category">
          <?php foreach($cats as $c): ?><option value="<?=h($c)?>"><?=h($c)?></option><?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="form-actions" style="margin-top:16px">
      <button type="submit" class="btn btn-gold"><i class="fas fa-upload"></i> Upload Images</button>
    </div>
  </form>
</div>

<div class="adm-card">
  <div class="adm-card-head"><h2>Gallery (<?=count($images)?> images)</h2></div>
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px">
    <?php foreach($images as $img): ?>
    <div style="background:#f8fafc;border-radius:10px;overflow:hidden;border:1px solid var(--border)">
      <div style="position:relative;aspect-ratio:4/3;overflow:hidden">
        <img src="<?=h($img['image_path'])?>" alt="<?=h($img['alt_text']??'')?>"
             style="width:100%;height:100%;object-fit:cover">
        <div style="position:absolute;top:6px;right:6px;display:flex;gap:4px">
          <span class="badge <?=$img['is_active']?'badge-green':'badge-red'?>"><?=$img['is_active']?'On':'Off'?></span>
        </div>
      </div>
      <form method="POST" style="padding:10px">
        <input type="hidden" name="update_id" value="<?=$img['id']?>">
        <input type="text" name="title" value="<?=h($img['title']??'')?>" placeholder="Title" style="margin-bottom:6px;padding:6px 10px;font-size:.78rem">
        <input type="text" name="alt_text" value="<?=h($img['alt_text']??'')?>" placeholder="Alt text" style="margin-bottom:6px;padding:6px 10px;font-size:.78rem">
        <select name="category" style="margin-bottom:8px;padding:6px 10px;font-size:.78rem">
          <?php foreach($cats as $c): ?><option value="<?=h($c)?>" <?=$img['category']===$c?'selected':''?>><?=h($c)?></option><?php endforeach; ?>
        </select>
        <div style="display:flex;align-items:center;gap:6px;margin-bottom:8px;font-size:.78rem">
          <label class="toggle" style="width:34px;height:20px">
            <input type="checkbox" name="is_active" <?=$img['is_active']?'checked':''?>>
            <span class="toggle-slider"></span>
          </label> Active
        </div>
        <div style="display:flex;gap:6px">
          <button type="submit" class="btn btn-outline btn-sm" style="flex:1;font-size:.75rem"><i class="fas fa-save"></i> Save</button>
          <a href="?action=delete&id=<?=$img['id']?>" class="btn btn-danger btn-sm" data-confirm="Delete this image?" style="font-size:.75rem"><i class="fas fa-trash"></i></a>
        </div>
      </form>
    </div>
    <?php endforeach; ?>
    <?php if(!$images): ?>
      <div style="grid-column:1/-1;text-align:center;padding:40px;color:var(--muted)"><i class="fas fa-images" style="font-size:3rem;display:block;margin-bottom:12px;opacity:.3"></i>No images yet. Upload some above.</div>
    <?php endif; ?>
  </div>
</div>

<?php adminFooter(); ?>
