<?php
/**
 * @package    Xiroweb Multi Editor with many column
 *
 * @author     Xiroweb <support@xiroweb.com>
 * @copyright  Copyright (c)2021 Xiroweb All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://www.xiroweb.com
 */

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

class mod_xiroweb_trendingInstallerScript
{
	public function preflight($type, $parent)
	{
		$app = JFactory::getApplication();

		// check Joomla version compatibility
		$jversion = new JVersion();
		if (!$jversion->isCompatible('3.2.0'))
		{
			$app->enqueueMessage('Please upgrade to at least Joomla! 3.2.0 before continuing!', 'error');

			return false;
		}
	}

	public function postflight($type, $parent)
	{
		if ($type == 'uninstall')
		{
			return true;
		}

		?>
		<style>
						
			@media (min-width : 768px) and (max-width : 1120px) {
				.row-fluid [class*="span"] {
					margin-left : 10px;
				}
			}

			@media (max-width : 767px) {
				#system-message-container.j-toggle-main, #j-main-container.j-toggle-main, #system-debug.j-toggle-main {
					float : none;
				}
			}

			/* End isis backend template fix */
			#j-main-container > .span12 > strong {
				font-weight : normal;
			}

			.template-intro {
				margin-bottom : 30px;
			}

			.template-intro *,
			.template-intro *::before,
			.template-intro *::after {
				box-sizing : border-box;
			}

			.template-intro-container {
				margin    : 0 auto;
				max-width : 85%;
			}

			.template-intro-container .btn {
				font-size     : 90%;
				font-weight   : bold;
				margin-bottom : 10px;
			}

			.intro-header {
				text-align : center;
				padding    : 60px 60px;
				background-color: #85FFBD;
				background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);

			}

			.intro-header-title {
				font-weight   : normal;
				color         : #000000;
			}

			.intro-header-title small {
				color : rgba(255, 255, 255, 0.5);
			}

			.intro-header-screens {
				position : relative;
				bottom   : -8px;
			}

			.intro-footer, .intro-content-highlights, .intro-content-features {
				padding : 60px 20px;
			}

			.intro-content-highlights {
				background-color : #f5f5f5;
			}

			.intro-quote {
				max-width  : 70%;
				text-align : center;
				font-style : italic;
				opacity    : 0.75;
				margin     : 0 auto 50px auto;
			}

			.intro-section-title {
				font-weight    : normal;
				text-align     : center;
				padding-bottom : 20px;
				margin-bottom  : 40px;
				border-bottom  : 1px solid rgba(0, 0, 0, 0.15);
				font-size      : 40px;
				line-height    : 1;
			}

			.thumbnails .row-fluid .span4 {
				margin-bottom : 40px;
			}

			.thumbnails .row-fluid .span12 {
				margin-bottom : 40px;
				width         : 97%;
			}

			.thumbnail {
				padding          : 30px;
				border           : 1px solid rgba(0, 0, 0, 0.15);
				background-color : rgba(255, 255, 255, 0.35);
				box-shadow       : none;
			}

			.thumbnail h4 {
				line-height : 1.3;
				font-size   : 18px;
				margin      : 25px 0 0 0;
				text-align  : center;
			}

			.intro-feature .btn,
			.thumbnail .btn {
				margin-top : 20px;
			}

			.intro-feature h4 {
				margin-bottom : 25px;
			}

			.intro-feature + .intro-feature {
				margin-top : 40px;
			}

			.intro-footer {
				text-align : center;
				background : #202935;
				color      : #ffffff;
			}

			.version-history {
				margin          : 0 auto 2rem auto;
				padding         : 0;
				list-style-type : none;
				color           : #ffffff;
			}

			.version-history > li {
				margin      : 0 0 0.5em 0;
				padding     : 0 0 0 4em;
				font-weight : normal;
			}

			.version-new,
			.version-fixed,
			.version-upgraded {
				float                 : left;
				font-size             : 0.8em;
				margin-left           : -4.9em;
				width                 : 4.5em;
				color                 : white;
				text-align            : center;
				font-weight           : bold;
				text-transform        : uppercase;
				-webkit-border-radius : 4px;
				-moz-border-radius    : 4px;
				border-radius         : 4px;
			}

			.version-new {
				background : #7dc35b;
			}

			.version-fixed {
				background : #e9a130;
			}

			.version-upgraded {
				background : #61b3de;
			}

			.install-ok {
				background : #7dc35b;
				color      : #ffffff;
				padding    : 3px;
			}

			.install-not-ok {
				background : #E9452F;
				color      : #ffffff;
				padding    : 3px;
			}

			#installer-left {
				border : 1px solid #e0e0e0;
				float  : left;
				margin : 10px;
			}

			#installer-right {
				float : left;
			}

			.tpl-button {
				display               : inline-block;
				background            : #459300;
				border                : 1px solid #459300 !important;
				padding               : 2px;
				color                 : #fff !important;
				cursor                : pointer;
				margin                : 0;
				-webkit-border-radius : 5px;
				-moz-border-radius    : 5px;
				border-radius         : 5px;
				text-decoration       : none !important;
			}

			.tpl-button:hover {
				text-decoration : underline !important;
			}

			.big-warning {
				background : #FAF0DB;
				border     : solid 1px #EBC46F;
				padding    : 5px;
			}

			.big-warning b {
				color : red;
			}

		</style>


<div class="template-intro">
			<div class="intro-header">
				<div class="template-intro-container">
					<div class="row-fluid">
					<div class="span12">
						<h1 class="intro-header-title">
							<?php echo Text::_('MOD_XIROWEB_TRENDING'); ?>
						</h1>
						</div>
					</div>
					
				</div>
			</div>
			<div class="intro-content">
				<section class="intro-content-highlights">
					<div class="template-intro-container">
						<div class="row-fluid">
							<div class="intro-quote lead">
								<?php echo Text::_('MOD_XIROWEB_TRENDING_INSTALL_DESC'); ?>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span12">
								<h3 class="intro-section-title"><strong>XiroWeb</strong> </h3>
							</div>
						</div>
					</div>
				</section>
			</div>
			<div class="intro-footer">
				<h3 class="text-center"><?php echo Text::_('MOD_XIROWEB_TRENDING_INSTALL_DESC2'); ?></h3>
				<ul class="version-history">
					<li class="text-center"><?php echo Text::_('MOD_XIROWEB_TRENDING_INSTALL_DESC3'); ?></li>
				</ul>
				<div class="template-intro-container">
					<a class="btn btn-success btn-large" target="_blank" href="https://www.xiroweb.com/app/xiroweb-module-tin-trending"><?php echo Text::_('MOD_XIROWEB_TRENDING'); ?></a>
				</div>
			</div>
		</div>
		<?php
	}
}
