$(document).ready(() => {

    //Append .docx on submit
    $('#contractName').on('blur', function () {
        let val = $(this).val().trim();
        if (val && !val.toLowerCase().endsWith('.docx')) {
            $(this).val(val + '.docx');
        }
    });

    // Add new contract
    $('#submit').on('click', (e) => {
        e.preventDefault();

        const contract_name = $('#contractName').val();
        const doc_file = $("#docfile")[0].files[0];
        const contract_type = $('#contractType').val();

        const formData = new FormData();
        formData.append('contract_name', contract_name);
        formData.append('doc_file', doc_file);
        formData.append('contract_type', contract_type);

        if (contract_name === '' || contract_type === '' || !doc_file) {
            toastr.error('Please fill in all fields.');
            return;
        } else {

            $.ajax({
                type: "POST",
                url: "../controls/add_contract_files.ctrl.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (r) {
                    if (r > 0) {
                        toastr.success('Contract added successfully!');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        toastr.error('Failed to add contract. Please try again.');
                    }
                }
            });
        }
    });

    //Edit contract
    $('#datatable').on('click', 'a.edit', function (e) {
        e.preventDefault();

        const id = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: '../controls/get_contract_files.ctrl.php',
            data: { id: id },
            success: function (r) {

                $('#editModal').modal('show');
                $('#edit_modalBody').html(r);

            }
        });

    });

    //Update contract
    $('#update').on('click', (e) => {
        e.preventDefault();

        const contract_name = $('#upd_contractName').val();
        const doc_file = $("#upd_docfile")[0].files[0];
        const contract_type = $('#upd_contractType').val();
        const id = $('#upd_id').val();

        const formData = new FormData();
        formData.append('contract_name', contract_name);
        formData.append('contract_file', doc_file);
        formData.append('contract_type_id', contract_type);
        formData.append('id', id);

        if (contract_name === '' || contract_type === '' || !doc_file) {
            toastr.error('Please fill in all fields.');
            return;
        } else {

            $.ajax({
                type: "POST",
                url: "../controls/update_contract_files.ctrl.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (r) {
                    if (r > 0) {
                        toastr.success('Contract updated successfully!');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        toastr.error('Failed to update contract. Please try again.');
                    }
                }
            });
        }
    });

    //Delete contract
    $('#datatable').on('click', 'a.delete', function (e) {
        e.preventDefault();

        const id = $(this).data('id');

        toastr.warning(
            'Are you sure you want to delete this contract?<br /><br /><button type="button" class="btn btn-danger btn-sm" id="toastr-confirm-delete">Yes, Delete</button>',
            'Confirm Delete',
            {
                closeButton: true,
                allowHtml: true,
                timeOut: 0,
                extendedTimeOut: 0,
                tapToDismiss: false,
                onShown: function () {
                    $('#toastr-confirm-delete').on('click', function () {
                        $.ajax({
                            type: 'POST',
                            url: '../controls/delete_contract_files.ctrl.php',
                            data: { id: id },
                            success: function () {
                                toastr.clear();
                                location.reload();
                            }
                        });
                    });
                }
            }
        );
    });

    //Download contract
    // $('#datatable').on('click', 'a.download', function (e) {
    //     e.preventDefault();

    //     const id = $(this).data('id');

    //     const form = $('<form>', {
    //         method: 'POST',
    //         action: '../controls/download_contract_files.ctrl.php'
    //     }).append(
    //         $('<input>', {
    //             type: 'hidden',
    //             name: 'id',
    //             value: id
    //         })
    //     );

    //     $('body').append(form);
    //     form.submit();
    // });

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
