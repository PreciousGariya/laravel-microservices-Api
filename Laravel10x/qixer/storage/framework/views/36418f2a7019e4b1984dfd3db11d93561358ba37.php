<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit SubCategory')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.css','data' => []]); ?>
<?php $component->withName('media.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.success','data' => []]); ?>
<?php $component->withName('msg.success'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.error','data' => []]); ?>
<?php $component->withName('msg.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title"><?php echo e(__('Edit SubCategory')); ?>   </h4>
                            </div>
                            <div class="right-content">
                                <a class="btn btn-info btn-sm" href="<?php echo e(route('admin.subcategory')); ?>"><?php echo e(__('All SubCategories')); ?></a>
                            </div>
                        </div>
                        <form action="<?php echo e(route('admin.subcategory.edit',$subcategory->id)); ?>" method="post" enctype="multipart/form-data" id="edit_category_form">
                            <?php echo csrf_field(); ?>
                            <div class="tab-content margin-top-40">
                                <div class="form-group">
                                    <label for="icon" class="d-block"><?php echo e(__('Parent Category')); ?></label>
                                    <select name="category_id" id="up_category_id" class="form-control">
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($cat->id); ?>" <?php if($cat->id == $subcategory->category_id): ?> selected <?php endif; ?>><?php echo e($cat->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name"><?php echo e(__('Sub Category Name')); ?></label>
                                    <input type="text" class="form-control" name="name" id="name" value="<?php echo e($subcategory->name); ?>" placeholder="<?php echo e(__('Sub Category Name')); ?>">
                                </div>
                                <div class="form-group permalink_label">
                                    <label class="text-dark"><?php echo e(__('Permalink * : ')); ?>

                                        <span id="slug_show" class="display-inline"></span>
                                        <span id="slug_edit" class="display-inline">
                                             <button class="btn btn-warning btn-sm slug_edit_button"> <i class="fas fa-edit"></i> </button>
                                            <input type="text" name="slug" class="form-control subcategory_slug mt-2" value="<?php echo e($subcategory->slug); ?>" style="display: none">
                                            <button class="btn btn-info btn-sm slug_update_button mt-2" style="display: none"><?php echo e(__('Update')); ?></button>
                                        </span>
                                    </label>
                                </div>

                                <!-- meta section start -->
                                <div class="row mt-4">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="image"><?php echo e(__('Upload SubCategory Image')); ?></label>
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap">
                                                    <?php echo render_image_markup_by_attachment_id($subcategory->image,'','thumb'); ?>

                                                </div>
                                                <input type="hidden" name="image" value="<?php echo e($subcategory->image); ?>">
                                                <button type="button" class="btn btn-info media_upload_form_btn"
                                                        data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                        data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal"
                                                        data-target="#media_upload_modal">
                                                    <?php echo e(__('Upload Image')); ?>

                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-9">
                                        <div class="card">
                                            <div class="card-body meta">
                                                <h5 class="header-title"><?php echo e(__('Meta Section')); ?></h5>
                                                <div class="row">
                                                    <div class="col-xl-4 col-lg-3">
                                                        <div class="nav flex-column nav-pills" id="v-pills-tab"
                                                             role="tablist" aria-orientation="vertical">
                                                            <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill"
                                                               href="#v-pills-profile" role="tab"
                                                               aria-controls="v-pills-profile"
                                                               aria-selected="false"><?php echo e(__('Facebook Meta')); ?></a>
                                                            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill"
                                                               href="#v-pills-messages" role="tab"
                                                               aria-controls="v-pills-messages"
                                                               aria-selected="false"><?php echo e(__('Twitter Meta')); ?></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-8 col-lg-9">
                                                        <div class="tab-content meta-content" id="v-pills-tabContent">
                                                            <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel"
                                                                 aria-labelledby="v-pills-profile-tab">
                                                                <div class="form-group">
                                                                    <label for="title"><?php echo e(__('Facebook Meta Tag')); ?></label>
                                                                    <input type="text" class="form-control" data-role="tagsinput"
                                                                           name="facebook_meta_tags" value="<?php echo e($subcategory->metaData->facebook_meta_tags ?? ''); ?>">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="title"><?php echo e(__('Facebook Meta Description')); ?></label>
                                                                        <textarea name="facebook_meta_description"
                                                                                  class="form-control max-height-140 meta-desc"
                                                                                  cols="20"
                                                                                  rows="4"><?php echo $subcategory->metaData->facebook_meta_description ?? ''; ?></textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group ">
                                                                    <label for="og_meta_image"><?php echo e(__('Facebook Meta Image')); ?></label>
                                                                    <div class="media-upload-btn-wrapper">
                                                                        <div class="img-wrap">
                                                                            <?php echo render_attachment_preview_for_admin($subcategory->metaData->facebook_meta_image ?? ''); ?>

                                                                        </div>
                                                                        <input type="hidden" id="facebook_meta_image" name="facebook_meta_image"
                                                                               value="<?php echo e($subcategory->metaData->facebook_meta_image ?? ''); ?>">
                                                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                                                data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                                data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal"
                                                                                data-target="#media_upload_modal">
                                                                            <?php echo e(__('Change Image')); ?>

                                                                        </button>
                                                                    </div>
                                                                    <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png')); ?></small>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                                                 aria-labelledby="v-pills-messages-tab">
                                                                <div class="form-group">
                                                                    <label for="title"><?php echo e(__('Twitter Meta Tag')); ?></label>
                                                                    <input type="text" class="form-control" data-role="tagsinput"
                                                                           name="twitter_meta_tags" value=" <?php echo e($subcategory->metaData->twitter_meta_tags ?? ''); ?>">
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="title"><?php echo e(__('Twitter Meta Description')); ?></label>
                                                                        <textarea name="twitter_meta_description"
                                                                                  class="form-control max-height-140 meta-desc"
                                                                                  cols="20"
                                                                                  rows="4"><?php echo $subcategory->metaData->twitter_meta_description ?? ''; ?></textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="og_meta_image"><?php echo e(__('Twitter Meta Image')); ?></label>
                                                                    <div class="media-upload-btn-wrapper">
                                                                        <div class="img-wrap">
                                                                            <?php echo render_attachment_preview_for_admin($subcategory->metaData->twitter_meta_image ?? ''); ?>

                                                                        </div>
                                                                        <input type="hidden" id="twitter_meta_image" name="twitter_meta_image"
                                                                               value="<?php echo e($subcategory->metaData->twitter_meta_image ?? ''); ?>">
                                                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                                                data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                                data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal"
                                                                                data-target="#media_upload_modal">
                                                                            <?php echo e(__('Change Image')); ?>

                                                                        </button>
                                                                    </div>
                                                                    <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png')); ?></small>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- meta section end -->

                                <button type="submit" class="btn btn-primary mt-3 submit_btn"><?php echo e(__('Submit ')); ?></button>

                              </div>
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.markup','data' => []]); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.icon-picker','data' => []]); ?>
<?php $component->withName('icon-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?> 
</script> 
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.js','data' => []]); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

<script>
    (function ($) {
        "use strict";
        $(document).ready(function () {
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.bulk-action-js','data' => ['url' => route('admin.subcategory.bulk.action')]]); ?>
<?php $component->withName('bulk-action-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.subcategory.bulk.action'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

            //Permalink Code
            var sl =  $('.subcategory_slug').val();
            var url = `<?php echo e(url('/subcategory/')); ?>/` + sl;
            var data = $('#slug_show').text(url).css('color', 'blue');

            function converToSlug(slug){
                let finalSlug = slug.replace(/[^a-zA-Z0-9]/g, ' ');
                //remove multiple space to single
                finalSlug = slug.replace(/  +/g, ' ');
                // remove all white spaces single or multiple spaces
                finalSlug = slug.replace(/\s/g, '-').toLowerCase().replace(/[^\w-]+/g, '-');
                return finalSlug;
            }

            $(document).on('click','.swal_status_change',function(e){
                e.preventDefault();
                Swal.fire({
                    title: '<?php echo e(__("Are you sure to change status?")); ?>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).next().find('.swal_form_submit_btn').trigger('click');
                    }
                });
            });

            //Slug Edit Code
            $(document).on('click', '.slug_edit_button', function (e) {
                e.preventDefault();
                $('.subcategory_slug').show();
                $(this).hide();
                $('.slug_update_button').show();
            });

            //Slug Update Code
            $(document).on('click', '.slug_update_button', function (e) {
                e.preventDefault();
                $(this).hide();
                $('.slug_edit_button').show();
                var update_input = $('.subcategory_slug').val();
                var slug = converToSlug(update_input);
                var url = `<?php echo e(url('/subcategory/')); ?>/` + slug;
                $('#slug_show').text(url);
                $('.subcategory_slug').hide();
            });

        });
    })(jQuery)
</script>
<?php $__env->stopSection(); ?> 



<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/bytesed/public_html/laravel/qixer/@core/resources/views/backend/pages/subcategory/edit_subcategory.blade.php ENDPATH**/ ?>