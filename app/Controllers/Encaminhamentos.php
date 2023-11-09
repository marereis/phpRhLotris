<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Core\View;

/**
 * Description of EntradaEstoque
 *
 * @author Mare
 */
class Encaminhamentos {

    private $dados;
    private $objModal;
    private $objModal1;

    /**
     * construtor
     */
    public function __construct() {
        $this->objModal = new \App\Models\Encaminhamentos();
        $this->objModal1 = new \App\Models\CartaEmail();
        $_SESSION['cartaEmail']['item'] = (!empty($_SESSION['cartaEmail']['item'])) ? $_SESSION['cartaEmail']['item'] : [];
    }

    /**
     * renderiza view ENCAMINHAMENTO
     */
    public function index() {
        View::renderTemplate('pages\encaminhamentos');
    }

    /**
     * renderiza ralatorio de ENCAMINHAMENTO
     */
    public function relatorioEncaminhar() {
       View::renderTemplate('pages\relatorioEncaminhar');
    }

    /**
     * renderiza Form de envio dA CARTA de ENCAMINHAMENTO POR EMAIL
     */
    public function CartaEmail() {
        View::renderTemplate('pages\cartaEmail');
    }

    /**
     * 
     * @return type
     */
    public function deletar() {

        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;

        if (in_array("", $this->dados)) {
            echo ajaxResponse("message", [
                "type" => "info",
                "message" => "Preencha tudos os campo pra Encaminhamento"
            ]);
            return;
        } elseif ($this->objModal->encaminhamentoId($this->dados["pk_cod_cand"]) > 0) {
            echo ajaxResponse("message", [
                "type" => "info",
                "message" => "Voce nao tem permissao para deletar este Encaminhamento = Candidato : " . $this->dados["nome_cand"] . " Vaga de : " . $this->dados["Cargo_prent"] . " !"
            ]);
            return;
        } else {
            $this->objModal->delete($this->dados);

            if ($this->objModal->getResultado()) {
                echo ajaxResponse("redirect", [
                    "url" => site('root') . 'encaminhamentos/index'
                ]);
                $_SESSION['msg'] = '<div class="message success">Empresa Deletado com sucesso!</div>';
            } else {
                $this->dados['form'] = $this->dados;
            }
        }
    }

    /**
     * 
     * @return type
     */
    public function consultar() {

        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;

        if (in_array("", $this->dados)) {
            echo ajaxResponse("message", [
                "type" => "info",
                "message" => "Preencha tudos os campo pra Consultar-se"
            ]);
            return;
        } else {
            $this->objModal->Pesquisar($this->dados);
        }
    }

    /**
     * 
     * @return type
     */
    public function consultarRelatorio() {

        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;

        if (in_array("", $this->dados)) {
            $this->objModal->PesquisarRelatorioTodos();
            return;
        } else {
            $this->objModal->PesquisarRelatorio($this->dados);
        }
    }

    /**
     * 
     * @param array $dados
     */
    public function relatorioPDF(array $dados = null) {
        ob_start();
        require_once './resources/views/pages/relatEncaminharPDF.php';
       // $dados = $_SESSION["dados"];
        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->loadHtml(ob_get_clean());
        //orientação e tipo de papel
        $dompdf->setPaper('A4', 'landscape');
        //Renderizar o html
        $dompdf->render();
        //Exibibir a página
        $dompdf->stream(
                "relatorioEncaminhamentos.pdf",
                [
                    "Attachment" => false //Para realizar o download somente alterar para true
                ]
        );
    }

    /**
     * cadastrar empresa 
     * @return type
     */
    public function cadastrar() {

        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;
//       var_dump($this->dados);
//       die();
        if (in_array("", $this->dados)) {
            echo ajaxResponse("message", [
                "type" => "info",
                "message" => "Preencha tudos os campo pra cadastra-se Encaminhamento"
            ]);
            return;
        } elseif ($this->objModal->EncaminhamentoValidacao($this->dados) > 0) {
            echo ajaxResponse("message", [
                "type" => "info",
                "message" => "Candidato ja Encamihado para vaga nº = " . $this->dados["Codigo_vaga"] . " -- Cargo = " . $this->dados["Cargo_prent"] . " -- na data de  = " . $this->dados["data_emisssao"] . " !"
            ]);
            return;
        } else {
            $this->objModal->insert($this->dados);
            $this->objModal->DadosCartaEnc($this->dados);
            $this->objModal->updateAtualizaVaga($this->dados);

            if ($this->objModal->getResultado()) {
                echo ajaxResponse("redirect", [
                    "url" => site('root') . 'encaminhamentos/index'
                ]);
                $_SESSION['msg'] = '<div class="message success">Candidato encaminhado com sucesso!</div>';
            } else {
                $this->dados['form'] = $this->dados;
            }
        }
    }

