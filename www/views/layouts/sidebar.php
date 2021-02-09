<?php
use hoaaah\sbadmin2\widgets\Menu;
use mdm\admin\components\MenuHelper;
use yii\bootstrap4\Nav;

echo Menu::widget([
    'options' => [
        'ulClass' => "navbar-nav bg-gradient-primary sidebar sidebar-dark accordion",
        'ulId' => "accordionSidebar"
    ], //  optional
    'brand' => [
        'url' => ['/'],
        'content' => <<<HTML
            <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>        
HTML
    ],
    'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id)
    /*'items' => [
        [
            'label' => 'Menu 1',
            'url' => ['/menu1'], //  Array format of Url to, will be not used if have an items
            'icon' => 'fas fa-fw fa-tachometer-alt', // optional, default to "fa fa-circle-o
            'visible' => true, // optional, default to true
            // 'options' => [
            //     'liClass' => 'nav-item',
            // ] // optional
        ],
        [
            'type' => 'divider', // divider or sidebar, if not set then link menu
            // 'label' => '', // if sidebar we will set this, if divider then no

        ],
        [
            'label' => 'Rbac admin',
            // 'icon' => 'fa fa-menu', // optional, default to "fa fa-circle-o
            'visible' => true, // optional, default to true
            // 'subMenuTitle' => 'Menu 2 Item', // optional only when have submenutitle, if not exist will not have subMenuTitle
            'items' => [
                [
                    'label' => 'Route',
                    'url' => ['/admin/route'], //  Array format of Url to, will be not used if have an items
                ],
                [
                    'label' => 'Permission',
                    'url' => ['/admin/permission'], //  Array format of Url to, will be not used if have an items
                ],
                [
                    'label' => 'Menu',
                    'url' => ['/admin/menu'], //  Array format of Url to, will be not used if have an items
                ],
                [
                    'label' => 'Role',
                    'url' => ['/admin/role'], //  Array format of Url to, will be not used if have an items
                ],
                [
                    'label' => 'Assignment',
                    'url' => ['/admin/assignment'], //  Array format of Url to, will be not used if have an items
                ],
                [
                    'label' => 'User',
                    'url' => ['/admin/user'], //  Array format of Url to, will be not used if have an items
                ],
            ]
        ],

        [
            'label' => 'Menu 3',
            'visible' => true, // optional, default to true
            // 'subMenuTitle' => 'Menu 3 Item', // optional only when have submenutitle, if not exist will not have subMenuTitle
            'items' => [
                [
                    'label' => 'Menu 3 Sub 1',
                    'url' => ['/menu21'], //  Array format of Url to, will be not used if have an items
                ],
                [
                    'label' => 'Menu 3 Sub 2',
                    'url' => ['/menu22'], //  Array format of Url to, will be not used if have an items
                ],
            ]
        ],
    ]*/
]);