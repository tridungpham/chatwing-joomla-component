<?php

/**
 * @author chatwing
 * @package Chatwing_Joomla
 */
class ChatwingCommonHelper
{
    public static function isJ3()
    {
        return version_compare(JVERSION, '3.0', '>=');
    }

    public static function getGravatarUrl($email, $size = 100)
    {
        $gravatarUrl = 'http://www.gravatar.com/avatar/';
        $hash = md5(strtolower(trim($email)));
        return $gravatarUrl . $hash . '?s=' . (int)$size;
    }
} 