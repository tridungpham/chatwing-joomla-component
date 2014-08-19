<?php

/**
 * @author chatwing
 * @package Chatwing_Joomla
 */

defined('DS') or define('DS', DIRECTORY_SEPARATOR);
define('CW_DEBUG', false);
define('CW_EXTENSION_PATH', dirname(__FILE__));
define('CW_CLIENT_ID', 'joomla');

require_once CW_EXTENSION_PATH . DS . 'vendor' . DS . 'autoload.php';

$cwContainer = new \Pimple\Container();

$cwContainer['api'] = function (\Pimple\Container $c) {
    $api = new \Chatwing\Api(CW_CLIENT_ID);
    $api->setEnv(CW_DEBUG ? CW_ENV_DEVELOPMENT : CW_ENV_PRODUCTION);

    if (isset($c['cw_token'])) {
        $api->setAccessToken($c['cw_token']);
    }

    return $api;
};

$cwContainer['cb'] = $cwContainer->factory(function (\Pimple\Container $c) {
    return new \Chatwing\Chatbox($c['api']);
});

$cwContainer['cb_session'] = $cwContainer->factory(function(\Pimple\Container $c){
    return new \Chatwing\Encryption\Session($c['cb_secret']);
});

JFactory::getApplication()->set('cw_container', $cwContainer);