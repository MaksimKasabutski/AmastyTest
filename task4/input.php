<a href="index.php"><- Back</a><br>
<?php
require('simple_html_dom.php');

if(isset($_POST['team'])) {

$teamName = $_POST['team'];
$output = '';
$output .= 'Team: ' . $teamName . '<br>';

$url = 'https://terrikon.com';
$html = file_get_html('https://terrikon.com/football/italy/championship/archive');
$header = $html->find('div.tab div.news dl dd a');

foreach ($header as $element) {
    $link = '';
    $link .= $url . $element->href;
    preg_match('/[0-9]{4}-[0-9]{2}/', $link, $year);
    if (!isset($year[0])) {
        $output .= 'Current season - Place: ';
    } else $output .= $year[0] . ' - Place: ';

    $html = file_get_html($link);
    $years = $html->find('div.tab table.colored tr td');
    foreach ($years as $element) {
        if ($element->plaintext == $teamName) {
            $td = $element->parent();
            $output .= $td->find('td', 0)->innertext;
        }
    }
    $output .= '<br>';
}
echo $output;
} else {
    echo "Something went wrong";
}