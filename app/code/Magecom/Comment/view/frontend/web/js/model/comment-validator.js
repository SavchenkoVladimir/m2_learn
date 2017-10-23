define(
    [
        'Magecom_Comment/js/view/comment-checkout-form'
    ],
    function (CommentForm) {
        'use strict';
        return {

            validate: function() {
                var comment = new CommentForm();

                return Boolean(comment.getComment());
            }
        }
    }
);