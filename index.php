<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confidence Interval Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #4CAF50;
        }

        form {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            max-width: 400px;
            margin: 20px auto;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: calc(100% - 10px);
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            text-align: center;
            font-size: 16px;
            margin-top: 10px;
        }

        b {
            color: #4CAF50;
        }

        h3 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
    </style>
</head>

<body>
    <h2>Confidence Interval Calculator</h2>

    <?php
    // Initialize variables
    $confLevel = $zScore = $mean = $SD = $NS = null;
    $probability = $lcl = $ucl = null;

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!empty($_POST["a"])) {
            $confLevel = floatval($_POST["a"]);
            // Step 1 Calculation
            $cl = $confLevel / 100;
            $probability = (1 - $cl) / 2;
        }

        if (!empty($_POST["b"]) && !empty($_POST["c"]) && !empty($_POST["d"]) && !empty($_POST["e"])) {
            $zScore = floatval($_POST["b"]);
            $mean = floatval($_POST["c"]);
            $SD = floatval($_POST["d"]);
            $NS = floatval($_POST["e"]);

            // Step 2 Calculation
            $nSR = sqrt($NS);
            $moe = $zScore * ($SD / $nSR);
            $lcl = $mean - $moe;
            $ucl = $mean + $moe;
        }
    }
    ?>

    <!-- Step 1 Form -->
    <h3>PROBABILITY</h3>
    <form action="" method="post">
        <label>Confidence Level (%):</label>
        <input type="text" name="a" value="<?php echo htmlspecialchars($confLevel); ?>"><br>
        <input type="submit" value="Calculate"><br>
    </form>
    <?php
    if ($probability !== null) {
        echo "<p>Probability: <b>{$probability}</b></p>";
    }
    ?>

    <!-- Step 2 Form -->
    <h3>CONFIDENCE INTERVAL</h3>
    <form action="" method="post">
        <!-- Pass the Step 1 value forward -->
        <input type="hidden" name="a" value="<?php echo htmlspecialchars($confLevel); ?>">

        <label>Z Score:</label>
        <input type="text" name="b" value="<?php echo htmlspecialchars($zScore); ?>"><br>

        <label>Mean:</label>
        <input type="text" name="c" value="<?php echo htmlspecialchars($mean); ?>"><br>

        <label>Standard Deviation:</label>
        <input type="text" name="d" value="<?php echo htmlspecialchars($SD); ?>"><br>

        <label>Number of Samples:</label>
        <input type="text" name="e" value="<?php echo htmlspecialchars($NS); ?>"><br>

        <input type="submit" value="Calculate"><br>
    </form>
    <?php
    if ($lcl !== null && $ucl !== null) {
        echo "<p>Lower Confidence Limit: <b>{$lcl}</b></p>";
        echo "<p>Upper Confidence Limit: <b>{$ucl}</b></p>";
    }
    ?>
</body>

</html>