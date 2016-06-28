<?php
return array(
    'DB_TYPE' => 'mysql',
    'DB_HOST' => '127.0.0.1',
    'DB_NAME' => 'train',
    'DB_USER' => 'root',
    'DB_PWD' => 'Taurus@150306!',
    'DB_PORT' => '3306',
    'DB_PREFIX' => 't_',

    'URL_CASE_INSENSITIVE' => true,
    'URL_MODEL' => 2,

    'MODULE_ALLOW_LIST' => 'Home',
    'URL_HTML_SUFFIX' => '.html',

    'APP_SUB_DOMAIN_DEPLOY' => true,
    'APP_SUB_DOMAIN_RULES' => array(
        'train.local' => 'Owner',
        '118.193.153.28' => 'Owner',
    ),

    'LAYOUT_ON' => true,

    'DEFAULT_TIMEZONE' => 'Asia/Shanghai',

    'DATA_CRYPT_TYPE' => 'Think',
    'DATA_CRYPT_KEY' => 'Taurus',

    'TMPL_ACTION_SUCCESS' => 'tpl/dispatch_jump.tpl',

    //'DATA_CACHE_TYPE' => 'Memcached',
    //'MEMCACHE_HOST' => '127.0.0.1',
    //'MEMCACHE_PORT' => '11211',

    'LOG_RECORD' => false,
    'LOG_EXCEPTION_RECORD' => false,
);
