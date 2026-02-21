<?php require_once __DIR__ . '/includes/header.php'; ?>

<section class="py-5 mt-5">
    <div class="container">
        <h2 class="section-title">Contact Us</h2>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card p-4 h-100">
                    <h4 class="text-gold mb-4">Get In Touch</h4>
                    <ul class="list-unstyled">
                        <li class="mb-4 d-flex">
                            <div class="bg-gold p-3 rounded-circle me-3 flex-shrink-0" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-map-marker-alt text-dark"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Address</h5>
                                <p class="text-muted mb-0"><?php echo GYM_ADDRESS; ?></p>
                            </div>
                        </li>
                        <li class="mb-4 d-flex">
                            <div class="bg-gold p-3 rounded-circle me-3 flex-shrink-0" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-phone text-dark"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Phone</h5>
                                <p class="text-muted mb-0"><?php echo GYM_PHONE; ?></p>
                            </div>
                        </li>
                        <li class="mb-4 d-flex">
                            <div class="bg-gold p-3 rounded-circle me-3 flex-shrink-0" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-envelope text-dark"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Email</h5>
                                <p class="text-muted mb-0">info@ironmangym.com</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card p-4 h-100">
                    <h4 class="text-gold mb-4">Business Hours</h4>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Monday - Saturday</span>
                        <span class="text-gold">06:00 AM - 10:00 PM</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Sunday</span>
                        <span class="text-gold">08:00 AM - 12:00 PM</span>
                    </div>
                    <hr class="border-secondary">
                    <h5 class="text-gold mt-3">Follow Us</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-outline-gold"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gold btn btn-outline-gold"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gold btn btn-outline-gold"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Review Page link integrated in Contact section as per branding -->
<section class="py-5 bg-darker-bg text-center">
    <div class="container">
        <h3 class="text-gold mb-4">Love your workout at Ironman Gym?</h3>
        <a href="review.php" class="btn btn-gold btn-lg px-5">LEAVE A REVIEW</a>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
