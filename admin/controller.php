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
if (!class_exists('AutoContentController')) {

    /**
     * Component primary controller
     */
    class AutoContentController extends JControllerLegacy {

        /**
         * @var		string	The default view.	 
         */
        protected $default_view = 'feeds';

    }

}