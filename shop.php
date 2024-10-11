<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'photography_shop');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination setup
$results_per_page = 6; // Number of items per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $results_per_page;

// Fetch images from the database
$query = "SELECT * FROM photos LIMIT $start_from, $results_per_page";
$result = $conn->query($query);

// Fetch total number of pages
$total_query = "SELECT COUNT(*) FROM photos";
$total_result = $conn->query($total_query);
$row = $total_result->fetch_row();
$total_pages = ceil($row[0] / $results_per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - McCall Southern Photography</title>
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
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .shop-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 50px;
        }

        .shop-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .shop-item {
            background-color: #111;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .shop-item img {
            max-width: 100%;
            border-radius: 5px;
        }

        .shop-item h3 {
            margin: 15px 0;
            color: #FF9350;
        }

        .shop-item p {
            margin: 10px 0;
        }

        .price {
            font-size: 18px;
            color: #FFD700;
        }

        .pagination {
            text-align: center;
            margin: 30px 0;
        }

        .pagination a {
            margin: 0 5px;
            color: #FF9350;
            text-decoration: none;
            padding: 8px 16px;
            background-color: #222;
            border-radius: 4px;
        }

        .pagination a.active {
            background-color: #FF9350;
            color: #fff;
        }

        .buy-button {
            background-color: #FF9350;
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .buy-button:hover {
            background-color: #FF6347;
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
    <div class="preloader"><svg><g><path d="M 50,100 A 1,1 0 0 1 50,0"/></g><g><path d="M 50,75 A 1,1 0 0 0 50,-25"/></g><defs><linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" style="stop-color:#FF56A1;stop-opacity:1" /><stop offset="100%" style="stop-color:#FF9350;stop-opacity:1" /></linearGradient></defs></svg></div>
    <header id="header" class="dark">
        <div id="header-wrap">
            <nav id="navbar">
                <!-- Logo -->
                <div class="main-logo">
                    <a href="index.html">
                        <img src="images/logo.png" alt="Logo" style="max-width: 150px; height: auto;">
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


    <div class="shop-container">
    <h1>Shop Our Photography</h1>

    <div class="shop-grid">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="shop-item">
                <img src="<?php echo $row['photo_url']; ?>" alt="<?php echo $row['title']; ?>">
                <h3><?php echo $row['title']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <p class="price">$<?php echo number_format($row['price'], 2); ?></p>

                <!-- Add to cart form -->
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="photo_id" value="1">
                    <input type="hidden" name="photo_title" value="Event Memories">
                    <input type="hidden" name="photo_price" value="175.00">
                    <input type="hidden" name="photo_url" value="<?php echo $row['photo_url']; ?>"> <!-- Pass Image URL -->
                    <button class="buy-button" type="submit">Add to Cart</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Pagination Links -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <a href="shop.php?page=<?php echo $i; ?>" class="<?php if ($i == $page) echo 'active'; ?>">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>
    </div>
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
