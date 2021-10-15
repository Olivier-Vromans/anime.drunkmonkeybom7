window.addEventListener("load", function(){
    console.log("Loaded")
    let table = $('#animes').DataTable({
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "responsive": true,
        columnDefs: [ {
            targets: 2,
            render: function ( data, type, row ) {
                return data.substr( 0, 75 );
            }
        }]
    });
    $(function(){
        $('.toggle-class').change(function() {
            let status = $(this).prop('checked') == true ? 1 : 0;
            let anime_id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changeStatus',
                data: {'status': status, 'anime_id': anime_id},
                success: function(data){
                    console.log(data.success)
                }
            });
        })
    })
});
