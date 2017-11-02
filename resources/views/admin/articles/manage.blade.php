@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <h1><i class="fa fa-newspaper-o"></i> <i class="fa fa-pencil"></i>Manage</h1>
        </section>

        <section class="content-header">
            @include('partials.errors')
        </section>

        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form method="get" action="">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="cat_id" class="form-control">
                                            <option value="">All Categories</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->cat_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="pub_status" class="form-control">
                                            <option value="0">All Publish Status</option>
                                            <option value="1">Unpublished</option>
                                            <option value="2">Published</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="feat_status" class="form-control">
                                            <option value="0">All Featured Status</option>
                                            <option value="1">Not Featured</option>
                                            <option value="2">Featured</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="submit" class="btn btn-primary" value="Go" />
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form method="get" action="admin">
                                <input type="hidden" name="jmod" value="articles" />
                                <input type="hidden" name="page" value="manage-articles" />
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input
                                            type="text"
                                            name="search-article"
                                            class="form-control"
                                            placeholder="Search"
                                            value=""
                                        >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="submit" class="btn btn-primary" value="Search" />
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Featured</th>
                            <th>Published</th>
                            <th>Created</th>
                            <th>Last Modified</th>
                            <th style="width: 20px"></th>
                        </tr>
                        @foreach($articles as $article)
                        <tr>
                            <td>
                                <a href="{{ route('edit-article', ['id' => $article->id ]) }}">{{ $article->title }}</a>
                            </td>
                            <td>
                                {{ $article->categories ? $article->categories->cat_title : ''  }}
                            </td>
                            <td>Featured</td>
                            <td>Status</td>

                            <td>
                                <span class="small">
                                    {{ $article->created_at }}
                                </span> by
                                <span class="label label-default">{{ $article->users->username }}</span>
                            </td>
                            <td>
                                @if(isset($article->lastUpdated->username))
                                    <span class="small">
                                        {{ $article->updated_at }}
                                    </span>  by
                                    <span class="label label-default">{{ $article->lastUpdated->username}}</span>
                                @endif
                            </td>
                            <td>
                                <a
                                    class="btn btn-xs btn-danger"
                                    href="{{ route('delete-article', ['id' => $article->id ]) }}"
                                >
                                    <i class="fa fa-remove"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                </div>
                <div class="box-body">
                    {{ $articles->links() }}
                </div>
            </div>

        </section>
    </div>
@endsection
