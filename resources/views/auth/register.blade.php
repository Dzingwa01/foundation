
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Foundation Mutual Society - You are not alone</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="register-form" style=" margin:auto;
        width: 400px;
        margin-top:5%;">
            <form class="col s12 card" method="POST" action="/register">
                @csrf
                <div class="center">
                    <a href="/">  <img style="width: 50%" src="/images/foundation-logo.png"/></a>
                </div>
                <div>
                    <h5 class="center-align" style="color:#1B1D98!important;font-weight: bolder;">Register</h5>
                </div>
                {{--<div class="input-field col s12">--}}
                    {{--<select name="role" required>--}}
                        {{--<option value="" disabled selected>Select Account Type</option>--}}
                        {{--<option value="incubatee">Incubatee</option>--}}
                        {{--<option value="partner">Partner</option>--}}
                       {{----}}
                    {{--</select>--}}
                    {{--<label>Account Type</label>--}}
                {{--</div>--}}

                <div class="row" style="padding-left: 1em;padding-right: 1em;">
                    <div class="input-field col s12">
                        <input  name="email" id="email" required type="email" class="validate">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="row" style=";padding-left: 1em;padding-right: 1em;">
                    <div class="input-field col s12">
                        <input required  name="name" id="name" type="text" class="validate">
                        <label for="name">Name</label>
                    </div>
                </div>
                <div class="row" style="padding-left: 1em;padding-right: 1em;">
                    <div class="input-field col s12">
                        <input required  name="surname" id="surname" type="text" class="validate">
                        <label for="surname">Surname</label>
                    </div>
                </div>
                <div class="row" style="padding-left: 1em;padding-right: 1em;">
                    <div class="input-field col s12">
                        <input required  name="contact_number" id="contact_number" type="text" class="validate">
                        <label for="contact_number">Phone Number</label>
                    </div>
                </div>
                <div class="row" style="padding-left: 1em;padding-right: 1em;">
                    <div class="input-field col s12">
                        <input required  name="password" id="password" type="password" class="validate">
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="row" style="padding-left: 1em;padding-right: 1em;">
                    <div class="input-field col s12">
                        <input required  name="password-confirm" id="password-confirm" type="password" class="validate">
                        <label for="password-confirm">Repeat Password</label>
                    </div>
                </div>

                <div class="row" style="padding-left: 1em;padding-right: 1em;">
                    <button class="btn right" type="submit" style="background-color: #B68121!important;">Register</button>
                </div>
                <div class="row" style="padding-left: 1em;padding-right: 1em;;">
                    <a class="right" href="login" style="color:#1B1D98!important;font-weight: bolder;">Have an account? Login Now</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!--JavaScript at end of body for optimized loading-->
{{--<script type="text/javascript" src="js/materialize.min.js"></script>--}}
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    $(document).ready(function(){
        $('select').formSelect();
    });
</script>
</body>
</html>