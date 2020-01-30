<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ltrans') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Ltrans') }}
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage Translations</div>

                    <div class="panel-body">
                        <a href="{{ url('translations/add') }}" class="btn btn-primary pull-right">Add New
                            Translation</a>
                        <br>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th> Language Name</th>
                                <th> Folder Name</th>
                                <th> Author</th>
                                <th> Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\Kalamsoft\Langman\Lman::langOption() as $lang)
                                <tr>
                                    <td>  {{  $lang['name'] }}   </td>
                                    <td> {{  $lang['folder'] }} </td>
                                    <td> {{  $lang['author'] }} </td>
                                    <td>
                                        @if($lang['folder'] !='en')
                                            <a href="{{ url('translations?edit='.$lang['folder'])}} "
                                               class="btn btn-sm btn-primary">Edit</a>
                                            <a href="{{ url('translations/remove/'.$lang['folder'])}} "
                                               class="btn btn-sm btn-danger">Delete </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
