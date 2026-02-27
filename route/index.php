<?php
$baseUrl          = './';
$pageTitle        = 'The Sandwich Club';
$noContentWrapper = true;
include __DIR__ . '/../includes/navbar.php';
?>

<style>
    .sc-card {
        position: relative;
        overflow: hidden;
        border-radius: 0.75rem;
        cursor: pointer;
        flex: 1;
        min-width: 0;
        box-shadow: 0 6px 20px rgba(0,0,0,.15);
        text-decoration: none;
        display: block;
        transition: box-shadow 0.3s ease;
    }

    .sc-card:hover {
        box-shadow: 0 12px 32px rgba(0,0,0,.22);
    }

    .sc-card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }

    .sc-card:hover img {
        transform: scale(1.05);
    }

    .sc-card-overlay {
        position: absolute;
        top: -100%;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(25, 135, 84, 0.90);
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 2rem;
        text-align: center;
        transition: top 0.4s ease;
    }

    .sc-card:hover .sc-card-overlay {
        top: 0;
    }

    .sc-card-overlay h4 {
        font-family: 'Fredoka', sans-serif;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }

    .sc-card-overlay p {
        font-family: 'Nunito', sans-serif;
        font-size: 1rem;
        line-height: 1.6;
        margin: 0;
        max-width: 320px;
    }

    .sc-card-label {
        background: #198754;
        color: #fff;
        text-align: center;
        padding: 0.75rem;
        font-family: 'Fredoka', sans-serif;
        font-size: 1.25rem;
        font-weight: 600;
        letter-spacing: 0.04em;
    }
</style>

<div class="container my-5 text-center">
    <h2>Welcome to The Sandwich Club</h2>
    <p class="text-muted mb-5">Manage your menus, products, and menu products below.</p>

    <div class="d-flex justify-content-center gap-4 px-4">

        <!-- Menus -->
        <a href="menus/index.php" class="sc-card">
            <img src="https://images.unsplash.com/photo-1599172995721-49309fff2f21?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Menus">
            <div class="sc-card-overlay">
                <h4>Menus</h4>
                <p>Create and manage sandwich menus. Each menu groups a collection of products available to customers.</p>
            </div>
            <div class="sc-card-label">Menus</div>
        </a>

        <!-- Products -->
        <a href="products/index.php" class="sc-card">
            <img src="https://images.unsplash.com/photo-1553909489-cd47e0907980?q=80&w=1025&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Products">
            <div class="sc-card-overlay">
                <h4>Products</h4>
                <p>Add individual sandwich items with names, prices, and image URLs to build your product catalogue.</p>
            </div>
            <div class="sc-card-label">Products</div>
        </a>

        <!-- Menu Products -->
        <a href="menu-products/index.php" class="sc-card">
            <img src="https://images.unsplash.com/photo-1466978913421-dad2ebd01d17?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Menu Products">
            <div class="sc-card-overlay">
                <h4>Menu Products</h4>
                <p>Link products to menus. Each menu product entry places a product inside a specific menu for customers to see.</p>
            </div>
            <div class="sc-card-label">Menu Products</div>
        </a>

    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>