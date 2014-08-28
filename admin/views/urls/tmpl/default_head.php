<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<tr>
    <th width="5">
        <?php echo JText::_('COM_AUTOCONTENT_FEED_HEADING_ID'); ?>
    </th>
    <th width="20">
        <input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
    </th>			
    <th>
        <?php echo JText::_('COM_AUTOCONTENT_FEED_FIELD_FEED_NAME_LABEL'); ?>
    </th>
    <th>
        <?php echo JText::_('COM_AUTOCONTENT_FEED_FIELD_FEED_TYPE_LABEL'); ?>
    </th>
    <th>
        <?php echo JText::_('COM_AUTOCONTENT_FEED_FIELD_FEED_CATEGORY_NAME'); ?>
    </th>
    <th>
        <?php echo JText::_('COM_AUTOCONTENT_FEED_FIELD_FEED_PUBLISHED'); ?>
    </th>
</tr>
