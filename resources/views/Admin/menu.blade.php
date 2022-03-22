
<div class="sidenav custom-sidenav" id="sidenav-main">
    <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="{{route('home')}}">
          <img src="{{asset('storage/uploads/logo/landing_logo.png')}}" class="navbar-brand-img" alt="...">
        </a>
        <div class="ml-auto">
            <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="scrollbar-inner">
        <div class="div-mega">
            <ul class="navbar-nav navbar-nav-docs">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('home*') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>{{ __('Dashboard') }}
                    </a>
                </li>
                @if(\Auth::user()->type=='super ADMIN')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                            <i class="fas fa-user"></i>{{ __('Company') }}
                        </a>
                    </li>
                @else
                    @if( Gate::check('Manage User') || Gate::check('Manage Role') || Gate::check('Manage Product')  || Gate::check('Manage User Last Login'))
                    <li class="nav-item">
                            <a class="nav-link {{ (Request::route()->getName() == 'user.index' || Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'permissions.index' || Request::route()->getName() == 'users.profile' || Request::route()->getName() == 'lastlogin') ? 'active' : 'collapsed' }}" href="#navbar-staff" data-toggle="collapse" role="button" aria-expanded="{{ (Request::route()->getName() == 'user.index' || Request::route()->getName() == 'roles.index' ||
                             Request::route()->getName() == 'permissions.index' || Request::route()->getName() == 'users.profile' || Request::route()->getName() == 'lastlogin') ? 'true' : 'false' }}" aria-controls="navbar-staff">
                                <i class="fas fa-columns"></i>{{ __('Staff') }}
                                <i class="fas fa-sort-up"></i>
                            </a>
                            <div class="collapse {{ (Request::route()->getName() == 'user.index' || Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'permissions.index' || Request::route()->getName() == 'users.profile' || Request::route()->getName() == 'lastlogin') ? 'show' : '' }}" id="navbar-staff">
                                <ul class="nav flex-column submenu-ul">
                                    @can('Manage User')
                                        <li class="nav-item {{ request()->is('user*') ? 'active' : '' }}">
                                            <a href="{{ route('users.index') }}" class="nav-link">{{ __('User') }}</a>
                                        </li>
                                    @endcan
                                    @can('Manage Role')
                                        <li class="nav-item {{ request()->is('roles*') ? 'active' : '' }}">
                                            <a href="{{ route('roles.index') }}" class="nav-link">{{ __('Role') }}</a>
                                        </li>
                                    @endcan
                                    @can('Manage Permission')
                                        <li class="nav-item {{ request()->is('permission') ? 'active' : '' }}">
                                            <a href="{{ route('permission.index') }}" class="nav-link">{{ __('Permissions') }}</a>
                                        </li>
                                    @endcan
                                    @can('Manage User Last Login')
                                    <li class="nav-item {{ request()->is('lastlogin') ? 'active' : '' }}">
                                        <a href="{{ route('lastlogin') }}" class="nav-link">{{ __('Last Login') }}</a>
                                    </li>
                                @endcan
                                </ul>
                            </div>
                        </li>
                    @endif
                @endif
                @if(Gate::check('Manage Product'))
                    <li class="nav-item ">
                        <a href="{{route('products.index')}}" class="nav-link {{ (Request::route()->getName() == 'products.index') ||  (Request::route()->getName() == 'products.create') ||  (Request::route()->getName() == 'products.edit') ||  (Request::route()->getName() == 'products.show') ? 'active' : '' }}">
                            <i class="fas fa-users"></i>{{ __('Products') }}
                        </a>
                    </li>
            @endif
            @can('Manage Event')
            <li class="nav-item">
                <a href="{{ route('event.index') }}" class="nav-link {{ request()->is('event*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i>{{ __('Event') }}
                </a>
            </li>
        @endcan

        @if(Gate::check('Manage Company Setting') || Gate::check('Manage System Setting'))
                    <li class="nav-item">
                        <a href="{{ route('setting.index') }}" class="nav-link {{ request()->is('settings*') ? 'active' : '' }}">
                            <i class="fas fa-sliders-h"></i>{{ __('System Setting') }}
                        </a>
                    </li>
                @endif

                @if(Gate::check('Manage Job') || Gate::check('Manage Job Application')|| Gate::check('Manage Job OnBoard') || Gate::check('Manage Custom Question') || Gate::check('Manage Interview Schedule') || Gate::check('Manage Career'))
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' || Request::route()->getName() == 'job.edit' || Request::route()->getName() == 'job.show' || Request::route()->getName() == 'job-application.index' || Request::route()->getName() == 'job-application.show' || Request::route()->getName() == 'job.application.candidate' || Request::route()->getName() == 'job.on.board' || Request::route()->getName() == 'job.on.board.convert'  || Request::route()->getName() ==
                        'custom-question.index'  || Request::route()->getName() == 'interview-schedule.index') ?
                        'active' : 'collapsed' }}"
                           href="#navbar-recurtment" data-toggle="collapse" role="button"
                           aria-expanded="{{ (Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' || Request::route()->getName() == 'job.edit' || Request::route()->getName() == 'job.show' || Request::route()->getName() == 'job-application.index' || Request::route()->getName() == 'job-application.show' || Request::route()->getName() == 'job.application.candidate' || Request::route()->getName() == 'job.on.board' || Request::route()->getName() == 'job.on.board.convert'  || Request::route()->getName() ==
                           'custom-question.index'  || Request::route()->getName() == 'interview-schedule.index') ?
                           'true' : 'false' }}"
                           aria-controls="navbar-training">
                            <i class="fas fa-user-md"></i>{{ __('Recurtment') }}
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse {{ (Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' || Request::route()->getName() == 'job.edit' || Request::route()->getName() == 'job.show' || Request::route()->getName() == 'job-application.index' || Request::route()->getName() == 'job-application.show' || Request::route()->getName() == 'job.application.candidate' || Request::route()->getName() == 'job.on.board' || Request::route()->getName() == 'job.on.board.convert'  || Request::route()->getName() ==
                        'custom-question.index'  || Request::route()->getName() == 'interview-schedule.index') ?
                        'show' : '' }}"
                             id="navbar-recurtment">
                            <ul class="nav flex-column submenu-ul">
                                @can('Manage Job')
                                    <li class="nav-item {{ (Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' || Request::route()->getName() == 'job.edit' || Request::route()->getName() == 'job.show' ) ? 'active' : '' }}">
                                        <a href="{{ route('job.index') }}" class="nav-link">{{ __('Jobs') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Job Application')
                                    <li class="nav-item {{ (Request::route()->getName() == 'job-application.index' || Request::route()->getName() == 'job-application.show') ? 'active' : '' }}">
                                        <a href="{{ route('job-application.index') }}" class="nav-link">{{ __('Job Application') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Job Application')
                                    <li class="nav-item {{ (Request::route()->getName() == 'job.application.candidate') ? 'active' : '' }}">
                                        <a href="{{ route('job.application.candidate') }}" class="nav-link">{{ __('Job Candidate') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Job OnBoard')
                                    <li class="nav-item {{ (Request::route()->getName() == 'job.on.board' || Request::route()->getName() == 'job.on.board.convert') ? 'active' : '' }}">
                                        <a href="{{ route('job.on.board') }}" class="nav-link">{{ __('Job OnBoard') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Custom Question')
                                    <li class="nav-item {{ (Request::route()->getName() == 'custom-question.index') ? 'active' : '' }}">
                                        <a href="{{ route('custom-question.index') }}" class="nav-link">{{ __('Custom Question') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Interview Schedule')
                                    <li class="nav-item {{ (Request::route()->getName() == 'interview-schedule.index') ? 'active' : '' }}">
                                        <a href="{{ route('interview-schedule.index') }}" class="nav-link">{{ __('Interview Schedule') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Career')
                                    <li class="nav-item">
                                        <a href="{{ route('career',[\Auth::user()->creatorId(),'en']) }}" target="_blank" class="nav-link">{{ __('Career') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endif
                @if(\Auth::user()->type != 'super admin')
                    <li class="nav-item">
                        <a href="{{ url('messages') }}" class="nav-link {{ (Request::route()->getName() == 'messages') ? 'active' : '' }}">
                            <i class="fas fa-comments"></i>{{ __('Messenger') }}
                        </a>
                    </li>
                @endif
                @if(Gate::check('Manage Department') || Gate::check('Manage Designation')  || Gate::check('Manage Document Type')  || Gate::check('Manage Branch') || Gate::check('Manage Award Type') || Gate::check('Manage Termination Types')|| Gate::check('Manage Payslip Type') || Gate::check('Manage Allowance Option') || Gate::check('Manage Loan Options')  || Gate::check('Manage Deduction Options') || Gate::check('Manage Expense Type')  || Gate::check('Manage Income Type') || Gate::check('Manage
                              Payment Type')  || Gate::check('Manage Leave Type') || Gate::check('Manage Training Type')  || Gate::check('Manage Job Category') || Gate::check('Manage Job Stage'))
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'department.index' || Request::route()->getName() == 'designation.index' || Request::route()->getName() == 'document.index' || Request::route()->getName() == 'branch.index' || Request::route()->getName() == 'awardtype.index' || Request::route()->getName() == 'terminationtype.index' || Request::route()->getName() == 'paysliptype.index' || Request::route()->getName() == 'allowanceoption.index' || Request::route()->getName() ==
            'loanoption.index' || Request::route()->getName() == 'deductionoption.index' || Request::route()->getName() == 'expensetype.index' || Request::route()->getName() == 'incometype.index'|| Request::route()->getName() == 'paymenttype.index' || Request::route()->getName() == 'leavetype.index' || Request::route()->getName() == 'goaltype.index' || Request::route()->getName() == 'trainingtype.index' || Request::route()->getName() == 'jobcategory.index' || Request::route()->getName() ==
            'jobstage.index') ? 'active' : 'collapsed' }}"
                           href="#navbar-constant" data-toggle="collapse" role="button"
                           aria-expanded="{{ (Request::route()->getName() == 'department.index' || Request::route()->getName() == 'designation.index' || Request::route()->getName() == 'document.index' || Request::route()->getName() == 'branch.index' || Request::route()->getName() == 'awardtype.index' || Request::route()->getName() == 'terminationtype.index' || Request::route()->getName() == 'paysliptype.index' || Request::route()->getName() == 'allowanceoption.index' || Request::route()->getName() ==
            'loanoption.index' || Request::route()->getName() == 'deductionoption.index' || Request::route()->getName() == 'expensetype.index' || Request::route()->getName() == 'incometype.index'|| Request::route()->getName() == 'paymenttype.index' || Request::route()->getName() == 'leavetype.index' || Request::route()->getName() == 'goaltype.index' || Request::route()->getName() == 'trainingtype.index' || Request::route()->getName() == 'jobcategory.index' || Request::route()->getName() ==
            'jobstage.index') ? 'true' : 'false' }}"
                           aria-controls="navbar-constant">
                            <i class="fas fa-external-link-alt"></i>{{ __('Constant') }}
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse {{ (Request::route()->getName() == 'department.index' || Request::route()->getName() == 'designation.index' || Request::route()->getName() == 'document.index' || Request::route()->getName() == 'branch.index' || Request::route()->getName() == 'awardtype.index' || Request::route()->getName() == 'terminationtype.index' || Request::route()->getName() == 'paysliptype.index' || Request::route()->getName() == 'allowanceoption.index' || Request::route()->getName() ==
            'loanoption.index' || Request::route()->getName() == 'deductionoption.index' || Request::route()->getName() == 'expensetype.index' || Request::route()->getName() == 'incometype.index'|| Request::route()->getName() == 'paymenttype.index' || Request::route()->getName() == 'leavetype.index' || Request::route()->getName() == 'goaltype.index' || Request::route()->getName() == 'trainingtype.index' || Request::route()->getName() == 'jobcategory.index' || Request::route()->getName() ==
            'jobstage.index') ? 'show' : '' }}"
                             id="navbar-constant">
                            <ul class="nav flex-column submenu-ul">
                                @can('Manage Branch')
                                    <li class="nav-item {{ request()->is('branch*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('branch.index') }}">{{ __('Branch') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Department')
                                    <li class="nav-item {{ request()->is('department*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('department.index') }}">{{ __('Department') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Designation')
                                    <li class="nav-item {{ request()->is('designation*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('designation.index') }}">{{ __('Designation') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Job Category')
                                    <li class="nav-item {{ request()->is('jobcategory*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('jobcategory.index') }}">{{ __('Job Category') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Job Stage')
                                    <li class="nav-item {{ request()->is('jobstage*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('jobstage.index') }}">{{ __('Job Stage') }}</a>
                                    </li>
                                @endcan
                                </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
