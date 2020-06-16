<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('adminHome');
    }

    public function generate(Request $request, $count) {

        \App\User::whereIn('id', \App\Role::where('role_id', 3)->pluck('model_id'))->where('created_at', '<=', \Carbon\Carbon::now())->each(function ($item) {
            $item->delete();
        });

//        \App\Patient::where('created_at', '<=', \Carbon\Carbon::now())->each(function ($item) {
//            $item->delete();
//        });

        if ($count) {

            echo $count;

            $users = factory('App\User', (int)$count)->create()
                ->each(function ($user) {
                    $current_date = \Carbon\Carbon::now()->format('Y-m-d');
                    $current_day = \Carbon\Carbon::now()->format('d');
                    $last_day = 30;

                    while ($current_day < $last_day) {
                        factory('App\Worktime')->create([
                            'doctor_id' => $user->id,
                            'date'      => $current_date,
                            'start'     => \Carbon\Carbon::parse($current_date . ' 09:00:00')->format('Y-m-d H:i:s'),
                            'end'       => \Carbon\Carbon::parse($current_date . ' 11:00:00')->format('Y-m-d H:i:s'),

                        ]);
                        factory('App\Worktime')->create([
                            'doctor_id' => $user->id,
                            'date'      => $current_date,
                            'start'     => \Carbon\Carbon::parse($current_date . ' 12:00:00')->format('Y-m-d H:i:s'),
                            'end'       => \Carbon\Carbon::parse($current_date . ' 16:30:00')->format('Y-m-d H:i:s'),

                        ]);
                        factory('App\Worktime')->create([
                            'doctor_id' => $user->id,
                            'date'      => $current_date,
                            'start'     => \Carbon\Carbon::parse($current_date . ' 17:00:00')->format('Y-m-d H:i:s'),
                            'end'       => \Carbon\Carbon::parse($current_date . ' 17:30:00')->format('Y-m-d H:i:s'),

                        ]);
                        $current_date = \Carbon\Carbon::parse($current_date)->addDay()->format('Y-m-d');
                        $current_day++;
                    }
                });

            factory('App\Patient', 500)->create();

            echo 'Generated complete';
        } else {
            echo 'Not generated count';
        }
    }
}
