<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate / Sell - Share The Style</title>
    <link rel="stylesheet" href="styles.css">
    <style>

        .container {
            max-width: 600px;
            margin: 2rem auto;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea {
            resize: vertical;
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

</style>
<link rel="stylesheet" href="styles.css">
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
<br>
<br>
<section class="container" style="max-width: 600px;">
    <h2>List Your Clothes 📋✔️</h2>
    <form action="donate_handler.php" method="post">
    <label for="item_name">Item Name:</label>
    <input type="text" id="item_name" name="item_name" required>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea>

    <label for="photo">Upload Photo:</label>
    <input type="file" id="photo" name="photo" accept="image/*" required>

    <button type="submit" style="margin-top: 1.5rem;">Donate Item</button>
</form>

</section>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/689854eb54cfc319258950de/1j29gneo5';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->

<footer>
    &copy; 2025 Share The Style | Spreading Warmth Through Fashion
</footer>
</body>
</html>
