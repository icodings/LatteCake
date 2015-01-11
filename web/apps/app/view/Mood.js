/**
 * Created by cong on 2014/12/25.
 */
Ext.define('LatteCake.view.Mood', {
    extend: 'Ext.Container',
    xtype: 'moodMain',
    requires: [
    ],
    config: {
        fullscreen: true,
        layout: 'card',
        cardAnimation: 'slide',
        items: [{
            xtype: 'moodList'
        },{
            xtype: 'moodForm'
        }]
    }
});
