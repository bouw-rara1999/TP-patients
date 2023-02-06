<?php include('PDO.php');

$query = 'SELECT * FROM clients';

try {
  $result = $database->query($query);
} catch (PDOException $e) {
  die('le code d\'erreur est ' . $e->getCode()); 
}

$data = $result->fetchAll(PDO::FETCH_ASSOC);

foreach($data as $array) {
  echo "Nom : " . $array["last_name"] . "<br>";
  echo "Prénom : " . $array["first_name"] . "<br>";
  echo "Date de naissance : " . $array["birthdate"] . "<br>";
  if($array["loyalty_card"] == 1) {
    echo "Carte de fidélité : Oui" . "<br>";
    echo "Numéro de carte : " . $array["loyalty_card_number"] . "<br>";
  } else {
    echo "Carte de fidélité : Non" . "<br>";
  }
  echo "<br>";
}
?>