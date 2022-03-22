<div class="card bg-none card-box">
    <?php echo e(Form::open(array('url'=>'job-application','method'=>'post', 'enctype' => "multipart/form-data"))); ?>

    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('job',__('Job'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::select('job',$jobs,null,array('class'=>'form-control select2','id'=>'jobs'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('name',__('Name'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control name'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('email',__('Email'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('email',null,array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('phone',__('Phone'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('phone',null,array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group col-md-6 dob d-none">
            <?php echo Form::label('dob', __('Date of Birth'),['class'=>'form-control-label']); ?>

            <?php echo Form::text('dob', old('dob'), ['class' => 'form-control datepicker']); ?>

        </div>
        <div class="form-group col-md-6 gender d-none">
            <?php echo Form::label('gender', __('Gender'),['class'=>'form-control-label']); ?>

            <div class="d-flex radio-check">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="g_male" value="Male" name="gender" class="custom-control-input">
                    <label class="custom-control-label" for="g_male"><?php echo e(__('Male')); ?></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="g_female" value="Female" name="gender" class="custom-control-input">
                    <label class="custom-control-label" for="g_female"><?php echo e(__('Female')); ?></label>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6 country d-none">
            <?php echo e(Form::label('country',__('Country'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('country',null,array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group col-md-6 country d-none">
            <?php echo e(Form::label('state',__('State'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('state',null,array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group col-md-6 country d-none">
            <?php echo e(Form::label('city',__('City'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('city',null,array('class'=>'form-control'))); ?>

        </div>

        <div class="form-group col-md-6 profile d-none">
            <?php echo e(Form::label('profile',__('Profile'),['class'=>'form-control-label'])); ?>

            <div class="choose-file form-group">
                <label for="profile" class="form-control-label">
                    <div><?php echo e(__('Choose file here')); ?></div>
                    <input type="file" class="form-control" name="profile" id="profile" data-filename="profile_create">
                </label>
                <p class="profile_create"></p>
            </div>
        </div>
        <div class="form-group col-md-6 resume d-none">
            <?php echo e(Form::label('resume',__('CV / Resume'),['class'=>'form-control-label'])); ?>

            <div class="choose-file form-group">
                <label for="resume" class="form-control-label">
                    <div><?php echo e(__('Choose file here')); ?></div>
                    <input type="file" class="form-control" name="resume" id="resume" data-filename="resume_create">
                </label>
                <p class="resume_create"></p>
            </div>
        </div>
        <div class="form-group col-md-12 letter d-none">
            <?php echo e(Form::label('cover_letter',__('Cover Letter'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::textarea('cover_letter',null,array('class'=>'form-control'))); ?>

        </div>
        <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-group col-md-12  question question_<?php echo e($question->id); ?> d-none">
                <?php echo e(Form::label($question->question,$question->question,['class'=>'form-control-label'])); ?>

                <input type="text" class="form-control" name="question[<?php echo e($question->question); ?>]" <?php echo e(($question->is_required=='yes')?'required':''); ?>>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12">
            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>

<?php /**PATH /var/www/html/hrm/resources/views/jobApplication/create.blade.php ENDPATH**/ ?>