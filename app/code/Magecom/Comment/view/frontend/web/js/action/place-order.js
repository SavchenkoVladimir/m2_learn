define(
    [
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/model/url-builder',
        'Magento_Customer/js/model/customer',
        'Magento_Checkout/js/model/place-order',
        'Magecom_Comment/js/view/comment-checkout-form'
    ],
    function (quote, urlBuilder, customer, placeOrderService, CommentForm) {
        'use strict';

        return function (paymentData, messageContainer) {
            var serviceUrl, payload;
            var commentForm = new CommentForm();
            var comment = commentForm.getComment();

            payload = {
                cartId: quote.getQuoteId(),
                billingAddress: quote.billingAddress(),
                paymentMethod: paymentData,
                checkoutComment: comment.comment_textarea
            };

            if (customer.isLoggedIn()) {
                serviceUrl = urlBuilder.createUrl('/carts/mine/payment-information', {});
            } else {
                serviceUrl = urlBuilder.createUrl('/guest-carts/:quoteId/payment-information', {
                    quoteId: quote.getQuoteId()
                });
                payload.email = quote.guestEmail;
            }

            return placeOrderService(serviceUrl, payload, messageContainer);
        };
    }
);
