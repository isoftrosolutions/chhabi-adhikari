<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/../config.php';
requireAuth();

$db = getDB(); $action = $_GET['action'] ?? 'list'; $id = (int)($_GET['id'] ?? 0);
$msg = ''; $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $icon  = trim($_POST['icon'] ?? 'fas fa-star');
    $title = trim($_POST['title'] ?? '');
    $desc  = trim($_POST['description'] ?? '');
    $url   = trim($_POST['link_url'] ?? '');
    $act   = isset($_POST['is_active']) ? 1 : 0;
    $order = (int)($_POST['sort_order'] ?? 0);
    $sid   = (int)($_POST['service_id'] ?? 0);

    if (!$title) { $error = 'Title is required.'; }
    else {
        if ($sid) {
            $db->prepare("UPDATE services SET icon=?,title=?,description=?,link_url=?,is_active=?,sort_order=? WHERE id=?")
               ->execute([$icon,$title,$desc,$url,$act,$order,$sid]);
            $msg = 'Service updated.';
        } else {
            $db->prepare("INSERT INTO services (icon,title,description,link_url,is_active,sort_order) VALUES (?,?,?,?,?,?)")
               ->execute([$icon,$title,$desc,$url,$act,$order]);
            $sid = (int)$db->lastInsertId(); $msg = 'Service created.';
        }
        $action = 'edit'; $id = $sid;
    }
}
if ($action==='delete'&&$id) { $db->prepare("DELETE FROM services WHERE id=?")->execute([$id]); header('Location: /admin/services.php?msg=deleted'); exit; }
if ($action==='toggle'&&$id) { $db->prepare("UPDATE services SET is_active=1-is_active WHERE id=?")->execute([$id]); header('Location: /admin/services.php'); exit; }

$svc = null;
if (in_array($action,['edit','new'])&&$id) { $s=$db->prepare("SELECT * FROM services WHERE id=?"); $s->execute([$id]); $svc=$s->fetch(); }

require_once __DIR__ . '/includes/layout.php';
adminHeader($action==='list'?'Services':'Edit Service','services');

if(isset($_GET['msg'])&&$_GET['msg']==='deleted'): ?><div class="alert alert-success"><i class="fas fa-check-circle"></i> Service deleted.</div><?php endif;
if($msg): ?><div class="alert alert-success"><i class="fas fa-check-circle"></i> <?=h($msg)?></div><?php endif;
if($error): ?><div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?=h($error)?></div><?php endif;

if ($action === 'list'):
    $services = $db->query("SELECT * FROM services ORDER BY sort_order ASC")->fetchAll();
?>
<div class="adm-card">
  <div class="adm-card-head">
    <h2>Services / Programs (<?=count($services)?>)</h2>
    <a href="?action=new" class="btn btn-gold"><i class="fas fa-plus"></i> New Service</a>
  </div>
  <table class="adm-table">
    <thead><tr><th>#</th><th>Icon</th><th>Title</th><th>Link</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>
      <?php foreach($services as $s): ?>
      <tr>
        <td style="color:var(--muted)"><?=$s['sort_order']?></td>
        <td><i class="<?=h($s['icon'])?>" style="font-size:1.3rem;color:var(--gold)"></i></td>
        <td style="font-weight:600"><?=h($s['title'])?></td>
        <td><a href="<?=h($s['link_url'])?>" target="_blank" style="color:var(--nav);font-size:.82rem"><?=h($s['link_url'])?></a></td>
        <td><a href="?action=toggle&id=<?=$s['id']?>" class="badge <?=$s['is_active']?'badge-green':'badge-red'?>" style="text-decoration:none;cursor:pointer"><?=$s['is_active']?'Active':'Hidden'?></a></td>
        <td><div style="display:flex;gap:6px">
          <a href="?action=edit&id=<?=$s['id']?>" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></a>
          <a href="?action=delete&id=<?=$s['id']?>" class="btn btn-danger btn-sm" data-confirm="Delete this service?"><i class="fas fa-trash"></i></a>
        </div></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php else: $s=$svc??[]; ?>
<div class="adm-card">
  <div class="adm-card-head">
    <h2><?=$s?'Edit Service':'New Service'?></h2>
    <a href="/admin/services.php" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> All Services</a>
  </div>
  <form method="POST">
    <input type="hidden" name="service_id" value="<?=(int)($s['id']??0)?>">
    <div class="form-grid">
      <div class="form-group full">
        <label>Service Title *</label>
        <input type="text" name="title" value="<?=h($s['title']??'')?>" required>
      </div>
      <div class="form-group">
        <label>Font Awesome Icon Class</label>
        <input type="text" name="icon" value="<?=h($s['icon']??'fas fa-star')?>" placeholder="fas fa-brain">
        <span class="form-hint">e.g. fas fa-brain, fas fa-graduation-cap, fas fa-coins</span>
        <div style="margin-top:8px;font-size:2rem;color:var(--gold)"><i id="icon-prev" class="<?=h($s['icon']??'fas fa-star')?>"></i></div>
        <script>document.querySelector('input[name=icon]').addEventListener('input',function(){document.getElementById('icon-prev').className=this.value;});</script>
      </div>
      <div class="form-group">
        <label>Link URL</label>
        <input type="text" name="link_url" value="<?=h($s['link_url']??'')?>" placeholder="courses.php">
      </div>
      <div class="form-group full">
        <label>Description</label>
        <textarea name="description" rows="4" placeholder="Short description of this service..."><?=h($s['description']??'')?></textarea>
      </div>
      <div class="form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="<?=(int)($s['sort_order']??0)?>" min="0">
      </div>
      <div class="form-group">
        <label>Status</label>
        <div class="toggle-wrap">
          <label class="toggle"><input type="checkbox" name="is_active" <?=($s['is_active']??1)?'checked':''?>><span class="toggle-slider"></span></label>
          <span>Active (show on homepage)</span>
        </div>
      </div>
    </div>
    <div class="form-actions" style="margin-top:20px">
      <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Save Service</button>
      <a href="/admin/services.php" class="btn btn-outline">Cancel</a>
    </div>
  </form>
</div>
<?php endif; adminFooter(); ?>
