<?php
$pageTitle = 'Insights & Inspiration Blog';
$pageSchema = '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Blog",
  "name": "Insights & Inspiration - D-school Blog",
  "description": "Read the latest articles on NLP, personal growth, leadership, and business mastery by Chhabi Adhikari."
}
</script>';
include 'includes/header.php';
$pdo = getDB();
$stmt = $pdo->query("SELECT category, COUNT(*) as count FROM blog_posts WHERE is_published = 1 GROUP BY category ORDER BY count DESC LIMIT 10");
$categories = $stmt->fetchAll();

$stmt = $pdo->query("SELECT * FROM blog_posts WHERE is_published = 1 ORDER BY published_at DESC LIMIT 4");
$recent_posts = $stmt->fetchAll();

$stmt = $pdo->query("SELECT * FROM blog_posts WHERE is_published = 1 ORDER BY published_at DESC");
$posts = $stmt->fetchAll();
$featured_post = !empty($posts) ? array_shift($posts) : null;
?>

<style>
    .blog-hero {
        background: linear-gradient(135deg, var(--secondary) 0%, #1a3a6a 100%);
        padding: 80px 0 60px;
        text-align: center;
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    .blog-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 70% 50%, rgba(245,166,35,0.15) 0%, transparent 60%);
        pointer-events: none;
    }
    .blog-hero h1 {
        font-size: clamp(2rem, 5vw, 3rem);
        margin-bottom: 15px;
        color: #fff;
    }
    .blog-hero p {
        font-size: 1.1rem;
        opacity: 0.85;
        max-width: 600px;
        margin: 0 auto;
    }
    .breadcrumb {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-bottom: 20px;
        font-size: 0.85rem;
        opacity: 0.7;
    }
    .breadcrumb a { color: var(--primary); }
    .breadcrumb span { color: rgba(255,255,255,0.5); }

    /* Filter Tabs */
    .blog-filters {
        background: #fff;
        border-bottom: 1px solid var(--border-color);
        position: sticky;
        top: 80px;
        z-index: 100;
        box-shadow: var(--shadow-sm);
    }
    .filter-tabs {
        display: flex;
        gap: 0;
        overflow-x: auto;
        scrollbar-width: none;
        justify-content: center;
    }
    .filter-tabs::-webkit-scrollbar { display: none; }
    .filter-tab {
        padding: 18px 24px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-grey);
        cursor: pointer;
        border: none;
        background: none;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
        white-space: nowrap;
    }
    .filter-tab:hover { color: var(--primary); }
    .filter-tab.active {
        color: var(--primary);
        border-bottom-color: var(--primary);
    }

    /* Blog Main Layout */
    .blog-main {
        padding: 70px 0 100px;
        background: var(--bg-section);
    }
    .blog-layout {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 50px;
        align-items: start;
    }

    /* Featured Post */
    .featured-post {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        margin-bottom: 40px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        transition: var(--transition);
    }
    .featured-post:hover { transform: translateY(-5px); box-shadow: var(--shadow-lg); }
    .featured-image {
        position: relative;
        overflow: hidden;
        min-height: 300px;
    }
    .featured-image .post-bg {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .featured-post:hover .post-bg { transform: scale(1.05); }
    .featured-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: var(--primary);
        color: #fff;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(245,166,35,0.4);
    }
    .featured-content {
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .post-category-tag {
        display: inline-block;
        color: var(--primary);
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }
    .featured-content h2 {
        font-size: 1.6rem;
        color: var(--secondary);
        text-align: left;
        text-transform: none;
        margin-bottom: 15px;
        line-height: 1.3;
    }
    .featured-content p {
        color: var(--text-grey);
        line-height: 1.7;
        margin-bottom: 25px;
        font-size: 0.95rem;
    }
    .post-meta-row {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 20px;
        font-size: 0.82rem;
        color: var(--text-grey);
    }
    .post-meta-row i { color: var(--primary); margin-right: 4px; }
    .read-more-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        font-weight: 700;
        font-size: 0.9rem;
        transition: var(--transition);
    }
    .read-more-btn:hover { gap: 12px; color: var(--primary-dark); }

    /* Blog Cards Grid */
    .blog-cards-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }
    .blog-post-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }
    .blog-post-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); }
    .card-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    .card-image .post-bg {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .blog-post-card:hover .card-image .post-bg { transform: scale(1.08); }
    .card-cat-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #fff;
    }
    .cat-nlp      { background: #7c3aed; }
    .cat-business { background: var(--primary); }
    .cat-selfhelp { background: #059669; }
    .cat-leadership { background: var(--secondary); }
    .cat-money    { background: #dc2626; }
    .cat-mindset  { background: #0891b2; }

    .card-body { padding: 25px; }
    .card-body h3 {
        font-size: 1.1rem;
        color: var(--secondary);
        margin-bottom: 10px;
        line-height: 1.4;
    }
    .card-body p {
        font-size: 0.88rem;
        color: var(--text-grey);
        line-height: 1.6;
        margin-bottom: 18px;
    }
    .card-footer-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.8rem;
        color: var(--text-grey);
        border-top: 1px solid #f1f5f9;
        padding-top: 15px;
    }
    .card-footer-row a {
        color: var(--primary);
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: var(--transition);
    }
    .card-footer-row a:hover { gap: 8px; color: var(--primary-dark); }

    /* Sidebar */
    .blog-sidebar { position: sticky; top: 140px; }
    .sidebar-widget {
        background: #fff;
        border-radius: 16px;
        padding: 30px;
        box-shadow: var(--shadow-sm);
        margin-bottom: 30px;
    }
    .sidebar-widget h4 {
        font-size: 1rem;
        color: var(--secondary);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--primary);
    }
    .recent-post-item {
        display: flex;
        gap: 15px;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
        align-items: flex-start;
    }
    .recent-post-item:last-child { border-bottom: none; padding-bottom: 0; }
    .recent-post-thumb {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        object-fit: cover;
        flex-shrink: 0;
    }
    .recent-post-info h5 {
        font-size: 0.88rem;
        color: var(--secondary);
        margin-bottom: 5px;
        line-height: 1.3;
        font-weight: 600;
    }
    .recent-post-info span { font-size: 0.78rem; color: var(--text-grey); }
    .category-list { padding: 0; }
    .category-list li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
    }
    .category-list li:last-child { border-bottom: none; }
    .category-list a { color: var(--text-grey); transition: color 0.3s; }
    .category-list a:hover { color: var(--primary); }
    .cat-count {
        background: var(--bg-section);
        color: var(--text-grey);
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
    }
    .tags-cloud { display: flex; flex-wrap: wrap; gap: 8px; }
    .tag {
        padding: 6px 14px;
        border-radius: 20px;
        border: 1px solid var(--border-color);
        font-size: 0.8rem;
        color: var(--text-grey);
        cursor: pointer;
        transition: all 0.3s;
    }
    .tag:hover { background: var(--primary); color: #fff; border-color: var(--primary); }
    .subscribe-widget { background: linear-gradient(135deg, var(--secondary), #1a3a6a); color: #fff; }
    .subscribe-widget h4 { color: #fff; border-bottom-color: var(--primary); }
    .subscribe-widget p { font-size: 0.9rem; opacity: 0.85; margin-bottom: 18px; line-height: 1.6; }
    .subscribe-form { display: flex; flex-direction: column; gap: 12px; }
    .subscribe-form input {
        padding: 12px 16px;
        border-radius: 8px;
        border: none;
        font-size: 0.9rem;
        outline: none;
        background: rgba(255,255,255,0.1);
        color: #fff;
        border: 1px solid rgba(255,255,255,0.2);
    }
    .subscribe-form input::placeholder { color: rgba(255,255,255,0.5); }
    .subscribe-form button {
        padding: 12px;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
    }
    .subscribe-form button:hover { background: var(--primary-dark); }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-top: 50px;
    }
    .page-btn {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        background: #fff;
        color: var(--text-grey);
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        font-size: 0.9rem;
    }
    .page-btn:hover, .page-btn.active {
        background: var(--primary);
        color: #fff;
        border-color: var(--primary);
        box-shadow: 0 4px 12px rgba(245,166,35,0.3);
    }

    /* Post image placeholders using gradients */
    .img-grad-1 { background: linear-gradient(135deg, #1a2f5a, #3b5998); }
    .img-grad-2 { background: linear-gradient(135deg, #F5A623, #E87722); }
    .img-grad-3 { background: linear-gradient(135deg, #059669, #047857); }
    .img-grad-4 { background: linear-gradient(135deg, #7c3aed, #5b21b6); }
    .img-grad-5 { background: linear-gradient(135deg, #dc2626, #b91c1c); }
    .img-grad-6 { background: linear-gradient(135deg, #0891b2, #0e7490); }
    .post-bg-div {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: rgba(255,255,255,0.6);
    }

    @media (max-width: 1024px) {
        .blog-layout { grid-template-columns: 1fr; }
        .blog-sidebar { position: static; }
    }
    @media (max-width: 768px) {
        .featured-post { grid-template-columns: 1fr; }
        .featured-image { min-height: 220px; }
        .blog-cards-grid { grid-template-columns: 1fr; }
    }
</style>

<!-- Blog Hero -->
<section class="blog-hero">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>/</span>
            <span>News &amp; Blog</span>
        </div>
        <h1>Insights &amp; Inspiration</h1>
        <p>Articles on NLP, personal growth, leadership, and business mastery by Chhabi Adhikari.</p>
    </div>
</section>

<!-- Category Filter -->
<div class="blog-filters">
    <div class="container">
        <div class="filter-tabs">
            <button class="filter-tab active" data-filter="all">All Posts</button>
            <?php foreach($categories as $c): ?>
            <button class="filter-tab" data-filter="<?= slugify($c['category']) ?>"><?= h($c['category']) ?></button>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Blog Main -->
<section class="blog-main">
    <div class="container">
        <div class="blog-layout">

            <!-- Posts Column -->
            <div class="blog-posts">

                <!-- Featured Post -->
                <?php if ($featured_post): ?>
                <article class="featured-post">
                    <div class="featured-image" style="background: <?= h($featured_post['image_gradient']) ?>;">
                        <div class="post-bg-div"><i class="<?= h($featured_post['image_icon']) ?>"></i></div>
                        <span class="featured-badge"><i class="fas fa-star"></i> Featured</span>
                    </div>
                    <div class="featured-content">
                        <span class="post-category-tag"><i class="fas fa-tag"></i> <?= h($featured_post['category']) ?></span>
                        <h2><?= h($featured_post['title']) ?></h2>
                        <div class="post-meta-row">
                            <span><i class="fas fa-user"></i> <?= h($featured_post['author']) ?></span>
                            <span><i class="fas fa-calendar"></i> <?= date('F j, Y', strtotime($featured_post['published_at'])) ?></span>
                        </div>
                        <p><?= h($featured_post['excerpt']) ?></p>
                        <a href="blog-detail.php?slug=<?= urlencode($featured_post['slug']) ?>" class="read-more-btn">Read Full Article <i class="fas fa-arrow-right"></i></a>
                    </div>
                </article>
                <?php endif; ?>

                <!-- Blog Cards Grid -->
                <div class="blog-cards-grid">
                    <?php foreach ($posts as $post): ?>
                    <article class="blog-post-card" data-category="<?= slugify($post['category']) ?>">
                        <div class="card-image" style="background: <?= h($post['image_gradient']) ?>">
                            <div class="post-bg-div"><i class="<?= h($post['image_icon']) ?>"></i></div>
                            <span class="card-cat-badge"><?= h($post['category']) ?></span>
                        </div>
                        <div class="card-body">
                            <h3><?= h($post['title']) ?></h3>
                            <p><?= h($post['excerpt']) ?></p>
                            <div class="card-footer-row">
                                <span><i class="fas fa-calendar" style="color:var(--primary);margin-right:4px;"></i> <?= date('M j, Y', strtotime($post['published_at'])) ?></span>
                                <a href="blog-detail.php?slug=<?= urlencode($post['slug']) ?>">Read More <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                </div>

            </div>

            <!-- Sidebar -->
            <aside class="blog-sidebar">

                <!-- Recent Posts -->
                <div class="sidebar-widget">
                    <h4>Recent Posts</h4>
                    <?php foreach ($recent_posts as $rp): ?>
                    <div class="recent-post-item">
                        <div class="recent-post-thumb" style="background: <?= h($rp['image_gradient']) ?>; border-radius:10px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.7);font-size:1.2rem;">
                            <i class="<?= h($rp['image_icon']) ?>"></i>
                        </div>
                        <div class="recent-post-info">
                            <h5><a href="blog-detail.php?slug=<?= urlencode($rp['slug']) ?>" style="color: inherit; text-decoration: none;"><?= h($rp['title']) ?></a></h5>
                            <span><?= date('F j, Y', strtotime($rp['published_at'])) ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Categories -->
                <div class="sidebar-widget">
                    <h4>Categories</h4>
                    <ul class="category-list">
                        <?php foreach($categories as $c): ?>
                        <li><a href="#" class="sidebar-cat-link" data-cat="<?= slugify($c['category']) ?>"><?= h($c['category']) ?></a> <span class="cat-count"><?= $c['count'] ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Tags -->
                <div class="sidebar-widget">
                    <h4>Popular Tags</h4>
                    <div class="tags-cloud">
                        <span class="tag">NLP</span>
                        <span class="tag">Mindset</span>
                        <span class="tag">Success</span>
                        <span class="tag">Leadership</span>
                        <span class="tag">Wealth</span>
                        <span class="tag">Subconscious</span>
                        <span class="tag">Coaching</span>
                        <span class="tag">Nepal</span>
                        <span class="tag">Growth</span>
                        <span class="tag">Motivation</span>
                    </div>
                </div>

                <!-- Subscribe -->
                <div class="sidebar-widget subscribe-widget">
                    <h4>Stay Updated</h4>
                    <p>Get Chhabi's latest insights delivered straight to your inbox.</p>
                    <form class="subscribe-form" onsubmit="return false;">
                        <input type="email" placeholder="Your email address">
                        <button type="submit"><i class="fas fa-paper-plane"></i> Subscribe</button>
                    </form>
                </div>

            </aside>
        </div>
    </div>
</section>

<script>
    // Category filter tabs
    const filterTabs = document.querySelectorAll('.filter-tab');
    const blogCards  = document.querySelectorAll('.blog-post-card');

    filterTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            filterTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            const filter = tab.dataset.filter;
            blogCards.forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>

<?php include 'includes/footer.php'; ?>
