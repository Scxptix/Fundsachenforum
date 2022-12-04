<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
    crossorigin="anonymous">
    <title>Fundsachenforum - Fundsache hinzufügen</title>
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
          <a class="nav-link" href="index.php">Zurück</a>
         </li>
       </ul>
     </div>
    </div>
  </nav>

  <div class="card m-3">
    <h5 class="card-title mx-auto mt-3 fs-1">Fundsache hinzufügen</h5>
    <div class="card-body mx-3">
        <p class="card-text">
            <form action="add.php" method="post">

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"></span>
                    <input type="text" name="titel" class="form-control" placeholder="Titel" aria-label="Titel" aria-describedby="basic-addon1" required><br>
                </div>

                <div class="input-group mb-3">
                    <input type="file" name="bild" class="form-control" id="inputGroupFile02">
                </div>


                <div class="form-floating">
                    <textarea name="text" class="form-control" placeholder="Beschreibung" id="floatingTextarea2" style="height: 100px" required></textarea><br>
                    <label for="floatingTextarea2">Beischreibung</label>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"></span>
                    <input type="text" name="kontakt" class="form-control" placeholder="Kontakt" aria-label="Kontakt" aria-describedby="basic-addon1" required><br>
                </div>

                <button type="submit" name="submit" class="btn btn-success col-12">Hinzufügen</button>
            </form>
        </p>
    </div>
  </div>

    <?php
    if(isset($_POST["submit"])){
        require("mysql.php");
        $stmt = $mysql->prepare("INSERT INTO items (TITEL, TEXT, KONTAKT, DATUM) VALUES (:titel, :text, :kontakt, :now)");
        $stmt->bindParam(":titel", $_POST["titel"], PDO::PARAM_STR);
        $stmt->bindParam(":text", $_POST["text"], PDO::PARAM_STR);
        $stmt->bindParam(":kontakt", $_POST["kontakt"], PDO::PARAM_STR);
        $now = time();
        $stmt->bindParam(":now", $now, PDO::PARAM_STR);
        $stmt->execute();
        echo "Deine Fundsache wurde erfolgreich hinzugefügt.";

    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
      crossorigin="anonymous"></script>
    
</body>
</html>
