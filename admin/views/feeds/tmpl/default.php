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

// load tooltip behavior
JHtml::_('behavior.tooltip');

$type = array();
$type[] = JHtml::_('select.option', 'k2', JText::_('JOPTION_SELECT_FEED_TYPE_K2'));
$type[] = JHtml::_('select.option', 'content', JText::_('JOPTION_SELECT_FEED_TYPE_CONTENT'));
?>
<form action="<?php echo JRoute::_('index.php?option=com_autocontent&view=feeds'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="j-main-container">
        <!-- Toolbar -->
        <div class="js-stools clearfix">
            <div class="clearfix">
                <fieldset id="filter-bar" style="height:auto;">
                    <div class="filter-search fltlft js-stools-container-bar clearfix">
                        <label class="filter-search-lbl" for="filter_search"><?php echo JText::_('COM_AUTOCONTENT_FEEDS_SEARCH'); ?>: </label>
                        <input type="text" class="pull-left" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_AUTOCONTENT_FEEDS_SEARCH'); ?>" />
                        <button type="submit" class="btn btn-small btn-success zt-btn-submit pull-left"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
                        <button type="button" class="btn btn-small zt-btn-reset" onclick="document.id('filter_search').value = '';
                                this.form.submit();"><?php echo JText::_('JSEARCH_RESET'); ?></button>
                    </div>
                    <div class="filter-select fltrt js-stools-container-list hidden-phone hidden-tablet shown clearfix">
                        <label for="filter_state">
                            <?php echo JText::_('COM_AUTOCONTENT_FEEDS_CATEGORY'); ?>
                        </label>
                        <select name="filter_feed_type" class="inputbox" onchange="this.form.submit()">
                            <option value="*"><?php echo JText::_('COM_AUTOCONTENT_ALL_FEEDS'); ?></option>
                            <?php echo JHtml::_('select.options', $type, 'value', 'text', $this->state->get('filter.feed_type')); ?>
                        </select>
                    </div>        
                </fieldset>
            </div>            
        </div>
        <table class="adminlist table table-striped">
            <thead><?php echo $this->loadTemplate('head'); ?></thead>
            <tfoot><?php echo $this->loadTemplate('foot'); ?></tfoot>
            <tbody><?php echo $this->loadTemplate('body'); ?></tbody>
        </table>
        <div>
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="boxchecked" value="0" />
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </div>
</form>