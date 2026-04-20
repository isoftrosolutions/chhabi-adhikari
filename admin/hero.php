<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/../config.php';
requireAuth();

$db = getDB(); $action = $_GET['action'] ?? 'list'; $id = (int)($_GET['id'] ?? 0);
$msg = ''; $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title    = trim($_POST['title'] ?? '');
    $subtitle = trim($_POST['subtitle'] ?? '');
    $btn1t    = trim($_POST['btn1_text'] ?? '');
    $btn1u    = trim($_POST['btn1_url'] ?? '');
    $btn2t    = trim($_POST['btn2_text'] ?? '');
    $btn2u    = trim($_POST['btn2_url'] ?? '');
    $gradient = trim($_POST['gradient'] ?? 'linear-gradient(155deg,#0d1b35,#1a2f5a)');
    $active   = isset($_POST['is_active']) ? 1 : 0;
    $order    = (int)($_POST['sort_order'] ?? 0);
    $hid      = (int)($_POST['hero_id'] ?? 0);

    $imagePath = trim($_POST['existing_image'] ?? '');
    if (!empty($_FILES['image']['name'])) {
        $up = uploadFile($_FILES['image'], 'hero');
        if ($up) $imagePath = $up;
    }

    if (!$title) { $error = 'Title is required.'; }
    else {
        if ($hid) {
            $db->prepare("UPDATE hero_slides SET title=?,subtitle=?,btn1_text=?,btn1_url=?,btn2_text=?,btn2_url=?,image_path=?,gradient=?,is_active=?,sort_order=? WHERE id=?")
               ->execute([$title,$subtitle,$btn1t,$btn1u,$btn2t,$btn2u,$imagePath,$gradient,$active,$order,$hid]);
            $msg = 'Slide updated.';
        } else {
            $db->prepare("INSERT INTO hero_slides (title,subtitle,btn1_text,btn1_url,btn2_text,btn2_url,image_path,gradient,is_active,sort_order) VALUES (?,?,?,?,?,?,?,?,?,?)")
               ->execute([$title,$subtitle,$btn1t,$btn1u,$btn2t,$btn2u,$imagePath,$gradient,$active,$order]);
            $hid = (int)$db->lastInsertId(); $msg = 'Slide added.';
        }
        $action = 'edit'; $id = $hid;
    }
}
if ($action==='delete'&&$id) { $db->prepare("DELETE FROM hero_slides WHERE id=?")->execute([$id]); header('Location: /admin/hero.php?msg=deleted'); exit; }
if ($action==='toggle'&&$id) { $db->prepare("UPDATE hero_slides SET is_active=1-is_active WHERE id=?")->execute([$id]); header('Location: /admin/hero.php'); exit; }

$slide = null;
if (in_array($action,['edit','new'])&&$id) { $s=$db->prepare("SELECT * FROM hero_slides WHERE id=?"); $s->execute([$id]); $slide=$s->fetch(); }

require_once __DIR__ . '/includes/layout.php';
adminHeader('Hero Slides','hero');

if(isset($_GET['msg'])&&$_GET['msg']==='deleted'): ?><div class="alert alert-success"><i class="fas fa-check-circle"></i> Slide deleted.</div><?php endif;
if($msg): ?><div class="alert alert-success"><i class="fas fa-check-circle"></i> <?=h($msg)?></div><?php endif;
if($error): ?><div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?=h($error)?></div><?php endif;

if ($action === 'list'):
    $slides = $db->query("SELECT * FROM hero_slides ORDER BY sort_order ASC")->fetchAll();
