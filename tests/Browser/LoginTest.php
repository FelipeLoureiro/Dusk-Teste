<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://betasun.before.com.br/_sys/')
                // ->waitFor('can_id',10)
                ->select('can_id', '3')//PAP
                ->type("us_re", "04782044186")
                ->type("us_senha", 20160810)
                ->press('Entrar')
                ->waitFor('#menu_7', 7)
                ->click('#menu_7')
                ->waitFor('#submenu_7_6')
                ->click("#submenu_7_6");
        });
    }
}
