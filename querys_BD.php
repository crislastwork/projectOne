<?php
/**
 * @author Cristina Alemany de Puig <adp.cris@gmail.com> 
 * @version 1.0
 * 
 */
require_once("config.inc.php");

Class Registre {

    // declarem els atributs
    private $dia_inici;
    private $dia_final;
    private $cayacs_a = 0;
    private $cayacs_b = 0;
    private $cayacs_c = 0;
    private $dies = 0;
    private $ids = array();
    private $data_ids = array();
    
    /**
     * @descripció: Guarda totes les dades del form i passa les dates a dormat
     * date('Y-m-d').
     * @param string $dia_ini: dia d'inici de la consulta.
     * @param string $dia_fin: dia final de la consulta.
     * @param numèric o string $cay_a: quantitat de cayacs tipus a.
     * @param numèric o string $cay_b: quantitat de cayacs tipus b.
     * @param numèric o string $cay_c: quantitat de cayacs tipus c.
     * 
     */
    public function __construct($dia_ini, $dia_fin, $cay_a, $cay_b, $cay_c) {

        // omplo els atributs de la classe
        $this->dia_inici = new DateTime($dia_ini);
        $this->dia_final = new DateTime($dia_fin);
        $this->cayacs_a = $cay_a;
        $this->cayacs_b = $cay_b;
        $this->cayacs_c = $cay_c;
    }
    
    /**
     * @descripció: comprova que la primera data sigui menor a la segona,
     *              calcula l'interval en dies del període, crea les dates i ids 
     *              de tots els registres i els omple en dues arrays.
     * @return boolean: retorna false si la primera data és major a la segona, si 
     *              no, fa tot el procés i retorna true. 
     */
    public function dates() {

        // comprovem que la primera data és menor que la segona
        if ($this->dia_inici > $this->dia_final) {
            return false;
        }

        // calculem els dies que hi ha entre la data inicial i la final
        $interval = $this->dia_inici->diff($this->dia_final);
        $this->dies = $interval->days;
        $this->dies;

        // poso el count a 0 perquè s'imprimeixi la primera data dins el for
        $count = 0;
        // fem un for de tantes vegades com dies tingui la consulta
        for ($i = 0; $i <= $this->dies; $i++) {
            // sumo un dia per cada loop (en el primer el count està a zero)
            $suma_date = date_add($this->dia_inici, date_interval_create_from_date_string($count . ' days'));
            $count = 1;
            // el passo en format string
            $data_id_prev = date_format($suma_date, 'Y-m-d');
            //omplim l'array de dates
            array_push($this->data_ids,$data_id_prev);
            // treiem els guionets
            $id = str_replace('-', '', $data_id_prev);
            // omplim l'array de ids
            array_push($this->ids,$id);
        }
        return true;
    }
    
    /**
     * @descripció: retorna l'array amb els ids dels registres de la consulta
     * @return array: amb els ids dels registres 
     */
    public function getIds() {
        return $this->ids;
    }
    
    /**
     * @descripció: retorna el número de cayacs tipus A del form
     * @return type: numèric o string
     */
    public function getCayacA() {
        return $this->cayacs_a;
    }
    
    /**
     * @descripció: retorna el número de cayacs tipus B del form
     * @return type: numèric o string
     */
    public function getCayacB() {
        return $this->cayacs_b;
    }
    
    /**
     * @descripció: retorna el número de cayacs tipus C del form
     * @return type: numèric o string
     */
    public function getCayacC() {
        return $this->cayacs_c;
    }
    
    /**
     * @descripció: retorna les dates del període en format ('Y-m-d')
     * @return type: array amb les dates dels registres
     */
    public function getData() {
        return $this->data_ids;
    }
    
    /**
     * @descripició: fa un reset dels atributs de la classe
     */
    public function resetDades() {

        // buido les dades
        $this->dia_inici = 0;
        $this->dia_final = 0;
        $this->cayacs_a = 0;
        $this->cayacs_b = 0;
        $this->cayacs_c = 0;
        $this->ids = array();
        $this->data_ids = array();
    }
}

