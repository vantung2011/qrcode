<?php

    namespace App\Http\Controllers;

    use App\Models\UserScan;
    use Illuminate\Http\Request;
    use Illuminate\Pagination\Paginator;

    class TimeSheetController extends Controller
    {
        public function index(Request $request)
        {
            // lấy ra toàn bộ user
            Paginator::useBootstrapFive();
            $userScans = UserScan::paginate(5)->withQueryString();
            // return response()->json($userScans);
            return view('admin.timesheet',compact('userScans'));
        }
    }
?>
