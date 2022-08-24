@if(!empty($item))
@php
    $no = $no ?? 0;
@endphp
<tr id="category_{{ $item->id }}">
    <td style="width:60px;font-weight:700;">
        {{ $no }}
    </td>
    <td style="width:200px;text-align:right;">
        <img src="{{ $item->image_small }}?{{ time() }}" />
    </td>
    <td style="vertical-align:top;">
        <div class="oneLine">
            <span class="tableHighLight">
                Tiêu đề Trang: (<span class="highLight_500">{{ mb_strlen($item->title) }}</span>)
            </span>
            {{ $item->title }}
        </div>
        <div class="oneLine">
            <span class="tableHighLight">
                Tiêu đề SEO: (<span class="highLight_500">{{ mb_strlen($item->seo_title) }}</span>)
            </span>
            {{ $item->seo_title }}
        </div>
        <div class="oneLine">
            <span class="tableHighLight">
                Mô tả SEO: (<span class="highLight_500">{{ mb_strlen($item->seo_description) }}</span>)
            </span>
            {{ $item->seo_description }}
        </div>
        <div class="oneLine">
            <span class="tableHighLight">
                Đường dẫn tĩnh:
            </span>
            {{ $item->seo_alias }}
        </div>
    </td>
    <td style="vertical-align:top;">
        <div class="oneLine">
            Đánh giá:
            <span class="tableHighLight">
                {{ $item->rating_aggregate_star }} / {{ $item->rating_aggregate_count }}
            </span>
        </div>
        <div class="oneLine">
            <i data-feather='plus'></i>
            {{ date('H:i, d/m/Y', strtotime($item->created_at)) }}
        </div>
        <div class="oneLine">
            <i data-feather='edit-2'></i>
            {{ date('H:i, d/m/Y', strtotime($item->updated_at)) }}
        </div>
    </td>
    <td style="vertical-align:top;display:flex;">
        <div class="icon-wrapper iconAction">
            <a href="{{ url($item->seo_alias_full) }}" target="_blank">
                <i data-feather='eye'></i>
                <div>Xem</div>
            </a>
        </div>
        <div class="icon-wrapper iconAction">
            <a href="{{ route('admin.category.view', ['id' => $item->id]) }}">
                <i data-feather='edit'></i>
                <div>Sửa</div>
            </a>
        </div>
        <div class="icon-wrapper iconAction">
            <a href="{{ route('admin.category.view', ['id' => $item->id, 'type' => 'copy']) }}">
                <i data-feather='copy'></i>
                <div>Chép</div>
            </a>
        </div>
        {{-- <div class="icon-wrapper iconAction">
            <a href="#" onClick="deleteItem('{{ $item->id }}');">
                <i data-feather='x-square'></i>
                <div>Xóa</div>
            </a>
        </div> --}}
    </td>
</tr>
@endif