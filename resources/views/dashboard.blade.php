@extends('layouts.backend.master')
@section('content')
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

@include('layouts.backend.overview') 

@if(Auth::user()->role == 2)
<!--Chart-box-->    
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
          <h5>Site Analytics</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span9">
              <div class="chart"></div>
            </div>
            <div class="span3">
              <ul class="site-stats">
                <li class="bg_lh"><i class="icon-user"></i> <strong>{{ $users->count() }}</strong> <small>Total Users</small></li>
                <li class="bg_lh"><i class="icon-plus"></i> <strong>{{ $new_users->count() }}</strong> <small>New Users </small></li>
                <li class="bg_lh"><i class="icon-tag"></i> <strong>{{ $orders->count() }}</strong> <small>Total Orders</small></li>
                <li class="bg_lh"><i class="icon-repeat"></i> <strong>{{ $pending_orders->count() }}</strong> <small>Pending Orders</small></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
<!--End-Chart-box--> 
@endif
    <hr/>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="icon-chevron-down"></i></span>
            <h5>Latest Posts</h5>
          </div>
          <div class="widget-content nopadding collapse in" id="collapseG2">
            <ul class="recent-posts">
              @if($posts)
              @foreach($posts as $post)
              <li>
                <div class="user-thumb"> <img width="40" height="40" alt="User" src="/uploads/post_images/{{ $post->featured_image }}"> </div>
                <div class="article-post"> <span class="user-info"> By: {{ $post->author }} / Date: {{ date('d M Y',strtotime($post->created_at)) }} / Time: {{ date('g:i A',strtotime($post->created_at)) }}</span>
                  <p><a href="#">{!! illuminate\Support\Str::words($post->body, 50, '...') !!}</a> </p>
                </div>
              </li>
              @endforeach
              @endif
              
                <a href="{{ route('blog') }}" class="btn btn-warning btn-mini">View All</a>
              </li>
            </ul>
          </div>
        </div>
        
        
      </div>

    </div>
  </div>
</div>

<!--end-main-container-part-->

@endsection