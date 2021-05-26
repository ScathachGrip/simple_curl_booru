<?php
ini_set('display_errors',0);
$form = '
<form action="index.php" method="GET">
<input type="hidden" style="width:30%;" name="tags"><br>
</form>';

function wordFilter($text)
{
    $ambilkata = $text;
    $ambilkata = str_replace(',', '_', $ambilkata);
    return $ambilkata;
}

$n0 = wordFilter($_GET['tags']);

$site = 'https://gelbooru.com/index.php?page=dapi&s=post&q=index&limit=50&tags='.$n0;
header('Content-Type: application/json');
$curl = curl_init($site);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE); 
$page = curl_exec($curl); 

curl_close($curl);

function sedx($text)
{
    $ambilkata = $text;
    $ambilkata = str_replace(' ', '%20', $ambilkata);
    return $ambilkata;
}


$regex = '/<?xml(.*?)<\/posts>/s';

if ( preg_match($regex, $page, $list) )	

preg_match_all('#file_url="(.*?)"#', $page, $match);

foreach($match[1] as $index => $value) {

//echo '{"url":"',sedx($match[1][array_rand($match[1])]),'"}';

}
$randomImage = sedx($match[1][array_rand($match[1])]);
echo '{"url":"',$randomImage,'"}';

?>

