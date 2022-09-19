@if(!empty($dataMenu))
    <!-- Menu từ Database Category -->
    <div class="boxScroll hide-767">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <div class="header_menu">
                <div class="header_menu_item">
                    <a href="/"><i class="fa-solid fa-house"></i></a>
                </div>
                @foreach($dataMenu as $menuLv1)
                    @if($menuLv1->seo_alias!='tim-kiem')
                        <div class="header_menu_item">
                            <a href="/{{ $menuLv1->seo_alias_full }}">{{ $menuLv1->title }}</a>
                            @if(!empty($menuLv1->child))
                                <ul>
                                    @foreach($menuLv1->child as $menuLv2)
                                        <li>
                                            <a href="/{{ $menuLv2->seo_alias_full }}">
                                                {{ $menuLv2->title }}
                                            </a>
                                            @if(!empty($menuLv2->child))
                                                <ul>
                                                    @foreach($menuLv2->child as $menuLv3)
                                                        <li>
                                                            <a href="/{{ $menuLv3->seo_alias_full }}">
                                                                {{ $menuLv3->title }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
            <form id="formSearchDesktop" method="get" action="/tim-kiem">
                <div class="searchHeader">
                    <input type="text" name="search_name" placeholder="Tìm kiếm..." value="{{ $searchName ?? null }}" />
                    <i class="fa-solid fa-magnifying-glass noBackground" onClick="submitForm('formSearchDesktop');"></i>
                </div>
            </form>
        </div>
    </div>
@else
    <!-- Menu từ Config -->
    @php
        $dataMenu   = config('menu.header-main-menu');
    @endphp
    <div class="boxScroll hide-767">
        <div class="header_menu">
            <div class="header_menu_item">
                <a href="/"><i class="fa-solid fa-house"></i></a>
            </div>
            @foreach($dataMenu as $menuLv1)
                <div class="header_menu_item">
                    <a href="/{{ $menuLv1['url'] }}">{{ $menuLv1['name'] }}</a>
                    @if(!empty($menuLv1['child']))
                        <ul>
                            @foreach($menuLv1['child'] as $menuLv2)
                                <li>
                                    <a href="/{{ $menuLv2['url'] }}">
                                        {{ $menuLv2['name'] }}
                                    </a>
                                    @if(!empty($menuLv2['child']))
                                        <ul>
                                            @foreach($menuLv2['child'] as $menuLv3)
                                                <li>
                                                    <a href="/{{ $menuLv3['url'] }}">
                                                        {{ $menuLv3['name'] }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endif

{{-- <div class="header_action">
    <button type="button" style="width:190px;padding-left:5px;">
    <i class="fa-solid fa-pencil"></i>
    Đăng ký khóa học
    </button>
</div> --}}