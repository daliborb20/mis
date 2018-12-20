<?php include "includes/header.php" ?>
<?php include "db.php" ?>
<div class="container" id="container__forma">
    <form id="forma2"  method="POST">
        <label class="col-md-12 col-xs-12"for="pojam" >Претрага по кључном појму</label>
        <input name="pojam" class="imena2 col-md-12 col-xs-12" id="pojam" type="text" placeholder="Kljucni pojam">

        <label for="broj_misljenja" class="col-md-12 col-xs-12">Претрага по броју мишљења</label>
        <input class="imena2 col-md-12 col-xs-12" name="broj_misljenja" id="broj_misljenja" type="text" placeholder="Broj misljenja">

        <label class="col-md-12 col-xs-12"for="broj_biltena">Претрага по броју билтена</label>
        <input class="imena2 col-md-12 col-xs-12" name="broj_biltena" id="broj_biltena" type="text" placeholder="Broj biltena">

        <label class="col-md-12 col-xs-12"for="datum_misljenja">Претрага по датуму мишљења</label>
        <input class="imena2 col-md-12 col-xs-12" name="datum_misljenja" id="datum_misljenja" type="date" placeholder="Datum misljenja">
 
        <input id="dugme2" name='Pretrazi'  value="Pretrazi" type="submit">
    </form>
</div>

<div class="container" id="rezultati">


<?php
//=======================pocetak pretrage
if(isset($_POST['Pretrazi'])) {
    $kljucni_pojam = htmlspecialchars($_POST['pojam']);
    $broj_misljenja = htmlspecialchars($_POST['broj_misljenja']);
    $broj_biltena =  htmlspecialchars($_POST['broj_biltena']);
    $datum_misljenja=  htmlspecialchars($_POST['datum_misljenja']);

    if($broj_misljenja == "" and  $broj_biltena == "" and  $datum_misljenja == "" and $kljucni_pojam != "") { 
        $query = "SELECT * FROM misljenja WHERE tekst_misljenja LIKE '%$kljucni_pojam%'";
        echo "prvi rezultat";
    }

    else if ($broj_misljenja == "" and  $broj_biltena == "" and  $kljucni_pojam == "" and $datum_misljenja != ""){
        $query = "SELECT * FROM misljenja WHERE datum_misljenja like '%$datum_misljenja%'";
        echo "2";
    }
    else if ($kljucni_pojam == "" and  $broj_biltena == "" and  $datum_misljenja == "" and $broj_misljenja != ""){
        $query = "SELECT * FROM misljenja WHERE broj_misljenja LIKE '%$broj_misljenja%'";
        echo "3";
    }
    else if ($kljucni_pojam == "" and  $broj_misljenja == "" and  $datum_misljenja == "" and $broj_biltena != ""){
        $query = "SELECT * FROM misljenja WHERE broj_biltena LIKE '%$broj_biltena%'";
        echo "4";
    }
    else if ($kljucni_pojam != "" and  $broj_misljenja != "" and  $datum_misljenja != "" and $broj_biltena != ""){
        $query = "SELECT * FROM misljenja WHERE broj_biltena LIKE '%$broj_biltena%' AND  LIKE broj_misljenja '%$broj_misljenja%' AND tekst_misljenja LIKE '%$kljucni_pojam%'  AND datum_misljenja LIKE '%$datum_misljenja%'";
        echo "5";
    }
    else if ($kljucni_pojam != "" and  $broj_misljenja != "" and  $datum_misljenja == "" and $broj_biltena == ""){
        $query = "SELECT * FROM misljenja WHERE tekst_misljenja LIKE '%$kljucni_pojam%' AND  LIKE broj_misljenja '%$broj_misljenja%'";
        echo "5";
    }
     else if ($kljucni_pojam == "" and  $broj_misljenja == "" and  $datum_misljenja != "" and $broj_biltena != ""){
        $query = "SELECT * FROM misljenja WHERE datum_misljenja LIKE '%$datum_misljenja%' AND  broj_biltena LIKE '%$broj_biltena%'";
        echo "5";
    }
 
     else if ($kljucni_pojam == "" and  $broj_misljenja == "" and  $datum_misljenja == "" and $broj_biltena == ""){
         echo "<h4 class='alert alert-danger'>Mорате унети минимум један критеријум за претрагу</h4>";
        echo "6";
         die;
    }
    //=======================================================kraj petlje 
    echo $query;
    $rezultat = mysqli_query($connection, $query);
    if(!$rezultat){
        echo "<h3 class='alert alert-warning'>Не постоји резултат који одговара задатом појму</h3>";
    } else {
        while($red = mysqli_fetch_assoc($rezultat)){
            echo "<p>{$red['tekst_misljenja']}</p>";
            echo "<a class='btn' href='pojedinacno.php?broj={$red['rbr_misljenja']}' id='dugme2'>Прикажи више информација</a>"; 
            echo "<hr>";
        }
    }

}

?>
</div>


</div>


<?php include "includes/footer.php" ?>
