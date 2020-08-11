<style>
    /**
 * Reset button styles
 */
    #wannaPrice {
        background: transparent;
        border: 0;
        padding: 0;
        cursor: pointer;
        outline: 0;
        -webkit-appearance: none;
    }
    /**
     * Set button styles
     */
    #wannaPrice {
        display: inline-block;
        padding: 16px 32px;
        font-size: 14px;
        border-radius: 4px;
        color: #fff;
        text-align: center;
        position: fixed;
        z-index: 99999;
        -webkit-transform: translateZ(0);
        -moz-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
        -webkit-transition: all 0.2s ease;
        -moz-transition: all 0.2s ease;
        -ms-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }
    /* #wannaPrice:hover {
        -webkit-transform: rotateX(20deg);
        -moz-transform: rotateX(20deg);
        -ms-transform: rotateX(20deg);
        transform: rotateX(20deg);
    }
    #wannaPrice:active {
        color: #444444;
        background: #ffffff;
    } */
    /**
     * Reset form
     */
    #wannaSaleForm {
        width: auto;
        background: transparent;
        border: 0;
        padding: 0;
        outline: 0;
        display: none;
        -webkit-appearance: none;
    }
    /**
     * Set form styles
     */
    #wannaSaleForm {
        width: 280px;
        position: fixed;
        z-index: 999999;
        display: none;
    }
    #wannaSaleForm .sign-up-agileinfo {
        background-color: {{ $display_settings->getBackgroundColor() }};
        position: relative;
    }
    #wannaSaleForm .sign-up-agileinfo #wannaSaleClose {
        border:none;
        outline:none;
        background-color: transparent;
        font-size: 16px;
        cursor: pointer;
        position: absolute;
        top: 8px;
        right: 10px;
        color: #000000 !important;
        text-decoration: none !important;
    }
    #wannaSaleForm .inputContainer {
        width: 240px !important;
        text-align: center;
        margin: 0 auto;
    }
    #wannaSaleForm input[type="text"],
    #wannaSaleForm input[type="email"],
    #wannaSaleForm input[type="tel"],
    #wannaSaleForm input[type="number"],
    #wannaSaleForm textarea,
    #wannaSaleForm select {
        width: calc(100%) !important;
        padding: 10px 12px 10px 12px !important;
        background:#fff !important;
        border: none !important;
        outline: none !important;
        margin-bottom: 15px !important;

        font-family: 'Open Sans', sans-serif;
        font-size: 13px;

        box-sizing : border-box !important;
    }
    #wannaSaleForm select {
        height: 40px;
    }
    #wannaSaleForm input[type="checkbox"] {
        -webkit-appearance: checkbox !important;
        -moz-appearance:    checkbox !important;
    }
    #wannaSaleForm textarea {
        margin-bottom: 11px !important;
        resize: none !important;
    }
    /* #wannaSaleForm #wannaSalePhone {
        padding-left: 60px;
    } */
    #wannaSaleForm p.errorText {
        font-family: 'Open Sans',sans-serif;
        font-size: 13px;
        color: red;
        margin: 10px 0px 0px 0px;
    }
    #wannaSaleForm .checkbox_area {
        width: calc(100% - 76px) !important;
        margin: 5px auto 5px auto !important;
    }
    #wannaSaleForm .checkbox_area label {
        width: 170px !important;
        float: right;
        text-align: left !important;
        font-family: 'Open Sans',sans-serif;
        font-size: 13px;
        color: #444444;
    }
    #wannaSaleForm .checkbox_area input {
        float: left !important;
        margin-top: 8px !important;
    }
    #wannaSaleForm #wannaSaleIframe {
        display: none;
    }
    #wannaSaleForm .sign-up-agileinfo {
        padding: 40px 0px 40px 0px;
        box-shadow: 0 3px 18px 8px rgba(38, 24, 24, 0.25);
        text-align:center;
        position:relative;
        z-index: 999999;
    }
    #wannaSaleForm h3 {
        color:#4285f4;
        font-size:20px;
        text-align:center;
        margin-bottom:20px;
        font-family: 'Open Sans', sans-serif;
    }
    #wannaSaleForm input[type="text"],
    #wannaSaleForm input[type="email"],
    #wannaSaleForm input[type="tel"],
    #wannaSaleForm input[type="number"],
    #wannaSaleForm select {
        background:#fff;
        border: none;
        outline: none;
        margin-bottom:15px;
        font-family: 'Open Sans', sans-serif;
    }
    #wannaSaleForm form a {
        color: #EEE;
        float: right;
        font-size: 13px;
        margin:20px 0;

    }
    #wannaSaleForm button#wannaSaleSubmit{
        background: rgb(66, 133, 244);
        color:#fff;
        padding: 10px;
        width: calc(100% - 76px);
        border:none;
        outline:none;
        cursor:pointer;
        margin-top:10px;
        transition: 0.5s all;
        webkit-transition: 0.5s all;
        -moz-transition: 0.5s all;
        -o-transition: 0.5s all;
        -ms-transition: 0.5s all;

        font-size:16px;
        font-family: 'Open Sans', sans-serif;
    }
    #wannaSaleForm button#wannaSaleSubmit:hover{
        background: #fff;
        color: #4285f4;
    }
    #wannaSaleForm .intl-tel-input .country-list {
        position: relative;
        top: -10px;
        left: -200px;
    }
    .inputContainer.phone {
        position: relative;
    }
    .inputContainer.phone .selectedCountry {
        width: 45px;
        height: 35px;
        padding-left: 5px;
        text-align: center;
        position: absolute;
        right: 10px;
        border: 0;
        cursor: pointer;
    }
    .inputContainer.phone .selectedCountry span {
        float: right;
        margin-top: 14px;
        font-size: 8px;
    }
    .inputContainer.phone .selectedCountry img {
        margin-top: 12px;
    }
    .inputContainer.phone .selectCountry {
        width: 100%;
        height: 155px;
        position: absolute;
        top: 37px;
        padding: 0;
        margin: 0;
        list-style: none;
        background-color: #fff;
        overflow: auto;
    }
    .inputContainer.phone .selectCountry li {
        padding: 5px 15px 5px 13px;
        text-align: left;
        cursor: pointer;
        font-family: 'Open Sans', sans-serif;
        font-size: 13px;
    }
    .inputContainer.phone .selectCountry li:hover {
        background-color: #DCDCDC;
    }
    .inputContainer.phone .selectCountry li img {
        margin-right: 10px;
    }
    .inputContainer.phone .selectCountry li span {
        font-family: 'Open Sans', sans-serif;
        font-size: 13px;
        margin: 0px 0px 0px 5px;
    }
    .inputContainer.phone .selectCountry li span span {
        color: #c0c0c0;
    }
</style>