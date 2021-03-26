<?php
require('Response.php');

$request = json_decode(file_get_contents('php://input'), true);

$sum = $request['sum'];
$denomination = stringToArray($request['denomination']);

function stringToArray($string)
{
    $array = explode(',', $string);
    foreach ($array as &$value) {
        $value = trim($value);
    }
    arsort($array);
    return $array;
}

function getNumberOfBills($denomination, $sum): array
{
    foreach ($denomination as $value) {
        $counter[$value] = 0;
        while ($value <= $sum) {
            $sum -= $value;
            $counter[$value]++;
        }
    }
    return ['counter' => $counter, 'sum' => $sum];
}

function responseGenerator($nominal, $sum)
{
    $numberOfNominals = [];
    array_push($numberOfNominals, 0);
    for ($i = 1; $i <= $sum + $nominal[0]; $i++) {
        $numberOfNominals[$i] = INF;
        for ($j = 0; $j < count($nominal); $j++) {
            if ($i >= $nominal[$j] and $numberOfNominals[$i - $nominal[$j]] + 1 < $numberOfNominals[$i]) {
                $numberOfNominals[$i] = $numberOfNominals[$i - $nominal[$j]] + 1;
            }
        }
    }

    if ($numberOfNominals[$sum] == INF) {
        for ($i = $sum; $i > 0; $i--) {
            if ($numberOfNominals[$i] != INF) {
                $minsum = $i;
                break;
            }
        }
        for ($i = $sum; $i < $sum + $nominal[0]; $i++) {
            if ($numberOfNominals[$i] != INF) {
                $maxsum = $i;
                break;
            }
        }
        $response = new Response('<div>Неверная сумма. Выберте ' . $minsum . ' или ' . $maxsum . '.</div>');
    } else {
        $output = [];
        foreach ($nominal as $value) {
            $output[$value] = 0;
        }
        while ($sum > 0) {
            for ($i = 0; $i < count($nominal); $i++) {
                if ($numberOfNominals[$sum - $nominal[$i]] == $numberOfNominals[$sum] - 1) {
                    if (array_key_exists($nominal[$i], $output)) {
                        $output[$nominal[$i]]++;
                    }
                    $sum -= $nominal[$i];
                    break;
                }
            }
        }
        $html = '<table><tr><th>Номинал</th><th>Значение</th><tr>';
        foreach ($output as $value => $count) {
            $html .= '<tr><td>' . $value . '</td><td>' . $count . '</td><tr>';
        }
        $html .= '</table>';
        $response = new Response($html);
    }
    return $response;
}
echo json_encode(responseGenerator($denomination, $sum));
return;
