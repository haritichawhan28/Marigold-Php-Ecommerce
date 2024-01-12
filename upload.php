
<?php 
require("db_conn.php"); // Get config file
// Check for successful image upload
if (isset($_FILES["Media"]) && $_FILES["Media"]["error"] == 0) {

    // Get uploaded image content
    $uploadedImageContent = file_get_contents($_FILES['Media']['tmp_name']);
    
    // Prepare SQL query to insert image
    $insertImageStmt = mysqli_prepare($conn, "INSERT INTO tbl_media(Media) VALUES(?)");

    if($insertImageStmt === false) {
        // SQL prep failed
        $message = "SQL prep failed: " . mysqli_error($conn);
    } else {
        // Bind image content to SQL query
        mysqli_stmt_bind_param($insertImageStmt, 's', $uploadedImageContent);
        
        // Execute SQL query
        if (mysqli_stmt_execute($insertImageStmt)) {
            // Upload successful
            $message ="15/- Rs";
        } else {
            // Upload failed
            $message = "Upload failed: " . mysqli_stmt_error($insertImageStmt);
        }
    }
}
?>


<?php
    // Fetch latest uploaded image
    $result = mysqli_query($conn, "SELECT MediaID, Media FROM tbl_media ORDER BY MediaID DESC LIMIT 1");

    if ($result && mysqli_num_rows($result) > 0) {
        // Extract image data if exists
        $imageRow = mysqli_fetch_assoc($result);
        
        // Display the image
        echo '<img src="data:image/jpeg;base64,' . base64_encode($imageRow['Media']) . '" alt="Uploaded Image">';

        echo "<a href='home.php?pro_id=Marigold'>Add to cart</a>";

      // Delete the image from the database
      //  $deleteResult = mysqli_query($conn, "DELETE FROM tbl_media WHERE MediaID = " . $imageRow['MediaID']);

    } 

    // Output message if exists
    echo isset($message) ? "<div class='message'>$message</div>" : '';

    // Close the DB connection
    mysqli_close($conn);
    ?>


<?php

//cart code which was present in the home 

session_start();

// Check if product is coming or not
if (isset($_GET['pro_id'])) {

  $proid = $_GET['pro_id'];

  // If session cart is not empty
  if (!empty($_SESSION['cart'])) {

    // Using "array_column() function" we get the product id existing in session cart array
    $acol = array_column($_SESSION['cart'], 'pro_id');

    // now we compare whther id already exist with "in_array() function"
    if (in_array($proid, $acol)) {

      // Updating quantity if item already exist
      $_SESSION['cart'][$proid]['qty'] += 1;
    } else {
      // If item doesn't exist in session cart array, we add a new item
      $item = [
        'pro_id' => $_GET['pro_id'],
        'qty' => 1
      ];

      $_SESSION['cart'][$proid] = $item;
    }
  } else {
    // If cart is completely empty, then store item in session cart
    $item = [
      'pro_id' => $_GET['pro_id'],
      'qty' => 1
    ];

    $_SESSION['cart'][$proid] = $item;
  }
}
?>
