$(document).ready(function(){

    $(".deleteRecord").click(function(e) {
        e.preventDefault() // Don't post the form, unless confirmed
        var id = $(this).data('id');
        var deleteRoute = $(this).data('action');
        swal({
                title: 'هل أنت متأكد ?',
                text: "بعد اتمام عملية الحذف لن يمكنك اعادتها مره اخرى",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم, أريد الحذف!'

        },
        function (){
            $(e.target).closest('form').submit() // Post the surrounding form
        });
    });

});


