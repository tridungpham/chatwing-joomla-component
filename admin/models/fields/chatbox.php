<?php

/**
 * @author chatwing
 * @package Chatwing_Joomla
 */
require_once(dirname(dirname(dirname(__FILE__))) . '/bootstrap.php');
require_once(CW_EXTENSION_PATH . DS . 'key.php');
require_once(CW_EXTENSION_PATH . DS . 'helpers' . DS . 'encryption.php');
JModelLegacy::addIncludePath(CW_EXTENSION_PATH . DS . 'models');

class JFormFieldChatbox extends JFormFieldList
{
    protected $type = 'chatbox';

    public function getOptions()
    {
        $model = JModelLegacy::getInstance('chatwing', 'ChatwingModel');
        $boxes = $model->getBoxList();
        $data = array();
        if($boxes) {
            foreach($boxes as $box) {
                $obj = new stdClass();
                $obj->value = $box->alias;
                $obj->text = $box->name;
                $data[] = $obj;
            }
        }
        return $data;
    }
}