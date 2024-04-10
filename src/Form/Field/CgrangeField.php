<?php
/*
; Fields CG Range
; Version			: 1.0.0
; Package			: Joomla 4.x/5.x
; copyright 		: Copyright (C) 2024 ConseilGouz. All rights reserved.
; license    		: https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

namespace ConseilGouz\Plugin\Fields\Cgrange\Form\Field;

defined('_JEXEC') or die('Restricted access');
use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;

class CgrangeField extends FormField
{
    protected $type = 'cgrange';

    public function getInput()
    {
        $base	= 'media/plg_fields_cgrange/';
        $def_form = '';
        $min  = (int)$this->getAttribute('min');
        $max  = (int)$this->getAttribute('max');
        $step = (int)$this->getAttribute('step');
        $width = (string)$this->getAttribute('width');
        $limits = (string)$this->getAttribute('limits');
        $limitcls = "";
        if ($limits == "show") {
            $limitcls = " limits";
        }
        /** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
        $wa = Factory::getApplication()->getDocument()->getWebAssetManager();
        $wa->registerAndUseStyle('cgrange', $base.'css/cgrange.css');
        $wa->registerAndUseScript('cgrange', $base.'js/cgrange.js');
        $def_form  = "<div style='display:flex'>";
        $def_form .= "<input type='range' name='".$this->name."' id='".$this->id."' value='".$this->value."' style='width:".$width."' class='form-cgrange ".$limitcls."' min='".$min."' max='".$max."' step='".$step."'> ";
        $def_form .= "<span id='cgrange-label-".$this->id."' class='cgrange-label' data='".$this->id."' style='margin-left:1em'></span>";
        $def_form .= '</div>';
        return $def_form;
    }
}
