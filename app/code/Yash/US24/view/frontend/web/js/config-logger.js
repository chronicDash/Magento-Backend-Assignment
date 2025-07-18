define([], function () {
    return function (config) {
        console.log('%c Magento Store Config:', 'color: green; font-weight: bold');
        console.log('Sales Email:', config.sales_email);
        console.log('Check/Money Order Enabled:', config.checkmo_enabled);
    };
});