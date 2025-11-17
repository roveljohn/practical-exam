<?php
// hashtable.php
// Stores book info and image mapping

$bookInfo = [
    "Harry Potter" => ["author" => "J.K. Rowling", "year" => 1997, "genre" => "Fantasy"],
    "The Hobbit" => ["author" => "J.R.R. Tolkien", "year" => 1937, "genre" => "Fantasy"],
    "Sherlock Holmes" => ["author" => "Arthur Conan Doyle", "year" => 1892, "genre" => "Mystery"],
    "Gone Girl" => ["author" => "Gillian Flynn", "year" => 2012, "genre" => "Mystery"],
    "A Brief History of Time" => ["author" => "Stephen Hawking", "year" => 1988, "genre" => "Science"],
    "The Selfish Gene" => ["author" => "Richard Dawkins", "year" => 1976, "genre" => "Science"],
    "Steve Jobs" => ["author" => "Walter Isaacson", "year" => 2011, "genre" => "Biography"],
    "Becoming" => ["author" => "Michelle Obama", "year" => 2018, "genre" => "Biography"]
];

$bookImages = [
    "Harry Potter" => "images/harry_potter.jpg",
    "The Hobbit" => "images/the_hobbit.jpg",
    "Sherlock Holmes" => "images/sherlock_holmes.jpg",
    "Gone Girl" => "images/gone_girl.jpg",
    "A Brief History of Time" => "images/brief_history_of_time.jpg",
    "The Selfish Gene" => "images/the_selfish_gene.jpg",
    "Steve Jobs" => "images/steve_jobs.jpg",
    "Becoming" => "images/becoming.jpg"
];

// Helper: get HTML for book info + image
function getBookInfoHTML($title, $bookInfo, $bookImages) {
    if (!$title) return "<p class=\"muted\">No book selected.</p>";
    $html = "<div class=\"book-details\">";
    if (isset($bookImages[$title]) && file_exists($bookImages[$title])) {
        $src = htmlspecialchars($bookImages[$title]);
        $html .= "<img class=\"book-cover\" src=\"$src\" alt=\"" . htmlspecialchars($title) . " cover\">";
    }
    if (isset($bookInfo[$title])) {
        $info = $bookInfo[$title];
        $html .= "<h2>" . htmlspecialchars($title) . "</h2>";
        $html .= "<p><strong>Author:</strong> " . htmlspecialchars($info['author']) . "</p>";
        $html .= "<p><strong>Year:</strong> " . htmlspecialchars($info['year']) . "</p>";
        $html .= "<p><strong>Genre:</strong> " . htmlspecialchars($info['genre']) . "</p>";
    } else {
        $html .= "<p class=\"error\">Book not found in details table.</p>";
    }
    $html .= "</div>";
    return $html;
}
?>