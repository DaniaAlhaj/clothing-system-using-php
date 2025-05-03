<?php
require_once 'dbconfig.in.php';
require_once 'ProductClass.php';

if (isset($_GET['id'])) {
    try {
        $productId = $_GET['id'];

        $sql = "SELECT * FROM product WHERE productId = :productId";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':productId', $productId);
        $statement->execute();
        $specific_product = $statement->fetch(PDO::FETCH_ASSOC);

        
            
            $product = new Product(
                $specific_product['productId'],
                $specific_product['productName'],
                $specific_product['category'],
                $specific_product['description'],
                $specific_product['price'],
                $specific_product['rating'],
                $specific_product['quantity'],
                $specific_product['productImageName']
            );


            echo $product->displayProductPage();
       

    } catch (PDOException $e) {
        die("PDO Exception: " . $e->getMessage());
    }
}
?>
