<?php
include ('PDO.php');

$mail = $_POST["mail"];
//je met ma fonction avec les données de email dans la variable email

if (!filter_var($mail, FILTER_VALIDATE_EMAIL) || empty($mail)) {
   // j'utilise filter au lieu du regex pour vérifier le mail et si les conditions ne sont pas rempli ou que l'entrée est vide
   $mailErr = "Invalid email format  <a href='formulaire.php'>Cliquez ici</a> pour essayer à nouveau.<br>";
   echo $mailErr;
   // message d'erreur
} else {
   echo "{$mail} est un mail qui est valide.<br>";
   // sinon c'est bon
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_POST['lastname']) && isset($_POST['firstname'])) {
    $sql = $database->prepare("INSERT INTO patients (lastname, firstname, birthdate, mail, phone) VALUES (:Lastname, :Firstname, :Birthdate, :Mail, :Phone)");
    $sql->bindParam(':Lastname', $_POST['lastname']);
    $sql->bindParam(':Firstname', $_POST['firstname']);
    $sql->bindParam(':Birthdate', $_POST['birthdate']);
    $sql->bindParam(':Mail', $_POST['mail']);
    $sql->bindParam(':Phone', $_POST['phone']);

    try {
       $sql->execute();
      echo "Patient ajouté avec succès";
    } catch (PDOException $e) {
      echo "Erreur lors de l'ajout du patient: " . $e->getMessage();
    }
    
  }
}
?>






