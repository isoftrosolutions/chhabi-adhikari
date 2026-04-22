<?php
if (file_exists(__DIR__ . '/../config.php')) {
    require_once __DIR__ . '/../config.php';
    $siteTitle = getSetting('site_title', 'Chhabi Adhikari | D School System | NLP Training in Nepal');
    $siteMeta  = getSetting('site_description', 'Certified NLP Trainer and Founder of D School System. Transform your life and career with expert coaching in Nepal.');
} else {
    $siteTitle = 'Chhabi Adhikari | D School System | NLP Training in Nepal';
    $siteMeta  = 'Certified NLP Trainer and Founder of D School System. Transform your life and career with expert coaching in Nepal.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($siteTitle) ?></title>
    <meta name="description" content="<?= htmlspecialchars($siteMeta) ?>">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' https://fonts.googleapis.com https://fonts.gstatic.com https://cdnjs.cloudflare.com https://img.youtube.com https://www.youtube.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com; font-src 'self' data: https://fonts.gstatic.com https://cdnjs.cloudflare.com; script-src 'self' 'unsafe-inline' https://www.googletagmanager.com https://www.google-analytics.com; connect-src 'self' https://www.google-analytics.com; img-src 'self' data: https://img.youtube.com https://dschoolsystem.com;">
    <link rel="canonical" href="https://dschoolsystem.com<?php echo $_SERVER['PHP_SELF']; ?>">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://dschoolsystem.com/">
    <meta property="og:title" content="<?= htmlspecialchars($siteTitle) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($siteMeta) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>/assets/Gemini_Generated_Image_ejsw4zejsw4zejsw.png">
    <link rel="manifest" href="<?= BASE_URL ?>/manifest.json">
    <meta name="theme-color" content="#1a2f5a">
</head>
<body>
    <header>
        <div class="container">
            <nav role="navigation" aria-label="Main navigation">
                <div class="logo">
                    <a href="<?= BASE_URL ?>/index.php">D-SCHOOL<span>SYSTEM</span></a>
                </div>
                <ul class="nav-links" role="menubar">
                    <li class="nav-item" role="none"><a href="<?= BASE_URL ?>/index" role="menuitem">Home</a></li>
                    <li class="nav-item" role="none"><a href="<?= BASE_URL ?>/about" role="menuitem">About</a></li>
                    <li class="nav-item" role="none"><a href="<?= BASE_URL ?>/blog" role="menuitem">News</a></li>
                    <li class="nav-item" role="none"><a href="<?= BASE_URL ?>/videos" role="menuitem">Videos</a></li>
                    <li class="nav-item" role="none"><a href="<?= BASE_URL ?>/gallery" role="menuitem">Gallery</a></li>
                    <li class="nav-item" role="none"><a href="<?= BASE_URL ?>/courses" role="menuitem">Services</a></li>
                    <li class="nav-item" role="none"><a href="<?= BASE_URL ?>/contact" role="menuitem">Contact Us</a></li>
                </ul>
                <button class="hamburger" aria-label="Toggle navigation menu" aria-expanded="false">
                    <i class="fas fa-bars" aria-hidden="true"></i>
                </button>
            </nav>
        </div>
    </header>
