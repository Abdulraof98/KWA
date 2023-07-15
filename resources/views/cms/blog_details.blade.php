@extends('layouts.main') 
@section('css')
{!!style_version('/frontend/custom/css/bootstrap.css') !!}
{!!style_version('/frontend/custom/css/bootstrap-grid.min.css') !!}
{!!style_version('/frontend/custom/css/custom.css') !!}
{!!style_version('/frontend/custom/css/icofont.css') !!}


<!-- Style here -->

@stop

@section('content')
<div class="page__center">
    <div class="page__title h5">{{$model->title}}</div>
    <p></p>
    <div class="page__row w-100">
        <div class="page__col blog_dtl w-100">
            <div class="details details_big">
                <div class="details__container">
                    <div class="details__row mb-0">
                        <div class="blog-single gray-bg py-0">
                            <div class="container">
                                <div class="row align-items-start">
                                    <div class="col-lg-12 px-0 m-15px-tb">
                                        <article class="article mb-0">
                                            <div class="article-img article_mainimg">
                                                <img src="{{ (!empty($model->image)) ? URL::asset('public/uploads/admin/blog/'.$model->image) : 'https://via.placeholder.com/800x350/87CEFA/000000'}}" title="" alt="">
                                            </div>
                                            <div class="article-title">
                                                <!-- <div class="media">
                                                    <div class="media-body">
                                                        <label>By Rachel Roth</label>
                                                        <span>26 FEB 2020</span>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="article-content">
                                                <!-- <p>Aenean eleifend ante maecenas pulvinar montes lorem et pede dis dolor pretium donec dictum. Vici consequat justo enim. Venenatis eget adipiscing luctus lorem. Adipiscing veni amet luctus enim sem libero tellus viverra venenatis aliquam. Commodo natoque quam pulvinar elit.</p>
                                                <p>Eget aenean tellus venenatis. Donec odio tempus. Felis arcu pretium metus nullam quam aenean sociis quis sem neque vici libero. Venenatis nullam fringilla pretium magnis aliquam nunc vulputate integer augue ultricies cras. Eget viverra feugiat cras ut. Sit natoque montes tempus ligula eget vitae pede rhoncus maecenas consectetuer commodo condimentum aenean.</p>
                                                <h4>What are my payment options?</h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                                <blockquote>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                                    <p class="blockquote-footer">Someone famous in <cite title="Source Title">Dick Grayson</cite></p>
                                                </blockquote>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
                                                {!! $model->description !!}
                                            </div>
                                        </article>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
@stop

@section('js')

@stop