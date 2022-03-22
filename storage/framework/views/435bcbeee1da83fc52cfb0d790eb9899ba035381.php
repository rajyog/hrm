<div class="card bg-none card-box">
    <?php echo e(Form::open(array('url'=>'event','method'=>'post'))); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('user_id',__('User'),['class'=>'form-control-label'])); ?>

                <select class="form-control select2" name="user_id" id="user_id" placeholder="<?php echo e(__('Select user')); ?>">
                    <option value=""><?php echo e(__('Select user')); ?></option>
                    <option value="0"><?php echo e(__('All user')); ?></option>
                    <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('title',__('Event Title'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter Event Title')))); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('start_date',__('Event start Date'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::text('start_date',null,array('class'=>'form-control datepicker'))); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('end_date',__('Event End Date'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::text('end_date',null,array('class'=>'form-control datepicker'))); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('color',__('Event Select Color'),['class'=>'form-control-label d-block mb-3'])); ?>

                <div class="btn-group btn-group-toggle btn-group-colors event-tag" data-toggle="buttons">
                    <label class="btn bg-info active"><input type="radio" name="color" value="#00B8D9" checked></label>
                    <label class="btn bg-warning"><input type="radio" name="color" value="#FFAB00"></label>
                    <label class="btn bg-danger"><input type="radio" name="color" value="#FF5630"></label>
                    <label class="btn bg-success"><input type="radio" name="color" value="#36B37E"></label>
                    <label class="btn bg-secondary"><input type="radio" name="color" value="#EFF2F7"></label>
                    <label class="btn bg-primary"><input type="radio" name="color" value="#051C4B"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('description',__('Event Description'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Event Description')))); ?>

            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /var/www/html/hrm/resources/views/event/create.blade.php ENDPATH**/ ?>