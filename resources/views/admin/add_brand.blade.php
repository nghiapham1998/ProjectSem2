@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thương hiệu sản phẩm
                </header>

                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" method="POST" action="{{URL::to('/save-brand')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên thương hiệu</label>
                                <input type="text" name="brand_name_product" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả danh mục</label>
                                <textarea style="resize: none;" rows="5" class="form-control" name="brand_desc_product" id="exampleInputPassword1" placeholder="Mô tả thương hiệu"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                <select class="form-control input-sm m-bot15" name="brand_status_product">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiện thị</option>
                                </select>
                            </div>

                            <button type="submit" name="add_brand_product" class="btn btn-info">Thêm thuong hiệu</button>
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

