<?php
/**
 * @author Tri Dung Pham <tridungpham.89@gmail.com>
 */

/**
 * todo encrypt API Key
 * todo extension update
 * todo make extension compatible with J25
 */

defined('_JEXEC') or die;

define('CHATWING_DEBUG', true);

if (!JFactory::getUser()->authorise('core.manage', 'com_chatwing')) {
  return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Execute the task.
$controller = JControllerLegacy::getInstance('Chatwing');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();