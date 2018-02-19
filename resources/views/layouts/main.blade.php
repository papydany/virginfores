<!DOCTYPE html>
<html>
<head>
@include('partial._header')
</head>
<style type="text/css">
	.table tbody tr td {
       padding: 5px !important;
    
}

</style>
<body class="fixed-header dashboard">  
	
 <nav class="page-sidebar" data-pages="sidebar">

@include('partial._navigation')

</nav>   	
 <div class="page-container ">

<div class="header ">
@include('partial._fixedheader') 
</div>
<div class="page-content-wrapper ">
<div class="content ">

 @include('partial._message') 
 @yield('content')
 
</div>
</div>
 @include('partial._footer')
</div>

    
  

    @include('partial._script')   
 @yield('script')
 </body>


</html>             