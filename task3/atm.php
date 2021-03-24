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
    rsort($array);
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

function responseGenerator($denomination, $sum): object
{
    $data = getNumberOfBills($denomination, $sum);
    if ($data['sum'] != 0) {
        $minsum = 0;
        foreach ($data['counter'] as $value => $count) {
            $minsum += $value * $count;
        }
        $maxsum = $minsum + array_key_last($data['counter']);
        $response = new Response('<div>Неверная сумма. Выберте ' . $minsum . ' или ' . $maxsum . '.</div>');
    } else {
        $html = '<table><tr><th>Номинал</th><th>Значение</th><tr>';
        foreach ($data['counter'] as $value => $count) {
            $html .= '<tr><td>' . $value . '</td><td>' . $count . '</td><tr>';
        }
        $html .= '</table>';
        $response = new Response($html);
    }
    return $response;
}

echo json_encode(responseGenerator($denomination, $sum));
return;


