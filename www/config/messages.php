<?php
return [
    'color' => null,
    'interactive' => true,
    'help' => null,
    'sourcePath' => '@app',
    'languages' => ['ru-RU'],
    'translator' => 'Yii::t',
    'sort' => false,
    'overwrite' => true,
    'removeUnused' => false,
    'markUnused' => true,
    'except' => [
        '.git',
        '.gitignore',
        '@yii/messages',
        '@yii/BaseYii.php',
    ],
    'only' => [
        '*.php',
    ],
    'format' => 'db',
    'db' => 'db',
    'catalog' => 'messages',
    'ignoreCategories' => [
        'yii',
        'kvselect',
        'kvdate',
        'kvbase',
    ],
];
