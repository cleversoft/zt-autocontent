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
 * AutoContent component helper.
 */
class AutoContentHelper {

    /**
     * Configure the Linkbar.
     */
    public static function addSubmenu($submenu) {
        JSubMenuHelper::addEntry(JText::_('COM_AUTOCONTENT_SUBMENU_FEEDS'), 'index.php?option=com_autocontent', $submenu == 'feeds');
        JSubMenuHelper::addEntry(JText::_('COM_AUTOCONTENT_SUBMENU_URLS'), 'index.php?option=com_autocontent&view=urls', $submenu == 'urls');
        JSubMenuHelper::addEntry(JText::_('COM_AUTOCONTENT_SUBMENU_CHANGLOG'), 'index.php?option=com_autocontent&view=logs', $submenu == 'logs');
    }

    /**
     * Get the actions
     */
    public static function getActions($messageId = 0) {
        $user = JFactory::getUser();
        $result = new JObject;

        if (empty($messageId)) {
            $assetName = 'com_autocontent';
        } else {
            $assetName = 'com_autocontent.message.' . (int) $messageId;
        }

        $actions = array(
            'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.delete'
        );

        foreach ($actions as $action) {
            $result->set($action, $user->authorise($action, $assetName));
        }

        return $result;
    }

    public static function isK2Enabled() {
        $db = JFactory::getDbo();
        $db->setQuery('SELECT' . $db->quoteName('enabled') . ' FROM ' . $db->quoteName('#__extensions') . ' WHERE ' . $db->quoteName('name') . ' = ' . $db->quote('com_k2'));
        return (bool) $db->loadResult();
    }

}
