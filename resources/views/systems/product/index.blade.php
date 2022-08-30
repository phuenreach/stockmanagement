@extends("systems.base")


@section("function")
  <h5>Product List</h5>
@endsection
@section("etra_style")
    <style>
        .frm-custom{
            display: flex;
        }
        .reload-btn{
            width: 50px;
            position: absolute;
            right: 75px;
        }
        .add-btn{
            width: 50px;
            position: absolute;
            right: 20px;
        }
    </style>
@endsection
@section("content")
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <div class="row">
                    <form action="{{ route("product.index") }}" method="GET" class="frm-custom">
                        <div class="col-3">
                            <input class="form-control shadow-none col-4" name="search">

                        </div>
                        <div class="col-3" style="margin: 0 5px">
                            <select id="inputState" class="form-select shadow-none  col-4" name="cat">
                                <option value="0" selected="">គ្រប់ប្រភេទទំនិញ</option>
                                @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>

                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-outline-info" ><i class="bi bi-search"></i></button>
                    </form>
                    <a class="btn btn-outline-info shadow-none reload-btn"  href={!! route("product.index") !!}><i class="bi bi-arrow-repeat"></i></a>
                    <a class="btn btn-outline-primary shadow-none add-btn"  href={!! route("product.create") !!}><i class="bi bi-plus"></i></a>
                </div>
            </div>
            <hr>
            <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">លេខរៀង</th>
                    <th scope="col">រូបភាព</th>
                    <th scope="col">ឈ្មោះ</th>
                    <th scope="col">ចំនួន</th>
                    <th scope="col">តម្លៃ(ឯកតា)</th>
                    <th scope="col">ប្រភេទ</th>
                    <th scope="col">មុខងារបន្ថែម</th>
                  </tr>
                </thead>
                <tbody>

                      @foreach ($products as $item)
                        <tr>
                              <td>{{ $loop->iteration }}</td>
                              <th scope="row"><a href="#"><img src="{{ asset("uploads/product/".$item->pro_galleries[0]->img_name ) }}" alt="" width="50s"></a></th>
                              <th scope="row">{{ $item->name }}</th>
                              <td><a href="#" class="text-primary fw-bold">{{ $item->quality }}</a></td>
                              <td>{{ $item->unit_price }}</td>
                              <td >{{ $item->categories['title'] }}</td>
                              <td>
                                  <a href="{{ route("user.status", ['id'=> $item->id, 'status'=>$item->status]) }}" class="action-controll" > <i class="bi {{ $item->status==1?"bi-eye":"bi-eye-slash" }}" ></i></a>
                                  <a href="{{ route("product.edit", $item->id) }}" class="action-controll"> <i class="bi bi-pencil-square"></i></a>
                              </td>
                          </tr>
                      @endforeach

                </tbody>
            </table>
    </div>
  </div>

@endsection
