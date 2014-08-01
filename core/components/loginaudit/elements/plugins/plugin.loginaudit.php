<?php
/**
 * Handles plugin events for Login Audit
 *
 * @package loginaudit
 */
$corePath = $modx->getOption('loginaudit.core_path', null, $modx->getOption('core_path') . 'components/loginaudit/');
require_once $corePath . '/model/loginaudit/loginaudit.class.php';
$loginaudit = new LoginAudit($modx);

switch ($modx->event->name) {
    case 'OnManagerLogin':
        return $loginaudit->logAction($user);
        break;
    case 'OnBeforeManagerLogout':
		return $loginaudit->logAction($user,'logout');
        break;
}
return;
