<?php
$consultarUsuarios = new App\Models\Usuarios();

$user = array();
if (!empty($_SESSION['user']) && $user = $_SESSION['user']) {
    unset($_SESSION['user']);
}
//if (!isset($_SESSION['usuario_id'])) {
//    $urlDestino = site("root") . 'erro/index';
//    header("Location: $urlDestino");
//}
?>
<div class="content">

    <input type="hidden" id="pag" value="Cadastro de Usuários">

    <div class="divseparacaofix">
        <div class="grupo">
            <form class="form" method="POST" action="<?= site("root") . "usuarios/cadastrar" ?>" id="formUsuarios">

                <div class="form-row">
                    <div class="campo">
                        <label for="Pk_cod">Codigo:</label>
                        <input type="text" class="tm-p-90" name="Pk_cod" id="Pk_cod" value="<?= (isset($user['PK_COD'])) ? ($user['PK_COD']) : ('0') ?>">
                    </div>
                    <div class="campo">
                        <label for="Nome">Nome:</label>
                        <input type="text" class="tm-g-500" name="Nome" id="Nome" value="<?= (isset($user['NOME'])) ? ($user['NOME']) : ('') ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="campo">
                        <label for="Codigo_Acesso">Codigo Acesso:</label>
                        <input type="text" class="tm-m-180" name="Codigo_Acesso" id="Codigo_Acesso" value="<?= (isset($user['CODIGO'])) ? ($user['CODIGO']) : ('') ?>">
                    </div> 
                    <div class="campo">
                        <label for="Senha_Acesso">Senha Acesso:</label>
                        <input type="password" class="tm-m-180" name="Senha_Acesso" id="Senha_Acesso" value="<?= (isset($user['SENHA'])) ? ($user['SENHA']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="Funcao">Funcao:</label>
                        <select name="Funcao" id="Funcao" class="tm-m-260" value="<?= (isset($user['FUNCAO'])) ? ($user['FUNCAO']) : ('') ?>">
                            <option><?= (isset($user['FUNCAO'])) ? ($user['FUNCAO']) : ('') ?></option>
                            <option value="Caixa">Caixa</option>
                            <option value="Atendente">Atendente</option>
                            <option value="Gerente">Gerente</option>
                            <option value="Administrador">Administrador</option>
                        </select>
                    </div>

                </div>

                <div class="form-row">
                    <div class="campo">
                        <label for="Cpf">CPF:</label>
                        <input type="text" class="tm-m-210" name="Cpf" id="Cpf" value="<?= (isset($user['CPF'])) ? ($user['CPF']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="Celular">Celular:</label>
                        <input type="text" class="tm-p-150" name="Celular" id="Celular" value="<?= (isset($user['CELULAR'])) ? ($user['CELULAR']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="Email">E-mail:</label>
                        <input type="text" class="tm-m-280" name="Email" id="Email" value="<?= (isset($user['EMAIL'])) ? ($user['EMAIL']) : ('') ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="campo">
                        <label for="Cep">CEP:</label>
                        <input type="text" class="tm-p-150" name="Cep" id="Cep" value="<?= (isset($user['CEP'])) ? ($user['CEP']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="Endereco">Endereço:</label>
                        <input type="text" class="tm-g-500" name="Endereco" id="Endereco" value="<?= (isset($user['ENDERECO'])) ? ($user['ENDERECO']) : ('') ?>">
                    </div>
                </div>

                <div class="form-row ">
                    <div class="campo">
                        <label for="Bairro">Bairro:</label>
                        <input type="text" class="tm-m-280" name="Bairro" id="Bairro" value="<?= (isset($user['BAIRRO'])) ? ($user['BAIRRO']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="Uf">UF:</label>
                        <select name="Uf" id="Uf" class="tm-p-90" value="<?= (isset($user['UF'])) ? ($user['UF']) : ('') ?>">
                            <option><?= (isset($user['UF'])) ? ($user['UF']) : ('') ?></option>
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
                        <input type="text" class="tm-m-280" name="Cidade" id="Cidade" value="<?= (isset($user['CIDADE'])) ? ($user['CIDADE']) : ('') ?>">
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
                <button class="button txt-small-1 img-salva-btn" id="salvarUsuarios" formaction="formUsuarios" title="Salvar Registro">Cadastrar</button>
            </div>
            <div class="campo">
                <button class="button txt-small-1 img-alterar-btn" id="alterarUsuarios" onclick="mudaAction3('<?= site('root') . 'usuarios/alterar' ?>')" title="Alterar Registro">Alterar</button>
            </div>
            <div class="campo">
                <button class="button txt-small-1 img-deletar-btn" id="deletarUsuarios" onclick="mudaAction3('<?= site('root') . 'usuarios/deletar' ?>')" title="Deletar Registro">Deletar</button>
            </div>
            <div class="campo">
                <a href="<?= site("root") . "controller/index" ?>" ><button class="button txt-small-1 img-sair-btn" id="sair" title="Sair Registro">Sair</button></a>
            </div>
        </div>
    </div>

    <div class="divseparacao">
        <h1 class="txt-small cor-az-es">Lista de Usuários</h1>
        <div class="grupo">
            <div class="form-row">
                <div class="campo">
                    <?php
                    $Pesquisa = $consultarUsuarios->BuscarTodos();
                    if (!empty($Pesquisa)) {
                        ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th style="width: 600px">Nome</th>
                                    <th style="width: 600px">Email</th>
                                    <th style="width: 600px">Telefone</th>
                                </tr>
                            </thead>
                            <?php foreach ($Pesquisa as $prodte) { ?>
                                <tr>
                                    <td><a  href="<?= site('root') . 'usuarios/ConsultarId/' . $prodte['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $prodte['CODIGO']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'usuarios/ConsultarId/' . $prodte['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $prodte['NOME']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'usuarios/ConsultarId/' . $prodte['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $prodte['EMAIL']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'usuarios/ConsultarId/' . $prodte['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $prodte['CELULAR']); ?></a></td>
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