    /**
     * Controller alterar empresa
     * @return type
     */
    public function alterar() {

        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;

        if (in_array("", $this->dados)) {
            echo ajaxResponse("message", [
                "type" => "info",
                "message" => "Preencha tudos os campo pra Alterar-se Encaminhamento"
            ]);
            return;
        } else {
            $this->objModal->update($this->dados);

            if ($this->objModal->getResultado()) {
                echo ajaxResponse("redirect", [
                    "url" => site('root') . 'encaminhamentos/index'
                ]);
                $_SESSION['msg'] = '<div class="message success">Encaminhamento Alterado com sucesso!</div>';
            } else {
                $this->dados['form'] = $this->dados;
            }
        }
    }

    public function alterarrrrrrrr() {

        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;

        if (in_array("", $this->dados)) {
            echo ajaxResponse("message", [
                "type" => "info",
                "message" => "Preencha tudos os campo pra Alterar-se Encaminhamento"
            ]);
            return;
        } elseif ($this->objModal->EncaminhamentoValidacao($this->dados) > 0) {
            echo ajaxResponse("message", [
                "type" => "info",
                "message" => "Candidato ja Encamihado para vaga nº = " . $this->dados["Codigo_vaga"] . " -- Cargo = " . $this->dados["Cargo_prent"] . " -- na data de  = " . $this->dados["data_emisssao"] . " !"
            ]);
            return;
        } else {
            $this->objModal->update($this->dados);

            if ($this->objModal->getResultado()) {
                echo ajaxResponse("redirect", [
                    "url" => site('root') . 'encaminhamentos/index'
                ]);
                $_SESSION['msg'] = '<div class="message success">Encaminhamento Alterado com sucesso!</div>';
            } else {
                $this->dados['form'] = $this->dados;
            }
        }
    }

    /**
     * deletar produtos direto ada tebela
     * @param type $data
     * @return type
     */
    public function deletarTabela($data) {

        $this->dados = $data;

        if ($this->dados <= 0) {
            echo ajaxResponse("message", [
                "type" => "info",
                "message" => "Preencha tudos os campo pra deletar-se Empresa parceira"
            ]);
            return;
        } else {
            $this->objModal->delete($this->dados);
        }
    }

    /**
     * consulta todos
     */
    public function consultarAll() {
        $this->objModal->BuscarTodos();
    }

    /**
     * consultar por id
     * @param type $data
     * @return type
     */
    public function consultarId($data) {

        $this->dados = filter_var($data, FILTER_VALIDATE_INT);

        if (empty($this->dados)) {
            echo ajaxResponse("message", [
                "type" => "info",
                "message" => "Preencha tudos os campo pra Consulta-se EmpresaID"
            ]);
            return;
        } else {
            $this->objModal->BuscarId($this->dados);
        }
    }

    /**
     * 
     * @param array $dados
     */
    public function cartaEncaminharPDF(array $dados = null) {
        ob_start();
        require_once './resources/views/pages/CartaEncaminharPDF.php';
        //$dados = $_SESSION['encaminhar'];
        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->loadHtml(ob_get_clean());
        //orientação e tipo de papel
        $dompdf->setPaper('A4');
        //Renderizar o html
        $dompdf->render();
        //Exibibir a página
        $dompdf->stream(
                "Cartaencaminhamento.pdf",
                [
                    "Attachment" => false //Para realizar o download somente alterar para true
                ]
        );
    }

