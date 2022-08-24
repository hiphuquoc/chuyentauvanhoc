@if(!empty($item))
<tr>
    <td style="width:180px;">
        <img src="{{ $item->pages['image_small'] }}" />
        @foreach($item->category as $category)
            <span class="badge" style="background:#00adef;margin-top:0.4rem;">{{ $category->infoCategory->name }}</span>
        @endforeach
    </td>
    <td style="vertical-align:top;">
        <div class="oneLine">
            <span class="tableHighLight">
                Tiêu đề Trang: (<span class="highLight_500">{{ mb_strlen($item->pages['title']) }}</span>)
            </span>
            {{ $item->pages['title'] }}
        </div>
        <div class="oneLine">
            <span class="tableHighLight">
                Mô tả Trang: (<span class="highLight_500">{{ mb_strlen($item->pages['description']) }}</span>)
            </span>
            {{ $item->pages['description'] }}
        </div>
    </td>
    <td style="vertical-align:top;">
        <div class="oneLine">
            <span class="tableHighLight">
                Tiêu đề SEO: (<span class="highLight_500">{{ mb_strlen($item->pages['seo_title']) }}</span>)
            </span>
            {{ $item->pages['seo_title'] }}
        </div>
        <div class="oneLine">
            <span class="tableHighLight">
                Mô tả SEO: (<span class="highLight_500">{{ mb_strlen($item->pages['seo_description']) }}</span>)
            </span>
            {{ $item->pages['seo_description'] }}
        </div>
        <div class="oneLine">
            <span class="tableHighLight">
                Đường dẫn tĩnh:
            </span>
            {{ $item->pages['seo_alias'] }}
        </div>
    </td>
    <td style="vertical-align:top;">
        <div class="oneLine">
            Đánh giá:
            <span class="tableHighLight">
                {{ $item->pages['rating_aggregate_star'] }} / {{ $item->pages['rating_aggregate_count'] }}
            </span>
        </div>
        <div class="oneLine">
            <i data-feather='plus'></i>
            {{ date('H:i, d/m/Y', strtotime($item->pages['created_at'])) }}
        </div>
        <div class="oneLine">
            <i data-feather='edit-2'></i>
            {{ date('H:i, d/m/Y', strtotime($item->pages['updated_at'])) }}
        </div>
    </td>
    <td style="vertical-align:top;display:flex;">
        <div class="icon-wrapper iconAction">
            <a href="{{ url($item->pages->seo_alias) }}" target="_blank">
                <i data-feather='eye'></i>
                <div>Xem</div>
            </a>
        </div>
        <div class="icon-wrapper iconAction">
            <a href="{{ route('admin.blog.viewEdit', ['id' => $item->id, 'type' => 'edit']) }}">
                <i data-feather='edit'></i>
                <div>Sửa</div>
            </a>
        </div>
        <div class="icon-wrapper iconAction">
            <a href="{{ route('admin.blog.viewEdit', ['id' => $item->id, 'type' => 'copy']) }}">
                <i data-feather='copy'></i>
                <div>Chép</div>
            </a>
        </div>
        <div class="icon-wrapper iconAction">
            <a href="#">
                <i data-feather='x-square'></i>
                <div>Xóa</div>
            </a>
        </div>
    </td>
</tr>
@endif