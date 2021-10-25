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

document.querySelectorAll(".editCategory").forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault()
        let id = btn.dataset.categoryId

        $.ajax({
            url: `/api/download/category/${id}`,
            success: (data) => {
                console.log(data)
                let modal = $("#editCategory")

                modal.find('.modal-title').html(`Edition de la catégorie <strong>${data.title}</strong>`)
                $('.formTitle').val(`${data.title}`)
                modal.find('#formEditCategory').attr('action', `/api/download/category/${data.id}`)
                modal.modal('show')
            }
        })
    })
})

document.querySelectorAll('.deleteCategory').forEach(btn => {
    btn.addEventListener('click', e => {
        e.preventDefault()
        let id = btn.dataset.categoryId
        console.log(btn.parentNode.parentNode)

        $.ajax({
            url: `/api/download/category/${id}`,
            method: 'DELETE',
            success: data => {
                console.log(data)
                btn.parentNode.parentNode.style.display = 'none'
                toastr.success("La catégorie à été supprimer avec succès")
            }
        })
    })
})
