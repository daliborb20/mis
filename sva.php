<?php include "includes/header.php" ?>
<?php include "db.php"; ?>

<div class="container ">
<?php
$query = "SELECT * FROM misljenja";
$rezultat = mysqli_query($connection, $query);

if(!$rezultat){
   echo ("Neuspoesno konektovanje" . mysqli_error($connection));
} else {
  foreach($rezultat as $red){
    $rbr= $red['rbr_misljenja'];
    $broj_misljenja = $red['broj_misljenja'];
    $broj_biltena = $red['broj_biltena'];
    $naslov_misljenja = $red['naslov_misljenja'];
    $datum = $red['datum_misljenja'];
    $tekst = substr($red['tekst_misljenja'],0, 800);
    $zakon = $red['zakon'];
    $link = $red['link_misljenja'];

    echo "<h4>Мишљење број: {$broj_misljenja}</h4>";
    echo "<h4>Датум мишљења: {$datum}</h4>";
    echo "<h4>Број билтена:{$broj_biltena}</h4>";
    echo "<h4><a href='$link'>Преузми билтен</a></h4>";
    echo "<h4>Мишљење се односи на : {$zakon}</h4>";
    echo "<h4>Наслов мишљења: {$naslov_misljenja}</strong></h4>";
    echo "<h4>Текст мишљења: </h4>";
    echo "<p>{$tekst}</p>";
    echo "<a class='btn'id='dugme2' href='pojedinacno.php?broj={$rbr}'>Прикажи више информација</a>";
    echo "<hr>";
 } 
}
?>
</div>
 <?php include "includes/footer.php" ?>
