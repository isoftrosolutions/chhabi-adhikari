<?php
$pageTitle = 'Contact Us – Begin Your Transformation';
$pageSchema = '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ContactPage",
  "name": "Contact Chhabi Adhikari & D-school System",
  "description": "Get in touch for NLP workshops, coaching, or any inquiries.",
  "url": "https://deschoolsystem.com/contact.php",
  "mainEntity": {
    "@type": "Organization",
    "name": "D-school System",
    "email": "mindapp69@gmail.com",
    "telephone": "+977-985-6029135",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Kathmandu",
      "addressCountry": "NP"
    }
  }
}
</script>';
include 'includes/header.php';

$success = false;
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']     ?? '');
    $email    = trim($_POST['email']    ?? '');
    $phone    = trim($_POST['phone']    ?? '');
    $interest = trim($_POST['interest'] ?? '');
    $raw_msg  = trim($_POST['message']  ?? '');

    if (empty($name) || empty($email) || empty($raw_msg)) {
        $error = 'Please fill in your name, email, and message.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        $parts = [];
        if ($phone)    $parts[] = "Phone: $phone";
        if ($interest) $parts[] = "Interested in: $interest";
        $parts[] = $raw_msg;
        $full_message = implode("\n", $parts);

        try {
            $stmt = getDB()->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $full_message]);
            $success = true;
        } catch (PDOException $e) {
            $error = 'Something went wrong. Please try again.';
        }
    }
}
?>

<style>
/* ── Contact Page ── */
.ct-hero {
    background: linear-gradient(135deg, #0B1E3F 0%, #1a3060 60%, #0d2550 100%);
    padding: 120px 0 80px;
    position: relative;
    overflow: hidden;
    text-align: center;
}
.ct-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 20% 50%, rgba(255,106,0,.12) 0%, transparent 55%),
        radial-gradient(circle at 80% 30%, rgba(255,106,0,.08) 0%, transparent 50%);
    pointer-events: none;
}
.ct-hero__tag {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,106,0,.15);
    border: 1px solid rgba(255,106,0,.3);
    color: #FF6A00;
    font-family: var(--font-body);
    font-size: .8rem;
    font-weight: 600;
    letter-spacing: .08em;
    text-transform: uppercase;
    padding: 6px 16px;
    border-radius: 100px;
    margin-bottom: 20px;
}
.ct-hero h1 {
    font-family: var(--font-heading);
    font-size: clamp(2rem, 4.5vw, 3.2rem);
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
    margin-bottom: 18px;
}
.ct-hero h1 em {
    font-style: normal;
    color: #FF6A00;
}
.ct-hero p {
    font-family: var(--font-body);
    font-size: clamp(.95rem, 2vw, 1.15rem);
    color: rgba(255,255,255,.75);
    max-width: 520px;
    margin: 0 auto;
    line-height: 1.7;
}
.ct-hero__dots {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-image: radial-gradient(rgba(255,255,255,.06) 1px, transparent 1px);
    background-size: 32px 32px;
    pointer-events: none;
}

/* ── Main two-column ── */
.ct-body {
    padding: 80px 0 60px;
    background: #F4F6FA;
}
.ct-grid {
    display: grid;
    grid-template-columns: 420px 1fr;
    gap: 48px;
    align-items: start;
}

