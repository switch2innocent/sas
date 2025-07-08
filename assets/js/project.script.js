$(document).ready(() => {

    //Check all checkboxes
    $('#check_all').change(function (e) {
        e.preventDefault();

        const table = $(e.target).closest('table');

        if ($(this).prop('checked')) {

            $('tbody tr td input[type="checkbox"]').each(function () {
                $('td input:checkbox', table).prop('checked', true);
            });
        } else {

            $('tbody tr td input[type="checkbox"]').each(function () {
                $('td input:checkbox', table).prop('checked', false);
            });
        }

    });

    //Add new project and contracts
    $('.save').on('click', function (e) {
        e.preventDefault();

        //Project details
        const project_code = $('#project_code').val();
        const company_code = $('#company_code option:selected').val();
        const project_name = $('#project_name').val();
        const condo = $('#condo').is(':checked') ? 1 : 0;
        const locations = $('#location').val();
        const city = $('#city').val();
        const province = $('#province').val();
        const association = $('#association').val();
        const registry = $('#registry').val();
        const project_tct_no = $('#project_tct_no').val();

        //Contract/pagibig/titling remarks and dates
        let contract_remarks = {}, contract_date = {};
        let pagibig_remarks = {}, pagibig_date = {};
        let titling_remarks = {}, titling_date = {};

        for (let i = 1; i <= 5; i++) {
            contract_remarks[i] = $(`#contract_remarks_${i}`).val();
            contract_date[i] = $(`#contract_date_${i}`).val();

            pagibig_remarks[i] = $(`#pagibig_remarks_${i}`).val();
            pagibig_date[i] = $(`#pagibig_date_${i}`).val();

            titling_remarks[i] = $(`#titling_remarks_${i}`).val();
            titling_date[i] = $(`#titling_date_${i}`).val();
        }

        //Validate
        if (company_code === '0') { //Company selection
            toastr.error('Please select a company code.');
            return;
        } else if (project_code === '' || company_code === '' || project_name === '' || locations === '' || city === '' || province === '' || association === '' || registry === '' || project_tct_no === '') { //Project details
            toastr.error('Please fill out project details.');
            return;
        } else if (contract_remarks[1] === '' || contract_date[1] === '' || contract_remarks[2] === '' || contract_date[2] === '' || contract_remarks[3] === '' || contract_date[3] === '' || contract_remarks[4] === '' || contract_date[4] === '' || contract_remarks[5] === '' || contract_date[5] === '') { //Contract Monitoring
            toastr.error('Please fill out contract monitoring');
            return;
        } else if (pagibig_remarks[1] === '' || pagibig_date[1] === '' || pagibig_remarks[2] === '' || pagibig_date[2] === '' || pagibig_remarks[3] === '' || pagibig_date[3] === '' || pagibig_remarks[4] === '' || pagibig_date[4] === '' || pagibig_remarks[5] === '' || pagibig_date[5] === '') { //Pag-IBIG Monitoring
            toastr.error('Please fill out Pag-IBIG monitoring');
            return;
        } else if (titling_remarks[1] === '' || titling_date[1] === '' || titling_remarks[2] === '' || titling_date[2] === '' || titling_remarks[3] === '' || titling_date[3] === '' || titling_remarks[4] === '' || titling_date[4] === '' || titling_remarks[5] === '' || titling_date[5] === '') { //Titling Monitoring
            toastr.error('Please fill out titling monitoring');
            return;
        } else {

            //Checked contract IDs
            const contract_id = [];
            $('input:checkbox[name="contract_id"]:checked').each(function () {
                contract_id.push($(this).val());
            });

            if (contract_id.length < 1) {
                toastr.error("Please select at least one contract.");
                return;
            }

            //Project first
            $.ajax({
                type: 'POST',
                url: '../controls/add_projects.ctrl.php',
                data: {
                    project_code,
                    company_code,
                    project_name,
                    condo,
                    locations,
                    city,
                    province,
                    association,
                    registry,
                    project_tct_no,
                    contract_remarks_1: contract_remarks[1],
                    contract_date_1: contract_date[1],
                    contract_remarks_2: contract_remarks[2],
                    contract_date_2: contract_date[2],
                    contract_remarks_3: contract_remarks[3],
                    contract_date_3: contract_date[3],
                    contract_remarks_4: contract_remarks[4],
                    contract_date_4: contract_date[4],
                    contract_remarks_5: contract_remarks[5],
                    contract_date_5: contract_date[5],
                    pagibig_remarks_1: pagibig_remarks[1],
                    pagibig_date_1: pagibig_date[1],
                    pagibig_remarks_2: pagibig_remarks[2],
                    pagibig_date_2: pagibig_date[2],
                    pagibig_remarks_3: pagibig_remarks[3],
                    pagibig_date_3: pagibig_date[3],
                    pagibig_remarks_4: pagibig_remarks[4],
                    pagibig_date_4: pagibig_date[4],
                    pagibig_remarks_5: pagibig_remarks[5],
                    pagibig_date_5: pagibig_date[5],
                    titling_remarks_1: titling_remarks[1],
                    titling_date_1: titling_date[1],
                    titling_remarks_2: titling_remarks[2],
                    titling_date_2: titling_date[2],
                    titling_remarks_3: titling_remarks[3],
                    titling_date_3: titling_date[3],
                    titling_remarks_4: titling_remarks[4],
                    titling_date_4: titling_date[4],
                    titling_remarks_5: titling_remarks[5],
                    titling_date_5: titling_date[5]
                },
                success: (project_r) => {

                    //Safely converts the response string from the PHP controller into a number.
                    const project_id = parseInt(project_r, 10);

                    if (project_id > 0) {

                        //Add project-contract links
                        $.ajax({
                            type: 'POST',
                            url: '../controls/add_project_contracts.ctrl.php',
                            data: {
                                id: contract_id,
                                project_id: project_id //Actual inserted project ID
                            },
                            success: (contract_r) => {

                                if (contract_r > 0) {
                                    toastr.success('Project and contracts added successfully!');
                                    setTimeout(() => {
                                        location.href = 'project.php';
                                    }, 2000);
                                } else {
                                    toastr.error('Project saved, but contracts could not be linked.');
                                }
                            }
                        });
                    } else {
                        toastr.error('Error adding project.');
                    }
                }
            });

        }

    });

    //View project details using button
    $('.view_all').on('click', function (e) {
        e.preventDefault();

        const id = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: '../controls/view_project_contract.ctrl.php',
            data: { id: id },
            success: function (r) {

                $('#viewModal').modal('show');
                $('#view_modalBody').html(r);

            }
        });
    });

    //View project details using DataTable cells
    $('#datatable').on('dblclick', 'tbody tr', function () {
        const project_contract_Id = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: '../controls/view_project_contract.ctrl.php',
            data: { id: project_contract_Id },
            success: function (r) {
                $('#viewModal').modal('show');
                $('#view_modalBody').html(r);
            }
        });
    });

    //Update contract projects
    $('.update').on('click', function (e) {
        e.preventDefault();

        const upd_project_id = $('#upd_project_id').val();
        //Project details
        const upd_project_code = $('#upd_project_code').val();
        const upd_company_code = $('#upd_company_code option:selected').val();
        const upd_project_name = $('#upd_project_name').val();
        const upd_condo = $('#upd_condo').is(':checked') ? 1 : 0;
        const upd_locations = $('#upd_location').val();
        const upd_city = $('#upd_city').val();
        const upd_province = $('#upd_province').val();
        const upd_association = $('#upd_association').val();
        const upd_registry = $('#upd_registry').val();
        const upd_project_tct_no = $('#upd_project_tct_no').val();

        //Contract/pagibig/titling remarks and dates
        let upd_contract_remarks = {}, upd_contract_date = {};
        let upd_pagibig_remarks = {}, upd_pagibig_date = {};
        let upd_titling_remarks = {}, upd_titling_date = {};

        for (let i = 1; i <= 5; i++) {
            upd_contract_remarks[i] = $(`#upd_contract_remarks_${i}`).val();
            upd_contract_date[i] = $(`#upd_contract_date_${i}`).val();

            upd_pagibig_remarks[i] = $(`#upd_pagibig_remarks_${i}`).val();
            upd_pagibig_date[i] = $(`#upd_pagibig_date_${i}`).val();

            upd_titling_remarks[i] = $(`#upd_titling_remarks_${i}`).val();
            upd_titling_date[i] = $(`#upd_titling_date_${i}`).val();
        }

        //Validate
        if (upd_company_code === '0') { //Company selection
            toastr.error('Please select a company code.');
            return;
        } else if (upd_project_code === '' || upd_company_code === '' || upd_project_name === '' || upd_locations === '' || upd_city === '' || upd_province === '' || upd_association === '' || upd_registry === '' || upd_project_tct_no === '') { //Project details
            toastr.error('Please fill out project details.');
            return;
        } else if (upd_contract_remarks[1] === '' || upd_contract_date[1] === '' || upd_contract_remarks[2] === '' || upd_contract_date[2] === '' || upd_contract_remarks[3] === '' || upd_contract_date[3] === '' || upd_contract_remarks[4] === '' || upd_contract_date[4] === '' || upd_contract_remarks[5] === '' || upd_contract_date[5] === '') { //Contract Monitoring
            toastr.error('Please fill out contract monitoring');
            return;
        } else if (upd_pagibig_remarks[1] === '' || upd_pagibig_date[1] === '' || upd_pagibig_remarks[2] === '' || upd_pagibig_date[2] === '' || upd_pagibig_remarks[3] === '' || upd_pagibig_date[3] === '' || upd_pagibig_remarks[4] === '' || upd_pagibig_date[4] === '' || upd_pagibig_remarks[5] === '' || upd_pagibig_date[5] === '') { //Pag-IBIG Monitoring
            toastr.error('Please fill out Pag-IBIG monitoring');
            return;
        } else if (upd_titling_remarks[1] === '' || upd_titling_date[1] === '' || upd_titling_remarks[2] === '' || upd_titling_date[2] === '' || upd_titling_remarks[3] === '' || upd_titling_date[3] === '' || upd_titling_remarks[4] === '' || upd_titling_date[4] === '' || upd_titling_remarks[5] === '' || upd_titling_date[5] === '') { //Titling Monitoring
            toastr.error('Please fill out titling monitoring');
            return;
        } else {

            //Checked contract IDs
            const upd_contract_id = [];
            $('input:checkbox[name="contract_id"]:checked').each(function () {
                upd_contract_id.push($(this).val());
            });

            if (upd_contract_id.length < 1) {
                toastr.error("Please select at least one contract.");
                return;
            }

            //Update project first
            $.ajax({
                type: 'POST',
                url: '../controls/update_projects.ctrl.php',
                data: {
                    upd_project_id,
                    upd_project_code,
                    upd_company_code,
                    upd_project_name,
                    upd_condo,
                    upd_locations,
                    upd_city,
                    upd_province,
                    upd_association,
                    upd_registry,
                    upd_project_tct_no,
                    upd_contract_remarks_1: upd_contract_remarks[1],
                    upd_contract_date_1: upd_contract_date[1],
                    upd_contract_remarks_2: upd_contract_remarks[2],
                    upd_contract_date_2: upd_contract_date[2],
                    upd_contract_remarks_3: upd_contract_remarks[3],
                    upd_contract_date_3: upd_contract_date[3],
                    upd_contract_remarks_4: upd_contract_remarks[4],
                    upd_contract_date_4: upd_contract_date[4],
                    upd_contract_remarks_5: upd_contract_remarks[5],
                    upd_contract_date_5: upd_contract_date[5],
                    upd_pagibig_remarks_1: upd_pagibig_remarks[1],
                    upd_pagibig_date_1: upd_pagibig_date[1],
                    upd_pagibig_remarks_2: upd_pagibig_remarks[2],
                    upd_pagibig_date_2: upd_pagibig_date[2],
                    upd_pagibig_remarks_3: upd_pagibig_remarks[3],
                    upd_pagibig_date_3: upd_pagibig_date[3],
                    upd_pagibig_remarks_4: upd_pagibig_remarks[4],
                    upd_pagibig_date_4: upd_pagibig_date[4],
                    upd_pagibig_remarks_5: upd_pagibig_remarks[5],
                    upd_pagibig_date_5: upd_pagibig_date[5],
                    upd_titling_remarks_1: upd_titling_remarks[1],
                    upd_titling_date_1: upd_titling_date[1],
                    upd_titling_remarks_2: upd_titling_remarks[2],
                    upd_titling_date_2: upd_titling_date[2],
                    upd_titling_remarks_3: upd_titling_remarks[3],
                    upd_titling_date_3: upd_titling_date[3],
                    upd_titling_remarks_4: upd_titling_remarks[4],
                    upd_titling_date_4: upd_titling_date[4],
                    upd_titling_remarks_5: upd_titling_remarks[5],
                    upd_titling_date_5: upd_titling_date[5]
                },
                success: (project_r) => {

                    if (project_r > 0) {

                        //Second delete project_contract
                        $.ajax({
                            type: 'POST',
                            url: '../controls/update_project_contracts.ctrl.php',
                            data: {
                                upd_project_id: upd_project_id
                            },
                            success: (r) => {
                                if (r > 0) {

                                    //Third Add new project-contract links
                                    $.ajax({
                                        type: 'POST',
                                        url: '../controls/add_project_contracts.ctrl.php',
                                        data: {
                                            id: upd_contract_id,
                                            project_id: upd_project_id //Actual inserted project ID
                                        },
                                        success: (contract_r) => {

                                            if (contract_r > 0) {
                                                toastr.success('Project and contracts updated successfully!');
                                                setTimeout(() => {
                                                    location.href = 'project.php';
                                                }, 2000);
                                            } else {
                                                toastr.error('Project saved, but contracts could not be linked.');
                                            }
                                        }
                                    });

                                } else {
                                    toastr.error('Delete project_contract failed!');
                                }
                            }
                        });

                    } else {
                        toastr.error('Error updating project.');
                    }

                }
            });

        }

    });

    //Delete project
    $('.delete').on('click', function (e) {
        e.preventDefault();

        const id = $(this).data('id');

        if (confirm("Are you sure you want to delete this project?")) {
            $.ajax({
                type: 'POST',
                url: '../controls/delete_project.ctrl.php',
                data: { id: id },
                success: function (r) {
                    if (r > 0) {
                        toastr.success("Project deleted successfully!");
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        toastr.error("Failed to delete project.");
                    }
                }
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