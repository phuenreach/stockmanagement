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
            right: 20px;
        }

    </style>
@endsection
@section("content")
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <div class="row">
                    <form action="{{ route("sale.view") }}" method="GET" class="frm-custom">
                        <div class="col-3">
                            <input class="form-control shadow-none col-4" name="search">

                        </div>
                        <div class="col-3" style="margin: 0 5px">
                            <select id="inputState" class="form-select shadow-none  col-4" name="cat">
                                <option value="0" selected="">គ្រប់ប្រភេទទំនិញ</option>
                                @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>

                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-outline-info" ><i class="bi bi-search"></i></button>
                    </form>
                    <a class="btn btn-outline-info shadow-none reload-btn"  href={!! route("sale.view") !!}><i class="bi bi-arrow-repeat"></i></a>
                </div>
            </div>

            <hr>


                    <table class="table table-borderless">
                        <thead>
                          <tr>
                            <th scope="col">រូបភាព</th>
                            <th scope="col">ឈ្មោះអទំនិញ</th>
                            <th scope="col">ចំនួន</th>
                            <th scope="col">តម្លៃសរុប</th>
                            <th scope="col">អតិថិជន</th>
                            <th scope="col">អ្នកលក់</th>
                          </tr>
                        </thead>
                        <tbody>

                              @foreach ($sold as $item)

                                <tr>
                                      <th scope="row"><a href="#"><img src="{{ asset("uploads/product/".$item->product["pro_galleries"][0]["img_name"] ) }}" alt="" width="50s"></a></th>
                                      <th scope="row">{{ $item->product['name'] }}</th>
                                      <td><a href="#" class="text-primary fw-bold">{{ $item->qty }}</a></td>
                                      <td>{{ $item->sub_total }}</td>
                                      <td >{{ $item->invoice['customer']['name'] }}</td>
                                      <th scope="row">{{ $item->invoice['user']['fullname'] }}</th>

                                  </tr>
                              @endforeach

                        </tbody>
                    </table>
                    {!! $sold->links() !!}

        </div>


    </div>
  </div>

@endsection
