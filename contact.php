<?php
include ('config/connect.php'); 

$pageTitle = "Contact Us | BS Surgical"; 

$contactQuery = mysqli_query($conn, "SELECT * FROM contacts ORDER BY id DESC LIMIT 1");
$contactInfo = mysqli_fetch_assoc($contactQuery);

$siteAddress = !empty($contactInfo['address']) ? $contactInfo['address'] : 'Plot no. 2 Upper Ground Floor, Kailash Puram, Govindpuram, Ghaziabad, Uttar Pradesh - 201013';
$sitePhone = !empty($contactInfo['phone']) ? $contactInfo['phone'] : '+91-8595803224';
$siteEmail = !empty($contactInfo['email']) ? $contactInfo['email'] : 'bssurgicals@gmail.com';
$siteWorkingHours = !empty($contactInfo['working_hours']) ? $contactInfo['working_hours'] : 'Mon - Sat, 10:00 AM to 7:00 PM IST';

$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_inquiry'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $company = mysqli_real_escape_string($conn, $_POST['company']);
    $interest = mysqli_real_escape_string($conn, $_POST['interest']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    if(!empty($company)) {
        $message = "Hospital/Clinic: " . $company . "\n\nRequirements:\n" . $message;
    }

    $insertQuery = "INSERT INTO inquiries (name, email, phone, subject, message, status) VALUES ('$name', '$email', '$phone', '$interest', '$message', 0)";
    
    if(mysqli_query($conn, $insertQuery)) {
        $msg = "<div class='alert alert-success mt-3'>Thank you! Your equipment inquiry has been sent successfully. Our team will contact you soon.</div>";
    } else {
        $msg = "<div class='alert alert-danger mt-3'>Oops! Something went wrong. Please try again or call us directly.</div>";
    }
}

$currentPage = basename($_SERVER['PHP_SELF']);
$seo_query = mysqli_query($conn, "SELECT meta_title, meta_key, meta_desc FROM meta WHERE page_url = '$currentPage'");

if ($seo_query && mysqli_num_rows($seo_query) > 0) {
    $seo_data = mysqli_fetch_assoc($seo_query);
    $pageTitle = $seo_data['meta_title'];
    $meta_keywords = $seo_data['meta_key'];
    $meta_description = $seo_data['meta_desc'];
}

$schema_query = mysqli_query($conn, "SELECT schema_markup FROM page_schemas WHERE page_url = '$currentPage'");
if ($schema_query && mysqli_num_rows($schema_query) > 0) {
    $schema_row = mysqli_fetch_assoc($schema_query);
    $page_schema = $schema_row['schema_markup']; 
}

include 'includes/header.php'; 
include 'includes/breadcrumb.php'; 
?>

<!-- ==============================
     1. CONTACT INFO & FORM SECTION
     ============================== -->
