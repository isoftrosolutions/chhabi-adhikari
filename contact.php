<?php 
$pageTitle = 'Contact Us';
$pageSchema = '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ContactPage",
  "name": "Contact Chhabi Adhikari & D-school System",
  "description": "Get in touch with us for NLP workshops, coaching, or any inquiries."
}
</script>';
include 'includes/header.php';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    if (empty($name) || empty($email) || empty($message)) {
        $error = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        try {
            $stmt = getDB()->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $message]);
            $success = true;
        } catch (PDOException $e) {
            $error = 'Something went wrong. Please try again.';
        }
    }
}
?>

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
                        <li style="margin-bottom: 1rem;"><i class="fas fa-envelope" style="margin-right: 10px; color: var(--secondary);"></i> mindapp69@gmail.com</li>
                        <li style="margin-bottom: 1rem;"><i class="fas fa-phone" style="margin-right: 10px; color: var(--secondary);"></i> +977 985-6029135</li>
                        <li style="margin-bottom: 1rem;"><i class="fas fa-map-marker-alt" style="margin-right: 10px; color: var(--secondary);"></i> Kathmandu, Nepal</li>
                    </ul>
                </div>
                
                <div class="contact-form">
                    <?php if ($error): ?>
                    <div style="background: #fee2e2; color: #dc2626; padding: 12px 16px; border-radius: 8px; margin-bottom: 1rem; font-size: 0.9rem;">
                        <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
                    </div>
                    <?php endif; ?>
                    <form id="contactForm" action="" method="POST" style="background: var(--bg-off-white); padding: 2rem; border-radius: 16px;">
                        <div style="margin-bottom: 1.5rem;">
                            <label for="name" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Name</label>
                            <input type="text" id="name" name="name" required style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px;" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                        </div>
                        <div style="margin-bottom: 1.5rem;">
                            <label for="email" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Email</label>
                            <input type="email" id="email" name="email" required style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px;" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                        </div>
                        <div style="margin-bottom: 1.5rem;">
                            <label for="message" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Message</label>
                            <textarea id="message" name="message" rows="5" required style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px;"><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="border: none; width: 100%;">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div id="successModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
        <div style="background: white; padding: 40px; border-radius: 16px; text-align: center; max-width: 400px; margin: 20px;">
            <div style="width: 60px; height: 60px; background: #d1fae5; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                <i class="fas fa-check" style="color: #059669; font-size: 30px;"></i>
            </div>
            <h3 style="color: #1a2f5a; margin-bottom: 10px;">Message Sent!</h3>
            <p style="color: #666; margin-bottom: 20px;">Thank you for reaching out. We'll get back to you soon.</p>
            <button onclick="closeModal()" class="btn btn-primary" style="border: none; padding: 12px 32px;">Continue</button>
        </div>
    </div>

    <script>
    <?php if ($success): ?>
    window.onload = function() {
        document.getElementById('successModal').style.display = 'flex';
        document.getElementById('contactForm').reset();
    };
    <?php endif; ?>
    
    function closeModal() {
        document.getElementById('successModal').style.display = 'none';
    }
    
    document.getElementById('successModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
    </script>

<?php include 'includes/footer.php'; ?>
