<?php
// Run this once to set up the database and seed data.
// Delete or restrict access after running.

$host = 'localhost'; $user = 'root'; $pass = ''; $dbname = 'dschool_cms';

try {
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `$dbname`");
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$tables = <<<SQL
CREATE TABLE IF NOT EXISTS admin_users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS settings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  setting_key VARCHAR(100) UNIQUE NOT NULL,
  setting_value TEXT
);

CREATE TABLE IF NOT EXISTS hero_slides (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(500) NOT NULL,
  subtitle TEXT,
  btn1_text VARCHAR(100),
  btn1_url VARCHAR(255),
  btn2_text VARCHAR(100),
  btn2_url VARCHAR(255),
  image_path VARCHAR(500),
  gradient VARCHAR(100) DEFAULT 'linear-gradient(155deg,#0d1b35,#1a2f5a)',
  is_active TINYINT DEFAULT 1,
  sort_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS services (
  id INT AUTO_INCREMENT PRIMARY KEY,
  icon VARCHAR(100) DEFAULT 'fas fa-star',
  title VARCHAR(255) NOT NULL,
  description TEXT,
  link_url VARCHAR(255),
  is_active TINYINT DEFAULT 1,
  sort_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS blog_posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(500) NOT NULL,
  slug VARCHAR(500) UNIQUE NOT NULL,
  category VARCHAR(100) DEFAULT 'General',
  excerpt TEXT,
  content LONGTEXT,
  image_path VARCHAR(500),
  image_gradient VARCHAR(100) DEFAULT 'linear-gradient(135deg,#1a2f5a,#3b5998)',
  image_icon VARCHAR(50) DEFAULT 'fas fa-newspaper',
  author VARCHAR(255) DEFAULT 'Chhabi Adhikari',
  is_published TINYINT DEFAULT 1,
  published_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS videos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(500) NOT NULL,
  description TEXT,
  youtube_url VARCHAR(500),
  youtube_id VARCHAR(50),
  category VARCHAR(100) DEFAULT 'NLP',
  bg_gradient VARCHAR(100) DEFAULT 'linear-gradient(135deg,#1a2f5a,#2d4a8a)',
  is_active TINYINT DEFAULT 1,
  sort_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS testimonials (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  role VARCHAR(255),
  location VARCHAR(255),
  content TEXT NOT NULL,
  rating TINYINT DEFAULT 5,
  avatar_initial CHAR(2),
  is_active TINYINT DEFAULT 1,
  sort_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS gallery (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  image_path VARCHAR(500) NOT NULL,
  alt_text VARCHAR(500),
  category VARCHAR(100) DEFAULT 'General',
  is_active TINYINT DEFAULT 1,
  sort_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS contact_messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  message TEXT NOT NULL,
  is_read TINYINT DEFAULT 0,
  replied_at TIMESTAMP NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS contact_replies (
  id INT AUTO_INCREMENT PRIMARY KEY,
  message_id INT NOT NULL,
  admin_name VARCHAR(255) DEFAULT 'D-School System',
  reply_text TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS newsletter_subscribers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) UNIQUE NOT NULL,
  name VARCHAR(255),
  is_active TINYINT DEFAULT 1,
  subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
SQL;

foreach (explode(';', $tables) as $sql) {
    $sql = trim($sql);
    if ($sql) $pdo->exec($sql);
}

// Admin user
$existing = $pdo->query("SELECT COUNT(*) FROM admin_users")->fetchColumn();
if (!$existing) {
    $hash = password_hash('admin123', PASSWORD_BCRYPT);
    $pdo->prepare("INSERT INTO admin_users (username, password_hash) VALUES (?, ?)")
        ->execute(['admin', $hash]);
}

// Default settings
$defaults = [
    'site_title'        => 'Chhabi Adhikari | D School System | NLP Training in Nepal',
    'site_description'  => 'Certified NLP Trainer and Founder of D School System. Transform your life and career with expert coaching in Nepal.',
    'site_tagline'      => "Nepal's Leading NLP Institute",
    'contact_phone'     => '+977-9800000000',
    'contact_email'     => 'info@dschoolsystem.com',
    'contact_address'   => 'Kathmandu, Nepal',
    'facebook_url'      => '#',
    'youtube_url'       => '#',
    'instagram_url'     => '#',
    'linkedin_url'      => '#',
    'footer_description'=> "Nepal's Leading Authority in Personal Transformation. Founded by Chhabi Adhikari, dedicated to helping you master your subconscious mind.",
    'stat_decades'      => '2+',
    'stat_lives'        => '1M+',
    'stat_cities'       => '20+',
    'stat_programs'     => '50+',
    'about_eyebrow'     => 'Meet the Founder',
    'about_title'       => "Chhabi Adhikari —\nNepal's Foremost NLP Authority",
    'about_text1'       => 'For more than two decades, Chhabi Adhikari has been transforming lives through Neuro-Linguistic Programming. His generative learning methodology uniquely helps participants learn, experience, and apply NLP in a simple yet profoundly effective way.',
    'about_text2'       => 'With workshops spanning Kathmandu, Pokhara, Butwal, Chitwan, and beyond — and NLP videos watched by millions — Chhabi is Nepal\'s most trusted voice in personal transformation, leadership, and the science of the subconscious mind.',
    'cta_heading'       => 'Ready to Transform Your Life?',
    'cta_subtext'       => 'Take the first step today. Join thousands of people who have already transformed their mindset, relationships, career, and health through D-School System.',
    'hero_eyebrow'      => "Nepal's Leading NLP Institute",
    'hero_title_line1'  => 'Transform Your Mind.',
    'hero_title_line2'  => 'Transform Your Life.',
    'hero_subtitle'     => 'Discover the power of Neuro-Linguistic Programming with Chhabi Adhikari — Nepal\'s most trusted NLP trainer with over two decades of transformational impact.',
    'why_title'         => 'Why D-School System?',
    'why_subtitle'      => 'The standard of excellence that sets us apart',
    'services_title'    => 'Our Transformational Programs',
    'services_subtitle' => 'Expertly designed programs to empower every area of your life',
    'testimonials_title'=> 'Success Stories',
    'blog_preview_title'=> 'Latest Insights',
    'videos_title'      => 'Watch & Learn',
    'about_image'       => 'assets/Gemini_Generated_Image_ejsw4zejsw4zejsw.png',
    'hero_image'        => 'assets/Gemini_Generated_Image_ejsw4zejsw4zejsw.png',
];

$stmt = $pdo->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?,?) ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value)");
foreach ($defaults as $k => $v) $stmt->execute([$k, $v]);

// Sample hero slides
$pdo->exec("DELETE FROM hero_slides");
$slides = [
    ['TRANSFORM YOUR MIND. TRANSFORM YOUR LIFE.', 'Discover the power of NLP with Chhabi Adhikari.', 'Explore Programs', 'courses.php', 'Watch Videos', 'videos.php', 'linear-gradient(155deg,#0d1b35 0%,#1a2f5a 45%,#0f2040 100%)', 0],
    ['MASTER YOUR SUBCONSCIOUS MIND', 'Unlock unlimited potential with NLP training in Nepal.', 'Start NLP Journey', 'nlp-practitioner.php', 'View Calendar', 'calendar.php', 'linear-gradient(155deg,#1a2f5a 0%,#2d4a8a 60%,#1a2f5a 100%)', 1],
    ['AWAKEN THE POWER WITHIN YOU', 'Join thousands who have transformed their lives with D-School System.', 'Join a Workshop', 'calendar.php', 'Our Success Stories', 'success-stories.php', 'linear-gradient(155deg,#7c3aed 0%,#1a2f5a 60%,#0d1b35 100%)', 2],
];
$s = $pdo->prepare("INSERT INTO hero_slides (title,subtitle,btn1_text,btn1_url,btn2_text,btn2_url,gradient,sort_order) VALUES (?,?,?,?,?,?,?,?)");
foreach ($slides as $sl) $s->execute($sl);

// Sample services
$pdo->exec("DELETE FROM services");
$services = [
    ['fas fa-brain',          'NLP Master Practitioner',       'The complete 5-day transformational NLP workshop. Master your subconscious mind.', 'courses.php',           1, 0],
    ['fas fa-user-tie',       'Train the Competent Life Coach','A 14-day residential workshop to become a certified professional life coach.',    'ttclc.php',             1, 1],
    ['fas fa-graduation-cap', 'NLP Practitioner',              'Your first step into the science of NLP. Reprogram limiting beliefs and create lasting change.', 'nlp-practitioner.php', 1, 2],
    ['fas fa-coins',          'Money Mastery',                 'Dissolve money blocks and reprogram a wealth mindset. Discover the psychology of abundance.', 'money.php',       1, 3],
    ['fas fa-book-open',      'Student Memory Mastery',        'Enhance concentration, memory, and exam performance. The perfect academic edge.',  'memory.php',            1, 4],
    ['fas fa-building',       'Corporate Training',            'Customised in-house programs for organisations seeking leadership excellence.',     'personal-counseling.php',1, 5],
];
$s = $pdo->prepare("INSERT INTO services (icon,title,description,link_url,is_active,sort_order) VALUES (?,?,?,?,?,?)");
foreach ($services as $sv) $s->execute($sv);

// Sample blog posts
$pdo->exec("DELETE FROM blog_posts");
$posts = [
    ['7 Secrets to Grow Your Business Beyond Limits', '7-secrets-business', 'Business', 'Discover the subconscious secrets behind scaling your business and leading with impact.', '<p>Your being a businessperson opens unlimited opportunities not only for yourself but also for countless others. Discover the 7 proven secrets to scaling up your business.</p>', 'linear-gradient(135deg,#1a2f5a,#3b5998)', 'fas fa-chart-line'],
    ['Whatever You Focus Upon Expands', 'whatever-you-focus-expands', 'Mindset', 'Learn to direct your focus intentionally and watch every area of your life transform with momentum.', '<p>Whatever you focus upon expands — it is a simple rule of our subconscious mind. It helps expand the things that we have been focusing upon, for better or worse.</p>', 'linear-gradient(135deg,#F5A623,#E87722)', 'fas fa-eye'],
    ['Handling People in Business: The Art of Influence', 'handling-people-business', 'Leadership', 'Master NLP-based influence and motivation strategies that bring out the best in every person around you.', '<p>When you wish to enhance the productivity of your organisation and increase profits, you need the support and engagement of the people working with you.</p>', 'linear-gradient(135deg,#059669,#047857)', 'fas fa-users'],
    ['The Power of NLP: Rewire Your Mind', 'power-of-nlp', 'NLP', 'NLP is a complete system for understanding how your brain creates your reality.', '<p>Neuro-Linguistic Programming is not just a technique — it is a complete system for understanding how your brain creates your reality. Discover how NLP can help you break old patterns and install empowering beliefs.</p>', 'linear-gradient(135deg,#7c3aed,#5b21b6)', 'fas fa-brain'],
    ['Reprogram Your Wealth: The Money Mindset Shift', 'money-mindset-shift', 'Money Mastery', 'Learn how to identify and dissolve your limiting beliefs around wealth and abundance.', '<p>Most financial struggles are not about money — they are about your beliefs about money. Learn how to identify and dissolve your limiting beliefs around wealth and abundance.</p>', 'linear-gradient(135deg,#dc2626,#b91c1c)', 'fas fa-coins'],
    ['The 5-Minute Morning Ritual That Changes Everything', '5-minute-morning-ritual', 'Mindset', 'Discover a simple yet powerful 5-minute ritual that top performers use to prime their mindset.', '<p>How you start your morning sets the tone for your entire day. Discover a simple yet powerful 5-minute ritual that top performers use to prime their mindset for success.</p>', 'linear-gradient(135deg,#0891b2,#0e7490)', 'fas fa-lightbulb'],
];
$s = $pdo->prepare("INSERT INTO blog_posts (title,slug,category,excerpt,content,image_gradient,image_icon) VALUES (?,?,?,?,?,?,?)");
foreach ($posts as $p) $s->execute($p);

// Sample videos
$pdo->exec("DELETE FROM videos");
$videos = [
    ['Introduction to NLP & Subconscious Mind', 'Learn the fundamentals of Neuro-Linguistic Programming and how your subconscious mind works.', '', '', 'NLP', 'linear-gradient(135deg,#1a2f5a,#2d4a8a)', 1, 0],
    ['How to Reprogram Your Money Mindset', 'Discover the NLP techniques to break through money blocks and attract financial abundance.', '', '', 'Money Mastery', 'linear-gradient(135deg,#7c3aed,#4f26b5)', 1, 1],
    ['NLP Anchoring Technique for Instant Confidence', 'Learn the powerful NLP anchoring technique to access your best state on demand.', '', '', 'NLP', 'linear-gradient(135deg,#059669,#027a50)', 1, 2],
    ['Student Memory Mastery Techniques', 'Powerful memory techniques for students to improve concentration and retention.', '', '', 'Students', 'linear-gradient(135deg,#dc2626,#b91c1c)', 1, 3],
    ['Corporate Leadership with NLP', 'How to use NLP principles to become an extraordinary leader in your organisation.', '', '', 'Leadership', 'linear-gradient(135deg,#0891b2,#0e7490)', 1, 4],
    ['The Wheel of Life — Balance Your Life with NLP', 'Chhabi explains how to achieve balance across all areas of your life using NLP.', '', '', 'Personal Growth', 'linear-gradient(135deg,#F5A623,#c85f00)', 1, 5],
];
$s = $pdo->prepare("INSERT INTO videos (title,description,youtube_url,youtube_id,category,bg_gradient,is_active,sort_order) VALUES (?,?,?,?,?,?,?,?)");
foreach ($videos as $v) $s->execute($v);

// Sample testimonials
$pdo->exec("DELETE FROM testimonials");
$testis = [
    ['Rajesh Shrestha', 'Entrepreneur', 'Kathmandu', "Chhabi's NLP workshop completely changed the way I see myself and my business. Within three months of applying what I learned, my income doubled. The subconscious reprogramming is real and it works.", 5, 'R', 1, 0],
    ['Sunita Thapa', 'Teacher & Life Coach', 'Pokhara', "I attended the NLP Master Practitioner workshop feeling stuck in life. I left with a completely new mindset. Chhabi has a gift for making complex psychology feel natural and immediately applicable.", 5, 'S', 1, 1],
    ['Priya Adhikari', 'Parent', 'Chitwan', "The Student Memory Mastery program was a game-changer for my son. His grades improved dramatically and his confidence soared. Thank you, Chhabi!", 5, 'P', 1, 2],
    ['Bikash Gurung', 'Sales Manager', 'Butwal', "After attending the Money Mastery workshop, I completely shifted my relationship with money. My sales performance improved by 200% and I finally feel in control of my financial destiny.", 5, 'B', 1, 3],
    ['Anita KC', 'Business Owner', 'Pokhara', "The TTCLC life coaching program was transformational. I'm now a certified coach helping others. Chhabi's teaching style is engaging, practical, and deeply impactful.", 5, 'A', 1, 4],
    ['Suresh Poudel', 'HR Director', 'Kathmandu', "We brought Chhabi in for corporate training and it was the best investment we made. The team's communication and performance improved dramatically within weeks.", 5, 'S', 1, 5],
];
$s = $pdo->prepare("INSERT INTO testimonials (name,role,location,content,rating,avatar_initial,is_active,sort_order) VALUES (?,?,?,?,?,?,?,?)");
foreach ($testis as $t) $s->execute($t);

// Create upload directories
foreach (['blog','videos','hero','gallery','services','general'] as $d) {
    @mkdir(__DIR__ . '/uploads/' . $d, 0755, true);
}

echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>D-School CMS Setup</title>
<style>body{font-family:sans-serif;max-width:700px;margin:50px auto;padding:20px;background:#f9f9f9;}
.card{background:#fff;padding:30px;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.08);}
h1{color:#1a2f5a;} h2{color:#F5A623;font-size:1.1rem;}
.success{background:#d1fae5;padding:12px 18px;border-radius:8px;color:#065f46;margin:10px 0;}
.info{background:#dbeafe;padding:12px 18px;border-radius:8px;color:#1e40af;margin:10px 0;}
.btn{display:inline-block;padding:12px 28px;background:#1a2f5a;color:#fff;border-radius:8px;text-decoration:none;margin:5px;font-weight:600;}
.btn-gold{background:#F5A623;color:#fff;}
</style></head><body><div class='card'>
<h1>✅ D-School CMS Setup Complete</h1>
<div class='success'>Database <strong>dschool_cms</strong> created with all tables.</div>
<div class='success'>Sample data seeded — blog posts, videos, services, testimonials, hero slides.</div>
<div class='success'>Upload directories created in <code>/uploads/</code>.</div>
<h2>Admin Login Credentials</h2>
<div class='info'><strong>URL:</strong> <a href='/admin/login.php'>/admin/login.php</a><br>
<strong>Username:</strong> admin<br><strong>Password:</strong> admin123</div>
<p><strong>⚠️ Change the admin password immediately after logging in.</strong></p>
<br>
<a href='/admin/login.php' class='btn btn-gold'>Go to Admin Panel</a>
<a href='/index.php' class='btn'>View Website</a>
</div></body></html>";