<section class="contact-page-section">
    <div class="container">
        <div class="row">
            
            <!-- Left Side: Dynamic Contact Information -->
            <div class="col-lg-5 reveal">
                <div class="contact-info-wrapper">
                    <span class="sec-subtitle">Get In Touch</span>
                    <h2 class="sec-title" style="color: #212529;">Let's Discuss Your Equipment Needs.</h2>
                    <p class="contact-desc">Have questions about our surgical instruments, bulk pricing for hospitals, or technical specifications? Our dedicated medical team is ready to assist you. Reach out to us today!</p>
                    
                    <!-- Location Card -->
                    <div class="info-card">
                        <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="info-content">
                            <h4>Head Office</h4>
                            <p><?php echo htmlspecialchars($siteAddress); ?></p>
                        </div>
                    </div>

                    <!-- Phone Card -->
                    <div class="info-card">
                        <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
                        <div class="info-content">
                            <h4>Phone Inquiry</h4>
                            <a href="tel:<?php echo htmlspecialchars($sitePhone); ?>"><?php echo htmlspecialchars($sitePhone); ?></a>
                            <p style="font-size: 12px; margin-top: 5px;">(Available <?php echo htmlspecialchars($siteWorkingHours); ?>)</p>
                        </div>
                    </div>

                    <!-- Email Card -->
                    <div class="info-card">
                        <div class="info-icon"><i class="fa-solid fa-envelope"></i></div>
                        <div class="info-content">
                            <h4>Email Address</h4>
                            <a href="mailto:<?php echo htmlspecialchars($siteEmail); ?>"><?php echo htmlspecialchars($siteEmail); ?></a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Side: Contact Form -->
            <div class="col-lg-7 reveal">
                <div class="contact-form-box">
                    <h3>Request a Free Quotation</h3>
                    <p>Fill out the form below and our medical equipment manager will get back to you within 24 hours.</p>
                    
                    <!-- Form Submission Alert Message -->
                    <?php echo $msg; ?>
                    
                    <form action="contact.php" method="POST">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control" name="company" placeholder="Hospital / Clinic Name">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="tel" class="form-control" name="phone" placeholder="Phone / WhatsApp No." required>
                            </div>
                        </div>

                        <div class="form-group">
                            <select class="form-select" name="interest" required>
                                <?php $selectedProduct = isset($_GET['product']) ? $_GET['product'] : ''; ?>
                                <option value="" disabled <?php echo ($selectedProduct=='')?'selected':''; ?>>Select Equipment of Interest</option>
                                <option value="General Inquiry">General Clinic Inquiry</option>
                                
                                <!-- Dynamic Products from Database -->
                                <?php 
                                $dropdownQuery = mysqli_query($conn, "SELECT pro_name FROM products WHERE status = 1");
                                if ($dropdownQuery && mysqli_num_rows($dropdownQuery) > 0) {
                                    while($dropdownItem = mysqli_fetch_assoc($dropdownQuery)):
                                        $isSelected = ($selectedProduct == $dropdownItem['pro_name']) ? 'selected' : '';
                                ?>
                                <option value="<?php echo htmlspecialchars($dropdownItem['pro_name']); ?>" <?php echo $isSelected; ?>>
                                    <?php echo htmlspecialchars($dropdownItem['pro_name']); ?>
                                </option>
                                <?php 
                                    endwhile;
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" name="message" placeholder="Tell us about your requirement (Quantity, Installation location, Equipment specific queries)..." required></textarea>
                        </div>

                        <button type="submit" name="submit_inquiry" class="btn-submit">Send Message <i class="fa-regular fa-paper-plane ms-2"></i></button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ==============================
     2. GOOGLE MAP SECTION
     ============================== -->
<section class="map-section reveal">
    <div class="container">
        <div class="map-container">
            <?php 
                if (!empty($contactInfo['map'])) {
                    $mapData = trim($contactInfo['map']);
                    
                    if (strpos($mapData, '<iframe') !== false) {
                        $mapIframe = str_replace(['width="600"', 'width="100%"'], 'width="100%"', $mapData);
                        $mapIframe = preg_replace('/height="\d+"/', 'height="100%"', $mapIframe);
                        echo $mapIframe;
                    } else {
                        echo '<iframe src="' . htmlspecialchars($mapData) . '" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
                    }
                } else {
                    // Updated Fallback map location based on Ghaziabad address
                    echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112028.98822506727!2d77.35246733221995!3d28.66317765955627!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cf1bb41c50fdf%3A0xe6f06fd26a7798ba!2sGhaziabad%2C%20Uttar%20Pradesh!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
                }
            ?>
        </div>
    </div>
</section>

<!-- ==============================
     3. SUPPORT / FAQ SECTION
     ============================== -->
<section class="faq-section">
    <div class="container">
        <div class="row justify-content-center text-center mb-5 reveal">
            <div class="col-lg-8">
                <span class="sec-subtitle">Customer Support</span>
                <h2 class="sec-title">Common Queries</h2>
            </div>
        </div>

        <div class="row justify-content-center reveal">
            <div class="col-lg-8">
                <div class="accordion faq-accordion" id="contactFaqAccordion">
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                How quickly do you respond to equipment quotation requests?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#contactFaqAccordion">
                            <div class="accordion-body">
                                Our sales team operates from Mon-Sat. You can expect a detailed response with pricing, availability, and technical specifications within 24 hours of submitting your inquiry.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                Do you provide installation and technical support?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#contactFaqAccordion">
                            <div class="accordion-body">
                                Yes, we offer comprehensive installation guidance and after-sales support for our equipment like operating microscopes to ensure smooth operations in your healthcare facility.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                Do you handle delivery to clinics and hospitals nationwide?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#contactFaqAccordion">
                            <div class="accordion-body">
                                Absolutely. We have a robust logistics network to ensure safe, secure, and timely delivery of delicate surgical equipment to your location anywhere across the country.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Scroll Animation Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const reveals = document.querySelectorAll(".reveal");
        const revealOnScroll = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("active");
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        reveals.forEach(reveal => revealOnScroll.observe(reveal));
    });
</script>

<!-- Include Footer -->
<?php include 'includes/footer.php'; ?>