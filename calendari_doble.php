<?php
/**
 * @author Cristina Alemany de Puig <adp.cris@gmail.com>
 * @version 1.0 
 * 
 */

error_reporting(-1);
require_once("config.inc.php");
include 'querys_BD.php';

function data($valor)
{
    $timer = explode(" ",$valor);
    $data = explode("-",$timer[0]);
    $fechex = $data[2]."/".$data[1]."/".$data[0];
    return $fechex;
}

function buscar_en_array($data,$array)
{
    $total_events=count($array);
    for($e=0;$e<$total_events;$e++)
    {
    	if ($array[$e]["data"]==$data) return true;
    }
}

function buscar_tipus_event($data_avui,$array) {
    
    foreach ($array as $nevent) {
        if ($nevent["data"] == $data_avui) {
            if ($nevent["llogatsa"] + $nevent["llogatsb"] + $nevent["llogatsc"] === 0) {
                $t = "a";
                return $t;
            } else if ($nevent["llogatsa"] + $nevent["llogatsb"] + $nevent["llogatsc"] > 0 &&
              $nevent["llogatsa"] + $nevent["llogatsb"] + $nevent["llogatsc"] != $nevent["cayaca"] + $nevent["cayacb"] + $nevent["cayacc"]) {
                $t = "b";
                return $t;
             } else {
                $t = "c";
                return $t;
             }
        }
    }
}

