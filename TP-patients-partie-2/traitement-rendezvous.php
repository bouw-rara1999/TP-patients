<?php
        // Connect to the database


include('PDO.php');
        // Check if the information entered in index1.php already exists






        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if(isset($_POST['lastName']) && isset($_POST['firstName']) && isset($_POST['dateHour'])) {
            $checkPatient = $database->prepare("SELECT * FROM patients WHERE lastname = :lastName AND firstname = :firstName");
            $checkPatient->bindParam(':lastName', $_POST['lastName']);
            $checkPatient->bindParam(':firstName', $_POST['firstName']);
         
            $checkPatient->execute();
            $result = $checkPatient->fetchAll();
         
           


            if ($result) {
              // If the information already exists, add a date and time
             // Préparation de la requête d'insertion
$insertQuery = $database->prepare("INSERT INTO appointments (dateHour, idPatients) VALUES (:newDate, :idPatients)");


// Liaison des variables avec les paramètres
$insertQuery->bindParam(':newDate', $_POST['dateHour']);
$insertQuery->bindParam(':idPatients', $result[0]['id']);


// Exécution de la requête
$insertQuery->execute();
              echo "Information trouvée! Votre rendez-vous a bien été pris en compte!";
             
            }
            else{
              echo "Information introuvable, veuillez d'abord vous inscrire avant de prendre rendez-vous ou entrer une identité valide!";
            }
          }
        }
      ?>