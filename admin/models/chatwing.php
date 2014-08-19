<?php

/**
 * @author chatwing
 * @package Chatwing_Joomla
 * Class ChatwingModelChatwing
 */
class ChatwingModelChatwing extends JModelLegacy
{
    // API information
    const API_VERSION = 1;
    const CLIENT_ID = 'joomla';

    /**
     * Get list of chat boxes
     * @throws Exception
     * @return array
     */
    public function getBoxList()
    {
        $configModel = JModelLegacy::getInstance('config', 'chatwingModel');
        $apiKey = $configModel->getTokenKey();

        try {
            $container = JFactory::getApplication()->get('cw_container');
            if (!$container) {
                throw new \Chatwing\Exception\ChatwingException(array('message' => JText::_('COM_CHATWING_ERROR_UNKNOWN')));
            }
            $container['api']->setAccessToken($apiKey);
            $response = $container['api']->call('user/chatbox/list');
        } catch (\Chatwing\Exception\ChatwingException $e) {
            $message = CW_DEBUG ? $e->getMessage() : JText::_('COM_CHATWING_ERROR_INVALID_RESPONSE');
            JFactory::getApplication()->enqueueMessage($message, 'error');
            return array();
        }

        return array_key_exists('data', $response) ? $response['data'] : array();
    }
}