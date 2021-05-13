document.querySelectorAll('.list-item').forEach((inbox) => {
    inbox.addEventListener('click', (e) => {
        e.preventDefault()
        window.location.href='/account/messagerie/'+inbox.dataset.item
    })
})
