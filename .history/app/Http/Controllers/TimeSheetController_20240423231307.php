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
            $users = UserScan::paginate(5)->withQueryString();
            if($request->search){
                $search = $request->search;
                $users = UserScan::where('name', 'like', "%$search%")->orWhere('email','like',"%$search%")->paginate(5)->withQueryString();
                if($users->count() >=1){
                    return view('admin.search',compact('users'))->render();
                }
                return view('admin.search',compact('users'))->with('searchError', 'Không tìm thấy kết quả nào!');
            }
            return view('admin.timesheet',compact('users'));
        }
    }
