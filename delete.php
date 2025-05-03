<?php
require_once "dbconfig.in.php";

if (isset($_GET['id'])) {
    try {
        $productId = $_GET['id'];

        $sql = "DELETE FROM product WHERE productId = :productId";
        $statement = $pdo->prepare($sql);

        $statement->bindValue(':productId', $productId);



 $filename = 'img/' . $productId . '.jpeg';

        if (file_exists($filename)) {
            unlink($filename);
        }


        $done = $statement->execute();

        if ($done) {
            echo "Product deleted successfully!";
        }
        
    } catch (Exception $e) {
        die("Exception: " . $e->getMessage());
    } catch (PDOException $e) {
        die("PDO Exception: " . $e->getMessage());
    }
}
?>
