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

/**
 * Class exists checking
 */
if (!class_exists('AutoContentViewLogs')) {
    jimport('joomla.application.component.view');

    /**
     * Feeds View
     */
    class AutoContentViewLogs extends JViewLegacy {

        /**
         * AutoContents view display method
         * @return void
         */
        function display($tpl = null) {
            // Get data from the model
            $items = $this->get('Items');
            $pagination = $this->get('Pagination');
            $state = $this->get('State');

            // Check for errors.
            if (count($errors = $this->get('Errors'))) {
                JError::raiseError(500, implode('<br />', $errors));
                return false;
            }

            // Assign data to the view
            $this->items = $items;
            $this->pagination = $pagination;
            $this->state = $state;

            // Set the toolbar
            $this->addToolBar();

            // Set the submenu
            AutoContentHelper::addSubmenu('logs');

            // Display the template
            parent::display($tpl);
        }

        /**
         * Setting the toolbar
         */
        protected function addToolBar() {
            $canDo = AutoContentHelper::getActions();
            JToolBarHelper::title(JText::_('COM_AUTOCONTENT_MANAGER_LOGS'), 'writemess.png');

            if ($canDo->get('core.delete')) {
                JToolBarHelper::trash('logs.clear', 'JTOOLBAR_LOGS_CLEAR', false);
                JToolBarHelper::deleteList('', 'logs.delete', 'JTOOLBAR_DELETE');
            }
        }

    }

}
