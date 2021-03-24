<a href="../index.php"><- Back</a><br>
<?php
$array = [
    'red',
    'blue',
    'green', 
    'yellow',
    'lime', 
    'magenta', 
    'black', 
    'gold', 
    'gray', 
    'tomato'
];

function render($array) {
    $html = '';
    for($i = 0; $i < 5; $i++) {
        for($j = 0; $j < 5; $j++) {
            $word = $array[array_rand($array, 1)];
            do {
                $color = $array[array_rand($array, 1)];
            } while ($color == $word);
            $html .= '<span style="color: ' . $color . '">'. $word . '</span> ';
        }
        $html .= "<br>";
    }
    echo $html;
}
render($array);
