<?php
/**
 * Handles plugin events for Login Audit
 *
 * @package loginaudit
 */
$corePath = $modx->getOption('loginaudit.core_path', null, $modx->getOption('core_path') . 'components/loginaudit/');
$modx->lexicon->load('loginaudit:tv');

switch ($modx->event->name) {
    case 'OnManagerLogin':
        return true;
        break;
    case 'OnManagerLogout':
	    return true;
        break;
}
return;
