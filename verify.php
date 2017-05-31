<?php
$access_token = 'Cq8fODVKKPJVth6IKySkccyKS4W1JSJpMnOEYzUr9oSSYUznmnz835mW9u3uWr8+wMGgRc8P6MTFUvaagI+2Sv9fj7e0hp5Wd7BGwmRpGceO4EY0oElanTcIf6ARnZ0CW6L8iVyz7cZqe1W8SrRIlAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
