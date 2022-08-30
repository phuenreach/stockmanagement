@extends('systems.base')

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


<div class="card">
    <div class="card-body">
      <h5 class="card-title">កែប្រែអ្នកប្រើប្រាស់</h5>

      <!-- Horizontal Form -->
      <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3 ">
          <label for="inputEmail3" class="col-sm-2 col-form-label">ឈ្មោះពេញ</label>
          <div class="col-sm-10">
            <input type="text" class="form-control shadow-none" name="fullname" value="{{ $user->fullname }}">
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputEmail3" class="col-sm-2 col-form-label">ឈ្នោះចូលប្រើ</label>
          <div class="col-sm-10">
            <input type="text" class="form-control shadow-none" name="username" value="{{ $user->username }}">
          </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">ទំនាក់ទំនង</label>
            <div class="col-sm-10">
              <input type="text" class="form-control shadow-none" name="contact"  value="{{ $user->contact }}">
            </div>
        </div>

        <div class="row mb-3">
            <label for="inputEmail" class="col-sm-2 col-form-label">រូបតំណាង</label>
            <div class="col-sm-10">
                <img id="blah" alt="your image" src="{{ asset("uploads/users/".$user->photo) }}" class="image-preview" width="100" height="100" />
                <input type="file" class="brow-image" name="photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                <input type="hidden" value="{{ $user->photo }}">

            </div>
          </div>
        <div class="text-center mt-5">
          <button type="submit" class="btn btn-primary">រក្សាទុក</button>
        </div>
      </form><!-- End Horizontal Form -->

    </div>
  </div>
@endsection
