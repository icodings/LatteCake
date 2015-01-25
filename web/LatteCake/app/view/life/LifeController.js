/**
 * Created by cong on 15-1-25.
 */
Ext.define('LatteCake.view.life.LifeController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.life-form',

    submitNewLife: function()
    {
        var form = this.getView().getForm(),
            kEditor = this.getView().kEditor;
        var subData = form.getValues();
        subData.lifeContent = kEditor.html();
        if( form.isValid() )
        {
            if( Ext.isEmpty( subData.lifeContent ))
            {
                Ext.Msg.alert('失败', '文章内容不能为空！');
                return;
            }
            form.submit({
                clientValidation: true,
                url: baseInfo.baseUrl + 'admin/life/newLife',
                params: subData,
                waitMsg: '正在保存...',
                success: function(form, action) {
                    var response = action.result;
                    Ext.MsgTip.msg('提示', response.message);
                    form.reset();
                    kEditor.html('');
                },
                failure: function(form, action) {
                    Ext.Msg.alert('失败', action.result.message);
                }
            });
        }
    }
});