<?php
$pageTitle = 'Digital Resources & E-Workshop Academy';
$pageSchema = '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "What is NLP?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Neuro-Linguistic Programming (NLP) is a psychological approach that involves analyzing strategies used by successful individuals and applying them to reach a personal goal. It relates thoughts, language, and patterns of behavior learned through experience to specific outcomes."
    }
  }, {
    "@type": "Question",
    "name": "Who is Chhabi Adhikari?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Chhabi Adhikari is Nepal\'s foremost NLP authority and the founder of the D-School System, with over two decades of experience in life coaching and corporate training."
    }
  }]
}
</script>';
include 'includes/header.php';
?>

    <!-- Page Banner -->
    <section class="page-banner" style="background: linear-gradient(rgba(26, 47, 90, 0.8), rgba(26, 47, 90, 0.8)), url('assets/Gemini_Generated_Image_ejsw4zejsw4zejsw.png') center/cover; padding: 100px 0; color: #fff; text-align: center; margin-top: 80px;">
        <div class="container">
            <h1 style="color: #fff; font-size: 3rem; text-transform: uppercase;">Digital Resources</h1>
            <p style="font-size: 1.25rem; opacity: 0.9;">E-Learning, Audio Programs & Books by Chhabi Adhikari</p>
        </div>
    </section>

    <!-- Online Courses Section -->
    <section class="online-courses-section" style="padding: 100px 0; background: #fff;">
        <div class="container">
            <h2 style="margin-bottom: 20px;">E-Workshop Academy</h2>
            
            <!-- AEO Optimized Content -->
            <div class="aeo-content" style="max-width: 800px; margin-bottom: 50px;">
                <h3 style="font-size: 1.5rem; margin-bottom: 10px; color: var(--secondary);">What is NLP?</h3>
                <p style="font-size: 1.05rem; line-height: 1.6; color: var(--text-grey); margin-bottom: 20px;">
                    Neuro-Linguistic Programming (NLP) is a psychological approach that involves analyzing strategies used by successful individuals and applying them to reach a personal goal. It relates thoughts, language, and patterns of behavior learned through experience to specific outcomes.
                </p>
                <h3 style="font-size: 1.5rem; margin-bottom: 10px; color: var(--secondary);">Who is Chhabi Adhikari?</h3>
                <p style="font-size: 1.05rem; line-height: 1.6; color: var(--text-grey);">
                    Chhabi Adhikari is Nepal's foremost NLP authority and the founder of the D-School System, with over two decades of experience in life coaching and corporate training.
                </p>
            </div>
            <div class="blog-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 30px;">
                <!-- Course 1 -->
                <div class="blog-card" style="box-shadow: var(--shadow-md);">
                    <div class="blog-image">
                        <img src="assets/Gemini_Generated_Image_ejsw4zejsw4zejsw.png" alt="NLP Practitioner Online">
                        <span class="category-badge">BEST SELLER</span>
                    </div>
                    <div class="blog-content">
                        <h4 class="blog-title">NLP Practitioner (10-Day E-Workshop)</h4>
                        <p class="blog-excerpt">Complete foundation of NLP delivered through high-definition video modules and live doubt sessions.</p>
                        <a href="nlp-practitioner.php" class="btn-primary coming-soon" style="margin-top: 20px; width: 100%; text-align: center;">COURSE DETAILS</a>
                    </div>
                </div>
                <!-- Course 2 -->
                <div class="blog-card" style="box-shadow: var(--shadow-md);">
                    <div class="blog-image">
                        <img src="assets/Gemini_Generated_Image_q9bjvcq9bjvcq9bj.png" alt="Money Mastery Online">
                        <span class="category-badge">FINANCE</span>
                    </div>
                    <div class="blog-content">
                        <h4 class="blog-title">Money Mastery Digital Bundle</h4>
                        <p class="blog-excerpt">Reprogram your financial subconscious with 15 intense audio anchors and 5 video coaching modules.</p>
                        <a href="money.php" class="btn-primary" style="margin-top: 20px; width: 100%; text-align: center;">ACCESS BUNDLE</a>
                    </div>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 60px;">
                 <a href="shop.php" class="coming-soon" style="color: var(--secondary); font-weight: 700;">Visit Full Digital Store →</a>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
