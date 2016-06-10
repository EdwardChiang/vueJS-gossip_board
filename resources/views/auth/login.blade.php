@extends("init")

@section("css")
    <title>login</title>
    <link href="{{url('/assets/css/general.css')}}" rel="stylesheet" type="text/css">
@endsection


@section("content")

    <br/><br/><br/><br/>
    <div id="login">
        <div class="formWrapper">
            <form action="{{url("auth/login")}}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="signin-card">
                    <div class="row">
                        <div class="col s12 m4 offset-m4">
                            <div class="card z-depth-3">
                                <div class="container">
                                    <div class="row">
                                        <div class="card-content black-text center-align">
                                            <span class="card-title">Sign in</span>
                                        </div>
                                        <form id="loginForm">
                                            <div class="input-field">
                                                <i class="material-icons prefix">account_box</i>
                                                <input type="text" id="account" name="account">
                                                <label for="account">Username</label>
                                            </div>
                                            <div class="input-field">
                                                <i class="material-icons prefix">lock</i>
                                                <input type="password" id="password" name="password">
                                                <label for="password">Password</label>
                                            </div>
                                            <div class="card-action center">
                                                <button type="submit" class="btn btn-warning">Sign in<i class="material-icons right">send</i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            <div id="signUpDiv" class="center">
                <a class="modal-trigger" href="#modal1" style="color: #039be5;">
                    <span>Sign up</span>
                </a>

                <!-- Sign up modal -->
                <div id="modal1" class="modal">
                    <div class="modal-content">
                        <h4>Sign Up</h4>
                        <div class="input-field">
                            <i class="material-icons prefix">comment</i>
                            <input type="text" id="signUpName" name="name" class="form__input">
                            <label for="Name">Name</label>
                        </div>
                        <div class="input-field">
                            <i class="material-icons prefix">account_box</i>
                            <input type="text" id="signUpAccount" name="account" class="form__input"/>
                            <label for="signUpAccount">Username</label>
                        </div>
                        <div class="input-field">
                            <i class="material-icons prefix">lock</i>
                            <input type="password" id="signUpPassword" name="password" class="form__input"/>
                            <label for="signUpPassword">Password</label>
                        </div>
                        <div class="input-field">
                            <i class="material-icons prefix">lock</i>
                            <input type="password" id="signUpConfirmPassword" name="confirm_password" class="form__input">
                            <label for="confirm_password">Confirm your password</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" id="createAccount" class=" modal-action modal-close waves-effect waves-green btn-flat" v-on:click="insertAccount">sign up<i class="material-icons right">send</i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section("js")
    <script>var STATUS = "{{$status}}";</script>
    <script src="{{url('/assets/js/login.js')}}"></script>
    <!--<script type="text/javascript" src="http://dmplus.cs.ccu.edu.tw/~s402410052//vueJS-gossip_board/assets/js/login.js"></script>-->
@endsection
