<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
    crossorigin="anonymous">
    <title>Fundsachenforum - Passwort zurücksetzen</title>
</head>
<body>

<?php
    if (isset($_POST["submit"])) {
        require("mysql.php");
        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE EMAIL = :email"); //Username überprüfen
        $stmt->bindParam(":email", $_POST["email"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count != 0){
            $token = generateRandomString(25);
            $stmt = $mysql->prepare("UPDATE accounts SET TOKEN = :token WHERE EMAIL = :email");
            $stmt->bindParam(":token", $token);
            $stmt->bindParam(":email", $_POST["email"]);
            $stmt->execute();
            mail($_POST["email"], "Passwort zurücksetzen", "https://dev.tutorialwork.de/Tutorials/Login/setpasswort.php?token=".$token);
            echo "Die Email wurde versendet";
        } else {
            echo "Diese Email ist nicht angemeldet";
        }
    }
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    ?>

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
      <h5 class="card-title mx-auto mt-3 fs-1">Passwort zurücksetzen</h5>
        <div class="card-body mx-3">
          <form action="passwortreset.php" method="POST">
            <p class="card-text">

              <div class="input-group input-group-lg mb-4">
                <span class="input-group-text" id="basic-addon1"></span>
                <input type="email" name="email" class="form-control" placeholder="Lernsax-Email" aria-label="Lernsax-Email" aria-describedby="basic-addon1" required><br><br>
              </div>

              <button type="submit" name="submit" class="btn btn-success col-12">Zurücksetzen</button>
            </p>
          </form>
        </div>    
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
      crossorigin="anonymous"></script>
  </body>
</html>
    
</body>
</html>