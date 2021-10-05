define(["jquery", "mage/url", "mage/translate", "jgrowl"], function ($, url) {
    "use strict";
    var config = window["checkout"]["add_to_cart_notification"];
    var mixin = {
        /**
         * @param {jQuery} form
         */
        ajaxSubmit: function (form) {
            var productId = form.find('input[name="product"]').val();
            var self = this;
            this._super(form);
            self.element.find(".message.error").remove();
            $.when(this.productPromise(productId), this.cartPromise()).then(
                    function (data) {
                        var product = data[0];
                        var title = $.mage.__("Added To Cart");
                        var modalImage = '<img class="notification-image" src="' + product["image"] + '" alt="' + product["name"] + '" width="80" height="80">';
                        var message = $.mage.__('<p>You added %1 to your <a href="%2">shopping cart</a>.</p><a class="primary action" href="%3">Proceed to Checkout</a>')
                                .replace("%1", product["name"])
                                .replace("%2", product["cart_url"])
                                .replace("%3", url.build("checkout/index"));
                        var modalCloseBtn = '<button class="action-close"><span>' + $.mage.__("Close") + "</span></button>";
                        // TODO: get width and height from product image xml config
                        var modalImage = '<img class="notification-image" src="' + product["image"] + '" alt="' + product["name"] + '" width="80" height="80">';
//                        console.log(modalImage);
                        if (config["notificationTemplate"] == 1) {
                            $("body").append(
                                    '<div id="add_to_cart_notification" role="dialog" class="modal-custom modal-added-to-cart">' +
                                    '<div class="modal-header">' +
                                    modalCloseBtn +
                                    "</div>" +
                                    '<div class="modal-content"><div class="product-image">' +
                                    modalImage +
                                    '</div><div class="product-content">' +
                                    '<div class="block-title">' +
                                    '<strong id="add_to_cart_notification-heading" role="heading" aria-level="2">' +
                                    title +
                                    "</strong></div>" +
                                    '<div class="notification-message">' +
                                    message +
                                    "</div>" +
                                    "</div></div></div>"
                                    );
                        } else {
                            $.jGrowl(message, {life: config["notificationLifetime"]});
                        }
//                        console.log(config["notificationLifetime"]);
//                        console.log(url.build('checkout/index'));
//                        console.log(data);
//                        
// Sample 2
//                     $.jGrowl("Stick this!", { sticky: true });
// // Sample 3
//                     $.jGrowl("A message with a header", { header: 'Important' });
// // Sample 4
//                     $.jGrowl("A message that will live a little longer.", { life: 10000 });
// // Sample 5
//                     $.jGrowl("A message with a beforeOpen callback and a different opening animation.", {
//                         beforeClose: function(e,m) {
//                             alert('About to close this notification!');
//                         },
//                         animateOpen: {
//                             height: 'show'
//                         }
//                     });                   

                        $("#add_to_cart_notification")
                                .find(".action-close")
                                .click(function () {
                                    self.removeNotification();
                                });

                        setTimeout(function () {
                            self.removeNotification();
                        }, config["notificationLifetime"]);
                    },
                    function (messages) {
                        if (self.element.find("div.mage-error").filter(":visible").length > 0) {
                            return;
                        }

                        var button = self.element.find("button.tocart");
                        messages.forEach(function (message) {
                            button.after(
                                    '<div class="message info message-add-to-cart"><div>' +
                                    message.text +
                                    "</div></div>"
                                    );
                        });
                    }
            );
        },

        removeNotification: function () {
            $("#add_to_cart_notification").fadeOut(150, function () {
                $(this).remove();
            });
        },

        productPromise: function (productId) {
            return $.get({
                url: window["BASE_URL"] + "/cart_notification/data/product/product_id/" + productId,
                cache: true
            });
        },

        cartPromise: function () {
            var dfd = $.Deferred();
            $(document).on("ajaxSuccess", function (event, request, settings) {
                if (settings.url.indexOf("/checkout/cart/add") === -1) {
                    return;
                }
                if (request.responseJSON.error_messages) {
                    dfd.reject(request.responseJSON.error_messages);
                    $(document).off("ajaxSuccess");
                    return;
                }
                dfd.resolve();
                $(document).off("ajaxSuccess");
            });
            return dfd.promise();
        }
    };

    return function (target) {
        if (!config["enabled"]) {
            return target;
        }
        $.widget("harriswebworks.catalogAddToCart", target, mixin);
        return $.harriswebworks.catalogAddToCart;
    };
});
