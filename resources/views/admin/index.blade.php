@extends('admin.layout')
{{-- @section('title',  __('admin/main.edarah') ) --}}

@section('breadcrumb')
{{-- <li class="breadcrumb-item active">{{ __('admin/main.blank-page') }}</li> --}}

@endsection

@section('content')
  <!-- details -->
  <section>
    <div class="row">
      <div class="col-sm">
        <div class="card p-2 mt-1">
          <div class="information">
            <div class="information-content">
              <div class="information-title">{{ __('admin/main.new-users') }}</div>
              <div class="information-count">1600</div>
            </div>

            <div class="information-icon"> <i class="bi bi-person-fill">
              </i></div>
          </div>
        </div>
      </div>
      <div class="col-sm">
        <div class="card p-2 mt-1">
          <div class="information">
            <div class="information-content">
              <div class="information-title">{{ __('admin/main.new-orders') }} </div>
              <div class="information-count">20</div>
            </div>

            <div class="information-icon"> <i class="bi bi-bag-fill"></i></div>
          </div>
        </div>
      </div>
      <div class="col-sm">
        <div class="card p-2 mt-1">
          <div class="information">
            <div class="information-content">
              <div class="information-title t">{{ __('admin/main.this-month-earnings') }}</div>
              <div class="information-count">$30k </div>
            </div>

            <div class="information-icon"> <i class="bi bi-calendar-fill"></i></div>
          </div>
        </div>
      </div>

    </div>

  </section>
  <!--/  details -->

  <!-- charts -->

  <section>
    <div class="row">
      <div class="col-md-6" >
        <div class="card p-2 mt-1" style="height:400px !important;">
          <table class="charts-css theme-chart show-heading column show-labels
              show-data show-primary-axis data-spacing-2
              datasets-spacing-9">
            <caption class="title"> {{ __('admin/main.sales') }} </caption>
            <thead>
              <tr>
                <th scope="col"> Year </th>
                <th scope="col"> Progress </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row"> Jan </th>
                <td style="--size:0.2;"><span class="data"> $10k
                  </span></td>
              </tr>
              <tr>
                <th scope="row"> Mar </th>
                <td style="--size:0.4;"><span class="data"> $20k
                  </span></td>
              </tr>
              <tr>
                <th scope="row"> May </th>
                <td style="--size:0.6;">$30k</td>
              </tr>
              <tr>
                <th scope="row"> Jul </th>
                <td style="--size:0.8;">$40k</td>
              </tr>
              <tr>
                <th scope="row"> Sep </th>
                <td style="--size:1;">$100k</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card p-2 mt-1" style="height:400px !important;">
          <table class="charts-css theme-chart line show-heading
              show-data-on-hover show-labels show-primary-axis">
            <caption class="title"> {{ __('admin/main.orders') }} </caption>

            <tbody>
              <tr>
                <th scope="row"> Jan </th>

                <td style="--start: 0.0; --size: 0.4"> <span class="data">
                    40K </span> </td>
              </tr>
              <tr>
                <td style="--start: 0.4; --size: 0.2"> <span class="data">
                    20K </span> </td>
              </tr>
              <tr>
                <td style="--start: 0.2; --size: 0.6"> <span class="data">
                    60K </span> </td>
              </tr>
              <tr>
                <th scope="row"> Mar </th>

                <td style="--start: 0.6; --size: 0.4"> <span class="data">
                    40K </span> </td>
              </tr>
              <tr>

                <td style="--start: 0.4; --size: 0.8"> <span class="data">
                    80K </span> </td>
              </tr>
              <tr>

                <td style="--start: 0.8; --size: 0.6"> <span class="data">
                    60K </span> </td>
              </tr>
              <tr>
                <th scope="row"> Sep </th>

                <td style="--start: 0.6; --size: 1.0"> <span class="data">
                    100K </span> </td>
              </tr>
            </tbody>

          </table>
        </div>
      </div>
    </div>
  </section>
  <!--/ charts -->

@endsection


