@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
            </header>

            <div class="panel-body">
                <div class="position-center">
                    <form role="form" method="POST" action="{{URL::to('/save-category')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="category_name_product" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                           <textarea style="resize: none;" rows="5" class="form-control" name="category_desc_product" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select class="form-control input-sm m-bot15" name="category_status_product">
                               <option value="0">Ẩn</option>
                                <option value="1">Hiện thị</option>
                            </select>
                        </div>

                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh muc</button>
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
