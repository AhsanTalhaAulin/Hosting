var config = {
    map: {
        '*': {
            jgrowl: 'Harriswebworks_AddToCartNotification/js/catalog/jquery.jgrowl.min',

        }
    },
    config: {
        mixins: {
            "Magento_Catalog/js/catalog-add-to-cart": {
                "Harriswebworks_AddToCartNotification/js/catalog/add-to-cart-mixin": true
            }
        }
    }
};
