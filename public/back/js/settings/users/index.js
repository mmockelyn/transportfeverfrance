"use strict";

let KTUsersList = () => {
    let e,t,n,r,o = document.getElementById('kt_table_users'),
        c = () => {
            o.querySelectorAll('[data-kt-users-table-filter="delete_row"]').forEach((t => {
                t.addEventListener('click', t => {
                    t.preventDefault()
                    const n = t.target.closest('tr'),
                        r = n.querySelectorAll('td')[1].querySelectorAll("a")[1].innerText;

                    Swal.fire({
                        text: `Êtes-vous sur de vouloir supprimer ${r} de la base de donnée ?`,
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Oui, Supprimer!",
                        cancelButtonText: "Non, Annuler",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(t => {
                        // Requete Ajax de suppression des utilisateurs selectionner

                        t.value ? Swal.fire({
                            text: `Vous avez supprimer ${r} de la base de donnée !`,
                            icon: 'success',
                            buttonsStyling: !1,
                            confirmButtonText: "OK !",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        }).then((() => {
                            e.row($(n)).remove().draw()
                        })).then((() => {
                            a()
                        })) : "cancel" === t.dismiss && Swal.fire({
                            text: customerName + " n'a pas été supprimer.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "OK !",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        })
                    })
                })
            }))
        };
    return {
        init: function () {

        }
    }
}();

KTUtil.onDOMContentLoaded((function() {
    KTUsersList.init()
}));
