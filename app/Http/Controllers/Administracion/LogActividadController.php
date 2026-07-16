<?php

namespace App\Http\Controllers\Administracion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administracion\LogActividad;

class LogActividadController extends Controller
{
     public function index()
    {
        $logs = LogActividad::latest()

            ->paginate(10);

        return view(

            'administracion.logs.index',
            compact('logs')

        );
    }
}
