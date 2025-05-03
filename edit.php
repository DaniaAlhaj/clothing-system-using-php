<?php
require_once "dbconfig.in.php";

if (isset($_GET['id'])) {
    try {
        $productId = $_GET['id'];

        // Correct SQL query and bind parameter
        $sql = "SELECT * FROM product WHERE productId = :productId";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':productId', $productId, PDO::PARAM_INT);
        $statement->execute();
        $specific_product = $statement->fetch(PDO::FETCH_ASSOC);

    
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>
<body>
    <h2>Update Product</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $productId; ?>" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend><strong>Product Record</strong></legend>

            <label for="Product_id">Product ID:</label>
            <input type="text" name="Product_id" value="<?php echo ($specific_product['productId']); ?>" disabled><br>

            <input type="hidden" name="product_id" value="<?php echo ($specific_product['productId']); ?>">

            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo ($specific_product['productName']); ?>"><br>

            <label for="category_select">Category:</label>
            <select id="category_select" name="category_select" disabled>
                <option value="1" <?php if ($specific_product['category'] == "Sweater") echo 'selected'; ?>>Sweater</option>
                <option value="2" <?php if ($specific_product['category'] == "FormalShirt") echo 'selected'; ?>>Formal Shirt</option>
            </select><br>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo ($specific_product['price']); ?>"><br>

            <label for="rating">Rating:</label>
            <input type="text" id="rating" name="rating" value="<?php echo ($specific_product['rating']); ?>" disabled><br>

            <label for="quantity">Quantity:</label>
            <input type="text" id="quantity" name="quantity" value="<?php echo ($specific_product['quantity']); ?>"><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="50"><?php echo ($specific_product['description']); ?></textarea><br>

            <label for="product_imagee">Product Image:</label>
            <input type="file" id="product_image" name="product_image"><br>

            <input type="submit" name="update" value="Update">
        </fieldset>
    </form>
</body>
</html>
        <?php
       
    } catch (PDOException $e) {
        die("PDO Exception: " . $e->getMessage());
    }
}

if (isset($_POST['update'])) {
    try {
        $productId = $_POST['product_id'];
        $productName = $_POST['product_name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];
        $productImageName = $productId . '.jpeg';

       
        $sql = "UPDATE product SET productName = :productName, description = :description,
                price = :price, quantity = :quantity, productImageName = :productImageName
                WHERE productId = :productId";
        $statement = $pdo->prepare($sql);

        $statement->bindValue(':productName', $productName);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':quantity', $quantity);
        $statement->bindValue(':productImageName', $productImageName);
        $statement->bindValue(':productId', $productId, PDO::PARAM_INT);

       if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
            if ($_FILES['product_image']['type'] == "image/jpeg") {
                $photoName = $productId . ".jpeg";
                $path = "img/" . $photoName;
                
              
                    if (file_exists($path)) {
                        unlink($path); 
                    }
                    if (move_uploaded_file($_FILES['product_image']['tmp_name'], $path)) {
                        echo "File uploaded successfully.";
                    } 
                
            } else {
                echo "File type must be a JPEG image.";
            }
        }

        $done = $statement->execute();

            echo "Product updated successfully!";
        
    } catch (Exception $e) {
        die("Exception: " . $e->getMessage());
    } catch (PDOException $e) {
        die("PDO Exception: " . $e->getMessage());
    }
}
?>
