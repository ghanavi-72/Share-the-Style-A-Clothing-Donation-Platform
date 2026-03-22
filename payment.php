<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Donation - Share The Style</title>
    <link rel="stylesheet" href="styles.css">
<style>
    body {
        background-color: #f9f9f9;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 600px;
        margin: 2rem auto;
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    h2 {
        font-size: 1.8rem;
        text-align: center;
        color: #8b5e3c; /* warm brown tone */
        margin-bottom: 1.5rem;
    }

    form h3 {
        color: #8b5e3c;
        margin-bottom: 1rem;
    }

    label {
        display: block;
        font-weight: bold;
        margin-top: 1rem;
        color: #5a4634;
    }

    input,
    textarea {
        width: 100%;
        padding: 0.6rem;
        margin-top: 0.3rem;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 1rem;
    }

    .buy-btn {
        background-color: #b1764c;
        border: none;
        color: white;
        padding: 0.75rem;
        margin-top: 1.5rem;
        font-size: 1rem;
        font-weight: bold;
        border-radius: 6px;
        cursor: pointer;
        width: auto;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    .buy-btn:hover {
        background-color: #945d3e;
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
</header>

<section class="container">
    <h2 style="text-align:center;">Request Your Donation</h2>
    <form action="payment_handler.php" method="post">
        <h3>Your Details</h3>

        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="address">Delivery Address</label>
        <textarea id="address" name="address" rows="3" required></textarea>

        <label for="city">City</label>
        <input type="text" id="city" name="city" required>

        <label for="zip">Postal Code</label>
        <input type="text" id="zip" name="zip" required>

        <button type="submit" class="buy-btn">Request Item</button>
    </form>
</section>

<footer>
    &copy; 2025 Share The Style | Spreading Warmth Through Fashion
</footer>
</body>
</html>

