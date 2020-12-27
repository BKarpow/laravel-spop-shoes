<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStatusRequest;
use App\Models\OrderStatus;
use App\Traits\TextToolTrait;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    use TextToolTrait;

    function index()
    {
//        dd(OrderStatus::paginate(env('PER_PAGE'))->count());
        return view('admin.pages.status.index', [
            'data' => OrderStatus::paginate(env('PER_PAGE'))
        ]);
    }

    function create()
    {
        return view('admin.pages.status.create');
    }

    function create_action(CreateStatusRequest $request)
    {
        $status = new OrderStatus();
        $status->title = $request->input('title');
        $status->alias = $this->getAliasFromString( $request->input('title'));
        $status->color = $request->input('color');
        $status->description = $request->input('description');
        $status->save();
        return redirect()
            ->route('statuses')
            ->with('status', 'Статус створено!');
    }

    function update($status_id)
    {

        return view('admin.pages.status.update', [
            'item' => OrderStatus::find((int)$status_id)->first()
        ]);
    }

    function update_action(CreateStatusRequest $request)
    {
        $status = OrderStatus::find((int)$request->input('status_id', 0))
            ->first();
        $status->title = $request->input('title');
        $status->alias = $this->getAliasFromString( $request->input('title'));
        $status->color = $request->input('color');
        $status->description = $request->input('description', '');
        $status->save();
        return redirect()
            ->route('statuses')
            ->with('status', 'Статус оновлено!');
    }

    function delete($status_id)
    {
        OrderStatus::find((int)$status_id)
            ->delete();
        return redirect()
            ->route('statuses')
            ->with('status', 'Статус видалено!');
    }
}
