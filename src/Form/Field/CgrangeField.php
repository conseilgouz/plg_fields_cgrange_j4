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
        $min  = $this->getAttribute('min');
        $max  = $this->getAttribute('max');
        $step = $this->getAttribute('step');
        $width = (string)$this->getAttribute('width');
        $limits = (string)$this->getAttribute('limits');

        $document = Factory::getApplication()->getDocument();
        /** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
        $wa = Factory::getApplication()->getDocument()->getWebAssetManager();
        $wa->registerAndUseStyle('cgrange', $base.'css/cgrange.css');
        if ((bool)Factory::getApplication()->getConfig()->get('debug')) { // Mode debug
            $document->addScript(''.URI::root().$base.'js/cgrange.js');
        } else {
            $wa->registerAndUseScript('cgrange', $base.'js/cgrange.js');
        }
        $def_form  = "<div style='display:flex'>";
        $wa->registerAndUseStyle('cgrslider', $base.'css/rSlider.min.css');
        $wa->registerAndUseScript('cgrslider', $base.'js/rSlider.min.js');
        $def_form .= '<div style="width:'.$width.'" class="'.$this->id.'"><input class="form-cgrange" type="text" id="'.$this->id.'" name="'.$this->name.'"  data="'.$this->id.'"/></div>';
        $val = [];
        $val = [];
        if (!$this->value) { // not initialized : set it to 1
            $val[0] = $min;
            $val[1] = $max;
            $this->value = $min;
        } else {
            if ($typerange == "cursor") {
                $val[0] = $this->value;
                $val[1] = $this->value;
            } else { // range
                $val = explode(',', $this->value);
            }
        }
        $document->addScriptOptions(
            $this->id,
            array('type' => $typerange,'min' => $min, 'max' => $max, 'step' => $step,'valmin' => $val [0], 'valmax' => $val[1], 'limits' => $limits, 'enabled' => 'true','width' => $width )
        );
        $def_form .= '</div>';

        return $def_form;
    }
}
