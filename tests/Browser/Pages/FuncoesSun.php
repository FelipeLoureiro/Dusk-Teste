<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;
use Tests\Browser\Pages\LoginPage;


class FuncoesSun extends BasePage
{
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
     *
     * */
    public function logar(Browser $browser, $Canal, $Cpf, $Senha)
    {
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
    public function SelecionarAba(Browser $browser, $divAba, $linkAba)
    {

        $browser->waitFor($divAba);

        // Pega as cordenadas em qual posição esta o elemento a ser clicado;
        $coordenadas = $browser->element($linkAba)->getLocation();
        $tamanho = $browser->element($linkAba)->getSize();

        $browser->script("window.scrollTo(" . ($coordenadas->getX() + $tamanho->getHeight()) . ", 0);");

        $browser->waitFor($linkAba);

        $browser->click('.ui-menu-item-wrapper', 'Vendedor - 88500110163 - Everton Fatina');
//        $browser->press($linkAba);

    }

    /**
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
