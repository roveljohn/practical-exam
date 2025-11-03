main.php
<?php
// ===============================================
// php-foundations-datastructures--Otom-Rovel-John
// Car Showroom System
// ===============================================

class Node {
    public $data;
    public $left;
    public $right;
    public function __construct($data) {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
    }
}

class BinarySearchTree {
    public $root;
    
    public function __construct() {
        $this->root = null;
    }
    
    public function insert($data) {
        $newNode = new Node($data);
        if ($this->root === null) {
            $this->root = $newNode;
            return;
        }
        $current = $this->root;
        while (true) {
            if (strcasecmp($data, $current->data) < 0) {
                if ($current->left === null) {
                    $current->left = $newNode;
                    return;
                }
                $current = $current->left;
            } else {
                if ($current->right === null) {
                    $current->right = $newNode;
                    return;
                }
                $current = $current->right;
            }
        }
    }

    public function search($data) {
        $current = $this->root;
        while ($current !== null) {
            $compare = strcasecmp($data, $current->data);
            if ($compare === 0) return true;
            $current = ($compare < 0) ? $current->left : $current->right;
        }
        return false;
    }

    public function inorderTraversal($node) {
        if ($node !== null) {
            $this->inorderTraversal($node->left);
            echo "🚗 " . $node->data . "<br>";
            $this->inorderTraversal($node->right);
        }
    }
}

// ===============================================
// RECURSIVE CATEGORY DISPLAY
// ===============================================
$carShowroom = [
    "Luxury" => [
        "Sedan" => ["Mercedes-Benz S-Class", "BMW 7 Series", "Audi A8"],
        "SUV" => ["Range Rover Vogue", "Porsche Cayenne", "Lexus LX570"]
    ],
    "Sports" => [
        "Coupe" => ["Ferrari 488 GTB", "Lamborghini Huracan", "McLaren 720S"],
        "Supercar" => ["Bugatti Chiron", "Koenigsegg Agera RS", "Pagani Huayra"]
    ],
    "Electric" => [
        "Sedan" => ["Tesla Model S", "Lucid Air", "Porsche Taycan"],
        "SUV" => ["Tesla Model X", "BMW iX", "Audi Q8 e-tron"]
    ]
];

function displayShowroom($cars, $indent = 0) {
    $space = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $indent);
    foreach ($cars as $category => $value) {
        if (is_array($value)) {
            echo $space . "🏷️ <strong>$category</strong><br>";
            displayShowroom($value, $indent + 1);
        } else {
            echo $space . "🚘 <em>$value</em><br>";
        }
    }
}

// ===============================================
// ===============================================
// HASH TABLE (CAR DETAILS)
// ===============================================
$carDetails = [
    "Tesla Model S" => ["manufacturer" => "Tesla", "year" => 2023, "type" => "Electric Sedan"],
    "Ferrari 488 GTB" => ["manufacturer" => "Ferrari", "year" => 2020, "type" => "Sports Coupe"],
    "BMW 7 Series" => ["manufacturer" => "BMW", "year" => 2022, "type" => "Luxury Sedan"],
    "Bugatti Chiron" => ["manufacturer" => "Bugatti", "year" => 2019, "type" => "Supercar"],
    "Porsche Taycan" => ["manufacturer" => "Porsche", "year" => 2023, "type" => "Electric Sedan"],
    "Audi Q8 e-tron" => ["manufacturer" => "Audi", "year" => 2024, "type" => "Electric SUV"]
];

function getCarDetails($model, $details) {
    if (isset($details[$model])) {
        $car = $details[$model];
        return "
        <div style='background:#fff; padding:15px; border-radius:10px; margin:10px 0; border-left:4px solid #27ae60;'>
            <h3 style='margin-top:0;'>🚗 $model</h3>
            <p><strong>Manufacturer:</strong> {$car['manufacturer']}</p>
            <p><strong>Year:</strong> {$car['year']}</p>
            <p><strong>Type:</strong> {$car['type']}</p>
        </div>";
    } else {
        return "
        <div style='background:#ffeaa7; padding:15px; border-radius:10px; margin:10px 0; border-left:4px solid #fdcb6e;'>
            <p><strong>❌ Car not found:</strong> \"$model\"</p>
        </div>";
    }
}

// ===============================================
// BUILD BST WITH CAR MODELS
// ===============================================
$bst = new BinarySearchTree();
foreach ($carDetails as $model => $info) {
    $bst->insert($model);
}

// ===============================================
// PAGE OUTPUT
// ===============================================
echo "<div style='font-family: Arial; background:#f4f6f7; padding:20px; border-radius:10px; max-width:900px; margin:20px auto;'>";

echo "<h2 style='text-align:center; color:#2c3e50;'>🚙 Car Showroom Management System</h2>";

echo "<div style='background:white; padding:20px; border-radius:10px; margin:15px 0;'>";
echo "<h3>Showroom Categories (Recursive Display):</h3>";
displayShowroom($carShowroom);
echo "</div>";

echo "<div style='background:white; padding:20px; border-radius:10px; margin:15px 0;'>";
echo "<h3>Car Details (Hash Table Lookup):</h3>";
echo getCarDetails("Tesla Model S", $carDetails);
echo getCarDetails("Ferrari 488 GTB", $carDetails);
echo getCarDetails("Unknown Car", $carDetails);
echo "</div>";

echo "<div style='background:white; padding:20px; border-radius:10px; margin:15px 0;'>";
echo "<h3>Alphabetical Car List (BST Traversal):</h3>";
$bst->inorderTraversal($bst->root);
echo "</div>";

echo "<div style='background:white; padding:20px; border-radius:10px; margin:15px 0;'>";
echo "<h3>Search Results (BST Search):</h3>";
echo "Search for \"Ferrari 488 GTB\": " . ($bst->search("Ferrari 488 GTB") ? "✅ Found" : "❌ Not Found") . "<br>";
echo "Search for \"Toyota Supra\": " . ($bst->search("Toyota Supra") ? "✅ Found" : "❌ Not Found") . "<br>";
echo "Search for \"Porsche Taycan\": " . ($bst->search("Porsche Taycan") ? "✅ Found" : "❌ Not Found") . "<br>";
echo "</div>";

echo "</div>";
?>
