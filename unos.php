<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>
<?php include 'includes/funkcije.php'; ?>

<div class="container">
    <form id="forma"  method="POST" class="form-group">
        <h1>Додај ново Мишљење</h1>
        <input placeholder="Број Мишљења" class="imena" type="text" name="broj_misljenja"  >
        <input type="text" class="imena" placeholder="Број билтена МФ" name="broj_biltena">
        <input type="text" placeholder="Наслов Мишљења МФ" name="naslov_misljenja" class="imena">
        <textarea name="tekst_misljenja" class="imena" placeholder="Текст Мишљења МФ"  cols="30" rows="10"></textarea>
        <input type="text" name="spec" class="imena" placeholder="Таг Мишљења" >
        <input type="text" name="link_misljenja" class="imena" placeholder="Линк ка ПДФ фајлу" >
        <input type="text" placeholder='Закон' name="zakon" class="imena">
        <input type="date" name="datum_misljenja" class="imena">
        <input type="submit" name="posalji" class="imena" value="Упиши Мишљење у базу података">
    </form>


</div>


<?php
//-------------------------------unos novih misljenja----------------
unesiNovoMisljenje();
?>
<?php include 'includes/footer.php'; ?>
