<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Tests\Classes\CaminhoMenu;


class MenuPage extends Page
{

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
     * Assert that the browser is on the page.
     *
     * @param Browser $browser
     * @param string $menu
     * @return void
     */

    public function EntrarMenu(Browser $browser, $menu)
    {
        $browser->waitFor('#menu');

        foreach (CaminhoMenu::ListagemMenu()[$menu] as $key => $caminho) {

            $MenuEstaFechado=false;

            if($key == 'Menu'){
                // busca a informação do menu, para verificar se o menu ja esta aberto ou não.
                $texto = $browser->script('var elem = document.getElementById("'.str_replace('#','', $caminho).'").className; return elem;');

                $MenuEstaFechado = (strpos($texto[0], 'open') !== false);
            }
            if ($key != 'FormTela'){
                if (!$MenuEstaFechado) {

                    $browser->waitFor($caminho)
                            ->click($caminho)
                            ->assertVisible($caminho);
                }
            }
        }

        $browser->waitFor($caminho, 15);
    }
}
