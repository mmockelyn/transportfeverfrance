"use strict";
var KTSubscriptionsList = function() {
    var t, e;
    return {
        init: function() {
            (t = document.getElementById("kt_subscriptions_table")) && (t.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"),
                    n = moment(e[5].innerHTML, "DD MMM YYYY, LT").format();
                e[5].setAttribute("data-order", n)
            })), e = $(t).DataTable({
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
                }]
            }), function() {
                const n = t.querySelectorAll('[type="checkbox"]'),
                    o = document.querySelector('[data-kt-subscription-table-toolbar="base"]'),
                    r = document.querySelector('[data-kt-subscription-table-toolbar="selected"]'),
                    c = document.querySelector('[data-kt-subscription-table-select="selected_count"]'),
                    l = document.querySelector('[data-kt-subscription-table-select="delete_selected"]');
                n.forEach((t => {
                    t.addEventListener("click", (function() {
                        setTimeout((function() {
                            a()
                        }), 50)
                    }))
                }));
                const a = () => {
                    const e = t.querySelectorAll('tbody [type="checkbox"]');
                    let n = !1,
                        l = 0;
                    e.forEach((t => {
                        t.checked && (n = !0, l++)
                    })), n ? (c.innerHTML = l, o.classList.add("d-none"), r.classList.remove("d-none")) : (o.classList.remove("d-none"), r.classList.add("d-none"))
                };
                l.addEventListener("click", (function() {
                    Swal.fire({
                        text: "Are you sure you want to delete selected customers?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then((function(t) {
                        t.value ? Swal.fire({
                            text: "You have deleted all selected customers!.",
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        }).then((function() {
                            n.forEach((t => {
                                t.checked && e.row($(t.closest("tbody tr"))).remove().draw()
                            }))
                        })).then((function() {
                            a()
                        })) : "cancel" === t.dismiss && Swal.fire({
                            text: "Selected customers was not deleted.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        })
                    }))
                }))
            }(), document.querySelector('[data-kt-subscription-table-filter="search"]').addEventListener("keyup", (function(t) {
                e.search(t.target.value).draw()
            })), t.querySelectorAll('[data-kt-subscriptions-table-filter="delete_row"]').forEach((t => {
                t.addEventListener("click", (function(t) {
                    t.preventDefault();
                    const n = t.target.closest("tr"),
                        o = n.querySelectorAll("td")[1].innerText;
                    Swal.fire({
                        text: "Are you sure you want to delete " + o + "?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then((function(t) {
                        t.value ? Swal.fire({
                            text: "You have deleted " + o + "!.",
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        }).then((function() {
                            e.row($(n)).remove().draw()
                        })).then((function() {
                            toggleToolbars()
                        })) : "cancel" === t.dismiss && Swal.fire({
                            text: o + " was not deleted.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        })
                    }))
                }))
            })), function() {
                const t = document.querySelector('[data-kt-subscription-table-filter="form"]'),
                    n = t.querySelector('[data-kt-subscription-table-filter="filter"]'),
                    o = t.querySelector('[data-kt-subscription-table-filter="reset"]'),
                    r = t.querySelectorAll("select");
                n.addEventListener("click", (function() {
                    var t = "";
                    r.forEach(((e, n) => {
                        e.value && "" !== e.value && (0 !== n && (t += " "), t += e.value)
                    })), e.search(t).draw()
                })), o.addEventListener("click", (function() {
                    r.forEach(((t, e) => {
                        $(t).val(null).trigger("change")
                    })), e.search("").draw()
                }))
            }())
        }
    }
}();
KTUtil.onDOMContentLoaded((function() {
    KTSubscriptionsList.init()
}));