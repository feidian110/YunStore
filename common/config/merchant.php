<?php

return [

    // ----------------------- 菜单配置 ----------------------- //
    'config' => [
        // 菜单配置
        'menu' => [
            'location' => 'addons', // default:系统顶部菜单;addons:应用中心菜单
            'icon' => 'fa fa-puzzle-piece',
        ],
        // 子模块配置
        'modules' => [
            // 基础
            'base' => [
                'class' => 'addons\YunStore\merchant\modules\base\Module',
            ],
            'pick' => [
                'class' => 'addons\YunStore\merchant\modules\pick\Module',
            ],
            'product' => [
                'class' => 'addons\YunStore\merchant\modules\product\Module',
            ],
        ],
    ],

    // ----------------------- 快捷入口 ----------------------- //

    'cover' => [

    ],

    // ----------------------- 菜单配置 ----------------------- //

    'menu' => [
        [
            'title' => '门店管理',
            'route' => 'main/index',
            'icon' => 'fa fa-heart',
        ],
        [
            'title' => '自提点刮管理',
            'route' => 'pick/index',
            'icon' => 'fa fa-heart',
        ],

    ],

    // ----------------------- 权限配置 ----------------------- //

    'authItem' => [
        [
            'title' => '所有权限',
            'name' => '*',
        ],
    ],
];