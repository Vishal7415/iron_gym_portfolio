<?php require_once __DIR__ . '/includes/header.php'; ?>

<style>
    /* Homepage-specific enhancements */
    .hero-floating-card {
        background: rgba(255,253,248,0.12);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 16px;
        padding: 20px 28px;
        text-align: center;
        animation: float 6s ease-in-out infinite;
    }
    .hero-floating-card:nth-child(2) { animation-delay: 2s; }
    .hero-floating-card h3 { font-size: 2rem; font-weight: 900; color: #fff; margin-bottom: 4px; }
    .hero-floating-card small { color: rgba(255,255,255,0.6); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; }

    .program-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
    }
    .program-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-lighter);
    }
    .program-card .card-img-top {
        height: 200px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .program-card:hover .card-img-top { transform: scale(1.05); }
    .program-card .card-body { padding: 28px; }
    .program-tag {
        position: absolute;
        top: 16px;
        left: 16px;
        background: var(--accent-gradient);
        color: #fff;
        font-weight: 700;
        font-size: 0.7rem;
        letter-spacing: 1px;
        padding: 6px 14px;
        border-radius: 50px;
        text-transform: uppercase;
        z-index: 2;
    }

    .cta-banner {
        background: var(--accent-gradient);
        border-radius: 24px;
        padding: 60px 40px;
        position: relative;
        overflow: hidden;
    }
    .cta-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }
    .cta-banner::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .review-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 20px;
        padding: 32px;
        position: relative;
        transition: all 0.4s ease;
    }
    .review-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }
    .review-card .stars { color: #F59E0B; font-size: 0.9rem; margin-bottom: 16px; }
    .review-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: var(--accent-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 800;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .counter { font-variant-numeric: tabular-nums; }
</style>

<!-- ===== HERO SECTION ===== -->
<section class="hero-section">
    <div class="container position-relative" style="z-index:2;">
        <div class="row align-items-center">
            <div class="col-lg-7 text-center text-lg-start">
                <div class="hero-badge">
                    <i class="fas fa-trophy me-2"></i> #1 GYM IN SEHORE
                </div>
                <h1 class="hero-title">
                    UNLEASH YOUR<br>
                    <span class="gradient-text" style="-webkit-text-fill-color:transparent;background:var(--accent-gradient);-webkit-background-clip:text;background-clip:text;">INNER BEAST</span>
                </h1>
                <p class="hero-subtitle text-start" style="margin:0 0 2.5rem;">
                    Transform your body, elevate your mind. Professional training with state-of-the-art
                    equipment and expert guidance at The Fitness Empire.
                </p>
                <div class="hero-buttons d-flex gap-3 justify-content-center justify-content-lg-start flex-wrap">
                    <a href="membership.php" class="btn btn-gold btn-lg px-5 py-3">
                        <i class="fas fa-crown me-2"></i> VIEW PLANS
                    </a>
                    <a href="contact.php" class="btn btn-outline-gold btn-lg px-5 py-3">
                        <i class="fas fa-map-marker-alt me-2"></i> FIND US
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-center">
                <div class="d-flex flex-column gap-4 mt-5">
                    <div class="hero-floating-card">
                        <h3>Est.</h3>
                        <small>Sep 2024</small>
                    </div>
                    <div class="hero-floating-card">
                        <h3>500+</h3>
                        <small>Active Members</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scroll indicator -->
    <div class="position-absolute bottom-0 start-50 translate-middle-x pb-4" style="z-index:2;animation:float 3s ease-in-out infinite;">
        <div class="text-center text-white" style="opacity:0.5;">
            <small style="letter-spacing:2px;font-size:0.7rem;">SCROLL DOWN</small><br>
            <i class="fas fa-chevron-down mt-1"></i>
        </div>
    </div>
</section>

<!-- ===== STATS BAR ===== -->
<section class="stats-section" id="stats">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-3">
                <div class="stat-item animate-on-scroll">
                    <div class="stat-number">2024</div>
                    <div class="stat-label">Est. September</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item animate-on-scroll" style="transition-delay:0.1s;">
                    <div class="stat-number counter" data-target="500">500+</div>
                    <div class="stat-label">Active Members</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item animate-on-scroll" style="transition-delay:0.2s;">
                    <div class="stat-number counter" data-target="5">5+</div>
                    <div class="stat-label">Expert Trainers</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item animate-on-scroll" style="transition-delay:0.3s;">
                    <div class="stat-number counter" data-target="100">100+</div>
                    <div class="stat-label">Equipment Units</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== PROGRAMS / SERVICES ===== -->
<section style="padding: 100px 0; background: var(--bg-cream);">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-title animate-on-scroll">OUR PROGRAMS</div>
            <h2 class="section-heading animate-on-scroll">
                Train Like A <span class="gradient-text">Champion</span>
            </h2>
            <p class="text-muted animate-on-scroll" style="max-width:550px;margin:0 auto;">
                From beginner to advanced, we have the perfect program for your fitness journey.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 animate-on-scroll" style="transition-delay:0.1s;">
                <div class="program-card h-100">
                    <div class="overflow-hidden position-relative">
                        <span class="program-tag">Popular</span>
                        <img src="https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Strength Training">
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="feature-icon" style="width:36px;height:36px;border-radius:10px;font-size:0.85rem;">
                                <i class="fas fa-dumbbell"></i>
                            </div>
                            <h5 class="fw-bold mb-0" style="color:var(--text-dark);">Strength Training</h5>
                        </div>
                        <p class="text-muted small mb-3">Build muscle, increase power, and transform your physique with our comprehensive weight training program.</p>
                        <a href="membership.php" class="text-decoration-none fw-bold small" style="color:var(--primary);">
                            Learn More <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 animate-on-scroll" style="transition-delay:0.2s;">
                <div class="program-card h-100">
                    <div class="overflow-hidden position-relative">
                        <span class="program-tag">Trending</span>
                        <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Cardio & HIIT">
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="feature-icon" style="width:36px;height:36px;border-radius:10px;font-size:0.85rem;">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <h5 class="fw-bold mb-0" style="color:var(--text-dark);">Cardio & HIIT</h5>
                        </div>
                        <p class="text-muted small mb-3">High-intensity workouts designed to burn fat, boost endurance, and keep your heart healthy and strong.</p>
                        <a href="membership.php" class="text-decoration-none fw-bold small" style="color:var(--primary);">
                            Learn More <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 animate-on-scroll" style="transition-delay:0.3s;">
                <div class="program-card h-100">
                    <div class="overflow-hidden position-relative">
                        <span class="program-tag">New</span>
                        <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Personal Training">
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="feature-icon" style="width:36px;height:36px;border-radius:10px;font-size:0.85rem;">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <h5 class="fw-bold mb-0" style="color:var(--text-dark);">Personal Training</h5>
                        </div>
                        <p class="text-muted small mb-3">One-on-one coaching with certified trainers who create customized plans for your unique goals.</p>
                        <a href="membership.php" class="text-decoration-none fw-bold small" style="color:var(--primary);">
                            Learn More <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== WHY CHOOSE US ===== -->
<section style="padding: 100px 0; background: var(--bg-warm);">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 animate-on-scroll">
                <div class="section-title">WHY CHOOSE US</div>
                <h2 class="section-heading">We Don't Just Build <span class="gradient-text">Bodies</span>, We Build <span class="gradient-text">Champions</span></h2>
                <p class="text-muted mb-4" style="line-height:1.8;">
                    At The Fitness Empire, every rep counts. Our world-class trainers and premium equipment
                    create the perfect environment for your transformation journey.
                </p>
                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="d-flex align-items-start gap-3">
                            <div class="feature-icon flex-shrink-0" style="width:44px;height:44px;font-size:1rem;">
                                <i class="fas fa-dumbbell"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1" style="font-size:0.9rem;">Premium Equipment</h6>
                                <small class="text-muted">100+ latest machines</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-start gap-3">
                            <div class="feature-icon flex-shrink-0" style="width:44px;height:44px;font-size:1rem;">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1" style="font-size:0.9rem;">Expert Trainers</h6>
                                <small class="text-muted">Certified professionals</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-start gap-3">
                            <div class="feature-icon flex-shrink-0" style="width:44px;height:44px;font-size:1rem;">
                                <i class="fas fa-apple-alt"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1" style="font-size:0.9rem;">Diet Planning</h6>
                                <small class="text-muted">Custom nutrition plans</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-start gap-3">
                            <div class="feature-icon flex-shrink-0" style="width:44px;height:44px;font-size:1rem;">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1" style="font-size:0.9rem;">Hygienic Space</h6>
                                <small class="text-muted">Clean & ventilated</small>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="membership.php" class="btn btn-gold">
                    <i class="fas fa-arrow-right me-2"></i> START YOUR JOURNEY
                </a>
            </div>
            <div class="col-lg-6 animate-on-scroll" style="transition-delay:0.2s;">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=700&q=80"
                         alt="Gym Interior"
                         class="w-100 rounded-4"
                         style="border:1px solid var(--card-border);box-shadow:var(--shadow-lg);">
                    <!-- Floating badge -->
                    <div style="position:absolute;bottom:-16px;left:50%;transform:translateX(-50%);background:var(--accent-gradient);padding:14px 32px;border-radius:60px;box-shadow:var(--shadow-gold);white-space:nowrap;">
                        <span style="font-weight:800;color:#fff;font-family:'Space Grotesk',sans-serif;font-size:0.9rem;letter-spacing:1px;">
                            <i class="fas fa-star me-2"></i>ESTABLISHED SEPTEMBER 2024
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== GOLDEN CTA BANNER ===== -->
<section style="padding: 60px 0; background: var(--bg-cream);">
    <div class="container animate-on-scroll">
        <div class="cta-banner text-center text-white">
            <div class="position-relative" style="z-index:2;">
                <h2 style="font-size:clamp(1.6rem,4vw,2.5rem);font-weight:900;margin-bottom:12px;color:#fff;font-family:'Space Grotesk',sans-serif;">
                    Ready to Transform Your Body?
                </h2>
                <p style="opacity:0.85;max-width:500px;margin:0 auto 24px;font-size:1.05rem;">
                    Join 500+ members who chose The Fitness Empire for their fitness journey. Plans start at just ₹500/month.
                </p>
                <a href="membership.php" class="btn px-5 py-3 fw-bold" style="background:#fff;color:var(--primary-dark);border-radius:14px;font-size:0.95rem;box-shadow:0 8px 30px rgba(0,0,0,0.15);letter-spacing:0.5px;">
                    <i class="fas fa-bolt me-2"></i> JOIN NOW — FROM ₹500/MONTH
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ===== LEAD CAPTURE ===== -->
<section style="background: var(--bg-warm); padding: 100px 0; border-top:1px solid var(--card-border);">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 mb-4 mb-lg-0 animate-on-scroll">
                <div class="section-title">GET STARTED TODAY</div>
                <h2 class="section-heading">Start Your <span class="gradient-text">Transformation</span> Journey</h2>
                <p class="text-muted mb-4" style="line-height:1.8;">
                    Leave your details and our expert trainers will call you to discuss your fitness goals and
                    design a customized path for you. Free consultation included!
                </p>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="feature-icon flex-shrink-0" style="width:42px;height:42px;font-size:0.9rem;">
                            <i class="fas fa-check"></i>
                        </div>
                        <div>
                            <strong style="color:var(--text-dark);">Personalized Diet Chart</strong>
                            <div class="text-muted small">Custom nutrition plan based on your goals</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="feature-icon flex-shrink-0" style="width:42px;height:42px;font-size:0.9rem;">
                            <i class="fas fa-check"></i>
                        </div>
                        <div>
                            <strong style="color:var(--text-dark);">Expert Workout Guidance</strong>
                            <div class="text-muted small">One-on-one coaching from certified trainers</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="feature-icon flex-shrink-0" style="width:42px;height:42px;font-size:0.9rem;">
                            <i class="fas fa-check"></i>
                        </div>
                        <div>
                            <strong style="color:var(--text-dark);">Premium Locker Facilities</strong>
                            <div class="text-muted small">Secure storage for your belongings</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 animate-on-scroll" style="transition-delay:0.2s;">
                <div class="card p-4 p-lg-5" style="border:1px solid var(--card-border);">
                    <h4 class="fw-bold mb-1"><span class="gradient-text">Free</span> Consultation</h4>
                    <p class="text-muted small mb-4">Fill the form & our trainer will reach out within 24 hours.</p>
                    <form action="lead.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase" style="letter-spacing:1px;color:var(--text-dark);">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase" style="letter-spacing:1px;color:var(--text-dark);">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" placeholder="Enter your mobile number" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase" style="letter-spacing:1px;color:var(--text-dark);">Your Fitness Goal</label>
                            <select name="goal" class="form-select">
                                <option>🔥 Weight Loss</option>
                                <option>💪 Muscle Building</option>
                                <option>🏃 General Fitness</option>
                                <option>🧘 Flexibility & Wellness</option>
                            </select>
                        </div>
                        <button class="btn btn-gold w-100 py-3" type="submit">
                            <i class="fas fa-paper-plane me-2"></i> BOOK FREE CONSULTATION
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== TESTIMONIALS ===== -->
<section style="padding: 100px 0; background: var(--bg-cream);">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-title animate-on-scroll">TESTIMONIALS</div>
            <h2 class="section-heading animate-on-scroll">What Our Members <span class="gradient-text">Say</span></h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 animate-on-scroll" style="transition-delay:0.1s;">
                <div class="review-card h-100">
                    <div class="stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="mb-4" style="color:var(--text-body);line-height:1.8;font-style:italic;">
                        "The Fitness Empire completely changed my life. Lost 15kg in 4 months with their expert guidance. The trainers are absolutely amazing!"
                    </p>
                    <div class="d-flex align-items-center gap-3">
                        <div class="review-avatar">R</div>
                        <div>
                            <strong style="color:var(--text-dark);">Rahul Sharma</strong>
                            <div class="text-muted small">Member since 2023</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 animate-on-scroll" style="transition-delay:0.2s;">
                <div class="review-card h-100">
                    <div class="stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="mb-4" style="color:var(--text-body);line-height:1.8;font-style:italic;">
                        "Best gym in Sehore, hands down. Clean environment, latest equipment, and Pravesh bhai's personal attention makes all the difference."
                    </p>
                    <div class="d-flex align-items-center gap-3">
                        <div class="review-avatar">A</div>
                        <div>
                            <strong style="color:var(--text-dark);">Amit Patel</strong>
                            <div class="text-muted small">Member since 2022</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 animate-on-scroll" style="transition-delay:0.3s;">
                <div class="review-card h-100">
                    <div class="stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="mb-4" style="color:var(--text-body);line-height:1.8;font-style:italic;">
                        "Great atmosphere and supportive community. The diet planning service helped me gain muscle the right way. Highly recommended!"
                    </p>
                    <div class="d-flex align-items-center gap-3">
                        <div class="review-avatar">V</div>
                        <div>
                            <strong style="color:var(--text-dark);">Vikram Singh</strong>
                            <div class="text-muted small">Member since 2024</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== MAP ===== -->
<section style="background: var(--bg-warm); padding: 80px 0; border-top:1px solid var(--card-border);">
    <div class="container animate-on-scroll">
        <div class="text-center mb-5">
            <div class="section-title">LOCATION</div>
            <h2 class="section-heading">Find <span class="gradient-text">Us Here</span></h2>
        </div>
        <div class="ratio ratio-21x9 rounded-4 overflow-hidden" style="border:1px solid var(--card-border);box-shadow:var(--shadow-md);">
            <iframe src="https://www.google.com/maps?q=The+Fitness+Empire,Charnal,Sehore,Madhya+Pradesh,India&output=embed&z=15"
                style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>
</section>

<!-- WhatsApp Button -->
<a href="https://wa.me/91<?php echo GYM_PHONE; ?>" target="_blank" class="whatsapp-btn">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
