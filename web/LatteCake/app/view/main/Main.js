/**
 * This class is the main view for the application. It is specified in app.js as the
 * "autoCreateViewport" property. That setting automatically applies the "viewport"
 * plugin to promote that instance of this class to the body element.
 *
 * TODO - Replace this content of this view to suite the needs of your application.
 */
Ext.define('LatteCake.view.main.Main', {
    extend: 'Ext.container.Container',
    requires: [
        'LatteCake.view.main.MainController',
        'LatteCake.view.main.MainModel'
    ],

    xtype: 'app-main',
    
    controller: 'main',
    viewModel: {
        type: 'main'
    },

    layout: {
        type: 'border'
    },

    items: [{
        xtype: 'appHeader',
        region: 'north'
    },{
        region: 'west',
        xtype: 'appNavigation'
    },{
        region: 'center',
        xtype: 'appContentPanel'
    }]
});
