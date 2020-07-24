@extends('Student.layout')
 


@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary" style="text-align: center;">Danh Sách Học Sinh</h6>
  </div>
  <br>
  <div class="container">
    <div class="row">
      
      <div class="col-md-3">
        <button class="btn btn-primary addstudent"  data-toggle="modal" data-target="#add" type="button"  >Thêm Mới</button>
      </div>
     
    </div>
  </div>
  
      
  <div class="card-body">
    
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>STT</th>
            <th>Họ Tên</th>
            <th>Email</th>
            <th style="width:25%;">Địa Chỉ</th>
            <th>Số Điện Thoại</th>
            <th></th>
          </tr>
        </thead>
                  
                  <tbody id="getProduct">
                   @foreach($list_student as $key => $student)
                   <tr>
                    <td>{{ $key+1 }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->address }}</td>
                        <td>{{ $student->phone }}</td>
                   <td>
                     <button class="btn btn-primary editstudent" title ="{{"Sửa"." ".$student->name}}"  data-toggle="modal" data-target="#edit" type="button" data-id="{{ $student->id }}" ><i class="fas fa-edit"></i></button>
                     <button class="btn btn-danger deletestudent" title ="{{"Xóa"." ".$student->name}}" data-toggle="modal" data-target="#delete" type="button" data-id="{{ $student->id }}" ><i class="fas fa-trash-alt"></i></button>
                   </td>
                 </tr>
                 @endforeach
               </tbody>
             </table>
             <div class="pull-right">{{ $list_student->links() }}</div>
           </div>
         </div>
       </div>

       <!-- Add Modal-->
     <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Thêm Mới Học Sinh : </h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row" style="margin: 5px">
                <div class="col-lg-12">
                  <form role="form" >
                        <fieldset class="form-group">
                            <label>Họ Và Tên : <i style="color: red">(*)</i> </label>
                            <input class="form-control name" id="name" name="name" >
                            <span class="errorEmail" style="color: red; font-size: 1rem;"></span>
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Email : <i style="color: red">(*)</i> </label>
                            <input class="form-control email" id="email" name="email" >
                            <span class="errorEmail" style="color: red; font-size: 1rem;"></span>
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Địa Chỉ : <i style="color: red">(*)</i> </label>
                            <input class="form-control address" id="address" name="address" >
                            <span class="errorAddress" style="color: red; font-size: 1rem;"></span>
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Số Điện Thoại : <i style="color: red">(*)</i> </label>
                            <input class="form-control phone" id="phone" name="phone" >
                            <span class="errorPhone" style="color: red; font-size: 1rem;"></span>
                        </fieldset>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-success addstudent" data-id ="" id="btn-add" value="add">Thêm</button>
                              
                              {{-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button> --}}
                        </div>
                    </form>
                </div>
              </div>
               
            </div>
            
          </div>
        </div>
      </div>
     <!-- Edit Modal-->
     <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa Học Sinh : <span class="title" style="font-style: italic"></span></h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row" style="margin: 5px">
                <div class="col-lg-12">
                  <form role="form"  >
                        <fieldset class="form-group">
                            <label>Họ Và Tên : <i style="color: red">*</i>  </label>
                            <input class="form-control name" id="name" name="name" >
                          <span class="errorName" style="color: red; font-size: 1rem;"></span>
                        </fieldset>


                        <fieldset class="form-group">
                            <label>Email : <i style="color: red">*</i> </label>
                            <input class="form-control email" id="email" name="email" >  
                            <span class="errorEmail" style="color: red; font-size: 1rem;"></span>
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Địa Chỉ : <i style="color: red">*</i> </label>
                            <input class="form-control address" id="address" name="address" >
                            <span class="errorAddress" style="color: red; font-size: 1rem;"></span>
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Số Điện Thoại : <i style="color: red">*</i> </label>
                            <input class="form-control phone" id="phone" name="phone" >
                            <span class="errorPhone" style="color: red; font-size: 1rem;"></span>
                        </fieldset>

                        
                    </form>
                </div>
              </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-success updatestudent" data-id ="">Sửa</button>
                    
                    {{-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button> --}}
                </div>
            </div>
            
          </div>
        </div>
      </div>
       <!-- Delete Modal-->
      <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa ? <span class="title"></span>  </h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body" style="margin-left: 183px;">
              <button type="button" class="btn btn-success delete">Có</button>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Không</button>
              <div>
              </div>
            </div>
          </div>

  

          

@endsection