define(
    [
        'Magecom_Comment/js/view/comment-checkout-form',
        'uiRegistry'
    ],
    function (CommentForm, registry) {
        'use strict';
        return {

            validate: function() {
                var comment = new CommentForm();

                return Boolean(comment.getComment());
            }
        }
    }
);