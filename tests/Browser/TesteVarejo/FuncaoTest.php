<?php

namespace Tests\Browser\TesteVarejo;

use Tests\Browser\TesteVarejo\FuncaoElementos;
use Tests\Browser\Pages\FuncoesSun;

use Tests\Browser\Pages\MenuPage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class FuncaoTest extends DuskTestCase
{
    public $Canal       = '2';
    public $UsuariCpf   = '02177959195';
    public $Senha       = '1';


    /**
     * @test
     */
    public function CriarFuncao()
    {

        $this->browse(function (Browser $browser) {

            $browser->on(new FuncoesSun())
                    ->logar($this->getCanal(), $this->getUsuariCpf(), $this->getSenha());

            // Caminho para entrar na pagina especifica do menu;
            $browser->on(new MenuPage)
                    ->EntrarMenu('CadastroFuncao');

            $browser->on(new FuncoesSun())
                    ->ElementoCheck(FuncaoElementos::Elementos()['Vendedor']['check'], 'fun_adicional');

            $browser->type('#fun_nome', 'Função automatizado Quem Agora Foiiii agora sim')
                    ->type('#fun_nivel', '3');

            // Seleciona a Aba "Modulo de Acesso"
            $browser->on(new FuncoesSun())
                    ->SelecionarAba('.moduloAcesso','#TabModuloAcesso');

            $browser->on(new FuncoesSun())
                    ->ElementoCheck(FuncaoElementos::Elementos()['Vendedor']['check'], 'mp_id');


            // Seleciona a Aba "Modulo de Acesso App"
            $browser->on(new FuncoesSun())
                    ->SelecionarAba('.moduloAcessoApp','#TabModuloAcessoApp');


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
                    ->logar($this->getCanal(), $this->getUsuariCpf(), $this->getSenha());

            // Caminho para entrar na pagina especifica do menu;
            $browser->on(new MenuPage)
                ->EntrarMenu('BuscarFuncao');

            $browser->waitFor('#janela');
            //$browser->script("document.getElementById('janela').style.display='none'; document.getElementById('lente').style.display='none';");

            //$browser->on(self::CriarFuncao());
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
