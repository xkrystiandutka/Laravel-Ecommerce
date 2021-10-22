@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<div class="container-full">
        <!-- Main content -->
        <section class="content">

         <!-- Basic Forms -->
          <div class="box">
            <div class="box-header with-border">
              <h4 class="box-title">Admin Change Password</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col">
                    <form  action="{{ route('update.change.password') }}" method="post">
                        @csrf
                      <div class="row">
                        <div class="col-12">

                            <div class="form-group">
                                <h5>Current Password</h5>
                                <div class="controls">
                                    <input type="password" name="oldpassword" id="current_password" class="form-control" required="" ></div>
                            </div>
                            <div class="form-group">
                                <h5>New Password</h5>
                                <div class="controls">
                                    <input type="password" name="password" id="password" class="form-control" required="" ></div>
                            </div>
                            <div class="form-group">
                                <h5>Confirm Password</h5>
                                <div class="controls">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required="" ></div>
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="update">
                            </div>
                    </form>

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
</div>
<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type){
            case 'error':
                toastr.error("{{ Session::get('message') }}");
            break;
            }
    @endif
</script>

@endsection
