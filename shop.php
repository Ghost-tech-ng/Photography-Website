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
    </style>
</head>

<body>
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
                <li class="nav__list-item active-nav"><a href="shop.php" class="hover-target">Shop</a></li>
                <li class="nav__list-item"><a href="cart.php" class="hover-target">Cart</a></li>
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
                    <input type="hidden" name="photo_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="photo_title" value="<?php echo $row['title']; ?>">
                    <input type="hidden" name="photo_price" value="<?php echo $row['price']; ?>">
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
                        <!--detail-->
                    </div>
                    <!--contact-detail-->

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
                    <!--col-md-6-->
                </div>
                <!--contact-information-->
            </div>
        </div>
    </footer>

    <script src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

</body>

</html>
