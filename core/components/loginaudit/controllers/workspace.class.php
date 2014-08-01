<?php
/**
 * LoginAudit
 *
 * Loads the Manager view.
 *
 * @package loginaudit
 * @subpackage controllers
 */
class LoginAuditWorkspaceManagerController extends LoginAuditBaseManagerController {
    public function process(array $scriptProperties = array()) {

    }

    public function getPageTitle() { return $this->modx->lexicon('loginaudit'); }

    public function loadCustomCssJs() {
        $this->addJavascript($this->loginaudit->config['jsUrl'] . 'mgr/widgets/grid.js');
        $this->addJavascript($this->loginaudit->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addLastJavascript($this->loginaudit->config['jsUrl'] . 'mgr/workspace/index.js');
    }

    public function getTemplateFile() { return $this->loginaudit->config['templatesPath'] . 'workspace.tpl'; }
}
