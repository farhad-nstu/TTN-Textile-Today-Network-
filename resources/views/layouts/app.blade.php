<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- <meta property="og:url" :content="'http://ttnweb.test/event-details/'+eventDetails.id" />
    <meta property="og:type" content="Event" />
    <meta property="og:title" :content= eventDetails.title />
    <meta property="og:description" :content= eventDetails.details />
    <meta property="og:image" :content="'http://ttnweb.test/storage/uploads/'+userData.id+'/Events/'+eventDetails.banner"/>
    <meta property="og:image:width" content="100%" />
    <meta property="og:image:height" content="250px" />
    <meta property="og:site_name" content="TTN"/> -->

    <title>Textile Today Network</title>

    <script>
        var base_url = '{{ URL::to('/')}}';
    </script>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" type="text/css">  

    <style>
    .req:after {
        content:"   \2731";
        position: absolute;
        color:red;
        font-size: 10px;
    }
    </style>
</head>

<body>
    <div id="app">
        <div id="wrapper">
            <app></app>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- <script src="{{ asset('lib/slick/slick.min.js') }}"></script>-->   
    <!-- <script src="{{ asset('js/script.js') }}"></script> -->

    <script>
    $(".alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert").alert('close');
    });
    </script>
</body>
</html>