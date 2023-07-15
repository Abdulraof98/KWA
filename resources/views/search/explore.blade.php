@extends('layouts.main') 
@section('css')
@stop

@section('content')
<section class="explore-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="explore-cntlr">
                    <div class="explore-filters-wrap">
                        <h2 class="explore-filters-title fl-h4">Filters <span class="close-filter"><i class="far fa-times-circle"></i></span></h2>
                        <div class="explore-filters-wrap-in">
                            <div class="explore-filters">
                            <div class="explore-filters-module-wrap">
                                <div class="explore-filters-module-cntlr explr-fltr-catgory-mdul-cntlr">
                                <div class="explr-fltr-mdul-hedding">
                                    <h3 class="explr-fltr-mdul-title fl-h5">Category</h3>
                                    <i class="fas fa-swatchbook"></i>
                                </div>
                                <div class="explore-filters-module">
                                    <ul class="reset-list">
                                    <li class="active">
                                        <div class="explr-fltr-mdul-item">
                                        <label for="explr-fltr-mdul-item-all">All Categories</label>
                                        <input id="explr-fltr-mdul-item-all" type="checkbox">
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <label for="explr-fltr-mdul-item-home">Home</label>
                                        <input id="explr-fltr-mdul-item-home" type="checkbox">
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <label for="explr-fltr-mdul-item-lifestyle">Lifestyle</label>
                                        <input id="explr-fltr-mdul-item-lifestyle" type="checkbox">
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <label for="explr-fltr-mdul-item-events">Events</label>
                                        <input id="explr-fltr-mdul-item-events" type="checkbox">
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <label for="explr-fltr-mdul-item-Business">Business</label>
                                        <input id="explr-fltr-mdul-item-Business" type="checkbox">
                                        </div>
                                    </li>
                                    </ul>
                                </div>
                                </div>
                                <div class="explore-filters-module-cntlr explr-fltr-reviews-mdul-cntlr">
                                <div class="explr-fltr-mdul-hedding">
                                    <h3 class="explr-fltr-mdul-title fl-h5">Reviews</h3>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="explore-filters-module">
                                    <ul class="reset-list">
                                    <li class="active">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="filter-review-5" type="radio">
                                        <label for="filter-review-5">
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span>& Up</span>
                                        </label>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="filter-review-4" type="radio">
                                        <label for="filter-review-4">
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span>& Up</span>
                                        </label>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="filter-review-3" type="radio">
                                        <label for="filter-review-3">
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span>& Up</span>
                                        </label>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="filter-review-2" type="radio">
                                        <label for="filter-review-2">
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span>& Up</span>
                                        </label>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="filter-review-1" type="radio">
                                        <label for="filter-review-1">
                                            <span><i class="fas fa-star"></i></span>
                                            <span>& Up</span>
                                        </label>
                                        </div>
                                    </li>
                                    </ul>
                                </div>
                                </div>
                                <div class="explore-filters-module-cntlr explr-fltr-hourly-rate-mdul-cntlr">
                                <div class="explr-fltr-mdul-hedding">
                                    <h3 class="explr-fltr-mdul-title fl-h5">Hourly Rate</h3>
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <div class="explore-filters-module">
                                    <ul class="reset-list">
                                    <li>
                                        <div class="explr-fltr-mdul-item">
                                        <input id="hourly-rate-any" type="radio">
                                        <label for="hourly-rate-any">Any Hourly Rate</label>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="hourly-rate-10" type="radio" checked>
                                        <label for="hourly-rate-10">Up To £10</label>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="hourly-rate-10-20" type="radio">
                                        <label for="hourly-rate-10-20">£10 To £20</label>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="hourly-rate-20-30" type="radio">
                                        <label for="hourly-rate-20-30">£20 To £30</label>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="hourly-rate-30-50" type="radio">
                                        <label for="hourly-rate-30-50">£30 To £50</label>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="hourly-rate-50" type="radio">
                                        <label for="hourly-rate-50">£50 & Above</label>
                                        </div>
                                    </li>
                                    </ul>
                                </div>
                                </div>
                                <div class="explore-filters-module-cntlr explr-fltr-expertise-mdul-cntlr">
                                <div class="explr-fltr-mdul-hedding">
                                    <h3 class="explr-fltr-mdul-title fl-h5">Expertise</h3>
                                    <i class="fas fa-user-astronaut"></i>
                                </div>
                                <div class="explore-filters-module expertise-filters-module">
                                    <ul class="reset-list">
                                    <li class="active">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="expertise-any" type="radio">
                                        <label for="expertise-any">Any Expertise</label>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="expertise-Plumbing" type="radio">
                                        <label for="expertise-Plumbing">Plumbing</label>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="expertise-Painting" type="radio">
                                        <label for="expertise-Painting">Painting</label>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="expertise-Flat-packs" type="radio">
                                        <label for="expertise-Flat-packs">Flat-packs</label>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="expertise-Clearance" type="radio">
                                        <label for="expertise-Clearance">Clearance</label>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="expertise-Gardening" type="radio">
                                        <label for="expertise-Gardening">Gardening</label>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="expertise-Flat-packs" type="radio">
                                        <label for="expertise-Flat-packs">Flat-packs</label>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="expertise-Clearance" type="radio">
                                        <label for="expertise-Clearance">Clearance</label>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="explr-fltr-mdul-item">
                                        <input id="expertise-Gardening" type="radio">
                                        <label for="expertise-Gardening">Gardening</label>
                                        </div>
                                    </li>
                                    </ul>
                                </div>
                                <div class="explore-filter-more">
                                    
                                </div>
                                <div class="explore-filter-less">- less</div>
                                </div>
                            </div>
                            <div class="explore-reset-filters">
                                <a href="#">Reset Filters</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="explore-content-cntlr">
                        <div class="explore-content">
                            <div class="explr-cntnt-hdr">
                                <div class="explr-cntnt-search-cntlr">
                                    <form action="">
                                    <div class="explr-cntnt-search">
                                        <div class="explr-cntnt-search-col explr-cntnt-search-col-01">
                                        <input type="text"name="" placeholder="Handyman">
                                        </div>
                                        <div class="explr-cntnt-search-col explr-cntnt-search-col-02">
                                        <input type="text" name="" placeholder="EH1 2NG">
                                        <span><i class="fas fa-map-marker"></i></span>
                                        </div>
                                    </div>
                                    <div class="explr-cntnt-submit">
                                        <input type="submit" name="" value="Search">
                                    </div>
                                    </form>
                                </div>
                                <div class="explr-cntnt-srch-result-sortby-cntlr">
                                    <div class="explr-cntnt-srch-result">
                                        <p><strong>6 Results</strong> in Edinburgh, Scotland</p>
                                    </div>
                                    <div class="explr-cntnt-sortby-cntlr">
                                        <div class="sorting-menu">
                                            <span>Sort by </span>
                                            <div class="explr-cntnt-sortby select-2-sortby">
                                            <select class="select-2-cntlr">
                                                <option selected>Featured</option>
                                                <option value="1">sort by 1</option>
                                                <option value="1">sort by 2</option>
                                                <option value="1">sort by 3</option>
                                                <option value="1">sort by 4</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="filter-menu">
                                            <span class="fm-label">Filter</span>
                                            <span class="fm-icons"><i></i><i></i><i></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="explr-company-items-cntlr">
                                @foreach($pros as $p)
                                <div class="explr-company-item">
                                    <div class="company-item-lft">
                                        <div class="company-item-img">
                                            <img src="{{ (!empty($p->profile_picture) ) ? URL::asset('public/uploads/frontend/profile_picture/original/'.$p->profile_picture) : URL::asset('public/frontend/images/profile.png') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="company-item-rgt">
                                        <div class="company-item-top">
                                            <div class="company-item-top-desc">
                                                <h3 class="company-item-desc-title fl-h5"><a href="#">{{$p->name}}</a></h3>
                                                <div class="company-item-top-details">
                                                    <ul class="reset-list">
                                                        <li>
                                                            <div class="company-item-top-dtls-col">
                                                            <span class="company-item-top-dtls-info-title">Handyman
                                                                <i class="fas fa-toolbox"></i>
                                                            </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="company-item-top-dtls-col">
                                                            <span class="company-item-top-dtls-info-title company-item-top-dtls-info-title-2">{{$p->zipcode}}
                                                                <i class="fas fa-map-marker"></i>
                                                            </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="company-item-top-dtls-col company-item-top-dtls-col-rating">
                                                            <span><i class="fas fa-star"></i> 5.4</span>
                                                            <span class="company-item-top-rating-count">(11)</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="company-item-desc">
                                                    <p>{{$p->bio}}</p>
                                                </div>
                                            </div>
                                            <div class="company-item-top-contact">
                                                <div class="company-item-cntct-col company-item-cntct-quote">
                                                    <a href="#">
                                                    <span>Get a Quote</span>
                                                    <i class="fas fa-tag"></i>
                                                    </a>
                                                </div>
                                                <div class="company-item-cntct-col company-item-cntct-msg">
                                                    <a href="mail:">
                                                    <span>Message</span>
                                                    <i class="fas fa-comment"></i>
                                                    </a>
                                                </div>
                                                <div class="company-item-cntct-col company-item-cntct-tel">
                                                    <a href="tel:">
                                                    <span>Phone</span>
                                                    <i class="fas fa-phone"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="company-item-tag-cntlr">
                                            <div class="company-item-tag companyItemTagSlider">
                                                @if(!empty($p->skills))
                                                @php $skills = $tag->getName($p->skills); @endphp
                                                @foreach($skills as $s)
                                                <div class="company-item-tag-slide-cntlr">
                                                    <div class="company-item-tag-slide">
                                                        <span class="mHc">{{$s}}</span>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="fl-pagination-cntlr">
                                    <ul class="clear-fix page-numbers">
                                        @if ($pros->lastPage() > 1)
                                        <li>
                                            <a class="prev page-numbers {{ ($pros->currentPage() == 1) ? ' d-none' : '' }}" href="{{ $pros->url($pros->currentPage()-1) }}">
                                            <i class="fas fa-chevron-left"></i>
                                            </a>
                                        </li>
                                        @for ($i = 1; $i <= $pros->asltPage(); $i++)
                                        <li>
                                            <a href="{{ $pros->url($i) }}">
                                                <span aria-current="page" class="page-numbers {{ ($pros->currentPage() == $i) ? ' current' : '' }}">{{$i}}</span>
                                            </a>
                                        </li>
                                        @endfor
                                        <li>
                                            <a class="next page-numbers {{ ($pros->currentPage() == $pros->lastPage()) ? ' d-none' : '' }}" href="{{ $pros->url($pros->currentPage()+1) }}">
                                            <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('js')

@stop