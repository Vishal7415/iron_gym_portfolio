<?php require_once __DIR__ . '/includes/header.php'; ?>

<section style="padding: 120px 0 80px; background: radial-gradient(ellipse at 50% 0%, rgba(212,175,55,0.06) 0%, transparent 60%);">
    <div class="container">
        <div class="text-center mb-5 animate-on-scroll">
            <div class="section-title">CONTACT US</div>
            <h2 class="section-heading">Get In <span class="gradient-text">Touch</span></h2>
            <p class="text-muted" style="max-width:500px;margin:0 auto;">Have questions? We'd love to hear from you. Reach out through any of the channels below.</p>
        </div>

        <div class="row g-4">
            <!-- Contact Cards -->
            <div class="col-lg-4 animate-on-scroll" style="transition-delay:0.1s;">
                <div class="card p-4 text-center h-100">
                    <div class="feature-icon mx-auto mb-3" style="width:70px;height:70px;font-size:1.5rem;">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Visit Us</h5>
                    <p class="text-muted small mb-3"><?php echo GYM_ADDRESS; ?></p>
                    <a href="https://maps.google.com?q=<?php echo urlencode(GYM_ADDRESS); ?>" target="_blank" class="btn btn-outline-gold btn-sm">
                        <i class="fas fa-directions me-1"></i> Get Directions
                    </a>
                </div>
            </div>
            <div class="col-lg-4 animate-on-scroll" style="transition-delay:0.2s;">
                <div class="card p-4 text-center h-100">
                    <div class="feature-icon mx-auto mb-3" style="width:70px;height:70px;font-size:1.5rem;">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Call Us</h5>
                    <p class="text-muted small mb-3"><?php echo GYM_PHONE; ?></p>
                    <a href="tel:<?php echo GYM_PHONE; ?>" class="btn btn-outline-gold btn-sm">
                        <i class="fas fa-phone me-1"></i> Call Now
                    </a>
                </div>
            </div>
            <div class="col-lg-4 animate-on-scroll" style="transition-delay:0.3s;">
                <div class="card p-4 text-center h-100">
                    <div class="feature-icon mx-auto mb-3" style="width:70px;height:70px;font-size:1.5rem;">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Working Hours</h5>
                    <p class="text-muted small mb-1">Mon–Sat: 6:00 AM – 10:00 AM &amp; 4:00 PM – 10:00 PM</p>
                    <p class="text-muted small mb-0">Sunday: Closed</p>
                </div>
            </div>
        </div>

        <!-- Social & CTA -->
        <div class="row mt-5">
            <div class="col-lg-8 mx-auto">
                <div class="card p-4 p-lg-5 text-center animate-on-scroll" style="border:1px solid rgba(212,175,55,0.15);">
                    <h4 class="fw-bold mb-2">Connect <span class="gradient-text">With Us</span></h4>
                    <p class="text-muted small mb-4">Follow us on social media for daily motivation, tips, and updates.</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap mb-4">
                        <a href="https://www.instagram.com/<?php echo GYM_INSTAGRAM; ?>" target="_blank"
                           class="btn btn-outline-gold px-4 py-3">
                            <i class="fab fa-instagram fa-lg me-2"></i> Instagram
                        </a>
                        <a href="https://wa.me/91<?php echo GYM_PHONE; ?>" target="_blank"
                           class="btn py-3 px-4 fw-bold" style="background:linear-gradient(135deg,#25d366,#128C7E);color:#fff;border-radius:50px;">
                            <i class="fab fa-whatsapp fa-lg me-2"></i> WhatsApp
                        </a>
                        <a href="tel:<?php echo GYM_PHONE; ?>"
                           class="btn btn-gold px-4 py-3">
                            <i class="fas fa-phone me-2"></i> Call Us
                        </a>
                    </div>
                    <div style="height:1px;background:linear-gradient(90deg,transparent,rgba(212,175,55,0.2),transparent);margin:20px 0;"></div>
                    <p class="text-muted small mb-0">
                        <i class="fas fa-star text-gold me-1"></i> 
                        Love our gym? <a href="https://g.co/kgs/review" target="_blank" class="text-gold text-decoration-none">Leave us a review on Google!</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="mt-5 animate-on-scroll">
            <div class="ratio ratio-21x9 rounded-4 overflow-hidden" style="border:1px solid rgba(212,175,55,0.15);">
                <iframe src="https://www.google.com/maps?q=The+Fitness+Empire,Charnal,Sehore,Madhya+Pradesh,India&output=embed&z=15" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
