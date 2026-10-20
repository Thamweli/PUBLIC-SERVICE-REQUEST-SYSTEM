
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/includes/functions.php';

$isLoggedIn = isset($_SESSION['user']) && is_array($_SESSION['user']);

$userRole = $isLoggedIn
    ? ($_SESSION['user']['role'] ?? '')
    : '';

$isAdmin = $isLoggedIn && $userRole === 'admin';
$isCitizen = $isLoggedIn && $userRole === 'citizen';

if ($isLoggedIn) {
    if ($isAdmin) {
        $dashboardUrl = 'admin/dashboard.php';
    } elseif ($isCitizen) {
        $dashboardUrl = 'citizen/dashboard.php';
    } else {
        $dashboardUrl = 'dashboard.php';
    }
} else {
    $dashboardUrl = 'login.php';
}

// Choose the correct destination for request-related actions.
if ($isCitizen) {
    $submitRequestUrl = 'citizen/create-request.php';
    $viewRequestsUrl = 'citizen/my-requests.php';
} elseif ($isAdmin) {
    $submitRequestUrl = 'admin/dashboard.php';
    $viewRequestsUrl = 'admin/manage-requests.php';
} else {
    $submitRequestUrl = 'login.php';
    $viewRequestsUrl = 'login.php';
}

$displayName = $isLoggedIn
    ? ($_SESSION['user']['full_name'] ?? 'User')
    : '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Murang'a Public Service Request System</title>

    <meta
        name="description"
        content="Report public service problems in Murang'a County and track their progress online."
    >

    <link rel="stylesheet" href="assets/css/home.css">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >
</head>

<body>

<header class="navbar">

    <a href="index.php" class="brand">
        <span class="logo">
            <i class="fa-solid fa-landmark"></i>
        </span>

        <span>Murang'a Public Service</span>
    </a>

    <button
        class="menu-toggle"
        id="menu-toggle"
        aria-label="Toggle navigation"
        aria-expanded="false"
        type="button"
    >
        <i class="fa-solid fa-bars"></i>
    </button>

    <nav class="nav-links" id="nav-links">

        <a href="index.php" class="nav-current">Home</a>

        <a href="#services">Services</a>

        <a href="login.php">User Login</a>

        <a href="login.php">Admin Login</a>

        <?php if ($isLoggedIn): ?>

            <a href="<?= e($dashboardUrl) ?>" class="btn btn-login">
                My Dashboard
            </a>

            <a href="logout.php" class="btn btn-admin">
                Logout
            </a>

        <?php else: ?>

        <?php endif; ?>

    </nav>

</header>

