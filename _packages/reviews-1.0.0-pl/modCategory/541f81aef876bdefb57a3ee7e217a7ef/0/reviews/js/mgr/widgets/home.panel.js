Reviews.panel.Home = function(config) {
    config = config || {};

    Ext.apply(config, {
        id          : 'reviews-panel-home',
        cls         : 'container',
        items       : [{
            html        : '<h2>' + _('reviews') + '</h2>',
            cls         : 'modx-page-header'
        }, {
            layout      : 'form',
            items       : [{
                html            : '<p>' + _('reviews.reviews_desc') + '</p>',
                bodyCssClass    : 'panel-desc'
            }, {
                xtype           : 'reviews-grid-reviews',
                cls             : 'main-wrapper',
                preventRender   : true
            }]
        }]
    });

    Reviews.panel.Home.superclass.constructor.call(this, config);
};

Ext.extend(Reviews.panel.Home, MODx.FormPanel);

Ext.reg('reviews-panel-home', Reviews.panel.Home);