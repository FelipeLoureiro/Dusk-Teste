<?php

namespace Tests\Browser;

use Tests\Browser\Pages\FuncoesSun;
use Tests\Browser\Pages\UrlPage;
use Tests\Browser\Pages\LoginPage;
use Tests\Browser\Pages\MenuPage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class FuncaoTest extends DuskTestCase
{
    public $Canal = '2';
    public $UsuariCpf = '02177959195';
    public $Senha = '1';

    /**
     * @test
     */
    public function CriarFuncao()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit(new UrlPage);

            // Faz o login no sistema.
            $browser->on(new LoginPage)
                ->FazerLogin($this->getCanal(), $this->getUsuariCpf(), $this->getSenha());

            // Caminho para entrar na pagina especifica do menu;
            $browser->on(new MenuPage)
                ->EntrarMenu('CadastroFuncao');

            $browser->on(new FuncoesSun())
                ->ElementoCheck(FuncaoTest::ElementosFuncao()['Vendedor']['check'],'fun_adicional');

            $browser->type('#fun_nome', 'Fun��o automatizado Quem Agora Foiiii agora sim')
                ->type('#fun_nivel', '3');

            // Seleciona a Aba "Modulo de Acesso"
            $browser->on(new FuncoesSun())
                ->SelecionarAba('.moduloAcesso','#TabModuloAcesso');

            $browser->on(new FuncoesSun())
                ->ElementoCheck(FuncaoTest::ElementosFuncao()['Vendedor']['check'],'mp_id');


            // Seleciona a Aba "Modulo de Acesso App"
            $browser->on(new FuncoesSun())
                ->SelecionarAba('.moduloAcessoApp','#TabModuloAcessoApp');


            $browser->on(new FuncoesSun())
                ->ElementoCheck(FuncaoTest::ElementosFuncao()['Vendedor']['check'],'amp_id');

            $browser->press('.corBotaoOk');

            $browser->waitFor('#aviso_texto');


            $texto = $browser->script('var elem = document.getElementById("aviso_texto").innerText; console.log(elem); return elem;');

            //$testeACompararUTF = mb_convert_encoding('Fun��o atualizada com sucesso!', "UTF-8");

            //Função inserida com sucesso

            $browser->whenAvailable('#aviso_texto', function ($Aviso){
                $Aviso->assertSee(mb_convert_encoding('Fun��o inserida com sucesso', "UTF-8"));
            });
        });
    }

    public static function ElementosFuncao(){

        return [
            'Vendedor' => [
                'input' => [

                ],
                'check' => [
                    'fun_adicional' =>[
                        'fun_venda'              => ['Acao' => '1', 'Default' => '1', 'texto' => 'Permiss�o para realizar Venda?'],
                        'fun_bko'                => ['Acao' => '0', 'Default' => '0', 'texto' => '� fun��o BKO?'],
                        'fun_rota'               => ['Acao' => '0', 'Default' => '0', 'texto' => 'Permiss�o para realizar Rota?'],
                        'fun_horario_acesso'     => ['Acao' => '0', 'Default' => '0', 'texto' => 'Controlar hor�rio de acesso?'],
                        'fun_log'                => ['Acao' => '0', 'Default' => '0', 'texto' => 'Permiss�o para ver Log?'],
                        'fun_acesso_todas_redes' => ['Acao' => '1', 'Default' => '1', 'texto' => 'Permiss�o para acessar todas Redes?'],
                        'fun_acesso_nacional'    => ['Acao' => '1', 'Default' => '1', 'texto' => 'Permiss�o para ter acesso Nacional?'],
                        'fun_importar_venda'     => ['Acao' => '0', 'Default' => '0', 'texto' => 'Permiss�o para importar Venda?'],
                        'fun_tsv'                => ['Acao' => '0', 'Default' => '0', 'texto' => 'Permiss�o para participar do TSV?']
                    ],
                    'mp_id' => [
                        // Ajuda
                        '45'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Central do cliente > Acesso'],
                        '56'  => ['Acao' => '1', 'Default' => '1', 'texto' => ' > Wiki > Acesso'],
                        '118' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Suporte BKO > Acesso'],
                        '46'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Suporte Sistema > Acesso'],
                        // Cadastros
                        '63'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Agenda (Rota) > Acesso'],
                        '67'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Agenda (Rota) > Importar'],
                        '113' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Banner (Fixa) > Acesso'],
                        '41'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Importa��o de Vendas > Acesso'],
                        '35'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Meta > Acesso'],
                        '38'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Meta > Enviar Mala Direta'],
                        '3'   => ['Acao' => '0', 'Default' => '0', 'texto' => ' > PDV > Acesso'],
                        '88'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > PDV > Alterar Dados do PDV, exceto Status Cadastral'],
                        '20'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > PDV > Alterar Status Cadastral'],
                        '21'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > PDV > Alterar todos os campos, exceto Dados do PDV e Status Cadastral'],
                        '44'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > PDV > Importar PDVs'],
                        '122' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > PDV > Inserir'],
                        '31'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > PDV > Somente Visualizar'],
                        '4'   => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Rede > Acesso'],
                        '124' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Rede > Inserir'],
                        '7'   => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Rota > Acesso'],
                        '2'   => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Fun��o > Acesso'],
                        '115' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Fun��o > Habilitar filtragem por l�der'],
                        '1'   => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Usu�rio > Acesso'],
                        '43'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Usu�rio > Importar usu�rios'],
                        '47'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Usu�rio > Inserir, Editar e Desativar'],
                        '117' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Usu�rio > Obrigar preenchimento do campo l�der'],
                        '141' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Usu�rio > Permitir cadastrar CPF/CNPJ'],
                        '30'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Usu�rio > Somente Visualizar'],
                        '132' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Usu�rio > Ver BKO online'],
                        '129' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Usu�rio > Ver fun��es online'],
                        '54'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Valida��o de visitas > Acesso'],
                        '55'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Valida��o de visitas > Qualquer usu�rio pode validar a Visita?'],
                        // Comunica��o
                        '6'   => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Adm. de comunicados > Acesso'],
                        '90'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Adm. de comunicados > Excluir ou editar Comunicados de outros usu�rios'],
                        '5'   => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Categoria > Acesso'],
                        '19'  => ['Acao' => '1', 'Default' => '1', 'texto' => ' > Portal de Comunicados > Acesso'],
                        // Vendas
                        '8'   => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Backoffice > Acesso'],
                        '39'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Backoffice > Alterar Status da Venda'],
                        '65'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Backoffice > Analisar Venda'],
                        '87'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Backoffice > An�lise Autom�tica'],
                        '134' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Backoffice > Editar Venda Finalizada'],
                        '136' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Backoffice > Log Venda Finalizada'],
                        '66'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Backoffice > Pegar Venda'],
                        '15'  => ['Acao' => '1', 'Default' => '1', 'texto' => ' > Venda > Acesso'],
                        '152' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Venda > Ativar Venda Controle Cart�o'],
                        '17'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Venda > Cancelar Venda'],
                        '133' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Venda > Editar Venda Finalizada'],
                        '16'  => ['Acao' => '1', 'Default' => '1', 'texto' => ' > Venda > Editar Venda Pendente'],
                        '114' => ['Acao' => '1', 'Default' => '', 'texto' => ' > Venda > Inserir Venda'],
                        '137' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Venda > Log Venda Finalizada'],
                        '103' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Venda > Vender Apenas Vivo Fixa'],
                        '104' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Televendas Fixa > Acesso'],
                        '105' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Televendas Fixa > Alterar Status da Venda'],
                        '106' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Televendas Fixa > Analisar Venda'],
                        '107' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Televendas Fixa > An�lise Autom�tica'],
                        '108' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Televendas Fixa > Pegar Venda'],
                        '111' => ['Acao' => '1', 'Default' => '1', 'texto' => ' > Vivo Fixa > Acesso'],
                        '130' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Vivo Fixa > Permitir Duplicidade de Leads'],
                        // TreinApp
                        '140' => ['Acao' => '1', 'Default' => '1', 'texto' => ' > TreinApp > Acesso'],
                        // Relat�rios
                        '42'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Flash > Acesso'],
                        '40'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Meta > Acesso'],
                        '18'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > PDV > Acesso'],
                        '79'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Redes > Acesso'],
                        '73'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Anal�tico de Agenda > Acesso'],
                        '11'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Check-in > Acesso'],
                        '71'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Gr�fico de Visitas > Acesso'],
                        '10'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Rotas > Acesso'],
                        '12'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Visitas > Acesso'],
                        '99'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Relat�rio de Acessos > Acesso'],
                        '9'   => ['Acao' => '1', 'Default' => '1', 'texto' => ' > Anal�tico de Vendas > Acesso'],
                        '135' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Anal�tico de Vendas > Mostrar C�digo IBGE'],
                        '138' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Anal�tico de Vendas > Ver Venda Finalizada'],
                        '69'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Exportar Planos > Acesso'],
                        '34'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Gr�fico de Vendas > Acesso'],
                        '36'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Gr�fico de Vendas Improdutivas > Acesso'],
                        '142' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Gr�fico de Vendas Vivo Fixa > Acesso'],
                        '61'  => ['Acao' => '1', 'Default' => '1', 'texto' => ' > Mapa de Vendas > Acesso'],
                        '37'  => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Relat�rio Gerencial > Acesso'],
                        '109' => ['Acao' => '1', 'Default' => '1', 'texto' => ' > Relat�rio Televendas > Acesso'],
                        '102' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Resumo Anal�tico > Acesso'],
                        '101' => ['Acao' => '0', 'Default' => '0', 'texto' => ' > Vendas Time > Acesso']
                    ],
                    'amp_id' => [
                        // ArcGIS
                        '13' => ['Acao' => '0', 'Default' => '0', 'texto' => 'ArcGIS > Acesso'],
                        // Atendimento Online
                        '8'  => ['Acao' => '0', 'Default' => '0', 'texto' => 'Chat > Acesso'],
                        // Check-in
                        '11' => ['Acao' => '0', 'Default' => '0', 'texto' => 'Check de Rota > Acesso'],
                        '4'  => ['Acao' => '0', 'Default' => '0', 'texto' => 'Check-In > Acesso'],
                        // Comunicados
                        '7'  => ['Acao' => '1', 'Default' => '1', 'texto' => 'Comunicados > Acesso'],
                        // Home

                        // Nova Senha
                        '15' => ['Acao' => '0', 'Default' => '0', 'texto' => 'Nova Senha > Acesso'],
                        // Nova Vendas Fixa
                        '21' => ['Acao' => '1', 'Default' => '1', 'texto' => 'Listar Venda Fixa > Acesso'],
                        '20' => ['Acao' => '1', 'Default' => '1', 'texto' => 'Nova Vendas Fixa > Acesso'],
                        // Pot�ncial Vendas
                        '18' => ['Acao' => '0', 'Default' => '0', 'texto' => 'Pot�ncial Vendas > Acesso'],
                        // Relat�rios
                        '10' => ['Acao' => '1', 'Default' => '1', 'texto' => 'Relatorios > Acesso'],
                        // Rota
                        '9'  => ['Acao' => '0', 'Default' => '0', 'texto' => 'Lista de Rotas > Acesso'],
                        // Suporte BKO
                        '19' => ['Acao' => '0', 'Default' => '0', 'texto' => 'Suporte BKO > Acesso'],
                        // TreinaApp
                        '16' => ['Acao' => '1', 'Default' => '1', 'texto' => 'TreinaApp > Acesso'],
                        // Venda
                        '12' => ['Acao' => '1', 'Default' => '1', 'texto' => 'Editar Venda Pendente > Acesso'],
                        '3'  => ['Acao' => '1', 'Default' => '1', 'texto' => 'Lista de Vendas > Acesso'],
                        '2'  => ['Acao' => '1', 'Default' => '1', 'texto' => 'Nova Venda > Acesso'],
                        // Visita
                        '5'  => ['Acao' => '0', 'Default' => '0', 'texto' => 'Registrar Visita > Acesso'],
                        // Visita Equipe de Rua
                        '17' => ['Acao' => '0', 'Default' => '0', 'texto' => 'Visita Equipe de Rua > Acesso']
                    ]
                ]
            ]
        ];

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
