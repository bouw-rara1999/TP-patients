<head>
  <link rel="stylesheet" href="liste-patientsstyle.css">
</head>
<form action="" method="post">
  <input type="text" name="search" placeholder="Rechercher un patient">
  <input type="submit" value="Rechercher">
</form>
<?php
include "PDO.php";

$per_page = 5;
$page = 1;

if (isset($_GET["page"])) {
  $page = $_GET["page"];
}

$start_from = ($page-1) * $per_page;

$query = $database->prepare("SELECT id, lastname, firstname FROM patients LIMIT $start_from, $per_page");
$query->execute();
$patients = $query->fetchAll();

$query = $database->prepare("SELECT COUNT(id) FROM patients");
$query->execute();
$total_records = $query->fetchColumn();

$total_pages = ceil($total_records / $per_page);




$search = isset($_POST["search"]) ? $_POST["search"] : "";
$search = "%$search%";

$query = $database->prepare("SELECT id, lastname, firstname FROM patients WHERE lastname LIKE :search OR firstname LIKE :search");
$query->execute([":search" => $search]);
$patients = $query->fetchAll();
?>
<table>
  <tr>
    <th>ID</th>
    <th>Lastname</th>
    <th>Firstname</th>
  </tr>
  <?php foreach ($patients as $patient) { ?>
  <tr>
    <td><?= $patient["id"] ?></td>
    <td><a href="profil-patient.php?id=<?= $patient["id"] ?>"><?= $patient["lastname"] ?></a></td>
    <td><a href="profil-patient.php?id=<?= $patient["id"] ?>"><?= $patient["firstname"] ?></a></td>
  </tr>
  <?php } ?>
</table>

<div class="pagination">
  <?php if ($page > 1) { ?>
    <a href="?page=<?= $page-1 ?>">Previous</a>
  <?php } ?>
  <?php for ($i=1; $i<=$total_pages; $i++) { ?>
    <a href="?page=<?= $i ?>" <?php if ($i == $page) { echo 'class="active"'; } ?>><?= $i ?></a>
  <?php } ?>
  <?php if ($page < $total_pages) { ?>
    <a href="?page=<?= $page+1 ?>">Next</a>
  <?php } ?>
</div>







