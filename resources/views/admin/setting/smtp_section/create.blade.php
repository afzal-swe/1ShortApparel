
@extends('admin.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>SMTP Table</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                          <h3 class="card-title">SMTP Modify</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">SMTP Section</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        @csrf
                    
                                        <div class="card-body">
                    
                                            <div class="form-group">
                                                <label for="">MAIL Mailer</label>
                                                <input type="text" name="mailer" class="form-control" value="{{ old('mailer') }}" placeholder="MAIL Mailer">
                                            </div>

                                            <div class="form-group">
                                                <label for="">MAIL HOST</label>
                                                <input type="text" name="host" class="form-control" value="{{ old('host') }}" placeholder="MAIL HOST">
                                            </div>

                                            <div class="form-group">
                                                <label for="">MAIL PORT</label>
                                                <input type="text" name="port" class="form-control" value="{{ old('port') }}" placeholder="MAIL PORT">
                                            </div>

                                            <div class="form-group">
                                                <label for="">MAIL USERNAME</label>
                                                <input type="text" name="user_name" class="form-control" value="{{ old('user_name') }}" placeholder="MAIL USERNAME">
                                            </div>

                                            <div class="form-group">
                                                <label for="">MAIL PASSWORD</label>
                                                <input type="text" name="password" class="form-control" placeholder="MAIL PASSWORD">
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