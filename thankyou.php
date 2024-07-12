<?php
session_start();

// Check if order information is in session
if (!isset($_SESSION['broodje'], $_SESSION['saus'], $_SESSION['verzending'], $_SESSION['naam'], $_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

// Get order information from session
$broodje = $_SESSION['broodje'];
$saus = $_SESSION['saus'];
$verzending = $_SESSION['verzending'];
$naam = $_SESSION['naam'];
$email = $_SESSION['email'];

// Prices of broodjes and sauces
$broodjes_prices = array(
    "Broodje carpaccio" => 5,
    "Broodje gezond" => 6,
    "Broodje kip Mex" => 6.5,
    "Broodje tonijnsalade" => 5.5
);

$saus_prices = array(
    "Mayonaise" => 1,
    "Ketchup" => 1,
    "Mosterd" => 1,
    "Tartarensaus" => 2
);

// Calculate total price
$broodje_price = $broodjes_prices[$broodje];
$saus_price = $saus_prices[$saus];
$verzending_price = ($verzending == 'verzending') ? 5 : 0;
$total_price = $broodje_price + $saus_price + $verzending_price;

// Define product images
$broodje_images = array(
    "Broodje carpaccio" => "uploads/Broodje_carpaccio.jpg",
    "Broodje gezond" => "uploads/Broodje_Gezond.jpg",
    "Broodje kip Mex" => "uploads/Broodje_kip_mex.jpg",
    "Broodje tonijnsalade" => "uploads/Broodje_tonijnsalade.jpg"
);

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bedankt voor uw bestelling</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-image: url('uploads/Background.jpg');
            background-size: cover;
            background-position: center;
            color: #333;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card img {
            width: 50%;
            border-bottom: 1px solid #eee;
        }
        .card-body {
            text-align: center;
        }
        .card-title {
            margin-top: 15px;
            font-size: 24px;
            color: darkred;
        }
        .btn-primary {
            background-color: darkred;
            border: none;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: red;
        }
        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <img src="<?php echo $broodje_images[$broodje]; ?>" alt="<?php echo $broodje; ?>">
        <div class="card-body">
            <h2 class="card-title"><?php echo $broodje; ?></h2>
            <h2>Bedankt voor uw bestelling, <?php echo htmlspecialchars($naam); ?>!</h2>
            <h3>Bestel Details:</h3>
            <p><?php echo $broodje; ?> + <?php echo $saus; ?> saus</p>
            <?php if ($verzending === 'verzending') : ?>
                <p>+ Verzending (+ €5)</p>
            <?php endif; ?>
            <p>Totale prijs = €<?php echo number_format($total_price, 2); ?></p>
            <a class="btn btn-primary" href="print.php">Bestel Afdrukken</a>
        </div>
    </div>
</div>
</body>
</html>
