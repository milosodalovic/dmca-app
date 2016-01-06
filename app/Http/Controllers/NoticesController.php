<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrepareNoticeRequest;
use App\Provider;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NoticesController extends Controller
{
    /**
     *Create a new NoticesController's instance
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all notices
     * @return string
     */
    public function index()
    {
        return 'all notices';
    }

    /**
     * Create a new notice
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $providers = Provider::lists('name', 'id');
        return view('notices/create', compact('providers'));
    }

    public function confirm(PrepareNoticeRequest $request)
    {
        $template = $this->compileDmcaTemplate($data=$request->all());
        session()->flash('dmca', $data);
        return view('notices/confirm', compact('template'));
    }

    public function store()
    {
        $data = session()->get('dmca');

        return \Request::input('template');
    }
    /**
     * Compile DMCA template
     * @param PrepareNoticeRequest $request
     * @return \Illuminate\Contracts\View\View
     */
    public function compileDmcaTemplate($data)
    {
        $data = $data + [
                'name' => \Auth::user()->name,
                'email' => \Auth::user()->email
            ];
        $template = view()->file(app_path('Http/Templates/dmca.blade.php'), $data);
        return $template;
    }

}
