<?php

namespace App\Http\Controllers;

use App\Models\Load;
use App\Models\Product;
use App\Models\LoadProduct;
use App\Models\Tacho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Exports\ReportLoadExport;


class LoadController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['homeLoad','addProduct','showAddProduct']]);
    }

    // public function test(){
    //     return view('elements.test');
    // }
    public function registerProduct($id){
        $load = Load::find($id);

        if($load){
            $products = LoadProduct::where('load_id',$id)->paginate(40);
            return view('elements.loads.register-product')->with('load',$load)->with('products',$products);
        }else{
            return redirect('/loads/index')->with('message-error','El cargue no fue encontrado');
        }
    }

    public function closeLoad(Request $request){
        $load = Load::find($request->load_id);
        $load->state = 'CLOSED';

        if($load->save()){
            return redirect('/loads/index')->with('message','El cargue ha sido cerrado existosamente!!');
        }
    }

    public function generatePDF($id){
        $load = Load::find($id);
        $products = LoadProduct::where('load_id',$id)->get();

        $suma = 0;
        foreach ($products as $product) {
            $suma += $product->product->amount;
        }

        $pdf = \PDF::loadView('elements.loads.pdf-loads', compact('products','load','suma'));
        return $pdf->download('report_cargue'.$id.'.pdf');

    }

    public function generateExcel($id){
        return \Excel::download(new ReportLoadExport($id), 'report_cargue'.$id.'.xlsx');
    }



    public function addProduct(Request $request){

        $load = Load::find($request->load_id);
        $product = Product::find($request->product_load_id);
        $tacho = Tacho::find($request->tacho_id);
        // dd($request);
        if (!$load || !$product || !$tacho) {
            // return redirect('/loads/index')->with('message-error','No puede agregar ese producto, por favor verifique la información');
            return back()->with('message-error','No puede agregar ese producto, por favor verifique la información');
        }
        DB::table('loads_products')->insert([
            'user_id'   => Auth::user()->id,
            'load_id'      => $request->load_id,
            'product_id'      => $request->product_load_id,
            'tacho_id'  => $request->tacho_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // return redirect('/loads/index')->with('message','El producto ha sido agregado existosamente!!');
        return back()->with('message','El producto ha sido agregado existosamente!!');
    }
    /**
     * Obtener todos los elementos y retornar la vista para su visualización
     * GET
     */
    public function showAddProduct()
    {
        // $product = Product::find($id);
        // $loads = Load::paginate(40)->sortByDesc('id');
        $loads = Load::paginate(40);
        // dd($loads);
        // $loads = Load::paginate(40);
        return view('elements.loads.add-product')->with('loads',$loads);
    }
    /**
     * Obtener todos los elementos y retornar la vista para su visualización
     * GET
     */
    public function index()
    {
        return view('elements.loads.home-load');
    }

    /**
     * Obtener todos los elementos y retornar la vista para su visualización
     * GET
     */
    public function indexLoad()
    {
        // $loads = Load::paginate(40)->sortByDesc('id');
        $loads = Load::paginate(40);
        // dd($loads);
        // $loads = Load::paginate(40);
        return view('elements.loads.index')->with('loads',$loads);
    }

    /**
     * Retornar la vista con el formulario para la creación del elemento con los registros que requiera
     * GET
     */
    public function create()
    {
        if(Auth::user()->role->name != 'Admin' && Auth::user()->role->name != 'Operator'){
            return redirect('home')->with('error','No puede acceder a este recurso');
       }
        $roles = Role::all();
        return view('elements.loads.create')->with('roles',$roles);

    }

    /**
     * Recibir solicitud del formulario de creación del elemento y creación del registro
     * POST
     */
    public function store(Request $request)
    {
        if(Auth::user()->role->name != 'Admin' && Auth::user()->role->name != 'Operator'){
            return redirect('home')->with('error','No puede acceder a este recurso');
       }
        $load = new Load;

        $load->state = 'OPEN';
        $date = Carbon::now();
        $load->date = $date->toDateString();
        $load->hour = $date->toTimeString();
        $load->user_id = Auth::user()->id;

        if($load->save()){
            return redirect('/loads/index')->with('message','El cargue ha sido creado existosamente!!');
        }


    }

    /**
     * Retornar la vista para visualizar un elemento
     * GET
     */
    public function show(string $id)
    {

        if(Auth::user()->role->name != 'Admin' && Auth::user()->role->name != 'Operator'){
            return redirect('home')->with('error','No puede acceder a este recurso');
       }
       $load = Load::find($id);
        $products = LoadProduct::where('load_id',$id)->paginate(40);
        return view('elements.loads.show')->with('products',$products)->with('load',$load);
    }

    /**
     * Retornar la vista para editar un elemento en especifico
     * GET
     */
    public function edit(string $id)
    {
        if(Auth::user()->role->name != 'Admin' && Auth::user()->role->name != 'Operator'){
            return redirect('home')->with('error','No puede acceder a este recurso');
       }
        $load = Load::find($id);
        $roles = Role::all();
        return view('elements.loads.edit')->with('user',$load)->with('roles',$roles);
    }

    /**
     * Recibe la solicitud de actualización de un elemento y actualiza el registro
     * PUT
     */
    public function update(Request $request, string $id)
    {
        if(Auth::user()->role->name != 'Admin' && Auth::user()->role->name != 'Operator'){
            return redirect('home')->with('error','No puede acceder a este recurso');
       }
        $load = Load::find($id);

        $load->fullname = $request->fullname;
        $load->email = $request->email;
        $load->password = bcrypt($request->password);
        $load->role_id = $request->role_id;

        if($load->save()){
            return redirect('/loads/index')->with('message','El usuario: '.$load->fullname.' ha sido actualizado existosamente!!');
        }
    }

    /**
     * Eliminar un registro
     * DELETE
     */
    public function destroy(Load $load)
    {
        if(Auth::user()->role->name != 'Admin' && Auth::user()->role->name != 'Operator'){
            return redirect('home')->with('error','No puede acceder a este recurso');
       }

        if($load->delete()){
            return redirect('/loads/index')->with('message','El cargue ha sido eliminado existosamente!!');
        }

    }

    /**
     * Eliminar un registro
     * DELETE
     */
    public function deleteProductLoad($id)
    {
        $product = LoadProduct::find($id);
        if(Auth::user()->role->name != 'Admin' && Auth::user()->role->name != 'Operator'){
            return redirect('home')->with('error','No puede acceder a este recurso');
        }


        if($product->delete()){
            return back()->with('message','El producto: '.$product->product->material.' ha sido eliminado del cargue existosamente!!');
        }

    }
}
