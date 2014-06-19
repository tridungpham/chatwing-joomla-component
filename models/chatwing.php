<?php

class ChatwingModelChatwing extends JModelLegacy
{
  // API information
  const API_URL     = 'http://staging.chatwing.com/api/';
  const API_VERSION = 1;
  const CLIENT_ID   = 'joomla';
  const TARGET_DOMAIN = 'staging.chatwing.com';
  
  // API action
  const API_FETCH_CHATBOX_LIST = '/user/chatbox/list';

  private static $_cache = array();

  /**
   * Fetch data from chatwing server
   *
   * @param string $type
   * @param array  $params
   *
   * @return mixed|null
   */
  public function fetchRemoteData($type = self::API_FETCH_CHATBOX_LIST, $params = array())
  {
    $configModel            = JModelLegacy::getInstance('config', 'chatwingModel');
    $apiKey                 = $configModel->getTokenKey();
    $params['access_token'] = $apiKey;
    $queryUrl               = $this->buildQueryUrl($type, $params);

    $ch    = curl_init();
    $agent = 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:30.0) Gecko/20100101 Firefox/30.0';
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_URL, $queryUrl);

    $remoteData = curl_exec($ch);
    curl_close($ch);
    // $remoteData = file_get_contents($queryUrl);

    if ($remoteData)
    {
      $remoteData          = json_decode($remoteData, true);
      self::$_cache[$type] = $remoteData;

      return $remoteData;
    }
    else
    {
      return null;
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
    if (isset(self::$_cache[self::API_FETCH_CHATBOX_LIST]) && self::$_cache[self::API_FETCH_CHATBOX_LIST])
    {
      $data = self::$_cache[self::API_FETCH_CHATBOX_LIST];
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