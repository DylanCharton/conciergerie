<?php
// FUNCTION TO ESTABLISH THE LINK THE DATABASE
function connect(){
    $servername = 'localhost';
    $username = 'root';
    $password = '';

    try{
        $pdo = new PDO("mysql:host=$servername; dbname=conciergerie_ledonienne", $username, $password);
        return $pdo;
    } catch (PDOException $e){
        die($e -> getMessage());
    }
};
// FUNCTION TO FETCH ALL MY DATABASE ELEMENTS
function allTasks(){
    $sql = connect()->prepare("SELECT * FROM intervention ORDER BY id_inter");
    $sql->execute();
    $allTasks = $sql->fetchAll(PDO::FETCH_ASSOC);

    return $allTasks;
};
// FUNCTION TO INSERT A NEW LINE IN MY TABLE
function insertTask(){
    $type_inter = $_POST["type_inter"];
    $date_inter = $_POST["date_inter"];
    $etage_inter = $_POST["etage_inter"];
    $insertTask = connect()->prepare("INSERT INTO intervention(type_inter, date_inter, etage_inter) VALUES (:type_inter, :date_inter, :etage_inter)");
    $insertTask->bindValue(':type_inter', $type_inter, PDO::PARAM_STR);
    $insertTask->bindValue(':date_inter', $date_inter, PDO::PARAM_STR);
    $insertTask->bindValue(':etage_inter', $etage_inter, PDO::PARAM_STR);
    $insertTask->execute();
    header("Refresh:0; url=index.php");
}
// CHECKING IF THE INPUT IN MY FORM HAS BEEN TRIGGERED SO I CAN USE MY FUNCTION TO INSERT
if(isset($_POST["submit_task"])){
    insertTask();
}

// I USE MY FUNCTION PREVIOUSLY DEFINED TO MAKE THE REQUEST
function displayLines($interventions){
    foreach($interventions as $intervention){
        echo "<tr><td>".$intervention['type_inter']."</td>" ;
        echo "<td>".$intervention['date_inter']."</td>" ;
        echo "<td>".$intervention['etage_inter']."</td>";
        echo '<td><form method="GET" action=\'\'><input type="submit" class="btn btn-danger" value="Supprimer" name="suppr"><input type="hidden" name="supprId" value="'.$intervention["id_inter"].'"></td> ';
        echo '<td><input type="button" class="btn btn-warning" value="Modifier"></td></form></tr> ';    
    
    }
}

function deleteLine(){
    $del = connect()->prepare("DELETE FROM intervention WHERE id_inter = :id");
    $del->bindParam(':id', $_GET['supprId']);
    $del-> execute();
}

if(isset($_GET['supprId'])){
    deleteLine();
};

function updateLine(){
    $update = connect()->prepare('UPDATE interventions SET date_inter = :date_inter, etage_inter=:etage, type_inter=:type_inter WHERE id_inter = :id');
    $update->bindParam(':date_inter', $_GET['update_date']);
    $update->bindParam(':etage', $_GET['update_etage']);
    $update->bindParam(':type_inter', $_GET['update_type']);
    $update->bindParam(':id', $_GET['update']);
    $update->execute();
 }
 if(isset($_GET["update_btn"])){
     updateLine();
 };

 function selectLine($type, $date, $etage){
     $select = "SELECT * FROM intervention WHERE 1=1";
     $param = array();
     if(!empty($type)){
        
         $select .= " && type_inter = ?";
         array_push($param, $type);
       
     }
     if(!empty($date)){
        
        $select .= " && date_inter = ?";
        array_push($param, $date);
    
     }
     if(!empty($etage)){
        
        $select .= " && etage_inter = ?";
        array_push($param, $etage);
     }
     $search = connect()->prepare($select);
     $search->execute($param);
     $result = $search->fetchAll(PDO::FETCH_ASSOC);

     return($result);   
 }

?>