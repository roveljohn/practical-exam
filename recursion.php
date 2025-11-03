recursion.php

<?php
$library = [
    "Fiction" => [
        "Science Fiction" => ["Dune", "Neuromancer", "Foundation"],
        "Fantasy" => ["The Name of the Wind", "Mistborn", "The Way of Kings"],
        "Mystery" => ["The Girl with the Dragon Tattoo", "Gone Girl", "The Silent Patient"]
    ],
    "Non-Fiction" => [
        "Biography" => ["Steve Jobs", "Becoming", "Educated"],
        "Science" => ["A Brief History of Time", "The Selfish Gene", "Sapiens"],
        "History" => ["The Guns of August", "1776", "The Wright Brothers"]
    ],
    "Children's" => [
        "Picture Books" => ["The Very Hungry Caterpillar", "Where the Wild Things Are", "Goodnight Moon"],
        "Chapter Books" => ["Charlotte's Web", "Harry Potter", "The Lightning Thief"]
    ]
];

function displayLibrary($library, $indent = 0) {
    $spaces = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $indent);
    
    foreach ($library as $category => $contents) {
        if (is_array($contents)) {
            echo $spaces . "📁 <strong>" . $category . "</strong><br>";
            displayLibrary($contents, $indent + 1);
        } else {
            echo $spaces . "📖 <em>" . $contents . "</em><br>";
        }
    }
}

echo "<div style='font-family: Arial, sans-serif; line-height: 1.6; padding: 20px; background-color: #f5f5f5; border-radius: 10px; max-width: 600px; margin: 20px auto;'>";
echo "<h2 style='color: #2c3e50; text-align: center;'>📚 Library Catalog</h2>";
echo "<div style='background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);'>";
displayLibrary($library);
echo "</div>";
echo "</div>";
?>
