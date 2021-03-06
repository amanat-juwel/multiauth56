@extends('admin.layouts.template')

@section('template')
<!-- Content Header -->
<section class="content-header">
    <h1>
        DATABASE BACKUP
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
        <li class="active">Database Backup</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
                @if(Session::has('success'))
                <div class="alert alert-success" id="success">
                    {{Session::get('success')}} @php Session::forget('success'); @endphp
                </div>
                @endif @if(Session::has('update'))
                <div class="alert alert-warning" id="update">
                    {{Session::get('update')}} @php Session::forget('update'); @endphp
                </div>
                @endif @if(Session::has('delete'))
                <div class="alert alert-danger" id="delete">
                    {{Session::get('delete')}} @php Session::forget('delete'); @endphp
                </div>
                @endif
           <div class="panel panel-primary">
              <div class="panel-heading">
               DB-BACKUP
               <a href="{{url('admin/database-backup/create')}}" class="btn btn-default btn-xs pull-right"><i class="fa fa-database"></i> Export Database</a>
              </div>
              <div class="panel-body">
                <div class="">
                        <table class="table-bordered" id="purchase_details" width="100%">
                            <thead>
                                <tr>
                                    <th height="25">Srl</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($directories)) @foreach ($directories as $key=>$file)
                                <tr>
                                    <td height="25">{{ ++$key }}</td>
                                    <td>{{ $file }}</td>
                                    <td>
                                        @php 
                                            date_default_timezone_set('Asia/Dhaka');
                                            echo date("Y-m-d", filectime('storage/app/public/'.$file));
                                         @endphp
                                    </td>
                                    <td>
                                        @php 
                                           date_default_timezone_set('Asia/Dhaka');
                                           echo date("h:i a", filectime('storage/app/public/'.$file));
                                         @endphp
                                    </td>
                                    <td>
                                        <div style="display:flex;">
                                       <a class="btn btn-success btn-xs" href="{{asset('storage/app/public/'.$file)}}"><i class="fa fa-download"></i>
                                        Download </a>
                                       &nbsp;&nbsp;&nbsp;
                                        <form action="{{url('admin/database-backup/delete')}}" method="post">
                                            {{ method_field('DELETE') }} {{ csrf_field() }}
                                            <input type="hidden" name="file" value="{{$file}}" />
                                            <button class="delete btn btn-danger btn-xs"  onclick="return confirm('Are you sure you want to delete this item?');"  >
                                                <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                            </button>
                                        </form>
                                       
                                    </div>

                                    </td>
                                </tr>
                                @endforeach @endif
                            </tbody>
                        </table>
                    </div>

              </div>
            </div>
        </div>
    </div> 
</section>
<!-- End Main Content -->
@endsection