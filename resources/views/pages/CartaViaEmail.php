<?php

$curriculo = array();
if (!empty($_SESSION['candidatoCurriculo']) && $curriculo = $_SESSION['candidatoCurriculo']) {
    unset($_SESSION['candidatoCurriculo']);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" "href= <?= site("root") . "/views/ui/img/logotransp.ico" ?>  />
        <title>Carta de Encaminhamento</title>

        <style>
            @page{
                margin: 90px 70px 5px 70px;
                size: 29.7cm 21.0cm landscape; /* a4 paper. */
            }
            body{
                margin: 2px ;
                padding: 0 ;
                font-family: "Open Sans", sans-serif;
            }
            h2{
                text-align: center;
            }
            .header{
                position: fixed;
                top: -55px;
                left: 0;
                right: 0;
                width: 95%;
                text-align: center;
                padding: 10px;
                margin-bottom: 50px
            }
            .header img{
                float: left;
                width: 230px;
                margin-top: -10px;
            }
            .footer{
                position: fixed;
                bottom: 1px;
                left: 0;
                width: 95%;
                padding: 10px 10px 10px 10px;
                text-align: center;
                font-size: 9pt;

            }
            .footer p span:before{
                counter-increment: span;
                content: "Página " counter(span);
                margin: 3px
            }
            table{
                width: 100%;
                border: 1px solid #555555;
                margin: 5px;
                padding: 5px;
                font-size: 9pt
            }
            thead, th{
                text-transform: uppercase;
                border: 1px #003eff solid;
                font-size: 8pt
            }
            table, th, td{
                border: 0px solid #555555;
                border-collapse: collapse;
                text-align: center;
                padding: 5px;
            }
            tr:nth-child(2n+0){
                background: #eeeeee;
            }

            strong{
                text-transform: uppercase !important;
            }

        </style> 

    </head>
    <body onabort="window.open('about:blank')">
        <div class="header">
            <h3><?= $curriculo["NOME"]; //var_dump($curriculo);?></h3>
        </div>
        <br> 
        <div>
            <p>Endereço :<?= $curriculo["ENDERECO"] ?> -  <?= $curriculo["BAIRRO"] ?> -      		
            CEP : <?= $curriculo["CEP"] ?> -  <?= $curriculo["CIDADE"] ?> - <?= $curriculo["UF"] ?> <br>     	  	
            Tel.: <?= $curriculo["CELULAR"] ?> - e-mail: <?= $curriculo["EMAIL"] ?><br>
            Nascido(a) em :<?= conversordata($curriculo["DATA_NASC"], 1); ?>  -  
            Idade :<?= $curriculo["IDADE"] ?>  -  
            Estado civil : <?= $curriculo["ESTADO_CIVIL"] ?></p>
            
           <p><strong>OBJETIVO: </strong>  <?= $curriculo["CARGO_PRETENDIDO"] ?></p> 
            
           <strong>EXPERIÊNCIA PROFISSIONAL</strong>
            <p><?= '-' . isset($curriculo["EMPRESA1"]) ? $curriculo["EMPRESA1"] : "";?><br> 
            <?= isset($curriculo["CARGO1"]) ? $curriculo["CARGO1"] : "";?> </p>
           <p><?= '-' . isset($curriculo["EMPRESA2"]) ? $curriculo["EMPRESA2"] : "";?><br> 
            <?= isset($curriculo["CARGO2"]) ? $curriculo["CARGO2"] : "";?><br> 
            <p><?='-' . isset($curriculo["EMPRESA3"]) ? $curriculo["EMPRESA3"] : "";?><br> 
            <?= isset($curriculo["CARGO3"]) ? $curriculo["CARGO3"] : ""; ?></p> 
             
            <strong>FORMAÇÃO ACADÊMICA - CURSO</strong>
            <p><?= (isset($curriculo["ESCOLARIDADE"])? $curriculo["ESCOLARIDADE"]:"") . " em " . (isset($curriculo["CURSO"]) ? $curriculo["CURSO"] : ""); ?></p> 
            <p><?= isset($curriculo["CURSO_EXTRA1"]) ? $curriculo["CURSO_EXTRA1"] : "";?><br>
            <?= isset($curriculo["CURSO_EXTRA2"]) ? $curriculo["CURSO_EXTRA2"] : "";?><br>
            <?= isset($curriculo["CURSO_EXTRA3"]) ? $curriculo["CURSO_EXTRA3"] : "";?></p>
            
        </div>

    </body>
</html>
