/**
 * Created by cong on 14-12-25.
 */
Ext.define('LatteCake.view.MoodForm', {
    extend: 'Ext.form.Panel',
    xtype: 'moodForm',
    requires: [
        'Ext.Toolbar',
        'Ext.form.Hidden'
    ],
    config: {
        id: 'moodForm',
        items: [
            {
                xtype: 'toolbar',
                title: '添加碎语',
                layout: 'hbox',
                items: [
                    {
                        id: 'backMoodList',
                        ui: 'back',
                        iconCls: 'arrow_left'
                    },
                    { xtype: 'spacer' },
                    {
                        id: 'saveMoodBtn',
                        ui: 'action',
                        text: '保存'
                    }
                ]
            },
            {
                id: 'moodFormBox',
                items: [
                    {
                        xtype: 'hiddenfield',
                        name: 'moodId'
                    },
                    {
                        labelWidth: '20%',
                        xtype: 'textfield',
                        name: 'moodTitle',
                        label: '标题',
                        placeHolder: '标题可不填',
                        maxLength: 10
                    },
                    {
                        labelWidth: '20%',
                        xtype: 'textareafield',
                        name: 'moodContent',
                        label: '内容',
                        placeHolder: '内容最长500字',
                        maxLength: 1000,
                        minLength: 1,
                        required: true
                    }
                ]
            }
        ]
    }
});