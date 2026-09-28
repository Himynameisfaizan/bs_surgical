<?php
// Database Connection
include 'config/connect.php'; 

// Fetch Service Details safely
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $service_id = intval($_GET['id']);
    
    $query = "SELECT * FROM services WHERE id = $service_id";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $service = mysqli_fetch_assoc($result);
        
        // --- DYNAMIC SEO LOGIC FROM DATABASE ---
        $pageTitle = htmlspecialchars($service['service_name']) . " | BS Surgical";
        $meta_description = htmlspecialchars(strip_tags($service['short_desc'])); // Short desc from DB
        $meta_keywords = strtolower(str_replace(' ', ', ', $service['service_name'])) . ", medical equipment, surgical supplies, BS Surgical";
        
        $imagePath = !empty($service['img_path']) ? 'admin/assets/img/uploads/' . $service['img_path'] : 'assets/images/default-service-large.jpg';
        
    } else {
        // Redirect if ID not found
        header("Location: services.php");
        exit();
    }
} else {
    // Redirect if no ID provided
    header("Location: services.php");
    exit();
}

include 'includes/header.php'; 
?>

<!-- SERVICE DETAILS HEADER -->
<section class="py-5" style="background-color: #17385A; color: white;">
    <div class="container py-4">
        <h1 class="text-uppercase" style="font-weight: 700; color: #fff;"><?= htmlspecialchars($service['service_name']) ?></h1>
        <p class="lead mb-0" style="color: #00A8B8;">Premium Medical & Surgical Equipment Solutions</p>
    </div>
</section>

<!-- MAIN CONTENT SECTION -->
<section class="section-padding bg-light" style="padding-top: 60px; padding-bottom: 80px;">
    <div class="container">
        <div class="row g-5">
            
            <!-- Left Column: Image and Description -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
                    <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($service['service_name']) ?>" class="img-fluid w-100" style="max-height: 450px; object-fit: cover;">
                </div>
                
                <div class="service-content bg-white p-4 p-md-5 rounded-4 shadow-sm">
                    <h2 class="mb-4" style="color: #17385A; font-weight: 700;">Overview</h2>
                    <h5 class="text-muted mb-4" style="line-height: 1.6;">
                        <?= htmlspecialchars($service['short_desc']) ?>
                    </h5>
                    
                    <div class="long-desc-content" style="color: #4a5568; line-height: 1.8; font-size: 1.05rem;">
                        <?= $service['long_desc'] ?>
                    </div>
                </div>
            </div>

            <!-- Right Column: Sidebar CTA & Contact -->
            <div class="col-lg-4">
                <!-- Request Quote Box -->
                <div class="bg-white p-4 rounded-4 shadow-sm mb-4" style="border-top: 5px solid #00A8B8;">
                    <h4 class="mb-3" style="color: #17385A; font-weight: 700;">Interested in this Equipment?</h4>
                    <p class="text-muted mb-4 small">Get a customized quotation for our <strong><?= htmlspecialchars($service['service_name']) ?></strong>. Our technical experts will get back to you immediately.</p>
                    
                    <form action="contact-process.php" method="POST">
                        <input type="hidden" name="interested_service" value="<?= htmlspecialchars($service['service_name']) ?>">
                        
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Your Name / Clinic Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="phone" class="form-control" placeholder="Phone / WhatsApp Number" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="message" rows="3" class="form-control" placeholder="Tell us about your hospital requirement..." required></textarea>
                        </div>
                        <button type="submit" class="btn w-100 py-2" style="background-color: #00A8B8; color: white; font-weight: 600; border-radius: 8px;">
                            Request Quotation <i class="bi bi-send ms-2"></i>
                        </button>
                    </form>
                </div>

                <!-- Contact Info Box -->
                <div class="bg-white p-4 rounded-4 shadow-sm">
                    <h5 class="mb-4" style="color: #17385A; font-weight: 600;">Need Immediate Assistance?</h5>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box me-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: rgba(23, 56, 90, 0.1); color: #17385A; font-size: 1.2rem;">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted small">Call Us 24/7</h6>
                            <a href="tel:+918595803224" class="text-decoration-none" style="color: #17385A; font-weight: 600;">+91-8595803224</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="icon-box me-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: rgba(0, 168, 184, 0.1); color: #00A8B8; font-size: 1.2rem;">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted small">Email Us</h6>
                            <a href="mailto:bssurgicals@gmail.com" class="text-decoration-none" style="color: #17385A; font-weight: 600; word-break: break-all;">bssurgicals@gmail.com</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Custom CSS for formatting DB Content -->
<style>
    .long-desc-content p { margin-bottom: 1.5rem; }
    .long-desc-content ul { padding-left: 1.5rem; margin-bottom: 1.5rem; }
    .long-desc-content li { margin-bottom: 0.5rem; }
</style>

<?php include 'includes/footer.php'; ?>