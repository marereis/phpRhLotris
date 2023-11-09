
<?php
$objVagas = new App\Models\Vagas();

$encaminharRelatorio = array();
if (!empty($_SESSION['encaminharConsulta']) && $encaminharRelatorio = $_SESSION['encaminharConsulta']) {
    unset($_SESSION['encaminharConsulta']);
}
$count = array();
if (!empty($_SESSION['count']) && $count = $_SESSION['count']) {
    unset($_SESSION['count']);
}

$_SESSION['dados']  = $encaminharRelatorio;
$_SESSION['dados2'] = $count;
?>

<div class="contentPainel">

    <input type="hidden" id="pag" value="Relatorios de Encaminhamentos">

    <!-- Painel  -->
    <div class="div_dR">

        <div class="grupo" style="flex-flow:row nowrap !important;justify-content: space-around ">
            <form action="<?= site("root")."encaminhamentos/consultarRelatorio" ?>"  method="POST">
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
                        <select name="Opcao" id="Opcao" class="txt-form tm-m-210">
                            <option value="PK_COD">Código</option>
                            <option value="FK_EMPRESA">Cód Empresa</option>
                            <option value="FK_CAND">Cód Candidato</option>
                            <option value="DATA_EMISSAO">Data Emissao</option>
                            <option value="STATUS_ENCAMI">Status</option>
                            <option value="TIPO_ENCAMI">Tipo Envio Carta</option>
                        </select> 
                    </div>
                    <div class="campo">
                        <label for="Parametros">Parametros:</label>
                        <input type="text" name="Parametros" id="Parametros" class="txt-form tm-m-350"value="">
                    </div>
                    <br>
                    <div class="campo">
                        <label></label>
                        <button class="button txt-small-1 img-procurar-btn" id="relaVendas" title="Relatorio Encaminhamentos">Pesquisar</button>
                    </div>
                </div> 
            </form>
            <div class="campo">
                <label></label>
                <a href="<?= site('root').'Encaminhamentos/relatorioPDF' ?>" target="_blank"><button class="button txt-small-1 img-pdf-btn" id="relaVendass" title="Relatorio Vagas">Relatorio PDF</button></a>
            </div>
            <div class="campo">
                <label></label>
                <a href="<?= site("root")."controller/index" ?>" ><button class="button txt-small-1 img-sair-btn" id="sair" title="Sair Registro">Sair</button></a>
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
                        <th>Data</th>
                        <th>Cód Cand</th>
                        <th>Candidato</th>
                        <th>Cód Vaga</th>
                        <th>Cargo</th>
                        <th>Cód Empresa</th>
                        <th>Empresa</th>
                        <th>Staus</th>
                    </tr>
                </thead> 
                <?php
                if (!empty($encaminharRelatorio)) {
                    foreach ($encaminharRelatorio as $prodt) {
                        ?>
                        <tr>
                            <td><?php echo($prodt['PK_COD']); ?></td>
                            <td><?php echo conversordata(($prodt['DATA_EMISSAO']), 1); ?></td>
                            <td><?PHP echo($prodt['FK_CAND']); ?></td>
                            <td><?PHP echo($prodt['CANDIDATO']); ?></td>
                            <td><?PHP echo $prodt['FK_VAGA']; ?></td>
                            <td><?PHP echo($prodt['CARGO_PRETENDIDO']); ?></td>
                            <td><?PHP echo $prodt['FK_EMPRESA']; ?></td>
                            <td><?PHP echo($prodt['EMPRESA']); ?></td>
                            <td><?PHP echo($prodt['STATUS_ENCAMI']); ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <tr><td COLSPAN="7"><hr></td></tr>
                <TR><td COLSPAN="3" align="left"><b>QTD. Total de Itens</b></td><td><b><?= isset($count["Quant"])
                        ? $count["Quant"] : ""; ?></b></td></tr>
                  <!--<TR><td COLSPAN="5" align="left"><strong> Total R$</strong></td><td><strong><?= isset($count['TOTAL'])
                        ? number_format($count['TOTAL'], 2, ',', '.') : ''; ?></strong></td><td></td></tr>-->
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
