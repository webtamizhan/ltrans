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
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    {!!  \Kalamsoft\Langman\Lman::TranslationSwitch() !!}
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
                        <ul class="nav nav-tabs">
                            @foreach($files as $f)
                                <li @if($file == $f) class="active" @endif >
                                    <a href="{{ url('translations?edit='.$lang.'&file='.$f)}}">{{ $f }} </a>
                                </li>
                            @endforeach
                        </ul>
                        <form class="form-horizontal" action="{{ url('translations/save') }}" method="POST">
                            {{ csrf_field() }}
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th> Phrase</th>
                                    <th> Translation</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($stringLang as $key => $val) :
                                if(! is_array($val))
                                {
                                ?>
                                <tr>
                                    <td><?php echo $key;?></td>
                                    <td><input type="text" name="<?php echo $key;?>" value="<?php echo $val;?>"
                                               class="form-control"/>
                                    </td>
                                </tr>
                                <?php
                                } else {
                                foreach($val as $k=>$v)
                                { ?>
                                <tr>
                                    <td><?php echo $key . ' - ' . $k;?></td>
                                    <td><input type="text" name="<?php echo $key;?>[<?php echo $k;?>]"
                                               value="<?php echo $v;?>" class="form-control"/>
                                    </td>
                                </tr>
                                <?php }
                                }
                                endforeach; ?>
                                </tbody>

                            </table>
                            <input type="hidden" name="lang" value="{{ $lang }}"/>
                            <input type="hidden" name="file" value="{{ $file }}"/>
                            <button type="submit" class="btn btn-info"> Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
