<?php

namespace App\Http\Controllers;

use App\UserFile;
use Illuminate\Http\Request;

//use App\User_files;
use App\Http\Requests;
use App\Repositories\FileRepository;

class UserFilesController extends Controller
{
    /**
     * The file repository instance.
     *
     * @var FileRepository
     */
    protected $files;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FileRepository $files)
    {
        $this->middleware('auth');
        $this->files = $files;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('files.index', [
            'files' => $this->files->forUser($request->user()),
        ]);
    }

    /**
     * Create a new file.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->files()->create([
            'name' => $request->name,
            'hash' => hash('md5', rand()),
            'size' => 0,
            'user_id' => $request->user()->id,
        ]);

        return redirect('/files');
    }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  UserFile  $file
     * @return Response
     */
    public function destroy(Request $request, UserFile $file)
    {
        $this->authorize('destroy', $file);
        $file->delete();

        return redirect('/files');
    }
}
