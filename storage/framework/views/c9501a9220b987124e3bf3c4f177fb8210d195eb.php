<div class="card bg-none card-box">
    <?php echo e(Form::model($event,array('route' => array('event.update', $event->id), 'method' => 'PUT'))); ?>

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
                    <label class="btn bg-info <?php echo e(($event->color=='#00B8D9')?'active':''); ?> "><input type="radio" name="color" value="#00B8D9" <?php echo e(($event->color=='#00B8D9')?'checked':''); ?>></label>
                    <label class="btn bg-warning <?php echo e(($event->color=='#FFAB00')?'active':''); ?>"><input type="radio" name="color" value="#FFAB00" <?php echo e(($event->color=='#FFAB00')?'checked':''); ?>></label>
                    <label class="btn bg-danger <?php echo e(($event->color=='#FF5630')?'active':''); ?>"><input type="radio" name="color" value="#FF5630" <?php echo e(($event->color=='#FF5630')?'checked':''); ?>></label>
                    <label class="btn bg-success <?php echo e(($event->color=='#36B37E')?'active':''); ?>"><input type="radio" name="color" value="#36B37E" <?php echo e(($event->color=='#36B37E')?'checked':''); ?>></label>
                    <label class="btn bg-secondary <?php echo e(($event->color=='#EFF2F7')?'active':''); ?>"><input type="radio" name="color" value="#EFF2F7" <?php echo e(($event->color=='#EFF2F7')?'checked':''); ?>></label>
                    <label class="btn bg-primary <?php echo e(($event->color=='#051C4B')?'active':''); ?>"><input type="radio" name="color" value="#051C4B" <?php echo e(($event->color=='#051C4B')?'checked':''); ?>></label>
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
            <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<script>
    if ($(".datepicker").length) {
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            format: 'yyyy-mm-dd',
            locale: date_picker_locale,
        });
    }
</script>
<?php /**PATH /var/www/html/hrm/resources/views/event/edit.blade.php ENDPATH**/ ?>