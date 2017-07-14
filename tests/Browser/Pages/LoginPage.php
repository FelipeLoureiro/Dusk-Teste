<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class LoginPage extends Page
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
     * @param string $Canal
     * @param string $Cpf
     * @param string $Senha
     * @return void
     */
    public function FazerLogin(Browser $browser, $Canal, $Cpf, $Senha)
    {

        $browser->visit(new UrlPage);

        $browser->maximize();

        $browser->select('can_id', $Canal)
                ->type('us_re', $Cpf)
                ->type('us_senha', $Senha)
                ->press('Entrar');
    }
}