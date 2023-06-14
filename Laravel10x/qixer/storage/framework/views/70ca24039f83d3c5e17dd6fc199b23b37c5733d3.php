<a tabindex="0" class="btn btn-danger btn-xs <?php echo e($class ?? 'mb-3'); ?> mr-1 swal_delete_button" data-toggle="tooltip" title="Delete User Account">
    <i class="ti-trash"></i>
</a>
<form method='post' action='<?php echo e($url); ?>' class="d-none">
<input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
<br>
<button type="submit" class="admin_delete_account_swal_form_submit_btn d-none"></button>
 </form>
<?php /**PATH /home/bytesed/public_html/laravel/qixer/@core/resources/views/components/admin-delete-user-account.blade.php ENDPATH**/ ?>