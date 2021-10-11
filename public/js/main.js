window.addEventListener("load", function(){
    console.log("Loaded")
    $('#animes').DataTable({
    "pageLength": 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "responsive": true,
    // "paging": false
    })
});
