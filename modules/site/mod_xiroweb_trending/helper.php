<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_xiroweb_trending
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\String\StringHelper;

$com_path = JPATH_SITE . '/components/com_content/';

JLoader::register('ContentHelperRoute', $com_path . 'helpers/route.php');
JModelLegacy::addIncludePath($com_path . 'models', 'ContentModel');

/**
 * Helper for mod_xiroweb_trending
 *
 * @since  1.6
 */
abstract class ModXirowebTintrendingHelper
{
	/**
	 * Get a list of articles from a specific category
	 *
	 * @param   \Joomla\Registry\Registry  &$params  object holding the models parameters
	 *
	 * @return  mixed
	 *
	 * @since  1.6
	 */
	public static function getList(&$params)
	{
		// Get an instance of the generic articles model
		$articles = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

		// Set application parameters in model
		$app       = JFactory::getApplication();
		$appParams = $app->getParams();
		$articles->setState('params', $appParams);

		$articles->setState('list.start', (int) $params->get('num_intro_skip', 0));
		$articles->setState('filter.published', 1);

		// Set the filters based on the module params
		
		$articles->setState('list.limit', (int) $params->get('count', 0));
		$articles->setState('load_tags', $params->get('show_tags', 0) || $params->get('article_grouping', 'none') === 'tags');

		// Access filter
		$access     = !JComponentHelper::getParams('com_content')->get('show_noauth');
		$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
		$articles->setState('filter.access', $access);

		//////////////////////////////////////////
		$mode = $params->get('switchmode', 'options');
		if ( $mode == 'ids' ) {
			$included_articles = $params->get('included_articles', '');
			if ($included_articles)
			{
				$included_articles = explode("\r\n", $included_articles);
				$articles->setState('filter.article_id', $included_articles);
	
				// InClude
				$articles->setState('filter.article_id.include', true);
			}
		} //if ( $mode == 'ids' )

		if ( $mode == 'options' ) {
			$catids = $params->get('catid');
				$articles->setState('filter.category_id.include', (bool) $params->get('category_filtering_type', 1));

						// Category filter
				if ($catids)
				{
					if ($params->get('show_child_category_articles', 0) && (int) $params->get('levels', 0) > 0)
					{
						// Get an instance of the generic categories model
						$categories = JModelLegacy::getInstance('Categories', 'ContentModel', array('ignore_request' => true));
						$categories->setState('params', $appParams);
						$levels = $params->get('levels', 1) ?: 9999;
						$categories->setState('filter.get_children', $levels);
						$categories->setState('filter.published', 1);
						$categories->setState('filter.access', $access);
						$additional_catids = array();

						foreach ($catids as $catid)
						{
							$categories->setState('filter.parentId', $catid);
							$recursive = true;
							$items     = $categories->getItems($recursive);

							if ($items)
							{
								foreach ($items as $category)
								{
									$condition = (($category->level - $categories->getParent()->level) <= $levels);

									if ($condition)
									{
										$additional_catids[] = $category->id;
									}
								}
							}
						}

						$catids = array_unique(array_merge($catids, $additional_catids));
					}

					$articles->setState('filter.category_id', $catids);
				}
				
				// Ordering
				$ordering = $params->get('article_ordering', 'a.ordering');

				switch ($ordering)
				{
					case 'random':
						$articles->setState('list.ordering', JFactory::getDbo()->getQuery(true)->Rand());
						break;

					case 'rating_count':
					case 'rating':
						$articles->setState('list.ordering', $ordering);
						$articles->setState('list.direction', $params->get('article_ordering_direction', 'ASC'));

						if (!JPluginHelper::isEnabled('content', 'vote'))
						{
							$articles->setState('list.ordering', 'a.ordering');
						}

						break;

					default:
						$articles->setState('list.ordering', $ordering);
						$articles->setState('list.direction', $params->get('article_ordering_direction', 'ASC'));
						break;
				}

				// Filter by multiple tags
				$articles->setState('filter.tag', $params->get('filter_tag', array()));

				$articles->setState('filter.featured', $params->get('show_front', 'show'));
				$articles->setState('filter.author_id', $params->get('created_by', array()));
				$articles->setState('filter.author_id.include', $params->get('author_filtering_type', 1));
				$articles->setState('filter.author_alias', $params->get('created_by_alias', array()));
				$articles->setState('filter.author_alias.include', $params->get('author_alias_filtering_type', 1));
				$excluded_articles = $params->get('excluded_articles', '');

				if ($excluded_articles)
				{
					$excluded_articles = explode("\r\n", $excluded_articles);
					$articles->setState('filter.article_id', $excluded_articles);

					// Exclude
					$articles->setState('filter.article_id.include', false);
				}

				$date_filtering = $params->get('date_filtering', 'off');

				if ($date_filtering !== 'off')
				{
					$articles->setState('filter.date_filtering', $date_filtering);
					$articles->setState('filter.date_field', $params->get('date_field', 'a.created'));
					$articles->setState('filter.start_date_range', $params->get('start_date_range', '1000-01-01 00:00:00'));
					$articles->setState('filter.end_date_range', $params->get('end_date_range', '9999-12-31 23:59:59'));
					$articles->setState('filter.relative_date', $params->get('relative_date', 30));
				}

				// Filter by language
				$articles->setState('filter.language', $app->getLanguageFilter());
		} // if ( $mode == 'options' ) 
		

		$items = $articles->getItems();

		// Display options
		$show_date        = $params->get('show_date', 0);
		$show_date_field  = $params->get('show_date_field', 'created');
		$show_date_format = $params->get('show_date_format', 'Y-m-d H:i:s');
		$show_category    = $params->get('show_category', 0);
		$show_hits        = $params->get('show_hits', 0);
		$show_author      = $params->get('show_author', 0);
		$show_introtext   = $params->get('show_introtext', 0);
		$introtext_limit  = $params->get('introtext_limit', 100);

		// Find current Article ID if on an article page
		$option = $app->input->get('option');
		$view   = $app->input->get('view');

		if ($option === 'com_content' && $view === 'article')
		{
			$active_article_id = $app->input->getInt('id');
		}
		else
		{
			$active_article_id = 0;
		}

		// Prepare data for display using display options
		foreach ($items as &$item)
		{
			$item->slug    = $item->id . ':' . $item->alias;

			/** @deprecated Catslug is deprecated, use catid instead. 4.0 */
			$item->catslug = $item->catid . ':' . $item->category_alias;

			if ($access || in_array($item->access, $authorised))
			{
				// We know that user has the privilege to view the article
				$item->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language));
			}
			else
			{
				$menu      = $app->getMenu();
				$menuitems = $menu->getItems('link', 'index.php?option=com_users&view=login');

				if (isset($menuitems[0]))
				{
					$Itemid = $menuitems[0]->id;
				}
				elseif ($app->input->getInt('Itemid') > 0)
				{
					// Use Itemid from requesting page only if there is no existing menu
					$Itemid = $app->input->getInt('Itemid');
				}

				$item->link = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $Itemid);
			}

			// Used for styling the active article
			$item->active      = $item->id == $active_article_id ? 'active' : '';
			$item->displayDate = '';

			if ($show_date)
			{
				$item->displayDate = JHtml::_('date', $item->$show_date_field, $show_date_format);
			}

			if ($item->catid)
			{
				$item->displayCategoryLink  = JRoute::_(ContentHelperRoute::getCategoryRoute($item->catid));
				$item->displayCategoryTitle = $show_category ? '<a href="' . $item->displayCategoryLink . '">' . $item->category_title . '</a>' : '';
			}
			else
			{
				$item->displayCategoryTitle = $show_category ? $item->category_title : '';
			}

			$item->displayHits       = $show_hits ? $item->hits : '';
			$item->displayAuthorName = $show_author ? $item->author : '';

			if ($show_introtext)
			{
				$item->introtext = JHtml::_('content.prepare', $item->introtext, '', 'mod_articles_category.content');
				$item->introtext = self::_cleanIntrotext($item->introtext);
			}

			$item->displayIntrotext = $show_introtext ? self::truncate($item->introtext, $introtext_limit) : '';
			$item->displayReadmore  = $item->alternative_readmore;
		}

		return $items;
	}

	/**
	 * Strips unnecessary tags from the introtext
	 *
	 * @param   string  $introtext  introtext to sanitize
	 *
	 * @return mixed|string
	 *
	 * @since  1.6
	 */
	public static function _cleanIntrotext($introtext)
	{
		$introtext = str_replace(array('<p>','</p>'), ' ', $introtext);
		$introtext = strip_tags($introtext, '<a><em><strong>');
		$introtext = trim($introtext);

		return $introtext;
	}

	/**
	 * Method to truncate introtext
	 *
	 * The goal is to get the proper length plain text string with as much of
	 * the html intact as possible with all tags properly closed.
	 *
	 * @param   string   $html       The content of the introtext to be truncated
	 * @param   integer  $maxLength  The maximum number of charactes to render
	 *
	 * @return  string  The truncated string
	 *
	 * @since   1.6
	 */
	public static function truncate($html, $maxLength = 0)
	{
		$baseLength = strlen($html);

		// First get the plain text string. This is the rendered text we want to end up with.
		$ptString = JHtml::_('string.truncate', $html, $maxLength, $noSplit = true, $allowHtml = false);

		for ($maxLength; $maxLength < $baseLength;)
		{
			// Now get the string if we allow html.
			$htmlString = JHtml::_('string.truncate', $html, $maxLength, $noSplit = true, $allowHtml = true);

			// Now get the plain text from the html string.
			$htmlStringToPtString = JHtml::_('string.truncate', $htmlString, $maxLength, $noSplit = true, $allowHtml = false);

			// If the new plain text string matches the original plain text string we are done.
			if ($ptString === $htmlStringToPtString)
			{
				return $htmlString;
			}

			// Get the number of html tag characters in the first $maxlength characters
			$diffLength = strlen($ptString) - strlen($htmlStringToPtString);

			// Set new $maxlength that adjusts for the html tags
			$maxLength += $diffLength;

			if ($baseLength <= $maxLength || $diffLength <= 0)
			{
				return $htmlString;
			}
		}

		return $html;
	}

}
