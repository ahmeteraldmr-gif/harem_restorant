<?php

$sourceDir = __DIR__ . '/GOOGLE FOTO MENU -';
$destDir = __DIR__ . '/public/images';

if (!is_dir($sourceDir)) {
    die("Error: Source directory '$sourceDir' does not exist.\n");
}

if (!is_dir($destDir)) {
    mkdir($destDir, 0755, true);
}

$files = [
    '1.png'  => 'ambiance-1.png',
    '2.png'  => 'ambiance-2.png',
    '3.png'  => 'ambiance-3.png',
    '4.png'  => 'ambiance-4.png',
    '5.jpg'  => 'ambiance-5.jpg',
    '6.png'  => 'ambiance-6.png',
    '7.jpeg' => 'ambiance-7.jpeg',
    '8.jpeg' => 'ambiance-8.jpeg',
];

echo "Copying ambiance files...\n";

foreach ($files as $srcName => $destName) {
    $srcPath = $sourceDir . '/' . $srcName;
    $destPath = $destDir . '/' . $destName;

    if (file_exists($srcPath)) {
        if (copy($srcPath, $destPath)) {
            echo "Successfully copied: $srcName -> $destName\n";
        } else {
            echo "Failed to copy: $srcName\n";
        }
    } else {
        echo "Warning: Source file not found: $srcPath\n";
    }
}

// Perform direct overrides for homepage & static assets
echo "\nPerforming specific asset overrides...\n";

$overrides = [
    '3.png' => 'hero.png',            // Main background terrace photo
    '2.png' => 'interior.png',        // Cozy tables
    '1.png' => 'gallery-terrace.png'  // Beautiful wide terrace view
];

foreach ($overrides as $srcName => $destName) {
    $srcPath = $sourceDir . '/' . $srcName;
    $destPath = $destDir . '/' . $destName;

    if (file_exists($srcPath)) {
        if (copy($srcPath, $destPath)) {
            echo "Successfully overrode: $destName with $srcName\n";
        } else {
            echo "Failed to override: $destName\n";
        }
    } else {
        echo "Warning: Source file for override not found: $srcPath\n";
    }
}

echo "\nDone!\n";
