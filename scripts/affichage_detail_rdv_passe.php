<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'test_projet_1';
$sessionsql = mysqli_connect($host, $user, $password, $database);
$agent_immo = "";
$date = "";
$lieu = "";
$adresse_lieu = "";
$ville_lieu = "";
$code_lieu = "";
$id_rdv = "";
$prix = "";
$id_bien = "";
$photo = "";

$client = $_SESSION['Omnes']['user_id'];
$sql = "SELECT Agent_immo,Date,Lieu,id_rdv FROM RDV JOIN Users ON Users.identifiant = RDV.Client WHERE Users.identifiant = \"$client\" and RDV.effectue=\"1\"";
$resultat = mysqli_query($sessionsql, $sql);

while ($row = mysqli_fetch_assoc($resultat)) {
    $agent_immo = $row['Agent_immo'];
    $date = $row['Date'];
    $lieu = $row['Lieu'];
    $id_rdv = $row['id_rdv'];
    $sql = "SELECT Adresse1,Ville,Code_postal,prix,Photo,id_bien FROM biens WHERE nom = \"$lieu\"";
    $resultat2 = mysqli_query($sessionsql, $sql);
    while($row = mysqli_fetch_assoc($resultat2)) {
        $adresse_lieu =$row['Adresse1'];
        $ville_lieu =$row['Ville'];
        $code_lieu =$row['Code_postal'];
        $prix =$row['prix'];
        $photo = $row['Photo'];
        $id_bien = $row['id_bien'];
    }

    echo
        "
        <table id=\"consultation\">
                <tr>
                    <th>Date/Heure</th>
                    <th>Agent immobilier</th>
                    <th>Biens</th>
                    <th></th>
                </tr>
                <tbody>
                    <tr>
                        <td>$date</td>
                        <td>$agent_immo</td>
                        <td>$adresse_lieu, $code_lieu $ville_lieu</td>
                        <td colspan=\"2\" align=\"center\">
                        <form method=\"post\" action=\"scripts/delete_rdv_detail.php\" >
                            <input type=\"hidden\" name=\"rdv_id\" value=\"$id_rdv\">
                            <button class=\"bouton_rdv\" type=\"submit\" name=\"submit$id_rdv\">Annuler ce RDV</button>
                        </form>
                        </td>
                    </tr>

                    <div class=\"descr\">
                    <img style=\"width :300%; height : 300%;\" src=\"data:image/jpg;base64," . base64_encode($photo) . "\" />
                        <br>
                        <div>
                            <h3 align=\"center\"><a href=\"Detail_batiment.php?id_bien=$id_bien\">$lieu</a></h3>
                            <h4 align=\"center\">Localisation : $adresse_lieu, $code_lieu $ville_lieu</h4>
                            <h5 align=\"center\">Prix : $prix €</h5>
                        </div>
                    </div>
                </tbody>
            </table>
        ";
}
?>