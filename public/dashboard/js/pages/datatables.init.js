$(function () {
    let processing_val      = $('html').attr('lang') == 'ar' ? "جارٍ التحميل ..." : "Processing ..."
    let lengthMenu_val      = $('html').attr('lang') == 'ar' ? "أظهر _MENU_ مدخلات" : "Show _MENU_ entry"
    let zeroRecords_val     = $('html').attr('lang') == 'ar' ? "لم يعثر على أية سجلات" : "No records found"
    let info_val            = $('html').attr('lang') == 'ar' ? "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل" : "Show _START_ to _END_ out of _TOTAL_ entry"
    let infoEmpty_val       = $('html').attr('lang') == 'ar' ? "يعرض 0 إلى 0 من أصل 0 سجل" : "Show 0 to 0 out of 0 records"
    let infoFiltered_val    = $('html').attr('lang') == 'ar' ? "(منتقاة من مجموع _MAX_ مُدخل)" : "(Selected from the sum of _MAX_ entered)"
    let first_val           = $('html').attr('lang') == 'ar' ? "الأول" : "The first"
    let search_val          = $('html').attr('lang') == 'ar' ? "ابحث : " : "Search : "
    let previous_val        = $('html').attr('lang') == 'ar' ? "السابق" : "Previous"
    let next_val            = $('html').attr('lang') == 'ar' ? "التالي" : "Next"
    let last_val            = $('html').attr('lang') == 'ar' ? "الأخير" : "The last"
    
    $('#datatable, #datatable2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        // "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "buttons": false,
        "responsive": true,
        "scrollX": true,
        "language": {
            "sProcessing": processing_val,
            "sLengthMenu": lengthMenu_val,
            "sZeroRecords": zeroRecords_val,
            "sInfo": info_val,
            "sInfoEmpty": infoEmpty_val,
            "sInfoFiltered": infoFiltered_val,
            "sInfoPostFix": "",
            "sSearch": search_val,
            "sUrl": "",
            "oPaginate": {
                "sFirst": first_val,
                "sPrevious": previous_val,
                "sNext": next_val,
                "sLast": last_val,
            }
        }
    });
});