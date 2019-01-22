Ext.onReady(function() {
    MODx.load({
        xtype : 'reviews-page-home'
    });
});

Reviews.page.Home = function(config) {
    config = config || {};

    config.buttons = [];

    if (Reviews.config.branding_url) {
        config.buttons.push({
            text        : 'Reviews ' + Reviews.config.version,
            cls         : 'x-btn-branding',
            handler     : this.loadBranding
        });
    }

    if (Reviews.config.branding_url_help) {
        config.buttons.push({
            text        : _('help_ex'),
            handler     : MODx.loadHelpPane,
            scope       : this
        });
    }

    Ext.applyIf(config, {
        components  : [{
            xtype       : 'reviews-panel-home',
            renderTo    : 'reviews-panel-home-div'
        }]
    });

    Reviews.page.Home.superclass.constructor.call(this, config);
};

Ext.extend(Reviews.page.Home, MODx.Component, {
    loadBranding: function(btn) {
        window.open(Reviews.config.branding_url);
    }
});

Ext.reg('reviews-page-home', Reviews.page.Home);