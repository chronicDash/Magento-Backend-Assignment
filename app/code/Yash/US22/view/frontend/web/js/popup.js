define(['jquery', 'Magento_Ui/js/modal/modal', 'text!Yash_US22/template/popup.html'], function ($, modal, template) {
    return function (settings) {
        const timeout = settings.timeout;
        const content = settings.content;
        
        const options = {
            type : 'popup',
            responsive : true,
            autoOpen : true,
            modalClass: 'us22',
            popupTpl: template
        };

        setTimeout(function () {
            $('<div />').html(content).modal(options);
        }, timeout * 1000);
    }
});