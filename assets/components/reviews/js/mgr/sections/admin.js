Ext.onReady(function() {
    MODx.load({
        xtype : 'reviews-page-admin'
    });
});

Reviews.page.Admin = function(config) {
    config = config || {};

    config.buttons = [];

    if (Reviews.config.branding_url) {
        config.buttons.push({
            text        : 'Reviews ' + Reviews.config.version,
            cls         : 'x-btn-branding',
            handler     : this.loadBranding
        });
    }

    config.buttons.push({
        text        : '<i class="icon icon-cogs"></i>' + _('reviews.default_view'),
        handler     : this.toDefaultView,
        scope       : this
    });

    if (Reviews.config.branding_url_help) {
        config.buttons.push({
            text        : _('help_ex'),
            handler     : MODx.loadHelpPane,
            scope       : this
        });
    }

    Ext.applyIf(config, {
        components  : [{
            xtype       : 'reviews-panel-admin',
            renderTo    : 'reviews-panel-admin-div'
        }]
    });

    Reviews.page.Admin.superclass.constructor.call(this, config);
};

Ext.extend(Reviews.page.Admin, MODx.Component, {
    loadBranding: function(btn) {
        window.open(Reviews.config.branding_url);
    },
    toDefaultView : function() {
        MODx.loadPage('home', 'namespace=' + MODx.request.namespace);
    }
});

Ext.reg('reviews-page-admin', Reviews.page.Admin);