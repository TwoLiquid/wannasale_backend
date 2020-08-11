<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    @include('dashboard.layouts.styles')
</head>
<body class="fixed-header menu-pin windows desktop pace-done">

{{-- <div class="flex-center position-ref full-height backlog">
    <div class="content">
        <div class="title m-b-md">
            <img src="{{ asset('assets/dashboard/img/logo.png') }}" height="74">
            <br><p style="margin-top: 0px; font-size: 24px; font-weight: lighter;">Регистрация</p>
        </div>
        <div>
            <form method="post" action="{{ route('register.make') }}" id="registerForm">
                {{ csrf_field() }}

                @if (count($errors))
                    @foreach($errors->all() as $error)
                        <p class="errorMessage">{{ $error }}</p>
                    @endforeach
                @endif

                <div class="registerFormContainer">
                    <div style="float: left; margin-right: 40px;">
                        <input type="text" name="user_name" placeholder="Ваше имя" value="{{ old('user_name') }}" />
                        <input type="email" name="user_email" placeholder="Ваш email" value="{{ old('user_email') }}" />
                        <input type="password" name="user_password" placeholder="Введите пароль" />
                        <input type="password" name="user_confirm_password" placeholder="Повторите пароль" />
                    </div>

                    <div style="float: right;">
                        <input type="text" name="company_name" placeholder="Название компании" value="{{ old('company_name') }}" />
                        <input type="text" name="company_slug" placeholder="Название домена" value="{{ old('company_slug') }}" />
                    </div>
                </div>

                <div class="clearfix"></div>

                <button type="submit">Регистрация</button>
            </form>
        </div>
    </div>
</div> --}}

<div class="register-container full-height sm-p-t-30">
    <div class="d-flex justify-content-center flex-column full-height ">
        <img width="250" src="{{ asset('assets/dashboard/img/logo.png') }}">
        <h3>Регистрация</h3>
        <form class="p-t-15" method="post" action="{{ route('register.make') }}" id="registerForm">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-group-default">
                        <label>Ваше имя</label>
                        <input type="text" name="user_name" placeholder="Введите ваше имя" class="form-control" value="{{ old('user_name') }}" required />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-group-default">
                        <label>Ваш e-mail</label>
                        <input type="email" name="user_email" placeholder="Введите ваш email" class="form-control" value="{{ old('user_email') }}" required />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-group-default">
                        <label>Пароль</label>
                        <input type="password" name="user_password" placeholder="Введите пароль" class="form-control" required />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-group-default">
                        <label>Повторите пароль</label>
                        <input type="password" name="user_confirm_password" placeholder="Повторите пароль" class="form-control" required />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-group-default">
                        <label>Название компании</label>
                        <input type="text" name="company_name" placeholder="Введите название компании" class="form-control" value="{{ old('company_name') }}" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-default">
                        <label>Домен</label>
                        <input type="text" name="company_slug" placeholder="Введите домен" class="form-control" value="{{ old('company_slug') }}" required />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if (count($errors))
                        @foreach($errors->all() as $error)
                            <p class="errorMessage">{{ $error }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- <div class="row m-t-10">
                <div class="col-lg-6">
                    <p><small>I agree to the <a href="#" class="text-info">Pages Terms</a> and <a href="#" class="text-info">Privacy</a>.</small></p>
                </div>
                <div class="col-lg-6 text-right">
                    <a href="#" class="text-info small">Help? Contact Support</a>
                </div>
            </div> -->
            <button class="btn btn-primary btn-cons m-t-10" type="submit">Зарегистрироваться</button>
        </form>
    </div>
</div>

</body>
</html>
