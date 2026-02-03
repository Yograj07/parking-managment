<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ParkFlow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/theme.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>

<body class="home">
    <div class="page-loader" id="pageLoader" aria-live="polite" aria-busy="true">
        <div class="loader-content">
            <span class="loader-logo">ParkFlow</span>
            <span class="loader-spinner"></span>
            <span class="loader-text">Preparing your experience</span>
        </div>
    </div>

    <?php include "./includes/navbar.php"; ?>

    <header class="hero">
        <div class="hero-content animate" style="--delay: 0.05s;">
            <span class="hero-badge">Smart Parking Platform</span>
            <h1>Modern parking operations with real-time visibility and effortless control.</h1>
            <p>
                ParkFlow helps drivers and admins coordinate every step of the parking journey
                with live slot tracking, secure access, and a clean, intuitive dashboard.
            </p>
            <div class="hero-actions">
                <a class="btn primary" href="login.php">Get Started</a>
                <a class="btn ghost" href="register.php">Create Account</a>
            </div>
            <div class="hero-highlights">
                <div class="animate" style="--delay: 0.15s;">
                    <strong>Live slot status</strong>
                    <span>Always in sync</span>
                </div>
                <div class="animate" style="--delay: 0.2s;">
                    <strong>Fast check-in</strong>
                    <span>One-click parking</span>
                </div>
                <div class="animate" style="--delay: 0.25s;">
                    <strong>Role-based access</strong>
                    <span>Secure workflows</span>
                </div>
            </div>
        </div>
        <div class="hero-visual">
            <div class="hero-showcase animate" style="--delay: 0.2s;">
                <div class="showcase-head">
                    <div>
                        <span class="showcase-title">Live Slot Status</span>
                        <small>Realtime monitoring</small>
                    </div>
                    <div class="showcase-count">18</div>
                </div>
                <div class="showcase-media">
                    <img src="./assets/images/illustrator_final.png" alt="ParkFlow dashboard preview">
                    <div class="showcase-badge">Auto-assign active</div>
                </div>
                <div class="showcase-stats">
                    <div>
                        <span>Available</span>
                        <strong>12</strong>
                    </div>
                    <div>
                        <span>Occupied</span>
                        <strong>4</strong>
                    </div>
                    <div>
                        <span>Disabled</span>
                        <strong>2</strong>
                    </div>
                </div>
                <div class="showcase-slots">
                    <div class="slot-cell available">A1</div>
                    <div class="slot-cell available">A2</div>
                    <div class="slot-cell occupied">A3</div>
                    <div class="slot-cell available">A4</div>
                    <div class="slot-cell available">B1</div>
                    <div class="slot-cell occupied">B2</div>
                </div>
                <div class="slot-legend">
                    <span><i class="dot available"></i>Available</span>
                    <span><i class="dot occupied"></i>Occupied</span>
                    <span><i class="dot disabled"></i>Disabled</span>
                </div>
            </div>
        </div>
    </header>

    <section class="feature-section" id="features">
        <div class="section-head">
            <span>Core Features</span>
            <h2>Everything you need to run smart parking in one place.</h2>
        </div>
        <div class="feature-grid">
            <div class="feature-card animate" style="--delay: 0.1s;">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 7h16v10H4z" fill="none" stroke="currentColor" stroke-width="2"/>
                        <path d="M8 7V5h8v2" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h3>Smart Slot Visibility</h3>
                <p>Track available, occupied, and disabled slots with a clean visual grid.</p>
            </div>
            <div class="feature-card animate" style="--delay: 0.15s;">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M7 12l3 3 7-7" fill="none" stroke="currentColor" stroke-width="2"/>
                        <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h3>User-Friendly Actions</h3>
                <p>Drivers can park, exit, and view history in seconds from any device.</p>
            </div>
            <div class="feature-card animate" style="--delay: 0.2s;">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 5h16v4H4zM6 9v10h12V9" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h3>Admin Oversight</h3>
                <p>Manage users, control slots, and review activity through unified reports.</p>
            </div>
            <div class="feature-card animate" style="--delay: 0.25s;">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 3l7 4v6c0 4-3 6-7 8-4-2-7-4-7-8V7z" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h3>Secure Workflows</h3>
                <p>Role-based permissions keep data safe and operations consistent.</p>
            </div>
        </div>
    </section>

    <section class="metrics">
        <div class="metric animate" style="--delay: 0.1s;">
            <div class="metric-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M4 12h6l2-6 2 12 2-6h4" fill="none" stroke="currentColor" stroke-width="2"/>
                </svg>
            </div>
            <h3>Live status</h3>
            <p>Real-time slot updates and instant parking confirmation.</p>
        </div>
        <div class="metric animate" style="--delay: 0.15s;">
            <div class="metric-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7 12l3 3 7-7" fill="none" stroke="currentColor" stroke-width="2"/>
                    <path d="M4 5h16v14H4z" fill="none" stroke="currentColor" stroke-width="2"/>
                </svg>
            </div>
            <h3>Faster exits</h3>
            <p>Exit vehicles with a single click and release slots immediately.</p>
        </div>
        <div class="metric animate" style="--delay: 0.2s;">
            <div class="metric-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M4 4h16v16H4z" fill="none" stroke="currentColor" stroke-width="2"/>
                    <path d="M8 9h8M8 13h6" fill="none" stroke="currentColor" stroke-width="2"/>
                </svg>
            </div>
            <h3>Clear history</h3>
            <p>Track every entry and exit for accurate reporting.</p>
        </div>
    </section>

    <section class="steps" id="how">
        <div class="section-head">
            <span>How It Works</span>
            <h2>Simple for drivers, powerful for admins.</h2>
        </div>
        <div class="steps-grid">
            <div class="step-card animate" style="--delay: 0.1s;">
                <span>01</span>
                <div class="step-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 7h16v10H4z" fill="none" stroke="currentColor" stroke-width="2"/>
                        <path d="M8 7V5h8v2" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h4>Add Vehicles</h4>
                <p>Register vehicles once for a quick parking workflow.</p>
            </div>
            <div class="step-card animate" style="--delay: 0.15s;">
                <span>02</span>
                <div class="step-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M3 12h18M6 16h12" fill="none" stroke="currentColor" stroke-width="2"/>
                        <path d="M6 8h12" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h4>Park & Manage</h4>
                <p>Select a vehicle, choose a slot or auto-assign, and park instantly.</p>
            </div>
            <div class="step-card animate" style="--delay: 0.2s;">
                <span>03</span>
                <div class="step-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 4h16v16H4z" fill="none" stroke="currentColor" stroke-width="2"/>
                        <path d="M8 9h8M8 13h6" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h4>Track History</h4>
                <p>View entry, exit, and slot history across all users and vehicles.</p>
            </div>
        </div>
    </section>

    <section class="cta" id="cta">
        <div class="cta-content animate" style="--delay: 0.1s;">
            <h2>Ready to run smarter parking operations?</h2>
            <p>Launch ParkFlow for your campus, mall, or office with a clean and modern experience.</p>
            <div class="cta-actions">
                <a class="btn primary" href="register.php">Create an Account</a>
                <a class="btn ghost" href="login.php">Sign In</a>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="contact-card animate" style="--delay: 0.1s;">
            <div class="contact-text">
                <h2>Get in touch</h2>
                <p>Have questions or feedback? Send us a note and we will respond quickly.</p>
            </div>
            <form class="contact-form" method="POST">
                <div class="field-grid">
                    <input type="text" placeholder="First name" maxlength="20" required>
                    <input type="text" placeholder="Last name" maxlength="20" required>
                </div>
                <input type="tel" maxlength="10" placeholder="Mobile number" required>
                <textarea rows="4" placeholder="Your message" required></textarea>
                <button type="submit">Send message</button>
            </form>
        </div>
    </section>

    <?php include "./includes/footer.php"; ?>

    <script src="assets/js/layout.js"></script>
    <script>
        const revealItems = document.querySelectorAll('.animate');
        const revealObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('in-view');
                        revealObserver.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.2 }
        );

        revealItems.forEach((item) => revealObserver.observe(item));
    </script>
</body>

</html>
