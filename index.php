<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Output as HTML5
$doc->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
$doc->addScriptVersion($this->baseurl . '/templates/' . $this->template . '/js/bootstrap.js');

// Add Stylesheets
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/bootstrap.css');
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/font-awesome/css/font-awesome.css');
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/style.css');

// Use of Google Font
if ($this->params->get('googleFont'))
{
	$doc->addStyleSheet('//fonts.googleapis.com/css?family=' . $this->params->get('googleFontName'));
	$doc->addStyleDeclaration("
	h1, h2, h3, h4, h5, h6, .site-title {
		font-family: '" . str_replace('+', ' ', $this->params->get('googleFontName')) . "', sans-serif;
	}");
}

// Template color
if ($this->params->get('templateColor'))
{
	$doc->addStyleDeclaration("
	body.site {
		border-top: 3px solid " . $this->params->get('templateColor') . ";
		background-color: " . $this->params->get('templateBackgroundColor') . ";
	}
	a {
		color: " . $this->params->get('templateColor') . ";
	}
	.nav-list > .active > a,
	.nav-list > .active > a:hover,
	.dropdown-menu li > a:hover,
	.dropdown-menu .active > a,
	.dropdown-menu .active > a:hover,
	.nav-pills > .active > a,
	.nav-pills > .active > a:hover,
	.btn-primary {
		background: " . $this->params->get('templateColor') . ";
	}");
}

// Check for a custom CSS file
$userCss = JPATH_SITE . '/templates/' . $this->template . '/css/user.css';

if (file_exists($userCss) && filesize($userCss) > 0)
{
	$this->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/user.css');
}

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = 'span6';
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = 'span9';
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = 'span9';
}
else
{
	$span = 'span12';
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<jdoc:include type="head" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>

<section class="header">
<div class="navbar navbar-default navbar-fixed-top">
	 <div class="container">
		 <div class="navbar-header">
			 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				 <span class="icon-bar"></span>
				 <span class="icon-bar"></span>
				 <span class="icon-bar"></span>
			 </button>
			 		<a class="navbar-brand" href=""><i class="fa fa-television fa-2x" aria-hidden="true"></i> <span class="logo"> IT & StartUP`s</span> </a>
		 </div>
		 <div class="navbar-collapse collapse">
			 <ul class="nav navbar-nav navbar-right">
				 <li class="active"><a href="">Home</a></li>
				 <li><a href="#">Про нас</a></li>
				 <li><a href="#">News</a></li>
				 <li><a href="#">Работы</a></li>
				 <li><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
			 </ul>
		 </div>
	 </div>
 </div>
</section>

<div class="container">
	<div class="row">
		<div class="col-md-6 maxpicsize"> <jdoc:include type="component" name="col-left" style="none"/>
			<jdoc:include type="modules" name="col-left" style="xhmtl"/>
		</div>

		<div class="col-md-6 maxpicsize">
			<jdoc:include type="modules" name="col-right" style="xhmtl"/>
		</div>
	</div>
</div>

</body>
</html>
