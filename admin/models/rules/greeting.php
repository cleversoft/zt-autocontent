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
if (!class_exists('JFormRuleGreeting')) {
    jimport('joomla.form.formrule');

    /**
     * Form Rule class for the Joomla Framework.
     */
    class JFormRuleGreeting extends JFormRule {

        /**
         * The regular expression.
         *
         * @access	protected
         * @var		string
         * @since	1.6
         */
        protected $regex = '^[^0-9]+$';

    }

}