<main>

    <!-- HERO SECTION -->
    <section class="hero" id="home">

        <div class="hero-content">

            <div class="status-indicator">
                <span></span>
            </div>

            <p class="hero-description">
                Report public service problems, submit requests,
                and follow their progress online.
            </p>

            <div class="hero-actions">

                <?php if ($isCitizen): ?>

                    <a href="<?= e($submitRequestUrl) ?>"
                       class="btn btn-explore">
                        Report an Issue
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                    <a href="<?= e($viewRequestsUrl) ?>"
                       class="btn btn-secondary">
                        Track My Requests
                    </a>

                <?php elseif ($isAdmin): ?>

                    <a href="<?= e($dashboardUrl) ?>"
                       class="btn btn-explore">
                        Open Admin Dashboard
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                    <a href="<?= e($viewRequestsUrl) ?>"
                       class="btn btn-secondary">
                        Manage Requests
                    </a>

                <?php else: ?>

                    <a href="register.php" class="btn btn-explore">
                        Get Started
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                    <a href="login.php" class="btn btn-secondary">
                        Sign In
                    </a>

                <?php endif; ?>

            </div>

            <div class="hero-note">
                <i class="fa-solid fa-circle-check"></i>
                Easy reporting. Transparent tracking. Better services.
            </div>

        </div>

        <div class="hero-visual">

            <a
                href="<?= e($submitRequestUrl) ?>"
                class="floating-card team-card"
                style="text-decoration: none; color: inherit;"
            >
                <i class="fa-solid fa-users"></i>

                <div>
                    <strong>Community: Your Voice Matters</strong>
                </div>
            </a>

            <div class="board-card">

                <div class="board-icon">
                    <i class="fa-solid fa-building-circle-check"></i>
                </div>

                <h2>PUBLIC SERVICE REQUESTS</h2>

                <p>Connecting Citizens to Better Services</p>

                <div class="board-divider"></div>

                <div class="board-features">

                    <div>
                        <i class="fa-solid fa-lightbulb"></i>
                        <span>Streetlights</span>
                    </div>

                    <div>
                        <i class="fa-solid fa-droplet"></i>
                        <span>Water Issues</span>
                    </div>

                    <div>
                        <i class="fa-solid fa-trash"></i>
                        <span>Garbage Collection</span>
                    </div>

                    <div>
                        <i class="fa-solid fa-road"></i>
                        <span>Road Damage</span>
                    </div>

                    <div>
                        <i class="fa-solid fa-water"></i>
                        <span>Drainage</span>
                    </div>

                    <div>
                        <i class="fa-solid fa-clipboard-check"></i>
                        <span>Request Tracking</span>
                    </div>

                </div>

            </div>

            <a
                href="<?= e($submitRequestUrl) ?>"
                class="floating-card opportunity-card"
                style="text-decoration: none; color: inherit; cursor: pointer;"
            >
                <i class="fa-solid fa-file-circle-plus"></i>

                <div>
                    <small>Have an issue?</small>
                    <strong>Submit a Request</strong>
                </div>
            </a>

        </div>

        <a
            href="#services"
            class="scroll-down"
            aria-label="View services"
        >
            <i class="fa-solid fa-chevron-down"></i>
        </a>

    </section>

    <!-- SERVICES SECTION -->
    <section class="careers-section" id="services">

        <div class="section-heading">

            <span class="section-label">OUR SERVICES</span>

            <h2>
                <a
                    href="#service-options"
                    style="color: inherit; text-decoration: none;"
                >
                    How Can We Help You?
                </a>
            </h2>

            <p>
                Use the Public Service Request System to report problems
                affecting your neighbourhood and monitor their progress.
            </p>

        </div>

        <div class="career-grid" id="service-options">

            <!-- SUBMIT REQUEST CARD -->
            <article class="career-card">

                <div class="career-icon">
                    <i class="fa-solid fa-file-circle-plus"></i>
                </div>

                <h3>Report an Issue</h3>

                <p>
                    Submit a service request, describe the problem,
                    provide its location, and optionally attach a photo.
                </p>

                <a href="<?= e($submitRequestUrl) ?>">
                    Submit a Request
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </article>

            <!-- TRACK REQUESTS CARD -->
            <article class="career-card">

                <div class="career-icon">
                    <i class="fa-solid fa-magnifying-glass-location"></i>
                </div>

                <h3>
                    <a
                        href="<?= e($viewRequestsUrl) ?>"
                        style="color: inherit; text-decoration: none;"
                    >
                        Track Your Requests
                    </a>
                </h3>

                <p>
                    Check your submitted requests, reference numbers,
                    and the latest recorded status updates.
                </p>

                <a href="<?= e($viewRequestsUrl) ?>">
                    View Requests
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </article>

            <!-- FOLLOW PROGRESS CARD -->
            <article class="career-card">

                <div class="career-icon">
                    <i class="fa-solid fa-clipboard-check"></i>
                </div>

                <h3>Follow Progress</h3>

                <p>
                    Follow status changes as requests move from Pending
                    to In Progress and, when completed, Resolved.
                </p>

                <a href="<?= e($isLoggedIn ? $dashboardUrl : 'login.php') ?>">
                    <?= $isLoggedIn ? 'Open Dashboard' : 'Sign In' ?>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </article>

        </div>

    </section>

    <!-- HOW IT WORKS SECTION -->
    <section class="process-section" id="how-it-works">

        <div class="section-heading">

            <span class="section-label">SIMPLE AND TRANSPARENT</span>

            <h2>How the System Works</h2>

            <p>
                Three simple steps to report and track a public service issue.
            </p>

        </div>

        <div class="process-grid">

            <article class="process-card">

                <span class="step-number">01</span>

                <i class="fa-solid fa-user-plus"></i>

                <h3>Create an Account</h3>

                <p>
                    Register as a citizen and sign in securely.
                </p>

                <a href="<?= e($isLoggedIn ? $dashboardUrl : 'register.php') ?>"
                   style="color: inherit; text-decoration: none;">
                    <?= $isLoggedIn ? 'Open Dashboard' : 'Register Now' ?>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </article>

            <article class="process-card">

                <span class="step-number">02</span>

                <i class="fa-solid fa-file-pen"></i>

                <h3>Submit Your Request</h3>

                <p>
                    Describe the problem and provide the location.
                </p>

                <a href="<?= e($submitRequestUrl) ?>"
                   style="color: inherit; text-decoration: none;">
                    Submit a Request
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </article>

            <article class="process-card">

                <span class="step-number">03</span>

                <i class="fa-solid fa-list-check"></i>

                <h3>Track Progress</h3>

                <p>
                    Use your dashboard to view recorded status updates.
                </p>

                <a href="<?= e($viewRequestsUrl) ?>"
                   style="color: inherit; text-decoration: none;">
                    View Requests
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </article>

        </div>

    </section>

    <!-- CALL TO ACTION -->
    <section class="call-to-action" id="contact">

        <div>

            <span class="section-label">
                LET'S IMPROVE OUR COMMUNITY
            </span>

            <h2>See a Problem? Let Us Know.</h2>

        </div>

       

    </section>

</main>

<!-- FOOTER -->
<footer class="footer">

    <p>
        &copy; <?= date('Y') ?> Murang'a Public Service Request System.
    </p>

    <a href="#home">Back to top ↑</a>

</footer>

<!-- MOBILE NAVIGATION -->
<script>
const menuToggle = document.getElementById('menu-toggle');
const navLinks = document.getElementById('nav-links');

if (menuToggle && navLinks) {
    menuToggle.addEventListener('click', function () {
        const isOpen = navLinks.classList.toggle('active');

        menuToggle.setAttribute(
            'aria-expanded',
            String(isOpen)
        );
    });
}
</script>

</body>
</html>
