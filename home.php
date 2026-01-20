<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ParkFlow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <script src="https://kit.fontawesome.com/b0b345bbc9.js" crossorigin="anonymous"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>

</head>

<body>
    <nav>
        <div class="header">
            <h1>ParkFlow <img src="./assets/images/favicon.png" alt="logo" width="40px"></h1>
        </div>
        <ul>
            <li>Login</li>
            <li>SignUp</li>
        </ul>
    </nav>


    <main>
        <div class="main-container">
            <div class="side-headings-main">
                <h1><span class="bg-alternate">Transform</span><span class="transform-icn"><lord-icon
                            src="https://cdn.lordicon.com/nlowgkwj.json"
                            trigger="loop"
                            delay="1000"
                            colors="secondary:#8F0177,secondary:#1b1091"
                            style="width:70px;height:70px">
                        </lord-icon></span> Your Parking Experience with <span class="bg-alternate">Smart</span> ParkFlow Technology.</h1>
                <p>Effortless Parking, Elevated Experience instant navigation & contactless access at zero wait time.</p>
                <a href="#">Get Started</a>
            </div>
            <div class="side-img">
                <img src="./assets/images/illustrator_final.png" alt="ParkFlow">
            </div>
        </div>
        <div class="cover-dot">
            <div class="dot"></div>
        </div>
    </main>

    <section>
        <div class="section-container">
            <div class="items">
                <div class="item-carts"><span><lord-icon
                            src="https://cdn.lordicon.com/jectmwqf.json"
                            trigger="loop"
                            delay="1500"
                            colors="secondary:#8F0177,primary:#1b1091"
                            style="width:140px;height:140px">
                        </lord-icon></span>
                    <h5>Smart Spot Detection</h5>
                </div>
                <div class="item-carts"><span><lord-icon
                            src="https://cdn.lordicon.com/edcgvlnw.json"
                            trigger="loop"
                            delay="1500"
                            colors="primary:#1b1091,secondary:#8f0177"
                            style="width:140px;height:140px">
                        </lord-icon></span>
                    <h5>Userfreindly System</h5>
                </div>
                <div class="item-carts"><span><lord-icon
                            src="https://cdn.lordicon.com/fgxwhgfp.json"
                            trigger="loop"
                            delay="1500"
                            colors="primary:#1b1091,secondary:#8f0177"
                            style="width:140px;height:140px">
                        </lord-icon></span>
                    <h5>Secure Payment Service</h5>
                </div>
                <div class="item-carts"><span><lord-icon
                            src="https://cdn.lordicon.com/onmwuuox.json"
                            trigger="loop"
                            delay="1500"
                            colors="primary:#1b1091,secondary:#8f0177"
                            style="width:140px;height:140px">
                        </lord-icon></span>
                    <h5>Access From Anywhere</h5>
                </div>
            </div>
        </div>
    </section>

    <div class="suggestion-container">


        <form method="POST">
            <h1>Get in touch</h1>
            <hr>
            <input type="text" placeholder="Enter first name" maxlength="20" id="texts" required>
            <input type="text" placeholder="Enter last name" maxlength="20" id="texts" required>
            <input type="tel" maxlength="10" placeholder="Enter mobile number" id="texts" required />
            <textarea name="suggestion" id="" rows="3" cols="50" placeholder="Enter your valuable suggestion" required></textarea>

            <button>
                Send now
            </button>

        </form>
        <div class="sugestion-illustraion">
            <img src="./assets/images/get_in_touch_illustration.png" alt="img">
        </div>
    </div>
    <div class="cover-dot ">
        <div class="mrgbt"></div>
    </div>

    <?php
    include "./includes/footer.php";
    ?>

</body>

</html>