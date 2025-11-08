<?php
// Simple placeholder image generator
header('Content-Type: image/jpeg');

$width = isset($_GET['w']) ? (int)$_GET['w'] : 400;
$height = isset($_GET['h']) ? (int)$_GET['h'] : 600;
$text = isset($_GET['text']) ? $_GET['text'] : 'Image';

$image = imagecreatetruecolor($width, $height);

// Colors
$colors = [
    ['bg' => [26, 32, 44], 'text' => [255, 255, 255]], // Dark blue
    ['bg' => [17, 24, 39], 'text' => [239, 68, 68]], // Dark gray with red
    ['bg' => [31, 41, 55], 'text' => [255, 255, 255]], // Gray
    ['bg' => [55, 65, 81], 'text' => [220, 38, 38]], // Darker gray with red
    ['bg' => [75, 85, 99], 'text' => [255, 255, 255]], // Medium gray
];

$colorIndex = isset($_GET['c']) ? (int)$_GET['c'] % count($colors) : 0;
$bgColor = imagecolorallocate($image, $colors[$colorIndex]['bg'][0], $colors[$colorIndex]['bg'][1], $colors[$colorIndex]['bg'][2]);
$textColor = imagecolorallocate($image, $colors[$colorIndex]['text'][0], $colors[$colorIndex]['text'][1], $colors[$colorIndex]['text'][2]);

imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);

// Add text
$fontSize = min($width, $height) / 10;
$bbox = imagettfbbox($fontSize, 0, __DIR__ . '/arial.ttf', $text);
$x = ($width - $bbox[4]) / 2;
$y = ($height - $bbox[5]) / 2;

// Use built-in font if TTF not available
imagestring($image, 5, $x, $y, $text, $textColor);

imagejpeg($image);
imagedestroy($image);
?>

