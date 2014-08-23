<?php

/**
 * Zt Autocontent
 * @package Joomla.Component
 * @subpackage com_autolinks
 * @version 0.5.0
 *
 * @copyright   Copyright (c) 2013 APL Solutions (http://apl.vn)
 *
 */
defined('_JEXEC') or die;

if (!class_exists('AutoContentItemFeed')) {

    class AutoContentItemFeed extends AutoContentItem {

        private $_feed;

        public function init($feed) {
            $this->_feed = $feed;
            $this->title = $this->_feed->get_title();
            $this->link = $this->_feed->get_permalink();
            parent::init();
        }

        protected function _loadContent() {
            if ($this->link && $html = $this->_getFile($this->link)) {
                $html = $this->convert_to_utf8($html);
                $content = grabArticleHtml($html);
            } else {
                return false;
            }

            if (false !== stripos($content, 'readability was unable to parse this page for content'))
                $content = '';
            if (false !== stripos($content, 'return go_back();'))
                $content = '';

            $content = $this->_cleanContent($content);
            if ($content != '') {
                $this->content = $this->_parseImages($content, $this->_feed->get_base());
            }
            /* Load description */
            $this->description = $this->_cleanContent($this->_feed->get_description());
            return true;
        }

        private function _getFile($url) {
            if (ini_get('allow_url_fopen') != 1) {
                @ini_set('allow_url_fopen', '1');
            }
            if (ini_get('allow_url_fopen') != 1) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                //Set curl to return the data instead of printing it to the browser.
                curl_setopt($ch, CURLOPT_URL, $url);
                $data = curl_exec($ch);
                curl_close($ch);
                return $data;
            } else {
                return @file_get_contents($url);
            }

            return false;
        }

    }

}