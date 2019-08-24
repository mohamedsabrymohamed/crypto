/*global $,jQuery,top,WOW */
(function ($) {
    "use strict";
    $(document).ready(function () {

        $('.dataTable').DataTable();
        
        $('.close-pop').on('click', function () {
           var popup = $('.popup');
            popup.hide();
        });

        $('.show-canel-pop').on('click', function () {
            var canel_pop = $('#canel-pop'),
                bill_id = $(this).parents('td').siblings('.bill-id').data('id'),
                hidden_input = $('#bill-input-cancel-id'),
                pop_cancelation_reason = $('#pop_cancelation_reason');

            if (hidden_input.length > 0 ) {
                hidden_input.val(bill_id);
            }
            
            if( $(this).hasClass('cancel-reason') ) {
                pop_cancelation_reason.text( $(this).data('canecl-reason') );
                console.log('yes has class');
            }
            
            canel_pop.show();
        });
        

        if( $('.popup-link').length > 0 ) {
            $('.popup-link').magnificPopup({
              type: 'image'
            });
        }
        

    }); /*End Document Ready Func */
}(jQuery));