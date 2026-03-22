

<?php
// --- DB SETTINGS ---
$DB_HOST = "localhost";   // XAMPP default
$DB_USER = "root";        // XAMPP default
$DB_PASS = "";            // XAMPP default (empty password)
$DB_NAME = "donation_db"; // your database

$TABLE   = "myntra_products_catalog_3"; // your table

// --- CONNECT ---
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) {
  die("DB connection failed: " . $conn->connect_error);
}

// --- GET USER QUERY ---
$q = isset($_POST['q']) ? trim($_POST['q']) : "";
if ($q === "") {
  die("Please go back and enter a description.");
}
$q_lc = mb_strtolower($q);

// --- SIMPLE 'AI' RULES (keyword-based) ---

// 1) Category detection
$CATEGORY_MAP = [
  't[-\s]?shirt|tee'                     => 'T-Shirt',
  'shirt'                                => 'Shirt',
  'kurta|kurti'                          => 'Kurta',
  'saree|sari'                           => 'Saree',
  'jeans|denim'                          => 'Jeans',
  'dress|gown'                           => 'Dress',
  'jacket|coat|blazer'                   => 'Jacket',
  'sweater|jumper|hoodie|cardigan'       => 'Sweater',
  'top|blouse'                           => 'Top',
  'skirt'                                => 'Skirt',
  'shorts'                               => 'Shorts',
  'legging|tights'                       => 'Leggings',
  'shoe|sneaker|sandal|footwear'         => 'Footwear',
  'bag|backpack|handbag'                 => 'Bag'
];

$detectedCategory = null;
$categorySearchTerm = null;
foreach ($CATEGORY_MAP as $pattern => $label) {
  if (preg_match("/$pattern/i", $q)) {
    $detectedCategory = $label;
    $categorySearchTerm = $label;
    break;
  }
}

// 2) Gender detection
$gender = null;
$GENDER_MAP = [
  'women|lady|female|girl' => 'Women',
  'men|man|male|guy|boy'   => 'Men',
  'boys'                   => 'Boys',
  'girls'                  => 'Girls',
  'unisex'                 => 'Unisex'
];
foreach ($GENDER_MAP as $pattern => $val) {
  if (preg_match("/$pattern/i", $q)) {
    $gender = $val; break;
  }
}

// 3) Color detection
$colors = ['Black','White','Blue','Red','Green','Yellow','Orange','Pink','Purple','Brown','Grey','Navy','Maroon','Beige','Teal','Olive','Gold','Silver','Multi'];
$color = null;
foreach ($colors as $c) {
  if (strpos($q_lc, strtolower($c)) !== false) {
    $color = $c; 
    break;
  }
}

// 4) Budget detection
$budget = null;
if (preg_match('/(?:under|below|upto|up to|max|less than|<)\s*([0-9]+)/i', $q_lc, $m)) {
  $budget = (int)$m[1];
}

// --- BUILD SQL ---
$where = [];
$esc = fn($s) => $conn->real_escape_string($s);

// Category
if ($categorySearchTerm) {
  $kw = '%' . $esc($categorySearchTerm) . '%';
  $where[] = "(ProductName LIKE '$kw' OR Description LIKE '$kw')";
}

// Gender
if ($gender) {
  $where[] = "Gender = '" . $esc($gender) . "'";
}

// Color
if ($color !== null) {
  $where[] = "PrimaryColor LIKE '%" . $esc($color) . "%'";
}

// Budget
if ($budget !== null) {
  $where[] = "`Price (INR)` <= " . (int)$budget;
}

// Build final query
$sql = "
  SELECT 
    ProductID,
    ProductName,
    ProductBrand,
    Gender,
    `Price (INR)`,
    NumImages,
    Description,
    PrimaryColor
  FROM $TABLE
  WHERE 1
";
if ($where) {
  $sql .= " AND " . implode(" AND ", $where);
}
$sql .= " ORDER BY `Price (INR)` ASC LIMIT 50";

$result = $conn->query($sql);
if (!$result) {
  die("Query error: " . $conn->error . "<br>SQL: " . htmlspecialchars($sql));
}

// --- OUTPUT ---
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Search Results</title>
<style>
  body { 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    margin: 20px; 
    background-color: #fff8f0; /* soft cream */
    color: #4b3832; /* deep warm brown */
  }

  table { 
    border-collapse: collapse; 
    width: 100%; 
    margin-top: 20px; 
    background-color: #fff1e6; /* light peach */
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border-radius: 10px;
    overflow: hidden;
  }

  th { 
    background: #c97b63; /* muted coral */
    color: #ffe8d6; /* warm pale */
    padding: 12px; 
    text-align: left; 
    font-weight: bold;
    font-size: 1rem;
  }

  td { 
    border: 1px solid #f1d9cc; 
    padding: 10px; 
    color: #4b3832; 
    font-size: 0.95rem;
  }

  tr:nth-child(even) { 
    background: #fff8f0; /* soft cream for even rows */
  }

  tr:hover { 
    background: #f9e2d2; /* subtle warm highlight on hover */
    transition: background 0.3s ease;
  }

  .back { 
    display: inline-block; 
    margin-bottom: 15px; 
    padding: 8px 14px; 
    background: #d4a373; /* warm caramel */
    color: white; 
    border-radius: 5px; 
    text-decoration: none; 
    font-weight: bold;
    transition: background 0.3s;
  }

  .back:hover { 
    background: #b08968; /* deeper caramel */
  }

  .meta { 
    margin: 10px 0; 
    color: #9c6644; /* warm coffee brown */
    font-style: italic;
  }
</style>

</head>
<body>
  <a class="back" href="categorize.html">&larr; Back</a>
  <h2>Results for “<?php echo htmlspecialchars($q); ?>”</h2>
  <div class="meta">
    <?php
      $bits = [];
      if ($detectedCategory) $bits[] = "Category: <b>$detectedCategory</b>";
      if ($gender)           $bits[] = "Gender: <b>$gender</b>";
      if ($color)            $bits[] = "Color: <b>$color</b>";
      if ($budget !== null)  $bits[] = "Budget ≤ <b>$budget</b>";
      echo $bits ? implode(" • ", $bits) : "No filters detected – showing general matches.";
    ?>
  </div>

  <?php if ($result->num_rows === 0): ?>
    <p>No matching products found.</p>
  <?php else: ?>
    <table>
      <tr>
        <th>Product ID</th>
        <th>Name</th>
        <th>Brand</th>
        <th>Gender</th>
        <th>Price (INR)</th>
        <th>Color</th>
        <th>Description</th>
      </tr>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo htmlspecialchars($row['ProductID']); ?></td>
          <td><?php echo htmlspecialchars($row['ProductName']); ?></td>
          <td><?php echo htmlspecialchars($row['ProductBrand']); ?></td>
          <td><?php echo htmlspecialchars($row['Gender']); ?></td>
          <td><?php echo htmlspecialchars($row['Price (INR)']); ?></td>
          <td><?php echo htmlspecialchars($row['PrimaryColor']); ?></td>
          <td><?php echo htmlspecialchars($row['Description']); ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
  <?php endif; ?>

</body>
</html>
<?php
$conn->close();
