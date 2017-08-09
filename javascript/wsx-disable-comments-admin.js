/**
 * Wrapper function to safely use $
 */
function wsxdcAdminWrapper($) {
    var wsxdcAdmin = {

        /**
         * Main entry point
         */
        init: function () {
        }

    }; // end wsxdcAdmin

    $(document).ready(wsxdcAdmin.init);

} // end wsxdcAdminWrapper()

wsxdcAdminWrapper(jQuery);
