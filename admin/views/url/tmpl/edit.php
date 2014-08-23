<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
$params = $this->form->getFieldsets('params');
?>
<form action="<?php echo JRoute::_('index.php?option=com_autocontent&view=url&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
    <div class="width-50 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_AUTOCONTENT_URL_DETAILS'); ?></legend>
            <ul class="adminformlist">
                <?php foreach ($this->form->getFieldset('details') as $field): ?>
                    <li><?php
                        echo $field->label;
                        echo $field->input;
                        ?></li>
                <?php endforeach; ?>
            </ul>
        </fieldset>
    </div>

    <div class="width-50 fltrt">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_AUTOCONTENT_URL_CATEGORY'); ?></legend>
            <ul class="adminformlist">
                <?php foreach ($this->form->getFieldset('settings') as $field): ?>
                    <li><?php
                        echo $field->label;
                        echo $field->input;
                        ?></li>
                <?php endforeach; ?>
            </ul>
        </fieldset>

        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_AUTOCONTENT_FEED_ADVANCED'); ?></legend>
            <ul class="adminformlist">
                <?php foreach ($this->form->getFieldset('advanced') as $field): ?>
                    <li><?php
                        echo $field->label;
                        echo $field->input;
                        ?></li>
                <?php endforeach; ?>
            </ul>
        </fieldset>		
    </div>

    <div>
        <input type="hidden" name="task" value="url.edit" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>