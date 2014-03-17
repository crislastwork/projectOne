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
            <div class="passos0">
                <div class="header_t">
                    <?php echo TITOL_PAS0; ?>
                </div>
                <div id="dades">
                    <div id="int_dades">
                        <form>
                            <input type="text" id="nom" class="in_name" name="FirstName" placeholder="Nom"><br>
                            <input type="email" id="mail"  class="in_name" name="FirstName" placeholder="E-Mail"><br>
                            <input type="text" id="tel"  class="in_name" name="FirstName" placeholder="Telefon"><br>
                        </form>
                    </div>
                </div>
                <div id="goto1">

                    <a onClick="comprovador();"><div id="boto">
                            <?php echo SEGUENT; ?> <br>
                            <?php echo TRIAR; ?>
                        </div></a>
                   
                </div>
                 <div id="messages0"></div>
            </div>
            <?php include 'includes/footer.php'; ?>
        </div>
        <script type="text/javascript">
                        localStorage.clear();



                        function comprovador() {
                            var nom = $('#nom').val();
                            localStorage.setItem("nom", nom);
                            var tel = $('#tel').val();
                            localStorage.setItem("tel", tel);
                            var mail = $('#mail').val();
                            localStorage.setItem("mail", mail);
                            var filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;	
                            if (nom == '' | tel == '' | !filtro.test(mail)) {
                                document.getElementById("messages0").style.display = "block";
                                document.getElementById("messages0").innerHTML = " <?php echo ALERTA_PAS0; ?>";
                            } else {
                                localStorage.setItem("rutas", "ruta_a");
                                window.location.href = 'http://localhost/transbrava/reserva_pas1.php';
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