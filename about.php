<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About | ParkFlow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/theme.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/pages.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>

<body class="page">
    <?php include "./includes/navbar.php"; ?>

    <header class="page-hero">
        <div>
            <span class="page-badge">About ParkFlow</span>
            <h1>Built to simplify parking operations for everyone.</h1>
            <p>
                ParkFlow is a modern parking management platform designed to reduce wait time,
                improve slot utilization, and give admins full visibility into daily operations.
            </p>
        </div>
    </header>

    <section class="page-section">
        <div class="grid-two">
            <div class="card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 3l7 4v6c0 4-3 6-7 8-4-2-7-4-7-8V7z" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h3>Our Mission</h3>
                <p>
                    Deliver a calm, efficient parking experience through smart workflows,
                    accurate tracking, and role-based control.
                </p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 5h16v4H4zM6 9v10h12V9" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h3>What We Solve</h3>
                <p>
                    We eliminate confusion by showing live slot status, preventing double
                    parking, and keeping history organized for reporting.
                </p>
            </div>
        </div>
    </section>

    <section class="page-section soft">
        <div class="section-head">
            <span>Values</span>
            <h2>Designed for clarity, speed, and reliability.</h2>
        </div>
        <div class="feature-grid">
            <div class="feature-card">
                <div class="card-icon small">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 12h16" fill="none" stroke="currentColor" stroke-width="2"/>
                        <path d="M4 6h10M4 18h10" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h4>Clarity</h4>
                <p>Clean UI and structured data so every action is confident.</p>
            </div>
            <div class="feature-card">
                <div class="card-icon small">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M7 12l3 3 7-7" fill="none" stroke="currentColor" stroke-width="2"/>
                        <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h4>Speed</h4>
                <p>Fast parking and quick exits keep operations flowing.</p>
            </div>
            <div class="feature-card">
                <div class="card-icon small">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 3l7 4v6c0 4-3 6-7 8-4-2-7-4-7-8V7z" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h4>Trust</h4>
                <p>Role-based access and audit trails for every vehicle.</p>
            </div>
        </div>
    </section>

    <section class="page-section">
        <div class="cta-strip">
            <div>
                <h3>Want to see ParkFlow in action?</h3>
                <p>Start with a demo account and explore the full workflow.</p>
            </div>
            <div class="cta-actions">
                <a class="btn primary" href="register.php">Create Account</a>
                <a class="btn ghost" href="login.php">Sign In</a>
            </div>
        </div>
    </section>

    <?php include "./includes/footer.php"; ?>
</body>

</html>
