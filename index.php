<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Conciergerie Lédonienne</title>
  <meta name="description" content="Notre service de conciergerie vous aidera au quotidien dans vos tâches">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">

</head>

<body class="main">
  <!-- Calling the file with all my functions -->
  <?php include('php/function.php');?>
  <!-- The nav is used to search for interventions -->
  <nav class="align-items-center justify-content-around nav-wrapper d-flex">
    <h2 class="text-white">Conciergerie Lédonienne </h2>
    <div class="d-flex">
      <form action="" method="get" class="search-form justify-content-center d-flex">
        

        <input type="text" name="search_type" size="35" placeholder="Type d'intervention..." class="mx-3">

        <input type="date" name="search_date" class="me-3">

        <select name="search_etage" class="me-3">
          <option value=""></option>
          <option value="RDC">RDC</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <input type="submit" name="search_task" value="Rechercher" class="btn btn-light">
        </select>


      </form>
    </div>
    <div class="d-flex">
      <a href="./php/logout.php" class="btn btn-danger">Déconnexion</a>
    </div>
</nav>
  <div class="bg px-5">

    <div class="container-fluid pt-4">
      <!-- The function called here allow me to display the name of the user if a session is set. Otherwise it redirects to login.php -->
      <h1 class="text-center"><?php checkConnexion(); ?></h1>
      <h2 class="text-center pb-4">Liste des interventions</h2>

      <table class="table table-dark table-striped">
        <thead>
          <tr>
            <th scope="col-3">#</th>
            <th scope="col-3">Type d'intervention</th>
            <th scope="col-3">Date</th>
            <th scope="col-3">Étage</th>
            <th scope="col-3">Action</th>
            <th scope="col-3" class="justify-content-end d-flex"><input type="button" class="btn btn-success add-btn"
                data-bs-toggle="modal" data-bs-target="#addModal" value="Ajouter une tâche"></th>
          </tr>
        </thead>
        <tbody>
          <?php
        // Condition to call either the search or just display my whole list of intervention
            if (isset($_GET["search_task"])){
              if(!empty($_GET['search_type']) || !empty($_GET['search_date']) || !empty($_GET['search_etage'])){
                displayLines(selectLine($_GET['search_type'], $_GET['search_date'], $_GET['search_etage']));
          
              } else {
                displayLines(allTasks());
              } 
            } else {
              displayLines(allTasks());
              } ;
            ?>
        </tbody>
      </table>
    </div>
    <div class="container d-flex justify-content-center mt-4">
      <!-- Form in which the datas will be passed when clicking on a "Modifier" input -->
      <form method="GET" class="d-flex flex-column w-50  update-form">
        <h2 class="text-center text-white modif-title">Modification de l'intervention</h2>
        <input type="text" name="intervention" value="<?php if(isset($_GET['action']) && $_GET['action']=="modifier" && !empty( $_GET['id']) ){
          echo $_GET['intervention'];
          } ?>">
        <input type="hidden" name="id" value="<?php if(isset($_GET['action']) && $_GET['action']=="modifier" && !empty( $_GET['id']) ){
    echo $_GET['id'];
    } ?>">
        <input class="mt-2" type="date" name="date" value="<?php if(isset($_GET['action']) && $_GET['action']=="modifier" && !empty( $_GET['id']) ){
    echo $_GET['date'];
    } ?>">
        <select class="mt-2" name="etage" value="<?php if(isset($_GET['action']) && $_GET['action']=="modifier" && !empty( $_GET['id']) ){
    echo $_GET['etage'];
    } ?>">
          <option name="etage" value="<?php if(isset($_GET['action']) && $_GET['action']=="modifier" && !empty( $_GET['id']) ){
      echo $_GET['etage'];
    } ?>"><?php if(isset($_GET['action']) && $_GET['action']=="modifier" && !empty( $_GET['id']) ){
      echo $_GET['etage'];
      } ?></option>
          <option value="RDC">RDC</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
        <input type="submit" name='action' value="Valider la modification" class="btn btn-success mt-4">

      </form>
      <!-- Triggering the updateLine() function if there is "action" in the URL and if it matches with "Valider la modification" -->
      <?php 
            if(isset($_GET['action']) && $_GET['action']=="Valider la modification" ){
              updateLine();
            }
            ?>
    </div>

    <!-- Modal to add an intervention -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addModalLabel">Ajouter une intervention</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Retour"></button>
          </div>
          <div class="modal-body">
            <form action="" method="post">
              <label class="label-add" for="type_inter">Type d'intervention :</label>
              <input class="mb-2" type="text" name="type_inter" placeholder="Changement d'ampoule..." required>
              <label class="label-add" for="date_inter">Date de l'intervention :</label>
              <input type="date" name="date_inter" size="55" class="mb-2" required>
              <label class="label-add" for="etage_inter">Étage de l'intervention :</label>
              <select name="etage_inter" required>
                <option value=""></option>
                <option value="RDC">RDC</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>


              </select>

          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="Retour">
            <input type="submit" name="submit_task" value="Ajouter" class="btn btn-success">
            </form>
          </div>
        </div>
      </div>
    </div>



  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
</body>

</html>