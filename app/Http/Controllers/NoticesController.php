<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrepareNoticeRequest;
use App\Notice;
use App\Provider;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        return Auth::user()->notices;
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

    public function store(Request $request)
    {
        $notice = $this->createNotice($request);

        //And then fire off the email
        Mail::queue('emails.dmca', compact('notice'), function($message) use ($notice) {
            $message->from($notice->getOwnerEmail())
                    ->to($notice->getRecipientEmail())
                    ->subject('DMCA Notice');
        });
        return redirect('notices');
    }
    /**
     * Compile DMCA template
     * @param PrepareNoticeRequest $request
     * @return \Illuminate\Contracts\View\View
     */
    public function compileDmcaTemplate($data)
    {
        $data = $data + [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email
            ];
        $template = view()->file(app_path('Http/Templates/dmca.blade.php'), $data);
        return $template;
    }

    /**
     * @param Request $request
     * @return \App\Notice
     */
    public function createNotice(Request $request)
    {
        $notice = session()->get('dmca') + ['template' => $request->input('template') ];
        $notice = Auth::user()->notices()->create($notice);

        return $notice;
    }

}
