Reviews.grid.Ratings = function(config) {
    config = config || {};

    config.tbar = [{
        text        : _('reviews.rating_create'),
        cls         : 'primary-button',
        handler     : this.createRating,
        scope       : this
    }, '->', {
        xtype       : 'textfield',
        name        : 'reviews-filter-ratings-search',
        id          : 'reviews-filter-ratings-search',
        emptyText   : _('search') + '...',
        listeners   : {
            'change'    : {
                fn          : this.filterSearch,
                scope       : this
            },
            'render'    : {
                fn          : function(cmp) {
                    new Ext.KeyMap(cmp.getEl(), {
                        key     : Ext.EventObject.ENTER,
                        fn      : this.blur,
                        scope   : cmp
                    });
                },
                scope       : this
            }
        }
    }, {
        xtype       : 'button',
        cls         : 'x-form-filter-clear',
        id          : 'reviews-filter-ratings-clear',
        text        : _('filter_clear'),
        listeners   : {
            'click'     : {
                fn          : this.clearFilter,
                scope       : this
            }
        }
    }];

    var columns = new Ext.grid.ColumnModel({
        columns     : [{
            header      : _('reviews.label_rating_name'),
            dataIndex   : 'name_formatted',
            sortable    : true,
            editable    : false,
            width       : 200,
            fixed       : false
        }, {
            header      : _('reviews.label_rating_active'),
            dataIndex   : 'active',
            sortable    : true,
            editable    : true,
            width       : 100,
            fixed       : true,
            renderer    : this.renderBoolean,
            editor      : {
                xtype       : 'modx-combo-boolean'
            }
        }, {
            header      : _('last_modified'),
            dataIndex   : 'editedon',
            sortable    : true,
            editable    : false,
            fixed       : true,
            width       : 200,
            renderer    : this.renderDate
        }]
    });

    Ext.applyIf(config, {
        cm          : columns,
        id          : 'reviews-grid-ratings',
        url         : Reviews.config.connector_url,
        baseParams  : {
            action      : 'mgr/ratings/getlist'
        },
        autosave    : true,
        save_action : 'mgr/reviews/updatefromgrid',
        fields      : ['id', 'name', 'active', 'menuindex', 'createdon', 'editedon', 'name_formatted'],
        paging      : true,
        pageSize    : MODx.config.default_per_page > 30 ? MODx.config.default_per_page : 30,
        enableDragDrop : true,
        ddGroup     : 'reviews-grid-ratings'
    });

    Reviews.grid.Ratings.superclass.constructor.call(this, config);

    this.on('afterrender', this.sortRatings, this);
};

Ext.extend(Reviews.grid.Ratings, MODx.grid.Grid, {
    filterSearch: function(tf, nv, ov) {
        this.getStore().baseParams.query = tf.getValue();

        this.getBottomToolbar().changePage(1);
    },
    clearFilter: function() {
        this.getStore().baseParams.query = '';

        Ext.getCmp('reviews-filter-ratings-search').reset();

        this.getBottomToolbar().changePage(1);
    },
    getMenu: function() {
        return [{
            text    : '<i class="x-menu-item-icon icon icon-pencil"></i>' + _('reviews.rating_update'),
            handler : this.updateRating,
            scope   : this
        }, '-', {
            text    : '<i class="x-menu-item-icon icon icon-times"></i>' + _('reviews.rating_remove'),
            handler : this.removeRating,
            scope   : this
        }];
    },
    sortRatings: function() {
        new Ext.dd.DropTarget(this.getView().mainBody, {
            ddGroup     : this.config.ddGroup,
            notifyDrop  : function(dd, e, data) {
                var index = dd.getDragData(e).rowIndex;

                if (undefined !== index) {
                    for (var i = 0; i < data.selections.length; i++) {
                        data.grid.getStore().remove(data.grid.getStore().getById(data.selections[i].id));
                        data.grid.getStore().insert(index, data.selections[i]);
                    }

                    var order = [];

                    Ext.each(data.grid.getStore().data.items, (function(record) {
                        order.push(record.id);
                    }).bind(this));

                    MODx.Ajax.request({
                        url     : Reviews.config.connector_url,
                        params  : {
                            action  : 'mgr/ratings/sort',
                            sort    : order.join(',')
                        },
                        listeners   : {
                            'success'   : {
                                fn          : function() {

                                },
                                scope       : this
                            }
                        }
                    });
                }
            }
        });
    },
    createRating: function(btn, e) {
        if (this.createRatingWindow) {
            this.createRatingWindow.destroy();
        }

        this.createRatingWindow = MODx.load({
            xtype       : 'reviews-window-rating-create',
            closeAction : 'close',
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });

        this.createRatingWindow.show(e.target);
    },
    updateRating: function(btn, e) {
        if (this.updateRatingWindow) {
            this.updateRatingWindow.destroy();
        }

        this.updateRatingWindow = MODx.load({
            xtype       : 'reviews-window-rating-update',
            record      : this.menu.record,
            closeAction : 'close',
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });

        this.updateRatingWindow.setValues(this.menu.record);
        this.updateRatingWindow.show(e.target);
    },
    removeRating: function(btn, e) {
        MODx.msg.confirm({
            title       : _('reviews.rating_remove'),
            text        : _('reviews.rating_remove_confirm'),
            url         : Reviews.config.connector_url,
            params      : {
                action      : 'mgr/ratings/remove',
                id          : this.menu.record.id
            },
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });
    },
    renderBoolean: function(d, c) {
        c.css = parseInt(d) === 1 || d ? 'green' : 'red';

        return parseInt(d) === 1 || d ? _('yes') : _('no');
    },
    renderDate: function(a) {
        if (Ext.isEmpty(a)) {
            return '—';
        }

        return a;
    }
});

