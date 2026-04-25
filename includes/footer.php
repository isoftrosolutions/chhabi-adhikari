<?php
if (!function_exists('getSetting')) {
    require_once __DIR__ . '/../config.php';
}
$fbUrl    = getSetting('facebook_url',  '#');
$ytUrl    = getSetting('youtube_url',   '#');
$igUrl    = getSetting('instagram_url', '#');
$liUrl    = getSetting('linkedin_url',  '#');
$phone    = getSetting('contact_phone', '');
$email    = getSetting('contact_email', '');
$address  = getSetting('contact_address', 'Kathmandu, Nepal');
$footDesc = getSetting('footer_description', "Nepal's Leading Authority in Personal Transformation. Founded by Chhabi Adhikari.");
?>
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="logo">
                        <a href="<?= BASE_URL ?>/index.php" style="color:#fff;">D-SCHOOL<span style="color:var(--primary);">SYSTEM</span></a>
                    </div>
                    <p style="margin-top:20px;font-size:.9rem;line-height:1.6;"><?= htmlspecialchars($footDesc) ?></p>
                    <?php if ($phone): ?><p style="margin-top:10px;font-size:.85rem;color:var(--primary)"><i class="fas fa-phone"></i> <?= htmlspecialchars($phone) ?></p><?php endif; ?>
                    <?php if ($email): ?><p style="font-size:.85rem;color:rgba(255,255,255,.6)"><i class="fas fa-envelope"></i> <?= htmlspecialchars($email) ?></p><?php endif; ?>
                    <div style="margin-top:22px;display:flex;gap:14px;">
                        <?php if($fbUrl && $fbUrl!=='#'): ?><a href="<?= htmlspecialchars($fbUrl) ?>" target="_blank" style="color:#fff;font-size:1.2rem;transition:color .3s" aria-label="Facebook"><i class="fab fa-facebook"></i></a><?php endif; ?>
                        <?php if($ytUrl && $ytUrl!=='#'): ?><a href="<?= htmlspecialchars($ytUrl) ?>" target="_blank" style="color:#fff;font-size:1.2rem;transition:color .3s" aria-label="YouTube"><i class="fab fa-youtube"></i></a><?php endif; ?>
                        <?php if($igUrl && $igUrl!=='#'): ?><a href="<?= htmlspecialchars($igUrl) ?>" target="_blank" style="color:#fff;font-size:1.2rem;transition:color .3s" aria-label="Instagram"><i class="fab fa-instagram"></i></a><?php endif; ?>
                        <?php if($liUrl && $liUrl!=='#'): ?><a href="<?= htmlspecialchars($liUrl) ?>" target="_blank" style="color:#fff;font-size:1.2rem;transition:color .3s" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a><?php endif; ?>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Programs</h4>
                    <ul style="padding:0;">
                       
                        <li><a href="<?= BASE_URL ?>/money">Money Mastery</a></li>
                        <li><a href="<?= BASE_URL ?>/online-courses">Online Courses</a></li>
                        <li><a href="<?= BASE_URL ?>/courses">All Programs</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul style="padding:0;">
                        <li><a href="<?= BASE_URL ?>/about">About Chhabi</a></li>
                        <li><a href="<?= BASE_URL ?>/calendar">Upcoming Workshops</a></li>
                        <li><a href="<?= BASE_URL ?>/success-stories">Success Stories</a></li>
                        <li><a href="<?= BASE_URL ?>/videos">Videos</a></li>
                        <li><a href="<?= BASE_URL ?>/blog">Blog</a></li>
                        <li><a href="<?= BASE_URL ?>/contact">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Legal</h4>
                    <ul style="padding:0;">
                        <li><a href="<?= BASE_URL ?>/refund-policy">Refund Policy</a></li>
                        <li><a href="<?= BASE_URL ?>/privacy-policy">Privacy Policy</a></li>
                        <li><a href="<?= BASE_URL ?>/terms">Terms & Conditions</a></li>
                    </ul>
                    <?php if($address): ?>
                    <div style="margin-top:20px;font-size:.82rem;color:rgba(255,255,255,.5);line-height:1.6">
                        <i class="fas fa-map-marker-alt" style="color:var(--primary)"></i> <?= htmlspecialchars($address) ?>
                    </div>
                    <?php endif; ?>
                    <div style="margin-top:16px">
                        <a href="<?= BASE_URL ?>/admin/login.php" style="font-size:.75rem;color:rgba(255,255,255,.2);text-decoration:none" title="Admin Login">Admin</a>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <p>Copyright &copy; <?= date('Y') ?> All Rights Reserved by D-School System</p>
            </div>
        </div>
    </footer>

    <!-- Coming Soon Modal -->
    <div id="comingSoonModal" class="cs-modal">
        <div class="cs-modal-content">
            <span class="cs-close">&times;</span>
            <div class="cs-icon"><i class="fas fa-clock"></i></div>
            <h2>Coming Soon!</h2>
            <p>We are currently working hard to bring this feature to you. Stay tuned for updates!</p>
            <button class="cs-btn" onclick="document.getElementById('comingSoonModal').style.display='none'">Got it!</button>
        </div>
    </div>

    <style>
    .cs-modal {
        display: none;
        position: fixed;
        z-index: 10000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.6);
        backdrop-filter: blur(5px);
        animation: fadeIn 0.3s ease;
    }
    .cs-modal-content {
        background: #fff;
        margin: 15% auto;
        padding: 40px;
        border-radius: 20px;
        width: 90%;
        max-width: 400px;
        text-align: center;
        position: relative;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        animation: slideUp 0.4s ease;
    }
    .cs-close {
        position: absolute;
        right: 20px;
        top: 15px;
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        transition: color 0.3s;
    }
    .cs-close:hover { color: var(--secondary); }
    .cs-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        margin: 0 auto 20px;
        box-shadow: 0 10px 20px rgba(245,166,35,0.3);
    }
    .cs-modal-content h2 {
        font-family: var(--font-heading);
        color: var(--secondary);
        margin-bottom: 15px;
    }
    .cs-modal-content p {
        color: var(--text-grey);
        line-height: 1.6;
        margin-bottom: 25px;
    }
    .cs-btn {
        background: var(--secondary);
        color: #fff;
        border: none;
        padding: 12px 35px;
        border-radius: 50px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .cs-btn:hover { background: #0d1b35; transform: translateY(-2px); }
    
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { transform: translateY(30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('comingSoonModal');
        const closeBtn = document.querySelector('.cs-close');
        
        // Handle all "coming-soon" buttons
        document.querySelectorAll('.coming-soon').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                modal.style.display = 'block';
            });
        });

        // Close modal on click outside or close button
        window.onclick = function(event) { if (event.target == modal) modal.style.display = 'none'; }
        closeBtn.onclick = function() { modal.style.display = 'none'; }
        
        // Hamburger Menu Logic
        document.querySelector('.hamburger')?.addEventListener('click', function() {
            this.setAttribute('aria-expanded', this.getAttribute('aria-expanded') === 'true' ? 'false' : 'true');
            document.querySelector('.nav-links').classList.toggle('active');
        });
        
        // Slider Logic (if present)
        const slides = document.querySelectorAll('.slide');
        const dots   = document.querySelectorAll('.dot');
        let cur = 0;
        if (slides.length > 0) {
            function showSlide(n) {
                slides.forEach(s => s.classList.remove('active'));
                dots.forEach(d => d.classList.remove('active'));
                if(slides[n]) slides[n].classList.add('active');
                if(dots[n])   dots[n].classList.add('active');
            }
            let iv = setInterval(() => { cur=(cur+1)%slides.length; showSlide(cur); }, 5000);
            dots.forEach((d,i) => d.addEventListener('click', () => { clearInterval(iv); cur=i; showSlide(i); iv=setInterval(()=>{cur=(cur+1)%slides.length;showSlide(cur);},5000); }));
            document.querySelector('.slider-prev')?.addEventListener('click',()=>{clearInterval(iv);cur=(cur-1+slides.length)%slides.length;showSlide(cur);iv=setInterval(()=>{cur=(cur+1)%slides.length;showSlide(cur);},5000);});
            document.querySelector('.slider-next')?.addEventListener('click',()=>{clearInterval(iv);cur=(cur+1)%slides.length;showSlide(cur);iv=setInterval(()=>{cur=(cur+1)%slides.length;showSlide(cur);},5000);});
        }
    });
    </script>
</body>
</html>
