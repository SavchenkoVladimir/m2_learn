define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/additional-validators',
        'Magecom_Comment/js/model/comment-validator'
    ],
    function (Component, additionalValidators, commentValidator) {
        'use strict';
        additionalValidators.registerValidator(commentValidator);
        return Component.extend({});
    }
);