if (typeof WannaSale == "undefined" || !WannaSale) {
    var WannaSale = {};
}

WannaSale.Lang = typeof WannaSale.Lang != 'undefined' && WannaSale.Lang ? WannaSale.Lang : {
    isUndefined : function (o) {
        return typeof o === 'undefined';
    },
    isString : function (o) {
        return typeof o === 'string';
    }
};

WannaSale.Settings = typeof WannaSale.Settings != 'undefined' && WannaSale.Settings ? WannaSale.Settings : {
    widgetKey : {},
    lang : {},
    currency : {},

    setWithData : function (
        key,
        lang,
        currency
    ) {
        this.widgetKey = key;
        this.lang = lang;
        this.currency = currency;
    }
};

WannaSale.DOM = typeof WannaSale.DOM != 'undefined' && WannaSale.DOM ? WannaSale.DOM : {

    iti : {},
    settings : {},

    get : function (el) {
        return (el && el.nodeType) ? el : document.getElementById(el);
    },

    addListener : function (el, type, fn) {
        if (WannaSale.Lang.isString(el)) { el = this.get(el); }

        if (el.addEventListener) {
            el.addEventListener(type, fn, false);
        } else if (el.attachEvent) {
            el.attachEvent('on' + type, fn);
        } else {
            el['on' + type] = fn;
        }
    },

    removeListener : function (el, type, fn) {
        if (WannaSale.Lang.isString(el)) { el = this.get(el); }

        if (el.removeEventListener){
            el.removeEventListener(type, fn, false);
        } else if (el.detachEvent) {
            el.detachEvent('on' + type, fn);
        } else {
            el['on' + type] = function () { return true; };
        }
    },

    purge : function (d) {
        var a = d.attributes, i, l, n;
        if (a) {
            l = a.length;
            for (i = 0; i < l; i += 1) {
                n = a[i].name;
                if (typeof d[n] === 'function') {
                    d[n] = null;
                }
            }
        }
        a = d.childNodes;
        if (a) {
            l = a.length;
            for (i = 0; i < l; i += 1) {
                WannaSale.DOM.purge(d.childNodes[i]);
            }
        }
    },

    setInnerHTML : function (el, html) {
        if (!el || typeof html !== 'string') {
            return null;
        }

        (function (o) {

            var a = o.attributes, i, l, n, c;
            if (a) {
                l = a.length;
                for (i = 0; i < l; i += 1) {
                    n = a[i].name;
                    if (typeof o[n] === 'function') {
                        o[n] = null;
                    }
                }
            }

            a = o.childNodes;

            if (a) {
                l = a.length;
                for (i = 0; i < l; i += 1) {
                    c = o.childNodes[i];

                    // delete child nodes
                    arguments.callee(c);
                    WannaSale.DOM.purge(c);
                }
            }

        })(el);

        el.innerHTML = html.replace(/<script[^>]*>[\S\s]*?<\/script[^>]*>/ig, "");
        return el.firstChild;
    },

    getVendorDomain : function () {
        var script = document.getElementById('wannaSaleWidget'),
            url = script.src,
            host = url.split(/\/+/)[0] + '//' + url.split(/\/+/)[1];

        return host;
    },

    getClientIP : function () {
        var ip = null;
        var xhrIP = new XMLHttpRequest();
        xhrIP.open('GET', 'https://api.ipify.org?format=jsonp&callback=', false);
        xhrIP.send();

        if (xhrIP.status == 200) {
            var data = JSON.parse(xhrIP.responseText.replace('(', '').replace(')', '').replace(';', ''));
            ip = data.ip;
            return ip;
        }
    },

    getCountryFromIP : function () {

        var ip = WannaSale.DOM.getClientIP();

        var request;
        if (window.XMLHttpRequest) { // Mozilla, Safari, ...
            request = new XMLHttpRequest();
        } else if (window.ActiveXObject) { // IE
            try {
                request = new ActiveXObject('Msxml2.XMLHTTP');
            } catch (e) {
                try {
                    request = new ActiveXObject('Microsoft.XMLHTTP');
                } catch (e) {}
            }
        }
        request.open("GET", '//ipinfo.io/' + ((ip) ? ip : ''), false);
        request.setRequestHeader("Accept", "application/json");
        request.send(null);

        if (request.status == 200) {
            var responseData = request.responseText;
            var data = JSON.parse(responseData);

            return data.country;
        }
    },

    getGeoDataFromIP : function () {
        var ip = WannaSale.DOM.getClientIP();

        var xhrIP = new XMLHttpRequest();
        xhrIP.open('GET', 'https://api.sypexgeo.net/json', false);
        xhrIP.send();

        if (xhrIP.status == 200) {
            var data = JSON.parse(xhrIP.responseText);

            return data;
        }
    },

    getWidgetButton : function (
        position,
        bottom,
        side,
        button_text,
        button_color,
        button_text_color,
        width,
        height,
        button_font_size
    ) {
        var wannaSaleButton = document.createElement('button');
        wannaSaleButton.id = 'wannaPrice';
        wannaSaleButton.innerHTML  = button_text;
        wannaSaleButton.style.backgroundColor = button_color;
        wannaSaleButton.style.color = button_text_color;
        wannaSaleButton.style.fontSize = button_font_size + 'px';
        wannaSaleButton.style.width = width + 'px';
        wannaSaleButton.style.height = height + 'px';

        if (position == '1') {
            wannaSaleButton.style.position = 'fixed';
            wannaSaleButton.style.left = side + 'px';
            wannaSaleButton.style.bottom = bottom + 'px';
        }

        if (position == '2') {
            wannaSaleButton.style.position = 'fixed';
            wannaSaleButton.style.right = side + 'px';
            wannaSaleButton.style.bottom = bottom + 'px';
        }

        if (position == '3') {
            wannaSaleButton.style.position = 'static';
        }

        return wannaSaleButton.outerHTML;
    },

    getWidgetRelatedButton : function (
        position,
        bottom,
        side,
        button_text,
        button_color,
        button_text_color,
        width,
        width_percent,
        height,
        button_font_size
    ) {
        var wannaSaleButton = document.createElement('button');
        wannaSaleButton.className = 'wannaSaleButton';
        wannaSaleButton.innerHTML  = button_text;
        wannaSaleButton.style.backgroundColor = button_color;
        wannaSaleButton.style.color = button_text_color;
        wannaSaleButton.style.position = 'relative';
        wannaSaleButton.style.height = height + 'px';
        wannaSaleButton.style.border = '0';
        wannaSaleButton.style.fontSize = button_font_size + 'px';
        wannaSaleButton.style.cursor = 'pointer';
        wannaSaleButton.style.borderRadius = '4px';

        if (width_percent == true) {
            wannaSaleButton.style.width = width + '%';
        } else {
            wannaSaleButton.style.width = width + 'px';
        }

        return wannaSaleButton.outerHTML;
    },

    setOverlay : function() {
        var wannaSaleOverlay = document.createElement('div');
        wannaSaleOverlay.className = 'wannaSaleOverlay';
        wannaSaleOverlay.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
        wannaSaleOverlay.style.position = 'fixed';
        wannaSaleOverlay.style.width = '100%';
        wannaSaleOverlay.style.height = '100%';
        wannaSaleOverlay.style.left = '0px';
        wannaSaleOverlay.style.top = '0px';
        wannaSaleOverlay.style.zIndex = '999997';
        document.body.appendChild(wannaSaleOverlay);
    },

    removeOverlay : function() {
        var elements = document.getElementsByClassName('wannaSaleOverlay');
        for (var i = 0; i < elements.length; ++i) {
            var item = elements[i];
            item.remove();
        }
    },

    setFinalMessage : function (
        message_text,
        message_text_color,
        message_background_color
    ) {
        var message = document.createElement('p');
        message.className = 'wannaSaleMessage';
        message.style.padding = '30px 40px 30px 40px';
        message.style.textAlign = 'center';
        message.style.fontSize = '13px';
        message.style.position = 'fixed';
        message.style.top = '50%';
        message.style.left = '50%';
        message.style.transform = 'translate(-50%, -50%)';
        message.style.backgroundColor = message_background_color;
        message.style.color = message_text_color;
        message.style.zIndex = '999998';
        message.innerHTML = message_text;

        document.body.appendChild(message);

        return message.outerHTML;
    },

    refreshFormFields : function () {
        if (document.getElementById("wannaSaleItemId") !== null) {
            document.getElementById("wannaSaleItemId").value = '';
        }
        if (document.getElementById("wannaSaleItemName") !== null) {
            document.getElementById("wannaSaleItemName").value = '';
        }
        // document.getElementById("wannaSaleSessionKey").value = '';
        document.getElementById("wannaSaleName").value = '';
        document.getElementById("wannaSaleEmail").value = '';
        if (document.getElementById("wannaSalePhone") !== null) {
            document.getElementById("wannaSalePhone").value = '';
            // document.getElementById("wannaSaleCountryCode").value = '';
        }
        // document.getElementById("wannaSaleIpCity").value = '';
        // document.getElementById("wannaSaleIpCountry").value = '';
        document.getElementById("wannaSalePrice").value = '';
    },

    removeMessage : function() {
        var elements = document.getElementsByClassName('wannaSaleMessage');
        for (var i = 0; i < elements.length; ++i) {
            var item = elements[i];
            item.remove();
        }
    },

    setWindowSettings : function (
        position,
        side,
        bottom,
        title_text,
        title_color,
        text,
        checkbox_text,
        window_button_text,
        window_button_color,
        window_button_text_color
    ) {

        var wannaSaleForm = document.getElementById('wannaSaleForm');
        if (position == 1) {
            wannaSaleForm.style.position = 'fixed';
            wannaSaleForm.style.left = side + 'px';
            wannaSaleForm.style.bottom = bottom + 'px';
        }

        if (position == 2) {
            wannaSaleForm.style.position = 'fixed';
            wannaSaleForm.style.right = side + 'px';
            wannaSaleForm.style.bottom = bottom + 'px';
        }

        if (position == 3) {
            wannaSaleForm.style.position = 'fixed';
            wannaSaleForm.style.top = '50%';
            wannaSaleForm.style.left = '50%';
            wannaSaleForm.style.transform = 'translate(-50%, -50%)';
        }

        var wannaSaleTitle = document.getElementById('wannaSaleTitle');
        var wannaSaleText = document.getElementById('wannaSaleText');
        wannaSaleText.innerText = text;

        var wannaCheckLabel = document.getElementById('wannaCheckLabel');
        wannaCheckLabel.innerText = checkbox_text;

        var wannaSaleSubmit = document.getElementById('wannaSaleSubmit');
        wannaSaleSubmit.innerText = window_button_text;
        wannaSaleSubmit.style.backgroundColor = window_button_color;
        wannaSaleSubmit.style.color = window_button_text_color;
    },

    validateForm : function () {

        var result = document.getElementById('widgetTextStatus');
        result.innerText = '';
        var inputItemName = document.getElementById('wannaSaleItemName');
        if (inputItemName !== null) {

            if (inputItemName.value == '') {
                inputItemName.style.borderBottom = '1px solid #ff4d00';
                result.innerHTML = 'Введите информацию о товаре.';

                return false;
            } else {
                inputItemName.style.borderBottom = '0px solid #ff4d00';
            }
        }

        var inputName = document.getElementById('wannaSaleName');
        if (inputName !== null) {
            var pattern = new RegExp(/^[а-яА-яAa-zA-z\-\ ]/i);
            if (!pattern.test(inputName.value)) {
                inputName.style.borderBottom = '1px solid red';
                result.innerHTML = 'Введите своё имя корректно.';

                return false;
            } else {
                inputName.style.borderBottom = '0px solid red';
            }
        }

        var inputEmail = document.getElementById('wannaSaleEmail');
        if (inputEmail !== null) {
            var pattern = new RegExp(/^[^\s@]+@[^\s@]+\.[^\s@]+$/);
            if (!pattern.test(inputEmail.value)) {
                inputEmail.style.borderBottom = '1px solid red';
                result.innerHTML = 'Введите свой адрес электронной почты корректно.';

                return false;
            } else {
                inputEmail.style.borderBottom = '0px solid red';
            }
        }

        if (document.getElementById('wannaSalePhone') !== null) {
            var inputPhone = document.getElementById('wannaSalePhone');
            if (inputPhone !== null) {

                if (inputPhone.value == '') {
                    inputPhone.style.borderBottom = '1px solid red';
                    result.innerHTML = 'Введите номер телефона.';

                    return false;
                } else {
                    inputPhone.style.borderBottom = '0px solid red';
                }
            }
        }

        var inputPrice = document.getElementById('wannaSalePrice');
        if (inputPrice !== null) {
            var pattern = new RegExp(/^[0-9]/i);
            if (!pattern.test(inputPrice.value)) {
                inputPrice.style.borderBottom = '1px solid red';
                result.innerHTML = 'Введите цену корректно.';

                return false;
            } else {
                inputPrice.style.borderBottom = '0px solid red';
            }
        };

        var inputCheck = document.getElementById('wannaCheck');
        if (inputCheck !== null) {
            if (inputCheck.checked === false) {
                result.innerHTML = 'Вы не подтвердили согласие на обработку данных.';

                return false;
            }
        }

        var customFields = document.getElementsByClassName('wannaSaleCustomField');

        for (var i = 0; i < customFields.length; ++i) {

            var fieldValue = customFields[i].value;
            var fieldType = customFields[i].dataset.type;
            var fieldTitle = customFields[i].dataset.title;

            if (fieldType == 'word') {
                var pattern = new RegExp(/^[а-яА-яAa-zA-z\-\ ]/i);
                if (!pattern.test(fieldValue)) {
                    result.innerHTML = 'Значение поля ' + customFields[i].dataset.title.toLowerCase() + ' должно быть строкой.';
                    return false;
                }
            } else if (fieldType == 'integer') {
                var pattern = new RegExp(/^[0-9]/i);
                if (!pattern.test(fieldValue)) {
                    result.innerHTML = 'Значение поля ' + customFields[i].dataset.title.toLowerCase() + ' должно быть числом.';
                    return false;
                }
            } else if (fieldType == 'text') {
                if (fieldType == '') {
                    result.innerHTML = 'Значение поля ' + customFields[i].dataset.title.toLowerCase() + ' должно быть текстом.';
                    return false;
                }
            }
        }

        return true;
    }
};

