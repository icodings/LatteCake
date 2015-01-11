Ext.define('LatteCake.view.Main', {
    extend: 'Ext.Container',
    xtype: 'appMain',
    requires: [
        'Ext.TitleBar',
        'Ext.Video'
    ],
    config: {
        fullscreen: true,
        layout: 'card',
        cardAnimation: 'slide',
        items: [{
            layout: 'fit',
            html: 'This is the notes list container',
            dockedItems: [{
//                xtype: 'titlebar',
                title: 'My Notes'
            }]
        }]
    }
});
