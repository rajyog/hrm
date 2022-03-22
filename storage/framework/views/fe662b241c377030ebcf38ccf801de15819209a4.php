<?php $__env->startPush('css-page'); ?>
    <meta name="route" content="<?php echo e($route); ?>">
    <meta name="url" content="<?php echo e(url('').'/'.config('chatify.routes.prefix')); ?>" data-user="<?php echo e(Auth::user()->id); ?>">

    
    <script src="<?php echo e(asset('js/chatify/font.awesome.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/chatify/autosize.js')); ?>"></script>
    
    <script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>

    
    <link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css'/>
    <link href="<?php echo e(asset('css/chatify/style.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('css/chatify/'.$dark_mode.'.mode.css')); ?>" rel="stylesheet"/>
    

    <?php echo $__env->make('Chatify::layouts.messengerColor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Messenger')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="messenger rounded min-h-700 overflow-hidden ">
            
            <div class="messenger-listView">
        
        <div class="m-header">
            <nav>
                <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">MESSAGES</span> </a>
                
                <nav class="m-header-right">
                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                </nav>
            </nav>
            
            <input type="text" class="messenger-search" placeholder="Search" />
            
            <div class="messenger-listView-tabs">
                <a href="#" <?php if($route == 'user'): ?> class="active-tab" <?php endif; ?> data-view="users">
                    <span class="far fa-user"></span> People</a>

            </div>
        </div>
        
        <div class="m-body">
           
           
           <div class="<?php if($route == 'user'): ?> show <?php endif; ?> messenger-tab app-scroll" data-view="users">

               
               <p class="messenger-title">Favorites</p>
                <div class="messenger-favorites app-scroll-thin"></div>

               
               <?php echo view('Chatify::layouts.listItem', ['get' => 'saved','id' => $id])->render(); ?>


               
               <div class="listOfContacts" style="width: 100%;height: calc(100% - 200px);"></div>

           </div>

           
           <div class="<?php if($route == 'group'): ?> show <?php endif; ?> messenger-tab app-scroll" data-view="groups">
                
                <p style="text-align: center;color:grey;">Soon will be available</p>
             </div>

             
           <div class="messenger-tab app-scroll" data-view="search">
                
                <p class="messenger-title">Search</p>
                <div class="search-records">
                    <p class="message-hint"><span>Type to search..</span></p>
                </div>
             </div>
        </div>
    </div>

    
    <div class="messenger-messagingView">
        
        <div class="m-header m-header-messaging">
            <nav>
                
                <div style="display: inline-flex;">
                    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                    </div>
                    <a href="#" class="user-name"><?php echo e(config('chatify.name')); ?></a>
                </div>
                
                <nav class="m-header-right">
                    <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                    <a href="/"><i class="fas fa-home"></i></a>
                    <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                </nav>
            </nav>
        </div>
        
        <div class="internet-connection">
            <span class="ic-connected">Connected</span>
            <span class="ic-connecting">Connecting...</span>
            <span class="ic-noInternet">No internet access</span>
        </div>
        
        <div class="m-body app-scroll">
            <div class="messages">
                <p class="message-hint" style="margin-top: calc(30% - 126.2px);"><span>Please select a chat to start messaging</span></p>
            </div>
            
            <div class="typing-indicator">
                <div class="message-card typing">
                    <p>
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                    </p>
                </div>
            </div>
            
            <?php echo $__env->make('Chatify::layouts.sendForm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    
    <div class="messenger-infoView app-scroll">
        
        <nav>
            <a href="#"><i class="fas fa-times"></i></a>
        </nav>
        <?php echo view('Chatify::layouts.info')->render(); ?>

    </div>
</div>



<?php echo $__env->make('Chatify::layouts.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <?php echo $__env->make('Chatify::layouts.footerLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/hrm/resources/views/vendor/Chatify/pages/app.blade.php ENDPATH**/ ?>