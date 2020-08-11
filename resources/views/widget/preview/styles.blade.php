<style>
    /* Reset */
    #previewButton {
        border: 0;
        padding: 0;
        cursor: pointer;
        outline: 0;
    }

    /* Custom */
    #previewButton {
        width: auto;
        display: inline-block;
        padding: 16px 32px;
        font-size: 14px;
        border-radius: 4px;

        -webkit-transform: translateZ(0);
        -moz-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);

        -webkit-transition: all 0.2s ease;
        -moz-transition: all 0.2s ease;
        -ms-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }
    #wannaSaleForm {
        width: 300px;
    }
    #wannaSaleForm .checkbox_area {
        width: calc(100% - 76px) !important;
        margin: 5px auto 5px auto !important;
    }
    #wannaSaleForm .checkbox_area label {
        width: 80% !important;
        float: right;
        text-align: left !important;
        font-family: 'Open Sans',sans-serif;
        font-size: 13px;
        color: #444444;
    }
    #wannaSaleForm .checkbox_area input {
        float: left !important;
        margin-top: 10px !important;
    }
    #wannaSaleText {
        width: calc(100% - 40px);
        margin: 0px auto 20px auto;
        font-size: 14px;
    }

    #wannaSaleForm .sign-up-agileinfo{
        padding: 40px 0px 40px 0px;
        box-shadow: 0 3px 18px 8px rgba(38, 24, 24, 0.25);
        text-align:center;
        position:relative;
        z-index: 99;
    }
    #wannaSaleForm h3{
        color:#4285f4;
        font-size:20px;
        text-align:center;
        margin-bottom:20px;
        font-family: 'Open Sans', sans-serif;
    }
    #wannaSaleForm input[type="text"],
    #wannaSaleForm input[type="email"],
    #wannaSaleForm input[type="tel"],
    #wannaSaleForm input[type="number"]{
        padding: 10px;
        width: calc(100% - 76px);
        background:#fff;
        border: none;
        outline: none;
        margin-bottom:15px;
        font-family: 'Open Sans', sans-serif;
    }
    #wannaSaleForm input[type="password"]{
        padding: 10px;
        width: calc(100% - 76px);
        background: #fff;
        border: none;
        outline: none;
        margin-bottom:15px;
    }
    #wannaSaleForm select{
        padding: 10px;
        width: calc(100% - 56px);
        background: #fff;
        border: none;
        outline: none;
        margin-bottom:15px;
    }
    #wannaSaleForm textarea,
    #wannaSaleForm select {
        padding: 10px;
        width: calc(100% - 76px);
        background: #fff;
        border: none;
        outline: none;
        resize: none;
        margin-bottom:11px;
        font-family: 'Open Sans', sans-serif;
    }
    #wannaSaleForm select {
        height: 40px;
    }
    #wannaSaleForm form a {
        color: #EEE;
        float: right;
        font-size: 13px;
        margin:20px 0;

    }
    #wannaSaleForm button{
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
    #wannaSaleForm button:hover{
        background: #fff;
        color: #4285f4;
    }
    #wannaSaleForm #wannaSalePhone {
        width: calc(100% - 4px);
        padding-left: 50px;
    }
</style>