Class Servei_Registre {
    
    private $consulta_BD = array();
    private $consulta_disp = array();
    private $count_inserts = 0;
    private $count_updates = 0;
    private $count_registres = 0;
    
    /**
     * @descripció: Crea nous registres o suma les quantitats al registres existents
     *              a la taula cayacs camps cayaca, cayacb i cayacc (crida els 
     *              mètodes insert_dades o update_dades).
     * @param objecte $registre: conté les dades del objecte Class Registre.
     * @return: missatge d'error en cas que la consulta no tingui èxit.
     * 
     */   
    public function comprova_registre($registre) {
    
        // cridem la funcio getIds i la guardem en una variable
        $ids = $registre->getIds();
        // calculem quants inserts o updates hi hauran
        $this->count_registres = count($ids);
        //comprovem que el id no existeix
        for ($i=0;$i<count($ids);$i++) {
            // fem la consulta a base de dades
            $query_consulta_id = "select cayaca,cayacb,cayacc,llogatsa,llogatsb,llogatsc,data from
                      cayacs where id='" . $ids[$i] . "'";
            mysql_select_db($GLOBALS['dbname']);
            $resultat_consulta = mysql_query($query_consulta_id);
            $this->consulta_BD = mysql_fetch_array($resultat_consulta);
                // enviem missatges d'error si no funca
                if (!$resultat_consulta) {
                    echo 'Hi ha hagut un error consultant les dades.'; 
                    exit();
                } else {
                    if (mysql_num_rows($resultat_consulta) == 0 ) {
                        // si no són reserves crearem nous registres
                        $this->insert_dades($registre, $i);
                    } else {
                        $this->update_dades($registre, $i);
                    }
                }
        }
    }
    
    /**
     * @descripció: fa la query que inserta els nous registres a la taula cayacs,
     *              en defineix l'id, la quantitat de cayacs A, B i C i la data. 
     * @param objecte $registre: conté les dades del objecte Class Registre.
     * @param numèric $i: conté el número de la iteració de la consulta.
     */
    private function insert_dades($registre, $i) {
        
        //agafem les dades
        $ids = $registre->getIds();
        $cayac_a = $registre->getCayacA();
        $cayac_b = $registre->getCayacB();
        $cayac_c = $registre->getCayacC();
        $data_ids = $registre->getData();
        // fem l'insert a base de dades
        $query_insert = "insert into cayacs (id,cayaca,cayacb,cayacc,data) values ('$ids[$i]',
                        '$cayac_a','$cayac_b','$cayac_c','$data_ids[$i]')";
        mysql_select_db($GLOBALS['dbname']);
        $resultat_insert = mysql_query($query_insert);
        // avisa a la funcio any_insert que ha rebut una petició
        $this->any_insert();
   }
   
   /**
    * @descripció: fa la query que updata els registres existents a la taula cayacs,
    *              suma la quantitat de cayacs A, B i C que l'usuari determina. 
    * @param objecte $registre: conté les dades del objecte Class Registre.
    * @param numèric $i: conté el número de la iteració de la consulta.
    */
   private function update_dades($registre, $i) {
        
        //agafem les dades
        $ids = $registre->getIds();
        $cayac_a = $registre->getCayacA();
        $cayac_b = $registre->getCayacB();
        $cayac_c = $registre->getCayacC();
        // fem l'update a base de dades
        $query_update = "update cayacs set cayaca=cayaca+'" . $cayac_a . "',
                        cayacb=cayacb+'" . $cayac_b . "',cayacc=cayacc+'"
                        . $cayac_c . "' where id='" . $ids[$i] . "'";
        mysql_select_db($GLOBALS['dbname']);
        $resultat_update = mysql_query($query_update);
        // avisa a la funcio any_update que ha rebut una petició
        $this->any_update();
    }
    
    /**
     * @descripció: fa la query que updata els registres existents a la taula cayacs,
     *              defineix la nova quantitat de cayacs A, B i C que l'usuari determina. 
     * @param objecte $registre: conté les dades del objecte Class Registre.
     */
    public function reescriu_dades($registre) {
        
        //agafem les dades
        $ids = $registre->getIds();
        // calculem quants inserts o updates hi hauran
        $this->count_registres = count($ids);
        $cay_a = $registre->getCayacA();
        $cay_b = $registre->getCayacB();
        $cay_c = $registre->getCayacC();
        // comprovem que les variables no estiguin buides
        if (is_numeric($cay_a)) {
            $cayac_a = "cayaca='" . $cay_a . "',";
        } else {
            $cayac_a = "cayaca=cayaca,";
        }
        if (is_numeric($cay_b)) {
            $cayac_b = "cayacb='" . $cay_b . "',";
        } else {
            $cayac_b = "cayacb=cayacb,";
        }
        if (is_numeric($cay_c)) {
            $cayac_c = "cayacc='" . $cay_c . "'";
        } else {
            $cayac_c = "cayacc=cayacc";
        }
        // reescriu la base de dades
        for ($i=0;$i<count($ids);$i++) {
            
            $query_reescriu = "update cayacs set ".$cayac_a." ".$cayac_b." ".$cayac_c."
                        where id='" . $ids[$i] . "'";
            mysql_select_db($GLOBALS['dbname']);
            $resultat_reescriu = mysql_query($query_reescriu);
            // avisa a la funcio any_update que ha rebut una petició
            $this->any_update();
        }
    }
    
    /**
     * @descripció: fa la query que updata els registres existents a la taula cayacs,
     *              suma la quantitat de cayacs llogats A, B i C que l'usuari determina. 
     * @param objecte $registre: conté les dades del objecte Class Registre.
     */
    public function update_llogats($registre) {
        
        //agafem les dades
        $ids = $registre->getIds();
        // calculem quants inserts o updates hi hauran
        $this->count_registres = count($ids);
        $cayac_a = $registre->getCayacA();
        $cayac_b = $registre->getCayacB();
        $cayac_c = $registre->getCayacC();
        // fem l'update a base de dades
        for ($i=0;$i<count($ids);$i++) {
            $query_update_llog = "update cayacs set llogatsa=llogatsa+'" . $cayac_a . "',
                            llogatsb=llogatsb+'" . $cayac_b . "',llogatsc=llogatsc+'"
                            . $cayac_c . "' where id='" . $ids[$i] . "'";
                mysql_select_db($GLOBALS['dbname']);
                $resultat_update_llog = mysql_query($query_update_llog);
                // avisa a la funcio any_update que ha rebut una petició
                $this->any_update();
        }
    }
    
    /**
     * @descripció: fa la query que updata els registres existents a la taula cayacs,
     *              defineix la nova quantitat de cayacs llogats A, B i C que l'usuari 
     *              determina. 
     * @param objecte $registre: conté les dades del objecte Class Registre.
     */
    public function reescriu_llogats($registre) {
        
        //agafem les dades
        $ids = $registre->getIds();
        // calculem quants inserts o updates hi hauran
        $this->count_registres = count($ids);
        $cay_a = $registre->getCayacA();
        $cay_b = $registre->getCayacB();
        $cay_c = $registre->getCayacC();
        if (is_numeric($cay_a)) {
            $cayac_a = "llogatsa='" . $cay_a . "',";
        } else {
            $cayac_a = "llogatsa=llogatsa,";
        }
        if (is_numeric($cay_b)) {
            $cayac_b = "llogatsb='" . $cay_b . "',";
        } else {
            $cayac_b = "llogatsb=llogatsb,";
        }
        if (is_numeric($cay_c)) {
            $cayac_c = "llogatsc='" . $cay_c . "'";
        } else {
            $cayac_c = "llogatsc=llogatsc";
        }
        for ($i=0;$i<count($ids);$i++) {
            // reescriu la base de dades
            $query_reescriu_llog = "update cayacs set ".$cayac_a." ".$cayac_b." ".$cayac_c."
                        where id='" . $ids[$i] . "'";
            mysql_select_db($GLOBALS['dbname']);
            $resultat_reescriu_llog = mysql_query($query_reescriu_llog);
            // avisa a la funcio any_update que ha rebut una petició
            $this->any_update();
        }
    }
    

    /**
     * @descripció: comprova que al afegir (valors positius o negatius) per tant, 
     *              posar o treure cayacs n'hi hagi suficients d'acord amb els 
     *              cayacs llogats per la data. 
     * @param objecte $registre: conté les dades del objecte Class Registre.
     * @return boolean: si hi ha prou cayacs retorna true, si no missatge d'error.
     */
    public function comprova_disponibilitat1($registre) {
        $d = $registre->getData();
        $d_ini = $d[0];
        $d_fin = end($d);
        $cayac_a = $registre->getCayacA();
        $cayac_b = $registre->getCayacB();
        $cayac_c = $registre->getCayacC();
        $query_exist = "select id FROM cayacs WHERE data BETWEEN '".$d_ini."' AND '".$d_fin."'";
        mysql_select_db($GLOBALS['dbname']);
        $resultat_exist = mysql_query($query_exist);
        $id_exist = array();
        while ($row = mysql_fetch_array($resultat_exist)) {
            array_push($id_exist, $row);
        }
        $query_disp_cay = "select id FROM cayacs WHERE cayaca+".$cayac_a." >= llogatsa AND cayacb+".$cayac_b." >=
            llogatsb AND cayacc+".$cayac_c." >= llogatsc AND data BETWEEN '".$d_ini."' AND '".$d_fin."'";
        mysql_select_db($GLOBALS['dbname']);
        $resultat_disp_cay = mysql_query($query_disp_cay);
        while ($row = mysql_fetch_array($resultat_disp_cay)) {
            array_push($this->consulta_disp, $row);
        }
        if (count($this->consulta_disp) == count($id_exist)) {
            return true;
        } else {
            echo 'No hi ha prou cayacs disponibles en alguna de les dates seleccionades!';
            exit();
        }    
    }
    
    /**
     * @descripció: comprova que al modificar el nombre de cayacs n'hi hagi 
     *              suficients d'acord amb els cayacs llogats per la data. 
     * @param objecte $registre: conté les dades del objecte Class Registre.
     * @return boolean: si hi ha prou cayacs retorna true, si no missatge d'error.
     */    
    public function comprova_disponibilitat2($registre) {
        $d = $registre->getData();
        $d_ini = $d[0];
        $d_fin = end($d);
        $cayac_a = $registre->getCayacA();
        $cayac_b = $registre->getCayacB();
        $cayac_c = $registre->getCayacC();
        $query_disp_cay = "select id FROM cayacs WHERE llogatsa <= '".$cayac_a."' AND llogatsb <=
            '".$cayac_b."' AND llogatsc <= '".$cayac_c."' AND data BETWEEN '".$d_ini."' AND '".$d_fin."'";
        mysql_select_db($GLOBALS['dbname']);
        $resultat_disp2 = mysql_query($query_disp_cay);
        while ($row = mysql_fetch_array($resultat_disp2)) {
            array_push($this->consulta_disp, $row);
        }
        if (count($this->consulta_disp) == count($d)) {
            return true;
        } else {
            echo 'Impossible modificar el nombre de cayacs, no hi ha prou cayacs disponibles o el registre no existeix';
            exit();
        }       
    }
    
    /**
     * @descripció: comprova que al afegir (valors positius o negatius) per tant, 
     *              posar o treure cayacs llogats n'hi hagi suficients d'acord amb 
     *              els cayacs disponibles per la data. 
     * @param objecte $registre: conté les dades del objecte Class Registre.
     * @return boolean: si hi ha prou cayacs retorna true, si no missatge d'error.
     */     
    public function comprova_disponibilitat3($registre) {
        $d = $registre->getData();
        $d_ini = $d[0];
        $d_fin = end($d);
        $cayac_a = $registre->getCayacA();
        $cayac_b = $registre->getCayacB();
        $cayac_c = $registre->getCayacC();
        $query_disp_cay = "select id FROM cayacs WHERE cayaca-llogatsa >= '".$cayac_a."' AND cayacb-llogatsb >=
            '".$cayac_b."' AND cayacc-llogatsc >= '".$cayac_c."' AND data BETWEEN '".$d_ini."' AND '".$d_fin."'";
        mysql_select_db($GLOBALS['dbname']);
        $resultat_disp_cay = mysql_query($query_disp_cay);
        while ($row = mysql_fetch_array($resultat_disp_cay)) {
            array_push($this->consulta_disp, $row);
        }
        if (count($this->consulta_disp) == count($d)) {
            return true;
        } else {
            echo 'No hi ha prou cayacs disponibles!';
            exit();
        }    
    }
    

    /**
     * @descripció: comprova que al modificar el nombre de cayacs llogats n'hi hagi 
     *              suficients d'acord amb els cayacs disponibles per la data. 
     * @param objecte $registre: conté les dades del objecte Class Registre.
     * @return boolean: si hi ha prou cayacs retorna true, si no missatge d'error.
     */
    public function comprova_disponibilitat4($registre) {
        $d = $registre->getData();
        $d_ini = $d[0];
        $d_fin = end($d);
        $cayac_a = $registre->getCayacA();
        $cayac_b = $registre->getCayacB();
        $cayac_c = $registre->getCayacC();
        $query_disp_cay = "select id FROM cayacs WHERE cayaca >= '".$cayac_a."' AND cayacb >=
            '".$cayac_b."' AND cayacc >= '".$cayac_c."' AND data BETWEEN '".$d_ini."' AND '".$d_fin."'";
        mysql_select_db($GLOBALS['dbname']);
        $resultat_disp_llog = mysql_query($query_disp_cay);
        while ($row = mysql_fetch_array($resultat_disp_llog)) {
            array_push($this->consulta_disp, $row);
        }
        if (count($this->consulta_disp) == count($d)) {
            return true;
        } else {
            echo 'No està permés entrar més cayacs llogats dels disponibles';
            exit();
        }       
    }
       
    /**
     * @descripció: cada cop que es crida aquest mètode s'incrementa l'atribut
     *              count_insert de la classe (es crida en cada iteració que hi 
     *              ha un insert).
     */
    private function any_insert(){
        $this->count_inserts++;
    }

    /**
     * @descripció: cada cop que es crida aquest mètode s'incrementa l'atribut
     *              count_updates de la classe (es crida en cada iteració que hi 
     *              ha un update).
     */    
    private function any_update(){
        $this->count_updates++;
    }

    /**
     * @descripció: fa la suma dels contadors count_inserts i count_updates i ho 
     *              compara amb el contador de registres total count_registres 
     *              (que s'omple al inici de cada petició amb el número de dies 
     *              del període); si coincideixen ambdós valors retorna true.
     * @return boolean: retorna true si hi ha hagut un insert o update per cada 
     *              dia del període, si no retorna fals.
     */
    public function fi_iteracions() {
        if ($this->count_inserts + $this->count_updates == $this->count_registres) {
            return true;
        }
        return false;
    }
}

