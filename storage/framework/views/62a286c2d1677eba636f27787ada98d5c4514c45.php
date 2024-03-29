<div class="card bg-none card-box">
    <?php echo e(Form::model($role,array('route' => array('roles.update', $role->id), 'method' => 'PUT'))); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('name',__('Name'),['class'=>'form-control-label'])); ?>

                <?php if($role->name == 'employee'): ?>
                    <p class="form-control"><?php echo e($role->name); ?></p>
                <?php else: ?>
                    <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Role Name')))); ?>

                <?php endif; ?>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-name" role="alert">
                    <strong class="text-danger"><?php echo e($message); ?></strong>
                </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php if(!empty($permissions)): ?>
                    <h6 class="my-3"><?php echo e(__('Assign Permission to Roles')); ?> </h6>
                    <table class="table table-striped mb-0" id="dataTable-1">
                        <thead>
                        <tr>
                            <th><?php echo e(__('Module')); ?> </th>
                            <th><?php echo e(__('Permissions')); ?> </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                           $modules=['User','Role','Department','Designation','Branch','Event','Document','Job Category','User Last Login','Company Setting','Job Stage','Job','Job Application','Permission','Product'];


                            if(Auth::user()->type == 'super admin'){
                                $modules[] = 'Language';
                            }
                        ?>
                        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($module); ?></td>
                                <td>
                                    <div class="row">
                                        <?php if(in_array('Manage '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('Manage '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,$role->permission, ['class'=>'custom-control-input','id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Manage',['class'=>'custom-control-label font-weight-500'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('Create '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('Create '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,$role->permission, ['class'=>'custom-control-input','id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Create',['class'=>'custom-control-label font-weight-500'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('Edit '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('Edit '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,$role->permission, ['class'=>'custom-control-input','id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Edit',['class'=>'custom-control-label font-weight-500'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('Delete '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('Delete '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,$role->permission, ['class'=>'custom-control-input','id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Delete',['class'=>'custom-control-label font-weight-500'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('Move '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('Move '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'custom-control-input','id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Move',['class'=>'custom-control-label font-weight-500'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>


                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /var/www/html/hrm/resources/views/roles/edit.blade.php ENDPATH**/ ?>