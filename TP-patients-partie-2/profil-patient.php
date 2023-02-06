<head>
  <link rel="stylesheet" type="text/css" href="profil-patient-style.css">
</head>
<?php
include "PDO.php";

if (!isset($_GET["id"])) {
  header("Location: liste-patients.php");
  exit;
}

$query = $database->prepare("SELECT * FROM patients WHERE id = ?");
$query->execute([$_GET["id"]]);
$patient = $query->fetch();

if (!$patient) {
  header("Location: liste-patients.php");
  exit;
}
?>

<table>
  <tr>
    <th>ID</th>
    <td><?= $patient["id"] ?></td>
  </tr>
  <tr>
    <th>Lastname</th>
    <td><?= $patient["lastname"] ?></td>
  </tr>
  <tr>
    <th>Firstname</th>
    <td><?= $patient["firstname"] ?></td>
  </tr>
  <tr>
    <th>Birthdate</th>
    <td><?= $patient["birthdate"] ?></td>
  </tr>
  <tr>
    <th>Phone</th>
    <td><?= $patient["phone"] ?></td>
  </tr>
  <tr>
    <th>Email</th>
    <td><?= $patient["mail"] ?></td>
  </tr>
</table>
