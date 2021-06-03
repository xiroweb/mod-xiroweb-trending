<?php

/**
 * @copyright	Copyright (C) 2020 by XiroWeb
 * @license		GNU/GPL
 * */
// no direct access
defined('_JEXEC') or die('Restricted access');


class JFormFieldLayoutdemo extends JFormField {

	protected $type = 'layoutdemo';

	protected function getInput() {
		$mediaPath = JUri::root(true) . '/media/mod_xiroweb_trending/images/';
		$styles = $this->element['styles'];
		$background = $this->element['background'] ? 'background: url(' . $mediaPath . $this->element['background'] . ') left top no-repeat;' : '';
		$img = $mediaPath . $this->element['background'];

		// $html = '<p style="' . $background . $styles . '" ></p>';
		$html = '<p><img src="'.$img.'"/></p>';
		return $html;
	}

	protected function getLabel() {
		return '';
	}
}
