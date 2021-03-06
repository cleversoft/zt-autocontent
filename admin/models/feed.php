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
if (!class_exists('AutoContentModelFeed')) {
    jimport('joomla.application.component.modeladmin');

    /**
     * Feed Model
     */
    class AutoContentModelFeed extends JModelAdmin {

        /**
         * Method override to check if you can edit an existing record.
         *
         * @param	array	$data	An array of input data.
         * @param	string	$key	The name of the key for the primary key.
         *
         * @return	boolean
         * @since	1.6
         */
        protected function allowEdit($data = array(), $key = 'id') {
            // Check specific edit permission then general edit permission.
            return JFactory::getUser()->authorise('core.edit', 'com_autocontent.message.' . ((int) isset($data[$key]) ? $data[$key] : 0)) or parent::allowEdit($data, $key);
        }

        /**
         * Returns a reference to the a Table object, always creating it.
         *
         * @param	type	The table type to instantiate
         * @param	string	A prefix for the table class name. Optional.
         * @param	array	Configuration array for model. Optional.
         * @return	JTable	A database object
         * @since	1.6
         */
        public function getTable($type = 'Feed', $prefix = 'AutoContentTable', $config = array()) {
            return JTable::getInstance($type, $prefix, $config);
        }

        /**
         * Method to get the record form.
         *
         * @param	array	$data		Data for the form.
         * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
         * @return	mixed	A JForm object on success, false on failure
         * @since	1.6
         */
        public function getForm($data = array(), $loadData = true) {
            // Get the form.
            $form = $this->loadForm('com_autocontent.feed', 'feed', array('control' => 'jform', 'load_data' => $loadData));
            if (empty($form)) {
                return false;
            }
            return $form;
        }

        /**
         * Method to get the data that should be injected in the form.
         *
         * @return	mixed	The data for the form.
         * @since	1.6
         */
        protected function loadFormData() {
            // Check the session for previously entered form data.
            $data = JFactory::getApplication()->getUserState('com_autocontent.edit.feed.data', array());
            if (empty($data)) {
                $data = $this->getItem();
            }
            return $data;
        }

    }

}
