Reviews.grid.Reviews = function(config) {
    config = config || {};

    config.tbar = [{
        text        : _('reviews.review_create'),
        cls         : 'primary-button',
        handler     : this.createReview,
        scope       : this
    }, '->', {
        xtype       : 'reviews-combo-resources',
        name        : 'reviews-filter-resource',
        id          : 'reviews-filter-resource',
        emptyText   : _('reviews.filter_resource'),
        listeners   : {
            'select'    : {
                fn          : this.filterResource,
                scope       : this
            }
        }
    }, {
        xtype       : 'textfield',
        name        : 'reviews-filter-search',
        id          : 'reviews-filter-search',
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
        id          : 'reviews-filter-clear',
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
            header      : _('reviews.label_name'),
            dataIndex   : 'name',
            sortable    : true,
            editable    : false,
            width       : 200,
            fixed       : true
        }, {
            header      : _('reviews.label_content'),
            dataIndex   : 'content',
            sortable    : true,
            editable    : false,
            width       : 200
        }, {
            header      : _('reviews.label_rating'),
            dataIndex   : 'rating',
            sortable    : true,
            editable    : false,
            width       : 150,
            fixed       : true,
            renderer    : this.renderRating
        }, {
            header      : _('reviews.label_active'),
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
        }, {
            header      : _('reviews.label_resource'),
            dataIndex   : 'resource_pagetitle_formatted',
            sortable    : false,
            hidden      : true,
            editable    : false
        }]
    });

    Ext.applyIf(config, {
        cm          : columns,
        id          : 'reviews-grid-reviews',
        url         : Reviews.config.connector_url,
        baseParams  : {
            action      : 'mgr/reviews/getlist'
        },
        autosave    : true,
        save_action : 'mgr/reviews/updatefromgrid',
        fields      : ['id', 'resource_id', 'rating', 'name', 'email', 'content', 'active', 'createdon', 'editedon', 'resource_pagetitle', 'resource_pagetitle_formatted'],
        paging      : true,
        pageSize    : MODx.config.default_per_page > 30 ? MODx.config.default_per_page : 30,
        grouping    : true,
        groupBy     : 'resource_pagetitle_formatted',
        singleText  : _('reviews.review'),
        pluralText  : _('reviews.reviews')
    });

    Reviews.grid.Reviews.superclass.constructor.call(this, config);
};

