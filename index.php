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

    echo "<h3>Misljenje br: {$broj_misljenja}</h3>";
    echo "<h4>Datum misljenja: {$datum}</h4>";
    echo "<h4>Broj biltena:{$broj_biltena}</h4>";
    echo "<h4><a href='$link'>Preuzmi bilten</a></h4>";
    echo "<h4>Misljenje se odnosi na: {$zakon}</h4>";
    echo "<h4>Naslov misljenja: <strong>{$naslov_misljenja}</strong></h4>";
    echo "<h4>Tekst misljenja: </h4>";
    echo "<p>{$tekst}</p>";
    echo "<a class='btn'id='dugme2' href='pojedinacno.php?broj={$rbr}'>Prikazi vise informacija</a>";
    echo "<hr>";
 } 
}
?>
</div>
 <?php include "includes/footer.php" ?>
