let t = document.getElementById('table_sales')
let e = $("#table_sales").DataTable({
    info: !1,
    order: [],
    pageLength: 10,
    lengthChange: !1,
    columnDefs: [{
        orderable: !1,
        targets: 1
    }, {
        orderable: !1,
        targets: 2
    }]
});

document.querySelector('[data-kt-subscription-table-filter="search"]').addEventListener('keyup', t => {
    e.search(t.target.value).draw()
})

$(".createdField").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format("YYYY"),10),
        locale: {
            "format": "YYYY-MM-DD"
        }
    }, function(start, end, label) {
        var years = moment().diff(start, "years");
        alert("You are " + years + " years old!");
    }
);

let modal_add_sale = $("#add_sale")
let modal_edit_sale = $("#edit_sale")

function getSolde() {
    let divSaleSoldeYearly = document.querySelector('.saleSoldeYear')
    let divSaleSoldeMonthly = document.querySelector('.saleSoldeMonthly')
    let divSaleSoldeDaily = document.querySelector('.saleSoldeDay')

    $.ajax({
        url: '/api/back/accounting/getSalesAmount',
        success: data => {
            divSaleSoldeYearly.innerHTML = data.yearly
            divSaleSoldeMonthly.innerHTML = data.monthly
            divSaleSoldeDaily.innerHTML = data.daily
        }
    })
}

$("#formAddSale").on('submit', e => {
    e.preventDefault()
    let form = $("#formAddSale")
    let uri = '/api/back/accounting/sale'
    let btn = form.find('.btn-primary')
    let data = form.serializeArray()

    btn.attr('data-kt-indicator', 'on')

    $.ajax({
        url: uri,
        method: "POST",
        data: data,
        success: data => {
            btn.removeAttr('data-kt-indicator')
            toastr.success("Vente enregistrer avec succès")
            t.querySelector('tbody').innerHTML += data.content
            modal_add_sale.modal('hide')
        },
        error: err => {
            btn.removeAttr('data-kt-indicator')
            toastr.error("Erreur lors de l'ajout de la vente")
            console.error(err)
        }
    })
})

document.querySelectorAll('.editSale').forEach(btn => {
    btn.addEventListener('click', e => {
        e.preventDefault()
        console.log(btn.dataset.id)
    })
})

getSolde()
