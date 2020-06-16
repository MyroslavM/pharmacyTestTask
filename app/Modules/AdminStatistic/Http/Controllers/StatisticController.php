<?php

namespace App\Modules\AdminStatistic\Http\Controllers;

use App\Diagnosis;
use App\Http\Controllers\Controller;
use App\Patient;
use App\Visit;

class StatisticController extends Controller
{
    public function show()
    {


        $patients = Patient::get()->groupBy(function ($qwe) {
            return \Carbon\Carbon::parse($qwe->birthday)->format('Y');
        });

        $birthday = [[], []];
        foreach ($patients as $key => $items) {
            array_push($birthday[0], $key);
            array_push($birthday[1], $items->count());
        }

        $birthday_array = array_combine($birthday[0], $birthday[1]);


        $doctors = Visit::with('doctor')->get()->groupBy('doctor_id');

        $visits = [[], []];
        foreach ($doctors as $key => $items) {
            array_push($visits[0], $items[0]->doctor->surname . ' ' . $items[0]->doctor->name . ' ' . $items[0]->doctor->patronymic);
            array_push($visits[1], $items->count());
        }
        $doctors_array = array_combine($visits[0], $visits[1]);


        $patients = Diagnosis::all()->groupBy('disease_id');

        $diagnosis = [[], []];
        foreach ($patients as $key => $items) {
            array_push($diagnosis[0], $items[0]->disease->name ?? 'Поле порожнє');
            array_push($diagnosis[1], $items->count());
        }
        $diagnosis_array = array_combine($diagnosis[0], $diagnosis[1]);


        $patients_wheres = Patient::with('where_my')->get()->groupBy('where_id');

        $wheres = [[], []];
        foreach ($patients_wheres as $key => $items) {
            array_push($wheres[0], $items[0]->where_my->name ?? 'Поле порожнє');
            array_push($wheres[1], $items->count());
        }
        $where_array = array_combine($wheres[0], $wheres[1]);


//        $patients_service = Visit::with('service')->get()->groupBy('services_id');
//
////        dd($patients_service);
//
//        $services = [[], []];
//        foreach ($patients_service as $key => $items) {
//            array_push($services[0], $items[0]->service->name);
//            array_push($services[1], $items->count());
//        }
//                dd($services[0],$services[1]);
//
//        $service_array = array_combine($services[0], $services[1]);
//


        $services = Visit::with('service')->get()->groupBy('service_id');
        $service = [[], []];
        foreach ($services as $key => $items) {
            array_push($service[0], $items[0]->service->name);
            array_push($service[1], $items->count());
        }
        $service_array = array_combine($service[0], $service[1]);



        return view('adminStatistic::show', ['birthday_array' => $birthday_array, 'doctors_array' => $doctors_array, 'diagnosis_array' => $diagnosis_array, 'where_array' => $where_array, 'service_array' => $service_array]);


    }
}
