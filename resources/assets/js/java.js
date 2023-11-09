/* 
 Created on : 06/01/2021, 11:03:52
 Author     : Mare
 */
const  URL = "http://localhost:81/rhlotris/";

/**
 * 
 * @type Element Painel de informativo de pagina
 */
$(function () {
    var pag = document.getElementById('pag');
    var titlepag = document.getElementById("titlepag");

    if (pag !== null) {
        titlepag.innerHTML = pag.value;
    }
});
/**
 * FUNÇÃO RETORNA DATA E HOTA ATUALIZADA
 * @returns {undefined}
 */
$(function (){
    
   let digitalElement =document.querySelector(".horadigital");
   
    function updateHora(){
        let now = new Date();
        let hour = now.getHours();
        let minute = now.getMinutes();
        let second = now.getSeconds();
        let datahoje = now.getDate() + "/" + (now.getMonth() + 1) + "/" + now.getFullYear();
        
        digitalElement.innerHTML = `${datahoje} - ${addZero(hour)}:${addZero(minute)}:${addZero(second)}`;
    }
    
    function addZero(time) {
        return time < 10 ? `0${time}` : time;        
    }
    
    setInterval(updateHora, 1000)
});

/**
 * muda o action e submita o formulario Candidatos
 * @type type 
 */
$(function () {
    $("#salvarCandidatos").click(function (e) {
        $("#formCandidatos").submit();
        e.preventDefault();
    });
    $("#alterarCandidatos").click(function (e) {
        $("#formCandidatos").submit();
        e.preventDefault();
    });
    $("#deletarCandidatos").click(function (e) {
        $("#formCandidatos").submit();
        e.preventDefault();
    });

});

function mudaAction(pagina) {
    document.getElementById("formCandidatos").action = pagina;
}

/**
 * botoes do formulario Vagas
 * @returns {undefined}
 */
$(function () {
    $("#salvarVagas").click(function (e) {
        $("#formVagas").submit();
        e.preventDefault();
    });
    $("#alterarVagas").click(function (e) {
        $("#formVagas").submit();
        e.preventDefault();
    });
    $("#deletarVagas").click(function (e) {
        $("#formVagas").submit();
        e.preventDefault();
    });

});
function mudaAction2(pagina1) {
    document.getElementById("formVagas").action = pagina1;
}

/**
 * botoes do formulario Usuarios
 * @returns {undefined}
 */
$(function () {
    $("#salvarUsuarios").click(function (e) {
        $("#formUsuarios").submit();
        e.preventDefault();
    });
    $("#alterarUsuarios").click(function (e) {
        $("#formUsuarios").submit();
        e.preventDefault();
    });
    $("#deletarUsuarios").click(function (e) {
        $("#formUsuarios").submit();
        e.preventDefault();
    });

});
function mudaAction3(pagina3) {
    document.getElementById("formUsuarios").action = pagina3;
}


/**
 * botoes do formulario EMPRESA
 * @returns {undefined}
 */
$(function () {
    $("#salvarEmpresa").click(function (e) {
        $("#formEmpresa").submit();
        e.preventDefault();
    });
    $("#alterarEmpresa").click(function (e) {
        $("#formEmpresa").submit();
        e.preventDefault();
    });
    $("#deletarEmpresa").click(function (e) {
        $("#formEmpresa").submit();
        e.preventDefault();
    });

});
function mudaAction4(pagina4) {
    document.getElementById("formEmpresa").action = pagina4;
}


/**
 * botoes do formulÁrio EMPRESA PARCEIRAS
 * @returns {undefined}
 */
$(function () {
    $("#salvarEmpresa_par").click(function (e) {
        $("#formEmpresa_par").submit();
        e.preventDefault();
    });
    $("#alterarEmpresa_par").click(function (e) {
        $("#formEmpresa_par").submit();
        e.preventDefault();
    });
    $("#deletarEmpresa_par").click(function (e) {
        $("#formEmpresa_par").submit();
        e.preventDefault();
    });

});
function mudaAction7(pagina7) {
    document.getElementById("formEmpresa_par").action = pagina7;
}

/**
 * botoes do formulario ENCAMINHAMENTOS
 * @returns {undefined}
 */
$(function () {
    $("#salvarEncamin").click(function (e) {
        $("#formEncamin").submit();
        e.preventDefault();
    });
    $("#alterarEncamin").click(function (e) {
        $("#formEncamin").submit();
        e.preventDefault();
    });
    $("#deletarEncamin").click(function (e) {
        $("#formEncamin").submit();
        e.preventDefault();
    });
        $("#enviaCarta01").click(function (e) {
        $("#formCartaEmail").submit();
        e.preventDefault();
    });

});
function mudaAction5(pagina5) {
    document.getElementById("formEncamin").action = pagina5;
}
function mudaAction6(pagina6) {
    document.getElementById("formCartaEmail").action = pagina6;
}


function imprimirCarta() {
    var conteudo = document.getElementById("CartaEncaminhamento").innerHTML;
    var tela_impressao = window.open("about:blank");
    tela_impressao.document.write(conteudo);
    tela_impressao.window.print(conteudo);
    tela_impressao.window.close("about:blank");
    window.location.reload = URL + "/encaminhamentos/index";
}

