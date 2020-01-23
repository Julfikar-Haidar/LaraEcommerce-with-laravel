@extends('frontend.layouts.master')

@section('content')

  <!-- Start Sidebar + Content -->
  <div class='container margin-top-20'>
    <div class="row">
      <div class="col-md-4">

        @include('frontend.partials.sidebar')

      </div>

      <div class="col-md-8">
        <div class="widget">
          @if (count($products)>0)
          <h3> Searched Products For - <span class="badge badge-primary">{{ $search }}</span></h3>
           @else
          <h2 class="m-5 text-center"> No result found</h2>
          @endif
          @include('frontend.pages.product.partials.all_products')
        </div>
        <div class="widget">

        </div>
      </div>


    </div>
  </div>

  <!-- End Sidebar + Content -->
@endsection
