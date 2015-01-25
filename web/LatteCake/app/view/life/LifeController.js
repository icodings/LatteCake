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
        if( form.isValid() )
        {
            var subData = form.getValues();
            subData.lifeContent = kEditor.html();
            form.submit({
                clientValidation: true,
                url: baseInfo.baseUrl + 'admin/life/newLife',
                params: subData,
                success: function(form, action) {
                    var response = action.result;
                    console.log(response);
                },
                failure: function(form, action) {
                    console.log(action);
//                    Ext.Msg.alert('失败', ));
                }
            });
        }
    }
});