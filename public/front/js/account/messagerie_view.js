document.querySelectorAll('.btn-default').forEach((btn) => {
    btn.addEventListener('click', (e) => {
        e.preventDefault()

        $.ajax({
            url: '/account/messagerie/'+btn.dataset.messageId,
            method: 'DELETE',
            success: (data) => {
                window.location.href='/account/messagerie'
            }
        })
    })
})
