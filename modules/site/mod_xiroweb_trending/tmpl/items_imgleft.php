<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_xiroweb_trending
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$tileanh = $params->get('tileanh', '33');

switch ($tileanh) {
	case '33':
		$col_img = 'bs5col-4';
		$col_title = 'bs5col-8';
		break;
	case '40':
		$col_img = 'bs5col-5';
		$col_title = 'bs5col-7';
		break;
	case '25':
		$col_img = 'bs5col-3';
		$col_title = 'bs5col-9';
		break;
	case '20':
		$col_img = 'bs5col-2';
		$col_title = 'bs5col-10';
		break;
	
	default:
		# code...
		break;
}
?>
	<div class="itembox">
		<div class="bs5row g-3 mb-3 align-items-start align-content-between">
			<div class="<?php echo $col_img; ?> imageboxleft">
				<?php if (!empty($images->image_intro)): ?>
					<a class="box-item-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
						<img width="100%" src="<?php echo htmlspecialchars($images->image_intro, ENT_COMPAT, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt, ENT_COMPAT, 'UTF-8'); ?>" />
					</a>
				<?php endif;// if ($images->image_intro != ''): ?>
			</div>
			<div class="<?php echo $col_title; ?> titlebox">
					<<?php echo $params->get('title_heading', 'h1'); ?>>
						<a class="box-item-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
					</<?php echo $params->get('title_heading', 'h1'); ?>>
					<div>
				<?php if ($item->displayHits) : ?>
					<span class="box-item-hits">
					<?php echo JText::_('MOD_XIROWEB_TRENDING_LUOTXEM'); ?><?php echo $item->displayHits; ?>
					</span>
				<?php endif; ?>

				<?php if ($params->get('show_author')) : ?>
					<span class="box-item-writtenby">
					<?php echo JText::_('MOD_XIROWEB_TRENDING_AUTHORNAME'); ?><?php echo $item->displayAuthorName; ?>
					</span>
				<?php endif; ?>

				<?php if ($item->displayCategoryTitle) : ?>
					<span class="box-item-category">
					<?php echo JText::_('MOD_XIROWEB_TRENDING_CATEGORYTITLE'); ?><?php echo $item->displayCategoryTitle; ?>
					</span>
				<?php endif; ?>

				<?php if ($item->displayDate) : ?>
					<span class="box-item-date">
						<?php echo $item->displayDate; ?>
					</span>
				<?php endif; ?>

				<?php if ($params->get('show_tags', 0) && $item->tags->itemTags) : ?>
					<div class="box-item-tags">
					<?php echo JText::_('MOD_XIROWEB_TRENDING_TAG'); ?><?php echo JLayoutHelper::render('joomla.content.tags', $item->tags->itemTags); ?>
					</div>
				<?php endif; ?>
				</div>

				<?php if ($params->get('show_introtext')) : ?>
					<p class="box-item-introtext">
						<?php echo $item->displayIntrotext; ?>
					</p>
				<?php endif; ?>

				<?php if ($params->get('show_readmore')) : ?>
					<p class="box-item-readmore">
						<a class="box-item-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
							<?php if ($item->params->get('access-view') == false) : ?>
								<?php echo JText::_('MOD_XIROWEB_TRENDING_REGISTER_TO_READ_MORE'); ?>
							<?php elseif ($readmore = $item->alternative_readmore) : ?>
								<?php echo $readmore; ?>
								<?php echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
							<?php elseif ($params->get('show_readmore_title', 0) == 0) : ?>
								<?php echo JText::sprintf('MOD_XIROWEB_TRENDING_READ_MORE_TITLE'); ?>
							<?php else : ?>
								<?php echo JText::_('MOD_XIROWEB_TRENDING_READ_MORE_TITLE'); ?>
								<?php echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
							<?php endif; ?>
						</a>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>