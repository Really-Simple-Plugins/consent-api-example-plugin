jQuery(document).ready(function ($) {
    var consentCategory = $('#example-plugin-content').data('consentcategory');
    console.log("checking consent for category "+consentCategory);
    /**
     * cookie placing plugin can listen to consent change
     *
     */
    console.log("load plugin example");
    document.addEventListener("wp_listen_for_consent_change", function (e) {
        console.log('listen for consent events');
        var changedConsentCategory = e.detail;
        console.log(changedConsentCategory);
        for (let key in changedConsentCategory) {
            if (changedConsentCategory.hasOwnProperty(key)) {
                if (key === consentCategory && changedConsentCategory[key] === 'allow') {
                    console.log("set "+consentCategory+" cookie on user actions");
                    activateConsent();
                }
            }
        }
    });

    /**
     * Or do stuff as soon as the consenttype is defined
     */
    $(document).on("wp_consent_type_defined", activateMyCookies);

    function activateMyCookies(consentData) {
        console.log("check service");
        if (wp_has_consent(consentCategory, 'service')) {
            console.log("do "+consentCategory+" cookie stuff");
        } else {
            console.log("no "+consentCategory+" cookies please");
        }

        console.log("check category")
        //your code here
        if (wp_has_consent(consentCategory)) {
            console.log("do "+consentCategory+" cookie stuff");
        } else {
            console.log("no "+consentCategory+" cookies please");
        }
    }

    //check if we need to wait for the consenttype to be set
    if (!window.waitfor_consent_hook) {
        console.log("we don't have to wait for the consent type, we can check the consent level right away!");
        if (wp_has_consent(consentCategory)) {
            activateConsent();
            console.log("set "+consentCategory+" stuff now!");
        } else {
            console.log("No "+consentCategory+" stuff please!");
        }
    }

    /**
     * Do stuff that normally would do stuff like tracking personal user data etc.
     */

    function activateConsent() {
        console.log("fire "+consentCategory);
        $('#example-plugin-content .functional-content').hide();
        $('#example-plugin-content .marketing-content').show();
    }
});
