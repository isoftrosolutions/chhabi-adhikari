<?php
session_start();
if (!empty($_SESSION['admin_logged_in'])) {
    header('Location: /admin/index.php'); exit;
}
require_once __DIR__ . '/../config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $stmt = getDB()->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $user['username'];
        header('Location: /admin/index.php'); exit;
    }
    $error = 'Invalid username or password.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin Login — D-School CMS</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{
  min-height:100vh;background:linear-gradient(135deg,#0d1b35 0%,#1a2f5a 100%);
  display:flex;align-items:center;justify-content:center;padding:20px;
  font-family:'Inter',system-ui,sans-serif;
}
.login-card{
  background:#fff;border-radius:16px;padding:44px 40px;width:100%;max-width:420px;
  box-shadow:0 25px 60px rgba(0,0,0,.3);
}
.login-logo{text-align:center;margin-bottom:32px;}
.login-logo i{font-size:2.5rem;color:#F5A623;display:block;margin-bottom:10px;}
.login-logo h1{font-size:1.4rem;font-weight:800;color:#1a2f5a;letter-spacing:.5px;}
.login-logo p{font-size:.82rem;color:#64748b;margin-top:4px;}
.form-group{margin-bottom:18px;}
label{display:block;font-size:.82rem;font-weight:600;color:#1e293b;margin-bottom:6px;}
.input-wrap{position:relative;}
.input-wrap i{
  position:absolute;left:13px;top:50%;transform:translateY(-50%);
  color:#94a3b8;font-size:.9rem;
}
input{
  width:100%;padding:11px 13px 11px 38px;border:1.5px solid #e2e8f0;
  border-radius:8px;font-size:.9rem;color:#1e293b;transition:border-color .2s;
  font-family:inherit;
}
input:focus{outline:none;border-color:#F5A623;}
.btn-login{
  width:100%;padding:13px;background:linear-gradient(135deg,#F5A623,#E87722);
  color:#fff;border:none;border-radius:8px;font-size:.95rem;font-weight:700;
  cursor:pointer;transition:opacity .2s;letter-spacing:.3px;
}
.btn-login:hover{opacity:.9;}
.error{background:#fee2e2;color:#991b1b;padding:10px 14px;border-radius:8px;font-size:.85rem;margin-bottom:16px;display:flex;align-items:center;gap:8px;}
.back-link{text-align:center;margin-top:20px;}
.back-link a{color:#64748b;font-size:.82rem;text-decoration:none;}
.back-link a:hover{color:#F5A623;}
</style>
</head>
<body>
<div class="login-card">
  <div class="login-logo">
    <i class="fas fa-brain"></i>
    <h1>D-SCHOOL CMS</h1>
    <p>Admin Control Panel</p>
  </div>
  <?php if ($error): ?>
    <div class="error"><i class="fas fa-exclamation-circle"></i> <?= h($error) ?></div>
  <?php endif; ?>
  <form method="POST">
    <div class="form-group">
      <label>Username</label>
      <div class="input-wrap">
        <i class="fas fa-user"></i>
        <input type="text" name="username" placeholder="Enter username" required
               value="<?= h($_POST['username'] ?? '') ?>">
      </div>
    </div>
    <div class="form-group">
      <label>Password</label>
      <div class="input-wrap">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" placeholder="Enter password" required>
      </div>
    </div>
    <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt"></i> &nbsp;Login</button>
  </form>
  <div class="back-link"><a href="/index.php">← Back to website</a></div>
</div>
</body>
</html>
