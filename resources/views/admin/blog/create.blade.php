@extends('admin.layout.master')
@section('title' , 'Create Product')
@section('body')
    <!-- Main -->
    <div class="app-main__inner">

        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Product
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form method="post" action="admin/blog" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id ?? null }}">
                                <div class="position-relative row form-group">
                                    <label for="title" class="col-md-3 text-md-right col-form-label">Title</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input required name="title" id="title" placeholder="Tile" type="text"
                                               class="form-control" value="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="content" class="col-md-3 text-md-right col-form-label">Content</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input required name="content" id="content" placeholder="Content" type="text"
                                               class="form-control" value="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="content" class="col-md-3 text-md-right col-form-label">Category</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input required name="category" id="category" placeholder="Category" type="text"
                                               class="form-control" value="">
                                    </div>
                                </div>
                                <div class="position-relative row form-group mb-1">
                                    <div class="col-md-9 col-xl-8 offset-md-2">
                                        <a href="#" class="border-0 btn btn-outline-danger mr-1">
                                                        <span class="btn-icon-wrapper pr-1 opacity-8">
                                                            <i class="fa fa-times fa-w-20"></i>
                                                        </span>
                                            <span>Cancel</span>
                                        </a>

                                        <button type="submit"
                                                class="btn-shadow btn-hover-shine btn btn-primary">
                                                        <span class="btn-icon-wrapper pr-2 opacity-8">
                                                            <i class="fa fa-download fa-w-20"></i>
                                                        </span>
                                            <span>Save</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- End Main -->
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection
