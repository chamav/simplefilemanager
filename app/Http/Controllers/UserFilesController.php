<?php

namespace App\Http\Controllers;

use App\UserFile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\FileRepository;
use Storage;
use File;
use Illuminate\Http\Response;

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
        $file = $request->file('file');
        if ($request->hasFile('file') && $file->isValid()) {
            $hash = hash_file('md5', $file->getPathname());
            $size = $file->getSize();
            if(!Storage::disk('local')->exists($hash))
                Storage::disk('local')->put($hash, File::get($file));
                //$file->move('../storage/app', $hash);

            $request->user()->files()->create([
                'name' => $file->getClientOriginalName(),
                'hash' => $hash,
                'size' => $size,
                'user_id' => $request->user()->id,
            ]);
        }

        return redirect('/files');
    }

    /**
     * Destroy the given file.
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

     /**
      * Dowload file.
      *
      * @param  Request  $request
      * @param  UserFile  $file
      * @return Response
      */
    public function download(Request $request, UserFile $file)
    {
        $this->authorize('download', $file);
        if(!$file->trashed()){
            $content = Storage::disk('local')->get($file->hash);
            return response($content, 200)->header('Content-Disposition','attachment; filename="'.$file->name.'"');
            /*return response()->download('../storage/app/'.$file->hash, $file->name);*/
        }

    }
}
