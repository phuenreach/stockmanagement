@extends("systems.base")



@section("function")
  <h5>Product List</h5>
@endsection

@section('etra_style')
    <style>
        .action-right{
            display: flex;
            margin:0 5px;
            right: 0;
            justify-content: flex-end
        }
        .action-right > button{
            margin: 0 5px;
        }
    </style>
@endsection

@section("content")

    <div class="card top-selling overflow-auto">
      <div class="card-body pb-0">
        <form action="{{ route("reciev.product.store") }}" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="card-title" style="display: flex">
                <div class="bar-action col-6">
                    <a href="{{ route("reciev.product.index") }}">បញ្ជីទំនិញ</a>
                </div>
                <div class="action-right col-6" >
                    <button type="submit" class="btn btn-outline-primary shadow-none">រក្សាទុក</button>
                    <button type="cancel" class="btn btn-outline-danger shadow-none">បោះបង់</button>

                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="col-form-label">ប្រភេទទំនិញ</label>
                    <div class="row">
                        <div class="col-sm-12">
                            <select class="form-select shadow-none cat-filter" aria-label="Default select example">
                                <option selected value="0">ប្រភេទទំនិញទាំងអស់</option>
                                @foreach ($categories as  $item)
                                    <option value="{{ $item->id }}" >{{ $item->title}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category_id'))
                                <span style="color: red; font-size:12px">សូមជ្រើសរើសប្រភេទទំនិញ </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="col-md-6 mb-3">
                    <label class="col-form-label">ទំនិញដែលបន្ថែម</label>
                    <div class="row">
                        <div class="col-sm-12">
                            <select class="form-select shadow-none product-list" aria-label="Default select example" name="pro_id">
                                <option selected value="0">ទំនិញទាំងអស់</option>
                                @foreach ($product as  $item)
                                    <option value="{{ $item->id }}" >{{ $item->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('pro_id'))
                                <span style="color: red; font-size:12px">សូមជ្រើសរើសមុខទំនិញ </span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="row mb-3">
                        <label for="inputText" class=" col-form-label">តម្លៃក្នុងមួយឯកតា</label>
                        <div class="">
                        <input type="number" class="form-control shadow-none" id="price" name="price" value="{{ old('price') }}" min="0.01" step="0.01">
                        @if($errors->has('price'))
                            <span style="color: red; font-size:12px">សូមបំពេញ និង​ ជាប្រភេទលេខ </span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-3">
                        <label for="inputText" class=" col-form-label">ចំនួន</label>
                        <div class="">
                        <input type="number" class="form-control shadow-none" name="qty" value="{{ old('qty') }}" min="0">
                        @if($errors->has('qty'))
                            <span style="color: red; font-size:12px">សូមបំពេញ និង ​ជាប្រភេទលេខ</span>
                        @endif
                        </div>
                    </div>

                </div>

            </div>
        </form>
      </div>

    </div>


@endsection

@section("extra_script")
<script>



// this script for controll all of ajax requestion
// it handle of category filter product
$(document).ready(function(){
    $(".cat-filter").on("change", function(){
        var cat_id = $(this).val();
        $.ajax({
            url:'{{ route("reciev.product.cet.filter") }}',
            data:{
                'cat_id':cat_id
            },
            success:function(response){
                option="<option>ទំនិញ</option>";
                response['data'].map((obj,i)=>{
                    option+='<option value='+obj.id+'>'+obj.name+'</option>'
                });
                $(".product-list").html(option)
            }

        });
    });

    $(".product-list").on("change", function(){
        $.ajax({
            url:'{{ route("reciev.product.pro.price") }}',
            data:{
                'pro_id':$(this).val()
            },
            success:function(response){
                $("#price").val(response['data']);
            }

        });
    })



});
</script>

@endsection
