<?php

namespace Tests\Classes;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Funcoes extends DuskTestCase
{
    /**
     * Assert that the browser is on the page.
     *
     * @param Browser $browser
     * @param string $Tab
     * @param string $link
     * @return void
     *
     */

    public function AbrirAbas($Tab, $link)
    {

        $browser = new Browser();

        $this->browse(function ($browser) use ($Tab, $link){
            $browser->whenAvailable($Tab, function ($modal1, $link) {
                $modal1->assertVisible($link)
                    ->press($link);
                });
        });

    }
}