<?php

namespace Tests\Browser\TesteVarejo;

use Tests\Browser\Pages\FuncoesSun;
use Tests\Browser\Pages\LoginPage;
use Tests\Browser\Pages\MenuPage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class UsuarioTest extends DuskTestCase
{

    public $Canal = '2';
    public $UsuariCpf = '02177959195';
    public $Senha = '1';

    /**
     * @test
     */
    public function CriarUsuario()
    {

        $this->browse(function (Browser $browser) {

            // Faz o login no sistema.
            $browser->on(new FuncoesSun())
                    ->logar($this->getCanal(), $this->getUsuariCpf(), $this->getSenha());

            // Caminho para entrar na pagina especifica do menu;
            $browser->on(new MenuPage)
                ->EntrarMenu('CadastroUsuario');

            $browser->pause(2000);
        });

    }

    /**
     * @return string
     */
    public function getCanal(): string
    {
        return $this->Canal;
    }

    /**
     * @return string
     */
    public function getUsuariCpf(): string
    {
        return $this->UsuariCpf;
    }

    /**
     * @return string
     */
    public function getSenha(): string
    {
        return $this->Senha;
    }
}
