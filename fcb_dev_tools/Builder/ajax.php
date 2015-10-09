<?php
include('utils.php');
header('Content-Type: application/json');

$action = $_GET['a'];

if ($action == 'templates') {
	$templates = getTemplates();

	print json_encode($templates);
} else if ($action == 'download') {
	$data = $_GET['d'];
	$data = json_decode($data);

	$template = getTemplates($data->name);

	$zip = new ZipArchive();
	$file = time() . '-' . (rand() % 1000) . '_EmailTemplate.zip';

	if ($zip->open($file, ZipArchive::CREATE) !== TRUE) {
		print 'Cant generate Zip Archive';
		die;
	}
	$templatehtml = $template->base->html;
	$mods = '';
	foreach ($data->modules as $mod) {
		foreach ($template->modules as $group) {
			foreach ($group->modules as $tmod) {
				if ($tmod->name == $mod) {
					$mods .= $tmod->html;
				}
			}
		}
	}
	$mods = str_replace('<!--[IMG_LOCATION]-->', 'img', $mods);
	$templatehtml = str_replace('<!--[MODULE_LOCATION]-->', $mods, $templatehtml);

	addDir($template->baseLocation . '/img', './templates/' . $template->name, $zip);
	$zip->addFromString('index.html', $templatehtml);
	$zip->close();

	header("Content-Type: application/zip");
	header("Content-Transfer-Encoding: Binary");
	header("Content-disposition: attachment; filename=\"" . $file . "\""); 
	echo readfile($file);
	unlink($file);
}