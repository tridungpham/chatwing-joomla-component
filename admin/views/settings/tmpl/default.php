<?php
/**
 * Author: chatwing
 */
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.formvalidation');
?>
<div class="chatwing-wrapper">
  <div class="row-fluid">
    <span10 class="offset1">
      <form class="form-horizontal" action="<?php echo JRoute::_('index.php?option=com_chatwing'); ?>" method="post" id="adminForm">
        <div class="control-group">
          <label class="control-label" for="width"><?php echo JText::_('COM_CHATWING_LABEL_WIDTH'); ?></label>
          <div class="controls">
            <div class="input-append">
              <input type="text" id="width" name="width" placeholder="600" value="<?php echo $this->config->getSetting('width'); ?>"/>
              <div class="add-on">px</div>
            </div>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="height"><?php echo JText::_('COM_CHATWING_LABEL_HEIGHT'); ?></label>
          <div class="controls">
            <div class="input-append">
              <input type="text" id="height" name="height" placeholder="400" value="<?php echo $this->config->getSetting('height'); ?>" />
              <div class="add-on">px</div>
            </div>
          </div>
        </div>

        <div class="control-group">
          <div class="controls">
            <button type="button" class="btn btn-success" onclick="Joomla.submitbutton('saveSetting')">
              <span class="icon-apply icon-white"></span>
                <?php echo JText::_('COM_CHATWING_ACTION_SAVE') ?>
            </button>
          </div>
        </div>

        <input type="hidden" name="task" value=""/>
        <?php echo JHtml::_('form.token'); ?>
      </form>
    </span10>
  </div>
</div>