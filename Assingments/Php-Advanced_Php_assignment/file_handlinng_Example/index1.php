<?php

// reads line by line and suitable for large file.
$file = 'sample.txt';

if (file_exists($file)) {
    echo "<h2>Content of '$file':</h2>";
    echo "<pre>";
    $handle = fopen($file, "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            echo $line;
        }
        fclose($handle);
    } else {
        echo "Unable to open the file.";
    }
    echo "</pre>";
} else {
    echo "File '$file' not found!";
}
?>
