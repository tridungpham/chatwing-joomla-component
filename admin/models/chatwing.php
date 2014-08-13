<?php

defined('CHATWING_EXTENSION_PATH') or define('CHATWING_EXTENSION_PATH', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_chatwing');

JLoader::registerNamespace('Chatwing', CHATWING_EXTENSION_PATH . DS . 'lib' . DS . 'src');

class ChatwingModelChatwing extends JModelLegacy
{
    // API information
    const API_VERSION = 1;
    const CLIENT_ID = 'joomla';

    /**
     * Get list of chat boxes
     * @return array
     */
    public function getBoxList()
    {
        $configModel = JModelLegacy::getInstance('config', 'chatwingModel');
        $apiKey = $configModel->getTokenKey();

        try {
            $api = new Chatwing\Api(self::CLIENT_ID);
            $api->setAPIVersion(self::API_VERSION);
            $api->setAccessToken($apiKey);
            $api->setEnv(CHATWING_DEBUG ? Chatwing\Api::ENV_DEVELOPMENT : Chatwing\Api::ENV_PRODUCTION);
            $response = $api->call('user/chatbox/list');
        } catch (\Chatwing\Exception\ChatwingException $e) {
            $message = CHATWING_DEBUG ? $e->getMessage() : JText::_('COM_CHATWING_ERROR_INVALID_RESPONSE');
            JFactory::getApplication()->enqueueMessage($message, 'error');
            return array();
        }

        return array_key_exists('data', $response) ? $response['data'] : array();
    }

    /**
     * Build the URL of a chat box
     * @param  string $key
     * @return string
     */
    public function getBoxUrl($key)
    {
        return 'http://' . self::TARGET_DOMAIN . '/chatbox/' . $key;
    }
}