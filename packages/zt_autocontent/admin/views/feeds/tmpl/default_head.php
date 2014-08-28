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
    <th width = "5">
        <?php echo JText::_('COM_AUTOCONTENT_FEED_HEADING_ID');
        ?>
    </th>
    <th width="20">
        <?php echo JHtml::_('grid.checkall'); ?>
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
