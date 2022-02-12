<?php

require_once(__DIR__ . '/vendor/autoload.php');

$config = Finnhub\Configuration::getDefaultConfiguration()->setApiKey('token', 'c82m2qaad3ia12596sb0');
$client = new Finnhub\Api\DefaultApi(
    new GuzzleHttp\Client(),
    $config
);
//echo "<pre>";

$valueSearch = ($client->quote("$_GET[search]")->getDp());
$valueAAPL = ($client->quote("AAPL")->getDp());
$valueMSTF = ($client->quote("MSFT")->getDp());
$valueAMZN = ($client->quote("AMZN")->getDp());
$valueTSLA = ($client->quote("TSLA")->getDp());

function setColor(float $stockChange = null): string
{
    if ($stockChange < 0) {
        return "red";
    } else {
        return "black";
    }
}

//die;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>StockAPI</title>
    <style>
        .container {
            display: flex;
            justify-content: space-evenly;
            height: 75vh;
        }

        .left, .right {
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
        }

        .box {
            height: 150px;
            width: 200px;
            border: solid 2px black;
            background: lawngreen;
        }
    </style>
</head>
<body>
<form method="get" action="/">
    <label>
        <input name="search" value=""/>
    </label>
    <button type="submit">Search</button>
</form>
<div class="box" style="text-align: center">
    <h1><?php echo $_GET["search"] ?>  </h1>
    <p><?php echo "Current price: " . ($client->quote("$_GET[search]")->getC()); ?></p>
    <p style="color: <?php print setColor($valueSearch) ?> ;"><?php echo "Percent change: " . $valueSearch; ?></p>
</div>
<div class="container">
    <div class='left'>
        <div class="box" style="text-align: center">
            <h1>AAPL</h1>
            <p><?php echo "Current price: " . ($client->quote("AAPL")->getC()); ?></p>
            <p style="color: <?php print setColor($valueAAPL) ?> ;"><?php echo "Percent change: " . $valueAAPL; ?></p>
        </div>
        <div class="box" style="text-align: center">
            <h1>MSFT</h1>
            <p><?php echo "Current price: " . ($client->quote("MSFT")->getC()); ?></p>
            <p style="color: <?php print setColor($valueMSTF) ?> ;"><?php echo "Percent change: " . $valueMSTF; ?></p>
        </div>
    </div>
    <div class='right'>
        <div class="box" style="text-align: center">
            <h1>AMZN</h1>
            <p><?php echo "Current price: " . ($client->quote("AMZN")->getC()); ?></p>
            <p style="color: <?php print setColor($valueAMZN) ?> ;"><?php echo "Percent change: " . $valueAMZN; ?></p>
        </div>
        <div class="box" style="text-align: center">
            <h1>TSLA</h1>
            <p><?php echo "Current price: " . ($client->quote("TSLA")->getC()); ?></p>
            <p style="color: <?php print setColor($valueTSLA) ?> ;"><?php echo "Percent change: " . $valueTSLA; ?></p>
        </div>
    </div>
</div>
</body>
</html>
