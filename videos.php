<?php
include 'includes/header.php';
$pdo = getDB();
$stmt = $pdo->query("SELECT * FROM videos WHERE is_active = 1 ORDER BY sort_order ASC, created_at DESC");
$videos = $stmt->fetchAll();
?>

    <!-- Page Banner -->
    <section class="page-banner" style="background: linear-gradient(rgba(26, 47, 90, 0.8), rgba(26, 47, 90, 0.8)), url('assets/Gemini_Generated_Image_2hrh3z2hrh3z2hrh.png') center/cover; padding: 100px 0; color: #fff; text-align: center; margin-top: 80px;">
        <div class="container">
            <h1 style="color: #fff; font-size: 3rem; text-transform: uppercase;">Video Library</h1>
            <p style="font-size: 1.25rem; opacity: 0.9;">Watch Chhabi Adhikari's Most Impactful NLP Sessions</p>
        </div>
    </section>

    <!-- Videos Grid -->
    <section class="videos-section" style="padding: 100px 0;">
        <div class="container">
            <div class="blog-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 30px;">
                <?php foreach ($videos as $vid): ?>
                <div class="blog-card" style="box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-radius: 12px; overflow: hidden; background: #fff;">
                    <?php if (!empty($vid['youtube_id'])): ?>
                    <div style="background: #000; height: 200px; display: flex; align-items: center; justify-content: center; position: relative;">
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?= h($vid['youtube_id']) ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <?php else: ?>
                    <div style="background: <?= h($vid['bg_gradient']) ?>; height: 200px; display: flex; align-items: center; justify-content: center; position: relative;" <?= $vid['youtube_url'] ? "onclick=\"window.open('{$vid['youtube_url']}', '_blank')\" style='cursor:pointer;'" : "" ?>>
                        <i class="fas fa-play" style="position: absolute; color: #fff; font-size: 3rem; cursor: pointer; opacity: 0.8;"></i>
                    </div>
                    <?php endif; ?>
                    <div class="blog-content" style="padding: 20px;">
                        <h4 class="blog-title" style="margin-bottom: 10px;"><?= nl2br(h($vid['title'])) ?></h4>
                        <p class="blog-excerpt" style="font-size: 0.95rem; color: #666;"><?= nl2br(h($vid['description'])) ?></p>
                        <?php if(!empty($vid['youtube_url'])): ?>
                        <a href="<?= h($vid['youtube_url']) ?>" target="_blank" class="btn-primary" style="margin-top: 15px; font-size: 0.8rem; padding: 10px 20px; display: inline-block; text-decoration: none;">WATCH ON YOUTUBE</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
