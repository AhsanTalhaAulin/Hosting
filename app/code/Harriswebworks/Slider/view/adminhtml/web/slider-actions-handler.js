/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/*jshint browser:true jquery:true expr:true*/
define([
    'jquery',
    'jquery/ui',
    'Magento_Ui/js/modal/modal',
    'mage/backend/validation',
    'mage/adminhtml/events'
], function ($) {
    'use strict';

    return {
        
        $urlTypeElement: '[data-action=slider-item-page-type]',
        $formId: '#edit_form',
        options: {
            customRoute: '.field-custom_route',
            categorySelect: '.field-category_id',
            cmsPageSelect: '.field-cms_page_id'
        },
        activeUrlType: 0,

        /**
         * Constructor component
         * @param {Object} data - this backend data
         */
        'Harriswebworks_Slider/slider-actions-handler': function (data) {
            this.initActions();
        },

        /**
         * Initialize dependable field slide action
         */
        initActions: function () {
            var self = this;

            this._initFormValidation();
                        this._initUrlTypeHandler();
                        this._toggleSelector();

                        $(this.$urlTypeElement).trigger('change');
        },

        /**
         * Initialize field toggling based on provided value.
         *
         * @private
         */
        _initUrlTypeHandler: function () {
            var self = this;

            $(this.$urlTypeElement).on('change', function (evt) {
                self.activeUrlType = $(this).val();
                self._toggleSelector();
            });
        },

        /**
         * Initialize form validation
         *
         * @private
         */
        _initFormValidation: function () {
            $(this.$formId).form()
                .validation({
                    validationUrl: '',
                    highlight: function (element) {
                        var detailsElement = $(element).closest('details');
                        if (detailsElement.length && detailsElement.is('.details')) {
                            var summaryElement = detailsElement.find('summary');
                            if (summaryElement.length && summaryElement.attr('aria-expanded') === "false") {
                                summaryElement.trigger('click');
                            }
                        }

                        $(element).trigger('highlight.validate');
                    }
                });
        },

       

       

        _toggleSelector: function () {
            var activeSelector = null,
                self = this;

            switch (parseInt(self.activeUrlType)) {
                case 0:
                    activeSelector = self.options.cmsPageSelect;
                    break;
                case 1:
                    activeSelector = self.options.categorySelect;
                    break;
                case 2:
                    activeSelector = self.options.customRoute;
                    break;
                default:
                    activeSelector = self.options.customRoute;
                    break;
            }

            $.each(this.options, function (index, element) {
                self.disableElement($(element));
            });

            self.enableElement($(activeSelector));
        },

        disableElement: function (elm) {
            elm.addClass('ignore-validate').prop('disabled', true);
            elm.hide();
        },

        enableElement: function (elm) {
            elm.removeClass('ignore-validate').prop('disabled', false);
            elm.show();
        },

        stopEvent: function (e, stopPropagation) {
            e.preventDefault ? e.preventDefault() : (e.returnValue = false);
            stopPropagation && e.stopPropagation && e.stopPropagation();
        }
    };
});

