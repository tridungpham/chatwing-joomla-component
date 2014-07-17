<?php
/**
 * @author  Tri Dung Pham <dungpt@live.com>
 */

defined('_JEXEC') or die;

class ChatwingController extends JControllerLegacy
{
  public function __construct($config = array())
  {
    parent::__construct($config);
    $configModel = $this->getModel('config');
    $jInput = JFactory::getApplication()->input;
    $viewName = $jInput->get('view');
    $task = $jInput->get('task');
    // if user hasn't set the API key, then redirect user to the key form
    if ((!$configModel->isTokenSet() && $viewName != 'apikey' && $task != 'savekey')) {
      $this->setRedirect('index.php?option=com_chatwing&view=apikey');
      $this->redirect();
    }
  }


  public function display($cachable = false, $urlparams = array())
  {
    /**
     * @var $configModel ChatwingModelConfig
     */
    $configModel = $this->getModel('config');
    $jInput = JFactory::getApplication()->input;
    $task = $jInput->get('task');
    switch($task) {
      case 'apikey':
        $jInput->set('view', 'apikey');
        break;

      case 'settings':
        $jInput->set('view', 'settings');
        break;
    }

    $view = $this->getView($jInput->get('view'), 'html');
    $view->setModel($configModel); // set view's model so in view we can use it

    return parent::display();
  }

  /**
   * Execute action which save API key to database
   *
   * @return void
   */
  public function saveKey()
  {    
    JSession::checkToken() or die('Invalid Token');
    $newKey = JFactory::getApplication()->input->get('key');
    if (!$newKey) {
      // new key is not available. Set error message and redirect
      $this->setRedirect('index.php?option=com_chatwing&view=apikey', JText::_('COM_CHATWING_ERROR_KEY_INVALID'), 'error');
      $this->redirect();
      exit;
    }

    /**
     * @var $configModel ChatwingModelConfig
     */
    $configModel = $this->getModel('config');
    try {
      $hasError = !$configModel->saveKey($newKey);
      if(!$hasError) {
        $message = JText::_('COM_CHATWING_MESSAGE_SAVE_KEY_SUCCESS');
      } else {
        $message = JText::_('COM_CHATWING_MESSAGE_SAVE_KEY_SUCCESS');
      }
    } catch (Exception $ex) {
      $message = CHATWING_DEBUG ? $ex->getMessage() : JText::_('COM_CHATWING_ERROR_CANNOT_SAVE_KEY');
      $hasError = true;
    }
    $this->setRedirect('index.php?option=com_chatwing&view=apikey', $message, $hasError ? 'error' : 'message');
    $this->redirect();
  }

  public function deleteKey()
  {
    JSession::checkToken() or die('Invalid Token');
    /**
     * @var $configModel ChatwingModelConfig
     */
    $configModel = $this->getModel('config');
    try {
      $hasError = !$configModel->saveKey();
      $message = JText::_('COM_CHATWING_MESSAGE_DELETE_KEY_SUCCESS');
    } catch (Exception $ex) {
      $message = CHATWING_DEBUG ? $ex->getMessage() : JText::_('COM_CHATWING_ERROR_CANNOT_DELETE_KEY');
      $hasError = true;
    }
    $this->setRedirect('index.php?option=com_chatwing&view=apikey', $message, $hasError ? 'error' : 'message');
    $this->redirect();
  }

  public function saveSetting()
  {
    JSession::checkToken() or die('Invalid Token');
    $configModel = $this->getModel('config');
    try {
      $hasError = !$configModel->saveSettings();
      $message = JText::_('COM_CHATWING_MESSAGE_SAVE_SETTING_SUCCESS');
    } catch (Exception $ex) {
      $message = CHATWING_DEBUG ? $ex->getMessage() : JText::_('COM_CHATWING_ERROR_CANNOT_SAVE_SETTING');
      $hasError = true;
    }
    $this->setRedirect('index.php?option=com_chatwing&view=settings', $message, $hasError ? 'error' : 'message');
    $this->redirect();
  }
}