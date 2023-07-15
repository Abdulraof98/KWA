@extends('layouts.main') 
@section('css')
{!!style_version('/frontend/custom/css/bootstrap.css') !!}
{!!style_version('/frontend/custom/css/bootstrap-grid.min.css') !!}
{!!style_version('/frontend/custom/css/bootstrap-select.css') !!}
{!!style_version('/frontend/custom/css/icofont.css') !!}
{!!style_version('/frontend/custom/css/owl.carousel.min.css') !!}
{!!style_version('/frontend/custom/css/custom.css') !!}

<!-- Style here -->

@stop

@section('content')
<div class="page__center">
    <!-- <div class="page__title h4">Privacy policy</div> -->
    <div class="page__title h4 text-center">{{$model->page_name}}</div>
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
                                            <div class="article-content">
                                                <!-- <p>Aenean eleifend ante maecenas pulvinar montes lorem et pede dis dolor pretium donec dictum. Vici consequat justo enim. Venenatis eget adipiscing luctus lorem. Adipiscing veni amet luctus enim sem libero tellus viverra venenatis aliquam. Commodo natoque quam pulvinar elit.</p>
                                                <p>Eget aenean tellus venenatis. Donec odio tempus. Felis arcu pretium metus nullam quam aenean sociis quis sem neque vici libero. Venenatis nullam fringilla pretium magnis aliquam nunc vulputate integer augue ultricies cras. Eget viverra feugiat cras ut. Sit natoque montes tempus ligula eget vitae pede rhoncus maecenas consectetuer commodo condimentum aenean.</p>
                                                <h2 class="h6">Heading</h2>
                                                <p>Eget aenean tellus venenatis. Donec odio tempus. Felis arcu pretium metus nullam quam aenean sociis quis sem neque vici libero. Venenatis nullam fringilla pretium magnis aliquam nunc vulputate integer augue ultricies cras. Eget viverra feugiat cras ut. Sit natoque montes tempus ligula eget vitae pede rhoncus maecenas consectetuer commodo condimentum aenean.</p>
                                                 <p>Eget aenean tellus venenatis. Donec odio tempus. Felis arcu pretium metus nullam quam aenean sociis quis sem neque vici libero. Venenatis nullam fringilla pretium magnis aliquam nunc vulputate integer augue ultricies cras. Eget viverra feugiat cras ut. Sit natoque montes tempus ligula eget vitae pede rhoncus maecenas consectetuer commodo condimentum aenean.</p>
                                                  <p>Eget aenean tellus venenatis. Donec odio tempus. Felis arcu pretium metus nullam quam aenean sociis quis sem neque vici libero. Venenatis nullam fringilla pretium magnis aliquam nunc vulputate integer augue ultricies cras. Eget viverra feugiat cras ut. Sit natoque montes tempus ligula eget vitae pede rhoncus maecenas consectetuer commodo condimentum aenean.</p>
                                                   <p>Eget aenean tellus venenatis. Donec odio tempus. Felis arcu pretium metus nullam quam aenean sociis quis sem neque vici libero. Venenatis nullam fringilla pretium magnis aliquam nunc vulputate integer augue ultricies cras. Eget viverra feugiat cras ut. Sit natoque montes tempus ligula eget vitae pede rhoncus maecenas consectetuer commodo condimentum aenean.</p>
                                                    <p>Eget aenean tellus venenatis. Donec odio tempus. Felis arcu pretium metus nullam quam aenean sociis quis sem neque vici libero. Venenatis nullam fringilla pretium magnis aliquam nunc vulputate integer augue ultricies cras. Eget viverra feugiat cras ut. Sit natoque montes tempus ligula eget vitae pede rhoncus maecenas consectetuer commodo condimentum aenean.</p> -->
                                                {!! $model->content_body !!}
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