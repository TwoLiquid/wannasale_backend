<script>

    $(document).ready(function() {

        var modalClientsMerge = $('#modalClientsMerge'),
            clientsMergeButton = $('.clientsMergeButton'),
            modalSimilarTable = $('#modalSimilarTable'),
            modalSimilarSecondStep = $('#modalSimilarSecondStep'),
            modalMergeTable = $('#modalMergeTable'),
            modalSimilarInfo = $('#modalSimilarInfo');

        clientsMergeButton.each(function () {
            $(this).on('click', function () {
                modalClientsMerge.data('current-client-id', $(this).data('client-id'));
                modalClientsMerge.data('current-client-name', $(this).data('client-name'));
                modalClientsMerge.data('current-client-phone', $(this).data('client-phone'));
            });
        });

        modalClientsMerge.on('hidden.bs.modal', function () {
            modalMergeTable.find('tbody').html('');
            modalSimilarTable.find('tbody').html('');
            modalSimilarInfo.text('Выберите клиента, с которым вы хотите связать текущего');
            $('#modalClientMergeChoose').show();
            $('#modalClientMergeSubmit').hide();
            modalSimilarTable.show();
            modalMergeTable.hide();

        });

        modalClientsMerge.on('show.bs.modal', function () {
            var currentClientId = $(this).data('current-client-id');

            $.get(
                '/clients/' + currentClientId + '/similar',
                function (response) {
                    if (response.data.similar != null) {
                        for (key in response.data.similar) {
                            var name = response.data.similar[key].name === null ? '' : response.data.similar[key].name;
                            var phone = response.data.similar[key].phone === null ? '' : response.data.similar[key].phone;

                            modalSimilarTable.find('tbody').append('<tr data-client-id="' + response.data.similar[key].id + '"' +
                                'data-client-name="' + name + '"' +
                                'data-client-phone="' + phone + '">' +
                                '<td><label>' + name + '</label> </td>' +
                                '<td><label>' + phone + '</label> </td>' +
                                '<td class="text-right"><input class="checking" type="checkbox"></td></tr>');
                        }
                    }
                }
            );
        });

        $('#modalClientMergeChoose').on('click', function () {

            var currentClientId = $('#modalClientsMerge').data('current-client-id');
            var currentClientName = $('#modalClientsMerge').data('current-client-name');
            var currentClientPhone = $('#modalClientsMerge').data('current-client-phone');

            var inputName = currentClientName !== '' ? '<input class="hiddenMergeCheckbox" type="radio" name="name" checked>' : '';
            var inputPhone = currentClientPhone !== '' ? '<input class="hiddenMergeCheckbox" type="radio" name="phone" checked>' : '';

            var html = '<tr data-client-id="' + currentClientId + '" data-client-name="' + currentClientName + '" data-client-phone="' + currentClientPhone + '">' +
                '<td style="background-color: #ccfaf1;"><label class="mergeName">' + currentClientName + '</label> ' + inputName + '</td>' +
                '<td style="background-color: #ccfaf1;"><label class="mergePhone">' + currentClientPhone + '</label> ' + inputPhone + '</td></tr>';

            $('.checking').each(function () {
                if ($(this).prop('checked')) {
                    var client_id = $(this).parent().parent().data('client-id');
                    var name = $(this).parent().parent().data('client-name');
                    var phone = $(this).parent().parent().data('client-phone');
                    var inputName = name === '' ? '' : '<input class="hiddenMergeCheckbox" type="radio" name="name">';
                    var inputPhone = phone === '' ? '' : '<input class="hiddenMergeCheckbox" type="radio" name="phone">';

                    html += '<tr data-client-id="' + client_id + '" data-client-name="' + name + '" data-client-phone="' + phone + '" class="mergeClient">' +
                        '<td><label>' + name + '</label> ' + inputName + '</td>' +
                        '<td><label>' + phone + '</label> ' + inputPhone + '</td></tr>';
                }
            });

            modalSimilarTable.hide();
            modalMergeTable.show();
            modalMergeTable.append(html);

            $('#modalClientMergeChoose').hide();
            $('#modalClientMergeSubmit').show();
            modalSimilarInfo.text('Выберите те имя и номер телефона, которые хотите оставить после слияния выбранных клиентов');
        });

        $(document).on('change', '.checking', function () {
            var matches = 0;
            $('.checking').each(function () {
                if ($(this).prop('checked')) {
                    matches++;
                }
            });
            if (matches > 0) {
                $('#modalClientMergeChoose button').prop('disabled', false);
            } else {
                $('#modalClientMergeChoose button').prop('disabled', true);
            }
        });

        $(document).on('change', '.hiddenMergeCheckbox', function () {
            if ($(this).attr('name') == 'name') {
                var name = $(this).prev('label').text();
                $('#mergeName').val(name);
            }

            if ($(this).attr('name') == 'phone') {
                var phone = $(this).prev('label').text();
                $('#mergePhone').val(phone);
            }
        });

        $('#modalClientMergeSubmit button').on('click', function () {
            var nameInputs = $("input[name=name]:checked"),
                phoneInputs = $("input[name=phone]:checked");

            if (nameInputs.length > 1) {
                return false;
            }

            if (phoneInputs.length > 1) {
                return false;
            }

            $('#modalMergeTable tbody tr.mergeClient').each(function () {
                var clientId = $(this).data('client-id');
                $('#mergeClientsForm').append('<input type="hidden" name="clients[]" value="' + clientId + '">');
            });

            var mainClientId = $('#modalClientsMerge').data('current-client-id');
            $('#mergeClientsForm').attr('action', '/clients/' + mainClientId + '/similar/update');
            $('#mergeClientsForm').submit();
        });
    });

</script>