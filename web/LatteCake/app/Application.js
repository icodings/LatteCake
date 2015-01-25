/**
 * The main application class. An instance of this class is created by app.js when it calls
 * Ext.application(). This is the ideal place to handle application launch and initialization
 * details.
 */
Ext.define('LatteCake.Application', {
    extend: 'Ext.app.Application',
    
    name: 'LatteCake',

    views: [
        'LatteCake.view.Header',
        'LatteCake.view.Navigation',
        'LatteCake.view.ContentPanel',
        'LatteCake.view.life.LifeList',
        'LatteCake.view.life.LifeEditor'
    ],

    requires: [
        'Ext.window.MessageBox'
    ],

    stores: [
        'NavigationStore'
    ],

    controllers: [
        'LatteCake.controller.MainController'
    ],

    launch: function () {
        Ext.MsgTip = function(){
            var msgCt;
            function createBox(t, s)
            {
                return ['<div class="msg" id="MsgTip">',
                    '<div class="x-box-tl"><div class="x-box-tr"><div class="x-box-tc"></div></div></div>',
                    '<div class="x-box-ml"><div class="x-box-mr"><div class="x-box-mc" style="font-size=12px;"><h3>', t, '</h3>', s, '</div></div></div>',
                    '<div class="x-box-bl"><div class="x-box-br"><div class="x-box-bc"></div></div></div>',
                    '</div>'].join('');
            }
            return {
                msg : function(title, message, autoHide, pauseTime)
                {
                    if(!msgCt)
                    {
                        msgCt = Ext.DomHelper.insertFirst(document.body, {
                            id: 'msg-div22',
                            style: 'position:absolute;top:10px;width:300px;margin:0 auto;z-index:20000;'
                        }, true);
                    }
                    msgCt.alignTo( document, 't-t' );
//                    message += '<br><span style="text-align:right;font-size:12px; width:100%; display:block;">' +
//                        '<font color="blank"><u style="cursor:pointer;" onclick="MsgTip.hide(this);">关闭</u></font></span>';
                    var m = Ext.DomHelper.append(msgCt, { html: createBox( title, message ) }, true);
                    m.slideIn('t');
                    if( !Ext.isEmpty( autoHide ) && autoHide == true )
                    {
                        if( Ext.isEmpty( pauseTime ) )
                        {
                            pauseTime = 1000;
                        }
                        m.pause( pauseTime ).ghost("tr", {remove:true});
                    }
                },
                hide:function(v)
                {
                    var msg = Ext.get( v.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement );
                    msg.ghost( "tr", { remove:true } );
                }
            };
        }();
    }
});
