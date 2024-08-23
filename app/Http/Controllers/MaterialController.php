<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialFormRequest;
use App\Models\Material;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $codigo = $request->input('codigo');
        $descricao = $request->input('descricao');
        if ($request->input('codigo') == null && $request->input('descricao') == null) {
            $material = Material::all();
        } else {
            $query = Material::query();

            if ($codigo) {
                $query->where('codigo', 'LIKE', "%$codigo%");
            }

            if ($descricao) {
                $query->where('descricao', 'LIKE', "%$descricao%");
            }
            $material = $query->get();
        }
        $mensagemSucesso = session('menssagem.sucesso');
        return view('dashboard')->with('materiais', $material)->with('codigo', $codigo)->with('descricao', $descricao)
        ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create(Request $request)
    {
        $material = new Material();
        return view('material.create')->with('material', $material);
    }

    public function store(MaterialFormRequest $request)
    {
        try {
            $request['status'] = $request->input('status', false);
            if ($request->input('status', false) == 'true') {
                $request['status'] = true;
            }
            Material::create($request->all());
            return to_route('material.index')->with('menssagem.sucesso', 'Material cadastrado com sucesso');
        } catch (QueryException $e) {
            $material = new Material();
            $material->fill($request->all());
            if ($e->errorInfo[0] == '23000') {
                return redirect()->back()
                    ->withErrors(['msg' => 'Material com esse código já foi adicionado.'])
                    ->with('material', $request->except('_token'));
            }
            return redirect()->back()->withErrors(['msg' => 'Erro desconhecido.'])->with('material', $request->except('_token'));;
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'An error occurred: ' . $e->getMessage()]);
        }

    }

    public function edit(Material $material)
    {
        session()->flash('material', $material);
        return view('material.edit')->with('material', $material);
    }

    public function update(Material $material, MaterialFormRequest $request)
    {
        $material->fill($request->all());
        
        $material->status = $request->input('status', false);
        if ($request->input('status', false) == 'true') {
            $material->status = true;
        }
        try {
            $material->save();
            return to_route('material.index')->with('menssagem.sucesso', 'Material alterado com sucesso');
        } catch (QueryException $e) {
            $material = new Material();
            $material->fill($request->all());
            if ($e->errorInfo[0] == '23000') {
                return redirect()->back()
                    ->withErrors(['msg' => 'Material com esse código já foi adicionado.'])
                    ->with('material', $request->except('_token'));
            }
            return redirect()->back()->withErrors(['msg' => 'Erro desconhecido.']);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        $material = Material::where('id', $request->id)->first();
        if ($request->status == "true") {
            return redirect()->back()->with('error', 'Não é possível excluir materiais que estão disponíveis em estoque.');
        }
        $material->destroy($request->id);
        return to_route('material.index')->with('menssagem.sucesso', 'Material excluído com sucesso');
    }
}
