/**
 * 
 * @returns {undefined}
 */
$(function () {
    $("form").submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var action = form.attr("action");
        var data = form.serialize();

        $.ajax({
            url: action,
            data: data,
            type: "post",
            dataType: "json",
            beforeSend: function (load) {
                ajax_load("open");
            },
            success: function (su) {
                ajax_load("close");

                if (su.message) {
                    var view = '<div class="message ' + su.message.type + '">' + su.message.message + '</div>';
                    $(".login_form_callback").html(view);
                    $(".message").effect("bounce");
                    return;
                }

                if (su.redirect) {
                    window.location.href = su.redirect.url;
                }

            }
        });

        function ajax_load(action) {
            ajax_load_div = $(".ajax_load");

            if (action === "open") {
                ajax_load_div.fadeIn(200).css("display", "flex");
            }

            if (action === "close") {
                ajax_load_div.fadeOut(200);
            }
        }
    });

    // // INICIA MENU EM BARRA
    // $(".menu-icon1").click(function () {
    //     $(".menu11").css("display", "block");
    // });
    // // abri menu 
    // $(".menu-icon").click(function (e) {
    //     e.preventDefault();
    //     $(".menu").css("display", "flex");
    // });


    /**
 * ABERTURA DE MENU LATERAL
 */
$(function () {
    var menu_width = 500;
    var menu = $(".menu");
    var menu_open = $("#btn_open_menu");
    var menu_close = $("#menu_conteiner");
    var overlay = $(".menu_conteiner");
    let open = false;

    menu_open.click(function (e) {
        e.preventDefault();
        open = !open;
        open_close_menu();
    });

    menu_close.click(function (e) {
        e.preventDefault();
        open = false;
        open_close_menu();
    });

    function open_close_menu() {
        if (open) {
            menu.css({"right": "0px"});
            overlay.css({"display": "block"});
            return;
        }
        menu.css({"right": "-" + menu_width + "px"});
        overlay.css({"display": "none"});
    }

});


  
});

/* JS PARA CONFIGURAÇÃO DAS MODAL DASHBORAD */

function iniciaModal(modalID) {
    const modal = document.getElementById(modalID);
    modal.classList.add('mostrar');
    modal.addEventListener('click', (e) => {
        if (e.target.id == modalID || e.target.className == 'fechar') {
            modal.classList.remove('mostrar');
        }
    });
}


const button = document.querySelector('#btvagas');
button.addEventListener('click', () => iniciaModal('vagasMODAL'));

const button1 = document.querySelector('#btencaminhar');
button1.addEventListener('click', () => iniciaModal('encaminharMODAL'));

//const button2 = document.querySelector('#salvarEncamin');
//button2.addEventListener('click', () => iniciaModal('opcaoModal'));
//
//const button4 = document.querySelector('#estoquebaixo');
//button4.addEventListener('click', () => iniciaModal('estoquebaixoMODAL'));

function abriMPG() {
    const button5 = document.querySelector('#salvarEncamin');
    button5.addEventListener('click', () => iniciaModal('opcaoModal'));
}



