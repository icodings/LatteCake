/**
 * Created by cong on 15-1-24.
 */
Ext.define('LatteCake.view.life.LifeList', {
    extend: 'Ext.grid.Panel',

    requires: [
        'Ext.data.*',
        'Ext.grid.*',
        'Ext.util.*',
        'Ext.toolbar.Paging',
        'Ext.ux.ProgressBarPager'
    ],
    xtype: 'LifeList',
    height: 320,
    frame: true,
    title: 'Progress Bar Pager',

    initComponent: function() {
        this.width = 650;

        var store = '';

        Ext.apply(this, {
            store: store,
            columns: [{
                text: 'Company',
                sortable: true,
                dataIndex: 'name',
                flex: 1
            },{
                text: 'Price',
                sortable: true,
                formatter: 'usMoney',
                dataIndex: 'price',
                width: 75
            },{
                text: 'Change',
                sortable: true,
                renderer: this.changeRenderer,
                dataIndex: 'change',
                width: 80
            },{
                text: '% Change',
                sortable: true,
                renderer: this.pctChangeRenderer,
                dataIndex: 'pctChange',
                width: 100
            },{
                text: 'Last Updated',
                sortable: true,
                dataIndex: 'lastChange',
                width: 115,
                formatter: 'date("m/d/Y")'
            }],
            bbar: {
                xtype: 'pagingtoolbar',
                pageSize: 10,
                store: store,
                displayInfo: true,
                plugins: new Ext.ux.ProgressBarPager()
            }
        });
        this.callParent();
    },

    afterRender: function(){
        this.callParent(arguments);
        this.getStore().load();
    },

    changeRenderer: function(val) {
        if (val > 0) {
            return '<span style="color:green;">' + val + '</span>';
        } else if(val < 0) {
            return '<span style="color:red;">' + val + '</span>';
        }
        return val;
    },

    pctChangeRenderer: function(val){
        if (val > 0) {
            return '<span style="color:green;">' + val + '%</span>';
        } else if(val < 0) {
            return '<span style="color:red;">' + val + '%</span>';
        }
        return val;
    }
});