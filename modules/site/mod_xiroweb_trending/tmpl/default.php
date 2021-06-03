<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_xiroweb_trending
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

	$stylecss					= $params->get('stylecss', 'none');

	JHtml::_('stylesheet', 'mod_xiroweb_trending/'.'bs4-grid.css', array('version' => 'auto', 'relative' => true));
	if	($stylecss != 'none') {
		JHtml::_('stylesheet', 'mod_xiroweb_trending/'.$stylecss.'.css', array('version' => 'auto', 'relative' => true));
	}
	
?>

<div class="module<?php echo $moduleclass_sfx; ?> mod-trending-<?php echo $stylecss; ?>">
	<?php foreach ($list as  $key => $item) : ?>
				<?php $images = json_decode($item->images);
				 ?>
				<?php require JModuleHelper::getLayoutPath('mod_xiroweb_trending', 'items_imgleft'); ?>
	
		<?php endforeach; ?>
</div>
