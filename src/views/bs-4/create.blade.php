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

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Add New Translation</div>

                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ url('translations/add') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class=" control-label col-md-4"> Language Name *</label>
                                <div class="col-md-5">
                                    <input name="name" type="text" id="name" class="form-control input-sm"
                                           required="" value="{{ old('name') }}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="folder" class=" control-label col-md-4"> Folder Name *</label>
                                <div class="col-md-5">
                                    <input value="{{ old('folder') }}" name="folder" type="text" id="folder"
                                           class="form-control input-sm" required/>
                                    <span class="help-block">
                                            <span class="text-info">(Please prefer country iso code as folder name!)</span>
                                        </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="author" class=" control-label col-md-4"> Author</label>
                                <div class="col-md-5">
                                    <input name="author" value="{{ old('author') }}" type="text" id="author"
                                           class="form-control input-sm" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ipt" class=" control-label col-md-4"> </label>
                                <div class="col-md-8">
                                    <button type="submit" name="submit" class="btn btn-info">Save Changes</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
