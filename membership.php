<?php require_once __DIR__ . '/includes/header.php'; ?>

<!-- ===== MEMBERSHIP HERO ===== -->
<section style="padding: 120px 0 60px; background: radial-gradient(ellipse at 50% 0%, rgba(212,175,55,0.06) 0%, transparent 60%);">
    <div class="container text-center">
        <div class="section-title animate-on-scroll">MEMBERSHIP PLANS</div>
        <h2 class="section-heading animate-on-scroll">Choose Your <span class="gradient-text">Power</span> Plan</h2>
        <p class="text-muted mb-0 animate-on-scroll" style="max-width:500px;margin:0 auto;line-height:1.8;">
            Flexible plans designed for your fitness journey. No hidden fees, no contracts. Just gains.
        </p>
    </div>
</section>

<!-- ===== PRICING CARDS ===== -->
<section class="pb-5" style="padding-bottom: 100px !important;">
    <div class="container">
        <div class="row justify-content-center g-4">

            <!-- 1 MONTH -->
            <div class="col-lg-4 col-md-6 animate-on-scroll" style="transition-delay: 0.1s;">
                <div class="card h-100 membership-card">
                    <div class="card-body p-5 text-center">
                        <div class="mb-3">
                            <span style="width:50px;height:50px;border-radius:14px;display:inline-flex;align-items:center;justify-content:center;background:rgba(212,175,55,0.08);border:1px solid rgba(212,175,55,0.15);color:var(--gold);font-size:1.2rem;">
                                <i class="fas fa-bolt"></i>
                            </span>
                        </div>
                        <h4 class="text-uppercase fw-bold mb-1" style="letter-spacing:2px;">Starter</h4>
                        <small class="text-muted">1 Month Plan</small>
                        <p class="price my-4">₹500</p>
                        <ul class="list-unstyled text-start mb-5" style="color:var(--text-body);">
                            <li class="mb-3 d-flex align-items-center">
                                <span style="width:22px;height:22px;border-radius:6px;display:inline-flex;align-items:center;justify-content:center;background:rgba(40,167,69,0.15);color:#28a745;font-size:0.7rem;margin-right:12px;flex-shrink:0;"><i class="fas fa-check"></i></span>
                                General Training
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <span style="width:22px;height:22px;border-radius:6px;display:inline-flex;align-items:center;justify-content:center;background:rgba(40,167,69,0.15);color:#28a745;font-size:0.7rem;margin-right:12px;flex-shrink:0;"><i class="fas fa-check"></i></span>
                                All Equipment Access
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <span style="width:22px;height:22px;border-radius:6px;display:inline-flex;align-items:center;justify-content:center;background:rgba(40,167,69,0.15);color:#28a745;font-size:0.7rem;margin-right:12px;flex-shrink:0;"><i class="fas fa-check"></i></span>
                                Cardio Section
                            </li>
                            <li class="mb-3 d-flex align-items-center" style="opacity:0.3;">
                                <span style="width:22px;height:22px;border-radius:6px;display:inline-flex;align-items:center;justify-content:center;background:rgba(220,53,69,0.1);color:#dc3545;font-size:0.7rem;margin-right:12px;flex-shrink:0;"><i class="fas fa-times"></i></span>
                                <span class="text-decoration-line-through">Diet Chart</span>
                            </li>
                        </ul>
                        <button class="btn btn-outline-gold w-100 py-3" onclick="openPayModal(1,'Starter — 1 Month','500')">
                            <i class="fas fa-arrow-right me-2"></i> SELECT PLAN
                        </button>
                    </div>
                </div>
            </div>

            <!-- 3 MONTHS — FEATURED -->
            <div class="col-lg-4 col-md-6 animate-on-scroll" style="transition-delay: 0.2s;">
                <div class="card h-100 membership-card featured" style="z-index:2;">
                    <div class="card-body p-5 text-center position-relative">
                        <div style="position:absolute;top:16px;right:16px;">
                            <span class="badge px-3 py-2 fw-bold" style="background:var(--accent-gradient);color:#000;border-radius:50px;font-size:0.7rem;letter-spacing:1px;">
                                🔥 MOST POPULAR
                            </span>
                        </div>
                        <div class="mb-3">
                            <span style="width:50px;height:50px;border-radius:14px;display:inline-flex;align-items:center;justify-content:center;background:rgba(212,175,55,0.15);border:1px solid rgba(212,175,55,0.3);color:var(--gold);font-size:1.2rem;">
                                <i class="fas fa-fire"></i>
                            </span>
                        </div>
                        <h4 class="text-uppercase fw-bold mb-1" style="letter-spacing:2px;">Pro</h4>
                        <small class="text-muted">3 Months Plan</small>
                        <p class="price my-4">₹1,200</p>
                        <ul class="list-unstyled text-start mb-5" style="color:var(--text-body);">
                            <li class="mb-3 d-flex align-items-center">
                                <span style="width:22px;height:22px;border-radius:6px;display:inline-flex;align-items:center;justify-content:center;background:rgba(40,167,69,0.15);color:#28a745;font-size:0.7rem;margin-right:12px;flex-shrink:0;"><i class="fas fa-check"></i></span>
                                General Training
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <span style="width:22px;height:22px;border-radius:6px;display:inline-flex;align-items:center;justify-content:center;background:rgba(40,167,69,0.15);color:#28a745;font-size:0.7rem;margin-right:12px;flex-shrink:0;"><i class="fas fa-check"></i></span>
                                All Equipment Access
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <span style="width:22px;height:22px;border-radius:6px;display:inline-flex;align-items:center;justify-content:center;background:rgba(40,167,69,0.15);color:#28a745;font-size:0.7rem;margin-right:12px;flex-shrink:0;"><i class="fas fa-check"></i></span>
                                Personal Diet Chart
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <span style="width:22px;height:22px;border-radius:6px;display:inline-flex;align-items:center;justify-content:center;background:rgba(40,167,69,0.15);color:#28a745;font-size:0.7rem;margin-right:12px;flex-shrink:0;"><i class="fas fa-check"></i></span>
                                Locker Facility
                            </li>
                        </ul>
                        <button class="btn btn-gold w-100 py-3" onclick="openPayModal(3,'Pro — 3 Months','1200')">
                            <i class="fas fa-crown me-2"></i> SELECT PLAN
                        </button>
                    </div>
                </div>
            </div>

            <!-- 1 YEAR -->
            <div class="col-lg-4 col-md-6 animate-on-scroll" style="transition-delay: 0.3s;">
                <div class="card h-100 membership-card">
                    <div class="card-body p-5 text-center">
                        <div class="mb-3">
                            <span style="width:50px;height:50px;border-radius:14px;display:inline-flex;align-items:center;justify-content:center;background:rgba(212,175,55,0.08);border:1px solid rgba(212,175,55,0.15);color:var(--gold);font-size:1.2rem;">
                                <i class="fas fa-crown"></i>
                            </span>
                        </div>
                        <h4 class="text-uppercase fw-bold mb-1" style="letter-spacing:2px;">Elite</h4>
                        <small class="text-muted">1 Year Plan</small>
                        <p class="price my-4">₹4,000</p>
                        <ul class="list-unstyled text-start mb-5" style="color:var(--text-body);">
                            <li class="mb-3 d-flex align-items-center">
                                <span style="width:22px;height:22px;border-radius:6px;display:inline-flex;align-items:center;justify-content:center;background:rgba(40,167,69,0.15);color:#28a745;font-size:0.7rem;margin-right:12px;flex-shrink:0;"><i class="fas fa-check"></i></span>
                                Best Value Plan
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <span style="width:22px;height:22px;border-radius:6px;display:inline-flex;align-items:center;justify-content:center;background:rgba(40,167,69,0.15);color:#28a745;font-size:0.7rem;margin-right:12px;flex-shrink:0;"><i class="fas fa-check"></i></span>
                                All Standard Perks
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <span style="width:22px;height:22px;border-radius:6px;display:inline-flex;align-items:center;justify-content:center;background:rgba(40,167,69,0.15);color:#28a745;font-size:0.7rem;margin-right:12px;flex-shrink:0;"><i class="fas fa-check"></i></span>
                                Monthly Progress Review
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <span style="width:22px;height:22px;border-radius:6px;display:inline-flex;align-items:center;justify-content:center;background:rgba(40,167,69,0.15);color:#28a745;font-size:0.7rem;margin-right:12px;flex-shrink:0;"><i class="fas fa-check"></i></span>
                                2 Free PT Sessions
                            </li>
                        </ul>
                        <button class="btn btn-outline-gold w-100 py-3" onclick="openPayModal(12,'Elite — 1 Year','4000')">
                            <i class="fas fa-arrow-right me-2"></i> SELECT PLAN
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ====== PAYMENT MODAL ====== -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="background:var(--bg-white); border:1px solid var(--card-border); border-radius:20px; box-shadow: 0 25px 80px rgba(0,0,0,0.15);">
      <div class="modal-header border-0 pb-0 pt-4 px-4">
        <h4 class="modal-title fw-bold"><span class="gradient-text"><i class="fas fa-dumbbell me-2"></i> Complete Registration</span></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <div class="row g-4">

          <!-- Left: QR Code -->
          <div class="col-md-5 text-center d-flex flex-column align-items-center justify-content-center">
            <div class="p-3 rounded-4 mb-3" style="background:#fff; display:inline-block; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
              <img src="assets/phonepe_qr.png" alt="PhonePe QR Code" style="width:210px; height:auto; border-radius:10px;">
            </div>
            <div class="badge px-3 py-2 mb-2" style="background:var(--primary-glow);border:1px solid var(--primary-lighter);border-radius:50px;font-size:0.85rem;color:var(--text-body);">
              <i class="fas fa-mobile-alt me-1 text-gold"></i> Scan & Pay via PhonePe / UPI
            </div>
            <div id="modalPlanBadge" class="badge mt-1 px-3 py-2" style="background:var(--accent-gradient);color:#000;font-size:0.9rem;border-radius:50px;font-weight:700;"></div>
            <p class="text-muted mt-2 small">Pay ₹<strong id="modalAmount" class="text-gold"></strong> then fill the form →</p>
          </div>

          <!-- Right: Registration Form -->
          <div class="col-md-7">
            <?php
              $error = $_GET['error'] ?? '';
              if ($error === 'utr') echo '<div class="alert alert-danger py-2 small" style="border-radius:12px;"><i class="fas fa-exclamation-triangle me-1"></i> Invalid Transaction ID. Must be 12 digits.</div>';
              if ($error === 'duplicate_utr') echo '<div class="alert alert-danger py-2 small" style="border-radius:12px;"><i class="fas fa-exclamation-triangle me-1"></i> This Transaction ID has already been used.</div>';
              if ($error === 'invalid') echo '<div class="alert alert-danger py-2 small" style="border-radius:12px;"><i class="fas fa-exclamation-triangle me-1"></i> Please fill all required fields correctly.</div>';
            ?>
            <form action="register.php" method="POST" id="registerForm">
              <input type="hidden" name="duration" id="modalDuration">

              <div class="d-flex gap-2 mb-3">
                <span class="badge py-2 px-3" style="background:rgba(212,175,55,0.1);color:var(--gold);border-radius:50px;font-size:0.75rem;">1. Pay QR</span>
                <span class="badge py-2 px-3" style="background:rgba(212,175,55,0.1);color:var(--gold);border-radius:50px;font-size:0.75rem;">2. Enter UTR</span>
                <span class="badge py-2 px-3" style="background:rgba(212,175,55,0.1);color:var(--gold);border-radius:50px;font-size:0.75rem;">3. Get Bill</span>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing:1px;">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
              </div>
              <div class="mb-3">
                <label class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing:1px;">Mobile Number <span class="text-danger">*</span></label>
                <input type="tel" name="phone" class="form-control" placeholder="10-digit mobile number" required pattern="[0-9]{10}">
              </div>
              <div class="mb-3">
                <label class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing:1px;">Email <span style="opacity:0.5;">(optional)</span></label>
                <input type="email" name="email" class="form-control" placeholder="your@email.com">
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-muted text-uppercase" style="letter-spacing:1px;">UPI Transaction ID (UTR) <span class="text-danger">*</span></label>
                <input type="text" name="utr" id="utrInput" class="form-control" 
                       placeholder="Enter 12-digit UTR from payment receipt" 
                       required pattern="[0-9]{12}" maxlength="12" inputmode="numeric"
                       oninput="validateUTR()">
                <div class="form-text text-muted small mt-1">
                  <i class="fas fa-info-circle me-1"></i> UPI app → Transaction History → 12-digit UTR
                </div>
                <div id="utrFeedback" class="small mt-1"></div>
              </div>

              <div class="py-2 px-3 small mb-3" id="utrAlert" style="background:rgba(220,53,69,0.08);border:1px solid rgba(220,53,69,0.2);color:#dc3545;border-radius:12px;">
                <i class="fas fa-lock me-1"></i> Enter valid 12-digit UTR to enable registration. <strong>Admin verifies payment.</strong>
              </div>

              <button type="submit" class="btn btn-gold w-100 py-3" id="submitBtn" disabled style="opacity:0.5;cursor:not-allowed;border-radius:14px;">
                <i class="fas fa-lock me-2"></i> Enter Valid UTR to Register
              </button>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
