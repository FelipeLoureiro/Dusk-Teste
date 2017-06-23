<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginPapTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testExample()
    {
        $user = factory(\App\User::class)->create([
            'cpf' => '04782044186',
            'password' => '20160810',

        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('https://betasun.before.com.br/_sys/')
            ->select('can_id', 2)
            ->type("us_re", $user->cpf)
            ->type("us_senha", $user->password)
                ->press("Entrar");

            $browser->pause(5000);
        });
    }
}
