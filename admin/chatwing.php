<?php
/**
 * @author chatwing
 * @package Chatwing_Joomla
 */

/**
 * todo encrypt API Key
 * todo extension update
 */

defined('_JEXEC') or die;
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
define('CHATWING_EXTENSION_PATH', JPATH_COMPONENT);
define('CHATWING_DEBUG', true);

require_once CHATWING_EXTENSION_PATH . DS . 'helpers' . DS . 'encryption.php';
require_once CHATWING_EXTENSION_PATH . DS . 'helpers' . DS . 'common.php';

// check if key file exist.
$keyFilePath = CHATWING_EXTENSION_PATH . DS . 'key.php';
if (file_exists($keyFilePath)) {
    require $keyFilePath;
}

if (!defined('CHATWING_ENCRYPT_KEY')) {
    // generate new key
    EncryptionHelper::generateKeyFile($keyFilePath);
    if(file_exists($keyFilePath)) {
        include_once $keyFilePath;
    }
    define('CHATWING_RESET_KEY', true);
}

// Execute the task.
$controller = JControllerLegacy::getInstance('Chatwing');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();