WannaSale.Ajax = typeof WannaSale.Ajax != 'undefined' && WannaSale.Ajax ? WannaSale.Ajax : {

    initWidget : function (o) {

        var xhrRequest = new XMLHttpRequest();
        xhrRequest.open('POST', WannaSale.DOM.getVendorDomain() + '/api/v1/displayWidget', false);

        xhrRequest.setRequestHeader('Authorization', o.key);
        xhrRequest.setRequestHeader('Accept-Language', o.lang);
        xhrRequest.setRequestHeader('Currency', o.currency);
        xhrRequest.setRequestHeader('Url', window.location);
        xhrRequest.send();

        if (xhrRequest.status == 200) {
            if (xhrRequest.readyState == 4 && xhrRequest.status == 200) {
                if (xhrRequest.responseText) {

                    var responseData = JSON.parse(xhrRequest.response);
                    if (responseData.data.load === true) {

                        var displaySettings = responseData.data.display_settings;
                        var customFields = responseData.data.custom_fields;

                        WannaSale.Button.render(displaySettings, o.key, responseData.data.session_key);
                        WannaSale.Window.render(
                            displaySettings,
                            responseData.data.content,
                            o.key,
                            o.lang,
                            o.currency,
                            responseData.data.session_key
                        );
                    }
                }
            }
        } else {
            return null;
        }
    },

    sendOpenRequest : function (widgetKey, sessionKey) {

        var ip = WannaSale.DOM.getClientIP();
        var widgetId = widgetKey;
        var xhrRequest = new XMLHttpRequest();
        var formData = new FormData();

        formData.append('session_key', sessionKey);

        xhrRequest.open('POST', WannaSale.DOM.getVendorDomain() + '/api/v1/setWidgetOpen', true);

        xhrRequest.setRequestHeader('Authorization', widgetId);
        xhrRequest.setRequestHeader('IP', ip);
        xhrRequest.setRequestHeader('Url', window.location);
        // xhrRequest.setRequestHeader('Accept-Language', lang);
        xhrRequest.setRequestHeader('X-User-Agent', navigator.userAgent);
        xhrRequest.send(formData);
    },

    sendRequest : function (widgetKey, lang, currency) {

        var ip = WannaSale.DOM.getClientIP();
        var widgetId = widgetKey;
        var xhrRequest = new XMLHttpRequest();
        var formData = new FormData();

        if (document.getElementById("wannaSaleItemId") !== null) {
            formData.append('item_id', document.getElementById("wannaSaleItemId").value)
        }

        if (document.getElementById("wannaSaleItemName") !== null) {
            formData.append('item_name', document.getElementById("wannaSaleItemName").value);
        }

        formData.append('session_key', document.getElementById("wannaSaleSessionKey").value);
        formData.append('name', document.getElementById("wannaSaleName").value);
        formData.append('email', document.getElementById("wannaSaleEmail").value);
        if (document.getElementById('wannaSalePhone') !== null) {
            formData.append('phone', document.getElementById("wannaSalePhone").value);
            formData.append('country', document.getElementById("wannaSaleCountryCode").value);
        }
        formData.append('offered_price', document.getElementById("wannaSalePrice").value);
        formData.append('currency', currency);

        formData.append('ip_city', document.getElementById("wannaSaleIpCity").value);
        formData.append('ip_country', document.getElementById("wannaSaleIpCountry").value);

        // Custom fields

        var customFields = document.getElementsByClassName('wannaSaleCustomField');
        for (var i = 0; i < customFields.length; ++i) {
            var fieldName = customFields[i].name;
            var fieldTitle = customFields[i].dataset.title;
            var fieldValue = customFields[i].value;

            formData.append('custom_fields[' + i + '][name]', fieldName);
            formData.append('custom_fields[' + i + '][title]', fieldTitle);
            formData.append('custom_fields[' + i + '][value]', fieldValue);
        }

        xhrRequest.open('POST', WannaSale.DOM.getVendorDomain() + '/api/v1/setWidgetRequest', false);

        xhrRequest.setRequestHeader('Authorization', widgetId);
        xhrRequest.setRequestHeader('IP', ip);
        xhrRequest.setRequestHeader('Url', window.location);
        xhrRequest.setRequestHeader('Accept-Language', lang);
        xhrRequest.setRequestHeader('X-User-Agent', navigator.userAgent);
        xhrRequest.send(formData);

        if (xhrRequest.status == 200) {
            if (xhrRequest.readyState == 4 && xhrRequest.status == 200) {
                if (xhrRequest.responseText) {

                    var messageText = document.getElementById('wannaSaleSettings').dataset.messageText;
                    var messageTextColor = document.getElementById('wannaSaleSettings').dataset.messageTextColor;
                    var messageBackgroundColor = document.getElementById('wannaSaleSettings').dataset.messageBackgroundColor;

                    var message = WannaSale.DOM.setFinalMessage(
                        messageText,
                        messageTextColor,
                        messageBackgroundColor
                    );

                    var responseData = JSON.parse(xhrRequest.response);
                    var form = document.getElementById('wannaSaleForm');
                    form.style.display = 'none';

                    setTimeout(function () {
                        WannaSale.DOM.removeMessage();
                        WannaSale.DOM.removeOverlay();
                        WannaSale.DOM.refreshFormFields();
                    }, 5000);

                    WannaSale.Dialog.show(
                        WannaSale.Settings.widgetKey,
                        WannaSale.Settings.lang,
                        WannaSale.Settings.currency
                    );
                }
            }
        } else if(xhrRequest.status == 422) {

            if (document.getElementById("wannaSalePhone") !== null) {
                var result = document.getElementById('widgetTextStatus');
                result.innerText = '';

                var inputPrice = document.getElementById('wannaSalePhone');
                inputPrice.style.border = '1px solid red';
                result.innerHTML = 'Неверный формат номера телефона.';
            }
        }
    }
};

