<?php
$consultarEmpresapar = new App\Models\EmpresasParceiras();

$dadosempresa = array();
if (!empty($_SESSION['empresapar']) && $dadosempresa = $_SESSION['empresapar']) {
    unset($_SESSION['empresapar']);
}
$empresapardConsultar = array();
if (!empty($_SESSION['empresas_parConsulta']) && $empresapardConsultar = $_SESSION['empresas_parConsulta']) {
    unset($_SESSION['empresas_parConsulta']);
}
?>

<div class="content">

    <input type="hidden" id="pag" value="Cadastro Empresas Parceiras">

    <div class="divseparacaofix">
        
        <div class="grupo">
            <form class="form" method="POST" action="<?= site("root") . "empresasParceiras/cadastrar" ?>" id="formEmpresa_par">

                <div class="form-row">
                    <div class="campo">
                        <label for="pk_cod">Codigo:</label> 
                        <input type="text" name="pk_cod" id="pk_cod" class="txt-form tm-p-110" value="<?= (isset($dadosempresa["PK_COD"])) ? ($dadosempresa["PK_COD"]) : ('0') ?>">
                    </div>
                    <div class="campo">
                        <label for="razao_social">Razão Social:</label> 
                        <input type="text" name="razao_social" id="razao_social"  class="txt-form tm-g-550" value="<?= (isset($dadosempresa["RAZAO_SOCIAL"])) ? ($dadosempresa["RAZAO_SOCIAL"]) : ('') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="campo">
                        <label for="cnpj">CNPJ:</label>
                        <input type="text" name="cnpj"  id="cnpj" class="txt-form tm-m-210"  value="<?= isset($dadosempresa["CNPJ"]) ? $dadosempresa["CNPJ"] : '' ?>">
                    </div>
                    <div class="campo">
                        <label for="nome_fantasia">Nome Fantasia:</label>
                        <input type="text" name="nome_fantasia" id="nome_fantasia" class="txt-form tm-g-450" value="<?= isset($dadosempresa ["NOME_FANTASIA"]) ? $dadosempresa ["NOME_FANTASIA"] : '' ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="campo">
                        <label for="responsavel">Responsavel:</label> 
                        <input type="text" name="responsavel"  id="responsavel"  class="txt-form tm-g-450" value="<?= isset($dadosempresa["RESPONSAVEL"]) ? $dadosempresa["RESPONSAVEL"] : '' ?>">
                    </div>
                    <div class="campo">
                        <label for="Tel_respon">Celular do responsável:</label> 
                        <input type="text" name="Tel_respon"  id="Tel_respon"  class="txt-form tm-m-210" value="<?= (isset($dadosempresa["TEL_RESPONS"])) ? ($dadosempresa["TEL_RESPONS"]) : ('') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="campo">
                        <label for="celular">Celular Empresa:</label> 
                        <input type="tel" name="celular" id="celular" class="txt-form tm-m-210" value="<?= (isset($dadosempresa["CELULAR"])) ? ($dadosempresa["CELULAR"]) : ('') ?>"> 
                    </div>
                    <div class="campo">
                        <label for="email">E-mail:</label> 
                        <input type="email" name="email" id="email" class="txt-form tm-g-450"  value="<?= (isset($dadosempresa["EMAIL"])) ? ($dadosempresa["EMAIL"]) : ('') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="campo">
                        <label for="Cep">CEP:</label>
                        <input type="text" class="tm-p-150" name="Cep" id="Cep" value="<?= (isset($dadosempresa['CEP'])) ? ($dadosempresa['CEP']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="Endereco">Endereço:</label>
                        <input type="text" class="tm-g-500" name="Endereco" id="Endereco" value="<?= (isset($dadosempresa['ENDERECO'])) ? ($dadosempresa['ENDERECO']) : ('') ?>">
                    </div>
                </div>

                <div class="form-row ">
                    <div class="campo">
                        <label for="Bairro">Bairro:</label>
                        <input type="text" class="tm-m-280" name="Bairro" id="Bairro" value="<?= (isset($dadosempresa['BAIRRO'])) ? ($dadosempresa['BAIRRO']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="Uf">UF:</label>
                        <select name="Uf" id="Uf" class="tm-p-90" value="<?= (isset($dadosempresa['UF'])) ? ($dadosempresa['UF']) : ('') ?>">
                            <option><?= (isset($dadosempresa['UF'])) ? ($dadosempresa['UF']) : ('') ?></option>
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AP">AP</option>
                            <option value="AM">AM</option>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="DF">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MT">MT</option>
                            <option value="MS">MS</option>
                            <option value="MG">MG</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PR">PR</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="RJ">RJ</option>
                            <option value="RN">RN</option>
                            <option value="RS">RS</option>
                            <option value="RO">RO</option>
                            <option value="RR">RR</option>
                            <option value="SC">SC</option>
                            <option value="SP">SP</option>
                            <option value="SE">SE</option>
                            <option value="TO">TO</option>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="Cidade">Cidade:</label>
                        <input type="text" class="tm-m-280" name="Cidade" id="Cidade" value="<?= (isset($dadosempresa['CIDADE'])) ? ($dadosempresa['CIDADE']) : ('') ?>">
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
                <button class="button txt-small-1 img-salva-btn" id="salvarEmpresa_par" title="Salvar Registro">Cadastrar</button>
            </div>
            <div class="campo">
                <button class="button txt-small-1 img-alterar-btn" id="alterarEmpresa_par" onclick="mudaAction7('<?= site('root') . 'empresasParceiras/alterar' ?>')" title="Alterar Registro">Alterar</button>
            </div>
            <div class="campo">
                <button class="button txt-small-1 img-deletar-btn" id="deletarEmpresa_par" onclick="mudaAction7('<?= site('root') . 'empresasParceiras/deletar' ?>')" title="Deletar Registro">Deletar</button>
            </div>
            <div class="campo">
                <a href="<?= site("root") . "controller/index" ?>" ><button class="button txt-small-1 img-sair-btn" id="sair" title="Sair Registro">Sair</button></a>
            </div>
        </div>

    </div>

    <div class="divseparacao">
        <h1 class="txt-small cor-az-es">Lista Empresa Parceiras</h1>
               
        <form action="<?= site("root") . "empresasParceiras/consultar" ?>"  method="POST">
            <div class="grupo">
                <div class="form-row">
                    <div class="campo">
                        <label for="Opcao">Codigo:</label>
                        <select name="Opcao" id="Opcao" class="txt-form" value="">
                            <option value="PK_COD">Código</option>
                            <option value="CNPJ">CNPJ</option>
                            <option value="RAZAO_SOCIAL">Razão Social</option>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="Parametros">Descrição:</label>
                        <input type="text" class="txt-form" name="Parametros" id="Parametros" value="">
                    </div>
                    <div class="campo">
                        <label></label>
                        <button class="button txt-small-1 img-procurar-btn">Pesquisar</button>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <div class="grupo">
            <div class="form-row">
                <div class="campo">
                    <?php
                    if (!empty($empresapardConsultar)) {
                        ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Cod</th>
                                    <th style="width: 200px">CPF</th>
                                    <th style="width: 500px">Nome</th>
                                </tr>
                            </thead>
                            <?php foreach ($empresapardConsultar as $prodte) { ?>
                                <tr>
                                    <td><a  href="<?= site('root') . 'empresasParceiras/ConsultarId/' . $prodte['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $prodte['PK_COD']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'empresasParceiras/ConsultarId/' . $prodte['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $prodte['CNPJ']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'empresasParceiras/ConsultarId/' . $prodte['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $prodte['RAZAO_SOCIAL']); ?></a></td>
                                </tr>
                                <?php
                            }
                        } else {
                            $Pesquisa = $consultarEmpresapar->BuscarTodos();
                            ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Cod</th>
                                        <th style="width: 200px">CPF</th>
                                        <th style="width: 500px">Nome</th>
                                    </tr>
                                </thead>
                                <?php foreach ($Pesquisa as $prodTOTAL) { ?>
                                    <tr>
                                        <td><a  href="<?= site('root') . 'empresasParceiras/ConsultarId/' . $prodTOTAL['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $prodTOTAL['PK_COD']); ?></a></td>
                                        <td><a  href="<?= site('root') . 'empresasParceiras/ConsultarId/' . $prodTOTAL['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $prodTOTAL['CNPJ']); ?></a></td>
                                        <td><a  href="<?= site('root') . 'empresasParceiras/ConsultarId/' . $prodTOTAL['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $prodTOTAL['RAZAO_SOCIAL']); ?></a></td>
                         
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
