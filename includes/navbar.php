
<?php
/**
 * Shared navbar component
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'The Sandwich Club') ?></title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
            integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y"
            crossorigin="anonymous"></script>

    <!-- Google Fonts: Fredoka (display) + Nunito (body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700&family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous"
          referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Cg fill='%2372ba65' fill-opacity='0.2'%3E%3Cpath fill-rule='evenodd' d='M0 0h40v40H0V0zm40 40h40v40H40V40zm0-40h2l-2 2V0zm0 4l4-4h2l-6 6V4zm0 4l8-8h2L40 10V8zm0 4L52 0h2L40 14v-2zm0 4L56 0h2L40 18v-2zm0 4L60 0h2L40 22v-2zm0 4L64 0h2L40 26v-2zm0 4L68 0h2L40 30v-2zm0 4L72 0h2L40 34v-2zm0 4L76 0h2L40 38v-2zm0 4L80 0v2L42 40h-2zm4 0L80 4v2L46 40h-2zm4 0L80 8v2L50 40h-2zm4 0l28-28v2L54 40h-2zm4 0l24-24v2L58 40h-2zm4 0l20-20v2L62 40h-2zm4 0l16-16v2L66 40h-2zm4 0l12-12v2L70 40h-2zm4 0l8-8v2l-6 6h-2zm4 0l4-4v2l-2 2h-2z'/%3E%3C/g%3E%3C/svg%3E");
        }
        h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: 'Fredoka', sans-serif;
        }
        .sc-page-content {
            background: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 2px 24px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            max-width: 1200px;
            margin: 1.75rem auto;
        }
        .sc-page-content--bare {
            background: transparent;
            box-shadow: none;
            border-radius: 0;
            padding: 0;
            max-width: 100%;
            margin: 0;
        }
    </style>
</head>
<body>
<div class="container-fluid p-0">
    <nav class="d-flex justify-content-between align-items-center bg-success text-white px-3">
        <a href="<?= $baseUrl ?>index.php" class="text-white text-decoration-none">
            <h1 class="m-0 py-3">The Sandwich Club</h1>
        </a>
        <div class="btn-group" role="group">
            <a href="<?= $baseUrl ?>index.php">
                <button type="button" class="btn text-white">Home</button>
            </a>
            <a href="<?= $baseUrl ?>about.php">
                <button type="button" class="btn text-white">About</button>
            </a>
        </div>
    </nav>
</div>
<div class="sc-page-content<?= !empty($noContentWrapper) ? ' sc-page-content--bare' : '' ?>">
