<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
</head>
<body>

<main>

<p>To add a new product, click on the following link: <a href="add.php">Add Product</a></p>
<p>Use the action below to edit or delete a product's record</p>

<form enctype="multipart/form-data" method="POST" action="<?php echo ($_SERVER['PHP_SELF']); ?>">
    
    <fieldset>
        <legend><strong>Advanced Product Search</strong></legend>
        
        <input type="text" id="text_choose" name="search" placeholder="Search product name">
        
        
        <input type="radio" id="name" name="group" value="name">
        <label for="name">Name</label>

        <input type="radio" id="price" name="group" value="price">
        <label for="price">Price</label>

        <input type="radio" id="category" name="group" value="category">
        <label for="category">Category</label>

        <select name="category_select">
            <option value="">Select Category</option>
            <option value="Sweater">Sweater</option>
            <option value="FormalShirt">Formal Shirt</option>
        </select>

        <input type="submit" value="Filter" name="Filter">
    
  
    
</form>

<?php
require 'dbconfig.in.php'; 
require 'ProductClass.php'; 

if (isset($_POST['Filter'])) {
    $query = "SELECT * FROM product WHERE 1=1";
   
    $selectedOption = isset($_POST['group']) ? $_POST['group']: '';
    $search = isset($_POST['search']) ? ($_POST['search']) : '';
    $category = isset($_POST['category_select']) ? ($_POST['category_select']) : '';
    
    if ($selectedOption == "price" && $search == "80") {
        $query .= " AND price >= :search";
    } elseif ($selectedOption == "name" && !empty($search)) {
        $query .= " AND productName LIKE :search";
    } elseif ($selectedOption == "price" && !empty($search)) {
        $query .= " AND price = :search";
    }

    if (!empty($category)) {
        $query .= " AND category = :category";
    }

    try {
        $statement = $pdo->prepare($query);

        if ($selectedOption == "price" && $search == "80") {
            $statement->bindValue(':search', $search);
        } elseif ($selectedOption == "name" && !empty($search)) {
            $search = "%$search%";
            $statement->bindValue(':search', $search);
        } elseif ($selectedOption == "price" && !empty($search)) {
            $statement->bindValue(':search', $search);
        }

        if (!empty($category)) {
            $statement->bindValue(':category', $category);
        }
        
        $statement->execute();
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

        echo '<table border="1">
            <caption>Product table results</caption>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($products as $productData) {
            $product = new Product(
                $productData['productId'],
                $productData['productName'],
                $productData['category'],
                $productData['description'],
                $productData['price'],
                $productData['rating'],
                $productData['quantity'],
                $productData['productImageName']
            );
            echo $product->displayInTable();
        }

        echo '</tbody></table>';
        echo ' </fieldset> ';
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


else {
    try {
        $query = "SELECT * FROM product";
        $statement = $pdo->prepare($query);
        $statement->execute();
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

        echo '<table border="1">
            <caption>Product table results</caption>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($products as $productData) {
            $product = new Product(
                $productData['productId'],
                $productData['productName'],
                $productData['category'],
                $productData['description'],
                $productData['price'],
                $productData['rating'],
                $productData['quantity'],
                $productData['productImageName']
            );
            echo $product->displayInTable();
        }

        echo '</tbody></table>';
        echo ' </fieldset> ';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

</main>

<footer></footer>

</body>
</html>
