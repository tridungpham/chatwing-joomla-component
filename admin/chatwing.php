<?php
/**
 * @author Tri Dung Pham <tridungpham.89@gmail.com>
 */

/**
 * todo encrypt API Key
 * todo extension update
 */

defined('_JEXEC') or die;
defined('DS') or define('DS', DIRECTORY_SEPARATOR);

define('CHATWING_DEBUG', true);

// check if Encryption key file available
$keyFilePath = JPATH_COMPONENT . DS . 'key.php';
if(file_exists($keyFilePath)) {
    include $keyFilePath;
} 

defined('CHATWING_ENCRYPT_KEY') or define('CHATWING_ENCRYPT_KEY', '2014CHATWING!#@');
require_once JPATH_COMPONENT . DS . 'helpers' . DS . 'encryption.php';
EncryptionHelper::setEncryptionKey(CHATWING_ENCRYPT_KEY);

// if (!JFactory::getUser()->authorise('core.manage', 'com_chatwing')) {
//   return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
// }

// Execute the task.
$controller = JControllerLegacy::getInstance('Chatwing');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();