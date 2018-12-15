<?php include "includes/header.php" ?>
<?php include "db.php" ?>
<div class="container" id="container__forma">
    <form id="forma2"  method="POST">
        <label class="col-md-12 col-xs-12"for="pojam" >Pretraga po kljucnom pojam</label>
        <input name="pojam" class="imena2 col-md-12 col-xs-12" id="pojam" type="text" placeholder="Kljucni pojam">

        <label for="broj_misljenja" class="col-md-12 col-xs-12">Pretraga po broju misljenja</label>
        <input class="imena2 col-md-12 col-xs-12" name="broj_misljenja" id="broj_misljenja" type="text" placeholder="Broj misljenja">

        <label class="col-md-12 col-xs-12"for="broj_biltena">Pretraga po broju misljenja</label>
        <input class="imena2 col-md-12 col-xs-12" name="broj_biltena" id="broj_biltena" type="text" placeholder="Broj biltena">
 
        <input id="dugme2" name='Pretrazi'  value="Pretrazi" type="submit">
    </form>
</div>

<div class="container" id="rezultati">
<?php
global $connection;
if(!$connection){
    echo  "<h1 class='alert alert-danger'>Neuspela konekcija</h1>";
}
if(isset($_POST['Pretrazi'])) {
    $kljucni_pojam = htmlspecialchars($_POST['pojam']);
    $broj_misljenja = htmlspecialchars($_POST['broj_misljenja']);
    $broj_biltena =  htmlspecialchars($_POST['broj_biltena']);

    $query = "SELECT * FROM misljenja WHERE tekst_misljenja LIKE '%$kljucni_pojam%'";
    $rezultat = mysqli_query($connection, $query);
    if(!$rezultat){
        echo "<h3 class='alert alert-warning'>Ne postoji rezultat koji odgovara zadatom pojmu</h3>";
    } else {
        while($red = mysqli_fetch_assoc($rezultat)){
            echo "<p>{$red['tekst_misljenja']}</p>";
            echo "<a class='btn' href='pojedinacno.php?broj={$red['rbr_misljenja']}' id='dugme2'>Prikazi vise infomracija</a>"; 
            echo "<hr>";
        }
    }

}

?>
</div>


</div>


<?php include "includes/footer.php" ?>
