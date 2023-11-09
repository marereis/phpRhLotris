
<?php
$objCandidatos = new App\Models\Candidatos();

$candRelatorio = [];
if (!empty($_SESSION['candConsulta']) && $candRelatorio = $_SESSION['candConsulta']) {
    unset($_SESSION['candConsulta']);
}
$count = [];
if (!empty($_SESSION['count']) && $count = $_SESSION['count']) {
    unset($_SESSION['count']);
}

$_SESSION['dados']  = $candRelatorio;
$_SESSION['dados2'] = $count;
?>
<div class="contentPainel">

    <input type="hidden" id="pag" value="Relatorios de Candidatos">

    <!-- Painel  -->
    <div class="div_dR">

        <div class="grupo" style="flex-flow:row nowrap !important;justify-content: space-around ">
            <form action="<?php echo site('root').'candidatos/consultarRelatorio'; ?>"  method="POST">
                <div class="form-row" >
                    <div class="campo">
                        <label for="Opcao">Opçoes:</label> 
                        <select name="Opcao" id="Opcao" class="txt-form tm-m-210" >
                            <option value="PK_COD">Código</option>
                            <option value="NOME">Nome</option>
                            <option value="CPF">CPF</option>
                            <option value="EMAIL">Email</option>
                            <option value="BAIRRO">Bairro</option>
                            <option value="CARGO_PRETENDIDO">Cargo Pretendido</option>
                            <option value="ESCOLARIDADE">Escolaridade</option>
                            <option value="CURSO">Cursos</option>
                        </select> 
                    </div>
                    <div class="campo">
                        <label for="Parametros">Descrição:</label>
                        <input type="text" name="Parametros" id="Parametros" class="txt-form tm-m-350"  value="">
                    </div>
                    <div class="campo">
                        <label></label>
                        <button class="button txt-small-1 img-procurar-btn" id="relaVendas" title="Relatorio Candidatos">Pesquisar</button>
                    </div>
                </div> 
            </form>
            <div class="campo">
                <label></label>
                <a href="<?php echo site('root').'candidatos/relatorioPDF'; ?>" target="_blank"><button class="button txt-small-1 img-pdf-btn" id="relaVendass" title="Relatorio Candidatos PDF">Relatorio PDF</button></a>
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
                        <th>Nome</th>
                        <th>Data Nasci</th>
                        <th>CPF</th>
                        <th>Bairro</th>
                        <th>Email</th>
                        <th>Celular</th>
                        <th>Cargo</th>
                    </tr>
                </thead> 
                <?php
                if (!empty($candRelatorio)) {
                    foreach ($candRelatorio as $prodt) {
                        ?>
                        <tr>
                            <td><?php echo $prodt['PK_COD']; ?></td>
                            <td><?php echo $prodt['NOME']; ?></td>
                            <td><?php echo $prodt['DATA_NASC']; ?></td>
                            <td><?php echo $prodt['CPF']; ?></td>
                            <td><?php echo $prodt['BAIRRO']; ?></td>
                            <td><?php echo $prodt['EMAIL']; ?></td>
                            <td><?php echo $prodt['CELULAR']; ?></td>
                            <td><?php echo $prodt['CARGO_PRETENDIDO']; ?></td>
                        </tr>
                        <?php
                    }
                    // } else {
                    //     echo '<h3>Produto nao Encontrado!</h3>';
                }
                ?>
                <tr><td COLSPAN="7"><hr></td></tr>
                <TR><td COLSPAN="3" align="left"><b>QTD. Total de Itens</b></td><td><b><?php echo isset($count['Quant'])
                        ? $count['Quant'] : ''; ?></b></td></tr>
            </table>  

            <div class="login_form_callback">
                <?php
                echo flash();
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
            </div>

        </div>

    </div>


</div>

