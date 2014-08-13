<?php
/**
 * @author dphamtri
 * @package
 */

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.formvalidation');
?>
<div class="chatwing-wrapper">
    <div class="row-fluid">
        <div class="span10 offset1">
            <div class="alert alert-block alert-info">
                <span class="icon icon-exclamation-sign"></span>
                <?php echo JText::_('COM_CHATWING_ALERT_ADD_KEY') ?>
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
                            <?php echo JText::_('COM_CHATWING_ACTION_SAVE') ?>
                        </button>
                    </div>
                </div>

                <input type="hidden" name="task" value=""/>
                <?php echo JHtml::_('form.token'); ?>
            </form>
            <script type="text/javascript">
                var submitform = function () {
                    var input = document.getElementById("key");
                    if (!input.value.length) {
                        alert('<?php echo JText::_("COM_CHATWING_ALERT_API_KEY_MISSING") ?>');
                        return;
                    }
                    Joomla.submitform('savekey');
                }
            </script>
        </div>
    </div>
</div>
