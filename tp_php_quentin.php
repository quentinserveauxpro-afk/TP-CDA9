<?php
require('Joueurs.php');
require('Armes.php');
session_start();

?>

<!DOCTYPE html>
    <html lang="fr">

        <head>
            <title>Formulaire Roliste</title>

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        </head>

        <body>
        <div class="container">

            <h1>Paré pour l'aventure</h1>
            <p>Créer votre personnage, définissez ses statistiques et choisissez une arme pour partir à l'aventure !</p>

            <br />

            <h2>Créateur de personnage</h2>

            <br />

            <form action="tp_php_quentin.php" method="post">
                <h3>Formulaire de Création</h3>

                <div class="mb-3">
                    <label for="formNom" class="form-label">Nom</label>
                    <input type="text" id="formNom" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="formHP" class="form-label">HP</label>
                    <input type="number" id="formHP" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="formMP" class="form-label">MP</label>
                    <input type="number" id="formMP" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="formPuissance" class="form-label">Puissance</label>
                    <input type="number" id="formPuissance" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="formPuissance" class="form-label">Magie</label>
                    <input type="number" id="formPuissance" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="formDefense" class="form-label">Defense</label>
                    <input type="number" id="formDefense" class="form-control">
                </div>

                <div class="col-auto">
                    <input type="submit" value="Créer" class="btn btn-primary mb-3"
                </div>
            </form>

            <br />

            <form action="tp_php_quentin.php" method="get">
                <label for="search">Rechercher</label>
                <input type="text" name="search" id="search">
                <input type="submit" value="Search">
            </form>

            <table id="table_joueurs" class="table">

                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">HP</th>
                        <th scope="col">MP</th>
                        <th scope="col">Puissance</th>
                        <th scope="col">Magie</th>
                        <th scope="col">Defense</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $user="root";
                    $pass="";
                    $dbname="quentincda9";
                    $host="localhost";

                    $db=new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                    $requete="";

                    if(isset($_GET['search'])) {
                        $requete=$db->prepare("SELECT * FROM joueurs WHERE id like :id
                         or nom like :nom
                         or hp like :hp
                         or mp like :mp
                         or puissance like :puissance
                         or magie like :magie
                         or defense like :defense");
                        $valeur="%".$_GET['search']."%";
                        $requete->bindValue("id",$valeur);
                        $requete->bindParam("nom",$valeur);
                        $requete->bindParam("hp",$valeur);
                        $requete->bindParam("mp",$valeur);
                        $requete->bindParam("puissance",$valeur);
                        $requete->bindParam("magie",$valeur);
                        $requete->bindParam("defense",$valeur);
                        $requete->execute();
                    }
                    else $requete=$db->query("SELECT * FROM joueurs");

                    $requete->setFetchMode(PDO::FETCH_ASSOC);

                    $joueurs=$requete->fetchAll();

                    foreach($joueurs as $joueur) {
                        echo "<tr>";
                        echo "<td>".$joueur['id']."</td>";
                        echo "<td>".$joueur['nom']."</td>";
                        echo "<td>".$joueur['hp']."</td>";
                        echo "<td>".$joueur['mp']."</td>";
                        echo "<td>".$joueur['puissance']."</td>";
                        echo "<td>".$joueur['magie']."</td>";
                        echo "<td>".$joueur['defense']."</td>";
                        echo "</tr>";
                    }
                ?>

                <?php
                if(isset($_POST['nom'])) {

                    $nom=$_POST['nom'];
                    $hp=$_POST['hp'];
                    $mp=$_POST['mp'];
                    $puissance=$_POST['puissance'];
                    $magie=$_POST['magie'];
                    $defense=$_POST['defense'];

                    $joueur = new Joueur($nom,$hp,$mp,$puissance,$magie,$defense);

                    if(isset($_SESSION['joueurs'])) {
                        $joueurs=$_SESSION['joueurs'];
                    }
                    else {
                        $joueurs=array();
                        $_SESSION['joueurs']=$joueurs;
                    }
                    $joueurs[]=$joueur;

                    $_SESSION['joueurs']=$joueurs;
                    foreach($joueurs as $joueur) {
                        echo $joueur;
                    }
                }
                ?>

                </tbody>

            </table>

            <br />

            <h2 class="">Armurerie</h2>

            <table id="table_armes" class="table">

                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Attaque</th>
                    <th scope="col">Puissance</th>
                    <th scope="col">Magie</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $user="root";
                    $pass="";
                    $dbname="quentincda9";
                    $host="localhost";

                    $db=new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                    $requete="";
                    $requete=$db->query("SELECT * FROM armes");
                    $requete->setFetchMode(PDO::FETCH_ASSOC);
                    $armes=$requete->fetchAll();

                    foreach($armes as $arme) {
                        echo "<tr>";
                        echo "<td>".$arme['id']."</td>";
                        echo "<td>".$arme['nom']."</td>";
                        echo "<td>".$arme['attaque']."</td>";
                        echo "<td>".$arme['puissance']."</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>

            </table>
        </div>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

        </body>

    </html>
