@extends('systems.base')

@section("extra_style")
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

@endsection


@section('content')


<div class="card">
    <div class="card-body">
      <h5 class="card-title">បង្កើតអ្នកប្រើប្រាស់</h5>

      <!-- Horizontal Form -->
      <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3 ">
          <label for="inputEmail3" class="col-sm-2 col-form-label">ឈ្មោះពេញ</label>
          <div class="col-sm-10">
            <input type="text" class="form-control shadow-none" name="fullname">
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputEmail3" class="col-sm-2 col-form-label">ឈ្នោះចូលប្រើ</label>
          <div class="col-sm-10">
            <input type="text" class="form-control shadow-none" name="username" >
          </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">ទំនាក់ទំនង</label>
            <div class="col-sm-10">
              <input type="text" class="form-control shadow-none" name="contact" >
            </div>
        </div>
        <div class="row mb-3">
          <label for="inputPassword3" class="col-sm-2 col-form-label">ពាក្យសំងាត់</label>
          <div class="col-sm-10">
            <input type="password" class="form-control shadow-none" name="password" >
          </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">បញ្ជាក់ពាក្យសំងាត់</label>
            <div class="col-sm-10">
              <input type="password" class="form-control shadow-none" name="confirm_pass" >
            </div>
        </div>
        <div class="row mb-3">

            <label for="inputEmail" class="col-sm-2 col-form-label">រូបតំណាង</label>
            <div class="col-sm-10">
                <img id ="add-gallery" alt="your image" src="{{ asset('static_images/black-image.jpg') }}" class="image-preview" width="100" height="100" >
                {{-- <input type="file" class="brow-image" name="photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"> --}}
            </div>
          </div>
        <div class="text-center mt-5">
          <button type="submit" class="btn btn-primary">រក្សាទុក</button>
          <button type="button" class="btn btn-primary" data-mdb-toggle="modal"
          data-mdb-target="#addGallery">up</button>
        </div>
      </form><!-- End Horizontal Form -->

    </div>
  </div>

@endsection

@section('extra_script')



@endsection
