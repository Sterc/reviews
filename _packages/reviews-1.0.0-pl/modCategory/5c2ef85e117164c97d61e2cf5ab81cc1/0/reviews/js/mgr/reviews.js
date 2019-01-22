var Reviews = function(config) {
    config = config || {};

    Reviews.superclass.constructor.call(this, config);
};

Ext.extend(Reviews, Ext.Component, {
    page    : {},
    window  : {},
    grid    : {},
    tree    : {},
    panel   : {},
    combo   : {},
    config  : {}
});

Ext.reg('reviews', Reviews);

Reviews = new Reviews();