<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product Form</title>
</head>
<body>
    <h2>Add Product</h2>
    <form action="<?php echo ($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend><strong>Product Record</strong></legend>
            <label for="product_id">Product ID:</label>
            <input type="text" id="product_id" name="product_id"><br>

            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name"><br>

            <label for="category_select">Category:</label>
            <select id="category_select" name="category_select">
                <option value="Sweater">Sweater</option>
                <option value="FormalShirt">Formal Shirt</option>
            </select><br>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price"><br>

            <label for="rating">Rating:</label>
            <input type="text" id="rating" name="rating"><br>

            <label for="quantity">Quantity:</label>
            <input type="text" id="quantity" name="quantity" ><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="50"placeholder="provide a full describtion for your product"></textarea><br>

            <label for="product_image">Product Image:</label>
            <input type="file" id="product_image" name="product_image"><br>

            <input type="submit" name="insert" value="Insert">
        </fieldset>
    </form>

    <?php
    require_once "dbconfig.in.php";
    require "ProductClass.php";

    if (isset($_POST['insert'])) {
        try {
            $sql = "INSERT INTO product (productId, productName, category, description, price, rating, quantity, productImageName) 
                    VALUES (:productId, :productName, :category, :description, :price, :rating, :quantity, :productImageName)";

            $statement = $pdo->prepare($sql);

            $statement->bindValue(":productId", $_POST['product_id']);
            $statement->bindValue(":productName", $_POST['product_name']);
            $statement->bindValue(":category", $_POST['category_select']);
            $statement->bindValue(":description", $_POST['description']);
            $statement->bindValue(":price", $_POST['price']);
            $statement->bindValue(":rating", $_POST['rating']);
            $statement->bindValue(":quantity", $_POST['quantity']);

            if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
                if ($_FILES['product_image']['type'] == "image/jpeg") {
                    $productId = $_POST['product_id'];
                    $photoName = $productId . ".jpeg";
                    $path = "img/" . $photoName;
                    move_uploaded_file($_FILES['product_image']['tmp_name'], $path);
                    $statement->bindValue(":productImageName", $photoName);
                    $done = $statement->execute();
                    
                  
                } else {
                    echo "File type must be a JPEG image.";
                }
            } else {
                echo "Error uploading file.";
            }
        } catch (Exception $e) {
            die("Exception: " . $e->getMessage());
        } catch (PDOException $e) {
            die("PDO Exception: " . $e->getMessage());
        }
    }
    ?>
</body>
</html>
