@extends('admin.template.main');

@section('title')
POSTS

 
@endsection
@section('cssblog')
<style>
        .page-blog-posts-item {
          padding-top: 10px;
        }
    
        .page-blog-posts-item .panel-body {
          padding-left: 30px;
          padding-right: 30px;
        }
    
        .page-blog-posts-content {
          font-size: 18px;
          font-family: Georgia,Cambria,"Times New Roman",Times,serif;
          line-height: 1.7;
        }
    
        .page-blog-posts-image {
          text-align: center;
          margin-top: 20px;
        }
    
        .page-blog-posts-image img {
          max-width: 100%;
        }
      </style>
      <!-- / Custom styling -->
@endsection


@section('contect')
 <!-- Custom styling -->
 
  <!-- Post -->
@foreach ( $articulos as  $articulo)
    

  <div class="panel page-blog-posts-item">
        <div class="panel-body p-b-0">
          <h2 class="font-weight-bold text-default m-a-0"><a href="pages-blog-post.html">{{$articulo->titulo}}</a></h2>
          <div class="m-t-1"><span class="text-muted">by</span> <a href="#">{{$articulo->user->name}}</a><span class="text-muted">&nbsp;&nbsp;·&nbsp;&nbsp;{{$articulo->created_at}}</span></div>
        </div>
  
        <div class="page-blog-posts-image">
          <img src="assets/demo/blog/1.jpg" alt="">
        </div>
  
        <div class="page-blog-posts-content panel-body">
        
                {{$articulo->contenido}}
         
        </div>
  
        <div class="panel-body p-y-0">
          <a href="#">Read more...</a>
        </div>
  
        <div class="panel-body clearfix">
          <div class="pull-md-left">
                @foreach ($articulo->tags as  $tag)
            <a href="#" class="label label-outline"> {{$tag->name}}</a>
            @endforeach
          </div>
  
          <!-- Spacing -->
          <div class="m-t-1"></div>
  
          <div class="pull-md-right text-muted">
            <a href="#"><i class="fa fa-heart-o"></i> 45</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#"><i class="fa fa-comment-o"></i> 7</a>
          </div>
        </div>
      </div>
      @endforeach
      <!-- / Post -->
  
   
  
@endsection
 
     