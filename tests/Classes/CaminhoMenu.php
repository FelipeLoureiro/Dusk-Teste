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
            'InserirUsuario' => [   'Menu'          => ['#menu_6'],
                                    'SubMenu'       => ['#submenu_6_3'],
                                    'Grupo'         => ['Usuário'],
                                    'BotaoItem'     => ['#MenuModulo8','.corBotaoInsere', 'Inserir Registro'],
                                    'FormTela'      => ['#formUsuario']
            ],
            'InserirFuncao' => [    'Menu'          => ['#menu_6'],
                                    'SubMenu'       => ['#submenu_6_3'],
                                    'Grupo'         => ['Função'],
                                    'BotaoItem'     => ['#MenuModulo9','.corBotaoInsere', 'Inserir Registro'],
                                    'FormTela'      => ['#formFuncao']
            ],
            'BuscarFuncao' => [     'Menu'          => ['#menu_6'],
                                    'SubMenu'       => ['#submenu_6_3'],
                                    'Grupo'         => ['Função'],
                                    'BotaoItem'     => ['#MenuModulo9','.corBotaoBusca', 'Buscar Registro'],
                                    'FormTela'      => ['#busca9']
            ],
            'InserirVenda' => [     'Menu'          => ['#menu_7'],
                                    'SubMenu'       => ['#submenu_7_6'],
                                    'Grupo'         => ['Venda'],
                                    'BotaoItem'     => ['#MenuModulo22','.corBotaoInsere', 'Inserir Registro'],
                                    'FormTela'      => ['#form22']
            ],
        ];
    }
}