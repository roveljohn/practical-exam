HASH TABLE DATA RETRIEVAL
// ===============================================
$movieDatabase = [
    "Iron Man" => [
        "Director" => "Jon Favreau",
        "Released" => 2008,
        "Genre" => "Superhero Action"
    ],
    "The Godfather" => [
        "Director" => "Francis Ford Coppola",
        "Released" => 1972,
        "Genre" => "Crime Drama"
    ],
    "Titanic" => [
        "Director" => "James Cameron",
        "Released" => 1997,
        "Genre" => "Romantic Drama"
    ]
];

function getMovieDetails($title, $database) {
    echo "=== MOVIE DETAILS ===\n";
    if (isset($database[$title])) {
        $data = $database[$title];
        echo "Title: $title\n";
        echo "• Director: " . $data['Director'] . "\n";
        echo "• Released: " . $data['Released'] . "\n";
        echo "• Genre: " . $data['Genre'] . "\n\n";
    } else {
        echo "Title: $title\n• STATUS: Not found in database\n\n";
    }
}

getMovieDetails("The Godfather", $movieDatabase);
getMovieDetails("Iron Man", $movieDatabase);
getMovieDetails("Unknown Movie", $movieDatabase);

// ===============================================
// 3. BINARY SEARCH TREE OPERATIONS
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
        $this->root = $this->insertRec($this->root, $data);
    }

    private function insertRec($node, $data) {
        if ($node == null) return new Node($data);
        if (strcasecmp($data, $node->data) < 0)
            $node->left = $this->insertRec($node->left, $data);
        else
            $node->right = $this->insertRec($node->right, $data);
        return $node;
    }

    public function inorderTraversal($node) {
        if ($node != null) {
            $this->inorderTraversal($node->left);
            echo $node->data . "\n";
            $this->inorderTraversal($node->right);
        }
    }

    public function search($node, $data) {
        if ($node == null) return false;
        if (strcasecmp($data, $node->data) == 0) return true;
        if (strcasecmp($data, $node->data) < 0)
            return $this->search($node->left, $data);
        else
            return $this->search($node->right, $data);
    }
}

// Create BST and insert movies
$bst = new BinarySearchTree();
$movieTitles = [
    "Iron Man", "Jurassic Park", "Pirates of the Caribbean",
    "Spider-Man: No Way Home", "The Godfather", "The Irishman",
    "The Notebook", "Titanic"
];

foreach ($movieTitles as $title) {
    $bst->insert($title);
}

echo "=== ALPHABETICAL MOVIE INDEX ===\n";
$bst->inorderTraversal($bst->root);
echo "\n";

echo "=== QUERY RESULTS ===\n";
$queries = ["Titanic", "Avatar", "The Godfather"];
foreach ($queries as $query) {
    $found = $bst->search($bst->root, $query);
    echo "Search(\"$query\"): " . ($found ? "✓ FOUND" : "✗ NOT FOUND") . "\n";
}
?>