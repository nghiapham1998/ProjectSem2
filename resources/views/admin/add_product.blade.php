@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
                </header>

                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" method="POST" action="{{URL::to('/save-Product')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                <textarea style="resize: none;" id="ckeditor1" rows="5" class="form-control" name="product_desc"  placeholder="Mô tả sản phẩm"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                <textarea style="resize: none;" id="ckeditor2" rows="5" class="form-control" name="product_content"  placeholder="Mô tả sản phẩm"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số lượng</label>
                                <input type="number" name="product_inventory" class="form-control" id="exampleInputEmail1" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Gía sản phẩm</label>
                                <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Gía sản phẩm">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                <select class="form-control input-sm m-bot15" name="product_category">
                                    @foreach($category_product as $key => $value)
                                    <option value="{{($value->category_id)}}">{{($value->category_name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                <select class="form-control input-sm m-bot15" name="product_brand">
                                    @foreach($brand_product as $key => $value)
                                    <option value="{{($value->brand_id)}}">{{($value->brand_name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                <select class="form-control input-sm m-bot15" name="product_status">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiện thị</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kích thước sản phẩm</label>
                                <input type="text" name="product_size" class="form-control" id="exampleInputEmail1" placeholder="size sản phẩm">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Màu sản phẩm</label>
                                <input type="text" name="product_color" class="form-control" id="exampleInputEmail1" placeholder="Màu sản phẩm">
                            </div>

                            <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                        </form>
                        <?php
                        $message = Session::get('message');
                        if ($message){
                            echo '<span style="color: green">'.$message.'</span>';
                            Session::put('message',null);
                        }
                        ?>
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection


