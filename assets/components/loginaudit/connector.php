<?php
/**
 * LoginAudit
 *
 * LoginAudit Connector
 *
 * @package LoginAudit
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$corePath = $modx->getOption('loginaudit.core_path', null, $modx->getOption('core_path') . 'components/loginaudit/');
require_once $corePath . 'model/loginaudit/loginaudit.class.php';
$modx->loginaudit = new LoginAudit($modx);

$modx->lexicon->load('loginaudit:default');

/* handle request */
if(isset($_GET["export"]) && $_GET["export"]) {
	$data = $modx->loginaudit->getActions();
	$rows = array();
	foreach($data as $user) {
		$row = array(
			$modx->lexicon('id') => $user->get('id'),
			$modx->lexicon('name') => $user->get('username'),
			$modx->lexicon('loginaudit.form.action') => $user->get('action'),
			$modx->lexicon('loginaudit.form.actionDate') => $user->get('actionDate'),
		);
		$rows[] = $row;
	}
	ob_start();
	header("Content-type: text/csv");
	header("Content-Disposition: attachment; filename=LoginAudit.csv");
	header("Pragma: no-cache");
	header("Expires: 0");
	$fp = fopen('php://output', 'w'); // this file actual writes to php output
	$i=0;
	foreach($rows as $row) {
		if($i == 0) fputcsv($fp, array_keys($row));
		$i++;
		fputcsv($fp, $row);
	}
	fclose($fp);
	$args = ob_get_clean();
	echo $args;
} else {
	$path = $modx->getOption('processorsPath', $modx->loginaudit->config, $corePath . 'processors/');
	$modx->request->handleRequest(array(
	    'processors_path' => $path,
	    'location' => '',
	));
}