
//--------------------------------------------------------------------------
// Sortable functions

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var changePosition = function(requestData, action) {
    $.ajax({
        'url': action,
        'type': 'POST',
        'data': requestData,
        'success': function(data) {
            if (! data.success) {
                console.error(requestData, action, data.errors);
            }
        },
        'error': function() {
            console.error('Sortable: Order change failed!');
        }
    });
};

function sortableMove(a, b, entityName, action) {
    var $sorted = b.item;

    var $previous = $sorted.prev();
    var $next = $sorted.next();

    if ($previous.length > 0) {
        changePosition({
            parentId: $sorted.data('parent-id'),
            type: 'moveAfter',
            entityName: entityName,
            id: $sorted.data('item-id'),
            positionEntityId: $previous.data('item-id')
        }, action);
    } else if ($next.length > 0) {
        changePosition({
            parentId: $sorted.data('parent-id'),
            type: 'moveBefore',
            entityName: entityName,
            id: $sorted.data('item-id'),
            positionEntityId: $next.data('item-id')
        }, action);
    } else {
        console.error('Sortable: Something wrong!');
    }
}

$(document).ready(function() {

    //--------------------------------------------------------------------------
    // CSRF-token

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //--------------------------------------------------------------------------
    // Feather icons

    feather.replace({
        width  : 16,
        height : 16
    });

    //--------------------------------------------------------------------------
    // Alerts disappearance

    var $alerts = $('.alert');
    if ($alerts.length) {
        window.setTimeout(function() {
            $alerts.closest('.pgn-wrapper').fadeOut();
        }, 4000);
    }

    //--------------------------------------------------------------------------
    // Modals

    // Action confirmation:
    $('#modalConfirm').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget),
            link   = button.data('link'),
            method = button.data('method') ? button.data('method') : 'post',
            modal  = $(this),
            form   = modal.find('#confirmForm');
        form.attr('action', link);
        form.attr('method', method);
    });

    // Loading:
    $('form.with-loading :submit').click(function () {
        var $form = $(this).closest('form');
        if ($form.length > 0 && $form[0].checkValidity()) {
            $('#modalLoading').modal('show');
        }
    });

    //--------------------------------------------------------------------------
    // Clipboard Widget Copy
    var $clipboardWidgetTextarea = $('#clipboardWidgetCopyButton');
    $clipboardWidgetTextarea.click(function () {
        var textarea = document.getElementById('clipboardWidgetTextarea');
        textarea.select();
        document.execCommand("copy");

        $('#clipboardWidgetCopyAlert').show();

        setTimeout(function () {
            $('#clipboardWidgetCopyAlert').hide();
        }, 3000);

        return false;
    });

    //--------------------------------------------------------------------------
    // Clipboard Button Copy
    var $clipboardButtonTextarea = $('#clipboardButtonCopyButton');
    $clipboardButtonTextarea.click(function () {
        var textarea = document.getElementById('clipboardButtonTextarea');
        textarea.select();
        document.execCommand("copy");

        $('#clipboardButtonCopyAlert').show();

        setTimeout(function () {
            $('#clipboardButtonCopyAlert').hide();
        }, 3000);

        return false;
    });

    //--------------------------------------------------------------------------
    // Sortable

    // Simple lists:
    var $sortableBlocks = $('.sortable');
    $sortableBlocks.each(function() {
        var $block = $(this);
        $block.sortable({
            handle: '.list-group-handler',
            axis: 'y',
            update: function(a, b){
                sortableMove(a, b, $block.data('entity'), $block.data('action'));
            },
            placeholder: "list-placeholder",
            cursor: "move",
            items: "> li"
        });
    });

    //--------------------------------------------------------------------------
    // DataTables

    // General settings:
    var settings = {
        "sDom": "<'table-responsive't><'row'<p i>>",
        "sPaginationType": "bootstrap",
        "destroy": true,
        "scrollCollapse": true,
        "oLanguage": {
            "sLengthMenu": "_MENU_ ",
            "sInfo": "Показаны с <b>_START_ по _END_</b> из _TOTAL_ записей",
            "sZeroRecords": "Нет записей",
            "sInfoEmpty": "Нечего отображать",
            "sInfoFiltered": "(отфильтровано из _MAX_ записей)",
            "oPaginate": {
                "sPrevious": "Предыдущая",
                "sNext": "Следующая",
                "sLast": "Последняя",
                "sFirst": "Первая"
            }
        },
        "iDisplayLength": 20
    };

    // All tables init:
    $(".datatable").each(function () {
        var table = $(this),
            ownSettings = settings,
            searchInput = table.parent().parent().find('.search-table').first();

        if (table.data('sort-column') && table.data('sort-order')) {
            ownSettings['order'] = [[ table.data('sort-column'), table.data('sort-order') ]];
        }
        else {
            ownSettings["aaSorting"] = [];
        }
        table.dataTable(ownSettings);

        if (searchInput.length) {
            searchInput.keyup(function() {
                table.fnFilter($(this).val());
            });
        }
    });

    //--------------------------------------------------------------------------
    // Bootstrap-like file input

    $('.file-input').bootstrapFileInput();

    //--------------------------------------------------------------------------
    // Image input preview

    $(".image-input").change(function() {
        var input = this,
            result = $(this).closest('.form-group').find(".image-preview");
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                result.attr('src', e.target.result);
                result.data('src', e.target.result);
                result.show();
            };

            reader.readAsDataURL(input.files[0]);
        }
        else {
            result.attr('src', result.data('placeholder'));
        }
    });

    //--------------------------------------------------------------------------
    // Checkboxes for image/file inputs clear

    $('.remove-image-checkbox').change(function() {
        var checkbox = $(this),
            input = checkbox.closest('.form-group').find(".image-input"),
            preview = checkbox.closest('.form-group').find(".image-preview");
        if (checkbox.is(':checked')) {
            preview.attr('src', preview.data('placeholder'));
            input.addClass('disabled');
        }
        else {
            preview.attr('src', preview.data('src'));
            input.removeClass('disabled');
        }
    });

    $('.remove-file-checkbox').change(function() {
        var checkbox = $(this),
            input = checkbox.closest('.form-group').find(".file-input");
        if (checkbox.is(':checked')) {
            input.addClass('disabled');
        }
        else {
            input.removeClass('disabled');
        }
    });

    //--------------------------------------------------------------------------
    // Textareas autosizing

    autosize($('textarea:not(.not-resized)'));

    //--------------------------------------------------------------------------
    // Datepicker

    $('.dateonlypicker').datetimepicker({
        lang: 'ru',
        timepicker: false,
        format: 'd.m.Y',
        scrollInput: false,
        dayOfWeekStart: 1
    });

    //--------------------------------------------------------------------------
    // Timepicker

    $('.timepicker').datetimepicker({
        lang: 'ru',
        timepicker: true,
        datepicker:false,
        format: 'H:i',
        scrollInput: false,
        dayOfWeekStart: 1,
        step: 10
    });

    //--------------------------------------------------------------------------
    // Datetimepicker

    $('.datetimepicker').datetimepicker({
        lang: 'ru',
        timepicker: true,
        format: 'd.m.Y H:i',
        scrollInput: false,
        dayOfWeekStart: 1
    });

    //--------------------------------------------------------------------------
    // Disabling number inputs scroll and form submit on Enter

    $('form').on('focus', 'input[type=number]', function (e) {
        $(this).on('mousewheel.disableScroll', function (e) {
            e.preventDefault()
        })
    }).on('blur', 'input[type=number]', function (e) {
        $(this).off('mousewheel.disableScroll')
    });

    $('form:not(.enter-submit) input').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    //--------------------------------------------------------------------------
    // Select2

    $('.select2tags').each(function() {
        var source = $(this).data('source') ? $(this).data('source').split(",") : [];
        $(".select2tags").select2({
            tags: source,
            tokenSeparators: [","],
            placeholder: function() {
                $(this).data('placeholder');
            }
        });
    });

    //--------------------------------------------------------------------------
    // Vendor select

    $('#headerVendorSelect').change(function () {
        var slug = $(this).val(),
            domain = $(this).data('domain');

        window.location.href = '//' + slug + '.' + domain;
    });

    if ( $('#button_text').length > 0 ) {
        $('#previewButton').text($('#button_text').val());

        $('#button_text').keyup(function () {
            $('#previewButton').text($(this).val());
        });
    }

    if ( $('#checkbox_text').length > 0 ) {
        $('#wannaCheckLabel').text($('#checkbox_text').val());

        $('#checkbox_text').keyup(function () {
            $('#wannaCheckLabel').text($(this).val());
        });
    }

    if ( $('#window_button_text').length > 0 ) {
        $('#wannaSaleSubmit').text($('#window_button_text').val());

        $('#window_button_text').keyup(function () {
            $('#wannaSaleSubmit').text($(this).val());
        });
    }

    if ( $('#button_color').length > 0 ) {
        $('#previewButton').css('background-color', $('#button_color').val());

        /* $('#button_color').keyup(function () {
            // alert('пидар');
            buttonColorPicker = new CP(document.getElementById('button_color'));
            // buttonColorPicker.set('rgb(255, 255, 255)');
            buttonColorPicker.fire("change", ['000000']);
        }); */


        /* var buttonColorPicker = new CP(document.getElementById('button_color'));
        buttonColorPicker.fire("change", [buttonColorPicker]);
        alert(buttonColorPicker); */

        /* buttonColorPicker.on("change", function(color) {

            if (colorPickerId == 'button_color') {
                buttonColorPicker.on("change", function (color) {
                    $('#previewButton').css('background-color', '#' + color);
                });
            }
        }); */

        /* colorPicker.on("change", function(color) {

            if (colorPickerId == 'button_color') {
                colorPicker.on("change", function (color) {
                    $('#previewButton').css('background-color', '#' + color);
                });
            }
        }); */
    }

    if ( $('#window_button_color').length > 0 ) {
        $('#wannaSaleSubmit').css('background-color', $('#window_button_color').val());
    }

    if ( $('#window_button_text_color').length > 0 ) {
        $('#wannaSaleSubmit').css('color', $('#window_button_text_color').val());
    }

    if ( $('#button_text_color').length > 0 ) {
        $('#previewButton').css('color', $('#button_text_color').val());
    }

    if ( $('#checkbox_text_color').length > 0 ) {
        $('#wannaCheckLabel').css('color', $('#checkbox_text_color').val());
    }

    if ( $('#button_width').length > 0 ) {
        $('#previewButton').css('width', $('#button_width').val());

        $('#button_width').keyup(function () {
            if ($('#button_width_percent').is(':checked')) {
                $('#previewButton').css('width', $('#button_width').val() + '%');
            } else {
                $('#previewButton').css('width', $('#button_width').val() + 'px');
            }
        });
    }

    if ( $('#button_font_size').length > 0 ) {
        $('#previewButton').css('font-size', $('#button_font_size').val() + 'px');

        $('#button_font_size').keyup(function () {
            $('#previewButton').css('font-size', $('#button_font_size').val() + 'px');
        });
    }

    if ( $('#button_width_percent').length > 0 ) {

        if ($('#button_width_percent').is(':checked')) {
            var buttonWidth = $('#button_width').val();
            $('#previewButton').css('width', buttonWidth + '%');
        }

        $('#button_width_percent').change(function () {
            if ($(this).is(':checked')) {
                $('#previewButton').css('width', $('#button_width').val() + '%');
            } else {
                $('#previewButton').css('width', $('#button_width').val() + 'px');
            }
        });
    }

    if ( $('#button_height').length > 0 ) {
        $('#previewButton').css('height', $('#button_height').val());

        $('#button_height').keyup(function () {
            $('#previewButton').css('height', $('#button_height').val());
        });
    }

    if ( $('#title_text').length > 0 ) {
        $('#previewTitle').text($('#title_text').val());

        $('#title_text').keyup(function () {
            $('#previewTitle').text($(this).val());
        });
    }

    if ( $('#title_color').length > 0 ) {
        $('#previewTitle').css('color', $('#title_color').val());
    }

    if ( $('#text').length > 0 ) {
        $('#previewText').text($('#text').val());

        $('#text').keyup(function () {
            $('#previewText').text($(this).val());
        });
    }

    if ( $('#background_color').length > 0 ) {
        $('#previewContainer').css('background-color', $('#background_color').val());
    }

    if ( $('#message_background_color').length > 0 ) {
        $('#previewMessage').css('background-color', $('#message_background_color').val());
    }

    if ( $('#message_text_color').length > 0 ) {
        $('#previewMessage').css('color', $('#message_text_color').val());
    }

    if ( $('#message_text').length > 0 ) {
        $('#previewMessage').text($('#message_text').val());

        $('#message_text').keyup(function () {
            $('#previewMessage').text($(this).val());
        });
    }

    $('.colorPickerInput').each(function () {
        var colorPickerId = $(this).attr('id');
        var colorPicker = new CP(document.getElementById(colorPickerId));

        colorPicker.on("change", function(color) {
            this.source.value = '#' + color;

            if (this.source.id == 'button_color') {
                $('#previewButton').css('background-color', '#' + color);
            }
            if (this.source.id == 'button_text_color') {
                $('#previewButton').css('color', '#' + color);
            }
            if (this.source.id == 'title_color') {
                $('#previewTitle').css('color', '#' + color);
            }
            if (this.source.id == 'background_color') {
                $('#previewContainer').css('background-color', '#' + color);
            }
            if (this.source.id == 'checkbox_text_color') {
                $('#wannaCheckLabel').css('color', '#' + color);
            }
            if (this.source.id == 'window_button_color') {
                $('#wannaSaleSubmit').css('background-color', '#' + color);
            }
            if (this.source.id == 'window_button_text_color') {
                $('#wannaSaleSubmit').css('color', '#' + color);
            }
            if (this.source.id == 'message_background_color') {
                $('#previewMessage').css('background-color', '#' + color);
            }
            if (this.source.id == 'message_text_color') {
                $('#previewMessage').css('color', '#' + color);
            }
        });

        function update() {
            colorPicker.set(this.value).enter();
        }

        colorPicker.source.oncut = update;
        colorPicker.source.onpaste = update;
        colorPicker.source.onkeyup = update;
        colorPicker.source.oninput = update;
    });

    if ( $('#credit_card_number').length > 0 ) {
        $('#credit_card_number').mask('0000 0000 0000 0000 00');
    }

    if ( $('#credit_card_month').length > 0 ) {
        $('#credit_card_month').mask('00');
    }

    if ( $('#credit_card_year').length > 0 ) {
        $('#credit_card_year').mask('0000');
    }

    if ( $('#credit_card_cvc').length > 0 ) {
        $('#credit_card_cvc').mask('000');
    }

    if ($('#mailTemplatesSelect').length > 0) {

        $('#mailTemplatesSelect').change(function () {
            var mailTitle = $(this).find('option:selected').data('title');
            var mailText = $(this).find('option:selected').data('text');
            var mailPrice = $('#mailPrice').val();

            if (typeof mailPrice == undefined) {
                $('#mailText').val(mailText);
            } else {
                var parsedMailText = mailText.replace('{price}', mailPrice);
                $('#mailText').val(parsedMailText);
            }

            $('#mailTitle').val(mailTitle);
        });
    }

});
