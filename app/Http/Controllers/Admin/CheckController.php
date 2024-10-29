<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Endpoint;;

use Illuminate\Support\Facades\Gate;

class CheckController extends Controller
{
    public function index(Endpoint $endpoint)
    {
        if (Gate::denies('ownerChecks', $endpoint)) {
            return back();
        }

        $checks = $endpoint->checks()->paginate();

        return view('admin.endpoints.logs.index', compact('endpoint', 'checks'));
    }
}
