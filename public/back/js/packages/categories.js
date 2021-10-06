jQuery(document).ready(function () {
    $("#liste_categories").DataTable();
});

document.querySelectorAll('.listSubCategory').forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault()
        let id = btn.dataset.categoryId
        $.ajax({
            url: '/api/download/list/category/'+id+'/subcategories',
            success: (data) => {
                console.log(data)
                let modal = $("#list_sub_categories")

                modal.find('.modal-title').html(`Liste des sous catégories de la catégorie <strong>${data.category.title}</strong>`)
                modal.find('.modal-body').html(`${data.content}`)
                modal.modal('show')
            },
            error: () => {
                console.log("Erreur !!!!")
            }
        })
    })
})
