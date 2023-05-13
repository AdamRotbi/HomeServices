<?php
    
namespace App\Http\Controllers;
    
use App\Models\Teams;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
    
class TeamsController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:teams-list|teams-create|teams-edit|teams-delete', ['only' => ['index','show']]);
         $this->middleware('permission:teams-create', ['only' => ['create','store']]);
         $this->middleware('permission:teams-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:teams-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $teams = Teams::latest()->paginate(5);
        return view('teams.index',compact('teams'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('teams.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'name' => 'required',
            'members' => 'required',
        ]);
    
        Teams::create($request->all());
    
        return redirect()->route('teams.index')
                        ->with('success','teams created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function show(Teams $teams): View
    {
        return view('teams.show',compact('teams'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function edit(Teams $teams): View
    {
        return view('teams.edit',compact('teams'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teams $teams): RedirectResponse
    {
         request()->validate([
            'name' => 'required',
            'members' => 'required',
        ]);
    
        $teams->update($request->all());
    
        return redirect()->route('teams.index')
                        ->with('success','teams updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teams $teams): RedirectResponse
    {
        $teams->delete();
    
        return redirect()->route('teams.index')
                        ->with('success','teams deleted successfully');
    }
}
?>