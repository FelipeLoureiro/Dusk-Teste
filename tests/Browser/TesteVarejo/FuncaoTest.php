<?php

namespace Tests\Browser\TesteVarejo;

use Tests\Browser\Pages\UsuarioLogin;
use Tests\Browser\Pages\FuncoesSun;
use Tests\Browser\Pages\MenuPage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class FuncaoTest extends DuskTestCase
{

    /**
     * @test
     */
    public function CriarFuncao()
    {

        $this->browse(function (Browser $browser) {

            $browser->on(new FuncoesSun())
                    ->logar(UsuarioLogin::CANAL_VAREJO);

            // Caminho para entrar na pagina especifica do menu;
            $browser->on(new MenuPage)
                    ->EntrarMenu('InserirFuncao');

            $browser->on(new FuncoesSun())
                    ->ElementoCheck(FuncaoElementos::Elementos()['Vendedor']['check'], 'fun_adicional');

            $browser->type('#fun_nome', 'Função automatizado Quem Agora Foiiii agora sim')
                    ->type('#fun_nivel', '3');

            // Seleciona a Aba "Modulo de Acesso"
            $browser->on(new FuncoesSun())
                //    ->SelecionarAba('.moduloAcesso','#TabModuloAcesso');
                ->SelecionarAba('#moduloAcesso', 'ui-tabs-anchor');

            $browser->on(new FuncoesSun())
                    ->ElementoCheck(FuncaoElementos::Elementos()['Vendedor']['check'], 'mp_id');


            // Seleciona a Aba "Modulo de Acesso App"
            $browser->on(new FuncoesSun())
                    ->SelecionarAba('#moduloAcessoApp', 'ui-tabs-anchor');


            $browser->on(new FuncoesSun())
                    ->ElementoCheck(FuncaoElementos::Elementos()['Vendedor']['check'],'amp_id');

            $browser->press('.corBotaoOk');

            $browser->waitFor('#aviso_texto');

            //Função inserida com sucesso
            $browser->whenAvailable('#aviso_texto', function ($Aviso){
                $Aviso->assertSee('Função inserida com sucesso')
                    ->click("#aviso_texto");
            });

        });
    }

    /**
     * @test
     */
    public function BuscarFuncao()
    {
        $this->browse(function (Browser $browser) {

            $browser->on(new FuncoesSun())
                    ->logar(UsuarioLogin::CANAL_VAREJO);

            // Caminho para entrar na pagina especifica do menu;
            $browser->on(new MenuPage)
                ->EntrarMenu('BuscarFuncao');

            $browser->waitFor('#janela');

        });
    }
}
