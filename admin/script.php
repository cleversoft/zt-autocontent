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
 * Script file of HelloWorld component
 * @link http://docs.joomla.org/J2.5:Developing_a_MVC_Component/Adding_an_install-uninstall-update_script_file
 */
class com_autocontentInstallerScript {

    /**
     * method to install the component
     * @param type $parent
     */
    function install($parent) {
        // $parent is the class calling this method
        /* No need redirect to component page after installed */
        //$parent->getParent()->setRedirectURL('index.php?option=com_autocontent');
    }

    /**
     * method to uninstall the component
     *
     * @return void
     */
    function uninstall($parent) {
        // $parent is the class calling this method
        //echo '<p>' . JText::_('COM_AUTOCONTENT_UNINSTALL_TEXT') . '</p>';
    }

    /**
     * method to update the component
     *
     * @return void
     */
    function update($parent) {
        // $parent is the class calling this method
        //echo '<p>' . JText::_('COM_AUTOCONTENT_UPDATE_TEXT') . '</p>';
    }

    /**
     * method to run before an install/update/uninstall method
     *
     * @return void
     */
    function preflight($type, $parent) {
        // $parent is the class calling this method
        // $type is the type of change (install, update or discover_install)
        //echo '<p>' . JText::_('COM_AUTOCONTENT_PREFLIGHT_' . $type . '_TEXT') . '</p>';
    }

    /**
     * method to run after an install/update/uninstall method
     *
     * @return void
     */
    function postflight($type, $parent) {
        // $parent is the class calling this method
        // $type is the type of change (install, update or discover_install)
        //echo '<p>' . JText::_('COM_AUTOCONTENT_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
    }

}
