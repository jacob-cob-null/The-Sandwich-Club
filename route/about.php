<?php
$baseUrl   = './';
$pageTitle = 'About — The Sandwich Club';
include __DIR__ . '/../includes/navbar.php';
?>

<div class="container" style="max-width: 800px;">

    <h2 class="mb-1">The Sandwich Club</h2>
    <p class="text-muted mb-4">PHP CRUD demo &mdash; Menus, Products &amp; Menu Products</p>

    <hr>

    <h5 class="mt-4">What is this?</h5>
    <p>
        A local restaurant management tool for creating and organising menus, adding products
        (with pricing), and linking products to menus through menu products.
        Built as a Midterm project covering PHP, MySQL, Bootstrap 5, and Docker for the course Application Development and Emerging Techonologies.
    </p>

    <h5 class="mt-4">Stack</h5>
    <table class="table table-bordered table-sm w-auto">
        <thead class="table-success">
            <tr><th>Layer</th><th>Technology</th></tr>
        </thead>
        <tbody>
            <tr><td>Language</td><td>PHP 8.2 (procedural <code>mysqli_*</code>)</td></tr>
            <tr><td>Database</td><td>MySQL 8.0</td></tr>
            <tr><td>UI</td><td>Bootstrap 5.3 &amp; Font Awesome 6 (CDN)</td></tr>
            <tr><td>Local runtime</td><td>Docker + Docker Compose</td></tr>
        </tbody>
    </table>

    <h5 class="mt-4">Features</h5>
    <ul>
        <li>Full CRUD on <strong>menus</strong> &mdash; soft delete (DateDeleted)</li>
        <li>Full CRUD on <strong>products</strong> &mdash; name, price, optional image URL</li>
        <li>Full CRUD on <strong>menuproducts</strong> &mdash; join table linking menus &amp; products</li>
        <li>Backend validation with prepared statements (SQL-injection safe)</li>
        <li>Shared navbar component via <code>includes/navbar.php</code></li>
        <li>Zero XAMPP &mdash; entire stack runs in Docker, I have strong opinions against XAMPP</li>
    </ul>
        <h5 class="mt-4">Notice</h5>
    <ul>
        <li>Images on <strong>products</strong> table are saved inside the app through the /uploads folder</li>
        <li>With the limitations of the <strong>Database Schema</strong> provided, only the <strong>menus</strong> table showcase a soft delete implementation</li>
        <li>The menuproducts table is <strong>transitive</strong>, connecting both the menu and product tables, therefore having constraint dependent on the contents of said tables</li>
    </ul>

    <h5 class="mt-4">Quick Start</h5>
    <pre class="bg-light border rounded p-3"><code>git clone &lt;git@github.com:jacob-cob-null/The-Sandwich-Club.git&gt;
cd The-Sandwich-Club
cp .env.example .env
docker compose up --build -d
# App → http://localhost:8080/route/index.php
# MySQL → localhost:3307 (user: root, password: secret)</code></pre>
 
    <h5 class="mt-4">Database</h5>
    <p>Three tables &mdash; schema auto-applied by <code>db/init.sql</code> on first container start:</p>
    <ul>
        <li><code>menus</code> &mdash; ID, Name, DateCreated, DateUpdated, DateDeleted</li>
        <li><code>products</code> &mdash; ID, name, price, imagePath</li>
        <li><code>menuproducts</code> &mdash; ID, menuID, productID (FK cascade)</li>
    </ul>
    <hr class="mt-4">
        <div class="d-flex justify-content-between">
            <p class="text-muted small">The Sandwich Club &mdash; <?= date('Y') ?></p>
            <p class="text-muted small">Lance Jacob B. Silverio  |  BSCS 2-A</p>
        </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
