@extends('layouts.backend.main')
@section('title', 'MyBlog | Dashboard')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Blog Posts</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/backend/home">Home</a></li>
            <li class="breadcrumb-item">Blog</li>
            <li class="breadcrumb-item active">All Posts</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            @if (!$posts)
            <div class="alert alert-danger">
                <strong>No record found</strong>
            </div>
            @else
            <div class="card-header">
              <h3 class="card-title">Display Post</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>                  
                  <tr>
                    <th>Action</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Date</th>
                    {{-- <th>Status</th> --}}
                  </tr>
                </thead>
                <tbody>
                  @foreach ($posts as $post)
                  <tr>
                    <td width="80"><a href="{{ route('blogs.edit',  [$post->id]) }}" class="btn btn-xs btn-defaul"><i class="fa fa-edit"></i></a>
                      <a href="{{ route('blogs.destroy',  [$post->id]) }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></td>
                      <td >{{ $post->title }} </td>
                      <td width="120">{{ $post->author->name }}</td>
                      <td width="150">{{ $post->Category->title }}b</td>
                    <td width="180"><abbr title="{{ $post->dateFormatted(true) }}">{{ $post->dateFormatted() }}</abbr> | {!! $post->publicationLabel() !!}</td>
                      {{-- <td width="100">{!! $post->publicationLabel() !!}</td> --}}
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <div class="float-right">
                  <small>{{ $postCount }} {{ Str::plural('post', $postCount) }}</small>
              </div>
              <div class="float-left">
                  {{ $posts->appends( Request::query() )->render() }}
              </div>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
  
  @section('script')
      <script type="text/javascript">
        $('ul.pagination').addClass('no-margin pagination-sm');
      </script>
  @endsection
  