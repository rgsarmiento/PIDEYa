<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\Poduct;
use App\Models\Customer;
use App\Models\Company_has_user;
use stdClass;

class DocumentController extends Controller
{
    function __construct()
    {
        /**$this->middleware('permission:documents.index', ['only' => ['index', 'show']]);
        $this->middleware('permission:documents.crear', ['only' => ['create', 'store']]);
        $this->middleware('permission:documents.editar', ['only' => ['edit', 'update']]);
        $this->middleware('permission:documents.eliminar', ['only' => ['destroy']]); */
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $role_user = auth()->user()->roles->first()->id;
        $company_id = 0;
        
        if ($role_user <> 1) {
            $user_id = $user->id;
            
            $company_has_user = Company_has_user::where('user_id', $user_id)->first();

            if ($company_has_user == null) {
                Auth::logout();
                return redirect('/');
            } else {
                $company_id = $company_has_user->company_id;
            }
        }

        $documents = Document::where('user_id', $user_id)->orderBy('updated_at', 'desc');
        
        $nRegistros = count($documents->get());

        $documents = $documents->paginate(10);
        
        return view('documents.index', compact('documents', 'nRegistros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $role_user = auth()->user()->roles->first()->id;
        $company_id = 0;

        if ($role_user <> 1) {
            $user_id = $user->id;
            $company_has_user = Company_has_user::where('user_id', $user_id)->first();

            if ($company_has_user == null) {
                Auth::logout();
                return redirect('/');
            } else {
                $company_id = $company_has_user->company_id;
            }
        }

        $products_document = new stdClass();
        $products_document->products = array();        

        //return dd($products_document);

        //$products = Poduct::select('code', DB::raw('CONCAT(code, " - ", description, " P(", price, ")", " C(", base_quantity, ")") AS name'))->where('company_id', $company_id)->orderBy('name', 'asc')->get();
        $products = Poduct::select('code', DB::raw('CONCAT(code, " - ", description, " P(", price, ")", " C(", base_quantity, ")") AS name'))->where('company_id', $company_id)->orderBy('name', 'asc')->get();
        $customers = Customer::select('id', DB::raw('CONCAT(identification_number, " - ", name) AS name'))->where('company_id', $company_id)->orderBy('name', 'asc')->get();
        return view('documents.crear', compact('products', 'customers', 'products_document'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentRequest $request)
    {

        $user = auth()->user();
        $role_user = auth()->user()->roles->first()->id;
        $company_id = 0;

        if ($role_user <> 1) {
            $user_id = $user->id;
            $company_has_user = Company_has_user::where('user_id', $user_id)->first();

            if ($company_has_user == null) {
                Auth::logout();
                return redirect('/');
            } else {
                $company_id = $company_has_user->company_id;
            }
        }

        $fechaHora = Carbon::now();
        $data = $request->all();
       
       $documento = new Document();
       $documento->company_id = $company_id;
       $documento->user_id = $user_id;
       $documento->date_issue = $fechaHora->format('Y-m-d');
       $documento->customer_id = $data['customer_id'];
       $documento->products = $data['products'];
       $documento->total = $data['total'];

       $documento->save();

       return redirect()->route('documents.index')->with('message', 'La orden de pedido para se creo con éxito');;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$documents = Document::where('company_id', $id)->orderBy('updated_at', 'desc')->first();
        
        $documents = Document::select('documents.id', 'customers.identification_number','customers.name','documents.products','documents.total','users.name as seller')
        ->join('customers', 'documents.customer_id', '=', 'customers.id')
        ->join('users', 'documents.user_id', '=', 'users.id')->where('documents.company_id', $id)->get();

        return ['data' => $documents];

        /**return [
            'success' => true,
            'message' => 'creada/actualizada con éxito',
            'documents' => $documents->collection,
        ];*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentRequest  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Document::where('id', $id)->delete();
    }
}
