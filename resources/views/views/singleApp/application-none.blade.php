@extends('layouts.admin.header')

@section('content')
    <div class="container_s">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="sky-container">
                    <div class="apps-card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container_s">

                            <h2 style="direction: rtl; width: max-content; background: #fff; color: #444; margin: 2em auto; padding: 1em 2em; -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.13); box-shadow: 0 1px 3px rgba(0,0,0,0.13); ">ניסית לערוך רכיב שאינו קיים. אולי הוא הסיר? </h2>

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
