/**
 * Created by cong on 15-1-24.
 */
Ext.define('LatteCake.store.NavigationStore', {
    extend: 'Ext.data.TreeStore',

    model: 'LatteCake.model.NavigationModel',
    proxy : {
        type : 'ajax',
        url  : baseInfo.baseUrl + 'admin/navigation'
    },
    autoLoad: true
});