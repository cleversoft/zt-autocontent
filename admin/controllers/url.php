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
if (!class_exists('AutoContelControllerUrl')) {
    jimport('joomla.application.component.controllerform');

    /**
     * URL  Controller
     */
    class AutoContentControllerUrl extends JControllerForm {

        /**
         * Do fetch data
         * @global type $app
         */
        public function load() {
            $model = parent::getModel('Urls', 'AutoContentModel');
            $cid = JRequest::getVar("cid");
            $time = strtotime(date("Y-m-d H:i:s"));

            for ($i = 0; $i < count($cid); $i++) {
                $feed = $model->getFeed($cid[$i]);
                $urls = explode("\n", $feed->feed_url);

                if (count($urls))
                    for ($k = 0; $k < count($urls); $k++) {
                        $url = trim($urls[$k]);
                        if ($url != "") {
                            $model->processData($url, $feed);
                        }
                    }
            }
            $this->setMessage(JTEXT::_("COM_AUTOCONTENT_URL_LOAD_SUCCESS"));
            $this->setRedirect(JRoute::_('index.php?option=com_autocontent&view=logs&time=' . $time, false));
        }

    }

}