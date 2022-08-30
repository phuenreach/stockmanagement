@extends("systems.base")

<style>

    .image-preview{
        width: 200px;
        height: 200px;
        position: absolute;
        border: 1px solid green;
    }

    .brow-image{
        width: 200px;
        height: 200px;
        position: relative;
        opacity: 0;
    }
</style>
@section('content')


<div class="row">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">បង្កើត {{ $parent_id !=0?'កូន'.$parent_name:$parent_name }}</h5>

          <!-- General Form Elements -->
          <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="parent_id" value="{{ $parent_id }}">
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


            <div class="row mb-3">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary shadow-none">រក្សាទុក</button>
              </div>
            </div>

          </form><!-- End General Form Elements -->

        </div>
      </div>
  </div>

@endsection
