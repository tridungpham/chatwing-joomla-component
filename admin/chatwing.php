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
//require_once JPATH_COMPONENT . DS . 'helpers' . DS . 'encryption.php';

// Execute the task.
$controller = JControllerLegacy::getInstance('Chatwing');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();