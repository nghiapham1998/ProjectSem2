@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục sản phẩm
                </header>

                <div class="panel-body">
                    @foreach($edit_category as $key => $value)
                    <div class="position-center">
                        <form role="form" method="POST" action="{{URL::to('/update-category/'.$value->category_id)}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" value="{{$value->category_name}}" name="category_name_product" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả danh mục</label>
                                <textarea style="resize: none;" rows="5" class="form-control" name="category_desc_product" id="exampleInputPassword1" placeholder="Mô tả danh mục">{{$value->category_desc}}</textarea>
                            </div>


                            <button type="submit" name="add_category_product" class="btn btn-info">Cập nhật danh muc</button>
                        </form>

                    </div>
                    @endforeach
                </div>
            </section>

        </div>

    </div>
@endsection
