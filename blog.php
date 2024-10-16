<?php
// Database connection
$servername = "localhost"; // or your server name
$username = "root"; // database username
$password = ""; // database password
$dbname = "photography_shop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch blog posts from the database
$sql = "SELECT * FROM posts ORDER BY date_posted DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <!-- Updated title for branding and SEO -->
    <title>McCall Southern Photography - Professional Photographer Portfolio & Services</title>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Favicon for branding -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <style>
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



    <section class="hero-section jarallax">
        <img src="images/banner2.jpg" class="jarallax-img">
        <div class="hero-content padding-xlarge">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    <h1 class="page-title" style="color: white">Our Latest Blogs</h1>
                        <div class="breadcrumbs">
                            <span class="item"><a href="index-2.html">Home /</a></span>
                            <span class="item">Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="padding-large">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="post-content">

                    <?php
                    // Loop through each blog post and display
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '
                            <article>
                                <h2>' . $row["title"] . '</h2>
                                <img src="' . $row["image_url"] . '" alt="' . $row["title"] . '" />
                                <p>By ' . $row["author"] . ' on ' . $row["date_posted"] . '</p>
                                <p>' . substr($row["content"], 0, 200) . '...</p>
                                <a href="single-post.php?id=' . $row["id"] . '">Read More</a>
                            </article>
                            <hr>';
                        }
                    } else {
                        echo "<p>No blog posts available.</p>";
                    }
                    ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

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

<?php
$conn->close();
?>
