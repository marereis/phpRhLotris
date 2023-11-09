
<?php
$consultarEmpresa = new App\Models\Empresa();
$empresa          = $consultarEmpresa->buscarTodos();

$encaminharConsult = [];
if (!empty($_SESSION['encaminharPDF']) && $encaminharConsult = $_SESSION['encaminharPDF']) {
  //  unset($_SESSION['encaminharPDF']);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" "href= <?php echo site('root').'resources/assets/img/logotransp.ico'; ?> />
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
                width: 160px;
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
            fieldset{
                border: none
            }

        </style> 

    </head>
    <body onabort="window.open('about:blank')">
        <div class="header">
            <img src=<?php echo site('root').'resources/assets/img/logoEmpresa.png'; ?> />
            <h2>ENCAMINHAMENTO Nº: <strong><?php echo (isset($encaminharConsult['PK_COD'])) ? ($encaminharConsult['PK_COD'])
                        : (''); ?></strong></h2>
        </div>
        <div>
            <p style="text-align:">Rio de janeiro  <?php
                $date = date('d /m /Y');
                echo $date;
                ?>
            </p>
        </div>
        <div>
             
            <fieldset>
                O candidato:  <strong><?php echo (isset($encaminharConsult['CANDIDATO']))
                        ? ($encaminharConsult['CANDIDATO']) : (''); ?></strong>  <br>
                Encaminhado vaga Nº: <strong><?php echo (isset($encaminharConsult['FK_VAGA']))
                        ? ($encaminharConsult['FK_VAGA']) : (''); ?></strong> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                Cargo:	  <strong><?php echo (isset($encaminharConsult['CARGO_PRETENDIDO']))
                        ? ($encaminharConsult['CARGO_PRETENDIDO']) : (''); ?></strong>  <br>
            </fieldset>
            <hr>
            <fieldset>
                Nome da Empresa:   <strong><?php echo (isset($encaminharConsult['EMPRESA']))
                        ? ($encaminharConsult['EMPRESA']) : (''); ?></strong> <br>
                Endereço:  <strong><?php echo (isset($encaminharConsult['ENDERECO']))
                        ? ($encaminharConsult['ENDERECO']) : (''); ?> </strong><br>
                CEP: <strong><?php echo (isset($encaminharConsult['CEP'])) ? ($encaminharConsult['CEP'])
                        : (''); ?> </strong>  Bairro: <strong><?php echo (isset($encaminharConsult['BAIRRO']))
                        ? ($encaminharConsult['BAIRRO']) : (''); ?> </strong><br>
                Cidade:  <strong><?php echo (isset($encaminharConsult['CIDADE']))
                        ? ($encaminharConsult['CIDADE']) : (''); ?></strong>   Estado: <strong><?php echo (isset($encaminharConsult['UF']))
                        ? ($encaminharConsult['UF']) : (''); ?> </strong><br>
                <p>
                    Atendimento a partir:  <strong><?php echo (isset($encaminharConsult['HORA_ENTREVISTA']))
                        ? ($encaminharConsult['HORA_ENTREVISTA']) : (''); ?></strong>
                    horas, no dia:  <strong><?php echo (isset($encaminharConsult['DATA_ENTREVISTA']))
                        ? conversordata($encaminharConsult['DATA_ENTREVISTA'], 1)
                        : (''); ?>  </strong>  <br>
                    Procurar:  <strong><?php echo (isset($encaminharConsult['NOME_CONTATO']))
                        ? ($encaminharConsult['NOME_CONTATO']) : (''); ?>  </strong>     <br>
                </p>
            </fieldset>
            
        </div>
 <hr>
        <div>
            <p style="text-align: justify">Solicitamos a devolução de presente como resultado deste encaminhamento preenchido, para que possamos efetuar nossos controles continuamos à disposição de V.S. no telefone <?php echo $empresa['0']['CELULAR']; ?></p>

            <p>Atenciosamente</p><br>

            <strong>RESULTADO DA SELEÇÃO</strong><br>

            (   ) Aceito na ocupação em referência – Data de Admissão:<br>
            (   ) Aceito na ocupação<br>
            (   ) Vaga já preenchida<br>
            (   ) Vaga já cancelada<br>
            (   ) Candidato Recusou a vaga<br>
            (   ) Reprovado no processo seleção<br>

            <p>Tipo de vaga colocada: (   ) aumento de quadro (   ) reposição</p>

            <p>Motivo: ____________________________________________________________________</p>
            <p> ____________________________________________________________________</p>
            <p> ____________________________________________________________________</p>
        </div>
   

        <div class="footer">
            <p ><?php
                echo $empresa['0']['RAZAO_SOCIAL'].' - '.$empresa['0']['ENDERECO'].' - '.$empresa['0']['BAIRRO'].' - '.
                $empresa['0']['CIDADE'].' - '.$empresa['0']['UF'].' - CEP : '.$empresa['0']['CEP'].' - Tel : '.
                $empresa['0']['CELULAR'];
                ?></p>
            <p> Lotris - RH &copy; <?php echo dataAtual(5); ?> - <span> </span></p>
        </div>
    </body>
</html>
