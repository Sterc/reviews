Reviews.combo.Rating = function(config) {
    config = config || {};

    var data    = [];
    var ratings = Reviews.config.rating_scale.split('||');
    var start   = parseInt(ratings[0]);
    var end     = parseInt(ratings[1]);

    if (start === 0) {
        start = 1;
    }

    data.push([0, '(' + _('reviews.rating_0') + ')', '']);

    for (var i = start; i <= end; i++) {
        var stars = [];

        for (var ii = start; ii <= end; ii++) {
            if (ii <= i) {
                stars.push('<i class="icon icon-star"></i>');
            } else {
                stars.push('<i class="icon icon-star-o"></i>');
            }
        }

        data.push([i, i + ' (' + _('reviews.rating_' + i) + ')', stars.join(' ')]);
    }

    Ext.applyIf(config, {
        store       : new Ext.data.ArrayStore({
            mode        : 'local',
            fields      : ['rating', 'label', 'stars'],
            data        : data.reverse()
        }),
        hiddenName  : 'rating',
        valueField  : 'rating',
        displayField : 'label',
        mode        : 'local',
        tpl         : new Ext.XTemplate('<tpl for=".">' +
            '<div class="x-combo-list-item">' +
                '{stars} {label:htmlEncode}' +
            '</div>' +
        '</tpl>')
    });

    Reviews.combo.Rating.superclass.constructor.call(this, config);
};

Ext.extend(Reviews.combo.Rating, MODx.combo.ComboBox);

Ext.reg('reviews-combo-rating', Reviews.combo.Rating);

Reviews.combo.Resource = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        url         : Reviews.config.connector_url,
        baseParams  : {
            action      : 'mgr/resources/getlist'
        },
        fields      : ['id', 'pagetitle', 'pagetitle_formatted'],
        hiddenName  : 'resource_id',
        pageSize    : 15,
        valueField  : 'id',
        displayField : 'pagetitle_formatted',
        forceSelection : true,
        editable    : true,
        typeAhead   : true,
        enableKeyEvents : true
    });

    Reviews.combo.Resource.superclass.constructor.call(this,config);
};

Ext.extend(Reviews.combo.Resource, MODx.combo.ComboBox);

Ext.reg('reviews-combo-resource', Reviews.combo.Resource);

Reviews.combo.Resources = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        url         : Reviews.config.connector_url,
        baseParams  : {
            action      : 'mgr/reviews/getresources'
        },
        fields      : ['id', 'pagetitle', 'pagetitle_formatted'],
        hiddenName  : 'resource_id',
        pageSize    : 15,
        valueField  : 'id',
        displayField : 'pagetitle_formatted'
    });

    Reviews.combo.Resources.superclass.constructor.call(this,config);
};

Ext.extend(Reviews.combo.Resources, MODx.combo.ComboBox);

Ext.reg('reviews-combo-resources', Reviews.combo.Resources);