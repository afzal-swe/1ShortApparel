
@extends('admin.layouts.app')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Message Table</h1>
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
                          <h3 class="card-title">Message List Here</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>phone</th>
                                    <th>Descrtption</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                
                                  @foreach ($contact as $key=>$row)
                                    <tr>
                                      <td>{{++$key}}</td>
                                      <td>{{ $row->name ?? "Null"}}</td>
                                      <td>{{ $row->email ?? "Null"}}</td>
                                      <td>{{ $row->phone ?? "Null" }}</td>
                                      <td>{{ Str::of($row->desctiption ?? "Null")->limit(30) }}</td>
                                        <td >
                                            {{-- <a href="#" class="btn btn-info btn-sm" title="Edit Data"><i class="fas fa-edit"></i></a> --}}
                                            <a href="{{ route('delete.message',$row->id) }}" id="delete" class="btn btn-danger btn-sm delete" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                  @endforeach
                               

                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                </div>
            </div>
        </div>
    </section>
  </div>

@endsection