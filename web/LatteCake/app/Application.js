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

    init: function()
    {

    },

    launch: function () {

    }
});
