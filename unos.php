<?php include "includes/header.php"  ?>
<?php include "db.php" ?>
 
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
if(isset($_POST['posalji']))
{
  $broj_misljenja = htmlspecialchars($_POST['broj_misljenja']);
  $broj_biltena = htmlspecialchars($_POST['broj_biltena']);
  $naslov_misljenja = htmlspecialchars($_POST['naslov_misljenja']);
  $tekst_misljenja = htmlspecialchars($_POST['tekst_misljenja']);
  $spec = htmlspecialchars($_POST['spec']);
  $link = htmlspecialchars($_POST['link_misljenja']);
  $zakon = htmlspecialchars($_POST['zakon']);
  $datum = htmlspecialchars($_POST['datum_misljenja']);

  $query = "INSERT INTO misljenja (naslov_misljenja, broj_misljenja, datum_misljenja, broj_biltena, tekst_misljenja, link_misljenja, zakon, spec) values ('$naslov_misljenja', '$broj_misljenja', '$datum','$broj_biltena', '$tekst_misljenja', '$link', '$zakon', '$spec')";
  $rezultat = mysqli_query($connection, $query);
  if(!$rezultat) 
  {
      echo "<div class='alert alert-danger'>Upis u bazu nije moguc</div> ".mysqli_error($connection);
  } 
  else {
      echo "<div class='alert alert-success'>Uspesno upisano u bazu</div> ";
  } 
}

?>
<?php include "includes/footer.php" ?>
