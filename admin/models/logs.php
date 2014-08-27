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

// import the Joomla modellist library
jimport('joomla.application.component.modellist');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

/**
 * FeedList Model
 */
class AutoContentModelLogs extends JModelList {

    /**
     * Method to build an SQL query to load the list data.
     *
     * @return	string	An SQL query
     */
    protected function populateState($ordering = null, $direction = null) {
        // Initialise variables.
        $app = JFactory::getApplication('administrator');

        // Load the filter date.
        $date = $this->getUserStateFromRequest($this->context . '.filter.log_date', 'filter_log_date');
        $this->setState('filter.log_date', $date);

        // Load the filter search.
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        // List state information.
        parent::populateState('id', 'ASC');
    }

    protected function getListQuery() {
        // Create a new query object.		
        $db = JFactory::getDBO();
        $time = JRequest::getVar("time");
        $time = ($time != NULL) ? date("Y-m-d H:i:s", $time) : NULL;
        $query = $db->getQuery(true);
        // Select some fields
        $query->select('*');

        // From the hello table
        $query->from('#__autocontent_log');
        if ($time != NULL) {
            $query->where('created_on >= ' . $db->Quote($time));
        }

        //Filter date
        $date = $this->getState('filter.log_date');
        if ($date != "" && $date != NULL) {
            $query->where('created_on >= ' . $db->Quote($date));
        }

        //Search text
        $type = $this->getState('filter.search');
        if ($this->getState('filter.search') !== '') {
            $token = $db->Quote('%' . $db->escape($this->getState('filter.search')) . '%');

            // Compile the different search clauses.
            $searches = array();
            $searches[] = 'message LIKE ' . $token;

            // Add the clauses to the query.
            $query->where('(' . implode(' OR ', $searches) . ')');
        }

        return $query;
    }

    public function delete($cid) {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);

        $query->delete('#__autocontent_log');
        $query->where('id IN (' . implode(", ", $cid) . ')');

        $db->setQuery((string) $query);
        $this->setError((string) $query);
        $db->query();

        // Check for a database error.
        if ($db->getErrorNum()) {
            $this->setError($db->getErrorMsg());
            return false;
        }

        return true;
    }

    public function clear() {
        $db = JFactory::getDBO();
        $query = "TRUNCATE TABLE #__autocontent_log";

        $db->setQuery((string) $query);
        $this->setError((string) $query);
        $db->query();

        // Check for a database error.
        if ($db->getErrorNum()) {
            $this->setError($db->getErrorMsg());
            return false;
        }

        return true;
    }

}
