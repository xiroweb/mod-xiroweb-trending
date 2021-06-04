<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_xiroweb_trending
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

$image_position = $params->get('imgageposition', '1');

HTMLHelper::_('stylesheet', 'mod_xiroweb_trending/bootstrap5-grid.css', array('version' => 'auto', 'relative' => true));
HTMLHelper::_('stylesheet', 'mod_xiroweb_trending/style1.css', array('version' => 'auto', 'relative' => true));

?>

<div class="module<?php echo $moduleclass_sfx; ?> mod-trending-style1">
	<?php foreach ($list as  $key => $item) : ?>
				<?php $images = json_decode($item->images);

				switch ($image_position) {
					case '1':
						require JModuleHelper::getLayoutPath('mod_xiroweb_trending', 'items_imgleft'); 
						break;
					case '2':
						require JModuleHelper::getLayoutPath('mod_xiroweb_trending', 'items_imgright'); 
						break;
					case '0':
						require JModuleHelper::getLayoutPath('mod_xiroweb_trending', 'items_noneimage'); 
						break;	
					default:
						break;
				} ?>
		<?php endforeach; ?>
</div>
