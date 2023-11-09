<?php
$objEcaminhamento = new \App\Models\Encaminhamentos();
?>

<div class="content">

    <input type="hidden" id="pag" value="Enviar E-mail Carta de Encaminhamento">

    <div class="divseparacaofix">
        <div class="grupo">  
            <form method="POST" action="<?php echo site('root').'encaminhamentos/LancaCartaEmail'; ?>" id="formEncamin">

                <div class="form-row">
                    <div class="campo">
                        <label for="codEncamCE">Código Encaminhamento:</label>
                        <input type="text" name="codEncamCE" id="codEncamCE" class="txt-form tm-m-180 cor-bk-cz-l" onkeypress="consultarCartaEncaminhar()"
                               value="" >
                    </div>
                </div>
                <hr style="margin: 0.5em 0.5em; border: 1px solid rgba(238, 147, 10, 0.925); max-width: 100%;">
                <div class="form-row">
                    <div class="campo">
                        <label for="Codigo_vagaCE">Codigo Vaga:</label>
                        <input type="text" name="Codigo_vagaCE" id="Codigo_vagaCE" class="txt-form tm-p-110 " onkeypress="consultarVagas()"
                               value="" autocomplete="">
                    </div>
                    <div class="campo">
                        <label for="Cargo_prentCE">Cargo Pretendido:</label>
                        <input type="text" name="Cargo_prentCE" id="Cargo_prentCE" class="txt-form tm-g-500" 
                               value="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="campo">
                        <label for="pk_cod_empreCE">Codigo:</label> 
                        <input type="text" name="pk_cod_empreCE" id="pk_cod_empreCE" class="txt-form tm-p-110" 
                               value="">
                    </div>
                    <div class="campo">
                        <label for="razao_socialCE">Razão Social:</label> 
                        <input type="text" name="razao_socialCE" id="razao_socialCE"  class="txt-form tm-g-500" 
                               value="">
                    </div>
                    <div class="campo">
                        <label for="email_empresaCE">Email Empresa:</label> 
                        <input type="text" name="email_empresaCE" id="email_empresaCE"  class="txt-form tm-g-550" 
                               value="">
                    </div>
                </div>

                <hr style="margin: 0.5em 0.5em; border: 1px solid rgba(238, 147, 10, 0.925); max-width: 100%;">
                <div class="form-row">
                    <div class="campo">
                        <label for="pk_cod_candCE">Codigo:</label>
                        <input type="text" name="pk_cod_candCE" id="pk_cod_candCE" class="txt-form tm-p-110 " onkeypress="consultarCandidato()"
                               value="">
                    </div>
                    <div class="campo">
                        <label for="nome_candCE">Nome:</label>
                        <input type="text" name="nome_candCE" id="nome_candCE" class="txt-form tm-g-500" 
                               value="">
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="campo">
                        <button class="button txt-small-1 img-alterar-btn" id="LancarCE" title="Incluir Carta">Incluir</button>
                    </div>
                </div>
            </form>  
        </div>

        <div class="login_form_callback">
<?php echo flash();
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
        </div>

        <div class="painelcontrolform">
            <div class="campo">
                <button class="button txt-small-1 img-salva-btn" id="enviaCarta01" title="Enviar Carta de Encaminhamentos">Enviar E-mail</button>
            </div>

            <div class="campo">
                <a href="<?php echo site('root').'controller/index'; ?>" ><button class="button txt-small-1 img-sair-btn" id="sair" title="Sair Registro">Sair</button></a>
            </div>
        </div>

    </div>

    <div class="divseparacao">

        <h1 class="txt-small cor-az-es">Encaminhamentos</h1>

        <div class="grupo">
            <div class="form-row">
                <form id="formCartaEmail" action="<?php echo site('root').'encaminhamentos/cartaEncaminharEmail/'; ?>" >
                    <div class="campo">
<?php if (!empty($_SESSION['cartaEmail']['item'])) { ?>

                            <table>
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Vaga</th>
                                        <th>Razão Social</th>
                                        <th>Email Empresa</th>
                                        <th>Candidato</th>
                                    </tr>
                                </thead>

    <?php
    foreach ($_SESSION['cartaEmail']['item'] as $id => $qtda) {
        foreach ($objEcaminhamento->encaminhamentoIdCE($id) as $cartasSelect) {
            // var_dump($cartasSelect);
            ?>
                                        <tr name="">
                                            <td><a href="<?php echo site('root').'encaminhamentos/DeletarTabelaCartaEmail/'.$cartasSelect['PK_COD']; ?>"><?php echo $cartasSelect['PK_COD']; ?></a></td>
                                            <td><a href="<?php echo site('root').'encaminhamentos/DeletarTabelaCartaEmail/'.$cartasSelect['PK_COD']; ?>" ><?php echo $cartasSelect['CARGO_PRETENDIDO']; ?></a></td>
                                            <td><a href="<?php echo site('root').'encaminhamentos/DeletarTabelaCartaEmail/'.$cartasSelect['PK_COD']; ?>" ><?php echo $cartasSelect['EMPRESA']; ?></a></td>
                                            <td><a href="<?php echo site('root').'encaminhamentos/DeletarTabelaCartaEmail/'.$cartasSelect['PK_COD']; ?>" ><?php echo $cartasSelect['EMAIL_ENCAM_EMPRE']; ?></a></td>
                                            <td><a href="<?php echo site('root').'encaminhamentos/DeletarTabelaCartaEmail/'.$cartasSelect['PK_COD']; ?>" ><?php echo $cartasSelect['CANDIDATO']; ?></a></td>
                                        </tr>
                                                    <?php
        }
    }
    ?>
                        
                                        <?php
} else {
    echo '<p><h4 class="txt-small-2 cor-az">Nenhum Encaminhamento listado!</h4></P>';
}
                                    // var_dump($_SESSION['estoque']['item']);
?>

                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


