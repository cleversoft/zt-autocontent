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
if (!class_exists('AutoContentControllerFeeds')) {
    jimport('joomla.application.component.controlleradmin');

    /**
     * Feeds Controller
     * List view controller
     */
    class AutoContentControllerFeeds extends JControllerAdmin {

        /**
         * Get model proxy
         * @param string $name
         * @param string $prefix         
         * @return object
         */
        public function getModel($name = 'Feeds', $prefix = 'AutoContentModel', $config = array('ignore_request' => true)) {
            $model = parent::getModel($name, $prefix, $config);
            return $model;
        }

    }

}
