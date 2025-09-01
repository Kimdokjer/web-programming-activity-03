<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<!-- GET= Data shows in the URL
         POST= Data is hidden-->
         <?php 

$product_name = "";
$category = "";
$price = "";
$stock_quantity = "";
$expiration_date = "";
$status = "";


$product_name_error = "";
$category_error = "";
$price_error = "";
$stock_quantity_error = "";
$expiration_date_error = "";
$status_error = "";

$has_error = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $product_name = trim(htmlspecialchars($_POST["product_name"]));
    $category = trim(htmlspecialchars($_POST["category"]));
    $price = trim(htmlspecialchars($_POST["price"]));
    $stock_quantity = trim(htmlspecialchars($_POST["stock_quantity"]));
    $expiration_date = trim(htmlspecialchars($_POST["expiration_date"]));
    $status = trim(htmlspecialchars($_POST["status"] ?? ""));    


    if(empty($product_name)){
    $product_name_error = "Product name is required";
    $has_error = true;
}

if(empty($category)){
    $category_error = "Category is required";
     $has_error = true;
}

if($price == ""){
    $price_error = "Price is required";
     $has_error = true;
}

elseif(!is_numeric($price) || $price < 1){
    $price_error = "Price must be a number and greater than 0";
     $has_error = true;
}

if($stock_quantity == ""){
    $stock_quantity_error = "Stock quantity is required";
     $has_error = true;
}

else if(!is_numeric($stock_quantity) || $stock_quantity < 0){
    $stock_quantity_error = "Stock quantity must be a number and not be negative";
     $has_error = true;
}

if(empty($expiration_date)){
    $expiration_date_error = "Expiration date is required";
     $has_error = true;
}
else if(strtotime($expiration_date) < strtotime(date('M-d-Y'))){
    $expiration_date_error = "Expiration date must be a future date";
     $has_error = true;
}

if(empty($status)){
    $status_error = "Status is required";
     $has_error = true;
}
if(!$has_error){
    header("Location: redirect.php");
    exit;
}
}

?>
    <form action="" method="post">

    <h2>
    <span class="company-name">Kim Company</span><br>Product Registration
    </h2><br>
        <div class="form-group">
        <label for="">Product name</label>
        <input type="text" name="product_name" value="<?php echo $product_name?>"> <br>
        <p class="error"><?php echo $product_name_error;?></p>
        </div>

        <div class="form-group">
        <label for="">Category: </label>
        <select name="category" id="" >
            <option value="">-- Select Caategory --</option>
            <option value="Category A"<?php if($category == "Category A") echo "selected";?>>Category A</option>
            <option value="Category B" <?php if($category == "Category B") echo "selected";?>>Category B</option>
            <option value="Category C" <?php if($category == "Category C") echo "selected";?>>Category C</option>
            <option value="Category D" <?php if($category == "Category D") echo "selected";?>>Category D</option>
        </select> <br>
        <p class="error"><?php echo $category_error;?></p>
        </div>
        
        <div class="form-group">
        <label for="">Price:(&#8369;): </label> 
        <input type="number" name="price" step="0.01" value="<?php echo $price?>"> <br>
        <p class="error"><?php echo $price_error;?></p>
        </div>
      
      <div class="form-group">
        <label for="">Stock Quantity:</label> 
        <input type="number" name="stock_quantity" min="0" value="<?php echo $stock_quantity?>"> <br>
        <p class="error"><?php echo $stock_quantity_error;?></p>
      </div>  

      <div class="form-group">
         <label>Expiration Date:</label> 
        <input type="date" name="expiration_date" value="<?php echo $expiration_date?>"> <br>
        <p class="error"><?php echo $expiration_date_error;?></p>
      </div>
      
        <div class="form-group">
        <label>Status:</label> 
        <input type="radio" name="status" value="active" <?php if($status == "active") echo "checked"; ?>> Active <br>
        <input type="radio" name="status" value="inactive" <?php if($status == "inactive") echo "checked"; ?>> Inactive <br>
        <p class="error"><?php echo $status_error;?></p>
      <div class="form-group"></div>
       
        <input type="submit" value="Save Product"> <br>


    </form>
</body>
</html>
