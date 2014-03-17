<?php
include_once "includes/langDetect.php";
?>
<!DOCTYPE html>
<html lang="<?php echo $user_language ?>">
    <head>
        <!--METAS-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="Rutes en caiac per la Costa Brava">
        <meta name="keywords" content="Costa brava, rutes en caiac, experiencies esportives, rutes costa brava">
        <meta name="author" content="Alexmany.com">
        <!--CSS-->
        <link rel="stylesheet" href="css/global.css" type="text/css"/>
        <!--FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:300,400,500,700' rel='stylesheet' type='text/css'>
        <!--JS-->
        <script type="text/javascript" src="js/jqurey11.js"></script>
    </head>
    <body>
        <div id="container">
            <!--header-->
            <?php include 'includes/header.php'; ?>
            <div class="passos">
                <div class="header_t">
                    <script> document.write(localStorage.getItem("nom"));</script> <?php echo TITOL_PAS1; ?>
                </div>
                <div class="caiacs">
                    <img  src="img/recursos/caiac.png" alt="image description"/>
                    <div class="int_caiac">
                        <div class="tit_caiac">
                            LASER
                        </div>
                        <div class="tit_caiac_des">
                            <?php echo TANCAT; ?>
                        </div>
                    </div>
                    <div class="cantitat">
                        <?php echo CANTITAT; ?> LASER
                        <select class="num_cay"  onchange="javascript:saveCaiakA();" name="num_cay_a" id="num_cay_a">

                            <option id="num_cay_a" name="num_cay_a" value="0"></option>
                            <option id="num_cay_a" name="num_cay_a" value="1">1</option>
                            <option id="num_cay_a" name="num_cay_a" value="2">2</option>
                            <option id="num_cay_a" name="num_cay_a" value="3">3</option>
                            <option id="num_cay_a" name="num_cay_a" value="4">4</option>
                            <option id="num_cay_a" name="num_cay_a" value="5">5</option>
                            <option id="num_cay_a" name="num_cay_a" value="6">6</option>
                            <option id="num_cay_a" name="num_cay_a" value="7">7</option>
                            <option id="num_cay_a" name="num_cay_a" value="8">8</option>
                            <option id="num_cay_a" name="num_cay_a" value="9">9</option>
                            <option id="num_cay_a" name="num_cay_a" value="10">10</option> 
                        </select>
                    </div>
                </div>
                <div class="caiacs">
                    <img  src="img/recursos/caiac.png" alt="image description"/>
                    <div class="int_caiac">
                        <div class="tit_caiac">
                            ATLANTIS
                        </div>
                        <div class="tit_caiac_des">
                            <?php echo DOBLE; ?>
                        </div>
                    </div>
                    <div class="cantitat">
                        <?php echo CANTITAT; ?> ATLANTIS
                        <select class="num_cay" onchange="javascript:saveCaiakB();" name="num_cay_b" id="num_cay_b">

                            <option id="num_cay_b" name="num_cay_b" value="0"></option>
                            <option id="num_cay_b" name="num_cay_b" value="1">1</option>
                            <option id="num_cay_b" name="num_cay_b" value="2">2</option>
                            <option id="num_cay_b" name="num_cay_b" value="3">3</option>
                            <option id="num_cay_b" name="num_cay_b" value="4">4</option>
                            <option id="num_cay_b" name="num_cay_b" value="5">5</option>
                            <option id="num_cay_b" name="num_cay_b" value="6">6</option>
                            <option id="num_cay_b" name="num_cay_b" value="7">7</option>
                            <option id="num_cay_b" name="num_cay_b" value="8">8</option>
                            <option id="num_cay_b" name="num_cay_b" value="9">9</option>
                            <option id="num_cay_b" name="num_cay_b" value="10">10</option> 
                        </select>
                    </div>
                </div>
                <div class="caiacs">
                    <img  src="img/recursos/caiac.png" alt="image description"/>
                    <div class="int_caiac">
                        <div class="tit_caiac">
                            VULCANO
                        </div>
                        <div class="tit_caiac_des">
                            <?php echo SIMPLE; ?>
                        </div>
                    </div>
                    <div class="cantitat">
                        <?php echo CANTITAT; ?> VULCANO
                        <select class="num_cay" onchange="javascript:saveCaiakC();" name="num_cay_c" id="num_cay_c">

                            <option id="num_cay_c" name="num_cay_c" value="0"></option>
                            <option id="num_cay_c" name="num_cay_c" value="1">1</option>
                            <option id="num_cay_c" name="num_cay_c" value="2">2</option>
                            <option id="num_cay_c" name="num_cay_c" value="3">3</option>
                            <option id="num_cay_c" name="num_cay_c" value="4">4</option>
                            <option id="num_cay_c" name="num_cay_c" value="5">5</option>
                            <option id="num_cay_c" name="num_cay_c" value="6">6</option>
                            <option id="num_cay_c" name="num_cay_c" value="7">7</option>
                            <option id="num_cay_c" name="num_cay_c" value="8">8</option>
                            <option id="num_cay_c" name="num_cay_c" value="9">9</option>
                            <option id="num_cay_c" name="num_cay_c" value="10">10</option> 
                        </select>
                    </div>
                </div>
                <div id="goto2">
                    <a href="reserva_pas0.php"><div id="botoAnt">
                            <?php echo ANTERIOR; ?> <br>
                            <?php echo TRIAR; ?>
                        </div></a>
                    <!--                    <a href="reserva_pas2.php"><div id="boto">-->
                    <a onClick="comprovador();"><div id="boto">
                            <?php echo SEGUENT; ?> <br>
                            <?php echo DADES_PERSONALS; ?>
                        </div></a>

                </div>
                <div id="messages"></div>
            </div>
            <?php include 'includes/footer.php'; ?>
        </div>
        <script type="text/javascript">

                        localStorage.setItem("caiakA", "nulo");
                        localStorage.setItem("caiacB", "nulo");
                        localStorage.setItem("caiacC", "nulo");


                        function comprovador() {
                            var comRutaA = document.getElementById("num_cay_a");
                            var comRutaB = document.getElementById("num_cay_b");
                            var comRutaC = document.getElementById("num_cay_c");
                            var selectedA = comRutaA.options[comRutaA.selectedIndex].text;
                            var selectedB = comRutaB.options[comRutaB.selectedIndex].text;
                            var selectedC = comRutaC.options[comRutaC.selectedIndex].text;
                            if (selectedA == '' && selectedB == '' && selectedC == '') {
                                document.getElementById("messages").style.display = "block";
                                document.getElementById("messages").innerHTML = " <?php echo ALERTA; ?>";
                            } else {
                                localStorage.setItem("rutas", "ruta_a");
                                window.location.href = 'http://localhost/transbrava/reserva_pas2.php';
                            }

                        }

                        function saveCaiakA()
                        {
                            var combo = document.getElementById("num_cay_a");
                            var selected = combo.options[combo.selectedIndex].text;
                            localStorage.setItem("caiakA", selected);

                        }
                        function saveCaiakB()
                        {
                            var combo = document.getElementById("num_cay_b");
                            var selected = combo.options[combo.selectedIndex].text;
                            localStorage.setItem("caiacB", selected);

                        }
                        function saveCaiakC()
                        {
                            var combo = document.getElementById("num_cay_c");
                            var selected = combo.options[combo.selectedIndex].text;
                            localStorage.setItem("caiacC", selected);

                        }

        </script>
    </body>
</html>