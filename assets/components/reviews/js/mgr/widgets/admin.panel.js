Reviews.panel.Admin = function(config) {
    config = config || {};

    Ext.apply(config, {
        id          : 'reviews-panel-admin',
        cls         : 'container',
        items       : [{
            html        : '<h2>' + _('reviews') + '</h2>',
            cls         : 'modx-page-header'
        }, {
            layout      : 'form',
            items       : [{
                html            : '<p>' + _('reviews.ratings_desc') + '</p>',
                bodyCssClass    : 'panel-desc'
            }, {
                xtype           : 'reviews-grid-ratings',
                cls             : 'main-wrapper',
                preventRender   : true
            }]
        }]
    });

    Reviews.panel.Admin.superclass.constructor.call(this, config);
};

Ext.extend(Reviews.panel.Admin, MODx.FormPanel);

Ext.reg('reviews-panel-admin', Reviews.panel.Admin);