<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="resource/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="resource/css/startpage/startpage.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">

    <title>MathJunkie</title>
</head>

<body>

<header>
    <div id="headline">
        <br>
        <h1 class="center-align shadow-text">MathJunkie</h1>
        <h5 class="center-align shadow-text">Who said Math has to be difficult and ugly?</h5>
    </div>

    <nav>
        <div class="nav-wrapper">
            <img src="resource/images/Icon.png" class="brand-logo center" alt="Logo"/>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="sass.html">Log In</a></li>
            </ul>
            <ul id="tutorial" class="left hide-on-med-and-down">
                <li><a href="tutorial.html">Tutorial</a></li>
            </ul>
        </div>
    </nav>
</header>

<main class="row">
    <div id="sidebar" style="padding-top:100px;"  class="col s2 blue lighten-3 valign"><br/></div>
    <div id="wrapper" class="col s10 row blue lighten-4">
        <div id="content" class="col s10 row">
            <div id="input">
                <div class="input-field">
                    <input name="data" id="first_name2" type="text" class="validate">
                    <label class="active" for="first_name2">Please type in your parameters</label>
                </div>
            </div>
            <div id="output" name="output">OUTPUT</div>
        </div>
    </div>

</main>
<footer>
    <div class="footer-copyright cyan">
        <div class="container" >
            <p>© 2015 MathJunkie</p>
        </div>
    </div>
</footer>


<script type="text/javascript" src="resource/js/jquery.min.js"></script>
<script type="text/javascript" src="resource/js/materialize.min.js"></script>



</body>
</html>