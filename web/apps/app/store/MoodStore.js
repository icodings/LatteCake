/**
 * Created by cong on 2014/12/25.
 */
Ext.define('LatteCake.store.MoodStore', {
    extend: 'Ext.data.Store',
    model: 'LatteCake.model.MoodModel',
    proxy: {
        type: 'ajax',
        url : baseInfo.baseUrl + 'mood/list',
        pageParam: 'page',
        reader: {
            rootProperty: 'data',
            totalProperty: 'totalCount'
        }

    },
    autoLoad: true,
    listeners: {
        load: function(store, records, successful, operation, eOpts){
            if( records.length < 1 )
            {
                Ext.Msg.alert('没有更多了...');
            }
            if(!successful){
                //这个事件具体的可以看API  no more record 也会进入
                Ext.Msg.alert(store.getProxy().getReader().rawData.message);
            }
        }
    }
});