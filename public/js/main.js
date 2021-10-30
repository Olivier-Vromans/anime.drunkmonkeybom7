//event lister to check if the page is loaded
window.addEventListener("load", function(){
    console.log("Loaded")
    //make the datatable
    let table = $('#animes').DataTable({
        //make the page length 10
        "pageLength": 10,
        //create a page length menu
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        //make the datatable responsive
        "responsive": true,
        //setup the columndefs
        columnDefs: [ {
            targets: 3,
            render: function ( data, type, row ) {
                return data.substr( 0, 75 );
            }
        }]
    });
});
$(function( $ ){
    //listen to the js-switch if it changes
    $('.js-switch').change(function () {
        //if true than false, if false than true statement
        let status = $(this).prop('checked') === true ? 1 : 0;
        //get the animeid
        let animeid = $(this).data('id');

        //setup ajax with CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //execute the ajax function
        $.ajax({
            //set all properties
            type: "POST",
            dataType: "json",
            url: "/anime/changeStatus",
            data: {'status': status, 'anime_id': animeid},
            success: function (data) {
            }
        });
    });
});
