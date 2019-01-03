<?php include "includes/header.php" ?>
<?php include "includes/db.php" ?>
<?php include "includes/funkcije.php" ?>
<div class="container" id="container__forma">
    <form id="forma2"   method="GET">
        <label class="col-md-12 col-xs-12"for="pojam" >Претрага по кључном појму</label>
        <input name="pojam" class="imena2 col-md-12 col-xs-12" id="pojam" type="text" placeholder="Кључни појам">

        <label for="broj_misljenja" class="col-md-12 col-xs-12">Претрага по броју мишљења</label>
        <input class="imena2 col-md-12 col-xs-12" name="broj_misljenja" id="broj_misljenja" type="text" placeholder="Број Мишљења">

        <label class="col-md-12 col-xs-12"for="broj_biltena">Претрага по броју билтена</label>
        <input class="imena2 col-md-12 col-xs-12" name="broj_biltena" id="broj_biltena" type="text" placeholder="Број Билтена">

        <label class="col-md-12 col-xs-12"for="datum_misljenja">Претрага по датуму мишљења</label>
        <input class="imena2 col-md-12 col-xs-12" name="datum_misljenja" id="datum_misljenja" type="date" placeholder="Датум Мишљења">
 
        <input id="dugme2" name='Pretrazi'  value="Претражи" type="submit">
    </form>
</div>



<?php
//=======================pocetak pretrage
pretraga();
paginacija();
?>
</div>

</div>


<?php include "includes/footer.php" ?>
