@extends('backend.admin-master')

@section('site-title')
    {{__('Edit Child Category')}}
@endsection
@section('style')
    <x-media.css/>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Edit Child Category')}}   </h4>
                            </div>
                            <div class="right-content">
                                <a class="btn btn-info btn-sm" href="{{route('admin.child.category')}}">{{__('All Child Categories')}}</a>
                            </div>
                        </div>
                        <form action="{{route('admin.child.category.edit',$child_category->id)}}" method="post" enctype="multipart/form-data" id="edit_category_form">
                            @csrf
                            <div class="tab-content margin-top-40">
                                <div class="form-group">
                                    <label for="icon" class="d-block">{{__('Parent Category')}}</label>
                                    <select name="category_id" id="category" class="form-control">
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" @if($cat->id==$child_category->category_id) selected @endif>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="icon" class="d-block">{{__('Sub Category')}}</label>
                                    <select  name="sub_category_id" id="subcategory" class="form-control subcategory">
                                        <option @if(!empty($child_category->sub_category_id)) value="{{ $child_category->sub_category_id }}" @else value="" @endif >
                                            {{ optional($child_category->subcategory)->name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">{{__('Child Category Name')}}</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{$child_category->name}}" placeholder="{{__('Child Category Name')}}">
                                </div>
                                <div class="form-group permalink_label">
                                    <label class="text-dark">{{__('Permalink * : ')}}
                                        <span id="slug_show" class="display-inline"></span>
                                        <span id="slug_edit" class="display-inline">
                                             <button class="btn btn-warning btn-sm slug_edit_button"> <i class="fas fa-edit"></i> </button>
                                            <input type="text" name="slug" class="form-control child_category_slug mt-2" value="{{$child_category->slug}}" style="display: none">
                                            <button class="btn btn-info btn-sm slug_update_button mt-2" style="display: none">{{__('Update')}}</button>
                                        </span>
                                    </label>
                                </div>

                                <!-- meta section start -->
                                <div class="row mt-4">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="image">{{__('Upload Child Category Image')}}</label>
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap">
                                                    {!! render_image_markup_by_attachment_id($child_category->image,'','thumb') !!}
                                                </div>
                                                <input type="hidden" name="image" value="{{$child_category->image}}">
                                                <button type="button" class="btn btn-info media_upload_form_btn"
                                                        data-btntitle="{{__('Select Image')}}"
                                                        data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                        data-target="#media_upload_modal">
                                                    {{__('Upload Image')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-9">
                                        <div class="card">
                                            <div class="card-body meta">
                                                <h5 class="header-title">{{__('Meta Section')}}</h5>
                                                <div class="row">
                                                    <div class="col-xl-4 col-lg-3">
                                                        <div class="nav flex-column nav-pills" id="v-pills-tab"
                                                             role="tablist" aria-orientation="vertical">
                                                            <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill"
                                                               href="#v-pills-profile" role="tab"
                                                               aria-controls="v-pills-profile"
                                                               aria-selected="false">{{__('Facebook Meta')}}</a>
                                                            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill"
                                                               href="#v-pills-messages" role="tab"
                                                               aria-controls="v-pills-messages"
                                                               aria-selected="false">{{__('Twitter Meta')}}</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-8 col-lg-9">
                                                        <div class="tab-content meta-content" id="v-pills-tabContent">
                                                            <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel"
                                                                 aria-labelledby="v-pills-profile-tab">
                                                                <div class="form-group">
                                                                    <label for="title">{{__('Facebook Meta Tag')}}</label>
                                                                    <input type="text" class="form-control" data-role="tagsinput"
                                                                           name="facebook_meta_tags" value="{{$child_category->metaData->facebook_meta_tags ?? ''}}">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="title">{{__('Facebook Meta Description')}}</label>
                                                                        <textarea name="facebook_meta_description"
                                                                                  class="form-control max-height-140 meta-desc"
                                                                                  cols="20"
                                                                                  rows="4">{!! $child_category->metaData->facebook_meta_description ?? '' !!}</textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group ">
                                                                    <label for="og_meta_image">{{__('Facebook Meta Image')}}</label>
                                                                    <div class="media-upload-btn-wrapper">
                                                                        <div class="img-wrap">
                                                                            {!! render_attachment_preview_for_admin($child_category->metaData->facebook_meta_image ?? '') !!}
                                                                        </div>
                                                                        <input type="hidden" id="facebook_meta_image" name="facebook_meta_image"
                                                                               value="{{$child_category->metaData->facebook_meta_image ?? ''}}">
                                                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                                                data-btntitle="{{__('Select Image')}}"
                                                                                data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                                                data-target="#media_upload_modal">
                                                                            {{__('Change Image')}}
                                                                        </button>
                                                                    </div>
                                                                    <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                                                 aria-labelledby="v-pills-messages-tab">
                                                                <div class="form-group">
                                                                    <label for="title">{{__('Twitter Meta Tag')}}</label>
                                                                    <input type="text" class="form-control" data-role="tagsinput"
                                                                           name="twitter_meta_tags" value=" {{$child_category->metaData->twitter_meta_tags ?? ''}}">
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="title">{{__('Twitter Meta Description')}}</label>
                                                                        <textarea name="twitter_meta_description"
                                                                                  class="form-control max-height-140 meta-desc"
                                                                                  cols="20"
                                                                                  rows="4">{!! $child_category->metaData->twitter_meta_description ?? '' !!}</textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="og_meta_image">{{__('Twitter Meta Image')}}</label>
                                                                    <div class="media-upload-btn-wrapper">
                                                                        <div class="img-wrap">
                                                                            {!! render_attachment_preview_for_admin($child_category->metaData->twitter_meta_image ?? '') !!}
                                                                        </div>
                                                                        <input type="hidden" id="twitter_meta_image" name="twitter_meta_image"
                                                                               value="{{$child_category->metaData->twitter_meta_image ?? ''}}">
                                                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                                                data-btntitle="{{__('Select Image')}}"
                                                                                data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                                                data-target="#media_upload_modal">
                                                                            {{__('Change Image')}}
                                                                        </button>
                                                                    </div>
                                                                    <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
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

                                <button type="submit" class="btn btn-primary mt-3 submit_btn">{{__('Submit ')}}</button>

                              </div>
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection

@section('script')
<script>
    <x-icon-picker/> 
</script> 
<x-media.js />

<script>
    (function ($) {
        "use strict";

        $(document).ready(function () {
            //Permalink Code
                var sl =  $('.child_category_slug').val();
                var url = `{{url('/child-category/')}}/` + sl;
                var data = $('#slug_show').text(url).css('color', 'blue');

                function converToSlug(slug){
                   let finalSlug = slug.replace(/[^a-zA-Z0-9]/g, ' ');
                    //remove multiple space to single
                    finalSlug = slug.replace(/  +/g, ' ');
                    // remove all white spaces single or multiple spaces
                    finalSlug = slug.replace(/\s/g, '-').toLowerCase().replace(/[^\w-]+/g, '-');
                    return finalSlug;
                }

                //Slug Edit Code
                $(document).on('click', '.slug_edit_button', function (e) {
                    e.preventDefault();
                    $('.child_category_slug').show();
                    $(this).hide();
                    $('.slug_update_button').show();
                });

                //Slug Update Code
                $(document).on('click', '.slug_update_button', function (e) {
                    e.preventDefault();
                    $(this).hide();
                    $('.slug_edit_button').show();
                    var update_input = $('.child_category_slug').val();
                    var slug = converToSlug(update_input);
                    var url = `{{url('/child-category/')}}/` + slug;
                    $('#slug_show').text(url);
                    $('.child_category_slug').val(slug)
                    $('.child_category_slug').hide();
                });

            $('#category').on('change',function(){
                let category_id = $(this).val();
                $.ajax({
                    method:'post',
                    url:"{{route('admin.get.subcategory')}}",
                    data:{category_id:category_id},
                    success:function(res){
                        if(res.status=='success'){
                            let alloptions = '';
                            let allSubCategory = res.sub_categories;
                            $.each(allSubCategory,function(index,value){
                                alloptions +="<option value='" + value.id + "'>" + value.name + "</option>";
                            });
                            $(".subcategory").html(alloptions);
                            $('#subcategory').niceSelect('update');
                        }
                    }
                })
            })

        });
    })(jQuery)
</script>
@endsection 


