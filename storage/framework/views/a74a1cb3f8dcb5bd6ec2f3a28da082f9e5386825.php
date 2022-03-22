
<div class="sidenav custom-sidenav" id="sidenav-main">
    <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
          <img src="<?php echo e(asset('storage/uploads/logo/landing_logo.png')); ?>" class="navbar-brand-img" alt="...">
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
                    <a href="<?php echo e(route('home')); ?>" class="nav-link <?php echo e(request()->is('home*') ? 'active' : ''); ?>">
                        <i class="fas fa-tachometer-alt"></i><?php echo e(__('Dashboard')); ?>

                    </a>
                </li>
                <?php if(\Auth::user()->type=='super ADMIN'): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('users.index')); ?>" class="nav-link <?php echo e(request()->is('user*') ? 'active' : ''); ?>">
                            <i class="fas fa-user"></i><?php echo e(__('Company')); ?>

                        </a>
                    </li>
                <?php else: ?>
                    <?php if( Gate::check('Manage User') || Gate::check('Manage Role') || Gate::check('Manage Product')  || Gate::check('Manage User Last Login')): ?>
                    <li class="nav-item">
                            <a class="nav-link <?php echo e((Request::route()->getName() == 'user.index' || Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'permissions.index' || Request::route()->getName() == 'users.profile' || Request::route()->getName() == 'lastlogin') ? 'active' : 'collapsed'); ?>" href="#navbar-staff" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::route()->getName() == 'user.index' || Request::route()->getName() == 'roles.index' ||
                             Request::route()->getName() == 'permissions.index' || Request::route()->getName() == 'users.profile' || Request::route()->getName() == 'lastlogin') ? 'true' : 'false'); ?>" aria-controls="navbar-staff">
                                <i class="fas fa-columns"></i><?php echo e(__('Staff')); ?>

                                <i class="fas fa-sort-up"></i>
                            </a>
                            <div class="collapse <?php echo e((Request::route()->getName() == 'user.index' || Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'permissions.index' || Request::route()->getName() == 'users.profile' || Request::route()->getName() == 'lastlogin') ? 'show' : ''); ?>" id="navbar-staff">
                                <ul class="nav flex-column submenu-ul">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage User')): ?>
                                        <li class="nav-item <?php echo e(request()->is('user*') ? 'active' : ''); ?>">
                                            <a href="<?php echo e(route('users.index')); ?>" class="nav-link"><?php echo e(__('User')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Role')): ?>
                                        <li class="nav-item <?php echo e(request()->is('roles*') ? 'active' : ''); ?>">
                                            <a href="<?php echo e(route('roles.index')); ?>" class="nav-link"><?php echo e(__('Role')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Permission')): ?>
                                        <li class="nav-item <?php echo e(request()->is('permission') ? 'active' : ''); ?>">
                                            <a href="<?php echo e(route('permission.index')); ?>" class="nav-link"><?php echo e(__('Permissions')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage User Last Login')): ?>
                                    <li class="nav-item <?php echo e(request()->is('lastlogin') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('lastlogin')); ?>" class="nav-link"><?php echo e(__('Last Login')); ?></a>
                                    </li>
                                <?php endif; ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(Gate::check('Manage Product')): ?>
                    <li class="nav-item ">
                        <a href="<?php echo e(route('products.index')); ?>" class="nav-link <?php echo e((Request::route()->getName() == 'products.index') ||  (Request::route()->getName() == 'products.create') ||  (Request::route()->getName() == 'products.edit') ||  (Request::route()->getName() == 'products.show') ? 'active' : ''); ?>">
                            <i class="fas fa-users"></i><?php echo e(__('Products')); ?>

                        </a>
                    </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Event')): ?>
            <li class="nav-item">
                <a href="<?php echo e(route('event.index')); ?>" class="nav-link <?php echo e(request()->is('event*') ? 'active' : ''); ?>">
                    <i class="fas fa-calendar-alt"></i><?php echo e(__('Event')); ?>

                </a>
            </li>
        <?php endif; ?>

        <?php if(Gate::check('Manage Company Setting') || Gate::check('Manage System Setting')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('setting.index')); ?>" class="nav-link <?php echo e(request()->is('settings*') ? 'active' : ''); ?>">
                            <i class="fas fa-sliders-h"></i><?php echo e(__('System Setting')); ?>

                        </a>
                    </li>
                <?php endif; ?>

                <?php if(Gate::check('Manage Job') || Gate::check('Manage Job Application')|| Gate::check('Manage Job OnBoard') || Gate::check('Manage Custom Question') || Gate::check('Manage Interview Schedule') || Gate::check('Manage Career')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' || Request::route()->getName() == 'job.edit' || Request::route()->getName() == 'job.show' || Request::route()->getName() == 'job-application.index' || Request::route()->getName() == 'job-application.show' || Request::route()->getName() == 'job.application.candidate' || Request::route()->getName() == 'job.on.board' || Request::route()->getName() == 'job.on.board.convert'  || Request::route()->getName() ==
                        'custom-question.index'  || Request::route()->getName() == 'interview-schedule.index') ?
                        'active' : 'collapsed'); ?>"
                           href="#navbar-recurtment" data-toggle="collapse" role="button"
                           aria-expanded="<?php echo e((Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' || Request::route()->getName() == 'job.edit' || Request::route()->getName() == 'job.show' || Request::route()->getName() == 'job-application.index' || Request::route()->getName() == 'job-application.show' || Request::route()->getName() == 'job.application.candidate' || Request::route()->getName() == 'job.on.board' || Request::route()->getName() == 'job.on.board.convert'  || Request::route()->getName() ==
                           'custom-question.index'  || Request::route()->getName() == 'interview-schedule.index') ?
                           'true' : 'false'); ?>"
                           aria-controls="navbar-training">
                            <i class="fas fa-user-md"></i><?php echo e(__('Recurtment')); ?>

                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse <?php echo e((Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' || Request::route()->getName() == 'job.edit' || Request::route()->getName() == 'job.show' || Request::route()->getName() == 'job-application.index' || Request::route()->getName() == 'job-application.show' || Request::route()->getName() == 'job.application.candidate' || Request::route()->getName() == 'job.on.board' || Request::route()->getName() == 'job.on.board.convert'  || Request::route()->getName() ==
                        'custom-question.index'  || Request::route()->getName() == 'interview-schedule.index') ?
                        'show' : ''); ?>"
                             id="navbar-recurtment">
                            <ul class="nav flex-column submenu-ul">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Job')): ?>
                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' || Request::route()->getName() == 'job.edit' || Request::route()->getName() == 'job.show' ) ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('job.index')); ?>" class="nav-link"><?php echo e(__('Jobs')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Job Application')): ?>
                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'job-application.index' || Request::route()->getName() == 'job-application.show') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('job-application.index')); ?>" class="nav-link"><?php echo e(__('Job Application')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Job Application')): ?>
                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'job.application.candidate') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('job.application.candidate')); ?>" class="nav-link"><?php echo e(__('Job Candidate')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Job OnBoard')): ?>
                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'job.on.board' || Request::route()->getName() == 'job.on.board.convert') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('job.on.board')); ?>" class="nav-link"><?php echo e(__('Job OnBoard')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Custom Question')): ?>
                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'custom-question.index') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('custom-question.index')); ?>" class="nav-link"><?php echo e(__('Custom Question')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Interview Schedule')): ?>
                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'interview-schedule.index') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('interview-schedule.index')); ?>" class="nav-link"><?php echo e(__('Interview Schedule')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Career')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('career',[\Auth::user()->creatorId(),'en'])); ?>" target="_blank" class="nav-link"><?php echo e(__('Career')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if(\Auth::user()->type != 'super admin'): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(url('messages')); ?>" class="nav-link <?php echo e((Request::route()->getName() == 'messages') ? 'active' : ''); ?>">
                            <i class="fas fa-comments"></i><?php echo e(__('Messenger')); ?>

                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('Manage Department') || Gate::check('Manage Designation')  || Gate::check('Manage Document Type')  || Gate::check('Manage Branch') || Gate::check('Manage Award Type') || Gate::check('Manage Termination Types')|| Gate::check('Manage Payslip Type') || Gate::check('Manage Allowance Option') || Gate::check('Manage Loan Options')  || Gate::check('Manage Deduction Options') || Gate::check('Manage Expense Type')  || Gate::check('Manage Income Type') || Gate::check('Manage
                              Payment Type')  || Gate::check('Manage Leave Type') || Gate::check('Manage Training Type')  || Gate::check('Manage Job Category') || Gate::check('Manage Job Stage')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'department.index' || Request::route()->getName() == 'designation.index' || Request::route()->getName() == 'document.index' || Request::route()->getName() == 'branch.index' || Request::route()->getName() == 'awardtype.index' || Request::route()->getName() == 'terminationtype.index' || Request::route()->getName() == 'paysliptype.index' || Request::route()->getName() == 'allowanceoption.index' || Request::route()->getName() ==
            'loanoption.index' || Request::route()->getName() == 'deductionoption.index' || Request::route()->getName() == 'expensetype.index' || Request::route()->getName() == 'incometype.index'|| Request::route()->getName() == 'paymenttype.index' || Request::route()->getName() == 'leavetype.index' || Request::route()->getName() == 'goaltype.index' || Request::route()->getName() == 'trainingtype.index' || Request::route()->getName() == 'jobcategory.index' || Request::route()->getName() ==
            'jobstage.index') ? 'active' : 'collapsed'); ?>"
                           href="#navbar-constant" data-toggle="collapse" role="button"
                           aria-expanded="<?php echo e((Request::route()->getName() == 'department.index' || Request::route()->getName() == 'designation.index' || Request::route()->getName() == 'document.index' || Request::route()->getName() == 'branch.index' || Request::route()->getName() == 'awardtype.index' || Request::route()->getName() == 'terminationtype.index' || Request::route()->getName() == 'paysliptype.index' || Request::route()->getName() == 'allowanceoption.index' || Request::route()->getName() ==
            'loanoption.index' || Request::route()->getName() == 'deductionoption.index' || Request::route()->getName() == 'expensetype.index' || Request::route()->getName() == 'incometype.index'|| Request::route()->getName() == 'paymenttype.index' || Request::route()->getName() == 'leavetype.index' || Request::route()->getName() == 'goaltype.index' || Request::route()->getName() == 'trainingtype.index' || Request::route()->getName() == 'jobcategory.index' || Request::route()->getName() ==
            'jobstage.index') ? 'true' : 'false'); ?>"
                           aria-controls="navbar-constant">
                            <i class="fas fa-external-link-alt"></i><?php echo e(__('Constant')); ?>

                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse <?php echo e((Request::route()->getName() == 'department.index' || Request::route()->getName() == 'designation.index' || Request::route()->getName() == 'document.index' || Request::route()->getName() == 'branch.index' || Request::route()->getName() == 'awardtype.index' || Request::route()->getName() == 'terminationtype.index' || Request::route()->getName() == 'paysliptype.index' || Request::route()->getName() == 'allowanceoption.index' || Request::route()->getName() ==
            'loanoption.index' || Request::route()->getName() == 'deductionoption.index' || Request::route()->getName() == 'expensetype.index' || Request::route()->getName() == 'incometype.index'|| Request::route()->getName() == 'paymenttype.index' || Request::route()->getName() == 'leavetype.index' || Request::route()->getName() == 'goaltype.index' || Request::route()->getName() == 'trainingtype.index' || Request::route()->getName() == 'jobcategory.index' || Request::route()->getName() ==
            'jobstage.index') ? 'show' : ''); ?>"
                             id="navbar-constant">
                            <ul class="nav flex-column submenu-ul">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Branch')): ?>
                                    <li class="nav-item <?php echo e(request()->is('branch*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('branch.index')); ?>"><?php echo e(__('Branch')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Department')): ?>
                                    <li class="nav-item <?php echo e(request()->is('department*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('department.index')); ?>"><?php echo e(__('Department')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Designation')): ?>
                                    <li class="nav-item <?php echo e(request()->is('designation*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('designation.index')); ?>"><?php echo e(__('Designation')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Job Category')): ?>
                                    <li class="nav-item <?php echo e(request()->is('jobcategory*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('jobcategory.index')); ?>"><?php echo e(__('Job Category')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Job Stage')): ?>
                                    <li class="nav-item <?php echo e(request()->is('jobstage*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('jobstage.index')); ?>"><?php echo e(__('Job Stage')); ?></a>
                                    </li>
                                <?php endif; ?>
                                </ul>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/hrm/resources/views/Admin/menu.blade.php ENDPATH**/ ?>