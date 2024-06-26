<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function index()
    {
        return view('home.reporte');
    }

    public function reporte()
    {
        $reporte = DB::select("WITH RECURSIVE CategoriaConSubcategorias AS (
            SELECT id, nombre, stock, parent_id, 1 AS nivel
            FROM categorias
            WHERE parent_id IS NULL AND deleted_at IS NULL

            UNION ALL

            SELECT c.id, c.nombre, c.stock, c.parent_id, cs.nivel + 1
            FROM categorias c
            JOIN CategoriaConSubcategorias cs ON c.parent_id = cs.id
            WHERE deleted_at IS NULL
        )

        SELECT id, nombre, SUM(stock) AS stock_acumulado, nivel
        FROM CategoriaConSubcategorias
        GROUP BY id, nombre, nivel
        ORDER BY id;");

        return DataTables::of($reporte)->make(true);
    }
}
