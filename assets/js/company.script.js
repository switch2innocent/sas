$(document).ready(() => {
    scrollY

    //Add new company
    $('.buttonFinish').on('click', function () {

        //Step 1 company details
        const company_code = $('#company_code').val();
        const company_name = $('#company_name').val();
        const company_address = $('#company_address').val();
        const city_notary = $('#city_notary').val();
        const company_city = $('#company_city').val();
        const company_tin = $('#company_tin').val();
        const company_ctc = $('#company_ctc').val();
        const company_ctc_date = $('#company_ctc_date').val();
        const company_ctc_place = $('#company_ctc_place').val();

        //Step 2 company personnels a
        const company_person_a = $('#company_person_a').val();
        const company_position_a = $('#company_position_a').val();
        const company_person_tin_a = $('#company_person_tin_a').val();
        const person_ctc_a = $('#person_ctc_a').val();
        const person_ctc_date_place_a = $('#person_ctc_date_place_a').val();

        //company personnels b
        const company_person_b = $('#company_person_b').val();
        const company_position_b = $('#company_position_b').val();
        const company_person_tin_b = $('#company_person_tin_b').val();
        const person_ctc_b = $('#person_ctc_b').val();
        const person_ctc_date_place_b = $('#person_ctc_date_place_b').val();

        //Step 3 pagibig personnel
        const pagibig_person = $('#pagibig_person').val();
        const pagibig_address = $('#pagibig_address').val();
        const pagibig_position = $('#pagibig_position').val();
        // //Validate
        if (company_code === '' || company_name === '' || company_address === '' || city_notary === '' || company_city === '' || company_tin === '' || company_ctc === '' || company_ctc_date === '' || company_ctc_place === '') {
            toastr["error"]("Please fill out all required fields in company details.");
            return;
        } else if (company_person_a === '' || company_position_a === '' || company_person_tin_a === '' || person_ctc_a === '' || person_ctc_date_place_a === '') {
            toastr["error"]("Please fill out all required fields for Person A.");
            return;
        } else if (company_person_b === '' || company_position_b === '' || company_person_tin_b === '' || person_ctc_b === '' || person_ctc_date_place_b === '') {
            toastr["error"]("Please fill out all required fields for Person B.");
            return;
        } else if (pagibig_person === '' || pagibig_address === '' || pagibig_position === '') {
            toastr["error"]("Please fill out all required fields for Pag-IBIG personnel.");
            return;
        } else {

            $.ajax({
                type: 'POST',
                url: '../controls/add_companys.ctrl.php',
                data: {
                    company_code,
                    company_name,
                    company_address,
                    city_notary,
                    company_city,
                    company_tin,
                    company_ctc,
                    company_ctc_date,
                    company_ctc_place,
                    company_person_a,
                    company_position_a,
                    company_person_tin_a,
                    person_ctc_a,
                    person_ctc_date_place_a,
                    company_person_b,
                    company_position_b,
                    company_person_tin_b,
                    person_ctc_b,
                    person_ctc_date_place_b,
                    pagibig_person,
                    pagibig_address,
                    pagibig_position
                },
                success: function (r) {
                    if (r > 0) {
                        toastr["success"]("Company added successfully!");
                        setTimeout(() => {
                            location.href = 'company.php';
                        }, 2000);
                    } else {
                        toastr["error"]("Failed to add company. Please try again.");
                    }
                },

            });
        }

    });

    //View company details using button
    $('.view_all').on('click', function (e) {
        e.preventDefault();

        const id = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: '../controls/view_company.ctrl.php',
            data: { id: id },
            success: function (r) {

                $('#viewModal').modal('show');
                $('#view_modalBody').html(r);

            }
        });
    });

    //View company details using DataTable cells
    $('#datatable').on('dblclick', 'tbody tr', function () {
        const companyId = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: '../controls/view_company.ctrl.php',
            data: { id: companyId },
            success: function (r) {
                $('#viewModal').modal('show');
                $('#view_modalBody').html(r);
            }
        });
    });

    //Update company details
    $('.update').on('click', function (e) {
        e.preventDefault();

        const id = $('#upd_id').val();
        const company_code = $('#upd_company_code').val();
        const company_name = $('#upd_company_name').val();
        const company_address = $('#upd_company_address').val();
        const city_notary = $('#upd_city_notary').val();
        const company_city = $('#upd_company_city').val();
        const company_tin = $('#upd_company_tin').val();
        const company_ctc = $('#upd_company_ctc').val();
        const company_ctc_date = $('#upd_company_ctc_date').val();
        const company_ctc_place = $('#upd_company_ctc_place').val();
        const company_person_a = $('#upd_company_person_a').val();
        const company_position_a = $('#upd_company_position_a').val();
        const company_person_tin_a = $('#upd_company_person_tin_a').val();
        const person_ctc_a = $('#upd_person_ctc_a').val();
        const person_ctc_date_place_a = $('#upd_person_ctc_date_place_a').val();
        const company_person_b = $('#upd_company_person_b').val();
        const company_position_b = $('#upd_company_position_b').val();
        const company_person_tin_b = $('#upd_company_person_tin_b').val();
        const person_ctc_b = $('#upd_person_ctc_b').val();
        const person_ctc_date_place_b = $('#upd_person_ctc_date_place_b').val();
        const pagibig_person = $('#upd_pagibig_person').val();
        const pagibig_address = $('#upd_pagibig_address').val();
        const pagibig_position = $('#upd_pagibig_position').val();

        //Validate
        if (company_code === '' || company_name === '' || company_address === '' || city_notary === '' || company_city === '' || company_tin === '' || company_ctc === '' || company_ctc_date === '' || company_ctc_place === '') {
            toastr["error"]("Please fill out all required fields in company details.");
            return;
        } else if (company_person_a === '' || company_position_a === '' || company_person_tin_a === '' || person_ctc_a === '' || person_ctc_date_place_a === '') {
            toastr["error"]("Please fill out all required fields for Person A.");
            return;
        } else if (company_person_b === '' || company_position_b === '' || company_person_tin_b === '' || person_ctc_b === '' || person_ctc_date_place_b === '') {
            toastr["error"]("Please fill out all required fields for Person B.");
            return;
        } else if (pagibig_person === '' || pagibig_address === '' || pagibig_position === '') {
            toastr["error"]("Please fill out all required fields for Pag-IBIG personnel.");
            return;
        } else {

            $.ajax({
                type: 'POST',
                url: '../controls/update_companys.ctrl.php',
                data: {
                    id,
                    company_code,
                    company_name,
                    company_address,
                    city_notary,
                    company_city,
                    company_tin,
                    company_ctc,
                    company_ctc_date,
                    company_ctc_place,
                    company_person_a,
                    company_position_a,
                    company_person_tin_a,
                    person_ctc_a,
                    person_ctc_date_place_a,
                    company_person_b,
                    company_position_b,
                    company_person_tin_b,
                    person_ctc_b,
                    person_ctc_date_place_b,
                    pagibig_person,
                    pagibig_address,
                    pagibig_position
                },
                success: function (r) {
                    if (r > 0) {
                        toastr["success"]("Company updated successfully!");
                        setTimeout(() => {
                            location.href = 'company.php';
                        }, 2000);
                    } else {
                        toastr["error"]("Failed to update company. Please try again.");
                    }
                },

            });
        }
    });

});

//Toastr
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}