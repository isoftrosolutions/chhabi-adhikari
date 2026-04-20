<?php include 'includes/header.php'; ?>

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
        <p>Articles on NLP, personal growth, leadership, and business mastery by Dr. Chhabi Adhikari.</p>
    </div>
</section>

<!-- Category Filter -->
<div class="blog-filters">
    <div class="container">
        <div class="filter-tabs">
            <button class="filter-tab active" data-filter="all">All Posts</button>
            <button class="filter-tab" data-filter="nlp">NLP</button>
            <button class="filter-tab" data-filter="business">Business</button>
            <button class="filter-tab" data-filter="selfhelp">Self Help</button>
            <button class="filter-tab" data-filter="leadership">Leadership</button>
            <button class="filter-tab" data-filter="money">Money Mastery</button>
            <button class="filter-tab" data-filter="mindset">Mindset</button>
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
                <article class="featured-post">
                    <div class="featured-image img-grad-2">
                        <div class="post-bg-div"><i class="fas fa-brain"></i></div>
                        <span class="featured-badge"><i class="fas fa-star"></i> Featured</span>
                    </div>
                    <div class="featured-content">
                        <span class="post-category-tag"><i class="fas fa-tag"></i> NLP</span>
                        <h2>The Power of NLP: Rewire Your Mind for Extraordinary Results</h2>
                        <div class="post-meta-row">
                            <span><i class="fas fa-user"></i> Dr. Chhabi Adhikari</span>
                            <span><i class="fas fa-calendar"></i> April 15, 2026</span>
                            <span><i class="fas fa-clock"></i> 8 min read</span>
                        </div>
                        <p>Neuro-Linguistic Programming is not just a technique — it is a complete system for understanding how your brain creates your reality. Discover how NLP can help you break old patterns and install empowering beliefs.</p>
                        <a href="#" class="read-more-btn">Read Full Article <i class="fas fa-arrow-right"></i></a>
                    </div>
                </article>

                <!-- Blog Cards Grid -->
                <div class="blog-cards-grid">

                    <article class="blog-post-card" data-category="business">
                        <div class="card-image img-grad-1">
                            <div class="post-bg-div"><i class="fas fa-chart-line"></i></div>
                            <span class="card-cat-badge cat-business">Business</span>
                        </div>
                        <div class="card-body">
                            <h3>7 Secrets to Grow Your Business Beyond Limits</h3>
                            <p>Your being a businessperson opens unlimited opportunities. Discover the proven secrets to scaling up your business using the power of your subconscious mind.</p>
                            <div class="card-footer-row">
                                <span><i class="fas fa-calendar" style="color:var(--primary);margin-right:4px;"></i> Apr 10, 2026</span>
                                <a href="#">Read More <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </article>

                    <article class="blog-post-card" data-category="selfhelp">
                        <div class="card-image img-grad-3">
                            <div class="post-bg-div"><i class="fas fa-eye"></i></div>
                            <span class="card-cat-badge cat-selfhelp">Self Help</span>
                        </div>
                        <div class="card-body">
                            <h3>Whatever You Focus Upon Expands</h3>
                            <p>It is a simple rule of our subconscious mind. Learn how to direct your focus intentionally and watch every area of your life transform with positive momentum.</p>
                            <div class="card-footer-row">
                                <span><i class="fas fa-calendar" style="color:var(--primary);margin-right:4px;"></i> Apr 5, 2026</span>
                                <a href="#">Read More <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </article>

                    <article class="blog-post-card" data-category="leadership">
                        <div class="card-image img-grad-4">
                            <div class="post-bg-div"><i class="fas fa-users"></i></div>
                            <span class="card-cat-badge cat-leadership">Leadership</span>
                        </div>
                        <div class="card-body">
                            <h3>Handling People in Business: The Art of Influence</h3>
                            <p>Enhance productivity by mastering the art of motivation and team management. Learn NLP-based strategies to inspire your team and lead with confidence.</p>
                            <div class="card-footer-row">
                                <span><i class="fas fa-calendar" style="color:var(--primary);margin-right:4px;"></i> Mar 28, 2026</span>
                                <a href="#">Read More <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </article>

                    <article class="blog-post-card" data-category="money">
                        <div class="card-image img-grad-5">
                            <div class="post-bg-div"><i class="fas fa-coins"></i></div>
                            <span class="card-cat-badge cat-money">Money Mastery</span>
                        </div>
                        <div class="card-body">
                            <h3>Reprogram Your Wealth: The Money Mindset Shift</h3>
                            <p>Most financial struggles are not about money — they are about your beliefs about money. Learn how to identify and dissolve your limiting beliefs around wealth and abundance.</p>
                            <div class="card-footer-row">
                                <span><i class="fas fa-calendar" style="color:var(--primary);margin-right:4px;"></i> Mar 20, 2026</span>
                                <a href="#">Read More <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </article>

                    <article class="blog-post-card" data-category="mindset">
                        <div class="card-image img-grad-6">
                            <div class="post-bg-div"><i class="fas fa-lightbulb"></i></div>
                            <span class="card-cat-badge cat-mindset">Mindset</span>
                        </div>
                        <div class="card-body">
                            <h3>The 5-Minute Morning Ritual That Changes Everything</h3>
                            <p>How you start your morning sets the tone for your entire day. Discover a simple yet powerful 5-minute ritual that top performers use to prime their mindset for success.</p>
                            <div class="card-footer-row">
                                <span><i class="fas fa-calendar" style="color:var(--primary);margin-right:4px;"></i> Mar 12, 2026</span>
                                <a href="#">Read More <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </article>

                    <article class="blog-post-card" data-category="nlp">
                        <div class="card-image img-grad-1">
                            <div class="post-bg-div"><i class="fas fa-comments"></i></div>
                            <span class="card-cat-badge cat-nlp">NLP</span>
                        </div>
                        <div class="card-body">
                            <h3>Anchoring: Use NLP to Instantly Access Your Best State</h3>
                            <p>Anchoring is one of NLP's most powerful tools. Learn how to create a personal anchor that instantly brings you to a state of peak confidence, calm, or focus whenever you need it.</p>
                            <div class="card-footer-row">
                                <span><i class="fas fa-calendar" style="color:var(--primary);margin-right:4px;"></i> Mar 5, 2026</span>
                                <a href="#">Read More <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </article>

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
                    <div class="recent-post-item">
                        <div class="recent-post-thumb img-grad-2" style="border-radius:10px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.7);font-size:1.2rem;">
                            <i class="fas fa-brain"></i>
                        </div>
                        <div class="recent-post-info">
                            <h5>The Power of NLP: Rewire Your Mind</h5>
                            <span>April 15, 2026</span>
                        </div>
                    </div>
                    <div class="recent-post-item">
                        <div class="recent-post-thumb img-grad-1" style="border-radius:10px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.7);font-size:1.2rem;">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="recent-post-info">
                            <h5>7 Secrets to Grow Your Business</h5>
                            <span>April 10, 2026</span>
                        </div>
                    </div>
                    <div class="recent-post-item">
                        <div class="recent-post-thumb img-grad-3" style="border-radius:10px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.7);font-size:1.2rem;">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="recent-post-info">
                            <h5>Whatever You Focus Upon Expands</h5>
                            <span>April 5, 2026</span>
                        </div>
                    </div>
                    <div class="recent-post-item">
                        <div class="recent-post-thumb img-grad-5" style="border-radius:10px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.7);font-size:1.2rem;">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div class="recent-post-info">
                            <h5>Reprogram Your Wealth Mindset</h5>
                            <span>March 20, 2026</span>
                        </div>
                    </div>
                </div>

                <!-- Categories -->
                <div class="sidebar-widget">
                    <h4>Categories</h4>
                    <ul class="category-list">
                        <li><a href="#">NLP</a> <span class="cat-count">12</span></li>
                        <li><a href="#">Business</a> <span class="cat-count">9</span></li>
                        <li><a href="#">Self Help</a> <span class="cat-count">15</span></li>
                        <li><a href="#">Leadership</a> <span class="cat-count">7</span></li>
                        <li><a href="#">Money Mastery</a> <span class="cat-count">5</span></li>
                        <li><a href="#">Mindset</a> <span class="cat-count">11</span></li>
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
                    <p>Get Dr. Chhabi's latest insights delivered straight to your inbox.</p>
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
