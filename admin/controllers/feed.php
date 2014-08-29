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
if (!class_exists('AutoContentControllerFeed')) {
    jimport('joomla.application.component.controllerform');

    /**
     * Feed Controller
     * Controller to process for each feed item
     */
    class AutoContentControllerFeed extends JControllerForm {

        /**
         * 
         * @param type $config
         */
        public function __construct($config = array()) {
            /* Set default view list */
            $this->view_list = 'feeds';
            parent::__construct($config);
        }

        protected function checkEditId($context, $id) {
            return true;
        }

        /**
         * Do fetch data
         */
        public function load() {
            $app = JFactory::getApplication();

            $model = $this->getModel('Feeds', 'AutoContentModel');
            $cid = JFactory::getApplication()->input->get('cid', array(), 'ARRAY');

            $time = strtotime(date("Y-m-d H:i:s"));

            for ($i = 0; $i < count($cid); $i++) {
                $feed = $model->getFeed($cid[$i]);
                $data = $model->load($feed);
                $model->processData($data, $feed);
            }

            $this->setRedirect(JRoute::_('index.php?option=com_autocontent&view=logs&time=' . $time, false), JTEXT::_("COM_AUTOCONTENT_FEED_LOAD_SUCCESS"));
        }

        /**
         * Get model proxy
         * @param string $name
         * @param string $prefix         
         * @return object
         */
        public function getModel($name = 'Feed', $prefix = 'AutoContentModel', $config = array('ignore_request' => true)) {
            $model = parent::getModel($name, $prefix, $config);
            return $model;
        }

    }

}