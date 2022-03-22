@extends('layouts.admin')
@section('page-title')
    {{__('Settings')}}
@endsection
@php
    $logo=asset(Storage::disk('local')->url('uploads/logo/'));
@endphp

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="nav-tabs">
                <div class="col-lg-12 our-system">
                    <div class="row">
                        <ul class="nav nav-tabs my-4">
                            <li>
                                <a data-toggle="tab" href="#site-setting" class="active">{{__('Site Setting')}}</a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#email-settings" class="">{{__('Email Setting')}} </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="site-setting" class="tab-pane in active">
                        {{Form::model($settings,array('url'=>'setting','method'=>'POST','enctype' => "multipart/form-data"))}}
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                <h4 class="h4 font-weight-400 float-left pb-2">{{__('Site settings')}}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4 class="small-title">{{__('Logo')}}</h4>
                                <div class="card setting-card setting-logo-box">
                                    <div class="logo-content">
                                        <img src="{{$logo.'/logo.png'}}" class="big-logo" alt=""/>
                                    </div>
                                    <div class="choose-file mt-5">
                                        <label for="logo">
                                            <div>{{__('Choose file here')}}</div>
                                            <input type="file" class="form-control" name="logo" id="logo" data-filename="edit-logo">
                                        </label>
                                        <p class="edit-logo"></p>
                                    </div>
                                    <p class="lh-160 mb-0 pt-2">{{__('These Logo will appear on Payslip.')}}</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4 class="small-title">{{__('Landi@php
                                    $logo = asset(Storage::url('uploads/logo/'));
                                    @endphpng Page Logo')}}</h4>
                                <div class="card setting-card setting-logo-box">
                                    <div class="col-12">
                                        <div class="logo-content">
                                            <img src="{{$logo.'/landing_logo.png'}}" class="landing-logo" alt=""/>
                                        </div>
                                        <div class="choose-file mt-4">
                                            <label for="landing-logo">
                                                <div>{{__('Choose file here')}}</div>
                                                <input type="file" class="form-control" name="landing_logo" id="landing-logo" data-filename="edit-landing-logo">
                                            </label>
                                            <p class="edit-landing-logo"></p>
                                        </div>
                                    </div>

                                    <div class="form-group mt-2">
                                        {{Form::label('display_landing_page',__('Landing Page Display'),array('class'=>'form-control-label')) }}
                                        <div class="">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="display_landing_page" id="display_landing_page" {{ $settings['display_landing_page'] == 'on' ? 'checked="checked"' : '' }}>
                                                <label class="custom-control-label form-control-label" for="display_landing_page"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4 class="small-title">{{__('Favicon')}}</h4>
                                <div class="card setting-card setting-logo-box">
                                    <div class="logo-content">
                                        <img src="{{$logo.'/favicon.png'}}" class="small-logo" alt=""/>
                                    </div>
                                    <div class="choose-file mt-5">
                                        <label for="small-favicon">
                                            <div>{{__('Choose file here')}}</div>
                                            <input type="file" class="form-control" name="favicon" id="small-favicon" data-filename="edit-favicon">
                                        </label>
                                        <p class="edit-favicon"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4 class="small-title">{{__('Settings')}}</h4>
                                <div class="card setting-card">
                                    <div class="form-group">
                                        {{Form::label('title_text',__('Title Text'),array('class'=>'form-control-label')) }}
                                        {{Form::text('title_text',null,array('class'=>'form-control','placeholder'=>__('Title Text')))}}
                                        @error('title_text')
                                        <span class="invalid-title_text" role="alert">
                                         <strong class="text-danger">{{ $message }}</strong>
                                         </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('footer_text',__('Footer Text'),array('class'=>'form-control-label')) }}
                                        {{Form::text('footer_text',null,array('class'=>'form-control','placeholder'=>__('Footer Text')))}}
                                        @error('footer_text')
                                        <span class="invalid-footer_text" role="alert">
                                                                     <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                        @enderror
                                    </div>
                                   {{-- <div class="form-group">
                                        {{Form::label('default_language',__('Default Language'),array('class'=>'form-control-label')) }}
                                        <div class="changeLanguage">
                                            <select name="default_language" id="default_language" class="form-control select2">
                                                @foreach(\App\Utility::languages() as $language)
                                                    <option @if($lang == $language) selected @endif value="{{$language }}">{{Str::upper($language)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="form-group">
                                        {{Form::label('SITE_RTL',__('RTL'),array('class'=>'form-control-label')) }}
                                        <div class="">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="SITE_RTL" id="SITE_RTL" {{ env('SITE_RTL') == 'on' ? 'checked="checked"' : '' }}>
                                                <label class="custom-control-label form-control-label" for="SITE_RTL"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12 text-right">
                                <input type="submit" value="{{__('Save Changes')}}" class="btn-submit">
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                    <div id="email-settings" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2">{{__('Email settings')}}</h4>
                                </div>
                            </div>
                            <div class="card bg-none company-setting">
                                {{Form::open(array('route'=>'email.settings','method'=>'post'))}}
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        {{Form::label('mail_driver',__('Mail Driver'),array('class'=>'form-control-label')) }}
                                        {{Form::text('mail_driver',env('MAIL_DRIVER'),array('class'=>'form-control','placeholder'=>__('Enter Mail Driver')))}}
                                        @error('mail_driver')
                                        <span class="invalid-mail_driver" role="alert">
                                                 <strong class="text-danger">{{ $message }}</strong>
                                                 </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        {{Form::label('mail_host',__('Mail Host'),array('class'=>'form-control-label')) }}
                                        {{Form::text('mail_host',env('MAIL_HOST'),array('class'=>'form-control ','placeholder'=>__('Enter Mail Driver')))}}
                                        @error('mail_host')
                                        <span class="invalid-mail_driver" role="alert">
                                                 <strong class="text-danger">{{ $message }}</strong>
                                                 </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        {{Form::label('mail_port',__('Mail Port'),array('class'=>'form-control-label')) }}
                                        {{Form::text('mail_port',env('MAIL_PORT'),array('class'=>'form-control','placeholder'=>__('Enter Mail Port')))}}
                                        @error('mail_port')
                                        <span class="invalid-mail_port" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        {{Form::label('mail_username',__('Mail Username'),array('class'=>'form-control-label')) }}
                                        {{Form::text('mail_username',env('MAIL_USERNAME'),array('class'=>'form-control','placeholder'=>__('Enter Mail Username')))}}
                                        @error('mail_username')
                                        <span class="invalid-mail_username" role="alert">
                                                 <strong class="text-danger">{{ $message }}</strong>
                                                 </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        {{Form::label('mail_password',__('Mail Password'),array('class'=>'form-control-label')) }}
                                        {{Form::text('mail_password',env('MAIL_PASSWORD'),array('class'=>'form-control','placeholder'=>__('Enter Mail Password')))}}
                                        @error('mail_password')
                                        <span class="invalid-mail_password" role="alert">
                                                 <strong class="text-danger">{{ $message }}</strong>
                                                 </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        {{Form::label('mail_encryption',__('Mail Encryption'),array('class'=>'form-control-label')) }}
                                        {{Form::text('mail_encryption',env('MAIL_ENCRYPTION'),array('class'=>'form-control','placeholder'=>__('Enter Mail Encryption')))}}
                                        @error('mail_encryption')
                                        <span class="invalid-mail_encryption" role="alert">
                                                 <strong class="text-danger">{{ $message }}</strong>
                                                 </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        {{Form::label('mail_from_address',__('Mail From Address'),array('class'=>'form-control-label')) }}
                                        {{Form::text('mail_from_address',env('MAIL_FROM_ADDRESS'),array('class'=>'form-control','placeholder'=>__('Enter Mail From Address')))}}
                                        @error('mail_from_address')
                                        <span class="invalid-mail_from_address" role="alert">
                                                 <strong class="text-danger">{{ $message }}</strong>
                                                 </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        {{Form::label('mail_from_name',__('Mail From Name'),array('class'=>'form-control-label')) }}
                                        {{Form::text('mail_from_name',env('MAIL_FROM_NAME'),array('class'=>'form-control','placeholder'=>__('Enter Mail Encryption')))}}
                                        @error('mail_from_name')
                                        <span class="invalid-mail_from_name" role="alert">
                                                 <strong class="text-danger">{{ $message }}</strong>
                                                 </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-lg-12 ">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <a href="#" data-url="{{route('test.mail' )}}" data-ajax-popup="true" data-title="{{__('Send Test Mail')}}" class="text-white btn-custom">
                                                {{__('Send Test Mail')}}
                                            </a>
                                        </div>
                                        <div class="form-group col-md-6 text-right">
                                            <input type="submit" value="{{__('Save Changes')}}" class="btn-submit text-white">
                                        </div>
                                    </div>
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>

@endsection
