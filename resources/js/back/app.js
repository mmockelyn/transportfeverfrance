document.querySelectorAll('.publish').forEach((btn) => {
    btn.addEventListener('click', (e) => {
        e.preventDefault()
        $.ajax({
            url: '/api/back/publishing',
            method: 'POST',
            data: {
                "provider": btn.dataset.provider,
                "providerId": btn.dataset.providerId
            },

            success: (data) => {
                window.location.reload()
            },

            error: (err) => {
                console.error(err)
                toast.error("Erreur lors de la publication", "Erreur Serveur")
            }
        })
    })
})

document.querySelectorAll('.unpublish').forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault()

        $.ajax({
            url: '/api/back/unpublishing',
            method: "POST",
            data: {
                "provider": btn.dataset.provider,
                "providerId": btn.dataset.providerId
            },
            success: (data) => {
                window.location.reload()
            },

            error: (err) => {
                console.error(err)
                toast.error("Erreur lors de la publication", "Erreur Serveur")
            }
        })
    })
})
