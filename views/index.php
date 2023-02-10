<?php 

include "../modele.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="../modele.php" method="post">
        <label for="name">Nom</label>
        <input type="text" name="name" />
        <input type="submit" value="Rechercher" />
    </form>


    <div>
        <?php foreach($pokemonList as $pokemon):?>
            <h2><?= $pokemon['name']?></h2>
            <p>id = <?= $pokemon['id']?></p>
            <img width="" src="<?= $pokemon['image']?>">
        <?php endforeach; ?>

    </div>

</body>
</html>