<?php

namespace App\Modules\AdminBlackList\Http\Controllers;

use App\Blacklist;
use App\Http\Controllers\Controller;
use App\Patient;
use App\Traits\SaveTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ListController extends Controller
{
    use SaveTrait;

    private $form = [
        'comment' => ['nullable', 'string'],
        'patient_id' => ['required', 'unique' => 'black_list,patient_id']
    ];

    public function show()
    {
        return view('adminBlackList::show');
    }
    public function showTarifs()
    {
        return view('adminBlackList::tarif');
    }
    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->save(Blacklist::class);
            return response(['status' => 1, 'message' => 'Додано в чорний список!', 'redirect' => route('adminBlackList')]);
        }
    }

    public function delete(Request $request, $id)
    {
        Blacklist::findOrFail($id)->delete();

        return redirect()->route('adminBlackList');
    }

    public function getBlackListTable()
    {
        return DataTables::of(Blacklist::with('user')->get())->only(['id', 'name', 'comment', 'created_at', 'updated_at'])
            ->editColumn('name', function (Blacklist $item) {
                return $item->user->first_name . ' ' . $item->user->name . ' ' . $item->user->last_name;
            })->editColumn('comment', function (Blacklist $item) {
                return $item->comment ?? 'Не вказано!';
            })->editColumn('created_at', function (Blacklist $item) {
                return \Carbon\Carbon::parse($item->user->birthday)->format('d.m.Y');
            })->editColumn('updated_at', function (Blacklist $item) {
                return '<div class="d-flex align-items-center">
                            <a  href="' . route('editPatient', ['id' => $item->user->id]) . '" class="fa fa-pencil-square-o" style="font-size: 20px"></a>
                            <a  href="' . route('deleteBlackList', $item->id) . '" class="fa fa-arrow-circle-o-left ml-3" style="font-size: 20px;color: #4ecc48"></a>
                        </div>';
            })->rawColumns(['updated_at'])->toJson();
    }

    public function getUsersTable()
    {
        $blacklist = Blacklist::pluck('patient_id');

        return DataTables::of(Patient::whereNotIn('id', $blacklist)->get())->only(['id', 'name', 'created_at', 'updated_at'])
            ->editColumn('name', function (Patient $item) {
                return $item->first_name . ' ' . $item->name . ' ' . $item->last_name;
            })->editColumn('created_at', function (Patient $item) {
                return \Carbon\Carbon::parse($item->birthday)->format('d.m.Y');
            })
            ->editColumn('updated_at', function (Patient $item) {
                return '<div class="d-flex align-items-center">
                            <a  href="' . route('editPatient', $item->id) . '" class="fa fa-pencil-square-o" style="font-size: 20px"></a>
                            <a  href="#" data-id="' . $item->id . '" class="fa fa-arrow-circle-o-right ml-3" id="dle-clk" style="font-size: 20px;     color: #c21a1a;"></a>
                        </div>';
            })
            ->rawColumns(['updated_at'])->toJson();
    }
}