Class Rutes {
    
    public function disp_admin(){
        $query = "select * from cayacs where cayaca > 0 and cayacb > 0 and cayacc > 0 and data >= CURDATE()";
        mysql_select_db($GLOBALS['dbname']);
	$resultat=mysql_query($query);

            return $this->crea_events($resultat);
    }
    
    public function disp_ruta_a($quant_a, $quant_b, $quant_c){
        
        $cayac_a = $quant_a;
        $cayac_b = $quant_b;
        $cayac_c = $quant_c;
        
        $query = "select * from cayacs WHERE
        cayaca-llogatsa >= '".$cayac_a."' AND cayacb-llogatsb >= '".$cayac_b."'
        AND cayacc-llogatsc >= '".$cayac_c."' AND DATE_ADD(data, INTERVAL 1 DAY) 
            in (select data from cayacs  WHERE data > CURDATE() and 
        cayaca-llogatsa >= '".$cayac_a."' AND cayacb-llogatsb >= '".$cayac_b."' 
        AND cayacc-llogatsc >= '".$cayac_c."')";

        mysql_select_db($GLOBALS['dbname']);
        $resultat = mysql_query($query);
        
            return $this->crea_events($resultat);

    }        

    public function disp_ruta_b($quant_a, $quant_b, $quant_c, $dies) {

        $cayac_a = $quant_a;
        $cayac_b = $quant_b;
        $cayac_c = $quant_c;
        $dies_ruta = $dies;
        $stri_qu = "in (select data from cayacs WHERE
            cayaca-llogatsa >= '".$cayac_a."' AND cayacb-llogatsb >= '".$cayac_b."'
            AND cayacc-llogatsc >= '".$cayac_c."' AND DATE_ADD(data, INTERVAL 1 DAY)";
        $tanc = ")";
        $s_q = "";
        $t = "";

        for ($d=0;$d<$dies_ruta-2;$d++) {
            $s_q = $stri_qu." ".$s_q;
            $t = $tanc." ".$t;
        }

        $query = "select * from cayacs WHERE
            cayaca-llogatsa >= '".$cayac_a."' AND cayacb-llogatsb >= '".$cayac_b."'
            AND cayacc-llogatsc >= '".$cayac_c."' AND DATE_ADD(data, INTERVAL 1 DAY)
            ".$s_q."                
                in (select data from cayacs WHERE data > CURDATE() + INTERVAL (".$dies_ruta." - 2) DAY and
            cayaca-llogatsa >= '".$cayac_a."' AND cayacb-llogatsb >= '".$cayac_b."' 
            AND cayacc-llogatsc >= '".$cayac_c."' ".$t.")";
        
        mysql_select_db($GLOBALS['dbname']);
        $resultat = mysql_query($query);
        
            return $this->crea_events($resultat);      
    }
    
    private function crea_events($resultat){
         $events = array();
	if ($fila=mysql_fetch_array($resultat))
	{
            $posicio=0;
            do
            {
                $events[$posicio]["id"]=$fila["id"];
                $events[$posicio]["data"]=$fila["data"];
                $events[$posicio]["cayaca"]=$fila["cayaca"];
                $events[$posicio]["cayacb"]=$fila["cayacb"];
                $events[$posicio]["cayacc"]=$fila["cayacc"];
                $events[$posicio]["llogatsa"]=$fila["llogatsa"];
                $events[$posicio]["llogatsb"]=$fila["llogatsb"];
                $events[$posicio]["llogatsc"]=$fila["llogatsc"];
                $events[$posicio]["dispa"] = $events[$posicio]["cayaca"] - $events[$posicio]["llogatsa"];
                $events[$posicio]["dispb"] = $events[$posicio]["cayacb"] - $events[$posicio]["llogatsb"];
                $events[$posicio]["dispc"] = $events[$posicio]["cayacc"] - $events[$posicio]["llogatsc"];
                $posicio+=1;
            }
            while($fila=mysql_fetch_array($resultat));
        }
        return $events;
    }
}


