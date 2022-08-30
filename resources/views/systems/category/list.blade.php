@extends('systems.base')

@section('content')
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">{{ $parent_name }}<span> | <a href="{{ route('category.create', $parent_id) }}", style="float: right">បង្កើតថ្មី</a></span></h5>
                  <!-- Default Table -->
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">រូបតំណាង</th>
                        <th scope="col">ឈ្នោះ</th>
                        <th scope="col">តម្រៀប</th>
                        <th scope="col">ថ្ងៃបង្កើត</th>
                        <th scope="col">មុខងា</th>
                      </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $item )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img alt="your image" src="{{ asset('uploads/category/'.$item->icon) }}" class="image-preview" width="50" height="50" />

                            </td>
                            <td>{{ $item->title }} ({{ $item->sub->count() }})</td>
                            <td>
                                @if(!$loop->first)
                                <a href="{{ route('category.order', ['id'=>$item->id,'order'=>$item->order,'mode'=>'up']) }}"><i class="bi bi-arrow-up-circle"></i></a>
                                @endif
                                @if (!$loop->last)
                                <a href="{{ route('category.order', ['id'=>$item->id,'order'=>$item->order,'mode'=>'down']) }}"><i class="bi bi-arrow-down-circle"></i></a>
                                @endif
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="#" style="padding: 5px"><i class="bi bi-eye " title="block category"></i></a>
                                <a href="{{ route('category.sub.list', $item->id) }}" style="padding: 5px;"><i class="bi bi-border-style" title="add child"></i></a>
                                <a href="{{ route('category.edit', $item->id) }}" style="padding: 5px"><i class="bi bi-pencil" title="edit"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                  </table>
                  {!! $data->links() !!}
                  <!-- End Default Table Example -->
                </div>
              </div>

        </div>
    </div>


<div class="modal right fade" id="categoryadd" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="nav flex-sm-column flex-row">
                            <a class="nav-item nav-link active" href="#">Home</a>
                            <a href="#" class="nav-item nav-link">Link</a>
                            <a href="#" class="nav-item nav-link">Link</a>
                            <a href="#" class="nav-item nav-link">Link</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
</div>
    <!-- container -->
@endsection
