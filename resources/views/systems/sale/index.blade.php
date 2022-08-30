@extends("systems.base")



@section("function")
  <h5>Product List</h5>
@endsection

@section('etra_style')
    <style>

        .header-title{
            display: flex;
            padding: 10px;
        }

        .btn-right{
            position: absolute;
            right: 20px;
        }

    </style>
@endsection

@section("content")

    <div class="card top-selling overflow-auto">
      <div class="card-body pb-0">
        <div class="header-title">
            @csrf
            <h5 class="modal-title">កាលក់ទំនិញ</h5>
          <div class="form-check "  style="margin-right: 10px; margin-left:50px">
            <input class="form-check-input shadow-none" type="radio" name="gridRadios" id="old-cus" value="old" checked="">
              <label class="form-check-label" for="old-cus">
                អតិថិជនចាស់
              </label>
          </div>
          <div class="form-check">
            <input class="form-check-input shadow-none" type="radio" name="gridRadios" id="new-cus" value="new"  checked>
              <label class="form-check-label" for="new-cus">
                អតិថិជនថ្មី
              </label>
          </div>
          <div class="btn-right">
            <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">បោះបង់</button>
            <button type="submit" class="btn btn-primary shadow-none" id="frmsubmite">រក្សាទុក</button>
        </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="col-form-label">ជ្រើសរើសអតិថិជន</label>
                <div class="row">
                    <div class="col-sm-12">
                        <select class="form-select shadow-none oldcus" id="cus_id" aria-label="Default select example"  disabled>
                            <option >អតិថិជន</option>
                            @foreach ($customer as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>

                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
            <div class="col-3 mb-3">
                <label for="inputText" class=" col-form-label">ឈ្មោះអតិថិជន</label>
                <div class="">
                <input type="text" class="form-control shadow-none newcus" name="cus_name" value="" min="0">
                </div>
            </div>
            <div class="col-3 mb-3">
                <label for="inputText" class=" col-form-label">អាសយដ្ខាន</label>
                <div class="">
                <input type="text" class="form-control shadow-none newcus" name="addr" value="" min="0">
                </div>
            </div>
            <div class="col-3 mb-3">
                <label for="inputText" class=" col-form-label">ទំនាក់ទំនង</label>
                <div class="">
                <input type="text" class="form-control shadow-none newcus" name="contact" value="" min="0">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="col-form-label">មុខទំនិញ</label>
                <div class="row">
                    <div class="col-sm-12">
                        <select class="form-select shadow-none product-list" aria-label="Default select example" name="pro_id" id="pro_id">
                          <option>ជ្រើសរើសទំនិញ</option>
                          @foreach ($product as  $item)
                          <option value="{{ $item->id }}" data-id = "{{ $item->unit_price }}" >{{ $item->name }} / {{ $item->quality }}</option>
                          @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <div class="col-3 mb-3">
                <label for="inputText" class=" col-form-label">តម្លៃ</label>
                <div class="">
                <input type="number" class="form-control shadow-none" name="price" value="" min="0">
                </div>
            </div>
            <div class="col-3 mb-3">
                <label for="inputText" class=" col-form-label">ចំនួន</label>
                <div class="">
                <input type="number" class="form-control shadow-none" name="qty" value="" min="0">
                </div>
            </div>
            <div class="col-2  mt-4">
              <button type="button" class="btn btn-primary shadow-none" style="margin-top: 15px;
              float: right;
          }" id="add-data">បញ្ចូល</button>
            </div>
        </div>
        <hr>
        <div class="row">
          <div class="card-body pb-0">
            <div class="col-12 bradcum-show" style="display: flex;
            justify-content: space-between;">
              <h5>រាយមុខទំនិញ</h5>
              <label >ចំនួនមុខទំនិញ =  <span class="text-info" id="pro-item">0</span> </label>
              <label >តម្លៃសរុប = <span class="text-danger" id="total">$ 0</span></label>


            </div>

            <table class="table table-borderless" height="200">
              <thead >
                <tr>
                  <th scope="col">ឈ្មោះផលិតផល</th>
                  <th scope="col">តម្លៃរាយ</th>
                  <th scope="col">ចំនួន</th>
                  <th scope="col">តម្លៃសរុប</th>
                  <th></th>
                </tr>
              </thead>
              <hr>
              <tbody id="data-append">


              </tbody>
            </table>

          </div>
        </div>
    </div>

    </div>

