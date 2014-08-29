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
if (!class_exists('AutoContentItem')) {

    /**
     * 
     */
    abstract class AutoContentItem extends JObject {

        public $isDuplicated = false;

        public function __construct($properties = null) {
            parent::__construct($properties);
        }

        /**
         * 
         */
        public function init() {
            if ($this->title && strpos($this->title, ' - ')) {
                $backup = $this->title;
                $backup = preg_replace('/([-])/', '$1[D]', $backup);
                $backup = explode('[D]', $backup);

                if (strlen($backup[0]) > 10 || count($backup) >= 2) {
                    unset($backup[count($backup) - 1]);
                    $this->title = trim(implode('', $backup), ' - ');
                }
            }
            $this->isDuplicated = $this->_isJoomlaContentDuplicate($title) || $this->_isK2Duplicate($title);
            if (!$this->isDuplicated) {
                if (false !== strpos($this->link, 'news.google.com')) {
                    $link = urldecode(substr($this->link, strpos($this->link, 'url=') + 4));
                } elseif (false !== strpos($this->link, '/**')) {
                    $link = urldecode(substr($this->link, strpos($this->link, '/**') + 3));
                }
                $this->_loadContent();
            }
        }

        abstract protected function _loadContent();

        /**
         * 
         * @param type $title
         * @return boolean
         */
        private function _isK2Duplicate($title) {
            $db = JFactory::getDBO();
            $query = "SELECT COUNT(*) FROM #__k2_items WHERE title = " . $db->Quote($title) . "";
            $db->setQuery($query);
            $count = $db->loadResult();

            return ($count) ? true : false;
        }

        /**
         * 
         * @param type $title
         * @return boolean
         */
        private function _isJoomlaContentDuplicate($title) {
            $db = JFactory::getDBO();
            $query = "SELECT COUNT(*) FROM #__content WHERE title = " . $db->Quote($title) . "";
            $db->setQuery($query);
            $count = $db->loadResult();

            return ($count) ? true : false;
        }

        protected function _cleanContent($text) {
            $is_remove = $this->item->remove_tag;
            $allow_tags = $this->item->allow_tags;
            $allow_tags = str_replace("/", "", $allow_tags);
            $allow_tags = str_replace(" ", "", $allow_tags);

            if ($is_remove) {
                $text = strip_tags($text, $allow_tags);
            }

            if ($this->item->ignore_class == '' && $this->item->ignore_id == '') {
                return $text;
            }

            $document = new DOMDocument();
            $text = mb_convert_encoding($text, 'HTML-ENTITIES', "UTF-8");
            @$document->loadHTML($text);

            $allParagraphs = $document->getElementsByTagName('*');
            $articleContent = $document->createElement('div');

            foreach ($allParagraphs as $node) {
                if ($node->tagName == 'html' || $node->tagName == 'body') {
                    continue;
                }

                $pid = $node->parentNode->getAttribute('id');
                $pclass = $node->parentNode->hasAttribute('class');
                $class = $node->hasAttribute('class');
                $id = $node->hasAttribute('id');

                //Parent node			
                if ($pclass && $node->parentNode->getAttribute('class') != '' && $this->item->ignore_class != '') {
                    if (preg_match('/(' . $this->item->ignore_class . ')/', $node->parentNode->getAttribute('class'))) {
                        $node->parentNode->parentNode->removeChild($node->parentNode);
                    }
                }
                if ($pid && $node->parentNode->getAttribute('id') != '' && $this->item->ignore_id != '') {
                    if (preg_match('/(' . $this->item->ignore_id . ')/', $node->parentNode->getAttribute('id'))) {
                        $node->parentNode->parentNode->removeChild($node->parentNode);
                    }
                }

                //Child node
                if ($class && $node->getAttribute('class') != '' && $this->item->ignore_class != '') {
                    if (preg_match('/(' . $this->item->ignore_class . ')/', $node->getAttribute('class'))) {
                        $node->parentNode->removeChild($node);
                    }
                }
                if ($id && $node->getAttribute('id') != '' && $this->item->ignore_id != '') {
                    if (preg_match('/(' . $this->item->ignore_id . ')/', $node->getAttribute('id'))) {
                        $node->parentNode->removeChild($node);
                    }
                }
            }

            foreach ($allParagraphs as $node) {
                $articleContent->appendChild($node);
            }

            $text = $articleContent->ownerDocument->saveXML($articleContent);
            $text = str_replace(array('<html>', '<body>', '</body>', '</html>'), '', $text);

            return $text;
        }

        protected function _parseImages($content, $link) {
            preg_match_all('/<img(.+?)src=\"(.+?)\"(.*?)>/', $content, $images);
            $urls = $images[2];

            if (count($urls)) {
                foreach ($urls as $pos => $url) {
                    $oldurl = $url;
                    $meta = parse_url($url);

                    if (!isset($meta['host'])) {
                        $meta = parse_url($link);
                        $url = str_replace("../", "", $url);
                        $url = $meta['scheme'] . '://' . $meta['host'] . '/' . $url;
                    }

                    $newurl = $this->cache_image($url, $feed);
                    if ($newurl)
                        $content = str_replace($oldurl, $newurl, $content);
                    else
                        $content = str_replace($images[0][$pos], '', $content);
                }
            }

            return $content;
        }

        protected function _cacheImage($url, $feed) {
            if (strpos($url, "icon_") !== FALSE)
                return false;

            $contents = $this->get_file($url);

            if (!$contents)
                return false;

            $basename = basename($url);
            $paresed_url = parse_url($basename);
            $filename = $paresed_url['path'];
            $cachepath = date("Y-m-d");
            $root = JURI::root();
            $real_cachepath = $feed->image_path . DS . $cachepath;

            if (!JFolder::exists(JPATH_ROOT . DS . $real_cachepath)) {
                JFolder::create(JPATH_ROOT . DS . $real_cachepath);
            }

            if (!JFolder::exists(JPATH_ROOT . DS . $real_cachepath)) {
                $real_cachepath = "images" . DS . "com_autocontent" . DS . $cachepath;
                JFolder::create(JPATH_ROOT . DS . $real_cachepath);
            }

            if (is_writable(JPATH_ROOT . DS . $real_cachepath)) {
                if ($contents) {
                    if (!JFile::exists(JPATH_ROOT . DS . $real_cachepath . DS . $filename))
                        JFile::write(JPATH_ROOT . DS . $real_cachepath . DS . $filename, $contents);

                    return str_replace(DS, "/", $real_cachepath . DS . rawurlencode($filename));
                }
            }

            return false;
        }

        public function getTitle() {
            return trim($this->title);
        }

        public function getContent() {
            return trim($this->content);
        }

    }

}