function consultarEmpresa() {

    //RETORNA O DADOS DO CANDIDATOS PARA ENCAMINHEMENTO
    $("#Codigo_emp").keyup(function (e) {
        e.preventDefault();
        // console.log($("#pk_cod_cand").val() + "chegando");
        $.ajax({
            url: URL + '/app/Models/Api.php?req=2',  
            method: 'POST',
            dataType: 'json',
            data: {Codigo_emp: $("#Codigo_emp").val()},
            success: function (dados) {
                console.log(dados);
                $("#Codigo_emp").val(dados.PK_COD);
                $("#Descricaoempre").val(dados.RAZAO_SOCIAL).css('color', 'black');
                $("#CNPJempre").val(dados.CNPJ);
            },
            error: function () {
                $("#Descricaoempre").val("Ooops..Erro-Empresa nao Encotrada").css('color', 'red');
            }
        });
    });
}

function consultarCandidato() {

    //RETORNA O DADOS DO CANDIDATOS PARA ENCAMINHEMENTO
    $("#pk_cod_cand").keyup(function (e) {
        e.preventDefault();
        // console.log($("#pk_cod_cand").val() + "chegando");
        $.ajax({
            url: URL + '/app/Models/Api.php?req=4',
            method: 'POST',
            dataType: 'json',
            data: {pk_cod_cand: $("#pk_cod_cand").val()},
            success: function (dados) {
                console.log(dados);
                $("#pk_cod_cand").val(dados.PK_COD);
                $("#nome_cand").val(dados.NOME).css('color', 'black');
                $("#tel_cand").val(dados.CELULAR);
                $("#email_cand").val(dados.EMAIL);
            },
            error: function () {
                $("#nome_cand").val("Oooops... Erro - Candidato nao Encotrado").css('color', 'red');
            }
        });
    });
}


function consultarVagas() {
    //RETORNA O DADOS DO VAGA PARA ENCAMINHEMENTO
    $("#Codigo_vaga").keyup(function (e) {
        e.preventDefault();
        // console.log($("#pk_cod_cand").val() + "chegando");
        $.ajax({
            url: URL + '/app/Models/Api.php?req=3',
            method: 'POST',
            dataType: 'json',
            data: {Codigo_vaga: $("#Codigo_vaga").val()},
            success: function (dados) {
                console.log(dados);
                $("#Codigo_vaga").val(dados.PK_COD);
                $("#Cargo_prent").val(dados.CARGO).css('color', 'black');
                $("#pk_cod_empre").val(dados.FK_EMPRESA);
                $("#razao_social").val(dados.EMPRESA);
                $("#responsavel").val(dados.RESPONSAVEL);
                $("#tel_respon").val(dados.TEL_RESPONS);
                $("#email_empresa_par").val(dados.EMAIL);
                $("#Cep").val(dados.CEP);
                $("#Endereco").val(dados.ENDERECO);
                $("#Bairro").val(dados.BAIRRO);
                $("#Cidade").val(dados.CIDADE);
                $("#Uf").val(dados.UF);
            },
            error: function () {
                $("#Cargo_prent").val("Oooops... Erro - Vaga nao Encotrada").css('color', 'red');
            }
        });
    });
}

function consultarCartaEncaminhar() {
    //RETORNA O DADOS DO VAGA PARA ENCAMINHEMENTO
    $("#codEncamCE").keyup(function (e) {
        e.preventDefault();
        // console.log($("#pk_cod_cand").val() + "chegando");
        $.ajax({
            url: URL + '/app/Models/Api.php?req=5',
            method: 'POST',
            dataType: 'json',
            data: {codEncamCE: $("#codEncamCE").val()},
            success: function (dados) {
                console.log(dados);
                $("#codEncamCE").val(dados.PK_COD);
                $("#Codigo_vagaCE").val(dados.FK_VAGA);
                $("#Cargo_prentCE").val(dados.CARGO_PRETENDIDO).css('color', 'black');
                $("#pk_cod_empreCE").val(dados.FK_EMPRESA);
                $("#razao_socialCE").val(dados.EMPRESA);
                $("#email_empresaCE").val(dados.EMAIL_ENCAM_EMPRE);
                $("#pk_cod_candCE").val(dados.FK_CAND);
                $("#nome_candCE").val(dados.CANDIDATO);                
            },
            error: function () {
                $("#Cargo_prentCE").val("Oooops... Erro - Carta nao Encontrada").css('color', 'red');
            }
        });
    });
}


/**
 * IMPRIMIR CARTA 
 * @returns {undefined}
 */
function ImprimirCartaEncaminhar() {
    var title = " **** BALCAO AMIGOS RH **** ";
    var retorno = confirm(title + "\n\nImprimir Carta de Encaminhamento");
    if (retorno == true) {
        window.open(URL + '/app/encaminhamentos/cartaEncaminharPDF');
        window.open(URL + '/app/encaminhamentos/index');
    } else {
        window.open(URL + '/app/encaminhamentos/index');
    }
}
/**
 * BARRA DE PROGRESSO
 * @returns {undefined}
 */
function barrapro() {

    var progressbar = $("#progressbar"), progressLabel = $(".progress-label");

    progressbar.progressbar({
        value: false,
        change: function () {
            progressLabel.text(progressbar.progressbar("value") + "%");
        },
        complete: function () {
            progressLabel.text("Backup Gerado com Sucesso ");
        }
    });

    function progress() {
        var val = progressbar.progressbar("value") || 0;

        progressbar.progressbar("value", val + 1);

        if (val < 99) {
            setTimeout(progress, 100);
        }
    }
    setTimeout(progress, 1000);
}