/* ── Left panel ── */
.ct-info {
    position: sticky;
    top: 100px;
}
.ct-info__card {
    background: #0B1E3F;
    border-radius: 20px;
    padding: 40px 36px;
    color: #fff;
    margin-bottom: 24px;
}
.ct-info__title {
    font-family: var(--font-heading);
    font-size: 1.3rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.ct-info__title i { color: #FF6A00; }

.ct-detail {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 22px;
}
.ct-detail:last-child { margin-bottom: 0; }
.ct-detail__icon {
    flex-shrink: 0;
    width: 42px;
    height: 42px;
    background: rgba(255,106,0,.15);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #FF6A00;
    font-size: 1rem;
}
.ct-detail__text strong {
    display: block;
    font-family: var(--font-heading);
    font-size: .8rem;
    font-weight: 600;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: rgba(255,255,255,.5);
    margin-bottom: 3px;
}
.ct-detail__text span {
    font-family: var(--font-body);
    font-size: .95rem;
    color: rgba(255,255,255,.9);
    line-height: 1.5;
}
.ct-detail__text a {
    color: rgba(255,255,255,.9);
    text-decoration: none;
    transition: color .2s;
}
.ct-detail__text a:hover { color: #FF6A00; }

.ct-social {
    display: flex;
    gap: 12px;
    margin-top: 28px;
    padding-top: 24px;
    border-top: 1px solid rgba(255,255,255,.1);
}
.ct-social a {
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,.08);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255,255,255,.7);
    font-size: .95rem;
    text-decoration: none;
    transition: background .2s, color .2s, transform .2s;
}
.ct-social a:hover {
    background: #FF6A00;
    color: #fff;
    transform: translateY(-2px);
}

/* ── What happens next ── */
.ct-next {
    background: #fff;
    border-radius: 20px;
    padding: 32px 36px;
    border: 1px solid rgba(11,30,63,.08);
}
.ct-next__title {
    font-family: var(--font-heading);
    font-size: 1rem;
    font-weight: 700;
    color: #0B1E3F;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.ct-next__title i { color: #FF6A00; }
.ct-step {
    display: flex;
    gap: 14px;
    margin-bottom: 18px;
    align-items: flex-start;
}
.ct-step:last-child { margin-bottom: 0; }
.ct-step__num {
    flex-shrink: 0;
    width: 28px;
    height: 28px;
    background: #FF6A00;
    border-radius: 50%;
    font-family: var(--font-heading);
    font-size: .75rem;
    font-weight: 800;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 1px;
}
.ct-step__text {
    font-family: var(--font-body);
    font-size: .9rem;
    color: #5a6478;
    line-height: 1.55;
}
.ct-step__text strong {
    display: block;
    font-weight: 600;
    color: #0B1E3F;
    margin-bottom: 2px;
}

/* ── Form panel ── */
.ct-form-wrap {
    background: #fff;
    border-radius: 24px;
    padding: 48px;
    box-shadow: 0 6px 24px rgba(11,30,63,.08);
}
.ct-form-wrap h2 {
    font-family: var(--font-heading);
    font-size: 1.6rem;
    font-weight: 800;
    color: #0B1E3F;
    margin-bottom: 6px;
}
.ct-form-wrap > p {
    font-family: var(--font-body);
    font-size: .95rem;
    color: #5a6478;
    margin-bottom: 32px;
    line-height: 1.6;
}
.ct-form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}
.ct-field {
    margin-bottom: 20px;
}
.ct-field label {
    display: block;
    font-family: var(--font-body);
    font-size: .82rem;
    font-weight: 600;
    letter-spacing: .04em;
    text-transform: uppercase;
    color: #0B1E3F;
    margin-bottom: 7px;
}
.ct-field label span { color: #FF6A00; }
.ct-field input,
.ct-field select,
.ct-field textarea {
    width: 100%;
    padding: 13px 16px;
    border: 1.5px solid #e0e4ed;
    border-radius: 10px;
    font-family: var(--font-body);
    font-size: .95rem;
    color: #0B1E3F;
    background: #fafbfd;
    outline: none;
    transition: border-color .2s, box-shadow .2s;
    box-sizing: border-box;
    appearance: none;
}
.ct-field select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%235a6478'%3E%3Cpath fill-rule='evenodd' d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    background-size: 16px;
    padding-right: 40px;
    cursor: pointer;
}
.ct-field input:focus,
.ct-field select:focus,
.ct-field textarea:focus {
    border-color: #FF6A00;
    box-shadow: 0 0 0 3px rgba(255,106,0,.12);
    background: #fff;
}
.ct-field textarea { resize: vertical; min-height: 130px; }
.ct-field input::placeholder,
.ct-field textarea::placeholder { color: #b0b8cc; }

.ct-error {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #dc2626;
    padding: 12px 16px;
    border-radius: 10px;
    font-family: var(--font-body);
    font-size: .9rem;
    margin-bottom: 24px;
}

.ct-submit {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, #FF6A00, #e85d00);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-family: var(--font-heading);
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: transform .2s, box-shadow .2s;
    box-shadow: 0 4px 16px rgba(255,106,0,.35);
    margin-top: 8px;
}
.ct-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(255,106,0,.45);
}
.ct-submit i { font-size: .9rem; }
.ct-privacy {
    font-family: var(--font-body);
    font-size: .78rem;
    color: #b0b8cc;
    text-align: center;
    margin-top: 14px;
    line-height: 1.5;
}
.ct-privacy i { color: #FF6A00; margin-right: 4px; }

/* ── FAQ ── */
.ct-faq {
    padding: 80px 0;
    background: #fff;
}
.ct-faq__header {
    text-align: center;
    margin-bottom: 52px;
}
.ct-faq__header h2 {
    font-family: var(--font-heading);
    font-size: clamp(1.6rem, 3vw, 2.2rem);
    font-weight: 800;
    color: #0B1E3F;
    margin-bottom: 10px;
}
.ct-faq__header p {
    font-family: var(--font-body);
    color: #5a6478;
    font-size: 1rem;
}
.ct-faq__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    max-width: 900px;
    margin: 0 auto;
}
.ct-faq__item {
    border: 1.5px solid #e0e4ed;
    border-radius: 14px;
    overflow: hidden;
    transition: border-color .2s;
}
.ct-faq__item.open { border-color: rgba(255,106,0,.4); }
.ct-faq__q {
    width: 100%;
    background: none;
    border: none;
    padding: 20px 22px;
    text-align: left;
    font-family: var(--font-heading);
    font-size: .95rem;
    font-weight: 700;
    color: #0B1E3F;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    line-height: 1.4;
}
.ct-faq__q i {
    flex-shrink: 0;
    color: #FF6A00;
    font-size: .8rem;
    transition: transform .3s;
}
.ct-faq__item.open .ct-faq__q i { transform: rotate(180deg); }
.ct-faq__a {
    display: none;
    padding: 0 22px 20px;
    font-family: var(--font-body);
    font-size: .9rem;
    color: #5a6478;
    line-height: 1.7;
    border-top: 1px solid #f0f2f7;
    padding-top: 14px;
}
.ct-faq__item.open .ct-faq__a { display: block; }

/* ── Bottom CTA ── */
.ct-cta {
    background: linear-gradient(135deg, #FF6A00 0%, #e85d00 100%);
    padding: 70px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.ct-cta::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(255,255,255,.07) 1px, transparent 1px);
    background-size: 28px 28px;
    pointer-events: none;
}
.ct-cta h2 {
    font-family: var(--font-heading);
    font-size: clamp(1.6rem, 3vw, 2.4rem);
    font-weight: 800;
    color: #fff;
    margin-bottom: 12px;
    line-height: 1.25;
}
.ct-cta p {
    font-family: var(--font-body);
    color: rgba(255,255,255,.85);
    font-size: 1.05rem;
    margin-bottom: 32px;
}
.ct-cta__btns {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
}
.ct-cta__btn-w {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 32px;
    background: #fff;
    color: #FF6A00;
    border-radius: 50px;
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: .95rem;
    text-decoration: none;
    box-shadow: 0 4px 20px rgba(0,0,0,.2);
    transition: transform .2s, box-shadow .2s;
}
.ct-cta__btn-w:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,0,0,.25); }
.ct-cta__btn-g {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 32px;
    background: rgba(255,255,255,.15);
    border: 2px solid rgba(255,255,255,.6);
    color: #fff;
    border-radius: 50px;
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: .95rem;
    text-decoration: none;
    transition: background .2s, transform .2s;
}
.ct-cta__btn-g:hover { background: rgba(255,255,255,.25); transform: translateY(-2px); }

