<?php
session_start();

// Check if session variables are set
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
$broodje_price = isset($broodjes_prices[$broodje]) ? $broodjes_prices[$broodje] : 0;
$saus_price = isset($saus_prices[$saus]) ? $saus_prices[$saus] : 0;
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
<html>
<head>
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
        .container2 {
            max-width: 500px;
            margin: 30px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-body {
            padding: 20px;
            text-align: center;
        }
        .btn-primary {
            background-color: darkred;
            border: none;
        }
        .btn-primary:hover {
            background-color: red;
        }
    </style>
</head>
<body>
<div class="container2">
    <div class="card">
        <img src="<?php echo $broodje_images[$broodje]; ?>" alt="<?php echo $broodje; ?>">
        <div class="card-body">
            <h3><?php echo $broodje; ?> met <?php echo $saus; ?> saus</h3>
            <?php if ($verzending === 'verzending') { echo "<p> Verzending (+ €5)</p>"; } ?>
            <p>Totale prijs = €<?php echo $total_price; ?></p>
            <h5>Bedankt voor uw bestelling, <?php echo $naam; ?>!</h5>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=syntrapxl.be" alt="QR Code" class="img-fluid">
            <br><br>
            <a class='btn btn-primary btn-block' onclick="window.print();">Afdrukken</a>
        </div>
    </div>
</div>
</body>
</html>