?>
<div class="alert alert-info"><i class="fas fa-info-circle"></i> Hero slides appear in the homepage hero section. The first active slide is shown by default. You can also use a static layout managed via <a href="/admin/settings.php">Settings</a>.</div>
<div class="adm-card">
  <div class="adm-card-head">
    <h2>Hero Slides (<?=count($slides)?>)</h2>
    <a href="?action=new" class="btn btn-gold"><i class="fas fa-plus"></i> Add Slide</a>
  </div>
  <table class="adm-table">
    <thead><tr><th>#</th><th>Gradient</th><th>Title</th><th>Buttons</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>
      <?php foreach($slides as $sl): ?>
      <tr>
        <td><?=$sl['sort_order']?></td>
        <td><div style="width:60px;height:36px;border-radius:6px;background:<?=h($sl['gradient'])?>"></div></td>
        <td style="font-weight:600;max-width:250px"><?=h(mb_strimwidth($sl['title'],0,50,'…'))?></td>
        <td style="font-size:.8rem;color:var(--muted)"><?=h($sl['btn1_text'])?> / <?=h($sl['btn2_text'])?></td>
        <td><a href="?action=toggle&id=<?=$sl['id']?>" class="badge <?=$sl['is_active']?'badge-green':'badge-red'?>" style="text-decoration:none;cursor:pointer"><?=$sl['is_active']?'Active':'Hidden'?></a></td>
        <td><div style="display:flex;gap:6px">
          <a href="?action=edit&id=<?=$sl['id']?>" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></a>
          <a href="?action=delete&id=<?=$sl['id']?>" class="btn btn-danger btn-sm" data-confirm="Delete this slide?"><i class="fas fa-trash"></i></a>
        </div></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php else: $sl=$slide??[]; $grads=['linear-gradient(155deg,#0d1b35 0%,#1a2f5a 45%,#0f2040 100%)'=>'Dark Navy','linear-gradient(155deg,#1a2f5a 0%,#2d4a8a 60%,#1a2f5a 100%)'=>'Navy Blue','linear-gradient(155deg,#7c3aed 0%,#1a2f5a 60%,#0d1b35 100%)'=>'Purple Navy','linear-gradient(155deg,#059669,#1a2f5a,#0d1b35)'=>'Green Navy','linear-gradient(155deg,#F5A623,#E87722,#c85f00)'=>'Gold']; ?>
<div class="adm-card">
  <div class="adm-card-head">
    <h2><?=$sl?'Edit Slide':'New Hero Slide'?></h2>
    <a href="/admin/hero.php" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> All Slides</a>
  </div>
  <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="hero_id" value="<?=(int)($sl['id']??0)?>">
    <div class="form-grid">
      <div class="form-group full">
        <label>Slide Title (main heading) *</label>
        <input type="text" name="title" value="<?=h($sl['title']??'')?>" required placeholder="TRANSFORM YOUR MIND. TRANSFORM YOUR LIFE.">
      </div>
      <div class="form-group full">
        <label>Subtitle / Tagline</label>
        <textarea name="subtitle" rows="2" placeholder="Supporting text below the heading..."><?=h($sl['subtitle']??'')?></textarea>
      </div>
      <div class="form-group">
        <label>Button 1 Text</label>
        <input type="text" name="btn1_text" value="<?=h($sl['btn1_text']??'')?>" placeholder="Explore Programs">
      </div>
      <div class="form-group">
        <label>Button 1 URL</label>
        <input type="text" name="btn1_url" value="<?=h($sl['btn1_url']??'')?>" placeholder="courses.php">
      </div>
      <div class="form-group">
        <label>Button 2 Text</label>
        <input type="text" name="btn2_text" value="<?=h($sl['btn2_text']??'')?>" placeholder="Watch Videos">
      </div>
      <div class="form-group">
        <label>Button 2 URL</label>
        <input type="text" name="btn2_url" value="<?=h($sl['btn2_url']??'')?>" placeholder="videos.php">
      </div>
      <div class="form-group">
        <label>Background Gradient</label>
        <select name="gradient" onchange="document.querySelector('.gradient-preview').style.background=this.value">
          <?php foreach($grads as $g=>$l): ?><option value="<?=h($g)?>" <?=($sl['gradient']??'')===$g?'selected':''?>><?=h($l)?></option><?php endforeach; ?>
        </select>
        <div class="gradient-preview" style="background:<?=h($sl['gradient']??'linear-gradient(155deg,#0d1b35,#1a2f5a)')?>">Preview</div>
      </div>
      <div class="form-group">
        <label>Background Image (optional, overrides gradient)</label>
        <input type="file" name="image" accept="image/*" data-preview="img-preview">
        <?php if(!empty($sl['image_path'])): ?>
          <img id="img-preview" src="<?=h($sl['image_path'])?>" class="img-preview" style="display:block">
          <input type="hidden" name="existing_image" value="<?=h($sl['image_path'])?>">
        <?php else: ?>
          <img id="img-preview" src="" class="img-preview" style="display:none">
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="<?=(int)($sl['sort_order']??0)?>" min="0">
      </div>
      <div class="form-group">
        <label>Status</label>
        <div class="toggle-wrap">
          <label class="toggle"><input type="checkbox" name="is_active" <?=($sl['is_active']??1)?'checked':''?>><span class="toggle-slider"></span></label>
          <span>Active</span>
        </div>
      </div>
    </div>
    <div class="form-actions" style="margin-top:20px">
      <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Save Slide</button>
      <a href="/admin/hero.php" class="btn btn-outline">Cancel</a>
    </div>
  </form>
</div>
<?php endif; adminFooter(); ?>
