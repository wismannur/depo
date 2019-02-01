<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <script src="main.js"></script> -->
    </head>
    <body>
        <?php 
            $par_id = $_GET['inv_id'];
            $v_print = $_GET['v_print'];
            $kode_depo = $_GET['kode_depo'];
            echo "<h1>INV ID nya adalah = $par_id  </h1> <br> 
                <h1>Metode print nya adalah = $v_print </h1> <br>
                <h1>Kode Depo nya adalah = $kode_depo </h1>";
        ?>
    </body>
</html>

