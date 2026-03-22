<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Search Results</title>
  <!-- Link to your CSS file just like in HTML -->
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


header {
    background-color: #c97b63; /* muted coral */
    color: white;
    padding: 15px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.15);
}

header h1 {
    font-size: 1.5rem;
    color: #ffe8d6; /* warm pale */
}

nav a {
    color: white;
    margin: 0 15px;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
}

nav a:hover {
    color: #ffe8d6;
}

h2 {
  color: #9c6644;
  text-align: center;
}
</style>

</head>
<body>
<header>
    <h1>Share The Style</h1>
    <nav>
        <a href="index.html">Home</a>
        <a href="buy.html">Buy</a>
        <a href="sell.php">Donate</a>
        <a href="categorize.html">AI Search</a>
        <a href="products.php">Available product deatils</a>
    </nav>
</header><br>
<h2>AVAILABLE PRODUCT DETAILS IN OUT PLATFORM 👕🛍️</h2>
<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "donation_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query data
$sql = "SELECT * FROM myntra_products_catalog_3 LIMIT 2000";


$result = $conn->query($sql);

// Display in table format
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0'>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Gender</th>
                <th>Price (INR)</th>
                <th>Images</th>
                <th>Description</th>
                <th>Primary Color</th>
            </tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['ProductID']."</td>
                <td>".$row['ProductName']."</td>
                <td>".$row['ProductBrand']."</td>
                <td>".$row['Gender']."</td>
                <td>".$row['Price (INR)']."</td>
                <td>".$row['NumImages']."</td>
                <td>".$row['Description']."</td>
                <td>".$row['PrimaryColor']."</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No records found.";
}

$conn->close();
?>
</body>
</html>


