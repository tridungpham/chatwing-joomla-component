<?php

class ChatwingViewChatwing extends JViewLegacy
{
  public function display($tpl = null) {
    $this->boxes = $this->get('BoxList');
    $this->_prepareHeader();
    parent::display($tpl);
  }

  private function _prepareHeader()
  {
    JToolbarHelper::title(JText::_('COM_CHATWING_CHATBOX_LIST'));
    JToolbarHelper::custom('apikey', 'options', '', JText::_('COM_CHATWING_LABEL_BUTTON_APIKEY'), false);
  }
}