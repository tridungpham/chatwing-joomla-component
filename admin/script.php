<?php
/**
 * Author: chatwing
 */
defined('DS') or define('DS', DIRECTORY_SEPARATOR);

class com_chatwingInstallerScript
{
  function preflight(){}
  function postflight(){}
  function update(){}
  function uninstall(){}

  function install()
  {
    $randomKey = self::generateRandomString(30);
    $targetDirPath = JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_chatwing';
    if(is_writable($targetDirPath)) {
        file_put_contents($targetDirPath . DS . 'key.php', '<?php define("CHATWING_ENCRYPT_KEY", \''.$randomKey.'\'); ?>');
    }
  }

  static function generateRandomString($resultLength = 10)
  {
    $result = '';
    $characterSpace = 'abcdefghijkG908765HIJKLMNOPQRSTUlmnopqrstuvwxyzABCDEFVWXYZ4321';
    $len = strlen($characterSpace);
    for($i =0; $i < $resultLength; $i++) {
        $randomPos = mt_rand(0, $len - 1);
        $result .= $characterSpace[$randomPos];
    }
    return $result;
  }
}