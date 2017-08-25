<?php
return [
    'filebrowserUploadUrl' => '/admin/upload/upload',
    'language'=>'ru',
    'allowedContent' => true,
    'templates_replaceContent'=>false,
    'contentsCss'=> Yii::getAlias('@web/css/styles.css'),
    'toolbarGroups' => [
        ['name' => 'document', 'groups' => ['mode', 'document', 'doctools' ]],
        ['name' => 'paragraph', 'groups' => ['templates', 'list', 'indent', 'align']],
        ['name' => 'clipboard', 'groups' => ['clipboard', 'undo' ]],
        ['name' => 'editing', 'groups' => ['find', 'selection',]],
        '/',
        ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup' ]],
        ['name' => 'insert'],
        ['name' => 'links', 'groups' => ['links', 'insert']],
        '/',
        ['name' => 'styles'],
        ['name' => 'colors'],
    ],
    'removeButtons' => 'Subscript,Superscript,Flash,HorizontalRule,Smiley,SpecialChar,Iframe',
    'removePlugins' => 'elementspath',
    'resize_enabled' => true,
];
