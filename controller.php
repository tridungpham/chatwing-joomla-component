<?php
/**
 * @author  Tri Dung Pham <dungpt@live.com>
 */

defined('_JEXEC') or die;

class ChatwingController extends JControllerLegacy
{
  public function display($cachable = false, $urlparams = array())
  {
    /**
     * @var $configModel ChatwingModelConfig
     */
    $configModel = $this->getModel('config');
    $viewName    = $this->input->get('view');
    $task = $this->input->get('task');

    // if user hasn't set the API key, then redirect user to the key form
    if ( (!$configModel->isTokenSet() && $viewName != 'apikey') || $task == 'apikey' )
    {
      $this->setRedirect('index.php?option=com_chatwing&view=apikey');
      $this->redirect();
      exit;
    }
    $view = $this->getView($viewName, 'html');
    $view->setModel($configModel); // set view's model so in view we can use it

    return parent::display();
  }

  /**
   * Execute action which save API key to database
   * @return void
   */
  public function saveKey()
  {
    JSession::checkToken() or die( 'Invalid Token' );
    $newKey = $this->input->get('key');
    if (!$newKey)
    {
      // new key is not available. Set error message and redirect
      $this->setRedirect('index.php?option=com_chatwing&view=apikey', JText::_('COM_CHATWING_ERROR_KEY_INVALID'), 'error');
      $this->redirect();
      exit;
    }

    /**
     * @var $configModel ChatwingModelConfig
     */
    $configModel = $this->getModel('config');
    try
    {
      $hasError = !$configModel->saveKey($newKey);
      $message  = JText::_('COM_CHATWING_MESSAGE_SAVE_KEY_SUCCESS');
    } catch (Exception $ex)
    {
      $message  = CHATWING_DEBUG ? $ex->getMessage() : JText::_('COM_CHATWING_ERROR_CANNOT_SAVE_KEY');
      $hasError = true;
    }
    $this->setRedirect('index.php?option=com_chatwing&view=apikey', $message, $hasError ? 'error' : 'message');
    $this->redirect();
  }  
}