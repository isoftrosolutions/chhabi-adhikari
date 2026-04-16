    <footer>
        <div class="container">
            <div class="footer-grid">
                <!-- Column 1 -->
                <div class="footer-brand">
                    <div class="logo">
                        <a href="index.php" style="color:#fff;">D-SCHOOL<span style="color:var(--primary);">SYSTEM</span></a>
                    </div>
                    <p style="margin-top: 20px; font-size: 0.9rem; line-height: 1.6;">
                        Nepal's Leading Authority in the field of Personal Transformation. Founded by Dr. Chhabi Adhikari, dedicated to helping you master your subconscious mind.
                    </p>
                    <div style="margin-top: 25px; display: flex; gap: 15px;">
                        <a href="#" style="color: #fff; font-size: 1.2rem;"><i class="fab fa-facebook"></i></a>
                        <a href="#" style="color: #fff; font-size: 1.2rem;"><i class="fab fa-youtube"></i></a>
                        <a href="#" style="color: #fff; font-size: 1.2rem;"><i class="fab fa-instagram"></i></a>
                        <a href="#" style="color: #fff; font-size: 1.2rem;"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                
                <!-- Column 2: Courses -->
                <div class="footer-col">
                    <h4>Courses</h4>
                    <ul style="padding: 0;">
                        <li><a href="nlp-sr-master.php">NLP SR Master Practitioner</a></li>
                        <li><a href="audio.php">Audio Programs</a></li>
                        <li><a href="online-courses.php">Online Courses</a></li>
                        <li><a href="#">Udemy Courses</a></li>
                        <li><a href="corporate.php">Corporate In-House</a></li>
                    </ul>
                </div>
                
                <!-- Column 3: Links -->
                <div class="footer-col">
                    <h4>Links</h4>
                    <ul style="padding: 0;">
                        <li><a href="calendar.php">Upcoming Workshops</a></li>
                        <li><a href="success-stories.php">Success Stories</a></li>
                        <li><a href="gallery.php">Pictures</a></li>
                        <li><a href="refund-policy.php">Refund Policy</a></li>
                        <li><a href="privacy-policy.php">Privacy Policy</a></li>
                        <li><a href="terms.php">Terms & Conditions</a></li>
                    </ul>
                </div>
                
                <!-- Column 4: Resources -->
                <div class="footer-col">
                    <h4>Resources</h4>
                    <ul style="padding: 0;">
                        <li><a href="blog.php">Dr. Chhabi's Blog</a></li>
                        <li><a href="about-nlp.php">About NLP</a></li>
                        <li><a href="trainers.php">Our Trainers</a></li>
                        <li><a href="videos.php">Videos</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                <p>Copyrights &copy; 2026 All Rights Reserved by D-School System</p>
            </div>
        </div>
    </footer>

    <script>
        // Simple script for mobile menu
        document.querySelector('.hamburger').addEventListener('click', function() {
            document.querySelector('.nav-links').classList.toggle('active');
        });

        // Hero Slider Logic
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');
        let currentSlide = 0;

        if (slides.length > 0) {
            function showSlide(n) {
                slides.forEach(slide => slide.classList.remove('active'));
                dots.forEach(dot => dot.classList.remove('active'));
                
                if (slides[n]) slides[n].classList.add('active');
                if (dots[n]) dots[n].classList.add('active');
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }

            // Auto-play
            let sliderInterval = setInterval(nextSlide, 5000);

            // Dot navigation
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    clearInterval(sliderInterval);
                    currentSlide = index;
                    showSlide(currentSlide);
                    sliderInterval = setInterval(nextSlide, 5000);
                });
            });
        }
    </script>
</body>
</html>
