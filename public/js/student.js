$.ajaxSetup({ // google search lý do tại sao phải dùng ajaxsetup laravel
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function ($) { // khi để file js riêng thì nên cần dòng này, còn nếu đặt js ngắn trong body hoặc header thì có thể k cần.
    
    //add student
        $('.addstudent').click(function (e) { 
            e.preventDefault();
            var name = $('#name').val();
            var email = $('#email').val();
            var address = $('#address').val();
            var phone = $('#phone').val();
            //  alert(name);
            $.ajax({
                type: "post",
                url: "studentAjax",
                data: {
                    name : name , 
                    email : email, 
                    address : address, 
                    phone : phone,
                },
                dataType: "json",
                success: function (result) {
                    console.log(result);
                    toastr.success(result.success, 'Thông Báo', {timeOut: 5000});// thư viện thông báo của bootstrap
					$('#add').modal('hide'); // ẩn cái modal edit sau khi thêm thành công
					location.reload(); //hàm reload lại trang khi thêm thành công
                }
            });
           
            
        });
    
    
    
    
    
    
    
    
    
    
    
    // edit student
    $('.editstudent').click(function (e) { // đầu tiên sẽ đổ dữ liệu ra form
        var idStudent = $(this).data('id'); //lấy id của student về
        console.log(idStudent); //in ra thử id của student đúng hay không
        $.ajax({ // gọi 1 ajax
            type: "get", // phương thức sử dụng là get
            url: "studentAjax/" + idStudent + "/edit", //route được định nghĩa theo resource 
            dataType: "json", //kiểu dữ liệu trả về luôn ở dạng json
            success: function (result) { //nếu thành công thì
                console.log(result);//in kết quả trả về của 1 student
				$('.name').val(result.name); // đổ dữ liệu ra form bằng class đã khai báo bên form
                $('.title').text(result.name);// như trên
                $('.email').val(result.email);
                $('.address').val(result.address);
                $('.phone').val(result.phone);
                $('.updatestudent').attr('data-id',idStudent); //gán id cho form edit
            }
        });
    });
     
    //update student
    $('.updatestudent').click(function (e) { // sau khi đã đổ dữ liệu ra form rồi thì tiến hành update
       var id = $(this).data('id'); // lấy id student về
       var name = $('#name').val(); //lấy giá trị cần update về
       var email = $('#email').val();
       var address = $('#address').val();
       var phone = $('#phone').val();
        //    alert(address);
        $.ajax({ 
            type: "put", //check method trong route resource 
            url: "studentAjax/" + id,// route update
            data: { // một object dữ liệu lấy về
                name : name, 
                email : email, 
                address : address, 
                phone : phone,
            },
            dataType: "json", // kiểu dữ liệu trả về luôn ở dạng json
            success: function (result) { // nếu thành công
                console.log(result); // in thông báo thành công hoặc có error bên console 
                if(result.error == 'true') // nếu gặp lỗi
                {
					$('.errorName').html(result.message.name[0]); // hiển thị lỗi ra form thông qua thẻ span
					$('.errorEmail').html(result.message.email[0]);
					$('.errorAddress').html(result.message.address[0]);
					$('.errorPhone').html(result.message.phone[0]);
                }else { // hoặc ngược lại, nếu thành coogn thì in thông báo thành công ra client
                    toastr.success(result.success, 'Thông Báo', {timeOut: 5000});// thư viện thông báo của bootstrap
					$('#edit').modal('hide'); // ẩn cái modal edit sau khi sửa thành công
					location.reload(); //hàm reload lại trang khi sửa thành công
                }
            }
        });
    });
    //delete student
    //xóa thì đơn giản rồi, gọi ajax trả về route vs method delete là được.
    $('.deletestudent').click(function (e) {  
        e.preventDefault();
        var id = $(this).data('id');

		$('.delete').click(function(event) {
			/* Act on the event */
			$.ajax({
				url: 'studentAjax/'+id,
				type: 'delete',
				dataType: 'json',
				success : function(result)
				{
					toastr.success(result.success, 'Thông Báo', {timeOut: 6000});
					location.reload();
				}
				
			});
			
		});
    });
});