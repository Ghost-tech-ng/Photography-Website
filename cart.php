<?php
session_start(); // Start the session

// Remove single item from the cart
if (isset($_GET['remove_id'])) {
    $remove_id = $_GET['remove_id'];
    if (isset($_SESSION['cart'][$remove_id])) {
        unset($_SESSION['cart'][$remove_id]);  // Remove the item from the session
    }
    header('Location: cart.php');  // Redirect to the cart page after removing
    exit();
}

// Clear the entire cart
if (isset($_GET['clear_cart'])) {
    unset($_SESSION['cart']);  // Clear the cart session
    header('Location: cart.php');  // Redirect to the cart page after clearing
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Updated title for branding and SEO -->
    <title>Cart - McCall Southern Photography </title>

    <!-- Standard meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Updated meta for SEO -->
    <meta name="author" content="McCall Southern Photography">
    <meta name="keywords" content="photography, professional photography, portfolio, wedding photography, event photography, family portraits, online galleries, photography services, photo editing, photo studio, McCall Southern">
    <meta name="description" content="McCall Southern Photography offers professional photography services including wedding photography, portraits, and events. Explore our portfolio and book sessions online.">

    <!-- Social media meta tags for improved sharing -->
    <meta property="og:title" content="McCall Southern Photography - Professional Photographer Portfolio & Services">
    <meta property="og:description" content="Explore McCall Southern Photography's portfolio and book professional photography sessions online. Offering weddings, portraits, events, and more.">
    <meta property="og:image" content="https://yourwebsite.com/assets/og-image.jpg">
    <!-- Replace with actual image URL -->
    <meta property="og:url" content="https://yourwebsite.com">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="McCall Southern Photography">
    <meta name="twitter:description" content="Explore McCall Southern Photography's portfolio and book professional photography sessions online.">

    <!-- Canonical URL for SEO -->
    <link rel="canonical" href="https://yourwebsite.com">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/vendor.css">
    <link rel="stylesheet" type="text/css" href="fonts/icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- Favicon for branding -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Replace with actual favicon -->
</head>


<body class="bg-black">

    <div class="preloader">
        <svg>
	  <g>
	    <path d="M 50,100 A 1,1 0 0 1 50,0"/>
	  </g>
	  <g>
	    <path d="M 50,75 A 1,1 0 0 0 50,-25"/>
	  </g>
	  <defs>
	    <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
	      <stop offset="0%" style="stop-color:#FF56A1;stop-opacity:1" />
	      <stop offset="100%" style="stop-color:#FF9350;stop-opacity:1" />
	    </linearGradient>
	  </defs>
	</svg>
    </div>

    <div class="nav nav-overlay">
        <div class="nav__content">
            <ul class="nav__list">
                <li class="nav__list-item"><a href="index.html" class="hover-target">Home</a></li>
                <li class="nav__list-item"><a href="about.html" class="hover-target">About</a></li>
                <li class="nav__list-item"><a href="services.html" class="hover-target">Services</a></li>
                <li class="nav__list-item"><a href="portfolio.html" class="hover-target">Portfolio</a></li>
                <li class="nav__list-item"><a href="testimonials.html" class="hover-target">Testimonials</a></li>
                <li class="nav__list-item"><a href="blog.php" class="hover-target">Blog</a></li>
                <li class="nav__list-item"><a href="faq.html" class="hover-target">FAQ</a></li>
                <li class="nav__list-item"><a href="shop.php" class="hover-target">Shop</a></li>
                <li class="nav__list-item active-nav"><a href="cart.php" class="hover-target">Cart</a></li>
                <li class="nav__list-item"><a href="contact.html" class="hover-target">Contact</a></li>
            </ul>
        </div>
    </div>

    <header id="header" class="light">
        <div id="header-wrap">
            <nav id="navbar">
                <div class="main-logo">
                    <a href="index.html">
                        <img src="images/logo.png" alt="McCall Southern Photography Logo" style="max-width: 150px; height: auto;">
                    </a>
                </div>


                <div class="action-menu">
                    <input id="menu-toggle" type="checkbox" />
                    <label class="menu-btn" for="menu-toggle">
                        <span></span>
                    </label>
                </div>
                <!--action-menu-->
            </nav>
        </div>
        <!--header-wrap-->
    </header>


<div class="shop-container">
    <h1>Your Cart</h1>

    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <div class="shop-grid">
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <div class="shop-item">
                    <h3><?php echo $item['title']; ?></h3>
                    <p class="price">$<?php echo number_format($item['price'], 2); ?></p>
                    <a href="cart.php?remove_id=<?php echo $item['id']; ?>" class="remove-button">Remove</a>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Clear Cart button -->
        <form action="cart.php" method="GET">
            <button type="submit" name="clear_cart" class="clear-cart-button">Clear Cart</button>
        </form>

        <form action="checkout.php" method="POST">
            <input type="email" name="email" placeholder="Enter your email for delivery" required>
            <button type="submit" class="buy-button">Checkout</button>
        </form>
    <?php else: ?>
        <h5><p>Your cart is empty.</p></h5>
    <?php endif; ?>
</div>

<footer id="footer" class="bg-black light padding-xlarge" style="background-image: url(images/photography.jpg); background-position: right; background-repeat: no-repeat;">
    <div class="container">
        <div class="row">
            <div class="contact-information mt-4 d-flex">
                <div class="contact-detail col-md-6">
                    <div class="detail mr-6 mb-4">
                        <ul class="list-unstyled colored-grey text-large">
                            <li>123 Southern Ave, Charleston, SC 29401, USA</li>
                            <li>+1 843-555-1234 / +1 843-555-5678</li>
                            <li><a href="mailto:info@mccallsouthern.com" class="colored">info@mccallsouthern.com</a></li>
                            <li>© 2024 McCall Southern Photography. All rights reserved.</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 p-0">
                    <div class="container">
                        <div class="row">
                            <h3>Quick Contact</h3>
                            <form action="https://www.mccallsouthern.com/contact.php" class="contact-form d-flex flex-wrap mt-4">
                                <input type="text" name="name" placeholder="Your Name" class="name mb-3" required>
                                <input type="email" name="email" placeholder="Your Email" class="mb-3" required>
                                <textarea name="message" placeholder="Your Message" style="height: 150px;" required></textarea>
                                <div class="pix_btn btn-click text-center mt-5">
                                    <button type="submit" class="btn btn-pill btn-large btn-outline-light mr-3" data-hover="click">
                                        <span>Send Message</span>
                                        <i class="icon icon-paper-plane"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>
