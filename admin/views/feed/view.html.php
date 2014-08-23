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

if (!class_exists('AutoContentViewFeed')) {
    jimport('joomla.application.component.view');

    /**
     * Feed View
     */
    class AutoContentViewFeed extends JViewLegacy {

        /**
         * display method of Hello view
         * @return void
         */
        public function display($tpl = null) {

            $this->form = $this->get('Form');
            $this->item = $this->get('Item');

            // Check for errors.
            if (count($errors = $this->get('Errors'))) {
                JError::raiseError(500, implode('<br />', $errors));
                return false;
            }

            $this->_addToolBar();
            $this->_setDocument();

            parent::display($tpl);
        }

        /**
         * Setting the toolbar
         */
        protected function _addToolBar() {
            JRequest::setVar('hidemainmenu', true);
            $isNew = $this->item->id == 0;
            $canDo = AutoContentHelper::getActions($this->item->id);
            JToolBarHelper::title($isNew ? JText::_('COM_AUTOCONTENT_MANAGER_FEED_NEW') : JText::_('COM_AUTOCONTENT_MANAGER_FEED_NEW_EDIT'), 'article-add.png');
            // Built the actions for new and existing records.
            if ($isNew) {
                // For new records, check the create permission.
                if ($canDo->get('core.create')) {
                    JToolBarHelper::apply('feed.apply', 'JTOOLBAR_APPLY');
                    JToolBarHelper::custom('feed.save2new', 'purge', 'purge', 'COM_AUTOCONTENT_SAVE_NEW_BUTTON', false);
                    JToolBarHelper::save('feed.save', 'JTOOLBAR_SAVE');
                }
                JToolBarHelper::cancel('feed.cancel', 'JTOOLBAR_CANCEL');
            } else {
                if ($canDo->get('core.edit')) {
                    // We can save the new record
                    JToolBarHelper::apply('feed.apply', 'JTOOLBAR_APPLY');
                    JToolBarHelper::custom('feed.save2new', 'purge', 'purge', 'COM_AUTOCONTENT_SAVE_NEW_BUTTON', false);
                    JToolBarHelper::save('feed.save', 'JTOOLBAR_SAVE');
                }
                JToolBarHelper::cancel('feed.cancel', 'JTOOLBAR_CLOSE');
            }
        }

        /**
         * Method to set up the document properties
         *
         * @return void
         */
        protected function _setDocument() {
            $isNew = $this->item->id == 0;
            $document = JFactory::getDocument();
            $document->setTitle($isNew ? JText::_('COM_AUTOCONTENT_FEED_CREATING') : JText::_('COM_AUTOCONTENT_FEED_EDITING'));
            JText::script('COM_AUTOCONTENT_FEED_ERROR_UNACCEPTABLE');
        }

    }

}