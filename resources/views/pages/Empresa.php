<?php
$consultarEmpresa = new App\Models\Empresa();

$dadosempresa = array();
if (!empty($_SESSION['empresa']) && $dadosempresa = $_SESSION['empresa']) {
    unset($_SESSION['empresa']);
}
?>

<div class="content">

    <input type="hidden" id="pag" value="Cadastro Empresarial">

    <div class="divseparacaofix">
        <div class="grupo">
            <form class="form" method="POST" action="<?= site("root") . "empresa/cadastrar" ?>" id="formEmpresa">

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
                        <label for="respcpf">Cpf do responsável:</label> 
                        <input type="text" name="respcpf"  id="CPF_RESPONSAVEL"  class="txt-form tm-m-210" value="<?= (isset($dadosempresa["CPF_RESPONSAVEL"])) ? ($dadosempresa["CPF_RESPONSAVEL"]) : ('') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="campo">
                        <label for="celular">Celular:</label> 
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
                <button class="button txt-small-1 img-salva-btn" id="salvarEmpresa" title="Salvar Registro">Cadastrar</button>
            </div>
            <div class="campo">
                <button class="button txt-small-1 img-alterar-btn" id="alterarEmpresa" onclick="mudaAction4('<?= site('root') . 'empresa/alterar' ?>')" title="Alterar Registro">Alterar</button>
            </div>
            <div class="campo">
                <button class="button txt-small-1 img-deletar-btn" id="deletarEmpresa" onclick="mudaAction4('<?= site('root') . 'empresa/deletar' ?>')" title="Deletar Registro">Deletar</button>
            </div>
            <div class="campo">
                <a href="<?= site("root") . "controller/index" ?>" ><button class="button txt-small-1 img-sair-btn" id="sair" title="Sair Registro">Sair</button></a>
            </div>
        </div>


    </div>

    <div class="divseparacao">
        <h1 class="txt-small cor-az-es">Lista Empresa</h1>

        <div class="grupo">
            <div class="form-row">
                <div class="campo">
                    <?php
                    $Pesquisa = $consultarEmpresa->BuscarTodos();

                    if (isset($Pesquisa)) {
                        ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>CNPJ</th>
                                    <th style="width: 500px">Nome Empresarial</th>
                                    <th>Responsavel</th>
                                </tr>
                            </thead>
                            <?php foreach ($Pesquisa as $prod) { ?>

                                <tr>
                                    <td><a href="<?= site('root') . 'empresa/ConsultarId/' . $prod['PK_COD'] ?>" title="Editar dados"><?PHP echo ($prod['PK_COD']); ?></a></td>
                                    <td><a href="<?= site('root') . 'empresa/ConsultarId/' . $prod['PK_COD']; ?>" title="Editar dados"><?PHP echo ($prod['CNPJ']); ?></a></td>
                                    <td><a href="<?= site('root') . 'empresa/ConsultarId/' . $prod['PK_COD']; ?>" title="Editar dados"><?PHP echo ($prod['RAZAO_SOCIAL']); ?></a></td>
                                    <td><a href="<?= site('root') . 'empresa/ConsultarId/' . $prod['PK_COD']; ?>" title="Editar dados"><?PHP echo ($prod['RESPONSAVEL']); ?></a></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo '<p><h4>Produto nao Encontrado!</h4></P>';
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
