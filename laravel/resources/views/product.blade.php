@extends('layouts.default_with_menu')

@section('content')
<form action="{{ url('/product') }}" method="post">
    @csrf
    <div class="row mt-3">
        <div class="col-6">
            <label>Category Name</label>
            <input type="text" name="category_name" class="form-control" />
        </div>
    </div>
    <button type="button" id="btn-add-product-list" class="btn btn-primary mt-3">
        + เพิ่ม product
    </button>
    <div class="row mt-3" id='product-list'>
        <div class="col-6">
            <lable>Product Name <button type="button"
                    class="btn btn-danger ml-3 mt-2 mb-2 btn-del-product-list">ลบ</button></lable>
            <input name="product_name[]" type="text" class="form-control" />
        </div>
    </div>
    <button class="btn btn-success mt-3 mb-3" type="submit">บันทึก</button>
</form>
<table class="table">
    <thead>
        <tr>
            <td>#</td>
            <td>Category Name</td>
            <td>Product Name</td>
            <td>User Name</td>
            <td> </td>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $key => $category)
        <tr>
            <td>{{ $key + 1 }}.</td>
            <td>{{ $category->name }}</td>
            <td>
                <ul>
                    @foreach($category->products as $product)
                    <li>{{ $product->name }}</li>
                    @endforeach
                </ul>
            </td>
            <td>{{ $product->user->name ?? 'Unknown' }}</td>
            <td>
                <form action="{{ url('/product/'.$category->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="confirm_delete(event)">ลบ</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#btn-add-product-list').on('click', function() {
            $("#product-list").append(`
            <div class="col-6">
            <lable>Product Name <button type="button"
                    class="btn btn-danger ml-3 mt-2 mb-2 btn-del-product-list">ลบ</button></lable>
            <input name="product_name[]" type="text" class="form-control" />
        </div>`)
        })

        $(document).on('click', '.btn-del-product-list', function() {
            $(this).parent().parent().remove();
        })
    });
</script>

<script>
    function confirm_delete(event) {
        event.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(function (result){
            if (result.isConfirmed) {
                event.target.closest("form").submit();
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });
            }
        });
    }
</script>
@endsection