<?php
require_once __DIR__ . '/includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'capture_lead') {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $goal = trim($_POST['goal'] ?? '');

    if (!empty($name) && !empty($phone) && $pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO leads (name, phone, goal) VALUES (?, ?, ?)");
            $stmt->execute([$name, $phone, $goal]);
            flash("Thank you! Our trainer will contact you shortly regarding your '$goal' goal.", "success");
        } catch (PDOException $e) {
            flash("Error processing your request. Please try again.", "danger");
        }
    } elseif (!$pdo) {
        flash("Database not connected. Lead could not be saved.", "danger");
    } else {
        flash("Please provide both name and phone number.", "warning");
    }
    
    // Redirect back to referring page or home
    $redirect = $_SERVER['HTTP_REFERER'] ?? 'index.php';
    redirect($redirect);
}
?>


<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3">UNLEASH YOUR <span class="text-gold">INNER BEAST</span></h1>
        <p class="lead mb-5 text-light">Professional Training. State-of-the-art Equipment. Real Results.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="membership.php" class="btn btn-gold btn-lg px-5">OUR PLANS</a>
            <a href="contact.php" class="btn btn-outline-white btn-lg px-5 text-white border-white">FIND US</a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 bg-darker-bg border-bottom border-dark">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-4 mb-md-0">
                <h2 class="text-gold fw-bold">10+</h2>
                <p class="text-muted">Years Experience</p>
            </div>
            <div class="col-md-3 mb-4 mb-md-0">
                <h2 class="text-gold fw-bold">500+</h2>
                <p class="text-muted">Active Members</p>
            </div>
            <div class="col-md-3 mb-4 mb-md-0">
                <h2 class="text-gold fw-bold">15+</h2>
                <p class="text-muted">Expert Trainers</p>
            </div>
            <div class="col-md-3">
                <h2 class="text-gold fw-bold">100+</h2>
                <p class="text-muted">Equipment Units</p>
            </div>
        </div>
    </div>
</section>

<!-- Lead Capture Form Section -->
<section class="py-5" id="join">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h2 class="section-title">START YOUR TRANSFORMATION</h2>
                <p class="text-muted mb-4">Leave your details and our expert trainers will call you to discuss your fitness goals and design a customized path for you.</p>
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-gold p-3 rounded-circle me-3">
                        <i class="fas fa-check text-dark"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">Personalized Diet Chart</h5>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-gold p-3 rounded-circle me-3">
                        <i class="fas fa-check text-dark"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">Expert Workout Guidance</h5>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="bg-gold p-3 rounded-circle me-3">
                        <i class="fas fa-check text-dark"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">Premium Locker Facilities</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card p-4">
                    <?php if ($flash = get_flash()): ?>
                        <div class="alert alert-<?php echo $flash['type']; ?> alert-dismissible fade show">
                            <?php echo $flash['message']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <form action="index.php" method="POST">
                        <input type="hidden" name="action" value="capture_lead">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" placeholder="Enter your mobile number" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Your Fitness Goal</label>
                            <select name="goal" class="form-select bg-dark text-light border-secondary">
                                <option value="Weight Loss">Weight Loss</option>
                                <option value="Muscle Building">Muscle Building</option>
                                <option value="Fat Loss">Fat Loss</option>
                                <option value="General Fitness">General Fitness</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-gold w-100 py-3 mt-2">BOOK A FREE CONSULTATION</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5 bg-darker-bg">
    <div class="container text-center">
        <h2 class="section-title d-inline-block">What Our Members Say</h2>
        <div class="row mt-5">
            <div class="col-md-4 mb-4">
                <div class="card p-4 h-100">
                    <div class="text-gold mb-3">
                        <i class="fas fa-quote-left fa-2x"></i>
                    </div>
                    <p class="text-muted italic">"The best gym in Bhopal! The trainers are very professional and the equipment is top-notch. I lost 10kg in just 3 months."</p>
                    <h5 class="text-gold mb-0">Rahul Sharma</h5>
                    <small class="text-muted">Member since 2023</small>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card p-4 h-100">
                    <div class="text-gold mb-3">
                        <i class="fas fa-quote-left fa-2x"></i>
                    </div>
                    <p class="text-muted">"Amazing environment. The dark and gold theme really gets you in the zone. Highly recommend the personal training program."</p>
                    <h5 class="text-gold mb-0">Priya Singh</h5>
                    <small class="text-muted">Member since 2022</small>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card p-4 h-100">
                    <div class="text-gold mb-3">
                        <i class="fas fa-quote-left fa-2x"></i>
                    </div>
                    <p class="text-muted">"Professional gym with all modern facilities. The staff is friendly and hygiene is very well maintained."</p>
                    <h5 class="text-gold mb-0">Amit Verma</h5>
                    <small class="text-muted">Member since 2024</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Google Map Embed Section -->
<section class="py-5 container">
    <h2 class="section-title">Locate Us</h2>
    <div class="ratio ratio-21x9 rounded overflow-hidden shadow">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3666.255562044813!2d77.44111111111111!3d23.23833333333333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjPCsDE0JzE4LjAiTiA3N8KwMjYnMjguMCJF!5e0!3m2!1sen!2sin!4v1620000000000!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
