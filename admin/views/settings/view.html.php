<?php

/**
 * Author: chatwing
 */
class ChatwingViewSettings extends JViewLegacy
{
  function display($tpl = null)
  {
    $this->config = $this->getModel('config');
    $this->_prepareHeader();
    if (version_compare(JVERSION, '3.0', '<')) {
      JFactory::getDocument()
        ->addStyleSheet(JURI::base() . 'components/com_chatwing/media/css/jbootstrap.min.css');
    }
    parent::display($tpl);
  }

  private function _prepareHeader()
  {
    JToolbarHelper::title(JText::_('COM_CHATWING_SETTINGS_MANAGER'));
  }
}