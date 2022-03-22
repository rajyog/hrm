
<div id="imageModalBox" class="imageModal">
    <span class="imageModal-close">&times;</span>
    <img class="imageModal-content" id="imageModalBoxSrc">
  </div>
  
  
  <div class="app-modal" data-name="delete">
      <div class="app-modal-container">
          <div class="app-modal-card" data-name="delete" data-modal='0'>
              <div class="app-modal-header">Are you sure you want to delete this?</div>
              <div class="app-modal-body">You can not undo this action</div>
              <div class="app-modal-footer">
                  <a href="javascript:void(0)" class="app-btn cancel">Cancel</a>
                  <a href="javascript:void(0)" class="app-btn a-btn-danger delete">Delete</a>
              </div>
          </div>
      </div>
  </div>
  
  <div class="app-modal" data-name="alert">
      <div class="app-modal-container">
          <div class="app-modal-card" data-name="alert" data-modal='0'>
              <div class="app-modal-header"></div>
              <div class="app-modal-body"></div>
              <div class="app-modal-footer">
                  <a href="javascript:void(0)" class="app-btn cancel">Cancel</a>
              </div>
          </div>
      </div>
  </div>
  
  <div class="app-modal" data-name="settings">
      <div class="app-modal-container">
          <div class="app-modal-card" data-name="settings" data-modal='0'>
              <form id="updateAvatar" action="<?php echo e(route('avatar.update')); ?>" enctype="multipart/form-data" method="POST">
                  <?php echo csrf_field(); ?>
                  <div class="app-modal-header">Update your profile settings</div>
                  <div class="app-modal-body">
                      
                      <div class="avatar av-l upload-avatar-preview"
                      style="background-image: url('<?php echo e(asset('/storage/'.config('chatify.user_avatar.folder').'/'.Auth::user()->avatar)); ?>');"
                      ></div>
                      <p class="upload-avatar-details"></p>
                      <label class="app-btn a-btn-primary update">
                          Upload profile photo
                          <input class="upload-avatar" accept="image/*" name="avatar" type="file" style="display: none" />
                      </label>
                      
                      <p class="divider"></p>
                      <p class="app-modal-header">Dark Mode <span class="
                        <?php echo e(Auth::user()->dark_mode > 0 ? 'fas' : 'far'); ?> fa-moon dark-mode-switch"
                         data-mode="<?php echo e(Auth::user()->dark_mode > 0 ? 1 : 0); ?>"></span></p>
                      
                      <p class="divider"></p>
                      <p class="app-modal-header">Change <?php echo e(config('chatify.name')); ?> Color</p>
                      <div class="update-messengerColor">
                            <a href="javascript:void(0)" class="messengerColor-1"></a>
                            <a href="javascript:void(0)" class="messengerColor-2"></a>
                            <a href="javascript:void(0)" class="messengerColor-3"></a>
                            <a href="javascript:void(0)" class="messengerColor-4"></a>
                            <a href="javascript:void(0)" class="messengerColor-5"></a>
                            <br/>
                            <a href="javascript:void(0)" class="messengerColor-6"></a>
                            <a href="javascript:void(0)" class="messengerColor-7"></a>
                            <a href="javascript:void(0)" class="messengerColor-8"></a>
                            <a href="javascript:void(0)" class="messengerColor-9"></a>
                            <a href="javascript:void(0)" class="messengerColor-10"></a>
                      </div>
                  </div>
                  <div class="app-modal-footer">
                      <a href="javascript:void(0)" class="app-btn cancel">Cancel</a>
                      <input type="submit" class="app-btn a-btn-success update" value="Update" />
                  </div>
              </form>
          </div>
      </div>
  </div><?php /**PATH /var/www/html/hrm/resources/views/vendor/Chatify/layouts/modals.blade.php ENDPATH**/ ?>