</div>


@endsection

@section("extra_script")
<script>
    var data = [];
    var  option_cus= true;
    var total_amount=0;
    $(document).ready(function(){
        $("#old-cus").on("click", function(){
            $(".newcus").prop("disabled","true");
            $(".oldcus").removeAttr('disabled')
            $(".newcus").val("")
            option_cus = false;
        });
        $("#new-cus").on("click", function(){
            $(".oldcus").prop("disabled","true");
            $(".newcus").removeAttr("disabled");
            $(".oldcus").val("")
            option_cus=true;
        });

        $("#add-data").on('click', function(){


          var proselect = $("#pro_id")
          var qty = $("input[name='qty']");
          var price = $("input[name='price']");
          var total = qty * price;

           // remove span before
           qty.next('span').remove();
           price.next('span').remove();

          // condition for make sur input null
          var warning = "<span class='text-danger' style='font-size:14px'>មិនអាចមិនមានទិន្ន័យបានទេ</span>"
          if (qty.val()==""){
            qty.after(warning)
            return
          }
          if (price.val() == ""){
              price.after(warning)
              return
          }

          data.push({
            'pro_id':proselect.val(),
            'name':proselect.find('option:selected').text(),
            'qty':qty.val(),
            'price':price.val(),
            'total':qty.val() * price.val()})



          addNewData()
          clearvalue(qty, price)
        });

        $("#frmsubmite").on('click', function(){
            var data_pro = data;
            var cusdata;
            if(option_cus == true){
                cusdata=[
                    {
                        "name":$("input[name='cus_name']").val(),
                        "addr":$("input[name='addr']").val(),
                        'contact':$("input[name='contact']").val(),
                    }
                ];
            }else{
                cusdata = $("#cus_id").val();
            }

            $.ajax({
                type:'POST',
                url:"{{ route('sale.store') }}",
                data:{
                    'cus':cusdata,
                    'pro_data':data_pro,
                    'amount':total_amount,
                    '_token':$("input[name='_token']").val(),
                },
                success:function(res){
                    console.log(res['message']);

                    if (res['message']){
                        toastr.success('កាលក់បានជោគជ័យ');
                    }
                }

            })

        })
    });

    // set price to input price while select change product
    $("#pro_id").on("change", function(){
        var price = $(this).find('option:selected').attr("data-id");
        $("input[name='price']").val(price);
        $("input[name='qty']").focus();


    })

    function clearvalue(...arg){
        for(i=0; i<arg.length; i++){
          arg[i].val("")
        }
    }

    function addNewData(){
      $("#pro-item").html(data.length)

      console.log(data)
      var data_raw="";
      var sumtotal=0;
      data.map((obj,index)=>{
        data_raw +='<tr>'+
          '<td><a href="#" class="text-primary fw-bold">'+obj.name+'</a></td>'+
          '<td>'+obj.qty+'</td>'+
          '<td class="fw-bold">'+obj.price+'</td>'+
          '<td>'+obj.total.toFixed(2)+'</td>'+
          '<td ><i class="bi bi-dash-square text-danger " onclick="removePro('+index+')"></i></td>'+
        '</tr>'
        sumtotal+= obj.total
      })
      // $("#total").html(dd);
      $("#total").html(sumtotal.toFixed(2)+" $")
      total_amount =sumtotal;
      $("#data-append").html(data_raw)
    }


    // remove data from array
    function removePro(e){
      data.splice(e,1)
      addNewData()
    }



</script>

@endsection
