<?php
session_start();

// Broodjes and sauce information
$broodjes = array(
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

// assign values to variables from POST
$broodje = $_POST['broodje'];
$saus = $_POST['saus'];
$verzending = $_POST['verzending'];
$naam = $_POST['naam'];
$email = $_POST['email'];

// make some sessions of our posted data
$_SESSION['broodje'] = $broodje;
$_SESSION['saus'] = $saus;
$_SESSION['verzending'] = $verzending;
$_SESSION['naam'] = $naam;
$_SESSION['email'] = $email;

function saveStringToFile($broodje, $saus, $verzending, $naam, $email) {
    // open or create a new file and append to it
    $file = fopen("bestellingen.csv", "a");
    // provice a prefered format for the date object
    $currendate = date('Y-m-d H:i:s');
    // write to file and close... use "\r\n" for new line
    $string = $currendate . "," . $naam . "," . $email . "," . $broodje . "," . $saus . "," . $verzending . "\r";
    fwrite($file, $string);
    fclose($file);
}

saveStringToFile($broodje, $saus, $verzending, $naam, $email);


// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Redirect to thank you page
    header("Location: thankyou.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Broodjes van Okan</title>
    <!-- CSS Styles -->
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
            width: 150px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            margin: 10px;
            float: left;
        }

        .card img {
            width: 100%;
            border-radius: 8px;
        }

        .card .info {
            text-align: center;
        }

        .button {
            background-color: red;
            color: white;
            padding: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            background-color: darkred;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body >

<!-- Sandwich options -->
<div class="container" >
<div class="card">
    <img src="https://images.bakkerbart.nl/Products/Original/Broodje_carpaccio-6174.jpg" alt="carpaccio">
    <div class="info">
        <h2>Broodje carpaccio</h2>
        <p>Price: €5</p>
    </div>
</div>

<div class="card">
    <img src="https://images.bakkerbart.nl/Products/Original/Bartje_Gezond_jpg-3414.jpg" alt="gezond">
    <div class="info">
        <h2>Broodje gezond</h2>
        <p>Price: €6</p>
    </div>
</div>

<div class="card">
    <img src="https://images.bakkerbart.nl/Products/Original/Bartje_kip_mex-6132.jpg" alt="kip Mex">
    <div class="info">
        <h2>Broodje kip Mex</h2>
        <p>Price: €6.5</p>
    </div>
</div>

<div class="card">
    <img src="https://images.bakkerbart.nl/Products/Original/bartje_tonijnsalade_jpg-3459.jpg" alt="tonijnsalade">
    <div class="info">
        <h2>Broodje tonijnsalade</h2>
        <p>Price: €5.5</p>
    </div>
</div>

<h1>Bestel Heerlijke Broodjes</h1>

<!-- Order form -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="broodje"> <strong> Kies je broodje:</strong></label>
    <select name="broodje" >
        <option value="" disabled selected>Kies broodje</option>
        <option value="Broodje carpaccio">Broodje carpaccio</option>
        <option value="Broodje gezond">Broodje gezond</option>
        <option value="Broodje kip Mex">Broodje kip Mex</option>
        <option value="Broodje tonijnsalade">Broodje tonijnsalade</option>
    </select>

    <br><br>
    <label for="saus"> <strong> Kies je sauce:</strong></label>
    <select name="saus" >
        <option value="" disabled selected>Kies sauce</option>
        <option value="Mayonaise">Mayonaise (+ €1)</option>
        <option value="Ketchup">Ketchup (+ €1)</option>
        <option value="Mosterd">Mosterd (+ €1)</option>
        <option value="Tartarensaus">Tartarensaus (+ €2)</option>
    </select>
    <br><br>
    <input type="radio" name="verzending" value="afhalen" >
    <label for="afhalen">Afhalen</label>
    <input type="radio" name="verzending" value="verzending" >
    <label for="verzending">Levering (+ €5)</label>

    <br><br>
    <label for="naam"><strong>  Naam:</strong></label>
    <input type="text" name="naam"  required>
    <br><br>
    <label for="email"><strong>  Email:</strong></label>
    <input type="email" name="email"  required>
    <br><br>
    <input class="button" type="submit" name="submit" href="thankyou.php" value="Bestel">
</form>
</div>
</body>
</html>
