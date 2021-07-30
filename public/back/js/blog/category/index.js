let modal_add_category = $("#add_category")
let form_add_category = document.querySelector("#formAddCategory")

$("#liste_category").DataTable({
    language: {
        processing:     "Traitement en cours...",
        search:         "Rechercher&nbsp;:",
        lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
        info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable:     "Aucune donnée disponible dans le tableau",
        paginate: {
            first:      "Premier",
            previous:   "Pr&eacute;c&eacute;dent",
            next:       "Suivant",
            last:       "Dernier"
        },
        aria: {
            sortAscending:  ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    }
});

form_add_category.querySelector(".btn-primary").addEventListener('click', (e) => {
    e.preventDefault()
    let form = $("#formAddCategory")
    let url = '/api/blog/category'
    let data = form.serializeArray()

    form_add_category.querySelector(".btn-primary").setAttribute("data-kt-indicator", "on")

    $.ajax({
        url: url,
        method: "POST",
        data: data,
        success: (data) => {
            form_add_category.querySelector(".btn-primary").removeAttribute('data-kt-indicator')
            Swal.fire({
                text: `La Catégorie ${data.category.title} à été ajouter`,
                icon: "success",
                buttonsStyling: !1,
                confirmButtonText: "Ok ",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            }).then((function (o) {
                if(o.isConfirmed) {
                    modal_add_category.modal('hide')
                    $('#liste_category tbody').prepend(data.html).hide().fadeIn()
                }
            }))
        },
        error: (err) => {
            form_add_category.querySelector(".btn-primary").removeAttribute('data-kt-indicator')
            console.error(err)
        }
    })
})
