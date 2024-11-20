<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use Carbon\Carbon;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Label\Font\OpenSans;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;


class ProductController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    /**
     * Obtener todos los elementos y retornar la vista para su visualización
     * GET
     */
    public function index()
    {
       if(Auth::user()->role->name != 'Admin' && Auth::user()->role->name != 'Operator'){
            return redirect('home')->with('error','No puede acceder a este recurso');
       }
        // $products = User::all();
        $products = Product::paginate(40);
        foreach ($products as $product) {
            Carbon::setLocale('es');
            $date = Carbon::parse($product->date_of_manufacture);
            $date = $date->format('d-M-Y');
            $product->date_of_manufacture = $date;

            $date = Carbon::parse($product->expiration_date);
            $date = $date->format('d-M-Y');
            $product->expiration_date = $date;


        }
        return view('elements.products.index')->with('products',$products);
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

        return view('elements.products.create');

    }

    /**
     * Recibir solicitud del formulario de creación del elemento y creación del registro
     * POST
     */
    public function store(ProductRequest $request)
    {
        if(Auth::user()->role->name != 'Admin' && Auth::user()->role->name != 'Operator'){
            return redirect('home')->with('error','No puede acceder a este recurso');
       }
        $product = new Product;

        $product->material = $request->material;
        $product->reference = $request->reference;
        $product->lote = $request->lote;

        $product->date_of_manufacture = $request->date_of_manufacture;
        $product->expiration_date = $request->expiration_date;
        $product->amount = $request->amount;
        $product->lote_provider = $request->lote_provider;
        $product->responsible = $request->responsible;
        $product->user_id = Auth::user()->id;

        if($product->save()){

            // $data = 'http://192.168.10.18/CarguesAlpina/public/loads/product/'.$product->id;
            // $data = '{id:'.$product->id.
            //         ',material:'.$product->material.
            //         ',reference:'.$product->reference.
            //         ',lote:'.$product->lote.
            //         ',date_of_manufacture:'.'"'.$product->date_of_manufacture.'"'.
            //         ',expiration_date:'.'"'.$product->expiration_date.'"'.
            //         ',amount:'.$product->amount.
            //         ',lote_provider:'.$product->lote_provider.
            //         ',responsible:'.$product->responsible.
            //         ',user_id:'.$product->user_id.'}';

            // $data = '{"id":"'.$product->id.
            //         '","material":"'.$product->material.
            //         '","reference":"'.$product->reference.
            //         '","lote":"'.$product->lote.
            //         '","user_id":"'.$product->user_id.'"}';

            $data = '{"id":"'.$product->id.
                    '","reference":"'.$product->reference.
                    '","lote":"'.$product->lote.'"}';

            // Create QR code
            $builder = new Builder(
                writer: new PngWriter(),
                writerOptions: [],
                validateResult: false,
                data: $data,
                encoding: new Encoding('UTF-8'),
                errorCorrectionLevel: ErrorCorrectionLevel::High,
                size: 400,
                margin: 10,
                roundBlockSizeMode: RoundBlockSizeMode::Margin,
                labelText: 'ID: '.$product->id,
                labelFont: new OpenSans(30),
                labelAlignment: LabelAlignment::Center
            );

            $qrCode = $builder->build();

            $qrCode->saveToFile(public_path('images/QR/').'qrcode'.$product->id.'.png');
            $product->qr_url = 'images/QR/qrcode'.$product->id.'.png';
            $product->save();

            return redirect('products')->with('message','El producto: '.$product->material.' ha sido creado existosamente!!');
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
        $product = Product::find($id);
        Carbon::setLocale('es');

        if($product->date_of_manufacture){
            $date = Carbon::parse($product->date_of_manufacture);
            $date = $date->format('d-M-Y');
            $product->date_of_manufacture = $date;
        }

        if($product->expiration_date){
            $date = Carbon::parse($product->expiration_date);
            $date = $date->format('d-M-Y');
            $product->expiration_date = $date;
        }


        return view('elements.products.show')->with('product',$product);
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
        $product = Product::find($id);
        return view('elements.products.edit')->with('product',$product);
    }

    /**
     * Recibe la solicitud de actualización de un elemento y actualiza el registro
     * PUT
     */
    public function update(ProductRequest $request, string $id)
    {
        if(Auth::user()->role->name != 'Admin' && Auth::user()->role->name != 'Operator'){
            return redirect('home')->with('error','No puede acceder a este recurso');
       }
       $product = Product::find($id);

       $product->material = $request->material;
       $product->reference = $request->reference;
       $product->lote = $request->lote;
    //    $product->qr_url = $request->qr_url;
       $product->date_of_manufacture = $request->date_of_manufacture;
       $product->expiration_date = $request->expiration_date;
       $product->amount = $request->amount;
       $product->user_id = Auth::user()->id;

        if($product->save()){
            return redirect('products')->with('message','El producto: '.$product->material.' ha sido actualizado existosamente!!');
        }
    }

    /**
     * Eliminar un registro
     * DELETE
     */
    public function destroy(Product $product)
    {
        if(Auth::user()->role->name != 'Admin' && Auth::user()->role->name != 'Operator'){
            return redirect('home')->with('error','No puede acceder a este recurso');
        }

        if($product->qr_url){
            $file = public_path().'/'.$product->qr_url;
            if (getimagesize($file)) {
                unlink($file);
            }
        }


        if($product->delete()){
            return redirect('products')->with('message','El producto: '.$product->material.' ha sido eliminado existosamente!!');
        }

    }
}
