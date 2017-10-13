define([
    'Magento_Ui/js/form/form',
    'uiRegistry'
], function (
    Component,
    registry
) {
    'use strict';
    return Component.extend({
        initialize: function () {
            this._super();
            this.source = registry.get('checkoutProvider');

            return this;
        },

        getComment: function () {
            this.source.set('params.invalid', false);
            this.source.trigger('customCheckoutForm.data.validate');

            if (!this.source.get('params.invalid')) {
                var checkoutComment = this.source.get('customCheckoutForm');

                return checkoutComment;
            }

            return false;
        }
    });
});