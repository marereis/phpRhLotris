<?php

?>

<div class="content">

    <input type="hidden" id="pag" value="Acesso ao Sistema" >

    <div class="divpainel">
        <div> <label class="label txt-large cor-am-cl" >Welcome!</label></div>
        <div>
            <h1 class="txt-mediun">Sistema de Gestão em RH</h1>
        </div>
        <div><img class="img-large" src="<?= asset("/img/LogoEmpresa.png"); ?>" /></div>
        <br><br><br><br>
        <div class="login_form_callback">
            <?=
            flash();
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
        </div>
      
    </div>

    <div class="divlogin">
        <form method="POST" action="<?= site("root") . "login/logar" ?>"> 
            <div><label  class="label txt-small-4 cor-br">Autenticação de Usuario</label></div><br><br>
            <div> <label  class="label txt-small cor-br" for="login">Login</label></div>
            <div> <input type="text" name="login" placeholder="Login" class="txt-form1 full mg-add-2" id="login"></div>
            <div> <label class="label txt-small cor-br" for="senha">Password</label> </div>
            <div> <input type="password" name="senha" placeholder="Password" class="txt-form1 full mg-add-2" id="senha"></div>
            <div> <input name="btLogar" type="submit" value="Log in" class="txt-small cor-br cor-bk-az-es border-cl full btnLogin" ></div>
        </form>
    </div>

</div>
