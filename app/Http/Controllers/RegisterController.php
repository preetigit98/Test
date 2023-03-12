<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use QrCode;
use Auth;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

/* This controller will register the data into user table
 * 
 * */

class RegisterController extends Controller
{
    

    public function index(Request $request ,Builder $builder)
    {

        if ($request->ajax()) {
            $data = User::select('id','name','lastname','email','profile')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                
                ->editColumn('profile', function(User $user) {
                    return '<img  height="100px"   src='.asset('public/profile/').'/'.$user->profile.'>';
                })
                ->rawColumns(['profile'])
                ->make(true);
        }
     
        return view('register');
      
    }

    public function RegisterUser(Request $req)
    {
        return view('Register');
    
    }

    public function checkemailexits(Request $req)
    {
       $email = $req->email;
       if (User::where('email', '=',$email)->exists()) {
            return $response = array('status'=>'failed','message'=>'Email Already in used');
        } 
        return $response = array('status'=>'success','message'=>'');
    }

    public function Registerstore(Request $req)
    {
        $recordsData = array('name'=>$req->name,'lastname'=>$req->lastname,'email'=>$req->email,'password'=>Hash::make(rand(1,100)));
        $data =  User::insert($recordsData);
        return $response = array('status'=>'success','message'=>'Record Insert Successfully');
    }

    public function Scanqrcode(Request $req)
    {
        return view('Scanqrcode');
    
    }

    public function login(Request $req)
    {
        return view('login');
    }

    public function loginpost(Request $req)
    {
       
        $email = $req->email;
        try{
            $user =  User::where('email', '=',$email)->firstOrFail(); 
            
            Auth::login($user);

            $qrcoderedirectUrl = URL('/').'/getdetails/'.$user->id;

            $qrcodename = time().'.png';
            $path = storage_path('app/public/qrcode/'.$qrcodename);

            $qrcodepath = asset('public/qrcode/'.$qrcodename);

            $image = QrCode::
            format('png')
            // ->merge(public_path('images/1644463030.png'), 0.5, true)
            ->size(500)
            ->errorCorrection('H')
            ->generate($qrcoderedirectUrl ,$path);
            return $response = array('status'=>'success','message'=>'Record found','dataimage'=>$qrcodepath);
        }
        // catch(Exception $e) catch any exception
        catch(ModelNotFoundException $e){
            return $response = array('status'=>'failed','message'=>'No Records Found');
        }


    }

    public function getdetails($id)
    {
        $data['heading'] = 'User Details';
        $data['userdata'] = User::find($id);
        return view('Details',$data);
    }
    public function editDetails(Request $req)
    {
        $user = User::find($req->id);
        $user->name = $req->name;
        $user->lastname = $req->lastname;
        $user->save();
        return $response = array('status'=>'success','message'=>'Record Update Successfully');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
      }

}
