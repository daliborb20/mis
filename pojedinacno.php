<?php include "includes/header.php" ?>
<?php include "db.php" ?>
<?php include "controler/funkcije.php" ?>

<div class="container">
<?php
Misljenja::pojedinacno();
?>
<?php Misljenja::posaljiMejl() ?>

</div>

<?php include "includes/footer.php" ?>
