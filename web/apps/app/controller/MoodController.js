/**
 * Created by cong on 2014/12/25.
 */
Ext.define('LatteCake.controller.MoodController', {
    extend: 'Ext.app.Controller',
    config: {
        refs: {
            moodMain: 'moodMain',
            newMoodBtn: '#newMoodButton',
            backMoodBtn: '#backMoodList',
            saveMoodBtn: '#saveMoodBtn',
            moodFormBox: '#moodFormBox',
            moodForm: 'moodForm',
            moodList: 'moodList',
            moodPullList: '#moodPullList',
            backMoodDetailBtn: '#backMoodDetailBtn',
            removeMoodBtn: '#removeMoodBtn',
            moodDetail: 'moodDetail',
            editMoodBtn: '#editMoodBtn'
        },
        control: {
            newMoodBtn: {
                tap: 'showNewMoodForm'
            },
            backMoodBtn: {
                tap: 'backMoodList'
            },
            saveMoodBtn: {
                tap: 'saveMoodForm'
            },
            moodPullList: {
                itemtap: 'showMoodDetail'
            },
            backMoodDetailBtn: {
                tap: 'backMoodList'
            },
            removeMoodBtn: {
                tap: 'removeMood'
            },
            editMoodBtn: {
                tap: 'showEditMood'
            }
        }
    },

//    launch: function()
//    {
//        Ext.getStore('MoodStore').load();
//    },

    /**
     * 保存数据
     */
    saveMoodForm: function(cmp, index, target, record)
    {
        var me = this,
            moodFormBox = this.getMoodForm(),
            formValues = moodFormBox.getValues();

        var formModel = Ext.create( 'LatteCake.model.MoodModel',{
            moodId: formValues.moodId,
            moodTitle: formValues.moodTitle,
            moodContent: formValues.moodContent
        } );

        var errors = formModel.validate();
        if( errors.isValid() )
        {
            moodFormBox.submit({
                url: baseInfo.baseUrl + 'mood/newMood',
                method: 'POST',
                waitMsg: '正在保存...',
                success: function( request, success, response )
                {
                    if( success.success == true )
                    {
                        var result = success.data;
                        moodFormBox.reset();

                        var moodStore = Ext.getStore('MoodStore');
                        if( !formValues.moodId )
                        {
                            moodStore.add({
                                moodId: result.moodId,
                                moodTitle: formValues.moodTitle,
                                moodContent: formValues.moodContent
                            });
                            moodStore.sync();
                            moodStore.sort('moodId', 'DESC');
                        }else
                        {
                            var moodForm = cmp.up('moodForm'),
                                id = moodStore.find('moodId', formValues.moodId);
                            moodStore.getAt(id).set('moodTitle', formValues.moodTitle);
                            moodStore.getAt(id).set('moodContent', formValues.moodContent);
                        }
                        me.backMoodList();
                    }else
                    {
                        Ext.Msg.alert( success.message );
                    }
                },
                failure: function( )
                {
                    Ext.Msg.alert('请求失败请检测网络是否畅通');
                },
                callback: function(request, success, response){}
            });
        }else
        {
            var message = '';
            Ext.each( errors.items, function( rec )
            {
                message += rec.getMessage() + ' ';
            });
            Ext.Msg.alert( "验证失败！", message, Ext.emptyFn );
        }
    },

    /**
     * 返回moodList页面
     */
    backMoodList: function()
    {
        this.getMoodForm().reset();
        this.getMoodMain().animateActiveItem('moodList', {type: 'slide', direction: 'right'});
    },

    /**
     * 显示添加或修改的页面
     */
    showNewMoodForm: function()
    {
        this.getMoodForm().reset();
        this.getMoodMain().animateActiveItem('moodForm', {type: 'slide', direction: 'left'});
    },

    /**
     * 显示详情
     * @param cmp
     * @param index
     * @param target
     * @param record
     * @param e
     * @param eOpts
     */
    showMoodDetail: function(cmp, index, target, record, e, eOpts)
    {
        var me = this,
            main = me.getMoodMain(),
            view = main.down('moodDetail');
        if(!view)
        {
            view = Ext.create('LatteCake.view.MoodDetail');
            main.add(view);
        }
        view.down('titlebar').setTitle(record.data.moodTitle);
        view.setHtml(record.data.moodContent);
//        view.setId(record.data.id);
        view.setRecord( record );
        main.animateActiveItem(view, {type: 'slide', direction: 'left'});
    },

    /**
     * 显示编辑窗口
     * @param cmp
     * @param index
     * @param target
     * @param record
     */
    showEditMood: function(cmp, index, target, record)
    {
        var detail = cmp.up('moodDetail');
        this.showNewMoodForm();
        this.getMoodForm().setRecord(detail.getRecord());
    },

    /**
     * 删除碎语
     * @param cmp
     * @param index
     * @param target
     * @param record
     * @param e
     * @param eOpts
     */
    removeMood: function(cmp, index, target, record, e, eOpts)
    {
        var me = this,
            main = me.getMoodMain(),
            view = main.down('moodMain');
        var detail = cmp.up('moodDetail');

        Ext.Msg.confirm('删除', '确定删除记事：' + detail.down('titlebar').getTitle() + '？', function(buttonId, value, opts)
        {
            if(buttonId == 'yes')
            {

                var moodRecord = detail.getRecord().getData();
                Ext.Ajax.request({
                    url: baseInfo.baseUrl + 'mood/delMood',
                    method : 'post',
                    params: { 'id': moodRecord.moodId },
                    success: function(response, opts) {
                        var obj = Ext.decode(response.responseText);
                        if( obj.success == true )
                        {
                            var moodStore = Ext.getStore('MoodStore');
                            moodStore.remove(detail.getRecord());
                            moodStore.sync();
                            me.backMoodList();
                        }else
                        {
                            Ext.alert(obj.message);
                        }
                    },
                    failure: function(response, opts) {
                        console.log('server-side failure with status code ' + response.status);
                    }
                })

            }
        }, view);
    }
});