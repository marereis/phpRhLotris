
<?php
$objVagas = new App\Models\Vagas();

$vagasRelatorio = array();
if (!empty($_SESSION['vagasConsulta']) && $vagasRelatorio = $_SESSION['vagasConsulta']) {
    unset($_SESSION['vagasConsulta']);
}
$count = array();
if (!empty($_SESSION['count']) && $count = $_SESSION['count']) {
    unset($_SESSION['count']);
}

$_SESSION['dados'] = $vagasRelatorio;
$_SESSION['dados2'] = $count;
?>

<div class="contentPainel">

    <input type="hidden" id="pag" value="Relatorios de Vagas">

    <!-- Painel  -->
    <div class="div_dR">

        <div class="grupo" style="flex-flow:row nowrap !important;justify-content: space-around ">
            <form action="<?= site("root") . "vagas/consultarRelatorio" ?>"  method="POST">
                <div class="form-row" >
<!--                    <div class="campo">
                        <label for="dtincio">Data Inicio:</label>
                        <input type="date" name="dtincio" id="dtincio" value="">
                    </div>
                    <div class="campo">
                        <label for="dtfinal">Data Final:</label>
                        <input type="date" name="dtfinal" id="dtfinal" value="">
                    </div>-->

                    <div class="campo">
                        <label for="Opcao">Opções:</label> 
                        <select name="Opcao" id="Opcao" class="txt-form tm-m-210" >
                            <option value="PK_COD">Código</option>
                            <option value="CNPJ">CNPJ</option>
                            <option value="EMPRESA">Empresa</option>
                            <option value="STATUS_VAGA">Status</option>
                            <option value="CARGO">Cargo</option>
                        </select> 
                    </div>
                    <div class="campo">
                        <label for="Parametros">Parametros:</label>
                        <input type="text" name="Parametros" id="Parametros" class="txt-form tm-m-350" value="">
                    </div>
                    <br>
                    <div class="campo">
                        <label></label>
                        <button class="button txt-small-1 img-procurar-btn" id="relaVendas" title="Relatorio Vagas">Pesquisar</button>
                    </div>
                </div> 
            </form>
            <div class="campo">
                <label></label>
                <a href="<?= site('root') . 'vagas/relatorioPDF' ?>" target="_blank"><button class="button txt-small-1 img-pdf-btn" id="relaVendass" title="Relatorio Vagas">Relatorio PDF</button></a>
            </div>
            <div class="campo">
                <label></label>
                <a href="<?= site("root") . "controller/index" ?>" ><button class="button txt-small-1 img-sair-btn" id="sair" title="Sair Registro">Sair</button></a>
            </div>
        </div>

    </div>

    <!-- Graficos -->
    <div class="contentGrafico">
        <div class="contentRela">
            <table align="center" style="border-collapse:collapse;" >
                <thead style="border-collapse:collapse; border: 1px blue  double; font-size: 14pt" >
                    <tr>
                        <th>Código</th>
                        <th>Cargo</th>
                        <th>Empresa</th>
                        <th>Status</th>
                        <th>Data</th>
                        <th>QTDA</th>
                    </tr>
                </thead> 
                <?php
                if (!empty($vagasRelatorio)) {
                    foreach ($vagasRelatorio as $prodt) {
                        ?>
                        <tr>
                            <td><?php echo($prodt['PK_COD']); ?></td>
                            <td><?php echo($prodt['CARGO']); ?></td>
                            <td><?PHP echo($prodt['EMPRESA']); ?></td>
                            <td><?PHP echo($prodt['STATUS_VAGA']); ?></td>
                            <td><?PHP echo conversordata($prodt['DATA_ABERTURA'], 1); ?></td>
                            <td><?PHP echo($prodt['QTD_VAGA']); ?></td>                           
                        </tr> 
                    <?php
                    }
                }
                ?>
<!--                <tr><td COLSPAN="7"><hr></td></tr>-->
               <TR><td COLSPAN="2" align="left"><b>QTD. Total de Itens</b></td><td><b><?= isset($count["Quant"]) ? $count["Quant"] : ""; ?></b></td></tr>
                <!--<TR><td COLSPAN="5" align="left"><strong> Total R$</strong></td><td><strong><?= isset($count['TOTAL']) ? number_format($count['TOTAL'], 2, ',', '.') : ''; ?></strong></td><td></td></tr>-->
            </table>

            <div class="login_form_callback">
                <?=
                flash();
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
            </div>

        </div>

    </div>


</div>
