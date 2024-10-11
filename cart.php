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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/vendor.css">
    <link rel="stylesheet" type="text/css" href="fonts/icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- Favicon for branding -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Replace with actual favicon -->

    <style>
        .shop-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #000;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .shop-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }

        .shop-item {
            background-color: #000;
            border-radius: 8px;
            color: white;
            padding: 15px;
            width: calc(33.333% - 20px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .shop-item img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .shop-item h3 {
            font-size: 18px;
            margin: 10px 0;
        }

        .shop-item .price {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .remove-button,
        .clear-cart-button,
        .buy-button {
            padding: 10px 15px;
            font-size: 14px;
            border: none;
            background-color: #1e90ff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .remove-button {
            background-color: #ff4d4d;
        }

        .shop-container form {
            margin-top: 20px;
            text-align: center;
        }

        .clear-cart-button {
            background-color: #ff4d4d;
        }

        .shop-item img {
            max-width: 100px;
            height: auto;
            margin-bottom: 10px;
        }

        .alert {
            background-color: #ff4d4d;
            color: white;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .shop-item {
                width: calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .shop-item {
                width: 100%;
            }
        }
         /* General header styles */
        
         #header {
            background-color: #000;
            padding: 10px 0;
            color: #fff;
        }
        
        #header-wrap {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        #navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }
        /* Logo */
        
        .main-logo img {
            max-width: 150px;
            height: auto;
        }
        /* Navigation list */
        
        .nav__list {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
            align-items: center;
        }
        
        .navigate {
            margin: 0 20px;
            position: relative;
        }
        
        .navigate a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            padding: 10px;
            transition: color 0.3s ease;
        }
        /* Hover effect for links */
        
        .navigate a:hover {
            color: #1e90ff;
        }
        /* Dropdown menu */
        
        .dropdown .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #111;
            list-style: none;
            top: 40px;
            left: 0;
            padding: 0;
            z-index: 10;
        }
        
        .dropdown .dropdown-menu li {
            padding: 10px;
        }
        
        .dropdown .dropdown-menu li a {
            color: #fff;
            text-decoration: none;
            display: block;
        }
        
        .dropdown:hover .dropdown-menu {
            display: block;
        }
        /* Cart icon styles */
        
        .cart-icon {
            color: #fff;
            font-size: 24px;
            padding: 10px;
        }
        
        .cart-icon:hover {
            color: #1e90ff;
        }
        /* Hamburger icon */
        
        .menu-icon {
            display: none;
            cursor: pointer;
            font-size: 24px;
            color: #fff;
        }
        /* Mobile responsiveness */
        
        @media (max-width: 768px) {
            #navbar {
                flex-direction: column;
                align-items: flex-start;
            }
            .nav__list {
                display: none;
                /* Hide the menu on mobile by default */
                flex-direction: column;
                width: 100%;
            }
            .navigate {
                margin: 10px 0;
                width: 100%;
            }
            .dropdown .dropdown-menu {
                position: relative;
                top: 0;
                left: 0;
            }
            /* Show the hamburger icon */
            .menu-icon {
                display: block;
            }
            /* When checkbox is checked, show the menu */
            .menu-toggle:checked+.menu-icon+.nav__list {
                display: flex;
            }
        }
    </style>
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

    <header id="header" class="dark">
        <div id="header-wrap">
            <nav id="navbar">
                <!-- Logo -->
                <div class="main-logo">
                    <a href="index.html">
                        <img src="images/logo.png" alt="Logo" style="max-width: 250px; height: 200px;">
                    </a>
                </div>

                <!-- Action menu for mobile (Hamburger Icon) -->
                <!-- <input type="checkbox" id="menu-toggle" class="menu-toggle"> -->
                <label for="menu-toggle" class="menu-icon">
                    <i class="fas fa-bars"></i> <!-- Font Awesome hamburger icon -->
                </label>

                <!-- Navigation List -->
                <ul class="nav__list">
                    <li class="navigate"><a href="index.html" class="hover-target">Home</a></li>
                    <li class="navigate"><a href="about.html" class="hover-target">About</a></li>
                    <li class="navigate"><a href="services.html" class="hover-target">Services</a></li>
                    <li class="navigate"><a href="portfolio.html" class="hover-target">Portfolio</a></li>
                    <li class="navigate"><a href="testimonials.html" class="hover-target">Testimonials</a></li>

                    <!-- Dropdown for Other Pages -->
                    <li class="navigate dropdown">
                        <a href="#" class="hover-target">Other Pages</a>
                        <ul class="dropdown-menu">
                            <li><a href="blog.php" class="hover-target">Blog</a></li>
                            <li><a href="cropping.html" class="hover-target">Cropping</a></li>
                            <li><a href="faq.html" class="hover-target">FAQ</a></li>
                            <li><a href="shop.php" class="hover-target">Shop</a></li>
                            <li><a href="contact.html" class="hover-target">Contact</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Cart Icon -->
                <div class="action-menu">
                    <a href="cart.php" class="cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </div>
            </nav>
        </div>
    </header>




    <?php if (isset($notification)): ?>
        <div class="alert">
            <?php echo $notification; ?>
        </div>
    <?php endif; ?>

    <div class="shop-container">
        <h1>Your Cart</h1>

        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
            <div class="shop-grid">
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="shop-item">
                    <?php if (!empty($item['photo_url'])): ?>
    <img src="<?php echo htmlspecialchars($item['photo_url']); ?>" alt="Product Image" style="max-width: 100px;">
<?php else: ?>
    <img src="images/default-placeholder.png" alt="Default Image" style="max-width: 100px;">
<?php endif; ?>
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

            <!-- Checkout -->
            <form action="checkout.php" method="POST">
                <input type="email" name="email" placeholder="Enter your email for delivery" required>
                <button type="submit" class="buy-button">Checkout</button>
            </form>
        <?php else: ?>
            <h5><p>Your cart is empty.</p></h5>
        <?php endif; ?>
    </div>


    <footer id="footer" class="bg-black text-center py-4" style="background-color: #000; color: #fff;">
        <div class="container">
            <p class="mb-1" style="font-size: 0.85rem;">123 Southern Ave, Charleston, SC 29401, USA</p>
            <p class="mb-1" style="font-size: 0.85rem;">+1 843-555-1234 / +1 843-555-5678</p>
            <p style="font-size: 0.85rem;"><a href="mailto:info@mccallsouthern.com" class="text-white">info@mccallsouthern.com</a></p>
            <p class="mt-4" style="font-size: 1rem; font-weight: bold;">Designed by <span style="font-style: italic;">Ghost Technologies</span></p>
        </div>
    </footer>

<script src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>
