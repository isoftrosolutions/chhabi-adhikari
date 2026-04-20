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
$footDesc = getSetting('footer_description', "Nepal's Leading Authority in Personal Transformation. Founded by Dr. Chhabi Adhikari.");
?>
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="logo">
                        <a href="/index.php" style="color:#fff;">D-SCHOOL<span style="color:var(--primary);">SYSTEM</span></a>
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
                        <li><a href="/nlp-sr-master.php">NLP SR Master Practitioner</a></li>
                        <li><a href="/ttclc.php">Train the Life Coach</a></li>
                        <li><a href="/nlp-practitioner.php">NLP Practitioner</a></li>
                        <li><a href="/money.php">Money Mastery</a></li>
                        <li><a href="/online-courses.php">Online Courses</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul style="padding:0;">
                        <li><a href="/about.php">About Dr. Chhabi</a></li>
                        <li><a href="/calendar.php">Upcoming Workshops</a></li>
                        <li><a href="/success-stories.php">Success Stories</a></li>
                        <li><a href="/videos.php">Videos</a></li>
                        <li><a href="/blog.php">Blog</a></li>
                        <li><a href="/contact.php">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Legal</h4>
                    <ul style="padding:0;">
                        <li><a href="/refund-policy.php">Refund Policy</a></li>
                        <li><a href="/privacy-policy.php">Privacy Policy</a></li>
                        <li><a href="/terms.php">Terms & Conditions</a></li>
                    </ul>
                    <?php if($address): ?>
                    <div style="margin-top:20px;font-size:.82rem;color:rgba(255,255,255,.5);line-height:1.6">
                        <i class="fas fa-map-marker-alt" style="color:var(--primary)"></i> <?= htmlspecialchars($address) ?>
                    </div>
                    <?php endif; ?>
                    <div style="margin-top:16px">
                        <a href="/admin/login.php" style="font-size:.75rem;color:rgba(255,255,255,.2);text-decoration:none" title="Admin Login">Admin</a>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <p>Copyright &copy; <?= date('Y') ?> All Rights Reserved by D-School System</p>
            </div>
        </div>
    </footer>

    <script>
    document.querySelector('.hamburger')?.addEventListener('click', function() {
        this.setAttribute('aria-expanded', this.getAttribute('aria-expanded') === 'true' ? 'false' : 'true');
        document.querySelector('.nav-links').classList.toggle('active');
    });
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
    </script>
</body>
</html>
