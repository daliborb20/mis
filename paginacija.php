<?php include "includes/header.php" ?>
<?php include "db.php" ?>

<div class="container">
<?php
$rezultata_po_strani = 9;

$query = "SELECT * FROM misljenja "; //prva cifra je broj od kojeg pocinje, druga cifra jeste ukupan broj
$rezultat = mysqli_query($connection, $query);
$broj_rezultata = mysqli_num_rows($rezultat);
/*while ($red = mysqli_fetch_array($rezultat)){
echo $red['rbr_misljenja'];
echo "<h3>{$red['naslov_misljenja']}</h4>";
echo "<p>{$red['tekst_misljenja'] }</p>". "<br>";
}

 */
$broj_strana = ceil($broj_rezultata / $rezultata_po_strani);//koliko ukupno strana nam je potrebno

if(!isset($_GET['strana'])){
    $strana = 1;
} else {
    $strana = $_GET['strana'];
}

$pocetni_broj = ($strana - 1)*$rezultata_po_strani;

$query = "SELECT * FROM misljenja LIMIT $pocetni_broj,$rezultata_po_strani";
$rezultat =mysqli_query($connection, $query);
while($red = mysqli_fetch_array($rezultat)){
    echo $red['rbr_misljenja'];
    echo "<h3>{$red['naslov_misljenja']}</h4>";
    echo "<p>{$red['tekst_misljenja'] }</p>". "<br>";
}

for($strana = 1; $strana <= $broj_strana; $strana++){
    echo "<a class='btn btn-danger text-justify' href='paginacija.php?strana={$strana}'>{$strana}</a>";

}
?>
</div>
<?php include "includes/footer.php" ?>
