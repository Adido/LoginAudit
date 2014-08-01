<?php
/**
 * LoginAudit
 */
require_once dirname(__FILE__) . '/model/loginaudit/loginaudit.class.php';
/**
 * @package loginaudit
 */
class IndexManagerController extends modExtraManagerController {
    public static function getDefaultController() { return 'workspace'; }
}

abstract class LoginAuditBaseManagerController extends modManagerController {
    /** @var LoginAudit $loginaudit */
    public $loginaudit;

    public function initialize() {
        $this->loginaudit = new LoginAudit($this->modx);

        $this->addCss($this->loginaudit->config['cssUrl'] . 'mgr.css');
        $this->addJavascript($this->loginaudit->config['jsUrl'] . 'mgr/loginaudit.js');
        $this->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            loginaudit.config = ' . $this->modx->toJSON($this->loginaudit->config) . ';
            loginaudit.config.connector_url = "' . $this->loginaudit->config['connectorUrl'] . '";
        });
        </script>');

        return parent::initialize();
    }

    public function getLanguageTopics() {
        return array('loginaudit:default');
    }

    public function checkPermissions() { return true; }
}
