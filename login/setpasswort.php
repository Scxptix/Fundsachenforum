<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
    crossorigin="anonymous">
    <title>Fundsachenforum - Neues Passwort</title>
</head>
<body>

<?php
    if(isset($_GET["token"])){
        require("mysql.php");
        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE TOKEN = :token"); //Username überprüfen
        $stmt->bindParam(":token", $_GET["token"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count != 0){
            if(isset($_POST["submit"])){
                if($_POST["pw1"] == $_POST["pw2"]){
                    $hash = password_hash($_POST["pw1"], PASSWORD_BCRYPT);
                    $stmt = $mysql->prepare("UPDATE accounts SET PASSWORD = :pw, TOKEN = null WHERE TOKEN = :token");
                    $stmt->bindParam(":pw", $hash);
                    $stmt->bindParam(":token", $_GET["token"]);
                    $stmt->execute();
                    echo 'Das Passwort wurde geändert <br>
                    <a href="index.php"></a>Login</a>';
                } else {
                    echo "Die Passwörter stimmen nicht überein";
                }
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
      <h5 class="card-title mx-auto mt-3 fs-1">Neues Passwort setzen</h5>
        <div class="card-body mx-3">
          <form action="setpasswort.php?token=<?php echo $_GET["token"] ?>" method="POST">
            <p class="card-text">

              <div class="input-group input-group-lg mb-4">
                <span class="input-group-text" id="basic-addon1"></span>
                <input type="password" name="pw" class="form-control" placeholder="Passwort" aria-label="Passwort" aria-describedby="basic-addon1" required><br><br>
              </div>

              <div class="input-group input-group-lg mb-4">
                <span class="input-group-text" id="basic-addon1"></span>
                <input type="password" name="pw2" class="form-control" placeholder="Passwort wiederholen" aria-label="Passwort wiederholen" aria-describedby="basic-addon1" required><br><br>
              </div>

              <button type="submit" name="submit" class="btn btn-success col-12">Zurücksetzen</button>
            </p>
          </form>
        </div>    
    </div>

    <?php
        } else {
            echo "Der Token ist ungültig";
        }
    } else {
        echo "Kein gültiger Token gesendet";
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
      crossorigin="anonymous"></script>
  </body>
</html>
    