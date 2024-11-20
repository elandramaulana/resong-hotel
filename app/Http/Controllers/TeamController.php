<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function team_presentions():View {
        $Divisions = Auth::user()->getActiveDivision();
        $divisionName = $Divisions->d_nama ?? false;
        $divisionID = $Divisions->id ?? false;
        $isApproval = Auth::user()->isUserApproval();
        if(!$isApproval){
            throw new AuthorizationException('You do not have permission to perform this action.');
        }

        return view('team_management.team_presensi', compact('divisionID', 'Divisions'));
    }
}
