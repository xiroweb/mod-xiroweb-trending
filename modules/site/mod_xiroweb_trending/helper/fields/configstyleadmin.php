<?php

/**
 * @copyright	Copyright (C) 2020 by XiroWeb
 * @license		GNU/GPL
 * */
// no direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;

class JFormFieldConfigstyleadmin extends JFormField {

	protected $type = 'configstyleadmin';

	protected function getInput() {

		Factory::getDocument()->addStyleDeclaration('
				@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap");

				#general {
					padding: 10px;
					border-radius: 12px;
					background-color: #85FFBD;
					background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);
				}
				#general > div[class*="row"] > div:nth-of-type(1) {
					font-family: "Roboto", sans-serif;
					font-size: 120%;
					font-weight: 400;
				}
	
				#general .control-label {
				    float: none;
				    width: auto;
				    padding-right: 0;
				    padding-top: 0;
				    text-align: left;
				}
				#general .control-label > label {
					display: inline-block;
					*display: inline;
					*zoom: 1;
				}
				#general .controls {
					margin-left: 0;
				}
	
			

				#general > div[class*="row"] > div:nth-of-type(1)  input[type="number"] {
				    font-size: 20px;
				    font-weight: bold;
				    color: #1976d2;
				    width: inherit;
				}

				#general > div[class*="row"] > div:nth-of-type(1) .chzn-container-single .chzn-single {
					border: 2px solid #2196f3;
				}
				#general > div[class*="row"] > div:nth-of-type(1) .chzn-container .chzn-drop,
				#general > div[class*="row"] > div:nth-of-type(1) .chzn-container-multi .chzn-choices
				 {
					border: 2px solid #2196f3;
				}
				#general > div[class*="row"] > div:nth-of-type(1) .chzn-container .chzn-results {
					font-weight: 700;
					color: #2196f3;
				}

				#general > div[class*="row"] > div:nth-of-type(1) textarea,
				#general > div[class*="row"] > div:nth-of-type(1)  input[type="text"],
				#general > div[class*="row"] > div:nth-of-type(1)  input[type="password"],
				#general > div[class*="row"] > div:nth-of-type(1)  input[type="datetime"],
				#general > div[class*="row"] > div:nth-of-type(1)  input[type="datetime-local"],
				#general > div[class*="row"] > div:nth-of-type(1)  input[type="date"],
				#general > div[class*="row"] > div:nth-of-type(1)  input[type="month"],
				#general > div[class*="row"] > div:nth-of-type(1)  input[type="time"],
				#general > div[class*="row"] > div:nth-of-type(1)  input[type="week"],
				#general > div[class*="row"] > div:nth-of-type(1)  input[type="number"],
				#general > div[class*="row"] > div:nth-of-type(1)  input[type="email"],
				#general > div[class*="row"] > div:nth-of-type(1)  input[type="url"],
				#general > div[class*="row"] > div:nth-of-type(1)  input[type="search"],
				#general > div[class*="row"] > div:nth-of-type(1)  input[type="tel"],
				#general > div[class*="row"] > div:nth-of-type(1)  input[type="color"],
				#general > div[class*="row"] > div:nth-of-type(1)  .uneditable-input,
				#general > div[class*="row"] > div:nth-of-type(1)  .chzn-container-multi .chzn-choices
				 {
					box-shadow: 0 6px 6px rgb(0 0 0 / 7%), 0 6px 6px rgb(0 0 0 / 16%);
					background: #FFFFFF;
				}
			
		');
		return '';
	}

	protected function getLabel() {
		return '';
	}
}
