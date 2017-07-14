<?php
/**
 * Created by PhpStorm.
 * User: douglas
 * Date: 23/06/17
 * Time: 09:47
 */

namespace Tests\Classes;


class CaminhoMenu
{
    /**
     * @return array
     */
    public static function ListagemMenu(){

        return [
            'CadastroUsuario' => [  'Menu'          => '#menu_6',
                                    'SubMenu'       => '#submenu_6_3',
                                    'Grupo'         => '.subCapa8',
                                    'BotaoItem'     => '#Usuario_corBotaoInsere',
                                    'FormTela'      => '#formUsuario'],

            'CadastroFuncao' => [   'Menu'          => '#menu_6',
                                    'SubMenu'       => '#submenu_6_3',
                                    'Grupo'         => '.subCapa9',
                                    'BotaoItem'     => '#Funcao_corBotaoInsere',
                                    'FormTela'      => '#formFuncao'],

            'BuscarFuncao' => [     'Menu'          => '#menu_6',
                                    'SubMenu'       => '#submenu_6_3',
                                    'Grupo'         => '.subCapa9',
                                    'BotaoItem'     => '#Funcao_corBotaoBusca',
                                    'FormTela'      => '#busca9'],

            'InserirVenda' => [     'Menu'          => '#menu_7',
                                    'SubMenu'       => '#submenu_7_6',
                                    'Grupo'         => '.subCapa22',
                                    'BotaoItem'     => '#VendaSun_corBotaoInsere',
                                    'FormTela'      => '#form22'],
        ];
    }
}