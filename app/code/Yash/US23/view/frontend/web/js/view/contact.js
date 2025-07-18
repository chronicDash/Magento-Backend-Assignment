define([
    'Magento_Ui/js/form/form',
    'Magento_Checkout/js/model/step-navigator',
    'mage/translate',
    'underscore'
], function (Component, stepNavigator, $t, _) {
    return Component.extend({
        defaults : {
            template: 'Yash_US23/contact',
            visible: true
        },

        initialize: function () {
            this._super();
            stepNavigator.registerStep(
                'contact',
                'contact',
                $t('Contact'),
                this.visible,
                _.bind(this.navigate, this),
                this.sortOrder
            );
        },

        initObservable: function () {
            this._super().observe(['visible']);

            return this;
        },

        navigate: function (step) {
            step && step.isVisible(true);
        }, 
        setContactInfo: function () {
            stepNavigator.next();
        }
    });
});