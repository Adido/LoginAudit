<?php
class LoginAuditGetListProcessor extends modObjectGetListProcessor {
    /* Class in model directory */
    public $classKey = 'auditLog';

    /* Language package to load */
    public $languageTopics = array('loginaudit:default');

    /* Field t sort by and direction */
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';

    /* Used to load the correct language error message */
    public $objectType = 'loginaudit.audit';

    /* Search database from backend module */
    public function prepareQueryBeforeCount(xPDOQuery $c) {
	    $c->select('auditLog.*, User.username');
	    $c->innerJoin('modUser','User','User.id = auditLog.user');
    	return $c;
    }

    public function afterIteration(array $list) {
	    return $list;
    }
}

return 'LoginAuditGetListProcessor';
