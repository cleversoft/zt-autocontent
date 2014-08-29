<?php
/**
 * Zt Autocontent
 * @package Joomla.Component
 * @subpackage com_autocontent
 * @version 0.5.0
 *
 * @copyright   Copyright (c) 2013 APL Solutions (http://apl.vn)
 *
 */
defined('_JEXEC') or die;
?>
<tr>
    <th width="30">
        <?php echo JText::_('COM_AUTOCONTENT_FEED_HEADING_ID'); ?>
    </th>
    <th width="30">
        <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
    </th>			
    <th>
        <?php echo JText::_('COM_AUTOCONTENT_FEED_FIELD_MESSAGE_LABEL'); ?>
    </th>
    <th width="200">
        <?php echo JText::_('COM_AUTOCONTENT_FEED_FIELD_CREATE_ON_LABEL'); ?>
    </th>
</tr>