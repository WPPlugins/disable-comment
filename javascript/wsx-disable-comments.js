/**
 * Wrapper function to safely use $
 */
function wsxdcWrapper($) {
    var wsxdc = {

        /**
         * Main entry point
         */
        init: function () {
            wsxdc.prefix = 'adc_';
            wsxdc.templateURL = $('#template-url').val();
            wsxdc.ajaxPostURL = $('#ajax-post-url').val();

            wsxdc.registerEventHandlers();
        },

        /**
         * Registers event handlers
         */
        registerEventHandlers: function () {
        }
    }; // end wsxdc

    $(document).ready(wsxdc.init);

} // end wsxdcWrapper()

wsxdcWrapper(jQuery);
