<?php
include 'config/connect.php';

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

$brands_array = [];
if (isset($conn)) {
    $brands_res = mysqli_query($conn, "SELECT * FROM brands ORDER BY id DESC");
    if ($brands_res && mysqli_num_rows($brands_res) > 0) {
        while ($brand = mysqli_fetch_assoc($brands_res)) {
            $brands_array[] = $brand;
        }
    }
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/breadcrumb.php'; ?>
  
<!-- 1. ABOUT COMPANY SECTION -->
<section class="inner-about section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 reveal mb-4 mb-lg-0">
                <div class="about-image-collage position-relative">
                    <img src="assets/images/about-main.jpg" alt="BS Surgical Equipment" class="about-img-1 w-100 rounded shadow-lg" style="object-fit: cover; height: 350px;" onerror="this.src='https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?q=80&w=800&auto=format&fit=crop'">
                    <img src="assets/images/about-sub.jpg" alt="Labomed Operating Microscope" class="about-img-2 position-absolute border border-white border-5 rounded shadow" style="width: 250px; bottom: -30px; right: -20px;" onerror="this.src='https://images.unsplash.com/photo-1579684385127-1ef15d508118?q=80&w=600&auto=format&fit=crop'">
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5 reveal mt-5 mt-lg-0">
                <span class="sec-subtitle text-uppercase fw-bold" style="color: var(--accent-teal); letter-spacing: 1px; font-size: 14px;">About BS Surgical</span>
                <h1 class="sec-title mb-4" style="color: var(--primary-blue); font-weight: 700; font-size: 2.2rem; line-height: 1.3;">Delivering Precision and Safety with Advanced Surgical Equipment.</h1>
                <p class="about-desc mb-3" style="color: #555; line-height: 1.7;">
                    <strong>BS Surgical</strong> has established itself as a premier provider of high-quality medical and surgical equipment. Operating from the heart of Delhi, India, we bridge the gap between advanced medical technology and healthcare professionals, delivering excellence in every product.
                </p>
                <p class="about-desc mb-4" style="color: #555; line-height: 1.7;">
                    Specializing in the supply of premium <strong>ENT Operating Microscopes, Surgical Burs,</strong> and specialized clinical instruments, we ensure that our medical clientele receives 100% reliable, certified, and precision-grade materials. Our stringent quality control and direct partnerships with top manufacturers make us a trusted partner in the healthcare industry.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 2. MISSION & VISION SECTION -->
<section class="mv-section section-padding" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row g-4">
            <!-- Mission Card -->
            <div class="col-lg-6 reveal">
                <div class="mv-card bg-white p-5 rounded-4 shadow-sm h-100" style="border-top: 4px solid var(--accent-teal);">
                    <div class="icon-wrap mb-4" style="width: 60px; height: 60px; background: rgba(0,168,184,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-heart-pulse mv-icon" style="font-size: 24px; color: var(--accent-teal);"></i>
                    </div>
                    <h3 class="mv-title" style="color: var(--primary-blue); font-weight: 700; margin-bottom: 15px;">Our Mission</h3>
                    <p class="about-desc mb-0" style="color: #666; line-height: 1.6;">
                        To consistently deliver superior quality surgical and medical equipment to healthcare facilities while maintaining ethical practices. We aim to empower doctors and surgeons by providing them with precise, safe, and technologically advanced instruments.
                    </p>
                </div>
            </div>
            <!-- Vision Card -->
            <div class="col-lg-6 reveal">
                <div class="mv-card bg-white p-5 rounded-4 shadow-sm h-100" style="border-top: 4px solid var(--primary-blue);">
                    <div class="icon-wrap mb-4" style="width: 60px; height: 60px; background: rgba(23,56,90,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-eye mv-icon" style="font-size: 24px; color: var(--primary-blue);"></i>
                    </div>
                    <h3 class="mv-title" style="color: var(--primary-blue); font-weight: 700; margin-bottom: 15px;">Our Vision</h3>
                    <p class="about-desc mb-0" style="color: #666; line-height: 1.6;">
                        To be the nation's most reliable and sustainable partner in the medical equipment supply industry, recognized for our uncompromising quality standards, competitive pricing, and commitment to improving patient care.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. WHY CHOOSE US -->
<section class="inner-wcu section-padding">
    <div class="container">
        <div class="row text-center mb-5 reveal">
            <div class="col-12">
                <span class="sec-subtitle text-uppercase fw-bold" style="color: var(--accent-teal); letter-spacing: 1px; font-size: 14px;">The BS Surgical Advantage</span>
                <h2 class="sec-title" style="color: var(--primary-blue); font-weight: 700;">Why Partner With Us?</h2>
            </div>
        </div>

        <div class="row align-items-center">
            <!-- Left Side Points -->
            <div class="col-lg-4 reveal">
                <div class="wcu-list-item d-flex align-items-start mb-4">
                    <div class="wcu-list-icon me-3 mt-1" style="color: var(--accent-teal); font-size: 1.5rem;"><i class="fa-solid fa-microscope"></i></div>
                    <div class="wcu-list-content">
                        <h4 style="color: var(--primary-blue); font-weight: 600; font-size: 1.1rem;">Advanced Technology</h4>
                        <p class="small text-muted">We provide top-of-the-line Labomed operating microscopes and precision burs designed for critical surgical procedures.</p>
                    </div>
                </div>
                <div class="wcu-list-item d-flex align-items-start mb-4">
                    <div class="wcu-list-icon me-3 mt-1" style="color: var(--accent-teal); font-size: 1.5rem;"><i class="fa-solid fa-certificate"></i></div>
                    <div class="wcu-list-content">
                        <h4 style="color: var(--primary-blue); font-weight: 600; font-size: 1.1rem;">Certified Quality</h4>
                        <p class="small text-muted">Strict adherence to global medical safety standards, fully compliant with international healthcare regulations.</p>
                    </div>
                </div>
            </div>

            <!-- Center Image -->
            <div class="col-lg-4 text-center reveal mb-4 mb-lg-0">
                <div style="padding: 15px; border: 2px dashed var(--accent-teal); border-radius: 50%; display: inline-block;">
                    <img src="assets/images/surgery-icon.jpg" alt="Precision Surgery" style="width: 100%; max-width: 300px; border-radius: 50%; object-fit: cover; aspect-ratio: 1/1;" onerror="this.src='https://images.unsplash.com/photo-1551076805-e1869033e561?q=80&w=600&auto=format&fit=crop'">
                </div>
            </div>

            <!-- Right Side Points -->
            <div class="col-lg-4 reveal">
                <div class="wcu-list-item d-flex align-items-start mb-4">
                    <div class="wcu-list-icon me-3 mt-1" style="color: var(--accent-teal); font-size: 1.5rem;"><i class="fa-solid fa-shield-halved"></i></div>
                    <div class="wcu-list-content">
                        <h4 style="color: var(--primary-blue); font-weight: 600; font-size: 1.1rem;">Durability & Safety</h4>
                        <p class="small text-muted">Our instruments are crafted for longevity, ensuring safety for both surgeons and patients during intensive operations.</p>
                    </div>
                </div>
                <div class="wcu-list-item d-flex align-items-start mb-4">
                    <div class="wcu-list-icon me-3 mt-1" style="color: var(--accent-teal); font-size: 1.5rem;"><i class="fa-solid fa-truck-medical"></i></div>
                    <div class="wcu-list-content">
                        <h4 style="color: var(--primary-blue); font-weight: 600; font-size: 1.1rem;">Reliable Logistics</h4>
                        <p class="small text-muted">A robust supply chain ensuring safe, secure, and timely delivery to hospitals and clinics across the country.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. Dynamic Brands / Clients Slider Section -->
<section class="brands-slider-section py-5" style="background-color: #f8f9fa; border-top: 1px solid #eaeaea;">
    <div class="container">
        <h2 class="text-center mb-5" style="color: var(--primary-blue); font-weight: 700; font-size: 1.5rem; letter-spacing: 1px;">OUR TRUSTED HOSPITALS & PARTNERS</h2>
        
        <div class="brand-slider-container">
            <div class="brand-slide-track">
                <?php if(!empty($brands_array)): ?>
                    <?php 
                    for($loop = 0; $loop < 2; $loop++):
                        foreach($brands_array as $brand):
                            $brandLogo = !empty($brand['logo_path']) ? $brand['logo_path'] : '';
                    ?>
                    <div class="brand-slide">
                        <?php if(!empty($brandLogo)): ?>
                            <img src="admin/<?= htmlspecialchars($brandLogo) ?>" alt="<?= htmlspecialchars($brand['brand_name']) ?>" title="<?= htmlspecialchars($brand['brand_name']) ?>">
                        <?php else: ?>
                            <span class="fw-bold text-dark"><?= htmlspecialchars($brand['brand_name']) ?></span>
                        <?php endif; ?>
                    </div>
                    <?php 
                        endforeach; 
                    endfor; 
                    ?>
                <?php else: ?>
                    <div class="brand-slide"><h4 class="brand-logo" style="color: #999;">ISO Certified</h4></div>
                    <div class="brand-slide"><h4 class="brand-logo" style="color: #999;">CE Mark</h4></div>
                    <div class="brand-slide"><h4 class="brand-logo" style="color: #999;">FDA Approved</h4></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- 5. HOW WE WORK (WORKING PROCESS) -->
<section class="process-section">
    <div class="container">
        <div class="row text-center mb-4 reveal">
            <div class="col-12">
                <span class="sec-subtitle" style="color: #ffffff;">Our Process</span>
                <h2 class="sec-title" style="color: #ffffff;">How We Supply</h2>
            </div>
        </div>

        <div class="process-grid reveal">
            <!-- Step 1 -->
            <div class="process-step">
                <div class="process-icon"><i class="fa-solid fa-handshake"></i></div>
                <h4>1. Consultation</h4>
                <p>Understanding specific equipment needs for your healthcare facility.</p>
            </div>
            <!-- Step 2 -->
            <div class="process-step">
                <div class="process-icon"><i class="fa-solid fa-magnifying-glass-chart"></i></div>
                <h4>2. Quality Sourcing</h4>
                <p>Procuring certified instruments and microscopes from top manufacturers.</p>
            </div>
            <!-- Step 3 -->
            <div class="process-step">
                <div class="process-icon"><i class="fa-solid fa-clipboard-check"></i></div>
                <h4>3. Testing & Calibration</h4>
                <p>Rigorous pre-dispatch testing to ensure flawless precision.</p>
            </div>
            <!-- Step 4 -->
            <div class="process-step">
                <div class="process-icon"><i class="fa-solid fa-truck-fast"></i></div>
                <h4>4. Safe Delivery</h4>
                <p>Secure installation and delivery at hospitals and clinics.</p>
            </div>
        </div>
    </div>
</section>

<style>
    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease-out;
    }
    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }
    @media (min-width: 992px) {
        .process-step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 40px;
            right: -50%;
            width: 100%;
            height: 2px;
            background: rgba(255, 255, 255, 0.2);
            border-top: 2px dashed rgba(255, 255, 255, 0.5);
            z-index: 0;
        }
        .process-step .process-icon {
            position: relative;
            z-index: 1;
        }
    }
</style>

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
        }, {
            threshold: 0.15
        });

        reveals.forEach(reveal => revealOnScroll.observe(reveal));
    });
</script>

<?php include 'includes/footer.php'; ?>