<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if(auth()->user()){

            switch (auth()->user()->roles) {
                
                case 'magazin':
                
                    return redirect()->route('magazin.index');
                    break;
                

                case 'admin' :
                        return redirect('/admin/users');
                        break;
                            
                default:
                    return redirect()->route('visiteur.index');
                    break;
            }
        }
        else{
            return redirect()->route('visiteur.index');
        }
    }
}
