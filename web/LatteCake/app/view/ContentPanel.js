/**
 * Created by cong on 15-1-24.
 */
Ext.define('LatteCake.view.ContentPanel', {
    extend: 'Ext.panel.Panel',
    xtype: 'appContentPanel',
    id: 'content-panel',
    scrollable: true,

    header: {
        hidden: true
    },

    requires: [

    ],

    items: [
        {
            xtype: 'LearnEditor'
        }
    ]
});
