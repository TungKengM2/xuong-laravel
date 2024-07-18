<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {


        //crud -> insert/create, delete, list, show, update

        // DB::table('users')->where('id', 7)->update([
        //     'name' => 'Update Value',
        //     'password' => bcrypt(12345678)
        // ]);
        // dd($data1->email);
        // foreach($data1 as $item){
        //     echo "Data 1 " . $item->name . '<br>';
        // }

        // User::query()
        // ->where('id', 7)
        // ->update([
        //         'name' => 'Update Value2',
        //         'password' => bcrypt(12345678)
        //     ]);
        // dd(1);

        // foreach($data2 as $item){
        //     echo "Data 2 " . $item->name . '<br>';
        // }
        // die;
        // dd($data1, $data2);
        // die;

        // Yêu cầu 1: Truy vấn tất cả các bản ghi - Viết truy vấn để lấy tất cả các bản ghi từ bảng users.

        $users = User::query()->get();
        $orders = Order::query()->get();
        $customers = Customer::query()->get();
        $products = Product::query()->get();
        $sales = Sale::query()->get();
        $employees = Employee::query()->get();
        $logs = Logg::query()->get();

        // Yêu cầu 2: Truy vấn với điều kiện - Viết truy vấn để lấy các bản ghi từ bảng users mà cột age lớn hơn 25.
        User::query()->where('age', '>', 25)->get();

        // Yêu cầu 3: Truy vấn với nhiều điều kiện - Viết truy vấn để lấy các bản ghi từ bảng users mà cột age lớn hơn 25 và status bằng 'active'.

        User::query()
            ->where('age', '>', 25)
            ->where('status', 'active')
            ->get();

        //Yêu cầu 4: Sắp xếp kết quả - Viết truy vấn để lấy các bản ghi từ bảng users, sắp xếp theo age giảm dần.

        User::query()->orderByDesc('age')->get();

        //Yêu cầu 5: Giới hạn số lượng kết quả - Viết truy vấn để lấy 10 bản ghi đầu tiên từ bảng products.

        Product::query()->limit(10)->get();

        //Yêu cầu 6: Truy vấn với điều kiện OR - Viết truy vấn để lấy các bản ghi từ bảng orders mà status là 'completed' hoặc total lớn hơn 100

        Order::query()
            ->where('status', 'completed')
            ->orwhere('total', '>', 100)
            ->get();

        //Yêu cầu 7: Truy vấn với LIKE - Viết truy vấn để lấy các bản ghi từ bảng customers mà name chứa chuỗi 'John'.

        Customer::query()
            ->where('name', 'LIKE', '%John%')
            ->get();

        //Yêu cầu 8: Truy vấn với BETWEEN - Viết truy vấn để lấy các bản ghi từ bảng sales mà amount nằm trong khoảng từ 1000 đến 5000.
        Sale::query()
            ->whereBetween('amount', [1000, 5000])
            ->get();


        //Yêu cầu 9: Truy vấn với IN - Viết truy vấn để lấy các bản ghi từ bảng employees mà department_id nằm trong danh sách [1, 2, 3].
        Employee::query()
            ->whereIn('department_id', [1, 2, 3])
            ->get();

        //Yêu cầu 10: Thực hiện JOIN - Viết truy vấn để lấy thông tin từ bảng orders và bảng customers với điều kiện orders.customer_id = customers.id.
        Order::query()
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select('orders.*', 'customers.name as customer_name', 'customers.email as customer_email')
            ->get();

        //Yêu cầu 11: Truy vấn với nhóm và tổng hợp - Viết truy vấn để tính tổng số lượng quantity của mỗi sản phẩm từ bảng order_items, nhóm theo product_id.

        //Yêu cầu 12: Cập nhật bản ghi - Viết truy vấn để cập nhật status của tất cả các đơn hàng trong bảng orders thành 'shipped' nếu status hiện tại là 'processing'.
        Order::query()
            ->where('status', 'processing')
            ->update(['status' => 'shipped']);

        //Yêu cầu 13: Xóa bản ghi - Viết truy vấn để xóa tất cả các bản ghi từ bảng logs mà created_at trước ngày 1/1/2020.
        Logg::query()
            ->whereDate('created_at', '<', '2020-1-1')
            ->delete();


        //Yêu cầu 14: Thêm bản ghi mới - Viết truy vấn để thêm một bản ghi mới vào bảng products với các thông tin về tên sản phẩm, giá và số lượng.
        Product::query()
            ->insert([
                'name'      => 'Ten San Pham',
                'price'     => 'Gia San Pham',
                'quantity'  => 'So Luong San Pham',
            ]);


        //Yêu cầu 15: Sử dụng Raw Expressions - Viết truy vấn để lấy các bản ghi từ bảng users mà tháng sinh (birth_date) là tháng 5.


        return view('welcome', [
            'users' => $users
        ]);
    }
}
