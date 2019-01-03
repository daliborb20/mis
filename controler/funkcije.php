<?php


   function pretraga()
    {
        global $connection;
        global $query;
        session_start();
        if (isset($_GET['reset']) && $_GET['reset'] == 1) {
            unset($_SESSION['query']);
        }

        if (isset($_GET['Pretrazi'])) {
            $kljucni_pojam = htmlspecialchars($_GET['pojam']);
            $broj_misljenja = htmlspecialchars($_GET['broj_misljenja']);
            $broj_biltena = htmlspecialchars($_GET['broj_biltena']);
            $datum_misljenja = htmlspecialchars($_GET['datum_misljenja']);
            if ($broj_misljenja == '' and $broj_biltena == '' and $datum_misljenja == '' and $kljucni_pojam != '') {
                $query = "SELECT * FROM misljenja WHERE tekst_misljenja LIKE '%$kljucni_pojam%' OR naslov_misljenja  LIKE '%$kljucni_pojam%' ";
            } elseif ($broj_misljenja == '' and $broj_biltena == '' and $kljucni_pojam == '' and $datum_misljenja != '') {
                $query = "SELECT * FROM misljenja WHERE datum_misljenja like '%$datum_misljenja%' ";
                $_SESSION['query'] = $query;
            } elseif ($kljucni_pojam == '' and $broj_biltena == '' and $datum_misljenja == '' and $broj_misljenja != '') {
                $query = "SELECT * FROM misljenja WHERE broj_misljenja LIKE '%$broj_misljenja%' ";
                $_SESSION['query'] = $query;
            } elseif ($kljucni_pojam == '' and $broj_misljenja == '' and $datum_misljenja == '' and $broj_biltena != '') {
                $query = "SELECT * FROM misljenja WHERE broj_biltena LIKE '%$broj_biltena%' ";
                $_SESSION['query'] = $query;
            } elseif ($kljucni_pojam != '' and $broj_misljenja != '' and $datum_misljenja != '' and $broj_biltena != '') {
                $query = "SELECT * FROM misljenja WHERE broj_biltena LIKE '%$broj_biltena%' AND  LIKE broj_misljenja '%$broj_misljenja%' AND tekst_misljenja LIKE '%$kljucni_pojam%'  AND datum_misljenja LIKE '%$datum_misljenja%' ";
                $_SESSION['query'] = $query;
            } elseif ($kljucni_pojam != '' and $broj_misljenja != '' and $datum_misljenja == '' and $broj_biltena == '') {
                $query = "SELECT * FROM misljenja WHERE tekst_misljenja LIKE '%$kljucni_pojam%' AND  LIKE broj_misljenja '%$broj_misljenja%' ";
                $_SESSION['query'] = $query;
            } elseif ($kljucni_pojam == '' and $broj_misljenja == '' and $datum_misljenja != '' and $broj_biltena != '') {
                $query = "SELECT * FROM misljenja WHERE datum_misljenja LIKE '%$datum_misljenja%' AND  broj_biltena LIKE '%$broj_biltena%' ";
                $_SESSION['query'] = $query;
            } elseif ($kljucni_pojam == '' and $broj_misljenja == '' and $datum_misljenja == '' and $broj_biltena == '') {
                echo "<h4 class='alert alert-danger'>Mорате унети минимум један критеријум за претрагу</h4>";
                die;
            }
            //=======================================================kraj
    //
        }
    }

   function paginacija()
    {
        global $connection;
        global $query;

        //===============paginacij pocetak

        if (isset($_SESSION['query'])) {
            $query = $_SESSION['query'];

            $rezultata_po_strani = 9;

            //===============paginacija kraj
            $rezultat = mysqli_query($connection, $query);
            $broj_rezultata = mysqli_num_rows($rezultat);
            $broj_strana = ceil($broj_rezultata / $rezultata_po_strani);

            if (!isset($_GET['strana'])) {
                $strana = 1;
            } else {
                $strana = $_GET['strana'];
            }

            $pocetni_broj = ($strana - 1) * $rezultata_po_strani;

            $query = $query."LIMIT $pocetni_broj, $rezultata_po_strani";
            mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
            $rezultat = mysqli_query($connection, $query);

            if (!$rezultat && !$query) {
                echo "<h3 class='alert alert-warning'>Не постоји резултат који одговара задатом појму</h3>";
            } else {
                while ($red = mysqli_fetch_assoc($rezultat)) {
                    $tekst_misljenja_prikaz = substr($red['tekst_misljenja'], 0, 1000);
                    echo "<div data-aos='fade-right'class='container' id='rezultati'>";
                    echo "<h4>Број Мишљења:<u>{$red['broj_misljenja']}</u></h4>";
                    echo "<h4>{$red['naslov_misljenja']}</h4>";
                    echo "<p>{$tekst_misljenja_prikaz}</p>";
                    echo "<a class='btn' href='pojedinacno.php?rbr={$red['rbr_misljenja']}' id='dugme2'>Прикажи више информација</a>";
                    echo '</div>';
                    echo '<hr>';
                }
            }
            for ($strana = 1; $strana <= $broj_strana; ++$strana) {
                echo "<a id='strana' class='btn btn-danger'  href='pretraga.php?strana={$strana}'>{$strana}</a>";
            }
        }
    }

   function poslednjihSto()
    {
        global $connection;
        $pojmovi = array('ПДВ', 'добит', 'доходак', 'фискалним', 'акцизама', 'рачуноводству');

        if (isset($_GET['zakon'])) {
            if (in_array($_GET['zakon'], $pojmovi)) {
                $pojam = htmlspecialchars($_GET['zakon']);
                $query = "SELECT * FROM misljenja WHERE zakon like '%$pojam%' ORDER BY rbr_misljenja DESC LIMIT 100";
                mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
                $rezultat = mysqli_query($connection, $query);

                if (!$rezultat) {
                    echo "<div class='container'>";
                    echo "<h3 class='alert alert-warning'>Не постоји резултат који одговара задатом појму</h3>";
                    echo '</div>';
                } else {
                    while ($red = mysqli_fetch_assoc($rezultat)) {
                        $tekst_misljenja_prikaz = substr($red['tekst_misljenja'], 0, 1000);
                        echo "<div data-aos='fade-right'class='container' id='rezultati'>";
                        echo "<h4>Број Мишљења:<u>{$red['broj_misljenja']}</u></h4>";
                        echo "<h4>{$red['naslov_misljenja']}</h4>";
                        echo "<p>{$tekst_misljenja_prikaz}</p>";
                        echo "<a class='btn' href='pojedinacno.php?rbr={$red['rbr_misljenja']}' id='dugme2'>Прикажи више информација</a>";
                        echo '</div>';
                        echo '<hr>';
                    }
                }
            }
        }
    }

   function posaljiMejl()
    {
        require 'mail/Exception.php';
        require 'mail/PHPMailer.php';
        require 'mail/SMTP.php';
        global $connection;

        if (isset($_GET['mejl'])) {
            $rbr = htmlspecialchars($_GET['broj']);
            $email = htmlspecialchars($_GET['mejl']);
            mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
            $query = "SELECT * FROM misljenja where rbr_misljenja = $rbr";
            $rezultat = mysqli_query($connection, $query);
            if (!$rezultat) {
                echo "<div class='alert alert-danger'>Neuspesno citanje iz baze podataka</div>";
            } else {
                foreach ($rezultat as $red) {
                    $tekst = $red['tekst_misljenja'];
                    $broj = $red['broj_misljenja'];

                    $mail = new PHPMailer\PHPMailer\PHPMailer();                              // Passing `true` enables exceptions
                    try {
                        //Server settings
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'mail.sarena-laza.in.rs';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'mis@sarena-laza.in.rs';                 // SMTP username
                $mail->Password = 'sarenala_misljenja';                           // SMTP password
                $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                    // TCP port to connect to

                //Recipients
                        $mail->setFrom('mis@sarena-laza.in.rs', 'Misljenje');
                        $mail->addAddress($email, 'Joe User');     // Add a recipient

                        //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Misljenje MF '.$broj;
                        $mail->Body = $tekst;

                        $mail->send();
                        echo "<h4 class='alert text-center'>Порука успешно послата!!</h4>";
                        echo "<h4 class='text-center'>Враћамо Вас на претходну страницу...</h4>";
                        header("refresh:2; url=pojedinacno.php?rbr={$rbr}");
                    } catch (Exception $e) {
                        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                    }
                }
            }
        }
    }

   function pojedinacno()
    {
        global $connection;
        if (isset($_GET['rbr'])) {
            $rbr = htmlspecialchars($_GET['rbr']);
            $query = "SELECT * FROM misljenja WHERE rbr_misljenja = $rbr";
            mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
            $rezultat = mysqli_query($connection, $query);

            if (!$rezultat) {
                echo "<div class='alert alert-danger'>Neuspesno citanje iz baze</div>";
            } else {
                foreach ($rezultat as $red) {
                    $broj_misljenja = $red['broj_misljenja'];
                    $broj_biltena = $red['broj_biltena'];
                    $naslov_misljenja = $red['naslov_misljenja'];
                    $datum = $red['datum_misljenja'];
                    $tekst = $red['tekst_misljenja'];
                    $zakon = $red['zakon'];
                    $link = $red['link_misljenja'];
                    $rbr = $red['rbr_misljenja'];

                    echo "<h4>Мишљење број: {$broj_misljenja}</h4>";
                    echo "<h4>Датум мишљења: {$datum}</h4>";
                    echo "<h4>Број билтена: {$broj_biltena}</h4>";
                    echo "<h4><a id='preuzmi_misljenje' href='$link'>Преузмите билтен</a></h4>";

                    echo "<h4><a id='link__sakrij' >Пошаљи мишљење на мејл</a></h4>";
                    echo "<div id='forma__skrivena'>";
                    echo "<form method='GET'>";
                    echo "<input id='mejl__forma'placeholder='Унесите мејл адресу' type='email' name='mejl'>";
                    echo "<input type='hidden' name='broj' value='{$rbr}'>";
                    echo "<input value='Пошаљи мишљење' type='submit' class='btn' id='dugme3'>";
                    echo '</form>';
                    echo '</div>';

                    echo "<h4>Мишљење се односи на: {$zakon}</h4>";
                    echo "<h4>Наслов мишљења: <strong>{$naslov_misljenja}</strong></h4>";
                    echo '<h4>Текст мишљења: </h4>';
                    echo "<p>{$tekst}</p>";
                    echo "<a class='btn'id='dugme2' href='index.php'>Повратак</a>";
                }
            }
        }
    }

    function unesiNovoMisljenje()
    {
        global $connection;
        if (isset($_POST['posalji'])) {
            $broj_misljenja = htmlspecialchars($_POST['broj_misljenja']);
            $broj_biltena = htmlspecialchars($_POST['broj_biltena']);
            $naslov_misljenja = htmlspecialchars($_POST['naslov_misljenja']);
            $tekst_misljenja = htmlspecialchars($_POST['tekst_misljenja']);
            $spec = htmlspecialchars($_POST['spec']);
            $link = htmlspecialchars($_POST['link_misljenja']);
            $zakon = htmlspecialchars($_POST['zakon']);
            $datum = htmlspecialchars($_POST['datum_misljenja']);
            mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
            $query = "INSERT INTO misljenja (naslov_misljenja, broj_misljenja, datum_misljenja, broj_biltena, tekst_misljenja, link_misljenja, zakon, spec) values ('$naslov_misljenja', '$broj_misljenja', '$datum','$broj_biltena', '$tekst_misljenja', '$link', '$zakon', '$spec')";
            $rezultat = mysqli_query($connection, $query);
            if (!$rezultat) {
                echo "<div class='alert alert-danger'>Upis u bazu nije moguc</div> ".mysqli_error($connection);
            } else {
                echo "<div class='alert alert-success'>Uspesno upisano u bazu</div> ";

            }
        }
    }

