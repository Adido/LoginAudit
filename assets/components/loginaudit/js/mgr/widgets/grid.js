LoginAudit.grid.Forms = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'loginaudit-grid-forms'
        ,url: LoginAudit.config.connector_url
        ,baseParams: {
            action: 'getlist'
        }
        ,fields: ['id','username','action','actionDate']
        ,paging: true
        ,remoteSort: true
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 4
        }, {
            header: _('name')
            ,dataIndex: 'username'
        }, {
            header: _('loginaudit.form.action')
            ,dataIndex: 'action'
        }, {
            header: _('loginaudit.form.actionDate')
            ,dataIndex: 'actionDate'
        }]
	    ,buttons: [{
		    text: 'Export as CSV',
		    handler: function() {
			    window.location = LoginAudit.config.connector_url+'?export=1';
		    }
	    }]
    });
    LoginAudit.grid.Forms.superclass.constructor.call(this, config);
};
Ext.extend(LoginAudit.grid.Forms, MODx.grid.Grid);
Ext.reg('loginaudit-grid-forms', LoginAudit.grid.Forms);
