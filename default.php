<?php

/**
 * ProcessWire 2.x Admin Markup Template
 *
 * Copyright 2010 by Ryan Cramer
 *
 *
 */

$searchForm = $user->hasPermission('page-edit') ? $modules->get('ProcessPageSearch')->renderSearchForm() : '';
$bodyClass = $input->get->modal ? 'modal' : '';
if(!isset($content)) $content = '';

$config->styles->prepend($config->urls->adminTemplates . "styles/main.css"); 
$config->scripts->append($config->urls->adminTemplates . "scripts/main.js"); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex, nofollow" />

	<title><?php echo strip_tags($page->get("browser_title|headline|title|name")); ?> &bull; ProcessWire</title>

	<script type="text/javascript">
		<?php

		$jsConfig = $config->js();
		$jsConfig['debug'] = $config->debug;
		$jsConfig['urls'] = array(
			'root' => $config->urls->root, 
			'admin' => $config->urls->admin, 
			'modules' => $config->urls->modules, 
			'core' => $config->urls->core, 
			'files' => $config->urls->files, 
			'templates' => $config->urls->templates,
			'adminTemplates' => $config->urls->adminTemplates,
			); 
		?>

		var config = <?php echo json_encode($jsConfig); ?>;
	</script>

	<?php foreach($config->styles->unique() as $file) echo "\n\t<link type='text/css' href='$file' rel='stylesheet' />"; ?>


	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="<?php echo $config->urls->adminTemplates; ?>styles/ie.css" />
	<![endif]-->	

	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo $config->urls->adminTemplates; ?>styles/ie7.css" />
	<![endif]-->

	<?php foreach($config->scripts->unique() as $file) echo "\n\t<script type='text/javascript' src='$file'></script>"; ?>

</head>
<body<?php if($bodyClass) echo " class='$bodyClass'"; ?>>
  <div class="topbar">
      <div class="topbar-inner">
        <div class="container-fluid">
          <a class="brand" href="<?=$config->urls->admin?>">Processwire</a>
          <ul class="nav">
          	<?php include($config->paths->templatesAdmin . "topnav.inc"); ?>
          </ul>
         	<?php echo $searchForm; ?>
          <ul class="nav secondary-nav">
            <?php if($user->hasPermission('profile-edit')): ?> 
              <li><a class='action' href='<?php echo $config->urls->admin; ?>profile/'><?=$user->name?></a></li>
            <?php endif; ?>

            <li><a class='action' href='<?php echo $config->urls->admin; ?>login/logout/'>Logout</a></li>
          </ul>
        </div>
      </div>
    </div>  

  <div class="container-fluid">  
	<div style="padding-top:60px;"> 
		<div class="container2">
        <h1 id='title'><?php echo strip_tags($this->fuel->processHeadline ? $this->fuel->processHeadline : $page->get("title|name")); ?></h1>

        <?php if(!$user->isGuest()): ?>
			<ul id='breadcrumb' class='breadcrumb'>
				<?php
				foreach($this->fuel('breadcrumbs') as $breadcrumb) {
					$title = htmlspecialchars(strip_tags($breadcrumb->title)); 
					echo "\n\t\t\t<li><a href='{$breadcrumb->url}'>{$title}</a><span class='divider'>/</span></li>";
				}
				?>
			</ul>
			<?php endif; ?>	
		</div>
	</div>

	<?php if(count($notices)) include($config->paths->adminTemplates . "notices.inc"); ?>

	<div id="content">

			<?php if(trim($page->summary)) echo "<h2>{$page->summary}</h2>"; ?>
			<?php if($page->body) echo $page->body; ?>


			<?php echo $content?>

	</div>
  
</div>

</body>
</html>
