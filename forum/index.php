
<?php
session_start();
if(!isset($_SESSION["username"])) {
  header("location: ../login/index.php");
  exit;
}
?>

<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
    crossorigin="anonymous">
    <title>Fundsachenforum - Forum</title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.html">
        <img src="img/logo.png" alt="Logo" width="28" height="30" class="d-inline-block align-text-top">
        &nbsp; GymBW</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <ul class="navbar-nav">
            <li class="nav-item">
          <a class="nav-link" href="../login/index.php">Abmelden</a>
         </li>
         <li class="nav-item">
          <a class="nav-link" href="add.php">Fundsache hinzufügen</a>
         </li>
       </ul>
     </div>
    </div>
  </nav>

  <?php
    require("rankmanager.php");
    echo "Dein Rang ist " .getRank($_SESSION["username"]);
  ?>

  <h1 class="text-center mt-4">Fundsachen</h1><br>

<div class="mx-3">
  <div class="input-group mb-3">
    <input type="text" name="suchfeld" class="form-control" placeholder="Suche" aria-label="Suche" aria-describedby="button-addon2">
    <button class="btn btn-outline-secondary" name="suchen" type="submit" id="button-addon">Suchen</button>
  </div>
</div>
  

<?php
  include "card.php";

?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
      crossorigin="anonymous"></script>
</body>
</html>