// quan es faci submit al form de l'administrador
if (isset($_POST['submit'])) {
    // creem un nou registre passant les dades del form
    $regi = new Registre($dia_inici = $_POST['dia_inici'], $dia_final = $_POST['dia_final'],
        $cayacs_a = $_POST['cayac_a'], $cayacs_b = $_POST['cayac_b'], $cayacs_c = $_POST['cayac_c']);
    
    if ($regi->dates() == true) {
    // creem un objecte servei_registre
    $ser_regi = new Servei_Registre();

        switch ($_POST['radio_status'])
        {
        case "afegeix":
            if ($ser_regi->comprova_disponibilitat1($regi) == true) {
                $ser_regi->comprova_registre($regi);
            }
            break;
        case "modifica":
            if ($ser_regi->comprova_disponibilitat2($regi) == true) {
                $ser_regi->reescriu_dades($regi);
            }
            break;
        case "llog_afegeix":
            if ($ser_regi->comprova_disponibilitat3($regi) == true) {
                $ser_regi->update_llogats($regi);
            }
            break;
        case "llog_modifica":
            if ($ser_regi->comprova_disponibilitat4($regi) == true) {
                $ser_regi->reescriu_llogats($regi);
            }
            break;
        default:
            echo 'Error!! Les dades no s\'han guardat, torna-hi siusplau!'; 
        }
        // enviem missatges d'error o exit
        if ($ser_regi->fi_iteracions() == true) {
                echo 'Les dades s\'han pujat a la base de dades amb èxit';
            } else {
                echo 'Hi ha hagut algun error pujant les dades';
            }
    }else {
        echo '<div>Ets mongui o que? la primera data ha de ser menor a la segona!!</div>';
    }
}
?>