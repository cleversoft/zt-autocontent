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
if (!class_exists('JFormFieldDateTime')) {
    jimport('joomla.form.helper');
    JFormHelper::loadFieldClass('list');

    /**
     * HelloWorld Form Field class for the HelloWorld component
     */
    class JFormFieldDateTime extends JFormFieldList {

        /**
         * The field type.
         *
         * @var		string
         */
        protected $type = 'DateTime';

        /**
         * Method to get a list of options for a list input.
         *
         * @return	array		An array of JHtml options.
         */
        protected function getInput() {
            $date = JFactory::getDate();
            $this->value = ($this->value != '0000-00-00 00:00:00') ? $this->value : '';

            return JHTML::_('calendar', $this->value, $this->name, $this->name, '%Y-%m-%d');
        }

    }

}
