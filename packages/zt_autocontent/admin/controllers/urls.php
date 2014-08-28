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

if (!class_exists('AutoContentControllerUrls')) {
    jimport('joomla.application.component.controlleradmin');

    /**
     * URLs Controller
     */
    class AutoContentControllerUrls extends JControllerAdmin {

        /**
         * Proxy for getModel.
         * @since	2.5
         */
        public function getModel($name = 'Urls', $prefix = 'AutoContentModel') {
            $model = parent::getModel($name, $prefix, array('ignore_request' => true));
            return $model;
        }

    }

}