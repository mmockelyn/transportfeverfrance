
let status = {
    0: {"title": "Non publier", "class": "danger"},
    1: {"title": "Publier", "class": "success"},
}
$("#liste_article").DataTable({
    "columnDefs": [
        {
            "render": function ( data, type, row ) {
                return '<span class="ms-2 badge badge-light-' + status[data]['class'] + ' fw-bold">' + status[data]['title'] + '</span>';
            },
            "targets": 2
        },
        {
            "render": function ( data, type, row ) {
                return '<span class="ms-2 badge badge-circle badge-primary fw-bold">' + data + '</span>';
            },
            "targets": 2
        }
    ]
})
