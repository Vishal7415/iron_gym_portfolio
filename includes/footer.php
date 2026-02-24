<?php
if (defined('FOOTER_INCLUDED')) return;
define('FOOTER_INCLUDED', true);
?>
<footer class="footer mt-auto">
    <div class="container position-relative">
        <div class="row g-4 mb-5">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h4 class="fw-bold mb-3">
                    <span class="gradient-text"><i class="fas fa-dumbbell me-2"></i>THE FITNESS EMPIRE</span>
                </h4>
                <p class="text-muted" style="line-height:1.8;">
                    Empowering your fitness journey with state-of-the-art equipment and expert guidance. 
                    Transform your body, elevate your mind.
                </p>
                <div class="d-flex gap-3 mt-4">
                    <a href="https://www.instagram.com/power_house_.9" target="_blank"
                       style="width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;background:rgba(212,175,55,0.08);border:1px solid rgba(212,175,55,0.15);color:var(--gold);transition:all 0.3s;">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://wa.me/919644962106" target="_blank"
                       style="width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;background:rgba(37,211,102,0.08);border:1px solid rgba(37,211,102,0.15);color:#25d366;transition:all 0.3s;">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="tel:<?php echo GYM_PHONE; ?>"
                       style="width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;background:rgba(212,175,55,0.08);border:1px solid rgba(212,175,55,0.15);color:var(--gold);transition:all 0.3s;">
                        <i class="fas fa-phone"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <h6 class="text-gold fw-bold mb-3 text-uppercase" style="letter-spacing:2px;font-size:0.8rem;">Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="footer-link"><i class="fas fa-chevron-right me-2" style="font-size:0.6rem;"></i>Home</a></li>
                    <li><a href="about.php" class="footer-link"><i class="fas fa-chevron-right me-2" style="font-size:0.6rem;"></i>About Us</a></li>
                    <li><a href="membership.php" class="footer-link"><i class="fas fa-chevron-right me-2" style="font-size:0.6rem;"></i>Membership Plans</a></li>
                    <li><a href="contact.php" class="footer-link"><i class="fas fa-chevron-right me-2" style="font-size:0.6rem;"></i>Contact Us</a></li>
                    <li><a href="admin/login.php" class="footer-link"><i class="fas fa-chevron-right me-2" style="font-size:0.6rem;"></i>Staff Login</a></li>
                </ul>
            </div>
            <div class="col-lg-5 col-6">
                <h6 class="text-gold fw-bold mb-3 text-uppercase" style="letter-spacing:2px;font-size:0.8rem;">Contact Info</h6>
                <div class="d-flex align-items-start mb-3">
                    <div class="feature-icon me-3" style="width:38px;height:38px;min-width:38px;border-radius:10px;font-size:0.85rem;">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <small class="text-muted"><?php echo GYM_ADDRESS; ?></small>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-3">
                    <div class="feature-icon me-3" style="width:38px;height:38px;min-width:38px;border-radius:10px;font-size:0.85rem;">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div>
                        <small class="text-muted"><?php echo GYM_PHONE; ?></small>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-4">
                    <div class="feature-icon me-3" style="width:38px;height:38px;min-width:38px;border-radius:10px;font-size:0.85rem;">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <small class="text-muted">Mon–Sat: 6:00 AM – 10:00 AM &amp; 4:00 PM – 10:00 PM<br>Sunday: Closed</small>
                    </div>
                </div>
                <a href="tel:<?php echo GYM_PHONE; ?>" class="btn btn-outline-gold w-100">
                    <i class="fas fa-phone me-2"></i> CALL NOW
                </a>
            </div>
        </div>
        <div style="height:1px;background:linear-gradient(90deg, transparent, rgba(212,175,55,0.2), transparent);margin-bottom:30px;"></div>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <p class="text-muted small mb-2 mb-md-0">
                &copy; <?php echo date('Y'); ?> <?php echo GYM_NAME; ?>. All Rights Reserved.
            </p>
            <p class="text-muted small mb-0" style="opacity:0.5;">
                <i class="fas fa-heart" style="color:var(--gold);font-size:0.7rem;"></i> Designed for Excellence
            </p>
        </div>
    </div>
</footer>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/919644962106" class="whatsapp-btn" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
