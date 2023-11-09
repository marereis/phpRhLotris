<?php

require_once(dirname(__FILE__) . "/../../vendor/autoload.php" );

$objCandidato = new App\Models\Candidatos();
$objVaga = new App\Models\Vagas();
$objEmpresa = new App\Models\EmpresasParceiras();
$objEcaminhamento = new App\Models\Encaminhamentos();

$req = filter_input(INPUT_GET, "req", FILTER_SANITIZE_SPECIAL_CHARS); //Obtemos o valor de REQ que é passado através da URL

if ($req) {

    if ($req == "1") {
        //RETORNA O DADOS DO EMPRESA PARA ENCAMINHEMENTO 
        $busca = filter_input(INPUT_POST, 'pk_cod_empre', FILTER_SANITIZE_SPECIAL_CHARS);
        foreach ($objEmpresa->BuscarEmpresaEncaminhar($busca) as $listamesa) {
            echo json_encode($listamesa);
        }
    }

    if ($req == "2") {
        //RETORNA O DADOS DO EMPRESA PARA ENCAMINHEMENTO 
        $busca = filter_input(INPUT_POST, 'Codigo_emp', FILTER_SANITIZE_SPECIAL_CHARS);
        foreach ($objEmpresa->buscarEmpresaVaga($busca) as $listamesa1) {
            echo json_encode($listamesa1);
        }
    }

    if ($req == "3") {
        //RETORNA O DADOS DO VAGA PARA ENCAMINHEMENTO
        $busca = filter_input(INPUT_POST, 'Codigo_vaga', FILTER_SANITIZE_SPECIAL_CHARS);
        foreach ($objVaga->BuscarVagaEncaminhar($busca) as $listamesa) {
            echo json_encode($listamesa);
        }
    }

    if ($req == "4") {
        //RETORNA O DADOS DO CANDIDATOS PARA ENCAMINHEMENTO
        $busca = filter_input(INPUT_POST, 'pk_cod_cand', FILTER_SANITIZE_SPECIAL_CHARS);
        foreach ($objCandidato->BuscarCandidatoEncaminhar($busca) as $listamesa) {
            echo json_encode($listamesa);
        }
    }

    if ($req == "5") {
        //RETORNA O DADOS DO CANDIDATOS PARA ENCAMINHEMENTO
        $busca = filter_input(INPUT_POST, 'codEncamCE', FILTER_SANITIZE_SPECIAL_CHARS);
        foreach ($objEcaminhamento->encaminhamentoIdCE($busca) as $listamesa) {
            echo json_encode($listamesa);
        }
    }

}


