<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/../config.php';
requireAuth();

$db = getDB();
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle about image upload
    if (!empty($_FILES['about_image']['name'])) {
        $path = uploadFile($_FILES['about_image'], 'general');
        if ($path) $_POST['about_image'] = $path;
    }
    if (!empty($_FILES['hero_image']['name'])) {
        $path = uploadFile($_FILES['hero_image'], 'hero');
        if ($path) $_POST['hero_image'] = $path;
    }

    $stmt = $db->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?,?) ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value)");
    foreach ($_POST as $key => $value) {
        if (strpos($key, '_') !== false || strlen($key) > 2) {
            $stmt->execute([$key, trim($value)]);
        }
    }

    // Handle password change
    if (!empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
        if ($_POST['new_password'] === $_POST['confirm_password']) {
            $hash = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
            $db->prepare("UPDATE admin_users SET password_hash=? WHERE username='admin'")->execute([$hash]);
            $msg = 'Settings and password saved successfully.';
        } else {
            $msg = 'Settings saved. Note: Passwords did not match — password not changed.';
        }
    } else {
        $msg = 'Settings saved successfully.';
    }
}

// Fetch all settings
$rows = $db->query("SELECT setting_key, setting_value FROM settings")->fetchAll(PDO::FETCH_KEY_PAIR);
function s(string $key, string $default = ''): string {
    global $rows;
    return htmlspecialchars($rows[$key] ?? $default, ENT_QUOTES);
}

require_once __DIR__ . '/includes/layout.php';
adminHeader('Site Settings','settings');

if($msg): ?><div class="alert alert-success"><i class="fas fa-check-circle"></i> <?=h($msg)?></div><?php endif; ?>

