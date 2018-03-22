 <?php

// Create connection
$connect = mysqli_connect("localhost", "root", "Gaelle", "colyseum");
$connect->query("SET NAMES UTF8");

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());

    
}


?>

<!DOCTYPE html>
<html>
<head>
  <title>Spectacles</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>

<div class="container">
  <h1>SPECTACLES</h1>
  <ul class="nav nav-pills center">
    <li><a data-toggle="pill" href="#requete1">Requête 1</a></li>
    <li><a data-toggle="pill" href="#requete2">Requête 2</a></li>
    <li><a data-toggle="pill" href="#requete3">Requête 3</a></li>
    <li><a data-toggle="pill" href="#requete4">Requête 4</a></li>
    <li><a data-toggle="pill" href="#requete5">Requête 5</a></li>
    <li><a data-toggle="pill" href="#requete6">Requête 6</a></li>
    <li><a data-toggle="pill" href="#requete7">Requête 7</a></li>
  </ul>
  
  <div class="tab-content center">
    <div id="requete1" class="tab-pane fade">
      <h2>Requête 1</h2>
      <h3>Afficher tous les clients</h3>
     <div>
        <?php
        $requête1 = mysqli_query($connect, "SELECT * FROM clients");
        while ($requête1_resultat = mysqli_fetch_array($requête1))
        {

          echo$requête1_resultat ["lastName"];
          echo "\n";
          echo$requête1_resultat ["firstName"];
          echo "</br>";
        };
        ?>
     </div>
    </div>
    <div id="requete2" class="tab-pane fade">
      <h2>Requête 2</h2>
      <h3>Afficher tous les types de spectacles possibles.</h3>
      <p>
        <?php
        $requête2 = mysqli_query($connect, "SELECT * FROM showTypes");
        while ($requête2_resultat = mysqli_fetch_array($requête2))
        {
          echo$requête2_resultat ["id"];
          echo "\n";
          echo$requête2_resultat ["type"];
          echo "</br>";
        };
        ?>
      </p>
    </div>
    <div id="requete3" class="tab-pane fade">
      <h2>Requête 3</h2>
      <h3>Afficher les 20 premiers clients selon leur identifiant</h3>
      <p>
        <?php
        $requête3 = mysqli_query($connect, "SELECT lastName, firstName FROM colyseum.clients WHERE id BETWEEN '1' AND '20'");
        while ($requête3_resultat = mysqli_fetch_array($requête3))
        {
          echo$requête3_resultat ["id"];
          echo "\n";
          echo$requête3_resultat ["lastName"];
          echo "\n";
          echo$requête3_resultat ["firstName"];
          echo "</br>";
        };
        ?>
      </p>
    </div>
    <div id="requete4" class="tab-pane fade">
      <h2>Requête 4</h2>
      <h3>N’afficher que les clients possédant une carte de fidélité.</h3>
      <p>
         <?php
        $requête4 = mysqli_query($connect, "SELECT lastName, firstName 
        FROM cards
        INNER JOIN cardTypes ON cards.cardTypesId = cardTypes.id
        INNER JOIN clients ON cards.cardNumber = clients.cardNumber
        WHERE clients.cardNumber is not null and type = 'Fidelité'");
        while ($requête4_resultat = mysqli_fetch_array($requête4))
        {
          echo$requête4_resultat ["lastName"];
          echo "\n";
          echo$requête4_resultat ["firstName"];
          echo "</br>";
        };
        ?>
      </p>
    </div>
    <div id="requete5" class="tab-pane fade">
      <h2>Requête 5</h2>
      <h3>Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M".</h3>
      <p>
        <?php
        $requête5 = mysqli_query($connect, "SELECT lastName FROM colyseum.clients WHERE lastName LIKE 'M%' order by lastName");
        while ($requête5_resultat = mysqli_fetch_array($requête5))
        {
          echo$requête5_resultat ["lastName"];
          echo "\n";
          echo$requête5_resultat ["firstName"];
          echo "</br>";
        };
        ?>
      </p>
    </div>
    <div id="requete6" class="tab-pane fade">
      <h2>Requête 6</h2>
      <h3>Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure</h3>
      <p>
         <?php
        $requête6 = mysqli_query($connect, "SELECT title, performer, date, startTime FROM colyseum.shows ORDER BY title");
        while ($requête6_resultat = mysqli_fetch_array($requête6))
        {
          echo$requête6_resultat ["title"];
          echo "\n";
          echo$requête6_resultat ["performer"];
          echo "\n";
          echo$requête6_resultat ["date"];
          echo "\n";
          echo$requête6_resultat ["startTime"];
          echo "</br>";
        };
        ?>
      </p>
    </div>
    <div id="requete7" class="tab-pane fade">
      <h2>Requête 7</h2>
      <h3>Afficher tous les clients</h3>
      <p>
       <?php
        $requête7 = mysqli_query($connect, "SELECT lastName, firstName, birthDate, 'Oui' AS cards, clients.cardNumber FROM clients INNER JOIN cards ON clients.cardNumber = cards.cardNumber WHERE cardTypesId = 1 UNION SELECT lastName, firstName, birthDate, 'Non' AS cards, ' ' AS cardNumber FROM clients INNER JOIN cards ON clients.cardNumber = cards.cardNumber WHERE cardTypesId > 1 UNION SELECT lastName, firstName, birthDate, 'Non' AS cards, ' ' AS cardNumber FROM clients WHERE card = 0" );
          while ($requête7_resultat = mysqli_fetch_array($requête7))
        { 
          echo$requête7_resultat ["firstName"];
          echo "\n";
          echo$requête7_resultat ["lastName"];
          echo "\n";
          echo$requête7_resultat ["birthDate"];
          echo "\n";
          echo$requête7_resultat ["card"];
          echo "\n";
          echo$requête7_resultat ["cardNumber"];
          echo "</br>";
        };
        ?> 
      </p>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>