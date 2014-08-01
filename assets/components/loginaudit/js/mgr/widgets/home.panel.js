LoginAudit.panel.Home = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        cls: 'container'
        ,defaults: { collapsible: false, autoHeight: true }
        ,items: [{
            html: '<h2>'+_('loginaudit')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        },MODx.getPageStructure([{
            title: _('loginaudit.top')
            ,layout: 'form'
            ,defaults: { border: false ,msgTarget: 'side' }
            ,items: [{
                html: '<p>'+_('loginaudit.intro_msg')+'</p>'
                ,bodyCssClass: 'panel-desc'
                ,border: false
            }, {
                xtype: 'loginaudit-grid-forms'
                ,cls:'main-wrapper'
                ,preventRender: true
            }]
        }])]
    });
    LoginAudit.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(LoginAudit.panel.Home,MODx.FormPanel);
Ext.reg('loginaudit-panel-home',LoginAudit.panel.Home);