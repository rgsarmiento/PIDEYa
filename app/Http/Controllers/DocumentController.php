<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Poduct;
use App\Models\Customer;
use stdClass;

class DocumentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:documents.index', ['only' => ['index', 'show']]);
        $this->middleware('permission:documents.crear', ['only' => ['create', 'store']]);
        $this->middleware('permission:documents.editar', ['only' => ['edit', 'update']]);
        $this->middleware('permission:documents.eliminar', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_id = 1;

        $documents = Document::where('company_id', $company_id)->orderBy('updated_at', 'desc');
        
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
        $company_id = 1;

        $products_document = new stdClass();
        $products_document->products = array();        

        //return dd($products_document);

        //$products = Poduct::select('code', DB::raw('CONCAT(code, " - ", description, " P(", price, ")", " C(", base_quantity, ")") AS name'))->where('company_id', $company_id)->orderBy('name', 'asc')->get();
        $products = Poduct::select('code', DB::raw('CONCAT(code, " - ", description, " P(", price, ")") AS name'))->where('company_id', $company_id)->orderBy('name', 'asc')->get();
        $customers = Customer::select('id', DB::raw('CONCAT(id, " - ", name) AS name'))->where('company_id', $company_id)->orderBy('name', 'asc')->get();
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

        $fechaHora = Carbon::now();
        $data = $request->all();
       
       $documento = new Document();
       $documento->company_id = 1;
       $documento->user_id = 1;
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
    public function show(Document $document)
    {
        //
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
    public function destroy(Document $document)
    {
        //
    }
}
