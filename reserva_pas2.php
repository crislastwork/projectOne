<!--

  @author Cristina Alemany de Puig <adp.cris@gmail.com> 
  @version 1.0
  
-->

<?php
error_reporting(-1);
require_once("config.inc.php");
include_once "includes/langDetect.php";
session_start();

//$pagina_anterior = $_SERVER['HTTP_REFERER'];
//if ($pagina_anterior != "http://localhost/transbrava/reserva_pas1.php")
//  header('Location: http://localhost/transbrava/index.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
        <title>Calendari Transbrava</title>
        <!-- Els dos meta seguents serveixen per prevenir el sistema de caché i es carregui cada vegada! -->
        <meta http-equiv="PRAGMA" content="NO-CACHE" />
        <meta http-equiv="EXPIRES" content="-1" />
        <!--METAS-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="description" content="Rutes en caiac per la Costa Brava"/>
        <meta name="keywords" content="Costa brava, rutes en caiac, experiencies esportives, rutes costa brava"/>
        <meta name="author" content="Alexmany.com"/>
        <!--JS-->
        <script src="js/jquery-1.9.0.min.js"></script>
        <!--CSS-->
        <link rel="stylesheet" href="css/global.css" type="text/css"/>
        <link type="text/css" rel="stylesheet" media="all" href="css/estils.css" />
        <!--FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:300,400,500,700' rel='stylesheet' type='text/css'>
            <script type="text/javascript">
               
                function generar_calendari(mes, any, ruta, quant_a, quant_b, quant_c)
                {
                    var agenda = $("#agenda");
                    agenda.html("<img src='img/loading.gif'>");
                    $.ajax({
                        type: "GET",
                        url: "calendari_user.php",
                        cache: false,
                        data: {mes: mes, any: any, ruta: ruta, quant_a: quant_a, quant_b: quant_b, quant_c: quant_c, accion: "generar_calendari"}
                    }).done(function(resposta)
                    {
                        agenda.html(resposta);
                        $(".eventb").css("background-color", "greenyellow");

                        $(".eventa").on("click", function(e) {
                            var iddata1 = $(e.target).attr("id");
                            var diesruta = $(".calendari").attr("id");
                            switch (diesruta) {
                                case "rua":
                                    var diesruta2 = 2;
                                    break;
                                case "rub":
                                    diesruta2 = 4;
                                    break;
                                case "ruc":
                                    diesruta2 = 7;
                                    break;
                            }
                            var iddata2 = iddata1.replace("-", "/").replace("-", "/");
                            iddata2 = new Date(iddata2);
                            var arrayselec = new Array();
                            var q = 0;
                            for (r = 0; r < diesruta2; r++) {
                                iddata2.setDate(iddata2.getDate() + q);
                                var any = iddata2.getFullYear();
                                var mes = iddata2.getMonth() + 1;
                                var dia = iddata2.getDate();
                                var z = "0";
                                if (mes.toString().length < 2) {
                                    mes = z.concat(mes);
                                }
                                if (dia.toString().length < 2) {
                                    dia = z.concat(dia);
                                }
                                any.toString();
                                var g = "-";
                                var iddata4 = any + g + mes + g + dia;
                                arrayselec.push(iddata4);
                                q = 1;
                            }
                            var nodes = $.map(arrayselec, function(i) {
                                return document.getElementById(i)
                            });

                            $(".eventa,.capevent").removeClass("borders");
                            $(nodes).addClass("borders");

                            // agafo la data del dia clicat
                            window.data_iniciu = this.id;
                            var str = window.data_iniciu; 
                            var any = str.slice(0,4);
                            var mes = str.slice(5,7);
                            var dia = str.slice(8,10);
                            window.data_inici = dia+"-"+mes+"-"+any;
                            alert(data_inici);
                        });

                        $('a.modal').bind("click", function(e)
                        {
                            e.preventDefault();
                        });

                        $(".anterior,.siguiente").bind("click", function(e)
                        {
                            e.preventDefault();
                            var datos = $(this).attr("rel");
                            var nova_data = datos.split("-");
                            window.any = nova_data[0];
                            window.mes = nova_data[1];
                            generar_calendari(nova_data[1], nova_data[0], ruta, quant_a, quant_b, quant_c);
                        });

                        $(window).resize(function()
                        {
                            var box = $('#boxes .window');
                            var maskHeight = $(document).height();
                            var maskWidth = $(window).width();
                            $('#mask').css({'width': maskWidth, 'height': maskHeight});
                            var winH = $(window).height();
                            var winW = $(window).width();
                            box.css('top', winH / 2 - box.height() / 2);
                            box.css('left', winW / 2 - box.width() / 2);
                        });
                    });
                }

                window.mes = "<?php if (isset($_GET["mes"])) echo $_GET["mes"]; ?>";
                window.any = "<?php if (isset($_GET["any"])) echo $_GET["any"]; ?>";

                $(document).ready(function()
                {
                    window.ruta = localStorage.getItem("rutas");
                    window.quant_a = localStorage.getItem("caiakA");
                    window.quant_b = localStorage.getItem("caiacB");
                    window.quant_c = localStorage.getItem("caiacC");
                    generar_calendari(window.mes, window.any, window.ruta, window.quant_a, window.quant_b, window.quant_c);

                    $("#consulta").click(function() {
                        if ($('#ruta').val() == "0") {
                            alert('Escull una ruta!');
                        } else if ($('#num_cay_a').val() == "0" && $('#num_cay_b').val() == "0" && $('#num_cay_c').val() == "0") {
                            alert('Cal que especifiquis la quantitat de cayacs per fer la consulta');
                        } else {
                            window.ruta = $('#ruta').val();
                            window.quant_a = $('#num_cay_a').val();
                            window.quant_b = $('#num_cay_b').val();
                            window.quant_c = $('#num_cay_c').val();
                            generar_calendari(window.mes, window.any, window.ruta, window.quant_a, window.quant_b, window.quant_c);

                        }
                    });


                });
            </script>
    </head>
    <body>
        <div id="container">
            <!--header-->
            <?php include 'includes/header.php'; ?>
            <div class="passos_2">
                <div class="header_t">
                    <script> document.write(localStorage.getItem("nom"));</script>   <?php echo TITOL_PAS2; ?>
                </div>

                <div id="info_cayaks">
                    <?php echo USER_CAI; ?>
                    <script>
                                    

                        if (localStorage.getItem("caiakA") != null & localStorage.getItem("caiakA") != "nulo") {
                            document.write(localStorage.getItem("caiakA"));
                            document.write(' caiac LASER ');
                        };

                        if (localStorage.getItem("caiacB") != null & localStorage.getItem("caiacB") != "nulo") {
                            document.write(localStorage.getItem("caiacB"));
                            document.write(' caiac ATLANTIS ');
                        };

                        if (localStorage.getItem("caiacC") != null & localStorage.getItem("caiacC") != "nulo") {
                            document.write(localStorage.getItem("caiacC"));
                            document.write(' caiac VULCANO ');
                        };

                    </script>
                </div>
                <div id="agenda"></div>

                <div id="goto2">

                    <a href="reserva_pas1.php"><div id="botoAnt">
                            <?php echo ANTERIOR; ?> <br>
                                <?php echo TRIAR; ?>
                        </div></a>
                    <!--                    <a href="reserva_pas2.php"><div id="boto">-->
                    <a onClick="comprovador();"><div id="boto">
                            <?php echo SEGUENT; ?> <br>
                                <?php echo DADES_PERSONALS; ?>
                        </div></a>

                </div>
                <div id="messages3"></div>
                <div id="mask"></div>
            </div>
        </div>
        <br/><br/></body>
    <script>

                        function comprovador() {
                            if (window.data_inici != null) {
                                localStorage.setItem("datainici", window.data_inici);
                                window.location.href = 'http://localhost/transbrava/reserva_pas3.php';
                            } else {
                                document.getElementById("messages3").style.display = "block";
                                document.getElementById("messages3").innerHTML = " <?php echo ALERTA_2; ?>";
                            }
                        }
    </script>
</html>

