<?php
// this method reads entire file at once and suitable for small to medium file size.
// File path
$file = 'sample.txt';

// Check if file exists
if (file_exists($file)) {
    // Read file content
    $content = file_get_contents($file);

    // Display content on web page with proper formatting
    echo "<h2>Content of '$file':</h2>";
    echo "<pre>$content</pre>"; // <pre> preserves line breaks and spacing
} else {
    echo "File '$file' not found!";
}
?>
