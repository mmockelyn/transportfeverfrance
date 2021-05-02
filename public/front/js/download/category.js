// Function de la recherche

function SearchIn() {
    const input = document.querySelector('#searching_package')
    const resultShow = document.querySelector('#search_result')
    const subcategory_id = document.querySelector('#subcategory_id').value
    const count_download = document.querySelector('#kt_subheader_total')

    input.addEventListener('keyup', (e) => {
        e.preventDefault()
        KTApp.block('#search_result')
        $.ajax({
            url: `/api/download/category/${subcategory_id}?=${input.value}`,
            method: 'POST',
            data: {search: input.value},
            success: (data) => {
                KTApp.unblock('#search_result')
                resultShow.innerHTML = data.html
                count_download.innerHTML = `${data.count} Packages disponible`
            },
            error: (err) => {
                KTApp.unblock('#search_result')
                Swal.fire({
                    type: 'error',
                    title: "Erreur Serveur",
                    text: "Une erreur à eu lieu lors de la récupération des mods"
                })
            }
        })
    })
}

SearchIn();
