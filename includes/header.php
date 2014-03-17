<div id="header">
    <div id="menu">
        <div id="menu_left">
            <img src="img/recursos/logoTransbrava.png">
        </div>
        <div id="menu_right">
            <div id="top">
                <div id="banderas">
                    <a href="index.php?lang=ca"> <img src="img/recursos/cat.png"></a>
                    <a href="index.php?lang=es"> <img src="img/recursos/cas.png"></a>
                    <a href="index.php?lang=en"> <img src="img/recursos/eng.png"></a>
                    <a href="index.php?lang=fr"> <img src="img/recursos/fr.png"></a>
                </div>
            </div>
            <div id="botom">
                <ul>
                    <li id="#" ><a id="inici" class="active" href="index.php?lang=<?php echo $user_language ?>"><?php echo INICI; ?></a></li> 
                    <li id="#" ><a class="active2" id="rutes" href="transbrava.php?lang=<?php echo $user_language ?>"><?php echo RUTES; ?></a>
                        <ul>
                            <li><a><?php echo TRANS_MENU; ?></a></li>
                            <li><a><?php echo ULTRA_MENU; ?></a></li>
                            <li><a><?php echo CENTRE_MENU; ?></a></li>
                            <li><a><?php echo SUD_MENU; ?></a></li>
                        </ul>
                    </li> 
                    <li id="#" ><a class="active2" id="serveis"  href="index.php?lang=<?php echo $user_language ?>"><?php echo SERVEIS; ?></a>
                        <ul>
                            <li><a><?php echo TRANSBRAVA; ?></a></li>
                            <li><a><?php echo ULTRABRAVA; ?></a></li>
                            <li><a><?php echo D_CENTRE; ?></a></li>
                            <li><a><?php echo D_SUD; ?></a></li>
                        </ul>
                    </li>
                    <li id="#" ><a class="active2" id="caiacs"  href="#"><?php echo ELS_NOSTRES_CAIACS; ?></a>
                        <ul>
                            <li><a><?php echo TRANSBRAVA; ?></a></li>
                            <li><a><?php echo ULTRABRAVA; ?></a></li>
                            <li><a><?php echo D_CENTRE; ?></a></li>
                            <li><a><?php echo D_SUD; ?></a></li>
                        </ul>
                    </li>
                    <li id="#" ><a class="active2" id="funcionament"  href="#"><?php echo FUNCIONAMENT; ?></a>
                        <ul>
                            <li><a><?php echo TRANSBRAVA; ?></a></li>
                            <li><a><?php echo ULTRABRAVA; ?></a></li>
                            <li><a><?php echo D_CENTRE; ?></a></li>
                            <li><a><?php echo D_SUD; ?></a></li>
                        </ul>
                    </li>
                    <li id="#" ><a class="active2" id="ofertes" href="#"><img width="50" style="position: absolute; margin: auto; margin-top: -16px;" src="img/recursos/ofertes.gif"><?php echo OFERTES; ?></a></li> 
                    <li id="#" ><a class="active2" id="contacte" href="#"><?php echo CONTACTE; ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>