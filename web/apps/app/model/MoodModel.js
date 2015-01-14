/**
 * Created by cong on 2014/12/25.
 */
Ext.define('LatteCake.model.MoodModel', {
    extend: 'Ext.data.Model',
    config: {
//        idProperty: 'moodId',
        fields: [
            { name: 'moodId', type: 'int' },
            { name: 'moodTitle', type: 'string' },
            { name: 'moodContent', type: 'string' }
        ],
        validations: [
            {type: 'length', field: 'moodTitle', max: 10, message: '标题最长10位'},
            {type: 'length', field: 'moodContent', min: 1, max:1000, message: '内容最少1位最多1000位'}
        ]
    }
});