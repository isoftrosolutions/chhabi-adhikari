<?php include 'includes/header.php'; ?>

    <!-- Page Banner -->
    <section class="page-banner" style="background: linear-gradient(rgba(26, 47, 90, 0.8), rgba(26, 47, 90, 0.8)), url('assets/Gemini_Generated_Image_2hrh3z2hrh3z2hrh.png') center/cover; padding: 100px 0; color: #fff; text-align: center; margin-top: 80px;">
        <div class="container">
            <h1 style="color: #fff; font-size: 3rem; text-transform: uppercase;">Video Library</h1>
            <p style="font-size: 1.25rem; opacity: 0.9;">Watch Dr. Chhabi Adhikari's Most Impactful NLP Sessions</p>
        </div>
    </section>

    <!-- Videos Grid -->
    <section class="videos-section" style="padding: 100px 0;">
        <div class="container">
            <div class="blog-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 30px;">
                <!-- Video 1 -->
                <div class="blog-card">
                    <div style="background: #000; height: 200px; display: flex; align-items: center; justify-content: center; position: relative;">
                        <video width="100%" height="100%" poster="assets/2.png">
                             <source src="assets/Introduction_ Dr. Chhabi Adhikari.mp4" type="video/mp4">
                        </video>
                        <i class="fas fa-play" style="position: absolute; color: #fff; font-size: 3rem; cursor: pointer; opacity: 0.8;"></i>
                    </div>
                    <div class="blog-content">
                        <h4 class="blog-title">Introduction to NLP in Nepal</h4>
                        <p class="blog-excerpt">Dr. Chhabi Adhikari explains how NLP can solve everyday life challenges in the Nepalese context.</p>
                    </div>
                </div>
                
                <!-- Placeholder Video 2 -->
                <div class="blog-card" style="background: #222; height: 350px; display: flex; align-items: center; justify-content: center; flex-direction: column; color: #fff; text-align: center; padding: 20px;">
                     <i class="fab fa-youtube" style="font-size: 4rem; color: #f00; margin-bottom: 20px;"></i>
                     <h4>Watch on YouTube</h4>
                     <p style="font-size: 0.9rem; opacity: 0.7;">Subscribe to Dr. Chhabi Adhikari's channel for over 200+ free NLP training videos.</p>
                     <a href="#" class="btn-primary" style="margin-top: 20px; font-size: 0.8rem; padding: 10px 20px;">GO TO YOUTUBE</a>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
