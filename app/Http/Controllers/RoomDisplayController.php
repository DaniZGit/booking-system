<?php

namespace App\Http\Controllers;

use App\Repositories\RoomRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoomDisplayController extends Controller
{
    //
    public function index(RoomRepository $roomRepository): View
    {
        $rooms = $roomRepository->all();

        return view('site.rooms.index', ['rooms' => $rooms]);
    }

    public function show(string $slug, RoomRepository $roomRepository): View
    {
        $room = $roomRepository->forSlug($slug);
 
        if (!$room) {
            abort(404);
        }
 
        return view('site.rooms.show', ['room' => $room]);
    }
}
