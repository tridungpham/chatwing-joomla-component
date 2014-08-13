<?php

/**
 * @author chatwing
 * @package Chatwing_Joomla
 */
class ChatwingViewChatwing extends JViewLegacy
{
    protected  $boxes = array();

    public function display($tpl = null)
    {
        $this->boxes = $this->get('BoxList');
        $this->_prepareHeader();

        if (version_compare(JVERSION, '3.0', '<')) {
            JFactory::getDocument()
                ->addStyleSheet(JURI::base() . 'components/com_chatwing/media/css/jbootstrap.min.css');
        }

        parent::display($tpl);
    }

    private function _prepareHeader()
    {
        JToolbarHelper::title(JText::_('COM_CHATWING_CHATBOX_LIST'));
        JToolbarHelper::custom('settings', 'options', '', JText::_('COM_CHATWING_LABEL_BUTTON_SETTINGS'), false);
    }
}