<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_xiroweb_trending
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the helper functions only once
JLoader::register('ModXirowebTintrendingHelper', __DIR__ . '/helper.php');

$input = JFactory::getApplication()->input;

// Prep for Normal or Dynamic Modes
$mode   = $params->get('switchmode', 'options');

$cacheid = md5($module->id);

$cacheparams               = new stdClass;
$cacheparams->cachemode    = 'id';
$cacheparams->class        = 'ModXirowebTintrendingHelper';
$cacheparams->method       = 'getList';
$cacheparams->methodparams = $params;
$cacheparams->modeparams   = $cacheid;



$list = JModuleHelper::moduleCache($module, $params, $cacheparams);


if (!empty($list))
{
	$grouped                    = false;
	$article_grouping           = $params->get('article_grouping', 'none');
	$article_grouping_direction = $params->get('article_grouping_direction', 'ksort');
	$moduleclass_sfx            = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');
	$item_heading               = $params->get('item_heading');


	require JModuleHelper::getLayoutPath('mod_xiroweb_trending', $params->get('layout', 'default'));
}
