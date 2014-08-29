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
if (!class_exists('AutoContentTableContent')) {
    jimport('joomla.database.table');

    /**
     * Feed Table class
     */
    class AutoContentTableContent extends JTable {

        /**
         * Constructor
         *
         * @param object Database connector object
         */
        function __construct(&$db) {
            parent::__construct('#__content', 'id', $db);
        }

    }

}
