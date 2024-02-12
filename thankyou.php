<?php
session_start();

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
    "Broodje carpaccio" => "https://images.bakkerbart.nl/Products/Original/Broodje_carpaccio-6174.jpg",
    "Broodje gezond" => "https://images.bakkerbart.nl/Products/Original/Bartje_Gezond_jpg-3414.jpg",
    "Broodje kip Mex" => "https://images.bakkerbart.nl/Products/Original/Bartje_kip_mex-6132.jpg",
    "Broodje tonijnsalade" => "https://images.bakkerbart.nl/Products/Original/bartje_tonijnsalade_jpg-3459.jpg"
);

// Print order details
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bedankt voor uw bestelling</title>
    <style>
        /* CSS Styles */
        body {
            background-image: url('https://www.tbakkershuizeke.be/media/images/news/15.jpg');
            background-size: cover; 
            background-position: center;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            margin-top: 50px;
            margin-bottom: 50px;
            
        }
        .card {
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            margin: 10px;
            float: left;
            background-color: #f9f9f9;
        }

        .card img {
            width: 100%;
            border-radius: 8px;
        }

        .card .info {
            text-align: center;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<div class="container">
<div class="card">
    <img src="<?php echo $broodje_images[$broodje]; ?>" alt="<?php echo $broodje; ?>">
    <div class="info">
        <h2><?php echo $broodje; ?></h2>
        
    </div>
</div>

<h2>Bedankt voor uw bestelling, <?php echo $naam; ?>!</h2><br><br>
<h3>Bestel Details:</h3><br>
<h3><?php echo $broodje; ?> + <?php echo $saus; ?> saus <br>
<?php
// If 'verzending' option is not selected, add this information as well
if ($verzending === 'verzending') {
    echo "<p>+ Verzending (+ €5)</p>";
}
?>


    Totale prijs = €<?php echo $total_price; ?></h3><br>
</h3>

    <a class='btn btn-primary' href="print.php">Bestel Afdrukken</a>
</body>
</div>
</html>