/* ── Success modal ── */
.ct-modal-bg {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(11,30,63,.6);
    backdrop-filter: blur(4px);
    z-index: 9999;
    align-items: center;
    justify-content: center;
}
.ct-modal-bg.open { display: flex; }
.ct-modal {
    background: #fff;
    border-radius: 24px;
    padding: 48px 40px;
    max-width: 440px;
    width: calc(100% - 40px);
    text-align: center;
    animation: ctFadeUp .35s ease;
}
@keyframes ctFadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}
.ct-modal__icon {
    width: 72px;
    height: 72px;
    background: #d1fae5;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 22px;
}
.ct-modal__icon i { color: #059669; font-size: 2rem; }
.ct-modal h3 {
    font-family: var(--font-heading);
    font-size: 1.5rem;
    font-weight: 800;
    color: #0B1E3F;
    margin-bottom: 10px;
}
.ct-modal p {
    font-family: var(--font-body);
    font-size: .95rem;
    color: #5a6478;
    line-height: 1.6;
    margin-bottom: 28px;
}
.ct-modal__close {
    padding: 13px 40px;
    background: linear-gradient(135deg, #FF6A00, #e85d00);
    color: #fff;
    border: none;
    border-radius: 50px;
    font-family: var(--font-heading);
    font-size: .95rem;
    font-weight: 700;
    cursor: pointer;
    transition: transform .2s, box-shadow .2s;
    box-shadow: 0 4px 14px rgba(255,106,0,.35);
}
.ct-modal__close:hover { transform: translateY(-2px); box-shadow: 0 8px 22px rgba(255,106,0,.45); }

/* ── Responsive ── */
@media (max-width: 1024px) {
    .ct-grid { grid-template-columns: 1fr; gap: 36px; }
    .ct-info { position: static; }
    .ct-info__card, .ct-next { padding: 28px; }
    .ct-faq__grid { grid-template-columns: 1fr; }
}
@media (max-width: 768px) {
    .ct-hero { padding: 90px 0 60px; }
    .ct-body { padding: 50px 0 40px; }
    .ct-form-wrap { padding: 28px 22px; }
    .ct-form-row { grid-template-columns: 1fr; gap: 0; }
    .ct-faq { padding: 50px 0; }
    .ct-cta { padding: 50px 0; }
}
@media (max-width: 480px) {
    .ct-form-wrap h2 { font-size: 1.3rem; }
    .ct-detail__icon { width: 36px; height: 36px; font-size: .85rem; }
    .ct-social a { width: 36px; height: 36px; }
    .ct-cta__btns { flex-direction: column; align-items: center; }
}
</style>

<!-- Hero -->
<section class="ct-hero">
    <div class="ct-hero__dots"></div>
    <div class="container" style="position:relative; z-index:2;">
        <div class="ct-hero__tag"><i class="fas fa-comments"></i> Start the Conversation</div>
        <h1>Let's Begin Your<br><em>Transformation</em></h1>
        <p>One message is all it takes. Tell us where you are — we'll show you the path forward.</p>
    </div>
</section>

<!-- Body: info + form -->
<section class="ct-body">
    <div class="container">
        <div class="ct-grid">

            <!-- Left: info + next steps -->
            <div class="ct-info">
                <div class="ct-info__card">
                    <div class="ct-info__title"><i class="fas fa-location-dot"></i> Reach Us Directly</div>

                    <div class="ct-detail">
                        <div class="ct-detail__icon"><i class="fas fa-envelope"></i></div>
                        <div class="ct-detail__text">
                            <strong>Email</strong>
                            <span><a href="mailto:mindapp69@gmail.com">mindapp69@gmail.com</a></span>
                        </div>
                    </div>

                    <div class="ct-detail">
                        <div class="ct-detail__icon"><i class="fas fa-phone"></i></div>
                        <div class="ct-detail__text">
                            <strong>Phone / WhatsApp</strong>
                            <span><a href="tel:+9779856029135">+977 985-6029135</a></span>
                        </div>
                    </div>

                    <div class="ct-detail">
                        <div class="ct-detail__icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="ct-detail__text">
                            <strong>Location</strong>
                            <span>Kathmandu, Nepal</span>
                        </div>
                    </div>

                    <div class="ct-detail">
                        <div class="ct-detail__icon"><i class="fas fa-clock"></i></div>
                        <div class="ct-detail__text">
                            <strong>Response Time</strong>
                            <span>Within 24 hours (Mon–Sat)</span>
                        </div>
                    </div>

                    <div class="ct-social">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="https://wa.me/9779856029135" aria-label="WhatsApp" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <!-- What happens next -->
                <div class="ct-next">
                    <div class="ct-next__title"><i class="fas fa-route"></i> What Happens Next</div>

                    <div class="ct-step">
                        <div class="ct-step__num">1</div>
                        <div class="ct-step__text">
                            <strong>We receive your message</strong>
                            You'll get an instant confirmation, and our team reviews your enquiry.
                        </div>
                    </div>

                    <div class="ct-step">
                        <div class="ct-step__num">2</div>
                        <div class="ct-step__text">
                            <strong>We call or WhatsApp you</strong>
                            Within 24 hours, Chhabi's team will reach out to understand your goals.
                        </div>
                    </div>

                    <div class="ct-step">
                        <div class="ct-step__num">3</div>
                        <div class="ct-step__text">
                            <strong>Free discovery session</strong>
                            We match you to the right program — no pressure, no commitment.
                        </div>
                    </div>
                </div>
            </div><!-- /ct-info -->

            <!-- Right: form -->
            <div class="ct-form-wrap">
                <h2>Send Us a Message</h2>
                <p>Fill in the form and we'll get back to you with the perfect next step for your journey.</p>

                <?php if ($error): ?>
                <div class="ct-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
                <?php endif; ?>

                <form id="contactForm" method="POST" action="">
                    <div class="ct-form-row">
                        <div class="ct-field">
                            <label for="name">Full Name <span>*</span></label>
                            <input type="text" id="name" name="name" placeholder="Your name"
                                   value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
                        </div>
                        <div class="ct-field">
                            <label for="email">Email Address <span>*</span></label>
                            <input type="email" id="email" name="email" placeholder="you@email.com"
                                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="ct-form-row">
                        <div class="ct-field">
                            <label for="phone">Phone / WhatsApp</label>
                            <input type="tel" id="phone" name="phone" placeholder="+977 9800000000"
                                   value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                        </div>
                        <div class="ct-field">
                            <label for="interest">Interested In</label>
                            <select id="interest" name="interest">
                                <option value="" <?= empty($_POST['interest']) ? 'selected' : '' ?>>— Select a program —</option>
                                <option value="NLP Master Practitioner"           <?= (($_POST['interest'] ?? '') === 'NLP Master Practitioner') ? 'selected' : '' ?>>NLP Master Practitioner</option>
                                <option value="Train The Trainer (TTT)"           <?= (($_POST['interest'] ?? '') === 'Train The Trainer (TTT)') ? 'selected' : '' ?>>Train The Trainer (TTT)</option>
                                <option value="Student Memory Mastery"            <?= (($_POST['interest'] ?? '') === 'Student Memory Mastery') ? 'selected' : '' ?>>Student Memory Mastery</option>
                                <option value="1-on-1 Coaching"                   <?= (($_POST['interest'] ?? '') === '1-on-1 Coaching') ? 'selected' : '' ?>>1-on-1 Coaching</option>
                                <option value="Online / Audio Bundle"             <?= (($_POST['interest'] ?? '') === 'Online / Audio Bundle') ? 'selected' : '' ?>>Online / Audio Bundle</option>
                                <option value="General Inquiry"                   <?= (($_POST['interest'] ?? '') === 'General Inquiry') ? 'selected' : '' ?>>General Inquiry</option>
                            </select>
                        </div>
                    </div>

                    <div class="ct-field">
                        <label for="message">Your Message <span>*</span></label>
                        <textarea id="message" name="message" placeholder="Tell us what you're struggling with, what you want to change, or any question you have…" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                    </div>

                    <button type="submit" class="ct-submit">
                        <i class="fas fa-paper-plane"></i> Send My Message
                    </button>
                    <p class="ct-privacy"><i class="fas fa-lock"></i> 100% private. We never share your details. No spam, ever.</p>
                </form>
            </div><!-- /ct-form-wrap -->

        </div><!-- /ct-grid -->
    </div>
</section>

<!-- FAQ -->
<section class="ct-faq">
    <div class="container">
        <div class="ct-faq__header">
            <h2>Common Questions</h2>
            <p>Still unsure? These answers help most people take the first step.</p>
        </div>
        <div class="ct-faq__grid">

            <div class="ct-faq__item">
                <button class="ct-faq__q" onclick="toggleFaq(this)">
                    Do I need any prior experience in NLP?
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="ct-faq__a">
                    Not at all. Our programs are designed to work for complete beginners as well as experienced coaches. Chhabi's teaching style is practical and story-driven — you absorb it, you don't just study it.
                </div>
            </div>

            <div class="ct-faq__item">
                <button class="ct-faq__q" onclick="toggleFaq(this)">
                    How long before I see results?
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="ct-faq__a">
                    Most participants report noticeable shifts during the very first session — in the way they think, respond to stress, and communicate. Deep, lasting change typically solidifies within the first 3–4 weeks.
                </div>
            </div>

            <div class="ct-faq__item">
                <button class="ct-faq__q" onclick="toggleFaq(this)">
                    Are the programs available online?
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="ct-faq__a">
                    Yes. We offer live in-person workshops, residential retreats, and online/audio bundles. The form above has an "Interested In" field — select your preference and we'll recommend the best option for you.
                </div>
            </div>

            <div class="ct-faq__item">
                <button class="ct-faq__q" onclick="toggleFaq(this)">
                    What is the investment for these programs?
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="ct-faq__a">
                    Pricing varies by program and format. Send us a message and we'll send you the full breakdown — including any early-bird offers or payment plans that may be available right now.
                </div>
            </div>

            <div class="ct-faq__item">
                <button class="ct-faq__q" onclick="toggleFaq(this)">
                    Can I get a free consultation first?
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="ct-faq__a">
                    Absolutely. We offer a free 20-minute discovery call to understand your situation and recommend the right program. Just send us a message — mention "discovery call" and we'll set it up.
                </div>
            </div>

            <div class="ct-faq__item">
                <button class="ct-faq__q" onclick="toggleFaq(this)">
                    Is this suitable for corporate teams?
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="ct-faq__a">
                    Yes. Chhabi has trained corporate teams across Nepal in leadership, communication, and mental performance. Reach out with your team size and goals — we'll build a custom program for you.
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Bottom CTA -->
<section class="ct-cta">
    <div class="container" style="position:relative; z-index:2;">
        <h2>Your Mind Is Capable of Far More.<br>Let's Prove It.</h2>
        <p>A single conversation with us can change the direction of your life.</p>
        <div class="ct-cta__btns">
            <a href="#contactForm" class="ct-cta__btn-w" onclick="document.getElementById('name').focus()">
                <i class="fas fa-paper-plane"></i> Send a Message
            </a>
            <a href="https://wa.me/9779856029135" class="ct-cta__btn-g" target="_blank" rel="noopener">
                <i class="fab fa-whatsapp"></i> WhatsApp Us Now
            </a>
        </div>
    </div>
</section>

<!-- Success modal -->
<div id="successModal" class="ct-modal-bg">
    <div class="ct-modal">
        <div class="ct-modal__icon"><i class="fas fa-check"></i></div>
        <h3>Message Sent!</h3>
        <p>Thank you for reaching out, <strong id="senderName"></strong>. We'll get back to you within 24 hours — check WhatsApp too!</p>
        <button class="ct-modal__close" onclick="closeSuccessModal()">Got it — Thanks!</button>
    </div>
</div>

<script>
/* FAQ accordion */
function toggleFaq(btn) {
    var item = btn.closest('.ct-faq__item');
    var isOpen = item.classList.contains('open');
    document.querySelectorAll('.ct-faq__item.open').forEach(function(el) { el.classList.remove('open'); });
    if (!isOpen) item.classList.add('open');
}

/* Success modal */
function closeSuccessModal() {
    document.getElementById('successModal').classList.remove('open');
}
document.getElementById('successModal').addEventListener('click', function(e) {
    if (e.target === this) closeSuccessModal();
});

<?php if ($success): ?>
window.addEventListener('load', function() {
    var name = <?= json_encode(htmlspecialchars($_POST['name'] ?? '')) ?>;
    document.getElementById('senderName').textContent = name;
    document.getElementById('successModal').classList.add('open');
    document.getElementById('contactForm').reset();
});
<?php endif; ?>

/* Scroll-reveal */
(function() {
    var els = document.querySelectorAll('.ct-info__card, .ct-next, .ct-form-wrap, .ct-faq__item');
    if (!('IntersectionObserver' in window)) { els.forEach(function(e){ e.style.opacity=1; }); return; }
    var obs = new IntersectionObserver(function(entries) {
        entries.forEach(function(en) {
            if (en.isIntersecting) {
                en.target.style.opacity = '1';
                en.target.style.transform = 'translateY(0)';
                obs.unobserve(en.target);
            }
        });
    }, { threshold: 0.1 });
    els.forEach(function(el) {
        el.style.cssText += 'opacity:0;transform:translateY(20px);transition:opacity .5s ease,transform .5s ease;';
        obs.observe(el);
    });
})();
</script>

<?php include 'includes/footer.php'; ?>
