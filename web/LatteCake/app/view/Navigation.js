Ext.define('LatteCake.view.Navigation', {
    extend: 'Ext.tree.Panel',

    xtype: 'appNavigation',

    title: '菜单栏',
    rootVisible: false,
    lines: false,
    useArrows: true,
    hideHeaders: true,
    collapseFirst: false,
    width: 250,
    minWidth: 100,
    height: 200,
    split: true,
    stateful: true,
    stateId: 'mainnav.west',
    collapsible: true,

    bufferedRenderer: '',

    initComponent: function() {
        Ext.apply(this, {
            store: Ext.getStore('NavigationStore')
        });
        this.callParent(arguments);
    }
});