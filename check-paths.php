<?php
$pdo = new PDO('mysql:host=localhost;dbname=dschool_cms', 'root', '');
$stmt = $pdo->query("SELECT id, image_path FROM gallery");
foreach($stmt as $r) {
    echo $r['id'] . ': ' . $r['image_path'] . "\n";
}