<?php
// recursion.php
// Handles the recursive category rendering and utility helpers

$library = [
    "Fiction" => [
        "Fantasy" => ["Harry Potter", "The Hobbit"],
        "Mystery" => ["Sherlock Holmes", "Gone Girl"]
    ],
    "Non-Fiction" => [
        "Science" => ["A Brief History of Time", "The Selfish Gene"],
        "Biography" => ["Steve Jobs", "Becoming"]
    ]
];

// Utility: detect if array is a list (numeric keys)
function is_list_array($arr) {
    if (!is_array($arr)) return false;
    return array_keys($arr) === range(0, count($arr) - 1);
}

// Recursive function that generates nested HTML lists
function renderLibraryHTML($library) {
    $html = "<ul class=\"library-list\">";
    foreach ($library as $key => $value) {
        if (is_int($key)) {
            $title = htmlspecialchars($value);
            $html .= "<li class=\"book\"><a href=\"?book=" . urlencode($value) . "\">$title</a></li>";
            continue;
        }

        $cat = htmlspecialchars($key);
        $html .= "<li class=\"category\"><span class=\"cat-label\">$cat</span>";
        if (is_array($value)) {
            if (is_list_array($value)) {
                $html .= "<ul>";
                foreach ($value as $book) {
                    $t = htmlspecialchars($book);
                    $html .= "<li class=\"book\"><a href=\"?book=" . urlencode($book) . "\">$t</a></li>";
                }
                $html .= "</ul>";
            } else {
                $html .= renderLibraryHTML($value);
            }
        }
        $html .= "</li>";
    }
    $html .= "</ul>";
    return $html;
}

// Helper: flatten titles from nested library
function flattenTitles($library, &$out = []) {
    foreach ($library as $key => $value) {
        if (is_int($key) && is_string($value)) {
            $out[] = $value;
            continue;
        }
        if (is_array($value)) {
            if (is_list_array($value)) {
                foreach ($value as $book) $out[] = $book;
            } else {
                flattenTitles($value, $out);
            }
        }
    }
    return $out;
}
?>