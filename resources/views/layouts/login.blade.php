<!DOCTYPE html>
<html>
<head>

@include('partial._header')
<script type="text/javascript">
    window.onload = function()
    {
      // fix for windows 8
      if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
        document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="pages/css/windows.chrome.fix.css" />'
    }
    </script>
</head>
<body class="fixed-header ">
 @yield('content')	
    @include('partial._script')   

<script>
    $(function()
    {
      $('#form-login').validate()
    })
    </script>
 </body>


</html>    