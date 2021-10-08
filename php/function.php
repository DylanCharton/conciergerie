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
function displayLines(){
    $interventions = allTasks();
    foreach($interventions as $intervention){
        echo "<tr><td>".$intervention['type_inter']."</td>" ;
        echo "<td>".$intervention['date_inter']."</td>" ;
        echo "<td>".$intervention['etage_inter']."</td> </tr>";
    }
}

?>