<?php

namespace Tests\Browser\TesteVarejo;

use Tests\Browser\Pages\FuncoesSun;
use Tests\Browser\Pages\MenuPage;
use Tests\Browser\Pages\UsuarioLogin;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class UsuarioTest extends DuskTestCase
{

    /**
     * @test
     */
    public function CriarUsuario()
    {

        $this->browse(function (Browser $browser) {

            // Faz o login no sistema.
            $browser->on(new FuncoesSun())
                    ->logar(UsuarioLogin::CANAL_VAREJO);

            // Caminho para entrar na pagina especifica do menu;
            $browser->on(new MenuPage)
                ->EntrarMenu('InserirUsuario');

            $browser->pause(2000);
        });

    }
}
