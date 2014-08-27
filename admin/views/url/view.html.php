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

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Feed View
 */
class AutoContentViewUrl extends JViewLegacy {

    /**
     * display method of Hello view
     * @return void
     */
    public function display($tpl = null) {
        // get the Data
        $form = $this->get('Form');
        $item = $this->get('Item');
        $script = $this->get('Script');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        // Assign the Data
        $this->form = $form;
        $this->item = $item;
        $this->script = $script;

        // Set the toolbar
        $this->addToolBar();

        // Display the template
        parent::display($tpl);

        // Set the document
        $this->setDocument();
    }

    /**
     * Setting the toolbar
     */
    protected function addToolBar() {
        JRequest::setVar('hidemainmenu', true);
        $user = JFactory::getUser();
        $userId = $user->id;
        $isNew = $this->item->id == 0;
        $canDo = AutoContentHelper::getActions($this->item->id);
        JToolBarHelper::title($isNew ? JText::_('COM_AUTOCONTENT_MANAGER_URL_NEW') : JText::_('COM_AUTOCONTENT_MANAGER_URL_NEW_EDIT'), 'weblinks.png');
        // Built the actions for new and existing records.
        if ($isNew) {
            // For new records, check the create permission.
            if ($canDo->get('core.create')) {
                JToolBarHelper::apply('url.apply', 'JTOOLBAR_APPLY');
                JToolBarHelper::custom('url.save2new', 'purge.png', 'purge.png', 'COM_AUTOCONTENT_SAVE_FETCH_BUTTON', false);
                JToolBarHelper::save('url.save', 'JTOOLBAR_SAVE');
            }
            JToolBarHelper::cancel('url.cancel', 'JTOOLBAR_CANCEL');
        } else {
            if ($canDo->get('core.edit')) {
                // We can save the new record
                JToolBarHelper::apply('url.apply', 'JTOOLBAR_APPLY');
                JToolBarHelper::custom('url.save2new', 'purge.png', 'purge.png', 'COM_AUTOCONTENT_SAVE_FETCH_BUTTON', false);
                JToolBarHelper::save('url.save', 'JTOOLBAR_SAVE');
            }
            JToolBarHelper::cancel('url.cancel', 'JTOOLBAR_CLOSE');
        }
    }

    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function setDocument() {
        $isNew = $this->item->id == 0;
        $document = JFactory::getDocument();
        $document->setTitle($isNew ? JText::_('COM_AUTOCONTENT_URL_CREATING') : JText::_('COM_AUTOCONTENT_URL_EDITING'));
        $document->addScript(JURI::root() . $this->script);
        $document->addScript(JURI::root() . "/administrator/components/com_autocontent/views/feed/submitbutton.js");
        JText::script('COM_AUTOCONTENT_FEED_ERROR_UNACCEPTABLE');
    }

}
