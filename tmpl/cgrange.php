<?php
/*
; Fields CG Range
; Version			: 1.1.1
; Package			: Joomla 4.x/5.x
; copyright 		: Copyright (C) 2024 ConseilGouz. All rights reserved.
; license    		: http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\Uri\Uri;

$value = $field->value;

$fieldparams = $field->fieldparams;

if ($value == '') {
    return;
}

if ($fieldparams->get('front', 'hide') == 'hide') {
// show only numbers
    echo $value;
    return;
}
// display cursor/range, but it is disabled
$base	= 'media/plg_fields_cgrange/';
$def_form = '';

$document = Factory::getApplication()->getDocument();
/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->registerAndUseStyle('cgrange', $base.'css/cgrange.css');
if ((bool)Factory::getConfig()->get('debug')) { // Mode debug
    $document->addScript(''.URI::root().$base.'js/cgrange.js');
} else {
    $wa->registerAndUseScript('cgrange', $base.'js/cgrange.js');
}

$typerange  = $fieldparams->get('typerange');
$min  = $fieldparams->get('min');
$max  = $fieldparams->get('max');
$step = $fieldparams->get('step');
$width = $fieldparams->get('width');
$limits = $fieldparams->get('limits');
$limitcls = "";
if ($limits == "show") {
    $limitcls = " limits";
}

$def_form  = "<div style='display:flex'>";
if ($typerange == 'cursor') {
    if (!$field->value) { // not initialized : set it to 1
        $field->value = $min;
    }
    $def_form .= "<input type='range' name='".$field->name."' id='range_".$field->id."' value='".$field->value."' style='width:".$width."' class='form-cgrange ".$limitcls."' data='range_".$field->id."' min='".$min."' max='".$max."' step='".$step."' disabled='disabled'> ";
    $def_form .= "<span id='cgrange-label-".$field->id."' class='cgrange-label' data='range_".$field->id."' style='margin-left:1em'></span>";
    $document->addScriptOptions(
        'range_'.$field->id,
        array('type' => $typerange,'min' => $min, 'max' => $max, 'step' => $step,'valmin' => $min, 'valmax' => $max)
    );
} else {
    $wa->registerAndUseStyle('cgrslider', $base.'css/rSlider.min.css');
    $wa->registerAndUseScript('cgrslider', $base.'js/rSlider.min.js');
    $def_form .= '<div style="width:'.$width.'" class="range_'.$field->id.'"><input class="form-cgrange" type="text" id="range_'.$field->id.'" name="'.$field->name.'"  data="range_'.$field->id.'"/></div>';
    $val = [];
    if (!$field->value) { // not initialized : set it to 1
        $val[0] = $min;
        $val[1] = $max;
    } else {
        $val = explode(',', $field->value);
    }
    $document->addScriptOptions(
        'range_'.$field->id,
        array('type' => $typerange,'min' => $min, 'max' => $max, 'step' => $step,'valmin' => $val [0], 'valmax' => $val[1], 'limits' => $limits,'enabled' => 'false')
    );
}
$def_form .= '</div>';

echo $def_form;
