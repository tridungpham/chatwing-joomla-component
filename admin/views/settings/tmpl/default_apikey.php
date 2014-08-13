<?php
/**
 * @author chatwing
 * @package Chatwing_Joomla
 */

?>
<div class="chatwing-wrapper">
    <div class="row-fluid">
        <div class="span10 offset1">
            <div class="alert alert-block alert-warning">
                <span class="icon icon-exclamation-sign"></span>
                <?php echo JText::_('COM_CHATWING_ALERT_CHANGE_KEY') ?>
            </div>

            <form method="post" action="<?php echo JRoute::_('index.php?option=com_chatwing') ?>"
                  class="form-horizontal" id="adminForm">
                <div class="control-group">
                    <div class="control-label">
                        <label for="key"><?php echo JText::_('COM_CHATWING_API_KEY'); ?></label>
                    </div>
                    <div class="controls">
                        <input type="text" name="key" id="key" class="input-xxlarge"/>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button type="button" class="btn btn-success" onclick="submitform()">
                            <span class="icon-apply icon-white"></span>
                            <?php echo JText::_('COM_CHATWING_ACTION_CHANGE') ?>
                        </button>

                        <button class="btn btn-danger" onclick="deleteKey()">
                            <i class="icon-remove"></i>
                            <?php echo JText::_('COM_CHATWING_ACTION_REMOVE_API_KEY') ?>
                        </button>
                    </div>
                </div>

                <input type="hidden" name="task" value=""/>
                <?php echo JHtml::_('form.token'); ?>
            </form>

            <script type="text/javascript">
                var cwMessages = {
                    confirm_change: '<?php echo JText::_("COM_CHATWING_API_KEY_CHANGE_CONFIRM_MESSAGE") ?>',
                    confirm_delete: '<?php echo JText::_("COM_CHATWING_API_KEY_REMOVE_CONFIRM_MESSAGE") ?>',
                    key_missing: '<?php echo JText::_("COM_CHATWING_ALERT_API_KEY_MISSING") ?>'
                };

                var submitform = function () {
                    if (confirm(cwMessages.confirm_change)) {
                        var input = document.getElementById("key");
                        if (!input.value.length) {
                            alert(cwMessages.key_missing);
                            return;
                        }
                        Joomla.submitform('savekey');
                    }
                };

                var deleteKey = function () {
                    if (confirm(cwMessages.confirm_delete)) {
                        Joomla.submitform('deleteKey');
                    }
                }
            </script>
        </div>
    </div>
</div>