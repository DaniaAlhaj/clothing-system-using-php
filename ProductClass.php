<?php
class Product {
    private $productId;
    private $productName;
    private $category;
    private $description;
    private $price;
    private $rating;
    private $quantity;
    private $productImageName;

    public function __construct($productId, $productName, $category, $description, $price, $rating, $quantity, $productImageName) {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->category = $category;
        $this->description = $description;
        $this->price = $price;
        $this->rating = $rating;
        $this->quantity = $quantity;
        $this->productImageName = $productImageName;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
    }

    public function getProductName() {
        return $this->productName;
    }

    public function setProductName($productName) {
        $this->productName = $productName;
    }

 
       public function getCategoryName() {
        return $this->category;
    
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getRating() {
        return $this->rating;
    }

    public function setRating($rating) {
        $this->rating = $rating;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function getProductImageName() {
        return $this->productImageName;
    }

    public function setProductImageName($productImageName) {
        $this->productImageName = $productImageName;
    }

    public function displayInTable() {
        $imgPath = "img/" . ($this->productImageName);
        $img = "<img src='$imgPath' alt='" . ($this->productName) . "' width='100' height='100' />";

        $editImage = "<img src='img/edit.png' alt='Edit' width='20' height='20' />";
        $editButton = '<a href="edit.php?id=' . $this->productId . '">' . $editImage . '</a>';

        $deleteImage = "<img src='img/delete.png' alt='Delete' width='20' height='20' />";
        $deleteButton = '<a href="delete.php?id=' . $this->productId . '">' . $deleteImage . '</a>';

        $linkID = '<a href="view.php?id=' . $this->productId . '">' . $this->productId . '</a>';

         
    

        $html = '<tr>';
        $html .= '<td>' . $img . '</td>';
        $html .= '<td>' . $linkID . '</td>';
        $html .= '<td>' . ($this->getProductName()) . '</td>';
        $html .= '<td>' . ($this->getCategoryName()) . '</td>';
        $html .= '<td>' . ($this->getPrice()) . '</td>';
        $html .= '<td>' . ($this->getQuantity()) . '</td>';
        $html .= '<td>' . $editButton . ' ' . $deleteButton . ' '  . '</td>';
        $html .= '</tr>';

        return $html;
    }
 public function displayProductPage() {
    $imgPath = "img/" . $this->productImageName;
    $img = "<img src='$imgPath' alt='" . ($this->productName) . "' width='300' height='300' />";
    
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Details</title>
    </head>
    <body>
        <?php echo $img; ?>
        
        <h2><?php echo "Product ID  " . ($this->productId) ." , " .($this->productName) ; ?>  </h2>
        <ul>
        <li>Price: <?php echo $this->price; ?></li>
        <li>Category: <?php echo htmlspecialchars($this->category); ?></li>
        <li>Rating: <?php echo $this->rating; ?></li>
       
    </ul>
    <h2>Describtion  </h2>
   <ul> 
    <?php
            
            $descriptionLines = explode("\n", $this->description);
            
            
            foreach ($descriptionLines as $line) {
                echo "<li>" . htmlspecialchars(trim($line)) . "</li>";
            }
            ?> 
   </ul>
    
      
    </body>
    </html>
    <?php
}

}
