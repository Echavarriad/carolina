<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;

use App\Http\Requests\RegisterRequest;

use App\Library\Tool;

use App\Mail\Register;

use App\Mail\Welcome;

use App\Models\Ad;

use App\Models\City;

use App\Models\Department;

use App\Models\Sector;

use App\Models\User;

use Auth;

use Carbon\Carbon;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Mail;



class RegisterController extends Controller {



    public function create_account() {
        if (\Auth::check()) {
            return redirect()->route('account_home');
        }

        $departments = Department::ordered()->get();
        $sectors = Sector::ordered()->get();

        return view('auth.create_account', compact('departments', 'sectors'));

    }



    public function cities() {



        if (!request()->ajax()) {

            return redirect('/');

        }



        $department = request()->get('department');

        $cities = City::where('department_id', $department)->ordered()->pluck('id', 'name');



        $view = view('ajax.cities', compact('cities'));

        $content = $view->render();



        return response()->json(['content' => $content]);

    }



    public function cities_slug() {



        if (!request()->ajax()) {

            return redirect('/');

        }



        $slug = request()->get('department');



        $department = Department::where('slug', $slug)->first();



        $cities = City::where('department_id', $department->id)->ordered()->pluck('slug', 'name');



        $view = view('ajax.cities', compact('cities'));

        $content = $view->render();



        return response()->json(['content' => $content]);

    }



    //Guardar registro

    public function register(RegisterRequest $request) {
        $data = $request->all();
        DB::beginTransaction();
        try {
            $user = new User;
            $user->fill($data);
            //Establece los créditos iniciales configurados
            $user->credits = (int) config('settings.initial_credits');

            //Notificaciones por defecto

            $user->notifications = config('notifications');
            $user->status = 1;
            $user->save();
            $data['price'] = Tool::escapePrice($data['price']);
            $data['percent'] = Tool::escapePercent($data['percent']);
            $now = Carbon::now();

            //Obtenemos la fecha en que caducará el anuncio en días
            $monthsExpiration = (int) config('settings.ad_expiration_months');
            $dateExpiration = $now->addMonths($monthsExpiration)->toDateTimeString();

            //Validar que no tenga algun correo o teléfono

            $data['description_short'] = Tool::escapeInfo($request->description_short);
            $slug = str_slug($request->name_company);
            $count = Ad::where('slug', $slug)->count();

            if ($count > 0) {

                $slug .= ($count + 1);

            }

            $ad = new Ad;

            $ad->fill($data);

            $ad->user_id = $user->id;

            $ad->date_end = $dateExpiration;

            $ad->status = 0;

            $ad->slug = $slug;

            $ad->save();

            $data['ad'] = $ad;

        } catch (Exception $e) {

            return response()->json(['status' => 0, 'message' => 'Ocurrió un error enviando la información']);

        }
        DB::commit();

        Mail::to($data['email'])->send(new Welcome($data));
        Auth::loginUsingId($user->id);
        session(['edit_ad' => $ad->id]);

        return response()->json(['status' => 1, 'redirect' => route('created_account')]);

    }



}

