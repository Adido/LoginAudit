<?php
/**
 * LoginAudit
 *
 * Resolve changes to db model
 *
 * @package loginaudit
 * @subpackage build
 */
if ($object->xpdo) {
    $success = false;
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;

            if (!isset($modx->loginaudit) || $modx->loginaudit === null) {
                $modelPath = $modx->getOption(
                    'loginaudit.core_path',
                    null,
                    $modx->getOption('core_path') . 'components/loginaudit/'
                ) . 'model/';
                $modx->addPackage('loginaudit', $modelPath);
                $modx->loginaudit = $modx->getService('loginaudit', 'loginaudit', $modelPath);
            }

		    /** @var xPDOManager $manager */
		    $manager = $modx->getManager();

            $success = true;
            break;
    }
}
