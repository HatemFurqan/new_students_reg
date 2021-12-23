<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>

    * {
        margin: 0;
        padding: 0
    }

    html {
        height: 100%
    }

    p {
        color: grey
    }

    .btn-primary {
        background-color: #25408F !important;
        border-color: #25408F !important;
    }

    .label-time {
        margin-right: 25px !important;
    }

    .input-time {
        width: auto !important;
    }

    @if(app()->getLocale() != 'ar')
        .text-right {
            text-align: left !important;
        }
        .label-time {
            margin-left: 25px;
            margin-right: 0 !important;
        }
        .input-time {
            margin: 0 !important;
        }
    @endif

    #heading {
        text-transform: uppercase;
        color: #25408F;
        font-weight: normal
    }

    #msform {
        text-align: center;
        position: relative;
        margin-top: 20px;
        font-family: 'Cairo', sans-serif;
    }

    #std-name {
       cursor: default !important;
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        margin: 0;
        padding-bottom: 20px;
        position: relative
    }

    .form-card {
        text-align: left
    }

    #msform fieldset:not(:first-of-type) {
        display: none
    }

    #msform input,
    #msform textarea {
        padding: 8px 15px 8px 15px;
        border: 1px solid #ccc;
        border-radius: 0px;
        margin-bottom: 25px;
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        font-family: 'Cairo', sans-serif;
        color: #2C3E50;
        background-color: #ECEFF1;
        font-size: 16px;
        letter-spacing: 1px
    }

    #msform input:focus,
    #msform textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #25408F;
        outline-width: 0
    }

    #msform .action-button {
        width: 100px;
        background: #25408F;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 0px 10px 5px;
        float: right
    }

    #msform .action-button:hover,
    #msform .action-button:focus {
        background-color: #311B92
    }

    #msform .action-button-previous {
        width: 100px;
        background: #616161;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px 10px 0px;
        float: right
    }

    #msform .action-button-previous:hover,
    #msform .action-button-previous:focus {
        background-color: #000000
    }

    .card {
        z-index: 0;
        border: none;
        position: relative
    }

    .fs-title {
        font-size: 25px;
        color: #25408F;
        margin-bottom: 15px;
        font-weight: normal;
        text-align: left
    }

    .purple-text {
        color: #25408F;
        font-weight: normal
    }

    .steps {
        font-size: 25px;
        color: gray;
        margin-bottom: 10px;
        font-weight: normal;
        text-align: right
    }

    .fieldlabels {
        color: gray;
        text-align: left
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey
    }

    #progressbar .active {
        color: #25408F
    }

    #progressbar li {
        list-style-type: none;
        font-size: 15px;
        width: 33%;
        float: left;
        position: relative;
        font-weight: 400
    }

    #progressbar #account:before {
        font-family: FontAwesome;
        content: "\f13e"
    }

    #progressbar #personal:before {
        font-family: FontAwesome;
        content: "\f007"
    }

    #progressbar #payment:before {
        font-family: FontAwesome;
        content: "\f030"
    }

    #progressbar #confirm:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 20px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1
    }

    #msform label {
        color: black !important;
        font-weight: bold !important;
        font-family: 'Cairo', sans-serif;
    }

    #msform #checks-section label {
        color: black !important;
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #25408F
    }

    .progress {
        height: 20px
    }

    .progress-bar {
        background-color: #25408F
    }

    .fit-image {
        width: 100%;
        object-fit: cover
    }
</style>

    <style>
        .ltr-table {
            margin: auto !important;
        }
        .ltr-table tr td{
            text-align: center !important;
            font-size: 12pt;
            color: #000000;
            font-width: bold;
            padding: 5px;
        }
        @if(app()->getLocale() == 'ar')
            #msform .label-right {
                text-align: right !important;
            }
            .rtl-text {
                text-align: right !important;
            }
            .select2-results__option {
                text-align: right !important;
            }
            #father_whatsApp_number,
            #mother_whatsApp_number {
                text-align: left !important;
            }
        @endif
    </style>

    {{--  checkout frame styles  --}}
    <style>*,*::after,*::before{box-sizing:border-box}html{padding:1rem;background-color:#FFF;font-family: 'Cairo', sans-serif;, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif}#payment-form{width:31.5rem;margin:0 auto}iframe{width:100%}.one-liner{display:flex;flex-direction:column}#pay-button{border:none;border-radius:3px;color:#FFF;font-weight:500;height:40px;width:100%;background-color:#13395E;box-shadow:0 1px 3px 0 rgba(19,57,94,0.4)}#pay-button:active{background-color:#0B2A49;box-shadow:0 1px 3px 0 rgba(19,57,94,0.4)}#pay-button:hover{background-color:#15406B;box-shadow:0 2px 5px 0 rgba(19,57,94,0.4)}#pay-button:disabled{background-color:#697887;box-shadow:none}#pay-button:not(:disabled){cursor:pointer}.card-frame{border:solid 1px #13395E;border-radius:3px;width:100%;margin-bottom:8px;height:40px;box-shadow:0 1px 3px 0 rgba(19,57,94,0.2)}.card-frame.frame--rendered{opacity:1}.card-frame.frame--rendered.frame--focus{border:solid 1px #13395E;box-shadow:0 2px 5px 0 rgba(19,57,94,0.15)}.card-frame.frame--rendered.frame--invalid{border:solid 1px #D96830;box-shadow:0 2px 5px 0 rgba(217,104,48,0.15)}.success-payment-message{color:#13395E;line-height:1.4}.token{color:#b35e14;font-size:0.9rem;font-family: 'Cairo', sans-serif;}@media screen and (min-width: 31rem){.one-liner{flex-direction:row}.card-frame{width:318px;margin-bottom:0}#pay-button{width:175px;margin-left:8px}}</style>

    <style>
        .select2.select2-container {
            width: 100% !important;
            display: block !important;
        }
        .select2-selection--single {
            height: 33px!important;
        }
        #cover-bg {
            background-image: url("{{ asset('images/cover.jpg') }}");
            width: 100%;
            height: 111px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
        }

        #times li {
            font-weight: bold !important;
        }
    </style>
