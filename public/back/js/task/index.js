"use strict";
var KTProjectTargets = {
    init: function () {
        !function () {
            const t = document.getElementById("kt_profile_overview_table");
            t.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"),
                    o = moment(e[1].innerHTML, "MMM D, YYYY").format();
                e[1].setAttribute("data-order", o)
            })), $(t).DataTable({
                info: !1,
                order: [],
                paging: !1
            })
        }()
    },
    getData: function () {
        $.ajax({
            url: '/api/tasks/list',
            success: (data) => {
                console.log(data)
                $("#count_task_pending").html(data.count_tasks_pending)
                $("#count_task_complete").html(data.count_tasks_complete)

                let content_task_card_pending = document.querySelector('#content_task_card_pending')
                content_task_card_pending.innerHTML = ``;
                console.log(data.tasks_pending)
                let tasksPending = Array.from(data.tasks_pending)
                if (data.count_tasks_pending === 0) {
                    content_task_card_pending.innerHTML += `
                    <div class="card mb-6 mb-xl-9">
                        <div class="card-body">
                            <div class="mb-2 text-center">
                            <div class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#000000" opacity="0.3"/>
                                        <rect fill="#000000" x="11" y="9" width="2" height="7" rx="1"/>
                                        <rect fill="#000000" x="11" y="17" width="2" height="2" rx="1"/>
                                </svg>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
                                <h2 class="fs-4 fw-bolder mb-1 text-gray-600">Aucune Tache actuellement</h2>
                            </div>
                        </div>
                    </div>
                    `
                } else {
                    tasksPending.forEach(task => {
                        content_task_card_pending.innerHTML += `
                    <div class="card mb-6 mb-xl-9">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Header-->
                            <div class="d-flex flex-stack mb-3">
                                <!--begin::Badge-->
                                <div class="badge badge-light">${task.category}</div>
                                <!--end::Badge-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Title-->
                            <div class="mb-2">
                                <a href="#" class="fs-4 fw-bolder mb-1 text-gray-900 text-hover-primary">${task.task}</a>
                            </div>
                            <!--end::Title-->
                            <!--begin::Content-->
                            <div class="fs-6 fw-bold text-gray-600 mb-5">${task.description}</div>
                            <!--end::Content-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    `
                    })
                }

                let content_task_card_complete = document.querySelector('#content_task_card_complete')
                content_task_card_complete.innerHTML = ``
                let tasksComplete = Array.from(data.tasks_complete)

                if (data.count_tasks_complete === 0) {
                    content_task_card_complete.innerHTML += `
                    <div class="card mb-6 mb-xl-9">
                        <div class="card-body">
                            <div class="mb-2 text-center">
                            <div class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#000000" opacity="0.3"/>
                                        <rect fill="#000000" x="11" y="9" width="2" height="7" rx="1"/>
                                        <rect fill="#000000" x="11" y="17" width="2" height="2" rx="1"/>
                                </svg>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
                                <h2 class="fs-4 fw-bolder mb-1 text-gray-600">Aucune Tache actuellement</h2>
                            </div>
                        </div>
                    </div>
                    `
                } else {
                    tasksComplete.forEach(task => {
                        content_task_card_complete.innerHTML += `
                    <div class="card mb-6 mb-xl-9">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Header-->
                            <div class="d-flex flex-stack mb-3">
                                <!--begin::Badge-->
                                <div class="badge badge-light">${task.category}</div>
                                <!--end::Badge-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Title-->
                            <div class="mb-2">
                                <a href="#" class="fs-4 fw-bolder mb-1 text-gray-900 text-hover-primary">${task.task}</a>
                            </div>
                            <!--end::Title-->
                            <!--begin::Content-->
                            <div class="fs-6 fw-bold text-gray-600 mb-5">${task.description}</div>
                            <!--end::Content-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    `
                    })
                }
            }
        })
    }
};

var KTModalNewTarget = function () {
    var t, e, n, a, o, i;
    return {
        init: function () {
            let modal = $("#kt_modal_new_target")
            let form = $("#kt_modal_new_target_form")
            let datas = form.serializeArray()
            let btnSubmit = document.querySelector('#kt_modal_new_target_submit')
            let btnCancel = document.querySelector('#kt_modal_new_target_cancel')

                btnSubmit.addEventListener('click', (e) => {
                    e.preventDefault()
                    btnSubmit.setAttribute("data-kt-indicator", "on")
                    btnSubmit.disabled = !0

                    $.ajax({
                        url: '/api/tasks',
                        method: 'POST',
                        data: {
                            "task": $('[name="task"]').val(),
                            "category": $('[name="category"]').val(),
                            "user_id": $('[name="user_id"]').val(),
                            "description": $('[name="description"]').val(),
                        },
                        success: (data) => {
                            console.log(data)
                            btnSubmit.removeAttribute('data-kt-indicator')
                            btnSubmit.disabled = !1
                            Swal.fire({
                                text: "Le formulaire à bien été soumis",
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            })
                            $("#kt_modal_new_target_form")[0].reset()
                            modal.modal('hide')
                            setTimeout(() => {
                                window.location.reload()
                            }, 2500)
                        },
                        error: (er) => {
                            console.error(er)
                            Swal.fire({
                                text: "Une erreur à été detecter lors de la soumission du formulaire",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok !",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            })
                        }
                    })
                });
                    btnCancel.addEventListener('click', (e) => {
                        e.preventDefault()
                        Swal.fire({
                            text: "Êtes-vous sur de vouloir annuler la saisie ?",
                            icon: "warning",
                            showCancelButton: !0,
                            buttonsStyling: !1,
                            confirmButtonText: "Oui, annuler!",
                            cancelButtonText: "Non",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light"
                            }
                        }).then((function (t) {
                            t.value ? ($("#kt_modal_new_target_form")[0].reset(), modal.modal('hide')) : "cancel" === t.dismiss && Swal.fire({
                                text: "Votre saisie à été annuler !.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            })
                        }))
                    })

        }
    }
}();

KTUtil.onDOMContentLoaded((function () {
    KTProjectTargets.init()
    KTProjectTargets.getData()
    KTModalNewTarget.init()
}));
