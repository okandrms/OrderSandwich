<?php
session_start();

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get values from POST request and save them in session
    $_SESSION['broodje'] = $_POST['broodje'];
    $_SESSION['saus'] = $_POST['saus'];
    $_SESSION['verzending'] = $_POST['verzending'];
    $_SESSION['naam'] = $_POST['naam'];
    $_SESSION['email'] = $_POST['email'];

    // Save order information to a file
    function saveStringToFile($broodje, $saus, $verzending, $naam, $email) {
        $file = fopen("bestellingen.csv", "a");
        $currendate = date('Y-m-d H:i:s');
        $string = $currendate . "," . $naam . "," . $email . "," . $broodje . "," . $saus . "," . $verzending . "\r\n";
        fwrite($file, $string);
        fclose($file);
    }

    saveStringToFile($_SESSION['broodje'], $_SESSION['saus'], $_SESSION['verzending'], $_SESSION['naam'], $_SESSION['email']);

    // Redirect to thank you page
    header("Location: thankyou.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Broodjes van Okan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('uploads/Background.jpg');
            background-size: cover;
            background-position: center;
            color: #333;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: darkred;
            margin-bottom: 20px;
        }
        .card-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .card {
            width: 22%;
            border: 1px solid #eee;
            border-radius: 10px;
            margin: 10px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card img {
            width: 100%;
            border-bottom: 1px solid #eee;
        }
        .info {
            padding: 10px;
            text-align: center;
        }
        form {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        form > div {
            flex: 1 1 45%;
            margin: 10px 5px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        select, input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .radio-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .radio-label {
            margin-right: 10px;
            font-weight: normal;
        }
        .submit-container {
            flex: 1 1 100%;
            text-align: center;
        }
        .button {
            background-color: darkred;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-block;
            width: auto;
        }
        .button:hover {
            background-color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Bestel Heerlijke Broodjes</h1>
    <div class="card-container">
        <div class="card">
            <img src="uploads/Broodje_carpaccio.jpg" alt="carpaccio">
            <div class="info">
                <h2>Broodje carpaccio</h2>
                <p>Price: €5</p>
            </div>
        </div>
        <div class="card">
            <img src="uploads/Broodje_Gezond.jpg" alt="gezond">
            <div class="info">
                <h2>Broodje gezond</h2>
                <p>Price: €6</p>
            </div>
        </div>
        <div class="card">
            <img src="uploads/Broodje_kip_mex.jpg" alt="kip Mex">
            <div class="info">
                <h2>Broodje kip Mex</h2>
                <p>Price: €6.5</p>
            </div>
        </div>
        <div class="card">
            <img src="uploads/Broodje_tonijnsalade.jpg" alt="tonijnsalade">
            <div class="info">
                <h2>Broodje tonijnsalade</h2>
                <p>Price: €5.5</p>
            </div>
        </div>
    </div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="broodje"><strong>Kies je broodje:</strong></label>
            <select name="broodje" required>
                <option value="" disabled selected>Kies broodje</option>
                <option value="Broodje carpaccio">Broodje carpaccio</option>
                <option value="Broodje gezond">Broodje gezond</option>
                <option value="Broodje kip Mex">Broodje kip Mex</option>
                <option value="Broodje tonijnsalade">Broodje tonijnsalade</option>
            </select>

            <label for="saus"><strong>Kies je saus:</strong></label>
            <select name="saus" required>
                <option value="" disabled selected>Kies saus</option>
                <option value="Mayonaise">Mayonaise (+ €1)</option>
                <option value="Ketchup">Ketchup (+ €1)</option>
                <option value="Mosterd">Mosterd (+ €1)</option>
                <option value="Tartarensaus">Tartarensaus (+ €2)</option>
            </select>
        </div>

        <div>
            <label><strong>Kies verzendmethode:</strong></label>
            <div class="radio-group">
                <div>
                    <input type="radio" id="afhalen" name="verzending" value="afhalen" required>
                    <label class="radio-label" for="afhalen">Afhalen</label>
                </div>
                <div>
                    <input type="radio" id="verzending" name="verzending" value="verzending" required>
                    <label class="radio-label" for="verzending">Levering (+ €5)</label>
                </div>
            </div>

            <label for="naam"><strong>Naam:</strong></label>
            <input type="text" name="naam" required>

            <label for="email"><strong>Email:</strong></label>
            <input type="email" name="email" required>
        </div>

        <div class="submit-container">
        <input class="button" type="submit" name="submit" href="thankyou.php" value="Bestel">
        </div>
    </form>
</div>

</body>
</html>
