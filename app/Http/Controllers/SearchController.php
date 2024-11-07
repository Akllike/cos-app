<?php

namespace App\Http\Controllers;

use App\Models\Gel;
use App\Models\Muse;
use App\Models\Scrab;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $muses = Muse::where('name', 'like', '%' . $request->input('name') . '%')->get();
        $gels = Gel::where('name', 'like', '%' . $request->input('name') . '%')->get();
        $scrabs = Scrab::where('name', 'like', '%' . $request->input('name') . '%')->get();

        $title = 'Результаты поиска - ' . $request->input('name') . ' | ShaR';

        return view('search', compact('muses', 'gels', 'scrabs', 'title'));
    }

    public function viewSearch(): View
    {
        return view('search');
    }
}
