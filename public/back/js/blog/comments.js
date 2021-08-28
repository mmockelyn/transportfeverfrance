$("#liste_blog_comment").DataTable();

document.querySelectorAll('.deleteComment').forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault()
        $.ajax({
            url: '/api/back/blog/'+btn.dataset.blog+'/comments/'+btn.dataset.comment,
            method: 'DELETE',
            success: () => {
                toastr.success("Le commentaire à été supprimer", "Commentaire supprimer");
                btn.parentNode.parentNode.style.display = 'none'
            },
            error: (error) => {
                toastr.error("Erreur lors de la suppression du commentaire", "Erreur Système")
            }
        })
    })
})