    /**
     * ENVIA EMAIL DA CARTA DOS CANDIDATO SELECIONADO NO FORMULARIO DE ENVIO
     * @param array $dados
     */
    public function cartaEncaminharEmail(array $dados = null) {

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $_SESSION['cartaEmail']['item'];
//        var_dump( $this->dados);
//        die();
        try {
            foreach ($this->dados as $value) {

                $this->objModal->dadosCartaEmail($value["codEncamCE"]);

                $mensagem = array();
                if (!empty($_SESSION["msgEmail"]) && $mensagem = $_SESSION["msgEmail"]) {
                    unset($_SESSION["msgEmail"]);
                }
//                echo $mensagem;                die();

                $emailEmpresa = array();
                if (!empty($_SESSION['encaminharPDF']) && $emailEmpresa = $_SESSION['encaminharPDF']) {
                    unset($_SESSION['encaminharPDF']);
                }

                $dadosEmpresa = new \App\Models\Empresa();
                $mailEmpresa = $dadosEmpresa->buscarTodos();

                $mail = new PHPMailer(true);

                if ($this->objModal->getResultado()) {

                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                   // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->isSMTP();
                    $mail->CharSet = "Utf-8";

              #CONFIGURAÇÃO PRODUÇÃO
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Port = 587;
            $mail->Username = 'marereis@gmail.com';
            $mail->Password = 'slwypyigmqkrbeso';
//            
                    #CONFIGURAÇÃO TESTE
//                    $mail->Host = 'smtp.mailtrap.io';
//                    $mail->SMTPAuth = true;
//                    $mail->Port = 2525;
//                    $mail->Username = 'de9a1c3c66934a';
//                    $mail->Password = 'a51ea2f20ea3aa';

                    //Recipients
                    $mail->setFrom($mailEmpresa['0']['EMAIL'], $mailEmpresa['0']['NOME_FANTASIA']);

                    $mail->addAddress($emailEmpresa['EMAIL_ENCAM_EMPRE'], $emailEmpresa['EMPRESA']);

                    $mail->addEmbeddedImage(dirname(__DIR__) . '/../resources/assets/img/logoEmpresa.png', 'logo', 'logoEmpresa.png');
                    $mail->isHTML(true);
                    $mail->Subject = "Encaminhamento RH Personal";
                    $mail->Body = $mensagem;
                    $mail->send();
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            echo "Message could not be sent. Mailer Error: { $exc . $mail->ErrorInfo}";
        } finally {
            
             $this->objModal->updateTipoEncaminhamento($this->dados);
            
            //REDERECIONA PARA PAGINA 
            echo ajaxResponse("redirect", [
                "url" => site('root') . 'encaminhamentos/cartaEmail'
            ]);
            //MENSAGEN DE CONFIRMAÇÃO
            $_SESSION['msg'] = '<div class="message success">Email Carta de Encaminhamento enviado com sucesso!</div>';
            //DELETAR A SESSAO
            unset($_SESSION['cartaEmail']['item']);
        }
    }

    /**
     * consulta produtos 
     * @return type
     */
    public function LancaCartaEmail() {

        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;
//        var_dump($data);
//      die();
        if (in_array("", $this->dados)) {
            echo ajaxResponse("message", [
                "type" => "info",
                "message" => "Preencha tudos os campo pra Consultar-se"
            ]);
            return;
        } else {
            $this->objModal1->LancarItens($this->dados);

            if ($this->objModal1->getResultado()) {
                echo ajaxResponse("redirect", [
                    "url" => site('root') . 'encaminhamentos/CartaEmail'
                ]);
                return;
            } else {
                $_SESSION['msg'] = '<div class="message error">Carta NÃO FOI Inserida com sucesso!</div>';
            }
        }
    }

    /**
     * deletar produtos direto ada tebela
     * @param type $data
     * @return type
     */
    public function DeletarTabelaCartaEmail($data) {

        $this->dados = filter_var($data, FILTER_VALIDATE_INT);

        if (empty($this->dados)) {
            echo ajaxResponse("message", [
                "type" => "info",
                "message" => "Erro deletar Produto"
            ]);
            return;
        } else {
            $this->objModal1->deletaritemcarrinho($this->dados);

            if ($this->objModal1->getResultado()) {
                $urlDestino = site("root") . 'encaminhamentos/CartaEmail';
                header("Location: $urlDestino");
                $_SESSION['msg'] = '<div class="message success">Carta Deletado com sucesso!</div>';
                return;
            } else {
                $_SESSION['msg'] = '<div class="message error">Carta nao Deletado com sucesso!</div>';
            }
        }
    }

//   FIM CLASSE 
}
