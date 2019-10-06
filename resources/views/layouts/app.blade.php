<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="md-scrollbar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <?php $email = isset(session()->all()['email']) ? session()->all()['email']:'Anonymous'; ?>
    <title>{{ config('app.name', 'Laravel') }} - <?=$email?></title>
    <!-- Scripts -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/vue-material.min.css">
    <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/theme/default.css">
    <link href="{{ asset('css/page_css/main_style.css') }}" rel="stylesheet">
    <?php


    function hex2rgba($color, $opacity = false) {

        $default = 'rgb(0,0,0)';

        //Return default if no color provided
        if(empty($color))
            return $default;

        //Sanitize $color if "#" is provided
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
            return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
            if(abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
    }

    $mainStyle = '';
    $secondStyle = '';
    $navbarStyle = '';
    $navbarStyleLighter = '';
    $navbarStyleHover = '';
    $primaryStyle = '';
    $accentStyle = '';
    $primaryColor = '';
    $navbarColor = '';
    $accentStyleLight = '';
    $primaryStyleLight = '';
        if(isset(session()->all()['theme']))
        {
            $mainColor = session()->all()['theme']['mainBG']['color'];
            $secondColor = session()->all()['theme']['secondBG']['color'];
            $navbarColor = session()->all()['theme']['navbarBG']['color'];
            $primaryColor = session()->all()['theme']['primaryBG']['color'];
            $accentColor = session()->all()['theme']['accentBG']['color'];


            $secondColorTransparency = session()->all()['theme']['secondBG']['transparency'];
            $navbarColorTransparency = session()->all()['theme']['navbarBG']['transparency'];
            $primaryColorTransparency = session()->all()['theme']['primaryBG']['transparency'];
            $accentColorTransparency = session()->all()['theme']['accentBG']['transparency'];

            $mainStyle = hex2rgba($mainColor,1);
            $secondStyle = hex2rgba($secondColor,$secondColorTransparency);
            $navbarStyle = hex2rgba($navbarColor,$navbarColorTransparency);
            $navbarStyleLighter = hex2rgba($navbarColor,floatval($navbarColorTransparency)+0.3);
            $navbarStyleHover = hex2rgba($navbarColor,floatval($navbarColorTransparency)+0.1);
            $primaryStyle = hex2rgba($primaryColor,$primaryColorTransparency);
            $accentStyle = hex2rgba($accentColor,$accentColorTransparency);
            $accentStyleLight = hex2rgba($accentColor,0.2);
            $primaryStyleLight = hex2rgba($primaryColor,0.2);
        }


    ?>
    <style>
        @media only screen and (max-width: 991.98px)  {
            .li-stretch{
                width: 100%;
                text-align: center;
            }
            .navbar-collapse{
            <?=($navbarStyleHover!=='' ? "background-color:$navbarStyleHover;" : "background-color:rgba(0, 0, 0, 0.2);")?>
            }
        }
        .grey-lightest{
            <?=($mainStyle!=='' ? "background-color:$mainStyle;" : "background-color: #f1f2f6;")?>
        }
        .grey-light{
            <?=($secondStyle!=='' ? "background-color:$secondStyle;" : "background-color: #dfe4ea;")?>
        }
        .orange-stress-transparent{
            transition-timing-function: ease-out;
            transition: 0.5s;
            <?=($navbarStyleHover!=='' ? "background-color:$navbarStyleHover;" : "background-color:rgba(0, 0, 0, 0.5);")?>
        }
        .orange-stress-transparent:hover{
            transition-timing-function: ease-in;
            transition: 0.5s;
        <?=($navbarStyle!=='' ? "background-color:$navbarStyle;" : "background-color:rgba(0, 0, 0, 0.2);")?>
        }
        .md-primary{
            <?=($primaryStyle!=='' ? "background-color:$primaryStyle !important;" : "background-color:#7e57c2")?>
            color:#448aff;
        }
        .c-p{
            cursor:pointer;
            <?=($primaryColor!=='' ? "color:$primaryColor;" : "color:#448aff;")?>

        }

        .li-stretch{
            transition-timing-function: ease-out;
            transition: 0.5s;
            text-align: center !important;
            width:100% !important;
            height:100%;
        }
        .li-stretch:hover{
            transition-timing-function: ease-in;
            transition: 0.5s;
            <?=($navbarStyleLighter!=='' ? "background-color:$navbarStyleLighter;" : "background-color:rgba(0, 0, 0, 0.2);")?>
            height:100%;
        }
        .dropdown-item.active, .dropdown-item:active{
            <?=($primaryStyle!=='' ? "background-color:$primaryStyle" : "background-color:rgba(0, 0, 0, 0.2);")?> !important;
        }
        :root {
            --blue: #3490dc;
            --indigo: #6574cd;
            --purple: #9561e2;
            --pink: #f66d9b;
            --red: #e3342f;
            --orange: #f6993f;
            --yellow: #ffed4a;
            --green: #38c172;
            --teal: #4dc0b5;
            --cyan: #6cb2eb;
            --white: #fff;
            --gray: #6c757d;
            --gray-dark: #343a40;
            --primary: #3490dc;
            --secondary: #6c757d;
            --success: #38c172;
            --info: #6cb2eb;
            --warning: #ffed4a;
            --danger: #e3342f;
            --light: #f8f9fa;
            --dark: #343a40;
            --md-theme-default-primary: <?=($primaryStyle!=='' ? $primaryStyle : "#448aff")?>  !important;
            --md-theme-default-accent: <?=($accentStyle!=='' ? $accentStyle : "#ff5252")?>  !important;
            --md-theme-default-accent-on-: <?=($accentStyleLight!=='' ? $accentStyleLight : "rgba(255,82,82,0.2)")?>  !important;
            --md-theme-default-primary-on-background: <?=($primaryColor!=='' ? $primaryColor : "#448aff")?>  !important;
            --breakpoint-xs: 0;
            --breakpoint-sm: 576px;
            --breakpoint-md: 768px;
            --breakpoint-lg: 992px;
            --breakpoint-xl: 1200px;
            --font-family-sans-serif: "Nunito", sans-serif;
            --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        }

    </style>
</head>
<body>


    <div id="app" class="grey-lightest" >
        <div class="container-fluid p-0">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="{{ asset('/js/page_scripts/main_script.js') }}"></script>
</body>
</html>
