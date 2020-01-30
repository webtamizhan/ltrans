<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="LogViewer">
    <meta name="author" content="ARCANEDEV">
    <title>LogViewer - Created by ARCANEDEV</title>
    {{-- Styles --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700|Source+Sans+Pro:400,600' rel='stylesheet' type='text/css'>
    <style>
        html {
            position: relative;
            min-height: 100%;
        }

        body {
            font-size: .875rem;
            margin-bottom: 60px;
        }

        .main-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            line-height: 60px;
            background-color: #E8EAF6;
        }

        .main-footer p {
            margin-bottom: 0;
        }

        .main-footer .fa.fa-heart {
            color: #C62828;
        }

        .page-header {
            border-bottom: 1px solid #8a8a8a;
        }

        /*
         * Navbar
         */

        .navbar-brand {
            padding: .75rem 1rem;
            font-size: 1rem;
        }

        .navbar-nav .nav-link {
            padding-right: .5rem;
            padding-left: .5rem;
        }

        /*
         * Boxes
         */

        .box {
            display: block;
            padding: 0;
            min-height: 70px;
            background: #fff;
            width: 100%;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            border-radius: .25rem;
        }

        .box > .box-icon > i,
        .box .box-content .box-text,
        .box .box-content .box-number {
            color: #FFF;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        }

        .box > .box-icon {
            border-radius: 2px 0 0 2px;
            display: block;
            float: left;
            height: 70px;
            width: 70px;
            text-align: center;
            font-size: 40px;
            line-height: 70px;
            background: rgba(0, 0, 0, 0.2);
        }

        .box .box-content {
            padding: 5px 10px;
            margin-left: 70px;
        }

        .box .box-content .box-text {
            display: block;
            font-size: 1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 600;
        }

        .box .box-content .box-number {
            display: block;
        }

        .box .box-content .progress {
            background: rgba(0, 0, 0, 0.2);
            margin: 5px -10px 5px -10px;
        }

        .box .box-content .progress .progress-bar {
            background-color: #FFF;
        }

        /*
         * Log Menu
         */

        .log-menu .list-group-item.disabled {
            cursor: not-allowed;
        }

        .log-menu .list-group-item.disabled .level-name {
            color: #D1D1D1;
        }

        /*
         * Log Entry
         */

        .stack-content {
            color: #AE0E0E;
            font-family: consolas, Menlo, Courier, monospace;
            white-space: pre-line;
            font-size: .8rem;
        }

        /*
         * Colors: Badge & Infobox
         */

        .badge.badge-env,
        .badge.badge-level-all,
        .badge.badge-level-emergency,
        .badge.badge-level-alert,
        .badge.badge-level-critical,
        .badge.badge-level-error,
        .badge.badge-level-warning,
        .badge.badge-level-notice,
        .badge.badge-level-info,
        .badge.badge-level-debug,
        .badge.empty {
            color: #FFF;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        }

        .badge.badge-level-all,
        .box.level-all {
            background-color: {{ log_styler()->color('all') }};
        }

        .badge.badge-level-emergency,
        .box.level-emergency {
            background-color: {{ log_styler()->color('emergency') }};
        }

        .badge.badge-level-alert,
        .box.level-alert {
            background-color: {{ log_styler()->color('alert') }};
        }

        .badge.badge-level-critical,
        .box.level-critical {
            background-color: {{ log_styler()->color('critical') }};
        }

        .badge.badge-level-error,
        .box.level-error {
            background-color: {{ log_styler()->color('error') }};
        }

        .badge.badge-level-warning,
        .box.level-warning {
            background-color: {{ log_styler()->color('warning') }};
        }

        .badge.badge-level-notice,
        .box.level-notice {
            background-color: {{ log_styler()->color('notice') }};
        }

        .badge.badge-level-info,
        .box.level-info {
            background-color: {{ log_styler()->color('info') }};
        }

        .badge.badge-level-debug,
        .box.level-debug {
            background-color: {{ log_styler()->color('debug') }};
        }

        .badge.empty,
        .box.empty {
            background-color: {{ log_styler()->color('empty') }};
        }

        .badge.badge-env {
            background-color: #6A1B9A;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark p-0">
    <a href="{{ route('log-viewer::dashboard') }}" class="navbar-brand mr-0">
        <i class="fa fa-fw fa-book"></i> Ltrans
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ Route::is('log-viewer::dashboard') ? 'active' : '' }}">
                <a href="{{ url('/') }}" class="nav-link">
                    <i class="fa fa-dashboard"></i>Back to {{ config('app.name') }}
                </a>
            </li>
            <li class="nav-item {{ Route::is('translations') ? 'active' : '' }}">
                <a href="{{ url('translations') }}" class="nav-link">
                    <i class="fa fa-archive"></i> Ltrans
                </a>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid">
    <main role="main" class="pt-3">
        <div class="page-header mb-4">
            <h1>Add New Translation</h1>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-3">
                <div class="box">
                    <div class="box-content">
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
    </main>
</div>

{{-- Footer --}}
<footer class="main-footer">
    <div class="container-fluid">
        <p class="text-muted pull-left">
            Ltrans</span>
        </p>
        <p class="text-muted pull-right">
            Created with <i class="fa fa-heart"></i> by Prabakaran T <sup>&copy;</sup>
        </p>
    </div>
</footer>

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
