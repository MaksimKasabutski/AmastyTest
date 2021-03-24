<a href="../index.php"><- Back</a><br>
<?php
require_once __DIR__ . '/vendor/autoload.php';
use Task1\King;
use Task1\Queen;

$king = new King(4, 3);
$queen = new Queen(1,1);

try {
    $king->move(3, 2);
    $king->move(2,2);
    $queen->move(3, 3);
    $queen->move(7, 3);
    echo 'King: ' . $king->getPosition() . '<br>';
    echo 'Queen: ' . $queen->getPosition();
} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
}

