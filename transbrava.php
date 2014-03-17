<?php
include_once "includes/langDetect.php";
?>
<!DOCTYPE html>
<html lang="<?php echo $user_language ?>">
    <head>
        <!--METAS-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="una travessa de quatre dies on et sentiràs nòmada del vent i les onades mentre recorres el fil de costa entre Blanes i Empúries.">
        <meta name="keywords" content="Blanes, Empúries, Illes Medes, oves marines de Tamariu, cales de Castell ">
        <meta name="author" content="Alexmany.com">
        <!--CSS-->
        <link rel="stylesheet" href="css/global.css" type="text/css"/>
        <!--FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:300,400,500,700' rel='stylesheet' type='text/css'>
        <!--JS-->
        <script type="text/javascript" src="js/jqurey11.js"></script>
        <script type="text/javascript" src="js/jquery.sudoSlider.js"></script>
    </head>
    <body id="transbrava">
        <div id="container">
            <!--header-->
            <?php include 'includes/header.php'; ?>
            <!--Slider-->
            <div id="conslider">
                <div id="slider">
                    <ul>
                        <li data-pause="4000"><img  src="img/slider/trans/1.jpg" alt="image description"/></li>
                        <li data-pause="4000"><img  src="img/slider/trans/2.jpg" alt="image description"/></li>
                        <li data-pause="4000"><img  src="img/slider/trans/3.jpg" alt="image description"/></li>
                        <li data-pause="4000"><img  src="img/slider/trans/4.jpg" alt="image description"/></li>
                    </ul>
                </div>
            </div>
            <!--texte intro-->
            <div class="destacats">
                <div class="intro_justi">
                    <?php echo INTRO_TRANS; ?>
                </div>
            </div>
            <!--body rutes, detextem si es tactil o no i cridem una pàgina o un altre-->
            <div class="content_body">
                <div class="int_content">
                    <div id="maps">
                        <img src="img/recursos/mapatrans.png">
                    </div>
                    <div id="info_ruta">
                        <div class="int_info">
                            <div class="header_t">
                                TRANSBRAVA
                            </div>
                            <div id="int_info_rutes">
                                <span class="titol_rutes2">
                                    Inclou:	
                                </span><br>
                                - Caiac de travessia amb compartiments estancs<br>
                                - Armilla, rem de travessia, cobrebanyera, axicador i dues bosses estanques<br>
                                - Pala desmuntable, bomba de buidatge, corda de remolc (per grup)<br>
                                - Servei de transport a l’inici o final de la ruta<br>
                                - Plànol aquàtic exclusiu del recorregut on detallem les platges per bivaquejar, els càmpings “amics”, les millors cales, els indrets més amagats i pintorescos, singulars rutes a peu i moltes altres dades d'interès. <br>
                                - Samarreta tècnica personalitzada pels “transbrava-finishers”.<br>
                                - Informació diària de la previsió meteorològica i de l'estat de la mar.<br>
                                - Telèfon de contacte directe davant qualsevol incidència<br>
                                - Assegurança de responsabilitat civil<br>
                                <div id="icons_rutes">
                                    <div class="comp_incon">
                                        <ul>
                                            <li><img class="icon" height="35" src="img/recursos/dies.png"></li>
                                            <li class="text_li"><?php echo ICON_DIES_4; ?></li>
                                        </ul>
                                        <ul>
                                            <li><img class="icon" height="35" src="img/recursos/nivell.png"></li>
                                            <li class="text_li"><?php echo ICON_LEVEL_MIG; ?></li>
                                        </ul>
                                        <ul>
                                            <li><img class="icon" height="35" src="img/recursos/distancia.png"></li>
                                            <li class="text_li">100 km</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="reserva_pas1.php"><div id="reserva">
                                <span class="preu">225 €</span><br><span class="preu2">335 € (doble)</span> <span class="res"> RESERVAR ARA!</span>
                            </div></a>
                    </div>
                </div>
            </div>
            <div class="destacats">
                <div class="intro_justi">
                    El Crit · Punta Miladones · Cala Pedrosa · aigües turqueses · Sa Foradada · snorkel · Illes Medes · Far de Sant Sebastià · Torre · Valentina · Sa Riera · Cala Morisca · gavines · Cala Montgo · La Catedral · cap de Sa Sal · Aigua-xellida · Treumal · Mar i Murtra
                </div>
            </div>

            <div id="serveis_extres">
                <div class="extres">
                    <div class="header_e">
                        <?php echo T_BIBAC; ?>
                    </div>
                    <div id="int_info_rutes">
                        <p> <?php echo BIBAC_EXTRES; ?></p>
                    </div>
                    <div class="preu_r">
                        12 € dia
                    </div>
                </div>
                <div class="extres">
                    <div class="header_e">
                        <?php echo T_CAMPING; ?>
                    </div>
                    <div id="int_info_rutes">
                        <p> <?php echo CAMPINGS_EXTRES; ?></p>
                    </div>
                    <div class="preu_r">
                        12 € dia
                    </div>
                </div>
                <div class="extres_final">
                    <div class="header_e">
                        <?php echo T_TALLER; ?>
                    </div>
                    <div id="int_info_rutes">
                        <p> <?php echo TALLER_EXTRES; ?></p>
                    </div>
                    <div class="preu_r">
                        12 € dia
                    </div>
                </div>

            </div>
            <?php include 'includes/footer.php'; ?>
        </div>
        <script type="text/javascript" >
            $(document).ready(function() {
                var sudoSlider = $("#slider").sudoSlider({
                    effect: "fade",
                    controlsFade: false
                });
                $(".prevBtn, .nextBtn, #slider").hover(
                        function() {
                            // Mousein
                            $(".prevBtn, .nextBtn").stop().fadeTo(200, 1);
                        },
                        function() {
                            //Mouse out
                            $(".prevBtn, .nextBtn").stop().fadeTo(200, 0);
                        }
                );
                $(".prevBtn, .nextBtn").stop().fadeTo(0, 0);
            });
        </script>
    </body>
</html>
<?php
    session_start();
    $_SESSION['ruta'] =  "ruta_b"
?>