Ext.extend(Reviews.grid.Reviews, MODx.grid.Grid, {
    filterSearch: function(tf, nv, ov) {
        this.getStore().baseParams.query = tf.getValue();

        this.getBottomToolbar().changePage(1);
    },
    filterResource: function(tf, nv, ov) {
        this.getStore().baseParams.resource_id = tf.getValue();

        this.getBottomToolbar().changePage(1);
    },
    clearFilter: function() {
        this.getStore().baseParams.query        = '';
        this.getStore().baseParams.resource_id  = '';

        Ext.getCmp('reviews-filter-search').reset();
        Ext.getCmp('reviews-filter-resource').reset();

        this.getBottomToolbar().changePage(1);
    },
    getMenu: function() {
        var menu = [];

        menu.push({
            text    : '<i class="x-menu-item-icon icon icon-pencil"></i>' + _('reviews.review_update'),
            handler : this.updateReview,
            scope   : this
        }, '-');

        if (parseInt(this.menu.record.active) === 1) {
            menu.push({
                text    : '<i class="x-menu-item-icon icon icon-eye-slash"></i>' + _('reviews.review_deactivate'),
                handler : this.deactivateReview
            }, '-');
        } else {
            menu.push({
                text    : '<i class="x-menu-item-icon icon icon-eye"></i>' + _('reviews.review_activate'),
                handler : this.activateReview
            }, '-');
        }

        menu.push({
            text    : '<i class="x-menu-item-icon icon icon-times"></i>' + _('reviews.review_remove'),
            handler : this.removeReview,
            scope   : this
        });

        return menu;
    },
    createReview: function(btn, e) {
        if (this.createReviewWindow) {
            this.createReviewWindow.destroy();
        }

        this.createReviewWindow = MODx.load({
            xtype       : 'reviews-window-review-create',
            closeAction : 'close',
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });

        this.createReviewWindow.show(e.target);
    },
    updateReview: function(btn, e) {
        if (this.updateReviewWindow) {
            this.updateReviewWindow.destroy();
        }

        this.updateReviewWindow = MODx.load({
            xtype       : 'reviews-window-review-update',
            record      : this.menu.record,
            closeAction : 'close',
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });

        this.updateReviewWindow.setValues(this.menu.record);
        this.updateReviewWindow.show(e.target);
    },
    activateReview: function(btn, e) {
        MODx.msg.confirm({
            title       : _('reviews.review_activate'),
            text        : _('reviews.review_activate_confirm'),
            url         : Reviews.config.connector_url,
            params      : {
                action      : 'mgr/reviews/update',
                id          : this.menu.record.id,
                active      : 1
            },
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });
    },
    deactivateReview: function(btn, e) {
        MODx.msg.confirm({
            title       : _('reviews.review_deactivate'),
            text        : _('reviews.review_deactivate_confirm'),
            url         : Reviews.config.connector_url,
            params      : {
                action      : 'mgr/reviews/update',
                id          : this.menu.record.id,
                active      : 0
            },
            listeners   : {
                'success'   : {
                    fn          : this.refresh,
                    scope       : this
                }
            }
        });
    },
    removeReview: function(btn, e) {
        MODx.msg.confirm({
            title       : _('reviews.review_remove'),
            text        : _('reviews.review_remove_confirm'),
            url         : Reviews.config.connector_url,
            params      : {
                action      : 'mgr/reviews/remove',
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
    renderRating: function(d, c, e) {
        var stars   = [],
            rating = parseInt(d),
            ratings = Reviews.config.ratings.split('||');

        for (var i = parseInt(ratings[0]); i <= parseInt(ratings[1]); i++) {
            if (rating >= i) {
                stars.push('<i class="icon icon-star"></i>');
            } else {
                stars.push('<i class="icon icon-star-o"></i>');
            }
        }

        return String.format('{0} ({1} / {2})', stars.join(' '), d, parseInt(ratings[1]));
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

Ext.reg('reviews-grid-reviews', Reviews.grid.Reviews);

Reviews.window.CreateReview = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        width       : 500,
        autoHeight  : true,
        title       : _('reviews.review_create'),
        url         : Reviews.config.connector_url,
        baseParams  : {
            action      : 'mgr/reviews/create'
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
                    fieldLabel  : _('reviews.label_name'),
                    description : MODx.expandHelp ? '' : _('reviews.label_name_desc'),
                    name        : 'name',
                    anchor      : '100%',
                    allowBlank  : false
                }, {
                    xtype       : MODx.expandHelp ? 'label' : 'hidden',
                    html        : _('reviews.label_name_desc'),
                    cls         : 'desc-under'
                }]
            }, {
                columnWidth : .15,
                items       : [{
                    xtype       : 'checkbox',
                    fieldLabel  : _('reviews.label_active'),
                    description : MODx.expandHelp ? '' : _('reviews.label_active_desc'),
                    name        : 'active',
                    inputValue  : 1
                }, {
                    xtype       : MODx.expandHelp ? 'label' : 'hidden',
                    html        : _('reviews.label_active_desc'),
                    cls         : 'desc-under'
                }]
            }]
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('reviews.label_email'),
            description : MODx.expandHelp ? '' : _('reviews.label_email_desc'),
            name        : 'email',
            anchor      : '100%',
            regex       : /^(([a-zA-Z0-9_\+\.\-]+)@([a-zA-Z0-9_.\-]+)\.([a-zA-Z]{2,5}){1,25})$/
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('reviews.label_email_desc'),
            cls         : 'desc-under'
        }, {
            layout      : 'column',
            defaults    : {
                layout      : 'form',
                labelSeparator : ''
            },
            items       : [{
                columnWidth : .5,
                items       : [{
                    xtype       : 'reviews-combo-resource',
                    fieldLabel  : _('reviews.label_resource'),
                    description : MODx.expandHelp ? '' : _('reviews.label_resource_desc'),
                    name        : 'resource_id',
                    anchor      : '100%'
                }, {
                    xtype       : MODx.expandHelp ? 'label' : 'hidden',
                    html        : _('reviews.label_resource_desc'),
                    cls         : 'desc-under'
                }]
            }, {
                columnWidth : .5,
                items       : [{
                    xtype       : 'reviews-combo-rating',
                    fieldLabel  : _('reviews.label_rating'),
                    description : MODx.expandHelp ? '' : _('reviews.label_rating_desc'),
                    name        : 'rating',
                    anchor      : '100%',
                    allowBlank  : false
                }, {
                    xtype       : MODx.expandHelp ? 'label' : 'hidden',
                    html        : _('reviews.label_rating_desc'),
                    cls         : 'desc-under'
                }]
            }]
        }, {
            xtype       : 'textarea',
            fieldLabel  : _('reviews.label_content'),
            description : MODx.expandHelp ? '' : _('reviews.label_content_desc'),
            name        : 'content',
            anchor      : '100%',
            listeners   : {
                afterrender : {
                    fn          : function(event) {
                        if (Reviews.loadRTE) {
                            Reviews.loadRTE(event.id, {
                                plugins     : MODx.config['reviews.editor_plugins'],
                                menubar     : MODx.config['reviews.editor_menubar'],
                                statusbar   : parseInt(MODx.config['reviews.editor_statusbar']) === 1,
                                toolbar1    : MODx.config['reviews.editor_toolbar1'],
                                toolbar2    : MODx.config['reviews.editor_toolbar2'],
                                toolbar3    : MODx.config['reviews.editor_toolbar3'],
                                height      : 150
                            });
                        }
                    }
                }
            }
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('reviews.label_content_desc'),
            cls         : 'desc-under'
        }]
    });

    Reviews.window.CreateReview.superclass.constructor.call(this, config);
};

