<?php
/*
; Fields CG Range
; Version			: 1.0.0
; Package			: Joomla 4.x/5.x
; copyright 		: Copyright (C) 2024 ConseilGouz. All rights reserved.
; license    		: http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/
defined('_JEXEC') or die;
$value = $field->value;
if ($value == '') {
    return;
}
echo $value;
