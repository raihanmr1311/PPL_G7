@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Data {!! link_to_asset(url, title = null, attributes = [], secure = null) !!}</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a href="" class="btn btn-primary"> <i class="fa fa-plus"></i> Buat Data Baru</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th>Task Name</th>
                      <th>Progress</th>
                      <th>Members</th>
                      <th>Due Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        1
                      </td>
                      <td>Create a mobile app</td>
                      <td class="align-middle">
                        <div class="progress" data-height="4" data-toggle="tooltip" title=""
                          data-original-title="100%" style="height: 4px;">
                          <div class="progress-bar bg-success" data-width="100%" style="width: 100%;"></div>
                        </div>
                      </td>
                      <td>
                        <img alt="image" src="../assets/img/avatar/avatar-5.png" class="rounded-circle" width="35"
                          data-toggle="tooltip" title="" data-original-title="Wildan Ahdian">
                      </td>
                      <td>2018-01-20</td>
                      <td>
                        <div class="badge badge-success">Completed</div>
                      </td>
                      <td><a href="#" class="btn btn-secondary">Detail</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('javascript')
  <script>
    $("#table-1").dataTable();
  </script>
@endpush
