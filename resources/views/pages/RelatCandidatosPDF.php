
<?php
$consultarEmpresa = new App\Models\Empresa();

$prodRelatorio = array();
if (!empty($_SESSION['dados']) && $prodRelatorio = $_SESSION['dados']) {
    unset($_SESSION['dados']);
}
$count = array();
if (!empty($_SESSION['dados2']) && $count = $_SESSION['dados2']) {
    unset($_SESSION['dados2']);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/ico" href= <?= site("root") . "resources/assets/img/logotransp.ico" ?> >
        <title>RELATÓRIO DE CANDIDATOS</title>

        <style>
            @page{
                margin: 70px 20px 5px;
                size:21.0cm 29.7cm  portrait; /* a4 paper. */
            }
            body{
                margin: 2px ;
                padding: 0 ;
                font-family: "Open Sans", sans-serif;
            }
            h4{
                text-align: right;
                color: blue
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
                width: 150px;
                margin-top: -10px;
            }
            .footer{
                position: fixed;
                bottom: 35px;
                left: 0;
                width: 95%;
                padding: 10px 5px 5px 5px;
                text-align: center;
                font-size: 9pt;
                margin: 5px
            }
            .footer p span:before{
                counter-increment: span;
                content: "Página " counter(span);
                margin: 10px
            }
            table{
                width: 100%;
                border: 1px solid #555555;
                margin: 0;
                padding: 0;
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

        </style>
    </head>
    <body onabort="window.open('about:blank')">
        <div class="header">
             <img src=<?php echo site('root').'resources/assets/img/logoEmpresa.png'; ?> />
            <h4>RELATÓRIO DE CANDIDADTOS</h4>
        </div>

        <div class="footer">
            <?PHP
            $empresa = $consultarEmpresa->BuscarTodos();
            ?>
            <p><?=
                $empresa['0']["RAZAO_SOCIAL"] . ' - ' . $empresa['0']["ENDERECO"] . ' - ' . $empresa['0']["BAIRRO"] . ' - ' .
                $empresa['0']["CIDADE"] . ' - ' . $empresa['0']["UF"] . ' - CEP : ' . $empresa['0']["CEP"] . ' - Tel : ' .
                $empresa['0']["CELULAR"]
                ?></p>
            <p> Lotris - RH &copy; <?= dataAtual(5); ?> - <span> </span></p>
        </div>

        <table>
            <thead><tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Data Nasci</th>
                    <th>CPF</th>
                    <th>Bairro</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th>Cargo</th>
                </tr></thead> 
            <?php
            if (!empty($prodRelatorio)) {
                foreach ($prodRelatorio as $prodt) {
                    ?>
                    <tr>
                        <td><?php echo($prodt['PK_COD']); ?></td>
                        <td><?PHP echo($prodt['NOME']); ?></td>
                        <td><?PHP echo($prodt['DATA_NASC']); ?></td>
                        <td><?PHP echo($prodt['CPF']); ?></td>
                        <td><?PHP echo($prodt['BAIRRO']); ?></td>
                        <td><?PHP echo($prodt['EMAIL']); ?></td>
                        <td><?PHP echo($prodt['CELULAR']); ?></td>
                        <td><?PHP echo($prodt['CARGO_PRETENDIDO']); ?></td>        
                    </tr> 
                    <?php
                }
                //} else {
                //    echo '<h3>Produto nao Encontrado!</h3>';
            }
            ?>
            <tr><td COLSPAN="7"><hr></td></tr>
            <TR><td COLSPAN="3"><b>Quantidade de Itens</b></td><td><b><?= isset($count["Quant"]) ? $count["Quant"] : ""; ?></b></td></tr>

        </table>
    </body>
</html>
