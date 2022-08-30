@extends("systems.base")

@section("content")
<div class="col-12">
    <div class="card top-selling overflow-auto">

      <div class="card-body pb-0">
        <h5 class="card-title">ទិន្ន័យរបស់អ្នកប្រើប្រាស់​<span>  <a href="{{ route('user.create') }}", style="float: right">បង្កើតថ្មី</a></span></h5>


        <table class="table table-borderless">
          <thead>
            <tr>
              <th scope="col">លេខរៀង</th>
              <th scope="col">រូបភាព</th>
              <th scope="col">ឈ្មោះពេញ</th>
              <th scope="col">ឈ្មោះចូលប្រើ</th>
              <th scope="col">ទំនាក់ទំនង</th>
              <th scope="col">ប្រភេទ</th>
              <th scope="col">មុខងារបន្ថែម</th>
            </tr>
          </thead>
          <tbody>

                @foreach ($user as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <th scope="row"><a href="#"><img src="{{ asset('uploads/users/'.$item->photo) }}" alt="" width="50s"></a></th>
                        <th scope="row">{{ $item->fullname }}</th>
                        <td><a href="#" class="text-primary fw-bold">{{ $item->username }}</a></td>
                        <td>{{ $item->contact }}</td>
                        <td >{{ $item->type }}</td>
                        <td>
                            <a href="{{ route("user.status", ['id'=> $item->id, 'status'=>$item->status]) }}" class="action-controll" > <i class="bi {{ $item->status==1?"bi-eye":"bi-eye-slash" }}" ></i></a>
                            <a href="{{ route("user.edit", $item->id) }}" class="action-controll"> <i class="bi bi-pencil-square"></i></a>
                        </td>
                    </tr>
                @endforeach

          </tbody>
        </table>

      </div>

    </div>
  </div>
@endsection