</head>
<body>

    <div class="container-fluid">

        <div id="cover-bg">

        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">

                <ul class="navbar-nav m-auto">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li class="nav-item active">
                            <a class="nav-link"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> {{ $properties['native'] }}
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>
        </nav>

        <div class="row justify-content-center">
            <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    <h2 id="heading">{{ __('Page Title') }}</h2>

                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form id="msform" action="{{ route('semester.subscribeOneToOne') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- progressbar -->
                        <ul id="progressbar" class="d-flex flex-row">
                            <li class="active" id="account"><strong>{{ __('resubscribe.Information and notes') }}</strong></li>
                            <li id="personal"><strong>{{ __('resubscribe.Register') }}</strong></li>
                            <li id="confirm"><strong>{{ __('resubscribe.Payment and termination') }}</strong></li>
                        </ul>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <br>
                            <!-- fieldsets -->
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="fs-title text-center">{{ __('resubscribe.General information') }}</h2>
                                    </div>
                                </div>

                                    <p class="rtl-text">
                                        <span class="text-center d-block w-100 font-weight-bold">{!! __('Learning System') !!}</span>
                                        <span class="text-center d-block w-100 font-weight-bold">{!! __('Click here') !!}</span>

                                        <br>

                                        <span style="display: block; color: #008000; font-weight: bold; text-align: center !important;">
                                            {!! __('Questions') !!}
                                        </span>

                                        <br>

                                        <span class="d-block text-center font-weight-bold" style="color: #ff0000;">{{ __('Times') }}</span>

                                         <ul class="rtl-text" id="times">
                                            <li>{{ __('Mecca time') }}</li>
                                            <li>{{ __('Morocco and France time') }}</li>
                                            <li>{{ __('New York time') }}</li>
                                        </ul>

                                        <span class="text-center d-block">{{ __('wish') }}</span>

                                    </p>

                                    <br>

                                <div id="signature-section">
                                    <label for="signature-label" class="text-right w-100 label-right" style="color: #ff0000 !important;">{{ __('Guardian Signature') }}:</label>
                                    <div class="form-group text-right">
                                        <input class="form-check-input input-time" type="radio" name="signature" id="signature" value="{{ __('Signature') }}" required>
                                        <label class="form-check-label label-time" style="color: #ff0000 !important;" for="signature">
                                            {{ __('Signature') }}
                                        </label>
                                    </div>
                                </div>

                            </div>

                            <input type="button" name="next" class="next action-button" value="{{ __('resubscribe.Next') }}" />
                        </fieldset>

                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">{{ __('resubscribe.Register') }}</h2>
                                    </div>
                                </div>

                                <div class="input-group mb-3" id="study-before-section">
                                    <label for="signature-label" class="text-right w-100 label-right">{{ __('study at the Center before') }}:</label>
                                    <div class="form-group text-right w-100">
                                        <input class="form-check-input input-time" type="radio" name="study_before" id="yes" value="yes" required>
                                        <label class="form-check-label label-time" for="yes">
                                            {{ __('yes') }}
                                        </label>
                                    </div>
                                    <div class="form-group text-right w-100">
                                        <input class="form-check-input input-time" type="radio" name="study_before" id="no" value="no" required>
                                        <label class="form-check-label label-time" for="no">
                                            {{ __('no') }}
                                        </label>
                                    </div>
                                </div>

                                <div id="study_before_student" class="d-none">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="std-section">{{ __('resubscribe.Section') }}</label>
                                        </div>
                                        <select class="custom-select" name="section" id="std-section">
                                            <option selected>{{ __('resubscribe.Choose') }}...</option>
                                            <option value="1">{{ __('resubscribe.Male') }}</option>
                                            <option value="2">{{ __('resubscribe.Female') }}</option>
                                        </select>
                                    </div>

                                    <div class="form-group text-right">
                                        <label for="std-number" class="text-right">{{ __('resubscribe.Serial Number') }}</label>
                                        <input type="number" min="0" name="student_number" class="form-control" id="std-number" placeholder="{{ __('resubscribe.Serial Number') }}">
                                    </div>

                                    <div class="form-group text-center">
                                        <button type="button" class="btn btn-primary w-50" id="std-number-search">{{ __('resubscribe.Search') }}</button>
                                    </div>

                                    <div class="form-group text-right" id="std-name-section">
                                        <div class="alert alert-danger d-none" role="alert">
                                        </div>
                                        <label for="std-name" class="text-right">{{ __('resubscribe.Name') }} *</label>
                                        <input type="text" min="0" name="student_name" class="form-control" id="std-name" placeholder="..." readonly>
                                    </div>

                                </div>

                                <div id="favorite_times">
                                    <label for="std-email-conf" class="text-right w-100 label-right">{{ __('one_to_one.Choose your preferred schedule') }}</label>
                                    <div class="form-group text-right">
                                        <input class="form-check-input input-time" type="radio" name="favorite_time" id="{{ __('Morning Session | 09:00 am - 12:00 pm GMT+3') }}" value="{{ __('Morning Session | 09:00 am - 12:00 pm GMT+3') }}">
                                        <label class="form-check-label label-time" for="{{ __('Morning Session | 09:00 am - 12:00 pm GMT+3') }}">
                                            {{ __('Morning Session | 09:00 am - 12:00 pm GMT+3') }}
                                        </label>
                                    </div>
                                    <div class="form-group text-right">
                                        <input class="form-check-input input-time" type="radio" name="favorite_time" id="{{ __('Evening Session 1 | 03:00 pm - 06:00 pm GMT+3') }}" value="{{ __('Evening Session 1 | 03:00 pm - 06:00 pm GMT+3') }}">
                                        <label class="form-check-label label-time" for="{{ __('Evening Session 1 | 03:00 pm - 06:00 pm GMT+3') }}">
                                            {{ __('Evening Session 1 | 03:00 pm - 06:00 pm GMT+3') }}
                                        </label>
                                    </div>
                                    <div class="form-group text-right">
                                        <input class="form-check-input input-time" type="radio" name="favorite_time" id="{{ __('Evening Session 2 | 07:00 pm - 10:00 pm GMT+3') }}" value="{{ __('Evening Session 2 | 07:00 pm - 10:00 pm GMT+3') }}">
                                        <label class="form-check-label label-time" for="{{ __('Evening Session 2 | 07:00 pm - 10:00 pm GMT+3') }}">
                                            {{ __('Evening Session 2 | 07:00 pm - 10:00 pm GMT+3') }}
                                        </label>
                                    </div>
                                    <div class="form-group text-right">
                                        <input class="form-check-input input-time" type="radio" name="favorite_time" id="{{ __('Evening Session 3 | 11:00 pm - 02:00 am GMT+3') }}" value="{{ __('Evening Session 3 | 11:00 pm - 02:00 am GMT+3') }}">
                                        <label class="form-check-label label-time" for="{{ __('Evening Session 3 | 11:00 pm - 02:00 am GMT+3') }}">
                                            {{ __('Evening Session 3 | 11:00 pm - 02:00 am GMT+3') }}
                                        </label>
                                    </div>
                                    <div class="form-group text-right">
                                        <input class="form-check-input input-time" type="radio" name="favorite_time" id="{{ __('Evening Session 4 | 02:00 am - 05:00 am GMT+3') }}" value="{{ __('Evening Session 4 | 02:00 am - 05:00 am GMT+3') }}">
                                        <label class="form-check-label label-time" for="{{ __('Evening Session 4 | 02:00 am - 05:00 am GMT+3') }}">
                                            {{ __('Evening Session 4 | 02:00 am - 05:00 am GMT+3') }}
                                        </label>
                                    </div>
                                </div>

                                <br>

                                {{-- yes studied (already_studied)--}}
                                <div id="already_studied" class="d-none">
                                    <div class="row">
                                        <div class="col-4 text-right">
                                            <label for="nationality_studied">{{ __('Nationality') }}</label>
                                            <select name="nationality_studied" class="form-control js-select2" id="nationality_studied">
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4 text-right">
                                            <label for="country_residence_studied">{{ __('Country of residence') }}</label>
                                            <select name="country_residence_studied" class="form-control js-select2" id="country_residence_studied">
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-4 text-right">
                                            <label for="city">{{ __('city') }}</label>
                                            <input type="text" name="city_studied" class="form-control" id="city" placeholder="{{ __('city') }}">
                                        </div>
                                        <div class="col-4 text-right">
                                            <label for="postal_code">{{ __('Postal code') }}</label>
                                            <input type="text" name="postal_code_studied" id="postal_code" class="form-control" placeholder="{{ __('Postal code') }}">
                                        </div>
                                        <div class="col-4 text-right">
                                            <label for="place_birth">{{ __('Place of birth') }}</label>
                                            <input type="text" name="place_birth_studied" id="place_birth" class="form-control" placeholder="{{ __('Place of birth') }}">
                                        </div>
                                        <div class="col-4 text-right">
                                            <label for="address">{{ __('Address - Street - Building') }}</label>
                                            <textarea type="text" name="address_studied" id="address" class="form-control"></textarea>
                                        </div>
                                        <div class="col-6 text-right">
                                            <label for="id_number">{{ __('ID/Passport Number') }}</label>
                                            <input type="text" name="id_number_studied" class="form-control" placeholder="{{ __('ID/Passport Number') }}">
                                        </div>
                                        <p class="text-center" style="color: #ff0000;">{{ __('sure the address is correct') }}</p>
                                    </div>

                                    <br>
                                    <hr>

                                    <div class="row">
                                        <div class="col-6 text-right">
                                            <label for="father_whatsApp_studied">{{ __('Father’s WhatsApp Number') }}</label>
                                            <select name="father_whatsApp_studied" class="form-control js-select2" id="father_whatsApp_studied">
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->code }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" name="father_whatsApp_number_studied" id="father_whatsApp_number" class="form-control">
                                        </div>
                                        <div class="col-6 text-right">
                                            <label for="mother_whatsApp_studied">{{ __('Mother’s WhatsApp Number') }}</label>
                                            <select name="mother_whatsApp_studied" class="form-control js-select2" id="mother_whatsApp_studied">
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->code }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" name="mother_whatsApp_number_studied" id="mother_whatsApp_number" class="form-control">
                                        </div>

                                        <br>

                                        <div class="col-6 text-right">
                                            <label for="father_email">{{ __('Father’s E-mail') }}</label>
                                            <input type="email" name="father_email_studied" id="father_email" class="form-control" placeholder="{{ __('Father’s E-mail') }}">
                                            <input type="email" name="confirm_father_email_studied" id="confirm_father_email" class="form-control" placeholder="{{ __('Father’s E-mail') }}">
                                        </div>
                                        <div class="col-6 text-right">
                                            <label for="mother_email" style="font-size: 15px;">{{ __('Mother’s E-mail') }}</label>
                                            <input type="email" name="mother_email_studied" id="mother_email" class="form-control" placeholder="{{ __('Mother’s E-mail') }}">
                                            <input type="email" name="confirm_mother_email_studied" id="confirm_mother_email" class="form-control" placeholder="{{ __('Mother’s E-mail') }}">
                                        </div>

                                        <p class="text-center w-100" style="color: #ff0000;">{{ __('Note: messages are sent on the (Email).') }}</p>

                                        <br>

                                        <div class="col-6 text-right">
                                            <label for="preferred_language">{{ __('Preferred language') }}</label>
                                            <select name="preferred_language_studied" class="form-control" id="preferred_language">
                                                <option value="Arabic">{{ __('Arabic') }}</option>
                                                <option value="English">{{ __('English') }}</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div id="not_study_before_student" class="d-none">
                                    <div class="form-group text-right">
                                        <label for="birthdate">{{ __('Birthdate') }}</label>
                                        <input type="date" class="form-control" name="birthdate" id="birthdate" placeholder="{{ __('Birthdate') }}">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="std-section">{{ __('resubscribe.Section') }}</label>
                                        </div>
                                        <select class="custom-select" name="new_student_section" id="new_student_section">
                                            <option selected>{{ __('resubscribe.Choose') }}...</option>
                                            <option value="1">{{ __('resubscribe.Male') }}</option>
                                            <option value="2">{{ __('resubscribe.Female') }}</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 text-right">
                                            <label for="first_name">{{ __('First Name') }}</label>
                                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="{{ __('First Name') }}">
                                        </div>
                                        <div class="col-6 text-right">
                                            <label for="father_name">{{ __('Father Name') }}</label>
                                            <input type="text" name="father_name" class="form-control" id="father_name" placeholder="{{ __('Father Name') }}">
                                        </div>
                                        <div class="col-6 text-right">
                                            <label for="grandfather_name">{{ __('Grandfather Name') }}</label>
                                            <input type="text" class="form-control" name="grandfather_name" id="grandfather_name" placeholder="{{ __('Grandfather Name') }}">
                                        </div>
                                        <div class="col-6 text-right">
                                            <label for="family_name">{{ __('Family Name') }}</label>
                                            <input type="text"  name="family_name" class="form-control"id="family_name"  placeholder="{{ __('Family Name') }}">
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-4 text-right">
                                            <label for="nationality">{{ __('Nationality') }}</label>
                                            <select name="nationality" class="form-control js-select2" id="nationality">
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4 text-right">
                                            <label for="country_residence">{{ __('Country of residence') }}</label>
                                            <select name="country_residence" class="form-control js-select2" id="country_residence">
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-4 text-right">
                                            <label for="city">{{ __('city') }}</label>
                                            <input type="text" name="city" class="form-control" id="city" placeholder="{{ __('city') }}">
                                        </div>
                                        <div class="col-4 text-right">
                                            <label for="postal_code">{{ __('Postal code') }}</label>
                                            <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="{{ __('Postal code') }}">
                                        </div>
                                        <div class="col-4 text-right">
                                            <label for="place_birth">{{ __('Place of birth') }}</label>
                                            <input type="text" name="place_birth" id="place_birth" class="form-control" placeholder="{{ __('Place of birth') }}">
                                        </div>
                                        <div class="col-4 text-right">
                                            <label for="address">{{ __('Address - Street - Building') }}</label>
                                            <textarea type="text" name="address" id="address" class="form-control"></textarea>
                                        </div>
                                        <div class="col-6 text-right">
                                            <label for="id_number">{{ __('ID/Passport Number') }}</label>
                                            <input type="text" name="id_number" class="form-control" placeholder="{{ __('ID/Passport Number') }}">
                                        </div>
                                        <p class="text-center" style="color: #ff0000;">{{ __('sure the address is correct') }}</p>
                                    </div>

                                    <br>
                                    <hr>

                                    <div class="row">
                                        <div class="col-6 text-right">
                                            <label for="father_whatsApp">{{ __('Father’s WhatsApp Number') }}</label>
                                            <select name="father_whatsApp" class="form-control js-select2" id="father_whatsApp">
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->code }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" name="father_whatsApp_number" id="father_whatsApp_number" class="form-control">
                                        </div>
                                        <div class="col-6 text-right">
                                            <label for="mother_whatsApp">{{ __('Mother’s WhatsApp Number') }}</label>
                                            <select name="mother_whatsApp" class="form-control js-select2" id="mother_whatsApp">
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->code }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" name="mother_whatsApp_number" id="mother_whatsApp_number" class="form-control">
                                        </div>

                                        <br>

                                        <div class="col-6 text-right">
                                            <label for="father_email">{{ __('Father’s E-mail') }}</label>
                                            <input type="text" name="father_email" id="father_email" class="form-control" placeholder="{{ __('Father’s E-mail') }}">
                                            <input type="text" name="confirm_father_email" id="confirm_father_email" class="form-control" placeholder="{{ __('Father’s E-mail') }}">
                                        </div>
                                        <div class="col-6 text-right">
                                            <label for="mother_email" style="font-size: 15px;">{{ __('Mother’s E-mail') }}</label>
                                            <input type="text" name="mother_email" id="mother_email" class="form-control" placeholder="{{ __('Mother’s E-mail') }}">
                                            <input type="text" name="confirm_mother_email" id="confirm_mother_email" class="form-control" placeholder="{{ __('Mother’s E-mail') }}">
                                        </div>

                                        <p class="text-center w-100" style="color: #ff0000;">{{ __('Note: messages are sent on the (Email).') }}</p>

                                        <br>

                                        <div class="col-6 text-right">
                                            <label for="preferred_language">{{ __('Preferred language') }}</label>
                                            <select name="preferred_language" class="form-control" id="preferred_language">
                                                <option value="Arabic">{{ __('Arabic') }}</option>
                                                <option value="English">{{ __('English') }}</option>
                                            </select>
                                        </div>

                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-6 text-right">
                                            <label for="guardian_name">{{ __('Guardian’s name') }}</label>
                                            <input type="text" name="guardian_name" id="guardian_name" class="form-control" placeholder="{{ __('Guardian’s name') }}">
                                        </div>
                                        <div class="col-6 text-right">
                                            <label for="guardian_work">{{ __('Guardian’s work') }}</label>
                                            <input type="text" name="guardian_work" id="guardian_work" class="form-control" placeholder="{{ __('Guardian’s work') }}">
                                        </div>
                                        <div class="col-6 text-right">
                                            <label for="mother_name">{{ __('Mother’s name') }}</label>
                                            <input type="text" name="mother_name" id="mother_name" class="form-control" placeholder="{{ __('Mother’s name') }}">
                                        </div>
                                        <div class="col-6 text-right">
                                            <label for="mother_work">{{ __('Mother’s work') }}</label>
                                            <input type="text" name="mother_work" id="mother_work" class="form-control" placeholder="{{ __('Mother’s work') }}">
                                        </div>

                                    </div>

                                    <hr>

                                    <div class="row">

                                        <div class="col-6 text-right">
                                            <label for="social_situation">{{ __('Student’s social situation') }}</label>
                                            <select name="social_situation" class="form-control" id="social_situation">
                                                <option value="{{ __('live with parents') }}">{{ __('live with parents') }}</option>
                                                <option value="{{ __('live with father') }}">{{ __('live with father') }}</option>
                                                <option value="{{ __('live with mother') }}">{{ __('live with mother') }}</option>
                                                <option value="other">{{ __('other') }}</option>
                                            </select>
                                        </div>

                                        <div class="col-6 text-right d-none" id="other-social-situation-section">
                                            <label for="other_social_situation">{{ __('Student’s social situation') }}</label>
                                            <input type="text" name="other_social_situation" id="other_social_situation" class="form-control" placeholder="{{ __('Student’s social situation') }}">
                                        </div>

                                        <div class="col-6 text-right">
                                            <label class="text-right w-100 label-right">{{ __('Has he/she any chronic disease?') }}:</label>
                                            <div class="form-group text-right w-100">
                                                <input class="form-check-input input-time" type="radio" name="chronic_disease" id="chronic_disease_yes" value="yes">
                                                <label class="form-check-label label-time" for="chronic_disease_yes">
                                                    {{ __('yes') }}
                                                </label>
                                            </div>
                                            <div class="form-group text-right w-100">
                                                <input class="form-check-input input-time" type="radio" name="chronic_disease" id="no" value="no">
                                                <label class="form-check-label label-time" for="chronic_disease_no">
                                                    {{ __('no') }}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-6 text-right d-none" id="explain_disease">
                                            <label for="current_disease">{{ __('Explain the current disease') }}</label>
                                            <textarea type="text" name="current_disease" class="form-control"></textarea>
                                        </div>

                                    </div>

                                    <hr>

                                    <div class="row">

                                        <div class="col-6 text-right">
                                            <label class="text-right w-100 label-right">{{ __('Has the student participated in any Qur’an school?') }}:</label>
                                            <div class="form-group text-right w-100">
                                                <input class="form-check-input input-time" type="radio" name="quran_school" id="quran_school_yes" value="yes">
                                                <label class="form-check-label label-time" for="quran_school_yes">
                                                    {{ __('yes') }}
                                                </label>
                                            </div>
                                            <div class="form-group text-right w-100">
                                                <input class="form-check-input input-time" type="radio" name="quran_school" id="quran_school_no" value="no">
                                                <label class="form-check-label label-time" for="quran_school_no">
                                                    {{ __('no') }}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-6 text-right d-none" id="name-school-section">
                                            <label for="name_school">{{ __('Name of the school') }}</label>
                                            <input type="text" name="name_school" id="name_school" class="form-control" placeholder="{{ __('Name of the school') }}">
                                        </div>

                                        <div class="col-12 text-right">
                                            <label class="text-right w-100 label-right">{{ __('Has the student studied Qaeedah Nurania?') }}:</label>
                                            <div class="form-group text-right w-100">
                                                <input class="form-check-input input-time" type="radio" name="studied_qaeedah" id="studied_qaeedah_yes" value="yes">
                                                <label class="form-check-label label-time" for="studied_qaeedah_yes">
                                                    {{ __('yes') }}
                                                </label>
                                            </div>
                                            <div class="form-group text-right w-100">
                                                <input class="form-check-input input-time" type="radio" name="studied_qaeedah" id="studied_qaeedah_no" value="no">
                                                <label class="form-check-label label-time" for="studied_qaeedah_no">
                                                    {{ __('no') }}
                                                </label>
                                            </div>

                                            <br>
                                            <hr>

                                            <p class="text-center" style="color: #ff0000;">{{ __('Required documents') }}</p>

                                            <br>

                                            <div class="form-group text-right w-100">
                                                <label class="form-check-label label-time w-100" for="student_id">
                                                    {{ __('Student ID') }}
                                                </label>
                                                <input class="form-check-input input-time" type="file" name="student_id" id="student_id">
                                            </div>
                                            <br>
                                            <br>
                                            <div class="form-group text-right w-100">
                                                <label class="form-check-label label-time w-100" for="guardian_id">
                                                    {{ __('Guardian ID') }}
                                                </label>
                                                <input class="form-check-input input-time" type="file" name="guardian_id" id="guardian_id">
                                            </div>

                                            <br>
                                            <br>
                                            <br>

                                            <div icd="guardian_commitment_section">
                                                <label class="text-right w-100 label-right" style="color: #ff0000 !important;">{{ __('Guardian Signature') }}:</label>
                                                <div class="form-group text-right">
                                                    <input class="form-check-input input-time" type="radio" name="guardian_commitment" id="guardian_commitment">
                                                    <label class="form-check-label label-time" style="color: #ff0000 !important;" for="guardian_commitment">
                                                        {{ __('Guardian Commitment') }}
                                                    </label>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <hr>

                                </div>
                            </div>

                            <input type="button" name="next" class="next action-button" value="{{ __('resubscribe.Next') }}" />
                            <input type="button" name="previous" class="previous action-button-previous" value="{{ __('resubscribe.Previous') }}" />
                        </fieldset>

                        <fieldset id="checks-section">

                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">{{ __('resubscribe.Payment and termination') }}</h2>
                                    </div>
                                </div>

                                <div class="form-group text-right">
                                    <div class="form-check text-right">
                                        <input class="form-check-input w-auto" type="checkbox" value="" id="agree-terms" required>
                                        <label class="form-check-label mr-4" for="agree-terms">
                                            {{ __('resubscribe.terms and conditions') }}
                                        </label>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div>
                                    <div class="form-check text-right">
                                        <input class="form-check-input w-auto" type="radio" name="payment_method" id="checkout_gateway" value="checkout_gateway">
                                        <label class="form-check-label mr-4" for="checkout_gateway">
                                            {!! __('one_to_one.Payment via credit card') !!}
                                        </label>
                                        <img class="text-center d-block" style="width: 38%;margin: auto;margin-top: 9px;" src="{{ asset('card-icons/cards.png') }}" alt="Cards icons">
                                    </div>

                                    <br>

                                    <div class="form-check text-right">
                                        <input class="form-check-input w-auto" type="radio" name="payment_method" id="hsbc" value="hsbc">
                                        <label class="form-check-label mr-4" for="hsbc">
                                            {{ __('one_to_one.HSBC Bank') }}
                                        </label>
                                    </div>
                                </div>

                                <div id="hsbc-section-elements" class="d-none text-right">
                                    <br>
                                    <label>
                                        <strong>{{ __('resubscribe.Registration method') }}</strong>
                                    </label>

                                    <table class="table table-bordered">

                                        <tbody>
                                        <tr>
                                            <td>{{ __('resubscribe.Bank name') }}</td>
                                            <td>The Hongkong and Shanghai Banking Corporation Limited (HSBC)</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('resubscribe.Bank address') }}</td>
                                            <td>Queens Road Central Hong Kong 1</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('resubscribe.Swift code') }}</td>
                                            <td>HSBCHKHHHKH</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('resubscribe.Beneficiary Name') }}</td>
                                            <td>FURQAN GROUP FOR EDUCATION AND IT LIMITED</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('resubscribe.Account number') }}</td>
                                            <td>023832223838</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('resubscribe.Account currency') }}</td>
                                            <td>دولار أمريكي (USD)</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('resubscribe.Beneficiary address') }}</td>
                                            <td>Room 409 Beverley Commercial Center Kowloon Hong Kong</td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <div class="form-group">
                                        <label for="money_transfer_image_path">{{ __('resubscribe.Choose the transfer picture') }}</label>
                                        <input type="file" class="form-control" style="height: 50px" name="money_transfer_image_path" id="money_transfer_image_path">
                                    </div>

                                    <div class="form-group text-right">
                                        <label for="bank_name">{{ __('resubscribe.Bank name') }}</label>
                                        <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="{{ __('resubscribe.Bank name') }}">
                                    </div>

                                    <div class="form-group text-right">
                                        <label for="account_owner">{{ __('resubscribe.Account holder name (in English as it appears in the bank)') }}</label>
                                        <input type="text" class="form-control" name="account_owner" id="account_owner" placeholder="{{ __('resubscribe.Account holder name (in English as it appears in the bank)') }}">
                                    </div>

                                    <div class="form-group text-right">
                                        <label for="transfer_date">{{ __('resubscribe.Transfer date') }}</label>
                                        <input type="date" class="form-control" name="transfer_date" id="transfer_date">
                                    </div>

                                    <div class="form-group text-right">
                                        <label for="bank_reference_number">{{ __('resubscribe.Operation reference number') }}</label>
                                        <input type="text" class="form-control" name="bank_reference_number" id="bank_reference_number" placeholder="{{ __('resubscribe.Operation reference number') }}">
                                    </div>

                                </div>

                                <input type="hidden" name="token_pay" id="token_pay">
                            </div>

                            <button type="submit" id="submit-main-form" class="btn btn-secondary w-100 mt-2" disabled>{{ __('resubscribe.Send') }}</button>
                            <input type="button" name="previous" class="previous action-button-previous" value="{{ __('resubscribe.Previous') }}" />

                        </fieldset>

                        <input type="hidden" name="hidden_apply_coupon" id="hidden_apply_coupon">
                    </form>

                    <form id="payment-form" method="POST" action="https://merchant.com/charge-card" class="d-none">

                        <div class="form-group text-right" id="apply-coupon" style="width: 50%; margin: auto;">
                            <label for="apply_coupon" class="text-right">{{ __('resubscribe.Enter coupon') }}</label>
                            <input type="text" aria-describedby="coupon-description" name="apply_coupon" class="form-control" id="apply_coupon" placeholder="{{ __('resubscribe.Enter coupon') }}" title="{{ __('resubscribe.Enter coupon') }}">
                            <small id="coupon-description" class="form-text text-muted"></small>

                            <div class="form-group text-center">
                                <button type="button" class="btn btn-primary" id="apply_coupon_btn" style="width: 70% !important;">{{ __('resubscribe.Apply') }}</button>
                            </div>
                        </div>

                        <div class="one-liner" style="flex-direction: column;justify-content: space-between;align-items: center;height: 100px;">
                            <div class="card-frame"></div>
                            <button class="btn btn-primary" id="pay-button" disabled>
                                {{ __('resubscribe.Checkout') }}
                                <i class="fas fa-spinner fa-spin d-none"></i>
                            </button>
                        </div>
                        <p class="error-message text-center"></p>
                        <p class="success-payment-message text-center"></p>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
{{--                    <form id="payment-form" method="POST" action="https://merchant.com/charge-card">--}}
{{--                        <div class="one-liner" style="flex-direction: column;justify-content: space-between;align-items: center;height: 100px;">--}}
{{--                            <div class="card-frame"></div>--}}
{{--                            <button class="btn btn-primary" id="pay-button" disabled>--}}
{{--                                إتمام الدفع--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <p class="error-message text-center"></p>--}}
{{--                        <p class="success-payment-message text-center"></p>--}}
{{--                    </form>--}}
                </div>
                <div class="modal-footer d-none">
                    <button type="button" class="d-none" id="close-modal" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>

    <!-- add frames script -->
