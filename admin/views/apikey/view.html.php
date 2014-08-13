<?php

/**
 * @author chatwing
 * @package Chatwing_Joomla
 */
class ChatwingViewApiKey extends JViewLegacy
{
    public function display($tpl = null)
    {
        /**
         * @var $configModel ChatwingModelConfig
         */
        $configModel = $this->getModel('config');

        $this->api_key_set = $configModel->isTokenSet();
        $this->_prepareHeader();

        if (version_compare(JVERSION, '3.0', '<')) {
            JFactory::getDocument()
                ->addStyleSheet(JURI::base() . 'components/com_chatwing/media/css/jbootstrap.min.css');
        }
        return parent::display($tpl);
    }

    private function _prepareHeader()
    {
        JToolbarHelper::title(JText::_('COM_CHATWING_APIKEY_MANAGER'));
    }
}
