<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>MARIGOLD</title>
 </head>
 <body>


<! <?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
}else{
     header("Location: index.php");
     exit();
}
?> >

<?php include 'header.php'; ?>

<div class="container">
  <div class="row">

  <div class="card" style="width: 18rem;">
    <img src="img/product1.jpeg" class="card-img-top">
    <div class="card-body">
      <h5 class="card-title">Marigold</h5>
      <p class="card-text">15/- Rs</p>
      <a href="home.php?pro_id=Marigold" class="btn btn-success">Add to Cart</a>
    </div>

    <div class="col-md-4">
        <div class="col-md-4">
      <div class="card" style="width: 18rem;">
        <img src="img/rose.jpeg" class="card-img-top">
        <div class="card-body">
          <h5 class="card-title">Rose</h5>
          <p class="card-text">20/- Rs</p>
          <a href="home.php?pro_id=Rose" class="btn btn-success">Add to Cart</a>
        </div>
      </div>   
    </div>

</div>
<?php include 'upload.php'; ?>
<?php include 'footer.php'; ?>

 </body>
 </html>





 