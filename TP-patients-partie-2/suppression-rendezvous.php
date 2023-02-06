<?php 
include('PDO.php');

if(isset($_POST['action']) && $_POST['action'] == 'suppression-rendezvous.php'){
  try {
    $supp = $database->prepare('DELETE FROM  appointments WHERE dateHour = :DateHour LIMIT 1');

    $supp->bindparam(':DateHour', $_POST['dateHour']);
   
    $executeIsOk = $supp->execute(); 
    
    if ($executeIsOk) {
      echo "horaire supprimé!";
    } else {
      echo "erreur veuillez réassayer à nouveau!";
    }
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
?>
