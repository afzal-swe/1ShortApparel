
@extends('admin.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users Table</h1>
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
                          <h3 class="card-title">All Users</h3>
                          
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>User Name</th>
                                    <th>Phone</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                    <th>Parmission</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                
                                  @foreach ($view_user as $key=>$row)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->user_name ?? "Null" }}</td>
                                        <td>{{ $row->phone ?? "Null" }}</td>
                                        <td>{{ $row->email }}</td>
                                        

                                       <td>
                                            @if($row->category==1) <span class="badge badge-success">category</span>@endif
                                            @if($row->product==1) <span class="badge badge-success">product</span>@endif
                                            @if($row->offer==1) <span class="badge badge-success">offer</span>@endif
                                            @if($row->order==1) <span class="badge badge-success">order</span>@endif
                                            @if($row->blog==1) <span class="badge badge-success">blog</span>@endif
                                            @if($row->pickup==1) <span class="badge badge-success">pickup</span>@endif
                                            @if($row->ticket==1) <span class="badge badge-success">ticket</span>@endif
                                            @if($row->contact==1) <span class="badge badge-success">contact</span>@endif
                                            @if($row->report==1) <span class="badge badge-success">report</span>@endif
                                            @if($row->setting==1) <span class="badge badge-success">setting</span>@endif
                                            @if($row->userrole==1) <span class="badge badge-success">userrole</span>@endif
                                        </td>
                                        
                                        <td>
                                            @if ($row->status==1)
                                                <p class="text-info">Active</p>
                                            @else
                                                <p class="text-danger">Deactive</p>
                                            @endif
                                        </td>
                                        <td>
                      	                    <a href="{{ route('user.edit',$row->id) }}" class="btn btn-info btn-sm edit" ><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('user.delete',$row->id) }}" id="delete" class="btn btn-danger btn-sm delete" title="Delete Data"><i class="fas fa-trash"></i></a>
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



<script>
  $(function () {
    //Initialize Select2 Elements
    

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  
</script>


@endsection