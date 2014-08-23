<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
JHTML::_('behavior.tooltip');
JHTML::_('behavior.calendar');
?>
<form action="<?php echo JRoute::_('index.php?option=com_autocontent&view=logs'); ?>" method="post" name="adminForm" id="adminForm">
	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('COM_AUTOCONTENT_LOG_SEARCH'); ?>: </label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_AUTOCONTENT_LOG_SEARCH'); ?>" />
			<button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_RESET'); ?></button>
		</div>
		<div class="filter-search fltrt">
			<label for="filter_date">
				<?php echo JTEXT::_("COM_AUTOCONTENT_FILTER_DATE"); ?>: 
			</label>
			<?php echo JHTML::_('calendar', $this->state->get('filter.log_date'), 'filter_log_date', 'filter_log_date', 
			'%Y-%m-%d', array('class'=>'inputbox', 'size'=>'15', 'onchange' => 'this.form.submit()')); ?>
		</div>
	</fieldset>
	<table class="adminlist">
		<thead><?php echo $this->loadTemplate('head');?></thead>
		<tfoot><?php echo $this->loadTemplate('foot');?></tfoot>
		<tbody><?php echo $this->loadTemplate('body');?></tbody>
	</table>
	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
