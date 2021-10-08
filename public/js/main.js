window.addEventListener("load", function(){
    $('#appointments tbody').on('click', '.btnedit', function (e) {

        let table = $('#anime').DataTable();
        let tr = $(this).closest('tr');

        // If its .child tr then get the parent row
        if ($(tr).hasClass('child')) {
            tr = $(tr).prev('tr.parent');
        }});
    console.log("Loaded")
    $('#anime').DataTable({
    "pageLength": 10,
    "responsive": true,
    "autowidth": true,
    })
});
