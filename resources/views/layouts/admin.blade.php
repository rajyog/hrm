
    <!DOCTYPE html>
<html dir="{{env('SITE_RTL') == 'on'?'rtl':''}}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ac.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/stylesheet.css') }}">

    @if(env('SITE_RTL')=='on')
        <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.css') }}">
    @endif
    @stack('css-page')


</head>

<body class="application application-offset">
<div class="container-fluid container-application">
    @include('Admin.menu')
    <div class="main-content position-relative">
        @include('Admin.header')
        <div class="page-content">
            <div class="page-title">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                        <div class="d-inline-block">
                            <h5 class="h4 d-inline-block font-weight-400 mb-0 ">@yield('page-title')</h5>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
                        @yield('action-button')
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
</div>

<div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div>
                <h4 class="h4 font-weight-400 float-left modal-title" id="exampleModalLabel"></h4>
                <a href="#" class="more-text widget-text float-right close-icon" data-dismiss="modal" aria-label="Close">{{__('Close')}}</a>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/site.core.js') }}"></script>
<script src="{{ asset('assets/libs/progressbar.js/dist/progressbar.min.js') }}"></script>
<script src="{{ asset('assets/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>

@stack('theme-script')

<script src="{{ asset('assets/js/site.js') }}"></script>
<script src="{{ asset('assets/js/datatables.min.js') }}"></script>
<script>
    var toster_pos="{{env('SITE_RTL')=='on' ?'left' : 'right'}}";
</script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>
    moment.locale('en');
</script>
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>

{{-- @if(\Auth::user()->type != 'super admin')
    <script>
        $(document).ready(function () {
            pushNotification('{{ Auth::id() }}');
        });

        function pushNotification(id) {

            // ajax setup form csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = false;

            var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
                cluster: '{{env('PUSHER_APP_CLUSTER')}}',
                forceTLS: true
            });

            // Pusher Notification
            var channel = pusher.subscribe('send_notification');
            channel.bind('notification', function (data) {
                if (id == data.user_id) {
                    $(".notification-toggle").addClass('beep');
                    $(".notification-dropdown #notification-list").prepend(data.html);
                }
            });

            // Pusher Message
            var msgChannel = pusher.subscribe('my-channel');
            msgChannel.bind('my-chat', function (data) {
                console.log(data);
                if (id == data.to) {
                    getChat();
                }
            });
        }

        // Get chat for top ox
        function getChat() {
            $.ajax({
                url: '{{route('message.data')}}',
                type: "get",
                cache: false,
                success: function (data) {
                    console.log(data);
                    if (data.length != 0) {
                        $(".message-toggle-msg").addClass('beep');
                        $(".dropdown-list-message-msg").html(data);
                    }
                }
            })
        }

        getChat();

        $(document).on("click", ".mark_all_as_read_message", function () {
            $.ajax({
                url: '{{route('message.seen')}}',
                type: "get",
                cache: false,
                success: function (data) {
                    $('.dropdown-list-message-msg').html('');
                    $(".message-toggle-msg").removeClass('beep');
                }
            })
        });
    </script>
@endif --}}

@stack('script-page')

<script>
    var dataTabelLang = {
        paginate: {previous: "{{__('Previous')}}", next: "{{__('Next')}}"},
        lengthMenu: "{{__('Show')}} _MENU_ {{__('entries')}}",
        zeroRecords: "{{__('No data available in table')}}",
        info: "{{__('Showing')}} _START_ {{__('to')}} _END_ {{__('of')}} _TOTAL_ {{__('entries')}}",
        infoEmpty: " ",
        search: "{{__('Search:')}}"
    }
</script>
<script>
    var date_picker_locale = {
        format: 'YYYY-MM-DD',
        daysOfWeek: [
            "{{__('Sun')}}",
            "{{__('Mon')}}",
            "{{__('Tue')}}",
            "{{__('Wed')}}",
            "{{__('Thu')}}",
            "{{__('Fri')}}",
            "{{__('Sat')}}"
        ],
        monthNames: [
            "{{__('January')}}",
            "{{__('February')}}",
            "{{__('March')}}",
            "{{__('April')}}",
            "{{__('May')}}",
            "{{__('June')}}",
            "{{__('July')}}",
            "{{__('August')}}",
            "{{__('September')}}",
            "{{__('October')}}",
            "{{__('November')}}",
            "{{__('December')}}"
        ],
    };
    var calender_header = {
        today: "{{__('today')}}",
        month: '{{__('month')}}',
        week: '{{__('week')}}',
        day: '{{__('day')}}',
        list: '{{__('list')}}'
    };
</script>
@if($message = Session::get('success'))
    <script>
        show_toastr('Success', '{!! $message !!}', 'success');
    </script>
@endif
@if($message = Session::get('error'))
    <script>
        show_toastr('Error', '{!! $message !!}', 'error');
    </script>
@endif
</body>
</html>
