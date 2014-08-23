<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Feeds View
 */
class AutoContentViewUrls extends JViewLegacy {

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
        AutoContentHelper::addSubmenu('urls');

        // Display the template
        parent::display($tpl);

        // Set the document
        $this->setDocument();
    }

    /**
     * Setting the toolbar
     */
    protected function addToolBar() {
        $canDo = AutoContentHelper::getActions();
        JToolBarHelper::title(JText::_('COM_AUTOCONTENT_SUBMENU_URLS'), 'weblinks-categories.png');
        if ($canDo->get('core.create')) {
            JToolBarHelper::addNew('url.add', 'JTOOLBAR_NEW');
        }

        JToolBarHelper::custom('url.load', 'purge.png', 'purge.png', 'COM_AUTOCONTENT_LOAD_URLS');

        if ($canDo->get('core.edit')) {
            JToolBarHelper::editList('url.edit', 'JTOOLBAR_EDIT');
        }
        if ($canDo->get('core.delete')) {
            JToolBarHelper::deleteList('', 'urls.delete', 'JTOOLBAR_DELETE');
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
    protected function setDocument() {
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_AUTOCONTENT_ADMINISTRATION'));
    }

}
