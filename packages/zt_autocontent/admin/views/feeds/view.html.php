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
 * Feeds View
 */
class AutoContentViewFeeds extends JViewLegacy {

    /**
     * AutoContents view display method
     * @return void
     */
    public function display($tpl = null) {
        /* Get model data */
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');

        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }

        // Set the submenu
        AutoContentHelper::addSubmenu('feeds');
        $this->_addToolBar();
        $this->_setDocument();

        parent::display($tpl);
    }

    /**
     * Setting the toolbar
     */
    protected function _addToolBar() {
        $canDo = AutoContentHelper::getActions();
        JToolBarHelper::title(JText::_('COM_AUTOCONTENT_MANAGER_FEEDS'), 'newsfeeds-cat.png');
        if ($canDo->get('core.create')) {
            JToolBarHelper::addNew('feed.add', 'JTOOLBAR_NEW');
        }

        JToolBarHelper::custom('feed.load', 'purge.png', 'purge.png', 'COM_AUTOCONTENT_LOAD_FEEDS');

        if ($canDo->get('core.delete')) {
            JToolBarHelper::deleteList('', 'feeds.delete', 'JTOOLBAR_DELETE');
        }
        if ($canDo->get('core.admin')) {
            JToolBarHelper::divider();
            JToolBarHelper::preferences('com_autocontent');
        }
    }

    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function _setDocument() {
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_AUTOCONTENT_ADMINISTRATION'));
    }

}