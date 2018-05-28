# bancodeprovas

Banco de Provas InfoJr UFBA

## Configuração

O arquivo de configuração para acesso ao banco está em `app/database.php` com o conteúdo:

~~~ php
<?php
return [
    'driver' => 'mysql',
    'mysql' => [
        'host' => 'localhost',
        'database' => 'nomebd',
        'username' => 'userbd',
        'password' => 'passwordbd',
        'charset' => 'utf8',
        'collation' =>'utf8_unicode_ci'
    ]
];
~~~

## Deploy

Via DeployHQ: `infra+bancodeprovas@infojr.com.br`
