<?php


$nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
$adresse1 = isset($_POST["Adresse_1"]) ? $_POST["Adresse_1"] : "";
$adresse2 = isset($_POST["Adresse_2"]) ? $_POST["Adresse_2"] : "";
$ville = isset($_POST["ville"]) ? $_POST["ville"] : "";
$codepostal = isset($_POST["codepostal"]) ? $_POST["codepostal"] : "";
$pays = isset($_POST["pays"]) ? $_POST["pays"] : "";
$telephone = isset($_POST["telephone"]) ? $_POST["telephone"] : "";
$mail = isset($_POST["mail"]) ? $_POST["mail"] : "";
$typecarte = isset($_POST["typecarte"]) ? $_POST["typecarte"] : "";
$numerocarte = isset($_POST["numerocarte"]) ? $_POST["numerocarte"] : "";
$dateexpiration = isset($_POST["dateexpiration"]) ? $_POST["dateexpiration"] : "";
$codesecurite = isset($_POST["codesecurite"]) ? $_POST["codesecurite"] : "";
$identifiant = isset($_POST["identifiant"]) ? $_POST["identifiant"] : "";
$motdepasse = isset($_POST["mot_de_passe"]) ? $_POST["mot_de_passe"] : "";



$host = 'localhost';
$user = 'root';
$password = '';
$database = 'test_projet_1';
$session = mysqli_connect($host, $user, $password, $database);

if (!$session) {
    die('La connexion à la base de données a échoué : ' . mysqli_connect_error());
}

$sql = "UPDATE Users SET nom = '$nom', prenom = '$prenom', Adresse_1 = '$adresse1', Adresse_2= '$adresse2', ville = '$ville', code_postal = '$codepostal', pays = '$pays', telephone = '$telephone', mail = '$mail', type_carte ='$typecarte', numero_carte ='$numerocarte', date_expiration ='$dateexpiration', code_securite ='$codesecurite', mot_de_passe = '$motdepasse'  WHERE identifiant = '$identifiant'";

if ($session->query($sql) === TRUE) {
    echo "Données mises à jour avec succès.";
} else {
    echo "Erreur lors de la mise à jour des données : " . $session->error;
}


mysqli_close($session);
header('Location: ../compte.php');
?>