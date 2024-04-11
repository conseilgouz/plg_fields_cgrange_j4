<?php
/*
; Fields CG Range
; Version			: 1.1.0
; Package			: Joomla 4.x/5.x
; copyright 		: Copyright (C) 2024 ConseilGouz. All rights reserved.
; license    		: http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

namespace ConseilGouz\Plugin\Fields\Cgrange\Extension;

defined('_JEXEC') or die;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Form\FormHelper;
use Joomla\Component\Fields\Administrator\Plugin\FieldsPlugin;

/**
 * Fields Text Plugin
 *
 */
class Cgrange extends FieldsPlugin
{
    public function onCustomFieldsPrepareDom($field, \DOMElement $parent, Form $form)
    {
        $fieldNode = parent::onCustomFieldsPrepareDom($field, $parent, $form);

        if (!$fieldNode) {
            return $fieldNode;
        }
        $fieldNode->setAttribute('typerange', $field->fieldparams->get('typerange', 'cursor'));
        $fieldNode->setAttribute('step', $field->fieldparams->get('step', '1'));
        $fieldNode->setAttribute('min', $field->fieldparams->get('min', '1'));
        $fieldNode->setAttribute('max', $field->fieldparams->get('max', '10'));
        $fieldNode->setAttribute('width', $field->fieldparams->get('width', 'auto'));
        $fieldNode->setAttribute('limits', $field->fieldparams->get('limits', 'show'));

        FormHelper::addFieldPrefix('ConseilGouz\Plugin\Fields\Cgrange\Form\Field');
        return $fieldNode;
    }

}
