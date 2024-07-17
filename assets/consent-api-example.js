jQuery(document).ready(function ($) {
    var contentId = wpConsentExampleData.contentId;
    var examplePluginContainers = $('#' + contentId + ' .category-container');

    /**
     * Listen for consent change events.
     */
    console.log("load plugin example");
    document.addEventListener("wp_listen_for_consent_change", function (e) {
        console.log('listen for consent events');
        var changedConsentCategory = e.detail;
        console.log(changedConsentCategory);
        examplePluginContainers.each(function () {
            var container = $(this);
            var consentCategory = container.data('consentcategory');
            for (var key in changedConsentCategory) {
                if (changedConsentCategory.hasOwnProperty(key)) {
                    if (key === consentCategory && changedConsentCategory[key] === 'allow') {
                        console.log("set " + consentCategory + " cookie on user actions");
                        activateConsent(consentCategory);
                    }
                }
            }
        });
    });

    /**
     * Do stuff as soon as the consent type is defined.
     */
    $(document).on("wp_consent_type_defined", function (consentData) {
        examplePluginContainers.each(function () {
            var container = $(this);
            var consentCategory = container.data('consentcategory');
            activateMyCookies(consentCategory);
        });
    });

    /**
     * Function to activate consent for a specified category.
     *
     * @param {string} consentCategory - The consent category.
     */
    function activateConsent(consentCategory) {
        console.log("fire " + consentCategory);
        $('#' + contentId + ' .' + consentCategory + '-content .no-consent-given').hide();
        $('#' + contentId + ' .' + consentCategory + '-content .consent-given').show();
    }

    /**
     * Function to handle consent-defined event.
     *
     * @param {string} consentCategory - The consent category.
     */
    function activateMyCookies(consentCategory) {
        if (wp_has_consent(consentCategory)) {
            console.log("do " + consentCategory + " cookie stuff");
            activateConsent(consentCategory);
        } else {
            console.log("no " + consentCategory + " cookies please");
        }
    }

    // Check if we need to wait for the consent type to be set.
    if (!window.waitfor_consent_hook) {
        console.log("we don't have to wait for the consent type, we can check the consent level right away!");
        examplePluginContainers.each(function () {
            var container = $(this);
            var consentCategory = container.data('consentcategory');
            if (wp_has_consent(consentCategory)) {
                activateConsent(consentCategory);
                console.log("set " + consentCategory + " stuff now!");
            } else {
                console.log("No " + consentCategory + " stuff please!");
            }
        });
    }
});
