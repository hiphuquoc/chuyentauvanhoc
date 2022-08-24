@if(!empty($item))
<tr id="blog_{{ $item->id }}">
    <td style="width:180px;">
        <img src="{{ $item->pages['image_small'] ?? $item->pages['image'] ?? null }}?{{ time() }}" />
        @foreach($item->category as $category)
            <span class="badge" style="background:#00adef;margin-top:0.4rem;">{{ $category->infoCategory->name }}</span>
        @endforeach
    </td>
    <td style="vertical-align:top;">
        <div class="oneLine">
            <span class="tableHighLight">
                Tiêu đề Trang: (<span class="highLight_500">{{ mb_strlen($item->pages['title']) ?? null }}</span>)
            </span>
            {{ $item->pages['title'] }}
        </div>
        <div class="oneLine">
            <span class="tableHighLight">
                Mô tả Trang: (<span class="highLight_500">{{ mb_strlen($item->pages['description']) ?? null }}</span>)
            </span>
            {{ $item->pages['description'] }}
        </div>
    </td>
    <td style="vertical-align:top;">
        <div class="oneLine">
            <span class="tableHighLight">
                Tiêu đề SEO: (<span class="highLight_500">{{ mb_strlen($item->pages['seo_title']) ?? null }}</span>)
            </span>
            {{ $item->pages['seo_title'] }}
        </div>
        <div class="oneLine">
            <span class="tableHighLight">
                Mô tả SEO: (<span class="highLight_500">{{ mb_strlen($item->pages['seo_description']) ?? null }}</span>)
            </span>
            {{ $item->pages['seo_description'] ?? null }}
        </div>
        <div class="oneLine">
            <span class="tableHighLight">
                Đường dẫn tĩnh:
            </span>
            {{ $item->pages['seo_alias'] ?? null }}
        </div>
    </td>
    <td style="vertical-align:top;">
        <div class="oneLine">
            Đánh giá:
            <span class="tableHighLight">
                {{ $item->pages['rating_aggregate_star'] }} / {{ $item->pages['rating_aggregate_count'] ?? null }}
            </span>
        </div>
        <div class="oneLine">
            <i data-feather='plus'></i>
            {{ date('H:i, d/m/Y', strtotime($item->pages['created_at'])) ?? null }}
        </div>
        <div class="oneLine">
            <i data-feather='edit-2'></i>
            {{ date('H:i, d/m/Y', strtotime($item->pages['updated_at'])) ?? null }}
        </div>
    </td>
    <td style="vertical-align:top;display:flex;">
        <div class="icon-wrapper iconAction">
            <a href="{{ url($item->pages->seo_alias) ?? null }}" target="_blank">
                <i data-feather='eye'></i>
                <div>Xem</div>
            </a>
        </div>
        <div class="icon-wrapper iconAction">
            <a href="{{ route('admin.blog.view', ['id' => $item->id, 'type' => 'edit']) }}">
                <i data-feather='edit'></i>
                <div>Sửa</div>
            </a>
        </div>
        <div class="icon-wrapper iconAction">
            <a href="{{ route('admin.blog.view', ['id' => $item->id, 'type' => 'copy']) }}">
                <i data-feather='copy'></i>
                <div>Chép</div>
            </a>
        </div>
        <div class="icon-wrapper iconAction">
            <a href="#" onClick="deleteItem('{{ $item->id }}');">
                <i data-feather='x-square'></i>
                <div>Xóa</div>
            </a>
        </div>
    </td>
</tr>
@endif