Ext.reg('reviews-grid-ratings', Reviews.grid.Ratings);

Reviews.window.CreateRating = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        autoHeight  : true,
        title       : _('reviews.rating_create'),
        url         : Reviews.config.connector_url,
        baseParams  : {
            action      : 'mgr/ratings/create'
        },
        fields      : [{
            layout      : 'column',
            defaults    : {
                layout      : 'form',
                labelSeparator : ''
            },
            items       : [{
                columnWidth : .85,
                items       : [{
                    xtype       : 'textfield',
                    fieldLabel  : _('reviews.label_rating_name'),
                    description : MODx.expandHelp ? '' : _('reviews.label_rating_name_desc'),
                    name        : 'name',
                    anchor      : '100%',
                    allowBlank  : false
                }, {
                    xtype       : MODx.expandHelp ? 'label' : 'hidden',
                    html        : _('reviews.label_rating_name_desc'),
                    cls         : 'desc-under'
                }]
            }, {
                columnWidth : .15,
                items       : [{
                    xtype       : 'checkbox',
                    fieldLabel  : _('reviews.label_rating_active'),
                    description : MODx.expandHelp ? '' : _('reviews.label_rating_active_desc'),
                    name        : 'active',
                    inputValue  : 1
                }, {
                    xtype       : MODx.expandHelp ? 'label' : 'hidden',
                    html        : _('reviews.label_rating_active_desc'),
                    cls         : 'desc-under'
                }]
            }]
        }]
    });

    Reviews.window.CreateRating.superclass.constructor.call(this, config);
};

Ext.extend(Reviews.window.CreateRating, MODx.Window);

Ext.reg('reviews-window-rating-create', Reviews.window.CreateRating);

Reviews.window.UpdateRating = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        autoHeight  : true,
        title       : _('reviews.rating_update'),
        url         : Reviews.config.connector_url,
        baseParams  : {
            action      : 'mgr/ratings/update'
        },
        fields      : [{
            xtype       : 'hidden',
            name        : 'id'
        }, {
            layout      : 'column',
            defaults    : {
                layout      : 'form',
                labelSeparator : ''
            },
            items       : [{
                columnWidth : .85,
                items       : [{
                    xtype       : 'textfield',
                    fieldLabel  : _('reviews.label_rating_name'),
                    description : MODx.expandHelp ? '' : _('reviews.label_rating_name_desc'),
                    name        : 'name',
                    anchor      : '100%',
                    allowBlank  : false
                }, {
                    xtype       : MODx.expandHelp ? 'label' : 'hidden',
                    html        : _('reviews.label_rating_name_desc'),
                    cls         : 'desc-under'
                }]
            }, {
                columnWidth : .15,
                items       : [{
                    xtype       : 'checkbox',
                    fieldLabel  : _('reviews.label_rating_active'),
                    description : MODx.expandHelp ? '' : _('reviews.label_rating_active_desc'),
                    name        : 'active',
                    inputValue  : 1
                }, {
                    xtype       : MODx.expandHelp ? 'label' : 'hidden',
                    html        : _('reviews.label_rating_active_desc'),
                    cls         : 'desc-under'
                }]
            }]
        }]
    });

    Reviews.window.UpdateRating.superclass.constructor.call(this, config);
};

Ext.extend(Reviews.window.UpdateRating, MODx.Window);

Ext.reg('reviews-window-rating-update', Reviews.window.UpdateRating);