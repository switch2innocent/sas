//Added superscipt
const superscriptMap = {
    'st': 'ˢᵗ',
    'nd': 'ⁿᵈ',
    'rd': 'ʳᵈ',
    'th': 'ᵗʰ'
};

function formatOrdinal(text) {
    return text.replace(/\b(\d+)(st|nd|rd|th)\b/gi, (match, num, suffix) => {
        const sup = superscriptMap[suffix.toLowerCase()] || suffix;
        return `${num}${sup}`;
    });
}

//Function for num to words
function numberToWords(n) {
    const ones = ["", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine"];
    const teens = ["ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen",
        "sixteen", "seventeen", "eighteen", "nineteen"];
    const tens = ["", "", "twenty", "thirty", "forty", "fifty",
        "sixty", "seventy", "eighty", "ninety"];
    const thousands = ["", "thousand", "million", "billion"];

    if (n === 0) return "zero";

    let word = '';
    let i = 0;

    while (n > 0) {
        if (i >= thousands.length) {
            throw new Error("Number too large to convert");
        }

        let chunk = n % 1000;
        if (chunk !== 0) {
            let chunkWord = helper(chunk).trim();
            word = chunkWord + " " + thousands[i] + (word ? " " + word : "");
        }
        n = Math.floor(n / 1000);
        i++;
    }

    return word.trim();

    function helper(num) {
        let str = '';
        if (num >= 100) {
            str += ones[Math.floor(num / 100)] + " hundred ";
            num %= 100;
        }

        if (num >= 10 && num <= 19) {
            str += teens[num - 10] + " ";
        } else if (num >= 20) {
            str += tens[Math.floor(num / 10)] + " ";
            str += ones[num % 10] + " ";
        } else {
            str += ones[num] + " ";
        }

        return str;
    }
}

function convertToPesosCentavosWords(amount) {
    let parts = amount.toFixed(2).split('.');
    let pesos = parseInt(parts[0]);
    let centavos = parseInt(parts[1]);

    let words = "";

    if (pesos > 0) {
        words += numberToWords(pesos) + " pesos";
    }

    if (centavos > 0) {
        if (words) words += " and ";
        words += numberToWords(centavos) + " centavos";
    }

    if (!words) {
        words = "zero pesos";
    }

    //Added Only at the end
    words = words.charAt(0).toUpperCase() + words.slice(1) + " only";

    return words;
}


//Function to format numbers with comma
function formatNumberWithCommas(value) {
    let parts = value.replace(/,/g, '').split('.');
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    return parts.join('.');
}

$(document).ready(function () {

    //Added superscript on add customer details
    $('#unit_floor').on('input', function () {
        const inputVal = $(this).val();

        //Function call for superscript
        const formatted = formatOrdinal(inputVal);
        $('#unit_floor').val(formatted);
    });

    //Added superscript on edit customer details
    $('#upd_unit_floor').on('input', function () {
        const inputVal = $(this).val();

        //Function call for superscript
        const formatted = formatOrdinal(inputVal);
        $('#upd_unit_floor').val(formatted);
    });

    //Format with commas to .currency_format class
    $('.currency_format').on('keypress', function (e) {
        let charCode = e.which ? e.which : e.keyCode;
        let charTyped = String.fromCharCode(charCode);
        let currentVal = $(this).val();

        //Allow digits
        if (/\d/.test(charTyped)) return true;

        //Allow only one decimal point
        if (charTyped === '.' && currentVal.indexOf('.') === -1) return true;

        //Block everything else
        e.preventDefault();
        return false;
    });

    $('.currency_format').on('input', function () {
        let inputVal = $(this).val();

        //Remove invalid characters (keep only digits and one decimal)
        let numericVal = inputVal.replace(/[^\d.]/g, '');
        numericVal = numericVal.replace(/^([^\.]*\.)|\./g, '$1');

        //Format with commas
        $(this).val(formatNumberWithCommas(numericVal));
    });

    //Init Select2 
    //For multiple signatories
    $('#signatories').select2({
        placeholder: "Choose signatories...",
        allowClear: true,
        width: 'resolve',
        maximumSelectionLength: 2
    });

    //For companies and projects
    ['#company_main', '#projects_main'].forEach(function (selector) {
        $(selector).select2({
            dropdownParent: $('#selectSignatoriesModal'),
            allowClear: true,
        });
    });

    //Global variables
    let customId = null;
    let contractId = null;
    let signatory1 = null;
    let signatory2 = null;

    //Contract_Signatories btn
    $(document).on('click', '.open-signatories-modal', function () {
        customId = $(this).data('custom-id');
        contractId = $(this).data('contract-id');
        $('#selectSignatoriesModal').modal('show');
    });

    //Select2 selection
    $('#signatories').on('change', function () {
        const selectedData = $(this).select2('data');
        signatory1 = selectedData[0] ? selectedData[0].id : null;
        signatory2 = selectedData[1] ? selectedData[1].id : null;
    });

    //Modal_btn
    $('#downloadSignatoriesBtn').on('click', function () {

        const selectedSignatories = $('#signatories').select2('data');
        const company_main = $('#company_main').val();
        const projects_main = $('#projects_main').val();

        //Validate selected
        if (!company_main) {
            toastr.error('Please select a company.');
            return;
        } else if (!projects_main) {
            toastr.error('Please select a project.');
            return;
        } else if (!selectedSignatories || selectedSignatories.length < 2) {
            toastr.error('Please select 2 signatories.');
            return;
        } else {
            //Dynamic Form to pass id
            const form = $('<form>', {
                method: 'GET',
                action: '../controls/download_contract_monitoring.ctrl.php'
            });

            form.append($('<input>', { type: 'hidden', name: 'custom_id', value: customId }));
            form.append($('<input>', { type: 'hidden', name: 'contract_id', value: contractId }));
            form.append($('<input>', { type: 'hidden', name: 'signatory1', value: signatory1 }));
            form.append($('<input>', { type: 'hidden', name: 'signatory2', value: signatory2 }));
            form.append($('<input>', { type: 'hidden', name: 'company_main', value: company_main }));
            form.append($('<input>', { type: 'hidden', name: 'projects_main', value: projects_main }));

            $('body').append(form);
            form.submit();
            form.remove();
        }
    });

    function bindNumberToWords(inputSelector, outputSelector) {
        $(inputSelector).on('input', function () {
            let val = $(this).val();
            let amount = parseFloat(val.replace(/,/g, ''));

            if (!isNaN(amount)) {
                try {
                    let words = convertToPesosCentavosWords(amount);
                    $(outputSelector).val(words);
                } catch (e) {
                    $(outputSelector).val("Error number too large.");
                }
            } else {
                $(outputSelector).val("");
            }
        });
    }

    //For add customer module DRY
    bindNumberToWords('#net_selling_price', '#net_selling_price_word');
    bindNumberToWords('#equity', '#equity_word');
    bindNumberToWords('#loan_amount', '#loan_amount_word');
    bindNumberToWords('#loan_term', '#loan_term_word');
    bindNumberToWords('#pagibig_interest', '#pagibig_interest_word');
    bindNumberToWords('#parking_nsp', '#parking_nsp_word');
    bindNumberToWords('#processing_fee', '#processing_fee_word');

    //For edit customer module DRY
    bindNumberToWords('#upd_net_selling_price', '#upd_net_selling_price_word');
    bindNumberToWords('#upd_equity', '#upd_equity_word');
    bindNumberToWords('#upd_loan_amount', '#upd_loan_amount_word');
    bindNumberToWords('#upd_loan_term', '#upd_loan_term_word');
    bindNumberToWords('#upd_pagibig_interest', '#upd_pagibig_interest_word');
    bindNumberToWords('#upd_parking_nsp', '#upd_parking_nsp_word');
    bindNumberToWords('#upd_processing_fee', '#upd_processing_fee_word');

    //Validate trillion
    $('.numberInput').on('input', function () {
        //Get the raw input value
        var rawValue = $(this).val();

        //Remove anything that's not a digit or a decimal point
        var cleanedValue = rawValue.replace(/[^0-9.]/g, '');

        //Convert the cleaned string to a number
        var value = parseFloat(cleanedValue);

        //Check if it's a valid number and >= 1 trillion
        if (!isNaN(value) && value >= 1000000000000) {
            toastr.error('Error number too large.');
            $(this).val(''); // Clear the input field
        }
    });

    //Server side datatable
    $('.datatable').DataTable({
        serverSide: true,
        processing: true,
        paging: true,
        order: [],
        ajax: {
            url: '../controls/datatables/view_customer_details.ctrl.php',
            type: 'POST',
        },
        columns: [
            { data: 0, visible: false },  // ID hidden column
            { data: 1 },
            { data: 2 },
            { data: 3 },
            { data: 4 },
            { data: 5 },
            { data: 6 },
            { data: 7, orderable: false }
        ],
        createdRow: function (row, data) {
            // Add data-id attribute from the hidden ID column
            $(row).attr('data-id', data[0]);
        }
    });


    //Add customer details
    $('.submit').on('click', () => {

        //Customer details
        const customer_code = $('#customer_code').val();
        const customer_name = $('#customer_name').val();
        const customer_address = $('#customer_address').val();
        const customer_id = $('#customer_id').val();
        const customer_tct_no = $('#customer_tct_no').val();
        const customer_ctc = $('#customer_ctc').val();
        const customer_ctc_date = $('#customer_ctc_date').val();
        const customer_ctc_place = $('#customer_ctc_place').val();
        const civil_status = $('#civil_status').val();
        const citizenship = $('#citizenship').val();
        const employment = $('#employment').val();
        const designation = $('#designation').val();
        const company = $('#company').val();
        const contact_no = $('#contact_no').val();
        const gender = $('#gender').val();
        const legality = $('#legality').val();
        const customer_spouse = $('#customer_spouse').val();
        const customer_spouse_id = $('#customer_spouse_id').val();
        const customer_spouse_ctc = $('#customer_spouse_ctc').val();
        const customer_spouse_ctc_date = $('#customer_spouse_ctc_date').val();
        const customer_spouse_ctc_place = $('#customer_spouse_ctc_place').val();
        const customer_contact_company = $('#customer_contact_company').val();
        const customer_contact_position = $('#customer_contact_position').val();
        const customer_contact_address = $('#customer_contact_address').val();
        const income = $('#income').val();
        const birthdate = $('#birthdate').val();
        const email = $('#email').val();

        //House details
        const project_id = $('#project_id option:selected').val();
        const house_no = $('#house_no').val();
        const lot = $('#lot').val();
        const block = $('#block').val();
        const house_type = $('#house_type').val();
        const lot_area = $('#lot_area').val();
        const floor_area = $('#floor_area').val();
        const condo_type = $('#condo_type').val();
        const unit_no = $('#unit_no').val();
        const unit_floor_area = $('#unit_floor_area').val();
        const unit_floor = $('#unit_floor').val();
        const unit_floor_sup = $('#unit_floor_sup').val();
        const parking_unit = $('#parking_unit').val();
        const parking_unit_area = $('#parking_unit_area').val();
        const parking_title_no = $('#parking_title_no').val();
        const parking_floor = $('#parking_floor').val();
        const parking_floor_sup = $('#parking_floor_sup').val();

        //Pricing details
        const net_selling_price = $('#net_selling_price').val();
        const net_selling_price_word = $('#net_selling_price_word').val();
        const equity = $('#equity').val();
        const equity_word = $('#equity_word').val();
        const payment_term = $('#payment_term').val();
        const repricing = $('#repricing').val();
        const loan_amount = $('#loan_amount').val();
        const loan_amount_word = $('#loan_amount_word').val();
        const loan_term = $('#loan_term').val();
        const loan_term_word = $('#loan_term_word').val();
        const pagibig_interest = $('#pagibig_interest').val();
        const pagibig_interest_word = $('#pagibig_interest_word').val();
        const parking_nsp = $('#parking_nsp').val();
        const parking_nsp_word = $('#parking_nsp_word').val();
        const processing_fee = $('#processing_fee').val();
        const processing_fee_word = $('#processing_fee_word').val();
        const regfees = $('#regfees').val();
        const admin_fee = $('#admin_fee').val();
        const additional_work = $('#additional_work').val();
        const transfer_tax = $('#transfer_tax').val();
        const docstamp_tax = $('#docstamp_tax').val();

        //Technical details
        const technical_description_1 = $('#technical_description_1').val();
        const technical_description_2 = $('#technical_description_2').val();
        const house_description = $('#house_description').val();
        const purpose = $('#purpose').val();

        //Co-Borrower details
        const co_borrower_1 = $('#co_borrower_1').val();
        const co_borrower_id_1 = $('#co_borrower_id_1').val();
        const co_borrower_spouse_1 = $('#co_borrower_spouse_1').val();
        const co_borrower_ctc_1 = $('#co_borrower_ctc_1').val();
        const co_borrower_date_place_1 = $('#co_borrower_date_place_1').val();
        const co_borrower_2 = $('#co_borrower_2').val();
        const co_borrower_id_2 = $('#co_borrower_id_2').val();
        const co_borrower_spouse_2 = $('#co_borrower_spouse_2').val();
        const co_borrower_ctc_2 = $('#co_borrower_ctc_2').val();
        const co_borrower_date_place_2 = $('#co_borrower_date_place_2').val();
        const witness_a = $('#witness_a').val();
        const witness_b = $('#witness_b').val();

        //Titling details
        const submitted_to_bir = $('#submitted_to_bir').val();
        const bir_actual_release = $('#bir_actual_release').val();
        const car_process_remarks1 = $('#car_process_remarks1').val();
        const actual_dockets_preparation_for_RD = $('#actual_dockets_preparation_for_RD').val();
        const car_process_remarks2 = $('#car_process_remarks2').val();
        const actual_preparation_of_docket_for_rd = $('#actual_preparation_of_docket_for_rd').val();
        const rd_assessment_remarks1 = $('#rd_assessment_remarks1').val();
        const actual_submitted_to_rd_for_assessment = $('#actual_submitted_to_rd_for_assessment').val();
        const actual_release_of_rd_assessment = $('#actual_release_of_rd_assessment').val();
        const rd_assessment_remarks2 = $('#rd_assessment_remarks2').val();
        const rd_assessment_received = $('#rd_assessment_received').val();
        const rcp_processed_signed = $('#rcp_processed_signed').val();
        const accounting_received_rcp_for_m_check = $('#accounting_received_rcp_for_m_check').val();
        const accounting_processed_m_check = $('#accounting_processed_m_check').val();
        const accounting_m_check_for_released = $('#accounting_m_check_for_released').val();
        const check_process_remarks1 = $('#check_process_remarks1').val();
        const m_check_received = $('#m_check_received').val();
        const check_process_remarks2 = $('#check_process_remarks2').val();
        const date_submitted_to_rd = $('#date_submitted_to_rd').val();
        const estimated_date_of_release = $('#estimated_date_of_release').val();
        const actual_date_released = $('#actual_date_released').val();

        // alert('clicked');

        //Validate required fields
        if (!customer_name || !customer_address || !civil_status || !contact_no || !gender || !birthdate) {
            toastr.error('Please fill in all required fields on customer details.');
            return;
        } else if (project_id === '0') {
            toastr.error('Please select a project at house info.');
            return;
        } else {

            //Add customer 1st
            $.ajax({
                url: '../controls/add_customers.ctrl.php',
                type: 'POST',
                data: {
                    customer_code,
                    customer_name,
                    customer_address,
                    customer_id,
                    customer_tct_no,
                    customer_ctc,
                    customer_ctc_date,
                    customer_ctc_place,
                    civil_status,
                    citizenship,
                    employment,
                    designation,
                    company,
                    contact_no,
                    gender,
                    legality,
                    customer_spouse,
                    customer_spouse_id,
                    customer_spouse_ctc,
                    customer_spouse_ctc_date,
                    customer_spouse_ctc_place,
                    customer_contact_company,
                    customer_contact_position,
                    customer_contact_address,
                    income,
                    birthdate,
                    email
                },
                success: function (customer_r) {

                    const customer_id = parseInt(customer_r, 10);
                    if (customer_id > 0) {
                        // alert('Customer details saved successfully.');

                        //2nd add customer_house details 
                        $.ajax({
                            type: 'POST',
                            url: '../controls/add_customer_houses.ctrl.php',
                            data: {
                                customer_id: customer_id, //Actual inserted project ID
                                project_id: project_id,
                                house_no: house_no,
                                lot: lot,
                                block: block,
                                house_type: house_type,
                                lot_area: lot_area,
                                floor_area: floor_area,
                                condo_type: condo_type,
                                unit_no: unit_no,
                                unit_floor_area: unit_floor_area,
                                unit_floor: unit_floor,
                                unit_floor_sup: unit_floor_sup,
                                parking_unit: parking_unit,
                                parking_unit_area: parking_unit_area,
                                parking_title_no: parking_title_no,
                                parking_floor: parking_floor,
                                parking_floor_sup: parking_floor_sup,
                                net_selling_price: net_selling_price,
                                net_selling_price_word: net_selling_price_word,
                                equity: equity,
                                equity_word: equity_word,
                                payment_term: payment_term,
                                repricing: repricing,
                                loan_amount: loan_amount,
                                loan_amount_word: loan_amount_word,
                                loan_term: loan_term,
                                loan_term_word: loan_term_word,
                                pagibig_interest: pagibig_interest,
                                pagibig_interest_word: pagibig_interest_word,
                                parking_nsp: parking_nsp,
                                parking_nsp_word: parking_nsp_word,
                                processing_fee: processing_fee,
                                processing_fee_word: processing_fee_word,
                                regfees: regfees,
                                admin_fee: admin_fee,
                                additional_work: additional_work,
                                transfer_tax: transfer_tax,
                                docstamp_tax: docstamp_tax,
                                technical_description_1: technical_description_1,
                                technical_description_2: technical_description_2,
                                house_description: house_description,
                                purpose: purpose,
                                co_borrower_1: co_borrower_1,
                                co_borrower_id_1: co_borrower_id_1,
                                co_borrower_spouse_1: co_borrower_spouse_1,
                                co_borrower_ctc_1: co_borrower_ctc_1,
                                co_borrower_date_place_1: co_borrower_date_place_1,
                                co_borrower_2: co_borrower_2,
                                co_borrower_id_2: co_borrower_id_2,
                                co_borrower_spouse_2: co_borrower_spouse_2,
                                co_borrower_ctc_2: co_borrower_ctc_2,
                                co_borrower_date_place_2: co_borrower_date_place_2,
                                witness_a: witness_a,
                                witness_b: witness_b
                            },
                            success: (customer_house_r) => {

                                const customer_house_id = parseInt(customer_house_r, 10);
                                if (customer_house_id > 0) {
                                    // alert('Customer house details saved successfully.');

                                    //3rd add contract_titling_monitoring details 
                                    $.ajax({
                                        type: 'POST',
                                        url: '../controls/add_contract_titling_monitorings.ctrl.php',
                                        data: {
                                            project_id: project_id,
                                            customer_id: customer_id, //Actual inserted project ID
                                            customer_house_id: customer_house_id, //Actual inserted project ID
                                            submitted_to_bir: submitted_to_bir,
                                            bir_actual_release: bir_actual_release,
                                            car_process_remarks1: car_process_remarks1,
                                            actual_dockets_preparation_for_RD: actual_dockets_preparation_for_RD,
                                            car_process_remarks2: car_process_remarks2,
                                            actual_preparation_of_docket_for_rd: actual_preparation_of_docket_for_rd,
                                            rd_assessment_remarks1: rd_assessment_remarks1,
                                            actual_submitted_to_rd_for_assessment: actual_submitted_to_rd_for_assessment,
                                            actual_release_of_rd_assessment: actual_release_of_rd_assessment,
                                            rd_assessment_remarks2: rd_assessment_remarks2,
                                            rd_assessment_received: rd_assessment_received,
                                            rcp_processed_signed: rcp_processed_signed,
                                            accounting_received_rcp_for_m_check: accounting_received_rcp_for_m_check,
                                            accounting_processed_m_check: accounting_processed_m_check,
                                            accounting_m_check_for_released: accounting_m_check_for_released,
                                            check_process_remarks1: check_process_remarks1,
                                            m_check_received: m_check_received,
                                            check_process_remarks2: check_process_remarks2,
                                            date_submitted_to_rd: date_submitted_to_rd,
                                            estimated_date_of_release: estimated_date_of_release,
                                            actual_date_released: actual_date_released
                                        },
                                        success: (contract_titling_monitoring_r) => {

                                            if (contract_titling_monitoring_r > 0) {
                                                toastr.success('Customer details saved successfully.');
                                                setTimeout(function () {
                                                    location.href = 'customer_details.php';
                                                }, 2000);
                                            } else {
                                                toastr.error('Failed to save contract titling monitoring details.');
                                            }
                                        }
                                    });

                                } else {
                                    toastr.error('Failed to save customer house details.');
                                }
                            }
                        });

                    } else {
                        toastr.error('Failed to save customer details.');
                    }
                }
            });
        }
    });

    //View project details using button
    $('.datatable').on('click', '.view_all', function (e) {
        e.preventDefault();

        const id = $(this).data('id');
        window.location.href = '../../sas/production/view_customer_details.php?id=' + encodeURIComponent(id);
    });

    //View by clicking cells
    $('.datatable').on('dblclick', 'tbody tr', function (e) {
        e.preventDefault();

        const project_contract_Id = $(this).data('id');
        window.location.href = '../../sas/production/view_customer_details.php?id=' + encodeURIComponent(project_contract_Id);
    });

    //Delete customer details
    $('.datatable').on('click', '.delete', function (e) {
        e.preventDefault();

        const id = $(this).data('id');

        if (confirm('Are you sure you want to delete this customer detail?')) {
            $.ajax({
                type: 'POST',
                url: '../controls/delete_customer_details.ctrl.php',
                data: {
                    id: id
                },
                success: (r) => {
                    if (r > 0) {
                        toastr.success('Deleted successfully.');
                        setTimeout(function () {
                            $('.datatable').DataTable().ajax.reload(null, false);
                        }, 2000);
                    } else {
                        toastr.error('Failed to delete');
                    }
                }
            });
        }
    });

    //Update customer details
    $('.update').on('click', () => {

        //Customer details
        const upd_custom_id = $('#upd_custom_id').val();
        const upd_customer_code = $('#upd_customer_code').val();
        const upd_customer_name = $('#upd_customer_name').val();
        const upd_customer_address = $('#upd_customer_address').val();
        const upd_customer_id = $('#upd_customer_id').val();
        const upd_customer_tct_no = $('#upd_customer_tct_no').val();
        const upd_customer_ctc = $('#upd_customer_ctc').val();
        const upd_customer_ctc_date = $('#upd_customer_ctc_date').val();
        const upd_customer_ctc_place = $('#upd_customer_ctc_place').val();
        const upd_civil_status = $('#upd_civil_status').val();
        const upd_citizenship = $('#upd_citizenship').val();
        const upd_employment = $('#upd_employment').val();
        const upd_designation = $('#upd_designation').val();
        const upd_company = $('#upd_company').val();
        const upd_contact_no = $('#upd_contact_no').val();
        const upd_gender = $('#upd_gender').val();
        const upd_legality = $('#upd_legality').val();
        const upd_customer_spouse = $('#upd_customer_spouse').val();
        const upd_customer_spouse_id = $('#upd_customer_spouse_id').val();
        const upd_customer_spouse_ctc = $('#upd_customer_spouse_ctc').val();
        const upd_customer_spouse_ctc_date = $('#upd_customer_spouse_ctc_date').val();
        const upd_customer_spouse_ctc_place = $('#upd_customer_spouse_ctc_place').val();
        const upd_customer_contact_company = $('#upd_customer_contact_company').val();
        const upd_customer_contact_position = $('#upd_customer_contact_position').val();
        const upd_customer_contact_address = $('#upd_customer_contact_address').val();
        const upd_income = $('#upd_income').val();
        const upd_birthdate = $('#upd_birthdate').val();
        const upd_email = $('#upd_email').val();

        //House details
        const upd_house_id = $('#upd_house_id').val();
        const upd_project_id = $('#upd_project_id option:selected').val();
        const upd_house_no = $('#upd_house_no').val();
        const upd_lot = $('#upd_lot').val();
        const upd_block = $('#upd_block').val();
        const upd_house_type = $('#upd_house_type').val();
        const upd_lot_area = $('#upd_lot_area').val();
        const upd_floor_area = $('#upd_floor_area').val();
        const upd_condo_type = $('#upd_condo_type').val();
        const upd_unit_no = $('#upd_unit_no').val();
        const upd_unit_floor_area = $('#upd_unit_floor_area').val();
        const upd_unit_floor = $('#upd_unit_floor').val();
        const upd_unit_floor_sup = $('#upd_unit_floor_sup').val();
        const upd_parking_unit = $('#upd_parking_unit').val();
        const upd_parking_unit_area = $('#upd_parking_unit_area').val();
        const upd_parking_title_no = $('#upd_parking_title_no').val();
        const upd_parking_floor = $('#upd_parking_floor').val();
        const upd_parking_floor_sup = $('#upd_parking_floor_sup').val();

        //Pricing details
        const upd_net_selling_price = $('#upd_net_selling_price').val();
        const upd_net_selling_price_word = $('#upd_net_selling_price_word').val();
        const upd_equity = $('#upd_equity').val();
        const upd_equity_word = $('#upd_equity_word').val();
        const upd_payment_term = $('#upd_payment_term').val();
        const upd_repricing = $('#upd_repricing').val();
        const upd_loan_amount = $('#upd_loan_amount').val();
        const upd_loan_amount_word = $('#upd_loan_amount_word').val();
        const upd_loan_term = $('#upd_loan_term').val();
        const upd_loan_term_word = $('#upd_loan_term_word').val();
        const upd_pagibig_interest = $('#upd_pagibig_interest').val();
        const upd_pagibig_interest_word = $('#upd_pagibig_interest_word').val();
        const upd_parking_nsp = $('#upd_parking_nsp').val();
        const upd_parking_nsp_word = $('#upd_parking_nsp_word').val();
        const upd_processing_fee = $('#upd_processing_fee').val();
        const upd_processing_fee_word = $('#upd_processing_fee_word').val();
        const upd_regfees = $('#upd_regfees').val();
        const upd_admin_fee = $('#upd_admin_fee').val();
        const upd_additional_work = $('#upd_additional_work').val();
        const upd_transfer_tax = $('#upd_transfer_tax').val();
        const upd_docstamp_tax = $('#upd_docstamp_tax').val();

        //Technical details
        const upd_technical_description_1 = $('#upd_technical_description_1').val();
        const upd_technical_description_2 = $('#upd_technical_description_2').val();
        const upd_house_description = $('#upd_house_description').val();
        const upd_purpose = $('#upd_purpose').val();

        //Co-Borrower details
        const upd_co_borrower_1 = $('#upd_co_borrower_1').val();
        const upd_co_borrower_id_1 = $('#upd_co_borrower_id_1').val();
        const upd_co_borrower_spouse_1 = $('#upd_co_borrower_spouse_1').val();
        const upd_co_borrower_ctc_1 = $('#upd_co_borrower_ctc_1').val();
        const upd_co_borrower_date_place_1 = $('#upd_co_borrower_date_place_1').val();
        const upd_co_borrower_2 = $('#upd_co_borrower_2').val();
        const upd_co_borrower_id_2 = $('#upd_co_borrower_id_2').val();
        const upd_co_borrower_spouse_2 = $('#upd_co_borrower_spouse_2').val();
        const upd_co_borrower_ctc_2 = $('#upd_co_borrower_ctc_2').val();
        const upd_co_borrower_date_place_2 = $('#upd_co_borrower_date_place_2').val();
        const upd_witness_a = $('#upd_witness_a').val();
        const upd_witness_b = $('#upd_witness_b').val();

        //Titling details
        const upd_cont_tit_id = $('#upd_cont_tit_id').val();
        const upd_submitted_to_bir = $('#upd_submitted_to_bir').val();
        const upd_bir_actual_release = $('#upd_bir_actual_release').val();
        const upd_car_process_remarks1 = $('#upd_car_process_remarks1').val();
        const upd_actual_dockets_preparation_for_RD = $('#upd_actual_dockets_preparation_for_RD').val();
        const upd_car_process_remarks2 = $('#upd_car_process_remarks2').val();
        const upd_actual_preparation_of_docket_for_rd = $('#upd_actual_preparation_of_docket_for_rd').val();
        const upd_rd_assessment_remarks1 = $('#upd_rd_assessment_remarks1').val();
        const upd_actual_submitted_to_rd_for_assessment = $('#upd_actual_submitted_to_rd_for_assessment').val();
        const upd_actual_release_of_rd_assessment = $('#upd_actual_release_of_rd_assessment').val();
        const upd_rd_assessment_remarks2 = $('#upd_rd_assessment_remarks2').val();
        const upd_rd_assessment_received = $('#upd_rd_assessment_received').val();
        const upd_rcp_processed_signed = $('#upd_rcp_processed_signed').val();
        const upd_accounting_received_rcp_for_m_check = $('#upd_accounting_received_rcp_for_m_check').val();
        const upd_accounting_processed_m_check = $('#upd_accounting_processed_m_check').val();
        const upd_accounting_m_check_for_released = $('#upd_accounting_m_check_for_released').val();
        const upd_check_process_remarks1 = $('#upd_check_process_remarks1').val();
        const upd_m_check_received = $('#upd_m_check_received').val();
        const upd_check_process_remarks2 = $('#upd_check_process_remarks2').val();
        const upd_date_submitted_to_rd = $('#upd_date_submitted_to_rd').val();
        const upd_estimated_date_of_release = $('#upd_estimated_date_of_release').val();
        const upd_actual_date_released = $('#upd_actual_date_released').val();

        // alert('clicked');

        // Validate required fields
        if (!upd_customer_name || !upd_customer_address || !upd_civil_status || !upd_contact_no || !upd_gender || !upd_birthdate) {
            toastr.error('Please fill in all required fields on customer details.');
            return;
        } else if (upd_project_id === '0') {
            toastr.error('Please select a project at house info.');
            return;
        } else {
            // Update customer details
            $.ajax({
                url: '../controls/update_customers.ctrl.php',
                type: 'POST',
                data: {
                    upd_custom_id: upd_custom_id,
                    customer_code: upd_customer_code,
                    customer_name: upd_customer_name,
                    customer_address: upd_customer_address,
                    customer_id: upd_customer_id,
                    customer_tct_no: upd_customer_tct_no,
                    customer_ctc: upd_customer_ctc,
                    customer_ctc_date: upd_customer_ctc_date,
                    customer_ctc_place: upd_customer_ctc_place,
                    civil_status: upd_civil_status,
                    citizenship: upd_citizenship,
                    employment: upd_employment,
                    designation: upd_designation,
                    company: upd_company,
                    contact_no: upd_contact_no,
                    gender: upd_gender,
                    legality: upd_legality,
                    customer_spouse: upd_customer_spouse,
                    customer_spouse_id: upd_customer_spouse_id,
                    customer_spouse_ctc: upd_customer_spouse_ctc,
                    customer_spouse_ctc_date: upd_customer_spouse_ctc_date,
                    customer_spouse_ctc_place: upd_customer_spouse_ctc_place,
                    customer_contact_company: upd_customer_contact_company,
                    customer_contact_position: upd_customer_contact_position,
                    customer_contact_address: upd_customer_contact_address,
                    income: upd_income,
                    birthdate: upd_birthdate,
                    email: upd_email
                },
                success: function (customer_r) {
                    // const customer_id = parseInt(customer_r, 10);
                    if (customer_r > 0) {

                        // Update customer house details
                        $.ajax({
                            type: 'POST',
                            url: '../controls/update_customer_houses.ctrl.php',
                            data: {
                                upd_house_id: upd_house_id,
                                project_id: upd_project_id,
                                house_no: upd_house_no,
                                lot: upd_lot,
                                block: upd_block,
                                house_type: upd_house_type,
                                lot_area: upd_lot_area,
                                floor_area: upd_floor_area,
                                condo_type: upd_condo_type,
                                unit_no: upd_unit_no,
                                unit_floor_area: upd_unit_floor_area,
                                unit_floor: upd_unit_floor,
                                unit_floor_sup: upd_unit_floor_sup,
                                parking_unit: upd_parking_unit,
                                parking_unit_area: upd_parking_unit_area,
                                parking_title_no: upd_parking_title_no,
                                parking_floor: upd_parking_floor,
                                parking_floor_sup: upd_parking_floor_sup,
                                net_selling_price: upd_net_selling_price,
                                net_selling_price_word: upd_net_selling_price_word,
                                equity: upd_equity,
                                equity_word: upd_equity_word,
                                payment_term: upd_payment_term,
                                repricing: upd_repricing,
                                loan_amount: upd_loan_amount,
                                loan_amount_word: upd_loan_amount_word,
                                loan_term: upd_loan_term,
                                loan_term_word: upd_loan_term_word,
                                pagibig_interest: upd_pagibig_interest,
                                pagibig_interest_word: upd_pagibig_interest_word,
                                parking_nsp: upd_parking_nsp,
                                parking_nsp_word: upd_parking_nsp_word,
                                processing_fee: upd_processing_fee,
                                processing_fee_word: upd_processing_fee_word,
                                regfees: upd_regfees,
                                admin_fee: upd_admin_fee,
                                additional_work: upd_additional_work,
                                transfer_tax: upd_transfer_tax,
                                docstamp_tax: upd_docstamp_tax,
                                technical_description_1: upd_technical_description_1,
                                technical_description_2: upd_technical_description_2,
                                house_description: upd_house_description,
                                purpose: upd_purpose,
                                co_borrower_1: upd_co_borrower_1,
                                co_borrower_id_1: upd_co_borrower_id_1,
                                co_borrower_spouse_1: upd_co_borrower_spouse_1,
                                co_borrower_ctc_1: upd_co_borrower_ctc_1,
                                co_borrower_date_place_1: upd_co_borrower_date_place_1,
                                co_borrower_2: upd_co_borrower_2,
                                co_borrower_id_2: upd_co_borrower_id_2,
                                co_borrower_spouse_2: upd_co_borrower_spouse_2,
                                co_borrower_ctc_2: upd_co_borrower_ctc_2,
                                co_borrower_date_place_2: upd_co_borrower_date_place_2,
                                witness_a: upd_witness_a,
                                witness_b: upd_witness_b
                            },
                            success: function (customer_house_r) {
                                // const customer_house_id = parseInt(customer_house_r, 10);
                                if (customer_house_r > 0) {
                                    // Update contract titling monitoring details
                                    $.ajax({
                                        type: 'POST',
                                        url: '../controls/update_contract_titling_monitorings.ctrl.php',
                                        data: {
                                            upd_cont_tit_id: upd_cont_tit_id,
                                            submitted_to_bir: upd_submitted_to_bir,
                                            bir_actual_release: upd_bir_actual_release,
                                            car_process_remarks1: upd_car_process_remarks1,
                                            actual_dockets_preparation_for_RD: upd_actual_dockets_preparation_for_RD,
                                            car_process_remarks2: upd_car_process_remarks2,
                                            actual_preparation_of_docket_for_rd: upd_actual_preparation_of_docket_for_rd,
                                            rd_assessment_remarks1: upd_rd_assessment_remarks1,
                                            actual_submitted_to_rd_for_assessment: upd_actual_submitted_to_rd_for_assessment,
                                            actual_release_of_rd_assessment: upd_actual_release_of_rd_assessment,
                                            rd_assessment_remarks2: upd_rd_assessment_remarks2,
                                            rd_assessment_received: upd_rd_assessment_received,
                                            rcp_processed_signed: upd_rcp_processed_signed,
                                            accounting_received_rcp_for_m_check: upd_accounting_received_rcp_for_m_check,
                                            accounting_processed_m_check: upd_accounting_processed_m_check,
                                            accounting_m_check_for_released: upd_accounting_m_check_for_released,
                                            check_process_remarks1: upd_check_process_remarks1,
                                            m_check_received: upd_m_check_received,
                                            check_process_remarks2: upd_check_process_remarks2,
                                            date_submitted_to_rd: upd_date_submitted_to_rd,
                                            estimated_date_of_release: upd_estimated_date_of_release,
                                            actual_date_released: upd_actual_date_released
                                        },
                                        success: function (contract_titling_monitoring_r) {
                                            if (contract_titling_monitoring_r > 0) {
                                                // alert('Contract titling monitoring details updated successfully.');
                                                // Optionally reload datatable or page
                                                // $('.datatable').DataTable().ajax.reload(null, false);

                                                toastr.success('Customer details updated successfully.');
                                                setTimeout(function () {
                                                    location.href = 'customer_details.php';
                                                }, 2000);
                                            } else {
                                                toastr.error('Failed to update contract titling monitoring details.');
                                            }
                                        }
                                    });
                                } else {
                                    toastr.error('Failed to update customer house details.');
                                }
                            }
                        });
                    } else {
                        toastr.error('Failed to update customer details.');
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

