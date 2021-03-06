<?php
/**
 * LoginAudit
 *
 * Build Tables script
 *
 * @package loginaudit
 * @subpackage build
 */
$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$tstart = $mtime;
set_time_limit(0);

require_once dirname(__FILE__) . '/build.config.php';
include_once MODX_CORE_PATH . 'model/modx/modx.class.php';
$modx= new modX();
$modx->initialize('mgr');
$fmz = $modx->getService('loginaudit', 'loginaudit', $modx->getOption('loginaudit.core_path', null, $modx->getOption('core_path') . 'components/loginaudit/') . 'model/loginaudit/');
if (!($fmz instanceof LoginAudit)) return '';

echo '<pre>'; /* used for nice formatting of log messages */

$manager= $modx->getManager();

/* Model Classes names */
$objects = array(
	'auditLog'
);

$mtime= microtime();
$mtime= explode(" ", $mtime);
$mtime= $mtime[1] + $mtime[0];
$tend= $mtime;
$totalTime= ($tend - $tstart);
$totalTime= sprintf("%2.4f s", $totalTime);

foreach($objects as $object) {
	$$object = $manager->createObjectContainer($object);
	echo $$object ? "\n{$object} table created\n" : "\n{$object} table not created\n";
}

echo "\nExecution time: {$totalTime}\n";

exit ();
