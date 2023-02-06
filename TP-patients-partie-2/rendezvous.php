<!-- traitement-rendezvous.php -->
<!DOCTYPE html>
<html>
<head>
  <title>Liste des rendez-vous</title>
  <link rel="stylesheet" type="text/css" href="traitement-rendezvous-style.css">
</head>
<body>
  <h1>Liste des rendez-vous</h1>
  <a href="ajout-rendezvous.php">Ajouter un rendez-vous</a>
  <table>
    <thead>
      <tr>
        <th>Date et heure</th>
        <th>Nom du patient</th>
        <th>Prénom du patient</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      include('PDO.php'); 
      $query = $database->prepare("SELECT appointments.id, appointments.dateHour, patients.lastName, patients.firstName FROM appointments INNER JOIN patients ON appointments.id = patients.id");
      $query->execute();
      $result = $query->fetchAll();
      foreach($result as $row){
        echo "<tr>";
        echo "<td>" . $row['dateHour'] . "</td>";
        echo "<td>" . $row['lastName'] . "</td>";
        echo "<td>" . $row['firstName'] . "</td>";
        echo "<form action='suppression-rendezvous.php' method='post'>";
        echo "<input type='hidden' name='dateHour' value='" . $row['dateHour'] . "'>";
        echo "<input type='hidden' name='action' value='suppression-rendezvous.php'>";
        echo "<td><input type='submit' value='Supprimer'></td>";
        echo "</form>";
        echo "</tr>";
      }
      if(isset($_POST['action']) && isset($_POST['action']) == 'suppression-rendezvous.php'){
        try {
          $supp = $database->prepare('DELETE FROM appointments WHERE dateHour = :dateHour LIMIT 1');
          $supp->bindparam(':dateHour', $_POST['dateHour']);
          $executeIsOk = $supp->execute(); 

      if ($executeIsOk) {
        echo "Horaire supprimé avec succès!";
      } else {
        echo "Erreur lors de la suppression. Veuillez réessayer à nouveau.";
      }
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  ?>
</tbody>
  </table> 
</body>
</html>