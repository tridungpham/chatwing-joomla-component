<?php
/**
 * @author dphamtri
 * @package
 */

defined('_JEXEC') or die('wrong way ?');

define('DS', DIRECTORY_SEPARATOR);
require_once JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_chatwing' . DS . 'bootstrap.php';
$keyFile = CW_EXTENSION_PATH . DS . 'key.php';
if (file_exists($keyFile)) {
    require_once($keyFile);
}

if (!defined('CW_ENCRYPTION_KEY')) {
    return;
}

require_once CW_EXTENSION_PATH . DS . 'helpers' . DS . 'common.php';

$controller = JControllerLegacy::getInstance('Chatwing');
$controller->execute('display');
$controller->redirect();