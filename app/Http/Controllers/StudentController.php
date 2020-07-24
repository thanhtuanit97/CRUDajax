<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;

use Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_student = Student::orderBy('id', 'desc')->paginate(5);
        return view('Student.list', compact('list_student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data  = $request->all();
        if(Student::create($data))
        {
            return response()->json(['success'=>'Thêm Học Sinh Thành Công'], 200);
        } else
        {
            return response()->json(['success'=>'Vui lòng kiểm tra lại ']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id); // tìm student theo id
        return response()->json($student, 200); // trả về một mảng json vs status là 200
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //có thể validate bằng form request cho thuận tiện.
        // không nên hoặc hạn chế dùng validate kiểu này
        $validator = Validator::make($request->all(), 
            [
                'name'=> 'required|min:10|max:40',
                'email'=>'required',
                'address'=>'required',
                'phone'=>'required',
            ],
            [
                'name.required'=> 'Tên học sinh không được để trống',
                'name.min'=> ':attribute quá ngắn',
                'name.max'=>':attribute quá dài',
                

                'email.required'=> ':attribute không được để trống',
                'address.required'=> ':attribute không được để trống',
                'phone.required'=> ':attribute không được để trống',
            ],[
                'name'=> 'Tên học sinh',
                'email'=>'Email',
                'address'=>'Địa chỉ',
                'phone'=>'Số điện thoại'
            ]
        );
        if($validator->fails()){
            return response()->json(['error'=>'true', 'message'=>$validator->errors()], 200);
        }
        $student = Student::find($id);
        $student->update([
            'name'=> $request->name, 
            'email'=> $request->email,
            'address'=>$request->address,
            'phone'=>$request->phone,
        ]);
        

        return response()->json(['success'=>'Sửa Học Sinh Thành Công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $student = Student::find($id);
        if($student->delete())
        {
            return response()->json(['success'=>'Đã Xóa Thành Công!']);
        } else {
            return response()->json(['error'=>'Có Lỗi Vui Lòng Kiểm Tra Lại!']);
        }
    }
}
