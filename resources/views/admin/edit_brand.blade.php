@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật thương hiệu sản phẩm
                </header>

                <div class="panel-body">
                    @foreach($edit_brand as $key => $value)
                        <div class="position-center">
                            <form role="form" method="POST" action="{{URL::to('/update-brand/'.$value->brand_id)}}">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" value="{{$value->brand_name}}" name="brand_name_product" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                                    <textarea style="resize: none;" rows="5" class="form-control" name="brand_desc_product" id="exampleInputPassword1" placeholder="Mô tả thương hiệu">{{$value->brand_desc}}</textarea>
                                </div>


                                <button type="submit" name="add_brand_product" class="btn btn-info">Cập nhật danh muc</button>
                            </form>

                        </div>
                    @endforeach
                </div>
            </section>

        </div>

    </div>
@endsection

