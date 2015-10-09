<?php

function getTemplates($name = '') {
	$templates = array();

	$path = './templates';

	foreach (new DirectoryIterator($path) as $file) {
		if ($file->isDot() || !$file->isDir())
			continue;

		$template = new stdClass();
		$template->name = $file->getFilename();
		$template->baseLocation = $path . '/' . $file->getFilename();
		$template->imgLocation = $path . '/' . $file->getFilename() . '/img';

		$base = new stdClass();
		$base->location = $path . '/' . $file->getFilename() . '/index.html';
		$base->html = file_get_contents($base->location);
		if (file_exists(str_replace('.html', '.json', $base->location))) {
			$base->settings = array();
		}

		$template->base = $base;

		$modulePath = $path . '/' . $file->getFilename() . '/modules/';
		$modules = findModules($modulePath, '');

		$template->modules = $modules;
		if ($name !== '' && $template->name == $name)
			return $template;

		$templates[] = $template;
	}

	return $templates;
}

function findModules($modulesPath, $folder) {
	$groups = array();

	$modules = array();
	$group = new stdClass();
	$group->name = $folder;
	$newPath = $modulesPath . $folder;
	foreach (new DirectoryIterator($newPath) as $module) {
		if ($module->isDot())
			continue;
		if ($module->isDir()) {
			$found = findModules($newPath, $module->getFilename());
			$groups = array_merge($groups, $found);
		}

		if (strpos($module->getFilename(), '.html') !== FALSE) {
			$mod = new stdClass();
			$mod->name = str_replace('.html', '', $module->getFilename());
			$mod->filename = $module->getFilename();
			$mod->html = file_get_contents($newPath . '/' . $mod->filename);
			if (file_exists($newPath . '/' . str_replace('.html', '.json', $mod->filename))) {
				$mod->settings = array();
			}

			$modules[] = $mod;
		}
	}
	$group->modules = $modules;
	$groups[] = $group;

	return $groups;
}

function addDir($path, $remove, $zip) {
	$localpath = str_replace($remove, '', $path);

    $zip->addEmptyDir($localpath); 
    $nodes = glob($path . '/*'); 
    foreach ($nodes as $node) { 
        $localpath = str_replace($remove, '', $node);

        if (is_dir($node)) { 
            addDir($node); 
        } else if (is_file($node))  { 
            $zip->addFile($node, $localpath); 
        } 
    } 
}