<?php include 'includes/header.php'; ?>
<?php include 'incluedes/db.php'; ?>
<?php include 'includes/funkcije.php'; ?>

<div class="container">
<form id="forma"  method="POST" class="form-group">
<h1>Dodaj novo misljenje</h1>
<input placeholder="Broj Misljenja" class="imena" type="text" name="broj_misljenja"  >
<input type="text" class="imena" placeholder="Broj Biltena Misljenja Finansija" name="broj_biltena">
<input type="text" placeholder="Naslov Misljenja MF" name="naslov_misljenja" class="imena">
<textarea name="tekst_misljenja" class="imena" placeholder="Tekst Misljenja MF"  cols="30" rows="10"></textarea>
<input type="text" name="spec" class="imena" placeholder="Tag Misljenja" >
<input type="text" name="link_misljenja" class="imena" placeholder="Link" >
<input type="text" placeholder='Zakon' name="zakon" class="imena">
<input type="date" name="datum_misljenja" class="imena">
<input type="submit" name="posalji" class="imena" value="Upisi misljenje u bazu podataka">
</form>


</div>


<?php
//-------------------------------unos novih misljenja----------------
unesiNovoMisljenje();
?>
<?php include 'includes/footer.php'; ?>
