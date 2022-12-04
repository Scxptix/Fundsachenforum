<div class="card mt-4 m-3">
      <div class="card-body mx-3">
        <p class="card-text">

        <?php
        if(isset($_GET["id"])){
            require("mysql.php");
            $stmt = $mysql->prepare("SELECT * FROM items WHERE ID = :id");
            $stmt->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->rowCount();
            if($count == 0){
                echo "Die Fundsache wurde nicht gefunden.";
            } else {
                $row = $stmt->fetch();
                    ?>
                    <h1><?php echo $row["TITEL"] ?></h1>
                    <p><?php echo $row["TEXT"] ?></p>
                    <p>Kontakt: <?php echo $row["KONTAKT"] ?></p>
                    <p><?php echo date("d.m.Y H:i", $row["DATUM"]) ?></p>
                    <a href="index.php"><button type="submit" name="submit" class="btn btn-success col-4" style="background: white; color: black;">Zurück</button></a>
                    <?php

            }
        } else {
            require("mysql.php");
            $stmt = $mysql->prepare("SELECT * FROM items ORDER BY DATUM DESC");
            $stmt->execute();
            $count = $stmt->rowCount();
            if($count == 0){
                echo "Es wurden keine Fundsache gefunden.";
            } else {
                while($row = $stmt->fetch()){
                    ?>
                    <h1><?php echo $row["TITEL"] ?></h1>
                    <p><?php echo substr($row["TEXT"], 0, 120) ?></p>
                    <p><?php echo date("d.m.Y H:i", $row["DATUM"]) ?></p>
                    <a style="color: black;" href="index.php?id=<?php echo $row["ID"] ?>">Mehr lesen</a><br><br>
                    <?php
                }
            }
        }
        ?>
        </p>
      </div>
    </div>