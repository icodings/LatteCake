/**
 * Created by cong on 15-1-24.
 */
Ext.define('LatteCake.controller.MainController', {
    extend: 'Ext.app.Controller',
    requires: [
        'LatteCake.view.life.LifeController',
        'LatteCake.view.learn.LearnController'
    ],
    config: {
        refs: {
            navigation: 'Navigation',
            contentPanel: 'ContentPanel'
        },
        control: {
            'navigation': {
                selectionchange: 'onTreeNavSelectionChange'
            }
        },
        routes  : {
            ':id': {
                action: 'handleRoute',
                before: 'beforeHandleRoute'
            }
        }
    },

    init: function()
    {

        Ext.MsgTip = function(){
            var msgCt;

            function createBox(t, s){
                // return ['<div class="msg">',
                //         '<div class="x-box-tl"><div class="x-box-tr"><div class="x-box-tc"></div></div></div>',
                //         '<div class="x-box-ml"><div class="x-box-mr"><div class="x-box-mc"><h3>', t, '</h3>', s, '</div></div></div>',
                //         '<div class="x-box-bl"><div class="x-box-br"><div class="x-box-bc"></div></div></div>',
                //         '</div>'].join('');
                return '<div class="msg ' + Ext.baseCSSPrefix + 'border-box"><h3>' + t + '</h3><p>' + s + '</p></div>';
            }
            return {
                msg : function(title, format) {
                    // Ensure message container is last in the DOM so it cannot interfere with
                    // layout#isValidParent's DOM ordering requirements.
                    if (msgCt) {
                        document.body.appendChild(msgCt.dom);
                    } else {
                        msgCt = Ext.DomHelper.append(document.body, {id:'msg-div'}, true);
                    }
                    var s = Ext.String.format.apply(String, Array.prototype.slice.call(arguments, 1));
                    var m = Ext.DomHelper.append(msgCt, createBox(title, s), true);
                    m.hide();
                    m.slideIn('t').ghost("t", { delay: 1000, remove: true});
                }
            };
        }();
    },

    initComponent: function()
    {
//        this.control({
//            'navigation': {
//                selectionchange: 'onTreeNavSelectionChange'
//            }
//        });
        console.log(this.getNavigation());
        console.log('init...');
    },

    onBreadcrumbNavSelectionChange: function(breadcrumb, node) {
        if (node) {
            this.redirectTo(node.getId());
        }
    },

    onTreeNavSelectionChange: function(selModel, records)
    {
        console.log('onTreeNavSelectionChange...');
        var record = records[0];

        if (record) {
            this.redirectTo(record.getId());
        }
    },

    beforeHandleRoute: function(id, action) {
        var me = this,
            node = Ext.getStore('NavigationStore').getNodeById(id);
        console.log(id);
console.log(Ext.getStore('NavigationStore').getNodeById(id));
        if (node) {
            //resume action
            action.resume();
        } else {
            Ext.Msg.alert(
                '路由错误',
                '没有找到 [ ' + id + ' ] 视图',
                function() {
                    me.redirectTo(me.getApplication().getDefaultToken());
                }
            );
            action.stop();
        }
    },

    handleRoute: function(id) {
        console.log(id);
        var me = this,
            navigationTree = me.getNavigation(),
            store = Ext.getStore('NavigationStore'),
            node = store.getNodeById(id),
            contentPanel = me.getContentPanel(),
            hasTree = navigationTree && navigationTree.isVisible(),
            cmp, className, ViewClass, clsProto, thumbnailsStore;

        Ext.suspendLayouts();

        if (node.isLeaf()) {

            contentPanel.removeAll(true);

            if (hasTree) {
                // Focusing explicitly brings it into rendered range, so do that first.
                navigationTree.getView().focusNode(node);
                navigationTree.getSelectionModel().select(node);
            } else {
                navigationBreadcrumb.setSelection(node);
            }

            contentPanel.body.addCls('kitchensink-example');

            className = Ext.ClassManager.getNameByAlias('widget.' + id);
            ViewClass = Ext.ClassManager.get(className);
            clsProto = ViewClass.prototype;

            if (clsProto.themes) {
                clsProto.themeInfo = clsProto.themes[themeName];

                if (themeName === 'gray') {
                    clsProto.themeInfo = Ext.applyIf(clsProto.themeInfo || {}, clsProto.themes.classic);
                } else if (themeName !== 'neptune' && themeName !== 'classic') {
                    if (themeName === 'crisp-touch') {
                        clsProto.themeInfo = Ext.applyIf(clsProto.themeInfo || {}, clsProto.themes['neptune-touch']);
                    }
                    clsProto.themeInfo = Ext.applyIf(clsProto.themeInfo || {}, clsProto.themes.neptune);
                }
                // <debug warn>
                // Sometimes we forget to include allowances for other themes, so issue a warning as a reminder.
                if (!clsProto.themeInfo) {
                    Ext.log.warn ( 'Example \'' + className + '\' lacks a theme specification for the selected theme: \'' +
                        themeName + '\'. Is this intentional?');
                }
                // </debug>
            }

            cmp = new ViewClass();

            contentPanel.add(cmp);
            this.setupPreview(clsProto);

            this.updateTitle(node);

            Ext.resumeLayouts(true);

            if (cmp.floating) {
                cmp.show();
            }
        } else {
            // Only attempt to select the node if the tree is visible
            if (hasTree) {
                if (id !== 'all') {
                    // If the node is the root (rootVisible is false), then
                    // Focus the first node in the tree.
                    navigationTree.ensureVisible(node.isRoot() ? store.getAt(0) : node, {
                        select: true,
                        focus: true
                    });
                }
            }
            // Ensure that non-leaf nodes are still highlighted and focused.
            else {
                navigationBreadcrumb.setSelection(node);
            }
            thumbnailsStore = me.getThumbnailsStore();
            thumbnailsStore.removeAll();
            thumbnailsStore.add(node.childNodes);
            if (!thumbnails.ownerCt) {
                contentPanel.removeAll(true);
            }
            contentPanel.body.removeCls('kitchensink-example');
            contentPanel.add(thumbnails);
            codePreview.removeAll();
            codePreview.add({
                html: node.get('description') || ''
            });
            codePreview.tabBar.hide();
            this.updateTitle(node);
            Ext.resumeLayouts(true);
        }
    },

});