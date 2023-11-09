<?php
$consultarEmpresas_par = new App\Models\EmpresasParceiras();
$objVagas = new App\Models\Vagas();

$empresaConsultar = array();
if (!empty($_SESSION['empresas_par_vg']) && $empresaConsultar = $_SESSION['empresas_par_vg']) {
    unset($_SESSION['empresas_par_vg']);
}

$Empresa = array();
if (!empty($_SESSION['Empresa']) && $Empresa = $_SESSION['Empresa']) {
    unset($_SESSION['Empresa']);
}

$vagaConsult = array();
if (!empty($_SESSION['vaga']) && $vagaConsult = $_SESSION['vaga']) {
    unset($_SESSION['vaga']);
}

$vagaPesquis = array();
if (!empty($_SESSION['vagaPesquis']) && $vagaPesquis = $_SESSION['vagaPesquis']) {
    unset($_SESSION['vagaPesquis']);
}
?>

<div class="content">

    <input type="hidden" id="pag" value="Cadastro de Vagas">

    <div class="divseparacaofix">
        <div class="grupo">  
            <form id="formVagas" action="<?= site('root') . 'vagas/cadastrar' ?>" method="POST" >
                <div class="form-row">
                    <div class="campo">
                        <label for="Codigo_emp">Cod:</label>
                        <input type="text" class="tm-p-90 cor-bk-cz-l" name="Codigo_emp" id="Codigo_emp"  onkeypress="consultarEmpresa()" value="<?= isset($vagaConsult['FK_EMPRESA']) ? $vagaConsult['FK_EMPRESA'] : ""; ?>">
                    </div>
                    <div class="campo">
                        <label for="Descricaoempre">Descrição Empresa:</label>
                        <input type="text" class="tm-m-350" name="Descricaoempre" id="Descricaoempre" value="<?= isset($vagaConsult['EMPRESA']) ? $vagaConsult['EMPRESA'] : ""; ?>">
                    </div>
                    <div class="campo">
                        <label for="CNPJempre">CNPJ Empresa:</label>
                        <input type="text" class="tm-m-180" name="CNPJempre" id="CNPJempre" value="<?= isset($vagaConsult['CNPJ']) ? $vagaConsult['CNPJ'] : ""; ?>">
                    </div>
                </div>

                <hr style="margin: 0.5em 0.5em; border: 1px solid rgba(238, 147, 10, 0.925); max-width: 100%;">

                <div class="form-row">
                    <div class="campo">
                        <label for="Codigo_vaga">Codigo Vaga:</label>
                        <input type="text" class="tm-p-90" name="Codigo_vaga" id="Codigo_vaga" 
                               value="<?= (isset($vagaConsult['PK_COD'])) ? ($vagaConsult['PK_COD']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="Data_abertura">Data Abertura:</label>
                        <input type="date" class=" tm-p-150" name="Data_abertura" id="Data_abertura" 
                               value="<?= (isset($vagaConsult['DATA_ABERTURA'])) ? ($vagaConsult['DATA_ABERTURA']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="Status_Vaga">Status Vaga:</label>
                        <select name="Status_Vaga" id="Status_Vaga" class="tm-m-210" 
                                value="<?= (isset($vagaConsult['STATUS_VAGA'])) ? ($vagaConsult['STATUS_VAGA']) : ('') ?>">
                            <option><?= (isset($vagaConsult['STATUS_VAGA'])) ? ($vagaConsult['STATUS_VAGA']) : ('') ?> </option>
                            <option value="Aberta">Aberta</option>
                            <option value="Em Selecao">Em Seleção</option>
                            <option value="Encaminhados">Encaminhados</option>
                            <option value="Fechada">Fechada</option>
                        </select>
                    </div> 
                    <div class="campo">
                        <label for="Data_fechar">Data Fechamento:</label>
                        <input type="date" class="tm-p-150" name="Data_fechar" id="Data_fechar" 
                               value="<?= (isset($vagaConsult['DATA_FECHAMENTO'])) ? ($vagaConsult['DATA_FECHAMENTO']) : ('') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="campo">
                        <label for="Qtda_vaga">Quantidade Vaga:</label>
                        <input type="text" class="tm-p-150" name="Qtda_vaga" id="Qtda_vaga" 
                               value="<?= (isset($vagaConsult['QTD_VAGA'])) ? ($vagaConsult['QTD_VAGA']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="Local_trab">Local de Trabalho:</label>
                        <input type="text" class="tm-g-500" name="Local_trab" id="Local_trab" 
                               value="<?= (isset($vagaConsult['LOCAL_VAGA'])) ? ($vagaConsult['LOCAL_VAGA']) : ('') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="campo">
                        <label for="Cargo_prent">Cargo Pretendido:</label>
                        <input type="text" class="tm-g-500" name="Cargo_prent" id="Cargo_prent" 
                               value="<?= (isset($vagaConsult['CARGO'])) ? ($vagaConsult['CARGO']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="Salario">Salário:</label>
                        <input type="text" class="tm-p-150" name="Salario" id="Salario" 
                               value="<?= (isset($vagaConsult['SALARIO'])) ? ($vagaConsult['SALARIO']) : ('') ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="campo">
                        <label for="Formacao">Formação:</label>
                        <select name="Formacao" id="Formacao" class="tm-g-400" 
                                value="<?= (isset($vagaConsult['FORMACAO'])) ? ($vagaConsult['FORMACAO']) : ('') ?>">
                            <option><?= (isset($vagaConsult['FORMACAO'])) ? ($vagaConsult['FORMACAO']) : ('') ?> </option>
                            <option value="Mestrado Doutorado">Mestrado/Doutorado</option>
                            <option value="Pos-graduação">Pos-graduação</option>
                            <option value="Ensino Superior">Ensino Superior</option>
                            <option value="Ensino Superior imcompleto">Ensino Superior imcompleto</option>
                            <option value="Ensino Médio">Ensino Médio</option>
                            <option value="Ensino Médio imcompleto">Ensino Médio imcompleto</option>
                            <option value="Ensino Fundamental">Ensino Fundamental</option>
                            <option value="Ensino Fundamental imcompleto">Ensino Fundamental imcompleto</option>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="Qualificacoes">Qualificações:</label>
                        <textarea name="Qualificaçoes"  id="Qualificaçoes" > 
                        <?= isset($vagaConsult['EXPERIENCIA']) ? $vagaConsult['EXPERIENCIA'] : '' ?> </textarea>
                    </div>
                    <div class="campo">
                        <label for="Atividades">Atividades:</label>
                        <textarea name="Atividades"  id="Atividades" > 
                        <?= isset($vagaConsult['ATIVIDADES']) ? $vagaConsult['ATIVIDADES'] : '' ?> </textarea>
                    </div>
                </div>
            </form>  
        </div>

        <div class="login_form_callback">
<?=
flash();
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
        </div>

        <div class="form-row painelcontrolform">
            <div class="campo">
                <button class="button txt-small-1 img-salva-btn" id="salvarVagas" formaction="formVagas" title="Salvar Registro" >Cadastrar</button>
            </div>
            <div class="campo">
                <button class="button txt-small-1 img-alterar-btn" id="alterarVagas" onclick="mudaAction2('<?= site('root') . 'vagas/alterar' ?>')" title="Alterar Registro">Alterar</button>
            </div>
            <div class="campo">
                <button class="button txt-small-1 img-deletar-btn" id="deletarVagas" onclick="mudaAction2('<?= site('root') . 'vagas/deletar' ?>')" title="Deletar Registro">Deletar</button>
            </div>
            <div class="campo">
                <a href="<?= site("root") . "controller/index" ?>" ><button class="button txt-small-1 img-sair-btn" id="sair" title="Sair Registro">Sair</button></a>
            </div>
        </div>

    </div>

    <div class="divseparacao">

        <h1 class="txt-small cor-az-es">Relação de Vagas</h1>

        <form action="<?= site("root") . "vagas/consultar" ?>" method="POST">
            <div class="grupo">
                <div class="form-row">
                    <div class="campo">
                        <label for="Opcao">Codigo:</label>
                        <select name="Opcao" id="Opcao" class="txt-form tm-m-180" value="">
                            <option value="PK_COD">Código</option>
                            <option value="STATUS_VAGA">Status Vaga</option>
                            <option value="CARGO">Cargo</option>
                            <option value="FK_EMPRESA">Cód Empresa</option>
                            <option value="LOCAL_VAGA">Local Vaga</option>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="Parametros">Descrição:</label>
                        <input type="text" class="txt-form tm-m-260" name="Parametros" id="Parametros" value="">
                    </div>
                    <div class="campo">
                        <label></label>
                        <button class="button txt-small-1 img-procurar-btn tm-p-110">Pesquisar</button>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <div class="grupo">
            <div class="form-row">
                <div class="campo">
<?php
if (!empty($vagaPesquis)) {
    ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Cod</th>
                                    <th>Empresa</th>
                                    <th>Cargo</th>
                                    <th>Local</th>
                                    <th>Status</th>                                    
                                </tr>
                            </thead>    
    <?php
    foreach ($vagaPesquis as $vagaresul) {
        ?>
                                <tr>
                                    <td><a  href="<?= site('root') . 'vagas/ConsultarId/' . $vagaresul['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresul['PK_COD']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'vagas/ConsultarId/' . $vagaresul['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresul['EMPRESA']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'vagas/ConsultarId/' . $vagaresul['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresul['CARGO']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'vagas/ConsultarId/' . $vagaresul['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresul['LOCAL_VAGA']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'vagas/ConsultarId/' . $vagaresul['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresul['STATUS_VAGA']); ?></a></td>
                                </tr>
        <?php
    }
} else {
    $Pesquisa = $objVagas->BuscarTodos();
    ?>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <th>Cod</th>
                                    <th>Empresa</th>
                                    <th>Cargo</th>
                                    <th>Local</th>
                                    <th>Status</th>                                    
                                </tr>
                            </thead>    
    <?php
    foreach ($Pesquisa as $vagaresu) {
        ?>
                                <tr>
                                    <td><a  href="<?= site('root') . 'vagas/ConsultarId/' . $vagaresu['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresu['PK_COD']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'vagas/ConsultarId/' . $vagaresu['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresu['EMPRESA']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'vagas/ConsultarId/' . $vagaresu['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresu['CARGO']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'vagas/ConsultarId/' . $vagaresu['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresu['LOCAL_VAGA']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'vagas/ConsultarId/' . $vagaresu['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresu['STATUS_VAGA']); ?></a></td>
                                </tr>
        <?php
    }
}
?>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>



