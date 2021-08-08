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
                console.log(data)
            },

            error: (err) => {
                console.error(err)
            }
        })
    })
})