switch ($_GET["accion"])
{
//    case "guardar_event":
//    {
//        $query="insert into tcalendari (data,event) values ('".$_GET["data"]."','".strip_tags($_GET["event"])."')";
//	mysql_select_db($dbname);
//	if ($resultado=mysql_query($query)) echo "<p class='ok'>Evento guardado correctamente.</p>";
//	else echo "<p class='error'>Se ha producido un error guardando el event.</p>";
//	break;
//    }
//    case "borrar_event":
//    {
//        $query="delete from tcalendari where id='".$_GET["id"]."' limit 1";
//	mysql_select_db($dbname);
//	if ($resultado=mysql_query($query)) echo "<p class='ok'>Evento eliminado correctamente.</p>";
//	else echo "<p class='error'>Se ha producido un error eliminando el event.</p>";
//	break;
//    }
    case "generar_calendari":
    {
    	$data_calendari=array();
        $data_calendari2 =array();
        if ($_GET["mes"]=="" || $_GET["any"]=="") 
        {
            $data_calendari[1]=intval(date("m"));
            $data_calendari2[1]=intval(date("m")+1);
            
            if ($data_calendari[1]<10) $data_calendari[1]="0".$data_calendari[1]; 
            if ($data_calendari2[1]<10) $data_calendari2[1]="0".$data_calendari2[1];
            
            $data_calendari[0]=date("Y");
            if ($data_calendari[1]==12) $data_calendari2[0]=date("Y")+1;
            else $data_calendari2[0]=date("Y");
            }
	else 
	{
            $data_calendari[1]=intval($_GET["mes"]);
            if ($data_calendari[1]==12) $data_calendari2[1]=1;
            else $data_calendari2[1]=intval($_GET["mes"])+1;
            
            if ($data_calendari[1]<10) $data_calendari[1]="0".$data_calendari[1];
            if ($data_calendari2[1]<10) $data_calendari2[1]="0".$data_calendari2[1];
            
            $data_calendari[0]=intval($_GET["any"]);
            if ($data_calendari[1]==12) $data_calendari2[0]=intval($_GET["any"])+1;
            else $data_calendari2[0]=intval($_GET["any"]);
	}
	$data_calendari[2]="01";
        $data_calendari2[2]="01";
	
	/* Obtenim el dia de la setmana del 1 del mes actual */
	$primeromes=date("N",mktime(0,0,0,$data_calendari[1],1,$data_calendari[0]));
        $primeromes2=date("N",mktime(0,0,0,$data_calendari2[1],1,$data_calendari2[0]));
		
	/* Comprovem si l'any es de traspàs i creem l'array de dies */
	if (($data_calendari[0] % 4 == 0) && (($data_calendari[0] % 100 != 0) || ($data_calendari[0] % 400 == 0))) $dies=array("","31","29","31","30","31","30","31","31","30","31","30","31");
	else $dies=array("","31","28","31","30","31","30","31","31","30","31","30","31");
		
        $rut = new Rutes();
        
        switch ($_GET["ruta"]) {

            case "admin":
                $events = $rut->disp_admin();
                break;
            
            case "ruta_a":
                $quant_a  = $_GET["quant_a"];
                $quant_b  = $_GET["quant_b"];
                $quant_c  = $_GET["quant_c"];
                $events = $rut->disp_ruta_a($quant_a, $quant_b, $quant_c);
                break;
            
            case "ruta_b":
                $quant_a  = $_GET["quant_a"];
                $quant_b  = $_GET["quant_b"];
                $quant_c  = $_GET["quant_c"];
                $dies_ruta = 4;
                $events = $rut->disp_ruta_b($quant_a, $quant_b, $quant_c, $dies_ruta);
                break;
            
            case "ruta_c":
                $quant_a  = $_GET["quant_a"];
                $quant_b  = $_GET["quant_b"];
                $quant_c  = $_GET["quant_c"];
                $dies_ruta = 7;
                $events = $rut->disp_ruta_b($quant_a, $quant_b, $quant_c, $dies_ruta);
                break;
        }

	$meses=array("","Gener","Febrer","Març","Abril","Maig","Juny","Juliol","Agost","Setembre","Octubre","Novembre","Desembre");
		
	/* Calculem els dies de la setmana anterior al dia 1 del mes en curs */
	$diesabans=$primeromes-1;
        $diesabans2=$primeromes2-1;
			
	/* Els dies totals de la taula sempre son màxim 42 (7 x 6 files) */
	$diesdespres=42;
			
	/* Calculem les files de la taula */
	$tope=$dies[intval($data_calendari[1])]+$diesabans;
	if ($tope%7!=0) $totalfilas=intval(($tope/7)+1);
	else $totalfilas=intval(($tope/7));
        
        $tope2=$dies[intval($data_calendari2[1])]+$diesabans2;
	if ($tope2%7!=0) $totalfilas2=intval(($tope2/7)+1);
	else $totalfilas2=intval(($tope2/7));
			
	/* Printem la taula */
	echo "<h2>Calendari TRANSBRAVA: ".$meses[intval($data_calendari[1])]." de ".$data_calendari[0]."</h2>";
	if (isset($mostrar)) echo $mostrar;
			
	echo "<table class='calendari' cellspacing='0' cellpadding='0'>";
	echo "<tr><th>Dilluns</th><th>Dimarts</th><th>Dimecres</th><th>Dijous</th><th>Divendres</th><th>Dissabte</th><th>Diumenge</th></tr><tr>";
	
	/* Inici de les files */
	$tr=0;
	$dia=1;
		
	for ($i=1;$i<=$diesdespres;$i++)
	{
            if ($tr<$totalfilas)
            {
                if ($i>=$primeromes && $i<=$tope) 
                {
                    echo "<td class='";
                    /* Creem la data completa */
                    if ($dia<10) $dia_actual="0".$dia; else $dia_actual=$dia;
                    $data_completa=$data_calendari[0]."-".$data_calendari[1]."-".$dia_actual;				
                    
                    if (count($events)>0 && buscar_en_array($data_completa,$events)==true) echo "event"; else echo "capevent";
                    /*  cris aqui afegim tipus d'event!! */
                    echo buscar_tipus_event($data_completa, $events);      
                    /* cris aqui fem algun canvi ojooo*/
                    /* Posem nom de classe al dia d'avui */
                    if (date("Y-m-d")==$data_completa) {echo " hoy";}
                    else if (date("Y-m-d")<$data_completa) {echo " futur";} /* cris aquesta linia es l'afegida  */
					
                    echo "'>";
						
                    /* Recorrem l'array per saber els events del dia */
                    $total_events=count($events);
                    $events_del_dia="";
                    for($e=0;$e<$total_events;$e++)
                    {
                        if ($events[$e]["data"]==$data_completa) 
                        {
                        $events_del_dia.="<p> Hi ha ".$events[$e]["dispa"]." cayacs A disponibles. <a href='#' class='eliminar_event' rel='".$events[$e]["id"]."' /></a></p>";
                        $events_del_dia.="<p> Hi ha ".$events[$e]["dispb"]." cayacs B disponibles.<a href='#' class='eliminar_event' rel='".$events[$e]["id"]."' /></a></p>";
                        $events_del_dia.="<p> Hi ha ".$events[$e]["dispc"]." cayacs C disponibles.<a href='#' class='eliminar_event' rel='".$events[$e]["id"]."' /></a></p>";
                        }
                    }
                    if ($events_del_dia!="")
                    {
                        echo "<a href='#' data-event='#event".$dia_actual."' class='modal' rel='".$data_completa."'>".$dia."</a><div class='window' id='event".$dia_actual."'>";
                        echo "<h2>Sumari pel dia ".data($data_completa)."</h2><a href='#' class='close' rel='".$data_completa."'>Tanca</a><div class='resposta'></div>";
                        echo $events_del_dia;
                        echo "</div>";
                    }
                    else echo "$dia";
                    echo "</td>";
                    $dia+=1;
                }
                else echo "<td class='desactivada'>&nbsp;</td>";
                if ($i==7 || $i==14 || $i==21 || $i==28 || $i==35 || $i==42) {echo "<tr>";$tr+=1;}
            }

        }
	echo "</table>";
        
        /* Printem la taula2 */
	echo "<h2>Calendari TRANSBRAVA: ".$meses[intval($data_calendari2[1])]." de ".$data_calendari2[0]."</h2>";
	if (isset($mostrar)) echo $mostrar;
			
	echo "<table class='calendari' cellspacing='0' cellpadding='0'>";
	echo "<tr><th>Dilluns</th><th>Dimarts</th><th>Dimecres</th><th>Dijous</th><th>Divendres</th><th>Dissabte</th><th>Diumenge</th></tr><tr>";
	
	/* Inici de les files */
	$tr=0;
	$dia=1;
		
	for ($i=1;$i<=$diesdespres;$i++)
	{
            if ($tr<$totalfilas2)
            {
                if ($i>=$primeromes2 && $i<=$tope2) 
                {
                    echo "<td class='";
                    /* Creem la data completa */
                    if ($dia<10) $dia_actual="0".$dia; else $dia_actual=$dia;
                    $data_completa=$data_calendari2[0]."-".$data_calendari2[1]."-".$dia_actual;				
                    
                    if (count($events)>0 && buscar_en_array($data_completa,$events)==true) echo "event"; else echo "capevent";
                    /*  cris aqui afegim tipus d'event!! */
                    echo buscar_tipus_event($data_completa, $events);      
                    /* cris aqui fem algun canvi ojooo*/
                    /* Posem nom de classe al dia d'avui */
                    if (date("Y-m-d")==$data_completa) {echo " hoy";}
                    else if (date("Y-m-d")<$data_completa) {echo " futur";} /* cris aquesta linia es l'afegida  */
					
                    echo "'>";
						
                    /* Recorrem l'array per saber els events del dia */
                    $total_events=count($events);
                    $events_del_dia="";
                    for($e=0;$e<$total_events;$e++)
                    {
                        if ($events[$e]["data"]==$data_completa) 
                        {
                        $events_del_dia.="<p> Hi ha ".$events[$e]["dispa"]." cayacs A disponibles. <a href='#' class='eliminar_event' rel='".$events[$e]["id"]."' /></a></p>";
                        $events_del_dia.="<p> Hi ha ".$events[$e]["dispb"]." cayacs B disponibles.<a href='#' class='eliminar_event' rel='".$events[$e]["id"]."' /></a></p>";
                        $events_del_dia.="<p> Hi ha ".$events[$e]["dispc"]." cayacs C disponibles.<a href='#' class='eliminar_event' rel='".$events[$e]["id"]."' /></a></p>";
                        }
                    }
                    if ($events_del_dia!="")
                    {
                        echo "<a href='#' data-event='#event".$dia_actual."' class='modal' rel='".$data_completa."'>".$dia."</a><div class='window' id='event".$dia_actual."'>";
                        echo "<h2>Sumari pel dia ".data($data_completa)."</h2><a href='#' class='close' rel='".$data_completa."'>Tanca</a><div class='resposta'></div>";
                        echo $events_del_dia;
                        echo "</div>";
                    }
                    else echo "$dia";
                    echo "</td>";
                    $dia+=1;
                }
                else echo "<td class='desactivada'>&nbsp;</td>";
                if ($i==7 || $i==14 || $i==21 || $i==28 || $i==35 || $i==42) {echo "<tr>";$tr+=1;}
            }

        }
	echo "</table>";
			
	$mesanterior=date("Y-m-d",mktime(0,0,0,$data_calendari[1]-1,01,$data_calendari[0]));
	$messiguiente=date("Y-m-d",mktime(0,0,0,$data_calendari[1]+1,01,$data_calendari[0]));
	echo "<p> &laquo; <a href='#' rel='$mesanterior' class='anterior'>Anterior</a> - <a href='#' class='siguiente' rel='$messiguiente'>Següent</a> &raquo;</p>";
	break;
    }
}
?>