function openPayModal(duration, label, amount) {
    document.getElementById('modalDuration').value    = duration;
    document.getElementById('modalPlanBadge').textContent = label;
    document.getElementById('modalAmount').textContent = parseInt(amount).toLocaleString('en-IN');
    document.getElementById('registerForm').reset();
    document.getElementById('modalDuration').value = duration;
    document.getElementById('submitBtn').disabled = true;
    document.getElementById('submitBtn').style.opacity = '0.5';
    document.getElementById('submitBtn').style.cursor = 'not-allowed';
    document.getElementById('submitBtn').innerHTML = '<i class="fas fa-lock me-2"></i> Enter Valid UTR to Register';
    document.getElementById('utrFeedback').innerHTML = '';
    var alert = document.getElementById('utrAlert');
    alert.style.background = 'rgba(220,53,69,0.08)';
    alert.style.borderColor = 'rgba(220,53,69,0.2)';
    alert.style.color = '#dc3545';
    alert.innerHTML = '<i class="fas fa-lock me-1"></i> Enter valid 12-digit UTR to enable registration. <strong>Admin verifies payment.</strong>';
    var modal = new bootstrap.Modal(document.getElementById('paymentModal'));
    modal.show();
}

function validateUTR() {
    var utr = document.getElementById('utrInput').value.replace(/\D/g, '');
    document.getElementById('utrInput').value = utr;
    var btn = document.getElementById('submitBtn');
    var feedback = document.getElementById('utrFeedback');
    var alertBox = document.getElementById('utrAlert');

    if (utr.length === 12) {
        btn.disabled = false;
        btn.style.opacity = '1';
        btn.style.cursor = 'pointer';
        btn.innerHTML = '<i class="fas fa-check-circle me-2"></i> I Have Paid — Confirm & Register';
        feedback.innerHTML = '<span class="text-success"><i class="fas fa-check-circle me-1"></i> Valid UTR format ✓</span>';
        alertBox.style.background = 'rgba(40,167,69,0.08)';
        alertBox.style.borderColor = 'rgba(40,167,69,0.2)';
        alertBox.style.color = '#28a745';
        alertBox.innerHTML = '<i class="fas fa-shield-alt me-1"></i> UTR will be verified by admin. Membership activates after verification.';
    } else {
        btn.disabled = true;
        btn.style.opacity = '0.5';
        btn.style.cursor = 'not-allowed';
        btn.innerHTML = '<i class="fas fa-lock me-2"></i> Enter Valid UTR to Register';
        if (utr.length > 0) {
            feedback.innerHTML = '<span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i> ' + utr.length + '/12 digits entered</span>';
        } else {
            feedback.innerHTML = '';
        }
        alertBox.style.background = 'rgba(220,53,69,0.08)';
        alertBox.style.borderColor = 'rgba(220,53,69,0.2)';
        alertBox.style.color = '#dc3545';
        alertBox.innerHTML = '<i class="fas fa-lock me-1"></i> Enter valid 12-digit UTR to enable registration. <strong>Admin verifies payment.</strong>';
    }
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
