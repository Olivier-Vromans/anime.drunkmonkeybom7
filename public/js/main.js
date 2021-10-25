window.addEventListener("load", function(){
    console.log("Loaded")
    let table = $('#animes').DataTable({
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "responsive": true,
        columnDefs: [ {
            targets: 3,
            render: function ( data, type, row ) {
                return data.substr( 0, 75 );
            }
        }]
    });
});
$(function( $ ){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let animeid = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/anime/changeStatus",
            data: {'status': status, 'anime_id': animeid},
            success: function (data) {
                console.log(data.message);
            }
        });
    });
});
