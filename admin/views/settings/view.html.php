<?php

/**
 * @author chatwing
 * @package Chatwing_Joomla
 */
class ChatwingViewSettings extends JViewLegacy
{
    private $tpl = null;

    function display($tpl = null)
    {
        $this->config = $this->getModel('config');
        if (!$this->config->isTokenSet()) {
            $tpl = 'newkey';
        } else {
            $tpl = JFactory::getApplication()->input->get('tpl', null);
        }

        $this->tpl = $tpl;

        $this->_prepareHeader();
        $this->_prepareSubMenu();
        $this->_prepareToolbar();
        if (version_compare(JVERSION, '3.0', '<')) {
            JFactory::getDocument()
                ->addStyleSheet(JURI::base() . 'components/com_chatwing/media/css/jbootstrap.min.css');
        }
        parent::display($tpl);
    }

    private function _prepareToolbar()
    {

    }

    private function _prepareHeader()
    {
        switch ($this->tpl) {
            case 'newkey':
                JToolbarHelper::title(JText::_('COM_CHATWING_SETTINGS_APIKEY'));
                break;

            case 'settings':
            default:
                JToolbarHelper::title(JText::_('COM_CHATWING_SETTINGS_MANAGER'));
                break;
        }
    }

    private function _prepareSubMenu()
    {
        JSubMenuHelper::addEntry(JText::_('COM_CHATWING_SUBMENU_SETTINGS'), 'index.php?option=com_chatwing&view=settings', $this->tpl == '');
        JSubMenuHelper::addEntry(JText::_('COM_CHATWING_SUBMENU_APIKEY'), 'index.php?option=com_chatwing&view=settings&tpl=apikey', $this->tpl == 'newkey');
    }
}