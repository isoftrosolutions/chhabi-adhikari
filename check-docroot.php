<?php
echo 'DOCUMENT_ROOT: ' . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo '__DIR__: ' . __DIR__ . "\n";
echo "Files exist:\n";
$files = [
    'assets/Gemini_Generated_Image_ejsw4zejsw4zejsw.png',
    'assets/Gemini_Generated_Image_pl1l98pl1l98pl1l.png',
    'assets/Gemini_Generated_Image_kwsdyvkwsdyvkwsd.png',
    'assets/Gemini_Generated_Image_q9bjvcq9bjvcq9bj.png',
    'assets/WhatsApp Image 2026-02-10 at 2.58.03 PM.jpeg',
    'assets/WhatsApp Image 2026-02-10 at 2.58.05 PM.jpeg',
];
foreach ($files as $f) {
    $fullPath = __DIR__ . '/' . $f;
    echo $f . ': ' . (file_exists($fullPath) ? 'EXISTS' : 'NOT FOUND') . "\n";
}