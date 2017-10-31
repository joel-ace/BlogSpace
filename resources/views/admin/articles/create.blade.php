@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-newspaper-o"></i> <i class="fa fa-pencil"></i>Add Post</h1>
        </section>

        <section class="content">
            <div class="row">

                <div class="col-md-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Article</h3>
                            @include('partials.errors')
                        </div>

                        <form
                            role="form"
                            action="{{ $action == 'create' ? route('article-form-submit') : route('edit-article-submit') }}"
                            method="post"
                            enctype="multipart/form-data"
                        >
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text"
                                       name="title"
                                       class="form-control"
                                       placeholder="Enter a Title"
                                       value="{{ old('title', isset($article->title) ? $article->title : '') }}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select name="cat_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            @if (old('cat_id',
                                                    isset($article->cat_id) ? $article->cat_id : '') == $category->id)
                                                <option value="{{ $category->id }}" selected>
                                                    {{ $category->cat_title }}
                                                </option>
                                            @else
                                                <option value="{{ $category->id }}">
                                                    {{ $category->cat_title }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Publish Status</label>
                                    <select name="status" class="form-control">
                                        <option value="2"
                                            {{
                                                old('status', isset($article->status) ? $article->status : '') == 2 ?
                                                'selected' : ''
                                            }}
                                        >
                                            Published
                                        </option>
                                        <option value="1"
                                            {{
                                               old('status', isset($article->status) ? $article->status : '') == 1 ?
                                                'selected' : ''
                                            }}
                                        >
                                            Unpublished
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea
                                        name="content"
                                        class="form-control"
                                        rows="15">{{ old('content', isset($article->title) ? $article->content : '') }}
                                    </textarea>
                                    <input type="hidden" name="id" value="{{ isset($article->id) ? $article->id : '' }}">
                                </div>

                                <div class="form-group well well-sm no-shadow">
                                    <label for="img_url">Featured Image</label>
                                    <input name="file_upload[]" type="file">
                                </div>

                            </div>
                            <div class="box-footer">
                                <button type="submit" name="submit" class="btn btn-sm btn-primary">Submit</button>
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </section>


    </div>
@endsection
