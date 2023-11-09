<?php
$consultarEmpresas_par = new App\Models\EmpresasParceiras();
$objVagas = new App\Models\Vagas();
$objEncaminhar = new App\Models\Encaminhamentos();

$empresaConsultar = array();
if (!empty($_SESSION['empresas_par_vg']) && $empresaConsultar = $_SESSION['empresas_par_vg']) {
    unset($_SESSION['empresas_par_vg']);
}

$Empresa = array();
if (!empty($_SESSION['Empresa']) && $Empresa = $_SESSION['Empresa']) {
    unset($_SESSION['Empresa']);
}

$encaminharConsult = array();
if (!empty($_SESSION['encaminhar']) && $encaminharConsult = $_SESSION['encaminhar']) {
    unset($_SESSION['encaminhar']);
}

$encarConsult = array();
if (!empty($_SESSION['encarConsult']) && $encarConsult = $_SESSION['encarConsult']) {
    unset($_SESSION['encarConsult']);
}

$_SESSION['encaminharPDF'] = $encaminharConsult;

//var_dump($encaminharConsult);
?>

<div class="content">

    <input type="hidden" id="pag" value="Encaminhamento">

    <div class="divseparacaofix">
        <div class="grupo">
            <form method="POST" action="<?= site("root") . "encaminhamentos/cadastrar" ?>" id="formEncamin">

                <div class="form-row">
                    <input type="hidden" name="Pk_cod" id="Pk_cod" 
                           value="<?= (isset($encaminharConsult['PK_COD'])) ? ($encaminharConsult['PK_COD']) : "0" ?>">

                    <div class="campo">
                        <label for="data_emisssao">Data do Emissão:</label>
                        <input type="text" name="data_emisssao" id="data_emisssao" class="txt-form tm-m-210" 
                               value="<?= (isset($encaminharConsult['DATA_EMISSAO'])) ? ($encaminharConsult['DATA_EMISSAO']) : dataAtual('3') ?>">
                    </div>
                    <div class="campo">
                        <label for="data_entrev">Data do Entrevista:</label>
                        <input type="date" name="data_entrev" id="data_entrev" class="txt-form tm-m-210 cor-bk-cz-l" 
                               value="<?= (isset($encaminharConsult['DATA_ENTREVISTA'])) ? ($encaminharConsult['DATA_ENTREVISTA']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="hora_entrev">Horário do Agendamento:</label>
                        <input type="text" name="hora_entrev" id="hora_entrev" class="txt-form tm-m-210 cor-bk-cz-l" 
                               value="<?= (isset($encaminharConsult['HORA_ENTREVISTA'])) ? ($encaminharConsult['HORA_ENTREVISTA']) : ('') ?>">
                    </div>
                </div>
                <hr style="margin: 0.5em 0.5em; border: 1px solid rgba(238, 147, 10, 0.925); max-width: 100%;">
                <div class="form-row">
                    <div class="campo">
                        <label for="Codigo_vaga">Codigo Vaga:</label>
                        <input type="text" name="Codigo_vaga" id="Codigo_vaga" class="txt-form tm-p-110 cor-bk-cz-l" onkeypress="consultarVagas()"
                               value="<?= (isset($encaminharConsult['FK_VAGA'])) ? ($encaminharConsult['FK_VAGA']) : ('') ?>" autocomplete="">
                    </div>
                    <div class="campo">
                        <label for="Cargo_prent">Cargo Pretendido:</label>
                        <input type="text" name="Cargo_prent" id="Cargo_prent" class="txt-form tm-g-550" 
                               value="<?= (isset($encaminharConsult['CARGO_PRETENDIDO'])) ? ($encaminharConsult['CARGO_PRETENDIDO']) : ('') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="campo">
                        <label for="pk_cod_empre">Codigo:</label> 
                        <input type="text" name="pk_cod_empre" id="pk_cod_empre" class="txt-form tm-p-110" 
                               value="<?= (isset($encaminharConsult['FK_EMPRESA'])) ? ($encaminharConsult['FK_EMPRESA']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="razao_social">Razão Social:</label> 
                        <input type="text" name="razao_social" id="razao_social"  class="txt-form tm-g-550" 
                               value="<?= (isset($encaminharConsult['EMPRESA'])) ? ($encaminharConsult['EMPRESA']) : ('') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="campo">
                        <label for="responsavel">Responsavel:</label> 
                        <input type="text" name="responsavel"  id="responsavel"  class="txt-form tm-g-450" 
                               value="<?= (isset($encaminharConsult['NOME_CONTATO'])) ? ($encaminharConsult['NOME_CONTATO']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="tel_respon">Celular do responsável:</label> 
                        <input type="text" name="tel_respon"  id="tel_respon"  class="txt-form tm-m-180" 
                               value="<?= (isset($encaminharConsult['TEL_CONTATO'])) ? ($encaminharConsult['TEL_CONTATO']) : ('') ?>">
                        <input type="hidden" name="email_empresa_par"  id="email_empresa_par"   
                               value="<?= (isset($encaminharConsult['EMAIL_ENCAM_EMPRE'])) ? ($encaminharConsult['EMAIL_ENCAM_EMPRE']) : ('') ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="campo">
                        <label for="Cep">CEP:</label>
                        <input type="text" name="Cep" id="Cep" class="txt-form tm-p-150" 
                               value="<?= (isset($encaminharConsult['CEP'])) ? ($encaminharConsult['CEP']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="Endereco">Endereço:</label>
                        <input type="text"name="Endereco" id="Endereco"  class="txt-form tm-g-500" 
                               value="<?= (isset($encaminharConsult['ENDERECO'])) ? ($encaminharConsult['ENDERECO']) : ('') ?>">
                    </div>
                </div>

                <div class="form-row ">
                    <div class="campo">
                        <label for="Bairro">Bairro:</label>
                        <input type="text" name="Bairro" id="Bairro" class="txt-form tm-m-280"
                               value="<?= (isset($encaminharConsult['BAIRRO'])) ? ($encaminharConsult['BAIRRO']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="Uf">UF:</label>
                        <input type="text" name="Uf" id="Uf"  class="txt-form tm-p-90"
                               value="<?= (isset($encaminharConsult['UF'])) ? ($encaminharConsult['UF']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="Cidade">Cidade:</label>
                        <input type="text"name="Cidade" id="Cidade"  class="txt-form tm-m-280" 
                               value="<?= (isset($encaminharConsult['CIDADE'])) ? ($encaminharConsult['CIDADE']) : ('') ?>">
                    </div>
                </div>
                <hr style="margin: 0.5em 0.5em; border: 1px solid rgba(238, 147, 10, 0.925); max-width: 100%;">
                <div class="form-row">
                    <div class="campo">
                        <label for="pk_cod_cand">Codigo:</label>
                        <input type="text" name="pk_cod_cand" id="pk_cod_cand" class="txt-form tm-p-110 cor-bk-cz-l" onkeypress="consultarCandidato()"
                               value="<?= (isset($encaminharConsult['FK_CAND'])) ? ($encaminharConsult['FK_CAND']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="nome_cand">Nome:</label>
                        <input type="text" name="nome_cand" id="nome_cand" class="txt-form tm-g-550" 
                               value="<?= (isset($encaminharConsult['CANDIDATO'])) ? ($encaminharConsult['CANDIDATO']) : ('') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="campo">
                        <label for="tel_cand">Telefone:</label>
                        <input type="tel" name="tel_cand" id="tel_cand" class="txt-form tm-m-210"
                               value="<?= (isset($encaminharConsult['TEL_CAND'])) ? ($encaminharConsult['TEL_CAND']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="email_cand">E-mail:</label>
                        <input type="email" name="email_cand" id="email_cand" class="txt-form tm-g-450" 
                               value="<?= (isset($encaminharConsult['EMAIL_CAND'])) ? ($encaminharConsult['EMAIL_CAND']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="Status_encami">Status :</label>
                        <select name="Status_encami" id="Status_encami" class="tm-m-210" value="<?= (isset($encaminharConsult['STATUS_ENCAMI'])) ? ($encaminharConsult['STATUS_ENCAMI']) : ('') ?>">
                            <option><?= (isset($encaminharConsult['STATUS_ENCAMI'])) ? ($encaminharConsult['STATUS_ENCAMI']) : ('') ?> </option>
                            <option value="Em Selecao">Em Seleção</option>
                            <option value="Contratado">Contratado</option>
                            <option value="Cancelada">Cancelada</option>
                        </select>
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
                <button class="button txt-small-1 img-salva-btn tm-p-130" id="salvarEncamin"  title="Salvar Registro" onclick="ImprimirCartaEncaminhar()" >Cadastrar</button> 
            </div>
            <div class="campo">
                <button class="button txt-small-1 img-alterar-btn tm-p-130" id="alterarEncamin" onclick="mudaAction5('<?= site('root') . 'encaminhamentos/alterar' ?>')" title="Alterar Registro">Alterar</button>
            </div>
            <div class="campo">
                <button class="button txt-small-1 img-deletar-btn tm-p-130" id="deletarEncamin" onclick="mudaAction5('<?= site('root') . 'encaminhamentos/deletar' ?>')" title="Deletar Registro">Deletar</button>
            </div>
            <div class="campo">
                <a href="<?= site('root') . 'encaminhamentos/cartaEncaminharPDF' ?>" target="_blank"><button class="button txt-small-1 img-pdf-btn tm-p-130" id="relaVendass" title="Carta Encaminhamento">Carta PDF</button></a>
            </div>
            <div class="campo">
                <a href="<?= site("root") . "controller/index" ?>" ><button class="button txt-small-1 img-sair-btn tm-p-130" id="sair" title="Sair Registro" >Sair</button></a>
            </div>
        </div>

    </div>

    <div class="divseparacao">

        <h1 class="txt-small cor-az-es">Relação de Encaminhados</h1>

        <form action="<?= site("root") . "encaminhamentos/consultar" ?>" method="POST">
            <div class="grupo">
                <div class="form-row">
                    <div class="campo">
                        <label for="Opcao">Codigo:</label>
                        <select name="Opcao" id="Opcao" class="txt-form tm-m-210" value="">
                            <option value="PK_COD">Código</option>
                            <option value="FK_VAGA">Cód Vaga</option>
                            <option value="CARGO_PRETENDIDO">Cargo</option>
                            <option value="FK_EMPRESA">Cód Empresa</option>
                            <option value="FK_CAND">Cód Candidato</option>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="Parametros">Descrição:</label>
                        <input type="text" class="txt-form tm-m-210" name="Parametros" id="Parametros" value="">
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
                    if (!empty($encarConsult)) {
                        ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Cod</th>
                                    <th>Candidato</th>
                                    <th>Vaga </th>
                                    <th>Cargos</th>
                                    <th>Empresa</th>
                                    <th>Data Emissao</th>                  
                                </tr>
                            </thead>    
                            <?php
                            foreach ($encarConsult as $vagaresul) {
                                ?>
                                <tr>
                                    <td><a  href="<?= site('root') . 'encaminhamentos/ConsultarId/' . $vagaresul['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresul['PK_COD']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'encaminhamentos/ConsultarId/' . $vagaresul['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresul['FK_CAND']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'encaminhamentos/ConsultarId/' . $vagaresul['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresul['FK_VAGA']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'encaminhamentos/ConsultarId/' . $vagaresul['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresul['CARGO_PRETENDIDO']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'encaminhamentos/ConsultarId/' . $vagaresul['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresul['FK_EMPRESA']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'encaminhamentos/ConsultarId/' . $vagaresul['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresul['DATA_EMISSAO']); ?></a></td>
                                </tr>
                                <?php
                            }
                        } else {
                            $Pesquisa = $objEncaminhar->BuscarTodos();
                            ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Cod</th>
                                        <th>Candidato</th>
                                        <th>Vaga </th>
                                        <th>Cargos</th>
                                        <th>Empresa</th>
                                        <th>Data Emissao</th>                  
                                    </tr>
                                </thead>    
                                <?php
                                foreach ($Pesquisa as $vagaresu) {
                                    ?>
                                    <tr>
                                        <td><a  href="<?= site('root') . 'encaminhamentos/ConsultarId/' . $vagaresu['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresu['PK_COD']); ?></a></td>
                                        <td><a  href="<?= site('root') . 'encaminhamentos/ConsultarId/' . $vagaresu['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresu['FK_CAND']); ?></a></td>
                                        <td><a  href="<?= site('root') . 'encaminhamentos/ConsultarId/' . $vagaresu['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresu['FK_VAGA']); ?></a></td>
                                        <td><a  href="<?= site('root') . 'encaminhamentos/ConsultarId/' . $vagaresu['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresu['CARGO_PRETENDIDO']); ?></a></td>
                                        <td><a  href="<?= site('root') . 'encaminhamentos/ConsultarId/' . $vagaresu['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresu['FK_EMPRESA']); ?></a></td>
                                        <td><a  href="<?= site('root') . 'encaminhamentos/ConsultarId/' . $vagaresu['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $vagaresu['DATA_EMISSAO']); ?></a></td>
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


<!--MODAL EMVIAR EMAIL PARA EMPRESA--> 
<!--<div id="opcaoModal"  class="modal_conteiner">
    <div class="modal">
        <button class="fechar">X</button>
        <div class="campo tm-g-500">
            <h1 class="txt-small cor-az-fc">Imprimir Carta de Encaminhamento</h1> 
            <a href="<?= site('root') . 'encaminhamentos/cartaEncaminharPDF' ?>" id="buttonFechar"  target="_blank" ><button class="button txt-small-1 img-pdf-btn" id="imprimirCt" title="Imprimir Carta Encaminhamento">imprimir PDF</button></a>
        </div>
        <div class="campo tm-g-620 ">
            <h1 class="txt-small cor-az-fc">Enviar Carta de Encaminhamento para Empresa</h1>
         <a href="<?= site('root') . 'encaminhamentos/cartaEncaminharEmail' ?>"  id="buttonFechar" ><button class="button txt-small-1 img-sair-btn" id="imprimirCt" title="Envia Carta Encaminhamento Email">Enviar E-mail</button></a>
        </div>
    </div>
</div>-->
<!--FINAL MODAL  -->