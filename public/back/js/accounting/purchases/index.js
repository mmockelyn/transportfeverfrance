let t = document.getElementById('table_purchases')
let e = $("#table_purchases").DataTable({
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

let modal_add_sale = $("#add_purchase")
let modal_edit_sale = $("#edit_purchase")

function getSolde() {
    let divSaleSoldeYearly = document.querySelector('.purchasesSoldeYear')
    let divSaleSoldeMonthly = document.querySelector('.purchasesSoldeMonthly')
    let divSaleSoldeDaily = document.querySelector('.purchasesSoldeDay')

    $.ajax({
        url: '/api/back/accounting/getPurchaseAmount',
        success: data => {
            console.log(data)
            divSaleSoldeYearly.innerHTML = data.yearly
            divSaleSoldeMonthly.innerHTML = data.monthly
            divSaleSoldeDaily.innerHTML = data.daily
        }
    })
}

$("#formAddPurchase").on('submit', e => {
    e.preventDefault()
    let form = $("#formAddPurchase")
    let uri = '/api/back/accounting/purchase'
    let btn = form.find('.btn-primary')
    let data = form.serializeArray()

    btn.attr('data-kt-indicator', 'on')

    $.ajax({
        url: uri,
        method: "POST",
        data: data,
        success: data => {
            btn.removeAttr('data-kt-indicator')
            toastr.success("Achat enregistrer avec succès")
            t.querySelector('tbody').innerHTML += data.content
            modal_add_sale.modal('hide')
            getSolde()
        },
        error: err => {
            btn.removeAttr('data-kt-indicator')
            toastr.error("Erreur lors de l'ajout de l'achat")
            console.error(err)
        }
    })
})
$("#formEditPurchase").on('submit', e => {
    e.preventDefault()
    let form = $("#formEditPurchase")
    let id = form.find('.idField').val()
    let uri = '/api/back/accounting/purchase/'+id
    let btn = form.find('.btn-primary')
    let data = form.serializeArray()

    btn.attr('data-kt-indicator', 'on')

    $.ajax({
        url: uri,
        method: "PUT",
        data: data,
        success: data => {
            btn.removeAttr('data-kt-indicator')
            btn.prepend('tr').fadeOut()
            t.querySelector('tbody').innerHTML += data.content
            modal_edit_sale.modal('hide')
            toastr.success("Achat Modifier avec Succès")
            getSolde()
        },
        error: err => {
            btn.removeAttr('data-kt-indicator')
            console.error(err)
        }
    })
})

document.querySelectorAll('.editPurchase').forEach(btn => {
    btn.addEventListener('click', e => {
        e.preventDefault()
        console.log(btn.dataset.id)
        $.ajax({
            url: '/api/back/accounting/purchase/'+btn.dataset.id,
            success: data => {
                modal_edit_sale.find('.modal-title').html('Edition de l\'achat: '+data.designation)
                modal_edit_sale.find('.idField').val(data.id)
                modal_edit_sale.find('.createdField').val(data.created_at)
                modal_edit_sale.find('.designationField').val(data.designation)
                modal_edit_sale.find('.referenceField').val(data.reference)
                modal_edit_sale.find('.amountField').val(data.amount)

                modal_edit_sale.modal('show')
            }
        })
    })
})

document.querySelectorAll('.delPurchase').forEach(btn => {
    btn.addEventListener('click', e => {
        e.preventDefault()
        $.ajax({
            url: '/api/back/accounting/purchase/'+btn.dataset.id,
            success: data => {
                toastr.success("Achat supprimer avec succès")
                btn.parentNode.parentNode.parentNode.parentNode.style.display = 'none'
                getSolde()
            }
        })
    })
})

getSolde()
