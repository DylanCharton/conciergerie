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
            <input type="submit" name="submit_task">
    </form>
    <div class="container mt-5">
    <table class=" table table-dark table-striped">
        <thead>
            <tr>
                <!-- <th scope="col">#</th> -->
                <th scope="col-3">Type d'intervention</th>
                <th scope="col-3">Date</th>
                <th scope="col-3">Étage</th>
            </tr>
        </thead>
        <tbody>
            <?php displayLines() ?>
               
        </tbody>
    </table>
    </div>
</body>

</html>