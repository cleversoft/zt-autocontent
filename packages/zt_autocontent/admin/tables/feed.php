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

// import Joomla table library
jimport('joomla.database.table');

/**
 * Feed Table class
 */
class AutoContentTableFeed extends JTable {

    /**
     * Constructor
     *
     * @param object Database connector object
     */
    public $id = null;
    public $type = null;
    public $feed_name = null;
    public $feed_url = null;
    public $feed_type = null;
    public $content_id = null;
    public $k2_id = null;
    public $author_id = null;
    public $update = null;
    public $get_articles = null;
    public $status = null;
    public $get_class = null;
    public $ignore_class = null;
    public $get_id = null;
    public $ignore_id = null;
    public $post_interval = null;
    public $image_path = null;
    public $remove_tag = null;
    public $allow_tags = null;
    public $replace_chars = null;
    public $replace_texts = null;
    public $creation_date = null;
    public $start_publishing = null;
    public $published = null;

    public function __construct(&$db) {
        parent::__construct('#__autocontent_feed', 'id', $db);
    }

    public function check() {
        $user = JFactory::getUser();
        if (!$this->author_id) {
            $this->author_id = $user->get('id');
        }
        return true;
    }

}
