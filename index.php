<?php include "includes/header.php" ?>
<?php include "db.php"; ?>
<?php include "controler/funkcije.php"; ?>

<div class="row">
<div class="col-md-8 col-md-offset-2 col-xs-offset-1" id="naslov">

    <h2 class="text-center"> Мишљења Министарства финансија </h2>
    <a href="index.php?zakon=ПДВ">
        <div id="container__zakoni" class="container col-md-4 col-xs-5">Порез на додату вредност</div>
    </a>

    <a href="index.php?zakon=добит">
        <div id="container__zakoni" class="container col-md-4 col-xs-5">Порез на добит предузећа</div>
    </a>

    <a href="index.php?zakon=доходак">
        <div id="container__zakoni" class="container col-md-4 col-xs-5">Порез на доходак грађана</div>
    </a>

    <a href="index.php?zakon=фискалним">
        <div id="container__zakoni" class="container col-md-4 col-xs-5">Фискалне касе</div>
    </a>

    <a href="index.php?zakon=акцизама">
        <div id="container__zakoni" class="container col-md-4 col-xs-5">Aкцизе</div>
    </a>

    <a href="index.php?zakon=рачуноводству">
        <div id="container__zakoni" class="container col-md-4 col-xs-5">Рачуноводство</div>
    </a>

</div>
</div>
<?php Misljenja::selektorZakona();?>
 <?php include "includes/footer.php" ?>
