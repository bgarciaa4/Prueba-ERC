<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categorias::all();

        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");

        $categoriasTable = Categorias::select(
            'categorias.id',
            'categorias.nombre',
            'categorias.stock',
            DB::raw('CASE WHEN subcategorias.id IS NULL THEN 1 ELSE 0 END AS flag_editar')
        )
        ->whereNull('categorias.deleted_at')
        ->leftJoin('categorias AS subcategorias', function ($join) {
            $join->on('categorias.id', '=', 'subcategorias.parent_id');
        })
        ->groupBy('categorias.id', 'categorias.nombre', 'categorias.stock')
        ->get();

        return view('home.index', compact('categorias', 'categoriasTable'));
    }

    public function store(Request $request)
    {
        $categoria = new Categorias();
        $categoria->nombre = $request->subcategoria;
        $categoria->descripcion = $request->descripcion;
        $categoria->stock = $request->stock;
        $categoria->parent_id = $request->categoria;
        $save = $categoria->save();

        if($save)
        {
            $this->updateParentStock($categoria);

            return 'success';
        }
    }

    public function editar(Request $request, Categorias $categoria)
    {
        $producto = Categorias::where('id','=', $request->id)->first();
        $categorias = Categorias::all();

        return view('home.editar', compact('categorias', 'producto'));
    }

    public function actualizar(Request $request)
    {
        $categoria = Categorias::where('id', $request->id)->first();
        $categoria->stock = $request->stock;
        $save = $categoria->save();

        if($save)
        {
            $this->updateParentStock($categoria);

            return redirect()->action([CategoriasController::class, 'index']);
        }
    }

    public function eliminar(Request $request)
    {
        $categoria = Categorias::find($request->id);
        $categoria->delete();

        $this->updateParentStock($categoria);

        return redirect()->action([CategoriasController::class, 'index']);
    }

    private function updateParentStock(Categorias $categoria)
    {
        while ($categoria->parent) {
            $categoria = $categoria->parent;
            $categoria->stock = $categoria->children()->sum('stock');
            $categoria->save();
        }
    }
}
