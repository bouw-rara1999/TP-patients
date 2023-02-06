<link rel="stylesheet" href="traitement.style.css" />
<?php include('PDO.php');


    $query = 'SELECT * FROM clients WHERE card = 0';

    try{
            $result = $database->query($query);
    } catch (PDOException $e) {
    
        die('le code d\'erreur est ' . $e->getCode()); 
    }

 $data = $result->fetchAll(PDO::FETCH_ASSOC);
    
    var_dump($data);
    foreach($data as $array)
    foreach($array as $key => $value)
    echo $key . ' : ' . $value;
    ?>