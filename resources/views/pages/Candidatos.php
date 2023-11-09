<?php
$consultarCandidatos = new App\Models\Candidatos();

$dadoscand = array();
if (!empty($_SESSION['candidato']) && $dadoscand = $_SESSION['candidato']) {
    unset($_SESSION['candidato']);
}
$candConsultar = array();
if (!empty($_SESSION['candidatosConsulta']) && $candConsultar = $_SESSION['candidatosConsulta']) {
    unset($_SESSION['candidatosConsulta']);
}
?>

<div class="content">

    <input type="hidden" id="pag" value="Cadastro de Candidatos">

    <div class="divseparacaofix">


        <div class="grupo">
            <form  class="form" id="formCandidatos" method="post" action='<?= site("root") . "candidatos/cadastrar" ?>' >

                <div class="form-row">
                    <div class="campo">
                        <label for="Pk_cod">Codigo:</label>
                        <input type="text" class="tm-p-110" name="Pk_cod" id="Pk_cod" value="<?= (isset($dadoscand['PK_COD'])) ? ($dadoscand['PK_COD']) : ('0') ?>">
                    </div>
                    <div class="campo">
                        <label for="Nome">Nome:</label>
                        <input type="text" class="tm-g-550" name="Nome" id="Nome" value="<?= (isset($dadoscand['NOME'])) ? ($dadoscand['NOME']) : ('') ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="campo">
                        <label for="Gênero">Gênero:</label>
                        <select name="Gênero" id="Gênero" class="tm-m-180" value="<?= (isset($dadoscand['SEXO'])) ? ($dadoscand['SEXO']) : ('') ?>">
                            <option><?= (isset($dadoscand['SEXO'])) ? ($dadoscand['SEXO']) : ('') ?></option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Outros">Outros</option>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="Data_nasc">Data nasc:</label>
                        <input type="date" class="tm-m-210" name="Data_nasc" id="Data_nasc" value="<?= (isset($dadoscand['DATA_NASC'])) ? ($dadoscand['DATA_NASC']) : ('') ?>">
                    </div> 
                    <div class="campo">
                        <label for="Idade">Idade:</label>
                        <input type="text" class="tm-p-90" name="Idade" id="Idade" value="<?= (isset($dadoscand['IDADE'])) ? ($dadoscand['IDADE']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="Estado_Civil">Estado Civil:</label>
                        <select name="Estado_Civil" id="Estado_Civil" class="tm-p-150" value="<?= (isset($dadoscand['ESTADO_CIVIL'])) ? ($dadoscand['ESTADO_CIVIL']) : ('') ?>">
                            <option><?= (isset($dadoscand['ESTADO_CIVIL'])) ? ($dadoscand['ESTADO_CIVIL']) : ('') ?></option>
                            <option value="Casado">Casado</option>
                            <option value="Solteiro">Solteiro</option>
                            <option value="Divociado">Divociado</option>
                            <option value="Outros">Outros</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="campo">
                        <label for="Nome_conj">Nome Cônjuge:</label>
                        <input type="text" class="tm-g-550" name="Nome_conj" id="Nome_conj" value="<?= (isset($dadoscand['NOME_CONJUGE'])) ? ($dadoscand['NOME_CONJUGE']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="Filhos">Filhos:</label>
                        <input type="text" class="tm-p-110" name="Filhos" id="Filhos" value="<?= (isset($dadoscand['QTD_FILHOS'])) ? ($dadoscand['QTD_FILHOS']) : ('0') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="campo">
                        <label for="Nome_mae">Nome Mae:</label>
                        <input type="text" class="tm-g-550" name="Nome_mae" id="Nome_mae" value="<?= (isset($dadoscand['NOME_MAE'])) ? ($dadoscand['NOME_MAE']) : ('') ?>">
                    </div>
                    <div class="campo">
                        <label for="Deficiente">Deficiente:</label>
                        <input type="text" class="tm-p-110" name="Deficiente" id="Deficiente" value="<?= (isset($dadoscand['DEFICIENTE'])) ? ($dadoscand['DEFICIENTE']) : ('0') ?>">
                    </div>
                </div>

                <br>

                <div class="aba">
                    <a href="#item1">Endereço/Contatos</a>
                    <a href="#item2">Documentação/Cargo</a>
                    <a href="#item3">Formação</a>
                    <a href="#item4">Experiencia 1</a>
                    <a href="#item5">Experiencia 2</a>
                    <a href="#item6">Experiencia 3</a>
                    <a href="#item7">Parecer Recrutador</a>
                </div>

                <div class="items">
                    <!--CONTATOS E ENDEREÇO-->
                    <section id="item1">

                        <div class="form-row">
                            <div class="campo">
                                <label for="Cep">CEP:</label>
                                <input type="text" class="tm-p-130" name="Cep" id="Cep" value="<?= (isset($dadoscand['CEP'])) ? ($dadoscand['CEP']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="Endereco">Endereço:</label>
                                <input type="text" class="tm-g-550" name="Endereco" id="Endereco" value="<?= (isset($dadoscand['ENDERECO'])) ? ($dadoscand['ENDERECO']) : ('') ?>">
                            </div>
                        </div>

                        <div class="form-row ">
                            <div class="campo">
                                <label for="Bairro">Bairro:</label>
                                <input type="text" class="tm-m-280" name="Bairro" id="Bairro" value="<?= (isset($dadoscand['BAIRRO'])) ? ($dadoscand['BAIRRO']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="Uf">UF:</label>
                                <select name="Uf" id="Uf" class="tm-p-90" value="<?= (isset($dadoscand['UF'])) ? ($dadoscand['UF']) : ('') ?>">
                                    <option><?= (isset($dadoscand['UF'])) ? ($dadoscand['UF']) : ('') ?></option>
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
                                <input type="text" class="tm-m-280" name="Cidade" id="Cidade" value="<?= (isset($dadoscand['CIDADE'])) ? ($dadoscand['CIDADE']) : ('') ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="campo">
                                <label for="Facebook">Facebook:</label>
                                <input type="text" class="tm-m-310" name="Facebook" id="Facebook" value="<?= (isset($dadoscand['FACEBOOK'])) ? ($dadoscand['FACEBOOK']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="Instagran">Instagran:</label>
                                <input type="text" class="tm-m-350" name="Instagran" id="Instagran" value="<?= (isset($dadoscand['INSTAGRAN'])) ? ($dadoscand['INSTAGRAN']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="Email">E-mail:</label>
                                <input type="text" class="tm-g-400" name="Email" id="Email" value="<?= (isset($dadoscand['EMAIL'])) ? ($dadoscand['EMAIL']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="Celular">Celular:</label>
                                <input type="text" class="tm-m-280" name="Celular" id="Celular" value="<?= (isset($dadoscand['CELULAR'])) ? ($dadoscand['CELULAR']) : ('') ?>">
                            </div>
                        </div>

                    </section>
                    <!--DOCUMENTAÇÃO/CARGO-->
                    <section id="item2">

                        <div class="form-row">
                            <div class="campo">
                                <label for="Cargo_pretend">Cargo Pretendido: </label>
                                <input type="text" class="tm-g-620" name="Cargo_pretend" id="Cargo_pretend" value="<?= (isset($dadoscand['CARGO_PRETENDIDO'])) ? ($dadoscand['CARGO_PRETENDIDO']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="Identidade">Identidade:</label>
                                <input type="text" class="tm-m-280" name="Identidade" id="Identidade" value="<?= (isset($dadoscand['IDENTIDADE'])) ? ($dadoscand['IDENTIDADE']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="CPF">CPF:</label>
                                <input type="text" class="tm-m-280" name="CPF" id="CPF" value="<?= (isset($dadoscand['CPF'])) ? ($dadoscand['CPF']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="PIS">PIS:</label>
                                <input type="text" class="tm-m-280" name="PIS" id="PIS" value="<?= (isset($dadoscand['PIS'])) ? ($dadoscand['PIS']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="ctps">Carteira de trabalho:</label>
                                <input type="text" class="tm-m-280" name="ctps" id="ctps" value="<?= (isset($dadoscand['CTPS'])) ? ($dadoscand['CTPS']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="titulo">Titulo de Eleitor:</label>
                                <input type="text" class="tm-m-280" name="titulo" id="titulo" value="<?= (isset($dadoscand['TITULO_ELEITOR'])) ? ($dadoscand['TITULO_ELEITOR']) : ('') ?>">
                            </div>
                        </div>

                    </section>
                    <!--FORMAÇÃO-->
                    <section id="item3">

                        <div class="form-row">
                            <div class="campo">
                                <label for="Escolaridade">Escolaridade:</label>
                                <select name="Escolaridade" id="Escolaridade" class="tm-g-400" value="<?= (isset($dadoscand['ESCOLARIDADE'])) ? ($dadoscand['ESCOLARIDADE']) : ('') ?>">
                                    <option><?= (isset($dadoscand['ESCOLARIDADE'])) ? ($dadoscand['ESCOLARIDADE']) : ('') ?></option>
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
                                <label for="Curso">Curso:</label>
                                <input type="text" class="tm-g-620" name="Curso" id="Curso" value="<?= (isset($dadoscand['CURSO'])) ? ($dadoscand['CURSO']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="Curso_extra1">Curso Extracurricular:</label>
                                <input type="text" class="tm-g-620" name="Curso_extra1" id="Curso_extra1" value="<?= (isset($dadoscand['CURSO_EXTRA1'])) ? ($dadoscand['CURSO_EXTRA1']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="Curso_extra2">Curso Extracurricular:</label>
                                <input type="text" class="tm-g-620" name="Curso_extra2" id="Curso_extra2" value="<?= (isset($dadoscand['CURSO_EXTRA2'])) ? ($dadoscand['CURSO_EXTRA2']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="Curso_extra3">Curso Extracurricular:</label>
                                <input type="text" class="tm-g-620" name="Curso_extra3" id="Curso_extra3" value="<?= (isset($dadoscand['CURSO_EXTRA3'])) ? ($dadoscand['CURSO_EXTRA3']) : ('') ?>">
                            </div>
                        </div>

                    </section>

                    <!--EXP.PROFISSIONAL 1-->
                    <section id="item4">
                        <div class="form-row">
                            <div class="campo">
                                <label for="Empresa1">1ª Empresa:</label>
                                <input type="text" class="tm-g-500" name="Empresa1" id="Empresa1" value="<?= (isset($dadoscand['EMPRESA1'])) ? ($dadoscand['EMPRESA1']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="Função1">Função:</label>
                                <input type="text" class="tm-m-310" name="Função1" id="Função1" value="<?= (isset($dadoscand['CARGO1'])) ? ($dadoscand['CARGO1']) : ('') ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="campo">
                                <label for="Salario1">Salario:</label>
                                <input type="text" class="tm-m-210" name="Salario1" id="Salario1" value="<?= (isset($dadoscand['SALARIO1'])) ? ($dadoscand['SALARIO1']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="Periodo1">Periodo:</label>
                                <input type="text" class="tm-m-310" name="Periodo1" id="Periodo1" value="<?= (isset($dadoscand['PERIODO1_1'])) ? ($dadoscand['PERIODO1_1']) : ('') ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="campo">
                                <label for="Atividades1">Atividades:</label>
                                <textarea name="Atividades1"  id="Atividades1"  style="width: 38em; height: 4em"> <?= isset($dadoscand['ATIVIDADES1']) ? $dadoscand['ATIVIDADES1'] : '' ?> </textarea>
                            </div>
                        </div>
                    </section>
                    <!--EXP.PROFISSIONAL 2-->
                    <section id="item5">

                        <div class="form-row">
                            <div class="campo">
                                <label for="Empresa2">2ª Empresa:</label>
                                <input type="text" class="tm-g-500" name="Empresa2" id="Empresa2" value="<?= (isset($dadoscand['EMPRESA2'])) ? ($dadoscand['EMPRESA2']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="Função2">Função:</label>
                                <input type="text" class="tm-m-310" name="Função2" id="Função2" value="<?= (isset($dadoscand['CARGO2'])) ? ($dadoscand['CARGO2']) : ('') ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="campo">
                                <label for="Salario2">Salario:</label>
                                <input type="text" class="tm-m-210" name="Salario2" id="Salario2" value="<?= (isset($dadoscand['SALARIO2'])) ? ($dadoscand['SALARIO2']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="Periodo2">Periodo:</label>
                                <input type="text" class="tm-m-310" name="Periodo2" id="Periodo2" value="<?= (isset($dadoscand['PERIODO2_1'])) ? ($dadoscand['PERIODO2_1']) : ('') ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="campo">
                                <label for="Atividades2">Atividades:</label>
                                <textarea name="Atividades2"  id="Atividades2"  style="width: 38em; height: 4em"> <?= isset($dadoscand['ATIVIDADES2']) ? $dadoscand['ATIVIDADES2'] : '' ?> </textarea>
                            </div>
                        </div>

                    </section>
                    <!--EXP.PROFISSIONAL 3-->
                    <section id="item6">

                        <div class="form-row">
                            <div class="campo">
                                <label for="Empresa3">3ª Empresa:</label>
                                <input type="text" class="tm-g-500" name="Empresa3" id="Empresa3" value="<?= (isset($dadoscand['EMPRESA3'])) ? ($dadoscand['EMPRESA3']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="Função3">Função:</label>
                                <input type="text" class="tm-m-310" name="Função3" id="Função3" value="<?= (isset($dadoscand['CARGO3'])) ? ($dadoscand['CARGO3']) : ('') ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="campo">
                                <label for="Salario3">Salario:</label>
                                <input type="text" class="tm-m-210" name="Salario3" id="Salario3" value="<?= (isset($dadoscand['SALARIO3'])) ? ($dadoscand['SALARIO3']) : ('') ?>">
                            </div>
                            <div class="campo">
                                <label for="Periodo3">Periodo:</label>
                                <input type="text" class="tm-m-310" name="Periodo3" id="Periodo3" value="<?= (isset($dadoscand['PERIODO3_1'])) ? ($dadoscand['PERIODO3_1']) : ('') ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="campo">
                                <label for="Atividades3">Atividades:</label>
                                <textarea name="Atividades3"  id="Atividades3"  style="width: 38em; height: 4em"> <?= isset($dadoscand['ATIVIDADES3']) ? $dadoscand['ATIVIDADES3'] : '' ?> </textarea>
                            </div>
                        </div>

                    </section>

                    <section id="item7">
                        <div class="form-row">
                            <div class="campo">
                                <label for="Parecer">Parecer do Recrutador:</label>
                                <textarea name="Parecer"  id="Parecer"  style="width: 38em; height: 12em"> <?= isset($dadoscand['OBS_ENTREVISTADOR']) ? $dadoscand['OBS_ENTREVISTADOR'] : '' ?> </textarea>
                            </div>
                        </div>
                    </section>
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
                <button class="button txt-small-1 img-salva-btn tm-p-130" id="salvarCandidatos" title="Salvar Registro">Cadastrar</button>
            </div>
            <div class="campo">
                <button class="button txt-small-1 img-alterar-btn tm-p-130" id="alterarCandidatos" onclick="mudaAction('<?= site('root') . 'candidatos/alterar' ?>')" title="Alterar Registro">Alterar</button>
            </div>
            <div class="campo">
                <button class="button txt-small-1 img-deletar-btn tm-p-130" id="deletarCandidatos" onclick="mudaAction('<?= site('root') . 'candidatos/deletar' ?>')"  title="Deletar Registro">Deletar</button>
            </div>
             <div class="campo">
                <a href="<?= site('root') . 'candidatos/curriculoCandPDF' ?>" target="_blank"><button class="button txt-small-1 img-pdf-btn tm-p-130" id="relaVendass" title="Curriculo Candidato">CRV PDF</button></a>
            </div>
            <div class="campo">
                <a href="<?= site("root") . "controller/index" ?>" ><button class="button txt-small-1 img-sair-btn tm-p-130" id="sair" title="Sair Registro">Sair</button></a>
            </div>
        </div>

    </div>

    <div class="divseparacao">

        <h1 class="txt-small cor-az-es">Lista de Candidatos</h1>

        <form action="<?= site("root") . "candidatos/consultar" ?>"  method="POST">
            <div class="grupo">
                <div class="form-row">
                    <div class="campo">
                        <label for="Opcao">Codigo:</label>
                        <select name="Opcao" id="Opcao" class="txt-form tm-m-210" value="">
                            <option value="PK_COD">Código</option>
                            <option value="CPF">CPF</option>
                            <option value="NOME">Nome</option>
                            <option value="CARGO_PRETENDIDO">Cargo Pretendido</option>
                            <option value="ESCOLARIDADE">Escolaridade</option>
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
        <div class="grupo" style="overflow-x: auto; height: 490px">
            <div class="form-row" style="overflow-x: auto; height: 480px;" >
                <div class="campo">
                    <?php
                    $Pesquisa = $consultarCandidatos->BuscarTodos();
                    if (!empty($candConsultar)) {
                        ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Cod</th>
                                    <th style="width: 200px">CPF</th>
                                    <th style="width: 500px">Nome</th>
                                </tr>
                            </thead>
                            <?php foreach ($candConsultar as $prodte) { ?>
                                <tr>
                                    <td><a  href="<?= site('root') . 'candidatos/ConsultarId/' . $prodte['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $prodte['PK_COD']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'candidatos/ConsultarId/' . $prodte['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $prodte['CPF']); ?></a></td>
                                    <td><a  href="<?= site('root') . 'candidatos/ConsultarId/' . $prodte['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $prodte['NOME']); ?></a></td>
                                </tr>
                                <?php
                            }
                        } else {
                            $Pesquisa = $consultarCandidatos->BuscarTodos();
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
                                        <td><a  href="<?= site('root') . 'candidatos/ConsultarId/' . $prodTOTAL['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $prodTOTAL['PK_COD']); ?></a></td>
                                        <td><a  href="<?= site('root') . 'candidatos/ConsultarId/' . $prodTOTAL['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $prodTOTAL['CPF']); ?></a></td>
                                        <td><a  href="<?= site('root') . 'candidatos/ConsultarId/' . $prodTOTAL['PK_COD'] ?>" title="Editar dados"><?PHP echo ( $prodTOTAL['NOME']); ?></a></td>

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

