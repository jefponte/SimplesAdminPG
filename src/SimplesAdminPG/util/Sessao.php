<?php

namespace SimplesAdminPG\util;

/**
 * Essa classe serve para iniciar uma sess�o usando cookie e session. 
 * Serve para facilitar a utiliza��o dessas ferramentas. 
 * @author jefponte
 *
 */
class Sessao
{

    public function __construct()
    {

    }

    public function criaSessao($host, $port, $user, $pass)
    {

    }

    public function mataSessao()
    {
        if (isset($_SESSION)) {
            session_destroy();
        }
        
        
    }

    public function getNivelAcesso()
    {
        if (isset($_SESSION['USUARIO_NIVEL'])) {
            return $_SESSION['USUARIO_NIVEL'];
        } else {
            return self::NIVEL_DESLOGADO;
        }
    }

    public function getIdUsuario()
    {
        if (isset($_SESSION['USUARIO_ID'])) {
            return $_SESSION['USUARIO_ID'];
        } else {

            return self::NIVEL_DESLOGADO;
        }
    }

    public function getLoginUsuario()
    {
        if (isset($_SESSION['USUARIO_LOGIN'])) {
            return $_SESSION['USUARIO_LOGIN'];
        } else {
            return self::NIVEL_DESLOGADO;
        }
    }
    public function __toString(){
        $strResposta = "";
        if($this->getNivelAcesso() == Self::NIVEL_DESLOGADO){
            $strResposta = 'Usuário Deslogado.';
        }else{
            $strResposta = 'Login: '.$this->getLoginUsuario();
            
        }
        return $strResposta;
    }

    const NIVEL_DESLOGADO = 0;
    
    const NIVEL_COMUM = 3;
    
    const NIVEL_NAO_VERIFICADO = 1;

    const NIVEL_VERIFICADO = 2;
    
    const NIVEL_COMPLETO = 3;

    const NIVEL_ADM = 4;
}