<form method="POST" enctype="multipart/form-data">
<div class="tab-group">
  <div class="tab-bar">
    <button type="button" class="tab-btn active" data-tab="tab-general">General</button>
    <button type="button" class="tab-btn" data-tab="tab-hero">Hero Section</button>
    <button type="button" class="tab-btn" data-tab="tab-about">About Section</button>
    <button type="button" class="tab-btn" data-tab="tab-sections">Section Headings</button>
    <button type="button" class="tab-btn" data-tab="tab-stats">Stats</button>
    <button type="button" class="tab-btn" data-tab="tab-contact">Contact & Social</button>
    <button type="button" class="tab-btn" data-tab="tab-account">Account</button>
  </div>

  <!-- General -->
  <div id="tab-general" class="tab-content active">
    <div class="adm-card">
      <div class="adm-card-head"><h2>General Settings</h2></div>
      <div class="form-grid">
        <div class="form-group full"><label>Site Title (browser tab & SEO)</label><input type="text" name="site_title" value="<?=s('site_title','Dr. Chhabi Adhikari | D School System')?>"></div>
        <div class="form-group full"><label>Site Description (SEO meta)</label><textarea name="site_description" rows="2"><?=s('site_description')?></textarea></div>
        <div class="form-group"><label>Site Tagline (short)</label><input type="text" name="site_tagline" value="<?=s('site_tagline',"Nepal's Leading NLP Institute")?>"></div>
        <div class="form-group"><label>Footer Description</label><textarea name="footer_description" rows="3"><?=s('footer_description')?></textarea></div>
      </div>
    </div>
  </div>

  <!-- Hero -->
  <div id="tab-hero" class="tab-content">
    <div class="adm-card">
      <div class="adm-card-head"><h2>Hero Section Text</h2></div>
      <div class="alert alert-info"><i class="fas fa-info-circle"></i> These control the static text on the hero. For dynamic slides, use <a href="<?= BASE_URL ?>/admin/hero.php">Hero Slides</a>.</div>
      <div class="form-grid">
        <div class="form-group"><label>Eyebrow Label</label><input type="text" name="hero_eyebrow" value="<?=s('hero_eyebrow')?>"></div>
        <div class="form-group"><label>Title Line 1</label><input type="text" name="hero_title_line1" value="<?=s('hero_title_line1','Transform Your Mind.')?>"></div>
        <div class="form-group"><label>Title Line 2</label><input type="text" name="hero_title_line2" value="<?=s('hero_title_line2','Transform Your Life.')?>"></div>
        <div class="form-group full"><label>Hero Subtitle Text</label><textarea name="hero_subtitle" rows="3"><?=s('hero_subtitle')?></textarea></div>
        <div class="form-group">
          <label>Hero / Dr. Chhabi Image</label>
          <?php if($rows['hero_image']??''): ?><img src="<?=s('hero_image')?>" style="max-width:200px;border-radius:8px;margin-bottom:8px;display:block"><?php endif; ?>
          <input type="file" name="hero_image" accept="image/*">
          <span class="form-hint">Or keep existing by leaving blank</span>
          <input type="hidden" name="hero_image" value="<?=s('hero_image')?>">
        </div>
      </div>
    </div>
  </div>

  <!-- About -->
  <div id="tab-about" class="tab-content">
    <div class="adm-card">
      <div class="adm-card-head"><h2>About Section</h2></div>
      <div class="form-grid">
        <div class="form-group"><label>Eyebrow Label</label><input type="text" name="about_eyebrow" value="<?=s('about_eyebrow','Meet the Founder')?>"></div>
        <div class="form-group full"><label>About Title</label><input type="text" name="about_title" value="<?=s('about_title')?>"></div>
        <div class="form-group full"><label>About Paragraph 1</label><textarea name="about_text1" rows="4"><?=s('about_text1')?></textarea></div>
        <div class="form-group full"><label>About Paragraph 2</label><textarea name="about_text2" rows="4"><?=s('about_text2')?></textarea></div>
        <div class="form-group">
          <label>About Section Image</label>
          <?php if($rows['about_image']??''): ?><img src="<?=s('about_image')?>" style="max-width:200px;border-radius:8px;margin-bottom:8px;display:block"><?php endif; ?>
          <input type="file" name="about_image" accept="image/*">
          <span class="form-hint">Upload to change the about section photo</span>
          <input type="hidden" name="about_image" value="<?=s('about_image')?>">
        </div>
      </div>
    </div>
  </div>

  <!-- Section Headings -->
  <div id="tab-sections" class="tab-content">
    <div class="adm-card">
      <div class="adm-card-head"><h2>Section Headings & Subtitles</h2></div>
      <div class="form-grid">
        <?php
        $sections = [
          'services_title'=>'Services Title','services_subtitle'=>'Services Subtitle',
          'why_title'=>'Why Us Title','why_subtitle'=>'Why Us Subtitle',
          'testimonials_title'=>'Testimonials Title',
          'blog_preview_title'=>'Blog Preview Title',
          'videos_title'=>'Videos Title',
          'cta_heading'=>'CTA Banner Heading','cta_subtext'=>'CTA Banner Subtext',
        ];
        foreach($sections as $k=>$l): ?>
        <div class="form-group"><label><?=$l?></label><input type="text" name="<?=$k?>" value="<?=s($k)?>"></div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Stats -->
  <div id="tab-stats" class="tab-content">
    <div class="adm-card">
      <div class="adm-card-head"><h2>Hero Stats Bar</h2></div>
      <div class="form-grid">
        <div class="form-group"><label>Decades (e.g. "2+")</label><input type="text" name="stat_decades" value="<?=s('stat_decades','2+')?>"></div>
        <div class="form-group"><label>Lives Touched (e.g. "1M+")</label><input type="text" name="stat_lives" value="<?=s('stat_lives','1M+')?>"></div>
        <div class="form-group"><label>Cities Reached (e.g. "20+")</label><input type="text" name="stat_cities" value="<?=s('stat_cities','20+')?>"></div>
        <div class="form-group"><label>Programs (e.g. "50+")</label><input type="text" name="stat_programs" value="<?=s('stat_programs','50+')?>"></div>
      </div>
    </div>
  </div>

  <!-- Contact & Social -->
  <div id="tab-contact" class="tab-content">
    <div class="adm-card">
      <div class="adm-card-head"><h2>Contact Information</h2></div>
      <div class="form-grid">
        <div class="form-group"><label>Phone</label><input type="text" name="contact_phone" value="<?=s('contact_phone')?>"></div>
        <div class="form-group"><label>Email</label><input type="email" name="contact_email" value="<?=s('contact_email')?>"></div>
        <div class="form-group full"><label>Address</label><input type="text" name="contact_address" value="<?=s('contact_address')?>"></div>
      </div>
    </div>
    <div class="adm-card">
      <div class="adm-card-head"><h2>Social Media Links</h2></div>
      <div class="form-grid">
        <div class="form-group"><label><i class="fab fa-facebook" style="color:#1877f2"></i> Facebook URL</label><input type="url" name="facebook_url" value="<?=s('facebook_url')?>"></div>
        <div class="form-group"><label><i class="fab fa-youtube" style="color:red"></i> YouTube URL</label><input type="url" name="youtube_url" value="<?=s('youtube_url')?>"></div>
        <div class="form-group"><label><i class="fab fa-instagram" style="color:#e1306c"></i> Instagram URL</label><input type="url" name="instagram_url" value="<?=s('instagram_url')?>"></div>
        <div class="form-group"><label><i class="fab fa-linkedin" style="color:#0a66c2"></i> LinkedIn URL</label><input type="url" name="linkedin_url" value="<?=s('linkedin_url')?>"></div>
      </div>
    </div>
  </div>

  <!-- Account -->
  <div id="tab-account" class="tab-content">
    <div class="adm-card">
      <div class="adm-card-head"><h2>Change Admin Password</h2></div>
      <div class="form-grid">
        <div class="form-group"><label>New Password</label><input type="password" name="new_password" placeholder="Leave blank to keep current"></div>
        <div class="form-group"><label>Confirm New Password</label><input type="password" name="confirm_password" placeholder="Repeat new password"></div>
      </div>
    </div>
  </div>

</div><!-- /tab-group -->

<div style="position:sticky;bottom:0;background:rgba(244,246,251,.95);backdrop-filter:blur(10px);padding:16px 0;margin-top:20px;border-top:1px solid var(--border)">
  <div style="display:flex;gap:12px;align-items:center">
    <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Save All Settings</button>
    <span style="font-size:.82rem;color:var(--muted)">Changes apply to the live website immediately.</span>
  </div>
</div>
</form>

<?php adminFooter(); ?>
