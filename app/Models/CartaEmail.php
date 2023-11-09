<?php

namespace App\Models;

/**
 * Description of EntradaEstoque.
 *
 * @author Mare
 */
class CartaEmail extends Conn
{
    private $Parametros;
    private $Opcao;
    private $dados;
    private $resultado = false;
    private $resultadoBd;
    private $conn;

    public function getResultado(): bool
    {
        return $this->resultado;
    }

    /**
     * construtor.
     */
    public function __construct()
    {
        $this->conn = $this->connect();
    }

    /**
     * @param type $atributo
     * @param type $valor
     *
     * @return $this
     */
    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;

        return $this;
    }

    /**
     * @param type $atributo
     *
     * @return type
     */
    public function __get($atributo)
    {
        return $this->$atributo;
    }

    /**
     * @return type
     */
    public function LancarItens(array $dados = null)
    {
        $this->dados = $dados;
        try {
            $id = (int) $this->dados['codEncamCE'];

            if (!isset($_SESSION['cartaEmail']['item'][$id])) {
                $_SESSION['cartaEmail']['item'][$id] = $this->dados;
                // $_SESSION['estoque']['vlqt'] = $this->dados ;
            } else {
                $_SESSION['cartaEmail']['item'][$id] += $this->dados;
                $_SESSION['msg'] = '<div class="message alert">Carta de Encaminhamento ja inserida!</div>';
            }
            $this->resultado = true;
        } catch (\PDOException $exc) {
            return 'Erro: Inseri items na nota! '.$exc->getTraceAsString();
        }
    }

    /**
     * deletar item do carinho.
     *
     * @param type $dados
     */
    public function deletaritemcarrinho($dados)
    {
        $this->dados = $dados;
        try {
            unset($_SESSION['cartaEmail']['item'][$this->dados]);
            $this->resultado = true;
        } catch (\PDOException $exc) {
            echo 'Erro! Error ao deletar itmes da nota! '.$exc->getTraceAsString();
        }
    }
}
