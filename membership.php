<?php require_once __DIR__ . '/includes/header.php'; ?>

<section class="py-5 mt-5">
    <div class="container text-center">
        <h2 class="section-title d-inline-block">Membership Plans</h2>
        <p class="text-muted mb-5">Choose a plan that fits your fitness journey. No hidden fees.</p>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 membership-card">
                    <div class="card-body p-5">
                        <h3 class="card-title text-uppercase font-weight-bold">1 Month</h3>
                        <p class="price mb-4">₹2,000</p>
                        <ul class="list-unstyled text-muted mb-5">
                            <li class="mb-3"><i class="fas fa-check text-gold me-2"></i> General Training</li>
                            <li class="mb-3"><i class="fas fa-check text-gold me-2"></i> All Equipment Access</li>
                            <li class="mb-3"><i class="fas fa-check text-gold me-2"></i> Cardio Section</li>
                            <li class="mb-3 text-decoration-line-through">Diet Chart</li>
                        </ul>
                        <a href="#join" class="btn btn-outline-gold w-100">SELECT PLAN</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 membership-card" style="transform: scale(1.05); border-color: var(--gold); background-color: #1a1a1a;">
                    <div class="card-body p-5">
                        <div class="badge bg-dark-gold text-dark mb-3">MOST POPULAR</div>
                        <h3 class="card-title text-uppercase font-weight-bold">3 Months</h3>
                        <p class="price mb-4">₹5,000</p>
                        <ul class="list-unstyled text-muted mb-5">
                            <li class="mb-3"><i class="fas fa-check text-gold me-2"></i> General Training</li>
                            <li class="mb-3"><i class="fas fa-check text-gold me-2"></i> All Equipment Access</li>
                            <li class="mb-3"><i class="fas fa-check text-gold me-2"></i> Personal Diet Chart</li>
                            <li class="mb-3"><i class="fas fa-check text-gold me-2"></i> Locker Facility</li>
                        </ul>
                        <a href="#join" class="btn btn-gold w-100">SELECT PLAN</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 membership-card">
                    <div class="card-body p-5">
                        <h3 class="card-title text-uppercase font-weight-bold">12 Months</h3>
                        <p class="price mb-4">₹15,000</p>
                        <ul class="list-unstyled text-muted mb-5">
                            <li class="mb-3"><i class="fas fa-check text-gold me-2"></i> Best Value Plan</li>
                            <li class="mb-3"><i class="fas fa-check text-gold me-2"></i> All Standard Perks</li>
                            <li class="mb-3"><i class="fas fa-check text-gold me-2"></i> Monthly Progress Review</li>
                            <li class="mb-3"><i class="fas fa-check text-gold me-2"></i> 2 Free PT Sessions</li>
                        </ul>
                        <a href="#join" class="btn btn-outline-gold w-100">SELECT PLAN</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include Lead Capture Form again at the bottom -->
<section class="py-5 bg-darker-bg" id="join">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-4">
                <h2 class="section-title d-inline-block">Ready to Join?</h2>
                <p class="text-muted">Fill out this quick form and our membership consultant will get in touch to finalize your registration.</p>
            </div>
            <div class="col-lg-6">
                <div class="card p-4">
                    <form action="index.php" method="POST">
                        <input type="hidden" name="action" value="capture_lead">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" name="phone" class="form-control" placeholder="Enter phone" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Plan Interested In</label>
                                <select name="goal" class="form-select bg-dark text-light border-secondary">
                                    <option value="1 Month">1 Month Plan</option>
                                    <option value="3 Months">3 Months Plan</option>
                                    <option value="6 Months">6 Months Plan</option>
                                    <option value="12 Months">12 Months Plan</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-gold w-100 py-3">SEND ENQUIRY</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
