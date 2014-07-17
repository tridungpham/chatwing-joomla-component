<?php

JLoader::registerNamespace('Chatwing', CHATWING_EXTENSION_PATH . DS . 'lib' . DS . 'src');

class ChatwingModelChatwing extends JModelLegacy
{
  // API information
  const API_URL     = 'http://staging.chatwing.com/api/';
  const API_VERSION = 1;
  const CLIENT_ID   = 'joomla';
  const TARGET_DOMAIN = 'staging.chatwing.com';
  
  // API action
  const API_ACTION_FETCH_CHATBOX_LIST = 'user/chatbox/list';

  private static $_cache = array();

  /**
   * Fetch data from chatwing server
   *
   * @param string $type
   * @param array  $params
   *
   * @return mixed|null
   */
  public function fetchRemoteData($type = self::API_ACTION_FETCH_CHATBOX_LIST, $params = array())
  {
    $configModel            = JModelLegacy::getInstance('config', 'chatwingModel');
    $apiKey                 = $configModel->getTokenKey();

    try {
      $api = new Chatwing\Api($apiKey, self::CLIENT_ID);
      $api->setEnv($api::ENV_DEVELOPMENT);
      $response = $api->call('user/chatbox/list');
      return $response;
    } catch (\Chatwing\Exception\ChatwingException $e) {
      die($e->getMessage()); // todo use another method to catch the error
    }
  }

  /**
   * Build the query URL
   * @param  string $action 
   * @param  array  $params 
   * @return string
   */
  protected function buildQueryUrl($action, $params = array())
  {
    $baseUrl             = self::API_URL . self::API_VERSION . $action;
    $params['client_id'] = self::CLIENT_ID;
    $query               = http_build_query($params);

    return $baseUrl . '?' . $query;
  }

  /**
   * Get chatbox list
   * @return array 
   */
  public function getBoxList()
  {
    if (isset(self::$_cache[self::API_ACTION_FETCH_CHATBOX_LIST]) && self::$_cache[self::API_ACTION_FETCH_CHATBOX_LIST])
    {
      $data = self::$_cache[self::API_ACTION_FETCH_CHATBOX_LIST];
    }
    else
    {
      $data = $this->fetchRemoteData();
    }

    return isset($data['data']) ? $data['data'] : array();
  }

  /**
   * Build the URL of a chatbox
   * @param  string $key 
   * @return string
   */
  public function getBoxUrl($key)
  {
    return 'http://' . self::TARGET_DOMAIN . '/chatbox/' . $key;
  }
}