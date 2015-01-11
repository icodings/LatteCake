/**
 * Created by cong on 14-12-28.
 */
Ext.define('LatteCake.view.MoodList', {
    extend: 'Ext.Container',
    xtype: 'moodList',
    requires: [
        'Ext.Toolbar',
        'Ext.List',
        'Ext.dataview.List',
        'Ext.dataview.DataView',
        'Ext.plugin.ListPaging',
        'Ext.plugin.PullRefresh',
        'LatteCake.plugin.PullRefreshFn'
    ],
    store: 'MoodStore',
    config: {

        layout: 'vbox',
        items: [
            {
                xtype: 'toolbar',
                title: '碎言碎语',
                layout: 'hbox',
                items: [
                    { xtype: 'spacer' },
                    {
                        id: 'newMoodButton',
                        ui: 'action',
                        iconCls: 'add'
                    }
                ]
            },
            {
                id: 'moodPullList',
                xtype: 'list',
                flex: 2,
                store: 'MoodStore',
                plugins: [
                    {
                        xtype: 'pullRefreshFn',
                        refreshFn: function (loaded, arguments) {
                            Ext.getStore('MoodStore').load({
                                page: 1,
                                start: 0
                            });
                        }
                    },
                    {
                        xclass: 'Ext.plugin.ListPaging',
                        loadMoreText: '加载更多...',
                        autoPaging: true
                    }
                ],

                emptyText: '<p class="no-searches">没有找到相关碎语</p>',

                itemTpl: '<div class="list-item-narrative">{moodContent}</div>'
            }
        ]


    }
});