<?php
/**
 * @author  chatwing
 * @package Chatwing_Joomla
 */

defined('_JEXEC') or die('Direct access is not allowed');

class ChatwingController extends JControllerLegacy
{
    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->configModel = $this->getModel('config');
        $isTokenSet = $this->configModel->isTokenSet();
        $jInput = JFactory::getApplication()->input;
        if ($jInput->get('task') != 'savekey'
            && !($jInput->get('view') == 'settings'
                && $jInput->get('tpl') == 'newkey')
        ) {
            if ((defined('CHATWING_RESET_KEY') || !$isTokenSet)) {
                // encryption key changed, so we must save new settings
                if ($isTokenSet) {
                    $this->configModel->saveKey();
                }
                $this->setRedirect('index.php?option=com_chatwing&view=settings&tpl=newkey');
                $this->redirect();
            }
        }
    }


    public function display($cachable = false, $urlparams = array())
    {
        $jInput = JFactory::getApplication()->input;
        $view = $this->getView($jInput->get('view'), 'html');
        $view->setModel($this->configModel); // set view's model so in view we can use it

        return parent::display();
    }

    public function settings()
    {
        JFactory::getApplication()->input->set('view', 'settings');
        $this->display();
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
            if (!$hasError) {
                $message = JText::_('COM_CHATWING_MESSAGE_SAVE_KEY_SUCCESS');
            } else {
                $message = JText::_('COM_CHATWING_MESSAGE_SAVE_KEY_SUCCESS');
            }
        } catch (Exception $ex) {
            $message = CW_DEBUG ? $ex->getMessage() : JText::_('COM_CHATWING_ERROR_CANNOT_SAVE_KEY');
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
            $message = CW_DEBUG ? $ex->getMessage() : JText::_('COM_CHATWING_ERROR_CANNOT_DELETE_KEY');
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
            $message = CW_DEBUG ? $ex->getMessage() : JText::_('COM_CHATWING_ERROR_CANNOT_SAVE_SETTING');
            $hasError = true;
        }
        $this->setRedirect('index.php?option=com_chatwing&view=settings', $message, $hasError ? 'error' : 'message');
        $this->redirect();
    }
}