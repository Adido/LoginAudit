<?php
/**
 * LoginAudit
 *
 * Resolve creating db tables
 *
 * @package loginaudit
 * @subpackage build
 */
if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
            $modx =& $object->xpdo;
            $modelPath = $modx->getOption('loginaudit.core_path',null,$modx->getOption('core_path').'components/loginaudit/').'model/';
            $modx->addPackage('loginaudit',$modelPath);

            $manager = $modx->getManager();

            /* Model Classes names */
            $objects = array(
                'auditLog'
            );

            foreach($objects as $object) {
                $manager->createObjectContainer($object);
            }

            break;
        case xPDOTransport::ACTION_UPGRADE:
            break;
    }
}
return true;
