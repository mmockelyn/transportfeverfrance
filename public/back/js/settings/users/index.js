"use strict";
var KTUsersList = function() {
    var e, t, n, r, o = document.getElementById("kt_table_users"),
        c = () => {
            o.querySelectorAll('[data-kt-users-table-filter="delete_row"]').forEach((t => {
                t.addEventListener("click", (function(t) {
                    t.preventDefault();
                    const n = t.target.closest("tr"),
                        r = n.querySelectorAll("td")[1].querySelectorAll("a")[1].innerText;
                    Swal.fire({
                        text: "Êtes-vous sur de vouloir supprimer " + r + "?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Oui, Supprimer!",
                        cancelButtonText: "Non, Annuler",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then((function(t) {
                        t.value ? Swal.fire({
                            text: "Vous avez supprimer " + r + "!.",
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok !",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        }).then((function() {
                            e.row($(n)).remove().draw()
                        })).then((function() {
                            a()
                        })) : "cancel" === t.dismiss && Swal.fire({
                            text: customerName + " n'a pas été supprimer.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok !",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        })
                    }))
                }))
            }))
        },
        l = () => {
            const c = o.querySelectorAll('[type="checkbox"]');
            t = document.querySelector('[data-kt-user-table-toolbar="base"]'), n = document.querySelector('[data-kt-user-table-toolbar="selected"]'), r = document.querySelector('[data-kt-user-table-select="selected_count"]');
            const s = document.querySelector('[data-kt-user-table-select="delete_selected"]');
            c.forEach((e => {
                e.addEventListener("click", (function() {
                    setTimeout((function() {
                        a()
                    }), 50)
                }))
            })), s.addEventListener("click", (function() {
                Swal.fire({
                    text: "Êtes-vous sur de vouloir supprimer tous les utilisateurs selectionner ?",
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: "Oui, supprimer!",
                    cancelButtonText: "Non, annuler",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then((function(t) {
                    t.value ? Swal.fire({
                        text: "Vous avez supprimer tous les utilisateurs selectionner!.",
                        icon: "success",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok !",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary"
                        }
                    }).then((function() {
                        c.forEach((t => {
                            t.checked && e.row($(t.closest("tbody tr"))).remove().draw()
                        }));
                        o.querySelectorAll('[type="checkbox"]')[0].checked = !1
                    })).then((function() {
                        a(), l()
                    })) : "cancel" === t.dismiss && Swal.fire({
                        text: "Les utilisateurs selectionner n'ont pas été supprimer.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok !",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary"
                        }
                    })
                }))
            }))
        };
    const a = () => {;
        const e = o.querySelectorAll('tbody [type="checkbox"]');
        let c = !1,
            l = 0;
        e.forEach((e => {
            e.checked && (c = !0, l++)
        })), c ? (r.innerHTML = l, t.classList.add("d-none"), n.classList.remove("d-none")) : (t.classList.remove("d-none"), n.classList.add("d-none"))
    };
    return {
        init: function() {
            o && (o.querySelectorAll("tbody tr").forEach((e => {
                const t = e.querySelectorAll("td"),
                    n = t[3].innerText.toLowerCase();
                let r = 0,
                    o = "minutes";
                n.includes("yesterday") ? (r = 1, o = "days") : n.includes("mins") ? (r = parseInt(n.replace(/\D/g, "")), o = "minutes") : n.includes("hours") ? (r = parseInt(n.replace(/\D/g, "")), o = "hours") : n.includes("days") ? (r = parseInt(n.replace(/\D/g, "")), o = "days") : n.includes("weeks") && (r = parseInt(n.replace(/\D/g, "")), o = "weeks");
                const c = moment().subtract(r, o).format();
                t[3].setAttribute("data-order", c);
                const l = moment(t[5].innerHTML, "DD MMM YYYY, LT").format();
                t[5].setAttribute("data-order", l)
            })), (e = $(o).DataTable({
                info: !1,
                order: [],
                pageLength: 10,
                lengthChange: !1,
                columnDefs: [{
                    orderable: !1,
                    targets: 0
                }, {
                    orderable: !1,
                    targets: 6
                }],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json'
                }
            })).on("draw", (function() {
                l(), c(), a()
            })), l(), document.querySelector('[data-kt-user-table-filter="search"]').addEventListener("keyup", (function(t) {
                e.search(t.target.value).draw()
            })), document.querySelector('[data-kt-user-table-filter="reset"]').addEventListener("click", (function() {
                document.querySelector('[data-kt-user-table-filter="form"]').querySelectorAll("select").forEach((e => {
                    $(e).val("").trigger("change")
                })), e.search("").draw()
            })), c(), (() => {
                const t = document.querySelector('[data-kt-user-table-filter="form"]'),
                    n = t.querySelector('[data-kt-user-table-filter="filter"]'),
                    r = t.querySelectorAll("select");
                n.addEventListener("click", (function() {
                    var t = "";
                    r.forEach(((e, n) => {
                        e.value && "" !== e.value && (0 !== n && (t += " "), t += e.value)
                    })), e.search(t).draw()
                }))
            })())
        }
    }
}();

function createUser() {
    let form = $("#kt_modal_add_user_form")
     form.on('submit', (e) => {
         e.preventDefault()
         let form = $("#kt_modal_add_user_form")
         let uri = form.attr('action')
         let data = form.serializeArray()

         let btn = form.find('.btn-primary')

         btn.attr('data-kt-indicator', 'on')

         $.ajax({
             url: uri,
             method: 'POST',
             data: data,
             success: data => {
                 btn.attr('data-kt-indicator', 'off')
                 console.log(data)
                 toastr.success(`Le compte de l'utilisateur <strong>${data.name}</strong> à été ajouté avec succès`);
             },
             error: err => {
                 btn.attr('data-kt-indicator', 'off')
                 toastr.error(err.responseText, "Erreur Serveur")
             }
         })
     })
}
KTUtil.onDOMContentLoaded((function() {
    KTUsersList.init()
    createUser()
}));
