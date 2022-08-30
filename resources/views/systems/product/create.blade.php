@extends("systems.base")



@section("function")
  <h5>Product List</h5>
@endsection
@section("etra_style")
    <style>
        .bar-action{
            display: block;
        }

        .action-right{
            position: absolute;
            right: 20px;
        }

        .preview-images-zone {
    width: 100%;
    border: 1px solid #ddd;
    min-height: 180px;
    /* display: flex; */
    padding: 5px 5px 0px 5px;
    position: relative;
    overflow:auto;
}
.preview-images-zone > .preview-image:first-child {
    height: 185px;
    width: 185px;
    position: relative;
    margin-right: 5px;
}
.preview-images-zone > .preview-image {
    height: 90px;
    width: 90px;
    position: relative;
    margin-right: 5px;
    float: left;
    margin-bottom: 5px;
}
.preview-images-zone > .preview-image > .image-zone {
    width: 100%;
    height: 100%;
}
.preview-images-zone > .preview-image > .image-zone > img {
    width: 100%;
    height: 100%;
}
.preview-images-zone > .preview-image > .tools-edit-image {
    position: absolute;
    z-index: 100;
    color: #fff;
    bottom: 0;
    width: 100%;
    text-align: center;
    margin-bottom: 10px;
    display: none;
}
.preview-images-zone > .preview-image > .image-cancel {
    font-size: 18px;
    position: absolute;
    top: 0;
    right: 0;
    font-weight: bold;
    margin-right: 10px;
    cursor: pointer;
    display: none;
    z-index: 100;
}
.preview-image:hover > .image-zone {
    cursor: move;
    opacity: .5;
}
.preview-image:hover > .tools-edit-image,
.preview-image:hover > .image-cancel {
    display: block;
}
.ui-sortable-helper {
    width: 90px !important;
    height: 90px !important;
}

.container {
    padding-top: 50px;
}
    </style>
@endsection
@section("content")

    <div class="card top-selling overflow-auto">
      <div class="card-body pb-0">
        <form action="{{ route("product.store") }}" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="card-title" style="display: flex">
                <div class="bar-action col-6">
                    <a href="{{ route("product.index") }}">បញ្ជីទំនិញ</a>
                </div>
                <div class="action-right">
                    <button type="submit" class="btn btn-outline-primary shadow-none">រក្សាទុក</button>
                    <button type="cancel" class="btn btn-outline-danger shadow-none">បោះបង់</button>

                </div>
            </div>
            <hr>
            <div class="row">

                <div class="col-md-6">
                    <div class="row mb-3">
                        <label for="inputText" class=" col-form-label">ឈ្មោះទំនិញ</label>
                        <div class="">
                        <input type="text" class="form-control shadow-none"  name="name" value="{{ old('name') }}" >
                        @if($errors->has('name'))
                            <span style="color: red; font-size:12px">សូមបំពេញឈ្មោះទំនិញ</span>
                        @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class=" col-form-label">ចំនួន</label>
                        <div class="">
                        <input type="number" class="form-control shadow-none" name="qty" value="{{ old('qty') }}" min="0">
                        @if($errors->has('qty'))
                            <span style="color: red; font-size:12px">សូមបំពេញ និង ​ជាប្រភេទលេខ</span>
                        @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class=" col-form-label">តម្លៃក្នុងមួយឯកតា</label>
                        <div class="">
                        <input type="number" class="form-control shadow-none" name="price" value="{{ old('price') }}" min="0.01" step="0.01">
                        @if($errors->has('price'))
                            <span style="color: red; font-size:12px">សូមបំពេញ និង​ ជាប្រភេទលេខ </span>
                        @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class=" col-form-label">លេខផលិតផល</label>
                        <div class="">
                        <input type="text" class="form-control shadow-none" name="code">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-3">
                        <label class="col-form-label">ប្រភេទទំនិញ</label>
                        <div class="row">
                            <div class="col-sm-10">
                                <select class="form-select shadow-none" aria-label="Default select example" name="category_id">
                                    <option selected value="0">ប្រភេទទំនិញទាំងអស់</option>
                                    @foreach ($categories as  $item)
                                        <option value="{{ $item->id }}" >{{ $item->title}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('category_id'))
                                    <span style="color: red; font-size:12px">សូមជ្រើសរើសប្រភេទទំនិញ </span>
                                @endif
                            </div>
                            <div class="col-sm-2" >
                                <button type="button" class="btn btn-outline-info shadow-none" data-bs-toggle="modal" data-bs-target="#addcategory"><i class="bi bi-plus"></i></button>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <fieldset class="form-group">
                            <a href="javascript:void(0)" onclick="$('#pro-image').click()">រូបភាព</a>
                            <input type="file" id="pro-image" name="images[]" style="display: none;" class="form-control" multiple>
                        </fieldset>
                        <div class="preview-images-zone">

                        </div>
                    </div>
                </div>

            </div>
        </form>
      </div>

    </div>

    <div class="modal fade left" id="addcategory" tabindex="-1" data-bs-backdrop="false" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">បង្កើតថ្មី</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- General Form Elements -->
          <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="parent_id">
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">ឈ្មោះ</label>
              <div class="col-sm-10">
                <input type="text" class="form-control shadow-none" name="title">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail" class="col-sm-2 col-form-label">slug</label>
              <div class="col-sm-10">
                <input type="text" class="form-control shadow-none" name="slug">
              </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail" class="col-sm-2 col-form-label">រូបតំណាង</label>
                <div class="col-sm-10">
                    <img id="blah" alt="your image" src="{{ asset('default_image/black-image.jpg') }}" class="image-preview" width="100" height="100" />
                    <input type="file" class="brow-image" name="icon" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                </div>
              </div>




          </form><!-- End General Form Elements -->

            </div>

          </div>
        </div>
      </div>
@endsection

@section("extra_script")
<script>
    $(document).ready(function() {
    document.getElementById('pro-image').addEventListener('change', readImage, false);


    $(document).on('click', '.image-cancel', function() {
        let no = $(this).data('no');
        $(".preview-image.preview-show-"+no).remove();
    });
});



var num = 4;
function readImage() {
    if (window.File && window.FileList && window.FileReader) {
        var files = event.target.files; //FileList object
        var output = $(".preview-images-zone");

        for (let i = 0; i < files.length; i++) {
            var file = files[i];
            if (!file.type.match('image')) continue;

            var picReader = new FileReader();

            picReader.addEventListener('load', function (event) {
                var picFile = event.target;
                var html =  '<div class="preview-image preview-show-' + num + '">' +
                            '<div class="image-cancel" data-no="' + num + '">x</div>' +
                            '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result + '"></div>' +
                            '<div class="tools-edit-image"><a href="javascript:void(0)" data-no="' + num + '" class="btn btn-light btn-edit-image">edit</a></div>' +
                            '</div>';

                output.append(html);
                num = num + 1;
            });

            picReader.readAsDataURL(file);
        }
        console.log(file)
        $("#pro-image").val(files);
    } else {
        console.log('Browser not support');
    }
}


</script>

@endsection
