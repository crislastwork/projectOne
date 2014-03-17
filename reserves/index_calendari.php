<!--

  @author Cristina Alemany de Puig <adp.cris@gmail.com> 
  @version 1.0
  
 -->

<?php
error_reporting(-1);
require_once("config.inc.php");
session_start();
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
        echo '<p align="right">Benvingut Josep! <a href ="logout.php"><input type="button" id="logout" value="Log out"/></a><p>';
} else {
    session_destroy();
    header('Location: index_admin.php');
}
?>
 <!DOCTYPE html>
 <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
            <title>Calendari Transbrava</title>
            <!-- Els dos meta seguents serveixen per prevenir el sistema de caché i es carregui cada vegada! -->
            <meta http-equiv="PRAGMA" content="NO-CACHE" />
            <meta http-equiv="EXPIRES" content="-1" />
            <script src="js/jquery-1.9.0.min.js"></script>
            <link type="text/css" rel="stylesheet" media="all" href="css/estils.css" />

            <script type="text/javascript">
                function generar_calendari(mes, any, ruta, quant_a, quant_b, quant_c)
                {
                    var agenda = $("#agenda");
                    agenda.html("<img src='images/loading.gif'>");
                    $.ajax({
                        type: "GET",
                        url: "calendari_doble.php",
                        cache: false,
                        data: {mes: mes, any: any, ruta: ruta, quant_a: quant_a, quant_b: quant_b, quant_c: quant_c, accion: "generar_calendari"}
                    }).done(function(resposta)
                    {
                        agenda.html(resposta);
                        if (window.ruta != "admin"){
                            $(".eventb").css("background-color","greenyellow","important");
                        }
                        $('a.modal').bind("click", function(e)
                        {
                            e.preventDefault();
                            var id = $(this).data('event');
                            var data = $(this).attr('rel');
                            if (data != "")
                            {
                                $("#event_data").val(data);
                                $("#que_dia").html(data);
                            }
                            var maskHeight = $(document).height();
                            var maskWidth = $(window).width();

                            $('#mask').css({'width': maskWidth, 'height': maskHeight});

                            $('#mask').fadeIn(1000);
                            $('#mask').fadeTo("slow", 0.8);

                            var winH = $(window).height();
                            var winW = $(window).width();

                            $(id).css('top', winH / 2 - $(id).height() / 2);
                            $(id).css('left', winW / 2 - $(id).width() / 2);

                            $(id).fadeIn(200);

                        });

                        $('.close').bind("click", function(e)
                        {
//                            var data = $(this).attr("rel");
//                            var nova_data = data.split("-");
                            e.preventDefault();
                            $('#mask').hide();
                            $('.window').hide();
//                            generar_calendari(nova_data[1], nova_data[0], ruta, quant_a, quant_b, quant_c);
                        });

                        //guardar event
//				$('.enviar').bind("click",function (e) 
//				{
//					e.preventDefault();
//					$("#resposta_form").html("<img src='images/loading.gif'>");
//					var event=$("#event_titulo").val();
//					var data=$("#event_data").val();
//					$.ajax({
//						type: "GET",
//						url: "calendari_doble.php",
//						cache: false,
//						data: { event:event,data:data,accion:"guardar_event" }
//					}).done(function( resposta2 ) 
//					{
//						$("#resposta_form").html(resposta2);
//						var event=$("#event_titulo").val("");
//					});
//				});

                        //eliminar event
//				$('.eliminar_event').bind("click",function (e) 
//				{
//					e.preventDefault();
//					var current_p=$(this);
//					$(".resposta").html("<img src='images/loading.gif'>");
//					var id=$(this).attr("rel");
//					$.ajax({
//						type: "GET",
//						url: "calendari_doble.php",
//						cache: false,
//						data: { id:id,accion:"borrar_event" }
//					}).done(function( resposta2 ) 
//					{
//						$(".resposta").html(resposta2);
//						current_p.parent("p").fadeOut();
//					});
//				});

                        $(".anterior,.siguiente").bind("click", function(e)
                        {
                            e.preventDefault();
                            var datos = $(this).attr("rel");
                            var nova_data = datos.split("-");
                            window.any = nova_data[0];
                            window.mes =nova_data[1];
                            generar_calendari(nova_data[1], nova_data[0],ruta, quant_a, quant_b, quant_c);
                        })

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

                    window.ruta = null;    
                    $(".num_cay").hide();
                    $("#rutes").change(function(){
                        window.ruta = $(this).val();
                        /* Generem el calendari amb la data d'avui */
                        if ($(this).val() != "admin"){
                            $(".num_cay").show();
                        } else {
                            $(".num_cay").hide();
                                generar_calendari(window.mes, window.any, window.ruta, window.quant_a, window.quant_b, window.quant_c);                
                            
                         }
                    }).trigger("change");
                    $("#consulta").click(function(){
                         window.quant_a = $('#num_cay_a').val();
                         window.quant_b = $('#num_cay_b').val();
                         window.quant_c = $('#num_cay_c').val();
                         generar_calendari(window.mes, window.any, window.ruta, window.quant_a, window.quant_b, window.quant_c);   
                     });
                    setTimeout(function() {
                        $('#mensaje').fadeOut('fast');
                    }, 3000);

                    // marca per defecte el radio button afegir
                    $('#afegir').attr('checked', true);

                });
            </script>
    </head>
    <body>
        <div id="calendaris">
            <select id="rutes">
                <option selected="selected" id="admin" name="rutes" value="admin">Administrador</option>
                <option id="ruta_a" name="rutes"  value="ruta_a">Ruta Descoberta</option>
                <option id="ruta_b" name="rutes"  value="ruta_b">Ruta Transbrava</option>
                <option id="ruta_c" name="rutes"  value="ruta_c">Ruta Ultrabrava</option>
            </select>
            <select class="num_cay" id="num_cay_a">
                <option>Cayacs A</option>
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
            <select class="num_cay" id="num_cay_b">
                <option>Cayacs B</option>
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
            <select class="num_cay" id="num_cay_c">
                <option>Cayacs A</option>
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
            <input type="button" class="num_cay" id="consulta" value="Consulta"/>
        </div>
        <div id="agenda"></div>
        <div id="mask"></div>
        <div id="formulari">   
            <form action="#" method="POST">
                <br/><br/>
                Dia d'inici:<br/><input type="date" name="dia_inici"/><br/>
                Dia final:<br/><input type="date" name="dia_final"/><br/><br/>

                Quantitat cayacs A:<br/><input type="number" name="cayac_a"/><br/>
                Quantitat cayacs B:<br/><input type="number" name="cayac_b"/><br/>
                Quantitat cayacs C:<br/><input type="number" name="cayac_c"/><br/><br/>

                <input type="radio" id="afegir" name="radio_status" value="afegeix"/>Afegeix
                <input type="radio" id="modificar" name="radio_status" value="modifica"/>Modifica
                <input type="radio" id="llog_afegir" name="radio_status" value="llog_afegeix"/>Afegeix Llogats
                <input type="radio" id="llog_modificar" name="radio_status" value="llog_modifica"/>Modifica Llogats<br/>
                <input type="submit" name=submit value="Desa"/>
            </form>
        </div>

<?php
if (isset($_POST['submit']) && !empty($_POST['dia_inici']) && !empty($_POST['dia_final'])) {
    require("querys_BD.php");
}
?><br/><br/></body>
 </html>

