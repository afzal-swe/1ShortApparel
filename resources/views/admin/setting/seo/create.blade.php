
@extends('admin.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>SEO Table</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><- Go To Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">SEO Modify</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">SEO Section</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('seo.add') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                    
                                        <div class="card-body">
                    
                                            <div class="form-group">
                                                <label for="">Author</label>
                                                <input type="text" name="meta_author" class="form-control @error('meta_author') is-invalid @enderror" value="{{ old('meta_author') }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Meta Title</label>
                                                <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title') }}">
                                                @error('meta_title')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                              </div>

                                            <div class="form-group">
                                                <label for="">Meta Keyword</label>
                                                <input type="text" name="meta_keyword" class="form-control @error('meta_keyword') is-invalid @enderror" value="{{ old('meta_keyword') }}">
                                                @error('meta_keyword')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="">Meta Description</label>
                                                <input type="text" name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" value="{{ old('meta_description') }}">
                                                 @error('meta_description')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="">Google Analytics</label>
                                                <input type="text" name="google_analytics" class="form-control @error('google_analytics') is-invalid @enderror" value="{{ old('google_analytics') }}">
                                                @error('google_analytics')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="">Google Verification</label>
                                                <input type="text" name="google_verification" class="form-control @error('google_verification') is-invalid @enderror" value="{{ old('google_verification') }}">
                                                @error('google_verification')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="">Alexa Analytics</label>
                                                <input type="text" name="alexa_analytics" class="form-control @error('alexa_analytics') is-invalid @enderror" value="{{ old('alexa_analytics') }}">
                                                @error('alexa_analytics')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                           
        
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Create</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                              </div>
                        </div>
                        <!-- /.card-body -->
                      </div>
                </div>
            </div>
        </div>
    </section>
  </div>

@endsection