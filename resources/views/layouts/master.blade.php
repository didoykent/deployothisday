<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <meta id="token" name="token" value="{{ csrf_token() }}">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


      <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
<link rel="stylesheet" href = "{{URL::to('css/main.css')}}" >





@yield('styles')
  </head>
  <body>






<div id="riv-vue">

@include('part/header')

      @yield('content')









</div>

    <script
      src="https://code.jquery.com/jquery-3.1.1.min.js"
      integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.3/vue-resource.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>


   <script type="text/javascript" src="/js/riv.js"></script>








@yield('scripts')

<script src="https://use.fontawesome.com/9a4143e1c6.js"></script>
<script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>

<div id="footer">
  <div class="container">
    <div class="col-sm-4">

            <img src="http://200.27.156.170/ean_default/img/cocha/RapidSSL_SEAL-90x50.gif">
          </div>
          <div class="col-sm-4 text-center" style="color:#efefef;">
          	Copyright © 2017 Rivecowe. All Rights Reserved
  			El Bosque Norte 0430, Las Condes, Santiago - Chile
          </div>
          <div class="col-sm-4 text-right">
          	<span class="fa-stack fa-lg">
                <i class="fa fa-circle text-primary fa-stack-2x"></i>
                <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
              </span>
            <span class="fa-stack fa-lg">
                <i class="fa fa-circle text-info fa-stack-2x"></i>
                <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
              </span>
            <span class="fa-stack fa-lg">
                <i class="fa fa-circle text-danger fa-stack-2x"></i>
                <i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
              </span>
          </div>
        </div>
  </div>
</div>




  </body>
</html>
