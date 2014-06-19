<?php
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.formvalidation');
?>
<div class="row-fluid">
  <div class="span10 offset1">
    <?php if($this->api_key_set): ?>
      <div class="alert alert-block">
        <span class="icon icon-exclamation-sign"></span>
        <?php echo JText::_('COM_CHATWING_ALERT_CHANGE_KEY') ?>
      </div>
      <script type="text/javascript">
      var submitform = function(){
        if(confirm('<?php echo JText::_("COM_CHATWING_API_KEY_CHANGE_CONFIRM_MESSAGE") ?>')) {
          var input = document.getElementById("key");
          if(!input.value.length) {
            alert('<?php echo JText::_("COM_CHATWING_ALERT_API_KEY_MISSING") ?>');
            return;
          }
          Joomla.submitform('savekey');
        }
      }

      var deleteKey = function(){
        if(confirm('<?php echo JText::_("COM_CHATWING_API_KEY_CHANGE_CONFIRM_MESSAGE") ?>')) {
          Joomla.submitform('deleteKey');
        }
      }
      </script>
    <?php else: ?> 
      <div class="alert alert-block alert-info">
        <span class="icon icon-exclamation-sign"></span>
        <?php echo JText::_('COM_CHATWING_ALERT_ADD_KEY') ?>
      </div>
      <script type="text/javascript">
      var submitform = function(){
        var input = document.getElementById("key");
        if(!input.value.length) {
          alert('<?php echo JText::_("COM_CHATWING_ALERT_API_KEY_MISSING") ?>');
          return;
        }
        Joomla.submitform('savekey');
      }
      </script>
    <?php endif; ?>

    <form method="post" action="<?php echo JRoute::_('index.php?option=com_chatwing') ?>" class="form-horizontal" id="adminForm">
      <div class="control-group">
        <div class="control-label">
          <label for="key"><?php echo JText::_('COM_CHATWING_API_KEY'); ?></label>
        </div>
        <div class="controls">
          <input type="text" name="key" id="key" class="input-xxlarge" />
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <button type="button" class="btn btn-success" onclick="submitform()">
            <span class="icon-apply icon-white"></span>
            <?php if($this->api_key_set): ?>
              <?php echo JText::_('COM_CHATWING_ACTION_CHANGE') ?>
            <?php else: ?>
              <?php echo JText::_('COM_CHATWING_ACTION_SAVE') ?>
            <?php endif; ?>
          </button>
        </div>
      </div>
      <?php if($this->api_key_set): ?>
      <div class="alert alert-block">
        <button class="btn btn-danger">
          <i class="icon-remove"></i>
          <?php echo JText::_('COM_CHATWING_ACTION_REMOVE_API_KEY') ?>
        </button>
        <span class="help-inline"><strong><?php echo JText::_('COM_CHATWING_ALERT_REMOVE_API_KEY') ?></strong></span>
      </div>
      <?php endif; ?>
      <input type="hidden" name="task" value="" />
      <?php echo JHtml::_('form.token'); ?>
    </form>
  </div>
</div>
