(function($){

    "use strict";

    $(".inputtags").tagsinput('items');

    $(document).ready(function() {
        $('#example1').DataTable();
    });

    $('.icp_demo').iconpicker();

    tinymce.init({
        selector: ".editor",
        height: "300",
    });

    $('.datepicker').datepicker({ format: "yyyy/mm/dd" });
    $('.timepicker').timepicker({
        icons:
        {
            up: 'fa fa-angle-up',
            down: 'fa fa-angle-down'
        }
    });

})(jQuery);
