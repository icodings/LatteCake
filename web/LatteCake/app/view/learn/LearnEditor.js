/**
 * Created by cong on 15-1-26.
 */
Ext.define('LatteCake.view.learn.LearnEditor', {
    extend : 'Ext.form.Panel',
    alias : 'widget.LearnEditor',
    xtype: 'LearnEditor',
    title: '编辑文章',

    controller: 'learn-form',

//    viewModel: true,

    initComponent : function() {

        var me = this;

        Ext.apply(this, {
            frame: true,
            bodyPadding: 5,
            resizable: true,

            fieldDefaults: {
                labelWidth: 70,
                anchor: '100%'
            },

            layout: {
                type: 'vbox',
                align: 'stretch'  // Child items are stretched to full width
            },

            defaultType: 'textfield',
            items: [
                {
                    allowBlank: false,
                    fieldLabel: '文章标题',
                    name: 'learnTitle',
                    emptyText: '请输入标题',
                    invalidText: '标题最长64个字符.',
                    maxLength: 32
                },{
                    xtype: 'filefield',
                    emptyText: '',
                    fieldLabel: '文章图片',
                    name: 'learnImage',
                    buttonText: '',
                    buttonConfig: {
                        iconCls: 'upload-icon'
                    }
                },{
                    xtype: 'textarea',
                    allowBlank: false,
                    fieldLabel: '文章简介',
                    name: 'learnDesc',
                    invalidText: '标题最长255个字符.',
                    emptyText: '请输入文章简介',
                    maxLength: 255
                },
                {
                    xtype: 'textarea',
                    region: 'center',
                    name: 'content',
                    id: 'content',
                    height: 400,
                    listeners: {
                        'render': function (f) {
                            setTimeout(function () {
                                if (KindEditor) {
                                    me.kEditor = KindEditor.create('#content-inputEl', {
                                        cssPath: '/static/kindEditor/plugins/code/prettify.css',
                                        uploadJson : baseInfo.baseUrl + 'admin/image/uploadImage',
                                        imageUploadJson: baseInfo.baseUrl + 'admin/image/uploadImage',
                                        imageSizeLimit: '3MB',
                                        resizeType: 0,
                                        resizeMode: 0,
                                        allowFileManager: true,
                                        height: 400
                                    });
                                }
                            }, 500);
                        }
                    }
                },{
                    fieldLabel: '来源',
                    name: 'learnSource',
                    emptyText: '请输入文章来源地址',
                    invalidText: '标题最长128个字符.',
                    maxLength: 128
                },{
                    fieldLabel: '关键字',
                    name: 'llearnKeyword',
                    emptyText: '请输入文章关键字',
                    maxLength: 128
                }, {
                    xtype: 'tagfield',
                    fieldLabel: '标签',
//                    store: {
//                        type: 'states'
//                    },
                    name: 'learnTag',
                    reference: 'locations',
                    displayField: 'state',
                    valueField: 'abbr',
                    createNewOnEnter: true,
                    createNewOnBlur: true,
                    filterPickList: true,
                    queryMode: 'local',
                    publishes: 'value'
                }
            ],
            buttons: [
                {
                    formBind: true,
                    disabled: true,
                    text: '保存',
                    listeners: {
                        click: 'submitNewLearn'
                    }
                },
                {
                    text: '清除',
                    listeners: {
                        click: 'clearLearnEdit'
                    }
                }
            ]
        });

        this.callParent(arguments);
    }
});