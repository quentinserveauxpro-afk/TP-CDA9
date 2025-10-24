<!DOCTYPE html>
    <html lang="fr">

        <head>
            <title>Formulaire Roliste</title>
        </head>

        <body>

            <h1>Paré pour l'aventure</h1>
            <p>Créer votre personnage, définissez ses statistiques et choisissez une arme pour partir à l'aventure !.</p>

            <br />

            <h2>Créateur de personnage</h2>

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>HP</th>
                        <th>MP</th>
                        <th>Puissance</th>
                        <th>Magie</th>
                        <th>Defense</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    require('Joueurs.php');
                    $user="root";
                    $pass="";
                    $dbname="quentincda9"
                ?>
                </tbody>

            </table>

            <br />

            <h2>Armurerie</h2>

            <table>

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Attaque</th>
                    <th>Puissance</th>
                    <th>Magie</th>
                </tr>
                </thead>
                <tbody>

                </tbody>

            </table>

        </body>

    </html>
