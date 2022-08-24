@extends('layouts.admin')
@section('content')

<div class="titlePage">Danh sách Chuyên mục</div>
<div class="card">
    <!-- ===== Table ===== -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th class="text-center">Ảnh</th>
                    <th class="text-center">Thông tin Category</th>
                    {{-- <th class="text-center">Thông tin SEO</th> --}}
                    <th class="text-center" style="min-width:180px;">Khác</th>
                    <th class="text-center" width="60px">-</th>
                </tr>
            </thead>
            <tbody>
                @php
                if(!empty($list)){
                    $i          = 1;
                    foreach($list as $item){
                        echo view('admin.category.oneRow', ['item' => $item, 'no' => $i]);
                        if(!empty($item->child)){
                            $j  = 1;
                            foreach($item->child as $child1){
                                echo view('admin.category.oneRow', ['item' => $child1, 'no' => $i.'.'.$j]);
                                if(!empty($child1->child)){
                                    $k  = 1;
                                    foreach($child1->child as $child2){
                                        echo view('admin.category.oneRow', ['item' => $child2, 'no' => $i.'.'.$j.'.'.$k]);
                                        if(!empty($child2->child)){
                                            $h  = 1;
                                            foreach($child2->child as $child3){
                                                echo view('admin.category.oneRow', ['item' => $child3, 'no' => $i.'.'.$j.'.'.$k.'.'.$h]);
                                            }
                                            ++$h;
                                        }
                                        ++$k;
                                    }
                                }
                                ++$j;
                            }
                        }
                        ++$i;
                    }
                }
                @endphp
            </tbody>
        </table>
    </div>

</div>
    
@endsection
@push('scripts-custom')
    <script type="text/javascript">
        function deleteItem(id){
            $.ajax({
                url         : "{{ route('admin.category.delete') }}",
                type        : "GET",
                dataType    : "html",
                data        : { id : id }
            }).done(function(data){
                if(data==true) $('#category_'+id).remove();
            });
        }
    </script>
@endpush