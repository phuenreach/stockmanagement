@extends("systems.base")
@section('etra_style')
    <style>
        .gallery-grid{
            display: flex;
            flex-wrap: wrap;

        }
        .gallery-grid > .post-item{
            margin: 5px;
            position: relative;
        }
        .post-item img{
            width: 100px;
        }
        /* .add-folde{
            float: left;

        } */
        /* .post-item img:hover{
            width: 400px;
            position: absolute;
            z-index: 4;

        } */
    </style>
@endsection

@section('content')

<div class="card">
    <div class="card-header  col-md-12">
        <h5 class="card-title">
            រូបភាពដែលបាន upload
        </h5>

        <div style="float: right">
            <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <span class="input-group-text" id="basic-addon2"><i class="bi bi-plus"></i></span>
            </div>
            <button type="button" class="btn btn-outline-info  shadow-none"><i class="bi bi-folder-plus"></i> New Folder</button>
            <button type="button" class="btn btn-outline-info shadow-none"><i class="bi bi-cloud-upload"></i> Upload Image</button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-10" >
                <div class=" gallery-grid">
                    @foreach ($gallery as  $item)
                        @if ($item->folder_id !=0)
                        <div class="post-item clearfix">
                            <img src="{{ asset('uploads/images/'.$item->path) }}" alt="" >
                        </div>
                        @else
                        <div class="post-item clearfix">
                            <img src="{{ asset('uploads/default/'.$item->path) }}" alt="" >
                        </div>
                        @endif

                    @endforeach


                </div>
            </div>
            <div class="col-md-2"​style="    border-left: 1px solid green;" >
                    <ul class="sidebar-nav" id="sidebar-nav">

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="index.html">
                        <span>រូបភាពទាំងអស់</span>
                        </a>
                    </li>
                    @foreach ($folder as $item )
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#">
                        <span>{{ $item->name }}</span>
                        </a>
                    </li>
                    @endforeach


                    </ul>

            </div>
        </div>
    </div>

  </div>


@endsection
