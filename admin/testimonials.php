<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/../config.php';
requireAuth();

$db = getDB(); $action = $_GET['action'] ?? 'list'; $id = (int)($_GET['id'] ?? 0);
$msg = ''; $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $role    = trim($_POST['role'] ?? '');
    $loc     = trim($_POST['location'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $rating  = min(5, max(1, (int)($_POST['rating'] ?? 5)));
    $initial = strtoupper(substr($name, 0, 1));
    $active  = isset($_POST['is_active']) ? 1 : 0;
    $order   = (int)($_POST['sort_order'] ?? 0);
    $tid     = (int)($_POST['testi_id'] ?? 0);

    if (!$name || !$content) { $error = 'Name and content are required.'; }
    else {
        if ($tid) {
            $db->prepare("UPDATE testimonials SET name=?,role=?,location=?,content=?,rating=?,avatar_initial=?,is_active=?,sort_order=? WHERE id=?")
               ->execute([$name,$role,$loc,$content,$rating,$initial,$active,$order,$tid]);
            $msg = 'Testimonial updated.';
        } else {
            $db->prepare("INSERT INTO testimonials (name,role,location,content,rating,avatar_initial,is_active,sort_order) VALUES (?,?,?,?,?,?,?,?)")
               ->execute([$name,$role,$loc,$content,$rating,$initial,$active,$order]);
            $tid = (int)$db->lastInsertId(); $msg = 'Testimonial added.';
        }
        $action = 'edit'; $id = $tid;
    }
}
if ($action==='delete'&&$id) { $db->prepare("DELETE FROM testimonials WHERE id=?")->execute([$id]); header('Location: /admin/testimonials.php?msg=deleted'); exit; }
if ($action==='toggle'&&$id) { $db->prepare("UPDATE testimonials SET is_active=1-is_active WHERE id=?")->execute([$id]); header('Location: /admin/testimonials.php'); exit; }

$testi = null;
if (in_array($action,['edit','new'])&&$id) { $s=$db->prepare("SELECT * FROM testimonials WHERE id=?"); $s->execute([$id]); $testi=$s->fetch(); }

require_once __DIR__ . '/includes/layout.php';
adminHeader('Testimonials','testimonials');

if(isset($_GET['msg'])&&$_GET['msg']==='deleted'): ?><div class="alert alert-success"><i class="fas fa-check-circle"></i> Testimonial deleted.</div><?php endif;
if($msg): ?><div class="alert alert-success"><i class="fas fa-check-circle"></i> <?=h($msg)?></div><?php endif;
if($error): ?><div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?=h($error)?></div><?php endif;

if ($action === 'list'):
    $testis = $db->query("SELECT * FROM testimonials ORDER BY sort_order ASC, created_at DESC")->fetchAll();
?>
<div class="adm-card">
  <div class="adm-card-head">
    <h2>Testimonials (<?=count($testis)?>)</h2>
    <a href="?action=new" class="btn btn-gold"><i class="fas fa-plus"></i> Add Testimonial</a>
  </div>
  <table class="adm-table">
    <thead><tr><th>#</th><th>Name</th><th>Role / Location</th><th>Rating</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>
      <?php foreach($testis as $t): ?>
      <tr>
        <td style="color:var(--muted)"><?=$t['sort_order']?></td>
        <td>
          <div style="display:flex;align-items:center;gap:10px">
            <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#1a2f5a,#1a3a6a);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;flex-shrink:0"><?=h($t['avatar_initial'])?></div>
            <strong><?=h($t['name'])?></strong>
          </div>
        </td>
        <td style="font-size:.82rem;color:var(--muted)"><?=h($t['role'])?>, <?=h($t['location'])?></td>
        <td style="color:#F5A623"><?=str_repeat('★',(int)$t['rating'])?></td>
        <td><a href="?action=toggle&id=<?=$t['id']?>" class="badge <?=$t['is_active']?'badge-green':'badge-red'?>" style="text-decoration:none;cursor:pointer"><?=$t['is_active']?'Active':'Hidden'?></a></td>
        <td><div style="display:flex;gap:6px">
          <a href="?action=edit&id=<?=$t['id']?>" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></a>
          <a href="?action=delete&id=<?=$t['id']?>" class="btn btn-danger btn-sm" data-confirm="Delete this testimonial?"><i class="fas fa-trash"></i></a>
        </div></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php else: $t=$testi??[]; ?>
<div class="adm-card">
  <div class="adm-card-head">
    <h2><?=$t?'Edit Testimonial':'New Testimonial'?></h2>
    <a href="/admin/testimonials.php" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> All Testimonials</a>
  </div>
  <form method="POST">
    <input type="hidden" name="testi_id" value="<?=(int)($t['id']??0)?>">
    <div class="form-grid">
      <div class="form-group">
        <label>Name *</label>
        <input type="text" name="name" value="<?=h($t['name']??'')?>" required>
      </div>
      <div class="form-group">
        <label>Role / Title</label>
        <input type="text" name="role" value="<?=h($t['role']??'')?>" placeholder="e.g. Entrepreneur">
      </div>
      <div class="form-group">
        <label>Location</label>
        <input type="text" name="location" value="<?=h($t['location']??'')?>" placeholder="e.g. Kathmandu">
      </div>
      <div class="form-group">
        <label>Rating (1–5)</label>
        <select name="rating">
          <?php for($r=5;$r>=1;$r--): ?><option value="<?=$r?>" <?=((int)($t['rating']??5))===$r?'selected':''?>><?=str_repeat('★',$r)?></option><?php endfor; ?>
        </select>
      </div>
      <div class="form-group full">
        <label>Testimonial Content *</label>
        <textarea name="content" rows="5" required placeholder="What did they say about Dr. Chhabi or D-School?"><?=h($t['content']??'')?></textarea>
      </div>
      <div class="form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="<?=(int)($t['sort_order']??0)?>" min="0">
      </div>
      <div class="form-group">
        <label>Status</label>
        <div class="toggle-wrap">
          <label class="toggle"><input type="checkbox" name="is_active" <?=($t['is_active']??1)?'checked':''?>><span class="toggle-slider"></span></label>
          <span>Active (visible on website)</span>
        </div>
      </div>
    </div>
    <div class="form-actions" style="margin-top:20px">
      <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Save</button>
      <a href="/admin/testimonials.php" class="btn btn-outline">Cancel</a>
    </div>
  </form>
</div>
<?php endif; adminFooter(); ?>
