<?php
if (defined('FOOTER_INCLUDED')) return;
define('FOOTER_INCLUDED', true);
?>
<footer class="footer mt-auto">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h4 class="text-gold mb-4"><i class="fas fa-dumbbell me-2"></i> IRONMAN GYM</h4>
                <p class="text-muted">Empowering your fitness journey with state-of-the-art equipment and expert guidance. Join the iron family today.</p>
                <div class="social-links mt-3">
                    <a href="#" class="text-gold me-3"><i class="fab fa-facebook-f fa-lg"></i></a>
                    <a href="#" class="text-gold me-3"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-gold me-3"><i class="fab fa-twitter fa-lg"></i></a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <h4 class="text-gold mb-4">Quick Links</h4>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="text-muted text-decoration-none mb-2 d-block">Home</a></li>
                    <li><a href="about.php" class="text-muted text-decoration-none mb-2 d-block">About Us</a></li>
                    <li><a href="membership.php" class="text-muted text-decoration-none mb-2 d-block">Membership Plans</a></li>
                    <li><a href="contact.php" class="text-muted text-decoration-none mb-2 d-block">Contact Us</a></li>
                    <li><a href="admin/login.php" class="text-muted text-decoration-none mb-2 d-block">Staff Login</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h4 class="text-gold mb-4">Contact Info</h4>
                <p class="text-muted mb-2"><i class="fas fa-map-marker-alt text-gold me-2"></i> <?php echo GYM_ADDRESS; ?></p>
                <p class="text-muted mb-2"><i class="fas fa-phone text-gold me-2"></i> <?php echo GYM_PHONE; ?></p>
                <p class="text-muted mb-2"><i class="fas fa-envelope text-gold me-2"></i> info@ironmangym.com</p>
                <a href="tel:<?php echo GYM_PHONE; ?>" class="btn btn-outline-gold mt-3 w-100">CALL NOW</a>
            </div>
        </div>
        <hr class="border-secondary">
        <div class="text-center text-muted">
            <p>&copy; <?php echo date('Y'); ?> Ironman Gym. All Rights Reserved. Designed for Excellence.</p>
        </div>
    </div>
</footer>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/91<?php echo GYM_PHONE; ?>" class="whatsapp-btn" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
