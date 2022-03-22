<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <section class="section">
            
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between w-100">
                                    <h4> <?php echo e(__('Manage Permission')); ?></h4>

                                    <a href="#" data-url="<?php echo e(route('permissions.create')); ?>" class="btn btn-sm btn-primary btn-round btn-icon" data-ajax-popup="true" data-toggle="tooltip" data-title="<?php echo e(__('Add Permission')); ?>" data-original-title="<?php echo e(__('Add Permission')); ?>">


                                        <?php echo e(__('Create')); ?>

                                    </a>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="table-responsive">
                                        <div class="row">
                                            <div class="col-sm-12 card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped dataTable" >
                                                        <thead class="">
                                                        <tr>
                                                            <th scope="col" style="width: 88%;"><?php echo e(__('title')); ?></th>
                                                            <th scope="col" style="width: 12%;"><?php echo e(__('Action')); ?></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr role="row">
                                                                <td><?php echo e($permission->name); ?></td>
                                                                <td>
                                                                    <a href="#" data-url="<?php echo e(route('permissions.edit',$permission->id)); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Update permission')); ?>" class="btn btn-outline btn-sm blue-madison">
                                                                        <i class="far fa-edit"></i>
                                                                    </a>
                                                                    <a href="#" class="btn btn-outline btn-sm red" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($permission->id); ?>').submit();">
                                                                        <i class="far fa-trash-alt"></i></a>
                                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id],'id'=>'delete-form-'.$permission->id]); ?>

                                                                    <?php echo Form::close(); ?>

                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/hrm/resources/views/permission/index.blade.php ENDPATH**/ ?>