
<?php
$objEmpresa_par = new App\Models\EmpresasParceiras();

$empre_parRelatorio = array();
if (!empty($_SESSION['empre_parConsulta']) && $empre_parRelatorio = $_SESSION['empre_parConsulta']) {
    unset($_SESSION['empre_parConsulta']);
}
$count = array();
if (!empty($_SESSION['count']) && $count = $_SESSION['count']) {
    unset($_SESSION['count']);
}

$_SESSION['dados']  = $empre_parRelatorio;
$_SESSION['dados2'] = $count;
?>
<div class="contentPainel">

    <input type="hidden" id="pag" value="Relatorios de Empresas Parceiras">

    <!-- Painel  -->
    <div class="div_dR">

        <div class="grupo" style="flex-flow:row nowrap !important;justify-content: space-around ">
            <form action="<?= site("root")."empresasParceiras/consultarRelatorio" ?>"  method="POST">
                <div class="form-row" >
                    <div class="campo">
                        <label for="Opcao">Opçoes:</label> 
                        <select name="Opcao" id="Opcao"  class="txt-form tm-m-210">
                            <option value="PK_COD">Código</option>
                            <option value="CNPJ">CNPJ</option>
                            <option value="RAZAO_SOCIAL">Razão Social</option>
                            <option value="NOME_FANTASIA">Nome Fantasia</option>
                            <option value="EMAIL">E-mail</option>
                        </select> 
                    </div>
                    <div class="campo">
                        <label for="Parametros">Descrição:</label>
                        <input type="text" name="Parametros" class="txt-form tm-m-350" id="Parametros" value="">
                    </div>
                    <div class="campo">
                        <label></label>
                        <button class="button txt-small-1 img-procurar-btn" id="relaVendas" title="Relatorio Candidatos">Pesquisar</button>
                    </div>
                </div> 
            </form>
            <div class="campo">
                <label></label>
                <a href="<?= site('root').'empresasParceiras/relatorioPDF' ?>" target="_blank"><button class="button txt-small-1 img-pdf-btn" id="relaVendass" title="Relatorio Candidatos PDF">Relatorio PDF</button></a>
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
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>CNPJ</th>
                        <th>Razão Social</th>
                        <th>Responsavel</th>
                        <th>Celular</th>
                        <th>Email</th>
                    </tr>
                </thead> 
                <?php
                if (!empty($empre_parRelatorio)) {
                    foreach ($empre_parRelatorio as $prodt) {
                        ?>
                        <tr>
                            <td><?php echo($prodt['PK_COD']); ?></td>
                            <td><?PHP echo($prodt['CNPJ']); ?></td>
                            <td><?PHP echo($prodt['RAZAO_SOCIAL']); ?></td>
                            <td><?PHP echo($prodt['RESPONSAVEL']); ?></td>
                            <td><?PHP echo($prodt['CELULAR']); ?></td>
                            <td><?PHP echo($prodt['EMAIL']); ?></td>
                        </tr>
                        <?php
                    }
                    // } else {
                    //     echo '<h3>Produto nao Encontrado!</h3>';
                }
                ?>
                <tr><td COLSPAN="7"><hr></td></tr>
                <TR><td COLSPAN="3" align="left"><b>QTD. Total de Itens</b></td><td><b><?= isset($count["Quant"])
                        ? $count["Quant"] : ""; ?></b></td></tr>
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

