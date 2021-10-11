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

<body>
<?php include('php/function.php');  ?>
<!-- Modal update -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    <form action="" method="post">
        <label for="type_inter">Type d'intervention</label>
        <input type="text" name="type_inter" size="35" placeholder="Changement d'ampoule..." required>
        <input type="date" name="date_inter" required>
        <select name="etage_inter" required>
            <option value="RDC">RDC</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <input type="submit" name="submit_task" value="Ajouter">
    </form>
    <div class="container mt-5">
    <table class=" table table-dark table-striped">
        <thead>
            <tr>
                <!-- <th scope="col">#</th> -->
                <th scope="col-3">Type d'intervention</th>
                <th scope="col-3">Date</th>
                <th scope="col-3">Étage</th>
                <th scope="col-3">Action</th>
                <th scope="col-3"></th>
            </tr>
        </thead>
        <tbody>
            <?php displayLines() ?>
               
        </tbody>
    </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>