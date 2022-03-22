<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php
    $logo=asset(Storage::disk('local')->url('uploads/logo/'));
?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <section class="nav-tabs">
                <div class="col-lg-12 our-system">
                    <div class="row">
                        <ul class="nav nav-tabs my-4">
                            <li>
                                <a data-toggle="tab" href="#site-setting" class="active"><?php echo e(__('Site Setting')); ?></a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#email-settings" class=""><?php echo e(__('Email Setting')); ?> </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="site-setting" class="tab-pane in active">
                        <?php echo e(Form::model($settings,array('url'=>'setting','method'=>'POST','enctype' => "multipart/form-data"))); ?>

                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Site settings')); ?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4 class="small-title"><?php echo e(__('Logo')); ?></h4>
                                <div class="card setting-card setting-logo-box">
                                    <div class="logo-content">
                                        <img src="<?php echo e($logo.'/logo.png'); ?>" class="big-logo" alt=""/>
                                    </div>
                                    <div class="choose-file mt-5">
                                        <label for="logo">
                                            <div><?php echo e(__('Choose file here')); ?></div>
                                            <input type="file" class="form-control" name="logo" id="logo" data-filename="edit-logo">
                                        </label>
                                        <p class="edit-logo"></p>
                                    </div>
                                    <p class="lh-160 mb-0 pt-2"><?php echo e(__('These Logo will appear on Payslip.')); ?></p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4 class="small-title"><?php echo e(__('Landi<?php
                                    $logo = asset(Storage::url('uploads/logo/'));
                                    ?>ng Page Logo')); ?></h4>
                                <div class="card setting-card setting-logo-box">
                                    <div class="col-12">
                                        <div class="logo-content">
                                            <img src="<?php echo e($logo.'/landing_logo.png'); ?>" class="landing-logo" alt=""/>
                                        </div>
                                        <div class="choose-file mt-4">
                                            <label for="landing-logo">
                                                <div><?php echo e(__('Choose file here')); ?></div>
                                                <input type="file" class="form-control" name="landing_logo" id="landing-logo" data-filename="edit-landing-logo">
                                            </label>
                                            <p class="edit-landing-logo"></p>
                                        </div>
                                    </div>

                                    <div class="form-group mt-2">
                                        <?php echo e(Form::label('display_landing_page',__('Landing Page Display'),array('class'=>'form-control-label'))); ?>

                                        <div class="">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="display_landing_page" id="display_landing_page" <?php echo e($settings['display_landing_page'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                <label class="custom-control-label form-control-label" for="display_landing_page"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4 class="small-title"><?php echo e(__('Favicon')); ?></h4>
                                <div class="card setting-card setting-logo-box">
                                    <div class="logo-content">
                                        <img src="<?php echo e($logo.'/favicon.png'); ?>" class="small-logo" alt=""/>
                                    </div>
                                    <div class="choose-file mt-5">
                                        <label for="small-favicon">
                                            <div><?php echo e(__('Choose file here')); ?></div>
                                            <input type="file" class="form-control" name="favicon" id="small-favicon" data-filename="edit-favicon">
                                        </label>
                                        <p class="edit-favicon"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4 class="small-title"><?php echo e(__('Settings')); ?></h4>
                                <div class="card setting-card">
                                    <div class="form-group">
                                        <?php echo e(Form::label('title_text',__('Title Text'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('title_text',null,array('class'=>'form-control','placeholder'=>__('Title Text')))); ?>

                                        <?php $__errorArgs = ['title_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-title_text" role="alert">
                                         <strong class="text-danger"><?php echo e($message); ?></strong>
                                         </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::label('footer_text',__('Footer Text'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('footer_text',null,array('class'=>'form-control','placeholder'=>__('Footer Text')))); ?>

                                        <?php $__errorArgs = ['footer_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-footer_text" role="alert">
                                                                     <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                   
                                    <div class="form-group">
                                        <?php echo e(Form::label('SITE_RTL',__('RTL'),array('class'=>'form-control-label'))); ?>

                                        <div class="">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="SITE_RTL" id="SITE_RTL" <?php echo e(env('SITE_RTL') == 'on' ? 'checked="checked"' : ''); ?>>
                                                <label class="custom-control-label form-control-label" for="SITE_RTL"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12 text-right">
                                <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn-submit">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                    <div id="email-settings" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Email settings')); ?></h4>
                                </div>
                            </div>
                            <div class="card bg-none company-setting">
                                <?php echo e(Form::open(array('route'=>'email.settings','method'=>'post'))); ?>

                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_driver',__('Mail Driver'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_driver',env('MAIL_DRIVER'),array('class'=>'form-control','placeholder'=>__('Enter Mail Driver')))); ?>

                                        <?php $__errorArgs = ['mail_driver'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_driver" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_host',__('Mail Host'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_host',env('MAIL_HOST'),array('class'=>'form-control ','placeholder'=>__('Enter Mail Driver')))); ?>

                                        <?php $__errorArgs = ['mail_host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_driver" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_port',__('Mail Port'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_port',env('MAIL_PORT'),array('class'=>'form-control','placeholder'=>__('Enter Mail Port')))); ?>

                                        <?php $__errorArgs = ['mail_port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_port" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_username',__('Mail Username'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_username',env('MAIL_USERNAME'),array('class'=>'form-control','placeholder'=>__('Enter Mail Username')))); ?>

                                        <?php $__errorArgs = ['mail_username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_username" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_password',__('Mail Password'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_password',env('MAIL_PASSWORD'),array('class'=>'form-control','placeholder'=>__('Enter Mail Password')))); ?>

                                        <?php $__errorArgs = ['mail_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_password" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_encryption',__('Mail Encryption'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_encryption',env('MAIL_ENCRYPTION'),array('class'=>'form-control','placeholder'=>__('Enter Mail Encryption')))); ?>

                                        <?php $__errorArgs = ['mail_encryption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_encryption" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_from_address',__('Mail From Address'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_from_address',env('MAIL_FROM_ADDRESS'),array('class'=>'form-control','placeholder'=>__('Enter Mail From Address')))); ?>

                                        <?php $__errorArgs = ['mail_from_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_from_address" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_from_name',__('Mail From Name'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_from_name',env('MAIL_FROM_NAME'),array('class'=>'form-control','placeholder'=>__('Enter Mail Encryption')))); ?>

                                        <?php $__errorArgs = ['mail_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_from_name" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                </div>
                                <div class="col-lg-12 ">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <a href="#" data-url="<?php echo e(route('test.mail' )); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Send Test Mail')); ?>" class="text-white btn-custom">
                                                <?php echo e(__('Send Test Mail')); ?>

                                            </a>
                                        </div>
                                        <div class="form-group col-md-6 text-right">
                                            <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn-submit text-white">
                                        </div>
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/hrm/resources/views/setting/company_settings.blade.php ENDPATH**/ ?>