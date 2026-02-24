<?php require_once __DIR__ . '/includes/header.php'; ?>

<section style="padding: 120px 0 80px; background: radial-gradient(ellipse at 50% 0%, rgba(212,175,55,0.06) 0%, transparent 60%);">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 animate-on-scroll">
                <div class="section-title">ABOUT US</div>
                <h2 class="section-heading">
                    The Fitness <span class="gradient-text">Empire</span>
                </h2>
                <p class="text-muted mb-4" style="line-height:1.9;">
                    Welcome to <strong class="text-gold">The Fitness Empire</strong> — the premier gym in 
                    <strong>Charnal, Sehore</strong>. Founded by <strong class="text-gold">Pravesh Gour</strong>, 
                    we are committed to transforming lives through fitness.
                </p>
                <p class="text-muted mb-4" style="line-height:1.9;">
                    Established in <strong class="text-gold">September 2024</strong>, The Fitness Empire
                    opened its doors to bring professional-grade training to the community of Charnal, Sehore.
                    With state-of-the-art equipment and expert guidance, we're here to help you hit your goals.
                </p>
                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="card p-3 text-center">
                            <div class="stat-number" style="font-size:2rem;">2024</div>
                            <small class="text-muted">Established</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card p-3 text-center">
                            <div class="stat-number" style="font-size:2rem;">500+</div>
                            <small class="text-muted">Happy Members</small>
                        </div>
                    </div>
                </div>
                <a href="membership.php" class="btn btn-gold">
                    <i class="fas fa-crown me-2"></i> JOIN THE EMPIRE
                </a>
            </div>
            <div class="col-lg-6 animate-on-scroll" style="transition-delay:0.2s;">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=800&q=80" 
                         alt="The Fitness Empire Gym" 
                         class="img-fluid rounded-4" 
                         style="border:1px solid rgba(212,175,55,0.15); box-shadow: 0 20px 60px rgba(0,0,0,0.4);">
                    <div style="position:absolute;bottom:-20px;right:-20px;background:var(--accent-gradient);padding:20px 30px;border-radius:16px;box-shadow:0 10px 30px rgba(212,175,55,0.3);">
                        <span style="font-size:1.5rem;font-weight:900;color:#000;font-family:'Space Grotesk',sans-serif;">EST. 2024</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values -->
<section class="py-5" style="padding:80px 0 !important;background:var(--bg-warm);position:relative;">
    <div style="position:absolute;top:0;left:0;right:0;height:1px;background:var(--card-border);"></div>
    <div class="container">
        <div class="text-center mb-5 animate-on-scroll">
            <div class="section-title">OUR VALUES</div>
            <h2 class="section-heading">What Makes Us <span class="gradient-text">Different</span></h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4 animate-on-scroll" style="transition-delay:0.1s;">
                <div class="card p-4 text-center h-100">
                    <div class="feature-icon mx-auto mb-3"><i class="fas fa-heart"></i></div>
                    <h5 class="fw-bold mb-2">Passion First</h5>
                    <p class="text-muted small mb-0">We live and breathe fitness. Our trainers bring genuine passion to every session.</p>
                </div>
            </div>
            <div class="col-md-4 animate-on-scroll" style="transition-delay:0.2s;">
                <div class="card p-4 text-center h-100">
                    <div class="feature-icon mx-auto mb-3"><i class="fas fa-handshake"></i></div>
                    <h5 class="fw-bold mb-2">Community</h5>
                    <p class="text-muted small mb-0">More than a gym — we're a family. Support each other, grow together.</p>
                </div>
            </div>
            <div class="col-md-4 animate-on-scroll" style="transition-delay:0.3s;">
                <div class="card p-4 text-center h-100">
                    <div class="feature-icon mx-auto mb-3"><i class="fas fa-trophy"></i></div>
                    <h5 class="fw-bold mb-2">Results Driven</h5>
                    <p class="text-muted small mb-0">We measure success by your transformation. Real results, guaranteed.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
