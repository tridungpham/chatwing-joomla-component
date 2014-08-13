<?php

class EncryptionHelper
{
    public static function encrypt($text)
    {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, CHATWING_ENCRYPT_KEY, $text, MCRYPT_MODE_ECB, $iv);
        return $encrypted_string;
    }

    public static function decrypt($text)
    {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, CHATWING_ENCRYPT_KEY, $text, MCRYPT_MODE_ECB, $iv);
        return $decrypted_string;
    }

    public static function generateKeyFile($filePath = '')
    {
        $randomKey = self::generateKey(20);
        $targetDir = dirname($filePath);
        if (is_writable($targetDir)) {
            file_put_contents($filePath, '<?php define("CHATWING_ENCRYPT_KEY", \'' . $randomKey . '\'); ?>');
        }
    }

    protected static function generateKey($resultLength = 10)
    {
        $key = '';
        $characterSpace = 'abcdefghijkG908765HIJKLMNOPQRSTUlmnopqrstuvwxyzABCDEFVWXYZ4321';
        $len = strlen($characterSpace);
        for ($i = 0; $i < $resultLength; $i++) {
            $randomPos = mt_rand(0, $len - 1);
            $key .= $characterSpace[$randomPos];
        }
        return $key;
    }
}

