{{-- Wrapper đồng bộ với dự án mẫu: include từng schema riêng theo listType --}}
@if(in_array('organization', $listType ?? []))
    @include('main.schema.organization')
@endif
@if(!empty($info) && in_array('article', $listType ?? []))
    @include('main.schema.article', compact('info'))
@endif
@if(!empty($info) && in_array('creativeworkseries', $listType ?? []))
    @include('main.schema.creativeworkseries', compact('info'))
@endif
@if(in_array('breadcrumb', $listType ?? []) && isset($breadcrumb))
    @include('main.schema.breadcrumb', compact('breadcrumb'))
@endif
@if(in_array('listitem', $listType ?? []) && !empty($list))
    @include('main.schema.itemlist', ['data' => $list])
@endif
