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

// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');

if (!class_exists('AutoContentControllerLogs')) {

    /**
     * Logs Controller
     */
    class AutoContentControllerLogs extends JControllerAdmin {

        /**
         * Proxy for Model
         * @param type $name
         * @param type $prefix
         * @param type $options
         * @return type
         */
        public function getModel($name = 'Logs', $prefix = 'AutoContentModel', $options = array('ignore_request' => true)) {
            $model = parent::getModel($name, $prefix, $options);
            return $model;
        }

        public function clear() {
            $model = $this->getModel();
            $model->clear();

            $this->setMessage(JTEXT::_("COM_AUTOCONTENT_FEED_CLEAR_SUCCESS"));
            $this->setRedirect(JRoute::_('index.php?option=com_autocontent&view=logs', false));
        }

    }

}