WannaSale.Button = typeof WannaSale.Button != 'undefined' && WannaSale.Button ? WannaSale.Button : {

    render : function (displaySettings, widgetKey, sessionKey) {

        var buttonContainer = document.createElement('div');
        document.body.appendChild(buttonContainer);

        if (displaySettings.position == '3') {

            var html = WannaSale.DOM.getWidgetRelatedButton(
                displaySettings.position,
                displaySettings.bottom,
                displaySettings.side,
                displaySettings.button_text,
                displaySettings.button_color,
                displaySettings.button_text_color,
                displaySettings.button_width,
                displaySettings.button_width_percent,
                displaySettings.button_height,
                displaySettings.button_font_size
            );

            var elements = document.getElementsByClassName('wannaSaleButton');
            for (var i = 0; i < elements.length; ++i) {
                var item = elements[i];
                item.outerHTML = html;
            }

            var classname = document.getElementsByClassName("wannaSaleButton");

            var myFunction = function() {
                WannaSale.DOM.setOverlay();
                WannaSale.Button.click(displaySettings);
                WannaSale.Ajax.sendOpenRequest(widgetKey, sessionKey);
            };

            for (var i = 0; i < classname.length; i++) {
                classname[i].addEventListener('click', myFunction, false);
            }

        } else {

            var html = WannaSale.DOM.getWidgetButton(
                displaySettings.position,
                displaySettings.bottom,
                displaySettings.side,
                displaySettings.button_text,
                displaySettings.button_color,
                displaySettings.button_text_color,
                displaySettings.button_width,
                displaySettings.button_height,
                displaySettings.button_font_size
            );

            WannaSale.DOM.setInnerHTML(buttonContainer, html);

            WannaSale.DOM.addListener('wannaPrice', 'click', function (e) {
                WannaSale.Button.click(displaySettings);
                WannaSale.Ajax.sendOpenRequest(widgetKey, sessionKey);
                WannaSale.DOM.setOverlay();

                return false;
            });
        }
    },

    click : function (displaySettings) {
        var wannaSaleForm = document.getElementById('wannaSaleForm');
        wannaSaleForm.style.display = 'block';

        if (displaySettings.position != '3') {
            var wannaPrice = document.getElementById('wannaPrice');
            wannaPrice.style.display = 'none';
        }

        return false;
    }

};

