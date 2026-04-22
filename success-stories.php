<?php
include 'includes/header.php';
$pdo = getDB();
$stmt = $pdo->query("SELECT * FROM testimonials WHERE is_active = 1 ORDER BY sort_order ASC, created_at DESC");
$testimonials = $stmt->fetchAll();
?>

    <!-- Page Banner -->
    <section class="page-banner" style="background: linear-gradient(rgba(26, 47, 90, 0.8), rgba(26, 47, 90, 0.8)), url('assets/Gemini_Generated_Image_q9bjvcq9bjvcq9bj.png') center/cover; padding: 100px 0; color: #fff; text-align: center; margin-top: 80px;">
        <div class="container">
            <h1 style="color: #fff; font-size: 3rem; text-transform: uppercase;">Success Stories</h1>
            <p style="font-size: 1.2rem; opacity: 0.9;">Real People. Real Results. Real Transformation.</p>
        </div>
    </section>

    <section class="testimonials-section" style="padding: 80px 0;">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 60px;">
                <h2>Voices of Transformation</h2>
                <div style="width: 80px; height: 4px; background: var(--primary); margin: 20px auto;"></div>
                <p style="max-width: 700px; margin: 0 auto; color: var(--text-grey);">Discover how Chhabi Adhikari's NLP methodologies have helped thousands of people across Nepal and beyond to unlock their true potential.</p>
            </div>

            <div class="testimonial-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 30px;">
                <?php foreach ($testimonials as $testi): ?>
                <div class="story-card" style="background: #fff; padding: 40px; border-radius: 20px; box-shadow: var(--shadow-md); position: relative;">
                    <i class="fas fa-quote-left" style="position: absolute; top: 20px; right: 20px; font-size: 2rem; color: rgba(245, 166, 35, 0.1);"></i>
                    <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 25px;">
                        <div style="width: 60px; height: 60px; border-radius: 50%; background: #eee; overflow: hidden; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #fff; background-color: var(--primary);">
                            <?= h($testi['avatar_initial']) ?>
                        </div>
                        <div>
                            <h4 style="margin-bottom: 5px;"><?= h($testi['name']) ?></h4>
                            <p style="font-size: 0.85rem; color: var(--primary); font-weight: 600;"><?= h($testi['role']) ?><?= (!empty($testi['location'])) ? ', ' . h($testi['location']) : '' ?></p>
                        </div>
                    </div>
                    <p style="font-style: italic; color: var(--text-grey); line-height: 1.8;">"<?= nl2br(h($testi['content'])) ?>"</p>
                    <div style="margin-top: 20px; color: #ffc107;">
                        <?= str_repeat('<i class="fas fa-star"></i>', $testi['rating'] ?? 5) ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Video Testimonials Section -->
            <div style="margin-top: 100px;">
                <h3 style="text-align: center; margin-bottom: 40px;">Watch Their Transformation</h3>
                <div class="video-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                    <div style="border-radius: 15px; overflow: hidden; box-shadow: var(--shadow-md);">
                        <video width="100%" height="200" controls>
                            <source src="assets/Introduction_%20Dr.%20Chhabi%20Adhikari.mp4" type="video/mp4">
                        </video>
                        <div style="padding: 15px; background: #fff;">
                            <h5 style="margin: 0;">Introduction to NLP Results</h5>
                        </div>
                    </div>
                    <div style="border-radius: 15px; overflow: hidden; box-shadow: var(--shadow-md); background: #222; display: flex; align-items: center; justify-content: center; height: 250px;">
                         <i class="fab fa-youtube" style="font-size: 4rem; color: #ff0000; cursor: pointer;"></i>
                    </div>
                    <div style="border-radius: 15px; overflow: hidden; box-shadow: var(--shadow-md); background: #222; display: flex; align-items: center; justify-content: center; height: 250px;">
                         <i class="fab fa-youtube" style="font-size: 4rem; color: #ff0000; cursor: pointer;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
