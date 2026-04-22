<?php 
include 'includes/header.php';

$galleryImages = [];
try {
    $stmt = getDB()->prepare("SELECT * FROM gallery WHERE is_active = 1 ORDER BY sort_order ASC, id DESC");
    $stmt->execute();
    $galleryImages = $stmt->fetchAll();
} catch (Exception $e) {
    $galleryImages = [];
}
?>

    <!-- Page Banner -->
    <section class="page-banner" style="background: linear-gradient(rgba(26, 47, 90, 0.8), rgba(26, 47, 90, 0.8)), url('<?= BASE_URL ?>/assets/Gemini_Generated_Image_2hrh3z2hrh3z2hrh.png') center/cover; padding: 100px 0; color: #fff; text-align: center; margin-top: 80px;">
        <div class="container">
            <h1 style="color: #fff; font-size: 3rem; text-transform: uppercase;">Photo Gallery</h1>
            <p style="font-size: 1.25rem; opacity: 0.9;">Explore Moments from Chhabi Adhikari's NLP Training Sessions</p>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="gallery-section" style="padding: 100px 0;">
        <div class="container">
            <?php if (empty($galleryImages)): ?>
                <p style="text-align: center; color: #666;">No gallery images yet. Check back soon!</p>
            <?php else: ?>
                <div class="gallery-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                    <?php foreach ($galleryImages as $img): ?>
                        <div class="gallery-item">
                            <img src="<?= BASE_URL ?>/<?= h(ltrim($img['image_path'], '/')) ?>" alt="<?= h($img['alt_text'] ?? $img['title'] ?? 'Gallery Image') ?>" style="width: 100%; height: 250px; object-fit: cover; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                            <div class="gallery-content" style="padding: 15px 0;">
                                <h4 style="margin: 0; font-size: 1.1rem;"><?= h($img['title'] ?? 'Gallery') ?></h4>
                                <p style="color: #666; font-size: 0.9rem; margin: 5px 0;"><?= h($img['category'] ?? '') ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php include 'includes/footer.php'; ?></content>
<parameter name="filePath">C:\Apache24\htdocs\d-sch\gallery.php