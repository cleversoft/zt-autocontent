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

jimport('joomla.html.parameter.element');

class JElementK2Category extends JFormField {

    var $_name = 'k2category';

    function getInput() {
        return $this->fetchElement($this->name, $this->value, $this->element, $this->options['control']);
    }

    function getLabel() {
        if (method_exists($this, 'fetchTooltip')) {
            return $this->fetchTooltip($this->element['label'], $this->description, $this->element, $this->options['control'], $this->element['name'] = '');
        } else {
            return parent::getLabel();
        }
    }

    function render() {
        return $this->getInput();
    }

    function fetchElement($name, $value, &$node, $control_name) {
        $db = JFactory::getDBO();
        $query = 'SELECT m.* FROM #__k2_categories m WHERE published = 1 ORDER BY parent, ordering';
        $db->setQuery($query);
        $mitems = $db->loadObjectList();
        $children = array();

        if ($mitems) {
            foreach ($mitems as $v) {
                if (K2_JVERSION == '16') {
                    $v->title = $v->name;
                    $v->parent_id = $v->parent;
                }
                $pt = $v->parent;
                $list = @$children[$pt] ? $children[$pt] : array();
                array_push($list, $v);
                $children[$pt] = $list;
            }
        }

        $list = JHTML::_('menu.treerecurse', 0, '', array(), $children, 9999, 0, 0);
        $mitems = array();
        if ($name == 'categories' || $name == 'jform[params][categories]') {
            $doc = & JFactory::getDocument();
            $js = "
			window.addEvent('domready', function(){
				setTask();
			});
			
			function setTask() {
				var counter=0;
				$$('#paramscategories option').each(function(el) {
					if (el.selected){
						value=el.value;
						counter++;
					}
				});
				if (counter>1 || counter==0){
					$('urlparamsid').setProperty('value','');
					$('urlparamstask').setProperty('value','');
					$('paramssingleCatOrdering').setProperty('disabled', 'disabled');
					enableParams();
				}
				if (counter==1){
					$('urlparamsid').setProperty('value',value);
					$('urlparamstask').setProperty('value','category');
					$('paramssingleCatOrdering').removeProperty('disabled');
					disableParams();
				}
			}
			
			function disableParams(){
				$('paramsnum_leading_items').setProperty('disabled','disabled');
				$('paramsnum_leading_columns').setProperty('disabled','disabled');
				$('paramsleadingImgSize').setProperty('disabled','disabled');
				$('paramsnum_primary_items').setProperty('disabled','disabled');
				$('paramsnum_primary_columns').setProperty('disabled','disabled');
				$('paramsprimaryImgSize').setProperty('disabled','disabled');
				$('paramsnum_secondary_items').setProperty('disabled','disabled');
				$('paramsnum_secondary_columns').setProperty('disabled','disabled');
				$('paramssecondaryImgSize').setProperty('disabled','disabled');
				$('paramsnum_links').setProperty('disabled','disabled');
				$('paramsnum_links_columns').setProperty('disabled','disabled');
				$('paramslinksImgSize').setProperty('disabled','disabled');
				$('paramscatCatalogMode').setProperty('disabled','disabled');
				$('paramscatFeaturedItems').setProperty('disabled','disabled');
				$('paramscatOrdering').setProperty('disabled','disabled');
				$('paramscatPagination').setProperty('disabled','disabled');
				$('paramscatPaginationResults0').setProperty('disabled','disabled');
				$('paramscatPaginationResults1').setProperty('disabled','disabled');
				$('paramscatFeedLink0').setProperty('disabled','disabled');
				$('paramscatFeedLink1').setProperty('disabled','disabled');
				$('paramscatFeedIcon0').setProperty('disabled','disabled');
				$('paramscatFeedIcon1').setProperty('disabled','disabled');
				$('paramstheme').setProperty('disabled','disabled');
			}
			
			function enableParams(){
				$('paramsnum_leading_items').removeProperty('disabled');
				$('paramsnum_leading_columns').removeProperty('disabled');
				$('paramsleadingImgSize').removeProperty('disabled');
				$('paramsnum_primary_items').removeProperty('disabled');
				$('paramsnum_primary_columns').removeProperty('disabled');
				$('paramsprimaryImgSize').removeProperty('disabled');
				$('paramsnum_secondary_items').removeProperty('disabled');
				$('paramsnum_secondary_columns').removeProperty('disabled');
				$('paramssecondaryImgSize').removeProperty('disabled');
				$('paramsnum_links').removeProperty('disabled');
				$('paramsnum_links_columns').removeProperty('disabled');
				$('paramslinksImgSize').removeProperty('disabled');
				$('paramscatCatalogMode').removeProperty('disabled');
				$('paramscatFeaturedItems').removeProperty('disabled');
				$('paramscatOrdering').removeProperty('disabled');
				$('paramscatPagination').removeProperty('disabled');
				$('paramscatPaginationResults0').removeProperty('disabled');
				$('paramscatPaginationResults1').removeProperty('disabled');
				$('paramscatFeedLink0').removeProperty('disabled');
				$('paramscatFeedLink1').removeProperty('disabled');
				$('paramscatFeedIcon0').removeProperty('disabled');
				$('paramscatFeedIcon1').removeProperty('disabled');
				$('paramstheme').removeProperty('disabled');
			}
			";



            $doc->addScriptDeclaration($js);
        }

        foreach ($list as $item) {
            $item->treename = JString::str_ireplace('&#160;', '- ', $item->treename);
            @$mitems[] = JHTML::_('select.option', $item->id, $item->treename);
        }

        if (K2_JVERSION == '16') {
            $fieldName = $name;
        } else {
            $fieldName = $control_name . '[' . $name . '][]';
        }

        if ($name == 'categories' || $name == 'jform[params][categories]') {
            $onChange = 'onchange="setTask();"';
        } else {
            $onChange = '';
        }

        return JHTML::_('select.genericlist', $mitems, $fieldName, $onChange . ' class="inputbox" ', 'value', 'text', $value);
    }

}
