<?php include "includes/header.php" ?>
<?php include "db.php" ?>
<?php include "controler/funkcije.php" ?>
<?php
global $connection;
 if(isset($_POST['Pretrazi'])) {
    $kljucni_pojam = htmlspecialchars($_POST['pojam']);
    $broj_misljenja = htmlspecialchars($_POST['broj_misljenja']);
    $broj_biltena =  htmlspecialchars($_POST['broj_biltena']);
    $datum_misljenja=  htmlspecialchars($_POST['datum_misljenja']);
    if($broj_misljenja == "" and  $broj_biltena == "" and  $datum_misljenja == "" and $kljucni_pojam != "") { 
        $query = "SELECT * FROM misljenja WHERE tekst_misljenja LIKE '%$kljucni_pojam%' OR naslov_misljenja  LIKE '%$kljucni_pojam%' ";
    }

    else if ($broj_misljenja == "" and  $broj_biltena == "" and  $kljucni_pojam == "" and $datum_misljenja != ""){
        $query = "SELECT * FROM misljenja WHERE datum_misljenja like '%$datum_misljenja%' ";
    }
    else if ($kljucni_pojam == "" and  $broj_biltena == "" and  $datum_misljenja == "" and $broj_misljenja != ""){
        $query = "SELECT * FROM misljenja WHERE broj_misljenja LIKE '%$broj_misljenja%' ";
    }
    else if ($kljucni_pojam == "" and  $broj_misljenja == "" and  $datum_misljenja == "" and $broj_biltena != ""){
        $query = "SELECT * FROM misljenja WHERE broj_biltena LIKE '%$broj_biltena%' ";
    }
    else if ($kljucni_pojam != "" and  $broj_misljenja != "" and  $datum_misljenja != "" and $broj_biltena != ""){
        $query = "SELECT * FROM misljenja WHERE broj_biltena LIKE '%$broj_biltena%' AND  LIKE broj_misljenja '%$broj_misljenja%' AND tekst_misljenja LIKE '%$kljucni_pojam%'  AND datum_misljenja LIKE '%$datum_misljenja%' ";
    }
    else if ($kljucni_pojam != "" and  $broj_misljenja != "" and  $datum_misljenja == "" and $broj_biltena == ""){
        $query = "SELECT * FROM misljenja WHERE tekst_misljenja LIKE '%$kljucni_pojam%' AND  LIKE broj_misljenja '%$broj_misljenja%' ";
    }
     else if ($kljucni_pojam == "" and  $broj_misljenja == "" and  $datum_misljenja != "" and $broj_biltena != ""){
        $query = "SELECT * FROM misljenja WHERE datum_misljenja LIKE '%$datum_misljenja%' AND  broj_biltena LIKE '%$broj_biltena%' ";
        } 
     else if ($kljucni_pojam == "" and  $broj_misljenja == "" and  $datum_misljenja == "" and $broj_biltena == ""){
         echo "<h4 class='alert alert-danger'>Mорате унети минимум један критеријум за претрагу</h4>";
         die;
    }
    //=======================================================kraj  
    //
  //===============paginacij pocetak
    $rezultata_po_strani = 3;

   
    //===============paginacija kraj
    $rezultat = mysqli_query($connection, $query); 
    $broj_rezultata = mysqli_num_rows($rezultat);
    $broj_strana = ceil($broj_rezultata / $rezultata_po_strani);

    if(!isset($_GET['strana'])){
            $strana = 1;
        } else {
            $strana = $_GET['strana'];
        }

    $pocetni_broj = ($strana - 1)*$rezultata_po_strani;

    $query = $query . "LIMIT $pocetni_broj, $rezultata_po_strani";
    $rezultat = mysqli_query($connection, $query);

    if(!$rezultat){
        echo "<h3 class='alert alert-warning'>Не постоји резултат који одговара задатом појму</h3>";
    } else {

        while($red = mysqli_fetch_assoc($rezultat)){
            $tekst_misljenja_prikaz = substr($red['tekst_misljenja'],0, 1000);
            echo "<h4>Број Мишљења:<u>{$red['broj_misljenja']}</u></h4>";
            echo "<h4>{$red['naslov_misljenja']}</h4>";
            echo "<p>{$tekst_misljenja_prikaz}</p>";
            echo "<a class='btn' href='pojedinacno.php?broj={$red['rbr_misljenja']}' id='dugme2'>Прикажи више информација</a>"; 
            echo "<hr>";
        }
    }
    for($strana = 1; $strana<= $broj_strana; $strana++){
        echo "<a id='strana' class='btn btn-danger'  href='pag_poj.php?strana={$strana}'>{$strana}</a>";

    }
 
 } 
?>