WannaSale.Window = typeof WannaSale.Window != 'undefined' && WannaSale.Window ? WannaSale.Window : {

    render : function (
        displaySettings,
        contentHTML,
        widgetKey,
        lang,
        currency,
        session_key
    ) {

        var wannaSaleWindow = document.createElement('div');
        wannaSaleWindow.innerHTML = contentHTML;
        document.body.appendChild(wannaSaleWindow);

        WannaSale.DOM.setWindowSettings(
            displaySettings.position,
            displaySettings.side,
            displaySettings.bottom,
            displaySettings.title_text,
            displaySettings.title_color,
            displaySettings.text,
            displaySettings.checkbox_text,
            displaySettings.window_button_text,
            displaySettings.window_button_color,
            displaySettings.window_button_text_color,
            displaySettings.show_phone
        );

        if (document.getElementById('wannaSalePhone') !== null) {
            /* this.initCountryCode();

            function insertCookies(event) {

                if (event.data.name !== '' && event.data.name !== undefined) {
                    document.getElementById('wannaSaleName').value = event.data.name;
                }
                if (event.data.phone !== '' && event.data.phone !== undefined) {
                    document.getElementById('wannaSalePhone').value = event.data.phone;
                }
                if (event.data.email !== '' && event.data.email !== undefined) {
                    document.getElementById('wannaSaleEmail').value = event.data.email;
                }
                if (event.data.country !== '' && event.data.country !== undefined) {
                    document.getElementById('wannaSaleCountryCode').value = event.data.country;
                    var iti = WannaSale.DOM.iti;
                    iti.setFlag(event.data.country);

                    var mask = inputPhone.getAttribute('placeholder').replace(/[1-9]/g, "0");
                    var phoneMask = new IMask(
                        document.getElementById('wannaSalePhone'), {
                            mask: mask
                        });
                }
            }

            if (window.addEventListener) {
                window.addEventListener("message", insertCookies);
            } else {
                // IE8
                window.attachEvent("onmessage", insertCookies);
            } */
        }

        WannaSale.DOM.addListener('wannaSaleClose', 'click', function (e) {
            var wannaSaleForm = document.getElementById('wannaSaleForm');
            wannaSaleForm.style.display = 'none';

            var wannaPrice = document.getElementById('wannaPrice');
            if (wannaPrice !== null) {
                wannaPrice.style.display = 'block';
            }

            WannaSale.DOM.removeOverlay();

            return false;
        });

        WannaSale.DOM.addListener('wannaSaleSubmit', 'click', function (e) {
            WannaSale.Window.submit(widgetKey, lang, currency);
        });

        WannaSale.DOM.addListener('selectedCountry', 'click', function (e) {
            var selectCountry = document.getElementById('selectCountry');
            selectCountry.style.display = 'block';
        });

        var phoneMask = new IMask(
            document.getElementById('wannaSalePhone'), {
                mask: '0 000 000 00 00'
            });

        var wannaSalePhone = document.getElementById('wannaSalePhone');
        wannaSalePhone.setAttribute('placeholder', '0 000 000 00 00');

        var hiddenSessionKey = document.getElementById('wannaSaleSessionKey');
        hiddenSessionKey.value = session_key;

        var geoData = WannaSale.DOM.getGeoDataFromIP();
        var city = geoData['city']['name_ru'];
        var country = geoData['country']['name_ru'];
        var countryCode = geoData['country']['iso'];

        var hiddenCountryCode = document.getElementById('wannaSaleCountryCode');
        hiddenCountryCode.value = countryCode;

        var wannaSaleIpCountry = document.getElementById('wannaSaleIpCountry');
        wannaSaleIpCountry.value = country;

        var wannaSaleIpCity = document.getElementById('wannaSaleIpCity');
        wannaSaleIpCity.value = city;

        var ul = document.getElementById('selectCountry');  // Parent
        ul.addEventListener('click', function(e) {

            if (e.target.tagName === 'LI'){
                var iso = e.target.getAttribute('data-iso');
                var mask = e.target.getAttribute('data-mask');

                var wannaSalePhone = document.getElementById('wannaSalePhone');
                wannaSalePhone.value = '';
                wannaSalePhone.setAttribute('placeholder', mask);

                var hiddenCountryCode = document.getElementById('wannaSaleCountryCode');
                hiddenCountryCode.value = iso;

                phoneMask.updateOptions({mask: mask});

                var img = e.target.querySelector('img');
                var selectedCountryImg = document.getElementById('selectedCountryImg');
                selectedCountryImg.setAttribute('src', img.getAttribute('src'));
            } else {
                var iso = e.target.parentNode.getAttribute('data-iso');
                var mask = e.target.parentNode.getAttribute('data-mask');

                var wannaSalePhone = document.getElementById('wannaSalePhone');
                wannaSalePhone.value = '';
                wannaSalePhone.setAttribute('placeholder', mask);

                var hiddenCountryCode = document.getElementById('wannaSaleCountryCode');
                hiddenCountryCode.value = iso;

                phoneMask.updateOptions({mask: mask});

                if (e.target.tagName === 'IMG'){
                    var img = e.target;
                    var selectedCountryImg = document.getElementById('selectedCountryImg');
                    selectedCountryImg.setAttribute('src', img.getAttribute('src'));
                } else if (e.target.tagName === 'SPAN') {

                }
            }

            ul.style.display = 'none';
        });
    },

    cookiesCatch : function() {

    },

    initCountryCode : function () {
        // var countryCode = WannaSale.DOM.getCountryFromIP();
        var geoData = WannaSale.DOM.getGeoDataFromIP();
        var city = geoData['city']['name_ru'];
        var country = geoData['country']['name_ru'];
        var countryCode = geoData['country']['iso'];

        var inputPhone = document.getElementById('wannaSalePhone');
        var hiddenCountryCode = document.getElementById('wannaSaleCountryCode');
        document.getElementById('wannaSaleIpCity').value = city;
        document.getElementById('wannaSaleIpCountry').value = country;

        hiddenCountryCode.value = countryCode;
        var iti = intlTelInput(inputPhone, {
            initialCountry: countryCode.toLowerCase(),
        });

        WannaSale.DOM.iti = iti;

        var mask = inputPhone.getAttribute('placeholder').replace(/[1-9]/g, "0");
        var phoneMask = new IMask(
            document.getElementById('wannaSalePhone'), {
                mask: mask
        });

        var dropdowns = document.getElementsByClassName('country');
        for (i = 0; i < dropdowns.length - 1; i++) {

            dropdowns[i].addEventListener("click", function () {
                hiddenCountryCode = document.getElementById('wannaSaleCountryCode');
                hiddenCountryCode.value = this.getAttribute('data-country-code');

                setTimeout(function () {
                    inputPhone.value = '';
                    var mask = inputPhone.getAttribute('placeholder').replace(/[1-9]/g, "0");
                    var phoneMask = new IMask(
                        document.getElementById('wannaSalePhone'), {
                            mask: mask
                    });
                }, 100);
            });
        }
    },

    submit : function (widgetKey, lang, currency) {

        var validateResult = WannaSale.DOM.validateForm();

        if (validateResult) {
            WannaSale.Ajax.sendRequest(
                widgetKey,
                lang,
                currency
            );
        }

    }
};

// YAHOO module pattern: http://ajaxian.com/archives/a-javascript-module-pattern
WannaSale.Dialog = typeof WannaSale.Dialog != 'undefined' && WannaSale.Dialog ? WannaSale.Dialog : function () {

    return {

        show : function (o) {

            if (o.key !== undefined && WannaSale.DOM.getVendorDomain() !== undefined) {

                var settings = WannaSale.Settings.setWithData(
                    o.key,
                    o.lang,
                    o.currency
                );

                WannaSale.DOM.settings = settings;
                WannaSale.Ajax.initWidget(o);
            }
        }

    };

}();