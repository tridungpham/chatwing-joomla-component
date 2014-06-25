<?php

/**
 * @author: Tri Dung Pham
 */
class ChatwingModelConfig extends JModelLegacy
{
  private static $_data = null;

  public function __construct()
  {
    parent::__construct();
    if (is_null(self::$_data))
    {
      $this->_getConfigData();
    }
  }

  /**
   * Get Config from DB and cache it
   * @return  void
   */
  private function _getConfigData()
  {
    $db    = $this->getDbo();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from($db->quoteName('#__chatwing_config'));
    $db->setQuery($query);
    $result = $db->loadAssocList('name');
    if ($result)
    {
      foreach($result as &$row){
        if(isset($row['value']) && $row['value']) {
          $row['value'] = EncryptionHelper::decrypt(base64_decode($row['value']));
        }
      }
      self::$_data = $result;
    }
    // if(isset($_data['api_key']['value'])) {
    //   $_data['api_key']['value'] = EncryptionHelper::decrypt($_data['api_key']['value']);
    // }
  }

  /**
   * Check if ChatWing API Token key is set
   * @return boolean
   */
  public function isTokenSet()
  {
    if (is_null(self::$_data))
    {
      $this->_getConfigData();
    }

    if (self::$_data && isset(self::$_data['api_key']) && !empty(self::$_data['api_key']) && self::$_data['api_key']['value'])
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  /**
   * Get ChatWing API Access Key
   * @return string|null 
   */
  public function getTokenKey()
  {
    return self::$_data && isset(self::$_data['api_key']) && !empty(self::$_data['api_key']) ? self::$_data['api_key']['value'] : null;
  }

  /**
   * Save API Key to database
   *
   * @param  string $apiKey ChatWing API Key
   *
   * @return boolean return True on success, otherwise return False
   */
  public function saveKey($apiKey = '')
  {
    /**
     * @var $configTable ChatwingTableConfig
     */
    $configTable = JTable::getInstance('config', 'chatwingtable');
    $configTable->load('api_key');
    $data       = array('value' => base64_encode(EncryptionHelper::encrypt($apiKey)));

    $saveResult = $configTable->save($data);

    return $saveResult;
  }

}