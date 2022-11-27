@php
    $list   = \App\Models\Blog::select('*')
                ->where('download', 1)
                ->orderBy('id', 'DESC')
                ->skip(0)->take(10)
                ->get();
@endphp

<div class="container">

    <div class="fileDownloadBox">
        <h2 class="fileDownloadBox_title">
            Tải tài liệu
        </h2>
        <div class="fileDownloadBox_des">
            Tổng hợp những tài liệu văn học hữu ích
        </div>
        <div class="fileDownloadBox_main customScrollBar-x">
            <table style="font-size:0.975rem;background:#fff;">
                <thead>
                    <tr>
                        <th width="60px">STT</th>
                        <th>Tiêu đề</th>
                        <th style="min-width: 140px;">Danh mục</th>
                        <th width="120px">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $blog)
                        <tr>
                            <td class="textCenter">{{ $loop->index+1 }}</td>
                            <td><a href="{{ url('/'.$blog->pages->seo_alias_full) }}">{{ $blog->name }}</a></td>
                            <td>
                                @if(!empty($blog->category))
                                    @foreach($blog->category as $c)
                                        @if($c->infoCategory->name!=='Tìm kiếm')
                                        <div class="badgeSecondary">
                                            {{ $c->infoCategory->name }}
                                        </div>
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td class="textCenter" style="padding: 0 0.5rem;">
                                <div class="iconAction">
                                    <a href="{{ url('/'.$blog->pages->seo_alias_full) }}" class="iconAction_item">
                                        <i class="fa-solid fa-eye" style="margin-bottom: -0.5rem;"></i>
                                        <div>Xem</div>
                                    </a>
                                    <a href="{{ route('main.blog.exportPdf', ['blog_info_id' => $blog->id]) }}" class="iconAction_item">
                                        <i class="fa-solid fa-download"></i>
                                        <div>Tải</div>
                                    </a>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="viewMore">
            <a href="/tai-tai-lieu" title="Xem tất cả"><i class="fa-solid fa-arrow-down-long"></i>Xem tất cả</a>
        </div>
        {{-- <div class="fileDownloadBox_button">
            <a href="#">
                Xem tất cả
            </a>
        </div> --}}
    
    </div>
</div>