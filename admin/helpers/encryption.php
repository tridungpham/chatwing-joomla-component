<?php

class EncryptionHelper
{
  private static $_key = null;

  public static function setEncryptionKey($key)
  {
    self::$_key = $key;
  }

  public static function encrypt($text)
  {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, self::$_key, $text, MCRYPT_MODE_ECB, $iv);
    return $encrypted_string;
  }

  public static function decrypt($text)
  {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, self::$_key, $text, MCRYPT_MODE_ECB, $iv);
    return $decrypted_string;
  }
}

