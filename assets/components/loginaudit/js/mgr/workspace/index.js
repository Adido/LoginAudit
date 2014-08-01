Ext.onReady(function() {
    MODx.load({ xtype: 'loginaudit-page-workspace'});
});

/**
 * Loads the LoginAudit environment
 *
 * @class loginaudit.page.Workspace
 * @extends MODx.Component
 * @params {Object} config An object of config properties
 * @xtype loginaudit-page-workspace
 */
LoginAudit.page.Workspace = function(config) {
    config = config || {};
    Ext.applyIf(config, {
    	formpanel: 'loginaudit-panel-home'
        ,components: [{
            xtype: 'loginaudit-panel-home'
            ,id: 'loginaudit-panel-home'
            ,renderTo: 'loginaudit-panel-workspace-div'
        }]
    });
    LoginAudit.page.Workspace.superclass.constructor.call(this, config);
};
Ext.extend(LoginAudit.page.Workspace, MODx.Component);
Ext.reg('loginaudit-page-workspace', LoginAudit.page.Workspace);
