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
} 