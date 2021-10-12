window.addEventListener("load", function(){
    console.log("Loaded")
    $('#animes').DataTable({
    "pageLength": 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "responsive": true,
    // "paging": false
    });
});
$('document').ready(function(){
    $(function(){
        console.log($('.toggle-class'));
        $('.toggle-class').change(function() {
            console.log("Function loaded")
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