<script src="https://cdn.checkout.com/js/framesv2.min.js"></script>
<script src="{{ asset('app.js') }}?v=63.61"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function(){

        $('.js-select2').select2();

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        setProgressBar(current);

        $(".next").click(function(){

            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;

            current_fs = $(this).parent();

            if(validate(current_fs)){
                next_fs = $(this).parent().next();

                //Add Class Active
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                //show the next fieldset
                next_fs.show();

                //hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function(now) {

                        // for making fieldset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({'opacity': opacity});
                    },
                    duration: 500
                });
                setProgressBar(++current);
            }
            if($('#checkout_gateway').is(':checked')){
                $("#payment-form").removeClass('d-none');
            }
        });

        $(".previous").click(function(){

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now) {
                // for making fieldset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({'opacity': opacity});
                },
                duration: 500
            });
            setProgressBar(--current);

            $("#payment-form").addClass('d-none');

        });

        function setProgressBar(curStep){
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width",percent+"%")
        }

        $(".submit").click(function(){
            return false;
        })

        $(document).on('click', 'form #apply_coupon_btn', function (e) {
            $('#hidden_apply_coupon').val($('form #apply_coupon').val());
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('apply.coupon') }}?std_number=' + $('form #std-number').val() + '&code=' + $('form #apply_coupon').val(),
                success: function (data) {
                    $('#coupon-description').html("{{ __('resubscribe.discount total is') }}" + data.discount + "$ " + "{{ __('resubscribe.and price after discount is') }}" + data.price_after_discount + "$ ");
                },
                error: function (data){
                    $('#coupon-description').html(data.responseJSON.msg);
                }
            });
        });

        $(document).on('click', 'form #std-number-search', function (e) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('semester.registration.getStudentInfo') }}?std_number=' + $('form #std-number').val() + '&std_section=' + $('form #std-section').val() + '&form_type=new_students',
                success: function (data) {
                    $('form #std-name').val(data.name);
                    $('form #std-name').css('border-color', 'green');
                    $('form #std-name-section .alert').addClass('d-none');
                    $('#already_studied').removeClass('d-none');
                },
                error: function (data){
                    $('form #std-name').val('');
                    $('form #std-name').attr("placeholder", '!');
                    $('form #std-name').attr("title", '!');
                    $('form #std-name').css('border-color', 'red');
                    $('form #std-name-section .alert').html(data.responseJSON.msg);
                    $('form #std-name-section .alert').removeClass('d-none');
                    $('#already_studied').addClass('d-none');
                }
            });
        });

        $(document).on('click', 'form #hsbc', function (e) {

            if($('#agree-terms').is(':checked')){
                $("#hsbc-section-elements").removeClass('d-none');
                $("#hsbc-section-elements").show();
                $("#hsbc-section-elements input").prop('required',true);

                $("#payment-form").addClass('d-none');

                $("#submit-main-form").removeAttr('disabled');
                $("#submit-main-form").removeClass('btn-secondary');
                $("#submit-main-form").addClass('btn-primary');
                $("#submit-main-form").removeClass('d-none');
            }else{
                e.preventDefault();
                alert('يجب عليك الموافقة على صحة البيانات السابقة')
            }
        });

        $(document).on('click', 'form #checkout_gateway', function (e) {

            if($('#agree-terms').is(':checked')){
                $("#hsbc-section-elements").addClass('d-none');
                $("#hsbc-section-elements").hide();
                $("#hsbc-section-elements input").removeAttr('required');

                $("#payment-form").removeClass('d-none');
                $("#submit-main-form").addClass('d-none');

            }else{
                e.preventDefault();
                alert('يجب عليك الموافقة على صحة البيانات السابقة')
            }

        });

        function validate(current_fs) {
            let inputs = current_fs.find("input[required]");
            let signature = $('#signature-section input[type=radio]');
            let studyBeforeRadio = current_fs.find('input[name=study_before]');

            flag = true;
            if (!signature[0].checked){
                $('#signature-section .error-msg-times').remove();
                $('#signature-section').prepend(`<div class="alert alert-danger error-msg-times text-right" role="alert">
                                              {{ __('You must confirm your familiarity with the distance education system') }}
                </div>`);
                return false;
            }else{
                flag = true;
                $('#signature-section .error-msg-times').remove();
            }

            for (let index = 0; index < studyBeforeRadio.length; ++index) {
                if (!studyBeforeRadio[index].checked){
                    $(studyBeforeRadio[index]).css('border-color', 'red');
                    flag = false;
                }else{
                    $(studyBeforeRadio[index]).css('border-color', 'green');
                    flag = true;
                    break;
                }
            }

            if (studyBeforeRadio !== undefined){
                if (!flag){
                    $('#study-before-section .error-msg-times').remove();
                    $('#study-before-section').prepend(`<div class="alert alert-danger error-msg-times text-right" role="alert">
                                              {{ __('You must confirm one of the following options') }}
                    </div>`);
                }else{
                    $('#study-before-section .error-msg-times').remove();
                }
            }

            for (index = 0; index < inputs.length; ++index) {
                if (inputs[index].value == null || inputs[index].value == ""){
                    $(inputs[index]).css('border-color', 'red');
                    flag = false;
                }else{
                    $(inputs[index]).css('border-color', 'green');
                }

                if ($(inputs[index]).attr('id') == 'std-email' || $(inputs[index]).attr('id') == 'std-email-conf'){
                    if ($('#std-email').val() == $('#std-email-conf').val() &&
                        $('#std-email').val() != "" &&
                        $('#std-email').val() != null &&
                        $('#std-email-conf').val() != "" &&
                        $('#std-email-conf').val() != null
                    ){
                        $('#std-email-conf').css('border-color', 'green');
                        $('#std-email').css('border-color', 'green');
                    }else{
                        $('#std-email-conf').css('border-color', 'red');
                        $('#std-email').css('border-color', 'red');
                        flag = false;
                    }

                }

            }

            return flag;
        }

        $(document).on('change', 'form#msform input[required]', function (e) {
            if ($(this).val() != "" && $(this).val() != null){
                $(this).css('border-color', 'green');
            }
        });

        $(document).on('change', 'select[name="father_whatsApp_studied"]', function (e) {
            $('input[name="father_whatsApp_number_studied"]').val(" " + $(this).val() + "+");
        });

        $(document).on('change', 'select[name="mother_whatsApp_studied"]', function (e) {
            $('input[name="mother_whatsApp_number_studied"]').val(" " + $(this).val() + "+");
        });

        //====================
        $(document).on('change', 'select[name="father_whatsApp"]', function (e) {
            $('input[name="father_whatsApp_number"]').val(" " + $(this).val() + "+");
        });

        $(document).on('change', 'select[name="mother_whatsApp"]', function (e) {
            $('input[name="mother_whatsApp_number"]').val(" " + $(this).val() + "+");
        });

        $(document).on('change', 'input[name="chronic_disease"]', function (e) {
            if($(this).val() == 'no'){
                $('textarea[name="current_disease"]').removeAttr('required');
                $('#explain_disease').addClass('d-none');
            }else{
                $('textarea[name="current_disease"]').prop('required', true);
                $('#explain_disease').removeClass('d-none');
            }
        });

        $(document).on('change', 'select[name="social_situation"]', function (e) {
            if($(this).val() == 'other'){
                $('input[name="other_social_situation"]').prop('required', true);
                $('#other-social-situation-section').removeClass('d-none');
            }else{
                $('input[name="other_social_situation"]').removeAttr('required');
                $('#other-social-situation-section').addClass('d-none');
            }
        });

        $(document).on('change', 'input[name="quran_school"]', function (e) {
            if($(this).val() == 'no'){
                $('input[name="name_school"]').removeAttr('required');
                $('#name-school-section').addClass('d-none');
            }else{
                $('input[name="name_school"]').prop('required', true);
                $('#name-school-section').removeClass('d-none');
            }
        });

        $(document).on('change', 'input[name="study_before"]', function (e) {

            if ($(this).val() == 'yes'){
                $('#study_before_student').removeClass('d-none');
                $('#not_study_before_student').removeClass('d-none');
                $('#not_study_before_student').addClass('d-none');

                $('#already_studied input, #already_studied select').prop('required', true);
                $('#not_study_before_student input, #not_study_before_student select').removeAttr('required');

                $('#study_before_student input, #study_before_student select').prop('required', true);
            }else{
                $('#not_study_before_student').removeClass('d-none');
                $('#study_before_student').removeClass('d-none');
                $('#study_before_student').addClass('d-none');

                $('#already_studied').addClass('d-none');
                $('#already_studied input, #already_studied select').removeAttr('required');
                $('#not_study_before_student input, #not_study_before_student select').prop('required', true);

                $('#study_before_student input, #study_before_student select').removeAttr('required');
            }

        });

    });
</script>

</body>
</html>
