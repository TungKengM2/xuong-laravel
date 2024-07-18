<?php

use App\Http\Controllers\HomeController;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Route;





// Route::get('/', function() {
//     DB::table('employees', 'e')
//         ->select('e.first_name', 'e.last_name', 'd.department_name')
//         ->join('deparment d', 'd.departmnet_id', 'e.deparment_id')
//         ->where('e.hire_date', '<=', DB::raw('DATEDD(year, -3, GETDATE'))
// })

Route::get('/', function () {
    return views('client.index');
})

