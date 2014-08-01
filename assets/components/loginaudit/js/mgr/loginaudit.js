var LoginAudit = function(config) {
    config = config || {};
    LoginAudit.superclass.constructor.call(this, config);
};
Ext.extend(LoginAudit, Ext.Component,{
    page:{}, window:{}, grid:{}, tree:{}, panel:{}, combo:{}, config:{}, view:{}, utils:{}
});
Ext.reg('LoginAudit', LoginAudit);

LoginAudit = new LoginAudit();
