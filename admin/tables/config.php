<?php
/**
 * Author: dphamtri
 */

defined('_JEXEC') or die;

class ChatwingTableConfig extends JTable
{
  public function __construct($db)
  {
    parent::__construct('#__chatwing_config', 'name', $db);
  }
}