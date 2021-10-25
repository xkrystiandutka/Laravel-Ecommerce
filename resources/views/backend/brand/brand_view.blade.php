@extends('admin.admin_master')
@section('admin')

  <!-- Content Wrapper. Contains page content -->
    <div class="container-full">
      <!-- Content Header (Page header) -->

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <div class="col-8">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Brand List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>Brand En</th>
                              <th>Brand Pl</th>
                              <th>Image</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($brands as $item)
                          <tr>
                            <td>{{ $item->brand_name_en }}</td>
                            <td>{{ $item->brand_name_pl  }}</td>
                            <td><img src="{{ asset($item->brand_image) }}" style="width: 70px; height:40px;"></td>
                            <td>
                                <a href="" class="btn btn-info">Edit</a>
                                <a href="" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

          </div>
          <!-- /.col -->

{{-- --------------- Add Brand Page ---- --}}

          <div class="col-4">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Add Brand</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                    <form  action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                            <div class="form-group">
                                <h5>Brand name en</h5>
                                <div class="controls">
                                    <input type="text" name="brand_name_en" class="form-control" required="" ></div>
                            </div>
                            <div class="form-group">
                                <h5>Brand name pl</h5>
                                <div class="controls">
                                    <input type="password" name="brand_name_pl" class="form-control" required="" ></div>
                            </div>
                            <div class="form-group">
                                <h5>Brand Image</h5>
                                <div class="controls">
                                    <input type="file" name="brand_image" class="form-control" required="" ></div>
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="update">
                            </div>
                    </form>
                   </div>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->

           </div>
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->

    </div>

@endsection
