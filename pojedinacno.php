<?php include "includes/header.php" ?>
<?php include "db.php" ?>
<div class="container">
<?php
if(isset($_GET['broj'])){
    $rbr = htmlspecialchars($_GET['broj']);
    $query = "SELECT * FROM misljenja WHERE rbr_misljenja = $rbr";
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

        echo "<h3>Misljenje br: {$broj_misljenja}</h3>";
        echo "<h4>Datum misljenja: {$datum}</h4>";
        echo "<h4>Broj biltena: <a href='$link'>{$broj_biltena}</a></h4>";
        echo "<h4>Misljenje se odnosi na: {$zakon}</h4>";
        echo "<h4>Naslov misljenja: <strong>{$naslov_misljenja}</strong></h4>";
        echo "<h4>Tekst misljenja: </h4>";
        echo "<p>{$tekst}</p>";
        echo "<a class='btn'id='dugme2' href='index.php'>Povratak</a>";
                
        }

    } 


}
?>


</div>
