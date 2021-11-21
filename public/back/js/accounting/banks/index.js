let t = document.getElementById('table_banks')
let e = $("#table_banks").DataTable({
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

let modal_add_sale = $("#add_bank")
let modal_edit_sale = $("#edit_bank")

function getSolde() {
    let divSaleSoldeYearly = document.querySelector('.bankSoldeYear')
    let divSaleSoldeMonthly = document.querySelector('.bankSoldeMonthly')
    let divSaleSoldeDaily = document.querySelector('.bankSoldeDay')

    $.ajax({
        url: '/api/back/accounting/getBanksAmount',
        success: data => {
            divSaleSoldeYearly.innerHTML = data.yearly
            divSaleSoldeMonthly.innerHTML = data.monthly
            divSaleSoldeDaily.innerHTML = data.daily
        }
    })
}

$("#formAddBank").on('submit', e => {
    e.preventDefault()
    let form = $("#formAddBank")
    let uri = '/api/back/accounting/bank'
    let btn = form.find('.btn-primary')
    let data = form.serializeArray()

    btn.attr('data-kt-indicator', 'on')

    $.ajax({
        url: uri,
        method: "POST",
        data: data,
        success: data => {
            btn.removeAttr('data-kt-indicator')
            toastr.success("Mouvement enregistrer avec succès")
            t.querySelector('tbody').innerHTML += data.content
            modal_add_sale.modal('hide')
            getSolde()
        },
        error: err => {
            btn.removeAttr('data-kt-indicator')
            toastr.error("Erreur lors de l'ajout du mouvement bancaire")
            console.error(err)
        }
    })
})
$("#formEditBank").on('submit', e => {
    e.preventDefault()
    let form = $("#formEditBank")
    let id = form.find('.idField').val()
    let uri = '/api/back/accounting/bank/'+id
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
            toastr.success("Mouvement bancaire Modifier avec Succès")
            getSolde()
        },
        error: err => {
            btn.removeAttr('data-kt-indicator')
            console.error(err)
        }
    })
})

document.querySelectorAll('.editBank').forEach(btn => {
    btn.addEventListener('click', e => {
        e.preventDefault()
        console.log(btn.dataset.id)
        $.ajax({
            url: '/api/back/accounting/bank/'+btn.dataset.id,
            success: data => {
                modal_edit_sale.find('.modal-title').html('Edition du mouvement: '+data.designation)
                modal_edit_sale.find('.idField').val(data.id)
                modal_edit_sale.find('.createdField').val(data.created_at)
                modal_edit_sale.find('.designationField').val(data.designation)
                modal_edit_sale.find('.referenceField').val(data.reference)
                modal_edit_sale.find('.amountField').val(data.amount)
                modal_edit_sale.find('.paypalField').val(data.paypal_id)

                if(data.model_type === 'sale') {
                    modal_edit_sale.find('.modelTypeSaleField').attr('checked')
                } else {
                    modal_edit_sale.find('.modelTypePurchaseField').attr('checked')
                }

                modal_edit_sale.modal('show')
            }
        })
    })
})

document.querySelectorAll('.delBank').forEach(btn => {
    btn.addEventListener('click', e => {
        e.preventDefault()
        $.ajax({
            url: '/api/back/accounting/bank/'+btn.dataset.id,
            success: data => {
                toastr.success("Mouvement bancaire supprimer avec succès")
                btn.parentNode.parentNode.parentNode.parentNode.style.display = 'none'
                getSolde()
            }
        })
    })
})

getSolde()
