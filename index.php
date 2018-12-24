<?php include "includes/header.php" ?>
<?php include "db.php"; ?>

<div class="row">
<div class="col-md-8 col-md-offset-2 col-xs-offset-1" id="naslov">
<div>
    <h2 class="text-center"> Мишљења Министарства финансија </h2>
</div>

    <a href="controler/funkcije.php?zakon=pdv">
        <div id="container__zakoni" class="container col-md-4 col-xs-5">Порез на додату вредност</div>
    </a>

    <a href="pocetna_misljenja.php?zakon=dobit">
        <div id="container__zakoni" class="container col-md-4 col-xs-5">Порез на добит предузећа</div>
    </a>

    <a href="pocetna_misljenja.php?zakon=dohodak">
        <div id="container__zakoni" class="container col-md-4 col-xs-5">Порез на доходак грађана</div>
    </a>

    <a href="pocetna_misljenja.php?zakon=kase">
        <div id="container__zakoni" class="container col-md-4 col-xs-5">Фискалне касе</div>
    </a>

    <a href=pocetna_misljenja.php?zakon=akcize">
        <div id="container__zakoni" class="container col-md-4 col-xs-5">Aкцизе</div>
    </a>

    <a href=pocetna_misljenja.php?zakon=racunovodstvo">
        <div id="container__zakoni" class="container col-md-4 col-xs-5">Рачуноводство</div>
    </a>

</div>
</div>
 <?php include "includes/footer.php" ?>
