
<div class="content">
       
    <input type="hidden" id="pag" value="Assistente Backup de BD" >

    <div class="divpainel divseparacaofix">
        <div>
            <img class="img-tinyy" src="<?= asset("/img/backupImagen.svg"); ?>"/>
        </div>
        <div>
            <h1 class="txt-small centro"> Gerar um Backup completo do Banco de Dados</h1>
        </div>
        <div id="progressbar"><div class="progress-label"></div></div>

        <div class="form-row">
            <div class="campo">
                <a href="<?= site("root") . "controller/gerarBackup" ?>" ><button class="button txt-small-1 img-Backup-btn" id="salvarEmpresa" title="Gerar Backup Completo" onclick="barrapro()">Gerar Backup</button></a>
            </div>
            <div class="campo">
                <a href="<?= site("root") . "controller/index" ?>" ><button class="button txt-small-1 img-sair-btn" id="sair" title="Sair Registro">Sair</button></a>
            </div>
        </div>



        <style>
           
        </style>
        <script>
            
        </script>


    </div>

</div>   



