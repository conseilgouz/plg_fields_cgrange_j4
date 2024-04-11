<?php
/*
; Fields CG Range
; Version			: 1.1.1
; Package			: Joomla 4.x/5.x
; copyright 		: Copyright (C) 2024 ConseilGouz. All rights reserved.
; license    		: https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

namespace ConseilGouz\Plugin\Fields\Cgrange\Form\Field;

defined('_JEXEC') or die('Restricted access');
use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\Uri\Uri;

class CgrangeField extends FormField
{
    protected $type = 'cgrange';

    public function getInput()
    {
        $base	= 'media/plg_fields_cgrange/';
        $def_form = '';
        $typerange  = (string)$this->getAttribute('typerange');
        $min  = (int)$this->getAttribute('min');
        $max  = (int)$this->getAttribute('max');
        $step = (int)$this->getAttribute('step');
        $width = (string)$this->getAttribute('width');
        $limits = (string)$this->getAttribute('limits');
        $limitcls = "";
        if ($limits == "show") {
            $limitcls = " limits";
        }
        $document = Factory::getApplication()->getDocument();
        /** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
        $wa = Factory::getApplication()->getDocument()->getWebAssetManager();
        $wa->registerAndUseStyle('cgrange', $base.'css/cgrange.css');
        if ((bool)Factory::getConfig()->get('debug')) { // Mode debug
            $document->addScript(''.URI::root().$base.'js/cgrange.js');
        } else {
            $wa->registerAndUseScript('cgrange', $base.'js/cgrange.js');
        }
        $def_form  = "<div style='display:flex'>";
        if ($typerange == 'cursor') {
            if (!$this->value) { // not initialized : set it to 1
                $this->value = $min;
            }
            $def_form .= "<input type='range' name='".$this->name."' id='".$this->id."' value='".$this->value."' style='width:".$width."' class='form-cgrange ".$limitcls."' data='".$this->id."' min='".$min."' max='".$max."' step='".$step."'> ";
            $def_form .= "<span id='cgrange-label-".$this->id."' class='cgrange-label' data='".$this->id."' style='margin-left:1em'></span>";
            $document->addScriptOptions(
                $this->id,
                array('type' => $typerange,'min' => $min, 'max' => $max, 'step' => $step,'valmin' => $min, 'valmax' => $max)
            );
        } else {
            $wa->registerAndUseStyle('cgrslider', $base.'css/rSlider.min.css');
            $wa->registerAndUseScript('cgrslider', $base.'js/rSlider.min.js');
            $def_form .= '<div style="width:'.$width.'" class="'.$this->id.'"><input class="form-cgrange" type="text" id="'.$this->id.'" name="'.$this->name.'"  data="'.$this->id.'"/></div>';
            $val = [];
            if (!$this->value) { // not initialized : set it to 1
                $val[0] = $min;
                $val[1] = $max;
            } else {
                $val = explode(',', $this->value);
            }
            $document->addScriptOptions(
                $this->id,
                array('type' => $typerange,'min' => $min, 'max' => $max, 'step' => $step,'valmin' => $val [0], 'valmax' => $val[1], 'limits' => $limits, 'enabled' => 'true' )
            );
        }
        $def_form .= '</div>';

        return $def_form;
    }
}
