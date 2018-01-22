<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;
use Tests\CreatesApplication;
use Tests\DuskTestCase;


class UsuarioLogin {
    const CANAL_VAREJO  = 2;
    const CANAL_PAP     = 3;
    const CANAL_PDR     = 4;

    const USUARIO_LOGIN = '02177959195';
    const SENHA_LOGIN   = '1';
}

class FuncoesSun extends BasePage
{
    use CreatesApplication;

    private static $loginPage;
    public static $VerificarBrowserNovo;

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/';
    }

    /**
     * Função para login
     *
     * @param Browser $browser
     * @param string  $Canal
     * @param string  $Cpf
     * @param string  $Senha
     * @return void
     * */
    public function logar(Browser $browser, $Canal, $Cpf = UsuarioLogin::USUARIO_LOGIN, $Senha = UsuarioLogin::SENHA_LOGIN)
    {
        /*if($Cpf != UsuarioLogin::USUARIO_LOGIN){

            self::$loginPage = null;

        }*/

        if(!self::$loginPage or !self::$VerificarBrowserNovo){

            self::$loginPage = new LoginPage();
            self::$VerificarBrowserNovo = $browser;

            $browser->on(self::$loginPage)
                    ->FazerLogin($Canal, $Cpf, $Senha);

        }
    }

    /**
     * Função para utilizar quando a muitos check list na tela de cadastro.
     * Forçando assim testar todas.
     *
     * @param  Browser $browser
     * @param  array   $elemento
     * @return void
     */
    public function ElementoCheck(Browser $browser, $elemento, $elementoIds, $SomenteVerificar = false)
    {
        foreach ($elemento[$elementoIds] as $checksIds => $CheckAcoes) {

            $idCheck = $elementoIds.'[]';
            $idDivCheck = '#'.$elementoIds.'_'.$checksIds;
            $textoCheck = $CheckAcoes['texto'];

            // Verifica a descrição do ckeckbox.
            $browser->with($idDivCheck, function (Browser $table) use ($textoCheck) {
                $table->assertSee($textoCheck);
            });

                // Verifica se a opção tem que vir selecionada.
            if($SomenteVerificar) {
                if ($CheckAcoes['Default'] == 1) {
                    $browser->assertChecked($idCheck, $checksIds);
                } else {
                    $browser->assertNotChecked($idCheck, $checksIds);
                }
            }
            else {
                if ($CheckAcoes['Acao'] == 1) {
                        $browser->check($idCheck, $checksIds);
                }
            }
        }
    }


    /**
     * Função para acessar as abas que existem nos telas de cadastros
     *
     * @param  Browser $browser
     * @param  string  $divAba
     * @param  string  $linkAba
     * @return void
     */
    public function SelecionarAba(Browser $browser, $Href, $ClasseHref)
    {

        $IdAba = $browser->clickByIdHref($Href, $ClasseHref);

        $browser->waitFor($IdAba);

        // Pega as cordenadas em qual posição esta o elemento a ser clicado;
        $coordenadas = $browser->element($IdAba)->getLocation();
        $tamanho = $browser->element($IdAba)->getSize();

        $browser->script("window.scrollTo(" . ($coordenadas->getX() + $tamanho->getHeight()) . ", 0);");

        $browser->click($IdAba);

    }

    /**
     * Foi criada essa nova variavel, para verificar se o Browser foi
     * fechado, pois verfica toda vez que é selecionado para fazer o login.
     *
     * @return mixed
     */
    public static function getVerificarBrowserNovo()
    {
        return self::$VerificarBrowserNovo;
    }

    /**
     * @param mixed $VerificarBrowserNovo
     */
    public static function setVerificarBrowserNovo($VerificarBrowserNovo)
    {
        self::$VerificarBrowserNovo = $VerificarBrowserNovo;
    }
}
