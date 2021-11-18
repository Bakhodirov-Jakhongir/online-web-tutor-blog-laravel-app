<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                return $btn;
            })->rawColumns(['action'])->make(true);
        }
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function user_collection()
    {
        $userCollection = collect([
            [
                'id' => 1,
                'name' => 'User 1',
                'email' => 'user1@gmail.com'
            ],
            [
                'id' => 2,
                'name' => 'User 2',
                'email' => 'user2@gmail.com'
            ],
            [
                'id' => 3,
                'name' => 'User 3',
                'email' => 'user3@gmail.com'
            ],
            [
                'id' => 4,
                'name' => 'User 4',
                'email' => 'user4@gmail.com'
            ]
        ]);

        $first = $userCollection->first();

        $last = $userCollection->last();

        $userCollection->reverse();

        return response()->json([
            'status' => true,
            'data' => [
                'collection' => $userCollection,
                'first' => $first,
                'last' => $last
            ]
        ], 200);
    }
}
