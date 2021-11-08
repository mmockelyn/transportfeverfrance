$("#liste_pages").DataTable({
    language: {
        url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json'
    },
});

document.querySelectorAll('.deletePage').forEach(btn => {
    btn.addEventListener('click', e => {
        e.preventDefault()

        let id = btn.dataset.id

        btn.setAttribute('data-kt-indicator', 'on')

        $.ajax({
            url: '/api/back/settings/cms/'+id,
            method: "DELETE",
            success: () => {
                btn.removeAttribute('data-kt-indicator')
                toastr.success("La page à été supprimer avec succès", "Suppression effecuer")
                btn.parentNode.parentNode.parentNode.parentNode.style.display = 'none'
            }
        })
    })
})
