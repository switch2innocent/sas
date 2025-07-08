$(document).ready(() => {

    //Add signatories
    $('#submit').on('click', (e) => {
        e.preventDefault();

        const company_person = $('#company_person').val();
        const company_position = $('#company_position').val();
        const company_person_tin = $('#company_person_tin').val();
        const person_ctc = $('#person_ctc').val();
        const person_ctc_date_place = $('#person_ctc_date_place').val();

        if (!company_person || !company_position || !company_person_tin || !person_ctc || !person_ctc_date_place) {
            toastr.error('Please fill in all fields.');
            return;
        } else {
            $.ajax({
                type: 'POST',
                url: '../controls/add_signatories.ctrl.php',
                data: {
                    company_person,
                    company_position,
                    company_person_tin,
                    person_ctc,
                    person_ctc_date_place
                },
                success: function (r) {

                    if (r > 0) {
                        toastr.success('Signatory added successfully!');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        toastr.error('Failed to add signatory');
                    }
                }
            });
        }

    });

    //Edit signatories
    $('#datatable').on('click', 'a.edit', function (e) {
        e.preventDefault();

        const id = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: '../controls/edit_signatories.ctrl.php',
            data: { id: id },
            success: function (r) {

                $('#editModal').modal('show');
                $('#edit_modalBody').html(r);

            }
        });
    });

    //Update signatories
    $('#update').on('click', (e) => {
        e.preventDefault();

        const id = $('#upd_id').val();
        const company_person = $('#upd_company_person').val();
        const company_position = $('#upd_company_position').val();
        const company_person_tin = $('#upd_company_person_tin').val();
        const person_ctc = $('#upd_person_ctc').val();
        const person_ctc_date_place = $('#upd_person_ctc_date_place').val();

        if (!company_person || !company_position || !company_person_tin || !person_ctc || !person_ctc_date_place) {
            toastr.error('Please fill in all fields.');
            return;
        } else {

            $.ajax({
                type: "POST",
                url: "../controls/update_signatories.ctrl.php",
                data: {
                    id: id,
                    company_person: company_person,
                    company_position: company_position,
                    company_person_tin: company_person_tin,
                    person_ctc: person_ctc,
                    person_ctc_date_place: person_ctc_date_place
                },
                success: function (r) {
                    console.log(r);
                    if (r > 0) {
                        toastr.success('Signatory updated successfully!');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        toastr.error('Failed to update signatory. Please try again.');
                    }
                }
            });

        }
    });

    //Delete project
    $('.delete').on('click', function (e) {
        e.preventDefault();

        const id = $(this).data('id');

        if (confirm("Are you sure you want to delete this signatory?")) {
            $.ajax({
                type: 'POST',
                url: '../controls/delete_signatories.ctrl.php',
                data: { id: id },
                success: function (r) {
                    if (r > 0) {
                        toastr.success("Signatory deleted successfully!");
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        toastr.error("Failed to delete signatory.");
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