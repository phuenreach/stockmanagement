@extends("systems.base")


@section("function")
  <h5>Product List</h5>
@endsection
@section("etra_style")
    <style>
        .bar-action{
            display: flex;
        }
        .bar-action:last-child{
            padding-left: 5px;
        }
        .action-right a{
            float: right;
        }
    </style>
@endsection
@section("content")
    <div class="card">
        <div class="card-body">
            <div class="card-title" style="display: flex">
                <div class="bar-action col-9">
                    <form id="frm-search" autocomplete="off">
                        <div class="row">
                            <div class="col-4">
                                <input type="text" class="form-control shadow-none" name="search" placeholder="search">
                            </div>
                            <div class="col-6">
                                <select id="inputState" class="form-select shadow-none" name="cat">
                                    <option selected="">គ្រប់ប្រភេទទំនិញ</option>
                                    @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="action-right col-3">
                    <a href="{{ route("product.create") }}">បង្កើតថ្មី</a>
                </div>
            </div>
      <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">ទំនិញដែលមាន</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link " id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">ទំនិញដែលអស់</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
        </li>
      </ul>
      <div class="tab-content pt-2" id="borderedTabContent">
        <div class="tab-pane fade  active show" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
            <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">លេខរៀង</th>
                    <th scope="col">ឈ្មោះទំនិញ</th>
                    <th scope="col">ចំនួន</th>
                    <th scope="col">តម្លៃ(ឯកតា)</th>
                    <th scope="col">ឈ្មោះអ្នកបញ្ចូល</th>
                    <th scope="col">កាលបរិច្ឆេទ</th>
                    {{-- <th scope="col">មុខងារបន្ថែម</th> --}}
                  </tr>
                </thead>
                <tbody>

                      @foreach ($re_products as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <th>{{ $item->product->name }}</th>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->user->fullname }}</td>
                                <td>{{ $item->created_at->format("d-m-Y") }}</td>
                                {{-- <td>
                                    <a href="{{ route("user.status", ['id'=> $item->id, 'status'=>$item->status]) }}" class="action-controll" > <i class="bi {{ $item->status==1?"bi-eye":"bi-eye-slash" }}" ></i></a>
                                    <a href="{{ route("user.edit", $item->id) }}" class="action-controll"> <i class="bi bi-pencil-square"></i></a>
                                </td> --}}
                            </tr>

                      @endforeach

                </tbody>
            </table>
            <hr>
            {{ $re_products->links() }}
        </div>
      </div><!-- End Bordered Tabs -->

    </div>
  </div>

@endsection

@section("extra_script")
    <script>
        $("#frm-search").on("submit", function(e){
            e.preventDefault();
            search = $(this).find("input[name=search]").val();
            cat = $(this).find("select[name=cat]").val()
            $.ajax({
                url :"{{ route('reciev.product.search') }}",
                data:{
                    text:search,
                    cat_id :cat
                },
                success:function(response){
                    console.log(response)
                }
            })

        })
    </script>
@endsection
