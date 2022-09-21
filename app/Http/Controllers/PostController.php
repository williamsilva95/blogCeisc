<?php

namespace App\Http\Controllers;

use App\Exports\PostsExport;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use http\Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{
    function __construct()
    {
        // obriga estar logado;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $post = Post::getAllForIndex();

        $result = $post->paginate('6');

        return view('post.index', compact('result'));
    }

    public function create()
    {
        return view('post.form');
    }

    public function store(Request $request)
    {
        try {
            $result = DB::transaction(function () use ($request){

                $id = $request->input('id');

                $post = Post::find($id);

                if (!$post){
                    $post = new Post();
                }

                $validate = validator($request->all(), $post->rules(), $post->mensages);

                if($validate->fails()){
                    return back()->withErrors($validate);
                }

                if($request->hasFile('imagem')){
                    // Get filename with the extension
                    $filenameWithExt = $request->file('imagem')->getClientOriginalName();
                    // Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just ext
                    $extension = $request->file('imagem')->getClientOriginalExtension();
                    // Filename to store
                    $fileNameToStore= $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    $path = $request->file('imagem')->storeAs('public', $fileNameToStore);

                    if($extension != 'jpg' && $extension != 'png' && $extension != 'gif'){
                        return back()->with('erro', 'Este arquivo não é uma imagem');
                    }
                }

                $post->fill($request->all());
                $post->titulo = $request->input('titulo');
                $post->descricao = $request->input('descricao');
                $post->imagem = $fileNameToStore;
                $post->user_id = Auth::user()->id;

                $save = $post->save();

                if($save) {
                    toast('Postagem salva com sucesso.','success');
                    return redirect('/post');
                }else{
                    toast('Erro ao salvar postagem.','warning');
                    return back();
                }
            });

            DB::commit();
            return $result;
        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function edit(Post $post)
    {
        return view('post.form', compact('post'));
    }

    public function show($id)
    {
       $post = Post::all()->first();

        if(Cache::has($id) == false)
        {
            Cache::add($id, 'contador', 0.30);
            $post->total_visualizacao+=1;
            $post->save();
        }

        return view('post.view', compact('post'));
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->input('id');

            $delete = DB::table('posts')->where('id', $id)->delete();

            if ($delete){
                return response()->json(['success' => true, 'msg'=> 'Postagem excluída com sucesso.']);
            } else {
                return response()->json(['success' => false, 'msg' => 'Erro ao excluir Postagem.']);
            }
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function pesquisar(Request $request){

        if($request->input('texto') == false){
            return redirect('/');
        }
        $post = Post::leftJoin('users','users.id','=','posts.user_id')
            ->where('titulo','like','%'.$request->input('texto').'%')
            ->orWhere('name','like','%'.$request->input('texto').'%')->get();

        return view('pesquisa',compact('post'));
    }

    public function adicionarGostei($id)
    {
        $post = Post::find($id);

        if(Cache::has('Voto '.$id) == false)
        {
            Cache::add('Voto'. $id. 'contador', 0.30);
            $post->total_gostei+=1;
            $post->save();

            Alert::success('Gostei!');
            return back();
        }else{
            return back();
        }
    }

    public function adicionarNaoGostei($id)
    {
        $post = Post::find($id);

        if(Cache::has('Voto '.$id) == false)
        {
            Cache::add('Voto'. $id. 'contador', 0.30);
            $post->total_naogostei+=1;
            $post->save();

            Alert::error('Não Gostei!');
            return back();
        }else{
            return back();
        }
    }

    public function exportar(Request $request)
    {
        try {
            return $this->exportarExcel($request->all());
        } catch(\Exception $exception) {
            toast('Erro ao exportar planilha.','error');
            return back();
        }
    }

    public function exportarExcel()
    {
        // Obtem consulta
        $post = $this->gerarConsultaExportacao()->get();

        // Retorna o resultado da consulta da planilha
        return Excel::download(new PostsExport($post), 'posts.xlsx');
    }

    public function gerarConsultaExportacao()
    {
        $query = Post::query()
            ->leftJoin('users','users.id','=','posts.user_id')
            ->select([
                'posts.id',
                'posts.titulo',
                'posts.descricao',
                'posts.imagem',
                'posts.total_gostei',
                'posts.total_naogostei',
                'posts.total_visualizacao',
                'posts.created_at',
                'users.name',
            ]);

        return $query;
    }

}
