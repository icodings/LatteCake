/**
 * Created by cong on 14-12-28.
 */
Ext.define('LatteCake.view.MoodDetail', {
    extend: 'Ext.Container',
    xtype: 'moodDetail',
    requires: [
        'Ext.TitleBar'
    ],
    config: {
        styleHtmlContent: true,
        scrollable: true,
        items: [
            {
                docked: 'top',
                xtype: 'titlebar',
                title: '',
                items: [
                    {
                        id: 'backMoodDetailBtn',
                        text: '返回',
                        align: 'left',
                        ui: 'back'
                    }
                ]
            },
            {
                docked: 'bottom',
                xtype: 'titlebar',
                title: '',
                items: [
                    {
                        id: 'removeMoodBtn',
                        align: 'right',
                        xtype: "button",
                        iconCls: "trash",
                        iconMask: true,
                        scope: this
                    },
                    {
                        id: 'editMoodBtn',
                        align: 'left',
                        xtype: "button",
                        iconCls: "compose",
                        iconMask: true,
                        scope: this
                    }
                ]
            }
        ]
    }
});