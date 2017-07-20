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
        $browser->waitFor('#menu', 60);

        foreach (CaminhoMenu::ListagemMenu()[$menu] as $key => $caminho) {

            $MenuEstaFechado=false;

            if($key == 'Menu'){
                // busca a informação do menu, para verificar se o menu ja esta aberto ou não.
                $texto = $browser->script('var elem = document.getElementById("'.str_replace('#','', $caminho[0]).'").className; return elem;');

                //$existe = $browser->findTrueFalse($caminho[0]);

                $MenuEstaFechado = (strpos($texto[0], 'open') !== false);
            }

            if($key == 'Grupo'){

                $browser->waitFor('#subCapa');

                $CountSubCapa = $browser->script("var text=document.querySelectorAll('.box-header');for(i=0;i<text.length;i++){if(text[i].innerText.indexOf('".$caminho[0]."')==1){return i;}}");

                $browser->script("jQuery.find('.box-header')[\"{$CountSubCapa[0]}\"].click();");

            }
            elseif($key == 'BotaoItem'){
                $botaoClass      = $caminho[1];
                $botaoDescricao  = $caminho[2];

                $browser->waitFor($caminho[0]);
                $browser->with($caminho[0], function ($Botao) use ($botaoClass, $botaoDescricao){
                    $Botao->click($botaoClass, $botaoDescricao);
                });
            }
            elseif ($key != 'FormTela'){
                if (!$MenuEstaFechado) {
                    $browser->waitFor($caminho[0])
                            ->click($caminho[0])
                            ->assertVisible($caminho[0]);
                }
            }
            else{
                $browser->waitFor($caminho[0]);
            }
        }
    }
}
