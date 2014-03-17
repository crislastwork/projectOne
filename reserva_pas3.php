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
        <!--Valors de la pàgina anterior-->
       
        <div id="container">
            <!--header-->
            <?php include 'includes/header.php'; ?>
            <div class="passos3">
                <div class="header_t">
                    <?php echo TITOL_PAS3; ?> 
                </div>
                <div class="con_tot">
                    <div id="cont_user">
                        <br>
                        <table class="table">
                            <tr>
                                <td class="one first"> <label id="cai1"></label></td>
                                <td class="two first"> <label id="cai1_price"></label></td>
                            </tr>
                            <tr>
                                <td class="one"> <label id="cai2"></label></td>
                                <td class="two"> <label id="cai2_price"></label></td>
                            </tr>
                            <tr>
                                <td class="one"> <label id="cai3"></label></td>
                                <td class="two"> <label id="cai3_price"></label></td>
                            </tr>
                            <tr >
                                <td class="one_t"> TOTAL <br><label id="total_price"></label></td>
                                <td class="two_t"> RESERVA <br><label id="total_reserva"></label></td>
                            </tr>
                            <tr>
                                <td class="recor" colspan="2"> Recorda que sortira el <label id="dates_sortida"></label></td>
                            </tr>
                        </table>
                        <table class="table2">
                            <tr>
                                <td class="recor" colspan="2"> 
                                    VOLS ALGUN SERVEI EXTRA
                                    <br>
                                    <form>
                                        <input type="checkbox" id="Taller">Taller monogràfic<br>
                                        <input type="checkbox" id="bicac">Pack bivac
                                    </form> 
                                </td>
                            </tr>
                            <tr>
                                <td class="recor" colspan="2"> 
                                    TAMANY DE SEMARRETA (REGAL)
                                    <br>
                                    <form>
                                        <input type="radio" name="sex" value="male">Male
                                        <input type="radio" name="sex" value="female">Female
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                

                <div id="goto2">
                    <a href="reserva_pas0.php"><div id="botoAnt">
                             <?php echo ANTERIOR; ?> <br>
                            <?php echo TRIAR; ?>
                        </div></a>
                    <!--                    <a href="reserva_pas2.php"><div id="boto">-->
                    <a onClick="sender();"><div id="boto">
                            <?php echo SEGUENT; ?> <br>
                            <?php echo DADES_PERSONALS; ?>
                        </div></a>
                    
                </div>
            </div>
            <
            <?php include 'includes/footer.php'; ?>
        </div>
        <script type="text/javascript">
            var price1 = 0;
            var price2 = 0;
            var price3 = 0;
             if (localStorage.getItem("caiakA") != null & localStorage.getItem("caiakA") != "nulo") {
                document.getElementById("cai1").innerHTML = localStorage.getItem('caiakA') + " caiac LASER";
                var price1 = localStorage.getItem('caiakA') * 250;
                document.getElementById("cai1_price").innerHTML = price1 + " €";
            }
             if (localStorage.getItem("caiacB") != null & localStorage.getItem("caiacB") != "nulo") {
                document.getElementById("cai2").innerHTML = localStorage.getItem('caiacB') + " caiac ATLANTIS";
                var price2 = localStorage.getItem('caiacB') * 250;
                document.getElementById("cai2_price").innerHTML = price2 + " €";
            }
            if (localStorage.getItem("caiacC") != null & localStorage.getItem("caiacC") != "nulo") {
                document.getElementById("cai3").innerHTML = localStorage.getItem('caiacC') + " caiac VULCANO";
                var price3 = localStorage.getItem('caiacC') * 250;
                document.getElementById("cai3_price").innerHTML = price3 + " €";
            }

            var total = price1 + price2 + price3;
            var reserva = total * 0.2 ;
            document.getElementById("total_price").innerHTML = total + " €";
            document.getElementById("total_reserva").innerHTML = reserva + " €";
            var format = localStorage.getItem('datainici');
            
            document.getElementById("dates_sortida").innerHTML = localStorage.getItem('datainici');

            function sender() {
                window.Taller = $('#Taller').val();
//                if (Taller == "on") {
//                    alert("caca");
//                    
//                }
        var caiaca = localStorage.getItem('caiakA');    
        alert(caiaca);
            $.post("sender.php", { caiacsa: caiaca } );
   
            }
        </script>
    </body>
</html>