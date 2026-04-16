<?php include 'includes/header.php'; ?>

    <section class="contact" style="padding: 100px 0;">
        <div class="container">
            <div class="section-header">
                <h2>Contact Us</h2>
                <p>Get in touch with us for workshops, coaching, or any inquiries.</p>
            </div>
            
            <div class="contact-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem;">
                <div class="contact-info">
                    <h3>Get In Touch</h3>
                    <p>We are here to help you on your journey of transformation.</p>
                    <ul style="margin-top: 2rem;">
                        <li style="margin-bottom: 1rem;"><i class="fas fa-envelope" style="margin-right: 10px; color: var(--secondary);"></i> info@dschoolsystem.com</li>
                        <li style="margin-bottom: 1rem;"><i class="fas fa-phone" style="margin-right: 10px; color: var(--secondary);"></i> +977 98000 00000</li>
                        <li style="margin-bottom: 1rem;"><i class="fas fa-map-marker-alt" style="margin-right: 10px; color: var(--secondary);"></i> Kathmandu, Nepal</li>
                    </ul>
                </div>
                
                <div class="contact-form">
                    <form action="#" method="POST" style="background: var(--bg-off-white); padding: 2rem; border-radius: 16px;">
                        <div style="margin-bottom: 1.5rem;">
                            <label for="name" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Name</label>
                            <input type="text" id="name" name="name" style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px;">
                        </div>
                        <div style="margin-bottom: 1.5rem;">
                            <label for="email" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Email</label>
                            <input type="email" id="email" name="email" style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px;">
                        </div>
                        <div style="margin-bottom: 1.5rem;">
                            <label for="message" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Message</label>
                            <textarea id="message" name="message" rows="5" style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="border: none; width: 100%;">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
