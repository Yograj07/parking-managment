<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>How It Works | ParkFlow</title>
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
            <span class="page-badge">How It Works</span>
            <h1>Simple steps for users, full control for admins.</h1>
            <p>
                ParkFlow keeps the experience clean and predictable, from vehicle registration
                to entry, exit, and reporting.
            </p>
        </div>
    </header>

    <section class="page-section">
        <div class="steps-grid">
            <div class="step-card">
                <span>01</span>
                <div class="step-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 7h16v10H4z" fill="none" stroke="currentColor" stroke-width="2"/>
                        <path d="M8 7V5h8v2" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h4>Create an account</h4>
                <p>Users register once to access vehicles, parking, and history.</p>
            </div>
            <div class="step-card">
                <span>02</span>
                <div class="step-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 12h16" fill="none" stroke="currentColor" stroke-width="2"/>
                        <path d="M4 6h10M4 18h10" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h4>Add vehicles</h4>
                <p>Store vehicles to park quickly without re-entering details.</p>
            </div>
            <div class="step-card">
                <span>03</span>
                <div class="step-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M3 12h18M6 16h12" fill="none" stroke="currentColor" stroke-width="2"/>
                        <path d="M6 8h12" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h4>Park with confidence</h4>
                <p>Choose a slot or auto-assign for instant parking approval.</p>
            </div>
            <div class="step-card">
                <span>04</span>
                <div class="step-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 4h16v16H4z" fill="none" stroke="currentColor" stroke-width="2"/>
                        <path d="M8 9h8M8 13h6" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h4>Exit and release</h4>
                <p>Exit in one click and free the slot for the next driver.</p>
            </div>
        </div>
    </section>

    <section class="page-section soft">
        <div class="section-head">
            <span>Admin Flow</span>
            <h2>Admins manage capacity, people, and reports in one place.</h2>
        </div>
        <div class="grid-two">
            <div class="card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 5h16v4H4zM6 9v10h12V9" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h3>Slot Management</h3>
                <p>Add, enable, or disable slots based on demand and maintenance.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M7 12l3 3 7-7" fill="none" stroke="currentColor" stroke-width="2"/>
                        <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h3>User Oversight</h3>
                <p>Approve access and monitor active or disabled users.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 4h16v16H4z" fill="none" stroke="currentColor" stroke-width="2"/>
                        <path d="M8 9h8M8 13h6" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h3>Reporting</h3>
                <p>Track daily activity and full parking history in seconds.</p>
            </div>
            <div class="card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 3l7 4v6c0 4-3 6-7 8-4-2-7-4-7-8V7z" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h3>Live Monitoring</h3>
                <p>Review parked vehicles and slot usage at any moment.</p>
            </div>
        </div>
    </section>

    <section class="page-section">
        <div class="cta-strip">
            <div>
                <h3>Ready to streamline your parking?</h3>
                <p>Launch ParkFlow for your team and start tracking in minutes.</p>
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
