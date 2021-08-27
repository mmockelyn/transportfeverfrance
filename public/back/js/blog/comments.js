$("#liste_blog_comment").DataTable();

document.querySelectorAll('.deleteComment').forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault()
        $.ajax({
            url: '/api/back/blog/'+btn.dataset.comment,
            method: 'DELETE',
            success: () => {

            },
            error: (error) => {

            }
        })
    })
})
