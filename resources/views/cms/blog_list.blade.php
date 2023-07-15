@extends('layouts.main') 
@section('css')
{!!style_version('/frontend/custom/css/custom.css') !!}
{!!style_version('/frontend/custom/css/icofont.css') !!}
Style here 

@stop

@section('content')
<div class="page__center">
    <div class="page__title h4">Check Blogs</div>
    @if(count($model) == 0)<div class="text-center"><p>No blog found!</p></div>@endif
    <div class="catalog__list" id="blog-list">
        <!-- <div class="game blog_list">
            <div class="game__preview" style="background-image: url({{URL::asset('public/frontend/img/player-pic-3.png')}});"></div>
            <div class="game__details gamedtl_btm">
                <div class="game__status">
                    <div class="status green">Jul 15</div>
                </div>
                <div class="game__title">Legacy Twitch API v5 Shutdown Details and Timeline</div>
                <div class="author__note">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce at congue nunc, in condimentum metus. </div>
                <div class="card__title readmore mt-3"><a href="#" class="games__title">Read more <i class="icofont-rounded-right"></i></a></div>
            </div>
        </div>
        <div class="game blog_list">
            <div class="game__preview" style="background-image: url({{URL::asset('public/frontend/img/player-pic-3.png')}});"></div>
            <div class="game__details gamedtl_btm">
                <div class="game__status">
                    <div class="status green">Jul 15</div>
                </div>
                <div class="game__title">Legacy Twitch API v5 Shutdown Details and Timeline</div>
                <div class="author__note">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce at congue nunc, in condimentum metus. </div>
                <div class="card__title readmore mt-3"><a href="#" class="games__title">Read more <i class="icofont-rounded-right"></i></a></div>
            </div>
        </div>
        <div class="game blog_list">
            <div class="game__preview" style="background-image: url({{URL::asset('public/frontend/img/player-pic-3.png')}});"></div>
            <div class="game__details gamedtl_btm">
                <div class="game__status">
                    <div class="status green">Jul 15</div>
                </div>
                <div class="game__title">Legacy Twitch API v5 Shutdown Details and Timeline</div>
                <div class="author__note">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce at congue nunc, in condimentum metus. </div>
                <div class="card__title readmore mt-3"><a href="#" class="games__title">Read more <i class="icofont-rounded-right"></i></a></div>
            </div>
        </div>
        <div class="game blog_list">
            <div class="game__preview" style="background-image: url({{URL::asset('public/frontend/img/player-pic-3.png')}});"></div>
            <div class="game__details gamedtl_btm">
                <div class="game__status">
                    <div class="status green">Jul 15</div>
                </div>
                <div class="game__title">Legacy Twitch API v5 Shutdown Details and Timeline</div>
                <div class="author__note">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce at congue nunc, in condimentum metus. </div>
                <div class="card__title readmore mt-3"><a href="#" class="games__title">Read more <i class="icofont-rounded-right"></i></a></div>
            </div>
        </div>
        <div class="game blog_list">
            <div class="game__preview" style="background-image: url({{URL::asset('public/frontend/img/player-pic-3.png')}});"></div>
            <div class="game__details gamedtl_btm">
                <div class="game__status">
                    <div class="status green">Jul 15</div>
                </div>
                <div class="game__title">Legacy Twitch API v5 Shutdown Details and Timeline</div>
                <div class="author__note">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce at congue nunc, in condimentum metus. </div>
                <div class="card__title readmore mt-3"><a href="#" class="games__title">Read more <i class="icofont-rounded-right"></i></a></div>
            </div>
        </div>
        <div class="game blog_list">
            <div class="game__preview" style="background-image: url({{URL::asset('public/frontend/img/player-pic-3.png')}});"></div>
            <div class="game__details gamedtl_btm">
                <div class="game__status">
                    <div class="status green">Jul 15</div>
                </div>
                <div class="game__title">Legacy Twitch API v5 Shutdown Details and Timeline</div>
                <div class="author__note">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce at congue nunc, in condimentum metus. </div>
                <div class="card__title readmore mt-3"><a href="#" class="games__title">Read more <i class="icofont-rounded-right"></i></a></div>
            </div>
        </div>
        <div class="game blog_list">
            <div class="game__preview" style="background-image: url({{URL::asset('public/frontend/img/player-pic-3.png')}});"></div>
            <div class="game__details gamedtl_btm">
                <div class="game__status">
                    <div class="status green">Jul 15</div>
                </div>
                <div class="game__title">Legacy Twitch API v5 Shutdown Details and Timeline</div>
                <div class="author__note">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce at congue nunc, in condimentum metus. </div>
                <div class="card__title readmore mt-3"><a href="#" class="games__title">Read more <i class="icofont-rounded-right"></i></a></div>
            </div>
        </div>
        <div class="game blog_list">
            <div class="game__preview" style="background-image: url({{URL::asset('public/frontend/img/player-pic-3.png')}});"></div>
            <div class="game__details gamedtl_btm">
                <div class="game__status">
                    <div class="status green">Jul 15</div>
                </div>
                <div class="game__title">Legacy Twitch API v5 Shutdown Details and Timeline</div>
                <div class="author__note">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce at congue nunc, in condimentum metus. </div>
                <div class="card__title readmore mt-3"><a href="#" class="games__title">Read more <i class="icofont-rounded-right"></i></a></div>
            </div>
        </div>
        <div class="game blog_list">
            <div class="game__preview" style="background-image: url({{URL::asset('public/frontend/img/player-pic-3.png')}});"></div>
            <div class="game__details gamedtl_btm">
                <div class="game__status">
                    <div class="status green">Jul 15</div>
                </div>
                <div class="game__title">Legacy Twitch API v5 Shutdown Details and Timeline</div>
                <div class="author__note">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce at congue nunc, in condimentum metus. </div>
                <div class="card__title readmore mt-3"><a href="#" class="games__title">Read more <i class="icofont-rounded-right"></i></a></div>
            </div>
        </div> -->
    </div>
</div>

@stop

@section('js')
<script>

    $(function(){
        load_blogs();
    });

    $(window).scroll(function () {
    var type = $('#category-type').val();
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        load_blogs();
    }
});
</script>
@stop