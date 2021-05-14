"use strict";
let wizard = function () {
    let _wizardEl;
    let _formEl;
    let _wizardObj;
    let _validations = [];


    let initWizard = function () {
        _wizardObj = new KTWizard(_wizardEl, {
            startStep: 1,
            clickableSteps: false
        });

        _wizardObj.on('change', (wizard) => {
            if (wizard.getStep() > wizard.getNewStep()) {
                return;
            }

            let validator = _validations[wizard.getStep() - 1];

            if (validator) {
                validator.validate().then(status => {
                    if(status == 'Valid') {
                        wizard.goTo(wizard.getNewStep())
                        KTUtil.scrollTop()
                    } else {
                        Swal.fire({
                            text: "Attention, un certains nombres d'erreur ont été detecter, veuillez réessayer",
                            icon: "error",
                            buttonStyling: false,
                            confirmButtonText: "Ok, Je vais regarder",
                            customClass: {
                                confirmButton: "btn font-weight-bold btn-light"
                            }
                        }).then(() => {
                            KTUtil.scrollTop()
                        })
                    }
                })
            }

            return false;
        });

        _wizardObj.on('changed', (wizard) => {
            KTUtil.scrollTop();
        })

        _wizardObj.on('submit', (wizard) => {
            Swal.fire({
                text: "Tout m'à l'air OK, Veuillez confirmer la soumission de votre mod",
                icon: 'success',
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Oui, je soumet mon mod",
                cancelButtonText: "Non, annulé",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-primary",
                    cancelButton: "btn font-weight-bold btn-default"
                }
            }).then((result) => {
                if(result.value) {
                    // Soumission Formulaire
                    _formEl.submit()
                } else if(result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Le formulaire n'à pas été soumis",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, J'ai compris!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-primary",
                        }
                    });
                }
            });
        });
    }

    let initValidation = () => {
        // Step 1
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    title: {
                        validators: {
                            notEmpty: {
                                message: "Le titre est obligatoire"
                            }
                        }
                    },
                    meta_keyword: {
                        validators: {
                            notEmpty: {
                                message: "Les mots clefs sont obligatoire"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap({
                        //eleInvalidClass: '',
                        eleValidClass: '',
                    })
                }
            }
        ));

        // Step 2
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    download_category_id: {
                        validators: {
                            notEmpty: {
                                message: "La catégorie est obligatoire"
                            }
                        }
                    },
                    download_sub_category_id: {
                        validators: {
                            notEmpty: {
                                message: "La catégorie est obligatoire"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap({
                        //eleInvalidClass: '',
                        eleValidClass: '',
                    })
                }
            }
        ));

        // Step 3
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    short_content: {
                        validators: {
                            notEmpty: {
                                message: "La courte description est obligatoire"
                            },
                            stringLength: {
                                max: 255,
                                message: 'La courte description ne peut pas être supérieur à 255 caractères.'
                            }
                        }
                    },
                    description: {
                        validators: {
                            notEmpty: {
                                message: "La description est obligatoire"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap({
                        //eleInvalidClass: '',
                        eleValidClass: '',
                    })
                }
            }
        ))

        // Step 4
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap({
                        //eleInvalidClass: '',
                        eleValidClass: '',
                    })
                }
            }
        ))
    }

    let chargeSubcategory = () => {
        let category_field = $("#download_category_id")
        let subcategory_field = document.querySelector('#download_sub_category_id')

        category_field.on('change', (e) => {
            e.preventDefault
            KTApp.block('#subcategory_field', {
                overlayColor: '#000000',
                state: 'danger',
                message: 'Veuillez patienter'
            })

            $.ajax({
                url: '/api/download/search/category/'+category_field.val(),
                success: (data) => {
                    KTApp.unblock('#subcategory_field')
                    subcategory_field.innerHTML = ``
                    data.subs.forEach((sub) => {
                        subcategory_field.innerHTML += `<option value="${sub.id}">${sub.title}</option>`
                    })
                    document.querySelector('#subcategory_field').style.display = 'block'
                },
                error: (err) => {
                    KTApp.unblock('#subcategory_field')
                    console.error(err)
                    $("#subcategory_field").html('<span class="text-danger font-weight-bolder font-size-h6">Impossible de recevoir la liste des sous catégories.</span>')
                    document.querySelector('#subcategory_field').style.display = 'block'
                }
            })
        })
    }

    let selectedData = () => {

        $("input[name=type_feature]").on('change', (e) => {

            if($("input[name=type_feature]:checked").val() == 0) {
                $("#vehicule_field").show();
                $("#other_field").hide();
            }

            if($("input[name=type_feature]:checked").val() == 1) {
                $("#vehicule_field").hide();
                $("#other_field").show();
            }

        })

        if($("input[name=type_feature]:checked").val() == 0) {
            $("#vehicule_field").show();
            $("#other_field").hide();
        }

        if($("input[name=type_feature]:checked").val() == 1) {
            $("#vehicule_field").hide();
            $("#other_field").show();
        }
    }


    return {
        init: function () {
            _wizardEl = KTUtil.getById('kt_wizard')
            _formEl = KTUtil.getById('kt_form')

            initWizard()
            initValidation()
            chargeSubcategory()
            selectedData()
        }
    };
}();

jQuery(document).ready(function () {
    wizard.init();

    $('[name="short_content"]').maxlength({
        alwaysShow: true,
        threshold: 5,
        warningClass: "label label-danger label-rounded label-inline",
        limitReachedClass: "label label-primary label-rounded label-inline"
    });

    $(".inputmask").inputmask("9999", {
        "placeholder": "aaaa",
        autoUnmask: true
    });

    let meta = document.querySelector('.tagify')
    new Tagify(meta)
});
