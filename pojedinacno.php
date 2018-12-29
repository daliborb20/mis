<?php include "includes/header.php" ?>
<?php include "db.php" ?>
<?php include "controler/funkcije.php" ?>

<div class="container">
<?php
if(isset($_GET['rbr'])){
    $rbr = htmlspecialchars($_GET['rbr']);
    $query = "SELECT * FROM misljenja WHERE rbr_misljenja = $rbr";
    mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
    $rezultat = mysqli_query($connection, $query);

    if(!$rezultat){
        echo "<div class='alert alert-danger'>Neuspesno citanje iz baze</div>";
    } else {
        foreach($rezultat as $red){
            $broj_misljenja = $red['broj_misljenja'];
            $broj_biltena = $red['broj_biltena'];
            $naslov_misljenja = $red['naslov_misljenja'];
            $datum = $red['datum_misljenja'];
            $tekst = $red['tekst_misljenja'];
            $zakon = $red['zakon'];
            $link = $red['link_misljenja'];
            $rbr = $red['rbr_misljenja'];

            echo "<h3>Мишљење broj: {$broj_misljenja}</h3>";
            echo "<h4>Датум мишљења: {$datum}</h4>";
            echo "<h4>Број билтена: {$broj_biltena}</h4>";
            echo "<h4><a id='link__sakrij' href='$link'>Преузмите билтен</a></h4>";


            echo "<h4><a href='#' id='link__sakrij' onclick='sakrij()'>Пошаљи мишљење на мејл</a></h4>";
            echo "<div id='forma__skirvena'>";
            echo "<form method='GET'>";
            echo "<input id='mejl__forma'placeholder='Унесите мејл адресу' type='email' name='mejl'>";
            echo "<input type='hidden' name='broj' value='{$rbr}'>";
            echo "<input value='Пошаљи мишљење' type='submit' class='btn' id='dugme3'>";
            echo "</form>";
            echo "</div>";

            echo "<h4>Мишљење се односи на: {$zakon}</h4>";
            echo "<h4>Наслов мишљења: <strong>{$naslov_misljenja}</strong></h4>";
            echo "<h4>Текст мишљења: </h4>";
            echo "<p>{$tekst}</p>";
            echo "<a class='btn'id='dugme2' href='index.php'>Повратак</a>";
                    
            }

    } 
}
?>
<?php Misljenja::posaljiMejl() ?>

</div>

<?php include "includes/footer.php" ?>
