<?php 
// var_dump($this->boxes);
 ?>
<div class="chatwing-wrapper">
  <div id="j-main-container">
    <form id="adminForm" action="<?php echo JRoute::_('index.php?option=com_chatwing') ?>" method="post">
      <table class="table table-striped">
        <thead>
        <tr>
          <th><?php echo JText::_('COM_CHATWING_LABEL_CHATBOX_ID'); ?></th>
          <th><?php echo JText::_('COM_CHATWING_LABEL_CHATBOX_NAME'); ?></th>
          <th><?php echo JText::_('COM_CHATWING_LABEL_CHATBOX_ALIAS'); ?></th>
          <th><?php echo JText::_('COM_CHATWING_LABEL_CHATBOX_KEY'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($this->boxes)): ?>
          <?php foreach($this->boxes as $box): ?>
            <tr>
              <td><?php echo $box['id']; ?></td>
              <td><?php echo $box['name']; ?></td>
              <td><?php echo $box['alias']; ?></td>
              <td><?php echo $box['key']; ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="4"><?php echo JText::_('COM_CHATWING_MESSAGE_NO_BOX_OR_INVALID') ?></td>
          </tr>
        <?php endif; ?>
        </tbody>
      </table>
      <input type="hidden" name="task" value="">
    </form>
  </div>
</div>
