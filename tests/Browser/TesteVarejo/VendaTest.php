<?php
/**
 * Testes de Venda
 * User: douglas Colussi
 * Date: 13/07/17
 * Time: 14:22
 */
namespace Tests\Browser\TesteVarejo;

use Tests\Browser\Pages\UsuarioLogin;
use Tests\Browser\TesteVarejo\FuncaoElementos;
use Tests\Browser\Pages\FuncoesSun;

use Tests\Browser\Pages\MenuPage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class VendaTest extends DuskTestCase
{

    /**
     * @test
     */
    public function InserirVenda(){

        $this->browse(function (Browser $browser) {

            $browser->on(new FuncoesSun())
                ->logar(UsuarioLogin::CANAL_VAREJO);

            // Caminho para entrar na pagina especifica do menu;
            $browser->on(new MenuPage)
                ->EntrarMenu('InserirVenda');

            $browser->select('#ufVenda', '12');

            $browser->type('#fiag_id_aux', 'MSD3062-001');

            $browser->waitFor('.ui-menu-item', 40);

            $idAutoComplet = $browser->attribute('.ui-autocomplete','id');

            //$browser->with('#div_dados_venda_fiag_id', function ($DivFilial){
            $browser->with('.ui-autocomplete', function ($item){
                    $item->click('.ui-menu-item-wrapper', 'MSD3062-001 - REQUINTE MÓVEIS');
                });
            //});


            $browser->click('#us_id_aux');
            $browser->waitFor('#us_id_aux', 40);
            $browser->type('#us_id_aux', '88500110163');

            //$browser->waitFor('.ui-menu-item', 40);

            $browser->with(!'#'.$idAutoComplet, '.ui-autocomplete', function ($item){
                    $item->click('.ui-menu-item-wrapper', 'Vendedor - 88500110163 - Everton Fatina');
                });
        });

    }
}