Ext.extend(Reviews.window.CreateReview, MODx.Window);

Ext.reg('reviews-window-review-create', Reviews.window.CreateReview);

Reviews.window.UpdateReview = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        width       : 500,
        autoHeight  : true,
        title       : _('reviews.review_update'),
        url         : Reviews.config.connector_url,
        baseParams  : {
            action      : 'mgr/reviews/update'
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
                    fieldLabel  : _('reviews.label_name'),
                    description : MODx.expandHelp ? '' : _('reviews.label_name_desc'),
                    name        : 'name',
                    anchor      : '100%',
                    allowBlank  : false
                }, {
                    xtype       : MODx.expandHelp ? 'label' : 'hidden',
                    html        : _('reviews.label_name_desc'),
                    cls         : 'desc-under'
                }]
            }, {
                columnWidth : .15,
                items       : [{
                    xtype       : 'checkbox',
                    fieldLabel  : _('reviews.label_active'),
                    description : MODx.expandHelp ? '' : _('reviews.label_active_desc'),
                    name        : 'active',
                    inputValue  : 1
                }, {
                    xtype       : MODx.expandHelp ? 'label' : 'hidden',
                    html        : _('reviews.label_active_desc'),
                    cls         : 'desc-under'
                }]
            }]
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('reviews.label_email'),
            description : MODx.expandHelp ? '' : _('reviews.label_email_desc'),
            name        : 'email',
            anchor      : '100%',
            regex       : /^(([a-zA-Z0-9_\+\.\-]+)@([a-zA-Z0-9_.\-]+)\.([a-zA-Z]{2,5}){1,25})$/,
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('reviews.label_email_desc'),
            cls         : 'desc-under'
        }, {
            layout      : 'column',
            defaults    : {
                layout      : 'form',
                labelSeparator : ''
            },
            items       : [{
                columnWidth : .5,
                items       : [{
                    xtype       : 'reviews-combo-resource',
                    fieldLabel  : _('reviews.label_resource'),
                    description : MODx.expandHelp ? '' : _('reviews.label_resource_desc'),
                    name        : 'resource_id',
                    anchor      : '100%'
                }, {
                    xtype       : MODx.expandHelp ? 'label' : 'hidden',
                    html        : _('reviews.label_resource_desc'),
                    cls         : 'desc-under'
                }]
            }, {
                columnWidth : .5,
                items       : [{
                    xtype       : 'reviews-combo-rating',
                    fieldLabel  : _('reviews.label_rating'),
                    description : MODx.expandHelp ? '' : _('reviews.label_rating_desc'),
                    name        : 'rating',
                    anchor      : '100%',
                    allowBlank  : false
                }, {
                    xtype       : MODx.expandHelp ? 'label' : 'hidden',
                    html        : _('reviews.label_rating_desc'),
                    cls         : 'desc-under'
                }]
            }]
        }, {
            xtype       : 'textarea',
            fieldLabel  : _('reviews.label_content'),
            description : MODx.expandHelp ? '' : _('reviews.label_content_desc'),
            name        : 'content',
            anchor      : '100%',
            listeners   : {
                afterrender : {
                    fn          : function(event) {
                        if (Reviews.loadRTE) {
                            Reviews.loadRTE(event.id, {
                                plugins     : MODx.config['reviews.editor_plugins'],
                                menubar     : MODx.config['reviews.editor_menubar'],
                                statusbar   : parseInt(MODx.config['reviews.editor_statusbar']) === 1,
                                toolbar1    : MODx.config['reviews.editor_toolbar1'],
                                toolbar2    : MODx.config['reviews.editor_toolbar2'],
                                toolbar3    : MODx.config['reviews.editor_toolbar3'],
                                height      : 150
                            });
                        }
                    }
                }
            }
        }, {
            xtype       : MODx.expandHelp ? 'label' : 'hidden',
            html        : _('reviews.label_content_desc'),
            cls         : 'desc-under'
        }]
    });

    Reviews.window.UpdateReview.superclass.constructor.call(this, config);
};

Ext.extend(Reviews.window.UpdateReview, MODx.Window);

Ext.reg('reviews-window-review-update', Reviews.window.UpdateReview);

Reviews.combo.Rating = function(config) {
    config = config || {};

    var data = [];
    var ratings = Reviews.config.ratings.split('||');

    for (var i = parseInt(ratings[0]); i <= parseInt(ratings[1]); i++) {
        data.push([i, i + ' (' + _('reviews.rating_' + i) + ')']);
    }

    Ext.applyIf(config, {
        store       : new Ext.data.ArrayStore({
            mode        : 'local',
            fields      : ['rating', 'label'],
            data        : data
        }),
        hiddenName  : 'rating',
        valueField  : 'rating',
        displayField : 'label',
        mode        : 'local'
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