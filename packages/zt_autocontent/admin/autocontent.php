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

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

$document = JFactory::getDocument();
$document->addStyleSheet(Juri::root().'administrator/components/com_autocontent/assets/css/autocontent.css');

/* Permission checking */
if (!JFactory::getUser()->authorise('core.manage', 'com_ztautolinks')) {
    return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}
/* Register tables directory */
JTable::addIncludePath(__DIR__ . '/tables');
require_once( dirname(__FILE__) . '/libraries/vendor/simplepie/autoloader.php');
require_once( dirname(__FILE__) . '/libraries/vendor/readability.php');
JLoader::register('AutoContentHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'autocontent.php');

/* Controller process */
$jinput = JFactory::getApplication()->input;
$controller = JControllerLegacy::getInstance('AutoContent');
$controller->execute($jinput->getCmd('task'));
$controller->redirect();
