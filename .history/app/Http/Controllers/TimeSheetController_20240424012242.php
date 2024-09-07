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
            $userScans = UserScan::all();
            if ($userScan->created_at){
            $userScan->created_at->format('d/m/Y H:i');
        else
            N/A;
            // return response()->json($userScans);
            return view('admin.timesheet',compact('userScans'));
        }
    }
?>
