<?php

/**
 * Author: dphamtri
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
    return parent::display($tpl);
  }

  private function _prepareHeader()
  {
    JToolbarHelper::title(JText::_('COM_CHATWING_APIKEY_MANAGER'));
  }
}