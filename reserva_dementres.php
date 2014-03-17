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
        <script type="text/javascript" src="js/jquery.sudoSlider.js"></script>
    </head>
    <body>
        <div id="container">
            <!--header-->
            <?php include 'includes/header.php'; ?>
            <div class="passos">
                ss
            </div>
           <?php include 'includes/footer.php'; ?>
        </div>
        <script type="text/javascript" >
            $(document).ready(function() {
                var sudoSlider = $("#slider").sudoSlider({
                    effect: "fade",
                    auto: true,
                    prevNext: false
                });
            });
        </script>
        <script type="text/javascript" src="js/hovers.js"></script>
    </body>
</html>