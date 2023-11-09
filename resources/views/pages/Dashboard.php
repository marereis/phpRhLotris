<?php
$objCandidatos = new App\Models\Candidatos();
$objEmpresa = new App\Models\EmpresasParceiras();
$objVagas = new App\Models\Vagas();
$objEncaminhar = new App\Models\Encaminhamentos();
?>
<div class="contentPainel">

    <input type="hidden" id="pag" value="Dashboard">

    <!-- Painel  -->
    <div class="div_d">
        <div class="painelDash " style="background: rgb(145, 94, 226);width: 100%;">
            <h2 class="txt-small-2 cor-cz-md mg-add-2">Candidatos Cadastrados</h2>
            <h1 class="txt-mediun-1">
                <?php
                $candid = $objCandidatos->totalCadastrados();
                echo ISSET($candid['QUANT']) ? number_format($candid['QUANT'], 0, ',', '.') : "0";
                ?>
            </h1>
        </div>
        <div class="painelDash " style="background: rgb(265, 219, 95);width: 100%;">
            <h2 class="txt-small-2 cor-cz-md mg-add-2">Empresas Cadastradas</h2>
            <h1 class="txt-mediun-1"> 
                <?php
                $empre_par = $objEmpresa->totalCadastrados();
                echo ISSET($empre_par['QUANT']) ? number_format($empre_par['QUANT'], 0, ',', '.') : "0";
                ?>
            </h1>
        </div>
        <div class="painelDash " style="background: rgb(95, 159, 219);width: 100%;">
            <h3 class="txt-small-2 cor-cz-md mg-add-2">Vagas Cadastradas</h3>
            <h1 class="txt-mediun-1"> 
                <?php
                $vagas = $objVagas->totalCadastrados();
                echo ISSET($vagas['QUANT']) ? number_format($vagas['QUANT'], 0, ',', '.') : "0";
                ?>
            </h1>
        </div>
        <div class="painelDash " style="background: rgb(350, 159, 219);width: 100%;">
            <h3 class="txt-small-2 cor-cz-md mg-add-2">Encaminhamento do Dia</h3>
            <h1 class="txt-mediun-1">
                <?php
                $encaninhados = $objEncaminhar->encaminhadosDia();
                echo ISSET($encaninhados['QUANT']) ? number_format($encaninhados['QUANT'], 0, ',', '.') : "0";
                ?>
            </h1>
        </div>
        <div class="painelDash " style="background: rgb(10, 789, 55);width: 100%;">
            <h2 class="txt-small-2 cor-cz-md mg-add-2">Cadastros Candidatos Dia</h2>
            <h1 class="txt-mediun-1"> 
                <?php
                $cadastroDiaCandi = $objCandidatos->cadastroCandDia();
                echo ISSET($cadastroDiaCandi['QUANT']) ? number_format($cadastroDiaCandi['QUANT'], 0, ',', '.') : "0";
                ?>
            </h1>
        </div>
    </div>

    <!-- Graficos -->
    <div class="contentGrafico">
        <div class="graficos">
            <img src=<?= site("root") . "resources/views/pages/Grafico.php" ?>>
            <hr style="margin: 0.2em 0.2em; border: 1px solid rgba(238, 147, 10, 0.925); max-width: 100%;">
            <img src=<?= site("root") . "resources/views/pages/Grafico3.php" ?> >
        </div>
        <div class="graficos">
            <img src=<?= site("root") . "resources/views/pages/Grafico1.php" ?>>
            <hr style="margin: 0.2em 0.2em; border: 1px solid rgba(238, 147, 10, 0.925); max-width: 100%;">
            <img src=<?= site("root") . "resources/views/pages/Grafico2.php" ?>>
        </div>
    </div>

    <div class="painelcontrolform">
        <div class="campo">
            <a href="<?= site("root") . "candidatos/index" ?>" ><button class=" txt-small-1 cor-az-es "  title="Cadastrar Candidatos">Cadastro Candidatos</button></a>
        </div>
        <div class="campo">
            <a href="<?= site("root") . "empresasParceiras/index" ?>" ><button class=" txt-small-1 cor-az-es"  title="Cadastrar Empresas Parceiras">Cadastro Empresas Parceiras</button></a>
        </div>
        <div class="campo">
            <a href="<?= site("root") . "vagas/index" ?>" ><button class=" txt-small-1 cor-az-es"  title="Cadastrar Vagas">Cadastro Vagas</button></a>
        </div>
        <div class="campo">
            <a href="<?= site("root") . "encaminhamentos/index" ?>" ><button class=" txt-small-1 cor-az-es"  title="Encaminhar Candidatos">Encaminhamento</button></a>
        </div>
        <div class="campo">
            <button class=" txt-small-1 " id="btvagas" title="Relação de Vagas por Status">Relação de Vagas</button>
        </div>
        <div class="campo">
            <button class=" txt-small-1 " id="btencaminhar"  title="Encaminhamentos Realizados">Encaminhamentos</button>
        </div>
    </div>


    <!-- MODAL VAGAS ABERTAS -->
    <div id="vagasMODAL"  class="modal_conteiner">
        <div class="modal">
            <h1>RELAÇÃO DE VAGAS</h1>
            <button class="fechar">X</button>
            <br>
            <div>
                <h2>VAGAS ABERTAS</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Cod</th>
                            <th>Cargo</th>
                            <th>Formação</th>
                            <th>Local</th>
                            <th>Empresa</th>
                            <th>QTDA Vagas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $vgencam = $objVagas->vagasAbertas();
                        foreach ($vgencam as $abertas) {
                            ?>
                            <tr>
                                <td><?= $abertas['PK_COD'] ?></td>
                                <td><?= $abertas['CARGO'] ?></td>
                                <td><?= $abertas['FORMACAO'] ?></td>
                                <td><?= $abertas['LOCAL_VAGA'] ?></td>
                                <td><?= $abertas['EMPRESA'] ?></td>
                                <td><?= $abertas['QTD_VAGA'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div>
                <h2>VAGAS EM SELEÇÃO</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Cod</th>
                            <th>Cargo</th>
                            <th>Formação</th>
                            <th>Local</th>
                            <th>Empresa</th>
                            <th>QTDA Vagas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $vgencam1 = $objVagas->vagasEmSelecao();
                        foreach ($vgencam1 as $abertas1) {
                            ?>
                            <tr>
                                <td><?= $abertas1['PK_COD'] ?></td>
                                <td><?= $abertas1['CARGO'] ?></td>
                                <td><?= $abertas1['FORMACAO'] ?></td>
                                <td><?= $abertas1['LOCAL_VAGA'] ?></td>
                                <td><?= $abertas1['EMPRESA'] ?></td>
                                <td><?= $abertas1['QTD_VAGA'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div>
                <h2>VAGAS COM ENCAMINHAMENTOS</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Cod</th>
                            <th>Cargo</th>
                            <th>Formação</th>
                            <th>Local</th>
                            <th>Empresa</th>
                            <th>QTDA Vagas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $vgencam2 = $objVagas->vagasEncaminhadas();
                        foreach ($vgencam2 as $abertas2) {
                            ?>
                            <tr>
                                <td><?= $abertas2['PK_COD'] ?></td>
                                <td><?= $abertas2['CARGO'] ?></td>
                                <td><?= $abertas2['FORMACAO'] ?></td>
                                <td><?= $abertas2['LOCAL_VAGA'] ?></td>
                                <td><?= $abertas2['EMPRESA'] ?></td>
                                <td><?= $abertas2['QTD_VAGA'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- FINAL MODAL  -->

    <!-- MODAL VAGAS CADASTRADOS -->
    <div id="encaminharMODAL" class="modal_conteiner">
        <div class="modal">
            <h1>ENCAMINHAMENTOS MES ATUAL</h1>
            <button class="fechar">X</button>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Cod</th>
                            <th>Data</th>
                            <th>Candidatos</th>
                            <th>Codigo Vaga</th>
                            <th>Cargo</th>
                            <th>Empresa</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $vgencam = $objEncaminhar->buscarTodosMesAtual();
                        foreach ($vgencam as $abertas) {
                            ?>
                            <tr>
                                <td><?= $abertas['PK_COD'] ?></td>
                                <td><?= $abertas['DATA_EMISSAO'] ?></td>
                                <td><?= $abertas['CANDIDATO'] ?></td>
                                <td><?= $abertas['FK_VAGA'] ?></td>
                                <td><?= $abertas['CARGO_PRETENDIDO'] ?></td>
                                <td><?= $abertas['EMPRESA'] ?></td>
                                <td><?= $abertas['STATUS_ENCAMI'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- FINAL MODAL  -->

         
    
    </div>
    
     

